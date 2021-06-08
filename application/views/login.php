
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Caturindo | Administrator</title>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/icon.ico">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login1-page">

    <div class="login-box">
      <div class="row" style="padding-bottom:25px">
        <center>
            <img src="<?php echo base_url()?>assets/dist/img/caturindo.png" style="height:100px; width:100px" alt=""/>
        </center>
      </div>

      <div class="login-box-body">
        <p class="login-box-msg">Administrator</p>
		    <?php
            if (validation_errors() || $this->session->flashdata('error')) {
		    ?>
          <div class="alert alert-danger">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Warning!</strong>
              <?php echo validation_errors(); ?>
              <?php echo $this->session->flashdata('error'); ?>
          </div>
		    <?php } ?>
        <?=form_open('index.php/login/auth'); ?>
          <div class="form-group has-feedback">
            <input type="text" name="email" autofocus required="" class="form-control" placeholder="Email">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="pass" required="" class="form-control" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-md-6">
              <button type="submit" class="btn btn-primary btn-block btn-flat">
                <span class="fa fa-sign-in"></span> 
                Login
              </button>
            </div>
            <div class="col-md-6">
              <a href="<?=base_url('login/user')?>" class="btn btn-success btn-block btn-flat">
                <span class="fa fa-user"></span> User
              </a>
            </div>
          </div>
          <!-- <div class="form-group has-feedback">
            <button type="submit" class="btn btn-primary btn-block btn-flat">
              <span class="fa fa-sign-in"></span> 
              Login
            </button>
          </div>
          <div class="form-group has-feedback">
            <a href="<?=base_url('login/user')?>" class="text-center">
              <span class="fa fa-user"></span> User
            </a>
          </div> -->
        <?php echo form_close(); ?>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
