<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Group extends REST_Controller {

	public function index_get()
	{

		$id_user = $this->get('id_user');

		$cek_user = $this->db->get_where('users', ['id'=>$id_user])->first_row();

		# untuk user bukan manajer
		if ($cek_user->role == 3) {
			$data = $this->db->select('gt.*')
							 ->from('team')
							 ->join('group_team gt', 'gt.id=team.id_group')
							 ->where('team.id_member', $id_user)
							 ->get()
							 ->result();
		} else {

			$data = $this->db->get_where('group_team', ['id_user'=>$id_user])->result();

			if (!empty($data)) {
				foreach ($data as $key => $value) {
					$this->db->where('gt.id !=', $value->id);
				}
			}
			
			$data2 = $this->db->select('gt.*')
							 ->from('team')
							 ->join('group_team gt', 'gt.id=team.id_group')
							 ->where('team.id_member', $id_user)
							 ->get()
							 ->result();

			# kalo $data pertama kosong, maka $data ngambil dari $data2
			if (empty($data)) {
				$data = $data2;
			} else {
				# kalo $data gk kosong, maka di gabung sama $data2
				$data = array_merge($data, $data2);
			}
		}

		if (!empty($data)) {
			foreach ($data as $key => $value) {
				$total = $this->db->get_where('team', ['id_group'=>$value->id])->num_rows();
				$value->total_anggota = $total;
			}
		}

		if (!empty($data)) {
			
			$this->response([
				'status'  => true,
				'message' => 'Data group berhasil di dapat',
				'data'    => $data
			], 200);

		} else {

			$this->response([
				'status'  => false,
				'message' => 'Data group gagal di dapat atau tidak ada',
				'data'    => []
			], 200);

		}
		
	}

	public function create_group_post()
	{

		$this->db->insert('group_team', $this->post());
		$cek = $this->db->affected_rows();

		if (!empty($cek)) {

			$last_id = $this->db->insert_id();
			$hasil = $this->db->get_where('group_team', ['id'=>$last_id])->first_row();

			# tambah team
			$insert_team = [
				'id_group'  => $last_id,
				'id_member' => $this->post('id_user')
			];
			$this->db->insert('team', $insert_team);

			$this->response([
				'status'  => true,
				'message' => 'Berhasil tambah group team',
				'data'    => $hasil
			], 200);

		} else {

			$this->response([
				'status'  => false,
				'message' => 'Gagal tambah group team',
				'data'    => null
			], 200);

		}
		

	}

	public function delete_group_get()
	{

		$id_group = $this->get('id_group');
		$this->db->delete('group_team', ['id'=>$id_group]);
		$this->db->delete('team', ['id_group'=>$id_group]);

		$this->response([
			'status'  => true,
			'message' => 'Berhasil hapus data group',
			'data'    => null
		], 200);

	}

}

/* End of file Group.php */
/* Location: ./application/controllers/api/Group.php */