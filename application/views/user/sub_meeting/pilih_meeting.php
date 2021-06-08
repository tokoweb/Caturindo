<div id="content" class="profile-v1">

	  <div class="panel box-shadow-none content-header">
	      <div class="panel-body">
	        <div class="col-md-12">
	            <h3 class="animated fadeInLeft">Booking Sub Meeting</h3>
	            <p class="animated fadeInDown">
	              <a href="<?=base_url('user/sub_meeting')?>" class="text-default">Sub meeting</a> 
	              <span class="fa-angle-right fa"></span>
	              Pilihan
	            </p>
	        </div>
	      </div>
	  </div>

	<div class="col-md-12" style="padding:0px; margin-top: 0px">
	<?php if(!empty($data_meeting)):?>
		<?php foreach($data_meeting as $dm):?>
			<div class="col-md-3" style="margin-top: 20px">
				<div class="panel" >
					<div class="panel-body">
						<h4><?=$dm->title?></h4>
						<p><?=$dm->description?></p>
						<hr>
						<p>
							<span class="icons icon-clock"></span> 
							<?=$dm->time?> <?=$dm->date?>
						</p>
						<p>
							<span class="icons icon-user"></span> <?=$dm->count_members?>
						</p>
						<p>
							<span class="icons icon-location-pin"></span>
							<?=$dm->location?>
						</p>
					</div>
					<a href="<?=base_url('user/sub_meeting/pilihan/')?><?=$dm->id?>" class="btn panel-footer col-md-12 text-white" style="background-color:#0d315e">
						Pilih Meeting
					</a>
				</div>
			</div>
		<?php endforeach?>
	<?php else:?>
		<div class="col-md-12">
	      <div class="alert alert-warning alert-3d alert-dismissible fade in" role="alert">
	        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
	        <h4>
	        	<strong>Warning!</strong> Anda belum memiliki data meeting, mohon untuk menambahkan data meeting terlebih dahulu.
	        </h4>
	      </div>
	    </div>
	<?php endif?>
	</div>
</div>