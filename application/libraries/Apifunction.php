<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apifunction {

    public function url_api() {
        return "{{baseUrl}}";
    }

    public function minute_to_hour($minute){
        return floor($minute/60);
    }

    public function hour_to_day($minute){
        return floor($minute/24);
    }

    public function url_api_(){
    return "http://api-dash.morbis.id/";
	}

	public function header_api() {
	    $Authorization  = 'Basic ZGFzaGJvYXJkOm1iaTEyMzQ1Ng==';
	    $headers 		= array();
	    $headers[] 		= 'Content-Type: application/json; charset=utf-8';
	    $headers[] 		= 'Accept: application/json';
	    $headers[] 		= 'Authorization: ' . $Authorization;
	    return $headers;
	}

	public function connectCurl($url, $headers, $request = null, $method) {
	    $ch = curl_init($url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	    if ($request) {
	        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

	        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
	    }
	    $data = curl_exec($ch);

	    if ($data === false) {
	        echo 'Curl error: ' . curl_error($ch);
	    } else {
	        return $data;
	    }
	}
}