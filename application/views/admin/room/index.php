<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Manage Rooms
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=base_url(); ?>index.php/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Manage Rooms</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  
  	<div class="row">          	
  	<div class="col-xs-12">
  		<div class="box">
        <div class="box-header">
          <h3 class="box-title">
          	<a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalTambah">
          		Add Room
          	</a>
          </h3>
          <div class="box-tools">
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">

          <table id="example1" class="table table-bordered table-hover dataTable" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Code Room</th>
                <th>Name Room</th>
                <th>Max People</th>
                <th>Aksi</th>
            </thead>
            <tbody>
          	<?php if(!empty($rooms)):?>
          		<?php $no=0; foreach($rooms as $r):?>
          			<tr>
          				<td><?=++$no?></td>
          				<td><?=$r->code_room?></td>
          				<td><?=$r->name_room?></td>
          				<td><?=$r->max_people?></td>
          				<td>
          					<a href="#" data-toggle="modal" data-target="#modalEdit<?=$r->code_room?>" class="btn btn-sm btn-warning btn-flat">
                      <i class="fa fa-edit"></i>
                    </a>
                    <a href="#" data-toggle="modal" data-target="#modalHapus<?=$r->code_room?>" class="btn btn-sm btn-danger btn-flat">
                      <i class="fa fa-trash"></i>
                    </a>
          				</td>
          			</tr>
          		<?php endforeach?>
          	<?php endif?>
            </tbody>
          </table>
          
        </div><!-- /.box-body -->
        </div>
     </div>
  </div>

<?php $this->load->view('admin/room/modal_rooms')?>

</section><!-- /.content -->
</div><!-- /.content-wrapper -->
