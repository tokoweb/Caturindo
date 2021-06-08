<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class File extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_meeting');
	}

	public function index()
	{
		
	}

	public function upload_post()
	{

		$config['upload_path']   = 'assets/file';
		// $config['allowed_types'] = 'gif|jpg|png|doc|txt|pdf';
		$config['allowed_types'] = '*';
		$config['max_size']      = 1024 * 10;
		$config['encrypt_name']  = TRUE;

		if (empty($_FILES)) {
			$this->response([
				'status'  => false,
				'message' => 'anda belum mengupload file',
				'data'    => null
			], 200);
		}

		$files = $_FILES['files'];

		$this->load->library('upload', $config);

		for ($y=0; $y < sizeof($_FILES['files']['name']); $y++) { 
	        
	      $_FILES['file']['name'] = $_FILES['files']['name'][$y];
          $_FILES['file']['type'] = $_FILES['files']['type'][$y];
          $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$y];
          $_FILES['file']['error'] = $_FILES['files']['error'][$y];
          $_FILES['file']['size'] = $_FILES['files']['size'][$y];

	        $image = $files['name'][$y];
	        $config['file_name'] = $image;

	        $this->upload->initialize($config);

	        if ($this->upload->do_upload('file')) {
	            
	            $data[] = $this->upload->data();

	        } else {
	            
	            $msg = $this->upload->display_errors('', '');
	            $this->response([
					'status'  => false,
					'message' => $msg,
					'data'    => [
						'message' => $msg
					]
				], 200);

	        }
	    }

		// @unlink($_FILES['file']);

		if (!empty($data)) {

			for ($i=0; $i < sizeof($data); $i++) { 
		    	$insert = [
		    		'file' => $data[$i]['file_name']
		    	];
				$data_file = $this->model_meeting->tambah_file($insert);
				// $data_file->file = base_url().'assets/file/'.$data_file->file;
				$d_file[] = $data_file->id;
			}

			$id_file = implode(',', $d_file);

			$this->response([
				'status'  => true,
				'message' => 'Berhasil upload file',
				'data'    => $id_file
			], 200);

		} else {

			$this->response([
				'status'  => false,
				'message' => $msg,
				'data'    => [
					'message' => $msg
				]
			], 200);

		}

	}

}

/* End of file File.php */
/* Location: ./application/controllers/api/File.php */