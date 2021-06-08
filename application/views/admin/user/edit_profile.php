<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Edit Profile
    <!-- <small>Control panel</small> -->
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=base_url()?>index.php/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Edit Profile</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  
  	<div class="row">          	
  	<div class="col-xs-12">
  		<div class="box">
        <div class="box-header">
          <h3 class="box-title">
          </h3>
          <div class="box-tools">
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          
          <form class="form" method="post" action="<?=base_url()?>index.php/admin/users/aksi_edit_admin">
            
            <div class="container">
              <div class="form-group row">
                <div class="col-md-2">
                  <a href="#" data-toggle="modal" data-target="#modalGantiPassword" class="btn btn-sm btn-info btn-rounded">
                    Change Password
                  </a>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-11">
                  <hr>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-1">
                  <label>Name</label>
                </div>
                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" value="<?=$data_admin->name?>">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-1">
                  <label>Username</label>
                </div>
                <div class="col-md-6">
                  <input type="text" name="username" class="form-control" value="<?=$data_admin->username?>">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-1">
                  <label>Email</label>
                </div>
                <div class="col-md-6">
                  <input type="text" name="email" class="form-control" value="<?=$data_admin->email?>">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-1">
                  <label>Phone</label>
                </div>
                <div class="col-md-6">
                  <input type="text" name="phone" class="form-control" value="<?=$data_admin->phone?>">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-1">
                  <label>Whatsapp</label>
                </div>
                <div class="col-md-6">
                  <input type="text" name="whatsapp" class="form-control" value="<?=$data_admin->whatsapp?>">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-1">
                  <button type="submit" class="btn btn-sm btn-rounded btn-success">Update</button>
                </div>
              </div>
            </div>

          </form>

        </div><!-- /.box-body -->
        </div>
     </div>
  </div>

<?php $this->load->view('admin/user/modal_admin')?>
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
