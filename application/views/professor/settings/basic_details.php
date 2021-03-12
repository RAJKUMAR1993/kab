
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
                            <form id="updateexpert">
                            <div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
                            <!-- <form id="basic-form" method="post" action="<?php echo base_url("professor/settings/update")?>" enctype="multipart/form-data" novalidate> -->
							<input type="hidden" value="<?php echo $professor->pro_image; ?>" name="image">
                            
                            <div class="row">
                                
                            	<div class="col-lg-4 pull-left">
                                    <div class="form-group">
                                        <label>Full Name<span style="color:red">*</span></label>
                                        <input type="text" class="form-control" name="pro_name" value="<?php if(isset($professor->pro_name)){ echo $professor->pro_name;}?>" required>
                                    </div>

                                </div>
                                
                                
                                
                                <div class="col-lg-4 pull-left">
                                    <div class="form-group">
                                        <label>Mobile Number 1<span style="color:red">*</span></label>
                                        <input type="text" class="form-control" name="mobile1"  maxlength="10" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" value="<?php if(isset($professor->mobile1)){ echo $professor->mobile1;}?>" required>
                                    </div>

                                </div>
                                
                                <div class="col-lg-4 pull-left">
                                    <div class="form-group">
                                        <label>Mobile Number 2</label>
                                        <input type="text" class="form-control" name="mobile2"  maxlength="10" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" value="<?php if(isset($professor->mobile2)){ echo $professor->mobile2;}?>">
                                    </div>

                                </div>
                                
                                <div class="col-lg-4 pull-left">
                                     <div class="form-group">
                                        <label>Email<span style="color:red">*</span></label>
                                       <input type="email" class="form-control" name="pro_email" value="<?php if(isset($professor->pro_email)){ echo $professor->pro_email;}?>" required>
                                    </div>
                                    
                                </div>
                                 
                                <div class="col-lg-4 pull-left">
                                    <div class="form-group">
                                        <label>Designation<span style="color:red">*</span></label>
                                        <input type="text" class="form-control" name="pro_designation" value="<?php if(isset($professor->pro_designation)){ echo $professor->pro_designation;}?>" required>
                                    </div>
                                    
                                </div>
                                    
                                <div class="col-lg-4 pull-left">    
                                     <div class="form-group">
                                        <label>Highest Education Qualification<span style="color:red">*</span></label>
                                       <input type="text" class="form-control" name="pro_quali" value="<?php if(isset($professor->pro_quali)){ echo $professor->pro_quali;}?>" required>
                                    </div>
                                  
                                </div>
                                
                                <div class="col-lg-4 pull-left">    
                                     <div class="form-group">
                                        <label>Current Organization</label>
                                       <input type="text" class="form-control" name="current_organization" value="<?php if(isset($professor->current_organization)){ echo $professor->current_organization;}?>">
                                    </div>
                                  
                                </div>
                                
                                <div class="col-lg-4 pull-left">    
                                     <div class="form-group">
                                        <label>Total Work Experience</label>
                                       <input type="number" class="form-control" name="work_exp" value="<?php if(isset($professor->work_exp)){ echo $professor->work_exp;}?>">
                                    </div>
                                  
                                </div>
                                
                                <div class="col-lg-4 pull-left">    
                                     <div class="form-group">
                                        <label>Language Spoken</label>
                                        <textarea class="form-control" rows="1" cols="30" name="lang"><?php if(isset($professor->pro_languages)){ echo $professor->pro_languages;}?></textarea>
										 
                                    </div>
                                  
                                </div>
                                
                                
                                
                                <div class="col-lg-4 pull-left">
                                     <div class="form-group">
                                        <label>Institute</label>
                                        <select  class="form-control" rows="5" cols="30" name="institute_id" readonly>
                                             <?php 
                                             $insname = $this->expert_model->get_institute_name($professor->institute_id);
                                             if($insname != ''){echo '<option value="'.$professor->institute_id.'">'.$insname.'</option>';}else{ echo '<option value="">No Institute Selected</option> '; }
                                             ?>
											
											 
                                        </select>
                                    </div> 
                                </div>  
                                <div class="col-lg-4 pull-left">
                                    <div class="form-group">
                                        <label>Professional Charges per Session : 60 min (Rs.)<span style="color:red">*</span></label>
                                        <input type="text" class="form-control" name="prof_ses_cost" value="<?php if(isset($professor->prof_ses_cost)){ echo $professor->prof_ses_cost;}?>" required>
                                    </div>
                                  </div>
                                <div class="col-lg-4 pull-left">    
                                     <div class="form-group">
                                        <label>Area Of Specialization<span style="color:red">*</span></label>
                                        <textarea type="text" rows="1" cols="30" class="form-control" name="specialization"><?php if(isset($professor->specialization)){ echo $professor->specialization;}?></textarea>
                                      
                                    </div>
                                  
                                </div>
                                
                                <div class="col-lg-4 pull-left">
                                    <div class="form-group">
                                        <label>Awards/Recognitions Received for Professional Services</label>
                                        <textarea class="form-control" rows="3" cols="30" name="awards"><?php if(isset($professor->awards)){ echo $professor->awards;}?></textarea>
                                    </div> 
                                </div>
                                
                                <div class="col-lg-4 pull-left">
                                    <div class="form-group">
                                        <label>Topic for Seminar/Webinars</label>
                                        <textarea class="form-control" rows="3" cols="30" name="topics"><?php if(isset($professor->topics)){ echo $professor->topics;}?></textarea>
                                    </div> 
                                </div>
                                
                                <div class="col-lg-4 pull-left">
                                    <div class="form-group">
                                        <label>Target Group To Attend Seminar (Webinar)</label>
                                        <textarea class="form-control" rows="3" cols="30" name="group_attend_seminar"><?php if(isset($professor->group_attend_seminar)){ echo $professor->group_attend_seminar;}?></textarea>
                                    </div> 
                                </div>
                                
								<div class="col-lg-4 pull-left">
                                    <div class="form-group">
                                        <label>Mailing Address</label>
                                        <textarea class="form-control" rows="3" cols="30" name="mailing_address"><?php if(isset($professor->mailing_address)){ echo $professor->mailing_address;}?></textarea>
                                    </div> 
                                </div>  
                                <div class="col-lg-4 pull-left">
                                    <div class="form-group">
                                        <label>Your Expectations from participants</label>
                                        <textarea class="form-control" rows="3" cols="30" name="expectations_from_participants" placeholder="Ex: Guidelines/Instructions to participants before attending your session"><?php if(isset($professor->expectations_from_participants)){ echo $professor->expectations_from_participants;}?></textarea>
                                    </div> 
                                </div>

                                <div class="col-lg-4 pull-left">                                
                                	<div class="form-group">
                                        <label>About Yourself</label>
                                        <textarea class="form-control" rows="3" cols="30" name="pro_shortdesc"><?php if(isset($professor->pro_shortdesc)){ echo $professor->pro_shortdesc;}?></textarea>
                                    </div> 
                                </div>
                                
                                <div class="col-lg-4 pull-left">    
                                     <div class="form-group">
                                        <label>Linkedin Profile</label>
                                       <input type="text" class="form-control" name="linkedin_profile" value="<?php if(isset($professor->linkedin_profile)){ echo $professor->linkedin_profile;}?>">
                                    </div>
                                  
                                </div> 
                                
                                <div class="col-lg-4 pull-left">    
                                     <div class="form-group">
                                        <label>Youtube Link</label>
                                       <input type="text" class="form-control" name="youtube_link" value="<?php if(isset($professor->youtube_link)){ echo $professor->youtube_link;}?>">
                                    </div>
                                  
                                </div>   
                                
                                <div class="col-lg-4 pull-left">    
                                     <div class="form-group">
                                        <label>Facebook</label>
                                       <input type="text" class="form-control" name="professor_facebook" value="<?php if(isset($professor->professor_facebook)){ echo $professor->professor_facebook;}?>">
                                    </div>
                                  
                                </div> 
                                
                                <div class="col-lg-4 pull-left">    
                                     <div class="form-group">
                                        <label>Twitter</label>
                                       <input type="text" class="form-control" name="professor_twitter" value="<?php if(isset($professor->professor_twitter)){ echo $professor->professor_twitter;}?>">
                                    </div>
                                  
                                </div>
                                <div class="col-lg-4 pull-left">    
                                     <div class="form-group">
                                        <label>Instagram</label>
                                       <input type="text" class="form-control" name="professor_instagram" value="<?php if(isset($professor->professor_instagram)){ echo $professor->professor_instagram;}?>">
                                    </div>
                                  
                                </div> 
                                <div class="col-lg-4 pull-left">
                                    <div class="form-group">
                                        <label>Password<span style="color:red">*</span></label>
                                        <input type="text" class="form-control" name="cpassword" value="<?php if(isset($professor->password)){ echo $this->institute_login_model->api_key_crypt($professor->password,"d");}?>" required>
                                        <input type="hidden" class="form-control" name="old_password" value="<?php if(isset($professor->password)){ echo $professor->password;}?>" >
                                    </div>
                                </div>
                                
                                <div class="col-lg-4 pull-left">
                               		<div class="form-group">
                                        <label>Image</label>
                                         <input type="file" name="picture" class="dropify" data-max-width="335" data-max-height="227">
                                         <span style="color: red;font-size: 12px;">Note : Please upload image with size 334 x 226.</span>
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
       var fdata = new FormData(this);
       var url = '<?php echo base_url("professor/settings/update")?>';
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
        },
		error : function(data){
			
			console.log(data);
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
  height: 100,
});

</script>