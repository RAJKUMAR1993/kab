
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
                                <h2>Your Details</h2>
                            </div>
                                
                        </div>
                        <div class="body">
                            <form id="updatespeaker" enctype="multipart/form-data">
                            <div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
                            <!-- <form id="basic-form" method="post" action="<?php echo base_url("speaker/settings/update")?>" enctype="multipart/form-data" novalidate> -->
                              <div class="row">
                                 <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Full Name<span style="color:red">*</span></label>
                                        <input type="text" class="form-control" name="full_name" value="<?php if(isset($speaker->speaker_name)){ echo $speaker->speaker_name;}?>" required>
                                    </div>
                                  </div>
                                  <div class="col-lg-6 pull-left">
                                <div class="form-group">
                                        <label>Address</label>
                                        <textarea class="form-control" rows="1" cols="30" name="mailingaddress" required><?php if(isset($speaker->speaker_mailingaddress)){ echo $speaker->speaker_mailingaddress;}?></textarea>
                                    </div> 
                                    
                                </div>
                                </div>
                              <div class="row">
                                 
                                  <div class="col-lg-6 pull-left">
                                     <div class="form-group">
                                        <label>Email Id<span style="color:red">*</span></label>
                                       <input type="email" class="form-control" name="email" value="<?php if(isset($speaker->speaker_email)){ echo $speaker->speaker_email;}?>" required>
                                    </div>
                                    </div>
                                   <div class="col-lg-6 pull-left">
                                        <div class="form-group">
                                    <label>Mobile Number (1) <span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="phone" value="<?php if(isset($speaker->speaker_mobile)){ echo $speaker->speaker_mobile;}?>" maxlength="10" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" required>
                                    </div>
                                  </div>
                                </div>
                                  <div class="row">
                                   <div class="col-lg-6 pull-left">
                                        <div class="form-group">
                                    <label>Mobile Number (2)<span style="color:red">*</span> </label>
                                    <input type="text" class="form-control" name="phone2" value="<?php if(isset($speaker->speaker_mobile2)){ echo $speaker->speaker_mobile2;}?>" maxlength="10" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" required>
                                    </div>
                                  </div>
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Designation<span style="color:red">*</span> </label>
                                        <input type="text" class="form-control" name="designation" value="<?php if(isset($speaker->speaker_designation)){ echo $speaker->speaker_designation;}?>" required>
                                    </div>
                                  </div>
                              </div>

                                <div class="row">
                                  <div class="col-lg-6 pull-left">
                                     <div class="form-group">
                                        <label>Highest Educational Qualification<span style="color:red">*</span></label>
                                       <input type="text" class="form-control" name="qualification" value="<?php if(isset($speaker->speaker_qualification)){ echo $speaker->speaker_qualification;}?>" required>
                                    </div>
                                  

                                </div>
                              </div>
                              <div class="row">
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Current Organization<span style="color:red">*</span></label>
                                        <input type="text" class="form-control" name="curorg" value="<?php if(isset($speaker->speaker_curorg)){ echo $speaker->speaker_curorg;}?>" required>
                                    </div>
                                  </div>
                                  <div class="col-lg-6 pull-left">
                                     <div class="form-group">
                                        <label>Total Work Experience<span style="color:red">*</span></label>
                                       <input type="text" class="form-control" name="tworkexp" value="<?php if(isset($speaker->speaker_tworkexp)){ echo $speaker->speaker_tworkexp;}?>" required>
                                    </div>
                                  

                                </div>
                              </div>
                              <div class="row">
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Gender<span style="color:red">*</span></label>
                                        <select  class="form-control" name="gender" required>
                                             <?php if(isset($speaker->speaker_gender)){echo '<option value="'.$speaker->speaker_gender.'">'.$speaker->speaker_gender.'</option>';}?>
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                  </div>
                                 <div class="col-lg-6 pull-left">
                                      <div class="form-group">
                                        <label>Type /Mode of Interaction preferred<span style="color:red">*</span>  </label>
                                        <select  class="form-control" rows="5" cols="30" name="type" required>
                                            
                                            <option value="">Select Mode</option>
                                            <option value="oto" <?php if(isset($speaker->speaker_type) && ($speaker->speaker_type == 'oto')){echo 'selected';}?>>One –to- one (Personalized)</option>
                                            <option value="otm"  <?php if(isset($speaker->speaker_type) && ($speaker->speaker_type == 'otm')){echo 'selected';}?>>One- to- many(Group counseling not more than 20)</option>
                                        </select>
                                    </div>  
                                    
                                   </div>
                                </div>
                                <div class="row">
                                   <div class="col-lg-6 pull-left"> 
                                     <div class="form-group">
                                        <label>Institute Name<span style="color:red">*</span></label>
                                        <select  class="form-control" rows="5" cols="30" name="institute_id" required readonly>
                                             <?php 
                                             $insname = $this->speaker_model->get_institute_name($speaker->institute_id);
                                             if($insname != ''){echo '<option value="'.$speaker->institute_id.'">'.$insname.'</option>';}else{ echo '<option value="">No Institute Selected</option> '; }
                                             ?>
                                        </select>
                                    </div>
                                    
                                </div>
                                   <div class="col-lg-6 pull-left">
                                <div class="form-group">
                                        <label>Language Spoken<span style="color:red">*</span></label>
                                        <textarea class="form-control" rows="1" cols="30" name="spokenlang" required><?php if(isset($speaker->speaker_spokenlang)){ echo $speaker->speaker_spokenlang;}?></textarea>
                                    </div> 
                                    
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-lg-6 pull-left">
                                     
                                      <div class="form-group">
                                        <label>Status<span style="color:red">*</span> </label>
                                        <select  class="form-control" rows="5" cols="30" name="status" required>
                                             <?php if(isset($speaker->speaker_status)){echo '<option value="'.$speaker->speaker_status.'">'.$speaker->speaker_status.'</option>';}?>
                                            <option value="">Status</option>
                                            <option value="Live Status">Live Status</option>
                                            <option value="Login Status">Login Status</option>
                                        </select>
                                    </div>  
                                    </div>
                                    <div class="col-lg-6 pull-left">
                                    <?php if(isset($speaker->password)){?>
                                    <div class="form-group">
                                        <label>Password<span style="color:red">*</span> </label>
                                        <input type="text" class="form-control" name="password" value="<?php if(isset($speaker->password)){ echo $this->institute_login_model->api_key_crypt($speaker->password,"d");}?>" required>
                                        <input type="hidden" class="form-control" name="old_password" value="<?php if(isset($speaker->password)){ echo $speaker->password;}?>" >
                                    </div>
                                    <?php }?>
                                </div>
                              </div>
                                  <div class="row">
                                 <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Professional Charges per Session : 30 min (Rs.)<span style="color:red">*</span></label>
                                        <input type="text" class="form-control" name="tcost" value="<?php if(isset($speaker->speaker_tcost)){ echo $speaker->speaker_tcost;}?>" required>
                                    </div>
                                  </div>
                                  <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Professional Charges per Session : 60 min (Rs.)<span style="color:red">*</span></label>
                                        <input type="text" class="form-control" name="scost" value="<?php if(isset($speaker->speaker_scost)){ echo $speaker->speaker_scost;}?>" required>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 pull-left">
										<div class="form-group">
											<label>LinkedIn Profile<span style="color:red">*</span></label>
											<input type="text" class="form-control" name="linkedinprofie" value="<?php if(isset($speaker->speaker_linkedinprofie)){ echo $speaker->speaker_linkedinprofie;}?>" required>
										</div>
                                    </div>
									<div class="col-lg-6 pull-left">
										<div class="form-group">
											<label>Youtube Link<span style="color:red">*</span> </label>
											<input type="text" class="form-control" name="youtube" value="<?php if(isset($speaker->speaker_youtube)){ echo $speaker->speaker_youtube;}?>" required>
										</div>
                                  </div>
                                </div>								
                                    <div class="row">
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Awards/Recognitions received for Professional services</label>
                                        <textarea class="form-control" rows="5" cols="30" name="awards"><?php if(isset($speaker->speaker_awards)){ echo $speaker->speaker_awards;}?></textarea>
                                    </div> 
                                </div>
                                <div class="col-lg-6 pull-left">
                                <div class="form-group">
                                        <label>Target group (Whom do you want to mentor/counsel/guide)</label>
                                        <textarea class="form-control" rows="5" cols="30" name="targetgroup"><?php if(isset($speaker->speaker_targetgroup)){ echo $speaker->speaker_targetgroup;}?></textarea>
                                    </div> 
                                    
                                </div>
                              </div>

