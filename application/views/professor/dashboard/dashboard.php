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
                            <!-- <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class=" icon-users text-col-blue" style="font-size:25px;"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6></h6>
                                            <span class="font700"><?php //echo 0;?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-blue mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="87"></div>
                                    </div>
                                </div>
                                </a>
                            </div> -->
                            <div class="col-lg-4 col-md-6 col-sm-6">
                            <a href="<?php echo base_url('professor/meetings');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class=" fa fa-book text-col-blue text-col-blue" style="font-size:25px;"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6> Booked (Upcoming) Sessions</h6>
                                            <span class="font700"><?php echo $this->db->query("SELECT * FROM tbl_professor_meeting LEFT JOIN tbl_students ON tbl_professor_meeting.session_student_id = tbl_students.student_id WHERE tbl_professor_meeting.session_pro_id='".$this->session->userdata['pro_id']."' ORDER BY session_date DESC ")->num_rows() ?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-blue mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="87"></div>
                                    </div>
                                </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                            <a href="<?php echo base_url('professor/enquiries');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class=" fa fa-question text-col-red" style="font-size:25px;"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>New Enquiries</h6>
                                            <span class="font700"><?php echo $this->db->query("SELECT tbl_institute_ask_a_question.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_ask_a_question LEFT JOIN tbl_students ON tbl_institute_ask_a_question.student_id = tbl_students.student_id WHERE tbl_institute_ask_a_question.institute_id='".$this->session->userdata['pro_id']."' AND tbl_institute_ask_a_question.type='professor'  ORDER BY id DESC")->num_rows();?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-red mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="87"></div>
                                    </div>
                                </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                            <a href="<?php echo base_url('professor/payments');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="fa fa-money text-col-green text-col-blue" style="font-size:25px;"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>New Payments</h6>
                                            <span class="font700"><?php echo $payment;?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-green mb-0 mt-3">
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