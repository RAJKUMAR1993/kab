<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view("front/includes/new_header");
$bgfiles = $this->db->order_by('id', 'desc')->get_where("tbl_bgvideo",["status"=>"Active"])->result();

?>
 
 
<!--  <link href="<?php echo base_url(); ?>/assets/template.css?1600450516" rel="stylesheet"> -->
 <script src="https://kit.fontawesome.com/b31e06099e.js" crossorigin="anonymous"></script>
 
<link href="<? echo base_url('assets/ninja/') ?>ninja-slider.css" rel="stylesheet" type="text/css" />
<!--ninjaVideoPlugin.js is required only when the slider contains video or audio.--> 
<script src="<? echo base_url('assets/ninja/') ?>ninjaVideoPlugin.js"></script> 
<script src="<? echo base_url('assets/ninja/') ?>ninja-slider.js" type="text/javascript"></script>

 <style>
 .call_section_custom {
  background: url(<?php echo base_url();?>assets/udema/img/background.jpeg) center center no-repeat fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  min-height: 400px;
  padding: 10% 0;
}

#slide_video div {
    vertical-align: middle;
    text-align: center;
  
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	z-index: 9999999;
}
#slide_video h3 {
    color: #fff;
    font-size: 52px;
    font-size: 3.25rem;
    margin: 0;
    text-transform: uppercase;
    font-weight: 800;
}	
#slide_video p {
    font-weight: 300;
    margin: 10px 0 0 0;
    padding: 0;
    font-size: 24px;
    font-size: 1.5rem;
    line-height: 1.4;
}
#slide_video {
    position: relative;
    background-size: cover;
    color: #fff;
    width: 100%;
    font-size: 16px;
    font-size: 1rem;
    display: table;
    height: 100%;
    z-index: 99;
    text-align: center;
}	 
 .overlay{
	 position:absolute !important;
	 background: rgba(0, 0, 0, 0.5); 
	 z-index: 9;
	 width: 100%;
	 height: 100%
 }
	 
.bs-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.55);
}	 
	 
 </style>
 

 
 
 
 
 
	<main>
	    
		<!--<section class="header-video">
			<div id="hero_video" style="position:absolute !important;background: rgba(0, 0, 0, 0.5);">
				<div>
					<h3><strong>TOP INSTITUTES</strong><br>IN KAB FAIR</h3>
					<p>In times of social distancing,our VIRTUAL FAIR will help you to enroll REAL students.</p>
				</div>
				<a href="#first_section" class="btn_explore hidden_tablet"><i class="ti-arrow-down"></i></a>
			</div>
			<img src="<?php //echo base_url();?>assets/udema/img/video_fix.png" alt="" class="header-video--media" data-video-src="<?php //echo base_url('assets/udema/video/').$bgvideo; ?>" data-teaser-source="<?php //echo base_url('assets/udema/video/').$bgvideo;?>" data-provider="" data-video-width="1920" data-video-height="960">
		</section>-->
		<!-- /header-video -->

	<? if(count($bgfiles) > 0){ ?>
		<!-- Slider -->
		
		<div id='ninja-slider' >
	  		
		  <div class="slider-inner">
		  
		   
		  
			<ul >
		  	<? foreach($bgfiles as $bg){ 
				if($bg->type == "image"){
				?>
		  
		  			<li id="slide_video">
		  				
		  				<a class="ns-img img-fluid" href="<? echo base_url().$bg->file ?>"></a>
		  				<div class="bs-overlay"></div>
						<div>
							<h3><strong>TOP INSTITUTES</strong><br>IN KAB FAIR</h3>
							<p>In times of social distancing,our VIRTUAL FAIR will help you to enroll REAL students.</p>
						</div>
						
		  			</li>
		  			
		  	<? }else{ ?>		
		  	
		  		  <li id="slide_video">
		  		  
					<div class="video" >
					  <video data-autoplay="true"  muted width="100%">
						<source src="<? echo base_url().$bg->file ?>" type="video/mp4" />
						</source>
					  </video>
					</div>
					<div class="bs-overlay"></div>
					<div>
						<h3><strong>TOP INSTITUTES</strong><br>IN KAB FAIR</h3>
						<p>In times of social distancing,our VIRTUAL FAIR will help you to enroll REAL students.</p>
					</div>
				  </li>
		   
		  	<? }} ?>
				  
			  
			</ul>
		  <!--  <div class="fs-icon"></div>-->
		  </div>
		</div>
		
		<!-- End layerslider -->
	<? } ?>


