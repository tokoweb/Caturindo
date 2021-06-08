<div id="content">

  <div class="panel box-shadow-none content-header">
      <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Booking Sub Meeting</h3>
            <p class="animated fadeInDown">
              <a href="<?=base_url('user/sub_meeting')?>" class="text-default">Sub meeting</a> 
              <span class="fa-angle-right fa"></span>
              <a href="<?=base_url('user/sub_meeting/pilih_meeting')?>" class="text-default">Pilih Meeting</a> 
              <span class="fa-angle-right fa"></span>
              <a href="<?=base_url('user/sub_meeting/pilihan/')?><?=$kode_meeting?>" class="text-default">Lokasi Meeting
              </a>
              <span class="fa-angle-right fa"></span> Booking
            </p>
        </div>
      </div>
  </div>

  <template>
      
    <div class="col-md-12" style="padding: 20px">
      
      <!-- <center> -->
        <div class="panel col-md-10 col-md-offset-1">

          <div class="panel-heading" style="background-color:#0d315e">
            <div class="row">
              <div class="col-md-1">
                <button class="btn btn-round btn-default" v-on:click="kembali()">Kembali</button>
              </div>
              <div class="col-md-10 col-md-offset-1">
                <h4 class="text-white"><?=$judul?></h4>
              </div>
            </div>
          </div>

            <div class="panel-body">
              <div class="row">

                <div class="col-md-12" v-if="error_lengkap">
    
                  <div class="alert alert-danger alert-outline alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <strong>Maaf </strong>{{ error_lengkap }}
                  </div>

                </div>
                
                <div class="col-md-6">
                  <div class="form-group form-animate-text">
                    <input v-model="meeting_title" type="text" class="form-text" name="meeting_title" required="">
                    <span class="bar"></span>
                    <label>Sub Meeting Title</label>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group form-animate-text">
                    <input v-model="driver_name" type="text" class="form-text" name="driver_name" required="">
                    <span class="bar"></span>
                    <label>Driver Name</label>
                  </div>
                </div>

                <div v-if="triger_group === 'null'" class="col-md-6">
                  <div class="form-group form-animate-text">
                      <a href="<?=base_url('user/tim')?>" class="btn btn-warning" target="_blank">Tambah Group</a>
                  </div>
                </div>

                <div v-else-if="triger_group === 'true'" class="col-md-6">
                  <div class="form-group form-animate-text">
                    <div v-html="pilih_group"></div>

                    <select v-model="id_group" class="form-text" @change="pilihGroup()" required="">
                      <option v-for="item in group" :value="item.id">
                        {{ item.nama_team }}
                      </option>
                    </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group form-animate-text">
                    <input id="files" type="file" class="form-text" ref="files" v-on:change="uploadFile()" multiple="">
                    <span class="bar"></span>
                    <label>Upload File</label>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group form-animate-text">
                    <textarea v-model="description" class="form-text" name="description" required=""></textarea>
                    <span class="bar"></span>
                    <label>Keterangan</label>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group form-animate-text">
                    <button v-on:click="bookingTransport()" class="btn text-white" style="background-color:#0d315e">Booking</button>
                  </div>
                </div>

              </div>
            </div>

        </div>
      <!-- </center> -->

    </div>

  </template>

</div>
<script type="text/javascript">
  let user_id = '<?=$id_user?>'
  let kode_transport = '<?=$kode_transport?>'
  var nama_transport = '<?=$nama_transport?>'
  var url_redirect = "<?=base_url('user/sub_meeting')?>"
  var url_kembali = "<?=base_url('user/sub_meeting/pilihan/')?><?=$kode_meeting?>"
  var url_upload = "http://caturindo.net/api/file/upload"
</script>
<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script type="text/javascript" src="<?=base_url()?>assets/js/submeeting_booking_transport.js"></script>