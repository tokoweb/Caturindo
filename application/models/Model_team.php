<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_team extends CI_Model {

	public function add($data)
	{

		$this->db->insert('team',$data);
		$success = $this->db->affected_rows();
		$name_team = null;

		if($success){

			$insert_id = $this->db->insert_id();

			$d_user = $this->db->get_where('users', ['id'=>$data['id_user']])->result();
			$d_member = $this->db->get('users')->result();

			foreach ($d_member as $key => $value) {
				
				$d_team = $this->db->get_where('team', ['id_member'=>$value->id])->first_row();

				if (!empty($d_team)) {
					$name_team = $d_team->username;
				}

				$team[] = [
					'member_name' => $name_team
				];

			}

			return $data;

		}

	}

	public function get($id_user)
	{

		$d_member = $this->db->select('users.*, ur.role as jabatan')
							 ->join('user_role ur', 'ur.id=users.role')
							 // ->where('users.id', $id_user)
							 ->get('users')
							 ->result();
		$name_team = null;
		$team = [];

		foreach ($d_member as $key => $value) {
			
			$d_team = $this->db->get_where('team', ['id_member'=>$value->id])->first_row();
			$d_leader = $this->db->get_where('team', ['id_user'=>$value->id])->first_row();

			if (!empty($d_team) && $value->id != $id_user) {

				$team[] = [
					'id_member'=> $value->id,
					'username' => $value->username,
					'email'    => $value->email,
					'phone'    => $value->phone,
					'whatsapp' => $value->whatsapp,
					'jabatan'  => $value->jabatan
				];

			}

			if (!empty($d_leader) && $value->id != $id_user) {

				$team[] = [
					'id_member'=> $value->id,
					'username' => $value->username,
					'email'    => $value->email,
					'phone'    => $value->phone,
					'whatsapp' => $value->whatsapp,
					'jabatan'  => $value->jabatan
				];

			}

		}

		return $team;

	}

	public function get_v2($id_user, $id_group=null, $role)
	{

		$team = [];

		if ($role == 2) { # kalo role nya manajer

			$d_team = $this->db->get_where('team', ['id_user'=>$id_user,'id_group'=>$id_group])->result();

		} else if($role == 3){ # kalo role nya staf

			# ambil id user dari manajer yang add tim
			$user_add = $this->db->get_where('team', ['id_member'=>$id_user,'id_group'=>$id_group])->first_row();


			if (!empty($user_add)) {

				$ketua  = $this->db->get_where('users', ['id'=>$user_add->id_user])->first_row();
				
				$team[] = [
					'id_member'=> $ketua->id,
					'username' => $ketua->username,
					'email'    => $ketua->email,
					'phone'    => $ketua->phone,
					'whatsapp' => $ketua->whatsapp,
					'jabatan'  => 'Manajer'
				];

				# ambil data member dalam tim
				$d_team = $this->db->get_where('team', ['id_user'=>$user_add->id_user])->result();

			}

			
		}
		
		if (!empty($d_team)) {
			
			foreach ($d_team as $key => $value) {

				# kalo user adalah manajer yang add tim
				$member = $this->db->get_where('users', ['id'=>$value->id_member])->first_row();
				
				if (!empty($member) && $member->id != $id_user){
					$jabatan = $this->db->get_where('user_role', ['id'=>$member->role])->first_row();
					$team[] = [
						'id_member'=> $member->id,
						'username' => $member->username,
						'email'    => $member->email,
						'phone'    => $member->phone,
						'whatsapp' => $member->whatsapp,
						'jabatan'  => $jabatan->role
					];
				}

			}

		}

		return $team;

	}

	public function get_v3($id_user, $id_group = null)
	{

		$this->db->select('*, team.id as id_team')
				 ->from('team')
				 ->join('users', 'users.id=team.id_member');

		if (!empty($id_group)) {
			$this->db->where('team.id_group', $id_group);
		}

		$data = $this->db->get()->result();

		if (!empty($data)) {

			foreach ($data as $key => $value) {

				$value->nama_group = null;
				$value->jabatan    = null;
				if (!empty($value->id_group)) {
					$group = $this->db->get_where('group_team', ['id'=>$value->id_group])->first_row();
					$value->nama_group = $group->nama_team;
				}

				if (!empty($value->role)) {
					$jabatan = $this->db->get_where('user_role', ['id'=>$value->role])->first_row();
					if (!empty($jabatan)) {
						$value->jabatan = $jabatan->role;
					}
				}
			}

			return $data;
		}

	}

	public function get_v4($id_user, $id_group = null)
	{

		$this->db->select('*, team.id as id_team')
				 ->from('team')
				 ->join('users', 'users.id=team.id_member');

		if (!empty($id_group)) {
			$this->db->where('team.id_group', $id_group);
		}

		$this->db->where('team.id_user', $id_user);

		$data = $this->db->get()->result();

		if (!empty($data)) {

			foreach ($data as $key => $value) {

				$value->nama_group = null;
				$value->jabatan    = null;
				if (!empty($value->id_group)) {
					$group = $this->db->get_where('group_team', ['id'=>$value->id_group])->first_row();
					if (!empty($group)) {
						$value->nama_group = $group->nama_team;
					}
				}

				if (!empty($value->role)) {
					$jabatan = $this->db->get_where('user_role', ['id'=>$value->role])->first_row();
					if (!empty($jabatan)) {
						$value->jabatan = $jabatan->role;
					}
				}
			}

			return $data;
		}

	}

	public function tanpa_id_group($id_user)
	{

		# kalo id group kosong
		if (empty($id_group)) {
			# ambil semua id group dari user di table member
			$id_group = $this->db->select('team.id_group')
							 ->distinct()
							 ->from('team')
							 ->where('team.id_member', $id_user)
							 ->get()
							 ->result();

			if (!empty($id_group)) {
				
				foreach ($id_group as $key => $value) {
					$user = $this->db->select('users.*')
							 ->from('team')
							 ->join('users', 'users.id = team.id_member')
							 ->where('team.id_group', $value->id_group)
							 ->where('team.id_member !=', $id_user)
							 ->get()
							 ->result();

					foreach ($user as $key => $user) {
						$jabatan = $this->db->get_where('user_role', ['id'=>$user->role])->first_row();
						$team[] = [
							'id_member'=> $user->id,
							'username' => $user->username,
							'email'    => $user->email,
							'phone'    => $user->phone,
							'whatsapp' => $user->whatsapp,
							'jabatan'  => $jabatan->role
						];
					}

				}

			}

		}

		return $team;

	}

	public function dengan_id_group($id_user, $id_group)
	{

		# kalo id group kosong
		$user = $this->db->select('users.*')
						 ->from('team')
						 ->join('users', 'users.id = team.id_member')
						 ->where('team.id_group', $id_group)
						 ->where('team.id_member !=', $id_user)
						 ->get()
						 ->result();

		if (!empty($user)) {
			
			foreach ($user as $key => $user) {
				$jabatan = $this->db->get_where('user_role', ['id'=>$user->role])->first_row();
				$team[] = [
					'id_member'=> $user->id,
					'username' => $user->username,
					'email'    => $user->email,
					'phone'    => $user->phone,
					'whatsapp' => $user->whatsapp,
					'jabatan'  => $jabatan->role
				];
			}

		} else {
			$team = [];
		}

		return $team;

	}

	public function get_group($id_user)
	{

		return $this->db->get_where('group_team', ['id_user'=>$id_user])->result();

	}

	public function search_member($id_user, $id_group = null)
	{

		$filter_member = $this->db->get_where('team', [
							'id_user'  => $id_user,
							'id_group' => $id_group
						 ])->result();

		# filter member yang sudah di add di tim
		# tidak di munculkan
		if (!empty($filter_member)) {
			foreach ($filter_member as $key => $value) {
				$this->db->where('id != ',$value->id_member);
			}
		}

		$data =  $this->db->where('id != ', $id_user)
						  ->where('role !=', null)
						  ->where('user_aktif', '1')
						  ->where('id != ', '2')
						  ->get('users')
						  ->result();

		if (!empty($data)) {
			foreach ($data as $key => $value) {
				$jabatan = $this->db->get_where('user_role', ['id'=>$value->role])->first_row();
				$value->jabatan = !empty($jabatan)?$jabatan->role:null;
			}
		}

		return $data;

	}

}

/* End of file Model_team.php */
/* Location: ./application/models/Model_team.php */