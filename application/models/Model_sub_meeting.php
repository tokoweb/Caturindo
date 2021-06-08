<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_sub_meeting extends CI_Model {

	public function tambah_sub($data){

		$this->db->insert('sub_meeting',$data);
		$success = $this->db->affected_rows();

		if($success){

			$insert_id = $this->db->insert_id();

			$user_tag = explode(',', $data['tag']);
			
			for ($i=0; $i < sizeof($user_tag); $i++) { 
				$data_member = [
					'user'    => trim($user_tag[$i]),
					'id_sub_meeting' => $data['id']
				];
				$this->db->insert('member_submeeting', $data_member);
			}
			
			if (!empty($data['id_file'])) {
				
				$data = $this->db->select('sub_meeting.*, file.file')
							 ->from('sub_meeting')
							 ->join('file', 'file.id=sub_meeting.id_file')
							 ->where('sub_meeting.id', $data['id'])
							 ->get()
							 ->first_row();

			} else {

				$data = $this->db->get_where('sub_meeting',['id' => $data['id']])->first_row();

			}

			if (!empty($data)) {
				
				$data->file = [];
				# ambil data file
				if (!empty($data->id_file)) {
					$file_array = explode(',', $data->id_file);
					if (is_array($file_array)) {
						$data->id_file = $file_array;
						for ($z=0; $z < sizeof($file_array); $z++) { 
							$data_file = $this->db->get_where('file', ['id'=>$file_array[$z]])->first_row();
							if (!empty($data_file)) {
								$data->file[] = base_url().'assets/file/'.$data_file->file;
							}
						}
					} else {
						$data_file   = $this->db->get_where('file', ['id'=>$data->id_file])->first_row();
						if (!empty($data_file)) {
							$data->file[] = base_url().'assets/file/'.$data_file->file;
						}
					}

				} else {
					$data->id_file = [];
				}

			}

			return $data;

		}

	}

	public function get_submeeting_for_admin($tgl_awal = null, $tgl_akhir = null)
	{


		if (empty($tgl_awal)) {
			$this->db->where('date >=', date('Y-m-d'));
		} else {
			$this->db->where('date >=', $tgl_awal);
		}

		if (empty($tgl_akhir)) {
			$this->db->where('date <=', date('Y-m-d'));
		} else {
			$this->db->where('date <=', $tgl_akhir);
		}

		// $data = $this->db->select('sub_meeting.*')
		// 				 ->join('team', 'team.id_group=sub_meeting.id_group')
		// 				 ->order_by('sub_meeting.id', 'desc')
		// 				 ->get('sub_meeting')
		// 				 ->result();

		$data = $this->db->order_by('id', 'desc')->get('sub_meeting')->result();

		if (!empty($data)) {
			
			foreach ($data as $key => $value) {

				// $value->tag = $tag;
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

					# ambil data total member grub
					$member_group = $this->db->select('u.*')
											 ->distinct()
											 ->join('users u', 'u.id=team.id_member')
											 ->where('team.id_group', $value->id_group)
											 ->get('team')
											 ->result();

					# ambil data user pembuat meeting
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
						$value->member_group = implode(',', $m_group);
						$value->seluruh_member = $member_group;
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
						if (!empty($data_file)) {
							$value->file[] = base_url().'assets/file/'.$data_file->file;
						}
					}

				} else {
					$value->id_file = [];
				}

				# ambil data sub meeting
				// $value->data_s_meeting = $this->detail_submeeting($value->id);

				if (empty($value->status_meeting)) {
					$hari_sekarang = date('Y-m-d H:i:s');
					if ($value->created_at < $hari_sekarang) {
						$value->meeting_status = 'Selesai';
					} else {
						$value->meeting_status = 'Dalam Proses';
					}
					$value->warna = 'bg-light-green';
				} else if ($value->status_meeting == 1) {
					$value->meeting_status = 'Selesai';
					$value->warna = 'bg-primary';
				}

			}

			return $data;

		}

	}

	public function tampil_submeeting($id_user = null, $id_meeting = null, $id_sub_meeting = null, $status_meeting = null, $web = null)
	{

		if (!empty($id_sub_meeting)){
			
			$this->db->where('sub_meeting.id', $id_sub_meeting);

		}

		if (!empty($status_meeting)){

			$this->db->where('sub_meeting.status_meeting', $status_meeting);

		} else {
			$this->db->where('sub_meeting.status_meeting', null);
		}

		$data = $this->db->select('sub_meeting.*')
						 ->from('sub_meeting')
						 ->join('team', 'team.id_group = sub_meeting.id_group')
						 ->where('team.id_member', $id_user)
						 ->get()
						 ->result();

		// echo "<pre>";
		// print_r($data);

		if (!empty($data)) {
			
			foreach ($data as $key => $value) {

				$value->nama_group = null;
				$value->member_group = null;
				$value->count_members = null;
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
						if (!empty($data_file)) {
							$value->file[] = base_url().'assets/file/'.$data_file->file;
						}
					}

				} else {
					$value->id_file = [];
				}

				if (!empty($value->code_room)) {

					$d_room = $this->db->get_where('rooms', ['code_room'=>$value->code_room])->first_row();
					if (!empty($d_room)) {
						$value->max_people = $d_room->max_people;
					} else {
						$value->max_people = null;
					}

				} else {

					$d_room = $this->db->get_where('transports', ['id'=>$value->id])->first_row();
					if (!empty($d_room)) {
						$value->max_people = $d_room->max_people;
					} else {
						$value->max_people = null;
					}
					
				}

				if (empty($value->status_meeting)) {
					$value->meeting_status = 'Dalam Proses';
					$value->warna = 'bg-light-green';
				} else if ($value->status_meeting == 1) {
					$value->meeting_status = 'Selesai';
					$value->warna = 'bg-info';
				}

			}

			return $data;

		}

	}

	public function tampil_per_staf($input)
	{

		$cek_tim = $this->db->get_where('team', ['id_member'=>$input['id_user']])->result();

		if (!empty($input['id_sub_meeting'])) {
			
			$data = $this->db->get_where('sub_meeting', ['id'=>$input['id_sub_meeting']])->result();

		} else {

			if (!empty($cek_tim)) {
				
				foreach ($cek_tim as $key => $value) {
					$id_group[] = $value->id_group;
				}

				if (!empty($input['status_meeting'])) {
					$this->db->where('status_meeting', $input['status_meeting']);
				} else {
					$this->db->where('status_meeting', null);
				}

				if (sizeof($id_group) > 1) {
					$this->db->where_in('id_group', $id_group);
				} else {
					$this->db->where('id_group', 20);
				}

				$data = $this->db->select('*')
								 ->from('sub_meeting')
								 ->order_by('created_at', 'desc')
								 ->get()
								 ->result();

			}

		}

		// echo "<pre>";
		// print_r ($data);
		// echo "</pre>";

		if (!empty($data)) {
			
			foreach ($data as $key => $value) {

				$value->nama_group = null;
				$value->member_group = null;
				$value->count_members = null;
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
						if (!empty($data_file)) {
							$value->file[] = base_url().'assets/file/'.$data_file->file;
						}
					}

				} else {
					$value->id_file = [];
				}

				if (!empty($value->code_room)) {

					$d_room = $this->db->get_where('rooms', ['code_room'=>$value->code_room])->first_row();
					if (!empty($d_room)) {
						$value->max_people = $d_room->max_people;
					} else {
						$value->max_people = null;
					}

				} else {

					$d_room = $this->db->get_where('transports', ['id'=>$value->id])->first_row();
					if (!empty($d_room)) {
						$value->max_people = $d_room->max_people;
					} else {
						$value->max_people = null;
					}
					
				}

			}

			return $data;

		}

	}

	public function tampil_semua($input)
	{
		
		if (!empty($input['id_sub_meeting'])) {
			$data = $this->db->get_where('sub_meeting', ['id'=>$input['id_sub_meeting']])->result();
		} else{

			if (!empty($input['tanggal'])) {
				$tgl_awal  = $input['tanggal'].'-01';
				$tgl_akhir = $input['tanggal'].'-31';
				$this->db->where('created_at >= ', $tgl_awal);
				$this->db->where('created_at <= ', $tgl_akhir);
			}

			if ($input['status_meeting'] == 1) {
				$this->db->where('status_meeting', 1);
			} else {
				$this->db->where_in('status_meeting', null,0);
			}

			$data = $this->db->order_by('created_at', 'desc')->get('sub_meeting')->result();

		}

		if (!empty($data)) {
			
			foreach ($data as $key => $value) {

				$value->nama_group = null;
				$value->member_group = null;
				$value->count_members = null;
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
						if (!empty($data_file)) {
							$value->file[] = base_url().'assets/file/'.$data_file->file;
						}
					}

				} else {
					$value->id_file = [];
				}

				if (!empty($value->code_room)) {

					$d_room = $this->db->get_where('rooms', ['code_room'=>$value->code_room])->first_row();
					if (!empty($d_room)) {
						$value->max_people = $d_room->max_people;
					} else {
						$value->max_people = null;
					}

				} else {

					$d_room = $this->db->get_where('transports', ['id'=>$value->id])->first_row();
					if (!empty($d_room)) {
						$value->max_people = $d_room->max_people;
					} else {
						$value->max_people = null;
					}
					
				}

			}

			return $data;

		}

	}	

}

/* End of file Model_sub_meeting.php */
/* Location: ./application/models/Model_sub_meeting.php */