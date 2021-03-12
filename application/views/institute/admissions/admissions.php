<? 
	$course = $this->input->get("course_name");
	$specialization = $this->input->get("specialization");
	$scholarship = $this->input->get("scholarship");
?>
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
                               
                        <div class="body">
                        
                        
                        <section id="lessons">
							<div class="intro_title">
								<h2>Application Details</h2>
							</div>
              <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <a href="<?php echo base_url('institute/admissions');?>">
                        <div class="body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <i class="fa fa-hourglass-start text-col-red" style="font-size:25px;"></i>
                                </div>
                                <div class="number float-right text-right">
                                    <h6> Total Applications Received</h6>
                                    <span class="font700"><?php  echo $this->db->get_where("tbl_institute_admission",["institute_id"=> $this->session->userdata('institute_id')])->num_rows();?></span>
                                </div>
                            </div>
                            <div class="progress progress-xs progress-transparent custom-color-red mb-0 mt-3">
                                <div class="progress-bar" data-transitiongoal="87"></div>
                            </div>
                            <!-- <small class="text-muted">19% compared to last week</small> -->
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6">
                    <a href="<?php echo base_url('institute/admissions');?>?status=In Progress">
                        <div class="body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <i class="fa fa-spinner text-col-blue" style="font-size:25px;"></i>
                                </div>
                                <div class="number float-right text-right">
                                    <h6> In Progress</h6>
                                    <span class="font700"><?php  echo $this->db->get_where("tbl_institute_admission",["status"=>'In Progress',"institute_id"=> $this->session->userdata('institute_id')])->num_rows();?></span>
                                </div>
                            </div>
                            <div class="progress progress-xs progress-transparent custom-color-blue mb-0 mt-3">
                                <div class="progress-bar" data-transitiongoal="87"></div>
                            </div>
                            <!-- <small class="text-muted">19% compared to last week</small> -->
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <a href="<?php echo base_url('institute/admissions');?>?status=Approved">
                        <div class="body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <i class="fa fa-volume-up text-col-green" style="font-size:25px;"></i>
                                </div>
                                <div class="number float-right text-right">
                                    <h6>Approved</h6>
                                    <span class="font700"><?php  echo $this->db->get_where("tbl_institute_admission",["status"=>'Approved',"institute_id"=> $this->session->userdata('institute_id')])->num_rows();?></span>
                                </div>
                            </div>
                            <div class="progress progress-xs progress-transparent custom-color-green mb-0 mt-3">
                                <div class="progress-bar" data-transitiongoal="87"></div>
                            </div>
                            <!-- <small class="text-muted">19% compared to last week</small> -->
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <a href="<?php echo base_url('institute/admissions');?>?status=Rejected">
                        <div class="body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <i class="fa fa-volume-up text-col-red" style="font-size:25px;"></i>
                                </div>
                                <div class="number float-right text-right">
                                    <h6>Rejected</h6>
                                    <span class="font700"><?php  echo $this->db->get_where("tbl_institute_admission",["status"=>'Rejected',"institute_id"=> $this->session->userdata('institute_id')])->num_rows();?></span>
                                </div>
                            </div>
                            <div class="progress progress-xs progress-transparent custom-color-red mb-0 mt-3">
                                <div class="progress-bar" data-transitiongoal="87"></div>
                            </div>
                            <!-- <small class="text-muted">19% compared to last week</small> -->
                        </div>
                    </a>
                </div>
              </div>
              <form method="get" id="fsubmit" action="">
              <div class="row">
                
                <div class="col-md-2">
                	<div class="form-group">
                		<select class="form-control fsubmit" name="course_name">
                			<option value="">Course</option>
                			<? $coursenames = $this->db->group_by("course_name")->get_where("tbl_courses",["institute_id"=>$this->session->userdata('institute_id')])->result();
							
							foreach($coursenames as $cn){
								$csel = ($cn->course_name == $course) ? 'selected' : '';
								echo '<option value="'.$cn->course_name.'" '.$csel.'>'.$cn->course_name.'</option>';
							}
							
							?>
                		</select>
                	</div>
                </div>
                
                <div class="col-md-2">
                	<div class="form-group">
                		<select class="form-control fsubmit" name="specialization">
                			<option value="">Specialization</option>
                			<? $cours = $this->db->group_by("course_id")->get_where("tbl_institute_admission",["institute_id"=>$this->session->userdata('institute_id')])->result();
							
							foreach($cours as $cc){
								$cname = $this->db->get_where("tbl_courses",["course_id"=>$cc->course_id])->row()->specialization;
								$ssel = ($cc->course_id == $specialization) ? 'selected' : '';
								
								echo '<option value="'.$cc->course_id.'" '.$ssel.'>'.$cname.'</option>';
							}
							
							?>
                		</select>
                	</div>
                </div>
                 <div class="col-md-2">
                	<div class="form-group">
                		<select class="form-control fsubmit" name="scholarship">
                			<option value="">Scholarship</option>
                			<option value="yes" <? echo ($scholarship == "yes") ? 'selected' : '' ?>>Yes</option>
                			<option value="no" <? echo ($scholarship == "no") ? 'selected' : '' ?>>No</option>
                		</select>
                	</div>
                </div>
                </form>
                <div class="col-md-4">	
					<div class="form-group">
						<div id="reportrange" name="date" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
							<i class="fa fa-calendar"></i>&nbsp;
							<span></span> <i class="fa fa-caret-down"></i>
						</div>
					</div>
                </div>
                <div class="col-md-1">		
                  <div class="form-group">
                    <input type="button" id="submitBtn" value="submit" class="btn btn-success mt-20"/>
                  </div>
                </div>
            </div>
		<div id="accordion_lessons" role="tablist" class="add_bottom_45">
							
              <!-- All Students Data -->
              <div class="card" style="margin-bottom: 10px">
                <div class="card-header" role="tab">
                  <h5 class="mb-0">
                    <a href="#"><i class="indicator ti-minus"></i> All Students Details</a>
                  </h5>
                </div>
                <div class="card-body">
                  <table class="table table-bordered table-striped table-hover dataTable js-exportable" style="display: none;">
                    <thead>
                        <tr> 
                            <th>S.no</th>
                            <th>Student Name</th>
                            <th>Merit Scholarship</th>
                            <th>Applied Date</th>
                            <th>Course Name</th>
							<th>Specialization</th>
                            <th>Duration</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($details){
                                $key=1;
                               foreach($details as $row):
                            $cdetails = $this->institute_model->get_course_details($row->course_id);
                            ?>
                       <tr>
                            <td><?php echo $key;?></td>
                            <td><?php echo $this->db->get_where("tbl_students",["student_id"=>$row->student_id])->row()->student_name;?></td>
                            <td><?php echo ucfirst($row->scholaryn);?></td>
                            <td><?php echo date('d-m-Y', strtotime($row->created_date)) ;?></td>
                            <td><?php echo $cdetails->course_name;?></td>
							             <td style="white-space: break-spaces;"><?php echo $cdetails->specialization;?></td>
                            <td><?php echo $cdetails->course_duration;?></td>  
                            <td><?php echo $row->status;?></td>
                            <!-- <td><a href="#" class="update_button" admssionid="<?php echo $row->id;  ?>" admssionstatus="<?php echo $row->status ; ?>" ><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a href="<?php echo base_url(); ?>institute/admissions/view_student/<?php echo $row->student_id;  ?>" target="_blank" admssionid="<?php echo $row->id;  ?>" admssionstatus="<?php echo $row->status ; ?>" >View</a></td> -->
                        </tr>
                        <?php $key++; endforeach;}?>
                    
                    </tbody>
                  
                  </table>
                </div>
              </div>
              <!-- All Students Data -->
              <? 
               
              $admissions = $this->db->group_by("student_id")->get_where("tbl_institute_admission",["institute_id"=>$this->session->userdata("institute_id")])->result(); 
							
							   foreach($admissions as $sk => $adm){	
								   
								$sdata = $this->db->get_where("tbl_students",["student_id"=>$adm->student_id])->row();
               
                $date = explode(" - ",$this->input->get("date"));
                $sdate = date("Y-m-d",strtotime($date[0]));
                $edate = date("Y-m-d",strtotime($date[1]));
                $status = $this->input->get("status");
							   
					if($course){

						$cdata = [];
						$cors = $this->db->get_where("tbl_courses",["course_name"=>$course,"institute_id"=> $this->session->userdata('institute_id')])->result();
						foreach($cors as $cr){
							$cdata[] = $cr->course_id;
						}
						$this->db->where_in("course_id",$cdata);
					}
					if($specialization){
						$this->db->where("course_id",$specialization);
					}				   
					if($this->input->get("date")){
					  $this->db->where('created_date BETWEEN "'. $sdate. '" and "'.$edate.'"');
					}

					if($status){
					  $this->db->where("status",$status);
					}
					if($scholarship){
						$this->db->where("scholaryn",$scholarship);
						if($scholarship == "no"){
							$this->db->or_where("scholaryn",null);
						}
					}			   
                  	$courses = $this->db->get_where("tbl_institute_admission",["institute_id"=>$this->session->userdata("institute_id"),"student_id"=>$adm->student_id])->result(); 
								  
							?>
							
							
									<div class="card" style="margin-bottom: 10px">
										<div class="card-header" role="tab" id="heading<? echo $sk ?>">
											<h5 class="mb-0">
												<a data-toggle="collapse" href="#collapse<? echo $sk ?>" aria-expanded="true" aria-controls="collapse<? echo $sk ?>"><i class="indicator ti-minus"></i> <? echo ucfirst($sdata->student_name) ?></a>
												
												<a href="<?php echo base_url(); ?>institute/admissions/view_student/<?php echo $adm->student_id; ?>" target="_blank" class="pull-right btn btn-info btn-sm">View Student Info</a>
											</h5>
										</div>

										<div id="collapse<? echo $sk ?>" class="collapse <? echo ($sk == 0) ? 'show' : '' ?>" role="tabpanel" aria-labelledby="heading<? echo $sk ?>">
											<div class="card-body">
											
						                        <div class="table-responsive">
													<table class="table table-bordered table-striped table-hover dataTable js-exportable">
														<thead>
															<tr> 
																<th>S.no</th>
																<th>Student Name</th>
																<th>Merit Scholarship</th>
																<th>Applied Date</th>
																<th>Course Name</th>
																<th>Specialization</th>
																<th>Duration</th>
																<th>Status</th>
																<th>Action</th>
															</tr>
														</thead>
														<tbody>
															<?php if($courses){
																	$key=1;
																  // print_r($details);
																   foreach($courses as $row):
																$cdetails = $this->institute_model->get_course_details($row->course_id);
																?>
														   <tr>
																<td><?php echo $key;?></td>
																<td><?php echo $sdata->student_name;?></td>
																<td><?php echo ucfirst($row->scholaryn);?></td>
																<td><?php echo date('d-m-Y', strtotime($row->created_date)) ;?></td>
																<td><?php echo $cdetails->course_name;?></td>
																<td style="white-space: break-spaces;"><?php echo $cdetails->specialization;?></td>
																<td><?php echo $cdetails->course_duration;?></td>  
																<td><?php echo $row->status;?></td>
																<td><a href="#" class="update_button" admssionid="<?php echo $row->id;  ?>" admssionstatus="<?php echo $row->status ; ?>" ><i class="fa fa-pencil"></i>
																</td>
															</tr>
															<?php $key++; endforeach;}else{ echo "No records found";}?>

														</tbody>

													</table>
													</div>


												</div>
											</div>
										</div>
									
							<? } ?>
																					
							</div>
							<!-- /accordion -->
						</section>

                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>

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
                                          <option value="In Progress">In Progress</option>
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
	
	$(".fsubmit").change(function(){
		$("#fsubmit").submit();
	})
	

$("#submitBtn").click(function(){

var date = $("#reportrange span").html();
console.log(date);
window.location.href = "<? echo base_url('institute/admissions') ?>?date="+date;

})



    $(document).ready(function(){
      setTimeout(function(){
        $("#DataTables_Table_0_info, #DataTables_Table_0_paginate, #DataTables_Table_0_filter").attr("style", "display:none;");
      }, 500);
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
</script>
<script type="text/javascript">
		$(document).ready(function() {
			 $('.input-daterange').datepicker({
              });
		});
	</script>
    <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
<script>

jQuery(document).ready(function() {
  
    jQuery("#select").change(function() {
        if (jQuery(this).val() === 'day'){ 
            jQuery('#ctitle').show();   
        } else {
            jQuery('#ctitle').hide(); 
        }
        if (jQuery(this).val() === 'week'){ 
            jQuery('#week').show();   
        } else {
            jQuery('#week').hide(); 
        }
        if (jQuery(this).val() === 'month'){ 
            jQuery('#month').show();   
        } else {
            jQuery('#month').hide(); 
        }
    });
});
</script>