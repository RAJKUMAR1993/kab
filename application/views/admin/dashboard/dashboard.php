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
                            <?php
                            $permissions = [];
                            if(isset($this->session->userdata['user_login'])){
                                $permissions = $this->session->userdata['permissions'];
                            }
                            ?>
                            <div <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('institutes', $permissions)){echo 'style="display:none;"';}} ?> class="col-lg-4 col-md-6 col-sm-6">
                                <a href="<?php echo base_url('admin/institutes');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class=" icon-users text-col-blue" style="font-size:25px;"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>INSTITUTES</h6>
                                            <span class="font700"><?php echo $total_institutes;?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-blue mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="87"></div>
                                    </div>
                                    <!-- <small class="text-muted">19% compared to last week</small> -->
                                </div>
                                </a>
                            </div>
                            <div <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('students', $permissions)){echo 'style="display:none;"';}} ?> class="col-lg-4 col-md-6 col-sm-6">
                                <a href="<?php echo base_url('admin/students');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="fa fa-2x fa-graduation-cap text-col-green"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>STUDENTS</h6>
                                            <span class="font700"><?php echo $total_students;?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-green mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="28"></div>
                                    </div>
                                   <!--  <small class="text-muted">19% compared to last week</small> -->
                                </div>
                                </a>
                            </div>
                            
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <a href="<?php echo base_url('admin/dashboard/inst_professors');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="icon-users text-col-orange" style="font-size:25px;"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>PROFESSORS (INSTITUTION)</h6>
                                            <span class="font700"><?php echo $total_inst_professors;?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-orange mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="28"></div>
                                    </div>
                                   <!--  <small class="text-muted">19% compared to last week</small> -->
                                </div>
                                </a>
                            </div>
                            
                            <div <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('professors', $permissions)){echo 'style="display:none;"';}} ?> class="col-lg-4 col-md-6 col-sm-6">
                                <a href="<?php echo base_url('admin/professors');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="icon-users text-col-grey" style="font-size:25px;"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>PROFESSORS (ADMIN)</h6>
                                            <span class="font700"><?php echo $total_professors;?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-grey mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="28"></div>
                                    </div>
                                   <!--  <small class="text-muted">19% compared to last week</small> -->
                                </div>
                                </a>
                            </div>
                            
                            <div <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('experts', $permissions)){echo 'style="display:none;"';}} ?> class="col-lg-4 col-md-6 col-sm-6">
                                <a href="<?php echo base_url('admin/experts');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="icon-users text-col-blue" style="font-size:25px;"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>COUNSELLORS (ADMIN)</h6>
                                            <span class="font700"><?php echo $total_experts;?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-blue mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="28"></div>
                                    </div>
                                   <!--  <small class="text-muted">19% compared to last week</small> -->
                                </div>
                                </a>
                            </div>
                            
                             <div <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('speakers', $permissions)){echo 'style="display:none;"';}} ?> class="col-lg-4 col-md-6 col-sm-6">
                                <a href="<?php echo base_url('admin/speakers');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="icon-users text-col-yellow" style="font-size:25px;"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>SPEAKERS (ADMIN)</h6>
                                            <span class="font700"><?php echo $total_speakers;?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-yellow mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="28"></div>
                                    </div>
                                   <!--  <small class="text-muted">19% compared to last week</small> -->
                                </div>
                                </a>
                            </div>
                            
                             <div <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('webinar_guests', $permissions)){echo 'style="display:none;"';}} ?> class="col-lg-4 col-md-6 col-sm-6">
                                <a href="<?php echo base_url('admin/webinars/guests');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="icon-users text-col-green" style="font-size:25px;"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>WEBINAR GUESTS</h6>
                                            <span class="font700"><?php echo $total_webinar_guests;?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-green mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="28"></div>
                                    </div>
                                   <!--  <small class="text-muted">19% compared to last week</small> -->
                                </div>
                                </a>
                            </div>
                            
                           	<div <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('webinars', $permissions)){echo 'style="display:none;"';}} ?> class="col-lg-4 col-md-6 col-sm-6">
                                <a href="<?php echo base_url('admin/webinars');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="fa fa-desktop fa-2x text-col-red" style="font-size:25px;"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>WEBINARS</h6>
                                            <span class="font700"><?php echo $total_webinars;?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-red mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="28"></div>
                                    </div>
                                   <!--  <small class="text-muted">19% compared to last week</small> -->
                                </div>
                                </a>
                            </div>
                             <div class="col-lg-4 col-md-6 col-sm-6">
                                <a href="<?php echo base_url('admin/auditorium/presentations');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="fa fa-desktop fa-2x text-col-dark" style="font-size:25px;"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>PRESENTATIONS</h6>
                                            <span class="font700"><?php echo $total_presentations;?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-dark mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="28"></div>
                                    </div>
                                   <!--  <small class="text-muted">19% compared to last week</small> -->
                                </div>
                                </a>
                            </div>
                            
                             <div class="col-lg-4 col-md-6 col-sm-6">
                                <a href="<?php echo base_url('admin/professors/meetings');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="fa fa-calendar fa-2x text-col-yellow" style="font-size:25px;"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>PROFESSOR'S MEETINGS</h6>
                                            <span class="font700"><?php echo $total_pro_meetings;?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-yellow mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="28"></div>
                                    </div>
                                   <!--  <small class="text-muted">19% compared to last week</small> -->
                                </div>
                                </a>
                            </div>
                            
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <a href="<?php echo base_url('admin/dashboard/enquiries');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="fa fa-question fa-2x text-col-green" style="font-size:25px;"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>ENQUIRIES</h6>
                                            <span class="font700"><?php echo $total_enquiries;?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-green mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="28"></div>
                                    </div>
                                   <!--  <small class="text-muted">19% compared to last week</small> -->
                                </div>
                                </a>
                            </div>
                            
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <a href="<?php echo base_url('admin/dashboard/admissions');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="fa fa-graduation-cap fa-2x text-col-red" style="font-size:25px;"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>ADMISSIONS</h6>
                                            <span class="font700"><?php echo $total_admissions;?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-red mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="28"></div>
                                    </div>
                                   <!--  <small class="text-muted">19% compared to last week</small> -->
                                </div>
                                </a>
                            </div>
                            
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <a href="<?php echo base_url('admin/dashboard/svebooth');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="icon-users fa-2x text-col-blue" style="font-size:25px;"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>STUDENTS VISITED E-BOOTH'S</h6>
                                            <span class="font700"><?php echo $total_svebooth;?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-blue mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="28"></div>
                                    </div>
                                   <!--  <small class="text-muted">19% compared to last week</small> -->
                                </div>
                                </a>
                            </div>
                            
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <a href="<?php echo base_url('admin/feedback');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="fa fa-comments-o fa-2x text-col-dark" style="font-size:25px;"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>FEEDBACK</h6>
                                            <span class="font700"><?php echo $total_feedbacks;?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-dark mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="28"></div>
                                    </div>
                                   <!--  <small class="text-muted">19% compared to last week</small> -->
                                </div>
                                </a>
                            </div>
                            
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <a href="<?php echo base_url('admin/dashboard/inst_feedbacks');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="fa fa-comments-o fa-2x text-col-green" style="font-size:25px;"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>FEEDBACK INSTITUTES</h6>
                                            <span class="font700"><?php echo $total_inst_feedbacks;?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-green mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="28"></div>
                                    </div>
                                   <!--  <small class="text-muted">19% compared to last week</small> -->
                                </div>
                                </a>
                            </div>
                           
                        </div>
                        <?php //if(!isset($this->session->userdata['user_login'])){ ?>
                        <!--<div class="row clearfix">
                            <div class="col-md-12 col-lg-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>No'of Students Visited E Booth's</h5>                            
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive social_media_table">
                                            <table class="table table-hover" id="dtable">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>E Booth Name</th>
                                                        <th align="center">Logged In Students</th>   
                                                        <th align="center">Anonymous Visitors</th>   
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                
                                                    <? //$institutes = $this->db->get_where("tbl_institutes",["is_active"=>0,"live_status"=>1,"is_deleted"=>0])->result(); 
                                                        //foreach($institutes as $ins){
                                                    ?>
                                                
                                                        <tr>
                                                            <td>
                                                                <a href="<?php //echo base_url('admin/dashboard/onlinestudents/').$ins->institute_id ; ?>" style="color: black"><span class="list-name"><? //echo ucfirst($ins->institute_name) ?></span></a>
                                                            </td>
                                                            <td align="center">
                                                                <span class="badge badge-success"><? //echo $this->db->get_where("tbl_student_institute_view_time",["institute_id"=>$ins->institute_id,"status"=>"online","date"=>date("Y-m-d"),"type"=>"loggedin"])->num_rows(); ?></span>
                                                            </td>
                                                            <td align="center">
                                                                <span class="badge badge-success"><? //echo $this->db->get_where("tbl_student_institute_view_time",["institute_id"=>$ins->institute_id,"status"=>"online","date"=>date("Y-m-d"),"type"=>"visitor"])->num_rows(); ?></span>
                                                            </td>
                                                        </tr>
                                                    <? //} ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->
                        <?php //} ?>

                        
                    </div>
                    <?php if(!isset($this->session->userdata['user_login'])){?>
                    <div class="card top_report">
                        <?php echo $this->session->flashdata('msg');?>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <?php                                 
                                $url = "https://zoom.us/oauth/authorize?response_type=code&client_id=".CLIENT_ID."&redirect_uri=".REDIRECT_URI;
                                ?>
                                  
                                <a href="<?php echo $url; ?>"><?php if($zoom_access_token){ echo "Generate Zoom Access Token"; } else{ echo "Re-Generate Zoom Access Token"; }?></a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>

           
             
            </div>
 
</div>

