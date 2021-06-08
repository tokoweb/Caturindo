<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Booking extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_booking');
	}

	public function index_get()
	{
		echo "string";
	}

	public function create_post()
	{
		
		$id_user        = $this->post('id_user');
		$code_room      = $this->post('code_room');
		$code_transport = $this->post('code_transport');
		$date           = $this->post('date');
		$time_start     = $this->post('time_start');
		$time_end       = $this->post('time_end');
		$note           = $this->post('note');
		$location       = $this->post('location');
		$driver_name    = $this->post('driver_name');

		if ($date < date('Y-m-d')) {
			$this->response([
				'status'  => false,
				'message' => 'tanggal tidak boleh sebelum hari ini',
				'data'    => []
			], 200);
		}

		if (!empty($code_room)) {

			$pesan_terbooking  = 'Maaf Ruangan '.$code_room.' tanggal '.$date;
			$pesan_terbooking .= ' pada jam '.$time_start.' sampai '.$time_end.' telah di booking';

			$sql = "SELECT * FROM booking
				WHERE 
				DATE = '$date'
				-- AND code_transport IS NULL
				AND code_room = '$code_room'
				AND time_start <= '$time_start'
				AND time_end >= '$time_end'
				OR
				DATE = '$date'
				-- AND code_transport IS NULL 
				AND code_room = '$code_room'
				AND time_start >= '$time_start'
				AND time_end <= '$time_end'
				OR
				DATE = '$date'
				-- AND code_transport IS NULL 
				AND code_room = '$code_room'
				AND time_start >= '$time_start'
				AND time_start <= '$time_end'
				";

		} else if(!empty($code_transport)) {

			$pesan_terbooking  = 'Maaf Transport '.$code_transport.' tanggal '.$date;
			$pesan_terbooking .= ' pada jam '.$time_start.' sampai '.$time_end.' telah di booking';

			$sql = "SELECT * FROM booking
				WHERE 
				date = '$date'
				-- AND code_room IS NULL
				AND code_transport = '$code_transport'
				AND time_start <= '$time_start'
				AND time_end >= '$time_end'
				OR 
				date = '$date'
				-- AND code_room IS NULL
				AND code_transport = '$code_transport'
				AND time_start >= '$time_start'
				AND time_end <= '$time_end'
				OR 
				date = '$date'
				-- AND code_room IS NULL
				AND code_transport = '$code_transport'
				AND time_start >= '$time_start'
				AND time_start <= '$time_end'";
		}

		
		if (!empty($sql)) {
			
			$cek_waktu_tersedia = $this->db->query($sql)->result();

			if (!empty($cek_waktu_tersedia)) {
				
				$this->response([
					'status'  => false,
					'message' => $pesan_terbooking,
					'data'    => []
				], 200);

			}

			$data_input = [
				'id_user'        => $id_user,
				'code_room'      => $code_room,
				'code_transport' => $code_transport,
				'date'      	 => $date,
				'time_start'     => $time_start,
				'time_end'       => $time_end,
				'note'      	 => $note,
				'driver_name'    => $driver_name,
				'location'		 => $location,
				'created_at'     => date('Y-m-d H:i:s')
			];

			$data_booking = $this->model_booking->create_booking($data_input);

			if (!empty($data_booking)) {
				
				$this->response([
					'status'  => true,
					'message' => 'Berhasil booking',
					'data'    => $data_booking
				], 200);

			} else {

				$this->response([
					'status'  => false,
					'message' => 'Gagal booking',
					'data'    => []
				], 200);

			}

		} else { // sql kosong

			$this->response([
				'status'  => false,
				'message' => 'Code room atau code transport harus di isi',
				'data'    => []
			], 200);

		}

	}

}

/* End of file Booking.php */
/* Location: ./application/controllers/api/Booking.php */