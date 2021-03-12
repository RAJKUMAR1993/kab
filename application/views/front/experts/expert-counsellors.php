<? $this->load->view("front/includes/header");?>
<style type="text/css">
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
  text-overflow: ellipsis;
  
  padding: 20px;
  font-size: 1.3rem;
  margin: 0;
}

.tip {
    display: inline-block;
    width: 180px;
    white-space: nowrap;
    overflow: hidden !important;
    text-overflow: ellipsis;
}


</style>
<div id="inbanner">
<img src="<?php echo base_url();?>assets/images/front/counselor.jpg"   alt="" class="img-fluid">
</div>

<section class="our-webcoderskull" style="margin-top: 0">
  <div class="container">
    <div class="row heading heading-icon">
        <h2>Meet Our Counsellors</h2>
    </div>
    <ul class="row">
	  <?php 
	  //print_r($sessions);
	  foreach($sessions as $se){ ?>
		    
			        <li class="col-12 col-md-6 col-lg-3 cut-text">
					    <div class="box_grid cnt-block equal-hight" style="overflow-wrap: anywhere;overflow-wrap: break-word;" >
							<!-- <a href="<?php //echo base_url();?>expert/scheduled/meetings/<?php //echo $se->expert_id; ?>" class="wish_bt" title="scheduled meeting list"></a> -->
							<figure><img src="<?php if($se->expert_photo == ""){ echo base_url().'assets/images/front/team4.png'; } else { echo base_url($se->expert_photo); } ?>" class="img-fluid" alt=""></figure>
							<h3 class=""><a href="#"  title="<?php echo $se->expert_fname; ?>"><?php echo $se->expert_fname; ?>&nbsp;<?php echo $se->expert_lname; ?></a></h3>
							<p class="cut-text" ><a class="overflow-dots" href="#" data-toggle="tooltip"  data-placement="bottom" title="<?php echo $se->expert_designation; ?>"><span class="tip"><?php echo $se->expert_designation; ?></span></a></p>
							<div class="line1"></div>
						    <p class="cut-text"><a class="overflow-dots" href="#" data-toggle="tooltip" data-placement="bottom" title="<?php echo $se->expert_qualification; ?>"> <span class="tip"><?php echo $se->expert_qualification; ?></span></a></p>
							<div class="line1"></div>
							<p class="cut-text">Language Spoken: <?php echo $se->expert_spokenlang; ?><?php echo $se->expert_id; ?></p>
						
							    <div class="cd">
									<h4> <?php echo $se->expert_tcost; ?></h4>
									<p class="cut-text">for 30 Minutes session</p> 
								</div>  
								<a href="<?php echo base_url();?>expert/profile/<?php echo $se->expert_id; ?>"><button class="btn btn-danger btn-block">BOOK NOW</button></a>         
					    </div>
				    </li>
			
	  <?php } ?>

      
    </ul>
  </div>
</section>




<? $this->load->view("front/includes/footer");?>
<script>
$(document).ready(function () {
  $("a").tooltip({
    'selector': '',
    'placement': 'top',
    'container':'body'
  });
});
</script>