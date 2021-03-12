 <nav class="navbar navbar-fixed-top">
            <div class="container-fluid">
    
                <div class="navbar-brand">
                    <a href="<?php echo base_url("student/dashboard");?>">
                        <img src="<?php echo base_url();?>assets/images/svg.png" alt="KAB Education Fair ONLINE" class="img-responsive logo">
                        <span class="name">KABEFO</span>
                    </a>
                </div>
                
                <div class="navbar-right">
                    <ul class="list-unstyled clearfix mb-0">
                        <li>
                            <div class="navbar-btn btn-toggle-show">
                                <button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu fa fa-bars"></i></button>
                            </div>                        
                            <a href="javascript:void(0);" class="btn-toggle-fullwidth btn-toggle-hide"><i class="fa fa-bars"></i></a>
                        </li>
                        <li>
                           <!--  <form id="navbar-search" class="navbar-form search-form">
                                <input value="" class="form-control" placeholder="Search here..." type="text">
                                <button type="button" class="btn btn-default"><i class="icon-magnifier"></i></button>
                            </form> -->
                        </li>
                        <li>
                            <div id="navbar-menu">
                                <ul class="nav navbar-nav">
                                  <!--   <li>
                                        <a href="javascript:void(0);" class="mega_menu icon-menu" title="Mega Menu">Mega</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="create_new icon-menu" title="Create New">Create New</a>
                                    </li> -->
                                    <!-- <li class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                                            <i class="icon-bell"></i>
                                            <span class="notification-dot"></span>
                                        </a>
                                        <ul class="dropdown-menu animated bounceIn notifications">
                                            <li class="header"><strong>You have 4 new Notifications</strong></li>
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <i class="icon-info text-warning"></i>
                                                        </div>
                                                        <div class="media-body">
                                                            <p class="text">Campaign <strong>Holiday Sale</strong> is nearly reach budget limit.</p>
                                                            <span class="timestamp">10:00 AM Today</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>                               
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <i class="icon-like text-success"></i>
                                                        </div>
                                                        <div class="media-body">
                                                            <p class="text">Your New Campaign <strong>Holiday Sale</strong> is approved.</p>
                                                            <span class="timestamp">11:30 AM Today</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <i class="icon-pie-chart text-info"></i>
                                                        </div>
                                                        <div class="media-body">
                                                            <p class="text">Website visits from Twitter is 27% higher than last week.</p>
                                                            <span class="timestamp">04:00 PM Today</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <i class="icon-info text-danger"></i>
                                                        </div>
                                                        <div class="media-body">
                                                            <p class="text">Error on website analytics configurations</p>
                                                            <span class="timestamp">Yesterday</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="footer"><a href="javascript:void(0);" class="more">See all notifications</a></li>
                                        </ul>
                                    </li> -->
                                   <!--  <li class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown"><i class="icon-flag"></i><span class="notification-dot"></span></a>
                                        <ul class="dropdown-menu animated bounceIn task">
                                            <li class="header"><strong>Project</strong></li>
                                            <li class="body">
                                                <ul class="menu tasks list-unstyled">
                                                    <li>
                                                        <a href="javascript:void(0);">
                                                            <span class="text-muted">Clockwork Orange <span class="float-right">29%</span></span>
                                                            <div class="progress">
                                                                <div class="progress-bar l-turquoise" role="progressbar" aria-valuenow="29" aria-valuemin="0" aria-valuemax="100" style="width: 29%;"></div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">
                                                            <span class="text-muted">Blazing Saddles <span class="float-right">78%</span></span>
                                                            <div class="progress">
                                                                <div class="progress-bar l-slategray" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" style="width: 78%;"></div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">
                                                            <span class="text-muted">Project Archimedes <span class="float-right">45%</span></span>
                                                            <div class="progress">
                                                                <div class="progress-bar l-parpl" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%;"></div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">
                                                            <span class="text-muted">Eisenhower X <span class="float-right">68%</span></span>
                                                            <div class="progress">
                                                                <div class="progress-bar l-coral" role="progressbar" aria-valuenow="68" aria-valuemin="0" aria-valuemax="100" style="width: 68%;"></div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">
                                                            <span class="text-muted">Oreo Admin Templates <span class="float-right">21%</span></span>
                                                            <div class="progress">
                                                                <div class="progress-bar l-amber" role="progressbar" aria-valuenow="21" aria-valuemin="0" aria-valuemax="100" style="width: 21%;"></div>
                                                            </div>
                                                        </a>
                                                    </li>                        
                                                </ul>
                                            </li>
                                            <li class="footer"><a href="javascript:void(0);">View All</a></li>
                                        </ul>
                                    </li> -->
                                   <!--  <li class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown"><i class="fa fa-language"></i></a>
                                        <ul class="dropdown-menu animated flipInX choose_language">                                        
                                            <li><a href="javascript:void(0);">English</a></li>
                                            <li><a href="javascript:void(0);">French</a></li>
                                            <li><a href="javascript:void(0);">Spanish</a></li>
                                            <li><a href="javascript:void(0);">Portuguese</a></li>
                                        </ul>
                                    </li> -->
                                    <li class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                                         <img class="rounded-circle" src="<?php echo base_url();?>assets/images/user-small.png" width="30" alt="">
                                        </a>
                                        <div class="dropdown-menu animated flipInY user-profile">
                                            <div class="d-flex p-3 align-items-center">
                                                <div class="drop-left m-r-10">
                                                    <img src="<?php echo base_url();?>assets/images/user-small.png" class="rounded" width="50" alt="">
                                                </div>
                                                <div class="drop-right">
                                                    <h4><?php echo $this->session->userdata('student_name');?></h4>
                                                    <p class="user-name"><?php echo $this->session->userdata('email');?></p>
                                                </div>
                                            </div>
                                            <div class="m-t-10 p-3 drop-list">
                                                <ul class="list-unstyled">
                                                    <li><a href="<?php echo base_url(); ?>student/settings/basic"><i class="icon-user"></i>My Profile</a></li>
                                                    <!-- <li><a href="app-inbox.html"><i class="icon-envelope-open"></i>Messages</a></li> -->
                                                    <!--<li><a href="#"><i class="icon-settings"></i>Settings</a></li>-->
													<li><a href="<?php echo base_url(); ?>student/settings/changepassword"><i class="icon-key"></i>Change Password</a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="<?php echo base_url("student/login/logout");?>"><i class="icon-power"></i>Logout</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                   <!--  <li>
                                        <a href="javascript:void(0);" class="icon-menu js-right-sidebar"><i class="icon-settings"></i></a>
                                    </li> -->
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    


         <div id="mega_menubar" class="mega_menubar">
                <div class="container">
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="header">
                                    <h2>Subscribe</h2>
                                </div>
                                <div class="body">
                                    <form>
                                        <div class="form-group">
                                            <input type="text" value="" placeholder="Enter Name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" value="" placeholder="Enter Email" class="form-control">
                                        </div>
                                        <button class="btn btn-primary">Subscribe</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="header">
                                    <h2>Accordion</h2>
                                </div>
                                <div class="body">
                                    <ul class="accordion2">
                                        <li class="accordion-item is-active">
                                            <h3 class="accordion-thumb"><span>Lorem ipsum</span></h3>
                                            <p class="accordion-panel">
                                                Lorem ipsum dolor sit amet, elit. Placeat, quibusdam! Voluptate nobis
                                            </p>
                                        </li>
                                        
                                        <li class="accordion-item">
                                            <h3 class="accordion-thumb"><span>Dolor sit amet</span></h3>
                                            <p class="accordion-panel">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing  Voluptate nobis
                                            </p>
                                        </li>
                                    </ul>
        
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="header">
                                    <h2>Company</h2>
                                </div>
                                <div class="body">
                                    <ul class="list-unstyled links">
                                        <li><a href="javascript:void(0);" title="" >Our Facts</a></li>
                                        <li><a href="javascript:void(0);" title="" >Confidentiality</a></li>                                
                                        <li><a href="javascript:void(0);" title="" >About Us</a></li>
                                        <li><a href="javascript:void(0);" title="" >Testimonials</a></li>
                                        <li><a href="javascript:void(0);" title="" >Contact Us</a></li>                                
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="header">
                                    <h2>Image Gallery</h2>
                                </div>
                                <div class="body">
                                    <div class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner" role="listbox">
                                            <div class="carousel-item active">
                                                <img src="<?php echo base_url();?>assets/images/image-gallery/1.jpg" class="img-fluid" alt="img" />
                                            </div>
                                            <div class="carousel-item">
                                                <img src="<?php echo base_url();?>assets/images/image-gallery/2.jpg" class="img-fluid" alt="img" />
                                            </div>
                                            <div class="carousel-item">
                                                <img src="<?php echo base_url();?>assets/images/image-gallery/3.jpg" class="img-fluid" alt="img"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>