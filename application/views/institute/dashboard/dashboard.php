
<link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/fullcalendar/fullcalendar.min.css">
       

 <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">
                        <h2>Dashboard</h2>
                    </div>            
                    <!-- <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                        <ul class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                    </div> -->
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-12">
                    <div class="card top_report">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <a href="<?php echo base_url('institute/councellors');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class=" icon-users text-col-blue" style="font-size:25px;"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>Professors</h6>
                                            <span class="font700"><?php echo $Professors;?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-blue mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="87"></div>
                                    </div>
                                </div>
                                </a>
                            </div>
                            
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <a href="<?php echo base_url('institute/videoconnect');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="fa fa-2x fa-handshake-o text-col-green"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>Admission Officer’s Meetings</h6>
                                            <span class="font700 onlinestudents_count"><?php echo $aomeetings; ?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-green mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="28"></div>
                                    </div>
                                   
                                </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <a href="<?php echo base_url('institute/videoconnect');?>?play_url=active">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="icon-control-play text-col-blue" style="font-size:25px;"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6> Admission Officer(Video)</h6>
                                            <span class="font700"><?php echo $video;?></span>
                                           
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-blue mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="87"></div>
                                    </div>
                                </div>
                                </a>
                            </div>
                            
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <a href="<?php echo base_url('institute/virtualcontacts');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="fa fa-2x fa-play text-col-blue" style="font-size: 25px;"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>Admission Officer's (Audio)</h6>
                                            <span class="font700"><?php echo $aoaudio; ?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-blue mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="28"></div>
                                    </div>
                                </div>
								</a>
                            </div>
                            
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <a href="<?php echo base_url('institute/sessions');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="fa fa-desktop fa-2x text-col-green"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>Presentations</h6>
                                            <span class="font700"><?php echo $presentations;?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-green mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="28"></div>
                                    </div>
                                   
                                </div>
                                </a>
                            </div>
                             <div class="col-lg-4 col-md-6 col-sm-6">
                                <a href="<?php echo base_url('institute/councellors/professor_meetings');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="fa fa-2x fa-handshake-o text-col-red"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>Professor's Meetings</h6>
                                            <span class="font700"><?php echo $promeetings;?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-red mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="41"></div>
                                    </div>
                                  
                                </div>
                                </a>
                            </div>
                             <div class="col-lg-4 col-md-6 col-sm-6">
                                <a href="<?php echo base_url('institute/virtualcontacts/view_virtualcontacts');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="fa fa-2x icon-call-in text-col-yellow"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>Admission Officers Calls Received</h6>
                                            <span class="font700"><?php echo $aocalls;?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-yellow mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="41"></div>
                                    </div>
                                  
                                </div>
                                </a>
                            </div>
                             <div class="col-lg-4 col-md-6 col-sm-6">
                                <a href="<?php echo base_url('institute/enquiries');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="fa fa-2x fa fa-question text-col-blue"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>Enquiries</h6>
                                            <span class="font700"><?php echo $enquiries;?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-blue mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="41"></div>
                                    </div>
                                  
                                </div>
                                </a>
                            </div>
                             <div class="col-lg-4 col-md-6 col-sm-6">
                                <a href="<?php echo base_url('institute/admissions');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="fa fa-2x fa-graduation-cap text-col-green"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>Applications</h6>
                                            <span class="font700"><?php echo $applications;?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-green mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="41"></div>
                                    </div>
                                  
                                </div>
                                </a>
                            </div>
                             <div class="col-lg-4 col-md-6 col-sm-6">
                                <a href="<?php echo base_url('institute/analytics/studentlogintime');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="fa fa-2x fa-users text-col-blue"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>Students visited E-booth</h6>
                                            <span class="font700"><?php echo $svebooth;?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-blue mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="41"></div>
                                    </div>
                                  
                                </div>
                                </a>
                            </div>
                             <div class="col-lg-4 col-md-6 col-sm-6">
                                <a href="<?php echo base_url('institute/feedback');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="fa fa-2x fa-comments-o text-col-yellow"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>Feedback received</h6>
                                            <span class="font700"><?php echo $feedback;?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-yellow mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="41"></div>
                                    </div>
                                  
                                </div>
                                </a>
                            </div>
                           
                        </div> 
                    </div>
                </div>
            </div>

           
             
            </div>
 
  <? /*$idata = $this->db->get_where("tbl_institutes",["institute_id"=>$this->session->userdata("institute_id")])->row(); 
			
	 if(json_decode($idata->allowed_creation_count)->coucellors > 0){*/		
	?>          
                                  
            <!--<div class="row clearfix">
				<div class="col-md-12">
					<div class="card">
						<div class="header">
							<h2>No'of Students Scheduled Meetings (Admission Officer's)</h2>                            
						</div>
						<div class="body">
							<div class="table-responsive social_media_table">
								<table class="table table-hover">
									<thead class="thead-dark">
										<tr>
											<th>Admission Officer Name</th>
											<th>Students</th>   
										</tr>
									</thead>
									<tbody>

										<? /*$institutes = $this->db->get_where("tbl_councellors",["institute_id"=>$this->session->userdata("institute_id"),"expert_status"=>"Active","is_deleted"=>0])->result(); 
											foreach($institutes as $ins){*/
										?>

											<tr>
												<td>
													<a href="<?php //echo base_url('institute/councellors/viewMeetings/').$ins->id ; ?>" style="color: black"><span class="list-name"><? //echo ucfirst($ins->expert_name) ?></span></a>
												</td>
												<td>
													<span class="badge badge-success"><? //echo $this->db->get_where("tbl_counsellor_student_schedule",["expert_id"=>$ins->id,"exp_std_time >="=>strtotime(date('Y-m-d H:i:s'))])->num_rows(); ?></span>
												</td>
											</tr>
										<? //} ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				
				 <div class="col-md-6">
					<div class="card">
						<div class="header">
							<h2>No'of Students Scheduled Meetings (Admission Officer's)</h2>                            
						</div>
						<div class="body">
						
							<div id="calendar"></div>
						
						</div>
					</div>
				</div> 

			</div>-->
           
     <? //} ?>      
            
          
</div>

<script>

	/*$(document).ready(function(){
		
		setInterval(function(){
			
			$.ajax({
				
				type : "get",
				url : "<? //echo base_url('institute/dashboard/onlinestudents_count') ?>",
				success : function(data){
					
					$(".onlinestudents_count").html(data);
					
				},
				error:function(data){
					
					
				}
				
			})
			
		},5000);
		
	})*/
	
</script>
