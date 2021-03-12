<? $this->load->view("front/institutes/header");?>
<nav class="navbar fixed-top bg-yellow  navbar-expand-md">
  <div class="container"> <a class="navbar-brand" href="<? echo base_url().'exhibitors/'.$this->uri->segment(2);?>"> <img src="<? 
  $idata = $this->homepage_model->get_insdetails($this->uri->segment(2));
  
  echo base_url().$idata->logo; ?>" height="51px" alt="image" style="border-right:#011b56 solid 1px;"> </a>
  
  <!-- <h2 class="c-heading"> West Bengal | Kolkata </h2> -->
 
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav3" aria-controls="navbarNav3" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
    <div class="collapse navbar-collapse" id="navbarNav3">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item "> <a class="nav-link " href="<? echo base_url().'exhibitors/'.$this->uri->segment(2).'/video' ?>"> Video Gallery</a> </li>
        <li class="nav-item"> <a class="nav-link" href="<? echo base_url().'exhibitors/'.$this->uri->segment(2).'/gallery' ?>">Photo Gallery </a> </li>
        <li class="nav-item"> <a class="nav-link" href="<? echo base_url().'exhibitors/'.$this->uri->segment(2).'/programmefee' ?>">Programme Fees</a> </li>
        <li class="nav-item"> <a class="nav-link" href="<? echo base_url().'exhibitors/'.$this->uri->segment(2).'/placements' ?>"> Placements </a> </li>
        <li class="nav-item"> <a class="nav-link" href="<? echo base_url().'exhibitors/'.$this->uri->segment(2).'/achievements' ?>"> Achivements </a> </li>
        <li class="nav-item"> <a class="nav-link" href="<? echo base_url().'exhibitors/'.$this->uri->segment(2).'/admission' ?>">Admission 2020</a> </li>
        <li>
          <div class="btn-group show-on-hover">
            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
              <? echo $this->session->userdata("student_name"); ?> <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
              <li><a href="<? echo base_url().'student/dashboard'?>">Dashboard</a></li>
              <li><a href="<? echo base_url('student/login/logout')?>">Logout</a></li>
              
            </ul>
          </div>
        </li>
      </ul>
     
    </div>
  </div>