<div class="row">
                               
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Short Description</label>
                                        <textarea class="form-control" rows="3" cols="30" name="shortdesc"><?php if(isset($speaker->speaker_shortdesc)){ echo $speaker->speaker_shortdesc;}?></textarea>
                                    </div> 
                                </div>
                                <div class="col-lg-6">
                                <div class="form-group">
                                        <label>Long Description</label>
                                        <textarea class="form-control" rows="3" cols="30" name="longdesc"><?php if(isset($speaker->speaker_longdesc)){ echo $speaker->speaker_longdesc;}?></textarea>
                                    </div> 
                                    
                                </div>
                              </div>
                                <div class="row">
                                  <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Image<span style="color:red">*</span></label>
                                        <input type="file" class="form-control dropify" name="photo" data-allowed-file-extensions="jpg jpeg png" data-default-file="<?php echo base_url($speaker->speaker_photo)?>">
                                        <input type="hidden" class="form-control" name="old_photo" value="<?php if(isset($speaker->speaker_photo)){ echo $speaker->speaker_photo;}?>" >
                                    </div>
                                </div>
								  <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Your Expectations from participants</label>
                                        <textarea type="text" class="form-control" rows="9" cols="30" name="expparti"><?php if(isset($speaker->speaker_expparti)){ echo $speaker->speaker_expparti;}?></textarea>
                                    </div>
                                  </div>
                                  
								</div>
								<div class="row">
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Area of specialization<span style="color:red">*</span></label>
                                       <textarea type="text" class="form-control summernote" name="expertise"><?php if(isset($speaker->speaker_expertise)){ echo $speaker->speaker_expertise;}?></textarea>
                                    </div>
                                  </div> 
                                  
                                </div>
                                <button type="submit" class="btn btn-primary pull-right">Update Details</button><br><br><br>

                                        <center><img src="<? echo base_url(); ?>assets/images/load.gif" width="42" height="42" alt="" style="display:none" id="loader"></center>
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
  
    $("#updatespeaker").on('submit', function(e){
       e.preventDefault();
       //var fdata = $("#updatespeaker").serialize();
       var fdata = new FormData(this);
       var url = '<?php echo base_url("speaker/settings/update")?>';
        //alert(url);
       $.ajax({
        url:url,
        data:fdata,
        type:"post",
        dataType:"json",
         processData:false,
          contentType:false,
          cache:false,
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

<script type="text/javascript">  
    $('.summernote').summernote({
    toolbar: [
    ['style', ['style']],
    ['font', ['bold', 'italic', 'underline', 'clear']],
    ['fontname', ['fontname']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']],
    ['table', ['table']],
   // ['insert', ['link', 'picture', 'hr']],
    ['view', ['fullscreen', 'codeview']],
    ['help', ['help']]
  ],
  height: 50,
});

</script>