<? $this->load->view("front/includes/header");?>
<style type="text/css">
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
  <a  class="btn btn-success btn-sm float-right px-md-5 " href="<?php echo base_url();?>professor" >
  <i class="fas fa-arrow-left"></i>   Back </a>
           <? echo $this->session->flashdata("payment_status"); ?>
           
            <form id="updateexpert">
              <input type="hidden" name="login_std_mail" value="<?php if($this->session->userdata('email')) { echo $this->session->userdata('email'); } ?>">
                <div class="row">
                    <div class="col-md-3">
                        <div class="profile-img">
						    <?php if($professor_details[0]->pro_image != ""){ ?>
								<img src="<?php echo base_url();?>assets/images/professors/<?php echo $professor_details[0]->pro_image; ?>" class="img-thumbnail img-fluid" width="375px" height="450px" alt=""/>
							<?php }else{ ?>
								<img src="<?php echo base_url();?>assets/images/front/team-4-big.jpg" class="img-thumbnail img-fluid" alt=""/>
							<?php } ?>
                            
                            
                            
                        </div>
                    </div>
                    <div class="col-md-7">
                    
                        <div class="profile-head">
                       
                                    <h5 style="padding: 0px;">
                                        <?php echo $professor_details[0]->pro_name; ?>
                                    </h5>
                                    <h6>
                                        <?php echo $professor_details[0]->pro_quali; ?>
                                    </h6>
                                    <p class="proile-rating"> <?php echo $professor_details[0]->current_organization; ?></p>
                                    <p>Language Spoken: <?php echo $professor_details[0]->pro_languages; ?></p>
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
                            <?php if(isset($professor_details[0]->professor_facebook) || isset($professor_details[0]->professor_twitter) || isset($professor_details[0]->professor_instagram)){ ?>
                            <h6>Follow Me On : </h6>
                            <?php if(isset($professor_details[0]->professor_facebook)){ ?>
                            <span><a href="<?php echo $professor_details[0]->professor_facebook; ?>" target="_blank"><img src="<?php echo base_url();?>assets/images/front/facebook.jpg"></a></span>
                            <?php }if(isset($professor_details[0]->professor_twitter)){ ?>
                            <span><a href="<?php echo $professor_details[0]->professor_twitter; ?>" target="_blank"><img src="<?php echo base_url();?>assets/images/front/twitter.jpg"></a></span>
                            <?php }if(isset($professor_details[0]->professor_instagram)){ ?>
                            <span><a href="<?php echo $professor_details[0]->professor_instagram; ?>" target="_blank"><img src="<?php echo base_url();?>assets/images/front/instagram.jpg"></a></span>
                            <?php }}?>
                          </div>
                        </div>
                    </div>
					<input type="hidden" name="pro_id" value="<?php echo $professor_details[0]->pro_id; ?>">
					<input type="hidden" name="pro_name" value="<?php echo $professor_details[0]->pro_name; ?>">
                    <div class="col-md-2">
                       
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <div class="profile-work">
                            <h3>Specialities</h3>
                            <?php echo $professor_details[0]->specialization; ?>
                        </div>
                    </div>
                    <div class="col-md-9 cd">
                      <h3>Biography</h3>
                      <p><?php echo $professor_details[0]->pro_shortdesc; ?></p>
                      <br/>
                      <?php if(isset($professor_details[0]->awards) && $professor_details[0]->awards!=''){ ?>
                      <h3>Awards/Recognitions</h3>
                      <p><?php echo $professor_details[0]->awards; ?></p>
         
                      <br/>
                      <?php }if(isset($professor_details[0]->group_attend_seminar) && $professor_details[0]->group_attend_seminar!=''){ ?>
                      <h3>Target group</h3>
                      <p><?php echo $professor_details[0]->group_attend_seminar; ?></p>
         
                      <br/>
                      <?php }if(isset($professor_details[0]->expectations_from_participants) && $professor_details[0]->expectations_from_participants!=''){ ?>
                      <h3>Expectations from Participants</h3>
                      <p><?php echo $professor_details[0]->expectations_from_participants; ?></p>
         
                      <br/>
                      <?php }?>
                      <div class="row" id="expbooksession" style="display: none;">
                        <?
                          $i = 1;
                          if(count($sessions)>0){
                        ?>
                          <ul class="nav nav-pills">
                            <?php
                            
                              foreach ($sessions as $session) {
                              ?>
                                <li class="nav-item">
                                  <a class="nav-link <?php if($i==1){ echo 'session_1'; }?> sessionBook" data-toggle="pill" href="#s<?php echo $session->duration;?>"><?php echo $session->duration;?> Minute Session</a>
                                </li>
                              <?php
                                $i++;
                              }
                           
                            ?>
                          </ul>  
                          <?
                             }
                            else{
                              echo '<div class="col-md-6 offset-md-3"><div class="alert alert-danger" style="text-align:center;">There is no sessions found</div></div>';
                            }
                          ?>    
                      </div>
                      <div class="row tm">
                        <input type="hidden" name="pro_session_id" id="sesid"/>
                        <input type="hidden" name="session_type" id="sesduration"/>
                        <input type="hidden" name="session_cost" id="sescost"/>
                        <input type="hidden" name="session_date" id="sesdate"/>
                        <input type="hidden" name="session_time" id="sestime"/>
                      </div>
                      <div class="row sessionBookRow">
                        <div class="col-md-6 tab-content session_booking">
                            <?php
                            $datetime = date("Y-m-d H:i:s"); 
                            foreach ($sessions as $session) {
                            ?>
                              <div class="tab-pane container" id="s<?php echo $session->duration;?>">
                                <?php
                                $session_details = $this->db->query("SELECT * FROM tbl_professor_sessions WHERE duration=".$session->duration." AND professor_id=".$professor_details[0]->pro_id." AND pro_se_time >= ".strtotime($datetime))->result();
                                if(count($session_details)>0){
                                  echo '<h3 class="basic_m_tital">Book Your Session <span class="error">(All Timings are in IST)</span></h3>';
                                  foreach ($session_details as $session_detail) {
                                    echo '<div class="row"><div class="form-group" style="padding-left:16px;"><input name="inputRadio" type="radio" class="inputRadio timing_'.$session_detail->pro_se_id.'" onclick="getDetails('.$session_detail->pro_se_id.')" data-id="'.$session_detail->pro_se_id.'" data-cost="'.$session_detail->amount.'" data-date="'.$session_detail->pro_se_date.'" data-time="'.$session_detail->pro_se_time.'" data-duration="'.$session_detail->duration.'"> '.$session_detail->title.' - '.$session_detail->pro_se_date.' '.date('H:i A', $session_detail->pro_se_time).' - Rs.'.$session_detail->amount.'</div></div>';
                                  }
                                }
                                ?>
                            </div>
                            <?php
                                }
                            ?>
                            <!-- <p style="color:red; display:inline-block;">If the above timings don't work for you, please select the below option.</p>
                            <label class="switch-request-session">
                               <input id="30_min_request_session" name="request_session" class="check" value="1" type="checkbox">
                               <input id="30_min_request_session" name="request_session" class="inputid" value="0" type="hidden">
                               <span class="request-session-slider round"></span>
                            </label><strong style="margin-left: 10px;">Request Session Time</strong>
                            <br><br>
                            <p style="color:black;">Once you select Request Session Time, The Counselor will get back to you and fix a timing convenient for you.</p> -->
                        </div>
                        <div class="col-md-6 moblie_p_info" id="30_min_session" style="display: none;">
                            <?php 
                            if($this->session->userdata('email') && ($this->session->userdata('login_type')=="student")){ ?>
                            <? } else { ?> 
                              <h3 class="basic_m_tital">Please share what specific help are you looking for?</h3>
                              <div class="form-group">
                                 <label for="email">Email Address*</label>
                                 <input type="email" name="student_email" class="form-control email" required>
                                 
                              </div>
                              <div class="form-group">
                                 <label for="name">Name*</label>
                                 <input type="name" name="student_name" class="form-control name" required>
                                
                              </div>
                              <div class="form-group">
                                 <label for="phone">Phone Number*</label>
                                 <input type="phone" name="student_phone" class="form-control phone" required minlength="10" maxlength="10">
                                
                              </div>
                              <div class="form-group">
                                 <label for="comment">Description</label>
                                 <textarea name="student_desc" class="form-control comment" rows="4" required style="height: 64px;"></textarea>
                              </div>
                              <div class="form-group">
                                 <label for="address">Address*</label>
                                 <textarea  name="student_address" class="form-control address" rows="4" required required style="height: 64px;"></textarea>
                               
                              </div>
                              <?php } ?>
                              
                              <div class="form-group">
                              <?php $type = $this->session->userdata('email'); 
                              if($type){ 
                                  ?>
                              <button class="btn btn-danger round_btns book_now_sessions" style="display: none;">Book now</button>
                          <?php }else{ ?>
                            <a class="btn btn-info round_btns" href="javascript:void(0)" data-toggle="modal" data-target="#myModalLoginNow">Login</a>  
                              <button class="btn btn-danger round_btns book_now_sessions" style="display: none;">Book now</button>
                          <?php } ?>
                              
                              </div>
                        </div>
                      </div> 
                      <div class="col-md-12">
                        <div class="alert alert-success" style="display:none;color: dodgerblue;font-family: aerial" id="smsg"></div>
                        <div class="alert alert-danger" style="display:none" id="emsg"></div>
                      </div>
                  </div>
                </div>
            </form>           
        </div>
