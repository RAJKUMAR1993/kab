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
                <?php echo $this->session->userdata('speaker_name');?>
                <span> (Speaker)</span>
            </div>
                <nav id="leftsidebar-nav" class="sidebar-nav">
                    <ul id="main-menu" class="metismenu <?php if($this->uri->segment(2)=="course"){echo "active";}?>" >
                        <!-- <li class="heading">Main</li> -->
                        <li <?php if($this->uri->segment(2)=="dashboard"){echo 'class="active"';}?>>
                            <a href="<?php echo base_url("speaker/dashboard");?>"><i class="icon-home"></i><span>Dashboard</span></a>
                        </li>
                     
                        <li class="middle <?php if($this->uri->segment(2)=="sessions"){echo "active";}?>">
                            <a href="<?php echo base_url("speaker/sessions");?>"><i class="fa fa-list"></i><span>Sessions</span></a>
                        </li>
                        
                        <li class="middle <?php if($this->uri->segment(2)=="meetings"){echo "active";}?>">
                            <a href="#uiElements" class="has-arrow"><i class="fa fa-list"></i><span>My Event Schedule</span></a>
                            <ul>
                                <li <?php if($this->uri->segment(2)=="meetings"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("speaker/meetings");?>">Booked Sessions</a>
                                </li>
                               
                            </ul>
                        </li>
                        
                        <li <?php if($this->uri->segment(2)=="calender"){echo 'class="active"';}?>>
                            <a href="<?php echo base_url("speaker/calender");?>"><i class="icon-calendar"></i><span>My Calendar</span></a>
                        </li>
						<li <?php if($this->uri->segment(2)=="enquiries"){echo 'class="active"';}?>>
                            <a href="<?php echo base_url("speaker/enquiries");?>"><i class="icon-pencil"></i><span>Enquiries</span></a>
                        </li>
						<li <?php if($this->uri->segment(2)=="reports"){echo 'class="active"';}?>>
                            <a href="<?php echo base_url("speaker/reports");?>"><i class="fa fa-list"></i><span>Reports</span></a>
                        </li>
                        <li class="middle <?php if($this->uri->segment(2)=="payments"){echo "active";}?>">
                            <a href="<?php echo base_url("speaker/payments");?>"><i class="fa fa-rupee"></i><span>Payments History</span></a>
                        </li>
                        <li class="middle <?php if($this->uri->segment(2)=="settings"){echo "active";}?>">
                            <a href="#uiElements" class="has-arrow"><i class="fa fa-wrench"></i><span>Settings</span></a>
                            <ul>
                                <li <?php if($this->uri->segment(3)=="basic"){echo 'class="active"';}?>>
                                    <a href="<?php echo base_url("speaker/settings/basic");?>">Basic Details</a>
                                </li>
                              
                            </ul>
                        </li>

                    </ul>
                </nav>
            </div>
        </div>