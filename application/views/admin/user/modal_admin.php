<!-- Modal Hapus user -->
  <div class="modal fade" id="modalGantiPassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h5 class="modal-title" id="myModalLabel">Reset Password <?=$data_admin->username?></h4>
        </div>
        <div class="modal-body">
          <form class="form" method="post" action="<?=base_url()?>index.php/admin/users/ganti_password">

            <div class="form-group">
              <input type="password" name="password_lama" class="form-control" placeholder="password lama" required="">
            </div>
            <div class="form-group">
              <input type="password" name="password_baru" class="form-control" placeholder="password baru" required="">
            </div>
            <div class="form-group">
              <input type="password" name="password_lagi" class="form-control" placeholder="ketik kembali password barunya" required="">
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
            <button type="submit" class="btn btn-primary">Iya</button>
          </form>
        </div>
      </div>
    </div>
  </div>