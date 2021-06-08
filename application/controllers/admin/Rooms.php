<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rooms extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_rooms');
		if($this->session->userdata('admin_valid') != TRUE )
			redirect("index.php/login");
	}

	public function index()
	{

		$a['page']	= "room/index";
		$a['rooms'] = $this->model_rooms->tampil_data();

		$this->load->view('admin/index', $a);

	}

	public function tambah_room()
	{

		$total = $this->db->select('count(code_room) as total')
				 ->get('rooms')
				 ->first_row();
		$code_room = $total->total + 1;

		$data = [
			'code_room'  => 'R'.$code_room,
			'name_room'  => $this->input->post('name_room'),
			'max_people' => $this->input->post('max_people'),
		];

		$this->db->insert('rooms', $data);

		$count = count($_FILES['files']['name']);
    
	    if (!empty($count)) {
	    	
	    	for($i=0;$i<$count;$i++){
	    
		        if(!empty($_FILES['files']['name'][$i])){
		    
		          $_FILES['file']['name'] = $_FILES['files']['name'][$i];
		          $_FILES['file']['type'] = $_FILES['files']['type'][$i];
		          $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
		          $_FILES['file']['error'] = $_FILES['files']['error'][$i];
		          $_FILES['file']['size'] = $_FILES['files']['size'][$i];
		  
		          $config['upload_path'] = 'assets/gambar';
		          $config['allowed_types'] = 'jpg|jpeg|png|gif';
		          $config['max_size'] = '5000';
		          $config['encrypt_name'] = TRUE;
		          // $config['file_name'] = $_FILES['files']['name'][$i];
		   
		          $this->load->library('upload',$config); 
		    
		          if($this->upload->do_upload('file')){

		            $uploadData = $this->upload->data();
		            $filename = $uploadData['file_name'];
		   
		            $data_gambar[] = $filename;

		          } else {

		          	$msg = $this->upload->display_errors('', '');
		          	$this->session->set_flashdata('pesan_gagal', $msg);
		          	redirect('index.php/admin/rooms','refresh');
		          	die();

		          }

		        }
		   
		    } // for

		    if (!empty($data_gambar)) {
		    	
		    	foreach ($data_gambar as $key => $dg) {
			    	$input_gambar = [
			    		'code_room' => 'R'.$code_room,
			    		'image'     => $dg   
			    	];
			    	$this->db->insert('image_rooms', $input_gambar);
			    }

		    }

	    }

	    $this->session->set_flashdata('pesan_berhasil', 'Berhasil tambah data ruangan');
		redirect('index.php/admin/rooms','refresh');

	}

	public function edit_room($code_room)
	{

		$data = [
			'name_room'  => $this->input->post('name_room'),
			'max_people' => $this->input->post('max_people'),
		];

		$this->db->update('rooms', $data, ['code_room'=>$code_room]);

		if (!empty($_FILES['files']))
			$count = count($_FILES['files']['name']);

	    if (!empty($count)) {

	    	for($i=0;$i<$count;$i++){
	    
		        if(!empty($_FILES['files']['name'][$i])){
		    
		          $_FILES['file']['name'] = $_FILES['files']['name'][$i];
		          $_FILES['file']['type'] = $_FILES['files']['type'][$i];
		          $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
		          $_FILES['file']['error'] = $_FILES['files']['error'][$i];
		          $_FILES['file']['size'] = $_FILES['files']['size'][$i];
		  
		          $config['upload_path'] = 'assets/gambar';
		          $config['allowed_types'] = 'jpg|jpeg|png|gif';
		          $config['max_size'] = '5000';
		          $config['encrypt_name'] = TRUE;
		   
		          $this->load->library('upload',$config); 
		    
		          if($this->upload->do_upload('file')){

		            $uploadData = $this->upload->data();
		            $filename = $uploadData['file_name'];
		   
		            $data_gambar[] = $filename;

		          } else {

		          	$msg = $this->upload->display_errors('', '');
		          	$this->session->set_flashdata('pesan_gagal', $msg);
		          	redirect('index.php/admin/rooms','refresh');
		          	die();

		          }

		        }
		   
		    } // for

		    if (!empty($data_gambar)) {
		    	foreach ($data_gambar as $key => $dg) {
			    	$input_gambar = [
			    		'code_room' => $code_room,
			    		'image'     => $dg   
			    	];
			    	$this->db->insert('image_rooms', $input_gambar);
			    }
		    }

	    }

	    $this->session->set_flashdata('pesan_berhasil', 'Berhasil edit ruangan');
		redirect('index.php/admin/rooms','refresh');

	}

	public function hapus_gambar($id_gambar)
	{
		$gambar = $this->db->get_where('image_rooms', ['id'=>$id_gambar])->first_row();
		unlink('assets/gambar/'.$gambar->image);

		$this->db->delete('image_rooms', ['id'=>$id_gambar]);
		$this->session->set_flashdata('pesan_berhasil', 'Berhasil hapus gambar');
		redirect('index.php/admin/rooms','refresh');

	}

	public function hapus_room($code_room)
	{

		$gambar = $this->db->get_where('image_rooms', ['code_room'=>$code_room])->result();

		foreach ($gambar as $key => $value) {
			unlink('assets/gambar/'.$value->image);
		}

		$this->db->delete('image_rooms', ['code_room'=>$code_room]);
		$this->db->delete('rooms', ['code_room'=>$code_room]);
		$this->session->set_flashdata('pesan_berhasil', 'Berhasil hapus gambar');
		redirect('index.php/admin/rooms','refresh');

	}

}

/* End of file Rooms.php */
/* Location: ./application/controllers/admin/Rooms.php */