<?
	if($news){

?>		
				
		<div class="news-scroll">
			<div class="container">
			<div class="row">
				<div class="col-md-2 col-sm-2 col-xs-12 news-scroll-left pull-right">News Updates</div>
				<div class="col-md-10 col-sm-10 col-xs-12">

					<div class="news-scroll-right">
						<div class="simple-marquee-container scr1">

							<div class="marquee">
								<ul class="marquee-content-items">

									<?php   
		        foreach ($news as $t) {

			  ?>
									<li>
										<a href="<?php echo base_url('detail/').$t->news_id.'/view' ?>" style="color: black">
											<? echo $t->title ?>
										</a>
									</li>

									<?php } ?>
								</ul>
							</div>
						</div>

					</div>

				</div>
			</div>
		</div>		
</div>
<? } ?>


			<ul id="grid_home" class="clearfix">
		
		<? $blocks = $this->db->order_by("id","desc")->get_where("tbl_card_blocks")->result();
			foreach($blocks as $b){
				if($b->status == 1){

				
			?>
			<li>
				<a class="img_container" style="height: 210px;">
					<!--<img src="http://via.placeholder.com/600x400/ccc/fff/grid_home_1.jpg" alt="">-->
					<div class="short_info" style="background-color: <? echo $b->color ?>;">
						<i class="<? echo $b->icon ?>" style="font-size: 40px;margin-bottom: 25px;"></i>
						<h3><strong><? echo $b->bold_text ?></strong><? echo $b->message ?></h3>
<!--						<div><span class="btn_1 rounded">Joining</span></div>-->
					</div>
				</a>
			</li>
			
		<? }} ?>	
		</ul>
		<!--/grid_home -->
		

		<div class="container-fluid" style="margin-top: 60px" id="first_section">
			<div class="main_title_2">
				<span><em></em></span>
				<h2>The Event</h2>
				<p>KAB Virtual Education Fair-2020.</p>
			</div>
			<div id="reccomended" class="owl-carousel owl-theme">
				<div class="item">
					<div class="box_grid">
						<figure>
<!--							<a href="#0" class="wish_bt"></a>-->
							<a href="#"><img src="<?php echo base_url();?>assets/udema/img/VC-1.png" class="img-fluid" alt=""></a>
						</figure>
						<div class="wrapper">
							<h3>College Connect</h3>
							<p>Change to intract with university/ college admission officer / Representative via chat, videocall, Telephone</p>
						</div>
						<ul>
							<li><!--<i class="icon_like"></i> 890--></li>
							<!--<li><a href="<? echo base_url('exhibitors') ?>">Live Interaction</a></li>-->
						</ul>
					</div>
				</div>
				<!-- /item -->
				<div class="item">
					<div class="box_grid">
						<figure>
<!--							<a href="#0" class="wish_bt"></a>-->
							<a href="#"><img src="<?php echo base_url();?>assets/udema/img/VC-2.png" class="img-fluid" alt=""></a>
						</figure>
						<div class="wrapper">
							<h3>High Impact Seminars</h3>
							<p>Most experienced Academic Administrators / Vice Chancellors / Director / Principals and Senior level IT Industries Professionals, Guidance experts presents plethora of Career options, via webcasting's advisers on career planning.</p>
						</div>
						<ul>
							<li><!--<i class="icon_like"></i> 890--></li>
							<!--<li><a href="<? echo base_url('eventschedule') ?>">Book Your slot</a></li>-->
						</ul>
					</div>
				</div>
				<!-- /item -->
				<div class="item">
					<div class="box_grid">
						<figure>