</section>
<script>
$(document).ready(function(){
  $(".sessionBookRow").removeAttr("style");
  $(".sessionBook").on("click", function(){
    $(".moblie_p_info").hide();
    $(".book_now_sessions").hide();
    $(".inputRadio").prop("checked", false);
    $(".sessionBookRow").attr("style", "border: 1px solid #ddd;padding: 10px;");
    $("#sesdate").val('');
    $("#sestime").val('');
    $("#sescost").val('');
    $("#sesduration").val('');
    $("#sesid").val('');
    $(".name").val('');
    $(".email").val('');
    $(".phone").val('');
    $(".comment").val('');
    $(".address").val('');
  });
});
function getDetails(pro_se_id){
  $("#sesid").val(pro_se_id);
  var date = $(".timing_"+pro_se_id).attr("data-date");
  var time = $(".timing_"+pro_se_id).attr("data-time");
  var amount = $(".timing_"+pro_se_id).attr("data-cost");
  var duration = $(".timing_"+pro_se_id).attr("data-duration");
 if(date!='' && typeof date!='undefined') { $("#sesdate").val(date); }
 if(time!='' && typeof time!='undefined') { $("#sestime").val(time); }
 if(amount!='' && typeof amount!='undefined') { $("#sescost").val(amount); }
 if(duration!='' && typeof duration!='undefined') { $("#sesduration").val(duration); } 
 $(".moblie_p_info").show();
 $(".book_now_sessions").show();
}
// $(".check").change(function() {
//   if($(".check").prop('checked') == true){
//     $('.book_now_sessions').show();
//     $(".yourButtonClass1").attr('style', 'pointer-events:none;background-color:#ddd;color:#000;');
//   }
//   else{
//     $('ul.session li').removeClass("btn-success");
//     $('ul.session li').addClass("btn-primary");
//     $('.book_now_sessions').hide();
//     $(".yourButtonClass1").removeAttr('style', 'pointer-events:none;background-color:#ddd;color:#000;');
//   }
//     //('.inputid').remove();
// 	$('.inputid').attr('disabled','disabled');
// 	return false;
// });

