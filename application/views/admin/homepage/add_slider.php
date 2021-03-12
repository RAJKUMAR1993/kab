
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
                                <h2>Slider Details</h2>
                            </div>
                            <a href="<?php echo base_url("admin/homepage/slider");?>" class="col-lg-1 pull-right"><u>Back</u></a>
                                   
                        </div>
                        <div class="body">
                            <div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
                            <form id="addeditinstitute" enctype="multipart/form-data">
                                <input type="hidden" id="url" name="url" value="<?php echo base_url("admin/homepage/save_slider/".$this->uri->segment(4));?>">
                                <input type="hidden" id="slider_id" name="slider_id" value="<?php echo $this->uri->segment(4);?>">
                            <!-- <form id="basic-form" method="post" action="<?php echo base_url("admin/institutes/save_institute/".$this->uri->segment(4));?>" novalidate>
 -->                                <div class="col-lg-6 pull-left">
                                     <?php if($this->uri->segment(4)){ ?>
										 <img src="<?php echo base_url();?>assets/images/homepage/<?php echo $slider->image; ?>" width="200px" height="100px">
									 <?php } ?>
									 
                                    <div class="form-group">
									    <br>
                                        <label>Image</label>
                                        <input type="file" class="form-control" name="picture"  <?php if($this->uri->segment(4)){ }else{ echo "required"; } ?>>
										<?php if($this->uri->segment(4)){ ?>
										<input type="hidden" value="<?php echo $slider->image; ?>" name="image" >
										<?php } ?>
                                    </div>
                                </div>

                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Text</label>
                                        <textarea class="form-control summernote" rows="5" cols="30" name="text" required><?php if(isset($slider->text)){ echo $slider->text;}?></textarea>
                                    </div>
                                   

                                </div>
                                
                                <div class="col-lg-6 pull-left">
                                </div>
                                <div class="col-lg-6 pull-left">
                                                 
                                        <button type="submit" class="btn btn-primary pull-right"><?php if($this->uri->segment(4)){echo "Update Slider";}else{ echo "Add Slider";}?></button><br><br><br>
                                        <center><img src="<? echo base_url(); ?>assets/images/load.gif" width="42" height="42" alt="" style="display:none" id="loader"></center>
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