
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
                                <h2>Video Details</h2>
                            </div>
                            <a href="<?php echo base_url("institute/data/video");?>" class="col-lg-1 pull-right"><u>Back</u></a>
                                   
                        </div>
                        <div class="body">
                            <div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
                            <form id="addeditinstitute" enctype="multipart/form-data">
                                <input type="hidden" id="url" name="url" value="<?php echo base_url("institute/data/savevideo/".$this->uri->segment(4));?>">
                                <input type="hidden" id="video_id" name="video_id" value="<?php echo $this->uri->segment(4);?>">
                            <!-- <form id="basic-form" method="post" action="<?php echo base_url("institute/data/savevideo/".$this->uri->segment(4));?>" novalidate>
							
 -->                                
                                    <div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Title</label>
											<input type="text" class="form-control" name="title" value="<?php if(isset($video->title)){ echo $video->title;}?>" required>
										</div>
									</div>
									<div class="col-lg-6">                                  
											<div class="form-group">
											<label>Status</label>
											<select class="form-control" name="status" required>
												<option value="">Select Status</option>
												<option value="Active" <?php if(isset($video->status) && ($video->status=="Active")){ echo "selected";}?>>Active</option>
												<option value="Inactive" <?php if(isset($video->status) && ($video->status=="Inactive")){ echo "selected";}?>>Inactive</option>
											</select>
											</div>
										</div>
										<input type="hidden" name="old_video" value="<?php if(isset($video->url)){ echo $video->url; }?>">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Description</label>
											<textarea class="form-control summernote" name="description"  rows="5" cols="30" required>
												<?php if(isset($video->description)){echo $video->description;}?>
												</textarea>
										</div>                                    
									</div>
                                    <div class="col-lg-6">
									   <div class="form-group"> 
										<label>Upload Video</label><br>
										<input type="file" class="dropify"  data-allowed-file-extensions="mp4 mp3" name="video" <?php if(isset($video->url)){}else{echo "required";} ?>/>
									</div>

									</div>
									
									

									
										<?php if(isset($video->url)){ ?>
									<div class="col-lg-6">
									   <div class="form-group"> 
										<video width="400" controls controlsList="nodownload">
										  <source src="<?php echo base_url().$video->url;?>" type="video/mp4">
										</video>
									</div>
									</div>
									<?php }?>
                                <div class="col-lg-6">
                                    
                                               
                                        <button type="submit" class="btn btn-primary pull-right"><?php if($this->uri->segment(4)){echo "Update Video";}else{ echo "Add Video";}?></button><br><br><br>
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
       e.preventDefault();
      // var fdata = $("#addeditinstitute").serialize();
      var fdata = new FormData(this);
       var url = $('#url').val();
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