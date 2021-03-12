
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
                                <h2>Browse Institutes</h2>
                            </div>
                            <!-- <a href="<?php echo base_url("admin/institutes");?>" class="col-lg-1 pull-right"><u>Back</u></a> -->
                                   
                        </div>
                        <div class="body">

                            <form id="basic-form" method="post" action="<?php echo base_url("institute/settings/update")?>" enctype="multipart/form-data" novalidate>
                                <div class="col-lg-8 pull-left">
                                    <div class="form-group">
                                        <label>search</label>
                                        <input type="text" class="form-control" name="name" required>
                                    </div>
                           
                                   <!--  <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" value="<?php if(isset($admin->email)){ echo $admin->email;}?>" required>
                                    </div>
                                    -->
                                </div>
                        
                                <!-- <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Mobile</label>
                                        <input type="number" class="form-control" name="mobile" value="<?php if(isset($admin->phone)){ echo $admin->phone;}?>"required>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="text" class="form-control" name="password" value="<?php if(isset($admin->password)){ echo $this->login_model->api_key_crypt($admin->password,"d");}?>" required>
                                        <input type="hidden" class="form-control" name="old_password" value="<?php if(isset($admin->password)){ echo $admin->password;}?>" >
                                    </div>
                                   
                                </div>

                                 <div class="col-lg-6 pull-left">
                                    
                                    
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea class="form-control" name="address" required><?php if(isset($admin->address)){ echo $admin->address;}?></textarea>
                                        
                                    </div>
                                                                      
                                 </div>

                                 <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Company Logo</label>
                                        <input type="file" class="form-control dropify" name="logo" data-allowed-file-extensions="jpg jpeg png" data-default-file="<?php echo base_url($admin->logo)?>">
                                        <input type="hidden" class="form-control" name="old_logo" value="<?php if(isset($admin->logo)){ echo $admin->logo;}?>" >
                                    </div>
                                </div>
 -->
<div class="col-lg-4">
   <button type="submit" class="btn btn-primary pull-right">Search</button><br><br><br> 
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