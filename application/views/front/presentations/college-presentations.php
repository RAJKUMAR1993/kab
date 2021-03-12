<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 $this->load->view("front/includes/new_header");?>
<style type="text/css">
	.box_grid a.wish_bt:after {
  font-family: 'ElegantIcons';
  content: "\e056";
}
.box_grid a.wish_bt:hover:after {
  content: "\e056";
  color: #fff;
}
</style>	
	<main>
	<section id="hero_in" class="general">
		<div class="wrapper">
		<div class="container">
			<h1 class="fadeInUp"><span></span>Webinars</h1>
		</div>
		</div>
	</section>
	<!--/hero_in-->

	<div class="container">
		<div class="pricing-container cd-has-margins">
		<!--/pricing-switcher -->
		<ul class="pricing-list bounce-invert">
			<? if($webinors){ ?>
		    <?php foreach($webinors as $se){ ?>
			<li class="col-12 col-md-6 col-lg-3">
				<ul class="pricing-wrapper">
					<li data-type="monthly" class="is-visible">
						<header class="pricing-header">
							<div class="box_grid price">
								

								<?php if($se->professor_image != ""){ ?>
								<img src="<?php echo base_url();?>assets/images/professors/<?php echo $se->professor_image; ?>" class="img-thumbnail img-fluid" width="375px" height="450px" alt=""/>
							<?php }else{ ?>
								<img src="<?php echo base_url();?>assets/images/front/team-4-big.jpg" class="img-thumbnail img-fluid" alt=""/>
							<?php } ?>
							</div>
						</header>
						<!-- /pricing-header -->
						<div class="pricing-body">
							<ul class="pricing-features">
								<li><h6><?php echo $se->professor_name; ?></h6></li>
								<li><?php echo $se->title; ?></li>
								<!-- <li><?php echo $se->description; ?></li> -->
								<li><?php echo date("d-m-Y",strtotime($se->date));?></li>
								<li><?php echo date('H:i A', $se->from_time);?> - <?php echo date('H:i A', $se->to_time);?></li>
							</ul>
						</div>
						
					</li>
				</ul>
				<!-- /pricing-wrapper -->
			</li>
			<?php } } ?>
		</ul>
		<!-- /pricing-list -->
	</div>
	<!-- /pricing-container -->	
	</div>
	<!-- /container -->
	
	
	</main>
	<!--/main-->
<?php $this->load->view("front/includes/new_footer");?>