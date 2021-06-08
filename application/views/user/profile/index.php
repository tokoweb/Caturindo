<div id="content" class="profile-v1">

	<div class="col-md-12 col-sm-12 profile-v1-wrapper" style="padding-right:0px; margin-top: 10px">
        <div class="col-md-12  profile-v1-cover-wrap">
            <div class="profile-v1-pp">
            	<a href="#" data-toggle="modal" data-target="#gambarProfile">
            		<?php if(empty($profile->id_image_profile)):?>
		              <img src="<?=base_url()?>assets/template/miminium/asset/img/avatar.jpg"/>
		            <?php else:?>
		              <img src="<?=$profile->id_image_profile?>"/>
		            <?php endif?>
            	</a>
              <h2><?=$profile->username?></h2>
            </div>
            <div class="col-md-12 profile-v1-cover" data-toggle="modal" data-target="#gambarBackground">
              <?php if(empty($profile->id_image_background)):?>
	              <img src="<?=base_url()?>assets/template/miminium/asset/img/bg1.jpg" class="img-responsive">
	           <?php else:?>
	           	<img src="<?=$profile->id_image_background?>" class="img-responsive">
	           <?php endif?>
            </div>
        </div>
        <!-- <div class="col-md-3 col-sm-12 padding-0 profile-v1-right">
            <div class="col-md-6 col-sm-4 profile-v1-right-wrap padding-0">
              <div class="col-md-12 padding-0 sub-profile-v1-right text-center sub-profile-v1-right1">
                  <h1>51K</h1>
                  <p>Followers</p>
              </div>
            </div>
            <div class="col-md-6 col-sm-4 profile-v1-right-wrap padding-0">
                <div class="col-md-12 sub-profile-v1-right text-center sub-profile-v1-right2">
                   <h1>609</h1>
                   <p>Following</p>
                </div>
            </div>
            <div class="col-md-12 col-sm-4 profile-v1-right-wrap padding-0">
                <div class="col-md-12 sub-profile-v1-right text-center sub-profile-v1-right3">
                  <h1>82001</h1>
                  <p>Post</p>
                </div>
            </div>
        </div> -->
     </div>

	<div class="col-md-12 col-sm-12 profile-v1-wrapper" style="padding-right:0px; margin-top: 2px">
		<div class="col-md-12 profile-v1-cover-wrap">
			<div class="panel">
			<?=form_open('user/profile/update')?>
				<div class="panel-body">
					<div class="col-md-6">
	                  <div class="form-group form-animate-text">
	                    <input type="text" class="form-text" name="name" value="<?=$profile->name?>" required="">
	                    <span class="bar"></span>
	                    <label>Nama</label>
	                  </div>
	                </div>
	                <div class="col-md-6">
	                  <div class="form-group form-animate-text">
	                    <input type="email" class="form-text" name="email" value="<?=$profile->email?>" required="">
	                    <span class="bar"></span>
	                    <label>Email</label>
	                  </div>
	                </div>
	                <div class="col-md-6">
	                  <div class="form-group form-animate-text">
	                    <input type="number" class="form-text" name="phone" value="<?=$profile->phone?>" required="">
	                    <span class="bar"></span>
	                    <label>Phone</label>
	                  </div>
	                </div>
	                <div class="col-md-6">
	                  <div class="form-group form-animate-text">
	                    <input type="number" class="form-text" name="whatsapp" value="<?=$profile->whatsapp?>" required="">
	                    <span class="bar"></span>
	                    <label>Whatsapp</label>
	                  </div>
	                </div>
	                <div class="col-md-12">
	                	<hr>
	                </div>
	                <div class="col-md-6">
	                  <div class="form-group form-animate-text">
	                    <input type="text" class="form-text" name="username" value="<?=$profile->username?>" required="">
	                    <span class="bar"></span>
	                    <label>Username</label>
	                  </div>
	                </div>
	                <div class="col-md-6">
	                    <button type="button" data-toggle="modal" data-target="#modalPassword" class=" btn btn-round ripple-infinite btn-mn btn-success ">
	                      <div>
	                      Update Password
	                      </div>
	                    </button>
	                </div>
	                <div class="col-md-12">
	                    <button type="submit" class=" btn btn-round ripple-infinite btn-mn btn-primary ">
	                      <div>
	                      Update
	                      </div>
	                    </button>
	                </div>
				</div>
			<?=form_close()?>
			</div>
		</div>
	</div>	
</div>

<?php $this->load->view('user/profile/modal_password')?>
<?php $this->load->view('user/profile/modal_gambar_profile')?>
<?php $this->load->view('user/profile/modal_gambar_background')?>