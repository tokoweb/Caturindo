<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_meeting extends CI_Model {

	public function menu_meeting($status_meeting = null)
	{

		$tab = ['All', 'Belum Selesai', 'Selesai'];

		for ($i=0; $i < sizeof($tab); $i++) {

			  if ($status_meeting == $i) {

		        $aktif[] = [
		          'id'     => $i,
		          'name'   => $tab[$i],
		          'active' => 'active',
		          'url'    => base_url('user/meeting').'?status_meeting='.$i
		        ];

		      } else {

		        $aktif[] = [
		          'id'     => $i,
		          'name'   => $tab[$i],
		          'active' => false,
		          'url'    => base_url('user/meeting').'?status_meeting='.$i
		        ];

		      }

	    }

	    return $aktif;

	}

	public function get_meeting_for_admin($tgl_awal = null, $tgl_akhir = null)
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

		// $data = $this->db->select('meeting.*')
		// 				 ->join('team', 'team.id_group=meeting.id_group')
		// 				 ->order_by('meeting.id', 'desc')
		// 				 ->get('meeting')
		// 				 ->result();

		$data = $this->db->order_by('id', 'desc')->get('meeting')->result();

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
				$value->data_s_meeting = $this->detail_submeeting($value->id);

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

	public function menu_submeeting($status_meeting = null)
	{

		$tab = ['All', 'Belum Selesai', 'Selesai'];

		for ($i=0; $i < sizeof($tab); $i++) {

			  if ($status_meeting == $i) {

		        $aktif[] = [
		          'id'     => $i,
		          'name'   => $tab[$i],
		          'active' => 'active',
		          'url'    => base_url('user/sub_meeting').'?status_meeting='.$i
		        ];

		      } else {

		        $aktif[] = [
		          'id'     => $i,
		          'name'   => $tab[$i],
		          'active' => false,
		          'url'    => base_url('user/sub_meeting').'?status_meeting='.$i
		        ];

		      }

	    }

	    return $aktif;

	}

	public function tampil_meeting_web($id_meeting = null, $status_meeting = null, $id_user = null, $tanggal = null, $web = null)
	{

		if (!empty($id_meeting)){
			$this->db->where('id', $id_meeting);
		}

		if (!empty($web)) {
			if (!empty($status_meeting)) {
				$this->db->where('status_meeting', $status_meeting);
			} else {
				$this->db->where('status_meeting', null);
			}
		}

		if (!empty($id_user)) {
			$this->db->where('id_user', $id_user);
		}

		if (!empty($tanggal)) {
			$this->db->where('date >=', $tanggal.'-01')
					 ->where('date <=', $tanggal.'-31');
		}

		$data = $this->db->order_by('id', 'desc')
						 ->get('meeting')
						 ->result();

		# data flag / member tim
		$flag_member = $this->db->get_where('team', ['id_user'=>$id_user])->result();

		if (!empty($flag_member)) {
			foreach ($flag_member as $key => $fm) {
				$user_flag = $this->db->get_where('users', ['id'=>$fm->id_member])->first_row();
				if (!empty($user_flag)) {
					$tag[] = $user_flag->username;
				}
			}

			$jumlah_tag = sizeof($tag);

			$tag = implode(',', $tag);
		} else {

			$jumlah_tag = 0;
			$tag = null;
		}

		// echo "<pre>";
		// print_r ($data);
		// echo "</pre>";
		// die();

		if (!empty($data)) {
			
			foreach ($data as $key => $value) {

				$value->date = tgl_indo($value->date);

				$value->tag = $tag;
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
					$member_group = $this->db->select('u.*')
											 ->join('users u', 'u.id=team.id_member')
											 ->where('team.id_group', $value->id_group)
											 ->where('team.id_member !=', $_SESSION['user_data']->id)
											 ->get('team')
											 ->result();

					$value->seluruh_member = null;
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

				$d_s_meeting = $this->db->get_where('sub_meeting', ['id_meeting'=>$value->id])->result();

				# ambil data sub meeting
				if (!empty($d_s_meeting)) {

					foreach ($d_s_meeting as $key => $dsm) {
						
						if (!empty($dsm->id_file)) {
							
							$dsm->tag = $tag;
							$dsm->count_members = sizeof($member_group);
							$dsm_data_file = $this->db->get_where('file', ['id'=>$dsm->id_file])->first_row();
							if (!empty($dsm_data_file)) {
								$dsm->file = base_url().'assets/file/'.$dsm_data_file->file;
							}

						}

					}

					$data_s_meeting = $d_s_meeting;

				} else {

					$data_s_meeting = [];

				}

				// $value->data_sub_meeting = $data_s_meeting;
				$value->data_s_meeting = $this->detail_submeeting($value->id);

				if (empty($value->status_meeting)) {
					// if ($value->date < date('Y-m-d')) {
					// 	$value->meeting_status = 'Selesai';
					// 	$value->warna = 'bg-primary';
					// } else {
					// 	$value->meeting_status = 'Dalam Proses';
					// 	$value->warna = 'bg-light-green';
					// }
					$value->meeting_status = 'Dalam Proses';
					$value->warna = 'bg-light-green';
				} else if ($value->status_meeting == 1) {
					$value->meeting_status = 'Selesai';
					$value->warna = 'bg-primary';
				}

			}

			return $data;

		}

	}

	public function tampil($id_meeting = null, $status_meeting = null, $id_user = null, $tanggal = null, $web = null)
	{

		if (!empty($id_meeting)){
			$this->db->where('id', $id_meeting);
		}

		if (!empty($web)) {
			if (!empty($status_meeting)) {
				$this->db->where('status_meeting', $status_meeting);
			} else {
				$this->db->where('status_meeting', null);
			}
		}

		if (!empty($id_user)) {
			$this->db->where('id_user', $id_user);
		}

		if (!empty($tanggal)) {
			$this->db->where('date >=', $tanggal.'-01')
					 ->where('date <=', $tanggal.'-31');
		}

		$data = $this->db->order_by('id', 'desc')
						 ->get('meeting')
						 ->result();

		# data flag / member tim
		$flag_member = $this->db->get_where('team', ['id_user'=>$id_user])->result();

		if (!empty($flag_member)) {
			foreach ($flag_member as $key => $fm) {
				$user_flag = $this->db->get_where('users', ['id'=>$fm->id_member])->first_row();
				if (!empty($user_flag)) {
					$tag[] = $user_flag->username;
				}
			}

			$jumlah_tag = sizeof($tag);

			$tag = implode(',', $tag);
		} else {

			$jumlah_tag = 0;
			$tag = null;
		}

		if (!empty($data)) {
			
			foreach ($data as $key => $value) {

				$value->tag = $tag;
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

				$d_s_meeting = $this->db->get_where('sub_meeting', ['id_meeting'=>$value->id])->result();

				# ambil data sub meeting
				if (!empty($d_s_meeting)) {

					foreach ($d_s_meeting as $key => $dsm) {
						
						if (!empty($dsm->id_file)) {
							
							$dsm->tag = $tag;
							$dsm->count_members = sizeof($member_group);
							$dsm_data_file = $this->db->get_where('file', ['id'=>$dsm->id_file])->first_row();
							if (!empty($dsm_data_file)) {
								$dsm->file = base_url().'assets/file/'.$dsm_data_file->file;
							}

						}

					}

					$data_s_meeting = $d_s_meeting;

				} else {

					$data_s_meeting = [];

				}

				// $value->data_sub_meeting = $data_s_meeting;
				$value->data_s_meeting = $this->detail_submeeting($value->id);

				if (empty($value->status_meeting)) {
					$value->meeting_status = 'Dalam Proses';
					$value->warna = 'bg-light-green';
				} else if ($value->status_meeting == 1) {
					$value->meeting_status = 'Selesai';
					$value->warna = 'bg-primary';
				}

			}

			return $data;

		}

	}

	public function tampil_v2($id_meeting = null, $status_meeting = null, $id_user = null, $tanggal = null, $web = null)
	{

		if (!empty($id_meeting)){
			$this->db->where('id', $id_meeting);
		}

		if (!empty($status_meeting)) {
			$this->db->where('status_meeting', $status_meeting);
		} else {
			$this->db->where('status_meeting', null);
		}

		// if (!empty($id_user)) {
		// 	$this->db->where('id_user', $id_user);
		// }

		if (!empty($tanggal)) {
			$this->db->where('date >=', $tanggal.'-01')
					 ->where('date <=', $tanggal.'-31');
		}

		$data = $this->db->select('meeting.*')
						 ->join('team', 'team.id_group=meeting.id_group')
						 ->where('team.id_member', $id_user)
						 ->order_by('meeting.id', 'desc')
						 ->get('meeting')
						 ->result();

		if (!empty($data)) {
			
			foreach ($data as $key => $value) {

				// $value->tag = $tag;
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
											 ->distinct()
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

				# ambil data sub meeting
				$value->data_s_meeting = $this->detail_submeeting($value->id);

				if (empty($value->status_meeting)) {
					$value->meeting_status = 'Dalam Proses';
					$value->warna = 'bg-light-green';
				} else if ($value->status_meeting == 1) {
					$value->meeting_status = 'Selesai';
					$value->warna = 'bg-primary';
				}

			}

			return $data;

		}

	}

	public function detail_submeeting($id_meeting)
	{

		$data = $this->db->where('id_meeting', $id_meeting)
						 ->order_by('id', 'desc')
						 ->get('sub_meeting')
						 ->result();


		if (!empty($data)) {
			
			foreach ($data as $key => $value) {

				// $value->tag = $tag;
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

				if (empty($value->status_meeting)) {
					$value->meeting_status = 'Dalam Proses';
					$value->warna = 'bg-light-green';
				} else if ($value->status_meeting == 1) {
					$value->meeting_status = 'Selesai';
					$value->warna = 'bg-info';
				}

			}

			return $data;

		} else {
			return [];
		}

	}

	public function tampil_per_staff($id_meeting = null, $status_meeting = null, $id_user = null, $tanggal = null)
	{

		# cek jika si user staf memiliki 2 tim
		$cek_tim = $this->db->get_where('team', ['id_member'=>$id_user])->result();

		if (empty($cek_tim)) {
			return null;
		} else {

			$id_user_manajer = $this->db->get_where('team', ['id_user'=>$cek_tim[0]->id_user])->result();

			if (!empty($id_meeting)){
				$this->db->where('id', $id_meeting);
			}

			if (!empty($status_meeting)) {
				$this->db->where('status_meeting', $status_meeting);
			} else {
				$this->db->where('status_meeting', null);
			}

			if (!empty($tanggal)) {
				$this->db->where('date >=', $tanggal.'-01')
						 ->where('date <=', $tanggal.'-31');
			}

			foreach ($cek_tim as $key => $ct) {
				$id_group[] = $ct->id_group;
			}

			$this->db->where_in('id_group', $id_group);

			$data = $this->db->order_by('created_at', 'desc')
							 ->get('meeting')
							 ->result();

		}

		# total member dalam tim
		if (!empty($id_user_manajer)) {
			$total_member = sizeof($id_user_manajer);
		} else {
			$total_member = null;
		}

		if (!empty($data)) {
			
			foreach ($data as $key => $value) {

				$value->count_members = $total_member;

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
				$value->data_s_meeting = $this->detail_submeeting($value->id);

			}

			return $data;

		}

	}

	public function tampil_per_staff_v2($id_meeting = null, $status_meeting = null, $id_user = null, $tanggal = null)
	{

		# cek jika si user staf memiliki 2 tim
		$cek_tim = $this->db->get_where('team', ['id_member'=>$id_user])->result();

		if (empty($cek_tim)) { echo "string";
			return null;
		} else {

			$id_user_manajer = $this->db->get_where('team', ['id_user'=>$cek_tim[0]->id_user])->result();

			foreach ($cek_tim as $key => $ct) {
				
				if (!empty($id_meeting)){
					$this->db->where('id', $id_meeting);
				}

				if (!empty($status_meeting)) {
					$this->db->where('status_meeting', $status_meeting);
				} else {
					$this->db->where('status_meeting', null);
				}

				if (!empty($id_user)) {
					$this->db->where('id_user', $ct->id_user);
				}

				if (!empty($tanggal)) {
					$this->db->where('date >=', $tanggal.'-01')
							 ->where('date <=', $tanggal.'-31');
				}

				$cek_data = $this->db->order_by('id', 'desc')
								 ->get('meeting')
								 ->result();

				if (!empty($cek_data)) {
					$data[] = $cek_data;
				}

			}

		}

		# total member dalam tim
		if (!empty($id_user_manajer)) {
			$total_member = sizeof($id_user_manajer);
		} else {
			$total_member = null;
		}

		if (!empty($data)) {
			
			foreach ($data[0] as $key => $value) {

				$value->count_members = $total_member;

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
				$value->data_s_meeting = $this->detail_submeeting($value->id);

			}

			return $data[0];

		}

	}

	public function tampil_semua($input)
	{
		
		if (!empty($input['id_meeting'])) {

			$data = $this->db->get_where('meeting', ['id'=>$input['id_meeting']])->result();
			if (!empty($data)) {
				foreach ($data as $key => $value) {
					$value->nama_group = null;
					if (!empty($value->id_group)) {
						$nama_group = $this->db->get_where('group_team', ['id'=>$value->id_group])->first_row();
						$value->nama_group = $nama_group->nama_team;
					}
				}
			}

		} else {

			if (!empty($input['tanggal'])) {
				$tgl_awal  = $input['tanggal'].'-01';
				$tgl_akhir = $input['tanggal'].'-31';
				$this->db->where('created_at >= ', $tgl_awal);
				$this->db->where('created_at <= ', $tgl_akhir);
			}

			if ($input['status_meeting'] == 1) {
				$this->db->where('status_meeting', 1);
			} else {
				// $this->db->where_in('status_meeting', [null, 0]);
				$this->db->where('status_meeting', null);
				$this->db->or_where('status_meeting', 0);
			}

			$data = $this->db->order_by('created_at', 'desc')->get('meeting')->result();
			
		}

		if (!empty($data)) {
			
			foreach ($data as $key => $value) {

				$value->nama_group = null;
				if (!empty($value->id_group)) {
					$nama_group = $this->db->get_where('group_team', ['id'=>$value->id_group])->first_row();
					$value->nama_group = $nama_group->nama_team;
				}

				$total_member = $this->db->get_where('meeting', ['id_group'=>$value->id_group])->result();
				$total_member = sizeof($total_member);

				$value->count_members = $total_member;

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
				$value->data_s_meeting = $this->detail_submeeting($value->id);

			}

			return $data;

		}

	}

	public function tampil_submeeting($id_user = null, $id_meeting = null, $id_sub_meeting = null, $status_meeting = null, $web = null)
	{

		if (!empty($id_sub_meeting)){
			
			$this->db->where('sub_meeting.id', $id_sub_meeting);

		}

		if (!empty($web)) {
			if (!empty($status_meeting)) {
				$this->db->where('status_meeting', $status_meeting);
			} else {
				$this->db->where('status_meeting', null);
			}
		}

		if (!empty($status_meeting)){

			$this->db->where('sub_meeting.status_meeting', $status_meeting);

		} else {
			$this->db->where('sub_meeting.status_meeting', null);
		}

		$data = $this->db->select('sub_meeting.*, booking.code_room, booking.code_transport')
						 ->join('booking', 'booking.id=sub_meeting.id_booking')
						 ->order_by('sub_meeting.id', 'desc')
						 ->get('sub_meeting')->result();

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

	public function tampil_submeeting_web($id_user = null, $id_meeting = null, $id_sub_meeting = null, $status_meeting = null, $web = null)
	{

		if (!empty($id_sub_meeting)){
			
			$this->db->where('sub_meeting.id', $id_sub_meeting);

		}

		if (!empty($web)) {
			if (!empty($status_meeting)) {
				$this->db->where('status_meeting', $status_meeting);
			} else {
				$this->db->where('status_meeting', null);
			}
		}

		$data = $this->db->select('sub_meeting.id as id_sub_meeting, sub_meeting.*, booking.code_room, booking.code_transport')
						 ->join('booking', 'booking.id=sub_meeting.id_booking')
						 ->order_by('sub_meeting.id', 'desc')
						 ->get('sub_meeting')->result();

		if (!empty($data)) {
			
			foreach ($data as $key => $value) {

				$value->date = tgl_indo($value->date);

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
					$member_group = $this->db->select('u.*')
											 ->join('users u', 'u.id=team.id_member')
											 ->where('team.id_group', $value->id_group)
											 ->where('team.id_member !=', $_SESSION['user_data']->id)
											 ->get('team')
											 ->result();
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
					// if ($value->date < date('Y-m-d')) {
					// 	$value->meeting_status = 'Selesai';
					// 	$value->warna = 'bg-primary';
					// } else {
					// 	$value->meeting_status = 'Dalam Proses';
					// 	$value->warna = 'bg-light-green';
					// }
					$value->meeting_status = 'Dalam Proses';
					$value->warna = 'bg-light-green';
				} else if ($value->status_meeting == 1) {
					$value->meeting_status = 'Selesai';
					$value->warna = 'bg-primary';
				}

			}

			// echo "<pre>";
			// print_r($data);
			// die();

			return $data;

		}

	}

	public function tambah($data){

		$this->db->insert('meeting',$data);
		$success = $this->db->affected_rows();

		if($success){

			$insert_id = $this->db->insert_id();
			$user_tag = explode(',', $data['tag']);
			
			for ($i=0; $i < sizeof($user_tag); $i++) { 
				$data_member = [
					'user'    => trim($user_tag[$i]),
					'id_meeting' => $data['id']
				];
				$this->db->insert('member_meeting', $data_member);
			}

			$data = $this->db->get_where('meeting', ['id'=>$data['id']])->first_row();
			$data->file = null;
			if (!empty($data->id_file)) {
				$d_file = $this->db->get_where('file', ['id'=>$data->id_file])->first_row();
				if (!empty($d_file)) {
					$data->file = base_url().'assets/file/'.$d_file->file;
				}
			}

			// $data = $this->db->select('meeting.*, file.file')
			// 				 ->from('meeting')
			// 				 ->join('file', 'file.id=meeting.id_file')
			// 				 ->where('meeting.id', $data['id'])
			// 				 ->get()
			// 				 ->first_row();
			return $data;

		}

	}

	public function tambah_v2($data){

		$this->db->insert('meeting',$data);
		$success = $this->db->affected_rows();

		if($success){

			$insert_id = $this->db->insert_id();
			$user_tag = explode(',', $data['tag']);
			
			for ($i=0; $i < sizeof($user_tag); $i++) { 
				$data_member = [
					'user'       => trim($user_tag[$i]),
					'id_meeting' => $data['id']
				];
				$this->db->insert('member_meeting', $data_member);
			}

			$data = $this->db->get_where('meeting', ['id'=>$data['id']])->first_row();

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

	public function tambah_file($data){

		$this->db->insert('file',$data);
		$success = $this->db->affected_rows();

		if($success){

			$insert_id = $this->db->insert_id();
			$data = $this->db->get_where('file',array('id' => $insert_id))->first_row();
			return $data;

		}

	}

	public function add_comment($data)
	{

		$this->db->insert('comment_meeting',$data);
		$success = $this->db->affected_rows();

		if($success){

			$insert_id = $this->db->insert_id();

			$data = $this->db->get_where('comment_meeting', ['id'=>$insert_id])->first_row();
			return $data;

		}

	}

	public function add_comment_sub_meeting($data)
	{

		$this->db->insert('comment_sub_meeting',$data);
		$success = $this->db->affected_rows();

		if($success){

			$insert_id = $this->db->insert_id();

			$data = $this->db->get_where('comment_sub_meeting', ['id'=>$insert_id])->first_row();
			return $data;

		}

	}


}

/* End of file Model_meeting.php */
/* Location: ./application/models/Model_meeting.php */