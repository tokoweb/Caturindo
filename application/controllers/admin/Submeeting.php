<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Submeeting extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_sub_meeting');
		if($this->session->userdata('admin_valid') != TRUE )
			redirect("index.php/login");
	}

	public function index()
	{

		$tgl_awal = $this->input->get('tgl_awal')?:date('Y-m-d');
		$tgl_akhir = $this->input->get('tgl_akhir')?:date('Y-m-d');

		$a['s_meetings'] = $this->model_sub_meeting->get_submeeting_for_admin($tgl_awal, $tgl_akhir);

		$tgl_a     = tgl_indo($tgl_awal);
		$tgl_akhir = tgl_indo($tgl_akhir);

		if ($tgl_awal == date('Y-m-d')) {
			$a['judul'] = "Data Sub Meeting ".$tgl_a;
		} else {
			$a['judul'] = "Data Sub Meeting ".$tgl_a." - ".$tgl_akhir;
		}

		$a['page']	= "sub_meeting/index";
		$this->load->view('admin/index', $a);

	}

	public function index_backup()
	{

		$a['page']	= "sub_meeting/index";

		$a['s_meetings'] = $this->db->select('sub_meeting.*, 
								    u.username as created_user, 
								    DATE_FORMAT(b.date, "%W %d %M %Y") as date')
						 ->join('users u', 'u.id=sub_meeting.id_user')
						 ->join('booking b', 'b.id=sub_meeting.id_booking')
						 ->order_by('sub_meeting.id', 'desc')
						 ->get('sub_meeting')->result();

		$this->load->view('admin/index', $a);

	}

}

/* End of file Submeeting.php */
/* Location: ./application/controllers/admin/Submeeting.php */