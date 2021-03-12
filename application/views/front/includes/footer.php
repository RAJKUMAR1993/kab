<style type="text/css">
    .follow_us span {
      color: #fff;
      text-transform: uppercase;
      font-weight: 500;
      letter-spacing: 2px;
      font-size: 13px;
      font-size: 0.8125rem;
      display: inline-block;
      margin-right: 10px;
      margin-bottom: 5px;
    }
</style>
<footer>
		<div class="container" style="padding: 5px">
			<div class="row">
           
            <div class="col-lg-4 col-md-12">
				    
                    <!--					<p><img src="img/logo.png" width="149" height="42" data-retina="true" alt=""></p>-->
                                       <?php  $data =$this->db->get("tbl_footer_description")->row();?>
                                        <h5><?php echo $data->title ?></h5>
                                        <p style="text-align: justify"><?php echo $data->description;?></p>
                                        
                                    </div>
                <? $menus =$this->db->get_where("tbl_footer_menu",["status"=>"Active"])->result(); 
			foreach($menus as $menu){		
		  ?> 
               
                <div class="col-lg-2 col-md-12 ml-lg-auto">
                    <h5 style="padding: 0;"><? echo $menu->name ?></h5>
                    <ul class="links">
                       
                       <? $submenus = $this->db->get_where("tbl_footer_submenu",["status"=>"Active","deleted"=>0,"menu_name"=>$menu->id])->result();  
							foreach($submenus as $submenu){
						?>
                       
	                        <li><a href="<? echo base_url().$submenu->sub_menu_link ?>" target="<? echo $submenu->sub_menu_target ?>"><? echo $submenu->sub_menu_name ?></a></li>
	                        
	                    <? } ?>    
                    </ul>
                </div>
				
		<? } ?>		
				
				<div class="col-lg-2 col-md-6">
					<h5>Contact with Us</h5>
					<ul class="contacts">
                    <? $contact = json_decode($this->db->get_where("tbl_homepage_sociallinks",["type"=>"contact"])->row()->links); ?>
                        <li><a href="<?php echo $contact->mobile_number ?>"><i class="ti-mobile"></i>SMS/WhatsApp:<?php if(isset( $contact->mobile_number)){ echo  $contact->mobile_number;} ?></a></li>
						<li><a href="<?php echo $contact->email ?>"><i class="ti-email"></i><?php  if(isset( $contact->email)){ echo $contact->email;} ?></a></li>
						<li><a href="<?php echo $contact->website_link ?>" target="_blank"><i class="ti-world"></i><?php if(isset($contact->website_link)){ echo $contact->website_link;} ?></a></li>
					</ul>
					
					<div class="follow_us">
                        <span>Follow us</span>
                        <ul style="display: flex;"> 
                        <br>
						<? $links = json_decode($this->db->get_where("tbl_homepage_sociallinks")->row()->links); //print_r($links);die; ?>	
							
						<? echo ($links->facebook != "") ? '<li><a href="'.$links->facebook.'"><i class="ti-facebook"></i></a></li>' : '' ?>
						<? echo ($links->twitter != "") ? '<li><a href="'.$links->twitter.'"><i class="ti-twitter-alt"></i></a></li>' : '' ?>
						<? echo ($links->google != "") ? '<li><a href="'.$links->google.'"><i class="ti-google"></i></a></li>' : '' ?>
						<? echo ($links->pinterest != "") ? '<li><a href="'.$links->pinterest.'"><i class="ti-pinterest"></i></a></li>' : '' ?>
						<? echo ($links->instagram != "") ? '<li><a href="'.$links->instagram.'"><i class="ti-instagram"></i></a></li>' : '' ?>
						<? echo ($links->youtube != "") ? '<li><a href="'.$links->youtube.'"><i class="ti-youtube"></i></a></li>' : '' ?>

						</ul>
					</div>
				</div>
			</div>
			<!--/row-->
			<hr>
			<div class="row">
				<div class="col-md-8">
					<ul id="additional_links">
						<li><a href="<? echo base_url().'termsandconditions';?>">Terms and conditions</a></li>
						<li><a href="<? echo base_url().'privacypolicy';?>">Privacy</a></li>
                        <li><a href="<? echo base_url().'cancellation';?>">Cancellation & Return Policy</a></li>
                        <li><a href="<? echo base_url().'disclaimer';?>">Disclaimer</a></li>
					</ul>
				</div>
				<div class="col-md-4">
                <?php $copy_right = $this->db->get_where("tbl_admin")->row()->copy_right;  ?>
					<div id="copy"><?php echo $copy_right;   ?></div>
				</div>
			</div>
		</div>
	</footer>
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
<!-- <? if($this->session->userdata("student_id")){ ?>
<a href="<? echo base_url() ?>student/eventBag"><button class="cartbox-open"><i class="fa fa-shopping-bag fa-2x" aria-hidden="true"></i> </button></a>
<? } ?> -->
<!-- jQuery is required --> 
<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script> 
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js"></script> --> 
<script src="https://bootstraplily.com/demo/youtube-website-html/js/owl.carousel.js"></script>
<script src="https://bootstraplily.com/demo/youtube-website-html/js/jquery.hoverplay.js"></script> 
<!-- <script>$('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    dots:false,
    nav:true,
    mouseDrag:false,
    autoplay:true,
    animateOut: 'slideOutUp',
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
});</script> -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script> 

