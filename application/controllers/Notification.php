<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_notification');
	}

	public function index()
	{
		
	}

	public function reminder_meeting()
	{

		$kemarin   = date('Y-m-d', strtotime("-1 day", strtotime(date("Y-m-d"))));
		$d_meeting = $this->db->where('date > ', date('Y-m-d'))
							  ->get('meeting')
							  ->result();
		$cek = [];

		if (!empty($d_meeting)) {
			
			foreach ($d_meeting as $key => $value) {

				$tgl1 = new DateTime(date('Y-m-d'));
		        $tgl2 = new DateTime($value->date);
		        $cek_hari = $tgl2->diff($tgl1)->days;
				
				if ($cek_hari == 1) {
					
					# kirim ke user si pembuat meeting
					$d_user = $this->db->get_where('users', ['id'=>$value->id_user])->first_row();

					$title_notification = "Reminder meeting ".$value->title." tomorrow ".$value->time." WIB ";

					$pecah_member = explode(',', $value->tag);

					for ($i=0; $i < sizeof($pecah_member); $i++) { 

						$d_member = $this->db->get_where('users', ['username'=>$pecah_member[$i]])->first_row();

						$ambil = [
							'body'  => $value->description,
							'title' => $title_notification,
							'id'    => $d_member->id
						];
						
						#kirim notifikasi ke user masing masing
						if (!empty($d_user->token_firebase)) {

							$cek[] = kirim_notifikasi($d_member->token_firebase, $ambil);

							$d_insert = [
								'id_user'     => $value->id_user,
								'id_user_tag' => $d_member->id,
								'id_meeting'  => $value->id,
								'title'       => $title_notification
							];
							$d_notif = $this->model_notification->tambah($d_insert);

						}

					}

					$ambil = [
						'body'  => $value->description,
						'title' => $title_notification,
						'id'    => $d_member->id
					];

					$cek[] = kirim_notifikasi($d_user->token_firebase, $ambil);

					$d_insert = [
						'id_user'     => $value->id_user,
						'id_user_tag' => $value->id_user,
						'id_meeting'  => $value->id,
						'title'       => $title_notification
					];
					$d_notif = $this->model_notification->tambah($d_insert);

				}

			}

		}

		print_r(json_encode($cek));

	}

	public function reminder_task()
	{

		$tanggal = date('Y-m-d');
		$kemarin = date('Y-m-d', strtotime("-1 day", strtotime(date("Y-m-d"))));
		$d_task = $this->db->where('due_date >', $tanggal)
						   ->get('task')
						   ->result();

		$cek = [];

		if (!empty($d_task)) {
			
			foreach ($d_task as $key => $value) {

				$tgl1 = new DateTime(date('Y-m-d'));
		        $tgl2 = new DateTime($value->due_date);
		        $cek_hari = $tgl2->diff($tgl1)->days;
				echo $value->due_date.' ';

				if ($cek_hari == 1) {
					
					# kirim ke user si pembuat meeting
					$d_user = $this->db->get_where('users', ['id'=>$value->id_user])->first_row();

					$title_notification = "Reminder task ".$value->name_task." tomorrow ".$value->time." WIB ";

					$m_task = $this->db->where('id_task', $value->id)->get('member_task')->result();

					if (!empty($m_task)) {

						foreach ($m_task as $key => $mt) {
							$du = $this->db->get_where('users', ['username'=>$mt->user])->first_row();
							
							if (!empty($du)) {
								
								$ambil = [
									'body'  => $value->description,
									'title' => $title_notification,
									'id'    => $du->id
								];
								
								#kirim notifikasi ke user masing masing
								if (!empty($du->token_firebase)) {

									$cek[] = kirim_notifikasi($du->token_firebase, $ambil);

									$d_insert = [
										'id_user'     => $value->id_user,
										'id_user_tag' => $du->id,
										'id_meeting'  => $value->id,
										'title'       => $title_notification
									];
									$d_notif = $this->model_notification->tambah($d_insert);

								}

							}

						}

					}

					$ambil = [
						'body'  => $value->description,
						'title' => $title_notification,
						'id'    => $value->id_user
					];

					$cek[] = kirim_notifikasi($d_user->token_firebase, $ambil);

					$d_insert = [
						'id_user'     => $value->id_user,
						'id_user_tag' => $value->id_user,
						'id_meeting'  => $value->id,
						'title'       => $title_notification
					];
					$d_notif = $this->model_notification->tambah($d_insert);

				}

			}

		}

		print_r(json_encode($cek));

	}

}

/* End of file Notification.php */
/* Location: ./application/controllers/Notification.php */