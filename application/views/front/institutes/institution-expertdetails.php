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
<div id="inbanner">
<img src="<?php echo base_url();?>assets/images/front/counselor.jpg"   alt="" class="img-fluid">
</div>

<section id="ex">
  <div class="container emp-profile">
            <form id="expertsession">
              <input type="hidden" name="login_std_mail" value="<?php if($this->session->userdata('email')) { echo $this->session->userdata('email'); } ?>">
              <input type="hidden" name="expid" value="<?php echo $sessions[0]->expert_id; ?>" >
                <div class="row">
                    <div class="col-md-3">
                        <div class="profile-img">
                            <img src="<?php if($sessions[0]->expert_photo == ""){ echo base_url().'assets/images/front/team4.png'; } else { echo base_url($sessions[0]->expert_photo); } ?>" class="img-thumbnail img-fluid" alt=""/>
                            
                            
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="profile-head">
                                    <h5>
                                        <?php echo $sessions[0]->expert_name; ?>
                                    </h5>
                                    <h6>
                                        <?php echo $sessions[0]->expert_qualification; ?>
                                    </h6>
                                    <p class="proile-rating"><?php
                                      $insname = $this->expert_model->get_institute_name($sessions[0]->institute_id);
                                     echo $insname; ?></p>
                                    
                                    <p>Language Spoken: <?php echo $sessions[0]->expert_spokenlang; ?></p>
                                    <a class="btn btn-danger round_btns" id="expsessionbutton" name="btnAddMore" style="color:#fff;">BOOK A SESSION</a>
                                    
                            
                        </div>
                    </div>
                    <div class="col-md-2">
                       
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <div class="profile-work">
                            <h3>Specialities</h3>
                            <?php echo $sessions[0]->expert_expertise; ?>
                        </div>
                    </div>
                    <div class="col-md-9 cd">

                     
                     <h3>Biography</h3>
                                    <p><?php echo $sessions[0]->expert_longdesc; ?></p>
       
                    <br/>
                    <div id="expbooksession" style="display: none;">
                    <div class="row">
                      <div class="col-md-6"><a class="btn btn-block btn-primary yourButtonClass" id="s30" session_duration="30" session_thirty="<?php  echo $sessions[0]->expert_tcost; ?>">30 Minute Session</a></div>
                     <div class="col-md-6"><a class="btn btn-block yourButtonClass" id="s60" session_duration="60" session_thirty="<?php  echo $sessions[0]->expert_scost; ?>">60 Minute Session</a></div>
		
                     </div>
                     
                         <div class="row tm">
                          <input type="hidden" name="sesduration" id="sesduration" value="30" />
                          <input type="hidden" name="sescost" id="sescost" value="<?php echo $sessions[0]->expert_tcost; ?>" />
                          <input type="hidden" name="sesdate" id="sesdate" value="<?php echo $sessions[0]->exp_se_date; ?>" />
                          <input type="hidden" name="sestime" id="sestime" value="<?php echo $sessions[0]->exp_se_time; ?>" />
                    <div class="col-md-6"><h2 class="QA_Span"></h2></div>
                     <div class="col-md-6"><h2><span class="GFG_Span"></span></h2></div>
                    </div>  
                    <hr>
                    
                    <div class="session_booking row">
                  <div class="col-sm-6">
                     <h3 class="basic_m_tital">Book Your Session <span class="error">(All Timings are in IST)</span></h3>
                     <div class="calendar" id="calendar-app">
                        <div class="session_avt_time">
                           <div id="footer-date">
                              <ul class="session">
							  <?php $k = 1; foreach($sessions as $se){ ?>
							      <li class="<?php if($k == '1'){?> active <?php } ?> yourButtonClass1" id="<?php  echo $se->exp_se_id; ?>" session_id="<?php  echo $se->exp_se_id; ?>" session_date="<?php  echo $se->exp_se_date; ?>" session_time="<?php  echo $se->exp_se_time; ?>" ><?php echo $se->exp_se_date; ?> <?php echo $se->exp_se_time; ?></li>
							  <?php $k++;} ?>
                              </ul>
                           </div>
                        </div>
                        <p style="color:red; display:inline-block;">If the above timings don't work for you, please select the below option.</p>
                        <label class="switch-request-session">
                           <input id="30_min_request_session" name="request-session-ckeckbox" type="checkbox" value="1">
                           <span class="request-session-slider round"></span>
                        </label><strong style="margin-left: 10px;">Request Session Time</strong>
                        <br><br>
                        <p style="color:black;">Once you select Request Session Time, The Counselor will get back to you and fix a timing convenient for you.</p>
                     </div>
                     <br>
                  </div>
                  <div class="col-sm-6 moblie_p_info" id="30_min_session">
                   <div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
       <?php if($this->session->userdata('email') && ($this->session->userdata('login_type')=="student")){ ?> 

       <? } else { ?>                       
      <h3 class="basic_m_tital">Please share what specific help are you looking for?</h3>
      <div class="form-group">
         <label for="email">Email Address*</label>
         <input type="email" class="form-control email" name="email" required="required">
         
      </div>
      <div class="form-group">
         <label for="name">Name*</label>
         <input type="text" class="form-control name" name="sname" required="required">
        
      </div>
      <div class="form-group">
         <label for="phone">Phone Number*</label>
         <input type="text" class="form-control phone" name="phone" maxlength="10" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" required="required">
        
      </div>
      <div class="form-group">
         <label for="comment">Description*</label>
         <textarea class="form-control comment" rows="2"  name="comment" required="required"></textarea>
         
      </div>
      <div class="form-group">
         <label for="address">Address*</label>
         <textarea name="address" class="form-control address" rows="2" required="required"></textarea>
       
      </div>
    <?php } ?>
      <div class="form-group">
         <button type="submit" class="btn btn-danger round_btns book_now_sessions">Book now</button>
         <center><img src="<? echo base_url(); ?>assets/images/load.gif" width="42" height="42" alt="" style="display:none" id="loader"></center>
      </div>
                  </div>
               </div>          
                    </div>    
                    </div>
                </div>
            </form>           
        </div>
