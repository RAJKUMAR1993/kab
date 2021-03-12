<? $this->load->view("front/includes/new_header");?>

<link href="<? echo base_url('assets/pnotify/pnotify.custom.min.css') ?>" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
 <link href="<?php echo base_url(); ?>/assets/template.css?1600450516" rel="stylesheet">
 <script src="https://kit.fontawesome.com/b31e06099e.js" crossorigin="anonymous"></script>
<style>

.page-item a{
		color: dimgrey !important;
	} 

.overlay {
  position: absolute;
  top: 5px;
/*  bottom: 0;*/
/*  left: 0;*/
  right: 5px;
/*
  height: 100%;
  width: 100%;
*/
  opacity: 0;
  transition: .3s ease;
/*  background-color: red;*/
}

figure:hover .overlay {
  opacity: 1;
}	
	
	
/* The side navigation menu */
.sidenav {
  height: 100%; /* 100% Full-height */
  width: 250px; /* 0 width - change this with JavaScript */
/*  position: fixed;  Stay in place */
/*  z-index: 1;  Stay on top */
  top: 30px; /* Stay at the top */
  left: 0;
/*  background-color: #111;  Black*/
/*  overflow-x: hidden;  Disable horizontal scroll */
/*  padding-top: 60px;  Place content 60px from the top */
  transition: 0.5s; /* 0.5 second transition effect to slide in the sidenav */
}

/* The navigation menu links */
.sidenav a {
  padding: 8px 8px 8px 16px;
  text-decoration: none;
  font-size: 14px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

/* When you mouse over the navigation links, change their color */
.sidenav a:hover {
  color: darkgrey;
}

/* Position and style the close button (top right corner) */
.sidenav .closebtn {
  position: absolute;
/*  top: 0;*/
  right: 25px;
  font-size: 20px;
  margin-left: 50px;
  color: dimgray;	
}
	
.sidenav .openbtn {
/*  position: absolute;*/
/*  top: 0;*/
  right: 25px;
  font-size: 20px;
  margin-left: 15px;
  color: dimgray;
}	

/* Style page content - use this if you want to push the page content to the right when you open the side navigation */
#main {
  transition: margin-left .5s;
  padding: 20px;
}

/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}	
.list-group-item{
	font-size:10px;
	padding:12px;
	text-align:center;
}	
video {
  opacity: 1;
}
.iconDetails {
	margin-left:2%;
	float:left; 
	height:40px;
	width:40px;	
} 

.container2 {
	width:100%;
	height:auto;
	padding:1%;
}

.container2 span {
    margin:0px;
}
	
.user-profile {
    width: 50px;
    height: 50px;
    background-color: #f1f1f1;
}
.navbar .menu-bar {
    display: inline-block;
    width: 50px;
    height: 50px;
    margin-right: 10px;
    position: relative;
    cursor: pointer;
}
.navbar .menu-bar .bars {
    position: relative;
    top: 50%;
    width: 30px;
    height: 2px;
    background-color: #333;
}
.navbar .menu-bar .bars::after {
    content: "";
    position: absolute;
    bottom: -8px;
    width: 100%;
    height: 2px;
    background-color: #333;
}
.navbar .menu-bar .bars::before {
    content: "";
    position: absolute;
    top: -8px;
    width: 100%;
    height: 2px;
    background-color: #333;
}
.navbar ul.navbar-nav li.nav-item.ets-right-0 .dropdown-menu {
    left: auto;
    right: 0;
    position: absolute;
}
.side-bar {
    position: absolute;
    /*	top:81px;*/
    left: 0;
    padding: 15px;
    display: inline-block;
    width: 100px;
    background-color: #fff;
    box-shadow: 0px 0px 8px #ccc;
  /*  height: 100vh;*/
    transition: ease 0.5s;
  /*  overflow-y: auto;*/
}
.main-body-content {
    display: inline-block;
    /*padding: 15px;*/
  		/*background-color:#eef4fb;*/
  		/*height: 100vh;*/
    height: 100%;
    padding-left: 100px;
    transition: ease 0.5s;
	min-height: 500px;
}
/*.ets-pt{
  		padding-top: 100px;
  	}*/
