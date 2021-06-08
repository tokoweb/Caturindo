<div id="content">
	<div class="col-md-12" style="padding:5px; margin-top: 10px">
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-heading" style="background-color:#0d315e">
					<div class="row">
						<div class="col-md-3">
							<a href="<?=base_url('user/task/pilihan')?>" class="btn btn-default btn-round">
								<i class="fa fa-plus"></i> Task
							</a>
						</div>
						<div class="col-md-6 col-md-offset-2 text-white">
							<h4>Data Task</h4>
						</div>
					</div>
				</div>
				<div class="panel-body">
					<div class="responsive-table">
	        			<table id="datatables-tim" class="table table-striped table-bordered" width="100%" cellspacing="0">
	        				<thead>
			                  <tr>
			                    <th class="text-center">No</th>
			                    <th class="text-center">Judul Task</th>
			                    <th class="text-center">Group</th>
			                    <th class="text-center">Meeting</th>
			                    <th class="text-center">Keterangan</th>
			                    <th class="text-center">Waktu</th>
			                    <th class="text-center">File</th>
			                    <th class="text-center">Status</th>
			                    <th class="text-center">Tindakan</th>
			                  </tr>
			                </thead>
			                <tfoot>
			                  <tr>
			                    <th class="text-center">No</th>
			                    <th class="text-center">Judul Task</th>
			                    <th class="text-center">Group</th>
			                    <th class="text-center">Meeting</th>
			                    <th class="text-center">Keterangan</th>
			                    <th class="text-center">Waktu</th>
			                    <th class="text-center">File</th>
			                    <th class="text-center">Status</th>
			                    <th class="text-center">Tindakan</th>
			                  </tr>
			                </tfoot>
			                <tbody>
			                	<?php if(!empty($data_task)):?>
			                		<?php $no=1; foreach($data_task as $dt):?>
			                			<tr>
			                				<td class="text-center"><?=$no++?></td>
			                				<td class="text-center"><?=$dt->name_task?></td>
			                				<td class="text-center">
			                					<a href="#" class="label label-primary" data-toggle="modal" data-target="#member<?=$dt->id?>">
			                						<?=$dt->nama_group?>
			                					</a>
			                				</td>
			                				<td class="text-center"><?=$dt->judul_meeting?></td>
			                				<td class="text-center"><?=$dt->description?></td>
			                				<td class="text-center">
			                					<?=$dt->due_date?> <?=$dt->time?>
			                				</td>
			                				<td class="text-center">
			                					<?php if(!empty($dt->file)):?>
				                					<?php $no_file=1; foreach($dt->file as $df):?>
						                              <a href="<?=$df?>" class="text-default" target="_blank">
						                                File <?=$no_file++?>
						                              </a>
						                              <br>
						                            <?php endforeach?>
				                				<?php endif?>
			                				</td>
			                				<td class="text-center "><?=$dt->status_task?></td>
			                				<td class="text-center ">
			                					<?php if($dt->status_task == 'Dalam Proses'):?>
			                						<a href="<?=base_url('user/task/selesai/')?><?=$dt->id?>" class="text-white btn btn-round ripple-infinite btn-mn" style="background-color:#0d315e">
			                							<div>
							                             Selesai
							                            </div>
			                						</a> 
			                						<br>
			                						<a href="<?=base_url('user/task/batal/')?><?=$dt->id?>" class="text-white btn btn-danger btn-round ripple-infinite btn-mn" style="margin-top: 5px">
			                							<div>
							                             Batal
							                            </div>
			                						</a>

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

<?php $this->load->view('user/task/modal_member')?>