<!-- modal tambah data -->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title" id="myModalLabel">Add Room</h4>
      </div>
      <div class="modal-body">
        <form class="form" method="post" action="<?=base_url()?>index.php/admin/rooms/tambah_room"  enctype='multipart/form-data'>
          <div class="form-group">
            <label>Name Room</label>
            <input type="text" class="form-control" name="name_room">
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

<?php if(!empty($rooms)):?>

<!-- modal edit data -->
  <?php foreach($rooms as $s):?>

    <div class="modal fade" id="modalEdit<?=$s->code_room?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            <h3 class="modal-title" id="myModalLabel">Edit Room <?=$s->name_room?> <b><?=$s->code_room?></b></h3>
          </div>
          <div class="modal-body">
            <form class="form" method="post" action="<?=base_url()?>index.php/admin/rooms/edit_room/<?=$s->code_room?>" enctype='multipart/form-data'>

              <div class="form-group">
                <label>Name Room</label>
                <input type="text" name="name_room" class="form-control" value="<?=$s->name_room?>">
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
                <form class="form" method="post" action="<?=base_url()?>index.php/admin/rooms/hapus_gambar/<?=$s->id_gambar[$i]?>">
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

    <div class="modal fade" id="modalHapus<?=$s->code_room?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <form class="form" method="post" action="<?=base_url()?>index.php/admin/rooms/hapus_room/<?=$s->code_room?>">

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