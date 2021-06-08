<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Task extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_task');
		$this->load->model('model_notification');
	}

	public function index_post()
	{

		$id_user = $this->post('id_user');
		$id_task = $this->post('id_task');
		$tanggal = $this->post('tanggal');
		$input   = $this->post();

		if (empty($id_user)) {
			$this->response([
				'status'  => false,
				'message' => 'id user tidak boleh kosong',
				'data'    => []
			], 200);
		}

		$cek_jabatan = $this->db->get_where('users', ['id'=>$id_user])->first_row();

		// if ($cek_jabatan->role == 2) {
		// 	$data_task = $this->model_task->get_task_v3($input);
		// } else if($cek_jabatan->role == 3){
		// 	$data_task = $this->model_task->get_task_v2($id_user, $id_task, $tanggal);
		// }

		# tampil semua data task di semua login user
		$data_task = $this->model_task->get_semua_task($input);

		if (!empty($data_task)) {

			$this->response([
				'status'  => true,
				'message' => 'Berhasil mendapatkan data task',
				'data'    => $data_task
			], 200);

		} else {

			$this->response([
				'status'  => false,
				'message' => 'Gagal mendapatkan data task',
				'data'    => []
			], 200);

		}
		
	}

	public function index_v2_post()
	{

		$id_user = $this->post('id_user');
		$id_task = $this->post('id_task');
		$tanggal = $this->post('tanggal');

		if (empty($id_user)) {
			$this->response([
				'status'  => false,
				'message' => 'id user tidak boleh kosong',
				'data'    => []
			], 200);
		}

		if (!empty($id_task)){
			$this->db->where('id', $id_task);
		}

		if (!empty($tanggal)) {
			$this->db->where('due_date >=', $tanggal.'-01')
					 ->where('due_date <=', $tanggal.'-31');
		}
		
		$data_task = $this->db->get('task')->result();
		$jumlah_tag = null;
		$tag = null;
		$member = null;

		if (!empty($data_task)) {
			
			foreach ($data_task as $key => $value) {

				$flag_member = $this->db->get_where('team', ['id_user'=>$value->id_user])->result();

				if (!empty($flag_member)) {
					foreach ($flag_member as $key => $fm) {
						$user_flag = $this->db->get_where('users', ['id'=>$fm->id_member])->first_row();
						if (!empty($user_flag)) {
							// $tag[]    = $user_flag->username;
							$member[] = $user_flag->username;
						}
					}

					if (!empty($member)) {
						$jumlah_tag = sizeof($member);
						$tag = implode(',', $member);
					}

				} else {

					$jumlah_tag = 0;
					$tag = null;
					$member = null;
				}

				$value->tags = $tag;
				$value->count_members = $jumlah_tag;
				$value->member = $member;

				if (!empty($value->id_file)) {
					
					$data_file = $this->db->get_where('file', ['id'=>$value->id_file])->first_row();
					$value->file = base_url().'assets/file/'.$data_file->file;

				}

			}

			$this->response([
				'status'  => true,
				'message' => 'Berhasil mendapatkan data task',
				'data'    => $data_task
			], 200);

		} else {

			$this->response([
				'status'  => false,
				'message' => 'Gagal mendapatkan data task',
				'data'    => []
			], 200);

		}
		
	}

	public function comment_get()
	{

		$id_task = $this->get('id_task');

		$data =	$this->db->select('comment_task.comment, users.username')
						 ->join('users', 'users.id=comment_task.id_user')
						 ->where('comment_task.id_task', $id_task)
						 ->order_by('comment_task.id', 'desc')
						 ->get('comment_task')
						 ->result();

		if (!empty($data)) {
			
			$this->response([
				'status'  => true,
				'message' => 'Berhasil tampil komen task',
				'data'    => $data
			], 200);

		} else {

			$this->response([
				'status'  => false,
				'message' => 'Gagal tampil komen task',
				'data'    => []
			], 200);

		}				 

	}

	public function add_task_post()
	{

		$id_user     = $this->post('id_user');
		$id_meeting  = $this->post('id_meeting');
		$id_file     = $this->post('id_file');
		$name_task   = $this->post('name_task');
		$description = $this->post('description');
		$due_date    = $this->post('due_date');
		$time        = $this->post('time');
		$id_group    = $this->post('id_group');

		// $tag_member = explode(',', $tag);

		if ($due_date < date('Y-m-d')) {
			$this->response([
				'status'  => false,
				'message' => 'Tanggal tidak bisa untuk hari kemarin',
				'data'    => null
			], 200);
		}

		$insert = [
			'id'          => random_char('TA', 4),
			'id_user'     => $id_user,
			'id_meeting'  => $id_meeting,
			'id_file'     => $id_file,
			'id_group'    => $id_group,
			'name_task'   => $name_task,
			'description' => $description,
			'due_date'    => $due_date,
			'time'        => $time
		];

		$hasil     = $this->model_task->add_task($insert);
		$d_manajer = $this->db->get_where('users', ['id'=>$id_user])->first_row();

		if (!empty($hasil)) {
			
			$this->response([
				'status'  => true,
				'message' => 'Berhasil tambah data task',
				'data'    => $hasil
			], 200);

		} else {

			$this->response([
				'status'  => false,
				'message' => 'Gagal tambah data task',
				'data'    => []
			], 200);

		}

	}

	public function add_member_post()
	{

		$id_user = $this->post('id_user');
		$id_task = $this->post('id_task');

		$cek_ada = $this->db->select('*')
						    ->from('member_task')
						    ->where('id_task', $id_task)
						    ->where('id_user', $id_user)
						    ->get()
						    ->result();

		if (!empty($cek_ada))
			$this->response([
				'status'  => false,
				'message' => 'User sudah di add',
				'data'    => [
					'message' => 'User sudah di add'
				]
			], 200);

		# ambil data user yang di tag
		$d_member = $this->db->get_where('users', ['id'=>$id_user])->first_row();

		$data_member = [
			'id_user' => $id_user,
			'id_task' => $id_task,
			'user'    => $d_member->username
		];

		# ambil user yang membuat task
		$d_task = $this->db->select('task.id_user, task.name_task, users.username')
						   ->from('task')
						   ->join('users', 'users.id=task.id_user')
						   ->where('task.id', $id_task)
						   ->get()
						   ->first_row();
		# ambil data member task sebelum di tambah
		$member_task = $this->db->get_where('member_task', ['id_task'=>$id_task])->first_row();

		$title_notification = $d_task->username." tagged you ";
		
		if (!empty($member_task)) {
			
			$total_member = sizeof($member_task);

			# simpan data member task
			$insert = $this->model_task->add_member_task($data_member);

			if ($total_member > 1) {
				$title_notification .= "and ".$total_member." others in a task";
			}

		}

		$d_insert = [
			'id_user'     => $d_task->id_user,
			'id_user_tag' => $d_member->id,
			'id_task'     => $id_task,
			'title'       => $title_notification
		];
		$d_notif = $this->model_notification->tambah($d_insert);

		$ambil = [
			'body'  => $d_task->name_task,
			'title' => $title_notification,
			'id'    => $d_notif->id
		];
		# kirim notifikasi ke user masing masing
		if (!empty($d_member->token_firebase)) {
			$cek = kirim_notifikasi($d_member->token_firebase, $ambil);
		}

		if (!empty($insert)) {
			
			$this->response([
				'status'  => true,
				'message' => 'Berhasil tambah member',
				'data'    => $insert
			], 200);

		} else {

			$this->response([
				'status'  => false,
				'message' => 'Gagal tambah member',
				'data'    => [
					'message' => 'Gagal tambah member'
				]
			], 200);

		}

	}

	public function add_comment_post()
	{
		
		$id_task = $this->post('id_task');
		$komen   = $this->post('comment');
		$id_user = $this->post('id_user');

		$data_insert = [
			'id_task' => $id_task,
			'id_user' => $id_user,
			'comment' => $komen
		];

		$hasil = $this->model_task->add_comment($data_insert);

		$d_task = $this->db->get_where('task', ['id'=>$id_task])->first_row();
		$d_user = $this->db->get_where('users', ['id'=>$d_task->id_user])->first_row();
		$member_task = $this->db->get_where('team', ['id_group'=>$d_task->id_group])->result();

		$title_notification = $d_user->username." comment on task ".$d_task->name_task;

		$all_member = $this->db->select('users.*')
							   ->from('task')
							   ->join('team', 'team.id_group = task.id_group')
							   ->join('users', 'users.id = team.id_member', 'left')
							   ->where('task.id', $id_task)
							   ->where('users.id !=', $id_user)
							   ->get()
							   ->result();

		# kirim notifikasi ke semua member
		if (!empty($all_member)) {
			
			foreach ($all_member as $key => $value) {
				$d_insert = [
					'id_user'     => $d_user->id,
					'id_user_tag' => $value->id,
					'id_task' => $id_task,
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
				'message' => 'Berhasil tambah komen task',
				'data'    => $hasil
			], 200);

		} else {

			$this->response([
				'status'  => false,
				'message' => 'Gagal tambah komen task',
				'data'    => []
			], 200);

		}

	}

	private function add_comment_backup()
	{

		$id_task = $this->post('id_task');
		$komen   = $this->post('comment');
		$id_user = $this->post('id_user');

		$data_insert = [
			'id_task' => $id_task,
			'id_user' => $id_user,
			'comment' => $komen
		];

		$hasil = $this->model_task->add_comment($data_insert);

		# $member_task = $this->db->get_where('member_task', ['id_task'=>$id_task])->result();
		$d_task = $this->db->get_where('task', ['id'=>$id_task])->first_row();
		$d_user = $this->db->get_where('users', ['id'=>$d_task->id_user])->first_row();
		$member_task = $this->db->get_where('team', ['id_group'=>$d_task->id_group])->result();

		$title_notification = $d_user->username." comment on task ".$d_task->name_task;

		# jika manajer punya member tim
		# maka member tim yang ada, mendapatkan notifikasi
		if (!empty($member_task)) {
			
			foreach ($member_task as $key => $value) {
			
				$d_member = $this->db->get_where('users', ['id'=>$value->id_member])->first_row();

				if (!empty($d_member) && $d_member->id != $id_user) {
					
					$d_insert = [
						'id_user'     => $d_task->id_user,
						'id_user_tag' => $d_member->id,
						'id_task'     => $id_task,
						'title'       => $title_notification
					];
					$d_notif = $this->model_notification->tambah($d_insert);

					$ambil = [
						'body'  => $komen,
						'title' => $title_notification,
						'id'    => $d_notif->id
					];
					# kirim notifikasi ke user masing masing
					if (!empty($d_member->token_firebase)) {
						$cek[] = kirim_notifikasi($d_member->token_firebase, $ambil);
					}

				}

			}

		}

		// die(print_r($cek));

		if (!empty($hasil)) {
			
			$this->response([
				'status'  => true,
				'message' => 'Berhasil tambah komen task',
				'data'    => $hasil
			], 200);

		} else {

			$this->response([
				'status'  => false,
				'message' => 'Gagal tambah komen task',
				'data'    => []
			], 200);

		}

	}

	public function update_status_put()
	{

		$where = ['id'=>$this->put('id_task')];
		$set   = ['status_task'=>'Y'];

		$this->db->update('task', $set, $where);

		$this->response([
			'status'  => true,
			'message' => 'Berhasil update status task',
			'data'    => []
		], 200);

	}

	public function cancel_put()
	{

		$where = ['id'=>$this->put('id_task')];

		$this->db->delete('task', $where);

		$this->response([
			'status'  => true,
			'message' => 'Berhasil cancel task',
			'data'    => []
		], 200);

	}

}

/* End of file Task.php */
/* Location: ./application/controllers/api/Task.php */