<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_booking extends CI_Model {

	public function create_booking($data)
	{

		$this->db->insert('booking',$data);
		$success = $this->db->affected_rows();

		if($success){

			$insert_id = $this->db->insert_id();

			return $this->db->get_where('booking', ['id'=>$insert_id])->result();

		}

	}

}

/* End of file Model_booking.php */
/* Location: ./application/models/Model_booking.php */