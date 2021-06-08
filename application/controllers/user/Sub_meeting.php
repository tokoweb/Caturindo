<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Sub_meeting extends CI_Controller {

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

		$aktif = $this->model_meeting->menu_submeeting($status_meeting);

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

	    $data['sub_meeting'] = $this->model_meeting->tampil_submeeting_web($_SESSION['user_data']->id, null, null, $status_meeting, $web);

	    $data['aktif'] = $aktif;
	    $data['konten'] = "user/sub_meeting/index";
		$this->load->view('user/index', $data);
		
	}

	public function pilih_meeting()
	{

		$data_meeting = $this->model_meeting->tampil(null, '1', $_SESSION['user_data']->id, null, 'web');

		$data['data_meeting'] = $data_meeting;

		$data['konten'] = "user/sub_meeting/pilih_meeting";
		$this->load->view('user/index', $data);

	}

	public function pilihan($id_meeting)
	{

		$data['kode_meeting'] = $id_meeting;
		$data['konten'] = "user/sub_meeting/pilihan";
		$this->load->view('user/index', $data);

	}

	public function booking_ruangan()
	{

		$session_user = $this->session->userdata('user_data');
		$cek = $this->input->get();

		$data['group'] = $this->db->get_where('group_team', ['id_user'=>$session_user->id])->result();

		if (empty($cek['kode_meeting'])) {
			// redirect('user/sub_meeting/pilih_meeting');
		}else if (
			empty($cek['kode_ruangan']) || empty($cek['tanggal']) ||
			empty($cek['waktu_mulai']) || empty($cek['waktu_selesai'])
		) {
			$kode_meeting = $cek['kode_meeting'];
			redirect('user/sub_meeting/pilihan/'.$kode_meeting,'refresh');
		}

		$r = $this->db->get_where('rooms', ['code_room'=>$cek['kode_ruangan']])->first_row();

		if (empty($r)) {
			redirect('user/sub_meeting/pilihan/'.$kode_meeting,'refresh');
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
		$data['kode_meeting']  = $cek['kode_meeting'];

		$data['semua_data'] = $cek;

		$data['konten'] = "user/sub_meeting/booking_ruangan";
		$this->load->view('user/index', $data);

	}

	public function booking_transport()
	{

		$session_user = $this->session->userdata('user_data');
		$cek = $this->input->get();

		if (empty($cek['kode_meeting'])) {
			redirect('user/sub_meeting/pilih_meeting');
		}else if (
			empty($cek['kode_transport']) || empty($cek['tanggal']) ||
			empty($cek['waktu_mulai']) || empty($cek['waktu_selesai'])
		) {
			$kode_meeting = $cek['kode_meeting'];
			redirect('user/sub_meeting/pilihan/'.$kode_meeting,'refresh');
		}

		$r = $this->db->get_where('transports', ['id'=>$cek['kode_transport']])->first_row();

		if (empty($r)) {
			redirect('user/sub_meeting/pilihan/'.$kode_meeting,'refresh');
		}

		$nama_transport = str_replace('Transport', '', $r->name_transport);
		$nama_transport = str_replace('transport', '', $nama_transport);
		$tanggal_indo = tgl_indo($cek['tanggal']);
		$judul = 'Booking Transport '.$nama_transport.' Pada '.$tanggal_indo.' Pukul '.$cek['waktu_mulai'].' Sampai '.$cek['waktu_selesai'];

		$data['judul']           = $judul;
		$data['nama_transport']  = $r->name_transport;
		$data['kode_transport']  = $cek['kode_transport'];
		$data['tanggal']       = $cek['tanggal'];
		$data['waktu_mulai']   = $cek['waktu_mulai'];
		$data['waktu_selesai'] = $cek['waktu_selesai'];
		$data['id_user']       = $session_user->id;
		$data['kode_meeting']  = $cek['kode_meeting'];

		$data['konten'] = "user/sub_meeting/booking_transport";
		$this->load->view('user/index', $data);

	}

	public function batal($id)
	{

		# ambil id booking
		$meeting = $this->db->get_where('sub_meeting', ['id'=>$id])->first_row();
		
		if (!empty($meeting)) {
			
			# hapus booking
			$this->db->delete('booking', ['id'=>$meeting->id_booking]);
			#hapus meeting
			$this->db->delete('sub_meeting', ['id'=>$id]);

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

		$this->session->set_flashdata('berhasil', 'Berhasil membatalkan sub meeting');
		redirect('user/sub_meeting','refresh');

	}

	public function selesai($id)
	{

		$this->db->update('sub_meeting', ['status_meeting'=>'1'],['id'=>$id]);
		$this->session->set_flashdata('berhasil', 'sub meeting telah selesai');
		redirect('user/sub_meeting','refresh');

	}

}

/* End of file Sub_meeting.php */
/* Location: ./application/controllers/user/Sub_meeting.php */