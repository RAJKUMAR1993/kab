<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>KAB Education Fair online</title>
<meta name="author" content="">
<link rel="icon" href="<?php echo base_url();?>assets/images/favicon.ico" type="image/x-icon">
<link href="<?php echo base_url();?>assets/css/template.css?<? echo time();?>" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/toastr/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script> -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
<style>
.rating i {
    color: #f00!important;
	}
	textarea {
	  width: 40%;
	  color: rgb(0, 0, 0);
	  border: 1px solid;
	  height: 66px;
	  resize: auto;
	  border-radius: 5px;
	}
	/* sticky button */	
		


	#feedback {
		height: 0px;
		width: 85px;
		position: fixed;
		right: 0;
		top: 55%;
		z-index: 1000;
		transform: rotate(-90deg);
		-webkit-transform: rotate(-90deg);
		-moz-transform: rotate(-90deg);
		-o-transform: rotate(-90deg);
		filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
	}
	#feedback a{
		display: block;
		background:#b6264e;
		height: 52px;
		padding-top: 10px;
		width: 155px;
		text-align: center;
		color: #fff;
		font-family: Arial, sans-serif;
		font-size: 17px;
		font-weight: bold;
		text-decoration: none;
	}
	#feedback a:hover {
		background:#00495d;
	}
	</style>
