<?php
$permissions = [];
if(isset($this->session->userdata['user_login'])){
    $permissions = $this->session->userdata['permissions'];
}
?>
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
                <?php echo $this->session->userdata('admin_name');?>
                <span> (Admin)</span>
            </div>
                <nav id="leftsidebar-nav" class="sidebar-nav">
                    <ul id="main-menu" class="metismenu <?php if($this->uri->segment(2)=="course"){echo "active";}?>" >
                        <!-- <li class="heading">Main</li> -->
                        <li>
                            <a href="<?php echo base_url();?>" target="_self"><i class="icon-home"></i><span>Home</span></a>
                        </li>
                        <li <?php if($this->uri->segment(2)=="dashboard"){echo 'class="active"';}?>>
                            <a href="<?php echo base_url("admin/dashboard");?>"><i class="fa fa-dashboard"></i><span>Dashboard</span></a>
                        </li>
                        
                        <li <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('users', $permissions)){echo 'style="display:none;"';}} ?> <?php if($this->uri->segment(2)=="users"){echo 'class="active"';}?>>
                            <a href="<?php echo base_url("admin/users");?>"><i class="fa fa-users"></i><span>Users</span></a>
                        </li>
                        <li <?php if(isset($this->session->userdata['user_login'])){ if(in_array('auditorium_create', $permissions) || in_array('auditorium_booked_presentations', $permissions)){}else{echo 'style="display:none;"';}} ?> class="middle <?php if($this->uri->segment(2)=="auditorium"){echo "active";}?>">
                            <a href="#uiElements" class="has-arrow"><i class="fa fa-building"></i><span>Auditorium</span></a>
                            <ul>  
								<li <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('auditorium_create', $permissions)){echo 'style="display:none;"';}} ?> <?php if($this->uri->segment(3)=="video"){echo 'class="active"';}?>>
									<a href="<? echo base_url("admin/auditorium/video") ?>"><span>Create</span></a>
								</li>
                         		<li <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('auditorium_booked_presentations', $permissions)){echo 'style="display:none;"';}} ?> <?php if($this->uri->segment(3)=="auditorium_presentations"){echo 'class="active"';}?>>
									<a href="<? echo base_url("admin/auditorium/auditorium_presentations") ?>"><span>Booked Presentations</span></a>
								</li>
								<li>
									<a href="<? echo base_url("admin/auditorium/presentations") ?>"><span>View Presentations</span></a>
								</li>
							</ul>
						</li>
                        
						<li <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('advertise', $permissions)){echo 'style="display:none;"';}} ?> <?php if($this->uri->segment(2)=="advertise"){echo 'class="active"';}?>>
                            <a href="<?php echo base_url("admin/avertise");?>"><i class="fa fa-building"></i><span>Advertise</span></a>
                        </li>
                         <li <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('categories', $permissions)){echo 'style="display:none;"';}} ?> <?php if($this->uri->segment(2)=="categories"){echo 'class="active"';}?>>
                            <a href="<?php echo base_url("admin/categories");?>"><i class="fa fa-list"></i><span>Categories</span></a>
                        </li>
                         <li <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('institutes', $permissions)){echo 'style="display:none;"';}} ?> <?php if($this->uri->segment(2)=="institutes"){echo 'class="active"';}?>>
                            <a href="<?php echo base_url("admin/institutes");?>"><i class="fa fa-university"></i><span>Institutes</span></a>
                        </li>
                        <li <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('students', $permissions)){echo 'style="display:none;"';}} ?> <?php if($this->uri->segment(2)=="students"){echo 'class="active"';}?>>
                            <a href="<?php echo base_url("admin/students");?>"><i class="fa fa-users"></i><span>Students</span></a>
                        </li>
                        <li <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('expert_counsellors', $permissions)){echo 'style="display:none;"';}} ?> <?php if($this->uri->segment(2)=="experts"){echo 'class="active"';}?>>
                            <a href="<?php echo base_url("admin/experts");?>"><i class="fa fa-users"></i><span>Experts Counsellers</span></a>
                        </li>
                        <li <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('speakers', $permissions)){echo 'style="display:none;"';}} ?> <?php if($this->uri->segment(2)=="speakers"){echo 'class="active"';}?>>
                            <a href="<?php echo base_url("admin/speakers");?>"><i class="fa fa-users"></i><span>Speakers</span></a>
                        </li>
                        <li <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('professors', $permissions)){echo 'style="display:none;"';}} ?> <?php if($this->uri->segment(2)=="professors"){echo 'class="active"';}?>>
                            <a href="<?php echo base_url("admin/professors");?>"><i class="fa fa-users"></i><span>Professors</span></a>
                        </li>
                        <li <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('webinar_dates', $permissions)){echo 'style="display:none;"';}} ?> <?php if($this->uri->segment(2)=="webinars" && $this->uri->segment(3)=="webinar_dates"){echo 'class="active"';}?>>
                            <a href="<?php echo base_url("admin/webinars/webinar_dates");?>"><i class="fa fa-users"></i>Webinar Dates</a>
                        </li>
                        <li <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('webinar_guests', $permissions)){echo 'style="display:none;"';}} ?> <?php if($this->uri->segment(2)=="webinars" && $this->uri->segment(3)=="guests"){echo 'class="active"';}?>>
                            <a href="<?php echo base_url("admin/webinars/guests");?>"><i class="fa fa-users"></i><span>Webinar Guests</span></a>
                        </li>
                        <li <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('webinars', $permissions)){echo 'style="display:none;"';}} ?> <?php if(current_url() == base_url("admin/webinars")){echo 'class="active"';}?>>
                            <a href="<?php echo base_url("admin/webinars");?>"><i class="fa fa-users"></i><span>Webinars</span></a>
                        </li>
                        
                        <li <?php if(isset($this->session->userdata['user_login'])){ if(in_array('feedback_report', $permissions) || in_array('institute_feedback', $permissions)){}else{echo 'style="display:none;"';}} ?> class="middle <?php if($this->uri->segment(2)=="feedback"){echo "active";}?>">
							<a href="#uiElements" class="has-arrow"><i class="fa fa-wrench"></i><span>Feedback Report</span></a>
							<ul>
								<li  <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('feedback_report', $permissions)){echo 'style="display:none;"';}} ?> <?php if($this->uri->segment(2)=="feedback"){echo 'class="active"';}?>>
									<a href="<?php echo base_url("admin/feedback");?>">Homepage Feedback</a>
								</li>
							   <li <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('institute_feedback', $permissions)){echo 'style="display:none;"';}} ?> <?php if($this->uri->segment(3)=="institue_feedback"){echo 'class="active"';}?>>
									<a href="<?php echo base_url("admin/feedback/institue_feedback");?>">Institute Feedback</a>
								</li>
							</ul>
						</li>
                        
						<!--<li <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('feedback_report', $permissions)){echo 'style="display:none;"';}} ?> <?php if($this->uri->segment(2)=="feedback"){echo 'class="active"';}?>>
                            <a href="<?php echo base_url("admin/feedback");?>"><i class="fa fa-comments-o"></i><span>Feedback Report</span></a>
                        </li>-->
                        <li <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('reports', $permissions)){echo 'style="display:none;"';}} ?> <?php if($this->uri->segment(2)=="reports"){echo 'class="active"';}?>>
                            <a href="<?php echo base_url("admin/reports");?>"><i class="fa fa-bars"></i><span>Reports</span></a>
                        </li>
                        <li <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('chat_bot_faqs', $permissions)){echo 'style="display:none;"';}} ?> <?php if(current_url() == base_url("admin/faqs")){echo 'class="active"';}?>>
                            <a href="<?php echo base_url("admin/faqs");?>"><i class="fa fa-comment-o"></i><span>Chat bot FAQs</span></a>
                        </li>
                        <li <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('kab_chat_bot_faqs', $permissions)){echo 'style="display:none;"';}} ?> <?php if($this->uri->segment(3)=="kab_faqs"){echo 'class="active"';}?>>
                            <a href="<?php echo base_url("admin/faqs/kab_faqs");?>"><i class="fa fa-comment-o"></i><span>KAB Chat bot FAQs</span></a>
                        </li>
                         <li <?php if(isset($this->session->userdata['user_login'])){ if(in_array('homepage_news_and_events_categories', $permissions) || in_array('homepage_news_and_events', $permissions) || in_array('homepage_testimonials', $permissions) || in_array('homepage_partner_and_sponsor', $permissions) || in_array('homepage_feedback', $permissions) || in_array('homepage_social_links', $permissions) || in_array('homepage_live_menu_status', $permissions)){}else{echo 'style="display:none;"';}} ?> <?php if($this->uri->segment(2)=="homepage"){echo 'class="active"';}?>>
                            <a href="#uiElements" class="has-arrow"><i class="fa fa-wrench"></i><span>Home Page Settings</span></a>
                            <ul>
                                    <!-- <li <?php if($this->uri->segment(3)=="slider"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("admin/homepage/slider");?>">Slider</a>
                                </li> -->
                                <li <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('homepage_news_and_events_categories', $permissions)){echo 'style="display:none;"';}} ?> <?php if($this->uri->segment(3)=="necategories"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("admin/homepage/necategories");?>">News & Events Categories</a>
                                </li>
                               <li <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('homepage_news_and_events', $permissions)){echo 'style="display:none;"';}} ?> <?php if($this->uri->segment(3)=="news"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("admin/homepage/news");?>">News & Events</a>
                                </li>
								<!-- <li <?php if($this->uri->segment(3)=="cards"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("admin/homepage/cards");?>">Cards</a>
                                </li> -->
								<li <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('homepage_testimonials', $permissions)){echo 'style="display:none;"';}} ?> <?php if($this->uri->segment(3)=="testimonials"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("admin/homepage/testimonials");?>">Testimonials</a>
                                </li>
								<li <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('homepage_partner_and_sponsor', $permissions)){echo 'style="display:none;"';}} ?> <?php if($this->uri->segment(3)=="partners"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("admin/homepage/partners");?>">Partners & Sponsor</a>
                                </li>
								<li <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('homepage_feedback', $permissions)){echo 'style="display:none;"';}} ?> <?php if($this->uri->segment(3)=="feedback"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("admin/homepage/feedback");?>">Feedback</a>
                                </li>
                                <li <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('homepage_social_links', $permissions)){echo 'style="display:none;"';}} ?> <?php if($this->uri->segment(3)=="sociallinks"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("admin/homepage/sociallinks");?>">Social Links</a>
                                </li>
                                <li <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('homepage_live_menu_status', $permissions)){echo 'style="display:none;"';}} ?> <?php if($this->uri->segment(3)=="menustatus"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("admin/homepage/menustatus");?>">Live Menu Status</a>
                                </li>
								<li>
                                    <a href="<?php echo base_url("admin/homepage/bgvideo");?>">Sliders</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url("admin/homepage/blocks");?>">Card Blocks</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url("");?>admin/homepage/foot_dec">Footer Description</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url("");?>admin/homepage/contact">Contacts Details</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url("");?>admin/homepage/footer_menu">Footer Settings</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url("");?>admin/homepage/why_to_attend">Students Why to attend</a>
                                </li>
                            </ul>
                        </li>

                        <li <?php if(isset($this->session->userdata['user_login'])){ if(in_array('professor_payments', $permissions) || in_array('speaker_payments', $permissions) || in_array('councellor_payments', $permissions)){}else{echo 'style="display:none;"';}} ?> <?php if($this->uri->segment(2)=="payments"){echo 'class="active"';}?>>
                            <a href="#" class="has-arrow"><i class="fa fa-rupee"></i><span>Payment History</span></a>
                            <ul>
                            
                                <li <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('professor_payments', $permissions)){echo 'style="display:none;"';}} ?> <?php if($this->uri->segment(2)=="payments"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("admin/payments/professorPayments");?>">Professor Payments</a>
                                </li>
                                <li <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('speaker_payments', $permissions)){echo 'style="display:none;"';}} ?> <?php if($this->uri->segment(2)=="payments"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("admin/payments/speakerPayments");?>">Speaker Payments</a>
                                </li>
                                <li <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('councellor_payments', $permissions)){echo 'style="display:none;"';}} ?> <?php if($this->uri->segment(2)=="payments"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("admin/payments/councellorPayments");?>">Councellor Payments</a>
                                </li>
                                
                            </ul>
                        </li>
                         
                        <li <?php if(isset($this->session->userdata['user_login'])){ if(in_array('settings_basic_details', $permissions) || in_array('settings_login_history', $permissions) || in_array('settings_database_backup', $permissions)){}else{echo 'style="display:none;"';}} ?> class="middle <?php if($this->uri->segment(2)=="settings"){echo "active";}?>">
                            <a href="#uiElements" class="has-arrow"><i class="fa fa-wrench"></i><span>Settings</span></a>
                            <ul>
                                <li <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('settings_basic_details', $permissions)){echo 'style="display:none;"';}} ?> <?php if($this->uri->segment(3)=="basic"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("admin/settings/basic");?>">Basic Details</a>
                                </li>
                               <li <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('settings_login_history', $permissions)){echo 'style="display:none;"';}} ?> <?php if($this->uri->segment(3)=="login_history"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("admin/settings/login_history");?>">Login History</a>
                                </li>
                                <li <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('settings_database_backup', $permissions)){echo 'style="display:none;"';}} ?> <?php if($this->uri->segment(3)=="backup"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("admin/settings/backup");?>">Backup</a>
                                </li>
                                <li <?php if(isset($this->session->userdata['user_login'])){ if(!in_array('third_party_tools', $permissions)){echo 'style="display:none;"';}} ?> <?php if($this->uri->segment(3)=="third_party_tools"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("admin/third_party_tools");?>">Third parts tools</a>
                                </li>
                            </ul>
                        </li> 
                      
                    </ul>
                </nav>
            </div>
        </div>