<!--							<a href="#0" class="wish_bt"></a>-->
							<a href="#"><img src="<?php echo base_url();?>assets/udema/img/VC-3.png" class="img-fluid" alt=""></a>
						</figure>
						<div class="wrapper">
							<h3>Talk to Professor</h3>
							<p>Knowledge showing session/ webinars form eminent Professors from Institutions of national repute give guidance & academic Insights regarding courses career prospects expelled programme outcomes, research areas etc.</p>
						</div>
						<ul>
							<li><!--<i class="icon_like"></i> 890--></li>
							<!-- <li><a href="<? echo base_url('professor') ?>">Learn More</a></li> -->
							<!--<li><a href="<? echo base_url('front/webinars/proffesors') ?>">Learn More</a></li>-->
						</ul>
					</div>
				</div>
			</div>
			<!-- /carousel -->
		</div>
		<!-- /container -->


	<? 
		$categories = $this->db->query("SELECT * from tbl_categories WHERE status='Active' and live_status='Active' and is_deleted=0 order by sort asc")->result(); 
		if(count($categories) > 0){
	?>

		<div class="container">
			<div class="main_title_2">
				<span><em></em></span>
				<h2>Exhibitor Profiles</h2>
			</div>
			<div class="row">
			
			<? foreach($categories as $category){ 
		
				$inscount = $this->db->get_where("tbl_institutes",["category_id"=>$category->category_id,"live_status"=>1,"is_deleted"=>0])->num_rows();
					
			   echo "<form style='display:none;' action='".base_url()."front/institutes/list' method='POST' class='getInstitutes_".$category->category_id."'><input type='number' name='category_id' value='".$category->category_id."'/></form>";
		
				?>
			
				<div class="col-lg-4 col-md-6 wow" data-wow-offset="150">
					<a href="#" onclick='submitForm(<? echo $category->category_id ?>)' class="grid_item">
						<figure class="block-reveal">
							<div class="block-horizzontal"></div>
							<img src="<?php echo base_url().$category->image; ?>" class="img-fluid" alt="">
							<div class="info">
								<small><i class="ti-layers"></i><? echo $inscount ?> Institutes</small>
								<h3><? echo $category->category_name ?></h3>
							</div>
						</figure>
					</a>
				</div>
				
			<? } ?>	
				<!-- /grid_item -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
<? } ?>		
		
		<div class="bg_color_1">
        <div class="container">
        
        	<div class="main_title_2">
				<span><em></em></span>
				<h2>Students.! Why to attend?</h2>
			</div>
			<div class="row">
				
				<div class="col-lg-8" id="faq">
					<div role="tablist" class="add_bottom_45 accordion_2" id="payment">
						<?php  $points = $this->db->get_where("tbl_bullet_points",["type"=>"bullet"])->result();
						foreach ($points as $b) {  
						?>
						<div class="card">
							<div class="card-header" role="tab">
								<h5 class="mb-0" style="color: white">
									<img src="<?php echo base_url();?>assets/animatedgifs/bullet.png" width="18px" height="15px">&nbsp;&nbsp;&nbsp;<?php echo $b->point; ?>
								</h5>
							</div>

							<div id="collapseOne_payment" class="collapse" role="tabpanel" data-parent="#payment">
								<div class="card-body">
								</div>
							</div>
						</div>
						<?php }?>
					</div>
					<!-- /accordion payment -->
				</div>
				<div class="col-lg-4 text-center">
					<?php  $images = $this->db->get_where("tbl_bullet_points",["type"=>"image"])->row(); ?>

						<img src="<?php echo base_url() .$images->point ?>" class="img-fluid"><br><br>
						<h4>FREE REGISTRATION</h4>
					  <a href="<? echo base_url()?>student/registration"><button class="btn btn-primary" style="cursor: pointer;"> Register </button></a>
				</div>
				<!-- /col -->
			</div>
		</div>
	</div>
						<!-- <div class="bg_color_1 webinarSchedule" id="webinarSchedule">
							<div class="container">
									<div class="main_title_2">
										<span><em></em></span>
										<h2>Webinar Schedule</h2>
									</div>
									<?php
									if(count($webinor_dates)>0){
									?>
									  	<ul class="nav nav-pills">
										  <?php
											$i = 1;
											foreach ($webinor_dates as $webinor_date) {
											?>
											  <li class="nav-item custom_nav_item" style="background-color: red;">
												<a class="nav-link <?php if($i==1){echo 'active';}?>" data-toggle="pill" href="#<?php echo 'webinor_'.$webinor_date->id;?>">
													<h4 style="color:#fff">Day <?php echo $i++;?></h4>
													<h6 style="color:#fff"><?php echo date("d-M-Y", strtotime($webinor_date->date));?></h6>
												</a>
											  </li>
											<?php
											}
											?>
										</ul>

										<div class="tab-content" style="border:1px solid indigo;padding-top:15px">
										  <?php
										$datetime = date("Y-m-d H:i:s");
										$timetoseconds = strtotime($datetime);
										$i = 1;
										foreach ($webinor_dates as $webinor_date) {
											$webinors = $this->db->select("tbl_webinors.*, tbl_professors.pro_name as professor_name, tbl_professors.pro_image")->join("tbl_professors", "tbl_professors.pro_id = tbl_webinors.professor_id", "left")->where("tbl_webinors.date =", $webinor_date->date)->where("tbl_webinors.to_time >= ".$timetoseconds)->get("tbl_webinors")->result();
										?>
										  <div class="tab-pane container <?php if($i==1){echo 'active';}?>" id="<?php echo 'webinor_'.$webinor_date->id;?>">
											  
											<div class="row">
												<?php
												$i = 1;
												foreach ($webinors as $webinor) {
													$image = base_url()."/assets/images/user.png";
													if($webinor->pro_image!=''){
														$image = base_url()."assets/images/professors/".$webinor->pro_image;
													}
												?>
												<div class="col-lg-6 col-xs-12 col-sm-12">
													<div class="box_teacher" style="padding:10px;">
														<div class="row">
															<div class="col-3">
																<img src="<?php echo $image;?>" width="100%">
															</div>
															<div class="col-9">
																<h5 style="margin-top:0px;"><i class="ti-user"></i> <?php echo $webinor->professor_name;?></h5>
																<h6><?php echo $webinor->title;?></h6>
																<h6 style="color:green"><?php echo date('H:i A', $webinor->from_time);?> - <?php echo date('H:i A', $webinor->to_time);?></h6>
																<h5><a <?php if($this->session->userdata("student_id")){ ?> onclick="getDetails('<?php echo $webinor->id;?>', '<?php echo $webinor->professor_id;?>')" class="btn btn-warning" <?php } else{ ?> class="btn btn-warning modalloginnext" href="javascript:void(0)" data-toggle="modal" data-target="#myModalLoginNow"<?php }?>>Participate</a></h5>
															</div>
														</div>
													</div>  
												</div>
												<?php
												}
												?>
											</div>
											
										  </div>
										<?php
										$i++;
										}
										?>
											<div class="row" style="padding-left:15px">
												<div class="col-md-6 moblie_p_info" id="30_min_session" style="display: none;">
													<form id="webinarpart">
														<input type="hidden" name="webinar_id" id="webinar_id">
														<input type="hidden" name="professor_id" id="professor_id">
							                              <div class="form-group">
							                                 <button class="btn btn-danger round_btns confirm_participation">Confirm Participation</button>
							                                 <button class="btn btn-info cancelButton" type="button">Cancel</button>
							                              </div>
						                          	</form>
					                        	</div>
											</div>
										</div>
									<?php
									}
									else{
										echo '<div class="tab-content" style="border:1px solid indigo;padding-top:15px"><h5 style="text-align:center;color:red;">No Webinars found.</h5></div>';
									}
									?>
							</div>
						</div> -->
		<div class="bg_color_1">
			<div class="container" style="padding-top:50px">
				<div class="main_title_2">
					<span><em></em></span>
					<h2>News and Events</h2>
				</div>
				<?
					if($news){
						//print_r($news);
					
				?>
				<div class="row">
					<? foreach($news as $ne) { ?>
					<div class="col-lg-6">
						<a class="box_news" href="<? echo base_url().'detail/'.$ne->news_id.'/view'; ?>">
							<figure><img src="<? if($ne->image){ echo base_url().$ne->image; } else { echo base_url().'assets/news/detault.jpg'; }?>" alt="">
								<figcaption><strong><? echo date('d',strtotime($ne->created_date)); ?></strong><? echo date('M',strtotime($ne->created_date)); ?></figcaption>
							</figure>
							<ul>
								<li><? echo $ne->createdby; ?></li>
								<li><? echo date('d.m.Y',strtotime($ne->created_date)); ?></li>
							</ul>
							<h4><? echo $ne->title; ?></h4>
							<p><? echo  substr($ne->message,0, 160); ?></p>
						</a>
					</div>
				<? } ?>
				
				</div>
			<? } ?>
				<!-- /row -->
				<!-- /row -->
				<p class="btn_home_align"><a href="<? echo base_url();?>newsandevents" class="btn_1 rounded" style="margin-bottom: 10px;">View all news</a></p>
			</div>
			<!-- /container -->
		</div>
		<!-- /bg_color_1 -->
		
		<div class="container">
			<div class="main_title_2">
				<span><em></em></span>
				<h2>Partners & Sponsor</h2>
			</div>
			<div id="carousel" class="owl-carousel owl-theme">
			
				<? $partners = $this->db->get_where("tbl_partners",["is_deleted"=>0])->result(); 
				
				   foreach($partners as $pi){
					   
					   if(file_exists('assets/images/partners/'.$pi->partner_image)){
						   
						   $pimage = base_url().'assets/images/partners/'.$pi->partner_image;
						   
				?>
			
					<div class="item">
						<a href="#0">
							<img src="<? echo $pimage ?>" alt=""><br><br>
							<div class="title">
								<h4><?php echo $pi->name;?></h4>
							</div>
						</a>
					</div>
				
				<? }} ?>
				
			</div>
			<!-- /carousel -->
		</div>

		
		<section>
    <div class="customer-feedback">
        <div class="container text-center">
            <div class="main_title_2">
				<span><em></em></span>
				<h2>Testimonials</h2>
