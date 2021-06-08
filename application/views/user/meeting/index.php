<div id="content">

	<div class="col-md-12 top-1" style="padding:5px;">
     
    <div class="col-md-12">
      <div class="col-md-12 tabs-area">

        <ul id="tabs-demo6" class="nav nav-tabs nav-tabs-v6" role="tablist">
          <li>
            <!-- <button data-toggle="modal" data-target="#modalTambah" class=" btn  ripple-infinite btn-mn btn-info">
              <div>
                <i class="fa fa-plus"></i> Meeting
              </div>
            </button> -->
            <a href="<?=base_url('user/meeting/pilih_ruangan')?>">
              <i class="fa fa-plus"></i> Meeting
            </a>
          </li>
          <?php foreach($aktif as $ak):?>
            <li role="presentation" class="<?=$ak['active']?>">
              <a href="<?=$ak['url']?>">
                <?=$ak['name']?>
              </a>
            </li>
          <?php endforeach?>
        </ul>

        <div id="tabsDemo6Content" class="tab-content tab-content-v6 col-md-12">

          <!-- TAB TIM -->
          <div role="tabpanel" class="tab-pane fade active in" id="tabs-demo7-area1" aria-labelledby="tabs-demo7-area1">
            
            <div class="responsive-table">
              <table id="datatables-tim" class="table table-striped table-bordered" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Title</th>
                    <th class="text-center">Group</th>
                    <th class="text-center">Lokasi</th>
                    <th class="text-center">Keterangan</th>
                    <th class="text-center">Waktu</th>
                    <th class="text-center">File</th>
                    <th class="text-center">Status Meeting</th>
                    <th class="text-center">Tindakan</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Title</th>
                    <th class="text-center">Group</th>
                    <th class="text-center">Lokasi</th>
                    <th class="text-center">Keterangan</th>
                    <th class="text-center">Waktu</th>
                    <th class="text-center">File</th>
                    <th class="text-center">Status Meeting</th>
                    <th class="text-center">Tindakan</th>
                  </tr>
                </tfoot>

                <tbody>
                  <?php if(!empty($data_meeting)):?>
                    <?php $no=1; foreach($data_meeting as $dm):?>
                      <tr>
                        <td class="text-center"><?=$no++?></td>
                        <td class="text-center"><?=$dm->title?></td>
                        <td class="text-center">
                          <a href="#" class="label label-primary" data-toggle="modal" data-target="#member<?=$dm->id?>">
                            <?=$dm->nama_group?>
                          </a>
                        </td>
                        <td class="text-center"><?=$dm->location?></td>
                        <td class="text-center"><?=$dm->description?></td>
                        <td class="text-center"><?=$dm->date?>, <?=$dm->time?> WIB</td>
                        <td class="text-center">
                          <?php if(!empty($dm->file)):?>
                            <?php $no_file=1; foreach($dm->file as $df):?>
                              <a href="<?=$df?>" class="text-default" target="_blank">
                                File <?=$no_file++?>
                              </a>
                              <br>
                            <?php endforeach?>
                          <?php endif?>
                        </td>
                        <td class="text-center"><?=$dm->meeting_status?></td>
                        <td class="text-center">
                          <?php if($dm->meeting_status != 'Selesai'):?>
                            <a href="<?=base_url('user/meeting/selesai/')?><?=$dm->id?>" class="text-white btn btn-round ripple-infinite btn-mn" style="background-color:#0d315e; margin-bottom: 5px">
                              <div>
                               Selesai
                              </div>
                            </a>
                            <br>
                            <button data-toggle="modal" data-target="#modalHapus<?=$dm->id?>" class=" btn btn-round ripple-infinite btn-mn btn-danger ">
                              <div>
                              Batal
                              </div>
                            </button>
                          <?php endif?>
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

  </div>

</div>

<?php $this->load->view('user/meeting/modal_tambah')?>
<?php $this->load->view('user/meeting/modal_hapus')?>
<?php $this->load->view('user/meeting/modal_member')?>