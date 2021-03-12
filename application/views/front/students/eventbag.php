<? $this->load->view("front/includes/new_header");?>





	<main>
		<section id="hero_in" class="general">
			<div class="wrapper">
				<div class="container">
					<h1 class="fadeInUp"><span></span>Institutes</h1>
				</div>
			</div>
		</section>
		<!--/hero_in-->
        <div class="bg_color_1">
			<div class="container margin_60_35">
				<div class="row">
					<?php foreach($edata as $ins){ 
					$in = $this->student_model->institute_details($ins->institute_id);
				?>
					<div class="col-md-4">
						<a class="getloginuser" studentid="<? if($this->session->userdata("student_id")){ echo $this->session->userdata("student_id"); } ?>" instituteid="<?php echo $in->institute_id ; ?>" href="<?php echo base_url(); ?>student/eventBag/<?php echo $in->institute_id ; ?>/view">
							<img src="<?php echo base_url();?><?php echo $in->theme_picture; ?>"   alt="" class="img-fluid " />
							<h4 style="text-align:center"><br><?php echo $in->institute_name; ?></h4>
							<p style="text-align:center"><?php echo $in->address; ?></p>
						</a>
					</div>
					<?php } ?>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!--/container-->
	</main>
	<!--/main-->
<br>
<section id="right">
  <div class="container text-center center-block">
    <h3>HOW TO BOOK A STALL?</h3>
    <h4> Contact KAB Consultants or TV9 to book a stall.</h4>
    <div class="row align-items-center">
      <div class="col-12 mx-auto"> <a href="#">
        <button class="btn-default btn">Book a Stall >></button>
        </a> </div>
    </div>
  </div>
</section><br>

<? $this->load->view("front/institutes/new_footer");?>