<? $this->load->view("front/includes/header");?>
<style type="text/css">
  ul.session li{
    background-color: #fff;
    text-align: center;
  }
  ul.session li.active{
    background-color: #3f9fff;
  }
  ul.session li a{
    color: #3f9fff;
  }
  ul.session li.active a{
    color: #fff;
  }
  ul.sessionbookings li{
    width: 50%;
    background-color: #ddd;
    text-align: center;
    padding: 10px;
    font-size: 18px;
  }
  ul.sessionbookings li.active{
    background-color: #3f9fff;
  }
  ul.sessionbookings li a{
    color: #000;
  }
  ul.sessionbookings li.active a{
    color: #fff;
  }
  .social-links {
    display: flex;
    margin-top: 20px;
  }
  .social-links span {
    margin-left: 10px;
    width: 30px;
  }
  .social-links h6 {
    padding-top: 8px;
  }
</style>

<div id="inbanner">
<img src="<?php echo base_url();?>assets/images/front/counselor.jpg"   alt="" class="img-fluid">
</div>

<section id="ex">
  <div class="container emp-profile">
           
      <? echo $this->session->flashdata("payment_status"); ?>     
           
            <form id="expertsession">
              <input type="hidden" name="login_std_mail" value="<?php if($this->session->userdata('email')) { echo $this->session->userdata('email'); } ?>">
              <input type="hidden" name="expid" value="<?php echo $sessions[0]->expert_id; ?>" >
			  <input type="hidden" name="exp_name" value="<?php echo $sessions[0]->expert_name; ?>" >
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
                                    <p class="proile-rating"><?php echo $sessions[0]->expert_curorg; ?></p>
                                    
                                    <p>Language Spoken: <?php echo $sessions[0]->expert_spokenlang; ?></p>
                                    <a class="btn btn-danger round_btns" id="expsessionbutton" name="btnAddMore" style="color:#fff;">BOOK A SESSION</a>

                                             <? if($this->session->userdata("student_id")){ ?>

      <a  class="btn btn-info round_btns" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">
        Ask a Question
      </a>

    <? }else{ ?>

      <a class="btn btn-info round_btns" href="javascript:void(0)" data-toggle="modal" data-target="#myModalLoginNow">
        Ask a Question
      </a>

    <? } ?>
                                    
                            <div class="social-links">
                              <?php if(isset($sessions[0]->expert_facebook) || isset($sessions[0]->expert_twitter) || isset($sessions[0]->expert_instagram)){ ?>
                              <h6>Follow Me On : </h6>
                              <?php if(isset($sessions[0]->expert_facebook)){ ?>
                              <span><a href="<?php echo $sessions[0]->expert_facebook; ?>" target="_blank"><img src="<?php echo base_url();?>assets/images/front/facebook.jpg"></a></span>
                              <?php }if(isset($sessions[0]->expert_twitter)){ ?>
                              <span><a href="<?php echo $sessions[0]->expert_twitter; ?>" target="_blank"><img src="<?php echo base_url();?>assets/images/front/twitter.jpg"></a></span>
                              <?php }if(isset($sessions[0]->expert_instagram)){ ?>
                              <span><a href="<?php echo $sessions[0]->expert_instagram; ?>" target="_blank"><img src="<?php echo base_url();?>assets/images/front/instagram.jpg"></a></span>
                              <?php }}?>
                            </div> 
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
                    <?php if(isset($sessions[0]->expert_awards) && $sessions[0]->expert_awards!=''){ ?>
                    <h3>Awards/Recognitions</h3>
                    <p><?php echo $sessions[0]->expert_awards; ?></p>
       
                    <br/>
                    <?php }if(isset($sessions[0]->expert_targetgroup) && $sessions[0]->expert_targetgroup!=''){ ?>
                    <h3>Target group</h3>
                    <p><?php echo $sessions[0]->expert_targetgroup; ?></p>
       
                    <br/>
                    <?php }if(isset($sessions[0]->expert_expparti) && $sessions[0]->expert_expparti!=''){ ?>
                    <h3>Expectations from Participants</h3>
                    <p><?php echo $sessions[0]->expert_expparti; ?></p>
       
                    <br/>
                    <?php }?>
                    <div id="expbooksession" style="display: none;">
                     <ul class="nav nav-tabs sessionbookings">
            <li class="active"><a data-toggle="tab" href="#home" class="yourButtonClass" id="s30" session_duration="30" session_thirty="<?php  echo $sessions[0]->expert_tcost; ?>" session_id="<?php  echo $sessions[0]->exp_se_id; ?>">30 Minute Session</a></li>
            <li><a data-toggle="tab" href="#menu1" class="yourButtonClass" id="s60" session_duration="60" session_thirty="<?php  echo $sessions[0]->expert_scost; ?>" session_id="<?php  echo $sessions[0]->exp_se_id; ?>">60 Minute Session</a></li>
            </ul>
                     
                         <div class="row tm">
                          <input type="hidden" name="expert_session_id" id="sesid" value="<?php echo $sessions[0]->exp_se_id; ?>" />
                          <input type="hidden" name="sesduration" id="sesduration" value="30" />
                          <input type="hidden" name="sescost" id="sescost" value="<?php echo $sessions[0]->expert_tcost; ?>" />
                          <input type="hidden" name="sesdate" id="sesdate" value="<?php echo $sessions[0]->exp_se_date; ?>" />
                          <input type="hidden" name="sestime" id="sestime" value="<?php echo $sessions[0]->exp_se_time; ?>" />
                    <div class="col-md-6"><h2 class="QA_Span">30 Minutes Career Q&A</h2></div>
                     <div class="col-md-6"><h2 style="float: right;"><span class="GFG_Span">Rs. <?php echo $sessions[0]->expert_tcost; ?></span></h2></div>
                    </div>  
                    <hr>
                    
                    <div class="session_booking row">
                  <div class="col-sm-12">
                     <h3 class="basic_m_tital">Book Your Session <span class="error">(All Timings are in IST)</span></h3>
                     <div class="calendar" id="calendar-app">
                        <div class="session_avt_time">
                           <div id="footer-date">
                             
                             <p style="font-weight: 500;font-size: 16px;margin-bottom: 5px;">Paid Sessions</p>
                              <ul class="session">
                              
							  <?php $k = 1;$d3 = 0;$d6 = 0; foreach($psessions as $se){ 
                $checkexists = $this->db->select("*")->where("expert_id", $sessions[0]->expert_id)->where("exp_std_date", $se->exp_se_date)->where("exp_std_time", $se->exp_se_time)->where("exp_std_duration", $se->duration)->get("tbl_expert_student_schedule");
	
                if($checkexists->num_rows()==0){
                ?>
							   <?php $d="0"; if($se->exp_se_date >= date("Y-m-d")){ if($se->duration==30){$d3++;}if($se->duration==60){$d6++;}$d="1"; ?>
							      <li data-id="<?php echo $se->duration.'_sessiontobehide';?>" class="<?php //if($k == '1'){ echo 'active'; } ?>" ><a href="#" class="yourButtonClass1" id="<?php  echo $se->exp_se_id; ?>" session_id="<?php  echo $se->exp_se_id; ?>" session_date="<?php  echo $se->exp_se_date; ?>" session_time="<?php  echo $se->exp_se_time; ?>"><?php echo $se->exp_se_date; ?> <?php echo date('H:i A', $se->exp_se_time); ?></a></li>
							      
							      
							      
								  <?php } 
                  //$k++;
                  } ?>
							  <?php } ?>
                                <?php if($d3==0){?><li data-id="<?php echo '30_sessiontobehide';?>" style="color: red;">No Sessions Found.</li><?php }?>
                                <?php if($d6==0){?><li data-id="<?php echo '60_sessiontobehide';?>" style="color: red;">No Sessions Found.</li><?php }?>
                         </ul>       
