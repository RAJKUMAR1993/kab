<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 $this->load->view("front/includes/new_header");?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
 <link href="<?php echo base_url(); ?>/assets/template.css?1600450516" rel="stylesheet">
 <script src="https://kit.fontawesome.com/b31e06099e.js" crossorigin="anonymous"></script>
 <style>
 .call_section_custom {
  background: url(<?php echo base_url();?>assets/udema/img/background.jpeg) center center no-repeat fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  min-height: 400px;
  padding: 10% 0;
}

 </style>
<style>

.singlepost figure img:hover {
    transform: scale(1.1);
}
	
.singlepost figure img {
	transition: all 0.3s ease;
}	
</style>

<main>
    <section id="hero_in" class="general" style="height: 230px">
        <div class="wrapper">
            <div class="container">
                <h1 class="fadeInUp"><span></span>Event Schedule</h1>
            </div>
        </div>
    </section>
    <div class="container margin_60_35 webinarSchedule">
       <nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<? echo base_url() ?>">Home</a></li>
				<li class="breadcrumb-item active">Event Schedule</li>	  
			</ol>
		</nav>
       
        <div class="row">
        
        	<div class="col-3"></div>
        	<div class="col-6 singlepost" align="center">
        		<a href="<? echo base_url('eventschedule') ?>" target="_self">
					<figure>
						<img src="<? echo base_url('assets/images/mainauditorium.jpg') ?>" width="100%" class="img-responsive" alt="">
					</figure>
					<h4 align="center">Main Auditorium</h4>
        		</a>
        	</div>
        	<div class="col-3"></div>
        
        </div>
        
        <div class="row">
        
        	<div class="col-1"></div>
        	<div class="col-5 singlepost" align="center" style="margin-right: 20px">
        		<a href="<? echo base_url('espeakers') ?>" target="_self">
					<figure>
						<img src="<? echo base_url('assets/images/auditorium.jpg') ?>" width="100%" class="img-responsive" alt="">
					</figure>
					<h4 align="center">Webinar Hall</h4>
       				<p style="text-align: center">(Eminent Speakers)</p>
        		</a>
        	</div>
        	<div class="col-5 singlepost" align="center">
        		<a href="<? echo base_url('front/webinars/proffesors') ?>" target="_self">
					<figure>
						<img src="<? echo base_url('assets/images/auditorium.jpg') ?>" width="100%" class="img-responsive" alt="">
					</figure>
					<h4 align="center">Professors Hall</h4>
       				<p style="text-align: center">(Professors)</p>
        		</a>
        	</div>
        	<div class="col-1"></div>
        
        </div>

        
        <div class="row">
        
        	<? $auds = $this->db->group_by("title")->get_where("tbl_institute_auditorium",["date >="=>date("Y-m-d")])->result(); 

			   if($auds){		

				   foreach($auds as $a){
					   $title = str_replace(" ","-",$a->title);
			?>
				<div class="col-3 singlepost" align="center">
					<a href="<? echo base_url('front/auditorium/view/').$title ?>" target="_blank">
						<figure>
							<img src="<? echo base_url('assets/images/auditorium.jpg') ?>" width="100%" class="img-responsive" alt="">
						</figure>
						<h4 align="center"><? echo $a->title ?></h4>
						<p style="text-align: center">(College Presentations)</p>
					</a>
				</div>
       
       		<? }} ?>
        
        </div>
                        
        <!-- /row -->
    </div>

</main>

    
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

    <?php $this->load->view("front/includes/new_footer");?>
<?php $this->load->view("student/login/login_popup")?>