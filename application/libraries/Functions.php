<?php
function kemaren($tgl){
    $tanggal = explode("-", $tgl);
    $tahun = $tanggal[0];
    $bulan = $tanggal[1];
    $hari = $tanggal[2]-1;

    if($hari < 1){
        $bulan -= 1;
        if($bulan==1 || $bulan==3 || $bulan==5 || $bulan==7 || $bulan==8 || $bulan==10 || $bulan==12){
            $jumlahHari=31;
        }else if($bulan==2){
            if($tahun % 4==0)
                $jumlahHari=29;
            else
                $jumlahHari=28;
        }else{
            $jumlahHari=30;
        }
        $hari = $jumlahHari ;
    }
    if($bulan < 1){
        $tahun -= 1;
        $bulan = 12;
        $hari = 31 ;
    }
    $bln_fix = strlen($bulan)==1?"0".$bulan:$bulan;
    $hri_fix = strlen($hari)==1?"0".$hari:$hari;
    return $tahun.'-'.$bln_fix.'-'.$hri_fix;
}

function romawi($num){
    switch ($num) {
        case 1:
        $romawi = 'I';
        break;
        case 2:
        $romawi = 'II';
        break;
        case 3:
        $romawi = 'III';
        break;
        case 4:
        $romawi = 'IV';
        break;
        case 5:
        $romawi = 'V';
        break;
        case 6:
        $romawi = 'VI';
        break;
        default:
        break;
    }
    return $romawi;
}
function grafik($maxScale = NULL,$xAxis = array(),$yAxis = array(),$graphTitle = "",$xTitle = "",$yTitle = "",$imageName = ""){
  $graph = new Graph(800,400,"auto");
  $graph->SetScale("textlin", 0, ($maxScale+3));
  $graph->SetMargin(50,50,40,40);
  $graph->SetBox(false);
  $graph->yaxis->HideLine(false);
  $graph->yaxis->HideTicks(false,false);
  $graph->yaxis->HideZeroLabel();
  $graph->xaxis->HideLine(false);
  $graph->xaxis->HideTicks(false,false);
  $graph->xaxis->HideZeroLabel();

  $graph->xaxis->setTickLabels($xAxis);
  $graph->title->Set("$graphTitle");
  $graph->xaxis->title->Set("$xTitle");
  $graph->yaxis->title->Set("$yTitle");
  $graph->SetBackgroundImage("assets/images/company/watermark.jpg",BGIMG_FILLFRAME);

  $barplot = new BarPlot($yAxis);
  $barplot->SetFillColor("red");
  $barplot->value->show();
  $barplot->SetFillGradient("navy","#EEEEEE",GRAD_LEFT_REFLECTION);
  $graph->Add($barplot);
  $graph->Stroke("assets/images/$imageName.png");
}
function antri($value) {
//    $value = $value + 1;
    $jml = strlen($value);
    if ($jml == 1)
        $no = "000" . $value;
    else if ($jml == 2)
        $no = "00" . $value;
    else if ($jml == 3)
        $no = "0" . $value;
    else if ($jml == 4)
        $no = $value;
    return $no;
}

/**
 *
 * @param <type> $tgl d/m/y
 * @return <type>
 */

function show_indo_tgl($tggl) {

    $datetime = explode(' ', $tggl);
    $tgl = explode('-',$datetime[0]);
    $mo = "";
    if ($tgl[1] == "01")
        $mo = "Januari";
    if ($tgl[1] == "02")
        $mo = "Februari";
    if ($tgl[1] == "03")
        $mo = "Maret";
    if ($tgl[1] == "04")
        $mo = "April";
    if ($tgl[1] == "05")
        $mo = "Mei";
    if ($tgl[1] == "06")
        $mo = "Juni";
    if ($tgl[1] == "07")
        $mo = "Juli";
    if ($tgl[1] == "08")
        $mo = "Agustus";
    if ($tgl[1] == "09")
        $mo = "September";
    if ($tgl[1] == "10")
        $mo = "Oktober";
    if ($tgl[1] == "11")
        $mo = "November";
    if ($tgl[1] == "12")
        $mo = "Desember";
    $new = "$tgl[2] $mo $tgl[0]";

    return $new;
}
function indo_tgl($tgl, $type=null) {
    if ($type == null) {
        $type = "/";
    }
    $tgl = explode($type, $tgl);
    if ($tgl[1] == '01')
        $mo = "Januari";
    if ($tgl[1] == '02')
        $mo = "Februari";
    if ($tgl[1] == '03')
        $mo = "Maret";
    if ($tgl[1] == '04')
        $mo = "April";
    if ($tgl[1] == '05')
        $mo = "Mei";
    if ($tgl[1] == '06')
        $mo = "Juni";
    if ($tgl[1] == '07')
        $mo = "Juli";
    if ($tgl[1] == '08')
        $mo = "Agustus";
    if ($tgl[1] == '09')
        $mo = "September";
    if ($tgl[1] == '10')
        $mo = "Oktober";
    if ($tgl[1] == '11')
        $mo = "November";
    if ($tgl[1] == '12')
        $mo = "Desember";
    $new = "$tgl[0] $mo $tgl[2]";

    return $new;
}

function noRm($value) {

    $jml = strlen($value);
    if ($jml == 1)
        $no = "0000000" . $value;
    if ($jml == 2)
        $no = "000000" . $value;
    if ($jml == 3)
        $no = "00000" . $value;
    if ($jml == 4)
        $no = "0000" . $value;
    if ($jml == 5)
        $no = "000" . $value;
    if ($jml == 6)
        $no = "00" . $value;
    if ($jml == 7)
        $no = "0" . $value;
    if ($jml == 8)
        $no = $value;
    if ($jml == 0)
        $no = "00000001";

    return $no;
}
function kodeKelompok($value) {

    $jml = strlen($value);
    if ($jml == 1)
        $no = "0000000" . $value;
    if ($jml == 2)
        $no = "000000" . $value;
    if ($jml == 3)
        $no = "00000" . $value;
    if ($jml == 4)
        $no = "0000" . $value;
    if ($jml == 5)
        $no = "000" . $value;
    if ($jml == 6)
        $no = "00" . $value;
    if ($jml == 7)
        $no = "0" . $value;
    if ($jml == 8)
        $no = $value;
    if ($jml == 0)
        $no = "00000001";

    return $no;
}
function noRm6digit($value) {
    $no='';
    $jml = strlen($value);
    if ($jml == 1)
        $no = "00000" . $value;
    if ($jml == 2)
        $no = "0000" . $value;
    if ($jml == 3)
        $no = "000" . $value;
    if ($jml == 4)
        $no = "00" . $value;
    if ($jml == 5)
        $no = "0" . $value;
    if ($jml >= 6)
        $no = $value;
    if ($jml == 0)
        $no = "000001";
    return $no;
}
function noRm3digit($value) {
    $no='';
    $jml = strlen($value);
    if ($jml == 1)
        $no = "00" . $value;
    if ($jml == 2)
        $no = "0" . $value;
    if ($jml >= 3)
        $no = $value;
    if ($jml == "0")
        $no = "001" . $value;
    return $no;
}

function ubahkoma($var){
    $result = str_replace(',', '.', $var);
    return $result;
}
function ubahtitik($var){
    $result = str_replace('.', ',', $var);
    return $result;
}

