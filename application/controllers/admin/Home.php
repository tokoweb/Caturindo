<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->model('model_admin');
		if($this->session->userdata('admin_valid') != TRUE )
			redirect("index.php/login");
	}

	function index(){

		/*
		$a['siswa']	= $this->model_admin->jumlah_siswa()->num_rows();
		$a['pengajar'] = $this->model_admin->jumlah_pengajar()->num_rows();
		$a['mata_pelajaran'] = $this->model_admin->jumlah_mata_pelajaran()->num_rows();
		$a['ruang_kelas'] = $this->model_admin->jumlah_ruang_kelas()->num_rows();
		*/
		$a['users']      =  $this->db->where('id!=2')->get('users')->num_rows();
		$a['meetings']   =  $this->db->get('meeting')->num_rows();
		$a['tasks']      =  $this->db->get('task')->num_rows();
		$a['transports'] =  $this->db->get('transports')->num_rows();
		$a['page']	     = "home";

		$this->load->view('admin/index', $a);
	}

	function siswa(){
		$a['data']	= $this->model_admin->get_siswa()->result_object();
		$a['page']	= "siswa";

		$this->load->view('admin/index', $a);
	}

	function pengajar(){
		$a['data']	= $this->model_admin->get_pengajar()->result_object();
		$a['page']	= "pengajar";

		$this->load->view('admin/index', $a);
	}

	function mata_pelajaran(){
		$a['data']	= $this->model_admin->jumlah_mata_pelajaran()->result_object();
		$a['page']	= "mata_pelajaran";

		$this->load->view('admin/index', $a);
	}

	function ruang_kelas(){
		$a['data']	= $this->model_admin->jumlah_ruang_kelas()->result_object();
		$a['page']	= "ruang_kelas";

		$this->load->view('admin/index', $a);
	}

	function pemesanan(){
		$a['data']	= $this->model_admin->get_pemesanan()->result_object();
		$a['page']	= "pemesanan";

		$this->load->view('admin/index', $a);
	}

	/* Fungsi Jenis Surat */
	function jenis_surat(){
		$a['data']	= $this->model_admin->tampil_jenis()->result_object();
		$a['page']	= "jenis_surat";

		$this->load->view('admin/index', $a);
	}

	function tambah_jenis(){
		$a['page']	= "tambah_jenis_surat";

		$this->load->view('admin/index', $a);
	}

	function insert_jenis(){

		$jenis = $this->input->post('jenis');
		$object = array(
				'jenis_surat' => $jenis
			);
		$this->db->insert('tb_jenis_surat', $object);

		redirect('admin/jenis_surat','refresh');
	}

	function edit_jenis($id){
		$a['editdata']	= $this->db->get_where('tb_jenis_surat',array('jenis_id'=>$id))->result_object();
		$a['page']	= "edit_jenis_surat";

		$this->load->view('admin/index', $a);
	}

	function update_jenis(){
		$id = $this->input->post('id');
		$jenis = $this->input->post('jenis');
		$object = array(
				'jenis_surat' => $jenis
			);
		$this->db->where('jenis_id', $id);
		$this->db->update('tb_jenis_surat', $object);

		redirect('admin/jenis_surat','refresh');
	}

	function hapus_jenis($id){

		$this->model_admin->hapus_jenis($id);
		redirect('admin/jenis_surat','refresh');
	}


	/* Fungsi Surat Keluar */
	function surat_keluar(){
		$a['data']	= $this->model_admin->tampil_surat_keluar()->result_object();
		$a['page']	= "surat_keluar";

		$this->load->view('admin/index', $a);
	}

	function tambah_surat_keluar(){
		$a['page']	= "tambah_surat_keluar";

		$this->load->view('admin/index', $a);
	}

	function insert_surat_keluar(){

		$jenis = $this->input->post('jenis');
		$no = $this->input->post('no');
		$tgl = $this->input->post('tgl');
		$untuk = $this->input->post('untuk');
		$perihal = $this->input->post('perihal');
		$ket = $this->input->post('ket');
		$object = array(
				'jenis_id' => $jenis,
				'no_surat' => $no,
				'tgl_surat' => $tgl,
				'untuk' => $untuk,
				'perihal' => $perihal,
				'ket' => $ket
			);
		$this->db->insert('tb_surat_keluar', $object);

		redirect('admin/surat_keluar','refresh');
	}

	function edit_surat_keluar($id){
		$a['editdata']	= $this->db->get_where('tb_surat_keluar',array('surat_id'=>$id))->result_object();
		$a['page']	= "edit_surat_keluar";

		$this->load->view('admin/index', $a);
	}

	function update_surat_keluar(){
		$id = $this->input->post('id');
		$jenis = $this->input->post('jenis');
		$no = $this->input->post('no');
		$tgl = $this->input->post('tgl');
		$untuk = $this->input->post('untuk');
		$perihal = $this->input->post('perihal');
		$ket = $this->input->post('ket');
		$object = array(
				'jenis_id' => $jenis,
				'no_surat' => $no,
				'tgl_surat' => $tgl,
				'untuk' => $untuk,
				'perihal' => $perihal,
				'ket' => $ket
			);
		$this->db->where('surat_id', $id);
		$this->db->update('tb_surat_keluar', $object);

		redirect('admin/surat_keluar','refresh');
	}


	function hapus_surat_keluar($id){

		$this->model_admin->hapus_surat_keluar($id);
		redirect('admin/surat_keluar','refresh');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('index.php/login');
	}
}