</section>
<script>
$(".yourButtonClass").on('click', function(event){
   $('#'+$(this).attr("id")).addClass("btn-primary");
   $('a').not('#'+$(this).attr("id")).removeClass("btn-primary");
  var sesdur = $(this).attr("session_duration");
     var sesdurval = sesdur + " Minutes";
  $(".QA_Span").text(sesdurval + ' Career Q&A ');
	$('.GFG_Span').text('Rs. '+ $(this).attr("session_thirty"));

  $('#sesduration').val($(this).attr("session_duration"));
  $('#sescost').val($(this).attr("session_thirty"));
	return false;
});

$(".yourButtonClass1").on('click', function(event){
    $('#'+$(this).attr("session_id")).addClass("btn-success");
    $('#'+$(this).attr("session_id")).removeClass("btn-primary");
    $('ul li').not('#'+$(this).attr("session_id")).removeClass("btn-success");
    $('#sesdate').val($(this).attr("session_date"));
    $('#sestime').val($(this).attr("session_time"));
  
  return false;
});

$("#expsessionbutton").on('click', function(event){
    
  $('#expbooksession').show();
  
});
</script>

<script type="text/javascript">
    $(document).ready(function(){
  
    $("#expertsession").on('submit', function(e){
       e.preventDefault();
       var fdata = $("#expertsession").serialize();
       var url = '<?php echo base_url("front/experts/save_expertsession")?>';
        //alert(url);
       $.ajax({
        url:url,
        data:fdata,
        type:"post",
        dataType:"json",
        beforeSend: function(){
          $("#loader").show();
        },
        success: function(str){
            //alert(str);
          console.log(str);
          $("#loader").hide();
          if(str.Status == 'Active'){
            $("#smsg").show();
            $("#smsg").html(str.Message);
            setTimeout(function(){ location.reload(); }, 1000);  
          }else{
            $("#emsg").show();
            $("#emsg").html(str.Message);
          }
        }
        });
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