function strtoint($var) {
	$jml 	= substr_count($var,'.');
	$str 	= explode(".",$var);
	$new 	= array();
	for ($i = 0; $i <= $jml; $i++) {
		$new = $str;
	}
	$implode = implode('',$new);
    $result = ubahkoma($implode);
    return $result;
}

function inttocur($jml) {
	$int = number_format($jml, 0, '','.');
	return $int;
}

function rupiah($jml) {
	$int = number_format($jml, 2, ',','.');
	return $int;
}

function rupiahplus($jml) {
	$int = number_format($jml, 2, ',','.');
	return "<span class='floleft'>Rp </span>".$int;
}

function rupiah2($jml) {
	$int = number_format($jml, 0, '','.');
	return $int;
}
function rupiah3($jml) {
	$int = number_format($jml, 0, '','');
	return $int;
}

function set_time_zone() {
    $time = date_default_timezone_set('Asia/Jakarta');
    return $time;
}

function date2mysql($tgl) {
    $new = null;
    $tgl = explode("/", $tgl);
    if (empty($tgl[2]))
        return "";
    $new = "$tgl[2]-$tgl[1]-$tgl[0]";
    return $new;
}

function date2mysql2($tgl) {
    $new = null;
    $tgl = explode("/", $tgl);
    if (empty($tgl[2]))
        return "";
    $new = "$tgl[2]-$tgl[0]-$tgl[1]";
    return $new;
}

function datefmysql($tgl) {
	if($tgl=='' || $tgl==null){
		return "-";
    }else{
       $tgl = explode("-", $tgl);
       $new = $tgl[2]."/".$tgl[1]."/".$tgl[0];
       return $new;
   }
}

function dateTanggalBulanTahun($tanggal){
    $date = strtotime($tanggal);
    return date("d/m/Y",$date);
}

/**
 *
 * @param <type> $tgl1 Y-m-d
 * @return <type>
 */
function createUmur($tgl1) {
    $tglSekarang = strtotime(date("Y-m-d"));
    $tglLahir = strtotime($tgl1);
    $age = 0;
    if($tglSekarang > $tglLahir){
      while( $tglSekarang > $tglLahir = strtotime('+1 year', $tglLahir))
      {
        ++$age;
    }
}else{
    while( $tglLahir > $tglSekarang = strtotime('+1 year', $tglSekarang))
    {
        --$age;
    }
}

return $age;
}
/**
 *
 * @param <type> $tgl d/m/Y
 * @return <type>
 */
function hitungUmur($tgl){
    $tanggal = explode("/", $tgl);
    $tahun = $tanggal[2];
    $bulan = $tanggal[1];
    $hari = $tanggal[0];

    $day = date('d');
    $month = date('m');
    $year = date('Y');

    $tahun = $year-$tahun;
    $bulan = $month-$bulan;
    $hari = $day-$hari;

    $jumlahHari = 0;
    $bulanTemp = ($month==1)?12:$month-1;
    if($bulanTemp==1 || $bulanTemp==3 || $bulanTemp==5 || $bulanTemp==7 || $bulanTemp==8 || $bulanTemp==10 || $bulanTemp==12){
        $jumlahHari=31;
    }else if($bulanTemp==2){
        if($tahun % 4==0)
            $jumlahHari=29;
        else
            $jumlahHari=28;
    }else{
        $jumlahHari=30;
    }

    if($hari<0){
        $hari+=$jumlahHari;
        $bulan--;
    }
    if($bulan<0 || ($bulan==0 && $tahun!=0)){
        $bulan+=12;
        $tahun--;
    }
    if($bulan == 12){
        $bulan = 0;
        $tahun += 1;
    }
    if ($tahun =='0'){
       $tahunz='';
   }
   else{
       $tahunz=$tahun." Tahun ";
   }
   return $tahunz.$bulan." Bulan ".$hari." Hari";
}
function hitungUmur2($tgl){
    $tanggal = explode("-", $tgl);
    $tahun = $tanggal[0];
    $bulan = $tanggal[1];
    $hari = $tanggal[2];

    $day = date('d');
    $month = date('m');
    $year = date('Y');

    $tahun = $year-$tahun;
    $bulan = $month-$bulan;
    $hari = $day-$hari;

    $jumlahHari = 0;
    $bulanTemp = ($month==1)?12:$month-1;
    if($bulanTemp==1 || $bulanTemp==3 || $bulanTemp==5 || $bulanTemp==7 || $bulanTemp==8 || $bulanTemp==10 || $bulanTemp==12){
        $jumlahHari=31;
    }else if($bulanTemp==2){
        if($tahun % 4==0)
            $jumlahHari=29;
        else
            $jumlahHari=28;
    }else{
        $jumlahHari=30;
    }

    if($hari<0){
        $hari+=$jumlahHari;
        $bulan--;
    }
    if($bulan<0 || ($bulan==0 && $tahun!=0)){
        $bulan+=12;
        $tahun--;
    }
    if($bulan == 12){
        $bulan = 0;
        $tahun += 1;
    }
    if ($tahun =='0'){
       $tahunz='';
   }
   else{
       $tahunz=$tahun." Tahun ";
   }
   return $tahunz.$bulan." Bulan ".$hari." Hari";
}

function hitungUmurKategori($tgl){
    $tanggal = explode("-", $tgl);
    $tahun = $tanggal[0];
    // $bulan = $tanggal[1];
    // $hari = $tanggal[2];

    // $day = date('d');
    // $month = date('m');
    $year = date('Y');

    $tahun = $year-$tahun;
    // $bulan = $month-$bulan;
    // $hari = $day-$hari;

    // $jumlahHari = 0;
    // $bulanTemp = ($month==1)?12:$month-1;
    // if($bulanTemp==1 || $bulanTemp==3 || $bulanTemp==5 || $bulanTemp==7 || $bulanTemp==8 || $bulanTemp==10 || $bulanTemp==12){
    //     $jumlahHari=31;
    // }else if($bulanTemp==2){
    //     if($tahun % 4==0)
    //         $jumlahHari=29;
    //     else
    //         $jumlahHari=28;
    // }else{
    //     $jumlahHari=30;
    // }

    // if($hari<0){
    //     $hari+=$jumlahHari;
    //     $bulan--;
    // }
    // if($bulan<0 || ($bulan==0 && $tahun!=0)){
    //     $bulan+=12;
    //     $tahun--;
    // }
    // if($bulan == 12){
    //     $bulan = 0;
    //     $tahun += 1;
    // }
    if ($tahun =='0'){
       $tahunz='';
   }
   else{
       $tahunz=$tahun;
   }
   return $tahunz;
}

function hitungUmur3($tgl){
   $tanggal = explode("/", $tgl);
   $tahun = $tanggal[2];
   $bulan = $tanggal[1];
   $hari = $tanggal[0];

   $day = date('d');
   $month = date('m');
   $year = date('Y');

   $tahun = $year-$tahun;
   $bulan = $month-$bulan;
   $hari = $day-$hari;

   $jumlahHari = 0;
   $bulanTemp = ($month==1)?12:$month-1;
   if($bulanTemp==1 || $bulanTemp==3 || $bulanTemp==5 || $bulanTemp==7 || $bulanTemp==8 || $bulanTemp==10 || $bulanTemp==12){
    $jumlahHari=31;
}else if($bulanTemp==2){
    if($tahun % 4==0)
        $jumlahHari=29;
    else
        $jumlahHari=28;
}else{
    $jumlahHari=30;
}

if($hari<0){
    $hari+=$jumlahHari;
    $bulan--;
}
if($bulan<0 || ($bulan==0 && $tahun!=0)){
    $bulan+=12;
    $tahun--;
}
if($bulan == 12){
    $bulan = 0;
    $tahun += 1;
}
if ($tahun =='0'){
	$tahunz='';
}
else{
	$tahunz=$tahun;
}
return $hasil = array('tahun' => $tahunz, 'bulan' => $bulan, 'hari' => $hari);
}

