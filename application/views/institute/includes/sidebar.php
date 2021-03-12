<style>
    .center{
        display: flex;
        justify-content: center;
        align-items: center;
  
    }
    
</style>

<div id="leftsidebar" class="sidebar">
            <div class="sidebar-scroll">

            <div class="header center ">
              <h1 style= " align-items: center;"><img class="rounded-circle" src="<?php echo base_url();?>assets/images/user-small.png" width="50" alt=""></i></h1>
            </div>
            <div class="text-center text-white role_name ">
                <?php echo $this->session->userdata('institute_name');?>
                <span> (Institute)</span>
            </div>

                <nav id="leftsidebar-nav" class="sidebar-nav">
                    <ul id="main-menu" class="metismenu <?php if($this->uri->segment(2)=="course"){echo "active";}?>" >
                        <!-- <li class="heading">Main</li> -->
                        <li>
                            <a href="<?php echo base_url();?>" target="_self"><i class="icon-home"></i><span>Home</span></a>
                        </li>
                        <li <?php if($this->uri->segment(2)=="dashboard"){echo 'class="active"';}?>>
                            <a href="<?php echo base_url("institute/dashboard");?>"><i class="fa fa-dashboard"></i><span>Dashboard</span></a>
                        </li>
                        <li <?php if(current_url()==base_url("institute/settings/basic")){echo 'class="active"';}?>>
                            <a href="<?php echo base_url("institute/settings/basic");?>"><i class="fa fa-user"></i><span>My Profile</span></a>
                        </li>
                        <li class="middle <?php if(($this->uri->segment(2)=="settings" && $this->uri->segment(3)=="menu_header") || ($this->uri->segment(2)=="settings" && $this->uri->segment(3)=="backgroundimage")){echo "active";}?>">
                            <a href="#uiElements" class="has-arrow"><i class="fa fa-wrench"></i><span>Settings</span></a>
                            <ul>
                                <li <?php if($this->uri->segment(3)=="menu_header"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("institute/settings/menu_header");?>">Display Settings</a>
                                </li>
                                <li <?php if($this->uri->segment(3)=="backgroundimage"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("institute/settings/backgroundimage");?>">Background Image </a>
                                </li>
                            </ul>
                        </li>
                        <li class="middle <?php if($this->uri->segment(2)=="data"){echo "active";}?>">
                            <a href="#uiElements" class="has-arrow"><i class="fa fa-list"></i><span>Data</span></a>
                            <ul>
                                <li <?php if($this->uri->segment(3)=="admission2020"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("institute/data/admission2020");?>">Admission 2020</a>
                                </li>
                                <!--<li <?php if($this->uri->segment(3)=="content"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("institute/data/content");?>">Content</a>
                                </li>-->
                                <li <?php if($this->uri->segment(3)=="video" || $this->uri->segment(3)=="addvideo"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("institute/data/video");?>">Video Gallery</a>
                                </li>
                                    <li <?php if($this->uri->segment(3)=="gallery"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("institute/data/gallery");?>">Photo Gallery</a>
                                </li>
                                <!-- <li <?php if($this->uri->segment(3)=="brouchers"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("institute/data/brouchers");?>">Brochure</a>
                                </li>
                                <li <?php if($this->uri->segment(3)=="ppts"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("institute/data/ppts");?>">PPTs</a>
                                </li> -->
                                <li <?php if($this->uri->segment(3)=="courses"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("institute/data/courses");?>">Courses & Fees Details</a>
                                </li>
                                <!--<li <?php if($this->uri->segment(3)=="programmefees"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("institute/data/programmefees");?>">Programmes and Fees </a>
                                </li>-->
                                <!--<li <?php if($this->uri->segment(3)=="placement"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("institute/data/placement");?>">Placements</a>
                                </li>-->
                                <li <?php if($this->uri->segment(3)=="placementstatistics"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("institute/data/placementstatistics");?>">Placement Statistics</a>
                                </li>
                                <li <?php if($this->uri->segment(3)=="studentsplacement"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("institute/data/studentsplacement");?>">Students Placement</a>
                                </li>
                                <li <?php if($this->uri->segment(3)=="feedback"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("institute/data/feedback");?>">Feedback</a>
                                </li>
                                <!-- <li <?php if($this->uri->segment(3)=="achievement"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("institute/data/achievement");?>">Achievements</a>
                                </li> -->
                                <li <?php if($this->uri->segment(3)=="testimonial"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("institute/data/testimonial");?>">Testimonials</a>
                                </li>
                                <li <?php if($this->uri->segment(3)=="sociallinks"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("institute/data/sociallinks");?>">Social Links</a>
                                </li>
                            </ul>
                        </li>
                        <li class="middle <?php if($this->uri->segment(2)=="sessions"){echo "active";}?>">
                            <a href="#uiElements" class="has-arrow"><i class="fa fa-list"></i><span>Presentations</span></a>
                            <ul>  
                                <li <?php if($this->uri->segment(2)=="#"){echo 'class="active"';}?>>
                                    <a href="<? echo base_url("institute/sessions") ?>"><span>Create</span></a>
                                </li>
                                <li <?php if($this->uri->segment(3)=="#"){echo 'class="active"';}?>>
                                    <a href="<? echo base_url("institute/sessions/auditorium_presentations") ?>"><span>Booked Presentations</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="middle <?php if($this->uri->segment(2)=="eventschedule"){echo "active";}?>">
                            <a href="#uiElements" class="has-arrow"><i class="fa fa-list"></i><span>My Event Schedule</span></a> 
                            <ul>  
                                <li <?php if($this->uri->segment(2)=="#"){echo 'class="active"';}?>>
                                    <a href="<? echo base_url("institute/eventschedule") ?>"><span>Presentations</span></a>
                                </li>
                                <li <?php if($this->uri->segment(3)=="#"){echo 'class="active"';}?>>
                                    <a href="<? echo base_url("institute/eventschedule/professor_meeting") ?>"><span>Professor Meetings</span></a>
                                </li>
                            </ul>
                        </li>
                        <li <?php if($this->uri->segment(2)=="councellors"){echo 'class="active"';}?>>
                            <a href="<?php echo base_url("institute/councellors");?>"><i class="fa fa-list"></i><span>Professors</span></a>
                        </li> 
                        <li class="middle <?php if($this->uri->segment(2)=="videoconnect" || $this->uri->segment(2)=="virtualcontacts" ){echo "active";}?>">
                            <a href="#uiElements" class="has-arrow"><i class="fa fa-list"></i><span>Admission Officers</span></a>
                            <ul>  
                                 <li <?php if($this->uri->segment(2)=="videoconnect"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("institute/videoconnect");?>">Video Connect</a>
                                </li>
                                <li <?php if($this->uri->segment(2)=="virtualcontacts"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("institute/virtualcontacts");?>">Helpline Numbers</a>
                                </li>
                            </ul>
                        </li>
                        <li <?php if($this->uri->segment(2)=="faqs"){echo 'class="active"';}?>>
                            <a href="<? echo base_url("institute/faqs") ?>"><i class="fa fa-list"></i><span>Chat bot FAQs</span></a>
                        </li>

                        <li <?php if($this->uri->segment(2)=="myeventschedule"){echo 'class="active"';}?>>
                            <a href="<? echo base_url("institute/myeventschedule") ?>"><i class="fa fa-calendar"></i><span>Calendar View</span></a>
                        </li>
                        <li <?php if($this->uri->segment(2)=="#"){echo 'class="active"';}?>>
                            <a href="<? echo base_url("institute/analytics") ?>"><i class="fa fa-list"></i><span>Statistics</span></a>
                        </li>
                        <li <?php if($this->uri->segment(2)=="#"){echo 'class="active"';}?>>
                            <a href="<?php echo base_url("institute/reports");?>"><i class="fa fa-list"></i><span>Reports</span></a>
                        </li>
                        <!-- <li class="middle <?php //if($this->uri->segment(2)=="admissions" || $this->uri->segment(2)=="enquiries" || $this->uri->segment(2)=="feedback"){echo "active";}?>">
                            <a href="#uiElements" class="has-arrow"><i class="fa fa-list"></i><span>Reports</span></a>
                            <ul> 
                                <li <?php //if($this->uri->segment(2)=="reports"){echo 'class="active"';}?>>
                                    <a href="<?php //echo base_url("institute/reports");?>">Reports</a>
                                </li>    
                                <li <?php //if($this->uri->segment(2)=="admissions"){echo 'class="active"';}?>>
                                    <a href="<?php //echo base_url("institute/admissions");?>">Applications</a>
                                </li>
                                 <li <?php //if($this->uri->segment(2)=="enquiries"){echo 'class="active"';}?>>
                                    <a href="<?php //echo base_url("institute/enquiries");?>">Enquiries</a>
                                </li>
                                <li <?php //if($this->uri->segment(2)=="feedback"){echo 'class="active"';}?>>
                                    <a href="<?php //echo base_url("institute/feedback");?>">Feedback Report</a>
                                </li>   
                            </ul>
                        </li>                     -->
                    </ul>
                </nav>
            </div>
        </div>