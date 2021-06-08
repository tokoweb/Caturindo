<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('model_admin');
		$this->load->model('model_users');
		$this->load->helper(array('cookie', 'url', 'string'));
	}

	public function index()
	{
		if($this->session->userdata('admin_valid') == TRUE )
			redirect("index.php/admin");

		$this->load->view('login');
	}

	public function user()
	{

		if(!empty($this->session->userdata('user_data'))){
			redirect("user/home");
		} else if ($this->model_admin->cek_cookie(get_cookie('login'))) {
			redirect("user/home");
		}

		$this->load->view('login_user_v2');
	}

	public function auth($user = null)
	{

		$email = $this->input->post("email");
		$pass = $this->input->post("pass");
		$remember = $this->input->post("remember");

		$cek = $this->model_admin->login($email, $pass, $user);
		
		if (!empty($cek)) {

			if(!empty($cek->role)){

				$data = array(
					'admin_id'    => $cek->id,
				    'admin_user'  => $cek->email,
				    'admin_valid' => TRUE
				);

				if (!empty($user)) {

					if (!empty($remember)) {

						$key = random_string();
						set_cookie('login',$key,'214748');
						$this->db->update('users', ['cookie'=>$key], ['id'=>$cek->id]);

					}
					$data_user = $this->model_users->get_user($cek->id);
					$this->session->set_userdata('user_data', $data_user);
					redirect('user/home','refresh');

				} else {
					$this->session->set_userdata($data);
					redirect('index.php/admin','refresh');
				}

			} else {
				$this->session->set_flashdata('error','Anda tidak memiliki otoritas!');
				redirect('index.php/login');
			}

		} else{

			if (!empty($user)) {
				$this->session->set_flashdata('error','Username atau Password Salah!');
				redirect('login/user');
			} else {
				$this->session->set_flashdata('error','Username atau Password Salah!');
				redirect('index.php/login');
			}
			
		}

	}

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */
