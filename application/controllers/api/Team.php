<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Team extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_team');
	}

	public function index_get()
	{

		$id_user  = $this->get('id_user');
		$id_group = $this->get('id_group');

		$d_user = $this->db->get_where('users', ['id'=>$id_user])->first_row();
		$d_jabatan = $this->db->get_where('user_role', ['id'=>$d_user->role])->first_row();
		
		if (!empty($id_group)) {
			$team = $this->model_team->dengan_id_group($id_user, $id_group);
		} else {
			$team = $this->model_team->tanpa_id_group($id_user);
		}

		$hasil = [
			'id_user'  => $d_user->id,
			'name'     => $d_user->name,
			'username' => $d_user->username,
			'email'    => $d_user->email,
			'phone'    => $d_user->phone,
			'jabatan'  => !empty($d_jabatan)?$d_jabatan->role:null
		];

		$d_gambar_profil = $this->db->get_where('file', ['id'=>$d_user->id_image_profile])->first_row();
        $d_background_profil = $this->db->get_where('file', ['id'=>$d_user->id_image_background])->first_row();

        if (!empty($d_gambar_profil)) {
            $hasil['image_profile'] = base_url().'assets/file/'.$d_gambar_profil->file;
        } else {
            $hasil['image_profile'] = null;
        }

        if (!empty($d_background_profil)) {
            $hasil['image_background'] = base_url().'assets/file/'.$d_background_profil->file;
        } else {
            $hasil['image_background'] = null;
        }

        $hasil['member'] = $team;

		$this->response([
			'status'  => true,
			'message' => 'Berhasil tampil data team',
			'data'    => $hasil
		], 200);
		
	}

	public function add_post()
	{

		$id_user   = $this->post('id_user');
		$id_member = $this->post('id_member');
		$id_group  = $this->post('id_group');

		if ($id_user == $id_member) {
			$this->response([
				'status'  => false,
				'message' => 'User tidak boleh add member diri sendiri',
				'data'    => []
			], 200);
		}

		$cek_user = $this->db->get_where('users', ['id'=>$id_user])->first_row();

		if ($cek_user->role == 3) {
			
			$this->response([
				'status'  => false,
				'message' => 'Hanya manajer yang dapat menambah anggota tim',
				'data'    => []
			], 200);

		}

		# cek member yang sudah di add
		$cek_member = $this->db->get_where('team', ['id_member'=>$id_member, 'id_group'=>$id_group])->first_row();
		$d_member   = $this->db->get_where('users', ['id'=>$id_member])->first_row();

		if (!empty($cek_member)) {
			
			$this->response([
				'status'  => false,
				'message' => 'member '.$d_member->username.' tidak dapat di tambah 2x',
				'data'    => []
			],200);

		}

		$d_insert = [
			'id_user'   => $id_user,
			'id_member' => $id_member,
			'id_group'  => $id_group
		];

		$this->db->insert('team', $d_insert);

		$this->response([
			'status'  => true,
			'message' => 'Berhasil tambah tim',
			'data'    => []
		], 200);

	}

	public function hapus_member_post(){

		$where = [
			'id_user'   => $this->post('id_user'),
			'id_member' => $this->post('id_member'),
			'id_group'  => $this->post('id_group')
		];

		$this->db->delete('team', $where);

		$this->response([
			'status'  => true,
			'message' => 'Berhasil hapus member tim',
			'data'    => []
		], 200);

	}

	public function search_user_get()
	{

		$id_user  = $this->get('id_user');
		$username = $this->get('username');

		$cek_user = $this->db->get('users', ['id'=> $id_user])->first_row();

		$this->db->select('id, username, email, role')
				 ->like('username', $username)
                 ->where('role IS NOT NULL', NULL, FALSE)
                 ->where('role!=', 1)
                 ->where('id !=', $id_user);

	    if (!empty($cek_user) && $cek_user->role == 2) {
	    	
	    	$data_team = $this->db->where('id_user', $id_user)
					    		  ->get('team')
					    		  ->result();

			if (!empty($data_team)) {
				foreach ($data_team as $key => $dt) {
					$this->db->where('id!=', $dt->id_member);
				}
			}

	    }

		$search    =  $this->db->get('users')->result_array();

		$sudah_ada = $this->model_team->get($id_user);

		for ($y=0; $y<sizeof($search); $y++) {
			
			for ($i=0; $i<sizeof($sudah_ada); $i++) {
				
				# user yang telah menjadi salah satu member, tidak akan muncul di pencarian
				if (!empty($search[$y])) {
				 	
				 	if ($sudah_ada[$i]['id_member'] == $search[$y]['id']) {
						unset($search[$y]);
					}

				 } 

			}

		}

		$this->response([
			'status'  => true,
			'message' => 'Data user berhasil didapat',
			'data'    => array_values($search)
		], 200);

	}

}

/* End of file Team.php */
/* Location: ./application/controllers/api/Team.php */