</script>

<script>
// $(".yourButtonClass").on('click', function(event){
//   $('.session_booking').show();
//    $('#'+$(this).attr("id")).addClass("btn-primary");
//    $('a').not('#'+$(this).attr("id")).removeClass("btn-primary");
//   var sesdur = $(this).attr("session_duration");
//      var sesdurval = sesdur + " Minutes";
//   $(".QA_Span").text(sesdurval + ' Career Q&A ');
//   $('.GFG_Span').text('Rs. '+ $(this).attr("session_thirty"));

//   $('#sesduration').val($(this).attr("session_duration"));
//   $('#sescost').val($(this).attr("session_thirty"));
//   return false;
// });

// $(".yourButtonClass1").on('click', function(event){
//     $(".book_now_sessions").show();
//     $('.li_'+$(this).attr("session_id")).addClass("btn-success");
//     $('.li_'+$(this).attr("session_id")).removeClass("btn-primary");
//     //$('#'+$(this).attr("session_id")).addClass("btn-success");
//     //$('#'+$(this).attr("session_id")).removeClass("btn-primary");
//     $('ul.session li').not('#'+$(this).attr("session_id")).removeClass("btn-success");
//     $('ul.session li').not('#'+$(this).attr("session_id")).addClass("btn-primary");
//     $('#sesdate').val($(this).attr("session_date"));
//     $('#sestime').val($(this).attr("session_time"));
  
//   return false;
// });

$("#expsessionbutton").on('click', function(event){
    
  $('#expbooksession').show(); 
  //$('.session_booking').hide();
  $(".session_1").click();
  
});
</script>


<? $this->load->view("front/includes/footer");?>
<script type="text/javascript">
    $(document).ready(function(){
      toastr.options.timeOut = "false";
      toastr.options.closeButton = true;
      toastr.options.positionClass = 'toast-bottom-right';
    $("#updateexpert").on('submit', function(e){
      var amount = $("#sescost").val();
       e.preventDefault();
       var fdata = $("#updateexpert").serialize();
       var url = '<?php echo base_url("front/professor/save_in_session")?>';
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
            //$("#smsg").show();
            //$("#smsg").html(str.Message);
            toastr.remove();
            toastr['success'](str.Message, '', {
                positionClass: 'toast-bottom-right'
            });
		    if(amount!=0 && typeof amount!='undefined' && amount!=''){
             window.location.href = "<?php echo base_url("front/payment/pay")?>";
            }
            else{
              setTimeout(function(){ location.reload(); }, 1500);  
            }
          }else{
            //$("#emsg").show();
            //$("#emsg").html(str.Message);
            toastr.remove();
            toastr['error'](str.Message, '', {
                positionClass: 'toast-bottom-right'
            });
          }
        }
        });
    });

    });
</script>


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
        <input type="hidden" name="institute_id" value="<? echo $professor_details[0]->pro_id; ?>">
        <input type="hidden" name="type" value="professor">
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