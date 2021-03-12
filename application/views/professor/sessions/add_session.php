
<style>
    td.details-control {
    background: url('<?php echo base_url(); ?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
    }
    tr.shown td.details-control {
        background: url('<?php echo base_url(); ?>assets/images/details_close.png') no-repeat center center;
    }
</style>

<div id="main-content">
          
    <div class="col-md-12">
                    <?php echo $this->session->flashdata('msg');?>
                    <div class="card">
                        <div class="header">
                            <div class="col-lg-9 pull-left">
                                <h2>Session Details</h2>
                            </div>
                            <div class="col-lg-1 pull-right">
                                <a href="<?php echo base_url("professor/sessions");?>" class="btn btn-info">Back</a>
                            </div>
                        </div>
                        <div class="body">
						
                            <form id="updateexpert">
                            <div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
                            <!-- <form id="basic-form" method="post" action="<?php echo base_url("professor/settings/update")?>" enctype="multipart/form-data" novalidate> -->
							<input type="hidden" name="pro_se_id" value="<?php if(isset($sessions[0]->pro_se_id)){ echo $sessions[0]->pro_se_id;}?>">
                                 <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Date <span style="color: red;">*</span></label>
                                        <input type="date" class="form-control" name="date" id="txtDate" value="<?php if(isset($sessions[0]->pro_se_date)){ echo $sessions[0]->pro_se_date;}?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Title <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" name="title" value="<?php if(isset($sessions[0]->title)){ echo $sessions[0]->title;}?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control summernote" name="description"  rows="4" cols="30">
                                            <?php if(isset($sessions[0]->description)){echo $sessions[0]->description;}?>
                                        </textarea>
                                    </div>
                                  

                                </div>

                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Time <span style="color: red;">*</span></label>
                                        <input type="time" class="form-control" name="time" value="<?php if(isset($sessions[0]->pro_se_time)){ echo date('H:i', $sessions[0]->pro_se_time);}?>" required>
                                    </div>
								    <div class="form-group">
                                        <label>Duration(In Minutes) <span style="color: red;">*</span></label>
                                        <input type="number" class="form-control" name="duration" value="<?php if(isset($sessions[0]->duration)){ echo $sessions[0]->duration;}?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Amount <span style="color: red;">*</span></label>
                                        <input type="number" class="form-control" name="amount" value="<?php if(isset($sessions[0]->amount)){ echo $sessions[0]->amount;}?>" required>
                                    </div>
                                    <?php if(isset($zoom_meeting[0]->meeting_link)){if(date("Y-m-d H:i:s", strtotime('+ '.$sessions[0]->duration.' minutes', $sessions[0]->pro_se_time)) >= date("Y-m-d H:i:s")){?>
                                    <div class="form-group">
                                        <label>Zoom Meeting Link : </label>
                                        <p class="zoom_meeting_link"><?php if(isset($zoom_meeting[0]->meeting_link)){ echo $zoom_meeting[0]->meeting_link;}?></p>
                                        <a class="btn btn-success" href="#" onclick="copyToClipboard('.zoom_meeting_link')">Copy Link</a>
                                    </div>
                                    <div class="form-group">
                                        <label>Zoom Meeting Password : </label>
                                        <?php if(isset($zoom_meeting[0]->meeting_password)){ echo $zoom_meeting[0]->meeting_password;}?>
                                    </div>
                                    <?php }
                                    else{
                                        echo "<p style='color:red;'>Note: Meeting time has been completed.</p>";
                                    }} ?>
                                </div>
                                <div class="col-lg-12 pull-right">
                                    <button type="submit" class="btn btn-primary pull-right"><?php if(isset($sessions[0]->pro_se_id)){ echo 'Update Details';}else{ echo 'Add Details';}?></button><br><br><br>
                                    <center><img src="<? echo base_url(); ?>assets/images/load.gif" width="42" height="42" alt="" style="display:none" id="loader"></center>
                                </div>
                            </form>
                        </div>
                    </div>
    </div>
</div>

<script type="text/javascript">
  $('.dropify').dropify({
    messages: {
        'default': 'Drag and drop a file here or click',
        'replace': 'Drag and drop or click to replace',
        'remove':  'Remove',
        'error':   'Ooops, something wrong happended.'
    }
});
</script>
<script type="text/javascript">
    $(document).ready(function(){
  
    $("#updateexpert").on('submit', function(e){
       e.preventDefault();
       var fdata = $("#updateexpert").serialize();
       var url = '<?php echo base_url("professor/sessions/save_session")?>';
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
    
    function copyToClipboard(element){
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
    }
</script>