<div class="custom_modal" id="placements">
    <div class="row">
        <div class="col-md-12 text-right">
            <a style="font-size:20px;cursor:pointer;color:red" onclick="closeModal('placements');">
                <i class="icon-cancel-6"></i><p style="font-size:10px">Close</p>
            </a>
        </div>
    </div>
    <div class="container margin_35">
		
			<div class="main_title_2">
				<span><em></em></span>
				<h2>Placements</h2>
			</div>
			
			<div class="grid">
  
  <div class="row">
<div class="col-md-12">
<h5>Placement Statistics</h5>
<div class="table-responsive box1">
<? $psdetails = $this->db->get_where("tbl_placementstatistics",["institute_id"=>$idata->institute_id,"is_deleted"=>0,"status"=>"Active"])->result();
            if($psdetails) { ?>
  <table border="0" cellspacing="0" cellpadding="0" class="table1" width="100%">
            <tbody><tr class="highlight">
              <th>Company Logo</th>
              <th>Company Name</th>
              <th>No'of Students Placed</th>
			  <th>Academic Year</th>
              <th>Highest Salary (Per Annum)</th>
            </tr>
            <?
            
              foreach ($psdetails as $row) {
                
            ?>
            <tr>
            	<td align="center"><? if($row->company_logo){ ?><img src="<? echo base_url().$row->company_logo ?>" style="width: 150px;height: 100px"><? } ?></td>
            	<td><? echo $row->companyname; ?></td>
            	<td><? echo $row->nostudentplaced; ?></td>
				<td><? echo $row->year; ?></td>
            	<td><? echo ($row->salaryannum != "") ? $this->student_model->getMoney($row->salaryannum)." Rs/-" : ''; ?></td>
            </tr>
            <? }  ?>
           
          </tbody></table>
<? } else { echo "No Records Found"; } ?>
        </div>
</div>

<div class="col-md-12">
<h5 style="margin-top: 20px;">Students Placement</h5>
		<div class="row">
  <?
            $spdetails = $this->db->get_where("tbl_studentsplacement",["institute_id"=>$idata->institute_id,"is_deleted"=>0,"status"=>"Active"])->result();
            if($spdetails) {
              $ixy = 1;
              foreach ($spdetails as $row2) {
                
            ?>
           		
           		<div class="col-lg-4 col-sm-12" style="margin-bottom:20px">
					<div style="padding:5px;background:#f1f1f1;width:100%;">

						<iframe src="<? echo base_url().$row2->url ?>" width="100%"></iframe>

					</div>

					<div style="max-height:105px;min-height:105px;border:1px solid #f1f1f1;padding:5px;overflow-y:auto" align="center">
						<h6 style="text-align:center"><? echo $row2->title ?></h6>
						<a style="margin-bottom:0px;text-align:center;border-radius: 15px;color: white" class="btn btn-info btn-sm" href="<? echo base_url().$row2->url ?>" download><i class="fa fa-download"></i> Download</a>
					</div>

				</div>
            
           <? $ixy++; } } else { echo "No Data Available"; } ?>
          
          </div>


</div>

 
  </div>
  
  </div>
	
</div>
</div>