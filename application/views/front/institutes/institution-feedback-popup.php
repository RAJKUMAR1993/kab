<style type="text/css">
  .rating i {
    color: #f00!important;
}
textarea {
  width: 40%;
  color: rgb(0, 0, 0);
  border: 1px solid;
  height: 66px;
  resize: auto;
  border-radius: 5px;
}
</style>
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

<div class="custom_modal" id="feedbacki">
    <div class="row">
        <div class="col-md-12 text-right">
            <a style="font-size:20px;cursor:pointer;color:red" onclick="closeModal('feedbacki');">
                <i class="icon-cancel-6"></i><p style="font-size:10px">Close</p>
            </a>
        </div>
    </div>
    <div class="container margin_20">
      <div class="main_title_2" style="margin-bottom: 0px;">
        <span><em></em></span>
        <h2>Feedback</h2>

      </div>
      <div class="grid">
       <div class="row align-items-center text-center">
  
 <div class="col-md-12">  <img src="<? echo base_url()?>assets/images/front/img_1.png" /> <p><? echo $idata->feedback_description; ?></p></div>
 
  </div>
  <form method="post" id="instfeedback">
  <div class="row align-items-center text-center">
   <div class="col-md-12 rate">
                                    <h5>
                                        <? echo $idata->feedback_question; ?>
                                    </h5>
                  <span style="color:#f00!important;" id="rating" class="rating" data-current-rating="0" data-icon-bad="fa fa-heart-o" data-icon-good="fa fa-heart"><i class="magic-rating-icon fa fa-heart" aria-hidden="true" data-default="false" data-rating="1"></i><i class="magic-rating-icon fa fa-heart-o" aria-hidden="true" data-default="false" data-rating="2"></i><i class="magic-rating-icon fa fa-heart-o" aria-hidden="true" data-default="false" data-rating="3"></i><i class="magic-rating-icon fa fa-heart-o" aria-hidden="true" data-default="false" data-rating="4"></i><i class="magic-rating-icon fa fa-heart-o" aria-hidden="true" data-default="false" data-rating="5"></i></span>                  
                                  <br/>
                                  <input type="hidden" name="student_id" value="<? if($this->session->userdata("student_id")){echo $this->session->userdata("student_id");}else{ echo 'anonymous'; } ?>">
                                  <input type="hidden" name="institute_id" value="<? echo $idata->institute_id; ?>">
                                  <input type="hidden" id="srating" name="srating" value="">
                                  <div style="text-align: center;">
                                  <textarea name="comment" style="text-align: center;" placeholder="Comment"></textarea>
                                </div>
                                <br/>
                                  <button type="submit" class="btn btn-danger"> GIVE FEEDBACK</button>
                                  &nbsp;&nbsp;&nbsp;
                                  <a href="<? echo base_url(); ?>" class="btn btn-success"> HOME</a>
                              <div class="smsgfb"></div>      
                                </div>
  </div>
  
  </form>
      </div>
  </div>
</div>



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
          setTimeout(function(){location.reload()},3000)
        }else if(data == "empty"){
          $(".smsgfb").html('<div class="alert alert-danger">Please give atleast one of rating or comment. </div>');
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