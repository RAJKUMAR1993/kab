
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
                                <h2>Students Placement Details</h2>
                            </div>
                            <a href="<?php echo base_url("institute/data/studentsplacement");?>" class="col-lg-1 pull-right"><u>Back</u></a>
                                   
                        </div>
                        <div class="body">
                            <div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
                            <form id="addeditstudentsplacement">
                                <input type="hidden" id="url" name="url" value="<?php echo base_url("institute/data/savestudentsplacement/".$this->uri->segment(4));?>">
                                <input type="hidden" id="ps_id" name="ps_id" value="<?php echo $this->uri->segment(4);?>">
                                  <div class="row">
                                   <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="title" value="<?php if(isset($studentsplacement->title)){ echo $studentsplacement->title;}?>" required>
                                    </div>

                                </div>
<div class="col-lg-6">
                                   
                                    <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status" required>
                                        <option value="">Select Status</option>
                                        <option value="Active" <?php if(isset($studentsplacement->status) && ($studentsplacement->status=="Active")){ echo "selected";}?>>Active</option>
                                        <option value="Inactive" <?php if(isset($studentsplacement->status) && ($studentsplacement->status=="Inactive")){ echo "selected";}?>>Inactive</option>
                                    </select>
                                    </div>
                                </div>
                                
                            </div>
<div class="row">
                              

                         <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Upload PDF (Placed students list)</label>
                                        <input type="file" class="form-control dropify" name="logo" data-allowed-file-extensions="pdf" data-default-file="<?php if(isset($studentsplacement->url)){ echo base_url($studentsplacement->url); }?>" >
                                        <input type="hidden" class="form-control" name="old_logo" value="<?php if(isset($studentsplacement->url)){ echo $studentsplacement->url;}?>" >
                                        
                                        <small style="color: red">Note :Maximum size of pdf should be less than 5mb</small>
                                    </div>
                                </div>     
                            </div>
                                <div class="row">
                                <div class="col-lg-12 pull-right">
                                    
                                               
                                        <button type="submit" class="btn btn-primary pull-right"><?php if($this->uri->segment(4)){echo "Update Students Placement";}else{ echo "Add Studens Placement";}?></button><br><br><br>
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
  
    $("#addeditstudentsplacement").on('submit', function(e){
       e.preventDefault();
       //var fdata = $("#addeditstudentsplacement").serialize();
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