<!--				<p>KAB Virtual Education Fair-2020.</p>-->
			</div>

<style>

	  
</style>         
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="owl-carousel feedback-slider" align="center">

						<? $testimonials = $this->db->get_where("tbl_testimonials",["is_deleted"=>0,"status"=>"Active"])->result(); 
						
						   foreach($testimonials as $te){
							   
							   if(file_exists("assets/images/testimonials/".$te->student_image)){
								   
								   $timage = base_url()."assets/images/testimonials/".$te->student_image;
								   
							   }else{
								   
								   $timage = base_url()."assets/images/user.png";
								   
							   }
						?>
							<!-- slider item -->
							<div class="feedback-slider-item">
								<img src="<? echo $timage ?>" class="center-block img-circle" alt="Customer Feedback" style="width: 150px;height: 150px">
								<h3 class="customer-name"><? echo $te->student_name ?></h3>
								<p><? echo nl2br($te->student_msg) ?></p>

							</div>
							<!-- /slider item -->
                      
                         <? } ?>
                       
                    </div><!-- /End feedback-slider -->

                    <!-- side thumbnail -->
                    <!-- <div class="feedback-slider-thumb hidden-xs">
                        <div class="thumb-prev">
                            <span>
                                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/451270/profile/profile-80.jpg" alt="Customer Feedback">
                            </span>
                        </div>

                        <div class="thumb-next">
                            <span>
                                <img src="https://res.cloudinary.com/hnmqik4yn/image/upload/c_fill,fl_force_strip,h_128,q_100,w_128/v1493982718/ah57hnfnwxkmsciwivve.jpg" alt="Customer Feedback">
                            </span>
                        </div>
                    </div> -->
                    <!-- /side thumbnail -->

                </div><!-- /End col -->
                
                
            </div><!-- /End row -->
        </div><!-- /End container -->
    </div><!-- /End customer-feedback -->
