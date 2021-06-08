<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_users');
		$this->load->model('model_meeting');
		if(empty($this->session->userdata('user_data')))
			redirect("login/user");
	}

	public function index()
	{

		$user = $this->session->userdata('user_data');
		$data_user = $this->model_users->get_user($user->id);

		$data['profile'] = $data_user;
		$data['konten']  = "user/profile/index";
		$this->load->view('user/index', $data);
		
	}

	public function update()
	{

		$user = $this->session->userdata('user_data');
		$update = $this->input->post();

		$this->db->update('users', $update, ['id'=>$user->id]);
		$this->session->set_flashdata('berhasil', 'Berhasil update profile');
		redirect('user/profile','refresh');

	}

	public function edit_password()
	{

		$user = $this->session->userdata('user_data');
		$update = $this->input->post();

		$data_user = $this->db->get_where('users', ['id'=>$user->id])->first_row();

		if (!empty($data_user)) {
			if (password_verify($update['password_lama'], $data_user->password)) {
				$options   = [
		            'cost' => 12,
		        ];
		        $password_hashed = password_hash($update['password'], PASSWORD_BCRYPT, $options);
				$this->db->update('users', ['password'=>$password_hashed]);
				$this->session->set_flashdata('berhasil', 'Berhasil update password');
			} else {
				$this->session->set_flashdata('gagal', 'Password lama yang anda input, tidak sesuai');
			}
		}
		
		redirect('user/profile','refresh');

	}

	public function ganti_gambar_profile()
	{

		$user = $this->session->userdata('user_data');

		$config['upload_path'] = 'assets/file';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 1024 * 8;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        $status = null;
        if (!$this->upload->do_upload('gambar')) {

            $status = 'error';
            $msg = $this->upload->display_errors('', '');

            $this->session->set_flashdata('gagal', $msg);
			redirect('user/profile','refresh');

        } else {

        	$user = $this->db->get_where('users', ['id'=>$user->id])->first_row();

	        if (!empty($user->id_image_profile)) {
				# ambil data file
				$file = $this->db->get_where('file', ['id'=>$user->id_image_profile])->first_row();
				if (!empty($file)) {
					$url_file = 'assets/file/'.$file->file;
					# delete file di folder
					if (file_exists($url_file)) {echo "masok";
						unlink($url_file);
					}
					# hapus file
					$this->db->delete('file', ['id'=>$user->id_image_profile]);
				}
			}

        	$data = $this->upload->data();
        	
        	$data_file = $this->model_meeting->tambah_file(['file'=>$data['file_name']]);
        	$this->db->update('users', ['id_image_profile'=>$data_file->id], ['id'=>$user->id]);

        	$this->session->set_flashdata('berhasil', 'Berhasil update foto profile');
			redirect('user/profile','refresh');

        }

	}

	public function ganti_gambar_background()
	{

		$user = $this->session->userdata('user_data');

		$config['upload_path'] = 'assets/file';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 1024 * 8;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        $status = null;
        if (!$this->upload->do_upload('gambar')) {

            $status = 'error';
            $msg = $this->upload->display_errors('', '');

            $this->session->set_flashdata('gagal', $msg);
			redirect('user/profile','refresh');

        } else {

        	$user = $this->db->get_where('users', ['id'=>$user->id])->first_row();

	        if (!empty($user->id_image_background)) {
				# ambil data file
				$file = $this->db->get_where('file', ['id'=>$user->id_image_profile])->first_row();
				if (!empty($file)) {
					$url_file = 'assets/file/'.$file->file;
					# delete file di folder
					if (file_exists($url_file)) {
						unlink($url_file);
					}
					# hapus file
					$this->db->delete('file', ['id'=>$user->id_image_profile]);
				}
			}

        	$data = $this->upload->data();
        	
        	$data_file = $this->model_meeting->tambah_file(['file'=>$data['file_name']]);
        	$this->db->update('users', ['id_image_background'=>$data_file->id], ['id'=>$user->id]);

        	$this->session->set_flashdata('berhasil', 'Berhasil update foto background');
			redirect('user/profile','refresh');

        }

	}

}

/* End of file Profile.php */
/* Location: ./application/controllers/user/Profile.php */