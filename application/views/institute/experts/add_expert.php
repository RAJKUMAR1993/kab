
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
                        <div class="header instituteHeader1">
                            <div class="col-lg-9 pull-left">
                                <h2>Expert Details</h2>
                            </div>
                            <div class="col-lg-1 pull-right">
                                <a href="<?php echo base_url("institute/experts");?>" class="btn btn-info">Back</a>
                            </div>
                                   
                        </div>
                        <div class="body">
                            <div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
                            <form id="addeditexpert">
                                <input type="hidden" id="url" name="url" value="<?php echo base_url("institute/experts/save_expert/".$this->uri->segment(4));?>">
                                <input type="hidden" id="expert_id" name="expert_id" value="<?php echo $this->uri->segment(4);?>">
                            <!-- <form id="basic-form" method="post" action="<?php echo base_url("institute/experts/save_expert/".$this->uri->segment(4));?>" novalidate> -->
                                <div class="col-lg-4 pull-left">
                                    <div class="form-group">
                                        <label>Full name</label>
                                        <input type="text" class="form-control" name="name" value="<?php if(isset($expert->expert_name)){ echo $expert->expert_name;}?>" required>
                                    </div>
                                     <div class="form-group">
                                        <label>Email</label>
                                       <input type="email" class="form-control" name="email" value="<?php if(isset($expert->expert_email)){ echo $expert->expert_email;}?>" required>
                                    </div>
                                  

                                </div>
                                <div class="col-lg-4 pull-left">
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
                                <div class="col-lg-4 pull-left">
                                    <div class="form-group">
                                        <label>Designation</label>
                                        <input type="text" class="form-control" name="designation" value="<?php if(isset($expert->expert_designation)){ echo $expert->expert_designation;}?>" required>
                                    </div>
                                     <div class="form-group">
                                        <label>Highest Educational Qualification</label>
                                       <input type="text" class="form-control" name="qualification" value="<?php if(isset($expert->expert_qualification)){ echo $expert->expert_qualification;}?>" required>
                                    </div>
                                  

                                </div>

                                <div class="col-lg-6 pull-left">
                                    
                                        <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" name="phone" value="<?php if(isset($expert->expert_mobile)){ echo $expert->expert_mobile;}?>" maxlength="10" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" required>
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
                                        <label>Short Description</label>
                                        <textarea class="form-control" rows="3" cols="30" name="shortdesc" required><?php if(isset($expert->expert_shortdesc)){ echo $expert->expert_shortdesc;}?></textarea>
                                    </div> 
                                </div>
                                <div class="col-lg-6 pull-left">
                                <div class="form-group">
                                        <label>Long Description</label>
                                        <textarea class="form-control" rows="3" cols="30" name="longdesc" required><?php if(isset($expert->expert_longdesc)){ echo $expert->expert_longdesc;}?></textarea>
                                    </div> 
                                    
                                        </div>
                                        <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Area of specialization</label>
                                       <textarea type="text" class="form-control summernote" name="expertise" required><?php if(isset($expert->expert_expertise)){ echo $expert->expert_expertise;}?></textarea>
                                    </div>
                                     
                                </div>
                                <div class="col-lg-12 pull-right">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary pull-right"><?php if($this->uri->segment(4)){echo "Update Expert";}else{ echo "Add Expert";}?></button><br><br><br>
                                        <center><img src="<? echo base_url(); ?>assets/images/load.gif" width="42" height="42" alt="" style="display:none" id="loader"></center>
                                    </div>
                                </div>
  
                            </form>
                        </div>

                       
                    </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
  
    $("#addeditexpert").on('submit', function(e){
       e.preventDefault();
       var fdata = $("#addeditexpert").serialize();
       var url = $('#url').val();
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