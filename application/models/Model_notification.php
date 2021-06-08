<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_notification extends CI_Model {

	public function tambah($insert)
	{

		$this->db->insert('notification', $insert);
		$success = $this->db->affected_rows();

		if($success){

			$insert_id = $this->db->insert_id();
			$data = $this->db->get_where('notification',['id' => $insert_id])->first_row();
			return $data;

		}

	}

}

/* End of file Model_notification.php */
/* Location: ./application/models/Model_notification.php */