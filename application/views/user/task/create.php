<div id="content">

  <div class="panel box-shadow-none content-header">
      <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Task</h3>
            <p class="animated fadeInDown">
              <a href="<?=base_url('user/sub_meeting')?>" class="text-default">List Task</a> 
              <span class="fa-angle-right fa"></span>
              <a href="<?=base_url('user/sub_meeting')?>" class="text-default">Pilihan</a>
              <span class="fa-angle-right fa"></span>
              Create
            </p>
        </div>
      </div>
  </div>

  <template>
      
    <div class="col-md-12" style="padding: 20px">
      
      <!-- <center> -->
        <div class="panel col-md-10 col-md-offset-1">

          <div class="panel-heading" style="background-color:#0d315e">
            <h4 class="text-white text-center">Create Task</h4>
          </div>

            <div class="panel-body">
              <div class="row">

                <div class="col-md-12" v-if="error_lengkap">
    
                  <div class="alert alert-danger alert-outline alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <strong>Maaf </strong>{{ error_lengkap }}
                  </div>

                </div>
                
                <div class="col-md-4">
                  <div class="form-group form-animate-text">
                    <input v-model="name_task" type="text" class="form-text" name="name_task" required="">
                    <span class="bar"></span>
                    <label>Nama Task</label>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group form-animate-text">
                    <div v-if="triger_group === 'null'">
                      <a href="<?=base_url('user/tim')?>" class="btn btn-warning" target="_blank">Tambah Group</a>
                    </div>
                    <div v-else-if="triger_group === 'true'">
                      
                      <div v-html="pilih_group"></div>

                      <select v-model="id_group" class="form-text" @change="pilihGroup()" required="">
                        <option v-for="item in group" :value="item.id">
                          {{ item.nama_team }}
                        </option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group form-animate-text">
                    <input id="files" type="file" class="form-text" ref="files" v-on:change="uploadFile()" multiple="">
                    <span class="bar"></span>
                    <label>Upload File</label>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group ">
                    <label>Due Date</label>
                    <input v-model="due_date" type="date" class="form-control" name="due_date" required="">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Time</label>
                    <input v-model="time" type="time" class="form-control" name="time" required="">
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
                    <button v-on:click="submitFile()" class="btn text-white" style="background-color:#0d315e">Create</button>
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
  var user_id = '<?=$id_user?>'
  let kode_meeting = '<?=$id_meeting?>'
  var url_redirect = "<?=base_url('user/task')?>"
  var url_upload = "http://caturindo.net/api/file/upload"
  // var url_upload = "http://localhost/inditama/caturindo_api/api/file/upload"
</script>
<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/create_task.js"></script>