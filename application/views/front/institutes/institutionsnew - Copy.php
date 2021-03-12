<? $this->load->view("front/includes/new_header");?>

<link href="<? echo base_url('assets/pnotify/pnotify.custom.min.css') ?>" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
		<section id="hero_in" class="courses" style="height: 90px">
			<div class="wrapper">
				
			</div>
		</section>
		<!--/hero_in-->


		<div class="container-fluid margin_60_35" style="padding-top:30px">
			<div class="row">
			
					
			<div id="mySidenav" class=" col-lg-2">

				<div style="background-color:#fff;width:100%;box-shadow: 1px 1px 2px #000000;">
<ul class="list-group">
<!--
	<li class="list-group-item">
		<a href="<? //echo base_url(); ?>">
			<i class="fa fa-home fa-3x"></i><br/>Home
		</a>
	</li>
-->
	<?php
	foreach ($categories as $category) {

		echo "<form style='display:none;' action='".base_url()."front/institutes/list' method='POST' class='getInstitutes_".$category->category_id."'><input type='number' name='category_id' value='".$category->category_id."'/></form>";
	?>
	<li class="list-group-item">
		<a href="#" onclick='submitForm(<? echo $category->category_id ?>)'>
			<i class="fa fa-building-o fa-2x"></i><br/><? echo $category->category_name ?>
		</a>
	</li>
	<? } ?>	
	
</ul>
</div>

<!-- 
			
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="fa fa-bars"></i></a>
  <a href="javascript:void(0)" class="openbtn" onclick="openNav()" style="display: none"><i class="fa fa-bars"></i></a> -->
  
 <!--  <?php
	foreach ($categories as $category) {

		echo "<form style='display:none;' action='".base_url()."front/institutes/list' method='POST' class='getInstitutes_".$category->category_id."'><input type='number' name='category_id' value='".$category->category_id."'/></form>";
	?>
	
	
		  <a href="#" onclick='submitForm(<? echo $category->category_id ?>)'><? echo $category->category_name ?></a>
		  
	<? } ?>	 -->  
</div>

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
		
			
				<div class="col-lg-10" id="main"  style="padding-top:0px;">
				
			    	
					<? $advertise = $this->db->order_by("id","desc")->get_where("tbl_advertise",["status"=>"Active","is_deleted"=>0])->row(); 

					   if($advertise){	
					?>
				    <div class="row" id="advertiseimage">
					
						<div class="container-fluid">
							<span><i class="fa fa-close closeadv" data-toggle="tooltip" title="Close Advertisement" style="color: red;font-size: 25px;position: absolute;float: right;right: 25px;top: 5px;cursor: pointer"></i></span>
							
							<? if($advertise->type == "image"){ ?>
							
								<a href="<? echo $advertise->navigation_link ?>" target="<? echo $advertise->target ?>"><img src="<? echo base_url().$advertise->image ?>" style="width: 100%; height: 300px;margin-bottom: 10px"></a>
							
							<? }else{ ?>
							
								<iframe src="<? echo $advertise->iframe_url ?>" style="width: 100%; height: 300px;margin-bottom: 10px"></iframe>			
									
							<? } ?>
									
						</div>
						
					</div>
					
					<? } ?>
				
					<div class="row">
						
						<div class="col-lg-12">
							
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
					
					<div class="row searchResults">
					
						<?php if(count($inst) > 0){ foreach($inst as $in){?>
						
							<div class="col-md-4">
								<div class="box_grid wow" style="height: 320px">
								<a class="getloginuser" studentid="<? if($this->session->userdata("student_id")){ echo $this->session->userdata("student_id"); } ?>" instituteid="<?php echo $in->institute_id ; ?>" href="<?php echo base_url(); ?>exhibitors/<?php echo str_replace(" ","-",$in->institute_name) ; ?>">
									<figure class="block-reveal" style="height: 151px">
										<div class="block-horizzontal"></div>
										
										<? if($in->institute_video) { ?>
										
<!--											<iframe class="embed-responsive-item" src="<? //if($in->institute_video){ echo base_url().$in->institute_video; } else { echo base_url().$in->theme_picture; } ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>-->
											
											
											<video controls> 
												<source src="<? if($in->institute_video){ echo base_url().$in->institute_video; } else { echo base_url().$in->theme_picture; } ?>">
											</video>
											
										<? }else{ ?>
										
											<img src="<?php echo base_url();?><?php echo $in->theme_picture; ?>" class="img-fluid" alt="">
											
										<? } ?>	
										
										<div class="overlay">
<!--												<a href="#" class="icon" title="User Profile">-->
												  <span style="padding: 5px;background-color: black;">
												  	<i class="icon icon-list <? echo ($this->session->userdata("student_id")) ? 'addtolist' :'' ?>" student_id="<? echo ($this->session->userdata("student_id")) ?>" institute_id="<? echo $in->institute_id; ?>" video_url="<?  echo $in->institute_video_url; ?>" style="font-size: 15px;color: white;cursor: pointer" data-toggle="<? echo ($this->session->userdata("student_id")) ? 'tooltip' : 'modal' ?>" title="Add To List" data-target="<? echo ($this->session->userdata("student_id")) ? '' : '#myModalLoginNow' ?>"></i>
												  </span>
<!--												</a>-->
											</div>
										
									</figure>
									<div class="wrapper" style="padding: 15px; height: 110px;">
<!--										<small>Category</small>-->
										<h3><?php echo $in->institute_name; ?></h3>
										<p style="margin-bottom: 0px"><?php echo ($in->city)."<br>".$in->state; ?></p>
										
									</div>
									<ul style="text-align: center">
										<li style="float: none;">Read More</li>
									</ul></a>
								</div>
							</div>

						<? }}else{
	
							echo '<p style="text-align:center;font-size:18px;padding-left:20px;">No Institutes Found</p>';
							
							} ?>
						
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
		<div class="bg_color_1">
			<div class="container margin_60_35">
				<div class="row">
					<div class="col-md-4">
						<a href="#0" class="boxed_list">
							<i class="pe-7s-help2"></i>
							<h4>24/7 Support</h4>
<!--							<p>Cum appareat maiestatis interpretaris et, et sit.</p>-->
						</a>
					</div>
					<div class="col-md-4">
						<a href="#0" class="boxed_list">
							<i class="pe-7s-wallet"></i>
							<h4>Payments and Refunds</h4>
<!--							<p>Qui ea nemore eruditi, magna prima possit eu mei.</p>-->
						</a>
					</div>
					<div class="col-md-4">
						<a href="#0" class="boxed_list">
							<i class="pe-7s-note2"></i>
							<h4>Quality Standards</h4>
<!--							<p>Hinc vituperata sed ut, pro laudem nonumes ex.</p>-->
						</a>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /bg_color_1 -->
	</main>

<? $this->load->view("front/includes/new_footer");?>

<script type="text/javascript" src="<? echo base_url('assets/pnotify/pnotify.custom.min.js') ?>"></script>

<?php $this->load->view("student/login/login_popup")?>
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