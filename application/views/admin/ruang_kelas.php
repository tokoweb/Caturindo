<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Ruang Kelas
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Ruang Kelas</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
          	<div class="row">          	
          	<div class="col-xs-12">
          		<div class="box">
                <div class="box-header">
                  <h3 class="box-title">
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
                        <th>Id Ruang Kelas</th>
                        <th>Nama Ruang Kelas</th>
                        <th>Alamat</th>
                        <th>Jam Operasional</th>
                        <th>Kapasitas</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                      	<?php  
                        $no = 1;
                        foreach ($data as $lihat):
                        ?>
                    	<tr>
                        <td><?php echo $no++ ?></td>
                    		<td><?php echo ucwords($lihat->id_ruang_kelas)?></td>
                        <td><?php echo ucwords($lihat->nama_ruang_kelas)?></td>
                        <td><?php echo ucwords($lihat->alamat_ruang_kelas)?></td>
                        <td><?php echo ucwords($lihat->jam_operasional_kelas)?></td>
                        <td><?php echo ucwords($lihat->kapasitas_kelas)?> orang</td>
                        <td align="center">
                          <div class="btn-group" role="group">
                            <a href="" class="btn btn-sm btn-primary btn-flat" data-toggle="modal" data-target="#modal-default"><i class="fa fa-edit"></i> Edit</a>
                            <a href="" onclick="javascript: return confirm('Anda yakin akan menghapus data ini ?')" class="btn btn-sm btn-danger btn-flat"><i class="fa fa-trash"></i> Hapus</a>
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
