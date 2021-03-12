 <nav class="navbar navbar-fixed-top">
            <div class="container-fluid">
    
                <div class="navbar-brand">
                    <a href="<?php echo base_url("expert/dashboard");?>">
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
                        
                        </li>
                        <li>
                            <div id="navbar-menu">
                                <ul class="nav navbar-nav">
                                  
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
                                                    <h4><?php echo $this->session->userdata('expert_name');?></h4>
                                                    <p class="user-name"><?php echo $this->session->userdata('email');?></p>
                                                </div>
                                            </div>
                                            <div class="m-t-10 p-3 drop-list">
                                                <ul class="list-unstyled">
                                                    <li><a href="#"><i class="icon-user"></i>My Profile</a></li>
                                                    
                                                    <li><a href="#"><i class="icon-settings"></i>Settings</a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="<?php echo base_url("expert/login/logout");?>"><i class="icon-power"></i>Logout</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
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