<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Meeting extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('model_meeting');
		$this->load->model('model_notification');
	}

	public function index_post()
	{

		$id_user        = $this->post('id_user');
		$id_meeting     = $this->post('id_meeting');
		$status_meeting = $this->post('status_meeting');
		$tanggal		= $this->post('tanggal');
		$input			= $this->post();

		if (empty($id_user))
			$this->response([
				'status'  => false,
				'message' => 'id user tidak boleh kosong',
				'data'	  => []
			], 200);

		$cek_jabatan = $this->db->get_where('users', ['id'=>$id_user])->first_row();

		# jika user adalah manajer
		// if ($cek_jabatan->role == 2) {
		// 	$data = $this->model_meeting->tampil_v2($id_meeting, $status_meeting, $id_user, $tanggal, null);
		// } else if ($cek_jabatan->role == 3) {
		// 	$data = $this->model_meeting->tampil_per_staff($id_meeting, $status_meeting, $id_user, $tanggal);
		// }

		# di munculin di semua halaman user
		$data = $this->model_meeting->tampil_semua($input);

		if (!empty($data)) {
			
			$this->response([
				'status'  => true,
				'message' => 'Data meeting berhasil didapat',
				'data'    => $data
			], 200);

		} else {

			$this->response([
				'status'  => false,
				'message' => 'Data meeting gagal didapat',
				'data'    => []
			], 200);

		}
		
	}

	public function create_post()
	{

		$id_user  = $this->post('id_user');
		$id_group = $this->post('id_group');
		$title    = $this->post('title');

		$data_insert = [
			'id'		  => random_char('M', 5),
			'id_user'     => $id_user,
			'id_booking'  => $this->post('id_booking'),
			'id_group'    => $this->post('id_group'),
			'title'       => $this->post('title'),
			'description' => $this->post('description'),
			'id_file'     => $this->post('id_file'),
			'date'        => $this->post('date'),
			'time'        => $this->post('time'),
			'tag'		  => $this->post('tag'),
			'location'    => $this->post('location')
		];

		$hasil_tambah = $this->model_meeting->tambah_v2($data_insert);
		# ambil data user dari pembuat meeting
		$d_manajer = $this->db->get_where('users', ['id'=>$id_user])->first_row();
		# ambil data member yang di add pada data meeting ini
		$d_member = $this->db->get_where('team', ['id_group'=>$id_group])->result();

		$total_member = sizeof($d_member);

		$user_member = [];
		# jika data member tidak kosong
		if (!empty($d_member)) {
			# data member di cari, untuk di ambil data user dari member tersebut
			foreach ($d_member as $key => $value) {
				$d_u_member = $this->db->get_where('users', ['id'=>$value->id_member])->first_row();
				# jika data user dari member yang di add tadi, didapat atau tidak kosong
				if (!empty($d_u_member)) {
					# simpan username dari member yang di add kedalam dalam array
					$user_member[] = $d_u_member->username;
					# jika token firebase nya ada
					# maka kirim notifikasi ke firebase
					if (!empty($d_u_member->token_firebase) && $d_u_member->id != $id_user) {

						$title_notification = $d_manajer->username." tagged you and ".$total_member." others in a meeting";

						$d_insert = [
							'id_user'     => $d_u_member->id,
							'id_user_tag' => $d_u_member->id,
							'id_meeting'  => $hasil_tambah->id,
							'title'       => $title_notification
						];
						# data simpan ke table notification
						$d_notif = $this->model_notification->tambah($d_insert);
						// $d_meeting = $this->db->get_where('meeting', ['id'=>$id_meeting])->first_row();
						
						$ambil = [
							'body'  => $title,
							'title' => $title_notification,
							'id'    => $d_notif->id
						];
						# kirim notifikasi ke user masing masing
						$cek = kirim_notifikasi($d_u_member->token_firebase, $ambil);
						// echo " ".$d_u_member->username." ".$d_u_member->token_firebase." ";

					}

				}

			}
		}

		if (!empty($hasil_tambah)) {
			
			$this->response([
				'status'  => true,
				'message' => 'Berhasil tambah data meeting',
				'data'    => $hasil_tambah
			], 200);

		} else {

			$this->response([
				'status'  => false,
				'message' => 'Gagal tambah data meeting',
				'data'    => []
			], 200);

		}

	}

	private function create_backup2_post()
	{

		$id_user = $this->post('id_user');

		$data_insert = [
			'id'		  => random_char('M', 5),
			'id_user'     => $id_user,
			'id_booking'  => $this->post('id_booking'),
			'id_group'    => $this->post('id_group'),
			'title'       => $this->post('title'),
			'description' => $this->post('description'),
			'id_file'     => $this->post('id_file'),
			'date'        => $this->post('date'),
			'time'        => $this->post('time'),
			'tag'		  => $this->post('tag'),
			'location'    => $this->post('location')
		];

		$hasil_tambah = $this->model_meeting->tambah($data_insert);
		# ambil data user dari pembuat meeting
		$d_manajer = $this->db->get_where('users', ['id'=>$id_user])->first_row();
		# ambil data member yang di add pada data meeting ini
		$d_member = $this->db->get_where('team', ['id_user'=>$id_user])->result();

		$user_member = [];
		# jika data member tidak kosong
		if (!empty($d_member)) {
			# data member di cari, untuk di ambil data user dari member tersebut
			foreach ($d_member as $key => $value) {
				$d_u_member = $this->db->get_where('users', ['id'=>$value->id_member])->first_row();
				# jika data user dari member yang di add tadi, didapat atau tidak kosong
				if (!empty($d_u_member)) {
					# simpan username dari member yang di add kedalam dalam array
					$user_member[] = $d_u_member->username;
					# jika token firebase nya ada
					# maka kirim notifikasi ke firebase
					if (!empty($d_u_member->token_firebase) && $d_u_member->id != $id_user) {

						$title_notification = $d_manajer->username." tagged you and ".sizeof($d_member)." others in a meeting";

						$d_insert = [
							'id_user'     => $d_u_member->id,
							'id_user_tag' => $d_u_member->id,
							'id_meeting'  => $hasil_tambah->id,
							'title'       => $title_notification
						];
						# data simpan ke table notification
						$d_notif = $this->model_notification->tambah($d_insert);
						// $d_meeting = $this->db->get_where('meeting', ['id'=>$id_meeting])->first_row();
						
						$ambil = [
							'body'  => $hasil_tambah->title,
							'title' => $title_notification,
							'id'    => $d_notif->id
						];
						# kirim notifikasi ke user masing masing
						$cek = kirim_notifikasi($d_u_member->token_firebase, $ambil);

					}

				}

			}
		}

		if (!empty($hasil_tambah)) {
			
			$this->response([
				'status'  => true,
				'message' => 'Berhasil tambah data meeting',
				'data'    => $hasil_tambah
			], 200);

		} else {

			$this->response([
				'status'  => false,
				'message' => 'Gagal tambah data meeting',
				'data'    => []
			], 200);

		}

	}

	private function create_backup_post()
	{

		$id_user = $this->post('id_user');

		$data_insert = [
			'id'		  => random_char('M', 5),
			'id_user'     => $id_user,
			'id_booking'  => $this->post('id_booking'),
			'title'       => $this->post('title'),
			'description' => $this->post('description'),
			'id_file'     => $this->post('id_file'),
			'date'        => $this->post('date'),
			'time'        => $this->post('time'),
			'tag'		  => $this->post('tag'),
			'location'    => $this->post('location')
		];

		$hasil_tambah = $this->model_meeting->tambah($data_insert);
		# ambil data user dari pembuat meeting
		$d_manajer = $this->db->get_where('users', ['id'=>$id_user])->first_row();
		# ambil data member yang di add pada data meeting ini
		$d_member = $this->db->get_where('member_meeting', ['id_meeting'=>$data_insert['id']])->result();

		$user_member = [];
		# jika data member tidak kosong
		if (!empty($d_member)) {
			# data member di cari, untuk di ambil data user dari member tersebut
			foreach ($d_member as $key => $value) {
				$d_u_member = $this->db->get_where('users', ['username'=>$value->user])->first_row();
				# jika data user dari member yang di add tadi, didapat atau tidak kosong
				if (!empty($d_u_member)) {
					# simpan username dari member yang di add kedalam dalam array
					$user_member[] = $d_u_member->username;
					# jika token firebase nya ada
					# maka kirim notifikasi ke firebase
					if (!empty($d_u_member->token_firebase) && $d_u_member->id != $id_user) {

						$title_notification = $d_manajer->username." tagged you and ".sizeof($d_member)." others in a meeting";

						$d_insert = [
							'id_user'     => $d_u_member->id,
							'id_user_tag' => $d_u_member->id,
							'id_meeting'  => $hasil_tambah->id,
							'title'       => $title_notification
						];
						# data simpan ke table notification
						$d_notif = $this->model_notification->tambah($d_insert);
						// $d_meeting = $this->db->get_where('meeting', ['id'=>$id_meeting])->first_row();
						
						$ambil = [
							'body'  => $hasil_tambah->title,
							'title' => $title_notification,
							'id'    => $d_notif->id
						];
						# kirim notifikasi ke user masing masing
						$cek = kirim_notifikasi($d_u_member->token_firebase, $ambil);

					}

				}

			}
		}

		// unset($hasil_tambah->tag);
		// $hasil_tambah->tag = $user_member;

		// if (!empty($hasil_tambah->file)) {
		// 	# tambah link dari file di upload
		// 	$hasil_tambah->file = base_url().'assets/file/'.$hasil_tambah->file;
		// } else {
		// 	$hasil_tambah->file = null;
		// }

		if (!empty($hasil_tambah)) {
			
			$this->response([
				'status'  => true,
				'message' => 'Berhasil tambah data meeting',
				'data'    => $hasil_tambah
			], 200);

		} else {

			$this->response([
				'status'  => false,
				'message' => 'Gagal tambah data meeting',
				'data'    => []
			], 200);

		}

	}

	public function add_member_meeting_post()
	{

		$username = $this->post('username');
		$id_meeting = $this->post('id_meeting');

		$where_cek = [
			'id_meeting' => $id_meeting,
			'username'   => $username
		];

		$cek = $this->db->get_where('member_meeting', $where_cek)->first_row();

		if (!empty($cek))
			$this->response([
				'status'  => true,
				'message' => 'member '.$cek.' tidak dapat ditambah 2x'
			], 200);

		$user_manajer = $this->db->select('users.username, users.id as id_user')
								 ->from('meeting')
								 ->join('users', 'users.id=meeting.id_user')
								 ->where('meeting.id', $id_meeting)
								 ->get()
								 ->first_row();

		$insert_m_meeting = [
			'user' => $username,
			'id_meeting' => $id_meeting
		];
		# simpan data member ke table member meeting
		$this->db->insert('member_meeting', $insert_m_meeting);
		# ambil kembali data member yang sudah di insert tadi
		$d_member = $this->db->get_where('member_meeting', ['id_meeting'=>$id_meeting])->result();

		foreach ($d_member as $key => $value) {

			$user_member[] = $value->user;
			$d_token = $this->db->get_where('users', ['username'=>$value->user])->first_row();

			#jika data user nya ada
			if (!empty($d_token)) {
				# jika token firebase nya ada
				# maka kirim notifikasi ke firebase
				if (!empty($d_token->token_firebase) && $d_token->id != $user_manajer->id_user) {

					$title_notification = $user_manajer->username." tagged you and ".sizeof($d_member)." others in a meeting";

					$d_insert = [
						'id_user'     => $d_token->id,
						'id_user_tag' => $d_token->id,
						'id_meeting'  => $id_meeting,
						'title'       => $title_notification
					];
					# data simpan ke table notification
					$d_notif   = $this->model_notification->tambah($d_insert);
					$d_meeting = $this->db->get_where('meeting', ['id'=>$id_meeting])->first_row();
					
					$ambil = [
						'body'  => $d_meeting->title,
						'title' => $title_notification,
						'id'    => $d_notif->id
					];
					# kirim notifikasi ke user masing masing
					$cek = kirim_notifikasi($d_token->token_firebase, $ambil);

					// echo "<pre>";
					// print_r ($cek);
					// echo "</pre>";

				}
				
			}

		}

		$tag_member = implode(",", $user_member);
		$this->db->update('meeting', ['tag'=>$tag_member], ['id'=>$id_meeting]);
		$d_meeting = $this->db->get_where('meeting', ['id'=>$id_meeting])->first_row();

		$this->response([
			'status'  => true,
			'message' => 'Berhasil tambah member meeting',
			'data'    => $d_meeting
		], 200);

	}

	public function upload_file_post(){
		
		$config['upload_path'] = 'assets/file';
		$config['allowed_types'] = 'gif|jpg|png|doc|txt|pdf';
		$config['max_size'] = 1024 * 10;
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);

		$status = null;
		if (!$this->upload->do_upload('file')) {

			$status = 'error';
			$msg = $this->upload->display_errors('', '');

		} else {

			$data = $this->upload->data();
	        // $file_id = $this->files_model->insert_file($data['file_name'], $_POST['title']);
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
			$data_file->file = base_url().'assets/file/'.$data_file->file;

			$this->response([
				'status'  => true,
				'message' => 'Berhasil upload file',
				'data'    => $data_file
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

	public function cancel_meeting_post()
	{

		$id_meeting = $this->post('id_meeting');

		$meeting = $this->db->get_where('meeting', ['id'=>$id_meeting])->first_row();
		$task    = $this->db->get_where('task', ['id_meeting'=>$id_meeting])->first_row();
		
		if (empty($meeting)) {
			
			$this->response([
				'status'  => false,
				'message' => 'Meeting telah di hapus',
				'data'    => []
			], 200);

		}

		if (!empty($task))
			$this->db->delete('member_task', ['id_task'=>$task->id]);

		if (!empty($meeting))
			$this->db->delete('booking', ['id'=>$meeting->id_booking]);
		
		$this->db->delete('task', ['id_meeting'=>$id_meeting]);
		$this->db->delete('meeting', ['id'=>$id_meeting]);

		$this->response([
			'status'  => true,
			'message' => 'Berhasil hapus meeting',
			'data'    => []
		], 200);

	}

	public function update_status_meeting_put()
	{

		$id_meeting = $this->put('id_meeting');

		$data_update = [
			'status_meeting' => 1
		];

		$this->db->update('meeting', $data_update, ['id'=>$id_meeting]);

		$this->response([
			'status'  => true,
			'message' => 'Berhasil update status meeting'
		], 200);

	}

	public function comment_get()
	{

		$id_meeting = $this->get('id_meeting');

		$data =	$this->db->select('comment_meeting.comment, users.username')
						 ->join('users', 'users.id=comment_meeting.id_user')
						 ->where('comment_meeting.id_meeting', $id_meeting)
						 ->order_by('comment_meeting.id', 'desc')
						 ->get('comment_meeting')
						 ->result();

		if (!empty($data)) {
			
			$this->response([
				'status'  => true,
				'message' => 'Berhasil tampil komen meeting',
				'data'    => $data
			], 200);

		} else {

			$this->response([
				'status'  => false,
				'message' => 'Gagal tampil komen meeting',
				'data'    => []
			], 200);

		}

	}

	public function add_comment_post()
	{
		
		$id_meeting = $this->post('id_meeting');
		$id_user    = $this->post('id_user');
		$komen      = $this->post('comment');

		$insert = [
			'id_user'    => $id_user,
			'id_meeting' => $id_meeting,
			'comment'    => $komen
		];

		$hasil = $this->model_meeting->add_comment($insert);

		$all_member = $this->db->select('users.*')
							   ->from('meeting')
							   ->join('team', 'team.id_group = meeting.id_group')
							   ->join('users', 'users.id = team.id_member', 'left')
							   ->where('meeting.id', $id_meeting)
							   ->where('team.id_member !=', $id_user)
							   ->get()
							   ->result();

		# ambil data meeting
		$d_meeting = $this->db->get_where('meeting', ['id'=>$id_meeting])->first_row();
		# ambil data user yang comment
		$d_user    = $this->db->get_where('users', ['id'=>$id_user])->first_row();

		if (empty($d_user)) {
			$this->response([
				'status'  => false,
				'message' => 'Data user tidak didapat, mohon cek id user terlebih dahulu',
				'data'    => null
			], 200);
		}

		# ambil data member meeting
		$m_meeting = $this->db->get_where('member_meeting', ['id_meeting'=>$id_meeting])->result();

		$title_notification = $d_user->username." comment on meeting ".$d_meeting->title;

		if (!empty($all_member)) {
			
			foreach ($all_member as $key => $value) {
				
				# kirim notifikasi, jika data member tidak kosong dan bukan member yang komen
				$d_insert = [
					'id_user'     => $d_user->id,
					'id_user_tag' => $value->id,
					'id_meeting'  => $id_meeting,
					'title'       => $title_notification
				];
				# simpan notifikasi
				$d_notif = $this->model_notification->tambah($d_insert);

				$ambil = [
					'body'  => $komen,
					'title' => $title_notification,
					'id'    => $d_notif->id
				];
				# kirim notifikasi ke user masing masing
				if (!empty($value->token_firebase)) {
					$cek = kirim_notifikasi($value->token_firebase, $ambil);
				}

			}

		}

		if (!empty($hasil)) {
			
			$this->response([
				'status'  => true,
				'message' => 'Berhasil tambah comment meeting',
				'data'    => $hasil
			],200);

		} else {

			$this->response([
				'status'  => false,
				'message' => 'Gagal tambah comment meeting',
				'data'    => []
			],200);

		}

	}

	private function add_comment_backup()
	{

		$id_meeting = $this->post('id_meeting');
		$id_user    = $this->post('id_user');
		$komen      = $this->post('comment');

		$insert = [
			'id_user'    => $id_user,
			'id_meeting' => $id_meeting,
			'comment'    => $komen
		];

		$hasil = $this->model_meeting->add_comment($insert);

		# ambil data meeting
		$d_meeting = $this->db->get_where('meeting', ['id'=>$id_meeting])->first_row();
		# ambil data user yang comment
		$d_user    = $this->db->get_where('users', ['id'=>$id_user])->first_row();
		# ambil data member meeting
		$m_meeting = $this->db->get_where('member_meeting', ['id_meeting'=>$id_meeting])->result();

		$title_notification = $d_user->username." comment on meeting ".$d_meeting->title;

		$d_team = $this->db->where('id_user', $d_meeting->id_user)->get('team')->result();

		# jika data member meeting nya tidak kosong
		# maka kirim notifikasi ke semua member meeting tersebut
		if (!empty($d_team)) {
			
			foreach ($m_meeting as $key => $value) {
				
				// $d_member = $this->db->get_where('users', ['username'=>$value->user])->first_row();
				$d_member = $this->db->where('id', $value->id)->where('id !=', $id_user)->get('users')->first_row();
				
				# kirim notifikasi, jika data member tidak kosong dan bukan member yang komen
				if (
					!empty($d_member)
					# && $value->user != $d_user->username
					# && $d_member->id != $id_user
				) {

					$d_insert = [
						'id_user'     => $d_user->id,
						'id_user_tag' => $d_member->id,
						'id_meeting'  => $id_meeting,
						'title'       => $title_notification
					];
					# simpan notifikasi
					$d_notif = $this->model_notification->tambah($d_insert);

					$ambil = [
						'body'  => $komen,
						'title' => $title_notification,
						'id'    => $d_notif->id
					];
					# kirim notifikasi ke user masing masing
					if (!empty($d_member->token_firebase)) {
						$cek = kirim_notifikasi($d_member->token_firebase, $ambil);
					}

				}

			}

		}

		# jika yang komen bukan yang bikin meeting
		# maka yang bikin meeting dapat notifikasi
		if ($id_user != $d_meeting->id_user) {
			$d_insert = [
				'id_user'     => $d_meeting->id_user,
				'id_user_tag' => $d_meeting->id_user,
				'id_meeting'  => $id_meeting,
				'title'       => $title_notification
			];
			# simpan notifikasi
			$d_notif = $this->model_notification->tambah($d_insert);

			$ambil = [
				'body'  => $komen,
				'title' => $title_notification,
				'id'    => $d_notif->id
			];
			# kirim notifikasi ke user masing masing
			$manajer = $this->db->get_where('users', ['id'=>$d_meeting->id_user])->first_row();
			if (!empty($manajer->token_firebase)) {
				$cek = kirim_notifikasi($manajer->token_firebase, $ambil);
			}
		}

		if (!empty($hasil)) {
			
			$this->response([
				'status'  => true,
				'message' => 'Berhasil tambah comment meeting',
				'data'    => $hasil
			],200);

		} else {

			$this->response([
				'status'  => false,
				'message' => 'Gagal tambah comment meeting',
				'data'    => []
			],200);

		}

	}

	public function add_comment_v2_post()
	{

		$id_meeting = $this->post('id_meeting');
		$id_user    = $this->post('id_user');
		$komen      = $this->post('comment');

		$insert = [
			'id_user'    => $id_user,
			'id_meeting' => $id_meeting,
			'comment'    => $komen
		];

		$hasil = $this->model_meeting->add_comment($insert);

		# ambil data meeting
		$d_meeting = $this->db->get_where('meeting', ['id'=>$id_meeting])->first_row();
		# ambil data user yang comment
		$d_user    = $this->db->get_where('users', ['id'=>$id_user])->first_row();
		# ambil data member meeting
		$m_meeting = $this->db->get_where('member_meeting', ['id_meeting'=>$id_meeting])->result();

		$title_notification = $d_user->username." comment on meeting".$d_meeting->title;

		# jika data member meeting nya tidak kosong
		# maka kirim notifikasi ke semua member meeting tersebut
		if (!empty($m_meeting)) {
			
			foreach ($m_meeting as $key => $value) {
				
				// $d_member = $this->db->get_where('users', ['username'=>$value->user])->first_row();
				$d_member = $this->db->where('username', $value->user)->where('id!=', $id_user)->get('users')->first_row();
				
				# kirim notifikasi, jika data member tidak kosong dan bukan member yang komen
				if (
					!empty($d_member) 
					# && $value->user != $d_user->username
					# && $d_member->id != $id_user
				) {

					$d_insert = [
						'id_user'     => $d_user->id,
						'id_user_tag' => $d_member->id,
						'id_meeting'  => $id_meeting,
						'title'       => $title_notification
					];
					# simpan notifikasi
					$d_notif = $this->model_notification->tambah($d_insert);

					$ambil = [
						'body'  => $komen,
						'title' => $title_notification,
						'id'    => $d_notif->id
					];
					# kirim notifikasi ke user masing masing
					if (!empty($d_member->token_firebase)) {
						$cek = kirim_notifikasi($d_member->token_firebase, $ambil);
					}

				}

			}

		}

		if (!empty($hasil)) {
			
			$this->response([
				'status'  => true,
				'message' => 'Berhasil tambah comment meeting',
				'data'    => $hasil
			],200);

		} else {

			$this->response([
				'status'  => false,
				'message' => 'Gagal tambah comment meeting',
				'data'    => []
			],200);

		}

	}

}

/* End of file Meeting.php */
/* Location: ./application/controllers/api/Meeting.php */