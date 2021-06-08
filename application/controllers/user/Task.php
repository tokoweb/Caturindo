<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_task');
		$this->load->model('model_notification');
		$this->load->model('model_meeting');
		if(empty($this->session->userdata('user_data')))
			redirect("login/user");
	}

	public function index()
	{

		$user = $this->session->userdata('user_data');

		$data['data_task'] = $this->model_task->get_task_web($user->id);

		$data['konten'] = "user/task/index";
		$this->load->view('user/index', $data);

	}

	public function selesai($id)
	{

		$this->db->update('task', ['status_task'=>'1'], ['id'=>$id]);
		$this->session->set_flashdata('berhasil', 'Task telah selesai');
		redirect('user/task','refresh');

	}

	public function batal($id)
	{

		$this->db->delete('task', ['id'=>$id]);
		$this->session->set_flashdata('berhasil', 'Task berhasil di batalkan');
		redirect('user/task','refresh');

	}

	public function pilihan($jenis = null)
	{

		$user = $this->session->userdata('user_data');

		if (!empty($jenis)) {
			$data['link_menu']  = base_url('user/task/pilihan/');
			$data['link_menu2'] = '#';
			$data['aktif'] = '';
			$data['aktif2'] = 'active';
			$data['sub'] = 'Sub';
			$data_meeting = $this->model_meeting->tampil_submeeting_web($user->id, null, null, null, null);
		} else {
			$data['link_menu'] = '#';
			$data['link_menu2'] = base_url('user/task/pilihan/').'1';
			$data['aktif'] = 'active';
			$data['aktif2'] = '';
			$data['sub'] = '';
			$data_meeting = $this->model_meeting->tampil(null, null, $user->id, null, null);
		}

		$data['data_meeting'] = $data_meeting;
		$data['konten'] = "user/task/pilihan";
		$this->load->view('user/index', $data);

	}

	public function create($id)
	{

		$user = $this->session->userdata('user_data');
		$data['id_meeting'] = $id;
		$data['id_user']	= $user->id;

		$data['konten'] = "user/task/create";
		$this->load->view('user/index', $data);

	}

}

/* End of file Task.php */
/* Location: ./application/controllers/user/Task.php */