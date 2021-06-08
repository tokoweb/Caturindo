<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Tasks
    <!-- <small>Control panel</small> -->
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=base_url(); ?>index.php/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Tasks</li>
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

          <table id="example1" class="table table-bordered table-hover dataTable" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>User Create Task</th>
                <th>Task Id</th>
                <th>Task Name</th>
                <th>Description</th>
                <th>Date</th>
                <th>Meeting Id</th>
                <th>Meeting Title</th>
            </thead>
            <tbody>
          	<?php if(!empty($tasks)):?>
          		<?php $no=0; foreach($tasks as $r):?>
          			<tr>
          				<td><?=++$no?></td>
                  <td><?=$r->created_user?></td>
          				<td><?=$r->id?></td>
          				<td><?=$r->name_task?></td>
          				<td><?=$r->description?></td>
                  <td><?=tgl_indo($r->created)?></td>
                  <td><?=$r->code_meting?></td>
                  <td><?=$r->title?></td>
          			</tr>
          		<?php endforeach?>
          	<?php endif?>
            </tbody>
          </table>
          
        </div><!-- /.box-body -->
        </div>
     </div>
  </div>


</section><!-- /.content -->
</div><!-- /.content-wrapper -->