.main-admin.show-menu .side-bar {
    width: 250px;
}
.main-admin.show-menu .main-body-content {
    padding-left: 265px;
}
.main-admin.show-menu .navbar .menu-bar .bars {
    width: 15px;
}
.main-admin.show-menu .navbar .menu-bar .bars::after {
    width: 10px;
}
.main-admin.show-menu .navbar .menu-bar .bars::before {
    width: 25px;
}
.main-admin.show-menu .side-bar-links {
    opacity: 1;
}
.main-admin.show-menu .side-bar .side-bar-icons {
    opacity: 0;
}
/**** end effacts ****/
.side-bar .side-bar-links {
    opacity: 0;
    transition: ease 0.5s;
}
.side-bar .side-bar-links ul.navbar-nav li a {
    font-size: 12px;
    color: #000;
    font-weight: 500;
    padding: 10px;
}
.side-bar .side-bar-links ul.navbar-nav li a i {
    font-size: 20px;
    color: #8ac1f6;
}
.side-bar .side-bar-links ul.navbar-nav li a:hover, .side-bar-links ul.navbar-nav li a:focus {
    text-decoration: none;
    background-color: #e5e5e5;
    color: #000;
}
.side-bar .side-bar-links ul.navbar-nav li a:hover i {
    color: #fff;
}
.side-bar .side-bar-logo img {
    width: 100px;
    height: 100px;
}
.side-bar .side-bar-icons {
    position: absolute;
    top: 20px;
    right: 0;
    width: 100px;
    opacity: 1;
    transition: ease 0.5s;
}
.side-bar .side-bar-icons .side-bar-logo img {
    width: 50px;
    height: 50px;
    object-fit: cover;
}
.side-bar .side-bar-icons .side-bar-logo h5 {
    font-size: 14px;
}
.side-bar .side-bar-icons .set-width {
    color: #000;
    font-size: 22px;
}
.side-bar .side-bar-icons .set-width:hover, .side-bar .side-bar-icons .set-width:focus {
    color: #8ac1f6;
    text-decoration: none;
}
.side-bar-icons small {
    font-size: 12px;
    line-height: 15px;
}
.side-bar-icons p {
    font-size: 12px;
    line-height: 15px;
	padding: 0px 5px;
}
.navbar-nav img {
    padding-right: 10px;
    padding-bottom: 5px;
}
.video-fluid {
    width: 100%;
    height: auto;
}
.vid-box p {
font-size: 12px;
margin: 0px;
}

.vid-box {
background: #fff;
-webkit-box-shadow: 0px 0px 30px 0px rgba(0, 0, 0, 0.1);
-moz-box-shadow: 0px 0px 30px 0px rgba(0, 0, 0, 0.1);
box-shadow: 0px 0px 30px 0px rgba(0, 0, 0, 0.1);
margin-bottom: 20px;
min-height: 262px;
}
.vid-box img {
    border: solid 1px #ccc;
}
.vid-box h4 {
    font-size: 14px;
    line-height: 1rem;
    color: #000;
    margin: 0px;
}
	
/*
.sticky1 {
  position: fixed;
  top: 88px;
}	
*/
	
@media screen and (max-width: 992px) {
.navbar .menu-bar{ display:none;}
}	
	
	
</style>
				

<script>

/* Set the width of the side navigation to 250px and the left margin of the page content to 250px and add a black background color to body */
function openNav() {
  document.getElementById("mySidenav").style.marginLeft = "0px";
  document.getElementById("main").style.marginLeft = "0px";
	
  $(".sidenav").removeClass("col-lg-1");	
  $(".sidenav").addClass("col-lg-2");	
  	
  $(".openbtn").hide();	
  $(".closebtn").show();	
}

