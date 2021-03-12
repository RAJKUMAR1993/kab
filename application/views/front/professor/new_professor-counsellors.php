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
	@media screen and (max-width: 600px) {
.pricing-container {
    margin: 0em auto;
}
.margin_60_35 {
    padding-top: 0;
    padding-bottom: 5px;
}
.pricing-features li {
    float: none;
    width: auto;
    padding: 1em;
}
.pricing-features li:nth-of-type(2n+1) {
    background-color: rgba(102, 45, 145, 0.06);
}
.pricing-features {
    width: auto;
}
.pricing-body {
    overflow-x: visible;
}
.cd-has-margins .select-plan {
    display: block;
    padding: 1.7em 0;
    border-radius: 0 0 4px 4px;
}
.select-plan {
    position: static;
    display: inline-block;
    height: auto;
    padding: 1.3em 3em;
    color: #fff;
    border-radius: 2px;
    background-color: #8139b8;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    -ms-border-radius: 5px;
    border-radius: 5px;
    font-size: 14px;
    font-size: 0.875rem;
    font-weight: 500;
    text-indent: 0;
    text-transform: uppercase;
    letter-spacing: 2px;
}
.cd-has-margins .pricing-footer {
    padding-bottom: 0;
}
.pricing-footer {
    position: relative;
    height: auto;
    padding: 1.8em 0;
    text-align: center;
}
.pricing-header {
    height: auto;
    padding: 1.9em 0.9em 1.6em;
    pointer-events: auto;
    text-align: center;
    color: #555;
    background-color: transparent;
}
.pricing-footer::after {
 
    top: 62%;}

}	
</style>	
	<main>
	<section id="hero_in" class="general" style="height: 240px;">
		<div class="wrapper">
		<div class="container">
			<h1 class="fadeInUp"><span></span>Professors</h1>
		</div>
		</div>
	</section>
	<!--/hero_in-->

	<div class="container margin_60_35">
		<div class="pricing-container cd-has-margins">
		<!--/pricing-switcher -->
		<ul class="pricing-list bounce-invert">
		    <?php foreach($sessions as $se){ ?>
			<li style="margin-right: 10px !important">
				<ul class="pricing-wrapper">
					<li data-type="monthly" class="is-visible">
						<header class="pricing-header">
							<div class="box_grid price">
								<?
								$pcheck = $this->db->where("session_pro_id",$se->pro_id)->get("tbl_professor_meeting")->num_rows();
								if($pcheck >0){
								?>
<!--<a href="<?php echo base_url();?>professor/scheduled/meetings/<?php echo $se->pro_id; ?>" class="wish_bt"  title="scheduled meeting list"></a>-->
								<?php } if($se->pro_image != ""){ ?>
								<img src="<?php echo base_url();?>assets/images/professors/<?php echo $se->pro_image; ?>" class="img-thumbnail img-fluid" style="width: 334px;height: 226px" alt=""/>
							<?php }else{ ?>
								<img src="<?php echo base_url();?>assets/images/front/team-4-big.jpg" style="width: 334px;height: 226px" class="img-thumbnail img-fluid" alt=""/>
							<?php } ?>
							</div>
						</header>
						<!-- /pricing-header -->
						<div class="pricing-body">
							<ul class="pricing-features">
								<li><h6><?php echo $se->pro_name; ?></h6></li>
								<li><?php echo $se->pro_designation; ?></li>
								<li><?php echo $se->pro_quali; ?></li>
								<li><em>Languages  </em> <?php echo $se->pro_languages; ?></li>
								<!-- <li><em>Session Cost  </em> <? //if($se->prof_ses_cost) { echo $se->prof_ses_cost;  } ?></li> -->
							</ul>
						</div>
						<!-- /pricing-body -->
						<footer class="pricing-footer">
							<a class="select-plan" href="<?php echo base_url();?>professor/profile/<?php echo $se->pro_id; ?>">Know More</a>
						</footer>
					</li>
				</ul>
				<!-- /pricing-wrapper -->
			</li>
			<?php } ?>
		</ul>
		<!-- /pricing-list -->
	</div>
	<!-- /pricing-container -->	
	</div>
	<!-- /container -->
	
	<!-- <div class="bg_color_1">
		<div class="container margin_60_35">
			<div class="row">
				<div class="col-md-6">
					<div class="box_faq">
						<i class="icon_info_alt"></i>
						<h4>Porro soleat pri ex, at has lorem accusamus?</h4>
						<p>Ut unum diceret eos, mel cu velit principes, ut quo inani dolorem mediocritatem. Mea in justo posidonium necessitatibus. Augue honestatis vis no, ius quot mazim forensibus in, per sale virtute legimus ne. Mea dicta facilisis eu.</p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="box_faq">
						<i class="icon_info_alt"></i>
						<h4>Ut quo inani dolorem mediocritatem?</h4>
						<p>Ut unum diceret eos, mel cu velit principes, ut quo inani dolorem mediocritatem. Mea in justo posidonium necessitatibus. Augue honestatis vis no, ius quot mazim forensibus in, per sale virtute legimus ne. Mea dicta facilisis eu.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="box_faq">
						<i class="icon_info_alt"></i>
						<h4>Per sale virtute legimus ne?</h4>
						<p>Ut unum diceret eos, mel cu velit principes, ut quo inani dolorem mediocritatem. Mea in justo posidonium necessitatibus. Augue honestatis vis no, ius quot mazim forensibus in, per sale virtute legimus ne. Mea dicta facilisis eu.</p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="box_faq">
						<i class="icon_info_alt"></i>
						<h4>Mea in justo posidonium necessitatibus?</h4>
						<p>Ut unum diceret eos, mel cu velit principes, ut quo inani dolorem mediocritatem. Mea in justo posidonium necessitatibus. Augue honestatis vis no, ius quot mazim forensibus in, per sale virtute legimus ne. Mea dicta facilisis eu.</p>
					</div>
				</div>
			</div>
		</div>
	</div> -->
	<!--/bg_color_1-->
	</main>
	<!--/main-->
<?php $this->load->view("front/includes/new_footer");?>