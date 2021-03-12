
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
                                <h2>Category Details</h2>
                            </div>
                            <a href="<?php echo base_url("admin/categories");?>" class="col-lg-1 pull-right"><button class="btn btn-primary">Back</button></a>
                                   
                        </div>
                        <div class="body">
                            <div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
                            <form id="addeditcategory">
                                <input type="hidden" id="url" name="url" value="<?php echo base_url("admin/categories/save_category/".$this->uri->segment(4));?>">
                                <input type="hidden" id="category_id" name="category_id" value="<?php echo $this->uri->segment(4);?>">
                            <!-- <form id="basic-form" method="post" action="<?php echo base_url("admin/categories/save_category/".$this->uri->segment(4));?>" novalidate> -->
                               
                               <div class="row">
                               
                                <div class="col-lg-4 pull-left">
                                    <div class="form-group">
                                        <label>Category name</label>
                                        <input type="text" class="form-control" name="name" value="<?php if(isset($category->category_name)){ echo $category->category_name;}?>" required>
                                    </div>        

                                </div>
                        		
                                <div class="col-lg-4 pull-left">
                                   
                                    <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" class="form-control" accept="image/*" name="image" <?php if(isset($category->image) && $category->image!=''){ echo '';}else{echo 'required';}?>>
                                    <small style="color: red">Note : Upload 350*240px image & Maximum File size of image should be less than 1MB</small>
                                    <input type="hidden" class="form-control" name="old_image" value="<?php if(isset($category->image)){ echo $category->image;}?>">
                                    </div>
                                </div>
                                
                                <div class="col-lg-4 pull-left">
                                   
                                    <div class="form-group">
                                    <label>Logo Image</label>
                                    <input type="file" class="form-control" accept="image/*" name="logo_image" <?php if(isset($category->logo_image) && $category->logo_image!=''){ echo '';}else{echo 'required';}?>>
                                    <small style="color: red">Note : Upload 25px*25px image</small>
                                    <input type="hidden" class="form-control" name="old_logo_image" value="<?php if(isset($category->logo_image)){ echo $category->logo_image;}?>">
                                    </div>
                                </div>
                                
                                <div class="col-lg-4 pull-left">
                                   
                                    <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status" required>
                                        <option value="">Select Status</option>
                                        <option value="Active" <?php if(isset($category->status) && ($category->status=="Active")){ echo "selected";}?>>Active</option>
                                        <option value="Inactive" <?php if(isset($category->status) && ($category->status=="Inactive")){ echo "selected";}?>>Inactive</option>
                                    </select>
                                    </div>
                                </div>
                                
                                <div class="col-lg-4 pull-left">
                                   
                                    <div class="form-group">
                                    <label>Live Status</label>
                                    <select class="form-control" name="live_status" required>
                                        <option value="">Select Status</option>
                                        <option value="Active" <?php if(isset($category->live_status) && ($category->live_status=="Active")){ echo "selected";}?>>Active</option>
                                        <option value="Inactive" <?php if(isset($category->live_status) && ($category->live_status=="Inactive")){ echo "selected";}?>>Inactive</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                	
                                </div>
                                </div>
                                <div class="row">
									<div class="col-lg-4">
										<label>Image :</label><br>

										<?php
										if(isset($category->image) && $category->image!=''){
										?>
											<img src="<?php echo base_url().$category->image;?>" style="width: 300px; height: 240px; padding: 5px; object-fit: contain; border: 1px solid black">
											<i class="fa fa-times-circle fa-2x" onclick="deleteCat('<?php echo $category->category_id;?>', '<?php echo $category->image;?>')" style="position: absolute;color: red;cursor: pointer;margin-top: 3px; margin-left: -32px;" id="59"></i>
										<?php
										}else{echo "<span style='color:red;'>No Image uploaded.</span>";}
										?>
									</div>
									<div class="col-lg-2" align="left">
										<label>Logo Image : </label><br>
										<?php
										if(isset($category->logo_image) && $category->logo_image!=''){
										?>

											<img src="<?php echo base_url().$category->logo_image;?>" style="width: 60px;padding: 15px; border: 1px solid black">
											<i class="fa fa-times-circle fa-2x" onclick="deleteCatlogo('<?php echo $category->category_id;?>', '<?php echo $category->logo_image;?>')" style="position: absolute;color: red;cursor: pointer;margin-top: 0px; margin-left: -20px;font-size: 22px;" id="59"></i>
										<?php
										}else{echo "<span style='color:red;'>No Image uploaded.</span>";}
										?>
									</div>
								</div>
                                
                                <div class="row">
									<div class="col-lg-6">
										<center><img src="<? echo base_url(); ?>assets/images/load.gif" width="42" height="42" alt="" style="display:none" id="loader"></center>
									</div>
									<div class="col-lg-2" style="margin-top: 25px;">            
											<button type="submit" class="btn btn-primary pull-right"><?php if($this->uri->segment(4)){echo "Update Category";}else{ echo "Add Category";}?></button><br><br><br>

									</div>
                               </div>
  
                            </form>
                        </div>
                    </div>
    </div>
</div>

<script type="text/javascript">
	
	$("#addeditcategory").on('submit', function(e){
       e.preventDefault();
       //var fdata = $("#addeditadvertise").serialize();
       var fdata = new FormData(this);
       var url = $('#url').val();
       // alert(fdata);
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
//  
//    $("#addeditcategory").on('submit', function(e){
//       e.preventDefault();
//       var fdata = $("#addeditcategory").serialize();
//       var url = $('#url').val();
//        //alert(url);
//       $.ajax({
//        url:url,
//        data:fdata,
//        type:"post",
//        dataType:"json",
//        beforeSend: function(){
//          $("#loader").show();
//        },
//        success: function(str){
//            //alert(str);
//          console.log(str);
//          $("#loader").hide();
//          if(str.Status == 'Active'){
//            $("#smsg").show();
//            $("#smsg").html(str.Message);
//            setTimeout(function(){ location.reload(); }, 1000);  
//          }else{
//            $("#emsg").show();
//            $("#emsg").html(str.Message);
//          }
//        }
//        });
//    });
//
function deleteCatlogo(cat_id, file_name){
        toastr.options.timeOut = 1000;
        toastr.options.closeButton = true;
        toastr.options.positionClass = 'toast-top-right';
        $.ajax({
            type : "POST",
            url : "<? echo base_url('admin/categories/deleteCatlogo') ?>",
            data : {cat_id : cat_id, file_name: file_name},
            success : function(data){
                if(data=='success'){
                    toastr.remove();
                    toastr['success']('Image deleted successfully.', '', {
                        positionClass: 'toast-top-right'
                    });
                }
                else{
                    toastr.remove();
                    toastr['error']('Not able to delete the image.', '', {
                        positionClass: 'toast-top-right'
                    });
                }
                setTimeout(function(){ location.reload(); }, 1000); 
            }
        });
    }
	
function deleteCat(cat_id, file_name){
        toastr.options.timeOut = 1000;
        toastr.options.closeButton = true;
        toastr.options.positionClass = 'toast-top-right';
        $.ajax({
            type : "POST",
            url : "<? echo base_url('admin/categories/deleteCat') ?>",
            data : {cat_id : cat_id, file_name: file_name},
            success : function(data){
                if(data=='success'){
                    toastr.remove();
                    toastr['success']('Image deleted successfully.', '', {
                        positionClass: 'toast-top-right'
                    });
                }
                else{
                    toastr.remove();
                    toastr['error']('Not able to delete the image.', '', {
                        positionClass: 'toast-top-right'
                    });
                }
                setTimeout(function(){ location.reload(); }, 1000); 
            }
        });
    }	
</script>