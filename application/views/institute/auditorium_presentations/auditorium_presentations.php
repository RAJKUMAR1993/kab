
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
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="col-lg-9 pull-left">
                            	<h2>Scheduled Meetings</h2>
                            </div>
                        </div>
			
        				<div class="body">
							<div class="col-lg-12 col-md-12">
									<div class="card">
										<div class="body">
											<ul class="nav nav-tabs-new2">
												<li class="nav-item"><a class="nav-link active show bgImages" data-toggle="tab" href="#Home-new2">Presentations</a></li>
												
												<li class="nav-item"><a class="nav-link  bgVideos" data-toggle="tab" href="#Profile-new2">Professor Sessions</a></li>
											</ul>
											<div class="tab-content">
												<div class="tab-pane active show" id="Home-new2">
													
													<div class="row">
														<!-- Column -->
														<div class="col-lg-12">
															<div class="card" style="border:0px">
																<div class="card-body">
																<div class="row">
																	<div class="col-lg-4 col-md-4 col-sm-6">
																		<a href="<?php echo base_url('institute/sessions/auditorium_presentations');?>">
																				<div class="body">
																					<div class="clearfix">
																						<div class="float-left">
																							<i class="fa fa-handshake-o text-col-green" style="font-size:25px;"></i>
																						</div>
																						<div class="number float-right text-right">
																							<h6> Booked presentations  </h6>
																							<span class="font700"><?php echo $booked;?></span>
																						</div>
																					</div>
																					<div class="progress progress-xs progress-transparent custom-color-green mb-0 mt-3">
																						<div class="progress-bar" data-transitiongoal="87"></div>
																					</div>
																				</div>
																			</a>
																	</div>
																	<div class="col-lg-4 col-md-4 col-sm-6">
																		<a href="<?php echo base_url('institute/sessions/auditorium_presentations?ref=completed');?>">
																				<div class="body">
																					<div class="clearfix">
																						<div class="float-left">
																							<i class="fa fa-check text-col-blue" style="font-size:25px;"></i>
																						</div>
																						<div class="number float-right text-right">
																							<h6>Completed presentations</h6>
																							<span class="font700"><?php echo $completed;?></span>
																						</div>
																					</div>
																					<div class="progress progress-xs progress-transparent custom-color-blue mb-0 mt-3">
																						<div class="progress-bar" data-transitiongoal="87"></div>
																					</div>
																				</div>
																			</a>
																	</div>
																	<div class="col-lg-4 col-md-4 col-sm-6">
																		<a href="<?php echo base_url('institute/sessions/auditorium_presentations?ref=upcoming');?>">
																				<div class="body">
																					<div class="clearfix">
																						<div class="float-left">
																							<i class="fa fa-arrow-up text-col-red" style="font-size:25px;"></i>
																						</div>
																						<div class="number float-right text-right">
																							<h6 style="font-size: 15px;">  Upcoming Presentations</h6>
																							<span class="font700"><?php echo $upcoming; ?></span>
																						</div>
																					</div>
																					<div class="progress progress-xs progress-transparent custom-color-red mb-0 mt-3">
																						<div class="progress-bar" data-transitiongoal="87"></div>
																					</div>
																				</div>
																			</a>
																	</div>
																	<div class="col-lg-4 col-md-4 col-sm-6">
																	   <div class="body">
																			<form method="get" id="filtersve">
																				<div class="clearfix">
																						<div class="form-group">
																							<label>Date</label>
																								<select class="form-control filtersve" name="date">
																									<option value="">Select Date</option>
																									<? $dates = $this->db->query("select date from tbl_student_auditorium_presentations group by date")->result();
																										foreach($dates as $d){
																											$date = ($this->input->get("date") == $d->date) ? 'selected' : '';
																											echo '<option value="'.$d->date.'" '.$date.'>'.date("d-m-Y",strtotime($d->date)).'</option>';
																										}				   
																									?>
																								</select>
																						</div>
																				</div>
																			</form>
																		</div>
																	</div>
																	<div class="col-md-4">
																<form method="get" id="filtersve1">
																	<div class="form-group" style="margin-top: 21px;">
																	<label>Auditorium</label>
																	<select class="form-control filtersve1" name="auditorium">
																			<option value="">Select Auditorium</option>
																			<? $institutes = $this->db->query("select tv.auditorium_id,ti.title from tbl_student_auditorium_presentations tv join tbl_institute_auditorium ti on tv.auditorium_id=ti.id group by tv.auditorium_id")->result();

																				foreach($institutes as $ins){
																					$insname = ($this->input->get("auditorium") == $ins->auditorium_id) ? 'selected' : '';
																					echo '<option value="'.$ins->auditorium_id.'" '.$insname.'>'.$ins->title.'</option>';
																				}				   
																			?>

																		</select>
																	</div>
																</div>
																<div class="col-md-1">
																	<div class="form-group" style="margin-top: 21px;">
																		<a href="<? echo base_url('institute/sessions/auditorium_presentations') ?>" class="btn btn-primary" style="margin-top: 25px">Clear</a>
																	</div>
																	</form>
																</div>
																</div>
																	<div class="table-responsive">
																		<table class="table table-bordered table-striped table-hover dataTable js-exportable">
																			<thead>
																				<tr>
																					<th>Sl.No.</th>
																					<th>Student Name</th>
																					<th>Title</th>
																					<th>Auditorium</th>
																					<th>Date</th>
																					<th>From Time</th>
																					<th>To Time</th>
																					<th>Zoom Link</th>
																					<th>Zoom Password</th>
																					<th>Recording</th>
																					<th>Converted Text</th> 

																				</tr>
																			</thead>
																			<tbody>
																				<?php if($webinars){
																						$key=1;
																						foreach($webinars as $row):
																							$mtg = $this->db->get_where("tbl_zoom_meetings", ["meeting_link" => $row->zoom_link])->row();
																							

																				?>
																				<tr>
																					<td><?php echo $key;?></td>
																					<td><a target="_self" href="<? echo base_url('institute/admissions/view_student/').$row->student_id ?>"><?php echo $this->db->get_where("tbl_students",["student_id"=>$row->student_id])->row()->student_name;?></a></td>
																					<td><?php echo $this->db->get_where("tbl_institute_presentations",["id"=>$row->presentation_id])->row()->title;?></td>
																					<td><?php echo $this->db->get_where("tbl_institute_auditorium",["id"=>$row->auditorium_id])->row()->title;?></td>
																					<td><?php echo date("d-m-Y",strtotime($row->date));?></td>
																					<td><?php echo date("H:i A", $row->from_time);?></td>
																					<td><?php echo date("H:i A", $row->to_time);?></td>
																					<?php
																					if(date("Y-m-d H:i", strtotime($row->date." ".date("H:i", $row->to_time))) >= date("Y-m-d H:i")){
																					?>
																					<td><a href="<? echo $row->zoom_link ?>" class="btn btn-primary" target="_blank">Join</a></td>
																					<td><?php echo $row->zoom_password;?></td>
																					<?php
																					}else{
																					?>
																					<td><p style="color: red;">Presentation Time has been completed.</p></td>
																					<td></td>
																					<?php
																					}
																					?>
																					<td><?php $play_url = $row->play_url;
																					if($play_url!=''){?><a href="<? echo base_url().$play_url ?>" class="btn btn-success" target="_blank">Play Recording</a><?php } else {echo 'No Recording Found.';}?></td>

																					<td><?php $converted_text = $row->converted_text;
																					if($converted_text!=''){?><a href="<? echo base_url('institute/sessions/downloadText/').$row->id ?>" class="btn btn-success" target="_blank">Download</a><?php } else {echo 'No Text Found.';}?></td>
																				</tr>
																				<?php $key++; endforeach;}
																				//else{ echo "No records found";}
																				?>

																			</tbody>

																		</table>
																	</div>
																</div>
															</div>
														</div>
													</div>
													
												</div>
												<div class="tab-pane " id="Profile-new2">
													
													<div class="row">
														<!-- Column -->
														<div class="col-lg-12">
															<div class="card" style="border:0px">
																<div class="card-body">
																	<div class="table-responsive">
																		<table class="table table-bordered table-striped table-hover dataTable js-exportable">
																			<thead>
																				<tr>
																					<th>S.no</th>
																					<th>Professor Name</th>
																					<th>Session Name</th>
																					<th>Date</th>
																					<th>From Time</th>
																					<th>To Time</th>
																					<th>Zoom Link</th>
																					<th>Zoom Password</th>
																					<th>Recording</th>
																					<th>Converted Text</th> 
																				</tr>
																			</thead>
																			<tbody>
																				<?php if($professor){
																						$key=1;
																						foreach($professor as $row):
																							//$mtg = $this->db->get_where("tbl_zoom_meetings", ["meeting_link" => $row->zoom_link])->row();

																					?>
																				<tr>
																					<td><?php echo $key;?></td>
																					<td><?php echo $this->db->get_where("tbl_councellors",array("id"=> $row->expert_id))->row()->expert_name;?></a></td>
																					<td><?php echo $this->db->get_where("tbl_counsellor_sessions",["exp_se_id"=>$row->session_id])->row()->title;?></td>
																					<td><?php echo date("d-m-Y",strtotime($row->exp_std_date));?></td>
																					<td><?php echo date("H:i A", $row->exp_std_time);?></td>
																					<td><?php echo date("H:i A", $row->to_time);?></td>
																					<?php
																					if(date("Y-m-d H:i", strtotime($row->date." ".date("H:i", $row->to_time))) >= date("Y-m-d H:i")){
																					?>
																					<td><a href="<? echo $row->zoom_link ?>" class="btn btn-primary" target="_blank">Join</a></td>
																					<td><?php echo $row->zoom_password;?></td>
																					<?php
																					}else{
																					?>
																					<td><p style="color: red;">Presentation Time has been completed.</p></td>
																					<td></td>
																					<?php
																					}
																					?>
																					<td><?php $play_url = $row->play_url;
																					if($play_url!=''){?><a href="<? echo base_url().$play_url ?>" class="btn btn-success" target="_blank">Play Recording</a><?php } else {echo 'No Recording Found.';}?></td>

																					<td><?php $converted_text = $row->converted_text;
																					if($converted_text!=''){?><a href="<? echo base_url('institute/sessions/downloadText/').$row->id ?>" class="btn btn-success" target="_blank">Download</a><?php } else {echo 'No Text Found.';}?></td>
																				</tr>
																				<?php $key++; endforeach;}
																				else{ echo "No records found";}
																				?>
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
		</div>
	</div>
</div>
<script>
	$(".filtersve").change(function(){
	$("#filtersve").submit();
	//alert($(this).val());


})
</script>
<script>
	$(".filtersve1").change(function(){

		$("#filtersve1").submit();

	})
</script>
