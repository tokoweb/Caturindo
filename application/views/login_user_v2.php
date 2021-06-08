<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="description" content="Miminium Admin Template v.1">
  <meta name="author" content="Isna Nur Azis">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Caturindo</title>

  <!-- start: Css -->
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/template/miminium/asset/css/bootstrap.min.css">

  <!-- plugins -->
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/template/miminium/asset/css/plugins/font-awesome.min.css"/>
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/template/miminium/asset/css/plugins/simple-line-icons.css"/>
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/template/miminium/asset/css/plugins/animate.min.css"/>
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/template/miminium/asset/css/plugins/icheck/skins/flat/aero.css"/>
  <link href="<?=base_url()?>assets/template/miminium/asset/css/style.css" rel="stylesheet">
  <!-- end: Css -->

  <!-- <link rel="shortcut icon" href="<?=base_url()?>assets/template/miminium/asset/img/logomi.png"> -->
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    </head> 

    <body id="mimin" class="dashboard form-signin-wrapper">

      <div class="container">

        <div class="col-md-12" style="margin-top: 100px">
          
          <form class="form-signin" action="<?=base_url('login/auth/user')?>" method="post" autocomplete="off">
            <div class="panel periodic-login">
                <!-- <span class="atomic-number">28</span> -->
                <div class="panel-body text-center">
                    <!-- <h1 class="atomic-symbol">Caturindo</h1> -->
                    <p class="atomic-mass">Manajer</p>
                    <!-- <p class="element-name">Miminium</p> -->

                    <i class="icons icon-arrow-down"></i>
                    <div class="form-group form-animate-text" style="margin-top:40px !important;">
                      <input type="text" class="form-text" name="email" autocomplete="off" required>
                      <span class="bar"></span>
                      <label>Email</label>
                    </div>
                    <div class="form-group form-animate-text" style="margin-top:40px !important;">
                      <input type="password" class="form-text" autocomplete="new-password" name="pass" required>
                      <span class="bar"></span>
                      <label>Password</label>
                    </div>
                    <label class="pull-left">
                    <input type="checkbox" class="icheck pull-left" name="remember"/> Remember me
                    </label>
                    <input type="submit" class="btn col-md-12" value="Login"/>
                </div>
                  <div class="text-center" style="padding:5px;">
                      <a href="<?=base_url('login')?>">Login Admin</a>
                  </div>
            </div>
          </form>

        </div>

      </div>

      <!-- end: Content -->
      <!-- start: Javascript -->
      <script src="<?=base_url()?>assets/template/miminium/asset/js/jquery.min.js"></script>
      <script src="<?=base_url()?>assets/template/miminium/asset/js/jquery.ui.min.js"></script>
      <script src="<?=base_url()?>assets/template/miminium/asset/js/bootstrap.min.js"></script>

      <script src="<?=base_url()?>assets/template/miminium/asset/js/plugins/moment.min.js"></script>
      <script src="<?=base_url()?>assets/template/miminium/asset/js/plugins/icheck.min.js"></script>

      <!-- custom -->
      <script src="<?=base_url()?>assets/template/miminium/asset/js/main.js"></script>
      <script type="text/javascript">
       $(document).ready(function(){
         $('input').iCheck({
          checkboxClass: 'icheckbox_flat-aero',
          radioClass: 'iradio_flat-aero'
        });
       });
     </script>
     <!-- end: Javascript -->

     <!-- NOTIFIKASI ALERT -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <?php if ($this->session->flashdata('error')):?>
    <script type="text/javascript">
      swal("Gagal", "<?=$this->session->flashdata('error')?>", "error");
    </script>
    <?php elseif($this->session->flashdata('berhasil')):?>
     <script type="text/javascript">
      swal("Berhasil", "<?=$this->session->flashdata('berhasil')?>", "success");
    </script>
    <?php endif?>
    <!-- END NOTIFIKASI ALERT -->

   </body>
   </html>