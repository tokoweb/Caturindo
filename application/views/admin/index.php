<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Caturindo | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/ionicons/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datepicker/datepicker3.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="<?=base_url()?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>A</b>SM</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Caturindo</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown">
        			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Selamat Datang, <?php echo $this->session->userdata('admin_user')?> <span class="caret"></span>
                </a>
          			  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo base_url() . "index.php/admin/users/edit_admin"?>">Edit Admin</a></li>
            				<li><a href="<?php echo base_url() . "index.php/admin/home/logout"?>">Logout</a></li>
          			  </ul>
      			  </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="<?php if($page == 'home'){echo 'active';} ?>">
              <a href="<?php echo base_url(); ?>index.php/admin">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
            <li class="<?php if($page == 'manage_user'){echo 'active';} ?>">
              <a href="<?php echo base_url(); ?>index.php/admin/users">
                <i class="fa fa-user"></i> <span>Users</span>
              </a>
            </li>
            <li class="<?php if($page == 'room/index'){echo 'active';} ?>">
              <a href="<?php echo base_url(); ?>index.php/admin/rooms">
                <i class="fa fa-building"></i> <span>Rooms</span>
              </a>
            </li>
            <li class="<?php if($page == 'transport/index'){echo 'active';} ?>">
              <a href="<?php echo base_url(); ?>index.php/admin/transports">
                <i class="fa fa-car"></i> <span>Transports</span>
              </a>
            </li>
            <li class="<?php if($page == 'meeting/index'){echo 'active';} ?>">
              <a href="<?php echo base_url(); ?>index.php/admin/meetings">
                <i class="fa fa-users"></i> <span>Meetings</span>
              </a>
            </li>
            <li class="<?php if($page == 'sub_meeting/index'){echo 'active';} ?>">
              <a href="<?php echo base_url(); ?>index.php/admin/submeeting">
                <i class="fa fa-users"></i> <span>Sub Meetings</span>
              </a>
            </li>
            <li class="<?php if($page == 'task/index'){echo 'active';} ?>">
              <a href="<?php echo base_url(); ?>index.php/admin/tasks">
                <i class="fa fa-book"></i> <span>Tasks</span>
              </a>
            </li>
            <!-- <li class="<?php if($page == 'transports'){echo 'active';} ?>">
              <a href="<?php echo base_url(); ?>index.php/admin/transports">
                <i class="fa fa-home"></i> <span>Transports</span>
              </a>
            </li> -->
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
      
      <?php $this->load->view('admin/'.$page); ?>

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; <?php echo date('Y') ?> <a href="#">Caturindo</a>.</strong> All rights reserved.
      </footer>
    </div><!-- ./wrapper -->

    <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Warning</h4>
          </div>
          <div class="modal-body">
            <p>Anda tidak memiliki akses!</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $(function () {
        $("#example1").DataTable({
          "language": {
              "url": "<?php echo base_url(); ?>assets/plugins/datatables/Indonesian.json",
              "sEmptyTable": "Tidak ada data di database"
          },
          responsive: true
        });
      });
      $(function() {
          $( "#tgl_surat" ).datepicker({
            autoclose: true
          });
        });
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- datepicker -->
    <script src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>assets/dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo base_url(); ?>assets/dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript">
      <?php if(!empty($this->session->flashdata('pesan_gagal'))):?>
          swal("Failed", "<?=$this->session->flashdata('pesan_gagal')?>", "error");
      <?php elseif(!empty($this->session->flashdata('pesan_berhasil'))):?>
          swal("Sukses", "<?=$this->session->flashdata('pesan_berhasil')?>", "success");
      <?php elseif($this->session->flashdata('berhasil_edit') == 'yes'):?>
          swal("Sukses", "<?=$this->session->flashdata('pesan')?>", "success");
      <?php elseif($this->session->flashdata('berhasil_edit') == 'no'):?>
          swal("Gagal edit admin", "<?=$this->session->flashdata('pesan')?>", "error");
      <?php endif?>
    </script>

  </body>
</html>
