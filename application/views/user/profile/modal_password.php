<div class="modal fade" id="modalPassword">
  <div class="modal-dialog">
    <div class="modal-content">
        <!-- <div class="modal-heading">
          as
        </div> -->
      <form action="<?=base_url('user/profile/edit_password')?>" method="post">
        <div class="modal-body">
          <div class="col-md-12" style="margin-top: 40px">
            <div class="form-group form-animate-text">
              <input type="password" class="form-text" name="password_lama" required="">
              <span class="bar"></span>
              <label>Password Lama</label>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group form-animate-text">
              <input type="password" class="form-text" name="password" required="">
              <span class="bar"></span>
              <label>Password Baru</label>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->