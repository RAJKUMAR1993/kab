
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
                                <h2>Advertise Details</h2>
                            </div>
                            <a href="<?php echo base_url("admin/avertise");?>" class="col-lg-1 pull-right"><button class="btn btn-primary">Back</button></a>
                                   
                        </div>
                        <div class="body">
                            <div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
                            <form id="addeditadvertise" enctype="multipart/form-data">
                                <input type="hidden" id="url" name="url" value="<?php echo base_url("admin/avertise/saveavertise/".$this->uri->segment(4));?>">
                                <input type="hidden" id="id" name="id" value="<?php echo $this->uri->segment(4);?>">
                            <!-- <form id="basic-form" method="post" action="<?php echo base_url("admin/advertise/saveadvertise/".$this->uri->segment(4));?>" novalidate>
 -->                                
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="title" value="<?php if(isset($advertise->title)){ echo $advertise->title;}?>" required>
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                   
                                    <div class="form-group">
                                    <label>Type</label>
                                    <select class="form-control" name="type" id="advtype" required onchange="changetype()">
                                        <option value="">Select Type</option>
                                        <option value="image" <?php if(isset($advertise->type) && ($advertise->type=="image")){ echo "selected";}?>>Image</option>
                                        <option value="iframe" <?php if(isset($advertise->type) && ($advertise->type=="iframe")){ echo "selected";}?>>Iframe</option>
                                    </select>
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                      <div class="col-lg-6">
                                   
                                    <div class="form-group">
                                    <label>Target</label>
                                    <select class="form-control" name="target" required>
                                        <option value="">Select Target</option>
                                        <option value="_blank" <?php if(isset($advertise->target) && ($advertise->target=="_blank")){ echo "selected";}?>>Blank</option>
                                        <option value="_self" <?php if(isset($advertise->target) && ($advertise->target=="_self")){ echo "selected";}?>>Self</option>
                                    </select>
                                    </div>
                                </div>
                                      <div class="col-lg-6">
                                   
                                    <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status" required>
                                        <option value="">Select Status</option>
                                        <option value="Active" <?php if(isset($advertise->status) && ($advertise->status=="Active")){ echo "selected";}?>>Active</option>
                                        <option value="Inactive" <?php if(isset($advertise->status) && ($advertise->status=="Inactive")){ echo "selected";}?>>Inactive</option>
                                    </select>
                                    </div>
                                </div>
                                </div>
                                <div class="row" id="iframeurl" <? if($this->uri->segment(4)==""){ echo "style='display:none;'";  }?><?php if(isset($advertise->type) && ($advertise->type=="image")){ echo "style='display:none;'";  } ?>>
                                    <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Iframe URL</label>
                                        <input type="text" class="form-control" id="ifurl" name="iframe_url" value="<?php if(isset($advertise->iframe_url)){ echo $advertise->iframe_url;}?>">
                                        
                                    </div>
                                </div>
                            </div>
                                <div class="row" id="imageurl" <? if($this->uri->segment(4)==""){ echo "style='display:none;'";  }?> <?php if(isset($advertise->type) && ($advertise->type=="iframe")){ echo "style='display:none;'"; } ?> >
                                    
                                    <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" class="form-control dropify" id="imurl" name="image" data-allowed-file-extensions="jpg jpeg png" data-default-file="<?php if(isset($advertise->image)){ echo base_url($advertise->image);}?>">
                                        <input type="hidden" class="form-control" name="old_image" value="<?php if(isset($advertise->image)){ echo $advertise->image;}?>" >
                                        	
                                        <small style="color: red">Note : Please upload 1870*300px Images</small>	
                                       
                                    </div>
                                </div>
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Navigate URL</label>
                                        <input type="text" class="form-control" name="navigation_link" id="inurl" value="<?php if(isset($advertise->navigation_link)){ echo $advertise->navigation_link;}?>">
                                        
                                    </div>
                                </div>
                                </div>
                               
                         
                                <div class="col-lg-12 pull-right">
                                    
                                               
                                        <button type="submit" class="btn btn-primary pull-right"><?php if($this->uri->segment(4)){echo "Update Advertise";}else{ echo "Add Advertise";}?></button><br><br><br>
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

<script>

function changetype() {
  var x = document.getElementById("advtype").value;
  $('#imageurl').hide();
    $('#iframeurl').hide();
  if(x=="image"){
    $('#imageurl').show();
    $('#iframeurl').hide();
    $("#imurl").prop('required',true);
    $("#inurl").prop('required',true);
  } else if(x=="iframe"){
    $('#imageurl').hide();
    $('#iframeurl').show();   
    $("#ifurl").prop('required',true);
  } else {
    $('#imageurl').hide();
    $('#iframeurl').hide();
  }
}
</script>


<script type="text/javascript">
    $(document).ready(function(){
  
    $("#addeditadvertise").on('submit', function(e){
       e.preventDefault();
       //var fdata = $("#addeditadvertise").serialize();
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
        },
		   error:function(data){
			   console.log(data);
		   }
        });
    });

    });
</script>