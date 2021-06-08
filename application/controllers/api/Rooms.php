<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Rooms extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_rooms');
	}

	public function index_get()
	{
		
		$id_room        = $this->get('id');
		// $status_booking = $this->get('status_booking');
		$date            = $this->get('date');
		$meeting_mulai   = $this->get('time_start');
		$meeting_selesai = $this->get('time_end');

		if (!empty($date) && $date < date('Y-m-d')) {
			
			$this->response([
				'status'  => false,
				'message' => 'Tidak dapat ditampilkan untuk jadwal hari kemarin',
				'data'    => []
			], 200);

		}

		if (!empty($id_room)) {

			$hasil = $this->model_rooms->ruangan_detail($id_room);

		} else {

			$hasil = $this->model_rooms->tampil_ruangan_tersedia_v3($date, $meeting_mulai, $meeting_selesai);

		}
		
		if (!empty($hasil)){

			if ($hasil == 'kosong') {
				
				$this->response([
					'status'  => false,
					'message' => 'Data ruangan belum tersedia',
					'data'    => []
				], 200);

			} else {

				for ($y=0; $y<sizeof($hasil); $y++) {

					$data_gambar = $this->db->get_where('image_rooms', ['code_room'=>$hasil[$y]['code_room']])->result();

					$gambar = null;
					if (!empty($data_gambar)) {
						
						foreach ($data_gambar as $key => $dr) {
							$gambar[] = base_url().'assets/gambar/'.$dr->image;
						}	

					}
					$hasil[$y]['image'] = $gambar;

				}

				$this->response([
					'status'  => true,
					'message' => 'Berhasil mendapatkan data ruangan',
					'data'    => $hasil
				], 200);

			}

		} else {

			$this->response([
				'status'  => false,
				'message' => 'Seluruh ruangan sudah di booking',
				'data'    => []
			], 200);

		}

	}

}

/* End of file Rooms.php */
/* Location: ./application/controllers/api/Rooms.php */