
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
                                <h2>Institute Details</h2>
                            </div>
                            <a href="<?php echo base_url("admin/institutes");?>" class="col-lg-1 pull-right"><button class="btn btn-primary">Back</button></a>
                                   
                        </div>
                        <div class="body">
                            <div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
                            <form id="addeditinstitute">
                                <input type="hidden" id="url" name="url" value="<?php echo base_url("admin/institutes/save_institute/".$this->uri->segment(4));?>">
                                <input type="hidden" id="institute_id" name="institute_id" value="<?php echo $this->uri->segment(4);?>">
                            <!-- <form id="basic-form" method="post" action="<?php echo base_url("admin/institutes/save_institute/".$this->uri->segment(4));?>" novalidate>
 -->                           
                           <div class="row">   
                                        
                               <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Institute name</label>
                                        <input type="text" class="form-control" name="name" value="<?php if(isset($institute->institute_name)){ echo $institute->institute_name;}?>" required>
                                    </div>
                               </div>     
                                 
                               <div class="col-lg-6 pull-left">        
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" value="<?php if(isset($institute->email)){ echo $institute->email;}?>" required>
                                    </div>
                                   

                                </div>

                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Contact Person Name</label>
                                        <input type="text" class="form-control" name="fullname" value="<?php if(isset($institute->full_name)){ echo $institute->full_name;}?>" required>
                                    </div>
                                </div>     
                                 
                               <div class="col-lg-6 pull-left">    
                                    
                                    <div class="form-group">
                                        <label>Designation</label>
                                        <input type="text" class="form-control" name="designation" value="<?php if(isset($institute->designation)){ echo $institute->designation;}?>" required>
                                    </div>
                                   

                                </div>
                        
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control"  maxlength="10" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" name="phone" value="<?php if(isset($institute->phone)){ echo $institute->phone;}?>" required>
                                    </div>
                                    
                                </div>     
                                 
                               <div class="col-lg-6 pull-left">    
                                    <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status" required>
                                        <option value="">Select Status</option>
                                        <option value="Active" <?php if(isset($institute->status) && ($institute->status=="Active")){ echo "selected";}?>>Active</option>
                                        <option value="Inactive" <?php if(isset($institute->status) && ($institute->status=="Inactive")){ echo "selected";}?>>Inactive</option>
                                    </select>
                                    </div>
                                </div>
                            
                            <?php if(isset($institute->password)){?>        
                                
                                <div class="col-lg-6 pull-left">
                                    
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="text" class="form-control" name="password" value="<?php if(isset($institute->password)){ echo $this->institute_login_model->api_key_crypt($institute->password,"d");}?>" required>
                                        <input type="hidden" class="form-control" name="old_password" value="<?php if(isset($institute->password)){ echo $institute->password;}?>" >
                                    </div>
                                    
                               </div>     
                                 
                            <?php }?>    
                                  
                               <div class="col-lg-6 pull-left">     

                                    <div class="form-group">
                                        <label>Live Status</label>
                                        <select class="form-control" name="live_status" required>
                                            <option value="">Select One</option>
                                            <option value="1" <?php if(isset($institute->live_status) && ($institute->live_status=="1")){ echo "selected";}?>>On</option>
                                            <option value="0" <?php if(isset($institute->live_status) && ($institute->live_status=="0")){ echo "selected";}?>>Off</option>
                                        </select>
                                    </div> 
                                </div>
                                
                                <div class="col-lg-6 pull-left">     

                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="form-control" name="category" required>
                                            <option value="">Select Category</option>
                                            <option value="a" <?php if(isset($institute->category) && ($institute->category=="a")){ echo "selected";}?>>Category A</option>
                                            <option value="b" <?php if(isset($institute->category) && ($institute->category=="b")){ echo "selected";}?>>Category B</option>
                                            <option value="c" <?php if(isset($institute->category) && ($institute->category=="c")){ echo "selected";}?>>Category C</option>
                                        </select>
                                    </div> 
                                </div>
                          
                          <? if($institute){ ?>            
                                
                                <div class="col-lg-6 pull-left">     

                                    <div class="form-group">
                                        <label>Additional Package Status</label>
                                        <select class="form-control" name="add_package_status" id="add_package_status" required>
                                            <option value="">Select Status</option>
                                            <option value="Active" <?php if(isset($institute->add_package_status) && ($institute->add_package_status=="Active")){ echo "selected";}?>>Active</option>
                                            <option value="Inactive" <?php if(isset($institute->add_package_status) && ($institute->add_package_status=="Inactive")){ echo "selected";}?>>Inactive</option>
                                        </select>
                                    </div> 
                                </div>
                                
                                <div class="col-lg-4 pull-left counts" style="display: <? echo ($institute->add_package_status=="Active") ? 'block' : 'none'; ?>">
                                    
                                    <div class="form-group">
                                        <label>Additional Councellors Count</label>
                                        <input type="number" class="form-control" name="councellor_count" value="<?php if(isset($institute->additional_package_count)){ echo json_decode($institute->additional_package_count)->coucellors;}?>">
                                    </div>
                                    
                               </div>
                               
                               <div class="col-lg-4 pull-left counts" style="display:  <? echo ($institute->add_package_status=="Active") ? 'block' : 'none'; ?>">
                                    
                                    <div class="form-group">
                                        <label>Additional Helpline Numbers Count</label>
                                        <input type="number" class="form-control" name="virtual_contact_count" value="<?php if(isset($institute->additional_package_count)){ echo json_decode($institute->additional_package_count)->phone;}?>">
                                    </div>
                                    
                               </div>
                               
                               <div class="col-lg-4 pull-left counts12" style="display:none;">
                                    
                                    <div class="form-group">
                                        <label>Additional Virtual Conference Links Count</label>
                                        <input type="number" class="form-control" name="virtual_link_count" value="<?php if(isset($institute->additional_package_count)){ echo json_decode($institute->additional_package_count)->video;}?>">
                                    </div>
                                    
                               </div>
                               
                               <div class="col-lg-4 pull-left counts" style="display:  <? echo ($institute->add_package_status=="Active") ? 'block' : 'none'; ?>">
                                    
                                    <div class="form-group">
                                        <label>Additional Presentation Time (In minutes)</label>
                                        <input type="number" class="form-control" name="presentation_time" value="<?php if(isset($institute->additional_package_count)){ echo json_decode($institute->additional_package_count)->presentation_time;}?>">
                                    </div>
                                    
                               </div>
                                
                          <? } ?>      
                                
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea class="form-control" rows="5" cols="30" name="address" required><?php if(isset($institute->address)){ echo $institute->address;}?></textarea>
                                    </div>             
                                        
                                </div>
                                
                                
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                    <label>Website URL</label>
                                    <input type="text" class="form-control" name="website" value="<?php if(isset($institute->website)){ echo $institute->website;}?>" required>
                                    </div>
                                </div>

                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                    <label>Tawk Chat URL</label>
                                    <input type="text" class="form-control" name="chat_url" value="<?php if(isset($institute->chat_url)){ echo $institute->chat_url;}?>">
                                    </div>
                                </div>
                                
                                <div class="col-lg-12 pull-right">
                                    <button type="submit" class="btn btn-primary pull-right"><?php if($this->uri->segment(4)){echo "Update Institute";}else{ echo "Add Institute";}?></button><br><br><br>
                                        <center><img src="<? echo base_url(); ?>assets/images/load.gif" width="42" height="42" alt="" style="display:none" id="loader"></center>
                                </div>
  
                            </form>
                        </div>
                    </div>
    </div>
</div>


<script type="text/javascript">
	
	$("#add_package_status").change(function(){
		
		var val = $(this).val();
		
		if(val == "Active"){
			
			$(".counts").show();
			
		}else{
			
			$(".counts").hide();
			
		}
		
	})
	
    $(document).ready(function(){
  
    $("#addeditinstitute").on('submit', function(e){
       e.preventDefault();
       var fdata = $("#addeditinstitute").serialize();
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
        },
		   error:function(data){
			   console.log(data)
		   }
        });
    });

    });
</script>