function datetime($dt) {
    $var = explode(" ", $dt);
    $var1 = explode("-", $var[0]);
    $var2 = "$var1[2]/$var1[1]/$var1[0]";

    return $var2 . " " . $var[1];
}

function datez($dt,$format=NULL){
    //echo DBConnection::$conn->getDatabasePlatform()->getDateFormatString();
    $format = ($format==NULL)?'d/m/Y':$format;
    $datetime = DateTime::createFromFormat('Y-m-d H:i:s', $dt);
    if(!is_object($datetime)){
        $datetime = DateTime::createFromFormat('Y-m-d', $dt);
    }
    $return = $datetime->format($format);
    return $return;
}

function datetimez($dt,$format=NULL){

    $format = ($format==NULL)?'d/m/Y H:i:s':$format;
    $datetime = DateTime::createFromFormat('Y-m-d H:i:s', $dt);
    if(!is_object($datetime)){
        $datetime = DateTime::createFromFormat('Y-m-d', $dt);
    }
    $return = $datetime->format($format);
    return $return;
}
function datetimetztodate($datetimetz,$format=NULL){
    $format = ($format==NULL)?"d-m-Y":$format;
    $new_datetimetz = datetimez($datetimetz);
    $datetime = DateTime::createFromFormat('d/m/Y H:i:s', $new_datetimetz);
    $new_date = $datetime->format($format);
    return $new_date;
}
function datetimetztotime($datetimetz,$format=NULL){
    $format = ($format==NULL)?"H:i:s":$format;
    $new_datetimetz = datetimez($datetimetz);
    $datetime = DateTime::createFromFormat('d/m/Y H:i:s', $new_datetimetz);
    $new_date = $datetime->format($format);
    return $new_date;
}

function datetime2mysql($dt){
    $var = explode(" ", $dt);
    $var1 = explode("/", $var[0]);
    $var2 = "$var1[2]-$var1[1]-$var1[0]";

    return $var2 . " " . $var[1];
}

function datetimemysql($dt){
    $var = explode(" ", $dt);
    $var1 = explode("/", $var[0]);
    $var2 = "$var1[2]-$var1[1]-$var1[0]";

    return $var2;
}
function deletetime($dtm) {
    $var = explode(" ", $dtm);
    $var1 = explode("-", $var[0]);
    $var2 = "$var1[2]/$var1[1]/$var1[0]";

    return $var2;
    //$var[1]
}
function hapuswaktu($hwt) {
    $var = explode(" ", $hwt);
    $var2 = "$var[0]";

    return $var2;
    //$var[1]
}
function pecahwaktu($pwt) {
    $varx = explode(" ", $pwt);
    $var = explode("-", $varx[0]);
    $tahun = "$var[0]";
    $bulan= "$var[1]";
    $hari= "$var[2]";
    $jd = GregorianToJD($bulan, $hari, $tahun);
    return $jd;
    //$var[1]
}
function pecaahTanggal($datetime){
    $pecah = explode(" ", $datetime);
    $var = explode("-", $pecah[0]);
    $tahun = "$var[0]";
    $bulan= "$var[1]";
    $hari= "$var[2]";
    $jd = $hari.' / '.$bulan.' / '.$tahun;
    return $jd;
}
function ambijam($datetime){
    $pecah = explode(" ", $datetime);
    $jam= "$pecah[1]";
    return $jam;
}

function tglLahir($umur) {
    $x = mktime(0, 0, 0, date("m"), date("d"), date("Y") - $umur);
    $bd = date("Y-m-d", $x);
    return $bd;
}

function checked($obj, $value){
    if($obj == $value){
        $show = "checked";
    }else{
        $show = "";
    }
    return $show;
}

function getBln($bln) {
    $sls = $_GET['thakhir'] - $_GET['thawal'];
    for ($i = 0; $i <= $sls; $i++) {
        switch ($bln) {
            case 1 + (12 * $i):
            $val = "01";
            break;

            case 2 + (12 * $i):
            $val = "02";
            break;

            case 3 + (12 * $i):
            $val = "03";
            break;

            case 4 + (12 * $i):
            $val = "04";
            break;

            case 5 + (12 * $i):
            $val = "05";
            break;

            case 6 + (12 * $i):
            $val = "06";
            break;

            case 7 + (12 * $i):
            $val = "07";
            break;

            case 8 + (12 * $i):
            $val = "08";
            break;

            case 9 + (12 * $i):
            $val = "09";
            break;

            case 10 + (12 * $i):
            $val = "10";
            break;

            case 11 + (12 * $i):
            $val = "11";
            break;

            case 12 + (12 * $i):
            $val = "12";
            break;
        }
    }
    return $val;
}

function blnAngka($bln) {
    $val = "0";
    switch ($bln) {
        case "Januari":
        $val = "1";
        break;

        case "Februari":
        $val = "2";
        break;

        case "Maret":
        $val = "3";
        break;

        case "April":
        $val = "4";
        break;

        case "Mei":
        $val = "5";
        break;

        case "Juni":
        $val = "6";
        break;

        case "Juli":
        $val = "7";
        break;

        case "Agustus":
        $val = "8";
        break;

        case "September":
        $val = "9";
        break;

        case "Oktober":
        $val = "10";
        break;

        case "November":
        $val = "11";
        break;

        case "Desember":
        $val = "12";
        break;
    }
    return $val;
}

function bln($bln) {
    $n = $_GET['thakhir'] - $_GET['thawal'];
    if ($n >= 0) {
        for ($i = 0; $i <= $n; $i++) {
            switch ($bln) {
                case 1 + ($i * 12):
                $val = "Januari";
                break;

                case 2 + ($i * 12):
                $val = "Februari";
                break;

                case 3 + ($i * 12):
                $val = "Maret";
                break;

                case 4 + ($i * 12):
                $val = "April";
                break;

                case 5 + ($i * 12):
                $val = "Mei";
                break;

                case 6 + ($i * 12):
                $val = "Juni";
                break;

                case 7 + ($i * 12):
                $val = "Juli";
                break;

                case 8 + ($i * 12):
                $val = "Agustus";
                break;

                case 9 + ($i * 12):
                $val = "September";
                break;

                case 10 + ($i * 12):
                $val = "Oktober";
                break;

                case 11 + ($i * 12):
                $val = "November";
                break;

                case 12 + ($i * 12):
                $val = "Desember";
                break;
            }
        }
        return $val;
    }
}

/**
 *
 * @param int $bln bulan ke- (mulai dari angka 1-12)
 * @return string
 */
