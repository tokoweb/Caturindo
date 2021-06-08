<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_rooms extends CI_Model {

	public function tampil_data()
	{

		$data = $this->db->order_by('code_room', 'desc')->get('rooms')->result();

		foreach ($data as $key => $value) {

			$gambar = $this->db->get_where('image_rooms', ['code_room'=>$value->code_room])->result();

			if (!empty($gambar)) {

				// if (!empty($gambar)) {
					$image = [];
					$id_gambar = [];
					foreach ($gambar as $key => $g) {
						$image[] = base_url().'assets/gambar/'.$g->image;
						$id_gambar[] = $g->id;
					}
					$value->gambar = $image;
					$value->id_gambar = $id_gambar;
					
				// } else {
				// 	$value->gambar = null;
				// 	$value->id_gambar = null;
				// }

			} else {
				$value->gambar = null;
				$value->id_gambar = null;
			}

		}

		return $data;

	}

	public function tampil_ruangan_tersedia($date=null, $meeting_mulai=null, $meeting_selesai=null)
	{

		$hasil = [];

		$d_ruangan = $this->db->get('rooms')->result();

			foreach ($d_ruangan as $key => $value) {

				$d_booking = $this->db->where('code_room', $value->code_room)
									  ->where('date', $date)
									  ->get('booking')
									  ->result();

				if (empty($d_booking)) {

					$hasil[] = [
						'code_room'    => $value->code_room,
						'name_ruangan' => $value->name_room,
						'due_time'     => null,
						'max_people'   => $value->max_people
					]; 

				} else {

					for ($i=0; $i<count($d_booking); $i++) {

						if (!empty($meeting_mulai) && !empty($meeting_selesai)) {
							
							/* Jam tersedia sebelum waktu booking lain */
							if (
								$meeting_mulai < $d_booking[$i]->time_start 
								&& 
								$meeting_selesai <= $d_booking[$i]->time_start
							) {

								$hasil[] = [
									'code_room'    => $value->code_room,
									'name_ruangan' => $value->name_room,
									'due_time'     => $d_booking[$i]->time_start.' - '.$d_booking[$i]->time_end,
									'max_people'   => $value->max_people
								];

							} else if(
								$meeting_mulai >= $d_booking[$i]->time_end 
								&&
								$meeting_selesai > $d_booking[$i]->time_end
							) {

								$hasil[] = [
									'code_room'    => $value->code_room,
									'name_ruangan' => $value->name_room,
									'due_time'     => $d_booking[$i]->time_start.' - '.$d_booking[$i]->time_end,
									'max_people'   => $value->max_people
								];

							}

						}
						
					} # for

				}

			} # foreach

		return $hasil;

	}

	public function tampil_ruangan_tersedia_v2($date=null, $meeting_mulai=null, $meeting_selesai=null)
	{

		$hasil = [];
		
		$d_ruangan = $this->db->get('rooms')->result();

			foreach ($d_ruangan as $key => $value) {

				$d_booking = $this->db->where('code_room', $value->code_room)
									  ->where('date', $date)
									  ->get('booking')
									  ->result();

				if (empty($d_booking)) {

					$due_time[] = '07:00:00 - 18:00:00';

				} else {

					for ($i=0; $i<count($d_booking); $i++) {

						if (!empty($meeting_mulai) && !empty($meeting_selesai)) {
							
							# Jam tersedia sebelum waktu booking lain
							if (
								$meeting_mulai < $d_booking[$i]->time_start 
								&& 
								$meeting_selesai <= $d_booking[$i]->time_start
							) {

								$due_time[] = $d_booking[$i]->time_start.' - '.$d_booking[$i]->time_end;

							} else if(
								$meeting_mulai >= $d_booking[$i]->time_end 
								&&
								$meeting_selesai > $d_booking[$i]->time_end
							) {

								$due_time[] = $d_booking[$i]->time_start.' - '.$d_booking[$i]->time_end;
								
							}

						}
						
					} # for

				}

				$hasil[] = [
					'code_room'    => $value->code_room,
					'name_ruangan' => $value->name_room,
					'due_time'     => $due_time,
					'max_people'   => $value->max_people
				];

			} # foreach

		# menghilangkan data yang dobel
		if (!empty($hasil)) {
			for ($i=0; $i < sizeof($hasil); $i++) { 
				if (!empty($hasil[$i-1])) {
					if ($hasil[$i-1]['name_ruangan'] == $hasil[$i]['name_ruangan']) {
						unset($hasil[$i]);
					}
				}
			}
		}

		return $hasil;

	}

	public function tampil_ruangan_tersedia_v3($date=null, $meeting_mulai=null, $meeting_selesai=null)
	{

		$hasil = $this->db->select('rooms.name_room as name_ruangan, rooms.*')->get('rooms')->result_array();

		if (empty($hasil)) {
			return 'kosong';
		}

		$sql = "SELECT DISTINCT code_room FROM booking
				WHERE 
				DATE = '$date'
				AND code_room IS NOT NULL 
				AND time_start <= '$meeting_mulai'
				AND time_end >= '$meeting_selesai'
				OR
				DATE = '$date'
				AND code_room IS NOT NULL 
				AND time_start >= '$meeting_mulai'
				AND time_end <= '$meeting_selesai'
				OR
				DATE = '$date'
				AND code_room IS NOT NULL 
				AND time_start >= '$meeting_mulai'
				AND time_start <= '$meeting_selesai'";

		$cek_waktu_tersedia = $this->db->query($sql)->result();

		if (!empty($cek_waktu_tersedia)) {

			foreach ($cek_waktu_tersedia as $key => $value) {
				$this->db->where('code_room !=', $value->code_room);
			}
			
		}

		$hasil = $this->db->select('rooms.name_room as name_ruangan, rooms.*')->get('rooms')->result_array();

		return $hasil;

	}

	public function ruangan_detail($id_room)
	{

		return $this->db->get_where('rooms', ['code_room'=>$id_room])->result_array();

	}

}

/* End of file Model_rooms.php */
/* Location: ./application/models/Model_rooms.php */