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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js"></script>
<style>.portfolio-menu{
  text-align:center;
}
.portfolio-menu ul li{
  display:inline-block;
  margin:0;
  list-style:none;
  padding:10px 15px;
  cursor:pointer;
  -webkit-transition:all 05s ease;
  -moz-transition:all 05s ease;
  -ms-transition:all 05s ease;
  -o-transition:all 05s ease;
  transition:all .5s ease;
}

.portfolio-item{
  /*width:100%;*/
}
.portfolio-item .item{
  /*width:303px;*/
  float:left;
  margin-bottom:10px;
}
</style>
<section class="our-webcoderskull ">
  <div class="container text-center">
  <h1>Photo Gallery</h1>
    
    
    <br/>
    
 
        <? if($gdata){ 
          $gallery = array();
          ?>  
         <div class="portfolio-menu mt-2 mb-4">
            <ul>

               <li class="btn btn-outline-dark active" data-filter="*">All</li>
               <? foreach($gdata as $row){ ?>
                <?  array_push($gallery,$this->institute_model->get_institute_gallery($row->title_id));?>
               <li class="btn btn-outline-dark" data-filter=".gts<? echo $row->title_id; ?>"> <? echo $row->gallery_title; ?></li>
             <? } ?>
            </ul>
         </div>
         <div class="portfolio-item row">

       <?  if($gallery){
        //print_r($gallery);
        $key = 1;
            foreach ($gallery as $key=>$row2) { ?>
             <div class="item gts<? echo $row2[$key]->title_id; ?> col-lg-3 col-md-4 col-6 col-sm">
               <a href="<? echo base_url('assets/images/gallery/').$row2[$key]->images; ?>" class="fancylight popup-btn" data-fancybox-group="light"> 
               <img class="img-fluid" src="<? echo base_url('assets/images/gallery/').$row2[$key]->images; ?>" alt="">
               </a>
            </div>
        <?  $key++;  } } ?>
            
         </div>
        <? } ?>
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
<script>
         $('.portfolio-menu ul li').click(function(){
          $('.portfolio-menu ul li').removeClass('active');
          $(this).addClass('active');
          
          var selector = $(this).attr('data-filter');
          $('.portfolio-item').isotope({
            filter:selector
          });
          return  false;
         });
         $(document).ready(function() {
         var popup_btn = $('.popup-btn');
         popup_btn.magnificPopup({
         type : 'image',
         gallery : {
          enabled : true
         }
         });
         });</script>