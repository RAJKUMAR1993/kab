
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
                                <h2>Feedback</h2>
                            </div>
<!--                            <a href="<?php //echo base_url("institute/data/achievement");?>" class="col-lg-1 pull-right"><u>Back</u></a>-->
                                   
                        </div>
                        <div class="body">
                            <div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
                            <form id="addeditachievement">
                                <input type="hidden" id="url" name="url" value="<?php echo base_url("institute/data/updatefeedback/".$this->uri->segment(4));?>">
                                <input type="hidden" id="achievement_id" name="achievement_id" value="<?php echo $this->uri->segment(4);?>">
                            		
                                <div class="row">   
                                    <div class="col-lg-6 pull-left">
	                                    <div class="form-group">
	                                        <label>Feedback Description <span style="color: red;">*</span></label>
	                                        <textarea class="form-control" name="feedback_description" rows="4" required><?php echo $admin->feedback_description;?></textarea>
	                                    </div>
	                                </div>
                                    <div class="col-lg-6 pull-left">
	                                    <div class="form-group">
	                                        <label>Feedback Question <span style="color: red;">*</span></label>
	                                        <textarea class="form-control" name="feedback_question" rows="4" required><?php echo $admin->feedback_question;?></textarea>
	                                    </div>
	                                </div>
									<div class="col-lg-6">

										<button type="submit" class="btn btn-primary pull-left">Update</button><br><br><br>
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
  
    $("#addeditachievement").on('submit', function(e){
       e.preventDefault();
       var fdata = $("#addeditachievement").serialize();
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