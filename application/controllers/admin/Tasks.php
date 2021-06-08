<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tasks extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_task');
		if($this->session->userdata('admin_valid') != TRUE )
			redirect("index.php/login");
	}

	public function index()
	{

		$tgl_awal  = $this->input->get('tgl_awal');
		$tgl_akhir = $this->input->get('tgl_akhir');

		$a['tasks'] = $this->model_task->get_task_web_admin($tgl_awal, $tgl_akhir);

		$a['page']	= "task/index_v2";
		$this->load->view('admin/index', $a);

	}

	private function index_backup()
	{

		$a['page']	= "task/index";

		$a['tasks'] = $this->db->select('task.*, 
									    u.username as created_user, 
									    DATE_FORMAT(task.due_date, "%W %d %M %Y") as created,
									    m.id as code_meting,
									    m.title')
							 ->join('users u', 'u.id=task.id_user')
							 ->join('meeting m', 'm.id=task.id_meeting')
							 ->order_by('task.id', 'desc')
							 ->get('task')->result();

		$this->load->view('admin/index', $a);

	}

}

/* End of file Tasks.php */
/* Location: ./application/controllers/admin/Tasks.php */