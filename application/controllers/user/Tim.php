<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Tim extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_team');
		$this->load->model('model_notification');
		if(empty($this->session->userdata('user_data')))
			redirect("login/user");
	}

	public function index()
	{

		$data['data_tim']    = $this->model_team->get_v4($_SESSION['user_data']->id, null);
		$data['data_group']  = $this->model_team->get_group($_SESSION['user_data']->id);

		$data['konten'] = "user/tim/index";
		$this->load->view('user/index', $data);

	}

	public function edit_group($id)
	{

		$this->db->update('group_team', $this->input->post(), ['id'=>$id]);
		$this->session->set_flashdata('berhasil', 'Berhasil update data group');
		redirect('user/tim','refresh');

	}

	public function cari_member()
	{

		$id_group = $this->input->get('id_group');
		$tampil = $this->model_team->search_member($_SESSION['user_data']->id, $id_group);

		print_r(json_encode($tampil));

	}

	public function tambah_tim()
	{

		$insert = $this->input->post();
		$cek_member = $this->db->get_where('team', $insert)->result();

		if (!empty($cek_member)) {
			$pesan = 'Maaf, member tersebut sudah di tambah';
			$this->session->set_flashdata('gagal', $pesan);
		} else {

			$this->db->insert('team', $insert);
			$this->session->set_flashdata('berhasil', 'Berhasil tambah member');
			$user   = $this->db->get_where('users', ['id'=>$insert['id_user']])->first_row();
			$member = $this->db->get_where('users', ['id'=>$insert['id_member']])->first_row();
			$team   = $this->db->get_where('team', ['id_group'=>$insert['id_group']])->result();
			$group  = $this->db->get_where('group_team', ['id'=>$insert['id_group']])->first_row();
			$total_member = !empty($team)?sizeof($team):0;

			$title_notification = $user->username." tagged you and ".$total_member." others in group ".$group->nama_team;

			$d_insert = [
				'id_user'     => $_SESSION['user_data']->id,
				'id_user_tag' => $insert['id_member'],
				'id_meeting'  => '',
				'title'       => $title_notification
			];
			# data simpan ke table notification
			$d_notif = $this->model_notification->tambah($d_insert);

			$ambil = [
				'body'  => 'member group '.$group->nama_team,
				'title' => $title_notification,
				'id'    => $d_notif->id
			];
			# kirim notifikasi ke user masing masing
			$cek = kirim_notifikasi($user->token_firebase, $ambil);

		}

		redirect('user/tim','refresh');

	}

	public function tambah_group()
	{

		$insert = $this->input->post();
		$this->db->insert('group_team', $insert);
		$insert_id = $this->db->insert_id();

		# habis insert, ambil data nya
		$group = $this->db->get_where('group_team',array('id' => $insert_id))->first_row();

		# tambah data team dengan id group tersebut
		$this->db->insert('team', [
			'id_user'   => $_SESSION['user_data']->id,
			'id_member' => $_SESSION['user_data']->id,
			'id_group'  => $group->id
		]);

		$this->session->set_flashdata('berhasil', 'Berhasil tambah group');
		redirect('user/tim','refresh');

	}

	public function hapus_tim($id)
	{

		$this->db->delete('team', ['id'=>$id]);
		$this->session->set_flashdata('berhasil', 'Berhasil hapus tim');
		redirect('user/tim','refresh');

	}

	public function hapus_group($id)
	{

		$this->db->delete('group_team', ['id'=>$id]);
		$this->db->delete('team', ['id_group'=>$id]);
		$this->session->set_flashdata('berhasil', 'Berhasil hapus group');
		redirect('user/tim','refresh');

	}

}

/* End of file Tim.php */
/* Location: ./application/controllers/user/Tim.php */