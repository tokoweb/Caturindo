<?php
class SepNew {

	public $sep = '';

	public $config = '';
	public $method = array('cariPesertaByNik' 		=>	'Peserta/nik/',
		'cariPesertaBpjs' 		=>	'Peserta/nokartu/',
		'buatSep' 				=> 	'SEP/1.1/insert',
		'transaksiSep'			=> 	'SEP/map/trans',
		'hapusSep'				=> 	'SEP/delete',
		'detailSep'				=> 	'SEP/',
		'riwayatKunjungan'		=> 'SEP/peserta/',
		'updatePulang'			=> 'Sep/updtglplg',
		'cariPoli'				=> 'poli/ref/poli',
		'cariPPK'				=> 	'referensi/faskes/',
		'updateSep'				=> 'sep/update',
		'editsep'				=> 'Sep/Update',
		'cariDokter'			=> 	'referensi/faskes/',
		'cariKec'				=> 	'referensi/kecamatan/kabupaten/',
		'cariKab'				=> 	'referensi/kabupaten/propinsi/',
		'cariProv'				=> 	'referensi/propinsi',
		'cariSpe'				=> 	'referensi/spesialistik',
		'cariDoc'				=> 	'referensi/dokter/',
		'cariDpjp'				=> 	'referensi/dokter/pelayanan/',
		'cariRujukan'			=> 	'Rujukan/List/Peserta/',
	);
	public $timestamp = '';
	public $signature = '';

	public function __construct() {
		date_default_timezone_set("Asia/Jakarta");
    }

    public function getConsid(){
    	return $this->consid;
    }

    public function getTimestamp(){
    	return $this->timestamp;
    }

    public function getSignature(){
    	return $this->signature;
    }

	public function generateHeader(){
		 date_default_timezone_set('UTC');
		 $tStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
		 $this->timestamp = $tStamp;
		 $consid = '19944';
		 $secretkey = '6nGW342H9L';

		  // Computes the signature by hashing the salt with the secret key as the key
		 $signature = hash_hmac('sha256', $consid . "&" . $tStamp, $secretkey, true);

		  // base64 encode…
		 $encodedSignature = base64_encode($signature);
		 $this->signature = $encodedSignature;

		 $headers = array(
		      "X-cons-id: " . $consid,
		      "X-timestamp: " . $tStamp,
		      "X-signature: " . $encodedSignature
		 );
		 // print_r($headers);
		 // exit();
		 return $headers;
	}

	public function getMethod($method){

		$availableMethod = $this->method;
		$url = 'https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/';

		if(!array_key_exists($method, $availableMethod)){
			return false;
		}

		return $url.$availableMethod[$method];
	}

	public function getMethodRujukan($method){

		$availableMethod = $this->method;
		$url = 'https://dvlp.bpjs-kesehatan.go.id/vclaim-rest/';

		if(!array_key_exists($method, $availableMethod)){
			return false;
		}

		return $url.$availableMethod[$method];
	}


	public function execute($url, $request=null, $method="POST"){
		$headers = $this->generateHeader();
		// show_array($request);
		// echo $url;
		$ch = curl_init($url);
    // curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		if($request){
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

			curl_setopt($ch, CURLOPT_POSTFIELDS, $request );



		}
		$content = curl_exec($ch);
		if (curl_exec($ch) === false) {
			echo 'Curl error: ' . curl_error($ch);
		} else {
        // echo 'Operation completed without any errors';
		}

