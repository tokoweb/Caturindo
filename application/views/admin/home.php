<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Small boxes (Stat box) -->
          <div class="row">

            <div class="col-lg-3 col-xs-3">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo $users ?></h3>
                  <p>Users</p>
                </div>
                <div class="icon">
                  <i class="fa fa-user"></i>
                </div>
                <a href="<?=base_url() ?>index.php/admin/users" class="small-box-footer">More info <i class="fa fa-user"></i></a>
              </div>
            </div><!-- ./col -->

            <div class="col-lg-3 col-xs-3">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $meetings; ?></h3>
                  <p>Meetings</p>
                </div>
                <div class="icon">
                  <i class="fa fa-users"></i>
                </div>
                <a href="<?=base_url(); ?>index.php/admin/meetings" class="small-box-footer">More info <i class="fa fa-users"></i></a>
              </div>
            </div><!-- ./col -->

            <div class="col-lg-3 col-xs-3">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo $tasks; ?></h3>
                  <p>Tasks</p>
                </div>
                <div class="icon">
                  <i class="fa fa-book"></i>
                </div>
                <a href="<?=base_url(); ?>index.php/admin/tasks" class="small-box-footer">More info <i class="fa fa-book"></i></a>
              </div>
            </div><!-- ./col -->

            <div class="col-lg-3 col-xs-3">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo $transports; ?></h3>
                  <p>Transport</p>
                </div>
                <div class="icon">
                  <i class="fa fa-home"></i>
                </div>
                <a href="<?=base_url(); ?>index.php/admin/transports" class="small-box-footer">More info <i class="fa fa-home"></i></a>
              </div>
            </div><!-- ./col -->

          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
