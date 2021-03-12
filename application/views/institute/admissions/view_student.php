
<style>
    td.details-control {
    background: url('<?php echo base_url(); ?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
    tr.shown td.details-control {
        background: url('<?php echo base_url(); ?>assets/images/details_close.png') no-repeat center center;
    }
    td {
    	white-space: break-spaces !important;
    }
</style>
<?php
$courses = $this->db->get_where("tbl_institute_admission",["institute_id"=>$this->session->userdata("institute_id"),"student_id"=>$student_id])->result(); 

$ees = $this->db->get_where("tbl_entrance_exams",["student_id"=>$student_id])->result();
	
?>
<div id="main-content">
        <div class="container-fluid">
            
            <div class="row clearfix">
                
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
						    <div class="row">
                            <div class="col-lg-8 pull-left">
                            	<h2>Student Details</h2>
                            </div>
							<div class="col-lg-4 pull-right">
                            	<a href="<?php echo base_url(); ?>institute/admissions/createPDF/<?php echo $student->std_id;  ?>" target="_blank" ><button class="btn btn-primary">Download</button></a>&nbsp;&nbsp;&nbsp;<button class="btn btn-primary cprintTable">Print</button>&nbsp;&nbsp;&nbsp;
                            	<a href="<?php echo base_url(); ?>institute/admissions"><button class="btn btn-info"><i class="fa fa-chevron-left"></i>  Back</button></a>
                            </div>
                            </div>                  
                        </div>
                               
                        <div class="body">
                        	<div class="table-responsive">
								<table class="table table-bordered" id="">
									<tbody>
									    <tr>
											<td colspan="3" style="text-align:center;font-weight: bold;">Basic Details</td>
										</tr>
									    <tr>
									        <td style="font-weight: bold;">Name</td>
									        <td><?php echo $student->student_name; ?></td>
									        <td rowspan="4" align="right"><img src="<?php if($student->image_std!=''){ echo base_url().$student->image_std; }else{echo base_url().'assets/images/user1.png';}?>" width="200" height="200"><br><img src="<?php if($student->signature_std!=''){ echo base_url().$student->signature_std; }else{echo base_url().'assets/images/signature.png';}?>"  width="200" height="50"></td>
										</tr>
									    <tr>
									        <td style="font-weight: bold;">Email</td>
									        <td><?php echo $student->email;?></td>
										</tr>	
									    <tr>
									        <td style="font-weight: bold;">phone</td>
									        <td><?php echo $student->phone; ?></td>
										</tr>
									    <tr>
									        <td style="font-weight: bold;">Address</td>
									        <td><?php echo $student->address;?></td>
										</tr>

										<? if((trim($student->ssc_board) != "") && (trim($student->ssc_school) != "")){ ?>
										
										<tr>
											<td colspan="3" style="text-align:center;font-weight: bold;">SSC</td>
										</tr>
									    <tr>
											<td style="font-weight: bold;">Name of the Board</td>
											<td colspan="2"><?php echo $student->ssc_board;?></td>
										</tr>
										<tr>
											<td style="font-weight: bold;">School Name</td>
											<td colspan="2"><?php echo $student->ssc_school;?></td>
										</tr>
										<tr>
											<td style="font-weight: bold;">School Address</td>
											<td colspan="2"><?php echo $student->ssc_address;?></td>
										</tr>
										<tr>
											<td style="font-weight: bold;">School District</td>
											<td colspan="2"><?php echo $student->ssc_district;?></td>
										</tr>
										<tr>
											<td style="font-weight: bold;">School State</td>
											<td colspan="2"><?php echo $student->ssc_state;?></td>
										</tr>
										
										<tr>
											<td style="font-weight: bold;">Hall Ticket Number</td>
											<td colspan="2"><?php echo $student->ssc_hallticket;?></td>
										</tr>
										<tr>
											<td style="font-weight: bold;">Total Marks</td>
											<td colspan="2"><?php echo $student->ssc_totalmarks;?></td>
										</tr>
										<tr>
											<td style="font-weight: bold;">Total Marks Secured</td>
											<td colspan="2"><?php echo $student->ssc_markssecured;?></td>
										</tr>
										<tr>
											<td style="font-weight: bold;">Percentage</td>
											<td colspan="2"><?php echo $student->ssc_percentage;?></td>
										</tr>
										<tr>
											<td style="font-weight: bold;">Year of passing</td>
											<td colspan="2"><?php echo $student->ssc_yearpassing;?></td>
										</tr>

										<? } ?>	
										<? if((trim($student->inter_board) != "") && (trim($student->inter_college) != "")){ ?>						
										<tr>
											<td colspan="3" style="text-align:center;font-weight: bold;">Intermidiate</td>
										</tr>
										<tr>
											<td style="font-weight: bold;">Name of the Board</td>
											<td colspan="2"><?php echo $student->inter_board;?></td>
										</tr>
										<tr>
											<td style="font-weight: bold;">College Name</td>
											<td colspan="2"><?php echo $student->inter_college;?></td>
										</tr>
										<tr>
											<td style="font-weight: bold;">Course Name</td>
											<td colspan="2"><?php echo $student->inter_course;?></td>
										</tr>
										<tr>
											<td style="font-weight: bold;">Group Name</td>
											<td colspan="2"><?php echo $student->inter_group;?></td>
										</tr>
										<tr>
											<td style="font-weight: bold;">College Address</td>
											<td colspan="2"><?php echo $student->inter_address;?></td>
										</tr>
										<tr>
											<td style="font-weight: bold;">College District</td>
											<td colspan="2"><?php echo $student->inter_district;?></td>
										</tr>
										<tr>
											<td style="font-weight: bold;">College State</td>
											<td colspan="2"><?php echo $student->inter_state;?></td>
										</tr>
										
										<tr>
											<td style="font-weight: bold;">Hall Ticket Number</td>
											<td colspan="2"><?php echo $student->inter_hallticket;?></td>
										</tr>
										<tr>
											<td style="font-weight: bold;">Total Marks</td>
											<td colspan="2"><?php echo $student->inter_totalmarks;?></td>
										</tr>
										<tr>
											<td style="font-weight: bold;">Total Marks Secured</td>
											<td colspan="2"><?php echo $student->inter_markssecured;?></td>
										</tr>
										<tr>
											<td style="font-weight: bold;">Percentage</td>
											<td colspan="2"><?php echo $student->inter_percentage;?></td>
										</tr>
										<tr>
											<td style="font-weight: bold;">Group Marks</td>
											<td colspan="2"><?php echo $student->inter_groupmarks;?></td>
										</tr>
										<tr>
											<td style="font-weight: bold;">Year of passing</td>
											<td colspan="2"><?php echo $student->inter_yearpassing;?></td>
										</tr>
										<? } ?>
										<? if((trim($student->degree_college) != "") && (trim($student->degree_auniversity) != "")){ ?>						

										<tr>
											<td colspan="3" style="text-align:center;font-weight: bold;">Degree/Graduation</td>
										</tr>
										<tr>
											<td style="font-weight: bold;">College Name</td>
											<td colspan="2"><?php echo $student->degree_college;?></td>
										</tr>
										<tr>
											<td style="font-weight: bold;">Affiliated University</td>
											<td colspan="2"><?php echo $student->degree_auniversity;?></td>
										</tr>
										<tr>
											<td style="font-weight: bold;">Course</td>
											<td colspan="2"><?php echo $student->degree_group;?></td>
										</tr>
										<tr>
											<td style="font-weight: bold;">Specialisation</td>
											<td colspan="2"><?php echo $student->degree_address;?></td>
										</tr>
										<tr>
											<td style="font-weight: bold;">College Address</td>
											<td colspan="2"><?php echo $student->degree_address;?></td>
										</tr>
										<tr>
											<td style="font-weight: bold;">College District</td>
											<td colspan="2"><?php echo $student->degree_district;?></td>
										</tr>
										<tr>
											<td style="font-weight: bold;">College State</td>
											<td colspan="2"><?php echo $student->degree_state;?></td>
										</tr>
										
										<tr>
											<td style="font-weight: bold;">Hall Ticket Number</td>
											<td colspan="2"><?php echo $student->degree_hallticket;?></td>
										</tr>
										<tr>
											<td style="font-weight: bold;">Total Marks</td>
											<td colspan="2"><?php echo $student->degree_totalmarks;?></td>
										</tr>
										<tr>
											<td style="font-weight: bold;">Total Marks Secured</td>
											<td colspan="2"><?php echo $student->degree_markssecured;?></td>
										</tr>
										<tr>
											<td style="font-weight: bold;">Percentage</td>
											<td colspan="2"><?php echo $student->degree_percentage;?></td>
										</tr>
										<tr>
											<td style="font-weight: bold;">Group Marks</td>
											<td colspan="2"><?php echo $student->degree_groupmarks;?></td>
										</tr>
										<tr>
											<td style="font-weight: bold;">Year of passing</td>
											<td colspan="2"><?php echo $student->degree_yearpassing;?></td>
										</tr>
										<? } ?>							

										<tr>
											<td colspan="3" style="text-align:center;font-weight: bold;">Additional Details</td>
										</tr>
									    <tr>
									        <td style="font-weight: bold;">Person with Disability</td>
									        <td colspan="2"><?php echo $student->person_disability_check_std; ?></td>
										</tr>
									    <tr>
									        <td style="font-weight: bold;">Type of disability</td>
									        <td colspan="2"><?php echo $student->disability_name_std;?></td>
										</tr>	
									    <!-- <tr>
									        <td style="font-weight: bold;">Photo</td>
									        <td>
												<?php if(file_exists($student->image_std)){ ?>
													<img src="<?php echo base_url().$student->image_std; ?>"  style="width: 80%;">
												<?php }else{ ?>
													<p>Image not found!..</p>
												<?php } ?>
											</td>
										</tr>
									    <tr>
									        <td style="font-weight: bold;">Signature</td>
									        <td>
											<?php if(file_exists($student->signature_std)){ ?>
												<img src="<?php echo base_url().$student->signature_std; ?>"  style="width: 80%;">
											<?php }else{ ?>
												<p>Signature not found!..</p>
											<?php } ?>
											</td>
										</tr> -->
									<? if(count($ees) > 0){ ?>
										<tr>
											<td colspan="3" style="text-align:center;font-weight: bold;">Entrance Exam Details</td>
										</tr>
											<div class="table-responsive">
												<table class="table table-bordered">
													<thead>
														<tr>
															<th>Entrance Exam Name</th>
															<th>Year of Appeared</th>
															<th>Hall Ticket Number</th>
															<th>Maximum Marks</th>
															<th>Marks Secured</th>
															<th>Rank Obtained / All India Rank</th>
														</tr>	
													</thead>
													<tbody>
														<? foreach($ees as $es){ ?>	
															<tr>
																<td><?php echo $es->exam_name;?></td>
																<td><?php echo $es->year_appeared;?></td>
																<td><?php echo $es->hallticket;?></td>
																<td><?php echo $es->max_marks;?></td>
																<td><?php echo $es->secured_marks;?></td>
																<td><?php echo $es->rank;?></td>

															</tr>
														<? } ?>		
													</tbody>	
												</table>
											</div>		
										<?php
										}
										if(count($courses)>0){
										?>
										<tr>
											<td colspan="3" style="text-align: center;font-weight: bold;">Applied Courses</td>
										</tr>
										<tr>
											<td colspan="3">
												<div class="table-responsive">
													<table class="table table-bordered">
														<thead>
															<tr> 
																<th>S.no</th>
                             									<th>Merit Scholarship</th>
                             									<th>Applied Date</th>
																<th>Course Name</th>
																<th>Specialization</th>
																<th>Duration</th>
															</tr>
														</thead>
														<tbody>
															<?php 
															if($courses){
																$key=1;
																foreach($courses as $row):
																	$cdetails = $this->institute_model->get_course_details($row->course_id);
																?>
														   <tr>
																<td><?php echo $key;?></td>
                            									<td><?php echo ucfirst($row->scholaryn);?></td>
                            									<td><?php echo date('d-m-Y', strtotime($row->created_date)) ;?></td>
																<td><?php echo $cdetails->course_name;?></td>
																<td style="white-space: break-spaces;"><?php echo $cdetails->specialization;?></td>
																<td><?php echo $cdetails->course_duration;?></td>  
															</tr>
															<?php $key++; endforeach;}?>
														</tbody>
													</table>
												</div>
											</td>
										</tr>
										<?php
										}
										?>
									</tbody>
								</table>
                            </div>
                            
                        </div>
                        
                        
                        
                    </div>

                    
                    
                    <div class="card">
                    	<div class="header">
						    <div class="row">
	                            <div class="col-lg-8 pull-left">
	                            	<h2>Student Certificates</h2>
	                            </div>
	                            <div class="col-lg-4 pull-right" align="right">
	                            	<a class="btn btn-primary" <?php if(count($studentdocs)>0) { ?> href="<?php echo base_url();?>institute/admissions/downloadStudCertZip/<?php echo $student->std_id;?>" <?php } else { ?> onclick="alert('There is no files to download.')" style="color: #fff;" <?php } ?>>Download All Files</a>
	                            </div>
	                        </div>
	                        <hr>
	                        <div class="row">
								<ul class="nav nav-tabs-new2">
									<li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#x">Xth</a></li>
									<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#xii">XIIth</a></li>
									<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#graduation">Graduation</a></li>
								</ul>
							</div>
	                    </div>
	                    <div class="body">
							<div class="tab-content">
								<div class="tab-pane show active" id="x">
									<div class="row">
										<?php
										$one = 0;
										foreach ($studentdocs as $cert) {
											if($cert->doc_category==1){
												$one++;
										?>
											<div class="col-md-4">
												<img alt="<?php echo $cert->doc_filename;?>" src="<?php echo base_url();?>uploads/students/certificates/<?php echo $cert->student_id;?>/<?php echo $cert->doc_filename;?>" style="width: 300px; height: 240px; padding: 5px; object-fit: contain; border: 1px solid black">
												<a download="<?php echo $cert->doc_filename;?>" href="<?php echo base_url();?>uploads/students/certificates/<?php echo $cert->student_id;?>/<?php echo $cert->doc_filename;?>" title="<?php echo $cert->doc_filename;?>">
												    <i class="fa fa-download fa-2x" style="position: absolute;z-index: 999;color: red;cursor: pointer;    margin-top: 3px; margin-left: -32px;" id="59"></i> 
												</a>
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
											<div class="col-md-4">
												<img alt="<?php echo $cert->doc_filename;?>" src="<?php echo base_url();?>uploads/students/certificates/<?php echo $cert->student_id;?>/<?php echo $cert->doc_filename;?>" style="width: 300px; height: 240px; padding: 5px; object-fit: contain; border: 1px solid black">
												<a download="<?php echo $cert->doc_filename;?>" href="<?php echo base_url();?>uploads/students/certificates/<?php echo $cert->student_id;?>/<?php echo $cert->doc_filename;?>" title="<?php echo $cert->doc_filename;?>">
												    <i class="fa fa-download fa-2x" style="position: absolute;z-index: 999;color: red;cursor: pointer;    margin-top: 3px; margin-left: -32px;" id="59"></i> 
												</a>
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
											<div class="col-md-4">
												<img alt="<?php echo $cert->doc_filename;?>" src="<?php echo base_url();?>uploads/students/certificates/<?php echo $cert->student_id;?>/<?php echo $cert->doc_filename;?>" style="width: 300px; height: 240px; padding: 5px; object-fit: contain; border: 1px solid black">
												<a download="<?php echo $cert->doc_filename;?>" href="<?php echo base_url();?>uploads/students/certificates/<?php echo $cert->student_id;?>/<?php echo $cert->doc_filename;?>" title="<?php echo $cert->doc_filename;?>">
												    <i class="fa fa-download fa-2x" style="position: absolute;z-index: 999;color: red;cursor: pointer;    margin-top: 3px; margin-left: -32px;" id="59"></i> 
												</a>
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
            
            
            
<!--   printable div      -->
            
<div class="body" id="printTable" style="display: none">

	<div class="table-responsive">
		<table class="table table-bordered" id=""><!-- Please make changes to above table and table in html file also if you are doing changes here -->
			<tbody>
			    <tr>
					<td colspan="3" style="text-align:center;font-weight: bold;">Basic Details</td>
				</tr>
			    <tr>
			        <td style="font-weight: bold;">Name</td>
			        <td><?php echo $student->student_name; ?></td>
			        <td rowspan="4" align="right"><img src="<?php if($student->image_std!=''){ echo base_url().$student->image_std; }else{echo base_url().'assets/images/user1.png';}?>" width="200" height="200"><br><img src="<?php if($student->signature_std!=''){ echo base_url().$student->signature_std; }else{echo base_url().'assets/images/signature.png';}?>"  width="200" height="50"></td>
				</tr>
			    <tr>
			        <td style="font-weight: bold;">Email</td>
			        <td><?php echo $student->email;?></td>
				</tr>	
			    <tr>
			        <td style="font-weight: bold;">phone</td>
			        <td><?php echo $student->phone; ?></td>
				</tr>
			    <tr>
			        <td style="font-weight: bold;">Address</td>
			        <td style="white-space: break-spaces;"><?php echo $student->address;?></td>
				</tr>

				<? if((trim($student->ssc_board) != "") && (trim($student->ssc_school) != "")){ ?>
				
				<tr>
					<td colspan="3" style="text-align:center;font-weight: bold;">SSC</td>
				</tr>
			    <tr>
					<td style="font-weight: bold;">Name of the Board</td>
					<td colspan="2"><?php echo $student->ssc_board;?></td>
				</tr>
				<tr>
					<td style="font-weight: bold;">School Name</td>
					<td colspan="2"><?php echo $student->ssc_school;?></td>
				</tr>
				<tr>
					<td style="font-weight: bold;">School Address</td>
					<td colspan="2"><?php echo $student->ssc_address;?></td>
				</tr>
				<tr>
					<td style="font-weight: bold;">School District</td>
					<td colspan="2"><?php echo $student->ssc_district;?></td>
				</tr>
				<tr>
					<td style="font-weight: bold;">School State</td>
					<td colspan="2"><?php echo $student->ssc_state;?></td>
				</tr>
				
				<tr>
					<td style="font-weight: bold;">Hall Ticket Number</td>
					<td colspan="2"><?php echo $student->ssc_hallticket;?></td>
				</tr>
				<tr>
					<td style="font-weight: bold;">Total Marks</td>
					<td colspan="2"><?php echo $student->ssc_totalmarks;?></td>
				</tr>
				<tr>
					<td style="font-weight: bold;">Total Marks Secured</td>
					<td colspan="2"><?php echo $student->ssc_markssecured;?></td>
				</tr>
				<tr>
					<td style="font-weight: bold;">Percentage</td>
					<td colspan="2"><?php echo $student->ssc_percentage;?></td>
				</tr>
				<tr>
					<td style="font-weight: bold;">Year of passing</td>
					<td colspan="2"><?php echo $student->ssc_yearpassing;?></td>
				</tr>

				<? } ?>	
				<? if((trim($student->inter_board) != "") && (trim($student->inter_college) != "")){ ?>						
				<tr>
					<td colspan="3" style="text-align:center;font-weight: bold;">Intermidiate</td>
				</tr>
				<tr>
					<td style="font-weight: bold;">Name of the Board</td>
					<td colspan="2"><?php echo $student->inter_board;?></td>
				</tr>
				<tr>
					<td style="font-weight: bold;">College Name</td>
					<td colspan="2"><?php echo $student->inter_college;?></td>
				</tr>
				<tr>
					<td style="font-weight: bold;">Course Name</td>
					<td colspan="2"><?php echo $student->inter_course;?></td>
				</tr>
				<tr>
					<td style="font-weight: bold;">Group Name</td>
					<td colspan="2"><?php echo $student->inter_group;?></td>
				</tr>
				<tr>
					<td style="font-weight: bold;">College Address</td>
					<td colspan="2"><?php echo $student->inter_address;?></td>
				</tr>
				<tr>
					<td style="font-weight: bold;">College District</td>
					<td colspan="2"><?php echo $student->inter_district;?></td>
				</tr>
				<tr>
					<td style="font-weight: bold;">College State</td>
					<td colspan="2"><?php echo $student->inter_state;?></td>
				</tr>
				
				<tr>
					<td style="font-weight: bold;">Hall Ticket Number</td>
					<td colspan="2"><?php echo $student->inter_hallticket;?></td>
				</tr>
				<tr>
					<td style="font-weight: bold;">Total Marks</td>
					<td colspan="2"><?php echo $student->inter_totalmarks;?></td>
				</tr>
				<tr>
					<td style="font-weight: bold;">Total Marks Secured</td>
					<td colspan="2"><?php echo $student->inter_markssecured;?></td>
				</tr>
				<tr>
					<td style="font-weight: bold;">Percentage</td>
					<td colspan="2"><?php echo $student->inter_percentage;?></td>
				</tr>
				<tr>
					<td style="font-weight: bold;">Group Marks</td>
					<td colspan="2"><?php echo $student->inter_groupmarks;?></td>
				</tr>
				<tr>
					<td style="font-weight: bold;">Year of passing</td>
					<td colspan="2"><?php echo $student->inter_yearpassing;?></td>
				</tr>
				<? } ?>
				<? if((trim($student->degree_college) != "") && (trim($student->degree_auniversity) != "")){ ?>						

				<tr>
					<td colspan="3" style="text-align:center;font-weight: bold;">Degree/Graduation</td>
				</tr>
				<tr>
					<td style="font-weight: bold;">College Name</td>
					<td colspan="2"><?php echo $student->degree_college;?></td>
				</tr>
				<tr>
					<td style="font-weight: bold;">Affiliated University</td>
					<td colspan="2"><?php echo $student->degree_auniversity;?></td>
				</tr>
				<tr>
					<td style="font-weight: bold;">Course</td>
					<td colspan="2"><?php echo $student->degree_group;?></td>
				</tr>
				<tr>
					<td style="font-weight: bold;">Specialisation</td>
					<td colspan="2"><?php echo $student->degree_address;?></td>
				</tr>
				<tr>
					<td style="font-weight: bold;">College Address</td>
					<td colspan="2"><?php echo $student->degree_address;?></td>
				</tr>
				<tr>
					<td style="font-weight: bold;">College District</td>
					<td colspan="2"><?php echo $student->degree_district;?></td>
				</tr>
				<tr>
					<td style="font-weight: bold;">College State</td>
					<td colspan="2"><?php echo $student->degree_state;?></td>
				</tr>
				
				<tr>
					<td style="font-weight: bold;">Hall Ticket Number</td>
					<td colspan="2"><?php echo $student->degree_hallticket;?></td>
				</tr>
				<tr>
					<td style="font-weight: bold;">Total Marks</td>
					<td colspan="2"><?php echo $student->degree_totalmarks;?></td>
				</tr>
				<tr>
					<td style="font-weight: bold;">Total Marks Secured</td>
					<td colspan="2"><?php echo $student->degree_markssecured;?></td>
				</tr>
				<tr>
					<td style="font-weight: bold;">Percentage</td>
					<td colspan="2"><?php echo $student->degree_percentage;?></td>
				</tr>
				<tr>
					<td style="font-weight: bold;">Group Marks</td>
					<td colspan="2"><?php echo $student->degree_groupmarks;?></td>
				</tr>
				<tr>
					<td style="font-weight: bold;">Year of passing</td>
					<td colspan="2"><?php echo $student->degree_yearpassing;?></td>
				</tr>
				<? } ?>							

				<tr>
					<td colspan="3" style="text-align:center;font-weight: bold;">Additional Details</td>
				</tr>
			    <tr>
			        <td style="font-weight: bold;">Person with Disability</td>
			        <td colspan="2"><?php echo $student->person_disability_check_std; ?></td>
				</tr>
			    <tr>
			        <td style="font-weight: bold;">Type of disability</td>
			        <td colspan="2"><?php echo $student->disability_name_std;?></td>
				</tr>	
			    <!-- <tr>
			        <td style="font-weight: bold;">Photo</td>
			        <td>
						<?php if(file_exists($student->image_std)){ ?>
							<img src="<?php echo base_url().$student->image_std; ?>"  style="width: 80%;">
						<?php }else{ ?>
							<p>Image not found!..</p>
						<?php } ?>
					</td>
				</tr>
			    <tr>
			        <td style="font-weight: bold;">Signature</td>
			        <td>
					<?php if(file_exists($student->signature_std)){ ?>
						<img src="<?php echo base_url().$student->signature_std; ?>"  style="width: 80%;">
					<?php }else{ ?>
						<p>Signature not found!..</p>
					<?php } ?>
					</td>
				</tr> -->

				<? if(count($ees) > 0){ ?>
				<tr>
					<td colspan="3" style="text-align:center;font-weight: bold;">Entrance Exam Details</td>
				</tr>
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Entrance Exam Name</th>
									<th>Year of Appeared</th>
									<th>Hall Ticket Number</th>
									<th>Maximum Marks</th>
									<th>Marks Secured</th>
									<th>Rank Obtained / All India Rank</th>
								</tr>	
							</thead>
							<tbody>
								<? foreach($ees as $es1){ ?>	
									<tr>
										<td><?php echo $es1->exam_name;?></td>
										<td><?php echo $es1->year_appeared;?></td>
										<td><?php echo $es1->hallticket;?></td>
										<td><?php echo $es1->max_marks;?></td>
										<td><?php echo $es1->secured_marks;?></td>
										<td><?php echo $es1->rank;?></td>

									</tr>
								<? } ?>		
							</tbody>	
						</table>
					</div>		
				<?php
				}
				if(count($courses)>0){
				?>
				<tr>
					<td colspan="3" style="text-align: center;font-weight: bold;">Applied Courses</td>
				</tr>
				<tr>
					<td colspan="3">
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr> 
										<th>S.no</th>
     									<th>Merit Scholarship</th>
     									<th>Applied Date</th>
										<th>Course Name</th>
										<th>Specialization</th>
										<th>Duration</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									if($courses){
										$key=1;
										foreach($courses as $row):
											$cdetails = $this->institute_model->get_course_details($row->course_id);
										?>
								   <tr>
										<td><?php echo $key;?></td>
    									<td><?php echo ucfirst($row->scholaryn);?></td>
    									<td><?php echo date('d-m-Y', strtotime($row->created_date)) ;?></td>
										<td><?php echo $cdetails->course_name;?></td>
										<td style="white-space: break-spaces;"><?php echo $cdetails->specialization;?></td>
										<td><?php echo $cdetails->course_duration;?></td>  
									</tr>
									<?php $key++; endforeach;}?>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
				<?php
				}
				?>
			</tbody>
		</table>
		<h4 align="center">Student Certificates</h4>                   	

		<div class="row">

			<? foreach ($studentdocs as $cert) { ?>

				<div class="col-md-6">

					<img alt="<?php echo $cert->doc_filename;?>" src="<?php echo base_url();?>uploads/students/certificates/<?php echo $cert->student_id;?>/<?php echo $cert->doc_filename;?>" style="padding: 5px;border: 1px solid black;width: 100%;"><br>
					<span style="text-align: center">Name: <?php echo $cert->doc_name;?></span>

				</div>

			<? } ?>				

		</div>
	</div>

	
</div>
         
<!--      Printable div ends      -->
            
            

            <div class="modal fade" id="updateModal" role="dialog">
                        <div class="modal-dialog">
                            <form id="updateadmission">
                            <div class="modal-content">
                              <div class="modal-header">
                                
                                <h6 class="modal-title">Update Admission Status</h6>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                
                              </div>
                              <div class="modal-body">
                                <div class="smsgapply"></div>
                                                         
                                  <input type="hidden" class="csid" name="csid" id="csid">
                                  
                                  <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                      <select name="status" id="cstatus" class="form-control">
                                          <option value="Pending">Pending</option>
                                          <option value="Approved">Approved</option>
                                          <option value="Rejected">Rejected</option>
                                      </select>
                                    </div>
                                  </div>
                                  
                                                                  
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                            </form>
                        </div><!--.modal-dialog-->
                    </div>

<script type="text/javascript">
    $(document).ready(function(){
  $(".update_button").click(function () {
      $("#csid").val($(this).attr('admssionid'));
      $("#cstatus").val($(this).attr('admssionstatus'));
    $("#updateModal").modal();
    });
 });
</script>

<script type="text/javascript">
      $("#updateadmission").submit(function(e){
  
    e.preventDefault();
    var fdata = $("#updateadmission").serialize();
    
    $.ajax({

      type : "post",
      data : fdata,
      url : "<? echo base_url('front/institutes/updateadmission') ?>",
      success : function(data){
        
        if(data == "success"){
          $(".smsgapply").html('<div class="alert alert-success">Status successfully Updated. </div>');
          setTimeout(function(){location.reload()},2000)
        } else{
          $(".smsgapply").html('<div class="alert alert-danger">Error Occured please try again.</div>');
        }
      },
      error : function(data){
        
        console.log(data);
        
      }

    })
  
  });
/*function printData()
{
	var style = "<style>";
	style = style + "table {width: 100%; font: 17px Calibri;}";
	style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse;";
	style = style + "padding: 2px 3px; text-align: center;}";
	style = style + "</style>";
   	var divToPrint=document.getElementById("printTable");
   	newWin= window.open('');
   	newWin.document.write(style);
   	newWin.document.write(divToPrint.outerHTML);
   	newWin.print();
   	newWin.close();
}*/

function printdiv(printpage)
{
var headstr = "<html><head><title></title></head><body>";
var footstr = "</body>";
var newstr = document.all.item(printpage).innerHTML;
var oldstr = document.body.innerHTML;
document.body.innerHTML = headstr+newstr+footstr;
window.print();
document.body.innerHTML = oldstr;
//return false;
}	
	
$(document).on('click','.cprintTable',function(){
	
	printdiv("printTable")
	
});
</script>