<?php $this->load->view("front/includes/guest_login")?>

<script>
			
$(".chatbox-open").click(function(){
	
 <? if(($this->session->userdata("student_id")) || ($this->session->userdata("guest_email"))){ ?>
						 
    	$(".chatbox-popup, .chatbox-close").fadeIn();
						 
	<? }else{ ?>
	
		
						 
	<? } ?>					 
						 
});

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
	
	$("#csend_message").submit(function(e){
		
		e.preventDefault();
		
		  var message = $("#ctmessage").val();
		  var array = {"text":message};

		  $.ajax({

				url: '//164.52.203.175:8000/parse',
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
						data : {student_message:message,institute_reply:data.directives[0].payload.text},
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
       AOS.init({
          duration: 1200,
        })
  </script>
  <!-- COMMON SCRIPTS -->
    <script src="<?php echo base_url();?>assets/udema/js/jquery-2.2.4.min.js"></script>
    <script src="<?php echo base_url();?>assets/udema/js/common_scripts.js"></script>
    <script src="<?php echo base_url();?>assets/udema/js/main.js"></script>
	<script src="<?php echo base_url();?>assets/udema/assets/validate.js"></script>
	<script src="<?php echo base_url();?>assets/vendor/toastr/toastr.js"></script>
	
	<!-- SPECIFIC SCRIPTS -->
	<script src="<?php echo base_url();?>assets/udema/js/video_header.js"></script>
	<script>
		HeaderVideo.init({
			container: $('.header-video'),
			header: $('.header-video--media'),
			videoTrigger: $("#video-trigger"),
			autoPlayVideo: true
		});
	</script>
	<script type="text/javascript">
		function openModal(id){
		$("#feedbacki").show();
		}	
		function closeModal(id){
			$("#feedbacki").hide();
		}
	</script>
</body>
</html>
<script> // Init function
$.fn.magicRatingInit = function(config) {

  
    for (widget of $(this)) {
        var magicRatingWidget = $(widget);
        //// Get datas ////
        // Icon +
        if (magicRatingWidget.data("iconGood") == null) {
            magicRatingWidget.data("iconGood", config.iconGood != null ? config.iconGood : "fa-star");
        };

        // Icon -
        if (magicRatingWidget.data("iconBad") == null) {
            magicRatingWidget.data("iconBad", config.iconBad != null ? config.iconBad : "fa-star-o");
        };

        // Max mark
        if (magicRatingWidget.data("maxMark") == null) {
            magicRatingWidget.data("maxMark", config.maxMark != null ? config.maxMark : 5);
        }

        /*
        console.log(magicRatingWidget.data("iconGood"));
        console.log(magicRatingWidget.data("iconBad"));
        */

        // Clear the widget
        magicRatingWidget.html("");

        // Init icons
        for (i = 1; i <= magicRatingWidget.data("maxMark"); i++) {
            if (i <= magicRatingWidget.data("currentRating")) {
                magicRatingWidget.append('<i class=" ' + magicRatingWidget.data("iconGood") + ' magic-rating-icon" aria-hidden="true" data-default=true data-rating=' + i + '></i>');
            } else {
                magicRatingWidget.append('<i class=" ' + magicRatingWidget.data("iconBad") + ' magic-rating-icon" aria-hidden="true" data-default=false data-rating=' + i + '></i>');
            }
        }

        // Init reset handler
        magicRatingWidget.on("mouseleave", function() {
            var widget = $(this);
            /*
            console.log("mouseleave");
            console.log(widget.data("iconGood"));
            console.log(widget.data("iconBad"));
            */
            widget.children().each(function() {
                var icon = $(this);
                if (icon.data("default") && !icon.hasClass("fa-star")) {
                    icon.removeClass(widget.data("iconBad"));
                    icon.addClass(widget.data("iconGood"));
                } else if (!icon.data("default") && !icon.hasClass("fa-star-o")) {
                    icon.removeClass(widget.data("iconGood"));
                    icon.addClass(widget.data("iconBad"));
                }
            });
        });

        // Init click handler
        magicRatingWidget.on("click", ".magic-rating-icon", function() {
            // Get rating
            var icon = $(this);
            var widget = icon.parent();
            var rating = icon.data("rating");
            /*
            console.log("click");
            console.log(widget.data("iconGood"));
            console.log(widget.data("iconBad"));
            */
            // Update rating
            widget.children().each(function() {
                if ($(this).data("rating") <= rating) {
                    if (!$(this).hasClass(widget.data("iconGood"))) {
                        $(this).removeClass(widget.data("iconBad"));
                        $(this).addClass(widget.data("iconGood"));
                    };
                    $(this).data("default", true);
                } else {
                    if (!$(this).hasClass(widget.data("iconBad"))) {
                        $(this).removeClass(widget.data("iconGood"));
                        $(this).addClass(widget.data("iconBad"));
                    }
                    $(this).data("default", false);
                }
            });

            var callbackSuccess = config.success.bind(null, widget, rating);
            callbackSuccess();
        });

        // Init hover icons
        magicRatingWidget.on("mouseenter", ".magic-rating-icon", function() {
            var icon = $(this);
            var rating = icon.data("rating");
            var widget = icon.parent();
            /*
            console.log("mouseenter");
            console.log(widget.data("iconGood"));
            console.log(widget.data("iconBad"));
            */
            widget.children().each(function() {
                if ($(this).data("rating") <= rating) {
                    if (!$(this).hasClass(widget.data("iconGood"))) {
                        $(this).removeClass(widget.data("iconBad"));
                        $(this).addClass(widget.data("iconGood"));
                    };
                } else {
                    if (!$(this).hasClass(widget.data("iconBad"))) {
                        $(this).removeClass(widget.data("iconGood"));
                        $(this).addClass(widget.data("iconBad"));
                    }
                }
            });
        });
    }
};

</script>
		
		<div class="custom_modal" id="feedbacki">
    <div class="row">
        <div class="col-md-12 text-right">
            <a style="font-size:20px;cursor:pointer;color:red" onclick="closeModal('feedbacki');">
                <i class="icon-cancel-6"></i>
            </a>
        </div>
    </div>
    <div class="container margin_20">
      <div class="main_title_2" style="margin-bottom: 0px;">
        <span><em></em></span>
        <h2>Feedback</h2>

      </div>
	  <? $idata = $this->db->get_where("tbl_admin")->row(); ?>
      <div class="grid">
       <div class="row align-items-center text-center">
  
 <div class="col-md-12">  <img src="<? echo base_url()?>assets/images/front/img_1.png" /> <p><? echo $idata->feedback_description; ?></p></div>
 
  </div>
  <form method="post" id="instfeedback">
  <div class="row align-items-center text-center">
   <div class="col-md-12 rate">
                                    <h5>
									
                                        <? echo $idata->feedback_question; ?>
                                    </h5>
                  <span style="color:#f00!important;" id="rating" class="rating" data-current-rating="0" data-icon-bad="fa fa-heart-o" data-icon-good="fa fa-heart"><i class="magic-rating-icon fa fa-heart" aria-hidden="true" data-default="false" data-rating="1"></i><i class="magic-rating-icon fa fa-heart-o" aria-hidden="true" data-default="false" data-rating="2"></i><i class="magic-rating-icon fa fa-heart-o" aria-hidden="true" data-default="false" data-rating="3"></i><i class="magic-rating-icon fa fa-heart-o" aria-hidden="true" data-default="false" data-rating="4"></i><i class="magic-rating-icon fa fa-heart-o" aria-hidden="true" data-default="false" data-rating="5"></i></span>                  
                                  <br/>
                                  <input type="hidden" name="student_id" value="<? if($this->session->userdata("student_id")){echo $this->session->userdata("student_id");}else{ echo 'anonymous'; } ?>">
                                  <input type="hidden" name="institute_id" value="<? echo $idata->institute_id; ?>">
                                  <input type="hidden" id="srating" name="srating" value="">
                                  <div style="text-align: center;">
                                  <textarea name="comment" style="text-align: center;" placeholder="Comment"></textarea>
                                </div>
                                <br/>
                                  <button type="submit" class="btn btn-danger"> GIVE FEEDBACK</button>
                                  &nbsp;&nbsp;&nbsp;
                                  <a href="<? echo base_url(); ?>" class="btn btn-success"> HOME</a>
                              <div class="smsgfb"></div>      
                                </div>
  </div>
  
  </form>
      </div>
  </div>
</div>
<script type="text/javascript">
        $(document).ready(function() {
            $('.rating').magicRatingInit({
                success: function(magicRatingWidget, rating) {
                    //alert(rating);
                    $('#srating').val(rating);
                },
                iconGood: "fa-bicycle",
                iconBad: "fa-car",
            });
            
        });
    </script>
	<script type="text/javascript">

  $("#instfeedback").submit(function(e){
  
    e.preventDefault();
    var fdata = $("#instfeedback").serialize();
    
    $.ajax({

      type : "post",
      data : fdata,
      url : "<? echo base_url('front/institutes/savefeedback') ?>",
      success : function(data){
        
        if(data == "success"){
          $(".smsgfb").html('<div class="alert alert-success">Thank you for your valuable feedback. </div>');
          setTimeout(function(){location.reload()},3000)
        }else if(data == "empty"){
          $(".smsgfb").html('<div class="alert alert-danger">Please give atleast one of rating or comment. </div>');
        }else{
          $(".smsgfb").html('<div class="alert alert-danger">Error Occured please try again.</div>');
        }
      },
      error : function(data){
        
        console.log(data);
        
      }

    })
  
  }); 
    
</script>