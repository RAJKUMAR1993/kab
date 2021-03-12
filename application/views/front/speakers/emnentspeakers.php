<? $this->load->view("front/includes/header");?>
<style>
.box_grid a.wish_bt:after {
  font-family: 'ElegantIcons';
  content: "\e056";
}
.box_grid a.wish_bt:hover:after {
  content: "\e056";
  color: #fff;
}

.cut-text {
    width: 200px;
    white-space: nowrap;
    overflow: hidden;
    /* text-overflow: ellipsis; */
    padding: 20px;
    font-size: 1.3rem;
    margin: 0;
    word-break: break-word;
}

.tip {
    display: inline-block;
    width: 180px;
    white-space: nowrap;
    overflow: hidden !important;
    text-overflow: ellipsis;
}

</style>
<main>
<section id="hero_in" class="general" style="height: 240px;">
		<div class="wrapper">
		<div class="container">
			<h1 class="fadeInUp"><span></span>Speakers</h1>
		</div>
		</div>
	</section>
<section class="our-webcoderskull" style="margin-top: 0px">
  <div class="container">
    <div class="row heading heading-icon">
        <h2>Meet Our Speakers</h2>
    </div>
    <ul class="row">
	  <?php foreach($sessions as $se){ ?>
		    
			<li class="col-12 col-md-6 col-lg-3 cut-text">
					  <div class="cnt-block equal-hight" style="overflow-wrap: anywhere;overflow-wrap: break-word;" >
						<figure><img src="<?php if($se->speaker_photo == ""){ echo base_url().'assets/images/front/team4.png'; } else { echo base_url($se->speaker_photo); } ?>" class="img-fluid" alt=""></figure>
						<p class="cut-text">
                <a class="overflow-dots" href="#" data-toggle="tooltip"  data-placement="bottom" title="<?php echo $se->speaker_name; ?>"><span class="tip"><?php echo $se->speaker_name; ?></span></a>
            </p>
						<p class="cut-text">
                <a class="overflow-dots" href="#" data-toggle="tooltip"  data-placement="bottom" title="<?php echo $se->speaker_designation; ?>"><span class="tip"><?php echo $se->speaker_designation; ?></span></a>
            </p>
						 <div class="line1"></div>
					   <p class="cut-text">
                  <a class="overflow-dots" href="#" data-toggle="tooltip"  data-placement="bottom" title="<?php echo $se->speaker_qualification; ?>"><span class="tip"><?php echo $se->speaker_qualification; ?></span></a>
             </p>
						<div class="line1"></div>
            <p class="cut-text">Language Spoken: <br><span data-toggle="tooltip" data-placement="bottom" title="<?php echo $se->speaker_spokenlang; ?>" class="tip"><?php echo $se->speaker_spokenlang; ?></span></p>
					   
					   <div class="cd">
					   <h4> <?php //echo $se->speaker_tcost; ?></h4>
			<p>for 30 Minutes session</p> 
			</div>  
			<a class="book_sessions" data-sid="<? echo $this->session->userdata("speaker_id") ?>" href="<?php echo base_url();?>speaker/profile/<?php echo $se->speaker_id; ?>"><button class="btn btn-danger btn-block " >BOOK NOW</button></a>         
					  </div>
				  </li>
			
	  <?php } ?>

      
    </ul>
  </div>
</section>
</main>



<? $this->load->view("front/includes/footer");?>

<script>
$(document).ready(function(){

$.ajax({

  url : "<? echo base_url('front/speakers/checkProfileviewtime') ?>",
  type : "post",
  data : {profile_id:"<? echo $se->speaker_id ?>","type":"<? echo ($this->session->userdata("student_id")) ? 'loggedin' : 'visitor'; ?>","ref_type":"speaker"},
  success : function(data){

    console.log(data);

  },
  error : function(data){

    console.log(data);

  }

});

});

window.addEventListener("beforeunload", function (e) {
  
  e.preventDefault();
  
  $.ajax({

  url : "<? echo base_url('front/speakers/updateProfileviewtime') ?>",
  type : "post",
  data : {profile_id:"<? echo $se->speaker_id ?>","type":"<? echo ($this->session->userdata("student_id")) ? 'loggedin' : 'visitor'; ?>","ref_type":"speaker"},
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