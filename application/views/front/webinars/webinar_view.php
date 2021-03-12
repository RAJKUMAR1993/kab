<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 $this->load->view("front/includes/new_header");?> 
<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
<script>
$(document).ready(function(){
    $('.customer-logos').slick({
        slidesToShow: 3,
        slidesToScroll: 3,
        autoplay: true,
        autoplaySpeed: 1500,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 4
            }
        }, {
            breakpoint: 520,
            settings: {
                slidesToShow: 3
            }
        }]
    });
});
</script>
  <style type="text/css">
  #hero_in{
    height:230px;
  }

.ed_course_single_tab .nav-tabs {
    border: 1px solid #dc3545;
    background-color: #ffffff;
    text-transform: capitalize;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    transition: all 0.3s ease;
	
}
.ed_course_single_tab .nav-tabs > li.active > a, .ed_course_single_tab .nav-tabs > li.active > a:hover, .ed_course_single_tab .nav-tabs > li.active > a:focus {
    color: #ffffff;
     border: 1px solid #dc3545;
    background-color: #b6264e;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    transition: all 0.3s ease;
	
}
.ed_course_single_tab .nav-tabs > li > a {
    margin-right: 0px;
    border-radius: 0px;
    
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    transition: all 0.3s ease;
}
.ed_course_single_tab {
    float: left;
    width: 100%;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    transition: all 0.3s ease;
}
.ed_course_single .ed_course_single_info {
    padding-top: 20px;
}
.ed_course_single_info {
    float: left;
    width: 100%;
    background-color: #ffffff;
    padding: 20px 0px;
}
.nav>li>a {
    position: relative;
    display: block;
    padding: 12px 12px;
	color:#b6264e;
}
.ed_course_tabconetent {
    border: 1px solid #dc3545;
	
    border-top: none;
    padding: 20px;
    float: left;
    width: 100%;
}

.ed_course_duration p {
    float: left;
    width: 100%;
    color: green;
    font-weight: 600;
    margin: 5px 0px 0px 0px;
}
.ed_course_tabconetent h2{ font-size:20px;}
.ed_course_tabconetent h4{ font-size:17px; margin:0px;}

.ed_course_tabconetent p {
    margin-bottom: 0;
}

