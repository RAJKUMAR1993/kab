
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
                                <h2>Conatcts Details</h2>
                            </div>
                            <?php //echo "<pre>";	print_r($data['contact']);die; ?>
                        </div>
                        <div class="body">
                            <div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
                            <form id="addeditinstitute" enctype="multipart/form-data">
                                <input type="hidden" id="url" name="url" value="<?php echo base_url("admin/homepage/updatecontact"); ?>">
                                
                                <div class="col-lg-6">
                                <div class="form-group">
                                        <label>Mobile Number</label>
                                        <input type="text" class="form-control" name="mobile_number" value="<?php echo $contact->mobile_number;?>">
                                    </div>

                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="email" value="<?php  echo $contact->email;?>">
                                        
                                    </div>
                                    <div class="form-group">
                                        <label>Website Link</label>
                                        <input type="text" class="form-control" name="websitelink" value="<?php  echo $contact->website_link;?>">
                                        
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
	alert();
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