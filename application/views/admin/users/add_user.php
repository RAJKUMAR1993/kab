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
                                <h2>User Details</h2>
                            </div>
                            <div class="col-lg-1 pull-right">
                                <a href="<?php echo base_url("admin/users");?>" class="btn btn-info">Back</a>
                            </div>
                                   
                        </div>
                        <div class="body">
                            <div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
                            <form id="addeditwebinor">
                                <input type="hidden" id="url" name="url" value="<?php echo base_url("admin/users/save_user/".$this->uri->segment(4));?>">
                                <input type="hidden" id="user_id" name="user_id" value="<?php echo $this->uri->segment(4);?>">
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>User Name <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" name="user_name" value="<?php if(isset($user->user_name)){ echo $user->user_name;}?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email <span style="color: red;">*</span></label>
                                        <input type="email" class="form-control" name="email" value="<?php if(isset($user->email)){ echo $user->email;}?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Mobile Number <span style="color: red;">*</span></label>
                                        <input class="form-control" type="text" name="mobile_no" value="<?php if(isset($user->mobile_no)){ echo $user->mobile_no;}?>" minlength="10" maxlength="10" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Status <span style="color: red;">*</span></label>
                                        <select class="form-control" name="status" required>
                                            <option value="">Select Status</option>
                                            <option <?php if($user->status=='Active'){echo 'selected';}?> value="Active">Active</option>
                                            <option <?php if($user->status=='Inactive'){echo 'selected';}?> value="Inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Password <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" name="password" value="<?php if(isset($user->password)){ echo $this->login_model->api_key_crypt($user->password,"d");}?>" required>
                                        <input type="hidden" class="form-control" name="old_password" value="<?php if(isset($user->password)){ echo $user->password;}?>" >
                                    </div>
                                </div>
                                <div class="col-lg-12 pull-right">
                                    <div class="form-group">
                                        <label><b>Admin Menu Permissions</b> <span style="color: red;">*</span></label>
                                        <?php
                                        $selected_menu = array();
                                        if(isset($user->menu_permissions)){
                                            $selected_menu = explode(',', $user->menu_permissions);
                                        }
                                        foreach ($adminmenu as $m) {
                                        ?>
                                        <div class="item">
                                            <input class="form-control" type="checkbox" name="menustatus[<?php echo $m->slug;?>]" <?php if($m->status==1 || in_array($m->slug, $selected_menu)){ echo "checked";}?>> <span class="item-name"><?php echo $m->menu_name;?></span>
                                            <hr>
                                        </div>
                                        <?php
                                        } 
                                        ?>
                                    </div>
                                </div>
                                <div class="col-lg-12 pull-right">                                    
                                     <button type="submit" class="btn btn-primary pull-right"><?php if($this->uri->segment(4)){echo "Update User";}else{ echo "Add User";}?></button><br><br><br>
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
        $("#addeditwebinor").on('submit', function(e){
           e.preventDefault();
           var fdata = $("#addeditwebinor").serialize();
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