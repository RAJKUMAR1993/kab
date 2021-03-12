
<style>
    td.details-control {
    background: url('<?php echo base_url(); ?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
    }
    tr.shown td.details-control {
        background: url('<?php echo base_url(); ?>assets/images/details_close.png') no-repeat center center;
    }
</style>

<div id="main-content">
      
    <div class="col-md-12">
		<?php echo $this->session->flashdata('msg');?>
		<div class="card">
			<div class="header">
				<div class="col-lg-9 pull-left">
					<h2>Students Why to attend</h2>
				</div>
				<div class="col-lg-1 pull-right">
				</div>
			</div>

			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Add Why to attend</button>
			<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add Why to attend</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			
			<? echo $this->session->flashdata("vidmsg"); ?>
			<div class="modal-body">
				<form method="post" action="<?php echo base_url()?>admin/homepage/add_to_attend">
			
				<div class="form-group">
					<label for="message-text" class="col-form-label">Points :</label>
					<textarea class="form-control" id="message-text" name="bullet" required></textarea>
				</div>
				<div class="modal-footer">
				<button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
				</form>
			</div>
			
			</div>
		</div>
		</div>
			<div class="body">
			
				<div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="body">
                            <ul class="nav nav-tabs-new2">
                                <li class="nav-item"><a class="nav-link <? echo (($this->session->userdata("active_tab") == "image") || $this->session->userdata("active_tab") == "") ? 'active show' : '' ?> bgImages" data-toggle="tab" href="#Home-new2">Image</a></li>
                                <li class="nav-item"><a class="nav-link <? echo (($this->session->userdata("active_tab") == "video")) ? 'active show' : '' ?> bgVideos" data-toggle="tab" href="#Profile-new2">Bullet Points</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane <? echo (($this->session->userdata("active_tab") == "image") || $this->session->userdata("active_tab") == "") ? 'active show' : '' ?>" id="Home-new2">
                                    
									<div class="">
										<!-- ============================================================== -->
										<!-- Start Page Content -->
										<!-- ============================================================== -->
										<div class="row">
											<div class="col-lg-12">
											
												<? echo $this->session->flashdata("vmsg"); ?>
												<div class="card" style="margin-bottom: 0px !important">
													<form action="<?php echo base_url() ?>admin/homepage/add_image" method="post" enctype="multipart/form-data">
														<div class="form-body">
															<div class="card-body">
																<div class="row">
																	<div class="col-md-3">
																		<div class="form-group">
																			<label class="control-label">Select Image</label>
																			<input type="file" class="form-control" name="image" accept="image/*" required="">
																		</div>
																	</div>
																	<div class="col-md-2">
																		<div class="form-actions">
																			<br>
																			<div class="card-body">
																				<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Submit</button>
																			</div>
																		</div>
																	</div>


																</div>

															</div>
													</form>

													</div>

												</div>
											</div>

										</div>

									<div class="row">
										<!-- Column -->
										<div class="col-lg-12">
											<div class="card" style="border:0px">
												<div class="card-body">
													<div class="table-responsive">
														<table class="table product-overview table-striped" id="zero_config">

															<thead>
																<tr>
																	<th>S.No</th>
																	<th>Image</th>
																	<th>Action</th>
																
																</tr>
															</thead>
															<tbody>
																<?php 
																  $i = 0;
														  		  $images = $this->db->get_where("tbl_bullet_points",["type"=>"image"])->result();
														  			foreach ($images as $u) {  ?>
																<tr>
																	<td style="padding: 0.5rem;">
																		<?php echo ++$i ?>
																	</td>
																	<td style="padding: 0.5rem;">
																		<a href="javascript:void(0)" class="btn btn-primary imagemodal" style="border-radius: 15px" image="<? echo base_url().$u->point ?>">View</a>
																	</td>
																	
																	<td style="padding: 0.5rem;">
																		<a href="javascript:void(0)" class="text-inverse p-r-10 editimagemodal" image="<? echo $u->point ?>" image_id="<? echo $u->id ?>"><i class="ti-marker-alt"></i></a>
																		<a href="#" name="delete" id="<?php echo $u->id ?>" class="text-inverse sa-params" onclick="delImageslider(this.id,'<? echo $u->point ?>')"><i class="ti-trash"></i></a>
																	</td>
																</tr>
																<?php } ?>

															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
										<!-- Column -->
									</div>
                                    
                                	</div>
                                </div>
                                <div class="tab-pane <? echo (($this->session->userdata("active_tab") == "video")) ? 'active show' : '' ?>" id="Profile-new2">
									<div class="">
										

									<div class="row">
										<!-- Column -->
										<div class="col-lg-12">
											<div class="card" style="border:0px">
												<div class="card-body">
													<div class="table-responsive">
														<table class="table product-overview table-striped" id="zero_config1">

															<thead>
																<tr>
																	<th>S.No</th>
																	<th>Points</th>
																	<th>Action</th>
																</tr>
															</thead>
															<tbody>
																<?php 
																  $i = 0;
														  		  $points = $this->db->get_where("tbl_bullet_points",["type"=>"bullet"])->result();
														  			foreach ($points as $b) {  ?>
																<tr>
																	<td style="padding: 0.5rem;">
																		<?php echo ++$i ?>
																	</td>
																	<td><?php echo $b->point; ?></td>
																	
																	<td style="padding: 0.5rem;">
																		<a href="javascript:void(0)" class="text-inverse p-r-10 editvideomodal"  video_id="<? echo $b->id ?>"><i class="ti-marker-alt"></i></a>
																		<a href="#" name="delete" id="<?php echo $b->id ?>" class="text-inverse sa-params" onclick="delVideoslider(this.id,'<? echo $b->point ?>')"><i class="ti-trash"></i></a>
																	</td>
																</tr>
																<?php } ?>

															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
										<!-- Column -->
									</div>
                                    
                                	</div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

			
			</div>


		</div>
    </div>
</div>

<div id="imagemodal" class="modal fade" role="dialog">
  	<div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header" style="display: block">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Banner Image</h4>
		  </div>
		  <div class="modal-body">
			<div class="image"></div>
		  </div>
		</div>
	</div>
</div>

<div id="editimagemodal" class="modal fade" role="dialog">
  	<div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header" style="display: block">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Update  Image</h4>
		  </div>
		  <div class="modal-body">
			<form action="<?php echo base_url() ?>admin/homepage/add_image" method="post" enctype="multipart/form-data">
				<div class="form-body">
					<div class="card-body">
						<div class="row">
							<div class="col-md-9">
								<div class="form-group">
									<label class="control-label">Select Image</label>
									<input type="file" class="form-control" accept="image/*" name="image" required="">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-actions">
									<br>
									<div class="card-body">
										<input type="hidden" name="old_image" class="old_image">
										<input type="hidden" name="image_id" class="image_id">
										<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Submit</button>
									</div>
								</div>
							</div>


						</div>

					</div>
			</form>
		  </div>
		</div>
	</div>
</div>
</div>



<div id="videomodal" class="modal fade" role="dialog">
  	<div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header" style="display: block">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Banner Video</h4>
		  </div>
		  <div class="modal-body">
			<div class="video"></div>
		  </div>
		</div>
	</div>
</div>

<div id="editvideomodal" class="modal fade" role="dialog">
  	<div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header" style="display: block">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Update Bullet Points</h4>
		  </div>
		  <div class="modal-body">
			<form action="<?php echo base_url() ?>admin/homepage/add_to_attend" method="post" enctype="multipart/form-data">
				<div class="form-body">
					<div class="card-body">
						<div class="row">
							<div class="col-md-9">
							<div class="form-group">
								<label for="message-text" class="col-form-label">Points :</label>
								<textarea class="form-control" id="message-text" name="bullet"></textarea>
							</div>
							</div>
							<div class="col-md-2">
								<div class="form-actions">
									<br>
									<div class="card-body">
										<input type="hidden" name="old_video" class="old_video">
										<input type="hidden" name="video_id" class="video_id">
										<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Submit</button>
									</div>
								</div>
							</div>


						</div>

					</div>
			</form>
		  </div>
		</div>
	</div>
</div>


<script>

$("input[type='checkbox']").bootstrapSwitch({size : 'mini'});
    
$('#zero_config').on('switchChange.bootstrapSwitch','input[name="switch"]', function (e, state) {
      
	  var nav_id = $(this).attr("nav_id"); 

		var status;

		if ($(this).is(":checked")){
			status = "Active";
		}else{
			status = "Inactive";
		}
		$.ajax({
			type:"POST",
			url:"<?php echo base_url();?>admin/homepage/imagestatus",
			data:{id:nav_id,status:status},
			success:function (data){
				location. reload(true);
			}

		});  
 });
		
$('#zero_config1').on('switchChange.bootstrapSwitch','input[name="switch"]', function (e, state) {
      
	  var nav_id = $(this).attr("nav_id"); 

		var status;

		if ($(this).is(":checked")){
			status = "Active";
		}else{
			status = "Inactive";
		}
		$.ajax({
			type:"POST",
			url:"<?php echo base_url();?>admin/homepage/videostatus",
			data:{id:nav_id,status:status},
			success:function (data){
				location. reload(true);
			}

		});  
 });	

</script>

<script type="text/javascript">

// slider image
	
	$(".bgImages").click(function(){
		$.ajax({
			type : "post",
			data : {active_tab:"image"},
			url : "<? echo base_url('admin/homepage/set_sliderstab') ?>",
			success : function(data){
				console.log(data);
			},
			error : function(data){
				console.log(data);
			}
		})
	})
	
	$(".bgVideos").click(function(){
		$.ajax({
			type : "post",
			data : {active_tab:"video"},
			url : "<? echo base_url('admin/homepage/set_sliderstab') ?>",
			success : function(data){
				console.log(data);
			},
			error : function(data){
				console.log(data);
			}
		})
	})
	
	$(".imagemodal").click(function(){
		$(".image").html('');
		var image = $(this).attr("image");
		$("#imagemodal").modal("show")
		$(".image").html('<img src="'+image+'" class="img-responsive" width="100%">');
		
	})
	
	$(".editimagemodal").click(function(){
		var image = $(this).attr("image");
		var image_id = $(this).attr("image_id");
		$("#editimagemodal").modal("show")
		$(".old_image").val(image);
		$(".image_id").val(image_id);
	})
	
	function delImageslider(id,image) {

        Swal({
			title: 'Are you sure?',
			text: 'You will not be able to recover this selected banner image!',
			type: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Yes, delete it!',
			cancelButtonText: 'No, keep it'
        }).then((result) => {
			if (result.value) {

				Swal(
				'Deleted!',
				'Your Selected banner image has been deleted.',
				'success'
				)
				$.ajax({
					method: 'POST',
					data: {'id' : id,image:image },
					url: '<?php echo base_url() ?>admin/homepage/del_image/'+id,
					success: function(data) {
						location.reload();   
					}
				});

			} else if (result.dismiss === Swal.DismissReason.cancel) {
				Swal(
				'Cancelled',
				'Your Selected banner image is safe :)',
				'success',

				)
			}
		})
    }
	
// slider image end
	
// slider Video
	
	$(".videomodal").click(function(){
		$(".video").html('');
		var video = $(this).attr("video");
		$("#videomodal").modal("show")
		$(".video").html('<video controls src="'+video+'" width="100%"></video>');
	})
	
	$(".editvideomodal").click(function(){
		var video = $(this).attr("video");
		var video_id = $(this).attr("video_id");
		$("#editvideomodal").modal("show")
		$(".old_video").val(video);
		$(".video_id").val(video_id);
	})
	
	function delVideoslider(id,video) {

        Swal({
			title: 'Are you sure?',
			text: 'You will not be able to recover this selected banner video!',
			type: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Yes, delete it!',
			cancelButtonText: 'No, keep it'
        }).then((result) => {
			if (result.value) {

				Swal(
				'Deleted!',
				'Your Selected banner video has been deleted.',
				'success'
				)
				$.ajax({
					method: 'POST',
					data: {'id' : id,video:video },
					url: '<?php echo base_url() ?>admin/homepage/delete_why_to_attend/'+id,
					success: function(data) {
						location.reload();   
					}
				});

			} else if (result.dismiss === Swal.DismissReason.cancel) {
				Swal(
				'Cancelled',
				'Your Selected banner video is safe :)',
				'success',

				)
			}
		})
    }
	

$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 
  var recipient = button.data('whatever') 
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
})

</script>