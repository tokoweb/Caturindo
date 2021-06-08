<?php

defined('BASEPATH') or exit('No direct script access allowed');

function kirim_notifikasi($token_user, $ambil)
{

    $url  = 'https://fcm.googleapis.com/fcm/send';
    
    $data = array(
        'to' 		   => $token_user,
        'collapse_key' => "type_a",
        "data"         => $ambil
    );
    $data_string = json_encode($data);

    $key = 'AAAADUIN924:APA91bHZbWgGcUU9H2yJYhf9Y0ywzijHL1bXnp1P5NXjU4uU6MqRzoeRstXJguV3FajQYN11ikPNzWPVcsU-cqZhnITUuRixZDkLO3N8TDYO0KVKloOKi0jauKTjzqn_hk1QGmZi-07g';
    # key yang lama
    # $key = 'AAAADUIN924:APA91bGoOPiMtpIKzPUiCNzXC7CYWv8yQFwuHIL37GrTkQW9ii-zk_1kcGQChzI7oCwN1lmdxXvrGmIK4xzHGw09Mu8hhrw4BCl-Ul98phjI9SnqBX2HcUIhjbHGNjUCqbLuN8Sl7NzL';

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
    curl_setopt($ch, CURLOPT_TIMEOUT, 360);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    	  'Authorization: key='.$key,
	      'Content-Type: application/json',
	      // 'Content-Length: ' . strlen($data_string)
  	  )
    );
    $res=curl_exec($ch);
    curl_close($ch);
    return $res;
    // return 'ada';
}

function random_char($huruf, $panjang) 
{

    $karakter = '0123456789';
    $string = ''; 
    for ( $i = 0; $i < $panjang; $i++ ) { 
        $pos = rand( 0, strlen( $karakter ) - 1 );
        // $string .= $karakter{$pos};
        $string .= $karakter[$pos]; 
    }
    //return "M".$string;
    return $huruf.$string;

}

function tgl_indo($tanggal){
    $bulan = array (
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);
    
    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun
 
    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}