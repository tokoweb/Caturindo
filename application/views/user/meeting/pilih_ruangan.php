<div id="content">

  <div class="panel box-shadow-none content-header">
      <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Booking Meeting</h3>
            <p class="animated fadeInDown">
              <a href="<?=base_url('user/sub_meeting')?>" class="text-default">meeting</a> 
              <span class="fa-angle-right fa"></span> Lokasi Meeting
            </p>
        </div>
      </div>
  </div>

  <template>

    <div v-if="lokasi_meeting == 'null'">
      
      <div class="col-md-12" style="padding: 20px">

        <div class="col-6 col-md-2 col-lg-1 col-md-offset-4">
          <div class="form-group">
            <button class="btn text-white" v-on:click="diRuangan()" style="background-color:#0d315e">Office</button>
          </div>
        </div>

        <div class="col-6 col-md-1 col-lg-6">
          <div class="form-group">
            <button class="btn text-white" v-on:click="diLuarRuangan()" style="background-color:#0d315e">Outside the Office</button>
          </div>
        </div>
        
        <!-- <center> -->
          <!-- <div class="panel col-md-4 col-md-offset-4"> -->

            <!-- <div class="panel-heading bg-primary">
              <h4 class="text-white">Lokasi Meeting</h4>
            </div>

            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-md-offset-2">
                  <div class="form-group">
                    <button class="btn btn-primary" v-on:click="diRuangan()">Office</button>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <button class="btn btn-primary" v-on:click="diLuarRuangan()">Outside <br>the Office</button>
                  </div>
                </div>
              </div>
            </div> -->

          <!-- </div> -->
        <!-- </center> -->

      </div>

    </div>
    
    <div v-else-if="lokasi_meeting === 'didalam'">
      
      <?php $this->load->view('user/meeting/ruangan')?>

    </div>

    <div v-else-if="lokasi_meeting === 'diluar'">
      
      <?php $this->load->view('user/meeting/transport')?>

    </div>

  </template>

</div>

<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script type="text/javascript">
  let kode_meeting = null
</script>
<script type="text/javascript" src="<?=base_url()?>assets/js/pilih_ruangan.js"></script>