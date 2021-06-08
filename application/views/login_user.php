<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V13</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?=base_url()?>assets/template/Login_v13/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/template/Login_v13/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/template/Login_v13/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/template/Login_v13/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/template/Login_v13/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/template/Login_v13/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/template/Login_v13/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/template/Login_v13/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/template/Login_v13/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/template/Login_v13/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/template/Login_v13/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/template/Login_v13/css/main.css">
<!--===============================================================================================-->
</head>
<body style="background-color: #999999;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="login100-more" style="background-image: url('<?=base_url()?>assets/template/Login_v13/images/bg-01.jpg');"></div>

			<div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
				<form class="login100-form validate-form" action="<?=base_url('login/auth/user')?>" method="post">
					<span class="login100-form-title p-b-59">
						User Manager
					</span>

					<div class="wrap-input100 validate-input" data-validate="Email is required: ex@abc.xyz">
						<span class="label-input100">Email</span>
						<input class="input100" type="email" name="email" placeholder="email ...">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="pass" placeholder="password">
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn justify-content-center">

						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" class="login100-form-btn">
								Sign In
							</button>
						</div>

						<a href="<?=base_url('login')?>" class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30">
							Admin
							<i class="fa fa-long-arrow-right m-l-5"></i>
						</a>

					</div>
				</form>
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->
	<script src="<?=base_url()?>assets/template/Login_v13/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url()?>assets/template/Login_v13/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url()?>assets/template/Login_v13/vendor/bootstrap/js/popper.js"></script>
	<script src="<?=base_url()?>assets/template/Login_v13/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url()?>assets/template/Login_v13/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url()?>assets/template/Login_v13/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?=base_url()?>assets/template/Login_v13/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url()?>assets/template/Login_v13/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url()?>assets/template/Login_v13/js/main.js"></script>

	<script src="https://cdn.jsdelivr.net/gh/abhiprojectz/alertia/dist/alertia.js"></script>

	<?php if(!empty($this->session->flashdata('error'))):?>
	<script type="text/javascript"> 
	alertia({
		'msg': "<?=$this->session->flashdata('error')?>",
		'type': 'danger'
	});
	</script>
	<?php endif?>

</body>
</html>