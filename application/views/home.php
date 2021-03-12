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
<div class="news-scroll">
<div class="container">
<div class="row">
<div class="col-md-1 col-sm-2 col-xs-12 news-scroll-left">UPDATE</div>
<div class="col-md-11 col-sm-10 col-xs-12">

<div class="news-scroll-right">
  <div class="simple-marquee-container scr1">
   
    
  <div class="marquee-1" style="left: -1100.93px;">
      <marquee id="test" behavior="scroll" direction="left" height="40" scrolldelay="4" scrollamount="4" onmouseover="document.all.test.stop()" onmouseout="document.all.test.start()">
       <?php foreach($news as $ne){ ?>
      <span style="padding-left:50px;"> <?php echo $ne->message; ?> </span>
    <?php } ?>
        </marquee>
    </div>
    
    </div>
    
    </div>

</div>





</div>


</div>

</div>

<section id="platform">
  <div class="container text-white">
    <div class="platform">
      <div class="row">
        <div class="col-md-3 align-items-center">
        
          <h2 class="">Career Bonaza <br/>
            for Intermediate</h2>
        </div>
        <div class="col-md-9">
          <div class="row">
            <div class="col-md-4">
              <div class="green">
              <img src="<?php echo base_url();?>assets/images/front/icon-1.png" width="70px">
                <h1>50+</h1>
                <h3>Institutions</h3>
                <p>India's Top Ranked Institutions, best Universities & Colleges are </p>
                <a href="#">
                <button class="btn btn-light bbn cap"> Joining</button>
                </a> </div>
            </div>
            <div class="col-md-4">
              <div class="red">
              <img src="<?php echo base_url();?>assets/images/front/icon-2.png" width="70px">
                <h1>5000 Seats</h1>
                <h3>50+ Specializations 10+ Programmers</h3>
                <p>Most Preferred Programmers & Technology Specialist in Engineering Science, Commerce & Management courses are</p>
                <a href="#">
                <button class="btn btn-light  bbn cap"> Offered </button>
                </a> </div>
            </div>
            <div class="col-md-4">
              <div class="blue">
              <img src="<?php echo base_url();?>assets/images/front/icon-3.jpg" width="70px">
                <h1>100+</h1>
                <h3>Professors, Career Advisor</h3>
                <p>Most Experienced Professors, Guidance Counsellors, Industry Experts for </p>
                <a href="#">
                <button class="btn btn-light bbn cap"> One to One Interaction </button>
                </a> </div>
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
    <h1> The Event : KAB Education Fair-2020 </h1>
      <div class="line"><img src="<?php echo base_url();?>assets/images/front/line.png"></div>
   
    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. </p>
    <div class="row text-center align-items-center">
      <div class="col-lg-4 col-md-6 col-sm-6 col-12 ">
        <h3>100000+ Students<br/> benefited</h3>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 col-12 ">
        <h3>100+ Institutions Participants every year</h3>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 col-12 ">
        <h3>50+ events Conducts so far in AP & Telangana</h3>
      </div>
    </div>
    <div class="row text-center align-items-center12">
      <div class="col-lg-4 col-md-6 col-sm-6 col-12 ">
        <div class="service-box image"> <img src="<?php echo base_url();?>assets/images/front/VC-1.png" class="img-fluid"/>
          <div class="btm-text aos-init" data-aos="fade-up">
            <div class="heading">
              <h2>College Connect</h2>
            </div>
            <p>Change to intract with university/ college admission officer / Representative via chat, videocall, Telephone</p>
            <div style="height:54px;"></div>
            <div class="more"> <a href="#">Schedule a Meeting for Live Interaction </a> </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 col-12 ">
        <div class="service-box image"> <img src="<?php echo base_url();?>assets/images/front/VC-2.png"  class="img-fluid"/>
          <div class="btm-text aos-init" data-aos="fade-up">
            <div class="heading">
              <h2>High Impact Seminars</h2>
            </div>
            <p>Most experienced Academic Administrators / Vice Chancellors / Director / Principals and Senior level IT Industries Professionals, Guidance experts presents plethora of Career options, via webcasting's advisers on career planning. </p>
            <div class="more"> <a href="#">Book Your slot</a> </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 col-12 " >
        <div class="service-box image"> <img src="<?php echo base_url();?>assets/images/front/VC-3.png"  class="img-fluid" />
          <div class="btm-text aos-init" data-aos="fade-up">
            <div class="heading">
              <h2>Talk to Professor</h2>
            </div>
            <p>Knowledge showing session/ webinars form eminent Professors from Institutions of national repute give guidance & academic Insights regarding courses career prospects expelled programme outcomes, research areas etc.</p>
            <div class="more"> <a href="#">Learn More </a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>
<section id="why">
  <div class="container ">
    <div class="row">
      <div class="col-md-7">
        <h1>Benefits to attend students</h1>
        <div class="line"><img src="<?php echo base_url();?>assets/images/front/line.png"></div>
        <div class="benbox">
          <h2>Application process for Admissions 2020</h2>

<p>Single application to reach 50+ universities / Colleges/ Institutions for admission in to undergraduate Programmes B.Tech, BBA,BSC, BCom, BA, Law, Hotel Management, Liberal Arts, BSC ( Agriculture), Paramedical Courses (BPT,MLT,Nursing)</p>
        </div>
        <div class="benbox">
          <h2>Merit Scholarship</h2>
          <p>Students can apply for merit scholarship(Tuition Fees Concession) offered by participating Institutions </p>
        </div>
        <div class="benbox">
          <p>JoSAA ,NEET and EAMCET Web Consulting Demonstration live Interaction for doubts clarifications</p>
        </div>
        <div class="benbox">
          <p>Guidance for JEE(Main)2020, JEE (Adv) 2020 NEET 2020 and EAMCET2020 rank holders on college selection, course Prioritization</p>
        </div>
        <div class="benbox">
          <p>One-to-one interaction with career advisors to shortest the career options </p>
        </div>
      </div>
      <div class="col-md-5 text-center"><img src="<?php echo base_url();?>assets/images/front/why-img.png" class="img-fluid">  
      
      <h4>REGISTRATION FREE</h4>
      <a href="#"><button class="btn btn-primary"> SUMIT YOUR QUERY </button></a>
      
      </div>
    </div>
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
      <div class="col-12 mx-auto"> <a href="#">
        <button class="btn-default btn">Book a Stall >></button>
        </a> </div>
    </div>
  </div>
</section>
<script>$('.owl-carousel').owlCarousel({
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
});</script>
<?php $this->load->view("front/includes/footer");?>