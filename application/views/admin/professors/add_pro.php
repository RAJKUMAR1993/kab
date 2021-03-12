
<style>
    td.details-control {
    background: url('<?php echo base_url(); ?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
    }
    tr.shown td.details-control {
        background: url('<?php echo base_url(); ?>assets/images/details_close.png') no-repeat center center;
    }
    .required:after {
    content:" *";
    color: red;
    }
</style>

<div id="main-content">
        

    <div class="col-md-12">
                    <?php echo $this->session->flashdata('msg');?>
                    <div class="card">
                        <div class="header">
                            <div class="col-lg-9 pull-left">
                                <h2>Professor Details</h2>
                            </div>
                            <a href="<?php echo base_url("admin/professors");?>" class="col-lg-1 pull-right"><button class="btn btn-primary">Back</button></a>
                                   
                        </div>
                        <div class="body">
                            <div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
                            <form id="addeditexpert">
                                <input type="hidden" id="url" name="url" value="<?php echo base_url("admin/professors/save_pro/".$this->uri->segment(4));?>">
                                <input type="hidden" id="expert_id" name="pro_id" value="<?php echo $this->uri->segment(4);?>">
                            
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label class="required">Full name</label>
                                        <input type="text" class="form-control" name="name" value="<?php if(isset($professors->pro_name)){ echo $professors->pro_name;}?>" required>
                                    </div>
                                     <div class="form-group">
                                        <label class="required">Email</label>
                                       <input type="email" class="form-control" name="email" value="<?php if(isset($professors->pro_email)){ echo $professors->pro_email;}?>" required>
                                    </div>
                                  

                                </div>

                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label class="required">Designation</label>
                                        <input type="text" class="form-control" name="designation" value="<?php if(isset($professors->pro_designation)){ echo $professors->pro_designation;}?>" required>
                                    </div>
                                     <div class="form-group">
                                        <label class="required">Qualification</label>
                                       <input type="text" class="form-control" name="qualification" value="<?php if(isset($professors->pro_quali)){ echo $professors->pro_quali;}?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                        <div class="col-lg-6 pull-left">
                                            <div class="form-group">
                                                <label class="required">Gender</label>
                                                <select  class="form-control" name="gender" required>
                                                    <option value="">Select Gender</option>
    <option value="Male" <? echo ($professors->pro_gender == "Male") ? "selected" : "" ?> >Male</option><option value="Female"<? echo ($professors->pro_gender == "Female") ? "selected" : "" ?>>Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 pull-left">
                                            <div class="form-group">
                                                <label class="required">Status</label>
                                                <select  class="form-control" rows="5" cols="30" name="status" required>
                                                    <option value="">Status</option>
                                                    <option value="Active" <? echo ($professors->pro_status == "Active") ? "selected" : "" ?> >Active</option>
                                                    <option value="Inactive"  <? echo ($professors->pro_status == "Inactive") ? "selected" : "" ?>>Inactive</option>
                                                </select>
                                            </div> 
                                        </div>
                                    </div>
                                
                                <?php if(isset($professors->password)){?>
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label class="required">Password</label>
                                        <input type="text" class="form-control" name="password" value="<?php if(isset($professors->password)){ echo $this->institute_login_model->api_key_crypt($professors->password,"d");}?>" required>
                                        <input type="hidden" class="form-control" name="old_password" value="<?php if(isset($professors->password)){ echo $professors->password;}?>" >
                                    </div>
                                </div>
                                <?php }?>
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label class="required">Phone</label>
                                        <input type="text" class="form-control" name="phone" value="<?php if(isset($professors->mobile1)){ echo $professors->mobile1;}?>" maxlength="10" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" required>
                                    </div>
                                </div>
                                    <div class="col-lg-12">
                                        <div class="col-lg-6 pull-left">
                                            <div class="form-group">
                                        <label class="required">Biography</label>
                                        <textarea class="form-control" rows="3" cols="30" name="longdesc" required><?php if(isset($professors->pro_longdesc)){ echo $professors->pro_longdesc;}?></textarea>
                                    </div> 
                                        </div>
                                        <div class="col-lg-6 pull-left">
                                            <div class="form-group">
                                              
                                                <label class="required">Short Description</label>
                                                <textarea class="form-control" rows="1" cols="30" name="shortdesc" required><?php if(isset($professors->pro_shortdesc)){ echo $professors->pro_shortdesc;}?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                <div class="col-lg-12">
                                        <div class="col-lg-6 pull-left">
                                           <!--  <div class="form-group">
                                                <label>Long Description</label>
                                                <textarea class="form-control " rows="3" cols="30" name="longdesc" required><?php if(isset($professors->pro_longdesc)){ echo $professors->pro_longdesc;}?></textarea>
                                            </div> -->
                                        </div>
                                        <div class="col-lg-6 pull-left">
                                            <div class="form-group">
                                                <label>Area of specialization</label>
                                                <textarea type="text" class="form-control summernote" name="expertise" required><?php if(isset($professors->pro_expertise)){ echo $professors->pro_expertise;}?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                
                                <div class="col-lg-12 pull-right">                                    
                                     <button type="submit" class="btn btn-primary pull-right"><?php if($this->uri->segment(4)){echo "Update Professor";}else{ echo "Add Professor";}?></button><br><br><br>
                                        <center><img src="<? echo base_url(); ?>assets/images/load.gif" width="42" height="42" alt="" style="display:none" id="loader"></center>
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