/* Set the width of the side navigation to 0 and the left margin of the page content to 0, and the background color of body to white */
function closeNav() {
  document.getElementById("mySidenav").style.marginLeft = "-30px";
  document.getElementById("main").style.marginLeft = "0px";
	
  $(".sidenav").removeClass("col-lg-2");	
  $(".sidenav").addClass("col-lg-1");	
  	
  $(".closebtn").hide();	
  $(".openbtn").show();	

}
</script>							

<main>
		<section id="hero_in" class="courses" style="height: 70px">
			<div class="wrapper">
				
			</div>
		</section>
		<!--/hero_in-->


		<div class="container-fluid margin_60_35" style="padding-top:30px">
			<div class="row">
			
					
	

				<!-- /aside -->

<!--
			<div class="main col-lg-3">
				<p>This menu is inspired by the left side menu found on YouTube. When clicking on the menu label and icon, the main menu appears beneath and the menu icon slides to the right side while the label slides up. To close the menu, the menu icon needs to be clicked again.</p>
				<div class="side">
					<nav class="dr-menu">
						<div class="dr-trigger"><span class="dr-icon dr-icon-menu"></span><a class="dr-label">Account</a></div>
						<ul>
							<li><a class="dr-icon dr-icon-user" href="#">Jason Quinn</a></li>
							<li><a class="dr-icon dr-icon-camera" href="#">Videos</a></li>
							<li><a class="dr-icon dr-icon-heart" href="#">Favorites</a></li>
							<li><a class="dr-icon dr-icon-bullhorn" href="#">Subscriptions</a></li>
							<li><a class="dr-icon dr-icon-download" href="#">Downloads</a></li>
							<li><a class="dr-icon dr-icon-settings" href="#">Settings</a></li>
							<li><a class="dr-icon dr-icon-switch" href="#">Logout</a></li>
						</ul>
					</nav>
				</div>
			</div>
-->
		
			
				<div class="col-lg-12" id="main"  style="padding-top:0px;">
				
			    	
					<? $advertisements = $this->db->order_by("id","RANDOM")->get_where("tbl_advertise",["status"=>"Active","is_deleted"=>0])->result(); 

					   if($advertisements){	
					?>
							<!-- <span><i class="fa fa-close closeadv" data-toggle="tooltip" title="Close Advertisement" style="color: red;font-size: 25px;position: absolute;float: right;right: 25px;top: 5px;cursor: pointer"></i></span> -->
							
							  
									
						<div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">

						  <div class="carousel-inner">

						  <? foreach($advertisements as $key => $advertise){ ?>


								<div class="carousel-item <? echo ($key == 0) ? 'active' : '' ?>">

									<? if($advertise->type == "image"){ ?>

										<a href="<? echo $advertise->navigation_link ?>" target="<? echo $advertise->target ?>">
										<img src="<? echo base_url().$advertise->image ?>" style="width: 100%;margin-bottom: 10px"></a>

									<? }else{ ?>

										<iframe src="<? echo $advertise->iframe_url ?>" style="width: 100%;margin-bottom: 10px;height:400px"></iframe>			

									<? } ?>

								</div>

						  <? } ?>

						  </div>	  	  

						</div>
					
					<? } ?>
					
				</div>	
			</div>	
				
					<div class="row">
						<div class="col-lg-2"></div>
						<div class="col-lg-10">
							
<!--							<form>-->
								<div id="custom-search-input" style="margin: 0; margin-bottom: 15px;width: 100%;">
									<div class="input-group">
										<input type="text" class="search-query src_fild" name="country" id="country" placeholder="Search Institutes">
										<input type="submit" class="btn_search src_btn" name="search" id="search" value="Search">
									</div>
								</div>
