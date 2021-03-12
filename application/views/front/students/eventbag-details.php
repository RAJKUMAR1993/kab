<? $this->load->view("front/includes/new_header");?>
<link href="<?php echo base_url();?>assets/css/template.css?<? echo time();?>" rel="stylesheet">

<main>
		<section id="hero_in" class="general">
			<div class="wrapper">
				<div class="container">
					<h1 class="fadeInUp"><span></span><? echo $idata->institute_name ?></h1>
				</div>
			</div>
		</section>
		<!--/hero_in-->
        <div class="bg_color_1">
			<div class="container margin_60_35">
				<div class="row">
						  <div class="col-md-8 text-white">
							<div class="vg">
							  <h1><? echo $idata->institute_name ?></h1>
							  <p><? echo $idata->aboutinst ?></p>
							</div>
						  </div>
						  
						  <div class="col-md-4 pad">
						  <div class="row no-gutters">
						  <div class="col-md-6 text-center"> <a href="#" data-toggle="modal" data-target="#Video">
							<div class="btn-box image"> <img src="<?php echo base_url();?>assets/images/front/video.png"  />
							  <h2>Video</h2>
							</div>
							</a> </div>
							
							 <!-- <div class="col-md-6 text-center"> <a href="#" data-toggle="modal" data-target="#offer">
							<div class="btn-box"> <img src="<?php echo base_url();?>assets/images/front/offerings.png"  />
							  <h2>Offerings</h2>
							</div>
							</a> </div> -->
							
							<div class="col-md-6 text-center"> <a href="#" data-toggle="modal" data-target="#brochure">
							<div class="btn-box"> <img src="<?php echo base_url();?>assets/images/front/brochure.png"  />
							  <h2>Brochure</h2>
							</div>
							</a> </div>
							
							<div class="col-md-6 text-center"> <a href="#" data-toggle="modal" data-target="#courses">
							<div class="btn-box"> <img src="<?php echo base_url();?>assets/images/front/courses.png"  />
							  <h2>Courses</h2>
							</div>
							</a> </div>
						  
						  </div>
						  </div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!--/container-->
	</main>




<? $this->load->view("front/institutes/new_footer");?>

<!-- The Modal -->
<div class="modal" id="Video">
  <div class="modal-dialog modal-lg">
    <div class="modal-content"> 
      
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Video Gallery</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <div class="row">
          <div class="col-12 col-lg-12 col-md-12 nn">

            <div class="video-row">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="font-weight-bold py-2 pl-2" style="color:#333;"><? echo $idata->institute_name; ?></h6>
                
              </div>
              <div class="owl-carousel">
                 <?
            $vdata = $this->db->get_where("tbl_video",["institute_id"=>$idata->institute_id])->result();
            foreach ($vdata as $row) { 
       $insinfo = $this->institute_model->get_institute_id($row->institute_id);
          ?>
                <div class="video-info"> 
        <video controls>
        <source src="<?php echo base_url().$row->url; ?>" type="video/mp4">
        </video>
        <div class="d-flex mt-2">
        <div class="author-thumb">
        <img src="<?php echo base_url().$insinfo->logo; ?>">
        </div>
        <div class="author-info">
        <h6 class="font-weight-bold mb-1"><a href=""><?php echo $row->title; ?></a></h6>
        <p class="text-muted"><?php echo $insinfo->institute_name; ?></p>
        <span class="text-muted font-weight-bold small"><?php echo date('d-m-Y',strtotime($row->created)); ?></span>
        </div>
        </div>   
      </div>
  <?  }
  ?>
               
                
                
              </div>
            </div>
          </div>
        </div>
      </div>
      
    
      
    </div>
  </div>
</div>
<div class="modal" id="offer">
  <div class="modal-dialog modal-fluid">
    <div class="modal-content"> 
      
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Offerings</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <p><?php if($idata->aboutinst){ echo $idata->aboutinst; } ?></p>
        <p>
          <?php if($idata->impnote){ echo $idata->impnote; } ?>
        </p>
        
      </div>
    </div>
  </div>
</div>
<div class="modal" id="brochure">
  <div class="modal-dialog modal-lg">
    <div class="modal-content"> 
      
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Brochures</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body profile-work">
       
        <ul>
          <?
            $bdata = $this->db->get_where("tbl_brouchers",["institute_id"=>$idata->institute_id])->result();
            if($bdata){
            foreach ($bdata as $row) { ?>
              <li><a href="<? echo base_url().'assets/images/brochure/'.$row->broucher; ?>" target="_blank"><? echo $row->broucher_name;?></a></li>
           <? } }
          ?>
          
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="modal" id="courses">
  <div class="modal-dialog modal-lg">
    <div class="modal-content"> 
      
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title"> Courses</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <div class="row">
  <div id="accordion" class="accordion col-md-12">
        <div class="card mb-0">

          <?
          $adata = $this->db->get_where("tbl_courses",["institute_id"=>$idata->institute_id])->result();
    if($adata) {
      foreach ($adata as $row) {
      
  ?>


            <div class="card-header collapsed" data-toggle="collapse" href="#collapse<? echo $row->course_id; ?>" aria-expanded="false">
                <a class="card-title">
                    <? echo $row->course_name; ?>
                </a>
            </div>
            <div id="collapse<? echo $row->course_id; ?>" class="card-body collapse" data-parent="#accordion" style="">
                <p><? echo $row->course_desc; ?></p>
                <p>Duration : <? echo $row->course_duration; ?></p>
            </div>
            <? } } ?>
        
        </div>
    </div>
 
  </div>
      </div>
    </div>
  </div>
</div>
<link rel="stylesheet" href="https://bootstraplily.com/demo/youtube-website-html/css/owl.carousel.css">
    <link rel="stylesheet" href="https://bootstraplily.com/demo/youtube-website-html/css/owl.theme.default.css">
    <script src="https://kit.fontawesome.com/b31e06099e.js" crossorigin="anonymous"></script>
<script>$(document).ready(function(){
  $(".owl-carousel").owlCarousel({
    dots:false,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:false
        },
        600:{
            items:2,
            nav:false
        },
        1000:{
            items:3,
            nav:false,
            loop:false
        }
    }
    });
});
$(function(){

  $('#videoID').hoverPlay();

});</script> 

<script src="https://bootstraplily.com/demo/youtube-website-html/js/owl.carousel.js"></script> 
<script src="https://bootstraplily.com/demo/youtube-website-html/js/jquery.hoverplay.js"></script> 