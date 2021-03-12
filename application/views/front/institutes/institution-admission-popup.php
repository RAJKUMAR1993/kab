<style type="text/css">
    .custom_modal {
        height: 85%;
    }
</style>
<div class="custom_modal" id="admissions">
    <div class="row">
        <div class="col-md-12 text-right">
            <a style="font-size:20px;cursor:pointer;color:red" onclick="closeModal('admissions');">
                <i class="icon-cancel-6"></i><p style="font-size:10px">Close</p>
            </a>
        </div>
    </div>
    <div class="container margin_35">
			
			<div class="main_title_2" style="margin-bottom: 20px">
				<span><em></em></span>
				<?php $data = $this->db->get('tbl_admin')->row();  ?>
				<h2><?php echo $data->admisssion_year  ?></h2>
			</div>
			
			<div class="grid1">
						
				<div class="container">	
						
							<? 
				
		$pdata = $this->db->get_where("tbl_ppts",["institute_id"=>$idata->institute_id])->result();
		$bdata = $this->db->get_where("tbl_brouchers",["institute_id"=>$idata->institute_id])->result();
				
		if($pdata || $bdata){		
				
	?>				
					
					
					<div class="row">
					
						<? 
							if($bdata) {

						?>

							<div class="col-md-<? echo (count($pdata) == 0) ? 12 : 6 ?>">

								<section id="lessons">
									<div class="intro_title" style="margin-bottom: 10px">
										<h4 align="center">Brouchers</h4>
										<ul>

										</ul>
									</div>

									<div class="row">

										<? foreach ($bdata as $row) { 
											$thumb = ($row->thumbnail != "") ? $row->thumbnail : 'assets/images/pdf.png';
										?>

											<div class="col-lg-6 col-sm-12" style="margin-bottom:20px">
												<div style="padding:5px;background:#f1f1f1;width:100%;">
													
													<img style="opacity: inherit;padding: 5px;width:100%;height: 235px; position:relative" src="<? echo base_url().$thumb ?>">
														
												</div>
												
												<div style="max-height:105px;min-height:105px;border:1px solid #f1f1f1;padding:5px;overflow-y:auto" align="center">
													<h6 style="text-align:center"><? echo $row->broucher_name ?></h6>
													<a style="margin-bottom:0px;text-align:center;border-radius: 15px;color: white" class="btn btn-info btn-sm" href="<? echo base_url('assets/images/brochure/').$row->broucher ?>" download><i class="fa fa-download"></i> Download</a>
												</div>

											</div>

										<? } ?>

									</div>

								</section>	

							</div>

						<? } ?>
						
						
						<? 
							if($pdata) {

						?>

							<div class="col-md-<? echo (count($bdata) == 0) ? 12 : 6 ?>">

								<section id="lessons">
									<div class="intro_title" style="margin-bottom: 10px">
										<h4 align="center">PPTs</h4>
										<ul>

										</ul>
									</div>

									<div class="row">

										<? foreach ($pdata as $row) { 
											$ppt = ($row->broucher != "") ? "assets/images/brochure/".$row->broucher : 'assets/images/ppt.png';
										?>

											<div class="col-lg-6 col-sm-12" style="margin-bottom:20px">
												<div style="padding:5px;background:#f1f1f1;width:100%;">
												
													<? if($row->broucher != ""){ ?>
													
														<iframe src="//docs.google.com/gview?url=<? echo base_url().$ppt ?>&embedded=true" width="100%"></iframe>

													<? }else{ ?>
														<img style="opacity: inherit;padding: 5px;width:100%;height: 145px; position:relative" src="<? echo base_url().$ppt ?>">
													<? } ?>	
												</div>
												
												<div style="max-height:105px;min-height:105px;border:1px solid #f1f1f1;padding:5px;overflow-y:auto" align="center">
													<h6 style="text-align:center"><? echo $row->broucher_name ?></h6>
													<a style="margin-bottom:0px;text-align:center;border-radius: 15px;color: white" class="btn btn-info btn-sm" href="<? echo base_url('assets/images/brochure/').$row->broucher ?>"><i class="fa fa-download"></i> Download</a>
												</div>

											</div>

										<? } ?>

									</div>

								</section>	

							</div>

						<? } ?>
						

                   
				</div>
				
		<? } ?>	
						
						

						<div class="row">
							<div class="col-md-12">
								<section id="lessons">
										<div class="intro_title" style="margin-bottom: 10px">
											<h4>About Institute</h4>
										</div>
									 <? if($idata->aboutinst){ ?>
										<p><? echo nl2br($idata->aboutinst) ?></p>
									<? } ?>
								</section>
							</div>
						</div>
					
				<? $adata = $this->db->get_where("tbl_courses",["institute_id"=>$idata->institute_id,"deleted"=>0])->result(); 
				
				   if($adata){	
				?>
<!--
					<div class="row">

						<div class="col-md-12">
						
						
							<section id="lessons">
								<div class="intro_title" style="margin-bottom: 10px">
									<h4><? if($idata->institute_name){ echo $idata->institute_name; }else{ echo 'Institute'; } ?> offers the following Professional Courses (Regular Degrees and Diplomas)</h4>
									<ul>

									</ul>
								</div>
								<div id="accordion_lessons" role="tablist" class="add_bottom_45">

								<? 
									foreach ($adata as $ak => $row) {

								  ?>

										<div class="card">
											<div class="card-header" role="tab" id="" style="background-color: rgba(0,0,0,.03) !important">
												<h5 class="mb-0">
													<a data-toggle="collapse" href="#c<? echo $ak ?>" aria-expanded="true" aria-controls="c2"><i class="indicator ti-minus"></i> <? echo $row->course_name; ?></a>
												</h5>
											</div>

											<div id="c<? echo $ak ?>" class="collapse <? //echo ($ak == 0) ? 'show' : ''; ?>" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion_lessons">
												<div class="card-body">
													<div class="list_lessons">
														<ul>
															<li style="border-bottom-color: transparent">
																<i style="font-weight: 700;font-size: 16px;">Course Name:</i> 
																<span style="float: none;margin-left: 6px;"><? echo $row->course_name; ?></span>
															</li>
															<li style="border-bottom-color: transparent">
																<i style="font-weight: 700;font-size: 16px;">Specialization:</i> 
																<span style="float: none;margin-left: 6px;"><? echo $row->specialization; ?></span>
															</li>
															<li style="border-bottom-color: transparent">
																<i style="font-weight: 700;font-size: 16px;">Duration:</i> 
																<span style="float: none;margin-left: 6px;"><? echo $row->course_duration; ?></span>
															</li>
															<li style="border-bottom-color: transparent">
																<i style="font-weight: 700;font-size: 16px;">Details:</i> 
																<span style="float: none;margin-left: 6px;"><? echo $row->course_desc; ?></span>
															</li>
															<li style="border-bottom-color: transparent">
																<i style="font-weight: 700;font-size: 16px;">Merit Scholarship:</i> 
																<span style="float: none;margin-left: 6px;"><? echo ($row->merit_scholarship == "yes") ? '<a href="javascript:void(0)" class="btn btn-info btn-sm viewScholarship" cid="'.$row->course_id.'" style="color:white;border-radius:15px;">View Details</a>' : 'Not Applicable'; ?></span>
															</li>
														</ul>
													</div>
												</div>
											</div>
										</div>

									<? } ?>	
								</div>
							</section>


						</div>
					</div>
					-->
					<? } ?>
					
					
				<? $achievements = $this->db->get_where("tbl_achievement",["institute_id"=>$idata->institute_id,"is_deleted"=>0,"status"=>"Active"])->result(); 
				
				   if($achievements){	
				?>

					<div class="row">

						<div class="col-md-12">
						
						
							<section id="lessons">
								<div class="intro_title" style="margin-bottom: 10px">
									<h4>Achivements</h4>
									<ul>

									</ul>
								</div>
								<div id="accordion_lessons1" role="tablist" class="add_bottom_45">

								<? 
									foreach ($achievements as $ac => $row) {

								  ?>

										<div class="card">
											<div class="card-header" role="tab" id="" style="background-color: rgba(0,0,0,.03) !important">
												<h5 class="mb-0">
													<a data-toggle="collapse" href="#ach<? echo $ac ?>" aria-expanded="true" aria-controls="c2"><i class="indicator ti-minus"></i> <? echo $row->title; ?></a>
												</h5>
											</div>

											<div id="ach<? echo $ac ?>" class="collapse <? //echo ($ak == 0) ? 'show' : ''; ?>" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion_lessons1">
												<div class="card-body">
													<div class="list_lessons">
														<ul>
															<li style="border-bottom-color: transparent">
																<i style="font-weight: 700;font-size: 16px;">Title:</i> 
																<span style="float: none;margin-left: 6px;"><? echo $row->title; ?></span>
															</li>
															<li style="border-bottom-color: transparent">
																<i style="font-weight: 700;font-size: 16px;">Details:</i> 
																<span style="float: none;margin-left: 6px;"><? echo $row->description; ?></span>
															</li>
														</ul>
													</div>
												</div>
											</div>
										</div>

									<? } ?>	
								</div>
								<!-- /accordion -->
							</section>
							<!-- /section -->


						</div>
					</div>
					
				<? } ?>
					
	
				
				
				
		<?
			if($idata->instoffr != ""){	
				?>

					<div class="row">

						<div class="col-md-12">
						
							<section id="lessons">
								<div class="intro_title" style="margin-bottom: 10px">
									<h4>Institute Offering</h4>
									<ul>

									</ul>
								</div>
											
								<div class="row">

									<div class="col-md-12">

										<p><? echo nl2br($idata->instoffr) ?></p>

									</div>
									
								</div>			
												
							</section>
									
						</div>					
						
					</div>	
					
			<? } ?>																				
	
<?
			if($idata->meritscolar != ""){	
				?>

					<div class="row">

						<div class="col-md-12">
						
							<section id="lessons">
								<div class="intro_title" style="margin-bottom: 10px">
									<h4>Merit Scholarships Details</h4>
									<ul>

									</ul>
								</div>
											
								<div class="row">

									<div class="col-md-12">

										<p><? echo nl2br($idata->meritscolar) ?></p>

									</div>
									
								</div>			
												
							</section>
									
						</div>					
						
					</div>	
					
			<? } ?>	
				
<?
			if($idata->impnote != ""){	
				?>

					<div class="row">

						<div class="col-md-12">
						
							<section id="lessons">
								<div class="intro_title" style="margin-bottom: 10px">
									<h4>Important Note</h4>
									<ul>

									</ul>
								</div>
											
								<div class="row">

									<div class="col-md-12">

										<p><? echo nl2br($idata->impnote) ?></p>

									</div>
									
								</div>			
												
							</section>
									
						</div>					
						
					</div>	
					
			<? } ?>				
				
				
			</div>

	

</div>
</div>
</div>