<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 $this->load->view("front/includes/header");?>
<div id="banner">
<header>
 <div class="owl-carousel owl-theme">
        <?php foreach($sliders as $row){ ?>
        <div class="item">
            <img src="<?php echo base_url();?>assets/images/homepage/<?php echo $row->image; ?>"   alt="">
            <div class="cover">
                <div class="container">
                    <div class="header-content">
                        <div class="line"></div>
                        <h2><?php echo $row->text; ?></h2>
                    </div>
                </div>
             </div>
        </div>
        <?php } ?>		
        
        
    </div>



</header>

</div>
<section id="news">
  <div class="container">
    <div class="row no-gutters">
      <div class="col-md-1">
        <h2>NEWS >></h2>
      </div>
      <div class="col-md-11">
        <marquee id="test" behavior="scroll" direction="left" height="40" scrolldelay="4" scrollamount="4" onmouseover="document.all.test.stop()" onmouseout="document.all.test.start()">
		<?php foreach($news as $ne){ ?>
			<span style="padding-left:50px;"> <?php echo $ne->message; ?> </span>
		<?php } ?>
        </marquee>
      </div>
    </div>
  </div>
</section>
<section id="platform">
  <div class="container text-white">
    <div class="platform">
      <div class="row">
        <div class="col-md-4 align-items-center">
          <h2 class="">RIGHT TIME.<br>
RIGHT 
OPPORTUNITY.</h2>
        </div>
        <div class="col-md-8">
          <div class="row">
            <div class="col-md-4">
              <div class="green"> <img src="<?php echo base_url();?>assets/images/front/icon-1.png" width="70px"/>
                <p>Exhibition </p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="red"> <img src="<?php echo base_url();?>assets/images/front/icon-2.png" width="70px"/>
                <p>Spot Admissions</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="blue"> <img src="<?php echo base_url();?>assets/images/front/icon-3.jpg" width="70px"/>
                <p>Expert Guidance</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>
<section id="services">
  <div class="container text-center  pb-5">
    <h1> FOR ORGANIZATIONS
      <div class="line"><img src="<?php echo base_url();?>assets/images/front/line.png"></div>
    </h1>
    <p>Education summit started in 2004 and since then conducting regularly. As the admission season makes way,<br/>
      students and parents are apprehensive about choosing the right field and institution for a bright future. </p>
    <div class="row text-center align-items-center">
      <?php foreach($cards as $cr){ ?>
		<div class="col-lg-4 col-md-6 col-sm-6 col-12 ">
        <div class="service-box image"> <img src="<?php echo base_url();?>assets/images/cards/<?php echo $cr->card_image; ?>" class="img-fluid"/>
         
          <div class="btm-text aos-init" data-aos="fade-up">
           <div class="heading">
            <h2><?php echo $cr->card_title; ?></h2>
          </div>
            <p><?php echo $cr->card_desc; ?></p>
            <div class="more"> <a href="<?php echo $cr->card_link; ?>">Learn More >> </a> </div>
          </div>
        </div>
      </div>
	<?php } ?>
     
      
      
    </div>
  </div>
  </div>
</section>
<section id="why">
  <div class="container ">
    <div class="row">
      <div class="col-md-7">
        <h1>WHY ATTEND?</h1>
        <div class="line"><img src="<?php echo base_url();?>assets/images/front/line.png"></div>
        <p>Education Summit organized by KAB Consultants(Telangana's Leading Education Consultants) in association with TV9</p>
        <ul>
          <li> Guidance for selection of College/Course based on EAMCET-2019, NEET-2019, JEE (Main) & JEE (Advanced) - 2019, ICET-2019, ECET-2019, PLYCET-2019 Ranks </li>
          <li> Demonstration on EAMCET, NEET, JOSAA, DOST, Web Counselling procedure</li>
          <li> Interactive sessions to clarify student's doubts</li>
          <li> Free Entry for visitors</li>
          <li> Spot Admissions Facility</li>
          <li> Free Pre-Counseling and Guidance sessions on EAMCET, JEE, ICET & NEET Web Counseling 2019</li>
          <li> Free career guidance exam to know their personality and choose a relevant career based on their personality.</li>
        </ul>
      </div>
      <div class="col-md-5"><img src="<?php echo base_url();?>assets/images/front/why-img.png" class="img-fluid"></div>
    </div>
  </div>
</section>
<section id="clients">
  <div class="container text-center">
    <h1> Partners & SPONSOR </h1>
    <div class="line"><img src="<?php echo base_url();?>assets/images/front/line.png"></div>
    <section class="customer-logos slider">
	  <?php foreach($partners as $pr){ ?>
		  <div class="slide "><img src="<?php echo base_url();?>assets/images/partners/<?php echo $pr->partner_image; ?>" ></div>
	  <?php } ?>
    </section>
  </div>
</section>
<section id="testi">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <h2>Students <b>Testimonials</b></h2>
          <!-- Carousel indicators -->
          <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
          </ol>
          <!-- Wrapper for carousel items -->
          <div class="carousel-inner">
		   <?php $i=1; foreach (array_chunk($testimonials, 2) as $group){ ?>
            <div class="item carousel-item <?php if($i == 1){ echo "active"; } ?>">
              <div class="row">
			  <?php foreach($group as $ts){ ?>
				<div class="col-sm-6">
                  <div class="testimonial">
                    <p><?php echo $ts->student_msg; ?></p>
                  </div>
                  <div class="media">
                    <div class="media-left d-flex mr-3"> <img src="<?php echo base_url();?>assets/images/testimonials/<?php echo $ts->student_image; ?>" alt=""> </div>
                    <div class="media-body">
                      <div class="overview">
                        <div class="name"><b><?php echo $ts->student_name; ?></b></div>
                        <div class="details"><?php echo $ts->student_quali; ?></div>
                        <div class="star-rating">
                          <ul class="list-inline">
                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                            <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
			  <?php } ?>
              </div>
            </div>
			<?php $i++; } ?>
            
            
          </div>
          <!-- Carousel controls --> 
          <a class="carousel-control left carousel-control-prev" href="#myCarousel" data-slide="prev"> <i class="fa fa-chevron-left"></i> </a> <a class="carousel-control right carousel-control-next" href="#myCarousel" data-slide="next"> <i class="fa fa-chevron-right"></i> </a> </div>
      </div>
    </div>
  </div>
</section>
<section id="awa">
  <div class="container text-center">
    <div class="row">
      <div class="col-md-4"><img src="<?php echo base_url();?>assets/images/front/awards.jpg" class="img-fluid">
        <h2>AWARDS</h2>
      </div>
      <div class="col-md-4"><img src="<?php echo base_url();?>assets/images/front/Conference.jpg" class="img-fluid">
        <h2>CONFERENCE</h2>
      </div>
      <div class="col-md-4"><img src="<?php echo base_url();?>assets/images/front/exhibition.jpg" class="img-fluid">
        <h2>EXHIBITION</h2>
      </div>
    </div>
  </div>
</section>
<section id="right">
  <div class="container text-center center-block">
    <h1>HOW TO BOOK A STALL?</h1>
   <h2> Contact KAB Consultants or TV9 to book a stall.</h2>
    <div class="row align-items-center">
      <div class="col-12 mx-auto">
       <a href="#"><button class="btn-default btn">Book a Stall >></button></a>
      </div>
    </div>
  </div>
</section>

<?php $this->load->view("front/includes/footer");?>