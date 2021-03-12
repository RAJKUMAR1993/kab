
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
                            <form id="updateexpert" enctype="multipart/form-data">
                            <div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
                            <!-- <form id="basic-form" method="post" action="<?php echo base_url("expert/settings/update")?>" enctype="multipart/form-data" novalidate> -->
                              <div class="row">
                                 <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>First name</label>
                                        <input type="text" class="form-control" name="fname" value="<?php if(isset($expert->expert_fname)){ echo $expert->expert_fname;}?>" required>
                                    </div>
                                  </div>
                                  <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Last name</label>
                                        <input type="text" class="form-control" name="lname" value="<?php if(isset($expert->expert_lname)){ echo $expert->expert_lname;}?>" required>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-6 pull-left">
                                <div class="form-group">
                                        <label>Mailing Address</label>
                                        <textarea class="form-control" rows="1" cols="30" name="mailingaddress"><?php if(isset($expert->expert_mailingaddress)){ echo $expert->expert_mailingaddress;}?></textarea>
                                    </div> 
                                    
                                </div>
                                  <div class="col-lg-6 pull-left">
                                     <div class="form-group">
                                        <label>Email Id</label>
                                       <input type="email" class="form-control" name="email" value="<?php if(isset($expert->expert_email)){ echo $expert->expert_email;}?>" required>
                                    </div>
    
                                </div>
                              </div>
                              <div class="row">
                                 <div class="col-lg-6 pull-left">
                                        <div class="form-group">
                                    <label>Mobile Number (1) </label>
                                    <input type="text" class="form-control" name="phone" value="<?php if(isset($expert->expert_mobile)){ echo $expert->expert_mobile;}?>" maxlength="10" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" required>
                                    </div>
                                  </div>
                                   <div class="col-lg-6 pull-left">
                                        <div class="form-group">
                                    <label>Mobile Number (2) </label>
                                    <input type="text" class="form-control" name="phone2" value="<?php if(isset($expert->expert_mobile2)){ echo $expert->expert_mobile2;}?>" maxlength="10" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57">
                                    </div>
                                  </div>
                              </div>
<div class="row">
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Designation</label>
                                        <input type="text" class="form-control" name="designation" value="<?php if(isset($expert->expert_designation)){ echo $expert->expert_designation;}?>" required>
                                    </div>
                                  </div>
                                  <div class="col-lg-6 pull-left">
                                     <div class="form-group">
                                        <label>Highest Educational Qualification</label>
                                       <input type="text" class="form-control" name="qualification" value="<?php if(isset($expert->expert_qualification)){ echo $expert->expert_qualification;}?>" required>
                                    </div>
                                  

                                </div>
                              </div>

<div class="row">
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Current Organization</label>
                                        <input type="text" class="form-control" name="curorg" value="<?php if(isset($expert->expert_curorg)){ echo $expert->expert_curorg;}?>">
                                    </div>
                                  </div>
                                  <div class="col-lg-6 pull-left">
                                     <div class="form-group">
                                        <label>Total Work Experience</label>
                                       <input type="text" class="form-control" name="tworkexp" value="<?php if(isset($expert->expert_tworkexp)){ echo $expert->expert_tworkexp;}?>">
                                    </div>
                                  

                                </div>
                              </div>

