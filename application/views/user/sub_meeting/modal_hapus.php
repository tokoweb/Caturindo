<!-- HAPUS DATA TIM -->
<?php if(!empty($sub_meeting)):?>
  <?php foreach($sub_meeting as $dt):?>

    <div class="modal fade" id="modalHapus<?=$dt->id?>">
      <div class="modal-dialog">
        <div class="modal-content">

          <form action="<?=base_url('user/sub_meeting/batal/')?><?=$dt->id?>" method="post">
            <div class="modal-body">
              <h4 class="text-center">
                Anda yakin membatalkan sub meeting ini ?
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