
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
                                <h2>Webinar Guests</h2>
                            </div>
                            <div class="col-lg-1 pull-right">
                                <a href="<?php echo base_url("admin/webinars/guests");?>" class="btn btn-info">Back</a>
                            </div>
                                   
                        </div>
                        <div class="body">
                            <div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
                            <form id="addeditguest">
                                <input type="hidden" id="url" name="url" value="<?php echo base_url("admin/webinars/save_guest/".$this->uri->segment(4));?>">
                                <input type="hidden" id="guest_id" name="guest_id" value="<?php echo $this->uri->segment(4);?>">
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Name <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" name="name" value="<?php if(isset($guest->name)){ echo $guest->name;}?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Mobile Number <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" name="mobile_no"  maxlength="10" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" value="<?php if(isset($guest->mobile_no)){ echo $guest->mobile_no;}?>" required>
                                    </div>

                                </div>
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Email <span style="color: red;">*</span></label>
                                        <input type="email" class="form-control" name="email" value="<?php if(isset($guest->email)){ echo $guest->email;}?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Designation <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" name="designation" value="<?php if(isset($guest->designation)){ echo $guest->designation;}?>" required>
                                    </div>

                                </div>
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Qualification <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" name="qualification" value="<?php if(isset($guest->qualification)){ echo $guest->qualification;}?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Current Organization</label>
                                        <input type="text" class="form-control" name="current_organization" value="<?php if(isset($guest->current_organization)){ echo $guest->current_organization;}?>">
                                    </div>
                                </div>
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Total Work Experience <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" name="work_exp" value="<?php if(isset($guest->work_exp)){ echo $guest->work_exp;}?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Languages Spoken</label>
                                        <input type="text" class="form-control" name="languages" value="<?php if(isset($guest->languages)){ echo $guest->languages;}?>">
                                    </div>
                                </div>
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>About Yourself</label>
                                        <textarea type="text" class="form-control" name="about_yourself" rows="5"><?php if(isset($guest->about_yourself)){ echo $guest->about_yourself;}?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>LinkedIn </label>
                                        <input type="text" class="form-control" name="linkedin_profile" value="<?php if(isset($guest->linkedin_profile)){ echo $guest->linkedin_profile;}?>">
                                    </div>
                                    <div class="form-group">
                                        <label>	Twitter </label>
                                        <input type="text" class="form-control" name="twitter" value="<?php if(isset($guest->twitter)){ echo $guest->twitter;}?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Instagram </label>
                                        <input type="text" class="form-control" name="instagram" value="<?php if(isset($guest->instagram)){ echo $guest->instagram;}?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Youtube</label>
                                        <input type="text" class="form-control" name="youtube" value="<?php if(isset($guest->youtube)){ echo $guest->youtube;}?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Facebook </label>
                                        <input type="text" class="form-control" name="facebook" value="<?php if(isset($guest->facebook)){ echo $guest->facebook;}?>">
                                    </div>
                                </div>

                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Image <span style="color: red;">*</span></label>
                                        <input type="hidden" value="<?php echo $guest->image; ?>" name="image">
                                         <input accept="image/*" type="file" name="picture" data-allowed-file-extensions="jpg png jpeg gif"  class="dropify" data-default-file="<?php if(isset($guest->image)){ echo base_url('assets/images/guests/'.$guest->image);}?>" <?php if(!isset($guest->image)){ echo 'required'; } ?> data-max-width="101" data-max-height="101">
                                         <span style="color: red;font-size: 12px;">Note : Please upload image with size 100 x 100.</span>
                                    </div>
                                </div>
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Area of Expertise <span style="color: red;">*</span></label>
                                        <textarea type="text" class="form-control" name="specialization" required><?php if(isset($guest->specialization)){ echo $guest->specialization;}?></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 pull-right">                                    
                                     <button type="submit" class="btn btn-primary pull-right"><?php if($this->uri->segment(4)){echo "Update Guest";}else{ echo "Add Guest";}?></button><br><br><br>
                                        <center><img src="<? echo base_url(); ?>assets/images/load.gif" width="42" height="42" alt="" style="display:none" id="loader"></center>
                                </div>
                            </form>
                        </div>

                       
                    </div>
    </div>
</div>
<? $this->load->view("admin/includes/footer");?>
<script type="text/javascript">
    $(document).ready(function(){

    $("#addeditguest").on('submit', function(e){
       e.preventDefault();
       var fdata = new FormData(this);
       var url = $('#url').val();
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