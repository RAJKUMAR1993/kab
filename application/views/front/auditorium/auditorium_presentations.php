<? $this->load->view("front/includes/new_header");?>

<!--<div id="inbanner">
<img src="<?php echo base_url();?>assets/images/front/audi-bg.jpg" style="height: 340px;width: 100%"  alt="" class="img-fluid">
</div>-->

<section id="hero_in" class="general" style="height: 250px">
	<div class="wrapper" style="background-image: url('<?php echo base_url();?>assets/images/front/audi-bg.jpg'); background-size:contain;">
	<div class="container">
		<h1 class="fadeInUp"><span></span><? echo $audi->title ?></h1>
	</div>
	</div>
</section>
		
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="<?php echo base_url();?>">Home</a></li>
	<li class="breadcrumb-item"><a href="<? echo base_url();?>front/webinars/eventSchedule">Event Schedule</a></li>
	<li class="breadcrumb-item"><a href="<? echo base_url('front/auditorium/view/').$audi->id ?>"><?php echo $audi->title;?></a></li>
	<li class="breadcrumb-item active" aria-current="page"><?php echo ucfirst($in->institute_name);?></li>
	  </ol>
</nav>		
		

<div class="container margin_60_35">
			<div class="row">
				<aside class="col-lg-3" id="sidebar">
					<div class="profile">
						<figure>
						<? if(file_exists($in->theme_logo)){ ?>
							<img src="<? echo base_url().$in->theme_logo ?>" class="rounded-circle" width="100%" height="100px">
						<? }else{ ?>	
							<img src="<? echo base_url('assets/images/logo.png') ?>" class="rounded-circle" width="100%" height="100px">
						<? } ?>
						</figure>
						<? echo '<p style="text-align:center;font-weight:500;">'.strtoupper($in->institute_name).'</p>'; ?>
						<ul>
							<li>Email <span class="float-right"><? echo $in->email ?></span> </li>
							<li>Phone <span class="float-right"><? echo $in->phone ?></span></li>
							<li style="height: 160px">Address <span class="float-right"><? echo $in->address ?></span></li>
						</ul>
					</div>
				</aside>
				<!--/aside -->

				<div class="col-lg-9">
					<div class="box_teacher">
					
						<hr class="styled_2">
						<div class="indent_title_in">
							<i class="pe-7s-display1"></i>
							<h3>Presentations</h3>
							<div class="alertMessage"></div>
<!--							<p>Mussum ipsum cacilds, vidis litro abertis.</p>-->
						</div>
						<div class="wrapper_indent">
<!--							<p>Mei ut decore accusam consequat, alii dignissim no usu. Phaedrum intellegat sit ut, no pri mutat eirmod. In eum iriure perpetua adolescens, pri dicunt prodesset et. Vis dicta postulant ad.</p>-->
							
							<? if(count($sessions) > 0){ ?>
							
								<table class="table table-responsive table-striped add_bottom_30">
									<thead>
										<tr>
											<th>Title</th>
											<th>From Time</th>
											<th>To Time</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										
										<?  
											foreach($sessions as $se){
											
												if(date("Y-m-d H:i A", strtotime($se->date." ".date("h:i A",$se->to_time))) >= date("Y-m-d H:i:s")){
													
												$stime = strtotime("now");	
										?>
											<tr>
												<td><? echo ucfirst($se->title) ?></td>
												<td><? echo date("h:i A",$se->from_time) ?></td>
												<td><? echo date("h:i A",$se->to_time) ?></td>
												<td>
													
													<? if((date("Y-m-d") == $se->date) && (($se->from_time >= $stime) && ($se->to_time <= $stime))){ ?>
													
														<a href="javascript:void(0)" class="btn btn-info btn-sm saveSession" id="<? echo $se->id ?>" ref="join" zoom_link="<? echo $se->zoom_meeting_link ?>" style="border-radius: 30%;margin-top: 0px;">Join</a>
														
													<? }else{ ?>
													
														<a href="javascript:void(0)" class="btn btn-info btn-sm saveSession" id="<? echo $se->id ?>" ref="book" style="border-radius: 30%;margin-top: 0px;">Book</a>
														
													<? } ?>			
														
												</td>
											</tr>
										<? }else{
													echo '<p style="text-align:center;font-size:18px;">No Presentations Found</p>';
												}} ?>	
											
									</tbody>
								</table>
								
							<?	}else{
	
								echo '<p style="text-align:center;font-size:18px;">No Presentations Found</p>';	

							} ?>	
						</div>
						<!--wrapper_indent -->
					</div>
				</div>
				<!-- /col -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->		<!--/container-->	

<? $this->load->view("front/includes/new_footer");?>
<script type="text/javascript" src="<? echo base_url('assets/udema/js/bootstrap.min.js') ?>"></script>

<script>

	$(".saveSession").click(function(e){
		
		var value = $(this).attr("id");
		var ref = $(this).attr("ref");
		var zoom_link = $(this).attr("zoom_link");
		
		$.ajax({

			type : "post",
			url : "<? echo base_url('front/Auditorium/save_in_session') ?>",
			data : {session:value,ref:ref},
			success : function(data){

				if(data == "success"){

					$(".alertMessage").html('<div class="alert alert-success">You Have Successfully Applied For this Session.</div>');
					setTimeout(function(){location.reload()},3000);

				}else if(data == "join"){
					
					window.location.href = zoom_link;
					
				}else{					

					$(".alertMessage").html(data)
					setTimeout(function(){$(".alertMessage").html("")},3000);

				}

				console.log(data)

			},
			error : function(data){

				console.log(data)

			}

		});
		
	});


</script>


