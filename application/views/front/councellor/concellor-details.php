<? $this->load->view("front/includes/header");?>

<div id="inbanner">
<img src="<?php echo base_url();?>assets/images/front/counselor.jpg"   alt="" class="img-fluid">
</div>

<section id="ex">
  <div class="container emp-profile">
            <form id="updateexpert">
              <input type="hidden" name="login_std_mail" value="<?php if($this->session->userdata('email')) { echo $this->session->userdata('email'); } ?>">
                <div class="row">
                    <div class="col-md-3">
                        <div class="profile-img">
                          <img src="<?php if($expert_details[0]->expert_photo == ""){ echo base_url().'assets/images/front/team4.png'; } else { echo base_url($expert_details[0]->expert_photo); } ?>" class="img-thumbnail img-fluid" alt=""/>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="profile-head">
                                    <h5 style="padding: 0px;">
                                        <?php echo $expert_details[0]->expert_name; ?>
                                    </h5>
                                    <h6>
                                        <?php echo $expert_details[0]->expert_qualification; ?>
                                    </h6>
                                    <p class="proile-rating"> <?php echo $expert_details[0]->expert_curorg; ?></p>
                                    <p>Languages: <?php echo $expert_details[0]->expert_spokenlang; ?></p>
									<? if($this->session->userdata("student_id")){ ?>
                        
										<a class="btn btn-danger round_btns" id="expsessionbutton" name="btnAddMore" style="color:#fff;">BOOK A SESSION</a>    
									
									<? }else{ ?>                        
									
										<a class="btn btn-danger round_btns" style="color:#fff;" href="javascript:void(0)" data-toggle="modal" data-target="#myModalLoginNow">BOOK A SESSION</a>    
									
									<? } ?>
                                    

                                    <!-- <? if($this->session->userdata("student_id")){ ?>

      <a  class="btn btn-info round_btns" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">
        Ask a Question
      </a>

    <? }else{ ?>

      <a class="btn btn-info round_btns" href="javascript:void(0)" data-toggle="modal" data-target="#myModalLoginNow">
        Ask a Question
      </a>

    <? } ?> -->

                        </div>
                    </div>
          <input type="hidden" name="councellor_id" value="<?php echo $expert_details[0]->id; ?>">
          <input type="hidden" name="exp_name" value="<?php echo $expert_details[0]->expert_name; ?>">
                    <div class="col-md-2">
                       
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <div class="profile-work">
                            <h3>Specialities</h3>
                            <?php echo $expert_details[0]->expert_expertise; ?>
                        </div>
                    </div>
                    <div class="col-md-9 cd">
                      <h3>Biography</h3>
                      <p><?php echo $expert_details[0]->expert_longdesc; ?></p>
                      <br/>
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
                                  <a class="nav-link <?php if($i==1){ echo 'session_1'; }?> sessionBook" data-toggle="pill" href="#s<?php echo $session->duration;?>"><?php echo $session->duration;?> Minute Session</a><p><?php echo $session->description;?></p>
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
                        <input type="hidden" name="coun_session_id" id="sesid"/>
                        <input type="hidden" name="session_type" id="sesduration"/>
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
                                $session_details = $this->db->query("SELECT * FROM tbl_counsellor_sessions WHERE duration=".$session->duration." AND expert_id=".$expert_details[0]->id." AND exp_se_time >= ".strtotime($datetime))->result();
                                if(count($session_details)>0){
                                  echo '<h3 class="basic_m_tital">Book Your Session <span class="error">(All Timings are in IST)</span></h3>';
                                  $i = 0;
                                  foreach ($session_details as $session_detail) {
                                    $checkexists = $this->db->select("*")->where("expert_id", $expert_details[0]->id)->where("exp_std_date", $session_detail->exp_se_date)->where("exp_std_time", $session_detail->exp_se_time)->where("exp_std_duration", $session_detail->duration)->get("tbl_counsellor_student_schedule");//->where("student_id", $student_id)
                                    if($checkexists->num_rows()==0){
                                    	$i++;
                                      echo '<div class="row"><div class="form-group" style="padding-left:16px;"><input name="inputRadio" type="radio" class="inputRadio timing_'.$session_detail->exp_se_id.'" onclick="getDetails('.$session_detail->exp_se_id.')" data-id="'.$session_detail->exp_se_id.'" data-date="'.$session_detail->exp_se_date.'" data-time="'.$session_detail->exp_se_time.'" data-duration="'.$session_detail->duration.'"> '.$session_detail->title.' - '.$session_detail->exp_se_date.' '.date('H:i A', $session_detail->exp_se_time).'<p>Description : '.$session_detail->description.'</p></div></div>';
                                    }
                                  }
                                  if($i==0){
                                 		echo '<div class="col-md-12 offset-md-3"><div class="alert alert-danger" style="text-align:center;">There is no sessions found</div></div>';
                                  }
                                }
                                ?>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="col-md-6 moblie_p_info" id="30_min_session" style="display: none;">
                            <?php if($this->session->userdata('email') && ($this->session->userdata('login_type')=="student")){ ?>
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
                                 <textarea type="comment" name="student_desc" class="form-control comment" rows="2"></textarea>
                              </div>
                              <div class="form-group">
                                 <label for="address">Address*</label>
                                 <textarea type="address" name="student_address" class="form-control address" rows="2" required></textarea>
                               
                              </div>
                              <?php } ?>
                              <div class="form-group">
                                 <button class="btn btn-danger round_btns book_now_sessions" style="display: none;">Book now</button>
                                 <? if($this->session->userdata("student_id")){ ?>

                                  <a  class="btn btn-info round_btns" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">
                                    Ask a Question
                                  </a>

                                <? }else{ ?>

                                  <a class="btn btn-info round_btns" href="javascript:void(0)" data-toggle="modal" data-target="#myModalLoginNow">
                                    Ask a Question
                                  </a>

                                <? } ?>
                              </div>
                        </div>
                      </div> 
                      <div class="col-md-12">
                        <div class="alert alert-success" style="display:none" id="smsg"></div>
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
    $("#sesduration").val('');
    $("#sesid").val('');
    $(".name").val('');
    $(".email").val('');
    $(".phone").val('');
    $(".comment").val('');
    $(".address").val('');
  });
});
function getDetails(exp_se_id){
  $("#sesid").val(exp_se_id);
  $("#session_id").val(exp_se_id);
  var date = $(".timing_"+exp_se_id).attr("data-date");
  var time = $(".timing_"+exp_se_id).attr("data-time");
  var duration = $(".timing_"+exp_se_id).attr("data-duration");
 if(date!='' && typeof date!='undefined') { $("#sesdate").val(date); }
 if(time!='' && typeof time!='undefined') { $("#sestime").val(time); }
 if(duration!='' && typeof duration!='undefined') { $("#sesduration").val(duration); } 
 $(".moblie_p_info").show();
 $(".book_now_sessions").show();
}
</script>

<script>
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
        toastr.options.timeOut = "false";
        toastr.options.closeButton = true;
        toastr.options.positionClass = 'toast-bottom-right';
        var amount = $("#sescost").val();
         e.preventDefault();
         var fdata = $("#updateexpert").serialize();
         fdata = fdata+"&student_id=" + <? echo $this->session->userdata("student_id"); ?>;
         var url = '<?php echo base_url("front/institutes/save_student_booking")?>';
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
              setTimeout(function(){ location.reload(); }, 1500);
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
        <input type="hidden" name="institute_id" value="<? echo $expert_details[0]->id; ?>">
        <input type="hidden" name="type" value="counsellor">
        <input type="hidden" name="student_id" value="<? echo $this->session->userdata("student_id") ?>">
		    <input type="hidden" name="query_date" value="<? echo date("Y-m-d"); ?>">
        <input type="hidden" name="session_id" id="session_id">
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