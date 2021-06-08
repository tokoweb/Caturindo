<!DOCTYPE html>
<html lang="en">
<head>
	
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
	<meta charset="utf-8">
	<meta name="description" content="Miminium Admin Template v.1">
	<meta name="author" content="Isna Nur Azis">
	<meta name="keyword" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Caturindo Manajer</title>
 
    <!-- start: Css -->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/template/miminium/asset/css/bootstrap.min.css">

      <!-- plugins -->
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/template/miminium/asset/css/plugins/font-awesome.min.css"/>
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/template/miminium/asset/css/plugins/simple-line-icons.css"/>
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/template/miminium/asset/css/plugins/animate.min.css"/>
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/template/miminium/asset/css/plugins/fullcalendar.min.css"/>
	<link href="<?=base_url()?>assets/template/miminium/asset/css/style.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/template/miminium/asset/css/plugins/datatables.bootstrap.min.css"/>
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/template/miminium/asset/css/plugins/select2.min.css"/>
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/template/miminium/asset/css/plugins/animate.min.css"/>
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/template/miminium/asset/css/plugins/spinkit.css"/>
	<!-- end: Css -->

	<!-- <link rel="shortcut icon" href="<?=base_url()?>assets/template/miminium/asset/img/logomi.png"> -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

 <body id="mimin" class="dashboard">
      
      <?php $this->load->view('user/content/header')?>

      <div class="container-fluid mimin-wrapper">
  
          <?php $this->load->view('user/content/sidebar')?>

  		
          <?php $this->load->view($konten)?>
          
      </div>

    <?php $this->load->view('user/content/sidebar_mobile')?>

    <?php $this->load->view('user/content/footer')?>
  </body>
</html>