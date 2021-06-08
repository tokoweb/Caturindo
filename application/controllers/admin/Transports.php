<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Transports extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_transports');
		if($this->session->userdata('admin_valid') != TRUE )
			redirect("index.php/login");
	}

	public function index()
	{

		$a['page']	= "transport/index";
		$a['transports'] = $this->model_transports->tampil_data();

		$this->load->view('admin/index', $a);

	}

	public function tambah_transport()
	{

		$total = $this->db->select('count(id) as total')
				 ->get('transports')
				 ->first_row();
		$code_transport = $total->total + 1;

		$data = [
			'id'              => 'T'.$code_transport,
			'name_transport'  => $this->input->post('name_transport'),
			'max_people'      => $this->input->post('max_people'),
		];

		$this->db->insert('transports', $data);

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
		          	redirect('index.php/admin/transports','refresh');
		          	die();

		          }

		        }
		   
		    } // for

		    if (!empty($data_gambar)) {
		    	
		    	foreach ($data_gambar as $key => $dg) {
			    	$input_gambar = [
			    		'code_transport' => 'T'.$code_transport,
			    		'image'          => $dg   
			    	];
			    	$this->db->insert('image_transports', $input_gambar);
			    }

		    }

	    }

	    $this->session->set_flashdata('pesan_berhasil', 'Berhasil tambah data transport');
		redirect('index.php/admin/transports','refresh');

	}

	public function edit_transport($code_transport)
	{

		$data = [
			'name_transport' => $this->input->post('name_transport'),
			'max_people'     => $this->input->post('max_people'),
		];

		$this->db->update('transports', $data, ['id'=>$code_transport]);

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
		          	redirect('index.php/admin/transports','refresh');
		          	die();

		          }

		        }
		   
		    } // for

		    if (!empty($data_gambar)) {
		    	foreach ($data_gambar as $key => $dg) {
			    	$input_gambar = [
			    		'code_transport' => $code_transport,
			    		'image'     => $dg   
			    	];
			    	$this->db->insert('image_transports', $input_gambar);
			    }
		    }

	    }

	    $this->session->set_flashdata('pesan_berhasil', 'Berhasil edit transport');
		redirect('index.php/admin/transports','refresh');

	}

	public function hapus_gambar($id_gambar)
	{
		$gambar = $this->db->get_where('image_transports', ['id'=>$id_gambar])->first_row();
		unlink('assets/gambar/'.$gambar->image);

		$this->db->delete('image_transports', ['id'=>$id_gambar]);
		$this->session->set_flashdata('pesan_berhasil', 'Berhasil hapus gambar');
		redirect('index.php/admin/transports','refresh');

	}

	public function hapus_transport($code_transport)
	{

		$gambar = $this->db->get_where('image_transports', ['code_transport'=>$code_transport])->result();

		foreach ($gambar as $key => $value) {
			unlink('assets/gambar/'.$value->image);
		}

		$this->db->delete('image_transports', ['code_transport'=>$code_transport]);
		$this->db->delete('transports', ['id'=>$code_transport]);
		$this->session->set_flashdata('pesan_berhasil', 'Berhasil hapus gambar');
		redirect('index.php/admin/transports','refresh');

	}

}

/* End of file Transports.php */
/* Location: ./application/controllers/admin/Transports.php */