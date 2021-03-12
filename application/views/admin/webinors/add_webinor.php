<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
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
                        <div class="header webinarHeader1">
                            <div class="col-lg-9 pull-left">
                                <h2>Webinar Details</h2>
                            </div>
                            <div class="col-lg-1 pull-right">
                                <a href="<?php echo base_url("admin/webinars");?>" class="btn btn-info">Back</a>
                            </div>
                                   
                        </div>
                        <div class="body">
                            <div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
                            <form id="addeditwebinor">
                                <input type="hidden" id="url" name="url" value="<?php echo base_url("admin/webinars/save_webinor/".$this->uri->segment(4));?>">
                                <input type="hidden" id="webinor_id" name="webinor_id" value="<?php echo $this->uri->segment(4);?>">
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Title <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" name="title" value="<?php if(isset($webinor->title)){ echo $webinor->title;}?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Descrption <span style="color: red;">*</span></label>
                                        <textarea class="form-control summernote" name="description"  rows="4" cols="30" required>
                                            <?php if(isset($webinor->description)){echo $webinor->description;}?>
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Image <span style="color: red;">*</span></label>
                                        <input type="hidden" value="<?php echo $webinor->image; ?>" name="image">
                                         <input accept="image/png, image/jpeg" type="file" name="picture" data-allowed-file-extensions="jpg png jpeg"  class="dropify" data-default-file="<?php if(isset($webinor->image)){ echo base_url('assets/images/webinars/'.$webinor->image);}?>" <?php if(!isset($webinor->image)){ echo 'required'; } ?> data-max-width="381" data-max-height="401">
                                         <span style="color: red;font-size: 12px;">Note : Please upload image with size 380 x 400.</span>
                                    </div>

                                </div>
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Date <span style="color: red;">*</span></label>
                                        <input type="date" id="date" class="form-control" name="date" value="<?php if(isset($webinor->date)){ echo $webinor->date;}?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>From Time <span style="color: red;">*</span></label>
                                        <input type="time" class="form-control" id="from_time" name="from_time" value="<?php if(isset($webinor->from_time)){ echo date('H:i', $webinor->from_time);}?>" required>
                                    </div>

                                </div>
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>To Time <span style="color: red;">*</span></label>
                                        <input type="time" class="form-control" id="to_time" name="to_time" value="<?php if(isset($webinor->to_time)){ echo date('H:i', $webinor->to_time);}?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Professor</label>
                                        <select class="selectpicker" multiple data-live-search="true" name="professor_ids[]">
                                            <?php
                                            foreach ($professors as $professor) {
                                                $selected = '';
                                                if(in_array($professor->pro_id, explode(',', $webinor->professor_ids))){
                                                    $selected = 'selected';
                                                }
                                                echo '<option '.$selected.' value="'.$professor->pro_id.'">'.$professor->pro_name.'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Guest</label>
                                        <select class="selectpicker" multiple data-live-search="true" name="guest_ids[]">
                                            <?php
                                            foreach ($guests as $guest) {
                                                $selected = '';
                                                if(in_array($guest->id, explode(',', $webinor->guest_ids))){
                                                    $selected = 'selected';
                                                }
                                                echo '<option '.$selected.' value="'.$guest->id.'">'.$guest->name.'</option>';
                                            }
												
                                            ?>
                                        </select>
                                        <select class="selectpicker" multiple data-live-search="true" name="speaker_ids[]">
                                            <?php
                                            foreach ($speakers as $speaker) {
                                                $selected = '';
                                                if(in_array($speaker->speaker_id, explode(',', $webinor->speaker_ids))){
                                                    $selected = 'selected';
                                                }
                                                echo '<option '.$selected.' value="'.$speaker->speaker_id.'">'.$speaker->speaker_name.'</option>';
                                            }
												
                                            ?>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>View Page Image <span style="color: red;">*</span></label>
                                        <input type="hidden" value="<?php echo $webinor->view_image; ?>" name="image">
                                         <input accept="image/png, image/jpeg" type="file" name="view_image" data-allowed-file-extensions="jpg png jpeg"  class="dropify" data-default-file="<?php if(isset($webinor->view_image)){ echo base_url('assets/images/webinars/'.$webinor->view_image);}?>" <?php if(!isset($webinor->view_image)){ echo 'required'; } ?> data-max-width="826" data-max-height="448">
                                         <span style="color: red;font-size: 12px;">Note : Please upload image with size 825 x 447.</span>
                                    </div>
                                    <?php if(isset($zoom_meeting[0]->meeting_link)){if(date("Y-m-d H:i:s", $webinor->to_time) >= date("Y-m-d H:i:s")){?>
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
                                        echo "<p style='color:red;'>Note: Webinar time has been completed.</p>";
                                    }} ?>

                                </div>
                                <div class="col-lg-12 pull-right">                                    
                                     <button type="submit" class="btn btn-primary pull-right"><?php if($this->uri->segment(4)){echo "Update Webinar";}else{ echo "Add Webinar";}?></button><br><br><br>
                                        <center><img src="<? echo base_url(); ?>assets/images/load.gif" width="42" height="42" alt="" style="display:none" id="loader"></center>
                                </div>
                            </form>
                        </div>

                       
                    </div>
    </div>
</div>
<? $this->load->view("admin/includes/footer");?>
<script type="text/javascript">
    // $('.summernote').summernote({
    //     toolbar: [
    //         ['style', ['style']],
    //         ['font', ['bold', 'italic', 'underline', 'clear']],
    //         ['fontname', ['fontname']],
    //         ['color', ['color']],
    //         ['para', ['ul', 'ol', 'paragraph']],
    //         ['height', ['height']],
    //         ['table', ['table']],
    //        // ['insert', ['link', 'picture', 'hr']],
    //         ['view', ['fullscreen', 'codeview']],
    //         ['help', ['help']]
    //     ],
    //     height: 100,
    // });

</script>
<script type="text/javascript">
    $(document).ready(function(){
        var dates_avail = [];
        <?php
        foreach ($selected_dates as $sdate) {
        ?>
            dates_avail.push('<?php echo date('j-n-Y', strtotime($sdate));?>');
        <?php
        }
        ?>
        //console.log(dates_avail);
        toastr.options.timeOut = "false";
        toastr.options.closeButton = true;
        toastr.options.positionClass = 'toast-top-right';
        $("#date").on("blur", function(){
            var date = $(this).val();
            var dt = new Date(date);
            //var dates_avail = ["5-8-2020", "6-8-2020", "7-8-2020"];
            var dt2 = dt.getDate();
            dt2 += "-" + (dt.getMonth()+1);
            dt2 += "-" + dt.getFullYear();
           // console.log(dt2);
            if ($.inArray(dt2, dates_avail) != -1) {
                return true;
            } else {
                toastr.remove();
                toastr['error']('This date is not available to create webinar. Available dates are '+dates_avail, '', {
                    positionClass: 'toast-top-right'
                });
                setTimeout(function(){ console.log("Test");$("#date").val(""); }, 1000); 
            }
        });

        $("#to_time").on("blur", function(){
            var date = $("#date").val();
            var from_time = $("#from_time").val();
            var to_time = $(this).val();
            //console.log(from_time+'--'+to_time);
            if(date!='' && from_time!='' && to_time!='' && typeof date!='undefined' && typeof from_time!='undefined' && typeof to_time!='undefined'){
                var from_datetime = date+' '+from_time;
                var to_datetime = date+' '+to_time;
                //console.log(from_datetime+'--'+to_datetime);
                var f_fdatetime = new Date(from_datetime);
                var f_tdatetime = new Date(to_datetime);
                //console.log(f_fdatetime+'--'+f_tdatetime);
                var getftime = parseInt(f_fdatetime.getTime());
                var gettttime = parseInt(f_tdatetime.getTime());
                //console.log(getftime+'--'+gettttime);
                if(gettttime>getftime){
                    return true;
                }
                else{
                    toastr.remove();
                    toastr['error']('To time should be greater than From time', '', {
                        positionClass: 'toast-top-right'
                    });
                    setTimeout(function(){ $("#to_time").val(""); }, 1000); 
                }
            }
        });
    $("#addeditwebinor").on('submit', function(e){
       e.preventDefault();
       var fdata = new FormData(this);
       var url = $('#url').val();
        //alert(url);
       $.ajax({
        url:url,
        data:fdata,
        type:"post",
        dataType:"json",
        cache:false,
        contentType: false,
        processData: false,
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>