<? $this->load->view("front/institutes/header");?>
<nav class="navbar fixed-top bg-yellow  navbar-expand-md">
  <div class="container"> <a class="navbar-brand" href="<? echo base_url().'exhibitors/'.$this->uri->segment(2);?>"> <img src="<? 
  $idata = $this->homepage_model->get_insdetails($this->uri->segment(2));
  
  echo base_url().$idata->logo; ?>" height="51px" alt="image" style="border-right:#011b56 solid 1px;"> </a>
  
  <!-- <h2 class="c-heading"> West Bengal | Kolkata </h2> -->
 
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav3" aria-controls="navbarNav3" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
    <div class="collapse navbar-collapse" id="navbarNav3">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item "> <a class="nav-link " href="<? echo base_url().'exhibitors/'.$this->uri->segment(2).'/video' ?>"> Video Gallery</a> </li>
        <li class="nav-item"> <a class="nav-link" href="<? echo base_url().'exhibitors/'.$this->uri->segment(2).'/gallery' ?>">Photo Gallery </a> </li>
        <li class="nav-item"> <a class="nav-link" href="<? echo base_url().'exhibitors/'.$this->uri->segment(2).'/programmefee' ?>">Programme Fees</a> </li>
        <li class="nav-item"> <a class="nav-link" href="<? echo base_url().'exhibitors/'.$this->uri->segment(2).'/placements' ?>"> Placements </a> </li>
        <li class="nav-item"> <a class="nav-link" href="<? echo base_url().'exhibitors/'.$this->uri->segment(2).'/achievements' ?>"> Achivements </a> </li>
        <li class="nav-item"> <a class="nav-link" href="<? echo base_url().'exhibitors/'.$this->uri->segment(2).'/admission' ?>">Admission 2020</a> </li>
        <li>
          <div class="btn-group show-on-hover">
            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
              <? echo $this->session->userdata("student_name"); ?> <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
              <li><a href="<? echo base_url().'student/dashboard'?>">Dashboard</a></li>
              <li><a href="<? echo base_url('student/login/logout')?>">Logout</a></li>
              
            </ul>
          </div>
        </li>
      </ul>
     
    </div>
  </div>
</nav>
<section class="our-webcoderskull ">
  <div class="container">
  <h1> Placements </h1><br/>
  <div class="row">
<div class="col-md-6">
<h5>Placement Statistics</h5>

<!--<p>Placement details in the academic year  2019-20 (Company Wise)</p>
-->
<div class="table-responsive-sm box1"><table border="0" cellspacing="0" cellpadding="0" class="table1">
            <tbody><tr class="highlight">
              <th>COMPANY NAME</th>
              <th>NO OF STUDENTS PLACED</th>
              <th>SALARY/ANNUM</th>
            </tr>
            <tr>
            	<td>CAPGEMINI</td>
            	<td>22</td>
            	<td>4.0 lakhs</td>
            </tr>
            <tr>
            	<td>TATA CONSULTANCY SERVICES</td>
            	<td>07</td>
            	<td>3.33 lakhs</td>
            </tr>
            <tr class="even">
            	<td>HEXAWARE TECHNOLOGIES BPS</td>
            	<td>42</td>
            	<td>1.46 lakhs</td>
            </tr>
            <tr>
            	<td>VISIONARY RCM</td>
            	<td>07</td>
            	<td>1.5 lakhs</td>
            </tr>
            <tr class="even">
            	<td>AMAZON</td>
            	<td>08</td>
            	<td>1.62 lakhs</td>
            </tr>
            <tr>
            	<td>TECH MAHINDRA BPS</td>
            	<td>71</td>
            	<td>1.6 lakhs</td>
            </tr>
            
           
           
          </tbody></table></div>
</div>

