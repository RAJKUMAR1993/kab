<style>
.coubox h3 {
    font-size: 15px;
    margin: 0px;
    padding: 0px;
    text-transform: uppercase;
    color: #00254b;
}
.coubox p {
    margin-top: 0;
    margin-bottom: 1rem;
    font-size: 14px;
}
</style>
<div class="custom_modal" id="pogram">
    <div class="row">
        <div class="col-md-12 text-right">
            <a style="font-size:20px;cursor:pointer;color:red" onclick="closeModal('pogram');">
                <i class="icon-cancel-6"></i><p style="font-size:10px">Close</p>
            </a>
        </div>
    </div>
    <div class="container margin_35" style="margin-bottom: 100px">

			<div class="main_title_2">
				<span><em></em></span>
				<h2>Programme Fees</h2>
			</div>
			
			<div class="table-responsive box1">
			<? $pfdata = $this->db->get_where("tbl_courses",["institute_id"=>$idata->institute_id,"deleted"=>0])->result();
			  if($pfdata){
				 ?>
			  <table border="0" cellspacing="0" cellpadding="0" class="table1" width="100%">
						<tbody><tr class="highlight">
						  <th>Course</th>
						  <th>Specialization</th>
						  <th>Tution Fees (Per Annum)</th>
						  <th>Duration</th>
						  <th>Merit Scholarship</th>
<!--						  <th>Highest Salary</th>-->
						</tr>
						<?

						  foreach ($pfdata as $row) {

						?>
						<tr>
							<td><? echo $row->course_name; ?></td>
							<td><? echo $row->specialization; ?></td>
							<td><? echo ($row->course_fees != "") ? $this->student_model->getMoney($row->course_fees) : ''; ?></td>
							<td><? echo $row->course_duration; ?></td>
							<td><? echo ($row->merit_scholarship == "yes") ? '<a href="javascript:void(0)" class="btn btn-info btn-sm viewScholarship" cid="'.$row->course_id.'" style="color:white;border-radius:15px;">View Details</a>' : 'Not Applicable'; ?>
							</td>
						</tr>
						<? }  ?>

					  </tbody></table>
			<? } else { echo "No Records Found"; } ?>
					
			</div>
			
			
  </div>
</div>