<style type="text/css">
  .ins .col-md-3 {
    position: relative;
    width: 100%;
    min-height: 1px;
    padding-right: 5px;
    padding-left: 5px;
  margin-bottom:30px;
}
.author-thumb img {
    width: 40px !important;
    height: 40px;
    border-radius: 60px;
    margin-right: 10px;
}
.ins h4{color:#0056b3; font-size:14px; font-weight:700; margin:0px;}
.ins p{color:#333; font-size:12px; font-weight:500; margin:0px; line-height:17px;}
.ins .media{ padding-top:10px;}
.ins-box {
    background: #fff;
    box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
    padding: 0px 5px 5px 5px;
    margin-top: 0px;
  min-height:70px;
}
.sidebar1 {
    background: #F17153;
    /* For browsers that do not support gradients */
    background: -webkit-linear-gradient(#F17153, #F58D63, #f1ab53);
    /* For Safari 5.1 to 6.0 */
    background: -o-linear-gradient(#F17153, #F58D63, #f1ab53);
    /* For Opera 11.1 to 12.0 */
    background: -moz-linear-gradient(#F17153, #F58D63, #f1ab53);
    /* For Firefox 3.6 to 15 */
    background: linear-gradient(#F17153, #F58D63, #f1ab53);
    /* Standard syntax */
    padding: 0px;
    min-height: 100%;
  width:100%;
  overflow:hidden;
}

.list {
    color: #fff;
    list-style: none;
    padding-left: 0px;
  
}
.list::first-line {
    color: rgba(255, 255, 255, 0.5);
}
/*.list> li, h5 {
    padding: 5px 0px 5px 40px;
}*/
.list>li{border-bottom:solid 1px #fca08a;}
.list>li:hover {
    background-color: rgba(255, 255, 255, 0.2);
    border-left: 5px solid white;
    color: white;
    font-weight: bolder;
    padding-left: 35px;
}
.list>li.active {
    background-color: rgba(255, 255, 255, 0.2);
    border-left: 5px solid white;
    color: white;
    font-weight: bolder;
    padding-left: 35px;
}


.form-control-borderless {
        border: none;
      }

      .form-control-borderless:hover, .form-control-borderless:active, .form-control-borderless:focus {
        border: none;
        outline: none;
        box-shadow: none;
      }

      .card-body {
        padding-bottom: 12px;
        padding-top: 12px;
        padding-right: 12px;
        padding-left: 12px;
        background: #607d8b7d;
      }

      .src_fild {
        border-radius: 0;
      }

      .src_btn {
        line-height: 0.5;
        height: 38px;
        border-radius: 0;
      }
      .currentpage{
        background-color: #eee;
      }
</style>
<script>
$(document).ready(function(){
    $('.customer-logos').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 4
            }
        }, {
            breakpoint: 520,
            settings: {
                slidesToShow: 3
            }
        }]
    });
});
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
<link rel="stylesheet" href="https:////cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https:////cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"></script>

<link href="<? echo base_url('assets/') ?>chatbot1.css" rel="stylesheet">

<!-- BASE CSS -->
    <link href="<?php echo base_url();?>assets/udema/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/udema/css/style.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/udema/css/vendors.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/udema/css/icon_fonts/css/all_icons.min.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="<?php echo base_url();?>assets/udema/css/custom.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/udema/css/tables.css" rel="stylesheet">
	
	<!-- Modernizr -->
	<script src="<?php echo base_url();?>assets/udema/js/modernizr.js"></script>
</head>
<? 
$logo = $this->db->get_where("tbl_admin")->row()->logo;	
$adlogo =  ($logo != "") ? $logo : 'assets/udema/img/logo.jpeg'; 
?>	
<body>
	
	<div id="page">
	
	<header class="header menu_2">
		<div id="preloader"><div data-loader="circle-side"></div></div><!-- /Preload -->
		<div id="logo">
			<a href="<?php echo base_url();?>"><img src="<?php echo base_url().$adlogo;?>" width="100" data-retina="true" alt=""></a>
		</div>
		<!-- /top_menu -->
		<a href="#menu" class="btn_mobile">
			<div class="hamburger hamburger--spin" id="hamburger">
				<div class="hamburger-box">
					<div class="hamburger-inner"></div>
				</div>
			</div>
		</a>
		<nav id="menu" class="main-menu">
			<ul>
				
				<?php
				$menu = $this->db->get_where("tbl_dynamic_menu", ["status" => 1])->result();
				foreach ($menu as $m) {
					if($m->menu_link!='front/auditorium/mainAuditorium'){
				?>
						<li><span><a href="<? echo base_url().$m->menu_link;?>"><?php echo $m->menu_name;?></a></span></li>
				<?php
					}
					else{ if($m->status==1){
				?>
						<li><span><a href="javascript:void(0)">Auditorium</a></span>
						<ul>
							<li><a href="<? echo base_url().$m->menu_link;?>"><?php echo $m->menu_name;?></a></li>
							<? $auds = $this->db->group_by("title")->get_where("tbl_institute_auditorium",["date >="=>date("Y-m-d")])->result(); 
							   if($auds){	
								   foreach($auds as $a){
									    $title = str_replace(" ","-",$a->title);
							?>
									<li><a href="<? echo base_url('front/auditorium/view/').$title ?>"><? echo $a->title ?></a></li>
							<? }} ?>	
						</ul>
					</li>
				<?php
						}
					}
				}
				?>
				
				<? if($this->session->userdata("student_id")){ ?>
				
				<li><span><a href="#0" class="rounded" style="background-color: #FFC107;color: #333;padding: 4px 15px;"><? echo $this->session->userdata("student_name"); ?></a></span>
				    <ul>
						<li><a href="<? echo base_url().'student/dashboard'?>">Dashboard</a></li>
					    <li><a href="<? echo base_url('student/login/logout')?>">Logout</a></li>
					</ul>
				</li>
				
			  <? } else if($this->session->userdata("institute_id")){ ?>

				<li><span><a href="<? echo base_url().'institute/dashboard'?>" class="rounded" style="background-color: #FFC107;color: #333;padding: 4px 15px;">Dashboard</a></span>
				    <ul>
					    <li><a href="<? echo base_url('institute/login/logout')?>">Logout</a></li>
					</ul>
				</li>
				
			  <? } else{ ?>  
			    <li><span><a href="#0" class="rounded" style="background-color: #FFC107;color: #333;padding: 4px 15px;">Login / Register</a></span>
				    <ul>
						<li><a href="<? echo base_url()?>student/login">Student</a></li>
						<li><a href="<? echo base_url()?>institute/login">Institute</a></li>
					</ul>
				</li>
				
			  <? } ?>
				
					
			</ul>
		</nav>
	</header>
	<div id="feedback">
			<a href="#"  onclick="openModal('feedbacki')">Feedback</a>
		</div>
		
 <? if(current_url()==base_url()){if(($this->session->userdata("student_id")) || ($this->session->userdata("guest_email"))){ ?>
 
	 <button type="button" class="btn_live_chat btn btn-primary btn-sm btn-icon chatbox-open">
		<i class="fa fa-comment" aria-hidden="true"></i><br><small style="font-size: 10px;">Chat</small>
	 </button>
	 
 <? }else{ ?>
 
 	 <button type="button" data-toggle="modal" data-target="#guest_login1" class="btn_live_chat btn btn-primary btn-sm btn-icon chatbox-open">
		<i class="fa fa-comment" aria-hidden="true"></i><br><small style="font-size: 10px;">Chat</small>
	 </button>	 
	 
 <? }} ?>	 
	 
 <button class="chatbox-close">
    <i class="fa fa-close fa-2x" aria-hidden="true"></i>
 </button>
 
 <section class="chatbox-popup">
  <div class="chatbox-popup__header">
    <aside style="flex:3">
      <i class="fa fa-user-circle fa-4x chatbox-popup__avatar" aria-hidden="true"></i>
    </aside>
    <aside style="flex:8">
      <h1 style="color:white;font-weight:bold;"><? //echo $idata->institute_name ?>Kab Consultants</h1> <i class="fa fa-circle" style="color: green" aria-hidden="true"></i> (Online)
    </aside>
    <!--<aside style="flex:1">
      <button class="chatbox-maximize"><i class="fa fa-window-maximize" aria-hidden="true"></i></button>
    </aside>-->
  </div>
 
  
 <main class="chatbox-panel__main" style="flex:1">
   
    <div class="mesgs">
         
       <div class="msg_history" id="your_div" style="max-height: 250px;overflow-y: scroll;">
           
            

       </div>
     </div>
   
  </main>

  
  <form method="post" id="csend_message">
   
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
  </form>
</section>
	
