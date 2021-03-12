
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
                                <h2>Admin Details</h2>
                            </div>
                                  
                        </div>
                        <div class="body">
                            <div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
                                <form id="updateAdminDetails" enctype="multipart/form-data">
                            <!-- <form id="basic-form" method="post" action="<?php echo base_url("admin/settings/update")?>" novalidate> -->
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Full name</label>
                                        <input type="text" class="form-control" name="name" value="<?php if(isset($admin->name)){ echo $admin->name;}?>" required>
                                    </div>
                           
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" value="<?php if(isset($admin->email)){ echo $admin->email;}?>" required>
                                    </div>
                                   
                                </div>
                        
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Mobile</label>
                                        <input type="text" class="form-control" name="mobile"  maxlength="10" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" value="<?php if(isset($admin->mobile)){ echo $admin->mobile;}?>"required>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="text" class="form-control" name="password" value="<?php if(isset($admin->password)){ echo $this->login_model->api_key_crypt($admin->password,"d");}?>" required>
                                        <input type="hidden" class="form-control" name="old_password" value="<?php if(isset($admin->password)){ echo $admin->password;}?>" >
                                    </div>
                                </div>
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Terms and Conditions</label>
                                        <textarea class="form-control summernote" name="termsandconditions"  rows="5" cols="30" required><?php if(isset($admin->website_termsandconditions)){echo $admin->website_termsandconditions;}?></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Privacy Policy</label>
                                        <textarea class="form-control summernote" name="privacypolicy"  rows="5" cols="30" required><?php if(isset($admin->website_privacypolicy)){echo $admin->website_privacypolicy;}?></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Cancellation & Return Policy</label>
                                        <textarea class="form-control summernote" name="cancellation"  rows="5" cols="30" required><?php if(isset($admin->website_cancellation)){echo $admin->website_cancellation;}?></textarea>
                                    </div>
                                </div>
                               
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label style="margin-top: 25px;">Main Chat Box</label>
                                        <div class="item" style="margin-top: -22px;">
                                            <input class="form-control" type="checkbox" name="mainchatbox" <?php if($admin->website_main_chat_box==1){echo 'checked';}?>>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Logo</label>
                                        <input type="file" class="form-control" name="logo">
                                        <input type="hidden" class="form-control" name="old_logo" value="<? echo $admin->logo ?>">
                                    </div>
                                    <div class="form-group">
                                        
                                        <img src="<? echo base_url().$admin->logo ?>" width="50%">
                                    </div>
                                    <div class="form-group">
                                        <label>Admission Year</label>
                                        <input type="text" class="form-control" name="admission" value="<?php if(isset($admin->admisssion_year)){ echo $admin->admisssion_year;}?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Copy Right</label>
                                        <input type="text" class="form-control" name="copyright" value="<?php if(isset($admin->copy_right)){ echo $admin->copy_right;}?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Disclaimer</label>
                                        <textarea class="form-control summernote" name="disclaimer"  rows="5" cols="30" required><?php if(isset($admin->disclaimer)){echo $admin->disclaimer;}?></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 pull-left">
                                    <button type="submit" class="btn btn-primary pull-right">Update Details</button><br><br><br>
                                   <center><img src="<? echo base_url(); ?>assets/images/load.gif" width="42" height="42" alt="" style="display:none" id="loader"></center>
                                </div>
                            </form>
                        </div>
                    </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
    //Login Service
    $("#updateAdminDetails").on('submit', function(e){
       e.preventDefault();
       var fdata = new FormData(this);
       var url = '<?php echo base_url("admin/settings/update") ?>';
        //alert(fdata);
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
          console.log(str);
          $("#loader").hide();
          if(str.Status == 'Active'){
            $("#smsg").show();
            $("#smsg").html(str.Message);
            setTimeout(function(){ $("#smsg").hide(); location.reload(); }, 500);
          }else{
            $("#emsg").show();
            $("#emsg").html(str.Message);
          }
        }
        });
    });
//Login Service Closed
    });
</script>