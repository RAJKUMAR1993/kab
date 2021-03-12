
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
                                <h2>Change Password</h2>
                            </div>
                            <!-- <a href="<?php echo base_url("admin/institutes");?>" class="col-lg-1 pull-right"><u>Back</u></a> -->
                                   
                        </div>
                        <div class="body">
                            <div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
                            <form id="instituteUpdateDetails" enctype="multipart/form-data">
                            <!-- <form id="basic-form" method="post" action="<?php echo base_url("institute/settings/update")?>" enctype="multipart/form-data" novalidate> -->
							  
								<div class="row clearfix">
                                    
									<div class="col-lg-6">
                                        <div class="form-group">
											<label>Old Password</label>
											<input type="text" class="form-control" name="oldpassword" value="<?php if(isset($admin->password)){ echo $this->institute_login_model->api_key_crypt($admin->password,"d");}?>" required>
											<input type="hidden" class="form-control" name="old_password" value="<?php if(isset($admin->password)){ echo $admin->password;}?>" >
										</div>	
                                    </div>
									<div class="col-lg-6">
                                        <div class="form-group">
											<label>New Password</label>
											<input type="text" class="form-control" name="password"  required>
											
											<input type="hidden" class="form-control" name="old_password" value="<?php if(isset($admin->password)){ echo $admin->password;}?>" >
										</div>	
                                    </div>
								</div>
								
                                 
                                 <button type="submit" class="btn btn-primary pull-right">Update</button>
                                 <center><img src="<? echo base_url(); ?>assets/images/load.gif" width="42" height="42" alt="" style="display:none" id="loader"></center>
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
<script>
function myFunction() {
  var x = document.getElementById("mySelect").value;
  //alert(x);
  if(x==2){
    $('#cctype').show();
    $('#overseascountry').hide();
  } else if(x==3){
    $('#cctype').hide();
    $('#overseascountry').show();
  } else {
    $('#cctype').hide();
    $('#overseascountry').hide();
  }
}
</script>
<script type="text/javascript">
    $(document).ready(function(){
  
    $("#instituteUpdateDetails").on('submit', function(e){
       e.preventDefault();
       var fdata = new FormData(this);
       var url = '<?php echo base_url("institute/settings/update_password") ?>';
        //alert(fdata);
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
          console.log(str);
          $("#loader").hide();
          if(str.Status == 'Active'){
            $("#smsg").show();
            $("#smsg").html(str.Message);
            setTimeout(function(){ $("#smsg").hide(); location.reload(); }, 500);
          }else{
            $("#emsg").show();
            $("#emsg").html(str.Message);
          }
        }
        });
    });

    });
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
