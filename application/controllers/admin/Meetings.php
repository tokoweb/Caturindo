<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Meetings extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_meeting');
		if($this->session->userdata('admin_valid') != TRUE )
			redirect("index.php/login");
	}

	public function index()
	{

		$tgl_awal = $this->input->get('tgl_awal')?:date('Y-m-d');
		$tgl_akhir = $this->input->get('tgl_akhir')?:date('Y-m-d');

		$a['page']	= "meeting/index";
		$a['meetings'] = $this->model_meeting->get_meeting_for_admin($tgl_awal, $tgl_akhir);

		$tgl_a     = tgl_indo($tgl_awal);
		$tgl_akhir = tgl_indo($tgl_akhir);

		if ($tgl_awal == date('Y-m-d')) {
			$a['judul'] = "Data meeting ".$tgl_a;
		} else {
			$a['judul'] = "Data meeting ".$tgl_a." - ".$tgl_akhir;
		}

		$this->load->view('admin/index', $a);

	}

	private function index_backup()
	{

		$a['page']	= "meeting/index";

		$a['meetings'] = $this->db->select('meeting.*, 
								    u.username as created_user, 
								    DATE_FORMAT(b.date, "%W %d %M %Y") as date')
						 ->join('users u', 'u.id=meeting.id_user')
						 ->join('booking b', 'b.id=meeting.id_booking')
						 ->order_by('meeting.id', 'desc')
						 ->get('meeting')->result();

		$this->load->view('admin/index', $a);

	}

}

/* End of file Meetings.php */
/* Location: ./application/controllers/admin/Meetings.php */