function bulan($bln) {
    switch ($bln) {
        case 1 :
        $val = "Januari";
        break;

        case 2 :
        $val = "Februari";
        break;

        case 3 :
        $val = "Maret";
        break;

        case 4 :
        $val = "April";
        break;

        case 5 :
        $val = "Mei";
        break;

        case 6 :
        $val = "Juni";
        break;

        case 7 :
        $val = "Juli";
        break;

        case 8 :
        $val = "Agustus";
        break;

        case 9 :
        $val = "September";
        break;

        case 10 :
        $val = "Oktober";
        break;

        case 11 :
        $val = "November";
        break;

        case 12 :
        $val = "Desember";
        break;
        default :
        $val = "";
        break;
    }
    return $val;
}

function paging($jml, $dataPerPage=NULL, $tab = NULL, $ajax = NULL,$content = NULL) {

    $showPage = NULL;
    ob_start();
    echo "
    <div class='body-page'>";
    if (!empty($_GET['page'])) {
        $noPage = $_GET['page'];
    } else {
        $noPage = 1;
    }

    $dataPerPage = ($dataPerPage!=NULL)?$dataPerPage:PAGINATE_LIMIT;
    $content = ($content!=NULL)?$content:"#content";
    $offset = ($noPage - 1) * $dataPerPage;

    $jumData = $jml;
    $jumPage = ceil($jumData / $dataPerPage);
    $get=$_GET;
    if ($jumData > $dataPerPage) {
        if ($noPage > 1){
            $get['page']=($noPage - 1);
            if ($ajax != NULL) "<span class='page-prev' onclick='contentloader(\"?" .  generate_get_parameter($get). "\",\"$content\")'>prev</span>";
            else echo "<span class='page-prev' onClick=location.href='?" .  generate_get_parameter($get). "'>prev</span>";
        }
        for ($page = 1; $page <= $jumPage; $page++) {
            if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage)) {
                if (($showPage == 1) && ($page != 2))
                    echo "...";
                if (($showPage != ($jumPage - 1)) && ($page == $jumPage))
                    echo "...";
                if ($page == $noPage)
                    echo " <span class='noblock'>" . $page . "</span> ";
                else{
                    $get['page']=$page;

                    if($tab != NULL){
                        $get['tab'] = $tab;
                    }
                    if ($ajax != NULL) echo " <a class='block' onclick='contentloader(\"?" .  generate_get_parameter($get). "\",\"$content\")'>" . $page . "</a> ";
                    else echo " <a class='block' href='?" .  generate_get_parameter($get). "'>" . $page . "</a> ";
                }
                $showPage = $page;
            }
        }

        if ($noPage < $jumPage){
            $get['page']=($noPage + 1);
            if ($ajax != NULL) echo "<span class='page-next' onclick='contentloader(\"?" .  generate_get_parameter($get). "\",\"$content\")'>next</span>";
            else echo "<span class='page-next' onClick=location.href='?" .  generate_get_parameter($get). "'>next</span>";
        }
    }
    echo "</div>";

    $buffer = ob_get_contents();
    ob_end_clean();
    return $buffer;
}

function pagination($sql, $dataPerPage, $tab = NULL){

    $showPage = NULL;
    ob_start();
    echo "
    <div class='body-page'>";
    if (!empty($_GET['pages'])) {
        $noPage = $_GET['pages'];
    } else {
        $noPage = 1;
    }

    $dataPerPage = $dataPerPage;
    $offset = ($noPage - 1) * $dataPerPage;

    $hasil = mysql_query($sql);

    $data = mysql_num_rows($hasil);
    $jumData = $data;
    $jumPage = ceil($jumData / $dataPerPage);
    $get=$_GET;
    if ($jumData > $dataPerPage) {
        if ($noPage > 1){
            $get['pages']=($noPage - 1);
            echo "<span class='page-prev' onClick=location.href='?" .  generate_get_parameter($get). "'>prev</span>";
        }
        for ($page = 1; $page <= $jumPage; $page++) {
            if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage)) {
                if (($showPage == 1) && ($page != 2))
                    echo "...";
                if (($showPage != ($jumPage - 1)) && ($page == $jumPage))
                    echo "...";
                if ($page == $noPage)
                    echo " <span class='noblock'>" . $page . "</span> ";
                else{
                    $get['pages']=$page;

                    if($tab != NULL){
                        $get['tab'] = $tab;
                    }

                    echo " <a class='block' href='?" .  generate_get_parameter($get). "'>" . $page . "</a> ";
                }
                $showPage = $page;
            }
        }

        if ($noPage < $jumPage){
            $get['pages']=($noPage + 1);
            echo "<span class='page-next' onClick=location.href='?" .  generate_get_parameter($get). "'>next</span>";
        }
    }
    echo "</div>";

    $buffer = ob_get_contents();
    ob_end_clean();
    return $buffer;
}

function delete_list_data($id, $tabel, $link, $err_link, $dataname=null, $page=NULL, $tab = NULL,$add_param=null) {

    $result = mysql_query("SELECT * from $tabel");
    $property = mysql_fetch_field($result);
    if($page != NULL){
        $pages = "&page=$page";
    }else $pages = "";

    if($tab != NULL){
        $tabs = "&tab=$tab";
    }else $tabs = "";

    if (isset($_POST['delete'])) {
        $sql = mysql_query("DELETE FROM $tabel WHERE " . $property->name . " = '$id'");
        if ($sql) {
            if($add_param!=null){
                header("location:" . app_base_url('' . $link . '') . "$pages"."$tabs"."&" . $add_param."");
            }else{
                header("location:" . app_base_url('' . $link . '') . "$pages"."$tabs");
            }

        } else {
            if($add_param!=null){
                header("location:" . app_base_url('' . $err_link . '') . "$pages"."$tabs"."&" . $add_param."");
            }else{
                header("location:" . app_base_url('' . $err_link . '') . "$pages"."$tabs");
            }

        }
    }
    if ($dataname == null) {
        $sql = mysql_query("select * from $tabel where " . $property->name . " = '$id'");
        $row = mysql_fetch_row($sql);
        $dataname = "$row[1]";
    }
    ?>
    <fieldset><legend>Konfirmasi delete data</legend>
        <form class="data-input" action="" method="post">
            Yakin akan menghapus data <b><?= $dataname ?> </b> ?
            <fieldset class="field-group">
                <input type="submit" value="OK" class="tombol" name="delete" />&nbsp;
                <input type="button" value="Batal" class="tombol" onClick="javascript:history.go(-1)" />
            </fieldset>
        </form>
    </fieldset>
    <?
}

/**
 *
 * @param <type> $dataname label data yang akan dihapus
 * @param <type> $link link jika data berhasil dihapus
 * @param <type> $err_link link jika data gagal dihapus
 * @param <type> $query daftar query yang dijalankan ketika data dihapus
 */
function delete_list_data2($dataname, $link, $err_link, $query=array(),$add_param=null) {
    if (isset($_POST['delete2'])) {
        //query delete
        $error=0;
        DBConnection::$conn->beginTransaction();
        foreach ($query as $id => $s) {
            try{
                _delete($s);
            }catch(Exception $e){
                $error++;
                //echo $e->getMessage();
                //echo '<br/>Query Index='.$id;
            }
        }
        if($error>0) {
            DBConnection::$conn->rollback();
            if($add_param!=null){
                header("location:" . app_base_url('' . $err_link . '')."&" . $add_param."");
            }else{
                header("location:" . app_base_url('' . $err_link . '') . "");
            }
        } else {
            DBConnection::$conn->commit();
            if($add_param!=null){
                header("location:" . app_base_url('' . $link . '')."&". $add_param."");
            }else{
                header("location:" . app_base_url('' . $link . ''). "");
            }
        }
    }
    ?>
    <fieldset><legend>Konfirmasi delete data</legend>
        <form class="data-input" action="" method="post">
            Yakin akan menghapus data <b><?= $dataname ?> </b> ?
            <fieldset class="field-group">
                <input type="submit" value="OK" class="tombol" name="delete2" />&nbsp;
                <input type="button" value="Batal" class="tombol" onClick="javascript:history.go(-1)" />
            </fieldset>
        </form>
    </fieldset>
    <?
}

