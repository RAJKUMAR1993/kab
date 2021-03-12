
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
                                <h2>Course Details</h2>
                            </div>
                            <a href="<?php echo base_url("institute/data/courses");?>" class="col-lg-1 pull-right"><u>Back</u></a>
                                   
                        </div>
                        <div class="body">
                            <div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
                            <form id="addeditinstitute">
                                <input type="hidden" id="url" name="url" value="<?php echo base_url("institute/data/add_course/".$this->uri->segment(4));?>">
                                <input type="hidden" id="video_id" name="cid" value="<?php echo $this->uri->segment(4);?>">
                                
                                <div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<label>Course Name</label>
											<input type="text" class="form-control" name="course_name" value="<?php if(isset($courses->course_name)){ echo $courses->course_name;}?>" required>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label>Specialization</label>
											<input type="text" class="form-control" name="specialization" value="<?php if(isset($courses->specialization)){ echo $courses->specialization;}?>" required>
										</div>
									</div>
									
									<div class="col-lg-4">
									   <div class="form-group"> 
										<label>Course Duration</label>
										<input type="text" class="form-control" name="course_duration" value="<?php if(isset($courses->course_duration)){ echo $courses->course_duration;}?>" required>
									   </div>
									</div>
									<div class="col-lg-6">
									   <div class="form-group"> 
										<label>Course Fees</label>
										<input type="text" class="form-control" name="course_fees" value="<?php if(isset($courses->course_fees)){ echo $courses->course_fees;}?>" required>
									   </div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Merit Scholarship</label>
											
											<select class="form-control" name="merit_scholarship" id="merit_scholarship" required>
												
												<option value="">Select Merit Scholarship</option>
												<option value="yes" <? echo ($courses->merit_scholarship == "yes") ? 'selected' : '' ?> >Yes</option>
												<option value="no" <? echo ($courses->merit_scholarship == "no") ? 'selected' : '' ?>>No</option>
												
											</select>
											
										</div>
									</div>
									<div class="col-lg-6" id="merit_scholarship_desc" style="display: <? echo ($courses->merit_scholarship == "yes") ? '' : 'none' ?>">
									   <div class="form-group"> 
										<label>Merit Scholarship Description</label>
										<textarea class="form-control code_preview0" name="merit_scholarship_desc"><?php if(isset($courses->merit_scholarship_desc)){ echo $courses->merit_scholarship_desc;}?></textarea>
									   </div>
									</div>
									<div class="col-lg-6">
									   <div class="form-group"> 
										<label>Course Info</label>
										<textarea class="form-control code_preview0" name="course_desc"><?php if(isset($courses->course_desc)){ echo $courses->course_desc;}?></textarea>
									   </div>
									</div>

									<div class="col-lg-6">          
											<button type="submit" class="btn btn-primary pull-right"><?php if($this->uri->segment(4)){echo "Update Course";}else{ echo "Add Course";}?></button><br><br><br>
											<center><img src="<? echo base_url(); ?>assets/images/load.gif" width="42" height="42" alt="" style="display:none" id="loader"></center>
									</div>
                            	</div>

                            </form>
                        </div>
                    </div>
    </div>
</div>

<script type="text/javascript">
 $(document).ready(function() {
    $('.code_preview0').summernote({height: 300});
    });
</script>
<script type="text/javascript">
	
	$("#merit_scholarship").change(function(){
		
		var val = $(this).val();
		
		if(val == "yes"){
			
			$("#merit_scholarship_desc").show();
			
		}else{
			
			$("#merit_scholarship_desc").hide();
			
		}
		
	})
	
    $(document).ready(function(){
  
    $("#addeditinstitute").on('submit', function(e){
       e.preventDefault();
       var fdata = $("#addeditinstitute").serialize();
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