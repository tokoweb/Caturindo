<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Meetings
    <!-- <small>Control panel</small> -->
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=base_url(); ?>index.php/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Meetings</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  
  	<div class="row"> 

      <!-- filter tanggal -->
      <div class="col-xs-6 col-xs-offset-3">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">
              Filter Waktu Meeting
            </h3>
            <div class="box-tools">
            </div>
          </div><!-- /.box-header -->
          <div class="box-body">
            
            <form class="form" action="" method="get">
              <div class="row">
                <div class="form-group col-xs-4">
                  <label>Tanggal Awal</label>
                  <input type="date" name="tgl_awal" class="form-control" required="">
                </div>
                <div class="form-group col-xs-4">
                  <label>Tanggal Akhir</label>
                  <input type="date" name="tgl_akhir" class="form-control" required="">
                </div>
                <div class="form-group col-xs-2">
                  <label></label>
                  <input type="submit" class="btn btn-sm btn-success form-control" name="tombol" value="Cari">
                </div>
                <div class="form-group col-xs-2">
                  <label></label>
                  <a href="<?=base_url('admin/meetings')?>" class="btn btn-sm btn-default form-control">Clear</a>
                </div>
              </div>
            </form>

          </div><!-- /.box-body -->
        </div>
      </div>

    	<div class="col-xs-12">
    		<div class="box">
          <div class="box-header">
            <h4 class="text-center">
              <?=$judul?>
            </h4>
            <div class="box-tools">
            </div>
          </div><!-- /.box-header -->
          <div class="box-body">

            <table id="example1" class="table table-bordered table-hover dataTable" style="width:100%">
              <thead>
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">User Create Meeting</th>
                  <th class="text-center">Meeting Id</th>
                  <th class="text-center">Group</th>
                  <th class="text-center">Meeting Title</th>
                  <th class="text-center">Description</th>
                  <th class="text-center">Date</th>
                  <th class="text-center">File</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Location</th>
              </thead>
              <tbody>
            	<?php if(!empty($meetings)):?>
            		<?php $no=0; foreach($meetings as $r):?>
            			<tr>
            				<td class="text-center"><?=++$no?></td>
                    <td class="text-center"><?=$r->creator?></td>
            				<td class="text-center"><?=$r->id?></td>
                    <td class="text-center">
                      <?php if(!empty($r->nama_group)):?>
                        <a href="#" class="label label-primary" data-toggle="modal" data-target="#member<?=$r->id?>">
                          <?=$r->nama_group?>
                        </a>
                      <?php endif?>
                    </td>
            				<td class="text-center"><?=$r->title?></td>
            				<td class="text-center"><?=$r->description?></td>
                    <td class="text-center"><?=tgl_indo($r->date)?></td>
                    <td class="text-center">
                      <?php if(!empty($r->file)):?>
                        <?php $no_file=1; foreach($r->file as $df):?>
                          <a href="<?=$df?>" class="text-default" target="_blank">
                            File <?=$no_file++?>
                          </a>
                          <br>
                        <?php endforeach?>
                      <?php endif?>
                    </td>
                    <td class="text-center"><?=$r->meeting_status?></td>
                    <td class="text-center"><?=$r->location?></td>
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
<?php $this->load->view('admin/meeting/modal_member')?>