</nav>
<script> // Init function
$.fn.magicRatingInit = function(config) {

  
    for (widget of $(this)) {
        var magicRatingWidget = $(widget);
        //// Get datas ////
        // Icon +
        if (magicRatingWidget.data("iconGood") == null) {
            magicRatingWidget.data("iconGood", config.iconGood != null ? config.iconGood : "fa-star");
        };

        // Icon -
        if (magicRatingWidget.data("iconBad") == null) {
            magicRatingWidget.data("iconBad", config.iconBad != null ? config.iconBad : "fa-star-o");
        };

        // Max mark
        if (magicRatingWidget.data("maxMark") == null) {
            magicRatingWidget.data("maxMark", config.maxMark != null ? config.maxMark : 5);
        }

        /*
        console.log(magicRatingWidget.data("iconGood"));
        console.log(magicRatingWidget.data("iconBad"));
        */

        // Clear the widget
        magicRatingWidget.html("");

        // Init icons
        for (i = 1; i <= magicRatingWidget.data("maxMark"); i++) {
            if (i <= magicRatingWidget.data("currentRating")) {
                magicRatingWidget.append('<i class=" ' + magicRatingWidget.data("iconGood") + ' magic-rating-icon" aria-hidden="true" data-default=true data-rating=' + i + '></i>');
            } else {
                magicRatingWidget.append('<i class=" ' + magicRatingWidget.data("iconBad") + ' magic-rating-icon" aria-hidden="true" data-default=false data-rating=' + i + '></i>');
            }
        }

        // Init reset handler
        magicRatingWidget.on("mouseleave", function() {
            var widget = $(this);
            /*
            console.log("mouseleave");
            console.log(widget.data("iconGood"));
            console.log(widget.data("iconBad"));
            */
            widget.children().each(function() {
                var icon = $(this);
                if (icon.data("default") && !icon.hasClass("fa-star")) {
                    icon.removeClass(widget.data("iconBad"));
                    icon.addClass(widget.data("iconGood"));
                } else if (!icon.data("default") && !icon.hasClass("fa-star-o")) {
                    icon.removeClass(widget.data("iconGood"));
                    icon.addClass(widget.data("iconBad"));
                }
            });
        });

        // Init click handler
        magicRatingWidget.on("click", ".magic-rating-icon", function() {
            // Get rating
            var icon = $(this);
            var widget = icon.parent();
            var rating = icon.data("rating");
            /*
            console.log("click");
            console.log(widget.data("iconGood"));
            console.log(widget.data("iconBad"));
            */
            // Update rating
            widget.children().each(function() {
                if ($(this).data("rating") <= rating) {
                    if (!$(this).hasClass(widget.data("iconGood"))) {
                        $(this).removeClass(widget.data("iconBad"));
                        $(this).addClass(widget.data("iconGood"));
                    };
                    $(this).data("default", true);
                } else {
                    if (!$(this).hasClass(widget.data("iconBad"))) {
                        $(this).removeClass(widget.data("iconGood"));
                        $(this).addClass(widget.data("iconBad"));
                    }
                    $(this).data("default", false);
                }
            });

            var callbackSuccess = config.success.bind(null, widget, rating);
            callbackSuccess();
        });

        // Init hover icons
        magicRatingWidget.on("mouseenter", ".magic-rating-icon", function() {
            var icon = $(this);
            var rating = icon.data("rating");
            var widget = icon.parent();
            /*
            console.log("mouseenter");
            console.log(widget.data("iconGood"));
            console.log(widget.data("iconBad"));
            */
            widget.children().each(function() {
                if ($(this).data("rating") <= rating) {
                    if (!$(this).hasClass(widget.data("iconGood"))) {
                        $(this).removeClass(widget.data("iconBad"));
                        $(this).addClass(widget.data("iconGood"));
                    };
                } else {
                    if (!$(this).hasClass(widget.data("iconBad"))) {
                        $(this).removeClass(widget.data("iconGood"));
                        $(this).addClass(widget.data("iconBad"));
                    }
                }
            });
        });
    }
};

</script>
<section class="our-webcoderskull ">
  <div class="container ">
  <h1>Feedback </h1>
  <div class="row align-items-center text-center">
  
 <div class="col-md-12">  <img src="<? echo base_url()?>assets/images/front/img_1.png" /> <p>Please help us serve you better by telling us about your product and service experience so far.<br/> We appreciate your business and want to make sure we meet your expectations.</p></div>
 
  </div>
  <form method="post" id="instfeedback">
  <div class="row align-items-center text-center">
   <div class="col-md-12 rate">
                                    <h5>
                                        How would you rate the KAB Education?
                                    </h5>
                  <span style="color:red" id="rating" class="rating" data-current-rating="0" data-icon-bad="fa fa-heart-o" data-icon-good="fa fa-heart"><i class="magic-rating-icon fa fa-heart" aria-hidden="true" data-default="false" data-rating="1"></i><i class="magic-rating-icon fa fa-heart-o" aria-hidden="true" data-default="false" data-rating="2"></i><i class="magic-rating-icon fa fa-heart-o" aria-hidden="true" data-default="false" data-rating="3"></i><i class="magic-rating-icon fa fa-heart-o" aria-hidden="true" data-default="false" data-rating="4"></i><i class="magic-rating-icon fa fa-heart-o" aria-hidden="true" data-default="false" data-rating="5"></i></span>                  
                                  <br/>
                                  <input type="hidden" name="student_id" value="<? echo $this->session->userdata("student_id"); ?>">
                                  <input type="hidden" name="institute_id" value="<? echo $institute_id; ?>">
                                  <input type="hidden" id="srating" name="srating" value="">
                                  <button type="submit" class="btn btn-danger"> GIVE FEEDBACK</button>
                              <div class="smsgfb"></div>      
                                </div>
  </div>
  
  </form>
  
  </div>
</section>

<script type="text/javascript">
        $(document).ready(function() {
            $('.rating').magicRatingInit({
                success: function(magicRatingWidget, rating) {
                    //alert(rating);
                    $('#srating').val(rating);
                },
                iconGood: "fa-bicycle",
                iconBad: "fa-car",
            });
            
        });
    </script>
