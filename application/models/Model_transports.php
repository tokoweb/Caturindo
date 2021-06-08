<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_transports extends CI_Model {

	public function tampil_data()
	{

		$data = $this->db->order_by('id', 'desc')->get('transports')->result();

		foreach ($data as $key => $value) {

			$gambar = $this->db->get_where('image_transports', ['code_transport'=>$value->id])->result();

			if (!empty($gambar)) {

				$image = [];
				$id_gambar = [];
				foreach ($gambar as $key => $g) {
					$image[] = base_url().'assets/gambar/'.$g->image;
					$id_gambar[] = $g->id;
				}
				$value->gambar = $image;
				$value->id_gambar = $id_gambar;

			} else {
				$value->gambar = null;
				$value->id_gambar = null;
			}

		}

		return $data;

	}

	public function tampil_tersedia($date=null, $meeting_mulai=null, $meeting_selesai=null)
	{

		$hasil = [];

		$d_ruangan = $this->db->get('transports')->result();

		if (!empty($d_ruangan)) {

			foreach ($d_ruangan as $key => $value) {

				$d_booking = $this->db->where('code_transport', $value->id)
									  ->where('date', $date)
									  ->get('booking')
									  ->result();

				if (empty($d_booking)) {
					
					$hasil[] = [
						'id' => $value->id,
						'name_transport' => $value->name_transport,
						'due_time'       => null,
						'max_people'     => $value->max_people
					];

				} else {

					for ($i=0; $i<count($d_booking); $i++) {

						if (!empty($meeting_mulai && !empty($meeting_selesai))) {
							
							/* Jam tersedia sebelum waktu booking lain */
							if (
								$meeting_mulai < $d_booking[$i]->time_start 
								&& 
								$meeting_selesai <= $d_booking[$i]->time_start
							) {

								$hasil[] = [
									'id' => $value->id,
									'name_transport' => $value->name_transport,
									'due_time'     => $d_booking[$i]->time_start.' - '.$d_booking[$i]->time_end,
									'max_people'   => $value->max_people
								];

							} else if(
								$meeting_mulai >= $d_booking[$i]->time_end 
								&&
								$meeting_selesai > $d_booking[$i]->time_end
							) {

								$hasil[] = [
									'id' => $value->id,
									'name_transport' => $value->name_transport,
									'due_time'       => $d_booking[$i]->time_start.' - '.$d_booking[$i]->time_end,
									'max_people'     => $value->max_people
								];

							}

						}
						
					} # for

				}

			} # foreach

			# menghilangkan data yang dobel
			if (!empty($hasil)) {
				for ($i=0; $i < sizeof($hasil); $i++) { 
					if (!empty($hasil[$i-1])) {
						if ($hasil[$i-1]['name_transport'] == $hasil[$i]['name_transport']) {
							unset($hasil[$i]);
						}
					}
				}
			}

			return $hasil;

		}

	}

	public function tampil_tersedia_v2($date=null, $meeting_mulai=null, $meeting_selesai=null)
	{

		$sql = "SELECT DISTINCT code_transport FROM booking
				WHERE 
				DATE = '$date'
				AND code_transport IS NOT NULL 
				AND time_start <= '$meeting_mulai'
				AND time_end >= '$meeting_selesai'
				OR
				DATE = '$date'
				AND code_transport IS NOT NULL 
				AND time_start >= '$meeting_mulai'
				AND time_end <= '$meeting_selesai'
				OR
				DATE = '$date'
				AND code_transport IS NOT NULL 
				AND time_start >= '$meeting_mulai'
				AND time_start <= '$meeting_selesai'";

		$cek_waktu_tersedia = $this->db->query($sql)->result();

		if (!empty($cek_waktu_tersedia)) {

			foreach ($cek_waktu_tersedia as $key => $value) {
				$this->db->where('id !=', $value->code_transport);
			}
			
		}

		$hasil = $this->db->get('transports')->result_array();

		return $hasil;

	}	

}

/* End of file Model_transports.php */
/* Location: ./application/models/Model_transports.php */