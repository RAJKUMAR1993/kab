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
<? if($this->session->userdata("student_id")){ ?>
<!--<a href="<? echo base_url() ?>student/eventBag"><button class="cartbox-open"><i class="fa fa-shopping-bag fa-2x" aria-hidden="true"></i> </button></a>-->
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
    <script src="<?php echo base_url();?>assets/vendor/toastr/toastr.js"></script>

<script>
       AOS.init({
          duration: 1200,
        })
  </script>
</body>
</html>