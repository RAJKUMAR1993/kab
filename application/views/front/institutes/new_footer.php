<style type="text/css">
    button.cartbox-open {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 52px;
    height: 52px;
    color: #fff;
    background-color: #FF9800;
    background-position: center center;
    background-repeat: no-repeat;
    box-shadow: 12px 15px 20px 0 rgba(46, 61, 73, 0.15);
    border: 0;
    border-radius: 50%;
    cursor: pointer;
    margin: 16px;
	z-index: 999999999999;
}
</style>
<footer>
		<div class="container margin_20_20">
			<div class="row">
				<div class="col-lg-5 col-md-12 p-r-5">
					<p><img src="img/logo.png" width="149" height="42" data-retina="true" alt=""></p>
					<p>Mea nibh meis philosophia eu. Duis legimus efficiantur ea sea. Id placerat tacimates definitionem sea, prima quidam vim no. Duo nobis persecuti cu. Nihil facilisi indoctum an vix, ut delectus expetendis vis.</p>
					<div class="follow_us">
						<ul>
							<li>Follow us</li>
							<li><a href="#0"><i class="ti-facebook"></i></a></li>
							<li><a href="#0"><i class="ti-twitter-alt"></i></a></li>
							<li><a href="#0"><i class="ti-google"></i></a></li>
							<li><a href="#0"><i class="ti-pinterest"></i></a></li>
							<li><a href="#0"><i class="ti-instagram"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 ml-lg-auto">
					<h5>Useful links</h5>
					<ul class="links">
						<li><a href="<? echo base_url()?>exhibitors">Exhibitors</a></li>
						<li><a href="<? echo base_url().'professor';?>">Professors</a></li>
						<li><a href="<? echo base_url()?>speakers">Eminent Speakers</a></li>
						<li><a href="<? echo base_url().'experts';?>">Expert Counsellors</a></li>
						<li><a href="#0">Seminars</a></li>
					</ul>
				</div>
				<div class="col-lg-3 col-md-6">
					<h5>Contact with Us</h5>
					<ul class="contacts">
						<li><a href="tel://9848056294"><i class="ti-mobile"></i> 9848056294</a></li>
						<li><a href="mailto:info@kabfair.com"><i class="ti-email"></i> info@kabfair.com</a></li>
					</ul>
				</div>
			</div>
			<!--/row-->
			<hr>
			<div class="row">
				<div class="col-md-8">
					<ul id="additional_links">
						<li><a href="#0">Terms and conditions</a></li>
						<li><a href="#0">Privacy</a></li>
					</ul>
				</div>
				<div class="col-md-4">
					<div id="copy">© 2020 Kab Education</div>
				</div>
			</div>
		</div>
	</footer>
	<!--/footer-->
	</div>
	<!-- page -->
<? if($this->session->userdata("student_id")){ ?>
<a href="<? echo base_url() ?>student/eventBag"><button class="cartbox-open"><i class="fa fa-shopping-bag fa-2x" aria-hidden="true"></i> </button></a>
<? } ?>
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
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script> 
    <script src="<?php echo base_url();?>assets/udema/js/jquery-2.2.4.min.js"></script>
    <script src="<?php echo base_url();?>assets/udema/js/common_scripts.js"></script>
    <script src="<?php echo base_url();?>assets/udema/js/main.js"></script>
	<script src="<?php echo base_url();?>assets/udema/assets/validate.js"></script>

<script>
       AOS.init({
          duration: 1200,
        })
  </script>
</body>
</html>