<div class="modal fade" id="gambarBackground">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
          <h4>Ganti Foto Background</h4>
        </div>
      <form action="<?=base_url('user/profile/ganti_gambar_background')?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="col-md-12">
            <div class="form-group">
              <input type="file" name="gambar" required="">
            </div>
          </div>
        </div>
        <div class="modal-footer" style="margin-top: 40px">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->