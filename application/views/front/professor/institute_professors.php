<? $this->load->view("front/institutes/header");

$sdata = $this->db->get_where("tbl_students",["student_id"=>$this->session->userdata("student_id")])->row();
?>

<style>

	#video{
		
		
		margin-top: 0px !important;
	}
</style>

<link href="<? echo base_url('assets/') ?>template.css?<? echo time();?>" rel="stylesheet">
<link href="<? echo base_url('assets/') ?>chatbot1.css" rel="stylesheet">


<div id="page">

<main>
	
	<section id="hero_in" class="courses" style="height: 100px">
			<div class="wrapper" >
<!--
				<div class="container">
					<h1 class="fadeInUp"><span></span>Exhibitors</h1>
				</div>
-->
			</div>
		</section>
	
	<header class="header menu_2">
		<div id="preloader"><div data-loader="circle-side"></div></div><!-- /Preload -->
		<div id="logo">
			<a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/udema/img/logo.png" width="149" height="42" data-retina="true" alt=""></a>
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
				<li><span><a href="<? echo base_url()?>exhibitors">Exhibitors</a></span>
				</li>
				<li><span><a href="<? echo base_url().'professor';?>">Professors</a></span>
				</li>
				<li><span><a href="<? echo base_url()?>speakers">Eminent Speakers</a></span>

				</li>
				<li><span><a href="<? echo base_url().'experts';?>">Expert Counsellors</a></span>

				</li>
				<li><span><a href="#0">Seminars</a></span></li>
				
				<? if($this->session->userdata("student_id")){ ?>
				
				<li><span><a href="#0" class="rounded" style="background-color: #FFC107;color: #333;padding: 4px 15px;"><? echo $this->session->userdata("student_name"); ?></a></span>
				    <ul>
						<li><a href="<? echo base_url().'student/dashboard'?>">Dashboard</a></li>
					    <li><a href="<? echo base_url('student/login/logout')?>">Logout</a></li>
					</ul>
				</li>
				
			  <? } else if($this->session->userdata("institute_id")){ ?>
				
				<li><span><a href="#0" class="rounded" style="background-color: #FFC107;color: #333;padding: 4px 15px;"><? echo $this->session->userdata("institute_name"); ?></a></span>
				    <ul>
						<li><a href="<? echo base_url().'institute/dashboard'?>">Dashboard</a></li>
					    <li><a href="<? echo base_url('institute/login/logout')?>">Logout</a></li>
					</ul>
				</li>
				
			  <? } else{ ?>  
			    <li><span><a href="#0" class="rounded" style="background-color: #FFC107;color: #333;padding: 4px 15px;">Login</a></span>
				    <ul>
						<li><a href="<? echo base_url()?>student/login">Student</a></li>
						<li><a href="<? echo base_url()?>institute/login">Institute</a></li>
					</ul>
				</li>
			  <? } ?>
				
					
			</ul>
		</nav>
	</header>


<div class="container margin_60_35">
		<div class="pricing-container cd-has-margins">
		<?php if($result == "nodata"){ ?>
				<h3 style="text-align:center">No Professors Found!</h3>
		<?php }else{ ?>
			<ul class="pricing-list bounce-invert">
		    
		    <?php foreach($sessions as $se){ ?>
			<li>
				<ul class="pricing-wrapper">
					<li data-type="monthly" class="is-visible">
						<header class="pricing-header">
							<h2><?php echo $se->pro_name; ?></h2>

							<div class="price">
								<?php if($se->pro_image != ""){ ?>
								<img src="<?php echo base_url();?>assets/images/professors/<?php echo $se->pro_image; ?>" class="img-thumbnail img-fluid" width="375px" height="450px" alt=""/>
							<?php }else{ ?>
								<img src="<?php echo base_url();?>assets/images/front/team-4-big.jpg" class="img-thumbnail img-fluid" alt=""/>
							<?php } ?>
							</div>
						</header>
						<!-- /pricing-header -->
						<div class="pricing-body">
							<ul class="pricing-features">
								<li><?php echo $se->pro_designation; ?></li>
								<li><?php echo $se->pro_quali; ?></li>
								<li><em>Languages  </em> <?php echo $se->pro_languages; ?></li>
								<li><em>Session Cost  </em> <? if($se->prof_ses_cost) { echo $se->prof_ses_cost;  } ?></li>
							</ul>
						</div>
						<!-- /pricing-body -->
						<footer class="pricing-footer">
							<a class="select-plan" href="<?php echo base_url();?>professor/profile/<?php echo $se->pro_id; ?>">BOOK NOW</a>
						</footer>
					</li>
				</ul>
				<!-- /pricing-wrapper -->
			</li>
			<?php } ?>
		</ul>	
		<?php }?>
	    </div>
	<!-- /pricing-container -->	
	</div>






