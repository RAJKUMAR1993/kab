
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
                                <h2>Content Details</h2>
                            </div>
                            <a href="<?php echo base_url("institute/data/content");?>" class="col-lg-1 pull-right"><u>Back</u></a>
                                   
                        </div>
                        <div class="body">
                            <div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
                            <form id="addeditcontent">
                                <input type="hidden" id="url" name="url" value="<?php echo base_url("institute/data/savecontent/".$this->uri->segment(4));?>">
                                <input type="hidden" id="content_id" name="content_id" value="<?php echo $this->uri->segment(4);?>">
                            <!-- <form id="basic-form" method="post" action="<?php echo base_url("institute/data/savecontent/".$this->uri->segment(4));?>" novalidate>
 -->                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="title" value="<?php if(isset($content->title)){ echo $content->title;}?>" required>
                                    </div>
                                    
                                   

                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control summernote" name="description"  rows="5" cols="30" required>
                                            <?php if(isset($content->description)){echo $content->description;}?>
                                            </textarea>
                                    </div>                                    
                                </div>

                              <div class="col-lg-6">
                                   
                                    <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status" required="required">
                                        <option value="">Select Status</option>
                                        <option value="Active" <?php if(isset($content->status) && ($content->status=="Active")){ echo "selected";}?>>Active</option>
                                        <option value="Inactive" <?php if(isset($content->status) && ($content->status=="Inactive")){ echo "selected";}?>>Inactive</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    
                                               
                                        <button type="submit" class="btn btn-primary pull-right"><?php if($this->uri->segment(4)){echo "Update Content";}else{ echo "Add Content";}?></button><br><br><br>
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
  
    $("#addeditcontent").on('submit', function(e){
       e.preventDefault();
       var fdata = $("#addeditcontent").serialize();
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
            //setTimeout(function(){ location.reload(); }, 1000);  
          }else{
            $("#emsg").show();
            $("#emsg").html(str.Message);
          }
        }
        });
    });

    });
</script>