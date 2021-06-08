<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->model('model_admin');
		if($this->session->userdata('admin_valid') != TRUE )
			redirect("index.php/login");
	}

	/* Fungsi Manage User */
	public function index(){

		$a['role']  = $this->db->get('user_role')->result();
		$a['data']	= $this->model_admin->tampil_user();
		$a['page']	= "manage_user";
		$status_user[] = (object)[
			'id_status' => 1,
			'status'    => 'Aktif'
		];
		$status_user[] = (object)[
			'id_status' => 2,
			'status'    => 'Non Aktif'
		];

		$a['status_user'] = $status_user;

		$this->load->view('admin/index', $a);

	}

	public function edit_admin()
	{

		$id = $this->session->userdata('admin_id');
		$a['data_admin'] = $this->db->get_where('users', ['id'=>$id])->first_row();

		$a['page']	= "user/edit_profile";
		$this->load->view('admin/index', $a);

	}

	public function aksi_edit_admin()
	{

		$id = $this->session->userdata('admin_id');
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$whatsapp = $this->input->post('whatsapp');

		$data_update = [
			'name' => $this->input->post('name'),
			'username' => $username,
			'email' => $email,
			'phone' => $phone,
			'whatsapp' => $whatsapp
		];

		$cek_user = $this->db->get_where('users', ['username'=>$username])->first_row();
        $cek_phone = $this->db->get_where('users', ['phone'=>$phone])->first_row();
        $cek_whatsapp = $this->db->get_where('users', ['whatsapp'=>$whatsapp])->first_row();

        if (!empty($cek_user) && $cek_user->id != $id) {
        	#cek username yang dobel
            
            $gagal = true;
            $pesan = 'Gagal update user, Username telah digunakan';

        } else if (!empty($cek_phone) && $cek_phone->id != $id) {
        	#cek no hp yang sudah di unakan user lain
            
            $gagal = true;
            $pesan = 'Gagal update user, No Hp telah digunakan oleh user lain';

        } else if (!empty($cek_whatsapp) && $cek_whatsapp->id != $id) {
            #cek nomor wa yang sudah digunakan user lain

            $gagal = true;
            $pesan = 'Gagal update user, No Whatsapp telah digunakan oleh user lain';

        }

        if (!empty($gagal)) {
        	
        	$flash_data = [
        		'berhasil_edit' => 'no',
        		'pesan'    => $pesan
        	];
        	$this->session->set_flashdata($flash_data);
        	redirect('index.php/admin/users/edit_admin','refresh');

        } else {

        	$this->db->update('users', $data_update, ['id'=>$id]);

        	$flash_data = [
        		'berhasil_edit' => 'yes',
        		'pesan'    => 'Berhasil edit data admin'
        	];
        	$this->session->set_flashdata($flash_data);
        	redirect('index.php/admin/users/edit_admin','refresh');

        }

	}

	public function ganti_password()
	{

		$id = $this->session->userdata('admin_id');
		$password_lama = $this->input->post('password_lama');
		$password_baru = $this->input->post('password_baru');
		$password_lagi = $this->input->post('password_lagi');

		// echo "password lama : ".$password_lama."<br>";
		// echo "password baru : ".$password_baru."<br>";
		// echo "password lagi : ".$password_lagi."<br>";

		if ($password_baru == $password_lagi) {
			
			$cek = $this->db->get_where('users', ['id'=>$id])->first_row();

			if (!empty($cek)) {

				$password_db = $cek->password;

				if (password_verify($password_lama, $password_db)) {
					$berhasil = true;
				}

			}

		} else {

			$beda_password = true;

		}

		if (!empty($berhasil)) {

			$options   = [
	            'cost' => 12,
	        ];
	        $password_hashed = password_hash($password_baru, PASSWORD_BCRYPT, $options);
			$this->db->update('users', ['password'=>$password_hashed], ['id'=>$id]);

			$flash_data = [
        		'berhasil_edit' => 'yes',
        		'pesan'    => 'Berhasil ganti password admin'
        	];

		} else if (!empty($beda_password)) {
			
			$flash_data = [
        		'berhasil_edit' => 'no',
        		'pesan'    => 'Mohon input kedua password baru yang sama'
        	];

		} else {
			
			$flash_data = [
        		'berhasil_edit' => 'no',
        		'pesan'    => 'Password lama yang anda input, tidak sesuai'
        	];

		}

		$this->session->set_flashdata($flash_data);
    	redirect('index.php/admin/users/edit_admin','refresh');

	}

	public function tambah_user(){

		$a['page']	= "tambah_user";

		$this->load->view('admin/index', $a);

	}

	public function edit_status_user($id_user)
	{

		$role = $this->input->post('status_aktif');

		$this->db->update('users', ['user_aktif'=>$role], ['id'=>$id_user]);
		redirect('index.php/admin/users','refresh');

	}

	public function edit_jabatan_user($id_user)
	{

		$role = $this->input->post('role');

		$this->db->update('users', ['role'=>$role], ['id'=>$id_user]);
		redirect('index.php/admin/users','refresh');

	}

	public function aksi_edit_user($id_user)
	{

		$data = [
			'username' => $this->input->post('username'),
			'email'    => $this->input->post('email'),
			'phone'    => $this->input->post('phone')
		];

		$this->db->update('users', $data, ['id'=>$id_user]);
		redirect('index.php/admin/users','refresh');

	}

	public function insert_user(){

		$user 	  = $this->input->post('user');
		$password = $this->input->post('password');
		$nama	  = $this->input->post('nama');

		$object = array(
				'username' => $user,
				'password' => md5($password),
				'nama' => $nama
			);
		$this->model_admin->insert_user($object);

		redirect('admin/manage_user','refresh');
	}

	public function edit_user($id){
		$a['editdata']	= $this->model_admin->edit_user($id)->result_object();
		$a['page']	= "edit_user";

		$this->load->view('admin/index', $a);
	}

	public function update_user(){
		$id 	  = $this->input->post('id');
		$user 	  = $this->input->post('user');
		$password = $this->input->post('password');
		$pass_old = $this->input->post('pass_old');
		$nama	  = $this->input->post('nama');

		if (empty($password)) {
			$object = array(
				'username' => $username,
				'password' => $password,
				'nama' => $nama
			);
		}else{
			$object = array(
				'username' => $username,
				'password' => $pass_old,
				'nama' => $nama
			);
		}


		$this->model_admin->update_user($id, $object);

		redirect('admin/surat_keluar','refresh');
	}

	public function hapus_user($id){

		$this->db->delete('users', ['id'=>$id]);
		redirect('index.php/admin/users','refresh');
	}

}

/* End of file Users.php */
/* Location: ./application/controllers/admin/Users.php */