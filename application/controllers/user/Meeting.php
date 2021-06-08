<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Meeting extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_meeting');
		if(empty($this->session->userdata('user_data')))
			redirect("login/user");
	}

	public function index()
	{

		$status_meeting = $this->input->get('status_meeting');
		$tanggal        = $this->input->get('tanggal')?:null;

		$aktif = $this->model_meeting->menu_meeting($status_meeting);

	    if (!empty($status_meeting)) {
	    	$web = 1;
	    	if ($status_meeting == 1) {
	    		$status_meeting = null;
	    	} else if ($status_meeting == 2) {
	    		$status_meeting = 1;
	    	}
	    } else {
	    	$web = null;
	    }

	    $data['aktif'] = $aktif;
		$data['data_meeting'] = $this->model_meeting->tampil_meeting_web(null, $status_meeting, $_SESSION['user_data']->id, $tanggal, $web);

		$data['konten'] = "user/meeting/index";
		$this->load->view('user/index', $data);

	}

	public function pilih_ruangan()
	{

		$data['konten'] = "user/meeting/pilih_ruangan";
		$this->load->view('user/index', $data);

	}

	public function booking_ruangan()
	{

		$session_user = $this->session->userdata('user_data');
		$cek = $this->input->get();

		$data['group'] = $this->db->get_where('group_team', ['id_user'=>$session_user->id])->result();
		$r = $this->db->get_where('rooms', ['code_room'=>$cek['kode_ruangan']])->first_row();

		if (
			empty($cek['kode_ruangan']) || empty($cek['tanggal']) ||
			empty($cek['waktu_mulai']) || empty($cek['waktu_selesai']) ||
			empty($r)
		) {
			redirect('user/meeting/pilih_ruangan','refresh');
		}

		$nama_ruangan = str_replace('Ruangan', '', $r->name_room);
		$nama_ruangan = str_replace('ruangan', '', $nama_ruangan);
		$tanggal_indo = tgl_indo($cek['tanggal']);
		$judul = 'Booking Ruangan '.$nama_ruangan.' Pada '.$tanggal_indo.' Pukul '.$cek['waktu_mulai'].' Sampai '.$cek['waktu_selesai'];

		$data['judul']         = $judul;
		$data['nama_ruangan']  = $r->name_room;
		$data['kode_ruangan']  = $cek['kode_ruangan'];
		$data['tanggal']       = $cek['tanggal'];
		$data['waktu_mulai']   = $cek['waktu_mulai'];
		$data['waktu_selesai'] = $cek['waktu_selesai'];
		$data['id_user']       = $session_user->id;

		$data['semua_data'] = $cek;

		$data['konten'] = "user/meeting/booking_ruangan";
		$this->load->view('user/index', $data);

	}

	public function booking_transport()
	{

		$session_user = $this->session->userdata('user_data');
		$cek = $this->input->get();

		$r = $this->db->get_where('transports', ['id'=>$cek['kode_transport']])->first_row();

		if (
			empty($cek['kode_transport']) || empty($cek['tanggal']) ||
			empty($cek['waktu_mulai']) || empty($cek['waktu_selesai']) ||
			empty($r)
		) {
			redirect('user/meeting/pilih_ruangan','refresh');
		}

		$nama_transport = str_replace('Transport', '', $r->name_transport);
		$nama_transport = str_replace('transport', '', $nama_transport);
		$tanggal_indo = tgl_indo($cek['tanggal']);
		$judul = 'Booking Transport '.$nama_transport.' Pada '.$tanggal_indo.' Pukul '.$cek['waktu_mulai'].' Sampai '.$cek['waktu_selesai'];

		$data['judul']         = $judul;
		$data['nama_transport']  = $r->name_transport;
		$data['kode_transport']  = $cek['kode_transport'];
		$data['tanggal']       = $cek['tanggal'];
		$data['waktu_mulai']   = $cek['waktu_mulai'];
		$data['waktu_selesai'] = $cek['waktu_selesai'];
		$data['id_user']       = $session_user->id;

		$data['konten'] = "user/meeting/booking_transport";
		$this->load->view('user/index', $data);

	}

	public function data_group()
	{

		$session_user = $this->session->userdata('user_data');
		$data = $this->db->get_where('group_team', ['id_user'=>$session_user->id])->result();
		// $data = [];

		if (!empty($data)) {
			$data = [
				'status' => true,
				'data'   => $data
			];
		} else {
			$data = [
				'status' => false,
				'data'   => null
			];
		}

		print_r(json_encode($data));

	}

	public function batal($id)
	{

		# ambil id booking
		$meeting = $this->db->get_where('meeting', ['id'=>$id])->first_row();
		
		if (!empty($meeting)) {
			
			# hapus booking
			$this->db->delete('booking', ['id'=>$meeting->id_booking]);
			#hapus meeting
			$this->db->delete('meeting', ['id'=>$id]);
			

			if (!empty($meeting->id_file)) {
				# hapus file
				$this->db->delete('file', ['id'=>$meeting->id_file]);
				# ambil data file
				$file = $this->db->get_where('file', ['id'=>$meeting->id_file])->first_row();
				if (!empty($file)) {
					$url_file = 'assets/file/'.$file->file;
					# delete file di folder
					if (file_exists($url_file)) {
						unlink($url_file);
					}
				}
			}

		}

		$this->session->set_flashdata('berhasil', 'Berhasil membatalkan meeting');
		redirect('user/meeting','refresh');

	}

	public function selesai($id)
	{

		$this->db->update('meeting', ['status_meeting'=>'1'],['id'=>$id]);
		$this->session->set_flashdata('berhasil', 'meeting telah selesai');
		redirect('user/meeting','refresh');

	}

}

/* End of file Meeting.php */
/* Location: ./application/controllers/user/Meeting.php */