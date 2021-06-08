<!-- HAPUS DATA TIM -->

<?php if(!empty($data_tim)):?>
  <?php foreach($data_tim as $dt):?>

    <div class="modal fade" id="modalHapusTim<?=$dt->id_team?>">
      <div class="modal-dialog">
        <div class="modal-content">

          <form action="<?=base_url('user/tim/hapus_tim/')?><?=$dt->id_team?>" method="post">
            <div class="modal-body">
              <h2 class="text-center">
                Anda yakin menghapus member ini ?
              </h2>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
              <button type="submit" class="btn btn-primary">Ya</button>
            </div>
          </form>

        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

  <?php endforeach?>
<?php endif?>

<!-- HAPUS DATA GROUP -->
<?php if(!empty($data_group)):?>
  <?php foreach($data_group as $dg):?>

    <div class="modal fade" id="modalHapusGroup<?=$dg->id?>">
      <div class="modal-dialog">
        <div class="modal-content">

          <form action="<?=base_url('user/tim/hapus_group/')?><?=$dg->id?>" method="post">
            <div class="modal-body">
              <h4 class="text-center">
                Anda yakin menghapus group ini ?
              </h4>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
              <button type="submit" class="btn btn-primary">Ya</button>
            </div>
          </form>

        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

  <?php endforeach?>
<?php endif?>