</section>
		
		
		<!--/container-->	





		<div class="call_section_custom">
			<div class="container clearfix">
				<div class="col-lg-5 col-md-6 float-left wow" data-wow-offset="250">
					<div class="block-reveal">
						<div class="block-vertical"></div>
						<div class="box_1">
							<h3>HOW TO BOOK A STALL?</h3>
							<p>Contact KAB Consultants to book a stall. </p>
							<a href="<? echo base_url()?>institute/registration" class="btn_1 rounded">Book a Stall >></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/call_section-->
		
	</main>
	<!-- /main -->
	
<?php $this->load->view("front/includes/new_footer");?>

<style>

	.news-scroll {
    background: #C20;
    min-height: 45px;
}

.news-scroll-right {
    background: #fff /*url(../images/newsbg-right.jpg) right top no-repeat*/;
    line-height: 45px;
    height: 45px;
    font-size: 14px;
    font-weight: 500;
    color: #ffffff;
    text-align: left;
    padding: 0px 0px 0px 13px;
    display: block;
	/*width: 1100px;*/
}
.news-scroll-right:before {
    position: absolute;
    content: "";
    background: url(<? echo base_url('assets/') ?>images/newsbg.png) left top no-repeat;
    height: 45px;
    width: 50px;
    left: 15px;
}
.simple-marquee-container {
    width: 100%;
    /* background: #0e1622; */
    float: left;
    display: inline-block;
    overflow: hidden;
    box-sizing: border-box;
    height: 45px;
    position: relative;
    cursor: pointer;
}
.news-scroll-left {
    background: url(../images/newsbg.png) right top no-repeat;
    line-height: 45px;
    height: 45px;
    font-size: 15px;
    font-weight: 500;
    color: #ffffff;
    text-align: right;
    text-transform: uppercase;
    padding: 2px 0px 0px 0px;
    display: block;
    letter-spacing: 2px;
}
	