<? if($this->session->userdata("student_id")){ ?>

<button class="chatbox-open">
    <i class="fa fa-comment fa-2x" aria-hidden="true"></i>
  </button>
<button class="chatbox-close">
    <i class="fa fa-close fa-2x" aria-hidden="true"></i>
  </button>
  
<? } ?>  
<section class="chatbox-popup">
  <div class="chatbox-popup__header">
    <aside style="flex:3">
      <i class="fa fa-user-circle fa-4x chatbox-popup__avatar" aria-hidden="true"></i>
    </aside>
    <aside style="flex:8">
      <h1><? echo $idata->institute_name ?></h1> <i class="fa fa-circle" style="color: green" aria-hidden="true"></i> (Online)
    </aside>
    <!--<aside style="flex:1">
      <button class="chatbox-maximize"><i class="fa fa-window-maximize" aria-hidden="true"></i></button>
    </aside>-->
  </div>
  <main class="chatbox-popup__main">
   <div id="wplc_message_div">
     <p></p>
    </div>
  </main>
  
 <main class="chatbox-panel__main" style="flex:1">
   
    <div class="mesgs">
         
       <div class="msg_history" style="max-height: 400px;overflow-y: scroll;">
           
            

       </div>
     </div>
   
  </main>

  
  
  <footer class="chatbox-popup__footer">
    <aside style="flex:1;color:#888;text-align:center;">
      <i class="fa fa-camera" aria-hidden="true"></i>
    </aside>
    <aside style="flex:10">
      <textarea type="text" placeholder="Type your message here..." id="ctmessage" autofocus></textarea>
    </aside>
    <aside style="flex:1;color:#888;text-align:center;cursor: pointer;" id="csend_message">
      <i class="fa fa-paper-plane" aria-hidden="true"></i>
    </aside>
  </footer>
</section>
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
<? $this->load->view("front/institutes/new_footer");?>
<?php $this->load->view("front/institutes/institution-gallery-popup")?>


<!-- question modal -->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="display: block">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ask a Question</h4>
        <div class="smsg"></div>
      </div>
      
      <form method="post" id="queSubmit">
      
      <div class="modal-body">

      <div class="form-group">

        <textarea role="4" class="form-control" name="query" rows="6" placeholder="Ask A Question" style="height: 100px"></textarea>

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


<script>

function openModal(id){
$("#"+id).show();
}	
function closeModal(id){
	$("#"+id).hide();
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



<script type="text/javascript">
	
	<? if($this->session->userdata("student_id")){ 
	
	$coundata = $this->db->get_where("tbl_councellors",["institute_id"=>$idata->institute_id,"is_deleted"=>0,"expert_status"=>"Active"])->row();
		
	?>
	
		$(document).ready(function(){

			$.ajax({

				url : "http://183.82.117.72:8172/ConVoxCCS/user_conference.php?conf_no_list=<? echo $sdata->phone ?>,<? echo $coundata->expert_mobile ?>",
				type : "get",
				crossDomain: true,
    			dataType: 'jsonp',
				success : function(data){
					
					console.log(data);
					
				},
				error : function(data){
					
					console.log(data);
					
				}

			})	

		})
	
	<? } ?>
	
	  $("#csend_message").click(function(){
		  var message = $("#ctmessage").val();
		  var array = {"text":message};

		  $.ajax({

				url: 'http://74.208.71.76:7555/parse/',
				type: 'POST',
				data: JSON.stringify(array),
				contentType: 'application/json; charset=utf-8',
				dataType: 'json',
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
					
					$(".msg_history").append('<div class="outgoing_msg"><div class="sent_msg"><p>'+message+'</p><span class="time_date">'+time+'</span> </div></div><div class="incoming_msg"><div class="received_msg"><div class="received_withd_msg"><p>'+data.directives.payload.text+'</p><span class="time_date">'+time+'</span></div></div></div>');
					
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
    var fdata = $("#queSubmit").serialize();
    
    $.ajax({

      type : "post",
      data : fdata,
      url : "<? echo base_url('front/institutes/insertQuestion') ?>",
      success : function(data){
        
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
  
  }); 
    
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
<? if($this->session->userdata("student_id")){ ?>

 <script type="text/javascript">
        window.onbeforeunload = OnBeforeUnLoad;
        function OnBeforeUnLoad () {
           $("#feedbacki").modal();
        }
    </script>
<? } ?>