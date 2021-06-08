<!-- Modal edit status user -->
<?php foreach($data as $s):?>

  <!-- modal edit jabatan -->
  <div class="modal fade" id="modalJabatan<?=$s->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h5 class="modal-title" id="myModalLabel"><?=$s->username?></h4>
        </div>
        <div class="modal-body">
          <form class="form" method="post" action="<?=base_url()?>index.php/admin/users/edit_jabatan_user/<?=$s->id?>">
            <div class="form-group">
              <select class="form-control" name="role">

              <?php if(empty($s->role)):?>
                <option disabled selected>Pilih Jabatan User</option>
              <?php endif?>

              <?php foreach($role as $r):?>
                <?php if(!empty($s->role) && $s->role == $r->id):?>
                  <option disabled selected><?=$r->role?></option>
                  <?php if($s->role != $r->id):?>
                    <option value="<?=$r->id?>"><?=$r->role?></option>
                  <?php endif?>
                <?php else:?>
                    <option value="<?=$r->id?>"><?=$r->role?></option>
                <?php endif?>
              <?php endforeach?>

              </select>
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

  <!-- modal edit user aktif -->
  <div class="modal fade" id="modalStatus<?=$s->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h5 class="modal-title" id="myModalLabel"><?=$s->username?></h4>
        </div>
        <div class="modal-body">
          <form class="form" method="post" action="<?=base_url()?>index.php/admin/users/edit_status_user/<?=$s->id?>">
            <div class="form-group">
              <select class="form-control" name="status_aktif">

              <?php if(empty($s->user_aktif)):?>
                <option disabled selected>Pilih Status User</option>
              <?php endif?>

              <?php foreach($status_user as $r):?>
                <?php if(!empty($s->user_aktif) && $s->user_aktif == $r->id_status):?>
                  <option disabled selected><?=$r->status?></option>
                  <?php if($s->user_aktif != $r->id):?>
                    <option value="<?=$r->id_status?>"><?=$r->status?></option>
                  <?php endif?>
                <?php else:?>
                    <option value="<?=$r->id_status?>"><?=$r->status?></option>
                <?php endif?>
              <?php endforeach?>

              </select>
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

<?php endforeach?>

<!-- Modal edit user -->
<?php foreach($data as $s):?>
  <div class="modal fade" id="modalEdit<?=$s->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h5 class="modal-title" id="myModalLabel">Edit User <b><?=$s->username?></b></h4>
        </div>
        <div class="modal-body">
          <form class="form" method="post" action="<?=base_url()?>index.php/admin/users/aksi_edit_user/<?=$s->id?>">

            <div class="form-group">
              <label>Username</label>
              <input type="text" name="username" class="form-control" value="<?=$s->username?>">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" class="form-control" value="<?=$s->email?>">
            </div>
            <div class="form-group">
              <label>Phone</label>
              <input type="number" name="phone" class="form-control" value="<?=$s->phone?>">
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
<?php endforeach?>

<!-- Modal Hapus user -->
<?php foreach($data as $s):?>
  <div class="modal fade" id="modalHapus<?=$s->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <form class="form" method="post" action="<?=base_url()?>index.php/admin/users/hapus_user/<?=$s->id?>">

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