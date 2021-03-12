
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
                                <h2>Details</h2>
                            </div>
                            <a href="<?php echo base_url("admin/homepage/news");?>" class="col-lg-1 pull-right"><button class="btn btn-primary">Back</button></a>
                                   
                        </div>
                        <div class="body">
                            <div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
                            <form id="addeditinstitute" enctype="multipart/form-data">
                                <input type="hidden" id="url" name="url" value="<?php echo base_url("admin/homepage/save_news/".$this->uri->segment(4));?>">
                                <input type="hidden" id="news_id" name="news_id" value="<?php echo $this->uri->segment(4);?>">
                            <!-- <form id="basic-form" method="post" action="<?php echo base_url("admin/institutes/save_institute/".$this->uri->segment(4));?>" novalidate>
 -->                                
                                <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="title" value="<?php if(isset($news->title)){ echo $news->title;}?>" required>
                                    </div>

                                </div>
                                <div class="col-lg-4">
                                   
                                    <div class="form-group">
                                    <label>Type</label>
                                    <select class="form-control" name="type" required>
                                        <option value="">Select Type</option>
                                        <option value="news" <?php if(isset($news->type) && ($news->type=="news")){ echo "selected";}?>>News</option>
                                        <option value="event" <?php if(isset($news->type) && ($news->type=="event")){ echo "selected";}?>>Event</option>
                                    </select>
                                    </div>
                                </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                        <label>Category</label>
                                            <select class="form-control" name="category_id" required>
                                                <option value="">Select Category</option>
                                                <?php
                                                    foreach ($necategories as $category) {
                                                ?>
                                                    <option value="<?php echo $category->id;?>" <?php if(isset($news->category_id) && ($news->category_id==$category->id)){ echo "selected";}?>><?php echo $category->category_name;?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Created By</label>
                                        <input type="text" class="form-control" name="createdby" value="<?php if(isset($news->createdby)){ echo $news->createdby;} else { echo $this->session->userdata('admin_name');} ?>" required>
                                    </div>

                                </div>
                                    <div class="col-lg-6">
                                   
                                    <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status" required>
                                        <option value="">Select Status</option>
                                        <option value="Active" <?php if(isset($news->status) && ($news->status=="Active")){ echo "selected";}?>>Active</option>
                                        <option value="Inactive" <?php if(isset($news->status) && ($news->status=="Inactive")){ echo "selected";}?>>Inactive</option>
                                    </select>
                                    </div>
                                </div>
                                    
                                </div>
                                <div class="row">
                                     <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" accept="image/jpeg" class="form-control dropify" id="imurl" name="image" data-allowed-file-extensions="jpg jpeg" data-default-file="<?php if(isset($news->image)){ echo base_url($news->image);}?>">
                                        <input type="hidden" class="form-control" name="old_image" value="<?php if(isset($news->image)){ echo $news->image;}?>" >
                                       
                                    </div>
                                    <small style="color: red">Note: Please upload 620*350px Image</small>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control summernote" rows="5" cols="30" name="text" required><?php if(isset($news->message)){ echo $news->message;}?></textarea>
                                    </div>
                                   <button type="submit" class="btn btn-primary pull-right"><?php if($this->uri->segment(4)){echo "Update";}else{ echo "Add";}?></button><br><br><br>
                                        <center><img src="<? echo base_url(); ?>assets/images/load.gif" width="42" height="42" alt="" style="display:none" id="loader"></center>

                                </div>
                                </div>
                                
  
                            </form>
                        </div>
                    </div>
    </div>
</div>
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

<script type="text/javascript">
    $(document).ready(function(){
  
    $("#addeditinstitute").on('submit', function(e){
		//alert();
       e.preventDefault();
       var formData = new FormData(this);
       var url = $('#url').val();
       $.ajax({
        url:url,
        data:formData,
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
        }
        });
    });

    });
</script>