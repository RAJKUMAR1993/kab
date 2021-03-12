<style type="text/css">
  .booknow {
    float: right;
    padding: 7px 25px !important;
  }
</style>
<form id="updateexpert">
    <div class="row">
      <input type="hidden" name="councellor_id" value="<?php echo $cid; ?>">
        <div class="col-md-12 cd" id="expbooksession" style="display: none;">
          <div class="row tm">
            <input type="hidden" name="coun_session_id" id="tsesid"/>
            <input type="hidden" name="session_type" id="tsesduration"/>
            <input type="hidden" name="session_date" id="tsesdate"/>
            <input type="hidden" name="session_time" id="tsestime"/>
          </div>
          <div class="row sessionBookRow">
            <div class="col-md-12 tab-content session_booking">
            <?php
            $sk = 0;
            if(count($sessions)>0){
              $selected_dates = array();
              foreach ($sessions as $session) {
                $datetime = date("Y-m-d H:i:s"); 
                $session_details = $this->db->query("SELECT * FROM tbl_counsellor_sessions WHERE exp_se_date='".$session->exp_se_date."' AND expert_id=".$cid." AND exp_se_time >= ".strtotime($datetime))->result();
                if(count($session_details)>0){
                  foreach ($session_details as $session_detail) {
                    $checkexists = $this->db->select("*")->where("expert_id", $cid)->where("exp_std_date", $session_detail->exp_se_date)->where("exp_std_time", $session_detail->exp_se_time)->where("exp_std_duration", $session_detail->duration)->get("tbl_counsellor_student_schedule");//->where("student_id", $student_id)
                    if($checkexists->num_rows()==0){
                      if(!in_array($session->exp_se_date, $selected_dates)){
                        $selected_dates[] = $session->exp_se_date;
                      }
                    }
                  }
                }
              }
              if(count($selected_dates)>0){
                foreach ($selected_dates as $exp_se_date) {
              ?>
              <div class="card" style="margin-bottom: 10px">
                <div class="card-header" role="tab" id="heading<? echo $sk ?>">
                  <h5 class="mb-0">
                    <a class="sessionBook" data-toggle="collapse" href="#collapse<? echo $sk ?>" aria-expanded="true" aria-controls="collapse<? echo $sk ?>"><?php echo date('l, F d Y', strtotime($exp_se_date));?></a>
                  </h5>
                </div>
                <div id="collapse<? echo $sk ?>" class="collapse <? echo ($sk == 0) ? 'show' : '' ?>" role="tabpanel" aria-labelledby="heading<? echo $sk ?>">
                  <div class="card-body">
                    <?php
                    $datetime = date("Y-m-d H:i:s"); 
                    $session_details = $this->db->query("SELECT * FROM tbl_counsellor_sessions WHERE exp_se_date='".$exp_se_date."' AND expert_id=".$cid." AND exp_se_time >= ".strtotime($datetime))->result();
                    if(count($session_details)>0){
                      $i = 0;
                      foreach ($session_details as $session_detail) {
                        $checkexists = $this->db->select("*")->where("expert_id", $cid)->where("exp_std_date", $session_detail->exp_se_date)->where("exp_std_time", $session_detail->exp_se_time)->where("exp_std_duration", $session_detail->duration)->get("tbl_counsellor_student_schedule");//->where("student_id", $student_id)
                        if($checkexists->num_rows()==0){
                          $i++;
                          echo '<div class="card" style="margin-bottom: 10px"><div class="card-header" role="tab"><input name="inputRadio" type="radio" class="inputRadio timing_'.$session_detail->exp_se_id.'" onclick="getDetails('.$session_detail->exp_se_id.')" data-id="'.$session_detail->exp_se_id.'" data-date="'.$session_detail->exp_se_date.'" data-time="'.$session_detail->exp_se_time.'" data-duration="'.$session_detail->duration.'"> '.date('H:i A', $session_detail->exp_se_time).' - '.date('H:i A', strtotime('+'.$session_detail->duration.' minutes', $session_detail->exp_se_time)).' <b>'.$session_detail->title.'</b><button class="btn btn-danger round_btns booknow book_now_sessions_'.$session_detail->exp_se_id.'" style="display: none;">Book now</button></div></div>';
                        }
                      }
                      if($i==0){
                        echo '<div class="col-md-12 offset-md-3"><div class="alert alert-danger" style="text-align:center;">There is no session found</div></div>';
                      }
                    }
                    ?>
                  </div>
                </div>
              </div> 
              <?
                  $sk++;
                }
              }
              else{
                echo '<div class="col-md-6 offset-md-3"><div class="alert alert-danger" style="text-align:center;">There is no session found</div></div>';
              }
            }
            else{
              echo '<div class="col-md-6 offset-md-3"><div class="alert alert-danger" style="text-align:center;">There is no session found</div></div>';
            }
            ?>
            </div>
            <!-- <div class="col-md-6 moblie_p_info" id="30_min_session" style="display: none;">
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
                  <div class="form-group" style="margin-top: 40px;">
                     <button class="btn btn-danger round_btns book_now_sessions" style="display: none;">Book now</button>
                  </div>
            </div> -->
          </div>
          <div class="col-md-12">
            <div class="alert alert-success" style="display:none" id="smsg"></div>
            <div class="alert alert-danger" style="display:none" id="emsg"></div>
          </div>
      	</div>
    </div>
</form> 
<script>
$(document).ready(function(){
  $(".sessionBookRow").removeAttr("style");
  $(".sessionBook").on("click", function(){
    $(".moblie_p_info").hide();
    //$(".book_now_sessions").hide();
    $(".booknow").hide();
    $(".inputRadio").prop("checked", false);
    //$(".sessionBookRow").attr("style", "border: 1px solid #ddd;padding: 10px;");
    $("#tsesdate").val('');
    $("#tsestime").val('');
    $("#tsesduration").val('');
    $("#tsesid").val('');
    $(".name").val('');
    $(".email").val('');
    $(".phone").val('');
    $(".comment").val('');
    $(".address").val('');
  });
});
function getDetails(exp_se_id){
	
  $(".booknow").hide();
  $("#tsesid").val(exp_se_id);
  $("#tsession_id").val(exp_se_id);
  var date = $(".timing_"+exp_se_id).attr("data-date");
  var time = $(".timing_"+exp_se_id).attr("data-time");
  var duration = $(".timing_"+exp_se_id).attr("data-duration");
	
  $("#tsesdate").val(date); 
  $("#tsestime").val(time);
  $("#tsesduration").val(duration);
 $(".moblie_p_info").show();
 $(".book_now_sessions_"+exp_se_id).show();
}
</script>

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
			   console.log(str);
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
          },
			 error : function(data){
				 console.log(data);
			 }
          });
      });

    });
</script>