<!--               free sessions                -->
                        <br>
						<br>
						<br>
        
                        <ul class="session">                
                             <p style="font-weight: 500;font-size: 16px;margin-bottom: 5px;">Free Sessions</p>
    
                                <?php $k1 = 1;$d31 = 0;$d61 = 0; foreach($fsessions as $fse){ 
                  $checkexistsf = $this->db->select("*")->where("expert_id", $sessions[0]->expert_id)->where("exp_std_date", $fse->exp_se_date)->where("exp_std_time", $fse->exp_se_time)->where("exp_std_duration", $fse->duration)->get("tbl_expert_student_schedule");
                  
                if($checkexistsf->num_rows()==0){
                ?>
							   <?php $df="0"; if($fse->exp_se_date >= date("Y-m-d")){ if($fse->duration==30){$d31++;}if($fse->duration==60){$d61++;}$df="1"; ?>
							      <li data-id="<?php echo $fse->duration.'_sessiontobehide';?>" class="<?php //if($k == '1'){ echo 'active'; } ?>" ><a href="#" class="yourButtonClass1" id="<?php  echo $fse->exp_se_id; ?>" session_id="<?php  echo $fse->exp_se_id; ?>" session_date="<?php  echo $fse->exp_se_date; ?>" session_time="<?php  echo $fse->exp_se_time; ?>"><?php echo $fse->exp_se_date; ?> <?php echo date('H:i A', $fse->exp_se_time); ?></a></li>
							      
							      
							      
								  <?php } 
                  //$k++;
                  } ?>
							  <?php } ?>
                                <?php if($d31==0){?><li data-id="<?php echo '30_sessiontobehide';?>" style="color: red;">No Sessions Found.</li><?php }?>
                                <?php if($d61==0){?><li data-id="<?php echo '60_sessiontobehide';?>" style="color: red;">No Sessions Found.</li><?php }?>
                                
                                
                                
                              </ul>
                             
                           </div>
                        </div>
                        <!-- <p style="color:red; display:inline-block;">If the above timings don't work for you, please select the below option.</p>
                        <label class="switch-request-session">
                           <input id="30_min_request_session" name="request-session-ckeckbox" type="checkbox" value="1">
                           <span class="request-session-slider round"></span>
                        </label><strong style="margin-left: 10px;">Request Session Time</strong>
                        <br><br>
                        <p style="color:black;">Once you select Request Session Time, The Counselor will get back to you and fix a timing convenient for you.</p> -->
                     </div>
                     <br>
                  </div>
                  <div class="col-sm-6 moblie_p_info" id="30_min_session">
                   <div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
       <?php if($this->session->userdata('email') && ($this->session->userdata('login_type')=="student")){ ?> 

       <? } else { ?>                       
      <!-- <h3 class="basic_m_tital">Please share what specific help are you looking for?</h3>
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
       
      </div> -->
    <?php } ?>
      <div class="form-group">
         <? if($this->session->userdata("student_id")){ ?>
          <button type="submit" class="btn btn-danger round_btns book_now_sessions" style="display:none">Book now</button>

        <? }else{ ?>

          <a class="btn btn-danger round_btns book_now_sessions" href="javascript:void(0)" data-toggle="modal" data-target="#myModalLoginNow" style="display:none">
            Book Now
          </a>

        <? } ?>
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
   //$('#'+$(this).attr("id")).addClass("btn-primary");
   //$('a').not('#'+$(this).attr("id")).removeClass("btn-primary");
   $('li').removeClass();
   $(this).parent().addClass('active');
  var sesdur = $(this).attr("session_duration");
  var sesdur = $(this).attr("session_duration");
     var sesdurval = sesdur + " Minutes";
  $(".QA_Span").text(sesdurval + ' Career Q&A ');
	$('.GFG_Span').text('Rs. '+ $(this).attr("session_thirty"));

  $('#sesduration').val($(this).attr("session_duration"));
  $('#sescost').val($(this).attr("session_thirty"));
  $('#sesid').val($(this).attr("session_id"));
  $('ul.session li[data-id=' + $(this).attr("session_duration")+'_sessiontobehide]').show();
  $('ul.session li[data-id!=' + $(this).attr("session_duration")+'_sessiontobehide]').hide();
	return false;
});

