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
                                <a href="<?php echo base_url('student/meetings/expertmeetings');?>?ref=upcoming">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="fa fa-2x fa-handshake-o text-col-blue" style="font-size:25px;"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>Counsellor Meetings (Upcoming)</h6>
                                            <span class="font700"><?php echo $upcomingcounsellors;?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-blue mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="87"></div>
                                    </div>
                                </div>
                                </a>
                            </div>
                            
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <a href="<?php echo base_url('student/meetings');?>?ref=upcoming">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="fa fa-2x fa-handshake-o  text-col-green"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>Professor Meetings (Upcoming)</h6>
                                            <span class="font700"><?php echo $upcomingpromeetings; ?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-green mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="28"></div>
                                    </div>
                                   
                                </div>
                                </a>
                            </div>
                             <div class="col-lg-4 col-md-6 col-sm-6">
                                <a href="<?php echo base_url('student/meetings/auditorium_presentations');?>?ref=upcoming">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="fa fa-2x fa-desktop text-col-red"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>College Presentations (Upcoming)</h6>
                                            <span class="font700"><?php echo $upcomingpresentations;?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-red mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="41"></div>
                                    </div>
                                  
                                </div>
                                </a>
                            </div> 
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <a href="<?php echo base_url('student/enquiries');?>?status=Replied">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="fa fa-2x fa-question text-col-green"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>Enquiry Replies Received</h6>
                                            <span class="font700"><?php echo $enquiriesreplied;?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-green mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="41"></div>
                                    </div>
                                  
                                </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <a href="<?php echo base_url('student/myapplications/admissions');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="fa fa-2x fa-graduation-cap text-col-red"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>Applications</h6>
                                            <span class="font700"><?php echo $applications;?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-red mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="41"></div>
                                    </div>
                                  
                                </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <a href="<?php echo base_url('student/dashboard/event_bag');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="fa fa-2x fa-shopping-bag text-col-blue"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>Event Bag</h6>
                                            <span class="font700"><?php echo $event_bag;?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-blue mb-0 mt-3">
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

                  
</div>