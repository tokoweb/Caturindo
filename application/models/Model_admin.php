<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_admin extends CI_Model {


	public function get_users()
	{
		return $this->db->get('users');
	}

	public function get_pengajar()
	{
		return $this->db->query("SELECT a.*, b.username, b.email FROM pengajar a, users b WHERE a.id_pengajar = b.id_user");
	}

	public function tampil_user()
	{

		$data = $this->db->where('id!=2')
						->order_by('id', 'desc')
						->get('users')->result();

		foreach ($data as $key => $value) {

			if (!empty($value->role)) {

				$status = $this->db->get_where('user_role', ['id'=>$value->role])->first_row();
				$value->status = $status->role;

			} else {

				$value->status = null;

			}
		}

		return $data;

	}

	public function jumlah_mata_pelajaran()
	{
		$this->db->select('*');
		$this->db->from('mata_pelajaran');
		$this->db->where('id_mata_pelajaran != 0');
		return $this->db->get();
	}

	public function jumlah_ruang_kelas()
	{
		$this->db->select('*');
		$this->db->from('ruang_kelas');
		$this->db->where('id_ruang_kelas != 0');
		return $this->db->get();
	}

	public function get_pemesanan()
	{
			return $this->db->query("SELECT a.id_pemesanan, b.nama_status_pemesanan, c.nama_status_pembayaran, d.nama_pengajar, e.nama_siswa, f.mata_pelajaran,
				a.id_order_midtrans, a.tanggal_pemesanan, a.jam_pemesanan, a.tanggal_belajar, a.jam_belajar, g.nama_tipe_les, a.alamat_pin_lokasi, a.harga, d.nama_bank, d.no_rekening_bank
				FROM pemesanan a, status_pemesanan b, status_pembayaran c, pengajar d, siswa e, mata_pelajaran f, tipe_les g
				WHERE a.id_status_pemesanan = b.id_status_pemesanan
				AND a.id_status_pembayaran = c.id_status_pembayaran
				AND a.id_pengajar = d.id_pengajar
				AND a.id_siswa = e.id_siswa
				AND a.id_mata_pelajaran = f.id_mata_pelajaran
				AND a.id_tipe_les = g.id_tipe_les");
	}

	public function do_login($email, $pass)
	{
		$query = $this->db->select('*');
		$array = array('email' => $email, 'password' => $pass);
		$query = $this->db->where($array);
		$query = $this->db->get('users');
		return $query;
	}

	public function login($email, $password, $user = null)
	{

		if (!empty($user)) {
			$where = [
				'email' => $email,
				'role'  => 2
			];
		} else {
			$where = [
				'email' => $email,
				'role'  => 1
			];
		}

		$cek = $this->db->get_where('users', $where)->first_row();

		if (!empty($cek)) {
			$password_db = $cek->password;

			if (password_verify($password, $password_db)) {
				return $cek;
			}

		} else {
			return false;
		}

	}

	public function cek_cookie($cookie = null)
	{

		if (!empty($cookie)) {
			$cek = $this->db->get_where('users', ['cookie'=>$cookie])->first_row();

			if (!empty($cek)) {

				$data = array(
					'admin_id'    => $cek->id,
				    'admin_user'  => $cek->email,
				    'admin_valid' => TRUE
				);
				$this->session->set_userdata('user_data', $cek);
				return true;

			}
		}

	}

	public function insert_user($object)
	{
		$this->db->insert('users', $object);
	}

	public function edit_user($id)
	{
		return $this->db->get_where('users',array('user_id'=>$id));
	}

	public function update_user($id, $object)
	{
		$this->db->where('user_id', $id);
		$this->db->update('users', $object);
	}

	public function delete_users($id)
	{
		return $this->db->delete('users', array('user_id' => $id));
	}
}
