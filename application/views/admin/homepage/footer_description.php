
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
                                <h2>KAB VIRTUAL EDUCATION FAIR-2020</h2>
                            </div>
                                   
                        </div>
                        <div class="body">
                            <div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
                            <form id="addeditinstitute" enctype="multipart/form-data">
                                <input type="hidden" id="url" name="url" value="<?php echo base_url("admin/homepage/updatedec"); ?>">
                                
                                <div class="col-lg-6">
                                <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="title" value="<?php if(isset($foot_dec->title)){ echo $foot_dec->title;}?>">
                                    </div>

                                    <div class="form-group">
                                        <label>Description</label><?php //echo $foot_dec->description ?>
                                        <input type="text" class="form-control" name="description" value="<?php if(isset($foot_dec->description)){ echo $foot_dec->description;}?>">

                                        <!-- <textarea class="form-control " rows="5"  name="description" value="<?php  //echo $foot_dec->description;?>"></textarea> -->

                                        
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                   
                                   <button type="submit" class="btn btn-primary pull-right">Update</button><br><br><br>
                                        <center><img src="<? echo base_url(); ?>assets/images/load.gif" width="42" height="42" alt="" style="display:none" id="loader"></center>
                                </div>   
                            </form>    
                        </div>
                    </div>
    </div>
</div>
<script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
<script>
                        CKEDITOR.replace( 'ckeditor' );
                </script>
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
        },
        error: function(str){
            //alert(str);
          console.log(str);
          
        },
        });
    });

     });
</script>