<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Users extends REST_Controller {

	public function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('model_users');
        $this->load->model('model_meeting');
    }

    public function index_get()
    {
    	
        $id_user = $this->get('id_user');

        $d_user = $this->db->get_where('users', ['id'=>$id_user])->first_row();
        $d_gambar_profil = $this->db->get_where('file', ['id'=>$d_user->id_image_profile])->first_row();
        $d_background_profil = $this->db->get_where('file', ['id'=>$d_user->id_image_background])->first_row();

        if (!empty($d_gambar_profil)) {
            $d_user->image_profile = base_url().'assets/file/'.$d_gambar_profil->file;
        } else {
            $d_user->image_profile = null;
        }

        if (!empty($d_background_profil)) {
            $d_user->image_background = base_url().'assets/file/'.$d_background_profil->file;
        } else {
            $d_user->image_background = null;
        }

        if (!empty($d_user)) {
            
            $this->response([
                'status'  => true,
                'message' => 'Data user berhasil didapat',
                'data'    => $d_user
            ], 200);

        } else {

            $this->response([
                'status'  => false,
                'message' => 'Data user gagal didapat',
                'data'    => []
            ], 200);

        }

    }

    public function edit_user_put()
    {

        $id_user  = $this->put('id_user');
        $username = $this->put('username');
        $no_hp    = $this->put('no_hp');
        $whatsapp = $this->put('whatsapp');

        $update = [
            'name' => $this->put('name'),
            'username' => $username,
            'email' => $this->put('email'),
            'phone' => $no_hp,
            'whatsapp' => $whatsapp
        ];

        $cek_user = $this->db->get_where('users', ['username'=>$username])->first_row();
        $cek_phone = $this->db->get_where('users', ['phone'=>$no_hp])->first_row();
        $cek_whatsapp = $this->db->get_where('users', ['whatsapp'=>$whatsapp])->first_row();

        if (!empty($cek_user) && $cek_user->id != $id_user) {
            
            $this->response([
                'status'  => false,
                'message' => 'Gagal update user, Username telah digunakan',
                'data'    => []
            ], 200);

        } else if (!empty($cek_phone) && $cek_phone->id != $id_user) {
            
            $this->response([
                'status'  => false,
                'message' => 'Gagal update user, No Hp telah digunakan oleh user lain',
                'data'    => []
            ], 200);

        } else if (!empty($cek_whatsapp) && $cek_whatsapp->id != $id_user) {
            
            $this->response([
                'status'  => false,
                'message' => 'Gagal update user, No Whatsapp telah digunakan oleh user lain',
                'data'    => []
            ], 200);

        }

        $this->db->update('users', $update, ['id'=>$id_user]);
        $hasil = $this->db->get_where('users', ['id'=>$id_user])->first_row();

        $this->response([
            'status'  => true,
            'message' => 'Berhasil edit user',
            'data'    => $hasil
        ], 200);

    }

    public function edit_image_profile_post(){

        $id_user = $this->post('id_user');
        
        $config['upload_path'] = 'assets/file';
        $config['allowed_types'] = 'gif|jpg|png|doc|txt|pdf|jpeg';
        $config['max_size'] = 1024 * 8;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        $status = null;
        if (!$this->upload->do_upload('file')) {

            $status = 'error';
            $msg = $this->upload->display_errors('', '');

        } else {

            $data = $this->upload->data();

            if($data) {

                $status = "success";
                // $msg = "File successfully uploaded";
                $file = $_FILES['file']['name'];

            } else {

                unlink($data['full_path']);
                $msg = "Something went wrong when saving the file, please try again.";

                $return = [
                    'status' => 'error',
                    'pesan'  => $msg
                ];

            }

        }
        @unlink($_FILES['file']);

        if ($status == 'success') {

            $data_file = $this->model_meeting->tambah_file(['file'=> $data['file_name']]);

            $this->db->update('users', ['id_image_profile'=>$data_file->id], ['id'=>$id_user]);
            // $hasil = $this->db->select('users.*, file.file')
            //          ->join('file', 'file.id=users.id_image_profile')
            //          ->where('users.id', $id_user)
            //          ->get('users')
            //          ->first_row();


            $hasil = $this->db->get_where('users', ['id'=>$id_user])->first_row();
            $d_gambar_profil = $this->db->get_where('file', ['id'=>$hasil->id_image_profile])->first_row();
            $d_background_profil = $this->db->get_where('file', ['id'=>$hasil->id_image_background])->first_row();

            if (!empty($d_gambar_profil)) {
                $hasil->image_profile = base_url().'assets/file/'.$d_gambar_profil->file;
            } else {
                $hasil->image_profile = null;
            }

            if (!empty($d_background_profil)) {
                $hasil->image_background = base_url().'assets/file/'.$d_background_profil->file;
            } else {
                $hasil->image_background = null;
            }

            $this->response([
                'status'  => true,
                'message' => 'Berhasil upload file',
                'data'    => $hasil
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

    public function edit_background_profile_post(){

        $id_user = $this->post('id_user');
        
        $config['upload_path'] = 'assets/file';
        $config['allowed_types'] = 'gif|jpg|png|doc|txt|pdf|jpeg';
        $config['max_size'] = 1024 * 8;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        $status = null;
        if (!$this->upload->do_upload('file')) {

            $status = 'error';
            $msg = $this->upload->display_errors('', '');

        } else {

            $data = $this->upload->data();

            if($data) {

                $status = "success";
                // $msg = "File successfully uploaded";
                $file = $_FILES['file']['name'];

            } else {

                unlink($data['full_path']);
                $msg = "Something went wrong when saving the file, please try again.";

                $return = [
                    'status' => 'error',
                    'pesan'  => $msg
                ];

            }

        }
        @unlink($_FILES['file']);

        if ($status == 'success') {

            $data_file = $this->model_meeting->tambah_file(['file'=> $data['file_name']]);

            $this->db->update('users', ['id_image_background'=>$data_file->id], ['id'=>$id_user]);

            $hasil = $this->db->get_where('users', ['id'=>$id_user])->first_row();
            $d_gambar_profil = $this->db->get_where('file', ['id'=>$hasil->id_image_profile])->first_row();
            $d_background_profil = $this->db->get_where('file', ['id'=>$hasil->id_image_background])->first_row();

            if (!empty($d_gambar_profil)) {
                $hasil->image_profile = base_url().'assets/file/'.$d_gambar_profil->file;
            } else {
                $hasil->image_profile = null;
            }

            if (!empty($d_background_profil)) {
                $hasil->image_background = base_url().'assets/file/'.$d_background_profil->file;
            } else {
                $hasil->image_background = null;
            }

            $this->response([
                'status'  => true,
                'message' => 'Berhasil upload file',
                'data'    => $hasil
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

    public function search_get()
    {

        $id_user = $this->get('id_user');
        $nama    = $this->get('name');

        # user yang muncul hanya user dengan jabatan staf
        $data = $this->db->like('username', $nama)
                         // ->where('role IS NOT NULL', NULL, FALSE)
                         ->where('role', 3)
                         ->where('id!=', $id_user)
                         ->get('users')
                         ->result();

        if (!empty($data)) {
            
            $this->response([
                'status'  => true,
                'message' => 'Data user berhasil didapat',
                'data'    => $data
            ], 200);

        } else {

            $this->response([
                'status'  => false,
                'message' => 'Data user tidak ditemukan',
                'data'    => []
            ], 200);

        }

    }

    public function login_post()
    {

    	$data['username'] = $this->post('username');
        $data['password'] = $this->post('password');
        $token_firebase   = $this->post('token_firebase');

        $cek_login = $this->model_users->login($token_firebase, $data);

        if (!empty($cek_login)) {

            if ($cek_login == 'password_salah') {
                
                $this->response([
                    'status'  => false,
                    'message' => 'Password yang anda inputkan salah, mohon input password yang benar',
                    'data'    => [
                        'message' => 'Password yang anda inputkan salah, mohon input password yang benar'
                    ]
                ], 200);

            } else if (empty($cek_login->user_aktif)) {
                
                $this->response([
                    'status'  => false,
                    'message' => 'Mohon menunggu, akun anda sedang di proses oleh admin',
                    'data'    => [
                        'message' => 'Mohon menunggu, akun anda sedang di proses oleh admin'
                    ]
                ], 200);

            } else if ($cek_login->user_aktif == 2) {
                
                $this->response([
                    'status'  => false,
                    'message' => 'Akun anda telah di nonaktifkan, untuk mengaktifkan kembali, silahkan hubungi admin',
                    'data'    => [
                        'message' => 'Akun anda telah di nonaktifkan, untuk mengaktifkan kembali, silahkan hubungi admin'
                    ]
                ], 200);

            } else {

                $this->response([
                    'status'  => true,
                    'message' => 'Berhasil login',
                    'data'    => $cek_login
                ], 200);

            }

        } else {

        	$this->response([
        		'status'  => false,
        		'message' => 'Gagal login',
        		'data'    => [
                    'message' => 'Gagal login'
                ]
        	], 200);

        }

    }

    public function register_post()
    {

    	$phone    = $this->post('phone');
    	$password = $this->post('password');
        $username = $this->post('username');
        $email    = $this->post('email');
        // $role     = $this->post('role');

        if (empty($phone) || empty($password) || empty($username) || empty($email)) {
        	
        	$this->response([
        		'status'  => false,
        		'message' => 'Mohon lengkapi data',
        		'data'    => []
        	], 200);

        }

    	$firstNumber = substr($phone, 0, 1);

    	/* cek angka pertama nomor yang di input */
        if ($firstNumber != 0) {
            $send_to      = '0' . $phone;
            $phone_number = '0' . $phone;
        } else {
            $send_to      = $phone;
            $phone_number = $phone;
        }

        /* validasi no hp */
    	if (!preg_match("/^[0-9|(\+|)]*$/", $phone)) {

            $this->response([
            	'status'  => false,
                'message' => 'Nomor telepon hanya boleh menggunakan angka.',
                'data'    => [],
            ], 200);

        }

        $cek_hp       = $this->db->get_where('users', ['phone'=>$phone])->result();
        $cek_email    = $this->db->get_where('users', ['email'=>$email])->result();
        $cek_username = $this->db->get_where('users', ['username'=>$username])->result();

        /* jika no hp sudah terdaftar */
        if (!empty($cek_hp)) {

        	$this->response([
            	'status'  => false,
                'message' => 'Nomor telepon telah dipakai. Coba dengan nomor lain.',
                'data'    => [
                    'message' => 'Nomor telepon telah dipakai. Coba dengan nomor lain.'
                ],
            ], 200);

        } else if (!empty($cek_email)) {
        	
        	$this->response([
            	'status'  => false,
                'message' => 'Email telah terdaftar. Coba dengan email lain.',
                'data'    => [
                    'message' => 'Email telah terdaftar. Coba dengan email lain.'
                ],
            ], 200);

        } else if (!empty($cek_username)) {
        	
        	$this->response([
            	'status'  => false,
                'message' => 'Username telah dipakai. Coba dengan email lain.',
                'data'    => [
                    'message' => 'Username telah dipakai. Coba dengan email lain.'
                ],
            ], 200);

        }

        $options   = [
            'cost' => 12,
        ];
        $password_hashed = password_hash($password, PASSWORD_BCRYPT, $options);

    	$data_insert = [
    		'email'    => $email,
    		'username' => $username,
    		'phone'    => $phone,
    		'password' => $password_hashed,
            // 'role'     => $role
    	];

    	$cek_daftar = $this->model_users->daftar($data_insert);

    	if (!empty($cek_daftar)) {
    		
    		$this->response([
    			'status'  => true,
    			'message' => 'Berhasil daftar',
    			'data'    => $cek_daftar
    		], 200);

    	} else {

    		$this->response([
    			'status'  => false,
    			'message' => 'Gagal daftar',
    			'data'    => [
                    'message' => 'Gagal daftar'
                ]
    		], 200);

    	}

    }

    public function reset_password_post()
    {

        $email = $this->post('email');

        $cek = $this->db->get_where('users', ['email'=>$email])->first_row();

        if (empty($cek)) {
            $this->response([
                'status'  => false,
                'message' => 'Email tidak terdaftar di sistem',
                'data'    => []
            ], 200);
        }

        $this->load->library('email');

        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'srv124.niagahoster.com';
        $config['smtp_user'] = 'support@caturindo.net';
        $config['smtp_pass'] = 'kJ9GQ9DGtJp$';
        $config['smtp_port'] = 587;

        $config['_smtp_auth'] = TRUE;
        $config['smtp_crypto'] = 'tls';
        $config['protocol'] = 'smtp';
        $config['mailtype'] = 'html';
        $config['send_multipart'] = FALSE;
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;

        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        
        $this->email->from('support@caturindo.net', 'Caturindo Support');
        $this->email->to($email);
        // $this->email->cc('another@example.com');
        // $this->email->bcc('and@another.com');

        $auto_pass  = random_string('numeric', 4);
        
        $options = [
            'cost' => 12,
        ];

        $password_hashed = password_hash($auto_pass, PASSWORD_BCRYPT, $options);

        $this->db->update('users', ['password'=>$password_hashed], ['id'=>$cek->id]);

        $pesan  = "<p>Dear ".$cek->username."</p>";
        $pesan .= "<p>".$auto_pass." adalah password Anda. Silahkan melakukan pergantian demi keamanan data Anda. Terimakasih.</p>";
        
        $this->email->subject('Reset Password');
        $this->email->message($pesan);
        
        $this->email->send();

        if (strstr($this->email->print_debugger(), "<pre>")) {
            
            $this->response([
                'status'  => true,
                'message' => 'Berhasil kirim pesan email',
                'data'    => [$pesan]
            ], 200);

        } else {

            $this->response([
                'status'  => false,
                'message' => 'Gagal kirim pesan email',
                'data'    => []
            ], 200);

        }

    }

    public function update_token_firebase_put()
    {

        $where = ['id' => $this->put('id_user')];  
        $update = ['token_firebase' => $this->put('token_firebase')];

        $this->db->update('users', $update, $where);

        $this->response([
            'status'  => true,
            'message' => 'Berhasil update token firebase',
            'data'    => []
        ], 200);

    }

    public function logout_put()
    {

        $where = ['id'=> $this->put('id_user')];
        $set   = ['token_firebase'=>''];

        $this->db->update('users', $set, $where);

        $this->response([
            'status'  => true,
            'message' => 'Berhasil logout dan hapus token firebase',
            'data'    => []
        ], 200);

    }

}

/* End of file Users.php */
/* Location: ./application/controllers/api/Login.php */