.news-scroll-left{ text-align:center!important;}

.news-scroll-right::before {
  background: none!important;  
}	
	
</style>

<link href="<? echo base_url() ?>assets/css/marquee.css" rel="stylesheet">
<link href="<? echo base_url() ?>assets/css/testi.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet">
<script type="text/javascript" src="<? echo base_url() ?>assets/js/marquee.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
	
<script type="text/javascript">
	
jQuery(document).ready(function($) {

    var feedbackSlider = $('.feedback-slider');
    feedbackSlider.owlCarousel({
        items: 1,
        nav: true,
        dots: true,
        autoplay: true,
        loop: true,
        mouseDrag: true,
        touchDrag: true,
        navText: ["<i class='fa fa-long-arrow-left'></i>", "<i class='fa fa-long-arrow-right'></i>"],
        responsive:{

            // breakpoint from 767 up
            767:{
                nav: true,
                dots: false
            }
        }
    });

    feedbackSlider.on("translate.owl.carousel", function(){
        $(".feedback-slider-item h3").removeClass("animated fadeIn").css("opacity", "0");
        $(".feedback-slider-item img, .feedback-slider-thumb img, .customer-rating").removeClass("animated zoomIn").css("opacity", "0");
    });

    feedbackSlider.on("translated.owl.carousel", function(){
        $(".feedback-slider-item h3").addClass("animated fadeIn").css("opacity", "1");
        $(".feedback-slider-item img, .feedback-slider-thumb img, .customer-rating").addClass("animated zoomIn").css("opacity", "1");
    });
    feedbackSlider.on('changed.owl.carousel', function(property) {
        var current = property.item.index;
        var prevThumb = $(property.target).find(".owl-item").eq(current).prev().find("img").attr('src');
        var nextThumb = $(property.target).find(".owl-item").eq(current).next().find("img").attr('src');
        var prevRating = $(property.target).find(".owl-item").eq(current).prev().find('span').attr('data-rating');
        var nextRating = $(property.target).find(".owl-item").eq(current).next().find('span').attr('data-rating');
        $('.thumb-prev').find('img').attr('src', prevThumb);
        $('.thumb-next').find('img').attr('src', nextThumb);
        $('.thumb-prev').find('span').next().html(prevRating + '<i class="fa fa-star"></i>');
        $('.thumb-next').find('span').next().html(nextRating + '<i class="fa fa-star"></i>');
    });
    $('.thumb-next').on('click', function() {
        feedbackSlider.trigger('next.owl.carousel', [300]);
        return false;
    });
    $('.thumb-prev').on('click', function() {
        feedbackSlider.trigger('prev.owl.carousel', [300]);
        return false;
    });
    
});	

	
	
