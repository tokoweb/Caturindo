<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Transport extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_transports');
	}

	public function index_get()
	{
		
		$id_transport   = $this->get('id_transport');
		// $status_booking = $this->get('status_booking');
		$date           = $this->get('date');
		$meet_mulai   	= $this->get('time_start');
		$meet_mulai 	= $this->get('time_end');

		if (!empty($id_transport)) {
			
			$data_transports = $this->db->get_where('transports', ['id'=>$id_transport])->result_array();

		} else {

			$data_transports = $this->model_transports->tampil_tersedia_v2($date, $meet_mulai, $meet_mulai);

		}

		if (!empty($data_transports)) {
			
			for ($i=0; $i < sizeof($data_transports); $i++) {
			
				$data_image = $this->db->get_where('image_transports', ['code_transport'=>$data_transports[$i]['id']])
						               ->result();

	           if (!empty($data_image)) {
	           		
	           		foreach ($data_image as $key => $di) {
	           			$data_transports[$i]['image'][] = base_url().'assets/gambar/'.$di->image;
	           		}

	           } else {

	           		$data_transports[$i]['image'] = null;
	           		
	           }

			}

		}

		if (!empty($data_transports)) {
			
			$this->response([
				'status'  => true,
				'message' => 'Data transport berhasil di dapat',
				'data'    => $data_transports
			], 200);

		} else {

			$this->response([
				'status'  => true,
				'message' => 'Data transport gagal di dapat',
				'data'    => []
			], 200);

		}

	}

}

/* End of file Transport.php */
/* Location: ./application/controllers/api/Transport.php */