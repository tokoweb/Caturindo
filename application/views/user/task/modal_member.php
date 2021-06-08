<?php if(!empty($data_task)):?>
  <?php foreach($data_task as $dt):?>

    <div class="modal fade" id="member<?=$dt->id?>">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-body">
            
            <table class="table table-striped table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">User</th>
                  <th class="text-center">Email</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">User</th>
                  <th class="text-center">Email</th>
                </tr>
              </tfoot>
              <tbody>
                <?php if(!empty($dt->seluruh_member)):?>
                  <?php $no=1; foreach($dt->seluruh_member as $sm):?>
                    <tr>
                      <td class="text-center"><?=$no++?></td>
                      <td class="text-center"><?=$sm->username?></td>
                      <td class="text-center"><?=$sm->email?></td>
                    </tr>
                  <?php endforeach?>
                <?php endif?>
              </tbody>
            </table>

          </div>

        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

<!-- <script type="text/javascript">
  $('#datatables-group'+<?=$dt->id?>).DataTable();
</script> -->

  <?php endforeach?>
<?php endif?>