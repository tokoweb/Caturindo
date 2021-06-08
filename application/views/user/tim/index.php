 <!-- start: Content -->
<div id="content">
   <div class="panel box-shadow-none content-header">
      <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Team & Group</h3>
            <!-- <p class="animated fadeInDown">
              Table <span class="fa-angle-right fa"></span> Data Tables
            </p> -->
        </div>
      </div>
  </div>
  <div class="col-md-12 top-1 padding-0">

    <div class="col-md-12">
      <div class="col-md-12 tabs-area">

        <ul id="tabs-demo6" class="nav nav-tabs nav-tabs-v6" role="tablist">
          <li>
            <button data-toggle="modal" data-target="#modalTambah" class=" btn text-white ripple-infinite btn-mn" style="background-color:#0d315e; margin-bottom: 5px">
              <div>
              <!-- <i class="fa fa-plus"></i> -->
              Tambah Team
              </div>
            </button>
          </li>
          <li>
            <button data-toggle="modal" data-target="#modalTambahGroup" class=" btn text-white ripple-infinite btn-mn" style="background-color:#0d315e">
              <div>
              <!-- <i class="fa fa-plus"></i> -->
              Tambah Group
              </div>
            </button>
          </li>
          <li role="presentation" class="active">
            <a href="#tabs-demo7-area1" id="tabs-demo6-1" role="tab" data-toggle="tab" aria-expanded="true">Team</a>
          </li>
          <li role="presentation" class="">
            <a href="#tabs-demo7-area2" role="tab" id="tabs-demo6-2" data-toggle="tab" aria-expanded="false">Group</a>
          </li>
          </li>
        </ul>

        <div id="tabsDemo6Content" class="tab-content tab-content-v6 col-md-12">

          <!-- TAB TIM -->
          <div role="tabpanel" class="tab-pane fade active in" id="tabs-demo7-area1" aria-labelledby="tabs-demo7-area1">
            
            <div class="responsive-table">
              <table id="datatables-tim" class="table table-striped table-bordered" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Group</th>
                    <th class="text-center">Member</th>
                    <th class="text-center">Jabatan</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Setting</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(!empty($data_tim)):?>
                    <?php $no=1; foreach($data_tim as $dt):?>

                      <tr>
                        <td class="text-center"><?=$no++?></td>
                        <td class="text-center"><?=$dt->nama_group?></td>
                        <td class="text-center"><?=$dt->username?></td>
                        <td class="text-center"><?=$dt->jabatan?></td>
                        <td class="text-center"><?=$dt->email?></td>
                        <td class="text-center">

                          <button data-toggle="modal" data-target="#modalHapusTim<?=$dt->id_team?>" class=" btn btn-circle ripple-infinite btn-mn btn-danger ">
                            <div>
                            <i class="fa fa-trash"></i>
                            </div>
                          </button>

                        </td>
                      </tr>

                    <?php endforeach?>
                  <?php endif?>
                </tbody>
              </table>
            </div>

          </div>

          <!-- TAB GROUP -->
          <div role="tabpanel" class="tab-pane fade" id="tabs-demo7-area2" aria-labelledby="tabs-demo7-area2">
            
              <div class="responsive-table">
                <table id="datatables-group" class="table table-striped table-bordered" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Group</th>
                      <th class="text-center">Setting</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(!empty($data_group)):?>
                      <?php $no=1; foreach($data_group as $dg):?>

                        <tr>
                          <td class="text-center"><?=$no++?></td>
                          <td class="text-center"><?=$dg->nama_team?></td>
                          <td class="text-center">

                            <button data-toggle="modal" data-target="#modalEdit<?=$dg->id?>" class=" btn btn-circle ripple-infinite btn-mn btn-warning ">
                              <div>
                              <i class="fa fa-edit"></i>
                              </div>
                            </button>

                            <button data-toggle="modal" data-target="#modalHapusGroup<?=$dg->id?>" class=" btn btn-circle ripple-infinite btn-mn btn-danger ">
                              <div>
                              <i class="fa fa-trash"></i>
                              </div>
                            </button>

                          </td>
                        </tr>

                      <?php endforeach?>
                    <?php endif?>
                  </tbody>
                </table>
              </div>

          </div>
        </div>

      </div>
    </div>

    <?php $this->load->view('user/tim/modal_tambah')?>
    <?php $this->load->view('user/tim/modal_edit')?>
    <?php $this->load->view('user/tim/modal_hapus')?>

  </div>  
  </div>
</div>
<!-- end: content -->