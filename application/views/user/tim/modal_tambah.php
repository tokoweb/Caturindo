<!-- MODAL TAMBAH TIM -->
<div class="modal fade" id="modalTambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Team</h4>
      </div>

      <?=form_open('user/tim/tambah_tim')?>

        <div class="modal-body">
          <input type="hidden" name="id_user" value="<?=$_SESSION['user_data']->id?>">

          <div class="form-group form-animate-text">
            <select class="form-text" required="" name="id_group" id="pilih-group">
              <?php if(!empty($data_group)):?>
                <option disabled="" selected="" value="">Pilih Group</option>
                <?php foreach($data_group as $dg):?>
                  <option value="<?=$dg->id?>"><?=$dg->nama_team?></option>
                <?php endforeach?>
              <?php else:?>
                <option disabled="" selected="" value="">Belum Ada Group</option>
              <?php endif?>
            </select>
          </div>

          <div class="form-group form-animate-text">
            <select class="select2-A form-text" style="width: 100%" name="id_member" id="muncul-member">
              <!-- <optgroup label="Alaskan/Hawaiian Time Zone">
                <option value="AK">Alaska</option>
                <option value="HI">Hawaii</option>
              </optgroup> -->
            </select>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

      <?=form_close()?>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END MODAL TAMBAH TIM -->

<!-- MODAL TAMBAH GROUP -->

<div class="modal fade" id="modalTambahGroup">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Group</h4>
      </div>

      <?=form_open('user/tim/tambah_group')?>

        <div class="modal-body">
          <input type="hidden" name="id_user" value="<?=$_SESSION['user_data']->id?>">

          <div class="form-group form-animate-text">
            <input type="text" name="nama_team" class="form-text" required="">
            <label>Nama Group</label>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

      <?=form_close()?>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- END MODAL TAMBAH GROUP -->