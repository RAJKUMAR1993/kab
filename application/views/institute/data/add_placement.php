
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
                            <div class="col-lg-9">
                                <h2>Placement Details</h2>
                            </div>
                            <a href="<?php echo base_url("institute/data/placement");?>" class="col-lg-1 pull-right"><u>Back</u></a>
                                   
                        </div>
                        <div class="body">
                            <div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
                            <form id="addeditplacement" enctype="multipart/form-data">
                                <input type="hidden" id="url" name="url" value="<?php echo base_url("institute/data/saveplacement/".$this->uri->segment(4));?>">
                                <input type="hidden" id="placement_id" name="placement_id" value="<?php echo $this->uri->segment(4);?>">
                            <!-- <form id="basic-form" method="post" action="<?php echo base_url("institute/data/saveplacement/".$this->uri->segment(4));?>" novalidate> -->  
                                <div class="row">
                            <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Company</label>
                                        <input type="text" class="form-control" name="company" value="<?php if(isset($placement->company)){ echo $placement->company;}?>" required>
                                    </div>
                                </div>  
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Website</label>
                                        <input type="text" class="form-control" name="website" value="<?php if(isset($placement->website)){ echo $placement->website;}?>" required>
                                    </div>
                                </div> 
                                </div>  
                                <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea class="form-control" name="address"  rows="1" cols="30" required>
                                            <?php if(isset($placement->address)){echo $placement->address;}?>
                                            </textarea>
                                    </div>                                    
                                </div>                      
                             <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Job Title</label>
                                        <input type="text" class="form-control" name="title" value="<?php if(isset($placement->title)){ echo $placement->title;}?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" value="<?php if(isset($placement->email)){ echo $placement->email;}?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Mobile</label>
                                        <input type="text" class="form-control" name="mobile" value="<?php if(isset($placement->mobile)){ echo $placement->mobile;}?>" maxlength="10" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Location</label>
                                        <input type="text" class="form-control" name="location" value="<?php if(isset($placement->location)){ echo $placement->location;}?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Recruitment Date</label>
                                        <input type="date" class="form-control" name="recruitmentdate" value="<?php if(isset($placement->recruitmentdate)){ echo $placement->recruitmentdate;}?>" required>
                                    </div>
                                </div>
                            </div>
                                <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Recruitment Time</label>
                                        <input type="time" class="form-control" name="recruitmenttime" value="<?php if(isset($placement->recruitmenttime)){ echo $placement->recruitmenttime;}?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Recruiter Name</label>
                                        <input type="text" class="form-control" name="recruitmentname" value="<?php if(isset($placement->recruitmentname)){ echo $placement->recruitmentname;}?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Available Positions</label>
                                        <input type="number" class="form-control" name="availposition" value="<?php if(isset($placement->availposition)){ echo $placement->availposition;}?>" required>
                                    </div>
                                </div>

                            <div class="col-lg-6">
                                   
                                    <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status" required="required">
                                        <option value="">Select Status</option>
                                        <option value="Active" <?php if(isset($placement->status) && ($placement->status=="Active")){ echo "selected";}?>>Active</option>
                                        <option value="Inactive" <?php if(isset($placement->status) && ($placement->status=="Inactive")){ echo "selected";}?>>Inactive</option>
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control summernote" name="description"  rows="5" cols="30" required>
                                            <?php if(isset($placement->description)){echo $placement->description;}?>
                                            </textarea>
                                    </div>                                    
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Company Logo</label>
                                        <input type="file" class="form-control dropify" name="clogo" data-allowed-file-extensions="jpg jpeg png" data-default-file="<?php if(isset($placement->url)){ echo base_url($placement->url); } ?>">
                                        <input type="hidden" class="form-control" name="old_clogo" value="<?php if(isset($placement->url)){ echo $placement->url;}?>" >
                                    </div>
                                </div>
                                
</div>
<div class="row">
                                <div class="col-lg-12">
                                    
                                               
                                        <button type="submit" class="btn btn-primary pull-right"><?php if($this->uri->segment(4)){echo "Update Placement";}else{ echo "Add Placement";}?></button><br><br><br>
                                        <center><img src="<? echo base_url(); ?>assets/images/load.gif" width="42" height="42" alt="" style="display:none" id="loader"></center>

                            <div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
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
  
    $("#addeditplacement").on('submit', function(e){
       e.preventDefault();
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