<!--							</form>-->
							
						</div>
						
					</div>
				
					
			<div id="page-container" class="main-admin">
			  <nav class="navbar navbar-expand-lg  bg-light w-100"> <a class="navbar-brand" href="#"></a>
				<div id="open-menu" class="menu-bar">
				  <div class="bars"></div>
				</div>
			  </nav>
			  <div class="side-bar" id="navbar">
				<div class="side-bar-links">
				  <ul class="navbar-nav">
					<li class="nav-item"> <a href="<? echo base_url('exhibitors'); ?>" class="nav-links d-block"><img src="<?php echo base_url();?>assets/icons/dedent-all.png"/> All</a> </li>
					
					<?php
					  $imgs = [base_url()."assets/icons/1.png",base_url()."assets/icons/2.png",base_url()."assets/icons/3.png",base_url()."assets/icons/4.png"];
					  
					$i = 1;
					foreach ($categories as $category) {
						
						$logo_image = ($category->logo_image != "") ? base_url().$category->logo_image : base_url()."assets/icons/2.png";
						
						echo "<form style='display:none;' action='".base_url()."front/institutes/list' method='POST' class='getInstitutes_".$category->category_id."'><input type='number' name='category_id' value='".$category->category_id."'/></form>";
					?>
					<li class="nav-item"> 
						<a href="#" onclick="submitForm(<? echo $category->category_id ?>)" class="nav-links d-block">
						<img src="<?php echo $logo_image;?>"/></i> <? echo $category->category_name ?></a> 
					</li>
					
					<? } ?>
				  </ul>
				</div>
				<div class="side-bar-icons"> 
				  <!-- <div class="side-bar-logo text-center py-3">
							<img src="" class="img-fluid rounded-circle border bg-secoundry mb-3">
							<h5>Company Name</h5>
						</div> -->
				  <div class="icons d-flex flex-column align-items-center"> <a href="<? echo base_url('exhibitors'); ?>" class="set-width text-center display-inline-block my-11"><img src="<?php echo base_url();?>assets/icons/dedent-all.png"/> <br/>
					<p>All</p>
					</a> 
					<?php
					$i = 1;
					foreach ($categories as $category1) {
						
						$logo_image = ($category1->logo_image != "") ? base_url().$category1->logo_image : base_url()."assets/icons/2.png";
						
						echo "<form style='display:none;' action='".base_url()."front/institutes/list' method='POST' class='getInstitutes_".$category1->category_id."'><input type='number' name='category_id' value='".$category1->category_id."'/></form>";
					?>
					
						<a href="#" onclick="submitForm(<? echo $category1->category_id ?>)" class="set-width text-center display-inline-block my-1"><img src="<?php echo $logo_image;?>"/><br/>
							<p><? echo $category1->category_name ?></p></a>
						
					<? } ?>	
					 
					</div>
				</div>
			  </div>	
				
				<div class="main-body-content w-100 ets-pt">
						<div class="row searchResults">
					
						<?php if(count($inst) > 0){ foreach($inst as $in){?>
						
							<div class="col-lg-3">
								<div class="vid-box">
								  
								  
								  <? if($in->institute_video) { ?>
								  
									<video class="video-fluid"  loop controls muted> 
										<source src="<? if($in->institute_video){ echo base_url().$in->institute_video; } else { echo base_url().$in->theme_picture; } ?>">
									</video>

								<? }else{ ?>

									<? if(file_exists($in->theme_picture)){ ?>
											<img src="<? echo base_url().$in->theme_picture ?>" class="img-fluid" alt="">
								<? }else{ ?>	
											<img src="<? echo base_url('assets/images/default.jpg') ?>" class="img-fluid" alt="">
								<? } ?>

								<? } ?>	
								  
								  
								  <div class="media p-3"> 
								  
								  	<? if(file_exists($in->theme_logo)){ ?>
										<img src="<? echo base_url().$in->theme_logo ?>" class="mr-3 rounded-circle" style="width:60px;">
									<? }else{ ?>	
										<img src="<? echo base_url('assets/images/default-logo.jpg') ?>" class="mr-3 rounded-circle" style="width:60px;">
									<? } ?>
								  
									<div class="media-body">
									  	<h4>
									  		<a class="getloginuser" studentid="<? if($this->session->userdata("student_id")){ echo $this->session->userdata("student_id"); } ?>" instituteid="<?php echo $in->institute_id ; ?>" href="<?php echo base_url(); ?>exhibitors/<?php echo str_replace(" ","-",$in->institute_name) ; ?>" style="color: black"><?php echo $in->institute_name; ?></a>
										</h4>
									  
									  <p><?php echo ($in->city).", ".$in->state; ?></p>
									</div>
								  </div>
								</div>
							</div>
							

						<? }}else{
	
							echo '<p style="text-align:center;font-size:18px;padding-left:20px;">No Institutes Found</p>';
							
							} ?>
						
					</div>
					
				</div>
				
			</div>
					
					<!-- /row -->
					<div class="row">
						<div class="col-md-12">
							<?php echo $pagination; ?>
						</div>
					</div> 
				</div>
				<!-- /col -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
		<!-- <div class="bg_color_1">
			<div class="container margin_60_35">
				<div class="row">
					<div class="col-md-4">
						<a href="#0" class="boxed_list">
							<i class="pe-7s-help2"></i>
							<h4>24/7 Support</h4>
						</a>
					</div>
					<div class="col-md-4">
						<a href="#0" class="boxed_list">
							<i class="pe-7s-wallet"></i>
							<h4>Payments and Refunds</h4>
						</a>
					</div>
					<div class="col-md-4">
						<a href="#0" class="boxed_list">
							<i class="pe-7s-note2"></i>
							<h4>Quality Standards</h4>
						</a>
					</div>
				</div>
			</div>
		</div> -->
		<!-- /bg_color_1 -->
	</main>

