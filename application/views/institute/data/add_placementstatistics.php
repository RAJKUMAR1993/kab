
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
                                <h2>Placement Statistics Details</h2>
                            </div>
                            <a href="<?php echo base_url("institute/data/placementstatistics");?>" class="col-lg-1 pull-right"><u>Back</u></a>
                                   
                        </div>
                        <div class="body">
                            <div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
                            <form id="addeditplacementstatistics">
                                <input type="hidden" id="url" name="url" value="<?php echo base_url("institute/data/saveplacementstatistics/".$this->uri->segment(4));?>">
                                <input type="hidden" id="ps_id" name="ps_id" value="<?php echo $this->uri->segment(4);?>">
                                  <div class="row">
                                   <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Company Name</label>
                                        <input type="text" class="form-control" name="companyname" value="<?php if(isset($placementstatistics->companyname)){ echo $placementstatistics->companyname;}?>" required>
                                    </div>

                                </div>
                                

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>No'of Students Placed</label>
                                        <input type="number" class="form-control" name="nostudentplaced" min="1" value="<?php if(isset($placementstatistics->nostudentplaced)){ echo $placementstatistics->nostudentplaced;}?>" required>
                                    </div>                                   
                                </div>
                            </div>
<div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Highest Salary</label>
                                        <input type="text" class="form-control" name="salaryannum" value="<?php if(isset($placementstatistics->salaryannum)){ echo $placementstatistics->salaryannum;}?>" required>
                                    </div>                                   
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Academic Year</label>
                                        <input type="text" class="form-control" name="year" value="<?php if(isset($placementstatistics->year)){ echo $placementstatistics->year;}?>" required>
                                        
                                    </div>
                                </div>
								<div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Company Logo</label>
                                        <input type="file" class="form-control" name="companylogo" <? ($placementstatistics->company_logo != "") ? '' : 'required' ?>>
                                        <input type="hidden" name="oldlogo" value="<? echo $placementstatistics->company_logo ?>">
                                        <small style="color: red">Note :Please upload 150*100px & Maximum size of image should be less than 100KB</small>
                                    </div>

                                </div>
                              <div class="col-lg-6">
                                   
                                    <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status" required>
                                        <option value="">Select Status</option>
                                        <option value="Active" <?php if(isset($placementstatistics->status) && ($placementstatistics->status=="Active")){ echo "selected";}?>>Active</option>
                                        <option value="Inactive" <?php if(isset($placementstatistics->status) && ($placementstatistics->status=="Inactive")){ echo "selected";}?>>Inactive</option>
                                    </select>
                                    </div>
                                </div>
                                
                            </div>
                                <div class="row">
                                <div class="col-lg-12 pull-right">
                                    
                                               
                                        <button type="submit" class="btn btn-primary pull-right"><?php if($this->uri->segment(4)){echo "Update Placement Statistics";}else{ echo "Add Placement Statistics";}?></button><br><br><br>
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
  
    $("#addeditplacementstatistics").on('submit', function(e){
       e.preventDefault();
       var formData = new FormData(this);
       var url = $('#url').val();
        //alert(url);
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
            setTimeout(function(){ window.location.href="<? echo base_url('institute/data/placementstatistics') ?>"; }, 1000);  
          }else{
            $("#emsg").show();
            $("#emsg").html(str.Message);
          }
        },
		   error : function(data){
			   console.log(data);
		   }
        });
    });

    });
</script>