<div class="row">
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select  class="form-control" name="gender" required>
                                             <?php if(isset($expert->expert_gender)){echo '<option value="'.$expert->expert_gender.'">'.$expert->expert_gender.'</option>';}?>
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                  </div>

                                     <div class="col-lg-6 pull-left">
                                      <div class="form-group">
                                        <label>Type /Mode of Interaction preferred </label>
                                        <select  class="form-control" rows="5" cols="30" name="type" required>
                                            
                                            <option value="">Select Mode</option>
                                            <option value="oto" <?php if(isset($expert->expert_type) && ($expert->expert_type == 'oto')){echo 'selected';}?>>One –to- one (Personalized)</option>
                                            <option value="otm"  <?php if(isset($expert->expert_type) && ($expert->expert_type == 'otm')){echo 'selected';}?>>One- to- many(Group counseling not more than 20)</option>
                                        </select>
                                    </div>  
                                    
                                   </div>
                                 
                                </div>
                                <div class="row">
                                  <div class="col-lg-6 pull-left">
                                     <div class="form-group">
                                        <label>Institute Name</label>
                                        <select  class="form-control" rows="5" cols="30" name="institute_id" required readonly>
                                             <?php 
                                             $insname = $this->expert_model->get_institute_name($expert->institute_id);
                                             if(isset($expert->institute_id)){echo '<option value="'.$expert->institute_id.'">'.$insname.'</option>';}
                                             ?>
                                        </select>
                                    </div>
                                    
                                </div>
                               
                                    <div class="col-lg-6 pull-left">
                                      <div class="form-group">
                                        <label>Status</label>
                                        <select  class="form-control" rows="5" cols="30" name="status" required>
                                             <?php if(isset($expert->expert_status)){echo '<option value="'.$expert->expert_status.'">'.$expert->expert_status.'</option>';}?>
                                            <option value="">Status</option>
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                    </div>  
                                    
                                   </div>
                                   </div>
                                   <div class="row">
                                 <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Professional Charges per Session : 30 min (Rs.)</label>
                                        <input type="text" class="form-control" name="tcost" value="<?php if(isset($expert->expert_tcost)){ echo $expert->expert_tcost;}?>" required>
                                    </div>
                                  </div>
                                  <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Professional Charges per Session : 60 min (Rs.)</label>
                                        <input type="text" class="form-control" name="scost" value="<?php if(isset($expert->expert_scost)){ echo $expert->expert_scost;}?>" required>
                                    </div>
                                  </div>
                                </div> 
                                   <div class="row">
                                   <div class="col-lg-6 pull-left">
                                    <?php if(isset($expert->password)){?>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="text" class="form-control" name="password" value="<?php if(isset($expert->password)){ echo $this->institute_login_model->api_key_crypt($expert->password,"d");}?>" required>
                                        <input type="hidden" class="form-control" name="old_password" value="<?php if(isset($expert->password)){ echo $expert->password;}?>" >
                                    </div>
                                    <?php }?>
                                </div>
                              
                                <div class="col-lg-6 pull-left">
                                <div class="form-group">
                                        <label>Language Spoken</label>
                                        <textarea class="form-control" rows="1" cols="30" name="spokenlang" required><?php if(isset($expert->expert_spokenlang)){ echo $expert->expert_spokenlang;}?></textarea>
                                    </div> 
                                    
                                </div>
                                </div>
                                  <div class="row">
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Awards/Recognitions received for Professional services</label>
                                        <textarea class="form-control" rows="5" cols="30" name="awards"><?php if(isset($expert->expert_awards)){ echo $expert->expert_awards;}?></textarea>
                                    </div> 
                                </div>
                                <div class="col-lg-6 pull-left">
                                <div class="form-group">
                                        <label>Target group (Whom do you want to mentor/counsel/guide)</label>
                                        <textarea class="form-control" rows="5" cols="30" name="targetgroup"><?php if(isset($expert->expert_targetgroup)){ echo $expert->expert_targetgroup;}?></textarea>
                                    </div> 
                                    
                                </div>
                              </div>
                                <div class="row">
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Short Description</label>
                                        <textarea class="form-control" rows="5" cols="30" name="shortdesc"><?php if(isset($expert->expert_shortdesc)){ echo $expert->expert_shortdesc;}?></textarea>
                                    </div> 
                                </div>
                                <div class="col-lg-6 pull-left">
                                <div class="form-group">
                                        <label>Long Description</label>
                                        <textarea class="form-control" rows="5" cols="30" name="longdesc"><?php if(isset($expert->expert_longdesc)){ echo $expert->expert_longdesc;}?></textarea>
                                    </div> 
                                    
                                </div>
                              </div>
                              <div class="row">
                                 
                                <div class="col-lg-6 pull-left">
                                     <div class="form-group">
                                        <label>Area of specialization</label>
                                       <textarea type="text" class="form-control summernote" name="expertise"><?php if(isset($expert->expert_expertise)){ echo $expert->expert_expertise;}?></textarea>
                                    </div>
                                  </div>
   <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" class="form-control dropify" name="photo" data-allowed-file-extensions="jpg jpeg png" data-default-file="<?php echo base_url($expert->expert_photo)?>">
                                        <input type="hidden" class="form-control" name="old_photo" value="<?php if(isset($expert->expert_photo)){ echo $expert->expert_photo;}?>" >
                                    </div>
                                </div>
</div>
 <div class="row">
                                 <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Your Expectations from participants</label>
                                        <textarea type="text" class="form-control" rows="5" cols="30" name="expparti"><?php if(isset($expert->expert_expparti)){ echo $expert->expert_expparti;}?></textarea>
                                    </div>
                                  </div>
                                  <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>LinkedIn Profile</label>
                                        <input type="text" class="form-control" name="linkedinprofie" value="<?php if(isset($expert->expert_linkedinprofie)){ echo $expert->expert_linkedinprofie;}?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Youtube Link </label>
                                        <input type="text" class="form-control" name="youtube" value="<?php if(isset($expert->expert_youtube)){ echo $expert->expert_youtube;}?>">
                                    </div>
                                  </div>
                                 <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Facebook</label>
                                        <input type="text" class="form-control" name="expert_facebook" value="<?php if(isset($expert->expert_facebook)){ echo $expert->expert_facebook;}?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Twitter </label>
                                        <input type="text" class="form-control" name="expert_twitter" value="<?php if(isset($expert->expert_twitter)){ echo $expert->expert_twitter;}?>">
                                    </div>
                                  </div> 
                                  <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Instagram</label>
                                        <input type="text" class="form-control" name="expert_instagram" value="<?php if(isset($expert->expert_instagram)){ echo $expert->expert_instagram;}?>">
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
  
    $("#updateexpert").on('submit', function(e){
       e.preventDefault();
       //var fdata = $("#updateexpert").serialize();
       var fdata = new FormData(this);
       var url = '<?php echo base_url("expert/settings/update")?>';
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