$(function (){

	$('.simple-marquee-container').SimpleMarquee();

});	

		
		function submitForm(cid){
			$(".getInstitutes_"+cid).submit();
		  }
		
		$(document).ready(function(){
			$(".cancelButton").on("click", function(){
				clear();
			});
	    	$(".custom_nav_item").on("click", function(){
	    		clear();
	    	});
			$("#webinarpart").on('submit', function(e){
		       	e.preventDefault();
		       	var fdata = $("#webinarpart").serialize();
	       		var url = '<?php echo base_url("front/webinars/save_in_participants")?>';
		       	$.ajax({
			        url:url,
			        data:fdata,
			        type:"post",
			        dataType:"json",
			        beforeSend: function(){
			          $("#loader").show();
			        },
			        success: function(str){
			          $("#loader").hide();
			          if(str.Status == 'Active'){
			            toastr.remove();
			            toastr['success'](str.Message, '', {
			                positionClass: 'toast-bottom-right'
			            });
			            setTimeout(function(){
			            	window.location.href = "<?php echo base_url("front/webinars/payment_page")?>";
			            }, 1000);
			          }else{
			            toastr.remove();
			            toastr['error'](str.Message, '', {
			                positionClass: 'toast-bottom-right'
			            });
			          }
			        }
	        	});
	    	});
		});
		function getDetails(web_id, prof_id){
			$("#webinar_id").val(web_id);
			$("#professor_id").val(prof_id);
		 	$(".moblie_p_info").show();
		 	$(".name").val('');
		    $(".email").val('');
		    $(".phone").val('');
		    $(".comment").val('');
		    $(".address").val('');
		    var target = $('.moblie_p_info');
		    if (target.length) {
		        $('html,body').animate({
		            scrollTop: target.offset().top - 100
		        }, 1000);
		        return false;
		    }
		}
		function clear(){
			$("#webinar_id").val('');
			$("#professor_id").val('');
			$(".moblie_p_info").hide();
		    $(".name").val('');
		    $(".email").val('');
		    $(".phone").val('');
		    $(".comment").val('');
		    $(".address").val('');
		    var target = $('.webinarSchedule');
		    if (target.length) {
		        $('html,body').animate({
		            scrollTop: target.offset().top - 100
		        }, 1000);
		        return false;
		    }
		    return false;
		}
	</script>
	