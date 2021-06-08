<div id="content">

  <template>
    
    <!-- PANEL PENCARIAN -->
    <div class="col-md-12" style="padding: 20px">
      
      <center>
        <div class="panel col-md-8 col-md-offset-2">

          <div class="panel-heading">
            Pilih Ruangan
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
                    <button class="btn btn-info" v-on:click="cariRuangan()">Cari Ruangan</button>
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

      <div v-if="ruangan">
        <div v-for="(k, i) in ruangan">

           <div class="panel col-md-3" style="margin: 3px">
               <img :src="k.image" class="img-responsive panel-heading" style="max-height: 230px; min-height: 230px">
               <div class="panel-body">
                  <h4>{{ k.name_ruangan }}</h4>
                  <p>maximal {{ k.max_people }} orang {{ k.code_room }}</p>
                  <p>
                    <a :href="'<?=base_url()?>user/meeting/booking_ruangan/'+k.code_room" class="btn ripple-infinite btn-outline btn-primary">Pilih</a>
                  </p>
               </div>
           </div>
          
        </div>
      </div>

    </div>
    <!-- END PANEL DATA YANG MUNCUL -->

  </template>

</div>

<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/js/pilih_ruangan.js"></script>