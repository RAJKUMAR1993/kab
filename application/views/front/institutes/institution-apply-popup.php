<div class="custom_modal" id="applyc">
    <div class="row">
        <div class="col-md-12 text-right">
            <a style="font-size:20px;cursor:pointer;color:red" onclick="closeModal('applyc');">
                <i class="icon-cancel-6"></i><p style="font-size:10px">Close</p>
            </a>
        </div>
    </div>
    <div class="container margin_35">
			
			<div class="main_title_2">
				<span><em></em></span>
				<h2>Apply For Admission</h2>
			</div>
			
			<div class="grid">
  
  <div class="row cv">
  

 
 <div class="col-md-12 ">
  <!-- <h2> <? if($idata->institute_name){ echo $idata->institute_name; } ?> offers the following Professional Courses (Regular Degrees and Diplomas)</h2>
 -->
	<div id="smsallapply"></div>
  <div class="smsgapply"></div>

  <? 
$adata = $this->db->get_where("tbl_courses",["institute_id"=>$idata->institute_id,"deleted"=>0])->result();
  if($adata) {
  		
  		
  ?>
 <div class="table-responsive box1">
<table class="table" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<th class="th-course-color first-table"> COURSE</th>
<th class="th-course-color first-table"> SPECIALIZATION</th>
<th class="th-duration-color"> DURATION</th>
<!--<th class="th-fee-structure-color"> DETAILS</th>-->
<th class="th-fee-structure-color"> MERIT SCHOLARSHIP</th>
<th class="th-fee-structure-color"> APPLY</th>
</tr>
	
	<? foreach ($adata as $row) { 
		$schk = $this->db->get_where("tbl_institute_admission",["course_id"=>$row->course_id,"institute_id"=>$idata->institute_id,"student_id"=>$this->session->userdata("student_id")])->num_rows();
	?>
		<tr>
			<td><? echo $row->course_name; ?></td>
			<td><? echo $row->specialization; ?></td>
			<td><? echo $row->course_duration; ?></td>
<!--			<td><? //echo $row->course_desc; ?></td>-->
			<td align="center"><? echo ($row->merit_scholarship == "yes") ? '<a href="javascript:void(0)" class="btn btn-info btn-sm viewScholarship" cid="'.$row->course_id.'">View Details</a>' : ''; ?></td>
			
			<? if($schk > 0){ ?>
			
				<td align="center"><button disabled class=" btn-info btn-sm btn">Applied</button></td>
			
			<? }else{ ?>
			
				<td align="center"><a href="javascript:void(0)" data-cid="<? echo $row->course_id; ?>" class=" btn-warning btn-sm btn applycourse">Apply Now</a></td>
				
			<? } ?>	
		</tr>
		
	<? } ?>	
</tbody>
</table></div> 

<hr/>

 <? } ?>
 
 </div>
 

 
  </div>
</div>
</div>
</div>


<style type="text/css">
  #myModalAdmission .modal-content {
    height: auto;
    margin-top: 120px;
  } 
  #myModalAdmission .modal-body {
    padding: 20px;
    padding-bottom: 0px;
}
#myModalAdmission .modal-footer {
    padding: 12px 45px;
} 
</style>
<!-- Apply Now modal -->

<!-- Modal -->
<div id="myModalAdmission" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="display: block">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Admission</h4>
      </div>
      
      <form method="post" id="admissionSubmit">
      
      <div class="modal-body" align="center">
        <input type="hidden" name="course_id" id="course_id" value="">
        <div class="scholaryn" style="display: none;">
          <label>Submit your application for meritscholarship</label><br>
          <div class="form-group">
            <input type="radio" class="scholaryni" name="scholaryn" value="yes"> Yes 
            <input type="radio" class="scholaryni" name="scholaryn" value="no"> No
          </div>
        </div><br>
        <p class="withoutMerit"> Are you sure you want to apply this course? </p>
      </div>
      <div class="modal-footer">

        <input type="hidden" name="institute_id" value="<? echo $idata->institute_id ?>">
        <input type="hidden" name="student_id" value="<? echo $this->session->userdata("student_id") ?>">
      <button type="submit" class="btn btn-primary">Apply</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      
    </form>   
    </div>

  </div>
</div>

<script type="text/javascript">

 $(".applycourse").on('click', function(event){
   $("#smsallapply").html("");
   $(".smsgapply").html("");
   $(".scholaryni").prop("checked", false);
   
	var scid = $(this).attr("data-cid");
	$('.modal-body #course_id').val(scid);
	 
	$.ajax({

      type : "post",
      data : {institute_id:"<? echo $idata->institute_id ?>",student_id:"<? echo $this->session->userdata("student_id") ?>",course_id:$("#course_id").val()},
      url : "<? echo base_url('front/institutes/checkadmission') ?>",
      success : function(data){
        
        if(data == "dublicate"){
          $("#smsallapply").html('<div class="alert alert-success">Already you applied this course. We will contact you soon. </div>');
          setTimeout(function(){$("#smsallapply").html("")},3000)
        }else{
          var cid = $("#course_id").val();
          $.ajax({
            type : "post",
            url : "<? echo base_url('front/institutes/getScholarshipinfo') ?>",
            data : {cid : cid},
            success : function(data){
              if(data!='' && typeof data!='undefined'){
                $(".scholaryn").removeAttr("style", "display:none;");
                $(".withoutMerit").attr("style", "display:none;");
                $(".scholaryni").attr("required", "required");
              }
             else{
                $(".scholaryn").attr("style", "display:none;");
                $(".withoutMerit").removeAttr("style", "display:none;");
                $(".scholaryni").removeAttr("required", "required");
             }             
            }
          });
          $("#myModalAdmission").modal("show")
        }
      },
      error : function(data){
        
        console.log(data);
        
      }

    }) 

});

  $("#admissionSubmit").submit(function(e){
  
    e.preventDefault();
    var fdata = $("#admissionSubmit").serialize();
    
    $.ajax({

      type : "post",
      data : fdata,
      url : "<? echo base_url('front/institutes/insertadmission') ?>",
      success : function(data){
        
        if(data == "success"){
          $("#myModalAdmission").modal("hide");
          $(".smsgapply").html('<div class="alert alert-success">You are successfully applied. We will contact you soon. </div>');
        } else if(data == "dublicate"){
          $("#myModalAdmission").modal("hide");
          $(".smsgapply").html('<div class="alert alert-success">Already you applied this course. We will contact you soon. </div>');
        }else{
          $(".smsgapply").html('<div class="alert alert-danger">Error Occured please try again.</div>');
        }
        setTimeout(function(){$(".smsgapply").html("")},3000);
      },
      error : function(data){
        
        console.log(data);
        
      }

    })
  
  }); 
    
</script>