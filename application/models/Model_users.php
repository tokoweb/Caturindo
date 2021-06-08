<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_users extends CI_Model {

	public function daftar($data){

		$this->db->insert('users',$data);
		$success = $this->db->affected_rows();

		if($success){

			$insert_id = $this->db->insert_id();
			$data = $this->db->get_where('users',array('id' => $insert_id))->first_row();
			return $data;

		}

	}

	public function login($token_firebase, $data)
	{

		/* login menggunakan username */
		$cek = $this->db->get_where('users', ['username'=>$data['username']])->first_row();

		if (empty($cek)) {
			
			/* login menggunakan no hp */
			$cek = $this->db->get_where('users', ['phone'=>$data['username']])->first_row();

			if (empty($cek)) {
				
				/* login menggunakan email */
				$cek = $this->db->get_where('users', ['email'=>$data['username']])->first_row();

				if (empty($cek)) {
					
					return false;

				}

			}

		}

		if (!empty($cek)) {
			$password_db = $cek->password;

			if (password_verify($data['password'], $password_db)) {

				$this->db->update('users', ['token_firebase'=>$token_firebase], ['id'=>$cek->id]);
				$hasil = $cek = $this->db->get_where('users', ['id'=>$cek->id])->first_row();
				return $hasil;

			} else {

				return 'password_salah';

			} 

		}

	}

	public function get_user($id_user)
	{

		$data_user = $this->db->get_where('users', ['id'=>$id_user])->first_row();

		# gambar profile
		if (!empty($data_user->id_image_profile)) {
			$g_profile = $this->db->get_where('file', ['id'=>$data_user->id_image_profile])->first_row();
			$data_user->id_image_profile = null;
			if (!empty($g_profile)) {
				$url_file = 'assets/file/'.$g_profile->file;
				# kalo file nya ada di folder
				if (file_exists($url_file)) {
					$data_user->id_image_profile = base_url().'assets/file/'.$g_profile->file;
				}
			}
		}

		# gambar background
		if (!empty($data_user->id_image_background)) {
			$g_background = $this->db->get_where('file', ['id'=>$data_user->id_image_background])->first_row();
			$data_user->id_image_background = null;
			if (!empty($g_background)) {
				$url_file = 'assets/file/'.$g_background->file;
				# kalo file nya ada di folder
				if (file_exists($url_file)) {
					$data_user->id_image_background = base_url().'assets/file/'.$g_background->file;
				}
			}
		}

		return $data_user;

	}

}

/* End of file Model_users.php */
/* Location: ./application/models/Model_users.php */