<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->
<style>
    td.details-control {
    background: url('<?php echo base_url(); ?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
    }
    tr.shown td.details-control {
        background: url('<?php echo base_url(); ?>assets/images/details_close.png') no-repeat center center;
    }
    .form-control1{
    	background-color: #005cbf;
    }
</style>

<div id="main-content">
    <div class="col-md-12">
    <?php echo $this->session->flashdata('msg');?>
	<div class="card">
		<div class="body">
			<ul class="nav nav-tabs-new2">
				<li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Home-new2">Basic Details</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#acd-new2">Academics</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Profile-new2">Entrance Exams</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Contact-new2">Additional Details</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Upload-Docs">Certificate Upload</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane show active" id="Home-new2">
					<form id="basic-form" method="post" action="<?php echo base_url("student/settings/update")?>" enctype="multipart/form-data" novalidate>
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Full name</label>
                                        <input type="text" class="form-control" name="name" value="<?php if(isset($admin->student_name)){ echo $admin->student_name;}?>" required>
                                    </div>
                           
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" value="<?php if(isset($admin->email)){ echo $admin->email;}?>" required>
                                    </div>
                                   
                                </div>
                        
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Mobile</label>
                                        <input type="number" class="form-control" name="mobile" value="<?php if(isset($admin->phone)){ echo $admin->phone;}?>"required>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="text" class="form-control" name="password" value="<?php if(isset($admin->password)){ echo $this->student_login_model->api_key_crypt($admin->password,"d");}?>" required>
                                        <input type="hidden" class="form-control" name="old_password" value="<?php if(isset($admin->password)){ echo $admin->password;}?>" >
                                    </div>
                                   
                                </div>

                                 <div class="col-lg-6 pull-left">
                                    
                                    
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea class="form-control" name="address" required><?php if(isset($admin->address)){ echo $admin->address;}?></textarea>
                                        
                                    </div>
                                                                      
                                 </div>


                                 <button type="submit" class="btn btn-primary pull-right">Update Details</button><br><br><br>
                            </form>
				</div>
				<div class="tab-pane" id="acd-new2">
					<div class="body">
                            <ul class="nav nav-tabs-new" style="dispaly:">
                                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Home-new">SSC / X Class Details</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Profile-new">Intermediate / +2 Details or Diploma</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Contact-new">Degree Details</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane show active" id="Home-new">
                                    <div class="col-lg-12 table-responsive">
									<?php if(!empty($student)){ ?>
										<table class="table table-bordered table-stripped" id="sscsdata">
											<thead>												
											</thead>
											<tbody>											    
												<tr>
													<td style="font-weight: bold;">Name of the Board</td>
													<td><?php echo $student->ssc_board;?></td>
												</tr>
												<tr>
													<td style="font-weight: bold;">School Name</td>
													<td><?php echo $student->ssc_school;?></td>
												</tr>
												<tr>
													<td style="font-weight: bold;">School Address</td>
													<td><?php echo $student->ssc_address;?></td>
												</tr>
												<tr>
													<td style="font-weight: bold;">School District</td>
													<td><?php echo $student->ssc_district;?></td>
												</tr>
												<tr>
													<td style="font-weight: bold;">School State</td>
													<td><?php echo $student->ssc_state;?></td>
												</tr>
												
												<tr>
													<td style="font-weight: bold;">Hall Ticket Number</td>
													<td><?php echo $student->ssc_hallticket;?></td>
												</tr>
												<tr>
													<td style="font-weight: bold;">Total Marks</td>
													<td><?php echo $student->ssc_totalmarks;?></td>
												</tr>
												<tr>
													<td style="font-weight: bold;">Total Marks Secured</td>
													<td><?php echo $student->ssc_markssecured;?></td>
												</tr>
												<tr>
													<td style="font-weight: bold;">Percentage</td>
													<td><?php echo $student->ssc_percentage;?></td>
												</tr>
												<tr>
													<td style="font-weight: bold;">Year of passing</td>
													<td><?php echo $student->ssc_yearpassing;?></td>
												</tr>
											</tbody>
										</table>
									<?php }else{ ?>
									    <table class="table table-bordered table-stripped" id="sscsdata">
											<thead>
												
											</thead>
											<tbody>											    
												<tr>
													<td style="font-weight: bold;">Name of the Board</td>
													<td></td>
												</tr>
												<tr>
													<td style="font-weight: bold;">School Name</td>
													<td></td>
												</tr>
												<tr>
													<td style="font-weight: bold;">School Address</td>
													<td></td>
												</tr>
												<tr>
													<td style="font-weight: bold;">School District</td>
													<td></td>
												</tr>
												<tr>
													<td style="font-weight: bold;">School State</td>
													<td></td>
												</tr>
												
												<tr>
													<td style="font-weight: bold;">Hall Ticket Number</td>
													<td></td>
												</tr>
												<tr>
													<td style="font-weight: bold;">Total Marks</td>
													<td></td>
												</tr>
												<tr>
													<td style="font-weight: bold;">Total Marks Secured</td>
													<td></td>
												</tr>
												<tr>
													<td style="font-weight: bold;">Percentage</td>
													<td></td>
												</tr>
												<tr>
													<td style="font-weight: bold;">Year of passing</td>
													<td></td>
												</tr>
											</tbody>
										</table>	
									<?php } ?>
									<div class="pull-right" style="margin-bottom: 10px">
										<button type="button" class="btn btn-info" id="sscupdprofile">Update Profile</button>
									</div>
									</div>
									<div class="row" id="sscupddata" style="display: none">
									    <form method="post" action="<?php echo base_url("student/settings/updatessc") ?>" enctype="multipart/form-data">

										     <div class="row" style="margin-bottom: 10px">
											   
											   <div class="col-md-6">
											   	<label class="control-label" for="">Name of the Board:</label>
												 <select name="ssc_board" class="form-control" style="width: 100%" required>
													
													<option value="">Choose Board</option>
													<?php foreach($sscboard as $board){?>
														<option value="<?php echo $board->board_name;?>" <? echo ($student->ssc_board == $board->board_name) ? 'selected' : ''; ?>><?php echo $board->board_name;?></option>
													<?php }?>
												  </select>
											   </div>	
											   
											   
												<div class="col-md-6">
													<label class="control-label" for="">School Name:</label>
													<input type="text" class="form-control" id="" name="ssc_school" value="<?php echo($student->ssc_school) ?>" style="width: 100%">
											   </div>	
												
											 </div>	

											  <div class="row" style="margin-bottom: 10px">
											   
											   <div class="col-md-6">
											   	<label class="control-label" for="">School Address:</label>
												 	<input type="text" class="form-control" id="" name="ssc_address" value="<?php echo($student->ssc_address) ?>" style="width: 100%">
											   </div>	
											   
											    <div class="col-md-6">
											   	<label class="control-label" for="">School State:</label>
												 <select name="ssc_state" class="form-control std_state" style="width: 100%" id="std_state" required>
													
													<option value="">Choose State</option>
													<?php foreach($states as $state){?>
														<option value="<?php echo $state->State;?>" <? echo ($student->ssc_state == $state->State) ? 'selected' : ''; ?>><?php echo $state->State;?></option>
													<?php }?>
												  </select>
											   </div>	

												
												
											 </div>	

											  <div class="row" style="margin-bottom: 10px">
											   
												<div class="col-md-6">
													<label class="control-label" for="">School District:</label>
													<select name="ssc_district" id="ssc_district" class="form-control student_district"  style="width: 100%" required>
														
														<option value="">Choose District</option>
														<?php foreach($districts as $dist){?>
															<option value="<?php echo $dist->District;?>" <? echo ($student->ssc_district == $dist->District) ? 'selected' : ''; ?>><?php echo $dist->District;?></option>
														<?php }?>
													  </select>
											   </div>	
											   
											   
												<div class="col-md-6">
													<label class="control-label" for="">Hallticket Number:</label>
													<input type="text" class="form-control" id="" name="ssc_hallticket" value="<?php echo($student->ssc_hallticket) ?>" style="width: 100%">
											   </div>	
												
											 </div>	

											  <div class="row" style="margin-bottom: 10px">
											   
											   <div class="col-md-6">
											   	<label class="control-label" for="">Total Marks:</label>
												 <input type="number" class="form-control" id="ssc_totalmarks" name="ssc_totalmarks" value="<?php echo($student->ssc_totalmarks) ?>" style="width: 100%">
											   </div>	
											   
											   
												<div class="col-md-6">
													<label class="control-label" for="">Total Marks Secured:</label>
													<input type="number" class="form-control" id="ssc_markssecured" name="ssc_markssecured" value="<?php echo($student->ssc_markssecured) ?>" style="width: 100%">
											   </div>	
												
											 </div>	

											  <div class="row" style="margin-bottom: 10px">
											   
											   <div class="col-md-6">
											   	<label class="control-label" for="">Percentage:</label>
												 	<input type="number" class="form-control" id="ssc_percentage" max="100" name="ssc_percentage" value="<?php echo($student->ssc_percentage) ?>" style="width: 100%">
											   </div>	
											   
											   
												<div class="col-md-6">
													<label class="control-label" for="">Year Of Passing:</label>
													<select name="ssc_yearpassing" class="form-control" style="width: 100%" required>
														
														<option value="">Choose Year</option>
														<?php foreach($years as $year){?>
															<option value="<?php echo $year->year;?>" <? echo ($student->ssc_yearpassing == $year->year) ? 'selected' : ''; ?>><?php echo $year->year;?></option>
														<?php }?>
													  </select>
											   </div>	
												
											 </div>	
	
												<button type="submit" class="btn btn-success btn-anim"><i class="icon-rocket"></i><span class="btn-text">Update</span></button>
												<button type="button" class="btn btn-primary" id="sscback">Back</button>
												
											</form>		
				                    </div>
                                </div>
                                <div class="tab-pane" id="Profile-new">
                                    <div class="col-lg-12 table-responsive">
										<table class="table table-bordered table-stripped" id="intersdata">
												<thead>
													
												</thead>
												<tbody>
													<tr>
														<td style="font-weight: bold;">Name of the Board</td>
														<td><?php echo $student->inter_board;?></td>
													</tr>
													<tr>
														<td style="font-weight: bold;">College Name</td>
														<td><?php echo $student->inter_college;?></td>
													</tr>
													<tr>
														<td style="font-weight: bold;">Course Name</td>
														<td><?php echo $student->inter_course;?></td>
													</tr>
													<tr>
														<td style="font-weight: bold;">Group Name</td>
														<td><?php echo $student->inter_group;?></td>
													</tr>
													<tr>
														<td style="font-weight: bold;">College Address</td>
														<td><?php echo $student->inter_address;?></td>
													</tr>
													<tr>
														<td style="font-weight: bold;">College District</td>
														<td><?php echo $student->inter_district;?></td>
													</tr>
													<tr>
														<td style="font-weight: bold;">College State</td>
														<td><?php echo $student->inter_state;?></td>
													</tr>
													
													<tr>
														<td style="font-weight: bold;">Hall Ticket Number</td>
														<td><?php echo $student->inter_hallticket;?></td>
													</tr>
													<tr>
														<td style="font-weight: bold;">Total Marks</td>
														<td><?php echo $student->inter_totalmarks;?></td>
													</tr>
													<tr>
														<td style="font-weight: bold;">Total Marks Secured</td>
														<td><?php echo $student->inter_markssecured;?></td>
													</tr>
													<tr>
														<td style="font-weight: bold;">Percentage</td>
														<td><?php echo $student->inter_percentage;?></td>
													</tr>
													<tr>
														<td style="font-weight: bold;">Group Marks</td>
														<td><?php echo $student->inter_groupmarks;?></td>
													</tr>
													<tr>
														<td style="font-weight: bold;">Year of passing</td>
														<td><?php echo $student->inter_yearpassing;?></td>
													</tr>
												</tbody>
											</table>
											<div class="pull-right" style="margin-bottom: 10px">
												<button type="button" class="btn btn-info" id="interupdprofile">Update Profile</button>
											</div>
										</div>
										<div class="row" id="interupddata" style="display: none">
												<form method="post" action="<?php echo base_url("student/settings/updateinter") ?>" enctype="multipart/form-data">

															 <div class="row" style="margin-bottom: 10px">
															   
															   <div class="col-md-6">
																<label class="control-label" for="">Name of the Board:</label><br>
																 <select name="inter_board" class="form-control" style="width: 100%" required>
																	
																	<option value="">Choose Board</option>
																	<?php foreach($interboard as $board){?>
																		<option value="<?php echo $board->board_name;?>" <? echo ($student->inter_board == $board->board_name) ? 'selected' : ''; ?>><?php echo $board->board_name;?></option>
																	<?php }?>
																  </select>
															   </div>	
															   
															   
																<div class="col-md-6">
																	<label class="control-label" for="">College Name:</label><br>
																	<input type="text" class="form-control" id="" name="inter_college" value="<?php echo($student->inter_college) ?>" style="width: 100%">
															   </div>	
																
															 </div>	
															 <div class="row" style="margin-bottom: 10px">
															   
															   <div class="col-md-6">
																<label class="control-label" for="">Name of Course:</label><br>
																 <select name="inter_course" class="form-control" style="width: 100%" required>
																	
																	<option value="">Choose Course</option>
																	<?php foreach($intercourse as $course){?>
																		<option value="<?php echo $course->course_name;?>" <? echo ($student->inter_course == $course->course_name) ? 'selected' : ''; ?>><?php echo $course->course_name;?></option>
																	<?php }?>
																  </select>
															   </div>	
															   
															   
																<div class="col-md-6">
																	<label class="control-label" for="">Group /Stream Name:</label><br>
																	<select name="inter_group" class="form-control" style="width: 100%" required>
																	
																	<option value="">Choose Course</option>
																	<?php foreach($intergroup as $group){?>
																		<option value="<?php echo $group->group_name;?>" <? echo ($student->inter_group == $group->group_name) ? 'selected' : ''; ?>><?php echo $group->group_name;?></option>
																	<?php }?>
																  </select>
															   </div>	
																
															 </div>	


															  <div class="row" style="margin-bottom: 10px">
															   
															   <div class="col-md-6">
																<label class="control-label" for="">College Address:</label><br>
																	<input type="text" class="form-control" id="" name="inter_address" value="<?php echo($student->inter_address) ?>" style="width: 100%">
															   </div>	
															   
																 <div class="col-md-6">
																<label class="control-label std_state" for="">College State:</label><br>
																 <select name="inter_state" id="inter_state" class="form-control std_state" style="width: 100%" required>
																	
																	<option value="">Choose State</option>
																	<?php foreach($states as $state){?>
																		<option value="<?php echo $state->State;?>" <? echo ($student->inter_state == $state->State) ? 'selected' : ''; ?>><?php echo $state->State;?></option>
																	<?php }?>
																  </select>
															   </div>
																	
																
															 </div>	

															  <div class="row" style="margin-bottom: 10px">
															   
															   <div class="col-md-6">
																	<label class="control-label" for="">College District:</label><br>
																	<select name="inter_district" id="inter_district" class="form-control student_district" style="width: 100%" required>
																		
																		<option value="">Choose District</option>
																		<?php foreach($districts as $dist){?>
																			<option value="<?php echo $dist->District;?>" <? echo ($student->inter_district == $dist->District) ? 'selected' : ''; ?>><?php echo $dist->District;?></option>
																		<?php }?>
																	  </select>
															   </div>

																
															   
															   
																<div class="col-md-6">
																	<label class="control-label" for="">Hallticket Number:</label><br>
																	<input type="text" class="form-control" id="" name="inter_hallticket" value="<?php echo($student->inter_hallticket) ?>" style="width: 100%">
															   </div>	
																
															 </div>	

															  <div class="row" style="margin-bottom: 10px">
															   
															   <div class="col-md-6">
																<label class="control-label" for="">Total Marks:</label><br>
																 <input type="number" class="form-control" id="inter_totalmarks" name="inter_totalmarks" value="<?php echo($student->inter_totalmarks) ?>" style="width: 100%">
															   </div>	
															   
															   
																<div class="col-md-6">
																	<label class="control-label" for="">Total Marks Secured:</label><br>
																	<input type="number" class="form-control" id="inter_markssecured" name="inter_markssecured" value="<?php echo($student->inter_markssecured) ?>" style="width: 100%">
															   </div>	
																
															 </div>	

															  <div class="row" style="margin-bottom: 10px">
															   
															   <div class="col-md-6">
																<label class="control-label" for="">Percentage:</label><br>
																	<input type="number" max="100" class="form-control" id="inter_percentage" name="inter_percentage" value="<?php echo($student->inter_percentage) ?>" style="width: 100%">
															   </div>	
															   
															   <div class="col-md-6">
																<label class="control-label" for="">Group Marks:</label><br>
																	<input type="number" class="form-control" id="" name="inter_groupmarks" value="<?php echo($student->inter_groupmarks) ?>" style="width: 100%">
															   </div>	

																<div class="col-md-6">
																	<label class="control-label" for="">Year Of Passing:</label><br>
																	<select name="inter_yearpassing" class="form-control" style="width: 100%" required>
																		
																		<option value="">Choose Year</option>
																		<?php foreach($years as $year){?>
																			<option value="<?php echo $year->year;?>" <? echo ($student->inter_yearpassing == $year->year) ? 'selected' : ''; ?>><?php echo $year->year;?></option>
																		<?php }?>
																	  </select>
															   </div>	
																
															 </div>	

																<center>	
																<button type="submit" class="btn btn-success btn-anim"><i class="icon-rocket"></i><span class="btn-text">Update</span></button>
																	<button type="button" class="btn btn-primary" id="interback">Back</button>
																</center>
															</form>							
								            </div>
                                    </div>
                                <div class="tab-pane" id="Contact-new">
                                    <div class="col-lg-12 table-responsive">
										<table class="table table-bordered table-stripped" id="degreesdata">
												<thead>
													
												</thead>
												<tbody>
													<tr>
														<td style="font-weight: bold;">College Name</td>
														<td><?php echo $student->degree_college;?></td>
													</tr>
													<tr>
														<td style="font-weight: bold;">Affiliated University</td>
														<td><?php echo $student->degree_auniversity;?></td>
													</tr>
													<tr>
														<td style="font-weight: bold;">Course</td>
														<td><?php echo $student->degree_course;?></td>
													</tr>
													<tr>
														<td style="font-weight: bold;">Specialisation</td>
														<td><?php echo $student->degree_group;?></td>
													</tr>
													<tr>
														<td style="font-weight: bold;">College Address</td>
														<td><?php echo $student->degree_address;?></td>
													</tr>
													<tr>
														<td style="font-weight: bold;">College District</td>
														<td><?php echo $student->degree_district;?></td>
													</tr>
													<tr>
														<td style="font-weight: bold;">College State</td>
														<td><?php echo $student->degree_state;?></td>
													</tr>
													
													<tr>
														<td style="font-weight: bold;">Hall Ticket Number</td>
														<td><?php echo $student->degree_hallticket;?></td>
													</tr>
													<tr>
														<td style="font-weight: bold;">Total Marks</td>
														<td><?php echo $student->degree_totalmarks;?></td>
													</tr>
													<tr>
														<td style="font-weight: bold;">Total Marks Secured</td>
														<td><?php echo $student->degree_markssecured;?></td>
													</tr>
													<tr>
														<td style="font-weight: bold;">Percentage</td>
														<td><?php echo $student->degree_percentage;?></td>
													</tr>
													<tr>
														<td style="font-weight: bold;">Group Marks</td>
														<td><?php echo $student->degree_groupmarks;?></td>
													</tr>
													<tr>
														<td style="font-weight: bold;">Year of passing</td>
														<td><?php echo $student->degree_yearpassing;?></td>
													</tr>
												</tbody>
											</table>
										</div>
										<div class="pull-right" style="margin-bottom: 10px">
											<button type="button" class="btn btn-info" id="degreeupdprofile">Update Profile</button>
										</div>
										<div class="row" id="degreeupddata" style="display: none">
							
															<form method="post" action="<?php echo base_url("student/settings/updatedegree") ?>" enctype="multipart/form-data">

															 <div class="row" style="margin-bottom: 10px">
															   
															   <div class="col-md-6">
																<label class="control-label" for="">College Name:</label><br>
																	<input type="text" class="form-control" id="" name="degree_college" value="<?php echo($student->degree_college) ?>" style="width: 100%">
															   </div>	
															   
															   
																<div class="col-md-6">
																	<label class="control-label" for="">Affiliated University:</label><br>
																	<select name="degree_auniversity" class="form-control" style="width: 100%" required>
																	
																	<option value="">Choose Board</option>
																	<?php foreach($auniversity as $u){?>
																		<option value="<?php echo $u->university;?>" <? echo ($student->degree_auniversity == $u->university) ? 'selected' : ''; ?>><?php echo $u->university;?></option>
																	<?php }?>
																  </select>
															   </div>	
																
															 </div>	
															 <div class="row" style="margin-bottom: 10px">
															   
															   <div class="col-md-6">
																<label class="control-label" for="">Course:</label><br>
																 <select name="degree_course" class="form-control" style="width: 100%" required>
																	
																	<option value="">Choose Course</option>
																	<?php foreach($degreecourse as $course){?>
																		<option value="<?php echo $course->course_name;?>" <? echo ($student->degree_course == $course->course_name) ? 'selected' : ''; ?>><?php echo $course->course_name;?></option>
																	<?php }?>
																  </select>

															   </div>	
															   
															   
																<div class="col-md-6">
																	<label class="control-label" for="">Specialization:</label><br>
																	<select name="degree_group" class="form-control" style="width: 100%" required>
																	
																	<option value="">Choose Specialization</option>
																	<?php foreach($degreegroup as $group){?>
																		<option value="<?php echo $group->group_name;?>" <? echo ($student->degree_group == $group->group_name) ? 'selected' : ''; ?>><?php echo $group->group_name;?></option>
																	<?php }?>
																  </select>
															   </div>	
																
															 </div>	


															  <div class="row" style="margin-bottom: 10px">
															   
															   <div class="col-md-6">
																<label class="control-label" for="">College Address:</label><br>
																	<input type="text" class="form-control" id="" name="degree_address" value="<?php echo($student->degree_address) ?>" style="width: 100%">
															   </div>	
																
																   <div class="col-md-6">
																<label class="control-label" for="">College State:</label><br>
																 <select name="degree_state" id="degree_state" class="form-control std_state" style="width: 100%" required>
																	
																	<option value="">Choose State</option>
																	<?php foreach($states as $state){?>
																		<option value="<?php echo $state->State;?>" <? echo ($student->degree_state == $state->State) ? 'selected' : ''; ?>><?php echo $state->State;?></option>
																	<?php }?>
																  </select>
															   </div>
															   
																
															 </div>	

															  <div class="row" style="margin-bottom: 10px">
															   
																	<div class="col-md-6">
																	<label class="control-label" for="">College District:</label><br>
																	<select name="degree_district" id="degree_district" class="form-control student_district" style="width: 100%" required>
																		
																		<option value="">Choose District</option>
																		<?php foreach($districts as $dist){?>
																			<option value="<?php echo $dist->District;?>" <? echo ($student->degree_district == $dist->District) ? 'selected' : ''; ?>><?php echo $dist->District;?></option>
																		<?php }?>
																	  </select>
															   </div>	
															   
															   
																<div class="col-md-6">
																	<label class="control-label" for="">Hallticket Number:</label><br>
																	<input type="text" class="form-control" id="" name="degree_hallticket" value="<?php echo($student->degree_hallticket) ?>" style="width: 100%">
															   </div>	
																
															 </div>	

															  <div class="row" style="margin-bottom: 10px">
															   
															   <div class="col-md-6">
																<label class="control-label" for="">Total Marks:</label><br>
																 <input type="number" class="form-control" id="degree_totalmarks" name="degree_totalmarks" value="<?php echo($student->degree_totalmarks) ?>" style="width: 100%">
															   </div>	
															   
															   
																<div class="col-md-6">
																	<label class="control-label" for="">Total Marks Secured:</label><br>
																	<input type="number" class="form-control" id="degree_markssecured" name="degree_markssecured" value="<?php echo($student->degree_markssecured) ?>" style="width: 100%">
															   </div>	
																
															 </div>	

															  <div class="row" style="margin-bottom: 10px">
															   
															   <div class="col-md-6">
																<label class="control-label" for="">Percentage:</label><br>
																	<input type="number" class="form-control" id="degree_percentage" name="degree_percentage" value="<?php echo($student->degree_percentage) ?>" style="width: 100%">
															   </div>	
															   
															   <div class="col-md-6">
																<label class="control-label" for="">Group Marks:</label><br>
																	<input type="number" class="form-control" id="" name="degree_groupmarks" value="<?php echo($student->degree_groupmarks) ?>" style="width: 100%">
															   </div>	

																<div class="col-md-6">
																	<label class="control-label" for="">Year Of Passing:</label><br>
																	<select name="degree_yearpassing" class="form-control" style="width: 100%" required>
																		
																		<option value="">Choose Year</option>
																		<?php foreach($years as $year){?>
																			<option value="<?php echo $year->year;?>" <? echo ($student->degree_yearpassing == $year->year) ? 'selected' : ''; ?>><?php echo $year->year;?></option>
																		<?php }?>
																	  </select>
															   </div>	
																
															 </div>	

																<center>	
																<button type="submit" class="btn btn-success btn-anim"><i class="icon-rocket"></i><span class="btn-text">Update</span></button>
																	<button type="button" class="btn btn-primary" id="degreeback">Back</button>
																</center>
															</form>
																
								</div>
                                </div>
                            </div>
                        </div>
				</div>
				<div class="tab-pane" id="Profile-new2">
						<div class="col-lg-12 table-responsive">
							<table class="table table-bordered table-stripped" id="edata">
									<thead>
										<th>Entrance Exam Name</th>
										<th>Year of Appeared</th>
										<th>Hall Ticket Number</th>
										<th>Maximum Marks</th>
										<th>Marks Secured</th>
										<th>Rank Obtained / All India Rank</th>
										<th>Action</th>
									</thead>
									<tbody>
										<?php
											foreach($entrance_list as $row):
										?>
										<tr>
											<!-- <td style="font-weight: bold;">Entrance Exam Name</td> -->
											<td><?php echo $row->exam_name;?></td>
											<td><?php echo $row->year_appeared;?></td>
											<td><?php echo $row->hallticket;?></td>
											<td><?php echo $row->max_marks;?></td>
											<td><?php echo $row->secured_marks;?></td>
											<td><?php echo $row->rank;?></td>
											
											<td><button type="button" class="btn btn-info udpateexam_<?php echo $row->id;?>" data-ename="<?php echo $row->exam_name;?>" data-yappeared="<?php echo $row->year_appeared;?>" data-hticket="<?php echo $row->hallticket;?>" data-xmarks="<?php echo $row->max_marks;?>" data-smarks="<?php echo $row->secured_marks;?>" data-rank="<?php echo $row->rank;?>" onclick="updateExam('<?php echo $row->id;?>')">Update</button></td>
										</tr>
										<?php endforeach;?>					
									</tbody>
								</table>
							</div>
							<div class="row">
								<div class="pull-right" style="padding-right: 30px;">
								<button type="button" class="btn btn-info" id="examsadd">ADD</button>
							</div>	
						</div>
					<div  id="edataupdate" style="display:none;">
					    <form method="post" action="<?php echo base_url("student/settings/entrance_insert") ?>" enctype="multipart/form-data">
						    <div class="row">
					    	<input type="hidden" name="exam_id" id="exam_id">
                                    <div class="col-lg-4">
										<div class="form-group">
											<label>Entrance Exam Name</label>
											<select name="exam_name" id="exam_name" class="form-control" required>
											<option value="">Choose Exam</option>
											<?php foreach($eexams as $exam){?>
												<option value="<?php echo $exam->exam_name;?>"><?php echo $exam->exam_name;?></option>
											<?php }?>
										</select>
										</div>							   
										<div class="form-group">
											<label>Year of Appeared</label>
											<select name="year_appeared" id="year_appeared" class="form-control" style="width: 100%" required>
												<option value="">Choose Year</option>
												<?php foreach($years as $year){?>
													<option value="<?php echo $year->year;?>"><?php echo $year->year;?></option>
												<?php }?>
										</select>
										</div>									   
									</div>
                                    <div class="col-lg-4">
										<div class="form-group">
											<label>Hall Ticket Number</label>
											<input type="text" class="form-control" id="hallticket" name="hallticket" value="" style="width: 100%">
										</div>							   
										<div class="form-group">
											<label>Maximum Marks</label>
											<input type="text" class="form-control" id="max_marks" name="max_marks" value="" style="width: 100%">
										</div>									   
									</div>
                                    <div class="col-lg-4">
										<div class="form-group">
											<label>Marks Secured</label>
											<input type="text" class="form-control" id="secured_marks" name="secured_marks" value="" style="width: 100%">
										</div>							   
										<div class="form-group">
											<label>Rank Obtained / All India Rank</label>
											<input type="text" class="form-control" id="rank" name="rank" value="" style="width: 100%">
										</div>									   
									</div>									
									</div>									
								
									<button type="submit" class="btn btn-primary pull-right">Update Details</button>
									</form>						
			        </div>
				</div>
				<div class="tab-pane" id="Contact-new2">
					<form action="<?php echo base_url('student/settings/udateotherdetails');?>" method="POST" enctype="multipart/form-data">
							<div class="row">
								<div class="col-lg-6 form-group">
									<label>Person with Disability ?</label><br>
									<input type="radio"  name="disability" value="Yes" id="disability" <?php echo ($admin->person_disability_check =='Yes')?"checked" :"";?>> Yes
									<input type="radio" name="disability" value="No" id="disability" <?php echo ($admin->person_disability_check =='No')?"checked" :"";?>> No
								</div>
								<div class="col-lg-5 form-group">
									<label>Type of disability</label>
									<select class="form-control" name="disability_name" id="disability_select">
										
										<option value="">Select Disability</option>
										<option value="vision Impairment" <? echo ($admin->disability_name == "vision Impairment") ? 'selected' : ''; ?>>vision Impairment.</option>
										<option value="deaf or hard of hearing" <? echo ($admin->disability_name == "deaf or hard of hearing") ? 'selected' : ''; ?>>deaf or hard of hearing.</option>
										<option value="mental health conditions" <? echo ($admin->disability_name == "mental health conditions") ? 'selected' : ''; ?>>mental health conditions.</option>
										<option value="orthopedic" <? echo ($admin->disability_name == "orthopedic") ? 'selected' : ''; ?>>Orthopedic.</option>
										<!-- <option value="">intellectual disability.</option>
										<option value="">acquired brain injury.</option>
										<option value="">autism spectrum disorder.</option>
										<option value="">physical disability.</option> -->
									</select>
								</div>
								<div class="col-lg-6 form-group">
									<label>Upload Photo</label><br>
									<span style="color: red">Width:350px, Height:500px Please maintain aspect ratio</span>
									<input type="file" name="image"  data-allowed-file-extensions="jpg png jpeg" class="dropify">
								</div>
								<div class="col-lg-6 form-group">
									<label>Upload Signature</label><br>
									<span style="color: red">Width:500px, Height:150px Please maintain aspect ratio</span>
									<input type="file" name="sign" data-allowed-file-extensions="jpg png jpeg" class="dropify">
								</div>
								<div class="row">
									<div class="col-lg-6">
										<?php
											if($admin->image !=""){
										?>
										<img src="<?php echo base_url().$admin->image?>"  style="width: 80%;">
									<?php }?>
									</div>
									<div class="col-lg-6">
										<?php
											if($admin->signature !=""){
											?>
											<img src="<?php echo base_url().$admin->signature?>" style="width: 80%; height: 150px;">
										<?php }?>
									</div>
								</div>
							</div>
							<div class="row">
								<button type="submit" class="btn btn-primary pull-right">Update</button>
							</div>
							
						</form>
				</div>
				<div class="tab-pane" id="Upload-Docs">
					<form action="<?php echo base_url('student/settings/uploaddocs');?>" method="POST" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-4">
								 <select name="certificate_name" class="form-control" style="width: 100%" required>
									<option value="">Choose Certificate</option>
									<option value="1">Xth</option>
									<option value="2">XIIth</option>
									<option value="3">Graduation</option>
								  </select>
							   </div>
							<div class="col-md-4">
								<input type="file" name="files[]" class="form-control" multiple required accept="image/jpeg">
								<span style="color: red;font-size: 12px;">Note: Allowed ext is .jpeg or jpg. Please give file name as certificate name. <b>Ex: SSC Marks Memo.jpeg</b></span>
							</div>
							<div class="col-md-4">
								<button type="submit" class="btn btn-primary form-control form-control1">Upload</button> 
							</div>
						</div>
					</form>
					<hr>
					<div class="container">
						<div class="row">
							<div class="col-md-3">
								<ul class="nav nav-tabs-new2 flex-column">
									<li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#x">Xth</a></li>
									<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#xii">XIIth</a></li>
									<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#graduation">Graduation</a></li>
								</ul>
							</div>
							<div class="col-md-9">
								<div class="tab-content">
									<div class="tab-pane show active" id="x">
										<div class="row">
											<?php
											$one = 0;
											foreach ($studentdocs as $cert) {
												if($cert->doc_category==1){
													$one++;
											?>
											<div class="col-md-6">
												<img src="<?php echo base_url();?>uploads/students/certificates/<?php echo $cert->student_id;?>/<?php echo $cert->doc_filename;?>" style="width: 300px; height: 240px; padding: 5px; object-fit: contain; border: 1px solid black">
												<i class="fa fa-times-circle fa-2x" onclick="deleteCert('<?php echo $cert->id;?>', '<?php echo $cert->doc_filename;?>', '<?php echo $cert->student_id;?>')" style="position: absolute;z-index: 999;color: red;cursor: pointer;    margin-top: 3px; margin-left: -32px;" id="59"></i>
												<span>Name: <?php echo $cert->doc_name;?></span> 
											</div>
											<?php
												}
											}
											if($one==0){
												echo "<span style='color:red;'>No files found.</span>";
											}
											?>
										</div>										
									</div>
									<div class="tab-pane show" id="xii">
										<div class="row">
											<?php
											$two = 0;
											foreach ($studentdocs as $cert) {
												if($cert->doc_category==2){
													$two++;
											?>
												<div class="col-md-6">
													<img src="<?php echo base_url();?>uploads/students/certificates/<?php echo $cert->student_id;?>/<?php echo $cert->doc_filename;?>" style="width: 300px; height: 240px; padding: 5px; object-fit: contain; border: 1px solid black">
													<i class="fa fa-times-circle fa-2x" onclick="deleteCert('<?php echo $cert->id;?>', '<?php echo $cert->doc_filename;?>', '<?php echo $cert->student_id;?>')" style="position: absolute;z-index: 999;color: red;cursor: pointer;    margin-top: 3px; margin-left: -32px;" id="59"></i>
													<span>Name: <?php echo $cert->doc_name;?></span> 
												</div> 
											<?php
												}
											}
											if($two==0){
												echo "<span style='color:red;'>No files found.</span>";
											}
											?>
										</div>
									</div>
									<div class="tab-pane show" id="graduation">
										<div class="row">
											<?php
											$three = 0;
											foreach ($studentdocs as $cert) {
												if($cert->doc_category==3){
													$three++;
											?>
												<div class="col-md-6">
													<img src="<?php echo base_url();?>uploads/students/certificates/<?php echo $cert->student_id;?>/<?php echo $cert->doc_filename;?>" style="width: 300px; height: 240px; padding: 5px; object-fit: contain; border: 1px solid black">
													<i class="fa fa-times-circle fa-2x" onclick="deleteCert('<?php echo $cert->id;?>', '<?php echo $cert->doc_filename;?>', '<?php echo $cert->student_id;?>')" style="position: absolute;z-index: 999;color: red;cursor: pointer;    margin-top: 3px; margin-left: -32px;" id="59"></i> 
													<span>Name: <?php echo $cert->doc_name;?></span> 
												</div>
											<?php
												}
											}
											if($three==0){
												echo "<span style='color:red;'>No files found.</span>";
											}
											?>
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

	$("#std_state").change(function(){
		
		var val = $(this).val();
		
		$.ajax({
			
			type : "post",
			url : "<? echo base_url('student/settings/getCities') ?>",
			data : {state : val},
			success : function(data){
				
				$("#ssc_district").html(data);
				
			}
			
		});
		
	})	
	
	$("#inter_state").change(function(){
		
		var val = $(this).val();
		
		$.ajax({
			
			type : "post",
			url : "<? echo base_url('student/settings/getCities') ?>",
			data : {state : val},
			success : function(data){
				
				$("#inter_district").html(data);
				
			}
			
		});
		
	})
	$("#degree_state").change(function(){
		
		var val = $(this).val();
		
		$.ajax({
			
			type : "post",
			url : "<? echo base_url('student/settings/getCities') ?>",
			data : {state : val},
			success : function(data){
				
				$("#degree_district").html(data);
				
			}
			
		});
		
	})
	function deleteCert(cert_id, file_name){
		toastr.options.timeOut = 1000;
        toastr.options.closeButton = true;
        toastr.options.positionClass = 'toast-top-right';
		$.ajax({
			type : "POST",
			url : "<? echo base_url('student/settings/deleteStudCert') ?>",
			data : {cert_id : cert_id, file_name: file_name},
			success : function(data){
				if(data=='success'){
	                toastr.remove();
	                toastr['success']('File deleted successfully.', '', {
	                    positionClass: 'toast-top-right'
                	});
				}
				else{
					toastr.remove();
	                toastr['error']('Not able to delete the file.', '', {
	                    positionClass: 'toast-top-right'
                	});
				}
            	setTimeout(function(){ location.reload(); }, 1000); 
			}
		});
	}

	function updateExam(exam_id){
		$("#exam_id").val(exam_id);
		var exam_name = $(".udpateexam_"+exam_id).attr("data-ename");
		var year_appeared = $(".udpateexam_"+exam_id).attr("data-yappeared");
		var hallticket = $(".udpateexam_"+exam_id).attr("data-hticket");
		var max_marks = $(".udpateexam_"+exam_id).attr("data-xmarks");
		var secured_marks = $(".udpateexam_"+exam_id).attr("data-smarks");
		var rank = $(".udpateexam_"+exam_id).attr("data-rank");

        $('#exam_name option[value="'+exam_name+'"]').attr("selected", "selected");
        $('#year_appeared option[value='+year_appeared+']').attr("selected", "selected");
        $('#hallticket').val(hallticket);
        $('#max_marks').val(max_marks);
        $('#secured_marks').val(secured_marks);
        $('#rank').val(rank);
        
        $("#edataupdate").toggle();
        $("#edata").hide();
	    $("#examsadd").hide();
	}
	
</script>