<div class="col-md-6">
<h5>Students Placement</h5>
<div class="download">
			    <div class="square"><a href="pdf/placement/PLACEMENT-2019-2020.pdf" target="_blank" class="yy">Placed Students List 2019-2020 Batch</a></div>
            <div class="square"><a href="pdf/placement/consolidated_2005-2011.pdf" target="_blank" class="xx">Consolidated Details of placement 2005-2014 Batch</a></div>
            <div class="square"><a href="pdf/placement/placed-2006-2010.pdf" target="_blank" class="yy">Placed - selected list -2006-2010 Batch</a></div>
            <div class="square"><a href="pdf/placement/placed-2007-2011.pdf" target="_blank" class="xx">Placed - selected list -2007-2011 Batch</a></div>
            <div class="square"><a href="pdf/placement/placed-2008-2012.pdf" target="_blank" class="yy">Placed Students in 2008-2012 Batch</a></div>
            <div class="square"><a href="pdf/placement/placed_2009-2013.pdf" target="_blank" class="xx">Placed Students List 2009-2013 Batch</a></div>
            <div class="square"><a href="pdf/placement/placed2010-2014.pdf" target="_blank" class="yy">Placed Students List 2010-2014 Batch</a></div>
             <div class="square"><a href="pdf/placement/placed_2009-2013.pdf" target="_blank" class="xx">Placed Students List 2009-2013 Batch</a></div>
            <div class="square"><a href="pdf/placement/placed2010-2014.pdf" target="_blank" class="yy">Placed Students List 2010-2014 Batch</a></div>
            
            <div class="square"><a href="pdf/placement/placed2010-2014.pdf" target="_blank" class="xx">Placed Students List 2010-2014 Batch</a></div>
             <div class="square"><a href="pdf/placement/placed_2009-2013.pdf" target="_blank" class="yy">Placed Students List 2009-2013 Batch</a></div>
            <div class="square"><a href="pdf/placement/placed2010-2014.pdf" target="_blank" class="xx">Placed Students List 2010-2014 Batch</a></div>
          </div>


</div>

 
  </div>
  
  </div>
</section>	
<section class="footer">
            <div class="g-bg-dark">
                <div class="container g-pt-70 g-pb-40">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 g-mb-30">
                            <h3 class="h6 g-color-white text-uppercase">Head Office</h3>
              <h4 class="g-color-text g-font-size-11 text-left text-uppercase" style="color: #a09c9c !important;">Address</h4>
                            <address class="g-font-size-13 g-color-gray-dark-v3 g-font-weight-600 g-line-height-2 mb-0" style="color: #fff !important;">
                               <? echo $idata->address ?>
                            </address>
              
                            <h4 class="g-color-text g-font-size-11 text-left text-uppercase" style="color: #a09c9c !important;">Email</h4>
                            <a href="#" class="text-white"><? echo $idata->email ?></a> <br>
                            
                            <h4 class="g-color-text g-font-size-11 text-left text-uppercase" style="color: #a09c9c !important;">Phone</h4>
                            <address class="g-font-size-13 g-color-gray-dark-v3 g-font-weight-600 g-line-height-2 mb-0" style="color: #fff !important;">
                             <? echo $idata->phone ?><br>
                             
                            </address>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 g-mb-30">
                            <h3 class="h6 g-color-white text-uppercase">Admission Helpline </h3>
              <h4 class="g-color-text g-font-size-11 text-left text-uppercase" style="color: #a09c9c !important;">Phone</h4>
                            <address class="g-font-size-13 g-color-gray-dark-v3 g-font-weight-600 g-line-height-2 mb-0" style="color: #fff !important;">
                             <? echo $idata->phone ?><br>
                             
                            </address>
                            <h4 class="g-color-text g-font-size-11 text-left text-uppercase" style="color: #a09c9c !important;">Email</h4>
                            <a href="#" class="text-white"><? echo $idata->email ?> </a> <br>
                   
                            
                            
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 g-mb-30">
                             <h3 class="h6 g-color-white text-uppercase">Social Network</h3>
                                   
               <ul class="social">
                                <li class="image"><a href="#" target="blank"><img src="<?php echo base_url();?>assets/images/front/facebook.jpg" class=" image img-circle" width="25px;" alt="KAB" title="KAB"></a></li>
                                <li class="image"><a href="#" target="blank"><img src="<?php echo base_url();?>assets/images/front/twitter.jpg" class="img-circle" width="25px;" alt="KAB" title="KAB"></a></li>
                                <li class="image"><a href="#" target="blank"><img src="<?php echo base_url();?>assets/images/front/linkedin.jpg" class="img-circle" width="25px;" alt="KAB" title="KAB"></a></li>
                                <li class="image"><a href="#" target="blank"><img src="<?php echo base_url();?>assets/images/front/youtube.jpg" class="img-circle" width="25px;" alt="KAB" title="KAB"></a></li>
                         </ul>
                        </div>

                    </div>
                </div>
            </div>

            <div class="g-bg-dark-light-v1">
                <div class="container g-pt-30">
                    <div class="row align-items-center">
                        <div class="col-md-12 text-center g-mb-30">
                            <p class="d-inline-block align-middle g-font-size-13 mb-0 g-color-white">
                                © <? echo date('Y');?> <? echo $idata->institute_name; ?>. All Rights Reserved.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>



<? $this->load->view("front/institutes/footer");?>