<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 $this->load->view("front/includes/new_header");?> 
<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
 -->

<style>
article.blog .post_info ul {
    margin: 10px 30px 0 12px;
    padding: 0px 10px 0 10px;
    width: 100%;
    position:relative;
    bottom: 11px;
    border-top: 0px solid #ededed;
}
.bord{ border-bottom: 1px solid #ededed;}


.clearfix{ clear:both;}

article.blog figure {
    height: 100%;
    overflow: hidden;
    position: static;
    margin-bottom: 0;
}


.slick-slide {
    margin: 0px 10px;
    padding:0px;
}

.slick-slide img {
    width: 100%;
}

.slick-slider
{
    position: relative;
    display: block;
    box-sizing: border-box;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
            user-select: none;
    -webkit-touch-callout: none;
    -khtml-user-select: none;
    -ms-touch-action: pan-y;
        touch-action: pan-y;
    -webkit-tap-highlight-color: transparent;
}

.slick-list
{
    position: relative;
    display: block;
    overflow: hidden;
    margin: 0;
    padding: 0;
}
.slick-list:focus
{
    outline: none;
}
.slick-list.dragging
{
    cursor: pointer;
    cursor: hand;
}

.slick-slider .slick-track,
.slick-slider .slick-list
{
    -webkit-transform: translate3d(0, 0, 0);
       -moz-transform: translate3d(0, 0, 0);
        -ms-transform: translate3d(0, 0, 0);
         -o-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
}

.slick-track
{
    position: relative;
    top: 0;
    left: 0;
    display: block;
}
.slick-track:before,
.slick-track:after
{
    display: table;
    content: '';
}
.slick-track:after
{
    clear: both;
}
.slick-loading .slick-track
{
    visibility: hidden;
}

.slick-slide
{
    display: none;
    float: left;
    height: 100%;
    min-height: 1px;
}
[dir='rtl'] .slick-slide
{
    float: right;
}
.slick-slide img
{
    display: block;
}
.slick-slide.slick-loading img
{
    display: none;
}
.slick-slide.dragging img
{
    pointer-events: none;
}
.slick-initialized .slick-slide
{
    display: block;
}
.slick-loading .slick-slide
{
    visibility: hidden;
}
.slick-vertical .slick-slide
{
    display: block;
    height: auto;
    border: 1px solid transparent;
}
.slick-arrow.slick-hidden {
    display: none;
}
</style>
<style type="text/css">
  #hero_in{
    height:230px;
  }
  .col-lg-12, .col-xs-12, .col-sm-12 {
    padding-right: 0px;
    padding-left: 0px;
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
    <div class="<? echo (count($webinor_dates)>0) ? 'bg_color_1' : '' ?> webinarSchedule" id="webinarSchedule">
        <div class="container">
            <?php
            if(count($webinor_dates)>0){
            ?>
            <ul class="nav nav-pills">
            <?php
            $i = 1;
            foreach ($webinor_dates as $webinor_date) {
            ?>
            <li class="nav-item custom_nav_item" style="background-color: red;">
                <a class="nav-link <?php if($i==1){echo 'active';}?>" data-toggle="pill" href="#<?php echo 'webinor_'.$webinor_date->id;?>">
                    <h4 style="color:#fff">Day <?php echo $i++;?></h4>
                    <h6 style="color:#fff"><?php echo date("d-M-Y", strtotime($webinor_date->date));?></h6>
                </a>
            </li>
            <?php
            }
            ?>
            </ul>
            <div class="tab-content" style="border:1px solid indigo;padding-top:15px">
                <?php
                $datetime = date("Y-m-d H:i:s");
                $timetoseconds = strtotime($datetime);
                $i = 1;
                foreach ($webinor_dates as $webinor_date) {       
                    $webinars = $this->db->select("*")->where("date =", $webinor_date->date)->where("to_time >= ".$timetoseconds)->get("tbl_webinors")->result();
                ?>
                <div class="tab-pane container <?php if($i==1){echo 'active';}?>" id="<?php echo 'webinor_'.$webinor_date->id;?>">
                    <div class="row">
                        <?php
                        $i = 1;
                        foreach ($webinars as $webinar) {
                            $users = array();
                            $professors = explode(',', $webinar->professor_ids);
                            if(count($professors)>0 && $webinar->professor_ids!=''){
                                foreach ($professors as $professor_id) {
                                    $pro_details = $this->db->get_where("tbl_professors", ["pro_id" => $professor_id, "pro_status" => 'Active', "is_deleted" => 0])->row();
                                    $users[] = array(
                                        'image' => ($pro_details->image) ? base_url().'assets/images/professors/'.$pro_details->image : base_url().'assets/images/professors/user.png',
                                        'name' => $pro_details->pro_name,
                                        'designation' => $pro_details->pro_designation,
                                        'specialization' => $pro_details->specialization,
                                        'experience' => $pro_details->work_exp,
                                        'about_yourself' => $pro_details->pro_shortdesc,
                                        'qualification' => $pro_details->pro_quali,
                                        'email' => $pro_details->pro_email,
                                        'mobile_no' => $pro_details->mobile1,
                                        'current_organization' => $pro_details->current_organization
                                    );
                                }
                            }
                            $guests = explode(',', $webinar->guest_ids);
                            if(count($guests)>0 && $webinar->guest_ids!=''){
                                foreach ($guests as $guest_id) {
                                    $gdetails = $this->db->get_where("tbl_webinar_guests", ["id" => $guest_id])->row();
                                    $users[] = array(
                                        'image' => ($gdetails->image) ? base_url().'assets/images/guests/'.$gdetails->image : base_url().'assets/images/guests/user.png',
                                        'name' => $gdetails->name,
                                        'designation' => $gdetails->designation,
                                        'specialization' => $gdetails->specialization,
                                        'experience' => $gdetails->work_exp,
                                        'about_yourself' => $gdetails->about_yourself,
                                        'qualification' => $gdetails->qualification,
                                        'email' => $gdetails->email,
                                        'mobile_no' => $gdetails->mobile_no,
                                        'current_organization' => $gdetails->current_organization
                                    );
                                }
                            }
							$speakers = explode(',', $webinar->speaker_ids);
                            if(count($speakers)>0 && $webinar->speaker_ids!=''){
                                foreach ($speakers as $speaker_id) {
                                    $sdetails = $this->db->get_where("tbl_speakers", ["speaker_id" => $speaker_id])->row();
                                    $users[] = array(
                                        'image' => ($sdetails->speaker_photo) ? base_url().$sdetails->speaker_photo : base_url().'assets/images/guests/user.png',
                                        'name' => $sdetails->speaker_name,
                                        'designation' => $sdetails->speaker_designation,
                                        'specialization' => $sdetails->speaker_qualification,
                                        'experience' => $sdetails->speaker_tworkexp,
                                        'about_yourself' => $sdetails->speaker_shortdesc,
                                        'qualification' => $sdetails->speaker_qualification,
                                        'email' => $sdetails->speaker_mailingaddress,
                                        'mobile_no' => $sdetails->speaker_mobile,
                                        'current_organization' => $sdetails->speaker_curorg
                                    );
                                }
                            }
                        ?>
                        <div class="col-lg-12 searchResults" style="padding-left: 10px;">
                            <article class="blog wow fadeIn">
                                    <div class="row no-gutters">
                                        <div class="col-lg-4">
                                            <figure>
                                                <img src="<? if($webinar->image){ echo base_url().'assets/images/webinars/'.$webinar->image; } else { echo base_url().'assets/images/webinars/detault.jpg'; } ?>" class="img-fluid" alt="">
                                            </figure>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="post_info">
                                                <h6><?php echo $webinar->title;?></h6>
                                                <h6 style="color:green"><?php echo date('d-m-Y', strtotime($webinar->date));?></h6>
                                                <h6 style="color:green"><?php echo date('H:i A', $webinar->from_time);?> - <?php echo date('H:i A', $webinar->to_time);?></h6>
                                                <p><? echo $webinar->description; ?></p>
                                                <div class="bord">
                                                    <div class="col-md-12" style="display: flex;" >
                                                        <div class="container">
                                                            <section class="customer-logos slider">
                                                                <?php
                                                                    foreach ($users as $k => $user) {
                                                                        $tooltip = "About : ".$user['about_yourself']."<br>Qualification : ".$user['qualification']."<br>Email : ".$user['email']."<br>Mobile No. : ".$user['mobile_no']."<br>Current Organization : ".$user['current_organization'];
                                                                ?>
                                                                <div class="slide">
                                                                    <div class="box_teacher" style="padding:10px;">
                                                                        <div class="row">
                                                                            <div class="col-3">
                                                                                <img src="<?php echo $user['image'];?>" style="height: 50px;width: 50px;max-width: none !important;">
                                                                            </div>
                                                                            <div class="col-9" style="padding-left: 35px;">
                                                                                <span style="margin-top:0px;font-size: 12px;"><?php echo $user['name'];?></span>
                                                                                <br>
                                                                                <small style="margin-top:0px;"><?php echo $user['designation'];?></small><br>
                                                                                <small style="margin-top:0px;"><?php echo $user['specialization'];?></small><br>
                                                                                <small style="margin-top:0px;">Exp : <?php echo $user['experience'];?></small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                                }
                                                                ?>
                                                            </section>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                                <div class="clearfix">
                                            </div>
                                            <ul>
                                                <li style="padding-left: 0px;">
                                                    <a <?php //if($this->session->userdata("student_id")){ ?> class="btn btn-info" style="color: #fff;" href="<?php echo base_url();?>front/webinars/webinar_view/<?php echo $webinar->id;?>" >View</a>
                                                </li>
                                                <li>
                                                    <?php

                                                    $chkp = $this->db->get_where("tbl_webinar_participants",["webinar_id"=>$webinar->id,"webinar_student_id"=>$this->session->userdata("student_id")])->num_rows();     
                                                    if($timetoseconds>=$webinar->from_time && $timetoseconds<=$webinar->to_time){
                                                        $zoom_meeting = $this->db->where("webinar_id", $webinar->id)->get("tbl_zoom_meetings")->row();
                                                    ?>
                                                        <a <?php if($this->session->userdata("student_id")){ ?> href="<? if(isset($zoom_meeting->meeting_link)){echo $zoom_meeting->meeting_link;}else{ echo '#';} ?>" class="btn btn-primary" target="_blank" <?php } else{ ?> class="btn btn-primary modalloginnext" href="javascript:void(0)" data-toggle="modal" data-target="#myModalLoginNow"<?php }?>>Join Now</a>
                                                    <?php
                                                    }
                                                    else{
                                                         ?>
                                                        <button style="color: #000;" id="mySubmit" <?php if($this->session->userdata("student_id")){ ?> onclick="getDetails('<?php echo $webinar->id;?>', '<?php echo $webinar->professor_id;?>')" class="btn btn-warning" <?php } else{ ?> class="btn btn-warning modalloginnext" href="javascript:void(0)" data-toggle="modal" data-target="#myModalLoginNow"<?php } ?> <? echo ($chkp > 0) ? 'disabled' : '' ?>>Participate</button>
                                                    <?php
                                                    }
                                                    ?>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    <?php   
                        }
                    ?>
                    </div>
                </div>
                <?php
                $i++;
                }
                ?> 
                <div class="row" style="padding-left:15px">
                    <div class="col-md-6 moblie_p_info" id="30_min_session" style="display: none;">
                        <form id="webinarpart">
                            <input type="hidden" name="webinar_id" id="webinar_id">
                              <div class="form-group">
                                 <button  class="btn btn-danger round_btns confirm_participation">Confirm Participation</button>
                                 <button class="btn btn-info round_btns cancelButton" type="button">Cancel</button>
                              </div>
                        </form>
                    </div>
                </div>
                <nav aria-label="..."></nav>
            </div>
            <?php
            }
            else{
                echo '<div class="tab-content" style="margin-top: 60px;margin-bottom: 60px;"><h5 style="text-align:center;color:red;">No Webinars found.</h5></div>';
            }
            ?>
        </div>
    </div>
</main>

<? $this->load->view("front/includes/new_footer"); ?>   
   
    <script src="<?php echo base_url();?>assets/udema/js/common_scripts.js"></script>
    <script src="<?php echo base_url();?>assets/udema/js/main.js"></script>
    
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
//                        window.location.href = "<?php echo base_url("front/webinars/payment_page")?>";
						location.reload();
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
<?php $this->load->view("student/login/login_popup")?>


    