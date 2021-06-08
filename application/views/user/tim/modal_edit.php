<!-- EDIT DATA GROUP -->

<?php if(!empty($data_group)):?>
  <?php foreach($data_group as $dt):?>

    <div class="modal fade" id="modalEdit<?=$dt->id?>">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edit Group <?=$dt->nama_team?></h4>
          </div>

          <form action="<?=base_url('user/tim/edit_group/')?><?=$dt->id?>" method="post">
            <div class="modal-body form-element">
              <div class="form-group form-animate-text" style="margin-top:40px !important;">
                <input type="hidden" name="id_user" value="<?=$dt->id_user?>">
                <input type="text" class="form-text" name="nama_team" value="<?=$dt->nama_team?>" required>
                <span class="bar"></span>
                <label>Nama Group</label>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>

        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

  <?php endforeach?>
<?php endif?>