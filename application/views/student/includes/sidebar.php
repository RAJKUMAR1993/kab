<style>
    .center{
        display: flex;
        justify-content: center;
        align-items: center;
        /* height: 200px; */
        /* border: 3px solid green; */
    }
</style>

<div id="leftsidebar" class="sidebar">
            <div class="sidebar-scroll">
            <div class="header center ">
              <h1 style= " align-items: center;"><img class="rounded-circle" src="<?php echo base_url();?>assets/images/user-small.png" width="50" alt=""></i></h1>
            </div>
            <div class="text-center text-white role_name ">
                <?php echo $this->session->userdata('student_name');?>
                <span> (Student)</span>
            </div>

                <nav id="leftsidebar-nav" class="sidebar-nav">
                    <ul id="main-menu" class="metismenu <?php if($this->uri->segment(2)=="course"){echo "active";}?>" >
                        <!-- <li class="heading">Main</li> -->
                        <li>
                            <a href="<?php echo base_url();?>" target="_self"><i class="icon-home"></i><span>Home</span></a>
                        </li>
                        <li <?php if($this->uri->segment(2)=="dashboard"){echo 'class="active"';}?>>
                            <a href="<?php echo base_url("student/dashboard");?>"><i class="fa fa-dashboard"></i><span>Dashboard</span></a>
                        </li>
                        <li <?php if(current_url()==base_url("student/settings/basic")){echo 'class="active"';}?>>
                            <a href="<?php echo base_url("student/settings/basic");?>"><i class="icon-user"></i><span>My Profile</span></a>
                        </li>
                        <? if($this->student_model->is_menu_enabled("exhibitors")){ ?>
						   <li <?php if(current_url()==base_url("student/browseinst")){echo 'class="active"';}?>>
								<a href="<?php echo base_url();?>student/browseinst"><i class="icon-home"></i><span>Exhibitors</span></a>
							</li>
                        <? } ?>
                        <li <?php if($this->uri->segment(3)=="shorlisted_list"){echo 'class="active"';}?>>
                            <a href="<?php echo base_url();?>student/browseinst/shorlisted_list"><i class="icon-social-dribbble"></i>College Connect/Meet</a>
                        </li>
                        <? if($this->student_model->is_menu_enabled("experts")){ ?>
							<li <?php if($this->uri->segment(3)=="experts"){echo 'class="active"';}?>>
								<a href="<?php echo base_url();?>experts" target="_self"><i class="icon-user-following"></i>Counsellors</a>
							</li>
                        <? } ?>
                        <? if($this->student_model->is_menu_enabled("professor")){ ?>
							<li <?php if($this->uri->segment(3)=="professor"){echo 'class="active"';}?>>
								<a href="<?php echo base_url();?>professor" target="_self"><i class="icon-microphone"></i>Talk to Professor</a>
							</li>
                        <? } ?>
                        <? if($this->student_model->is_menu_enabled("front/webinars/eventSchedule")){ ?>
							<li <?php if($this->uri->segment(3)=="eventschedule"){echo 'class="active"';}?>>
								<a href="<?php echo base_url('front/webinars/eventSchedule');?>" target="_self"><i class="icon-support"></i>College Presentations</a>
							</li>
                        <? } ?>
                        <li <?php if($this->uri->segment(3)=="event_bag"){echo 'class="active"';}?>>
                            <a href="<?php echo base_url();?>student/dashboard/event_bag" target="_self"><i class="fa fa-shopping-cart"></i><span>Event Bag</span></a>
                        </li> 
                        <li <?php if($this->uri->segment(2)=="enquiries"){echo 'class="active"';}?>>
                            <a href="<?php echo base_url("student/enquiries");?>"><i class="icon-pencil"></i><span>My Enquiries</span></a>
                        </li>
                        <li <?php if($this->uri->segment(2)=="myapplications"){echo 'class="active"';}?>>
                            <a href="#uiElements" class="has-arrow"><i class="icon-list"></i><span>My Application Status</span></a>
                            <ul>
                                <li <?php if($this->uri->segment(3)=="admissions"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("student/myapplications/admissions");?>">Admission</a>
                                </li>
                            </ul>
                        </li>
                        <li <?php if($this->uri->segment(2)=="meetings"){echo 'class="active"';}?>>
                            <a href="#uiElements" class="has-arrow"><i class="icon-list"></i><span>My Event Schedule</span></a>
                            <ul>
                                
                                <li class="middle <?php if($this->uri->segment(2)=="meetings" && $this->uri->segment(3)==""){echo "active";}?>">
                                    <a href="<?php echo base_url("student/meetings");?>">Professors Meetings</a>
                                </li>
                                <li class="middle <?php if($this->uri->segment(2)=="meetings" && $this->uri->segment(3)=="speakers"){echo "active";}?>">
                                    <a href="<?php echo base_url("student/meetings/speakers");?>">Speakers Meetings</a>
                                </li>
                                <li class="middle <?php if($this->uri->segment(2)=="meetings" && $this->uri->segment(3)=="expertmeetings"){echo "active";}?>">
                                    <a href="<?php echo base_url("student/meetings/expertmeetings");?>">Counsellor Meetings</a>
                                </li>
                                <li class="middle <?php if($this->uri->segment(2)=="meetings" && $this->uri->segment(3)=="councellors"){echo "active";}?>">
                                    <a href="<?php echo base_url("student/meetings/councellors");?>">Admission Officer Meetings</a>
                                </li>
                                <li class="middle <?php if($this->uri->segment(2)=="meetings" && $this->uri->segment(3)=="webinars"){echo "active";}?>">
                                    <a href="<?php echo base_url("student/meetings/webinars");?>">Webinars</a>
                                </li>
                                <li class="middle <?php if($this->uri->segment(2)=="meetings" && $this->uri->segment(3)=="auditorium_presentations"){echo "active";}?>">
                                    <a href="<?php echo base_url("student/meetings/auditorium_presentations");?>">Auditorium Presentations</a>
                                </li>
                                
                            </ul>
                        </li>

                        <li <?php if($this->uri->segment(2)=="payments"){echo 'class="active"';}?>>
                            <a href="#" class="has-arrow"><i class="fa fa-rupee"></i><span>Payment History</span></a>
                            <ul>
                            
                                <li <?php if($this->uri->segment(2)=="payments"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("student/payments/professorPayments");?>">Professor Payments</a>
                                </li>
                                <li <?php if($this->uri->segment(2)=="payments"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("student/payments/speakerPayments");?>">Speaker Payments</a>
                                </li>
                                <li <?php if($this->uri->segment(2)=="payments"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("student/payments/councellorPayments");?>">Councellor Payments</a>
                                </li>
                                
                            </ul>
                        </li>
                        <li <?php if($this->uri->segment(2)=="calendar"){echo 'class="active"';}?>>
                            <a href="<?php echo base_url("student/calendar");?>"><i class="icon-calendar"></i><span>Calendar View</span></a>
                        </li>
                        <li <?php if($this->uri->segment(2)=="#"){echo 'class="active"';}?>>
                            <a href="<?php echo base_url("student/reports");?>"><i class="fa fa-list"></i><span>Reports</span></a>
                        </li>
                         <!-- <li>
                            <a href="<?php echo base_url();?>experts" target="_self"><i class="icon-pencil"></i><span>Rank Analysis</span></a>
                        </li> -->
                    </ul>
                </nav>
            </div>
        </div>