		curl_close($ch);
		return $content;
	}

	public function cariPesertaByNik($nik){
		$date = date('Y-m-d');
		$url = $this->getMethod('cariPesertaByNik').$nik.'/tglSEP/'.$date;
		// echo $url;
		return $this->execute($url);
	}

	public function cariPesertaBpjs($no){
		$date = date('Y-m-d');
		// echo $date;
		$url = $this->getMethod('cariPesertaBpjs').$no.'/tglSEP/'.$date;
		//echo $url;
		return $this->execute($url);
	}

	public function cariPPK($nama){

		$url = $this->getMethod('cariPPK').$nama.'/1';
		// echo $url;
		return $this->execute($url);
	}
	public function cariProv(){

		$url = $this->getMethod('cariProv');
		return $this->execute($url);
	}
	public function cariKab($id_prov){

		$url = $this->getMethod('cariKab').$id_prov;
		return $this->execute($url);
	}
	public function cariKec($id_kab){

		$url = $this->getMethod('cariKec').$id_kab;
		return $this->execute($url);
	}
	public function cariSpe(){

		$url = $this->getMethod('cariSpe');
		return $this->execute($url);
	}
	public function cariRujukan($nama){
		$url = $this->getMethodRujukan('cariRujukan').$nama;
		return $this->execute($url);
	}
	public function cariDoc($nama){

		$url = $this->getMethod('cariDoc').$nama;
		return $this->execute($url);
	}public function cariDpjp($jenis,$sep){
		$date = date('Y-m-d');
		$url = $this->getMethod('cariDpjp').$jenis.'/tglPelayanan/'.$date.'/Spesialis/'.$sep;
		// echo $url;
		return $this->execute($url);
	}

	public function createSepInap($noBpjs, $kode_diagnosa, $id_kelas_sep, $lakaLantas, $id_pasien, $lokasi, $now){


		$data = array("noKartu"=>$noBpjs,
			"tglSep" => $now,
			"tglRujukan"=> $now,
			"noRujukan" => '123123123',
			"ppkRujukan" => "1120R005",
			"jnsPelayanan" => "1",
			"ppkPelayanan"=>"1120R005",
			"catatan" => "",
			"diagAwal" => $kode_diagnosa,
			"poliTujuan" => "",
			"klsRawat" => $id_kelas_sep,
			"lakaLantas"=>$lakaLantas,
			"user"=> User::$nama,
			"noMr"=>noRm($id_pasien));
		//jika kecelakaan
		if($lakaLantas == 1){
			$data['lokasiLaka'] = $lokasi;
		}

		$request = json_encode(array("request"=>array("t_sep"=>$data)));


		$url = $this->getMethod('buatSep');
		return $this->execute($url, $request);

	}

	public function insertSep($id_pasien,$no_bpjs, $tglSep,$jenis_pelayanan, $tglRujukan, $noRujukan, $kode_asal_rujukan, $jns_perawatan, $catatan, $kode_diagnosa, $kode_poli_sep, $id_kelas_sep, $lakaLantas,$penjamin,$tgl_laka,$kll,$suplesi,$no_suplesi,$prov,$kab,$kec,$no_skdp,$doc_dpjp,$telp,$eksekutif,$cob,$katarak){

	  // $tgl_rujukan = str_replace('/', '-', $tglRujukan);
	  // $tgl_sep = str_replace('/', '-', $tglSep);

		$data = array( "noKartu" => $no_bpjs,
			"tglSep" => date("Y-m-d", strtotime($tglSep)),
			"ppkPelayanan" => "1120R005",
			"jnsPelayanan" => $jenis_pelayanan,
			"klsRawat" => $id_kelas_sep,
			"noMR" => noRm6digit($id_pasien),
			"rujukan" => array(
				"asalRujukan"=> "1",
				"tglRujukan" => $tglRujukan,
				"noRujukan" =>  $noRujukan,
				"ppkRujukan"=> $kode_asal_rujukan
			),
			"catatan" => $catatan,
			"diagAwal" => $kode_diagnosa,
			"poli" => array(
				"tujuan" =>  $kode_poli_sep,
				"eksekutif" => $eksekutif
			),
			"cob" => array(
				"cob" => $cob
			),
			"katarak" => array(
				"katarak" => $katarak
			),
			"jaminan" => array(
				"lakaLantas" => $lakaLantas,
				"penjamin"=>array(
					"penjamin" => $penjamin,
					"tglKejadian" => date("Y-m-d",strtotime($tgl_laka)),
					"keterangan" => $kll,
					"suplesi" => array(
						"suplesi" => $suplesi,
						"noSepSuplesi" => $no_suplesi,
						"lokasiLaka" => array(
							"kdPropinsi"=> $prov,
							"kdKabupaten" => $kab,
							"kdKecamatan "=> $kec
						)
					)
				)
			),
			"skdp" => array(
				"noSurat" => $no_skdp,
				"kodeDPJP" => $doc_dpjp
			),
			"noTelp" => $telp,
			"user" => User::$nama);





		$request = json_encode(array("request"=>array("t_sep"=>$data)));
		//
		 //  	show_array($request);
			// exit();


		$url = $this->getMethod('buatSep');
		return $this->execute($url, $request);


	}

	public function updateSep($no_sep){

		$response = $this->getDetailSep($no_sep);
		$object = json_decode($response);
		// $this->deleteSep($no_sep);
		$data = array("noKartu" => $object->response->peserta->noKartu,
			"tglSep" => $object->response->tglSep.' 07:00:00',
			"ppkPelayanan" => "1120R005",

			"catatan" => $object->response->catatan,
			"diagAwal" => $object->response->diagAwal->kdDiag,
			"poliTujuan" => null,
			"klsRawat" => $object->response->klsRawat->kdKelas,
			"lakaLantas" => ($object->response->lakaLantas->status == 0?'2':'1'),
			"noMr" => $object->response->peserta->noMr,
			"tglRujukan"=> null,
			"noRujukan" => '12313',
			"ppkRujukan" => '1120R005',
			"jnsPelayanan" => '1',
			"user"=> User::$nama
		);



		$request = json_encode(array("request"=>array("t_sep"=>$data)));

		// echo $request;


		$url = $this->getMethod('buatSep');
		return $this->execute($url, $request);


	}

	public function getRiwayatKunjungan($no_peserta){
		$url = $this->getMethod('riwayatKunjungan').$no_peserta;
		// echo $url;
		return $this->execute($url);

	}

	public function insertTransaksiSep($no_sep, $id_billing){

		$data = array("noSep"=>$no_sep,
			"noTrans"=>$id_billing,
			"ppkPelayanan"=>"1120R005");
		$request = json_encode(array("request"=>array("t_map_sep"=>$data)));


		$url = $this->getMethod('transaksiSep');
		return $this->execute($url, $request);


	}

	public function updatePulang($no_sep, $tgl_pulang){

		$data = array("noSep"=>$no_sep,
			"tglPlg"=>$tgl_pulang,
			"ppkPelayanan"=>"1120R005");
		$request = json_encode(array("request"=>array("t_sep"=>$data)));


		$url = $this->getMethod('updatePulang');
		return $this->execute($url, $request);


	}
	public function cariPoli(){
		$url = $this->getMethod('cariPoli');

		return $this->execute($url);
	}

	public function deleteSep($no_sep){
		$data = array(
			"noSep"=>$no_sep,
			"user"=> "RS"
		);
		$request = json_encode(array("request"=>array("t_sep"=>$data)));
	 // show_array($request);
		$url = $this->getMethod('hapusSep');
		return $this->execute($url, $request, "DELETE");


	}



	public function getDetailSep($no_sep){
		$url = $this->getMethod('detailSep').$no_sep;

		return $this->execute($url);
	}
	public function editsep($nosep,$kelasrawat,$norm,$asalrujukan,$tglRujukan,$noRujukan,$ppkRujukan,$catatan,$diagnosa,$lakaLantas,$noTelp){


		$data = array(
			"noSep"=>$nosep,
			"klsRawat"=>$kelasrawat,
			"noMR"=> noRm6digit($norm),
			"rujukan"=> array(
				"asalRujukan"=> $asalrujukan,
				"tglRujukan"=> date("Y-m-d H:i:s",strtotime($tglRujukan)),
				"noRujukan"=> $noRujukan,
				"ppkRujukan"=> $ppkRujukan
			),
			"catatan"=> $catatan,
			"diagAwal"=> $diagnosa,
			"poli"=> array(
				"eksekutif"=> "0"
			),
			"cob"=> array(
				"cob"=>"0"
			),
			"jaminan"=> array(
				"lakaLantas"=> $lakaLantas,
				"penjamin"=> "1",
				"lokasiLaka"=>"Jakarta"
			),
			"noTelp"=> $noTelp,
			"user"=> "RS"
		);
		$request = json_encode(array("request"=>array("t_sep"=>$data)));

		// show_array($request);


		$url = $this->getMethod('editsep');
		// echo $url;
		$method="PUT";
		return $this->execute($url, $request,$method);
	}

}

?>
