<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Submeeting extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('model_meeting');
		$this->load->model('model_sub_meeting');
		$this->load->model('model_notification');
	}

	public function index_get()
	{

		$id_user        = $this->get('id_user');
		$id_meeting     = $this->get('id_meeting');
		$id_sub_meeting = $this->get('id_sub_meeting');
		$status_meeting = $this->get('status_meeting');
		$input          = $this->get();

		if (empty($id_user)) {
			$this->response([
				'status'  => false,
				'message' => 'id user tidak boleh kosong',
				'data'    => []
			], 200);
		}

		$cek_jabatan = $this->db->get_where('users', ['id'=>$id_user])->first_row();

		# kalo manajer
		// if ($cek_jabatan->role == 2) {
		// 	$data = $this->model_sub_meeting->tampil_submeeting($id_user, $id_meeting, $id_sub_meeting, $status_meeting);
		// } else if ($cek_jabatan->role == 3) {
		// 	$data = $this->model_sub_meeting->tampil_per_staf($input);
		// }

		# tampil semua data di semua user
		$data = $this->model_sub_meeting->tampil_semua($input);

		if (!empty($data)) {

			foreach ($data as $key => $value) {
				
				$member = $this->db->get_where('team', ['id_user'=>$value->id_user])->result();

				$value->count_members = null;
				if (!empty($member)) {
					$value->count_members = sizeof($member);
				}

			}
			
			$this->response([
				'status'  => true,
				'message' => 'Data sub meeting berhasil didapat',
				'data'    => $data
			], 200);

		} else {

			$this->response([
				'status'  => false,
				'message' => 'Data sub meeting tidak ada atau gagal didapat',
				'data'    => []
			], 200);

		}

	}

	public function add_member_meeting_post()
	{

		$username = $this->post('username');
		$id_sub_meeting = $this->post('id_sub_meeting');

		$user_manajer = $this->db->select('users.username, users.id as id_user')
								 ->from('sub_meeting')
								 ->join('users', 'users.id=sub_meeting.id_user')
								 ->where('sub_meeting.id', $id_sub_meeting)
								 ->get()
								 ->first_row();

		$insert_m_meeting = [
			'user' => $username,
			'id_sub_meeting' => $id_sub_meeting
		];
		# simpan data member ke table member meeting
		$this->db->insert('member_submeeting', $insert_m_meeting);
		# ambil kembali data member yang sudah di insert tadi
		$d_member = $this->db->get_where('member_submeeting', ['id_sub_meeting'=>$id_meeting])->result();

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
						'id__sub_meeting'  => $id_sub_meeting,
						'title'       => $title_notification
					];
					# data simpan ke table notification
					$d_notif   = $this->model_notification->tambah($d_insert);
					$d_meeting = $this->db->get_where('sub_meeting', ['id'=>$id_meeting])->first_row();
					
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

	public function create_sub_meeting_post()
	{

		$id_user = $this->post('id_user');

		if (empty($this->post('id_group'))) {
			$this->response([
				'status'  => false,
				'message' => 'id group tidak boleh kosong',
				'data'    => null
			], 200);
		}

		$data_insert = [
			'id'		  => random_char('SM', 5),
			'id_user'     => $id_user,
			'id_meeting'  => $this->post('id_meeting'),
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

		$hasil_tambah = $this->model_sub_meeting->tambah_sub($data_insert);

		# ambil data user dari pembuat meeting
		$d_manajer = $this->db->get_where('users', ['id'=>$id_user])->first_row();
		# ambil data member yang di add pada data meeting ini
		$d_member = $this->db->get_where('member_submeeting', ['id_sub_meeting'=>$data_insert['id']])->result();

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
					# hanya user yang di tag, yang mendapatkan notifikasi
					if (!empty($d_u_member->token_firebase) && $d_u_member->id != $id_user) {

						$title_notification = $d_manajer->username." tagged you and ".sizeof($d_member)." others in a sub meeting";

						$d_insert = [
							'id_user'     => $d_u_member->id,
							'id_user_tag' => $d_u_member->id,
							'id_sub_meeting'  => $hasil_tambah->id,
							'title'       => $title_notification
						];
						# data simpan ke table notification
						$d_notif = $this->model_notification->tambah($d_insert);
						
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

	public function update_status_submeeting_put()
	{

		$id_meeting = $this->put('id_sub_meeting');

		$data_update = [
			'status_meeting' => 1
		];

		$this->db->update('sub_meeting', $data_update, ['id'=>$id_meeting]);

		$this->response([
			'status'  => true,
			'message' => 'Berhasil update status sub meeting'
		], 200);

	}

	public function comment_sub_meeting_get()
	{

		$id_meeting = $this->get('id_sub_meeting');

		$data =	$this->db->select('comment_sub_meeting.comment, users.username')
						 ->join('users', 'users.id=comment_sub_meeting.id_user')
						 ->where('comment_sub_meeting.id_sub_meeting', $id_meeting)
						 ->order_by('comment_sub_meeting.id', 'desc')
						 ->get('comment_sub_meeting')
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

	public function add_comment_sub_meeting_post()
	{
		
		$id_sub_meeting = $this->post('id_sub_meeting');
		$id_user        = $this->post('id_user');
		$komen          = $this->post('comment');

		$insert = [
			'id_user' => $id_user,
			'id_sub_meeting' => $id_sub_meeting,
			'comment' => $komen
		];

		$hasil = $this->model_meeting->add_comment_sub_meeting($insert);

		# ambil data user yang comment
		$d_user    = $this->db->get_where('users', ['id'=>$id_user])->first_row();
		# ambil data member meeting
		$m_meeting = $this->db->get_where('member_submeeting', ['id_sub_meeting'=>$id_sub_meeting])->result();
		# ambil data sub meeting
		$d_meeting = $this->db->get_where('sub_meeting', ['id'=>$id_sub_meeting])->first_row();

		$title_notification = $d_user->username." comment on sub meeting ".$d_meeting->title;

		$all_member = $this->db->select('users.*')
							   ->from('sub_meeting')
							   ->join('team', 'team.id_group = sub_meeting.id_group')
							   ->join('users', 'users.id = team.id_member', 'left')
							   ->where('sub_meeting.id', $id_sub_meeting)
							   ->where('users.id !=', $id_user)
							   ->get()
							   ->result();

		if (!empty($all_member)) {
			
			foreach ($all_member as $key => $value) {
				$d_insert = [
					'id_user'     => $d_user->id,
					'id_user_tag' => $value->id,
					'id_sub_meeting' => $id_sub_meeting,
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
				'message' => 'Berhasil tambah comment sub meeting',
				'data'    => $hasil
			],200);

		} else {

			$this->response([
				'status'  => false,
				'message' => 'Gagal tambah comment sub meeting',
				'data'    => []
			],200);

		}

	}

	private function add_comment_sub_meeting_backup()
	{

		$id_sub_meeting = $this->post('id_sub_meeting');
		$id_user        = $this->post('id_user');
		$komen          = $this->post('comment');

		$insert = [
			'id_user' => $id_user,
			'id_sub_meeting' => $id_sub_meeting,
			'comment' => $komen
		];

		$hasil = $this->model_meeting->add_comment_sub_meeting($insert);

		# ambil data meeting
		$d_meeting = $this->db->get_where('sub_meeting', ['id'=>$id_sub_meeting])->first_row();

		if (empty($d_meeting)) {
			$this->response([
				'status'  => false,
				'message' => 'Data sub meeting tidak di temukan',
				'data'    => []
			], 200);
		}

		# ambil data user yang comment
		$d_user    = $this->db->get_where('users', ['id'=>$id_user])->first_row();
		# ambil data member meeting
		$m_meeting = $this->db->get_where('member_submeeting', ['id_sub_meeting'=>$id_sub_meeting])->result();

		$title_notification = $d_user->username." comment on sub meeting ".$d_meeting->title;

		# jika data member meeting nya tidak kosong
		# maka kirim notifikasi ke semua member meeting tersebut
		if (!empty($m_meeting)) {
			
			foreach ($m_meeting as $key => $value) {
				
				$d_member = $this->db->get_where('users', ['username'=>$value->user])->first_row();
				
				# kirim notifikasi, jika data member tidak kosong dan bukan member yang komen
				if (!empty($d_member) && $value->user != $d_user->username) {
					
					$d_insert = [
						'id_user'     => $d_user->id,
						'id_user_tag' => $d_member->id,
						'id_sub_meeting' => $id_sub_meeting,
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
				'message' => 'Berhasil tambah comment sub meeting',
				'data'    => $hasil
			],200);

		} else {

			$this->response([
				'status'  => false,
				'message' => 'Gagal tambah comment sub meeting',
				'data'    => []
			],200);

		}

	}

	public function cancel_post()
	{

		$id_sub_meeting = $this->post('id_sub_meeting');

		$meeting = $this->db->get_where('sub_meeting', ['id'=>$id_sub_meeting])->first_row();
		// $task    = $this->db->get_where('task', ['id_meeting'=>$id_sub_meeting])->first_row();
		
		if (empty($meeting)) {
			
			$this->response([
				'status'  => false,
				'message' => 'Sub meeting telah di hapus',
				'data'    => []
			], 200);

		}

		// $this->db->delete('member_task', ['id_task'=>$task->id]);
		// $this->db->delete('booking', ['id'=>$meeting->id_booking]);
		// $this->db->delete('task', ['id_meeting'=>$id_meeting]);
		$this->db->delete('sub_meeting', ['id'=>$id_sub_meeting]);

		$this->response([
			'status'  => true,
			'message' => 'Berhasil hapus sub meeting',
			'data'    => []
		], 200);

	}

}

/* End of file Submeeting.php */
/* Location: ./application/controllers/api/Submeeting.php */