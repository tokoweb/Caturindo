<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Notification extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function index_get()
	{

		$id_user = $this->get('id_user');

		$d_notification = $this->db->get_where('notification', ['id_user_tag'=>$id_user])->result();

		foreach ($d_notification as $key => $value) {

			$value->meeting = null;
			$value->sub_meeting = null;
			$value->task = null;
			if (!empty($value->id_meeting)) {
				$d_meeting = $this->db->get_where('meeting', ['id'=>$value->id_meeting])->first_row();
				if (!empty($d_meeting)) {
					$value->meeting = [
						'title' => $d_meeting->title,
						'description' => $d_meeting->description
					];
				}
			}

			if (!empty($value->id_task)) {
				$d_task = $this->db->get_where('task', ['id'=>$value->id_task])->first_row();
				if (!empty($d_task)) {
					$value->task = [
						'title' => $d_task->name_task,
						'description' => $d_task->description
					];
				}
			}

			if (!empty($value->id_sub_meeting)) {
				$d_s_meeting = $this->db->get_where('sub_meeting', ['id'=>$value->id_sub_meeting])->first_row();
				if (!empty($d_s_meeting)) {
					$value->sub_meeting = [
						'title'       => $d_s_meeting->title,
						'description' => $d_s_meeting->description
					];
				}
			}

		}

		if (!empty($d_notification)) {
			
			$this->response([
				'status'  => true,
				'message' => 'Notifikasi berhasil didapat',
				'data'    => $d_notification
			], 200);

		} else {

			$this->response([
				'status'  => false,
				'message' => 'Belum ada notifikasi',
				'data'    => []
			], 200);

		}
		
	}
	public function app_version_get()
	{

		$cek = $this->db->get_where('app_version', ['version'=>$this->get('version')])->first_row();

		if (!empty($cek)) {
			
			$this->response([
				'status'  => true,
				'message' => 'Version app sudah sesuai',
				'data'    => $cek
			], 200);

		} else {

			$this->response([
				'status'  => false,
				'message' => 'Mohon update aplikasi ke versi terbaru',
				'data'    => []
			], 200);

		}

	}

}

/* End of file Notification.php */
/* Location: ./application/controllers/api/Notification.php */