$(".yourButtonClass1").on('click', function(event){
    //$('#'+$(this).attr("session_id")).addClass("btn-success");
    //$('#'+$(this).attr("session_id")).removeClass("btn-primary");
    $('ul.session li').not('#'+$(this).attr("session_id")).removeClass('active');
    $(this).parent().addClass('active');
    $('ul li').not('#'+$(this).attr("session_id")).removeClass("btn-success");
    $('#sesdate').val($(this).attr("session_date"));
    $('#sestime').val($(this).attr("session_time"));
	$('#sesid').val($(this).attr("session_id"));
    $('.book_now_sessions').show();
    var target = $('.book_now_sessions');
    if (target.length) {
        $('html,body').animate({
            scrollTop: target.offset().top - 100
        }, 1000);
        return false;
    }
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
			  if(str.Message == "Payment"){

				  window.location.href = "<?php echo base_url("front/payment/pay")?>";

			  }else{

				  setTimeout(function(){ location.reload(); }, 1000);  

			  }
          }else{
            $("#emsg").show();
            $("#emsg").html(str.Message);
          }
        }
        });
    });

      $('ul.session li[data-id=30_sessiontobehide]').show();
      $('ul.session li[data-id!=30_sessiontobehide]').hide();
    });
</script>

<? $this->load->view("front/includes/footer");?>

<!-- Modal -->
<style type="text/css">
  .mm-page {
    position: inherit;
}
</style>
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="display: block">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ask a Question</h4>
        <div class="smsg"></div>
      </div>
      
      <form method="post" id="queSubmit">
      
      <div class="modal-body">

      <div class="form-group">

        <textarea role="4" class="form-control" name="query" rows="6" placeholder="Ask A Question" style="height: 100px"></textarea>

      </div>

      </div>
      <div class="modal-footer">
        <input type="hidden" name="institute_id" value="<? echo $sessions[0]->expert_id; ?>">
		<input type="hidden" name="query_date" value="<? echo date('Y-m-d'); ?>">
        <input type="hidden" name="type" value="expert">
        <input type="hidden" name="student_id" value="<? echo $this->session->userdata("student_id") ?>">
      <button type="submit" class="btn btn-primary">Submit</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      
    </form>   
    </div>

  </div>
</div>

<?php $this->load->view("student/login/login_popup")?>

<script type="text/javascript">
  $("#queSubmit").submit(function(e){
  
    e.preventDefault();
    var fdata = $("#queSubmit").serialize();
    
    $.ajax({

      type : "post",
      data : fdata,
      url : "<? echo base_url('front/institutes/insertQuestion') ?>",
      success : function(data){
        
        if(data == "success"){
          $(".smsg").html('<div class="alert alert-success">We have received your Question successfully, We will contact you soon.</div>');
          setTimeout(function(){location.reload()},3000)
        }else{
          $(".smsg").html('<div class="alert alert-danger">Error Occured please try again.</div>');
        }
      },
      error : function(data){
        
        console.log(data);
        
      }

    })
  
  }); 
</script>