function delete_data($kolom,$id,$table,$redirect) {
    $sql = mysql_query("DELETE FROM $table WHERE " . $kolom . " = '". $id ."'");
    if ($sql) header("location:" . app_base_url('' . $redirect . '') . "");
}
function difference_time($begin, $end) {
    // Return the number of days between the two dates:
    $data_frek['frek'] = round(abs(strtotime($end)-strtotime($begin))/86400);
    return $data_frek;
    // end function dateDiff
}

function diffyear($begin, $end) {

    return $diff = $end - $begin;
}

/**
 *
 * @param type $sql
 * @return jumlah record dari query
 */
function countrow($sql) {
    $exe = DBConnection::$conn->query("SELECT count( * ) AS JUMLAH_DATA FROM ($sql) DATA ");
    $row_exe = $exe->fetch(PDO::FETCH_ASSOC);
    $count = $row_exe['JUMLAH_DATA'];
    return $count;
}

function _select_arr($sql) {
    $result = array();
    try {
       $exe = DBConnection::$conn->query($sql);
       $result = $exe->fetchAll(PDO::FETCH_ASSOC);
   } catch (Exception $exc) {
    echo $exc->getTraceAsString(). "<hr>" . $sql;
    throw $exc;
}
return $result;
}

/*
function _select($sql) {
    $exe = mysql_query($sql) or die(mysql_error() . "<hr>" . $sql);
    return $exe;
}
*/
function _select_unique_results($sql) {
    $row =array();
    try {
       $exe = DBConnection::$conn->query($sql);
       $row = $exe->fetch(PDO::FETCH_ASSOC);
   } catch (Exception $exc) {
    echo $sql. "<hr> error : " .$exc->getTraceAsString() ;
    throw $exc;
}

return $row;
}

/*
function _farray($sql) {
    $data = null;
    if (!empty($sql)) {
        $data = mysql_fetch_array($sql);
        return $data;
    }
}
*/

function _insert($sql) {
    try{
        $exe = DBConnection::$conn->prepare($sql);
        $exe->execute();
        return $exe->rowCount();
    }catch (Exception $e){
        echo $sql. "<hr>" .$e->getTraceAsString() ;
        throw $e;
    }
}

function _update($sql) {
   try{
    $exe = DBConnection::$conn->prepare($sql);
    $exe->execute();
    return $exe->rowCount();
}catch (Exception $e){
    echo $sql. "<hr>" .$e->getTraceAsString() ;
    throw $e;
}
}

function _delete($sql) {
	$exe = DBConnection::$conn->prepare($sql);
    $exe->execute();
    return $exe->rowCount();
}
function _transaction_query($sql) {
    $exe = DBConnection::$conn->prepare($sql);
    try{
        $exe->execute();
        return $exe->rowCount();
    }catch(Exception $err){
        echo $sql;
        show_array($err);
        DBConnection::$conn->rollback();
        exit();
    }

}

function _last_id($tableName) {
//    return mysql_insert_id();
    $qid = DBConnection::$conn->query("select MAX(ID) as ID from $tableName");
    $id = $qid->fetch(PDO::FETCH_ASSOC);
    return $id['ID'];
}

