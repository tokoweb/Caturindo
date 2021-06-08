<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Siswa
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Siswa</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          	<div class="row">
          	<div class="col-xs-12">
          		<div class="box">
                <div class="box-header">
                  <h3 class="box-title">
                    <!--<a href="<?php echo base_url(); ?>admin/tambah_pengajar" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-edit"></i> Tambah</a>-->
                  	<a href="" class="btn btn-sm btn-primary btn-flat" data-toggle="modal" data-target="#modal-default"><i class="fa fa-edit"></i> Tambah</a>
                  </h3>
                  <div class="box-tools">
                  	<!--
                    <div class="input-group" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search">
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                    -->
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                  <table id="example1" class="table table-bordered table-hover dataTable">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Id User</th>
                        <th>Username</th>
                        <th>Nama Siswa</th>
                        <th>No Telpon</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                      	<?php
                        $no = 1;
                        foreach ($data as $lihat):
                        ?>
                    	<tr>
                        <td><?php echo $no++ ?></td>
                    		<td><?php echo $lihat->id_siswa?></td>
                        <td><?php echo $lihat->username?></td>
                        <td><?php echo $lihat->nama_siswa?></td>
                        <td><?php echo $lihat->no_telpon_siswa?></td>
                        <td><?php echo $lihat->email?></td>
                        <td align="center">
                          <div class="btn-group" role="group">
                            <a href="" class="btn btn-sm btn-primary btn-flat" data-toggle="modal" data-target="#modal-default"><i class="fa fa-edit"></i> Edit</a>
                            <a href="" onclick="javascript: return confirm('Anda yakin akan menghapus data ini ?')" class="btn btn-sm btn-danger btn-flat"><i class="fa fa-trash"></i> Hapus</a>
                            <!--<a href="<?php echo base_url(); ?>admin/edit_siswa/<?php echo $lihat->id_user ?>" class="btn btn-sm btn-primary btn-flat" data-toggle="modal" data-target="#modal-default"><i class="fa fa-edit"></i> Edit</a>-->
                            <!--<a href="<?php echo base_url(); ?>admin/hapus_siswa/<?php echo $lihat->id_user ?>" onclick="javascript: return confirm('Anda yakin akan menghapus data ini ?')" class="btn btn-sm btn-danger btn-flat"><i class="fa fa-trash"></i> Hapus</a>-->
                          </div>
                        </td>
                    	</tr>
                    	<?php endforeach; ?>
                    </tbody>
                  </table>

                </div><!-- /.box-body -->
                </div>
             </div>
          </div>


        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
