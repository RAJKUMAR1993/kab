<? $this->load->view("front/institutes/header");

$sdata = $this->db->get_where("tbl_students",["student_id"=>$this->session->userdata("student_id")])->row();
$bgurl = $this->db->where("institute_id",$idata->institute_id)->get("tbl_ins_bgimage")->row();
$video_connect = $this->db->where("institute_id", $idata->institute_id)->where("date", date("Y-m-d"))->get("tbl_college_connect")->row();


?>

<link href="<? echo base_url('assets/pnotify/pnotify.custom.min.css') ?>" rel="stylesheet">

<style>
@media only screen and (max-width: 700px) and (min-width: 250px){
	.ins-head h5 {
		margin-bottom: 0px !important;
		margin-top: 33px !important;
		font-weight: 600 !important;
		font-family: arial !important;
		font-size: 13px !important;
		color: #dcfaf0;
		text-align: center !important;
	}
}
	
	@media only screen and (max-width: 700px) and (min-width: 250px){
		.back {
			display: none !important;
		}
		.hamburger-box{
			display: none !important;
		}
	}
	
	@media only screen and (max-width: 1024px) and (min-width: 768px){
		.back {
			display: none !important;
		}
		.hamburger-box{
			display: none !important;
		}
		.ins-head{
			flex: 0 0 100% !important;
		    max-width: 100% !important;
		}
		.ins-head h5{
			text-align: center!important;
		}
	}
	
</style>

<? if(file_exists($bgurl->url)){ ?>
<style type="text/css">
  #video {
    background-image: url(<? echo base_url().$bgurl->url; ?>);
    background-size: cover;
  background-position: center;
}
</style>


<? } else { ?>

<style type="text/css">
  #video {
    background-image: url(<? echo base_url() ?>assets/images/audi-bg.jpg);
    background-size: cover;
  background-position: center;  
}
</style>
  <? } ?>
  
<style>

	#video{
	
		margin-top: 0px !important;
	}
	.sticky {
    background-color: <?php echo $color; ?>!important;
    }
</style>
<style>

	#video{
		
		
		margin-top: 0px !important;
	}
</style>
<style type="text/css">
#navbarNav3 .active {
    color: #fff !important;
    border-radius: 6px;
    padding: 2px 5px 2px 5px;
    background: #183577;
}
#navbarNav3 ul li a:hover {
    color: #fff;
    border-radius: 4px;
    padding: 2px 5px 2px 5px;
    background: #183577 !important;
}

