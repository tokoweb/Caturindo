<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_task extends CI_Model {

	public function get_task_web_admin($tgl_awal = null, $tgl_akhir = null)
	{

		if (!empty($id_task)){
			$this->db->where('id', $id_task);
		}

		if (!empty($tgl_awal)) {
			$this->db->where('due_date >=', $tgl_awal);
		}

		if (!empty($tgl_akhir)) {
			$this->db->where('due_date <=', $tgl_akhir);
		}
		
		$data_task = $this->db->order_by('id', 'desc')->get('task')->result();
		$jumlah_tag = null;
		$tag = null;
		$member = null;

		if (!empty($data_task)) {
			
			foreach ($data_task as $key => $value) {

				$value->count_members = null;

				$member_group = [];
				$value->nama_group = null;
				$value->member_group = null;
				$value->seluruh_member = null;
				$value->creator = '-';
				if (!empty($value->id_group)) {

					# ambil data nama grub
					$nama_group = $this->db->get_where('group_team', ['id'=>$value->id_group])->first_row();
					if (!empty($nama_group)) {
						$value->nama_group = $nama_group->nama_team;
					}

					if (!empty($_SESSION['user_data']->id)) {
						$this->db->where('team.id_member !=', $_SESSION['user_data']->id);
					}

					# ambil data total member grub
					$member_group = $this->db->select('u.*')
											 ->join('users u', 'u.id=team.id_member')
											 ->where('team.id_group', $value->id_group)
											 ->get('team')
											 ->result();

					# ambil data user pembuat task
					if (!empty($value->id_user)) {
						$creator = $this->db->get_where('users', ['id'=>$value->id_user])->first_row();
						if (!empty($creator)) {
							$value->creator = $creator->username;
						}
					}
											 
					
					if (!empty($member_group)) {
						foreach ($member_group as $key => $mg) {
							$m_group[] = $mg->username;
						}
						$value->count_members = sizeof($m_group);
						$value->member_group = implode('<br>', $m_group);
						$value->seluruh_member = $member_group;
						unset($m_group);
					}
				}

				$value->file = null;
				# ambil data file
				if (!empty($value->id_file)) {
					$file_array = explode(',', $value->id_file);
					if (is_array($file_array)) {
						$value->id_file = $file_array;
						for ($z=0; $z < sizeof($file_array); $z++) { 
							$data_file = $this->db->get_where('file', ['id'=>$file_array[$z]])->first_row();
							if (!empty($data_file)) {
								$value->file[] = base_url().'assets/file/'.$data_file->file;
							}
						}
					} else {
						$data_file   = $this->db->get_where('file', ['id'=>$value->id_file])->first_row();
						$value->file[] = base_url().'assets/file/'.$data_file->file;
					}

				}

				if (empty($value->status_task)) {
					$value->status_task = 'Dalam Proses';
					$value->warna = 'bg-light-green';
				} else if ($value->status_task == 1 || $value->status_task == 'Y') {
					$value->status_task = 'Selesai';
					$value->warna = 'bg-primary';
				}

				$value->judul_meeting = null;
				if (!empty($value->id_meeting)) {
					$d_meeting = $this->db->get_where('meeting', ['id'=>$value->id_meeting])->first_row();
					$d_s_meeting = $this->db->get_where('sub_meeting', ['id'=>$value->id_meeting])->first_row();
					if (!empty($d_meeting)) {
						$value->judul_meeting = $d_meeting->title;
					} else if (!empty($d_s_meeting)) {
						$value->judul_meeting = $d_s_meeting->title;
					}
				}

			}

		}

		return $data_task;

	}

	public function get_task_web($id_user = null)
	{

		if (!empty($id_task)){
			$this->db->where('id', $id_task);
		}

		if (!empty($tanggal)) {
			$this->db->where('due_date >=', $tanggal.'-01')
					 ->where('due_date <=', $tanggal.'-31');
		}

		if (!empty($id_user)) {
			$this->db->where('id_user', $id_user);
		}
		
		$data_task = $this->db->order_by('id', 'desc')->get('task')->result();
		$jumlah_tag = null;
		$tag = null;
		$member = null;

		// echo "<pre>";
		// print_r ($data_task);
		// echo "</pre>";
		// die();

		if (!empty($data_task)) {
			
			foreach ($data_task as $key => $value) {

				$value->due_date = tgl_indo($value->due_date);

				$value->count_members = null;

				$member_group = [];
				$value->nama_group = null;
				$value->member_group = null;
				$value->seluruh_member = null;
				$value->creator = '-';
				if (!empty($value->id_group)) {

					# ambil data nama grub
					$nama_group = $this->db->get_where('group_team', ['id'=>$value->id_group])->first_row();
					if (!empty($nama_group)) {
						$value->nama_group = $nama_group->nama_team;
					}

					if (!empty($_SESSION['user_data']->id)) {
						$this->db->where('team.id_member !=', $_SESSION['user_data']->id);
					}

					# ambil data total member grub
					$member_group = $this->db->select('u.*')
											 ->join('users u', 'u.id=team.id_member')
											 ->where('team.id_group', $value->id_group)
											 ->get('team')
											 ->result();

					# ambil data user pembuat task
					if (!empty($value->id_user)) {
						$creator = $this->db->get_where('users', ['id'=>$value->id_user])->first_row();
						if (!empty($creator)) {
							$value->creator = $creator->username;
						}
					}
											 
					
					if (!empty($member_group)) {
						foreach ($member_group as $key => $mg) {
							$m_group[] = $mg->username;
						}
						$value->count_members = sizeof($m_group);
						$value->member_group = implode('<br>', $m_group);
						$value->seluruh_member = $member_group;
						unset($m_group);
					}
				}

				$value->file = null;
				# ambil data file
				if (!empty($value->id_file)) {
					$file_array = explode(',', $value->id_file);
					if (is_array($file_array)) {
						$value->id_file = $file_array;
						for ($z=0; $z < sizeof($file_array); $z++) { 
							$data_file = $this->db->get_where('file', ['id'=>$file_array[$z]])->first_row();
							if (!empty($data_file)) {
								$value->file[] = base_url().'assets/file/'.$data_file->file;
							}
						}
					} else {
						$data_file   = $this->db->get_where('file', ['id'=>$value->id_file])->first_row();
						$value->file[] = base_url().'assets/file/'.$data_file->file;
					}

				}

				if (empty($value->status_task)) {
					// if ($value->due_date < date('Y-m-d')) {
					// 	$value->status_task = 'Selesai';
					// 	$value->warna = 'bg-primary';
					// } else {
					// 	$value->status_task = 'Dalam Proses';
					// 	$value->warna = 'bg-light-green';
					// }
					$value->status_task = 'Dalam Proses';
					$value->warna = 'bg-light-green';
				} else if ($value->status_task == 1 || $value->status_task = 'Y') {
					$value->status_task = 'Selesai';
					$value->warna = 'bg-primary';
				}

				$value->judul_meeting = null;
				if (!empty($value->id_meeting)) {
					$d_meeting = $this->db->get_where('meeting', ['id'=>$value->id_meeting])->first_row();
					$d_s_meeting = $this->db->get_where('sub_meeting', ['id'=>$value->id_meeting])->first_row();
					if (!empty($d_meeting)) {
						$value->judul_meeting = $d_meeting->title;
					} else if (!empty($d_s_meeting)) {
						$value->judul_meeting = $d_s_meeting->title;
					}
				}

			}

		}

		return $data_task;

	}

	public function get_task($id_user = null, $id_task = null, $tanggal = null)
	{

		if (!empty($id_task)){
			$this->db->where('id', $id_task);
		}

		if (!empty($tanggal)) {
			$this->db->where('due_date >=', $tanggal.'-01')
					 ->where('due_date <=', $tanggal.'-31');
		}

		if (!empty($id_user)) {
			$this->db->where('id_user', $id_user);
		}
		
		$data_task = $this->db->get('task')->result();
		$jumlah_tag = null;
		$tag = null;
		$member = null;

		if (!empty($data_task)) {
			
			foreach ($data_task as $key => $value) {

				$value->count_members = null;

				$member_group = [];
				$value->nama_group = null;
				$value->member_group = null;
				if (!empty($value->id_group)) {

					# ambil data nama grub
					$nama_group = $this->db->get_where('group_team', ['id'=>$value->id_group])->first_row();
					if (!empty($nama_group)) {
						$value->nama_group = $nama_group->nama_team;
					}

					# ambil data total member grub
					$member_group = $this->db->select('u.username')
											 ->join('users u', 'u.id=team.id_member')
											 ->where('team.id_group', $value->id_group)
											 ->where('team.id_member != ', $id_user)
											 ->get('team')
											 ->result();
					if (!empty($member_group)) {
						foreach ($member_group as $key => $mg) {
							$m_group[] = $mg->username;
						}
						$value->count_members = sizeof($m_group);
						$value->member_group = implode(',', $m_group);
					}
				}

				$value->file = [];
				# ambil data file
				if (!empty($value->id_file)) {
					$file_array = explode(',', $value->id_file);
					if (is_array($file_array)) {
						$value->id_file = $file_array;
						for ($z=0; $z < sizeof($file_array); $z++) { 
							$data_file = $this->db->get_where('file', ['id'=>$file_array[$z]])->first_row();
							$value->file[] = base_url().'assets/file/'.$data_file->file;
						}
					} else {
						$data_file   = $this->db->get_where('file', ['id'=>$value->id_file])->first_row();
						$value->file[] = base_url().'assets/file/'.$data_file->file;
					}

				} else {
					$value->id_file = [];
				}

			}

		}

		return $data_task;

	}

	public function get_task_v2($id_user = null, $id_task = null, $tanggal = null)
	{

		if (!empty($id_task)){
			$this->db->where('id', $id_task);
		}

		if (!empty($tanggal)) {
			$this->db->where('due_date >=', $tanggal.'-01')
					 ->where('due_date <=', $tanggal.'-31');
		}
		
		$data_task = $this->db->select('task.*')
							  ->join('team', 'team.id_group = task.id_group')
							  ->where('team.id_member', $id_user)
							  ->order_by('team.id', 'desc')
							  ->get('task')
							  ->result();
		$jumlah_tag = null;
		$tag = null;
		$member = null;

		if (!empty($data_task)) {
			
			foreach ($data_task as $key => $value) {

				$value->count_members = null;

				$member_group = [];
				$value->nama_group = null;
				$value->member_group = null;
				if (!empty($value->id_group)) {

					# ambil data nama grub
					$nama_group = $this->db->get_where('group_team', ['id'=>$value->id_group])->first_row();
					if (!empty($nama_group)) {
						$value->nama_group = $nama_group->nama_team;
					}

					# ambil data total member grub
					$member_group = $this->db->select('u.username')
											 ->join('users u', 'u.id=team.id_member')
											 ->where('team.id_group', $value->id_group)
											 ->where('team.id_member != ', $id_user)
											 ->get('team')
											 ->result();
					if (!empty($member_group)) {
						foreach ($member_group as $key => $mg) {
							$m_group[] = $mg->username;
						}
						$value->count_members = sizeof($m_group);
						$value->member_group = implode(',', $m_group);
					}
				}

				$value->file = [];
				# ambil data file
				if (!empty($value->id_file)) {
					$file_array = explode(',', $value->id_file);
					if (is_array($file_array)) {
						$value->id_file = $file_array;
						for ($z=0; $z < sizeof($file_array); $z++) { 
							$data_file = $this->db->get_where('file', ['id'=>$file_array[$z]])->first_row();
							$value->file[] = base_url().'assets/file/'.$data_file->file;
						}
					} else {
						$data_file   = $this->db->get_where('file', ['id'=>$value->id_file])->first_row();
						$value->file[] = base_url().'assets/file/'.$data_file->file;
					}

				} else {
					$value->id_file = [];
				}

			}

		}

		return $data_task;

	}

	public function get_task_v3($input)
	{
		
		$cek_tim = $this->db->get_where('team', ['id_member'=>$input['id_user']])->result();


		if (!empty($input['id_task'])) {
			
			$data_task = $this->db->get_where('task', ['id'=>$input['id_task']])->result();

		} else if (!empty($cek_tim)) {
			
			foreach ($cek_tim as $key => $value) {
				$id_group[] = $value->id_group;
			}

			if (sizeof($id_group) > 1) {
				$this->db->where_in('id_group', $id_group);
			} else {
				$this->db->where('id_group', $id_group[0]);
			}

			if (!empty($tanggal)) {
				$this->db->where('due_date >=', $tanggal.'-01')
						 ->where('due_date <=', $tanggal.'-31');
			}

			$data_task = $this->db->order_by('due_date', 'desc')->get('task')->result();

		}

		$jumlah_tag = null;
		$tag = null;
		$member = null;

		if (!empty($data_task)) {
			
			foreach ($data_task as $key => $value) {

				$value->count_members = null;

				$member_group = [];
				$value->nama_group = null;
				$value->member_group = null;
				if (!empty($value->id_group)) {

					# ambil data nama grub
					$nama_group = $this->db->get_where('group_team', ['id'=>$value->id_group])->first_row();
					if (!empty($nama_group)) {
						$value->nama_group = $nama_group->nama_team;
					}

					# ambil data total member grub
					$member_group = $this->db->select('u.username')
											 ->join('users u', 'u.id=team.id_member')
											 ->where('team.id_group', $value->id_group)
											 ->where('team.id_member != ', $input['id_user'])
											 ->get('team')
											 ->result();
					if (!empty($member_group)) {
						foreach ($member_group as $key => $mg) {
							$m_group[] = $mg->username;
						}
						$value->count_members = sizeof($m_group);
						$value->member_group = implode(',', $m_group);
					}
				}

				$value->file = [];
				# ambil data file
				if (!empty($value->id_file)) {
					$file_array = explode(',', $value->id_file);
					if (is_array($file_array)) {
						$value->id_file = $file_array;
						for ($z=0; $z < sizeof($file_array); $z++) { 
							$data_file = $this->db->get_where('file', ['id'=>$file_array[$z]])->first_row();
							$value->file[] = base_url().'assets/file/'.$data_file->file;
						}
					} else {
						$data_file   = $this->db->get_where('file', ['id'=>$value->id_file])->first_row();
						$value->file[] = base_url().'assets/file/'.$data_file->file;
					}

				} else {
					$value->id_file = [];
				}

			}

		}

		return $data_task;

	}

	public function get_semua_task($input)
	{
		
		if (!empty($input['id_task'])) {

			$data_task = $this->db->get_where('task', ['id'=>$input['id_task']])->result();
			if (!empty($data_task)) {
				foreach ($data_task as $key => $value) {
					$value->nama_group = null;
					if (!empty($value->id_group)) {
						$nama_group = $this->db->get_where('group_team', ['id'=>$value->id_group])->first_row();
						$value->nama_group = $nama_group->nama_team;
					}
				}
			}

		} else{

			if (!empty($input['tanggal'])) {
				$tgl_awal  = $input['tanggal'].'-01';
				$tgl_akhir = $input['tanggal'].'-31';
				$this->db->where('due_date >= ', $tgl_awal);
				$this->db->where('due_date <= ', $tgl_akhir);
			}

			// if (!empty($input['status_meeting']) && $input['status_meeting'] == 1) {
			// 	$this->db->where('status_task', 1);
			// } else {
			// 	$this->db->where_in('status_task', null, 0);
			// }

			$data_task = $this->db->order_by('due_date', 'desc')->get('task')->result();
		}

		$jumlah_tag = null;
		$tag = null;
		$member = null;

		if (!empty($data_task)) {
			
			foreach ($data_task as $key => $value) {

				$value->nama_group = null;
				if (!empty($value->id_group)) {
					$nama_group = $this->db->get_where('group_team', ['id'=>$value->id_group])->first_row();
					$value->nama_group = $nama_group->nama_team;
				}

				$value->count_members = null;

				$member_group = [];
				$value->nama_group = null;
				$value->member_group = null;
				if (!empty($value->id_group)) {

					# ambil data nama grub
					$nama_group = $this->db->get_where('group_team', ['id'=>$value->id_group])->first_row();
					if (!empty($nama_group)) {
						$value->nama_group = $nama_group->nama_team;
					}

					# ambil data total member grub
					$member_group = $this->db->select('u.username')
											 ->join('users u', 'u.id=team.id_member')
											 ->where('team.id_group', $value->id_group)
											 ->where('team.id_member != ', $input['id_user'])
											 ->get('team')
											 ->result();
					if (!empty($member_group)) {
						foreach ($member_group as $key => $mg) {
							$m_group[] = $mg->username;
						}
						$value->count_members = sizeof($m_group);
						$value->member_group = implode(',', $m_group);
						unset($m_group);
					}
				}

				$value->file = [];
				# ambil data file
				if (!empty($value->id_file)) {
					$file_array = explode(',', $value->id_file);
					if (is_array($file_array)) {
						$value->id_file = $file_array;
						for ($z=0; $z < sizeof($file_array); $z++) { 
							$data_file = $this->db->get_where('file', ['id'=>$file_array[$z]])->first_row();
							if (!empty($data_file)) {
								$value->file[] = base_url().'assets/file/'.$data_file->file;
							}
						}
					} else {
						$data_file   = $this->db->get_where('file', ['id'=>$value->id_file])->first_row();
						$value->file[] = base_url().'assets/file/'.$data_file->file;
					}

				} else {
					$value->id_file = [];
				}

			}

		}

		return $data_task;

	}

	public function add_member_task($data)
	{

		$this->db->insert('member_task',$data);
		$success = $this->db->affected_rows();

		if($success){

			$insert_id = $this->db->insert_id();

			$data = $this->db->select('users.id, users.username')
							 ->from('member_task')
							 ->join('users', 'users.id = member_task.id_user')
							 ->where('member_task.id', $insert_id)
							 ->get()
							 ->first_row();
			return $data;

		}

	}

	public function add_task($data)
	{

		$this->db->insert('task',$data);
		$success = $this->db->affected_rows();

		if($success){

			$insert_id = $this->db->insert_id();

			$data = $this->db->get_where('task', ['id'=>$data['id']])->first_row();
			
			if (!empty($data)) {

				$id_file = explode(',', $data->id_file);
				unset($data->id_file);
				$data->id_file = $id_file;

				$data->file = [];
				if (!empty($data->id_file)) {
					# kalo array
					if (is_array($id_file)) {
						
						for ($i=0; $i < sizeof($data->id_file); $i++) { 
							$d_file = $this->db->get_where('file', ['id'=>$data->id_file[$i]])->first_row();
							if (!empty($d_file)) {
								$data->file[] = base_url().'assets/file/'.$d_file->file;
							}
						}

					} else {

						$d_file = $this->db->get_where('file', ['id'=>$data->id_file])->first_row();
						if (!empty($d_file)) {
							$data->file[] = base_url().'assets/file/'.$d_file->file;
						}

					}

				}

				return $data;

			}

		}

	}

	public function add_comment($data)
	{

		$this->db->insert('comment_task',$data);
		$success = $this->db->affected_rows();

		if($success){

			$insert_id = $this->db->insert_id();

			$data = $this->db->get_where('comment_task', ['id'=>$insert_id])->first_row();
			return $data;

		}

	}	

}

/* End of file Model_task.php */
/* Location: ./application/models/Model_task.php */