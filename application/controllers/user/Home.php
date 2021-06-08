<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(empty($this->session->userdata('user_data')))
			redirect("login/user");
	}

	public function index()
	{

		$data['kota'] = !empty($details->city)?$details->city:'Yogyakarta';
		$data['konten'] = "user/dashboard";

		$this->load->view('user/index', $data);

	}

	public function logout()
	{
		$this->session->sess_destroy();
		delete_cookie('login');
		redirect('login/user');
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/user/Home.php */