function show_array($array) {
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function post_value($name) {
    if (isset($_POST[$name])) {
        return $_POST[$name];
    } else {
        return null;
    }
}

function get_value($name) {
    if (isset($_GET[$name])) {
        return $_GET[$name];
    } else {
        return null;
    }
}

function array_value($array, $index) {
    if (isset($array[$index])) {
        return $array[$index];
    } else {
        return null;
    }
}
function _num_rows($sql){
    $exe = DBConnection::$conn->query("SELECT count( * ) AS JUMLAH_DATA FROM ($sql) DATA ");
    $row_exe = $exe->fetch(PDO::FETCH_ASSOC);
    $count = $row_exe['JUMLAH_DATA'];
    return $count;
}

function get_date_now() {
    return date("d/m/Y");
}

/**
 * fungsi $endDate-$startDate
 * @param <type> $startDate format tanggal Y-M-D
 * @param <type> $endDate format tanggal Y-M-D
 */
function selisih_hari($startDate, $endDate) {
    $tgl1 = $startDate;  // 1 Oktober 2009
    $tgl2 = $endDate;  // 10 Oktober 2009
    // memecah tanggal untuk mendapatkan bagian tanggal, bulan dan tahun
    // dari tanggal pertama
//    echo "$tgl1 $tgl2";
    $pecah1 = explode("-", $tgl1);

    $date1 = $pecah1[2];
    $month1 = $pecah1[1];
    $year1 = $pecah1[0];

    // memecah tanggal untuk mendapatkan bagian tanggal, bulan dan tahun
    // dari tanggal kedua

    $pecah2 = explode("-", $tgl2);
    $date2 = $pecah2[2];
    $month2 = $pecah2[1];
    $year2 = $pecah2[0];

    // menghitung JDN dari masing-masing tanggal

    $jd1 = GregorianToJD($month1, $date1, $year1);
    $jd2 = GregorianToJD($month2, $date2, $year2);

    // hitung selisih hari kedua tanggal

    $selisih = $jd2 - $jd1;
    return $selisih;
}
function generate_sort_parameter($sort,$sortBy=null,$tab = NULL){
    $link=$_GET;
    $link['sort']=$sort;

    if($sortBy=='asc' && isset($_GET['sort']) && $_GET['sort']==$sort)
        $link['sortBy']='desc';
    else
        $link['sortBy']='asc';
    if($tab != NULL){
        $tabs['tab']=$tab;
    }else $tabs['tab']="";

    $link=generate_get_parameter($link,$tabs);
    return $link;
}
function generate_get_parameter($get,$addArr=array(),$removeArr=array()) {
    // show_array($get);
    if($addArr==null)
        $addArr=array();
    foreach($removeArr as $rm){
        unset($get[$rm]);
    }

    $link = "";
    $get=array_merge($get, $addArr);
    foreach ($get as $key => $val) {
        if ($link == null) {
            $link.="$key=$val";
        }else
        $link.="&$key=$val";
    }
    return $link;
}

function int_to_money($nominal) {
    return "Rp. " . number_format($nominal, 0, '', '.');
}

function header_excel($namaFile) {
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");

    // header untuk nama file
    header("Content-Disposition: attachment;filename=" . $namaFile );
    header("Content-Transfer-Encoding: binary ");
}

function include_css() {
    ?>
    <link rel="stylesheet" type="text/css" href="<?= app_base_url('/assets/css/layout-default-latest.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= app_base_url('/assets/css/jquery.flipflopfolding.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= app_base_url('/assets/css/barcode-font.css') ?>" />

    <link rel="stylesheet" type="text/css" href="<?= app_base_url('/assets/css/jquery.partsselector.css') ?>" media="all" />
    <link rel="stylesheet" type="text/css" href="<?= app_base_url('/assets/css/base.css') ?>" media="all" />
    <link rel="stylesheet" type="text/css" href="<?= app_base_url('/assets/css/base/ui.all.css') ?>" media="all" />
    <link rel="stylesheet" type="text/css" href="<?= app_base_url('/assets/css/style.css') ?>" media="all" />
    <link rel="stylesheet" type="text/css" href="<?= app_base_url('/assets/css/jquery.autocomplete.css') ?>" media="all" />
    <link rel="stylesheet" type="text/css" href="<?= app_base_url('/assets/css/jquery.multiselect2side.css') ?>" media="all" />
    <?
}

function include_css_excel_report() {
    ?>
    <style type="text/css">
    h2{
        font-size: 16px;
    }
    td{
        background-color: #ffffff;
        border: 1px solid #000;
    }
    table{
        background-color: #ffffff;
    }
    tr.odd{
        background-color:#ffffff;
    }
    tr.even{
        background-color:#ffffff;
    }
</style>
<?
}

function tampilkan_pesan() {
    include 'app/actions/admisi/pesan.php';
    echo isset($pesan) ? $pesan : NULL;
}
function currencyToNumber($a){
    $b=str_ireplace(".", "", $a);
    return str_replace(",",".",$b);
}
function waktufmysql($waktu){
    $time=explode(" ", $waktu);
    $waktu=array();
    $waktu['tanggal']=datefmysql($time[0]);
    $waktu['jam']=$time[1];
    return $waktu;
}
function showWaktuFromMysql($waktu){
    $w=waktufmysql($waktu);
    return $w['tanggal']." ".$w['jam'];
}

function notifikasi($data,$center=null) {
	if ($center != null) return "<center><div class='notif' style='float: none; width: 23%'>".$data."</div></center>";
	return "<div class='notif'>".$data."</div><div style='clear: both'></div>";
}

function addButton($url,$title,$java=Null) {
	if ($java!=Null) {
       return "<a href='' onclick='".$url.";return false' id='".$java."' class='add'><div class='icon button-add'></div>".$title."</a>";
   } else {
       return "<a href='".app_base_url($url)."' class='add'><div class='icon button-add'></div>".$title."</a>";
   }
}

function topButton($url,$title) {
	return "<a href='".$url."' class='add'><div class='icon button-top'></div>".$title."</a>";
}


function excelButton($url,$title) {
	return "<a href='".app_base_url($url)."' class='varianButton'><div class='icon button-excel'></div>".$title."</a>";
}

function nama_packing_barang($data_array){
//urutan parameter array generik,nama_barang,kekuatan,sediaan,satuan,pabrik
    $nama = "$data_array[1]";
    if ($data_array['0'] == 'Generik'||$data_array[0] == 'Non Generik') {
                $nama.= ( $data_array[2] != 0) ? " $data_array[2], $data_array[3]" : " $data_array[3]"; //kekuatan dan sediaan
            }
    $nama.= !empty($data_array[4])?" @$data_array[4]":''; //satuan
    $nama.= ( $data_array[0] == 'Generik') ? ' ' . $data_array[5] : ''; //pabrik

    return $nama;
}

function test($data) {
	echo "<pre>";
	print_r($data);
	echo "</pre>";
}

function boxnotif() {
	echo "<div id='box-notif'></div><div class='clear'></div>";
}

function lembar_header_excel($colspan){
   $head = head_laporan_muat_data();

   $data="
   <tr>
   <td colspan='$colspan' style='border:0;text-align:center;'><h1>".$head['nama']."</h1></td>
   </tr>
   <tr>
   <td  colspan='$colspan' style='border:0;text-align:center;'>".$head['alamat'].",".$head['kabupaten']."</td>
   </tr>
   <tr>
   <td  colspan='$colspan' style='border:0;text-align:center;'>Telp: ".$head['telp'].", Fax: ".$head['fax'].", Email: ".$head['email'].", Website: ".$head['web']."</td>
   </tr>
   <tr>
   <td  colspan='$colspan' style='border:0;text-align:center;'></td>
   </tr>
   ";

   return $data;
}


function array_sort($array, $on, $order=SORT_ASC) {
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
            asort($sortable_array);
            break;
            case SORT_DESC:
            arsort($sortable_array);
            break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}
function array_key_to_lower($array){
    $data = array_map(function($row_array){return array_change_key_case($row_array,CASE_LOWER);},$array);
    return $data;
}
function daily_data_retriever($sql,$startTime,$endTime){
    $query = DBConnection::$conn->prepare($sql);
    $query->bindValue(':awal',$startTime,'datetime');
    $query->bindValue(':akhir',$endTime,'datetime');
    try{
        $query->execute();
    }catch(Exception $e){
        show_array($e);
        exit();
    }
    $jml = count($query->fetchAll(PDO::FETCH_BOTH));
    return $jml;
}
function firstAndLastDayInMonth($bulan,$tahun){
    if($bulan==12){
        $date2 = ($tahun+1)."-01-01";
    }else{
        $date2 = $tahun."-".($bulan+1)."-01";
    }
    $date1 = $tahun."-".$bulan."-01";
    $hari = selisih_hari($date1, $date2);
    $date3 = $tahun."-".$bulan."-".$hari;

    $return['awal'] = $date1;
    $return['akhir'] = $date3;

    return $return;
}
function monthsDiff($start, $end)
{
    $date1 = new DateTime($end);
    $date2 = new DateTime($start);

    $diff = $date1->diff($date2);
    $result = ($diff->format('%y') * 12) + $diff->format('%m');
    return $result;
}
function max_write_on_row($data,$len) {
	if (strlen($data) > $len) return substr($data,0,$len-2)." ..."; else return $data;
}
function nomer_paging($page,$perpage) {
    if ($page > 1)
        $no = $perpage * ($page - 1) + 1;
    else
        $no = 1;

    return $no;
}

function select_rentang_umur($cek){
    ?>
    <select name="umur" id="umur">
        <option value="">Pilih rentang umur</option>
        <option value="0-10" <?= $cek=='0-10'?'selected':'';?>>0-10 Tahun</option>
        <option value="11-20" <?= $cek=='11-20'?'selected':'';?>>11-20 Tahun</option>
        <option value="21-30" <?= $cek=='21-30'?'selected':'';?>>21-30 Tahun</option>
        <option value="31-40" <?= $cek=='31-40'?'selected':'';?>>31-40 Tahun</option>
        <option value="41-50" <?= $cek=='41-50'?'selected':'';?>>41-50 Tahun</option>
        <option value="51-60" <?= $cek=='51-60'?'selected':'';?>>51-60 Tahun</option>
        <option value="61-70" <?= $cek=='61-70'?'selected':'';?>>61-70 Tahun</option>
        <option value="71-80" <?= $cek=='71-80'?'selected':'';?>>71-80 Tahun</option>
        <option value="81-90" <?= $cek=='81-90'?'selected':'';?>>81-90 Tahun</option>
        <option value="91-100" <?= $cek=='91-100'?'selected':'';?>>91-100 Tahun</option>
        <option value="101-110" <?= $cek=='101-110'?'selected':'';?>>101-110 Tahun</option>
    </select>
    <?php
}
function generate_tanggal_lahir($val){
    $age = explode('-', $val);
    $return['awal'] = tglLahir($age[0]);
    $return['akhir'] = tglLahir($age[1]);
    return $return;
}

function golongan(){
    $golongan = array(
        'I/a','I/b','I/c','I/d',
        'II/a','II/b','II/c','II/d',
        'III/a','III/b','III/c','III/d',
        'IV/a','IV/b','IV/c','IV/d','IV/e'
    );
    return $golongan;
}

function pangkat() {
    $pangkat = array(
        'Juru Muda','Juru Muda Tingkat 1',
        'Juru','Juru Tingkat 1',
        'Pengatur Muda','Pengatur Muda Tingkat 1',
        'Pengatur','Pengatur Tingkat 1',
        'Penata Muda','Penata Muda Tingkat 1',
        'Penata','Penata Tingkat 1',
        'Pembina','Pembina Tingkat 1',
        'Pembina Utama Muda','Pembina Utama Madya','Pembina Utama'
    );
    return $pangkat;
}

function get_pangkat($gol){
    if($gol!=null){
        $golongan=  golongan();
        $pangkat= pangkat();

        $key=  array_search($gol, $golongan);
        return $pangkat[$key];
    }else{
        return null;
    }
}

function get_nilai($nilai){
    if($nilai!=null){
        if($nilai<=60){
            return 'Kurang';
        }else if($nilai<=70){
            return 'Cukup';
        }else if($nilai<=90){
            return 'Baik';
        }else{
            return 'Amat Baik';
        }
    }else{
        return null;
    }
}

function get_nomor_bukti(){
    $no_bukti=  DBConnection::$conn->fetchColumn('select max(nomor_bukti) as nomor from jurnal');
    if($no_bukti==null){
        return 1;
    }else{
        $no_bukti++;
        return $no_bukti;
    }
}

function get_last_saldo(){
    $saldo=  DBConnection::$conn->fetchColumn('SELECT jumlah from saldo where id=(select max(id) from saldo)');
    if($saldo==null){
        return 0;
    }else{
        return $saldo;
    }
}

function get_proses_informasi($id){
    $sql="select di.*,i1.hidden_informasi as parent_field,i1.tabel_hidden_informasi as parent_tabel,
    i2.tabel_hidden_informasi as child_tabel,i2.hidden_informasi as child_field from detail_informasi di
    join informasi i1 on i1.id=di.parent_id
    join informasi i2 on i2.id=di.child_id
    where di.id_informasi=$id";
    $hasil=  _select_unique_results($sql);
    return array_change_key_case($hasil);
}

function rekening_transaksi_relasi_tabel($tabel,$detail_tabel){
    $sql="SELECT rt. * ,i.tabel_hidden_informasi AS tabel, i.hidden_informasi AS field, kt.nama AS nama_kategori_transaksi,rc.status as status_rekening
    FROM rekening_transaksi rt
    JOIN informasi i ON i.id = rt.id_informasi
    JOIN kategori_transaksi kt ON kt.id = rt.id_kategori_transaksi
    JOIN rekening rc on rc.id=rt.id_rekening
    WHERE i.tabel_hidden_informasi = '$tabel' or i.tabel_hidden_informasi = '$detail_tabel'";
    $hasil=  _select_arr($sql);
    return array_key_to_lower($hasil);
}

function operator_proses($keterangan){
    $operator=null;
    switch ($keterangan) {
        case 'Tambah':
        $operator='+';
        break;
        case 'Kurang':
        $operator='-';
        break;
        case 'Bagi':
        $operator='/';
        break;
        case 'Kali':
        $operator='*';
        break;
        default:
        break;
    }
    return $operator;
}

function operator_proses2($awal,$proses,$akhir){
    //echo $awal.' '.$proses.' '.$akhir;
    $nilai=0;
    switch ($proses) {
        case 'Tambah':
        $nilai=$awal+$akhir;
        break;
        case 'Kurang':
        $nilai=$awal-$akhir;
        break;
        case 'Bagi':
        $nilai=$awal/$akhir;
        break;
        case 'Kali':
        $nilai=$awal*$akhir;
        break;
        default:
        break;
    }
    return $nilai;
}

function get_nilai_proses_transaksi($id_informasi,$id_transaksi,$tabel,$detail_tabel){
    $sql="SELECT * FROM `informasi` WHERE `id` =$id_informasi";
    $query=  _select_unique_results($sql);
    $hasil=  array_change_key_case($query);

    if($hasil['hidden_informasi']==null){
        $proses_informasi=  get_proses_informasi($id_informasi);
        if($proses_informasi['parent_field']!=null&&$proses_informasi['child_field']!=null){
            if(preg_match('/^detail_[a-z]*/',$proses_informasi['parent_tabel'])>0){
                $sql="select ($proses_informasi[parent_field]".  operator_proses($proses_informasi['keterangan'])."$proses_informasi[child_field]) as hasil from $proses_informasi[parent_tabel] where id_$tabel=$id_transaksi";
                $hasil= array_key_to_lower(_select_arr($sql));
                $nilai=array();
                foreach($hasil as $h){
                    array_push($nilai, $h['hasil']);
                }
            }else{
                //$awal=DBConnection::$conn->fetchColumn("select $proses_informasi[parent_field] from $proses_informasi[parent_tabel] where id=$id_transaksi");
                $nilai=0;
            }
        }else{
            if($proses_informasi['parent_field']!=null){
                if(preg_match('/^detail_[a-z]*/',$proses_informasi['parent_tabel'])>0){
                    $sql="select $proses_informasi[parent_field] as hasil from $proses_informasi[parent_tabel] where id_$tabel=$id_transaksi";
                    $hasil= array_key_to_lower(_select_arr($sql));
                    $awal=array();
                    foreach($hasil as $h){
                        if($proses_informasi['parent_field']=='diskon'){
                            array_push($awal, $h['hasil']/100);
                        }else{
                            array_push($awal, $h['hasil']);
                        }
                    }
                }else{
                    $awal=DBConnection::$conn->fetchColumn("select $proses_informasi[parent_field] from $proses_informasi[parent_tabel] where id=$id_transaksi");
                    if($proses_informasi['parent_field']=='ppn'){
                        $awal/=100;
                    }
                }
            }else{
                $awal=  get_nilai_proses_transaksi($proses_informasi['parent_id'], $id_transaksi, $tabel, $detail_tabel);
            }
            if($proses_informasi['child_field']!=null){
                if(preg_match('/^detail_[a-z]*/',$proses_informasi['child_tabel'])>0){
                    $sql="select $proses_informasi[child_field] as hasil from $proses_informasi[child_tabel] where id_$tabel=$id_transaksi";
                    $hasil= array_key_to_lower(_select_arr($sql));
                    $akhir=array();
                    foreach($hasil as $h){
                        if($proses_informasi['child_field']=='diskon'){
                            array_push($akhir, $h['hasil']/100);
                        }else{
                            array_push($akhir, $h['hasil']);
                        }
                    }
                }else{
                    $akhir=DBConnection::$conn->fetchColumn("select $proses_informasi[child_field] from $proses_informasi[child_tabel] where id=$id_transaksi");
                    if($proses_informasi['child_field']=='ppn'){
                        $akhir/=100;
                    }
                }
            }else{
                $akhir=  get_nilai_proses_transaksi($proses_informasi['child_id'], $id_transaksi, $tabel, $detail_tabel);
            }
//            show_array($awal);
//            show_array($akhir);
            if(is_array($awal)&&  is_array($akhir)){
                $nilai=0;
                foreach($awal as $key=>$aw){
                    $nilai+=operator_proses2($aw, $proses_informasi['keterangan'], $akhir[$key]);
                }
            }else if(is_array($awal)){
                $nilai=  operator_proses2(array_sum($awal), $proses_informasi['keterangan'], $akhir);
            }else if(is_array($akhir)){
                $nilai=  operator_proses2($awal, $proses_informasi['keterangan'], array_sum($akhir));
            }else{
                $nilai=  operator_proses2($awal, $proses_informasi['keterangan'], $akhir);
            }
        }
    }else{
        $nilai=DBConnection::$conn->fetchColumn("select $hasil[hidden_informasi] from $hasil[tabel_hidden_informasi] where id=$id_transaksi");
    }
    return $nilai;
}

function jurnal_transaksi($id,$tabel,$detail_tabel,$total_tagihan=null){
    $transaksi=  array_change_key_case(_select_unique_results('select * from '.$tabel.' where id='.$id));
    $id_rek_trans_temp=0;
    $id_jurnal=null;
    $rekening_transaksi=rekening_transaksi_relasi_tabel($tabel,$detail_tabel);
    //die(show_array($rekening_transaksi));
    if($total_tagihan==null){
        $total_tagihan=$transaksi['total_tagihan'];
    }

    foreach($rekening_transaksi as $key=>$rt){
        if($id_rek_trans_temp!=$rt['id_kategori_transaksi']){
            $no_bukti=  get_nomor_bukti();
            $sql="INSERT INTO jurnal(tanggal,nama,kode_bukti,nomor_bukti,jumlah,status) VALUES (:tanggal,'".$rt['nama_kategori_transaksi']."',:kode_bukti,$no_bukti,$total_tagihan,'1')";
            $query=  DBConnection::$conn->prepare($sql);
            $query->bindValue(':tanggal',new DateTime($transaksi['waktu']),'date');
            $query->bindValue(':kode_bukti',$tabel=='pembelian'?'BKK':'BKP','string');
            try{
                $query->execute();
                $id_jurnal = _last_id('jurnal');
                $id_rek_trans_temp=$rt['id_kategori_transaksi'];
            }catch(Exception $err){
                show_array($err);
                exit();
            }
        }
        if($id_jurnal!=null){
            $jumlah=  get_nilai_proses_transaksi($rt['id_informasi'], $id, $tabel, $detail_tabel);
            if(is_array($jumlah)){
                $jumlah=array_sum($jumlah);
            }
            $sql2="INSERT INTO detail_jurnal(id_jurnal,id_rekening,jumlah,status) VALUES (?,?,?,?)";
            $query2=  DBConnection::$conn->prepare($sql2);
            $query2->bindValue(1,$id_jurnal,'integer');
            $query2->bindValue(2,$rt['id_rekening'],'integer');
            $query2->bindValue(3,$jumlah,'float');
            $query2->bindValue(4,$rt['status'],'string');
            try{
                $query2->execute();
                $saldo_awal=  get_last_saldo();
                $saldo_akhir=0;
                if(($rt['status']=='D'&&$rt['status_rekening']==1)||($rt['status']=='K'&&$rt['status_rekening']==0)){
                    $saldo_akhir=$saldo_awal+$jumlah;
                }else{
                    $saldo_akhir=$saldo_awal-$jumlah;
                }
                $sql3="INSERT INTO saldo(jumlah,jumlah_akhir,tanggal,id_rekening) VALUES (:jumlah,:jumlah_akhir,:tanggal,:id_rekening)";
                $query3=  DBConnection::$conn->prepare($sql3);
                $query3->bindValue(':jumlah',$saldo_akhir,'float');
                $query3->bindValue(':jumlah_akhir',$saldo_akhir,'float');
                $query3->bindValue(':tanggal',new DateTime(date('Y-m-d')),'date');
                $query3->bindValue(':id_rekening',$rt['id_rekening'],'integer');
                try{
                    $query3->execute();
                    DBConnection::$conn->insert('relasi_transaksi', array('id_transaksi'=>$id,'nama_tabel'=>$tabel,'id_rekening_transaksi'=>$rt['id']));
                }catch(Exception $err){
                    show_array($err);
                    exit();
                }
            }catch(Exception $err){
                show_array($err);
                exit();
            }
        }
    }
}

function getBulanSetahun() {
    $bulan =  array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
    return $bulan;
}

function quote_string_nama($nama){
  return substr(DBConnection::$conn->quote($nama, \PDO::PARAM_STR),1,-1);
}

function add_option($value,$label=null,$obj=null){
    if($obj == $value){
        $show = '<option value="'.$value.'" selected>'.$label.'</option>';
    }else{
        $show = '<option value="'.$value.'">'.$label.'</option>';
    }
    return $show;
}

function load_sistem_lama($title,$url){
  if(defined('OLD_SYSTEM_URL')) {
    $fungsi = 'load_sistem_lama(\''.$title.'\', \''.app_base_url('admisi/informasi/frame-sistem-lama').'\', \''.OLD_SYSTEM_URL.$url.'\')';
    echo '<a class="cetak"
    onclick="'.$fungsi.'"
    href="#">'.$title.'</a>';
}
}
function hilangkangKomaAtas($var){
    $result = str_replace("'", ' ', $var);
    return $result;
}
function datediff($tgl1, $tgl2){
  $tgl1 = strtotime($tgl1);
  $tgl2 = strtotime($tgl2);
  $diff_secs = abs($tgl1 - $tgl2);
  $base_year = min(date("Y", $tgl1), date("Y", $tgl2));
  $diff = mktime(0, 0, $diff_secs, 1, 1, $base_year);
  return array( "years" => date("Y", $diff) - $base_year, "months_total" => (date("Y", $diff) - $base_year) * 12 + date("n", $diff) - 1, "months" => date("n", $diff) - 1, "days_total" => floor($diff_secs / (3600 * 24)), "days" => date("j", $diff) - 1, "hours_total" => floor($diff_secs / 3600), "hours" => date("G", $diff), "minutes_total" => floor($diff_secs / 60), "minutes" => (int) date("i", $diff), "seconds_total" => $diff_secs, "seconds" => (int) date("s", $diff) );
}
function bulanhuruf($bln){
    switch ($bln){
     case 1:
      return "Januari";
      break;
     case 2:
      return "Februari";
      break;
     case 3:
      return "Maret";
      break;
     case 4:
      return "April";
      break;
     case 5:
      return "Mei";
      break;
     case 6:
      return "Juni";
      break;
     case 7:
      return "Juli";
      break;
     case 8:
      return "Agustus";
      break;
     case 9:
      return "September";
      break;
     case 10:
      return "Oktober";
      break;
     case 11:
      return "November";
      break;
     case 12:
      return "Desember";
      break;
    }
}

function translate_hari($number){

    switch ($number) {
        case '1':
            return "Senin";
            break;
        case '2':
            return "Selasa";
            break;
        case '3':
            return "Rabu";
            break;
        case '4':
            return "Kamis";
            break;
        case '5':
            return "Jumat";
            break;
        case '6':
            return "Sabtu";
            break;
        case '7':
            return "Minggu";
            break;
        default:
            return "";
            break;
    }
}


