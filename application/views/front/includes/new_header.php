<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Udema a modern educational site template">
    <meta name="author" content="Ansonika">
    <title>KAB Education Fair online</title>

    <!-- Favicons-->
    <link rel="icon" href="<?php echo base_url();?>assets/images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="<?php echo base_url();?>assets/udema/img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="<?php echo base_url();?>assets/udema/img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="<?php echo base_url();?>assets/udema/img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="<?php echo base_url();?>assets/udema/img/apple-touch-icon-144x144-precomposed.png">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- BASE CSS -->
    <link href="<?php echo base_url();?>assets/udema/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/udema/css/style.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/udema/css/vendors.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/udema/css/icon_fonts/css/all_icons.min.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
	<link href="<?php echo base_url();?>assets/udema/css/blog.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/udema/css/custom.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/udema/css/tables.css" rel="stylesheet">
	<link href="<? echo base_url('assets/') ?>chatbot1.css" rel="stylesheet">
	
	<!-- Modernizr -->
	<script src="<?php echo base_url();?>assets/udema/js/modernizr.js"></script>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/toastr/toastr.min.css">
	<link href="<?php echo base_url(); ?>/assets/template.css?1600450516" rel="stylesheet">
	
	
	<!-- SPECIFIC CSS -->
    <link href="<?php echo base_url();?>assets/udema/layerslider/css/layerslider.css" rel="stylesheet">
	
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
</head>
<body>

<? 
$logo = $this->db->get_where("tbl_admin")->row()->logo;	
$adlogo =  ($logo != "") ? $logo : 'assets/udema/img/logo.jpeg'; 
?>	
	
	<div id="page">
	
	<header class="header menu_2">
		<div id="preloader"><div data-loader="circle-side"><img src="<?php echo base_url();?>assets/animatedgifs/atom.gif"></div></div><!-- /Preload -->
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
				
				<!-- <li><span><a href="#0" class="rounded" style="background-color: #FFC107;color: #333;padding: 4px 15px;"><? echo $this->session->userdata("institute_name"); ?></a></span>
				    <ul>
						<li><a href="<? echo base_url().'institute/dashboard'?>">Dashboard</a></li>
					    <li><a href="<? echo base_url('institute/login/logout')?>">Logout</a></li>
					</ul>
				</li> -->
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
	<!-- /header -->
	<div id="feedback">
			<a href="#"  onclick="openModal('feedbacki')">Feedback</a>
		</div>
 
 <? $chatbox_status = $this->db->get_where("tbl_admin")->row()->website_main_chat_box;
 if(current_url()==base_url() && $chatbox_status==1){if(($this->session->userdata("student_id")) || ($this->session->userdata("guest_email"))){ ?>
 
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

 