.footer {
    color: #fff!important;
    background: rgba(22, 11, 29, 0.5)!important;
    padding: 0px 20px 5px 20px!important;
    margin: 10px 0px!important;
    border: solid 1px #1a1530!important;
}
/*.g-bg-dark {
   background-color: rgb(19 24 29 / 0.8);
}*/
.g-pt-70 {
    padding-top: 1rem !important;
}
.c-heading { color: #fff!important; font-size:15px; margin: 0px;padding:20px 0 0 20px;float:left;}
.our-webcoderskull{margin-top: 77px;}
#video{margin-top: 77px;}
.g-font-size-11 {
    font-size: 0.78571rem !important;
}

.g-font-size-13 {
    font-size: 12px !important;
}
/*.g-mb-30 {
    margin-bottom: 2.14286rem !important;
}*/
.g-bg-dark-light-v1 {
    background-color: #0e151b;
}
.g-pt-30 {
    padding-top: 2.14286rem !important;
}
.g-font-size-11 {
    font-size: 0.78571rem !important;
}
.footer h4{ padding-top:10px; margin:0px;}
.footer a{font-size:13px;}
.fixed-top {
  
    z-index: 99999999;
}
.vidpadd {
    margin-top: 0px;
}

.vg { background: rgba(22, 11, 29, 0.5);
    padding: 20px;
    margin: 20px 0px;
    border: solid 1px #1a1530;}
.vg h1{font-size:22px;}
.vg p{font-size:14px;}
.bg-brown {
    background-color: #53381a!important;
}

</style>


<link href="<? echo base_url('assets/') ?>template.css?<? echo time();?>" rel="stylesheet">
<link href="<? echo base_url('assets/') ?>chatbot1.css" rel="stylesheet">


<div id="page">

<main>
	
	<section id="hero_in" class="courses" style="height: 90px;margin-bottom: 10px;">
			<div class="wrapper" >
<!--
				<div class="container">
					<h1 class="fadeInUp"><span></span>Exhibitors</h1>
				</div>
-->
			</div>
		</section>
	
	<header class="header menu_2 sticky" style="background-color: <? echo $idata->header_color_code ?> !important; padding: 17px 8px !important;">
		<div id="logo">
		
		<? if(file_exists($idata->logo)){ ?>
		
			<a href="<? echo base_url().'exhibitors/'.$this->uri->segment(2);?>"> <img src="<? echo base_url().$idata->logo ?>"height="70px" alt="image"> 
    		</a>
    		
    	<? } ?>	
			<br>
		</div>
		<!-- /top_menu -->
		<a href="#menu" class="btn_mobile">
			<div class="hamburger hamburger--spin" id="hamburger">
				<div class="hamburger-box">
					<div class="hamburger-inner"></div>
				</div>
			</div>
		</a>
		<div class="row">
		   <div class="col-md-10 col-12 ins-head">
					<h5 style="font-weight: 600;vertical-align: middle;margin-bottom: 0px;margin-top: 15px;font-family:<? echo $idata->ins_font_family; ?>;font-size: <? echo $idata->ins_font_size; ?>;color: <? echo $idata->ins_font_color; ?>;"><? echo $idata->institute_name; ?>
			</h5>
		   </div>
		   <div class="col-md-2 back">
	      		<a href="<?php echo base_url(); ?>exhibitors" class="btn btn-primary" style="margin-top:15px;border-radius: 30px;"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
		   </div>
		</div>
		<!--<nav id="menu" class="main-menu">
			<ul>
				 <li>
				 	<span>
				 		<a href="<? echo base_url() ?>">Home</a>
				 	</span>
				 </li>

				 <li> <span><a class="modalloginnext" href="javascript:void(0)" <? if($this->session->userdata("student_id")){ ?> onclick="openModal('Video')" <?php }else{?> href="javascript:void(0)" data-toggle="modal" data-target="#myModalLoginNow" <?php }?>> Video Gallery</a></span> </li>
				
				<li> <span><a class="modalloginnext" href="javascript:void(0)" <? if($this->session->userdata("student_id")){ ?>  onclick="openModal('photo')" <?php }else{?> href="javascript:void(0)" data-toggle="modal" data-target="#myModalLoginNow" <?php }?>>Photo Gallery </a></span> </li>
				
				<li> <span><a class="modalloginnext" href="javascript:void(0)" <? if($this->session->userdata("student_id")){ ?> onclick="openModal('pogram')" <?php }else{?> href="javascript:void(0)" data-toggle="modal" data-target="#myModalLoginNow" <?php }?>>Programme Fees</a></span> </li>
				
				<li> <span><a class="modalloginnext" href="javascript:void(0)" <? if($this->session->userdata("student_id")){ ?> onclick="openModal('placements')" <?php }else{?> href="javascript:void(0)" data-toggle="modal" data-target="#myModalLoginNow" <?php }?>> Placements </a></span> </li>
				
				<li> <span><a class="modalloginnext" href="javascript:void(0)" <? if($this->session->userdata("student_id")){ ?> onclick="openModal('achivements')" <?php }else{?> href="javascript:void(0)" data-toggle="modal" data-target="#myModalLoginNow" <?php }?>> Achivements </a> </span></li>
				
				<li><span> <a class="modalloginnext" href="javascript:void(0)" <? if($this->session->userdata("student_id")){ ?> onclick="openModal('admissions')" <?php }else{?> href="javascript:void(0)" data-toggle="modal" data-target="#myModalLoginNow" <?php }?>>Admission 2020</a></span> </li> 
				
				<?php if($this->session->userdata("student_id")){ ?>
				<li style="    border: 1px solid white !important;border-radius: 5px;padding: 5px;"><? echo $this->session->userdata("student_name"); ?>
					
					<ul>
					  <li><a href="<? echo base_url().'student/dashboard'?>">Dashboard</a></li>
					  <li><a href="<? echo base_url('student/login/logout')?>">Logout</a></li>

					</ul>
				  </div>
				</li>
				<?php }else{?>
				  <li class="nav-item"> <a class="nav-link modalloginnext" href="javascript:void(0)" data-toggle="modal" data-target="#myModalLoginNow">Login</a> </li>
				<?php }?>
				
			</ul>
		</nav>-->
	</header>





<section id="video">
 
  <div class="row1">
  	
  	<div class="col-md-12" align="center">
  		<!--<p style="margin-bottom: 0px;
    margin-top: 25px;
    font-size: 18px;
    font-weight: 600;
    color: white;"><? echo $idata->institute_name; ?></p>-->
  	</div>
  	
  </div>
  

<br>
  <div class="container">
   
   <div class="row" >
   <div class="col-md-12">
   <div class="ins-logo1">
   
<!--
   <div class="row">
      <div class="col-md-2" >  
      <a <? if($this->session->userdata("student_id")){ ?> href="#" onclick="openModal('feedbacki')" <? } else { ?> href="<? echo base_url(); ?>" <? } ?> ><img src="<?php echo base_url();?>assets/images/front/logo.png" height="64px" alt="image"></a>  
      </div>
       <div class="col-md-8 text-center">  <h2> Amity University </h2> </div>
        <div class="col-md-2" > <a href="<? echo base_url().'exhibitors/'.$this->uri->segment(2);?>"> <img src="<? echo base_url().$idata->logo ?>" width="100%" height="64px" alt="image"></a>  </div>
       </div>
       </div>
       </div>
    </div>
-->
   
   
   
   
    <div class="row  text-center">
      <div class="col-md-2 text-center"> 
        <? //if($this->session->userdata("student_id")){ ?>
        <a href="#" onclick="openModal('Video')">
        <div class="btn-box image"> <img src="<?php echo base_url();?>assets/images/front/video.png"  />
          <h2>Video</h2>
        </div>
        </a> 
        <? //}else{ ?>
<!--
           <a class="modalloginnext" href="javascript:void(0)" data-toggle="modal" data-target="#myModalLoginNow">
          <div class="btn-box image"> <img src="<?php echo base_url();?>assets/images/front/video.png"  />
            <h2>Video</h2>
          </div>
          </a> 
-->
        <? //} ?>
        <? //if($this->session->userdata("student_id")){ ?>
        <a href="#" onclick="openModal('photo')">
        <div class="btn-box"> <img src="<?php echo base_url();?>assets/images/front/photo.png"  />
          <h2>Photo Gallery</h2>
        </div>
        </a>
        <? //}else{ ?>
<!--
           <a class="modalloginnext" href="javascript:void(0)" data-toggle="modal" data-target="#myModalLoginNow">
          <div class="btn-box"> <img src="<?php echo base_url();?>assets/images/front/photo.png"  />
            <h2>Photo Gallery</h2>
          </div>
          </a>  
-->
        <? //} ?>
        <? //if($this->session->userdata("student_id")){ ?>
         <a href="#" onclick="openModal('pogram')">
        <div class="btn-box"> <img src="<?php echo base_url();?>assets/images/front/fees.png"  />
          <h2>Courses & Fees</h2>
        </div>
        </a> 
        <? //}else{ ?>
<!--
        <a class="modalloginnext" href="javascript:void(0)" data-toggle="modal" data-target="#myModalLoginNow">
        <div class="btn-box"> <img src="<?php echo base_url();?>assets/images/front/fees.png"  />
          <h2>Programme Fees</h2>
        </div>
        </a>
-->
        <? //} ?>
        <? //if($this->session->userdata("student_id")){ ?>
        <a href="#" onclick="openModal('placements')">
        <div class="btn-box"> <img src="<?php echo base_url();?>assets/images/front/placement.png"  />
          <h2>Placements</h2>
        </div>
        </a>
          <? //}else{ ?>
<!--
        <a class="modalloginnext" href="javascript:void(0)" data-toggle="modal" data-target="#myModalLoginNow">
        <div class="btn-box"> <img src="<?php echo base_url();?>assets/images/front/placement.png"  />
          <h2>Placements</h2>
        </div>
        </a>
        </a>
-->
        <? //} ?>
        <? //if($this->session->userdata("student_id")){ ?> 
		<a href="#" onclick="openModal('achivements')">
        <div class="btn-box"> <img src="<?php echo base_url();?>assets/images/front/achievements.png"  />
          <h2>Testimonials</h2>
        </div>
        </a>
      <? //} else { ?>
<!--
        <a class="modalloginnext" href="javascript:void(0)" data-toggle="modal" data-target="#myModalLoginNow">
        <div class="btn-box"> <img src="<?php echo base_url();?>assets/images/front/achievements.png"  />
          <h2>Testimonials</h2>
        </div>
        </a> 
-->
<? //} ?>
      </div>
      <div class="col-md-8">
       
       
       
       <div class="row align-items-center text-center mx-auto">
  <div class="col-md-11 mx-auto">
  <div class="vidpadd">
  
  <? if(file_exists($idata->detailed_theme_picture)){ ?>    
      
       <img src="<? echo base_url().$idata->detailed_theme_picture ?>" width="100%">
       
  <? }else{ ?>     
       
       <img src="<? echo base_url('assets/images/audi-bg.jpg') ?>" width="100%">
        
  <? } ?>      
        
  </div>
  </div>
  
  </div>
       
       
        
<!--
        <div style="margin-top:10px;  display: flex; justify-content: center; " class="insData">
        

        <div class="row">
		 
          <div class="col-md-4">
		    <a href="<?php echo base_url(); ?>front/professor/institute_professors/<?php echo $this->uri->segment(2);?>">
            <img src="<? echo base_url(); ?>/assets/images/user1.png" style="width:50%;text-align:center">
            <h6 style="color:#fff">PROFESSORS</h6>
            </a>
		  </div>
		  
          <div class="col-md-4">
		    <a href="<?php echo base_url(); ?>front/professor/institute_speakers/<?php echo $this->uri->segment(2);?>">
            <img src="<? echo base_url(); ?>/assets/images/user2.png" style="width:50%;text-align:center">
            <h6 style="color:#fff">SPEAKERS</h6>
			</a>
          </div>
          <div class="col-md-4">
		    <a href="<?php echo base_url(); ?>front/professor/institute_counsellers/<?php echo $this->uri->segment(2);?>">
            <img src="<? echo base_url(); ?>/assets/images/user3.png" style="width:50%;text-align:center">
            <h6 style="color:#fff">COUNCELLORS</h6>
			</a>
          </div>
        </div>

        </div>
-->
        
      <div style="margin-top:10px;  display: flex; justify-content: center; " class="insData">
          <? if($this->session->userdata("student_id")){ ?>
        <button type="button" style="margin: 5px;font-size: 15px;height: 60px;width: 60px;border-radius: 20px;" class="btn_live_chat btn btn-info btn-sm btn-icon videoConferenceMeeting" data-aid="<? echo $video_connect->id ?>" data-iid="<? echo $idata->institute_id ?>" data-sid="<? echo $this->session->userdata("student_id") ?>"><i class="fa fa-video" aria-hidden="true"></i><br><small style="font-size: 10px;">Video</small>
        </button>   
        <?php } else{ ?>
        <button type="button" style="margin: 5px;font-size: 15px;height: 60px;width: 60px;border-radius: 20px;" class="btn_live_chat btn btn-info btn-sm btn-icon" data-toggle="modal" data-target="#myModalLoginNow"><i class="fa fa-video" aria-hidden="true"></i><br><small style="font-size: 10px;">Video</small>
        </button>
        <?php } ?>
      
      <? if($this->session->userdata("student_id")){ ?>   
      <!--<button type="button" style="margin: 5px;font-size:15px;height: 60px;width: 60px;border-radius: 20px;" class="btn_live_chat btn btn-primary btn-sm btn-icon chatbox-open">
      <i class="fa fa-comment" aria-hidden="true"></i><br><small style="font-size: 10px;">Chat</small>
      </button>-->
  <? } ?>
      
      
   <? if($this->session->userdata("student_id")){ ?>
         
       <button type="button" style="margin: 5px;font-size: 15px;height: 60px;width: 60px;border-radius: 20px;" class="btn_live_chat btn btn-danger btn-sm btn-icon call_connect"><i class="fa fa-phone" aria-hidden="true"></i><br><small style="font-size: 10px;">Telephone</small></button>
       
   <? }else{ ?>    
       
       <button type="button" style="margin: 5px;font-size: 15px;height: 60px;width: 60px;border-radius: 20px;color: white" class="btn_live_chat btn btn-danger btn-sm btn-icon"  data-toggle="modal" data-target="#myModalLoginNow"><i class="fa fa-phone" aria-hidden="true"></i><br><small style="font-size: 10px;">Telephone</small></button>
	    
      
   <? } ?>       
      </div>  
      </div>
      <div class="col-md-2 text-center"> <? //if($this->session->userdata("student_id")){ ?>  
       <a href="#" onclick="openModal('admissions')">
        <div class="btn-box"> <img src="<?php echo base_url();?>assets/images/front/admission.png"  />
          <?php $data = $this->db->get('tbl_admin')->row();  ?>
				<h2><?php echo $data->admisssion_year  ?></h2>
        </div>
        </a> 
        <? //}else{ ?>
<!--
          <a class="modalloginnext" href="javascript:void(0)" data-toggle="modal" data-target="#myModalLoginNow">
        <div class="btn-box"> <img src="<?php echo base_url();?>assets/images/front/admission.png"  />
          <h2>Admission 2020</h2>
        </div>
        </a> 
-->
         <? //} ?> 
         
    <? //if($this->session->userdata("student_id")){ ?> 
         <a href="#" onclick="openModal('councellors')">
        <div class="btn-box"> <img src="<?php echo base_url();?>assets/images/front/interaction.png"  />
          <h2 style="font-size:13px">Talk to Professor</h2>
        </div>
        </a>
<? //}else{ ?>
    <!--<a class="modalloginnext" href="javascript:void(0)" data-toggle="modal" data-target="#myModalLoginNow">
        <div class="btn-box"> <img src="<?php echo base_url();?>assets/images/front/interaction.png"  />
          <h2 style="font-size:13px">Talk to Professor</h2>
        </div>
        </a>-->
         <? //} ?>
         
          
     <? if($this->session->userdata("student_id")){ ?>      
        <a href="#" onclick="openModal('applyc')">
        <div class="btn-box"> <img src="<?php echo base_url();?>assets/images/front/apply.png"  />
          <h2>Apply for Admission</h2>
        </div>
        </a> 
<? }else{ ?>
   <a class="modalloginnext" href="javascript:void(0)" data-toggle="modal" data-target="#myModalLoginNow">
        <div class="btn-box"> <img src="<?php echo base_url();?>assets/images/front/apply.png"  />
          <h2>Apply for Admission</h2>
        </div>
        </a>  
         <? } ?>

         
    <? if($this->session->userdata("student_id")){ ?>

      <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal">
        <div class="btn-box"> 

          <img src="<?php echo base_url();?>assets/images/front/queries.png"  />
          <h2>Send Enquiry</h2>

        </div>
      </a>

    <? }else{ ?>

      <a class="modalloginnext" href="javascript:void(0)" data-toggle="modal" data-target="#myModalLoginNow">
        <div class="btn-box"> 

          <img src="<?php echo base_url();?>assets/images/front/queries.png"  />
          <h2>Send Enquiry</h2>

        </div>
      </a>

    <? } ?>
         
         <? //if($this->session->userdata("student_id")){ ?> 
        <a  href="#" onclick="openModal('feedbacki')">
        <div class="btn-box"> <img src="<?php echo base_url();?>assets/images/front/feedback.png"  />
          <h2>Feedback</h2>
        </div>
        </a>
<? //}else{ ?>
   <!-- <a class="modalloginnext" href="javascript:void(0)" data-toggle="modal" data-target="#myModalLoginNow">
        <div class="btn-box"> <img src="<?php echo base_url();?>assets/images/front/feedback.png"  />
          <h2>Feedback</h2>
        </div>
        </a> -->
         <? //} ?>
         </div>
    </div>
    <!--<div class="row">
      <div class="col-md-12 text-white">
    
    <div class="vg">
        <p><? echo $idata->aboutinst ?></p>
    </div>
    
    </div>
    </div>-->
    
    
    
    
    
    
    
	
	<section class="footer">
            <div class="g-bg-dark">
                <div class="container g-pt-70 g-pb-40">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 g-mb-30">
                            <h3 class="h6 g-color-white text-uppercase">Address</h3>
                            <address class="g-font-size-13 g-color-gray-dark-v3 g-font-weight-600 g-line-height-2 mb-0" style="color: #fff !important;">
                               <? echo $idata->address ?>
                            </address>
              
                             <br>

                         <? if($idata->website){ ?>
              
                            <h3 class="h6 g-color-white text-uppercase">Website</h3>
                            <address class="g-font-size-13 g-color-gray-dark-v3 g-font-weight-600 g-line-height-2 mb-0" style="color: #fff !important;">
                               <a href="<? echo $idata->website ?>" target="_blank" style="color: white"><? echo $idata->website ?></a>
                            </address>	
                            
                         <? } ?>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 g-mb-30">
                            <h3 class="h6 g-color-white text-uppercase">Contact </h3>
              <h4 class="g-color-text g-font-size-11 text-left text-uppercase" style="color: #a09c9c !important;">Phone</h4>
                            <address class="g-font-size-13 g-color-gray-dark-v3 g-font-weight-600 g-line-height-2 mb-0" style="color: #fff !important;">
                             <? echo $idata->phone ?><br>
                             
                            </address>
                            <h4 class="g-color-text g-font-size-11 text-left text-uppercase" style="color: #a09c9c !important;">Email</h4>
                            <a href="#" class="text-white"><? echo $idata->email ?> </a> <br>
                          
               
                            
                            
                            
                        </div>

                       <? 
						$social = json_decode($this->db->get_where("tbl_institutes",["institute_id"=>$idata->institute_id])->row()->social_links)
						?>
                       
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 g-mb-30">
                            <h3 class="h6 g-color-white text-uppercase">Social Media</h3>
                            <ul class="social">
                               <? if($social->facebook != ""){ ?>
                                <li class="image"><a href="<? echo $social->facebook ?>" target="blank"><img src="<?php echo base_url();?>assets/images/front/facebook.jpg" class=" image img-circle" width="25px;" alt="KAB" title="KAB"></a></li>
                               <? } ?> 
                               <? if($social->twitter != ""){ ?>
                                <li class="image"><a href="<? echo $social->twitter ?>" target="blank"><img src="<?php echo base_url();?>assets/images/front/twitter.jpg" class="img-circle" width="25px;" alt="KAB" title="KAB"></a></li>
                               <? } ?>
                               <? if($social->instagram != ""){ ?> 
                                <li class="image"><a href="<? echo $social->instagram ?>" target="blank"><img src="<?php echo base_url();?>assets/images/front/instagram.png" class="img-circle" width="25px;" height="25px" alt="KAB" title="KAB"></a></li>
                               <? } ?>
                               <? if($social->youtube != ""){ ?> 
                                <li class="image"><a href="<? echo $social->youtube ?>" target="blank"><img src="<?php echo base_url();?>assets/images/front/youtube.jpg" class="img-circle" width="25px;" alt="KAB" title="KAB"></a></li>
                               <? } ?> 
                         </ul>

                         <br>

                    <? $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>    
                        
                         <h3 class="h6 g-color-white text-uppercase">Recommend to friends</h3>
                            <ul class="social">
                               
                                <li class="image"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<? echo $actual_link ?>&amp;src=sdkpreparse"><img src="<?php echo base_url();?>assets/images/front/facebook.jpg" class=" image img-circle" width="25px;" alt="KAB" title="KAB"></a></li>
                                <li class="image"><a target="_blank" href="https://twitter.com/intent/tweet?text=<? echo $actual_link ?>"><img src="<?php echo base_url();?>assets/images/front/twitter.jpg" class="img-circle" width="25px;" alt="KAB" title="KAB"></a></li>
                                 <? if($this->session->userdata("student_id")){ ?>
                                <li class="image">
                                  <a href="https://api.whatsapp.com/send?phone=91<? echo $sdata->phone ?>&amp;text=<? echo $actual_link ?>" target="_blank"><img src="<?php echo base_url();?>assets/images/whatsapp.png" style="height: 32px;width: 32px" alt="Whats App Contact"></a>
                                </li>
                                <? } ?>
                                
                          </ul
                        </div>

                    </div>
                </div>
            </div>

            
        </section>
	
  </div>
</section>



<? if($this->session->userdata("student_id")){ ?>

<!-- <button class="chatbox-open">
    <i class="fa fa-comment fa-2x" aria-hidden="true"></i>
  </button> -->
<!--<button class="chatbox-close">
    <i class="fa fa-close fa-2x" aria-hidden="true"></i>
  </button>-->
  
<? } ?>  
<!--<section class="chatbox-popup">
  <div class="chatbox-popup__header">
    <aside style="flex:3">
      <i class="fa fa-user-circle fa-4x chatbox-popup__avatar" aria-hidden="true"></i>
    </aside>
    <aside style="flex:8">
      <h1 style="color:white;font-weight:bold;"><? echo $idata->institute_name ?></h1> <i class="fa fa-circle" style="color: green" aria-hidden="true"></i> (Online)
    </aside>
    <aside style="flex:1">
      <button class="chatbox-maximize"><i class="fa fa-window-maximize" aria-hidden="true"></i></button>
    </aside>
  </div>
  <main class="chatbox-popup__main">
   <div id="wplc_message_div">
     <p></p>
    </div>
  </main>
  
 <main class="chatbox-panel__main" style="flex:1">
   
    <div class="mesgs">
         
       <div class="msg_history" id="your_div" style="max-height: 400px;overflow-y: scroll;">
           
            

       </div>
     </div>
   
  </main>

  
  
  <footer class="chatbox-popup__footer">
    <aside style="flex:1;color:#888;text-align:center;">
    </aside>
    <aside style="flex:10">
      <input type="text" placeholder="Type your message here..." id="ctmessage"  class="form-control" autofocus>
    </aside>
    <aside style="flex:1;color:white;text-align:center;cursor: pointer;" id="csend_message">
      <i class="fa fa-paper-plane" aria-hidden="true"></i>
    </aside>
  </footer>
</section>-->
<!--
<section class="chatbox-panel">
  <header class="chatbox-panel__header">
    <aside style="flex:3">
      <i class="fa fa-user-circle fa-3x chatbox-popup__avatar" aria-hidden="true"></i>
    </aside>
    <aside style="flex:8">
      <h1>Kab Education</h1> <i class="fa fa-circle" aria-hidden="true"></i> (Online)
    </aside>
    <aside style="flex:3;text-align:right;">
      <button class="chatbox-minimize"><i class="fa fa-window-restore" aria-hidden="true"></i></button>
      <button class="chatbox-panel-close"><i class="fa fa-close" aria-hidden="true"></i></button>
    </aside>
  </header>
  
  <footer class="chatbox-panel__footer">
    <aside style="flex:1;color:#888;text-align:center;">
      <i class="fa fa-camera" aria-hidden="true"></i>
    </aside>
    <aside style="flex:10">
      <textarea type="text" id="tmessage" placeholder="Type your message here..." autofocus></textarea>
    </aside>
    <aside style="flex:1;color:#888;text-align:center;cursor: pointer"  id="send_message">
      <i class="fa fa-paper-plane" aria-hidden="true"></i>
    </aside>
  </footer>

-->




</div>


</main>
	
<?php $this->load->view("front/institutes/institution-video-popup")?>
<? $this->load->view("front/institutes/footer");?>
<?php $this->load->view("front/institutes/institution-gallery-popup")?>


<!-- question modal -->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="display: block">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Send Enquiry</h4>
        <div class="smsg"></div>
      </div>
      
      <form method="post" id="queSubmit">
      
      <div class="modal-body">

      <div class="form-group">

        <textarea role="4" class="form-control" name="query" rows="6" placeholder="Send Enquiry" style="height: 100px"></textarea>

      </div>

      </div>
      <div class="modal-footer">
        <input type="hidden" name="institute_id" value="<? echo $idata->institute_id ?>">
        <input type="hidden" name="student_id" value="<? echo $this->session->userdata("student_id") ?>">
		<input type="hidden" name="query_date" value="<? echo date("Y-m-d"); ?>">
        <input type="hidden" name="type" value="institute">
      <button type="submit" class="btn btn-primary">Submit</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      
    </form>   
    </div>

  </div>
</div>


<script>

function openModal(id){
$("#"+id).show();
}	
function closeModal(id){
	$("#"+id).hide();
}
</script>
<script type="text/javascript">
  function openModal1(id, cid=null){
	  $("#coun_id").val(cid)
    $(".btn_request_a_session").hide();
    if(id=='sessionbooking'){
      $(".btn_request_a_session").show();
    }
    $.ajax({
      url : "<? echo base_url('front/webinars/getProfessor') ?>",
      type : "post",
      data : {cid:cid},
      dataType: "json",
      success : function(data){
        if(data!='' && typeof data!='undefined'){
          if(data.institute_id!='' && typeof data.institute_id!='undefined'){
            $("#institute_id").val(data.institute_id);
          }
          if(data.expert_name!='' && typeof data.expert_name!='undefined'){
            $(".mnt_name").html(data.expert_name);
          } 
          if(data.expert_qualification!='' && typeof data.expert_qualification!='undefined'){
            $(".mnt_edu").html(data.expert_qualification);
          }
          if(data.expert_spokenlang!='' && typeof data.expert_spokenlang!='undefined'){
            $(".sal_row").html("Language Spoken: "+data.expert_spokenlang);
          }
          if(data.expert_expertise!='' && typeof data.expert_expertise!='undefined'){
            $(".mnt_specialy").html(data.expert_expertise);
          }
          if(data.expert_longdesc!='' && typeof data.expert_longdesc!='undefined'){
            $(".basic_para").html(data.expert_longdesc);
          }
          if(data.expert_name!='' && typeof data.expert_name!='undefined'){
            $(".about_user").html(data.expert_name);
          }
          if(data.expert_designation!='' && typeof data.expert_designation!='undefined'){
            $(".mnt_designation").html(data.expert_designation);
          }
          if(data.expert_department!='' && typeof data.expert_department!='undefined'){
            $(".mnt_department").html(data.expert_department);
          }
          if(data.institute_name!='' && typeof data.institute_name!='undefined'){
            $(".mnt_institution").html(data.institute_name);
          }
          if(data.expert_photo!='' && typeof data.expert_photo!='undefined'){
            $(".profile_image").html('<img src="<?php echo base_url();?>'+data.expert_photo+'" class="mentor_big_img" style="margin-bottom:10px;">');
          }
        }
      }
    });
    $.ajax({
      url : "<? echo base_url('front/webinars/getProfessorSessions') ?>",
      type : "post",
      data : {cid:cid},
      success : function(data){
        if(data!='' && typeof data!='undefined'){
          $(".counsellorSessions").html(data);
        }
      }
    });
    setTimeout(function(){
      $("#"+id).show();
    }, 1500);
  }

</script>

<!-- Apply Now modal -->

<!-- Modal -->
<div id="myModalApplyNow" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="display: block">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Apply Now</h4>
        <div class="smsgapply"></div>
      </div>
      
      <form method="post" id="applynowSubmit">
      
      <div class="modal-body">
      <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" name="name" required />
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" name="email" required />
      </div>
      <div class="form-group">
        <label>Mobile</label>
        <input type="text" class="form-control" name="mobile" maxlength="10" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" required />
      </div>
      <div class="form-group">
        <label>Message</label>
        <textarea rows="2" class="form-control" name="message" required></textarea>

      </div>

      </div>
      <div class="modal-footer">
        <input type="hidden" name="institute_id" value="<? echo $idata->institute_id ?>">
        <input type="hidden" name="student_id" value="<? echo $this->session->userdata("student_id") ?>">
      <button type="submit" class="btn btn-primary">Submit</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      
    </form>   
    </div>

  </div>
</div>
<?php $this->load->view("student/login/login_popup")?>
<?php $this->load->view("front/institutes/institution-fee-popup")?>
<?php $this->load->view("front/institutes/institution-placements-popup")?>
<?php $this->load->view("front/institutes/institution-achievements-popup")?>
<?php $this->load->view("front/institutes/institution-admission-popup")?>
<?php $this->load->view("front/institutes/institution-apply-popup")?>
<?php $this->load->view("front/institutes/institution-feedback-popup")?>
<?php $this->load->view("front/institutes/councellors-popup")?>

<?php $this->load->view("front/eventschedule/profile")?>
<?php $this->load->view("front/eventschedule/askaquestion")?>
<?php $this->load->view("front/eventschedule/sessionbooking")?>

<script type="text/javascript" src="<? echo base_url('assets/pnotify/pnotify.custom.min.js') ?>"></script>
<link rel="stylesheet" href="<? echo base_url() ?>assets/vendor/sweetalert/sweetalert.css"/>
<script src="<? echo base_url() ?>assets/vendor/sweetalert/sweetalert.min.js"></script>

<script src="https://kit.fontawesome.com/b31e06099e.js" crossorigin="anonymous"></script>
<? if($this->session->userdata("student_id")){ ?>

 <script type="text/javascript">
//      window.onbeforeunload = OnBeforeUnLoad;
	  window.addEventListener("beforeunload", function (e) {
		  
		  e.preventDefault();
		  
		  $.ajax({

			url : "<? echo base_url('front/institutes/updateInstituteviewtime') ?>",
			type : "post",
			data : {student_id:"<? echo $this->session->userdata("student_id") ?>",institute_id:"<? echo $idata->institute_id ?>",type:"loggedin"},
			success : function(data){

			  console.log(data+"ravi");

			},
			error : function(data){

			  console.log(data);

			}

		  });
		  
		 return '';
	  });
	  
    </script>
<? }else{ ?>

	 <script type="text/javascript">
		 
        window.addEventListener("beforeunload", function (e) {
          
		   e.preventDefault();
			
		   $.ajax({

			url : "<? echo base_url('front/institutes/updateInstituteviewtime') ?>",
			type : "post",
			data : {student_id:"<? echo $this->input->ip_address() ?>",institute_id:"<? echo $idata->institute_id ?>",type:"visitor"},
			success : function(data){

			  console.log(data);

			},
			error : function(data){

			  console.log(data);

			}

		  }); 	
      		
			return '';
	   });
		 

    </script>

<? } ?>



<? 
$from_time = '';
$to_time = '';
$vfrom_time = '';
$vto_time = '';
if($this->session->userdata("student_id")){ 
  
// $coundata = $this->db->get_where("tbl_councellors",["institute_id"=>$idata->institute_id,"is_deleted"=>0,"expert_status"=>"Active"])->row();
	
  $helplinenum = json_decode($idata->virtual_conference_numbers,true);	
  $rnum = array_rand($helplinenum,1);
  	
  $mobile = $helplinenum[$rnum]['contact'];
  $from_time = $helplinenum[$rnum]['from_time'];
  $to_time = $helplinenum[$rnum]['to_time'];
//  if(isset($coundata->expert_mobile)){$mobile = $coundata->expert_mobile;}
//  else{if(isset($coundata->expert_mobile2)){$mobile = $coundata->expert_mobile2;}}
  echo '<input type="hidden" name="camobile" id="camobile" value="'.$mobile.'">';
  if($video_connect->from_time!=''){
    $vfrom_time = date('H:i', $video_connect->from_time);
  }
  if($video_connect->to_time!=''){
    $vto_time = date('H:i', $video_connect->to_time);
  }
}
?>

<script type="text/javascript">
	$(document).ready(function(){
    $(".btn_request_a_session").on('click', function(event){
      $('#expbooksession').show(); 
      //$('.session_booking').hide();
      $(".session_1").click();
    });

    var from = '<?php echo $from_time;?>';
    var to = '<?php echo $to_time;?>';
    var vfrom = '<?php echo $vfrom_time;?>';
    var vto = '<?php echo $vto_time;?>';
    if(from!='' && to!=''){
      $('.call_connect').tooltip({title: "Call allowed between <br>"+from+" - "+to, html: true, placement: "top"});
    }
    if(vfrom!='' && vto!=''){
      $('.videoConferenceMeeting').tooltip({title: "Video Conference allowed between <br>"+vfrom+" - "+vto, html: true, placement: "top"});
    }
  });
	<? if($this->session->userdata("student_id")){ ?>
	
		$(document).ready(function(){
			
//			var cmobile = $("#camobile").val();
//      		connectCall(cmobile);
			
			<? if($this->session->userdata("sendOnloadmail_status") != $idata->institute_id){  ?>
      			onloadmail();
			<? } ?>
			
			$.ajax({
				
				url : "<? echo base_url('front/institutes/checkInstituteviewtime') ?>",
				type : "post",
				data : {student_id:"<? echo $this->session->userdata("student_id") ?>",institute_id:"<? echo $idata->institute_id ?>","type":"loggedin"},
				success : function(data){
					
					console.log(data);
					
				},
				error : function(data){
					
					console.log(data);
					
				}
				
			});

				

		})
		
	function onloadmail(){
		
		$.ajax({
				
			url : "<? echo base_url('front/institutes/sendOnloadmail') ?>",
			type : "post",
			data : {student_id:"<? echo $this->session->userdata("student_id") ?>",institute_name:"<? echo $idata->institute_name ?>",institute_id:<? echo $idata->institute_id ?>},
			success : function(data){

				console.log(data);

			},
			error : function(data){

				console.log(data);

			}

		});
		
	}	
	
	$(".call_connect").click(function(){
      var camobile = $("#camobile").val();
      var from = '<?php echo $from_time;?>';
      var to = '<?php echo $to_time;?>';
		
		swal({
			title: "",
			text: "Are you sure your registered mobile number is not in DND.",
//			type: "warning",
			showCancelButton: true,
			confirmButtonClass: 'btn-warning',
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			closeOnConfirm: true
		}, function () {
			if(from!='' && to!=''){
				var date = new Date();
				var ymd = date.getFullYear()+'-'+(date.getMonth()+1)+'-'+date.getDate();
				var fdatetime = ymd+' '+from+':00';
				var tdatetime = ymd+' '+to+':00';
				var fdate = new Date(fdatetime);
				var tdate = new Date(tdatetime);
				var from_time = fdate.getTime();
				var to_time = tdate.getTime();
				var current_time = date.getTime();
//				console.log(fdate+'-'+tdate+'-'+date);
//				console.log(parseInt(from_time)+'-'+parseInt(to_time)+'-'+parseInt(current_time));
				if(parseInt(current_time)>=parseInt(from_time) && parseInt(current_time)<=parseInt(to_time))
				{
					connectCall(camobile);
				}
			}
			
		});	
			
        
    })
    $(".call_connect_c").click(function(){
      var cmobile = $(this).attr("data-mobile");
      connectCall(cmobile);
    })
	
    function connectCall(no){
      $.ajax({

        url : "<? echo base_url('welcome/convoxcall/').$sdata->phone.'/' ?>"+no,
        type : "post",
		data : {institute_id:"<? echo $idata->institute_id ?>",student_id:"<? echo $this->session->userdata("student_id") ?>"},  
//        crossDomain: true,
//        dataType: 'jsonp',
        success : function(data){
			
			if(data == "success"){
			
				new PNotify({
	//				title: 'Success',
					text: 'Call Initiated',
					type:'success',
					delay: 3000,
					animate: {
						animate: true,
						in_class: 'bounceUpDown',
						out_class: 'fadeOut'
					},
					addclass: "stack-bottomright",
					stack: {
					"dir1": "up",
					"dir2": "left"
					},
				});  
				
			}else{
				
				new PNotify({
	//				title: 'Success',
					text: 'Error Occured Please try again.',
					type:'danger',
					delay: 3000,
					animate: {
						animate: true,
						in_class: 'bounceUpDown',
						out_class: 'fadeOut'
					},
					addclass: "stack-bottomright",
					stack: {
					"dir1": "up",
					"dir2": "left"
					},
				});
				
			}
          	console.log(data);
          
        },
        error : function(data){
          
			/*new PNotify({
//				title: 'Success',
				text: 'Call Initiated',
				type:'success',
				delay: 3000,
				animate: {
					animate: true,
					in_class: 'bounceUpDown',
					out_class: 'fadeOut'
				},
				addclass: "stack-bottomright",
				stack: {
				"dir1": "up",
				"dir2": "left"
				},
				
			});*/	
          	console.log(data);
          
        }

      })
    }
	<? }else{ ?>
	
		$(document).ready(function(){
			
			
			$.ajax({
				
				url : "<? echo base_url('front/institutes/checkInstituteviewtime') ?>",
				type : "post",
				data : {student_id:"<? echo $this->input->ip_address() ?>",institute_id:"<? echo $idata->institute_id ?>","type":"visitor"},
				success : function(data){
					
					console.log(data);
					
				},
				error : function(data){
					
					console.log(data);
					
				}
				
			});

				

		})
	
	<? } ?>
	
	$("#csend_message").click(function(){
		  var message = $("#ctmessage").val();
		  var array = {"text":message};

		  $.ajax({

				url: '//74.208.185.113:4600/parse',
				type: 'POST',
				data: JSON.stringify(array),
				contentType: 'application/json; charset=utf-8',
				dataType: 'json',
        crossDomain: true,
				async: false,
			    beforeSend : function(){
					
//					$(".outgoing_msg").append('<div class="sent_msg"><p>Test which is a new approach to have allsolutions</p><span class="time_date"> 11:01 AM    |    June 9</span> </div></div>');
					
				},
				success: function(data) {
					
					$("#ctmessage").val("");
					console.log(data);
					var today = new Date();
					var month = getmonth(today.getMonth());
					
					var ampm = today.getHours() >= 12 ? 'PM' : 'AM';
					var time = today.getHours() + ":" + today.getMinutes() + " " + ampm + " | " + month + " " + today.getDate();
					
					$(".msg_history").append('<div class="outgoing_msg"><div class="sent_msg"><p>'+message+'</p><span class="time_date">'+time+'</span> </div></div><div class="incoming_msg"><div class="received_msg"><div class="received_withd_msg"><p>'+data.directives[0].payload.text+'</p><span class="time_date">'+time+'</span></div></div></div>');

					$.ajax({
						
						type : "post",
						data : {institute_id:"<? echo $idata->institute_id ?>",student_message:message,institute_reply:data.directives[0].payload.text},
						url : "<? echo base_url('front/institutes/saveChat') ?>",
						success : function(data){
							
							
							
						},
						error : function(data){
							
							
							
						}
						
					});	
                    var objDiv = document.getElementById("your_div");
                    objDiv.scrollTop = objDiv.scrollHeight;
					
				},
				error:function(data){
					
					/*$("#ctmessage").val("");
					var today = new Date();
					var month = getmonth(today.getMonth());
					
					var ampm = today.getHours() >= 12 ? 'PM' : 'AM';
					var time = today.getHours() + ":" + today.getMinutes() + " " + ampm + " | " + month + " " + today.getDate();
					
					$(".msg_history").append('<div class="outgoing_msg"><div class="sent_msg"><p>'+message+'</p><span class="time_date">'+time+'</span> </div></div><div class="incoming_msg"><div class="received_msg"><div class="received_withd_msg"><p>test</p><span class="time_date">'+time+'</span></div></div></div>');*/
					
					console.log(data);
				}

		  })
	  })
	  
  function getmonth(month){
	  
	  if(month == 0){
		  return "Jan"; 
	  }else if(month == 1){
		  return "Feb";
	  }else if(month == 2){
		  return "Mar";
	  }else if(month == 3){
		  return "Apr";
	  }else if(month == 4){
		  return "May";
	  }else if(month == 5){
		  return "June";
	  }else if(month == 6){
		  return "July";
	  }else if(month == 7){
		  return "Aug";
	  }else if(month == 8){
		  return "Sep";
	  }else if(month == 9){
		  return "Oct";
	  }else if(month == 10){
		  return "Nov";
	  }else if(month == 11){
		  return "Dec";
	  }
	  
  }	  

  $("#queSubmit").submit(function(e){
    e.preventDefault();
    submitQuery("#queSubmit");
  }); 

  $("#queSubmit1").submit(function(e){
    e.preventDefault();
    submitQuery("#queSubmit1");
  }); 

  function submitQuery(id){
    var fdata = $(id).serialize();
    
    $.ajax({

      type : "post",
      data : fdata,
      url : "<? echo base_url('front/institutes/insertQuestion') ?>",
      success : function(data){
        console.log(data);
        if(data == "success"){
          $(".smsg").html('<div class="alert alert-success">We have received your Question successfully, We will contact you soon.</div>');
          setTimeout(function(){location.reload()},3000)
        }else{
          $(".smsg").html('<div class="alert alert-danger">Error Occured please try again.</div>');
        }
      },
      error : function(data){
        
        console.log(data);
        
      }

    })
  
  }
    
</script>

<script type="text/javascript">

  $("#applynowSubmit").submit(function(e){
  
    e.preventDefault();
    var fdata = $("#applynowSubmit").serialize();
    
    $.ajax({

      type : "post",
      data : fdata,
      url : "<? echo base_url('front/institutes/applynow') ?>",
      success : function(data){
        
        if(data == "success"){
          $(".smsgapply").html('<div class="alert alert-success">You are successfully applied. We will contact you soon. </div>');
          setTimeout(function(){location.reload()},3000)
        }else{
          $(".smsgapply").html('<div class="alert alert-danger">Error Occured please try again.</div>');
        }
      },
      error : function(data){
        
        console.log(data);
        
      }

    })
  
  });

  $(".videoConferenceMeeting").on("click", function(){
    var institute_id = $(this).attr("data-iid");
      var admission_officer_id = $(this).attr("data-aid");
      var data = {institute_id: institute_id,admission_officer_id:admission_officer_id};
      $.ajax({
        type : "POST",
        data : data,
        url : "<? echo base_url('front/institutes/videoconferencemeeting') ?>",
        success : function(resulturl){
          if(resulturl){
            window.open(resulturl, '_blank');
          }else{
            toastr.remove();
            toastr['error']('No Session Found.', '', {
                positionClass: 'toast-bottom-right'
            });
          }
        }
      });


  });
  











  $(".videoConferenceMeeting").on("click", function(){
   
      toastr.options.timeOut = "false";
      toastr.options.closeButton = true;
      toastr.options.positionClass = 'toast-bottom-right';
      var institute_id = $(this).attr("data-iid");
      var admission_officer_id = $(this).attr("data-aid");

     
      var data = {institute_id: institute_id,admission_officer_id:admission_officer_id};
      $.ajax({
        type : "POST",
        data : data,
        url : "<? echo base_url('front/institutes/videoconferencemeeting') ?>",
        success : function(resulturl){
          if(resulturl){
            window.open(resulturl, '_blank');
          }else{
            toastr.remove();
            toastr['error']('No Session Found.', '', {
                positionClass: 'toast-bottom-right'
            });
          }
        }
      });
  });
  
  // Councellor Sessions
  function getSessions(councellor_id){
    $(".sessionsRow").show();
    $(".councellorSessions").html("");
    $(".book_now_sessions").hide();
    $(".inputRadio").prop("checked", false);
    $("#councellor_id").val('');
    $("#sesdate").val('');
    $("#sestime").val('');
    $("#sesduration").val('');
    $("#sesid").val('');
    var data = {councellor_id: councellor_id, student_id: <? echo $this->session->userdata("student_id");?>};
    $.ajax({
      type : "POST",
      data : data,
      url : "<? echo base_url('front/institutes/getcouncellorsessions') ?>",
      success : function(data){
        $(".councellorSessions").html(data);
      }
    });
  }
  function getDetails(exp_se_id){
    $("#sesid").val(exp_se_id);
    var date = $(".timing_"+exp_se_id).attr("data-date");
    var time = $(".timing_"+exp_se_id).attr("data-time");
    var duration = $(".timing_"+exp_se_id).attr("data-duration");
    if(date!='' && typeof date!='undefined') { $("#sesdate").val(date); }
    if(time!='' && typeof time!='undefined') { $("#sestime").val(time); }
    if(duration!='' && typeof duration!='undefined') { $("#sesduration").val(duration); } 
    $(".book_now_sessions").show();
  }
  $("#updatestudentsession").on('submit', function(e){
      toastr.options.timeOut = "false";
      toastr.options.closeButton = true;
      toastr.options.positionClass = 'toast-bottom-right';
      var amount = $("#sescost").val();
       e.preventDefault();
       var fdata = $("#updatestudentsession").serialize();
       fdata = fdata+"&student_id=" + <? echo $this->session->userdata("student_id"); ?>;
       var url = '<?php echo base_url("front/institutes/save_student_booking")?>';
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
            setTimeout(function(){ location.reload(); }, 1500);
          }else{
            toastr.remove();
            toastr['error'](str.Message, '', {
                positionClass: 'toast-bottom-right'
            });
          }
        }
        });
    });
  //Counsellor Sessions
	