<? $this->load->view("front/includes/new_footer");?>

<script type="text/javascript" src="<? echo base_url('assets/pnotify/pnotify.custom.min.js') ?>"></script>
<script type="text/javascript" src="<? echo base_url('assets/udema/js/bootstrap.min.js') ?>"></script>

<?php $this->load->view("student/login/login_popup")?>

<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery("#open-menu").click(function(){
			if(jQuery('#page-container').hasClass('show-menu')){
			jQuery("#page-container").removeClass('show-menu');
		}

			else{
			jQuery("#page-container").addClass('show-menu');
			}
		});
	});
</script>

<script>
/*var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 5000); // Change image every 2 seconds
}*/

$('.carousel').carousel()

</script>




<script type="text/javascript">
	
	$(".closeadv").click(function(){
		
		$("#advertiseimage").hide();
		
	})
	
	
	$(".addtolist").click(function(){
		
		var sid = $(this).attr("student_id");
		var iid = $(this).attr("institute_id");
		var vurl = $(this).attr("video_url");
		
		$.ajax({
			
			type : "post",
			url : "<? echo base_url('front/institutes/addtolist') ?>",
			data : {student_id:sid,institute_id:iid,video_url:vurl},
			success:function(data){
				
				if(data == "success"){
					
					new PNotify({
						title: 'Success',
						text: 'Added To List',
						type:'success',
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
				
				if(data == "exists"){
					
					new PNotify({
						title: 'Warning',
						text: 'Already Added To List',
						type:'warning',
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
			error:function(data){
				
				console.log(data);
				
			}
			
		});
		
	})
	
	
	
//  $(document).ready(function(){
    $("#search").on("click", function(){
      var query = $("#country").val();
	  //alert(query);
	  var url = '<?php echo base_url("front/institutes/searchnew") ?>'; 
        $.ajax({
                url: url,
                method: 'POST',
                data: {query:query},
                success: function(data)
                {
				
                  $('.searchResults').html(data);
                }
        });
    });
//  });
  function submitForm(cid){
  	$(".getInstitutes_"+cid).submit();
  }
</script>

<script type="text/javascript">
	$(".getloginuser").on('click', function(event){
		var stid = $(this).attr("studentid");
	   	var insid = $(this).attr("instituteid");
	   	//alert(stid + insid );
	   	if(stid != ""){
	   		
	   	
	   	var url = '<?php echo base_url("front/institutes/insertstdip") ?>'; 
        $.ajax({
                url: url,
                method: 'POST',
                data: {stid:stid,insid:insid},
                success: function(data)
                {
				console.log(data);
                }
        });
        }

	});
</script>