<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">
                        <h2>Dashboard</h2>
                    </div>            
                 
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-12">
                    <div class="card top_report">
                        <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <a href="<?php echo base_url('speaker/meetings');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class=" fa fa-book text-col-blue text-col-blue" style="font-size:25px;"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6> Upcoming Booked Sessions</h6>
                                            <span class="font700"><?php echo $this->db->query("SELECT * FROM tbl_speaker_student_schedule LEFT JOIN tbl_students ON tbl_speaker_student_schedule.student_id = tbl_students.student_id WHERE tbl_speaker_student_schedule.speaker_id='".$this->session->userdata['speaker_id']."' ORDER BY spe_std_date DESC")->num_rows() ?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-blue mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="87"></div>
                                    </div>
                                </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                            <a href="<?php echo base_url('speaker/enquiries');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class=" fa fa-question text-col-red" style="font-size:25px;"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>New Enquiries Received</h6>
                                            <span class="font700"><?php echo $this->db->query("SELECT tbl_institute_ask_a_question.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_ask_a_question LEFT JOIN tbl_students ON tbl_institute_ask_a_question.student_id = tbl_students.student_id WHERE tbl_institute_ask_a_question.institute_id='".$this->session->userdata['speaker_id']."' AND tbl_institute_ask_a_question.type='speaker'  ORDER BY id DESC")->num_rows();?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-red mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="87"></div>
                                    </div>
                                </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                            <a href="<?php echo base_url('speaker/dashboard/livedata');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="fa fa-signal text-col-green text-col-blue" style="font-size:25px;"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>Number of live Students on my profile</h6>
                                            <span class="font700"><?php 
                                            $speaker_id    =$this->session->userdata("speaker_id");
                                            echo $this->db->order_by('id', 'DESC')->get_where("tbl_viewprofiles_data",["profile_id"=>$this->session->userdata("speaker_id"),"ref_type"=>"speaker", "status"=> "online"])->num_rows(); ?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-green mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="87"></div>
                                    </div>
                                </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                            <a href="<?php echo base_url('speaker/dashboard/studentlogintime');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class=" fa fa-users text-col-blue text-col-blue" style="font-size:25px;"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6> Number of students visited my profile</h6>
                                            <span class="font700"><?php 
                                            $speaker_id =$this->session->userdata['speaker_id'];
                                            echo  $this->db->query("SELECT * from tbl_viewprofiles_data where ref_type='speaker'")->num_rows(); ?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-blue mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="87"></div>
                                    </div>
                                </div>
                                </a>
                            </div>
                           
                    </div>
                </div>
            </div>

           
             
            </div>

                  
</div>