</script>


<script>
//const chatbox = jQuery.noConflict();

//chatbox(() => {
  $(".chatbox-open").click(() =>
    $(".chatbox-popup, .chatbox-close").fadeIn()
  );

  $(".chatbox-close").click(() =>
    $(".chatbox-popup, .chatbox-close").fadeOut()
  );

  $(".chatbox-maximize").click(() => {
    $(".chatbox-popup, .chatbox-open, .chatbox-close").fadeOut();
    $(".chatbox-panel").fadeIn();
    $(".chatbox-panel").css({ display: "flex" });
  });

  $(".chatbox-minimize").click(() => {
    $(".chatbox-panel").fadeOut();
    $(".chatbox-popup, .chatbox-open, .chatbox-close").fadeIn();
  });

  $(".chatbox-panel-close").click(() => {
    $(".chatbox-panel").fadeOut();
    $(".chatbox-open").fadeIn();
  });
//});

$(".modalloginnext").on("click", function(){
  $("#emsg").hide();
  $("#emsg").html("");
});

</script>

<style type="text/css">button.cartbox-open {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 52px;
    height: 52px;
    color: #fff;
    background-color: #FF9800;
    background-position: center center;
    background-repeat: no-repeat;
    box-shadow: 12px 15px 20px 0 rgba(46, 61, 73, 0.15);
    border: 0;
    border-radius: 50%;
    cursor: pointer;
    margin: 16px;
  z-index: 999999999999;
}</style>
<? if($this->session->userdata("student_id")){ ?>
<!--<a href="<? echo base_url() ?>student/eventBag"><button class="cartbox-open"><i class="fa fa-shopping-bag fa-2x" aria-hidden="true"></i> </button></a>-->
<? } ?>

<div id="getScholarshipinfo" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style="margin-top: 120px">
      <div class="modal-header" style="display: block">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color: white">Merit Scholarship Description</h4>
      </div>
      <div class="modal-body">
        <div id="schlarshipinfo" style="text-align: justify"></div>
      </div>
    </div>

  </div>
</div>


<script>

  $(".viewScholarship").click(function(){
    
    var cid = $(this).attr("cid");
    
    $.ajax({
      
      type : "post",
      url : "<? echo base_url('front/institutes/getScholarshipinfo') ?>",
      data : {cid : cid},
      success : function(data){
        
        $("#schlarshipinfo").html(data);
        $("#getScholarshipinfo").modal("show");
        
      }
      
    });
    
  })

</script>
<? if($idata->chat_url!=''){//$this->session->userdata("student_id") &&  ?>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var
s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='<?php echo $idata->chat_url;?>';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<? } ?>