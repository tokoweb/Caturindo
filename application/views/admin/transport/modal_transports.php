<!-- modal tambah data -->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title" id="myModalLabel">Add Transport</h4>
      </div>
      <div class="modal-body">
        <form class="form" method="post" action="<?=base_url()?>index.php/admin/transports/tambah_transport"  enctype='multipart/form-data'>
          <div class="form-group">
            <label>Name Transport</label>
            <input type="text" class="form-control" name="name_transport">
          </div>
          <div class="form-group">
            <label>Max People</label>
            <input type="number" class="form-control" name="max_people">
          </div>
          <div class="form-group">
            <label>Image</label>
            <input type="file" name="files[]" class="btn btn-default" multiple="">
          </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php if(!empty($transports)):?>

  <?php foreach($transports as $s):?>

    <!-- modal edit data -->
    <div class="modal fade" id="modalEdit<?=$s->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            <h3 class="modal-title" id="myModalLabel">Edit Transport <?=$s->name_transport?> <b><?=$s->id?></b></h3>
          </div>
          <div class="modal-body">
            <form class="form" method="post" action="<?=base_url()?>index.php/admin/transports/edit_transport/<?=$s->id?>" enctype='multipart/form-data'>

              <div class="form-group">
                <label>Name Transport</label>
                <input type="text" name="name_transport" class="form-control" value="<?=$s->name_transport?>">
              </div>
              <div class="form-group">
                <label>Max People</label>
                <input type="number" name="max_people" class="form-control" value="<?=$s->max_people?>">
              </div>
              <div class="form-group">
                <label>Image</label>
                <input type="file" name="files[]" class="btn btn-default" multiple="">
              </div>
              <div class="form-group row">
              <?php if(!empty($s->gambar)):?>
                
                <?php for($i=0; $i<sizeof($s->gambar); $i++):?>
                  <div class="col-sm-3">
                    <a href="#" data-toggle="modal" data-target="#modalEditGambar<?=$s->id_gambar[$i]?>" class="thumbnail">
                      <img src="<?=$s->gambar[$i]?>" style="max-height: 300px; min-height: 200px">
                    </a>
                  </div>
                <?php endfor?>
              <?php endif?>
              </div>

          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Hapus gambar -->
    <?php if(!empty($s->gambar)):?>
      <?php for($i=0; $i<sizeof($s->gambar); $i++):?>
        <div class="modal fade" id="modalEditGambar<?=$s->id_gambar[$i]?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h2 class="modal-title" id="myModalLabel"><b>Apakah Ingin menghapus gambar ini ?</b></h2>
              </div>
              <div class="modal-body">
                <form class="form" method="post" action="<?=base_url()?>index.php/admin/transports/hapus_gambar/<?=$s->id_gambar[$i]?>">
                <div class="form-group row">
                  <div class="col-lg-12">
                    <img src="<?=$s->gambar[$i]?>" class="img img-responsive">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-sm btn-primary">Hapus</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      <?php endfor?>
    <?php endif?>

    <!-- Hapus Transport -->
    <div class="modal fade" id="modalHapus<?=$s->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <form class="form" method="post" action="<?=base_url()?>index.php/admin/transports/hapus_transport/<?=$s->id?>">

              Yakin menghapus data ini ?

          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
              <button type="submit" class="btn btn-primary">Iya</button>
            </form>
          </div>
        </div>
      </div>
    </div>

  <?php endforeach?>

<?php endif?>