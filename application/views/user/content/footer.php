<!-- start: Javascript -->
    <script src="<?=base_url()?>assets/template/miminium/asset/js/jquery.min.js"></script>
    <script src="<?=base_url()?>assets/template/miminium/asset/js/jquery.ui.min.js"></script>
    <script src="<?=base_url()?>assets/template/miminium/asset/js/bootstrap.min.js"></script>
   
    
    <!-- plugins -->
    <script src="<?=base_url()?>assets/template/miminium/asset/js/plugins/moment.min.js"></script>
    <script src="<?=base_url()?>assets/template/miminium/asset/js/plugins/fullcalendar.min.js"></script>
    <script src="<?=base_url()?>assets/template/miminium/asset/js/plugins/jquery.nicescroll.js"></script>
    <script src="<?=base_url()?>assets/template/miminium/asset/js/plugins/jquery.vmap.min.js"></script>
    <script src="<?=base_url()?>assets/template/miminium/asset/js/plugins/maps/jquery.vmap.world.js"></script>
    <script src="<?=base_url()?>assets/template/miminium/asset/js/plugins/jquery.vmap.sampledata.js"></script>
    <script src="<?=base_url()?>assets/template/miminium/asset/js/plugins/chart.min.js"></script>
    <script src="<?=base_url()?>assets/template/miminium/asset/js/plugins/jquery.datatables.min.js"></script>
    <script src="<?=base_url()?>assets/template/miminium/asset/js/plugins/datatables.bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/template/miminium/asset/js/plugins/select2.full.min.js"></script>

    <!-- custom -->
     <script src="<?=base_url()?>assets/template/miminium/asset/js/main.js"></script>

     <script type="text/javascript">
      $(document).ready(function(){
        $('#datatables-tim').DataTable();
        $('#datatables-group').DataTable();
      });
    </script>

    <script type="text/javascript">
    $(".select2-A").select2({
      placeholder: "Pilih Member ..",
      allowClear: true,
      width: 'resolve'
    });
    </script>

    <!-- NOTIFIKASI ALERT -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <?php if ($this->session->flashdata('gagal')):?>
    <script type="text/javascript">
      swal("Gagal", "<?=$this->session->flashdata('gagal')?>", "error");
    </script>
    <?php elseif($this->session->flashdata('berhasil')):?>
     <script type="text/javascript">
      swal("Berhasil", "<?=$this->session->flashdata('berhasil')?>", "success");
    </script>
    <?php endif?>
    <!-- END NOTIFIKASI ALERT -->

    <script type="text/javascript">
        
        document.getElementById('pilih-group').addEventListener('change', function() {
              // console.log('You selected: ', this.value);

              $.ajax({
                type: "get",
                dataType: "json",
                url: "<?=base_url()?>"+"user/tim/cari_member",
                data: {
                    id_group:this.value
                },
                success: function (data){
                    // console.log(data);
                    var html = '<option value="">Pilih Member ...</option>';

                    for (var i = data.length - 1; i >= 0; i--) {
                        html += '<option value="'+data[i].id+'">'+data[i].username+' ('+data[i].email+') ('+data[i].jabatan+')</option>';
                    }
                    $("#muncul-member").html(html);
                    // console.log(html);

                }
              });

              
          });

    </script>
     
<!-- end: Javascript -->