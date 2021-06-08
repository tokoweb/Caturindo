<!-- PANEL PENCARIAN -->
<div class="col-md-12" style="padding: 20px">
  
  <center>
    <div class="panel col-md-8 col-md-offset-2">

      <div class="panel-heading" style="background-color:#0d315e">
        <div class="row">
          <div class="col-md-1">
            <button class="btn btn-round btn-default" v-on:click="kembali()">Kembali</button>
          </div>
          <div class="col-md-2 col-md-offset-4">
            <h4 class="text-white">
            Pilih Transport {{ loading }}
          </h4>
          </div>
        </div>
      </div>

        <div class="panel-body">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Tanggal meeting</label>
                <input v-model="tanggal" type="date" name="tanggal" class="form-control" required="">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label>Jam Mulai Meeting</label>
                <input v-model="waktu_mulai" type="time" name="waktu_mulai" class="form-control" required="">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label>Jam Selesai Meeting</label>
                <input v-model="waktu_selesai" type="time" name="waktu_selesai" class="form-control" required="">
              </div>
            </div>

            <div class="col-md-1">
              <div class="form-group">
                <label></label>
                <button class="btn text-white" v-on:click="cariTransport()" style="background-color:#0d315e">Cari Transport</button>
              </div>
            </div>

          </div>
        </div>

    </div>
  </center>

</div>
<!-- END PANEL PENCARIAN -->

<!-- PANEL DATA YANG MUNCUL -->
<div class="col-md-12" style="padding:10px;">

  <div v-if="error_lengkap">
    
    <div class="alert alert-danger alert-outline alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
      <strong>Maaf </strong>{{ error_lengkap }}
    </div>

  </div>

  <div v-if="loading">
    <div class="sk-wave">
      <div class="sk-rect sk-rect1"></div>
      <div class="sk-rect sk-rect2"></div>
      <div class="sk-rect sk-rect3"></div>
      <div class="sk-rect sk-rect4"></div>
      <div class="sk-rect sk-rect5"></div>
    </div>
  </div>

  <div v-if="transport">
    <div v-for="(k, i) in transport">

       <div class="panel col-md-3" style="margin: 3px">
           <img :src="k.image[0]" class="img-responsive panel-heading" style="max-height: 230px; min-height: 230px">
           <div class="panel-body">
              <h4>{{ k.name_transport }}</h4>
              <p>maximal {{ k.max_people }} orang</p>
              <p>
                <a :href="'<?=base_url()?>user/sub_meeting/booking_transport?kode_meeting='+kode_meeting+'&kode_transport='+k.id+'&tanggal='+tanggal+'&waktu_mulai='+waktu_mulai+'&waktu_selesai='+waktu_selesai" class="btn ripple-infinite btn-outline btn-primary">Pilih</a>
              </p>
           </div>
       </div>
      
    </div>
  </div>

</div>
<!-- END PANEL DATA YANG MUNCUL -->