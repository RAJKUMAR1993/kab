<? $this->load->view("front/includes/header");?>

<div id="inbanner">
<img src="<?php echo base_url();?>assets/images/front/counselor.jpg"   alt="" class="img-fluid">
</div>

<section class="our-webcoderskull ">
  <div class="container">
    <div class="row heading heading-icon">
        <h2>Meet Our Expert Team of Career Advisers</h2>
    </div>
    <ul class="row">
	  <?php foreach($sessions as $se){ ?>
		    
			<li class="col-12 col-md-6 col-lg-3">
					  <div class="cnt-block equal-hight" >
						<figure>
						   <?php if($se->pro_image != ""){ ?>
								<img src="<?php echo base_url();?>assets/images/professors/<?php echo $se->pro_image; ?>" class="img-thumbnail img-fluid" width="375px" height="450px" alt=""/>
							<?php }else{ ?>
								<img src="<?php echo base_url();?>assets/images/front/team-4-big.jpg" class="img-thumbnail img-fluid" alt=""/>
							<?php } ?>
						</figure>
						<h3><a href="#"><?php echo $se->pro_name; ?></a></h3>
						<p><?php echo $se->pro_designation; ?></p>
						 <div class="line1"></div>
					   <p> <?php echo $se->pro_quali; ?></p>
						<div class="line1"></div>
						<p><?php echo $se->pro_languages; ?></p>
					   
					   <div class="cd">
					   	<? if($se->prof_ses_cost) { ?>
					   	<h4> <?php echo $se->prof_ses_cost; ?></h4>
			<p>for 60 Minutes session</p> 
		<? } ?>
					 
			</div>  
			<a href="<?php echo base_url();?>professor/profile/<?php echo $se->pro_id; ?>"><button class="btn btn-danger btn-block">BOOK NOW</button></a>         
					  </div>
				  </li>
			
	  <?php } ?>

      
    </ul>
  </div>
</section>




<? $this->load->view("front/includes/footer");?>