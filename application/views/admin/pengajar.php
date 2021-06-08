<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Pengajar
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Pengajar</li>
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
                        <th>Id User</th>
                        <th>Username</th>
                        <th>Nama Pengajar</th>
                        <th>Jenis Kelamin</th>
                        <th>Pendidikan</th>
                        <th>No Telpon</th>
                        <th>Email</th>
                        <th>Alamat KTP</th>
                        <th>Alamat Tinggal</th>
                        <th>Nama Bank</th>
                        <th>No Rekening</th>
                        <th>Referensi</th>
                        <th>Foto Pengajar</th>
                        <th>Foto KTP</th>
                        <th>Foto Buku Tabungan</th>
                        <th>Foto Ijazah Lainnya</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                      	<?php
                        $no = 1;
                        foreach ($data as $lihat):
                        ?>
                    	<tr>
                        <td><?php echo $no++ ?></td>
                    		<td><?php echo $lihat->id_pengajar?></td>
                        <td><?php echo $lihat->username?></td>
                        <td><?php echo $lihat->nama_pengajar?></td>
                        <?php if($lihat->jenis_kelamin == 1){?>
                          <td><?= "Pria"?></td>
                        <?php } else {?>
                          <td><?= "Wanita"?></td>
                        <?php }?>
                        <td><?php echo $lihat->pendidikan?></td>
                        <td><?php echo $lihat->no_telpon_pengajar?></td>
                        <td><?php echo $lihat->email?></td>
                        <td><?php echo $lihat->alamat_tinggal?></td>
                        <td><?php echo $lihat->alamat_ktp?></td>
                        <td><?php echo $lihat->nama_bank?></td>
                        <td><?php echo $lihat->no_rekening_bank?></td>
                        <td><?php echo $lihat->referensi?></td>
                        <td>
                          <a href="<?php echo $lihat->foto_pengajar?>" target="_blank">
                            <img class="img-responsive" style="max-width: 100%; max-height:100%; height:50px; width:100px;" src="<?php echo $lihat->foto_pengajar?>">
                          </a>
                        </td>
                        <td>
                          <a href="<?php echo $lihat->foto_ktp?>" target="_blank">
                            <img class="img-responsive" style="max-width: 100%; max-height:100%; height:50px; width:100px;" src="<?php echo $lihat->foto_ktp?>">
                          </a>
                        </td>
                        <td>
                          <a href="<?php echo $lihat->foto_buku_tabungan?>" target="_blank">
                            <img class="img-responsive" style="max-width: 100%; max-height:100%; height:50px; width:100px;" src="<?php echo $lihat->foto_buku_tabungan?>">
                          </a>
                        </td>
                        <td>
                          <a href="<?php echo $lihat->foto_ijazah_lainnya?>" target="_blank">
                            <img class="img-responsive" style="max-width: 100%; max-height:100%; height:50px; width:100px;" src="<?php echo $lihat->foto_ijazah_lainnya?>">
                          </a>
                        </td>
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