<section class="footer">
            <div class="g-bg-dark">
                <div class="container g-pt-70 g-pb-40">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 g-mb-30">
                            <h3 class="h6 g-color-white text-uppercase">Head Office</h3>
              <h4 class="g-color-text g-font-size-11 text-left text-uppercase" style="color: #a09c9c !important;">Address</h4>
                            <address class="g-font-size-13 g-color-gray-dark-v3 g-font-weight-600 g-line-height-2 mb-0" style="color: #fff !important;">
                               <? echo $idata->address ?>
                            </address>
              
                            <h4 class="g-color-text g-font-size-11 text-left text-uppercase" style="color: #a09c9c !important;">Email</h4>
                            <a href="#" class="text-white"><? echo $idata->email ?></a> <br>
                            
                            <h4 class="g-color-text g-font-size-11 text-left text-uppercase" style="color: #a09c9c !important;">Phone</h4>
                            <address class="g-font-size-13 g-color-gray-dark-v3 g-font-weight-600 g-line-height-2 mb-0" style="color: #fff !important;">
                             <? echo $idata->phone ?><br>
                             
                            </address>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 g-mb-30">
                            <h3 class="h6 g-color-white text-uppercase">Admission Helpline </h3>
              <h4 class="g-color-text g-font-size-11 text-left text-uppercase" style="color: #a09c9c !important;">Phone</h4>
                            <address class="g-font-size-13 g-color-gray-dark-v3 g-font-weight-600 g-line-height-2 mb-0" style="color: #fff !important;">
                             <? echo $idata->phone ?><br>
                             
                            </address>
                            <h4 class="g-color-text g-font-size-11 text-left text-uppercase" style="color: #a09c9c !important;">Email</h4>
                            <a href="#" class="text-white"><? echo $idata->email ?> </a> <br>
                   
                            
                            
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 g-mb-30">
                             <h3 class="h6 g-color-white text-uppercase">Social Network</h3>
                                   
               <ul class="social">
                                <li class="image"><a href="#" target="blank"><img src="<?php echo base_url();?>assets/images/front/facebook.jpg" class=" image img-circle" width="25px;" alt="KAB" title="KAB"></a></li>
                                <li class="image"><a href="#" target="blank"><img src="<?php echo base_url();?>assets/images/front/twitter.jpg" class="img-circle" width="25px;" alt="KAB" title="KAB"></a></li>
                                <li class="image"><a href="#" target="blank"><img src="<?php echo base_url();?>assets/images/front/linkedin.jpg" class="img-circle" width="25px;" alt="KAB" title="KAB"></a></li>
                                <li class="image"><a href="#" target="blank"><img src="<?php echo base_url();?>assets/images/front/youtube.jpg" class="img-circle" width="25px;" alt="KAB" title="KAB"></a></li>
                         </ul>
                        </div>

                    </div>
                </div>
            </div>

            <div class="g-bg-dark-light-v1">
                <div class="container g-pt-30">
                    <div class="row align-items-center">
                        <div class="col-md-12 text-center g-mb-30">
                            <p class="d-inline-block align-middle g-font-size-13 mb-0 g-color-white">
                                © <? echo date('Y');?> <? echo $idata->institute_name; ?>. All Rights Reserved.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>



<? $this->load->view("front/institutes/footer");?>
<script type="text/javascript">

  $("#instfeedback").submit(function(e){
  
    e.preventDefault();
    var fdata = $("#instfeedback").serialize();
    
    $.ajax({

      type : "post",
      data : fdata,
      url : "<? echo base_url('front/institutes/insertfeedback') ?>",
      success : function(data){
        
        if(data == "success"){
          $(".smsgfb").html('<div class="alert alert-success">Thank you for your valuable feedback. </div>');
          //setTimeout(function(){location.reload()},3000)
        }else{
          $(".smsgfb").html('<div class="alert alert-danger">Error Occured please try again.</div>');
        }
      },
      error : function(data){
        
        console.log(data);
        
      }

    })
  
  }); 
    
</script>