.badge {
    display: inline-block;
    min-width: 10px;
    padding: 3px 7px;
    font-size: 13px !important;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    background-color:green;
    border-radius: 10px;
}
.ed_course_single_tab .nav-tabs > li > a:hover {
    border-color: #167ac6 #167ac6 #167ac6;

    color: #ffffff;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    transition: all 0.3s ease;
}
.ed_course_single_tab .nav > li > a:hover, .nav > li > a:focus {
  
    background-color: #b6264e;
	
	  color: #ffffff;
	  
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    transition: all 0.3s ease;
}
.widget_categories ul li{ background:url(list.png) left top no-repeat; padding-left:20px;}
.widget_categories ul li a {
    font-size: 13px;
    /* text-decoration: none; */
    text-transform: capitalize;
    -webkit-transition: all 0.3s;
    -moz-transition: all 0.3s;
    -ms-transition: all 0.3s;
    -o-transition: all 0.3s;
    transition: all 0.3s;
    color: #333;
    line-height: 30px;
}
.widget_categories ul li a:hover { color:#b6264e;}
.widget-title {
    padding: 11px 0;
    margin-bottom: 15px;
    border-bottom: 1px solid #ccc9c9;
    font-size: 19px;
}
</style>
  <main>
  <section id="hero_in" class="general">
    <div class="wrapper">
      <div class="container">
        <h1 class="fadeInUp"><span></span>Event Schedule</h1>
      </div>
    </div>
  </section>
  <br/>
  <div class="bg_color_1 webinarSchedule" id="webinarSchedule">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
          <div class="ed_course_single_item">
            <div class="ed_course_single_image"> <img id="" src="<? if($webinar->view_image){ echo base_url().'assets/images/webinars/'.$webinar->view_image; } else { echo base_url().'assets/images/webinars/detault.jpg'; } ?>" class="img-fluid img-thumbnail" style="width: 825px;height: 450px;"> </div>
            <div class="ed_course_single_info">
              <div>
                <div class="row">
                  <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 pull-left text-left">
                    <div class="ed_course_duration date">
                      <h4 id="ContentPlaceHolder1_heventname"><?php echo $webinar->title;?></h4>
                      <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pull-left text-left">
                          <p>Date: &nbsp;<span id="ContentPlaceHolder1_seventDate"><?php echo date('d-m-Y', strtotime($webinar->date));?></span></p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 pull-right text-right">
                    <div class="ed_course_duration">
                      <p><span class="Timing">Timings: </span><span id="ContentPlaceHolder1_stime"><?php echo date('H:i A', $webinar->from_time);?> - <?php echo date('H:i A', $webinar->to_time);?></span></p>
                      <?php 
                      	$from = date('Y-m-d', strtotime($webinar->date)).'T'.date('H:i:s', $webinar->from_time);
                      	$to = date('Y-m-d', strtotime($webinar->date)).'T'.date('H:i:s', $webinar->to_time);
						$date1 = new DateTime($from);
						$date2 = new DateTime($to);
					    $diff = $date2->diff($date1);
					    $duration = $diff->format('%h');
                      ?>
                      <p><span class="Duration" style="margin-right: 47px">Duration: </span><span id="ContentPlaceHolder1_sdays" class=""><?php echo $duration. ' hr(s)';?></span></p>
                    </div>
                  </div>
                </div>
              </div>
              <div> </div>
            </div>
            <div class="ed_course_single_tab">
              <div role="tabpanel"> 
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class=""><a href="#description" class="active show" aria-controls="description" role="tab" data-toggle="tab" aria-expanded="true">Description</a></li>
                  <li role="presentation" class=""><a href="#panellist" aria-controls="students" role="tab" data-toggle="tab" aria-expanded="false">Panel List</a></li>
                </ul>
                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane active" id="description">
                    <div class="ed_course_tabconetent">
                      <h2>About Programme</h2>
                      <p id="ContentPlaceHolder1_pdescription"></p>
                      <p class="MsoNormal"><span style="font-size: 13pt;"><? echo $webinar->description; ?> </span></p>
                      <p></p>
                    </div>
                    <div class="ed_course_tabconetent">
                      <div class="ed_inner_dashboard_info">
                        <div class="ed_course_single_info">
                          <h2>Total panel list :- <span id="ContentPlaceHolder1_spanellist" class="badge badge-primary" style="color: white; margin-left: 5px; font-size: 25px"><?php echo count($users);?></span></h2>
                          	<?php
                            foreach ($users as $k => $user) {
                            ?>
	                          <div class="media border p-3"> <img src="<?php echo $user['image'];?>" alt="" class="mr-3 rounded-circle" style="width:60px;">
	                            <div class="media-body">
	                              <h4><?php echo $user['name'];?> </h4>
	                              <p><i><?php echo $user['designation'];?> </i></p>
	                              <p><strong>Specialization : </strong><?php echo $user['specialization'];?></p>
	                              <p><strong>Experience : </strong><?php echo $user['experience'];?></p>
	                              <p><strong>About : </strong><?php echo $user['about_yourself'];?></p>
	                              <p><strong>Qualification : </strong><?php echo $user['qualification'];?></p>
	                              <p><strong>Email : </strong><?php echo $user['email'];?></p>
	                              <p><strong>Mobile No. : </strong><?php echo $user['mobile_no'];?></p>
	                              <p><strong>Current Organization : </strong><?php echo $user['current_organization'];?></p>
	                            </div>
	                          </div>
	                          <div style="height:10px;"></div>
	                        <?php
	                      	}
	                        ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div role="tabpanel" class="tab-pane" id="panellist">
                    <div class="ed_inner_dashboard_info">
                      <div class="ed_course_tabconetent">
                      <div class="ed_inner_dashboard_info">
                        <div class="ed_course_single_info">
                          <h2>Total panel list :- <span id="ContentPlaceHolder1_spanellist" class="badge badge-primary" style="color: white; margin-left: 5px; font-size: 25px">2</span></h2>
                          	<?php
                            foreach ($users as $k => $user) {
                            ?>
	                          <div class="media border p-3"> <img src="<?php echo $user['image'];?>" alt="" class="mr-3 rounded-circle" style="width:60px;">
	                            <div class="media-body">
	                              <h4><?php echo $user['name'];?> </h4>
	                              <p><i><?php echo $user['designation'];?> </i></p>
	                              <p><strong>Specialization : </strong><?php echo $user['specialization'];?></p>
	                              <p><strong>Experience : </strong><?php echo $user['experience'];?></p>
	                              <p><strong>About : </strong><?php echo $user['about_yourself'];?></p>
	                              <p><strong>Qualification : </strong><?php echo $user['qualification'];?></p>
	                              <p><strong>Email : </strong><?php echo $user['email'];?></p>
	                              <p><strong>Mobile No. : </strong><?php echo $user['mobile_no'];?></p>
	                              <p><strong>Current Organization : </strong><?php echo $user['current_organization'];?></p>
	                            </div>
	                          </div>
	                          <div style="height:10px;"></div>
	                        <?php
	                      	}
	                        ?>
                        </div>
                      </div>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
              <!--tab End--> 
            </div>
          </div>
        </div>
        <!--Sidebar Start-->
        
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="sidebar_wrapper_upper">
            <div class="sidebar_wrapper">
              <aside class="widget widget_categories">
                <h4 class="widget-title">Related events</h4>
                <ul>
                	<?php
                	$c = 0;
                	foreach ($webinars as $webinar) {
                		if($webinar->id!=$webinar->id){
                			$c++;
                	?>
                  	<li><a href="<?php echo base_url();?>front/webinars/webinar_view/<?php echo $webinar->id;?>"><?php echo $webinar->title;?></a></li>
                  	<?php
                  		}
                  	}
                  	if($c==0){
                  		echo "<li style='color:red;'>No Webinars.</li>";
                  	}
                  	?>
                </ul>
                <?php
				$datetime = date("Y-m-d H:i:s");
				$timetoseconds = strtotime($datetime);
                if($timetoseconds>=$webinar->from_time && $timetoseconds<=$webinar->to_time){
                    $zoom_meeting = $this->db->where("webinar_id", $webinar->id)->get("tbl_zoom_meetings")->row();
                ?>
                    <a <?php if($this->session->userdata("student_id")){ ?> href="<? if(isset($zoom_meeting->meeting_link)){echo $zoom_meeting->meeting_link;}else{ echo '#';} ?>" class="btn btn-primary" target="_blank" <?php } else{ ?> class="btn btn-primary modalloginnext" href="javascript:void(0)" data-toggle="modal" data-target="#myModalLoginNow"<?php }?>>Join Now</a>
                <?php
                }
                else{
                ?>
                    <a style="color: #000;" <?php if($this->session->userdata("student_id")){ ?> onclick="getDetails('<?php echo $webinar->id;?>', '<?php echo $webinar->professor_id;?>')" class="btn btn-warning" <?php } else{ ?> class="btn btn-warning modalloginnext" href="javascript:void(0)" data-toggle="modal" data-target="#myModalLoginNow"<?php }?>>Participate</a>
                <?php
                }
                ?>
              </aside>
             
            </div>
          </div>
        </div>
        
        <!--Sidebar End--> 
        
      </div>

        <div class="row" style="padding-top:15px">
            <div class="col-md-6 moblie_p_info" id="30_min_session" style="display: none;">
                <form id="webinarpart">
                    <input type="hidden" name="webinar_id" id="webinar_id">
                      <div class="form-group">
                         <button class="btn btn-danger round_btns confirm_participation">Confirm Participation</button>
                         <button class="btn btn-info round_btns cancelButton" type="button">Cancel</button>
                      </div>
                </form>
            </div>
        </div>
    </div>
  </div>
</div>
</main>
<script type="text/javascript">
    $(document).ready(function(){
        $(".cancelButton").on("click", function(){
            clear();
        });
        $(".custom_nav_item").on("click", function(){
            clear();
        });
        $("#webinarpart").on('submit', function(e){
            e.preventDefault();
            var fdata = $("#webinarpart").serialize();
            var url = '<?php echo base_url("front/webinars/save_in_participants")?>';
            $.ajax({
                url:url,
                data:fdata,
                type:"post",
                dataType:"json",
                beforeSend: function(){
                  $("#loader").show();
                },
                success: function(str){
                  $("#loader").hide();
                  if(str.Status == 'Active'){
                    toastr.remove();
                    toastr['success'](str.Message, '', {
                        positionClass: 'toast-bottom-right'
                    });
                    setTimeout(function(){
						location.reload();
//                        window.location.href = "<?php echo base_url("front/webinars/payment_page")?>";
                    }, 2000);
                  }else{
                    toastr.remove();
                    toastr['error'](str.Message, '', {
                        positionClass: 'toast-bottom-right'
                    });
                  }
                }
            });
        });
    });
    function getDetails(web_id, prof_id){
        $("#webinar_id").val(web_id);
        $("#professor_id").val(prof_id);
        $(".moblie_p_info").show();
        $(".name").val('');
        $(".email").val('');
        $(".phone").val('');
        $(".comment").val('');
        $(".address").val('');
        var target = $('.moblie_p_info');
        if (target.length) {
            $('html,body').animate({
                scrollTop: target.offset().top - 100
            }, 1000);
            return false;
        }
    }
    function clear(){
        $("#webinar_id").val('');
        $("#professor_id").val('');
        $(".moblie_p_info").hide();
        $(".name").val('');
        $(".email").val('');
        $(".phone").val('');
        $(".comment").val('');
        $(".address").val('');
        var target = $('.webinarSchedule');
        if (target.length) {
            $('html,body').animate({
                scrollTop: target.offset().top - 100
            }, 1000);
            return false;
        }
        return false;
    }
</script>
    <?php $this->load->view("front/includes/new_footer");?>
<?php $this->load->view("student/login/login_popup")?>
