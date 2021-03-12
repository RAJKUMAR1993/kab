
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
        <div class="container-fluid">
            <div class="block-header">
           
           		<div class="header instituteHeader row">
					<div class="col-md-3 pull-left">
						<h2>Applications </h2>
					</div>
					<div class="col-lg-9 col-md-9 col-sm-12 text-right">
						<ul class="breadcrumb justify-content-end" style="background-color: transparent">
							<li class="breadcrumb-item"><a href="<? echo base_url('admin/dashboard') ?>"><i class="icon-home"></i></a></li>
							<li class="breadcrumb-item active">Applications</li>
						</ul>
					</div>                                                   
				</div>
           
            </div>
            <div class="row clearfix">
                
                <div class="col-lg-12">
                    <div class="card">
                               
                        <div class="body">
                        
                        
                        <section id="lessons">
							
							
									<div class="card" style="margin-bottom: 10px">
										<div class="card-body">

											<div class="table-responsive">
												<table class="table table-bordered table-striped table-hover dataTable js-exportable">
													<thead>
														<tr> 
															<th>S.no</th>
															<th>Institute Name</th>
															<th>Student Name</th>
															<th>Merit Scholarship</th>
															<th>Applied Date</th>
															<th>Course Name</th>
															<th>Specialization</th>
															<th>Duration</th>
															<th>Status</th>
														</tr>
													</thead>
													<tbody>
														<?php 
														  $key = 1;
														  foreach($details as $sk => $row){	
								   
								  							$sdata = $this->db->get_where("tbl_students",["student_id"=>$row->student_id])->row();
								  							$idata = $this->db->get_where("tbl_institutes",["institute_id"=>$row->institute_id])->row();
															$cdetails = $this->institute_model->get_course_details($row->course_id);
															?>
													   <tr>
															<td><?php echo $key;?></td>
															<td><?php echo $idata->institute_name;?></td>
															<td><?php echo $sdata->student_name;?></td>
															<td><?php echo ucfirst($row->scholaryn);?></td>
															<td><?php echo date('d-m-Y', strtotime($row->created_date)) ;?></td>
															<td><?php echo $cdetails->course_name;?></td>
															<td style="white-space: break-spaces;"><?php echo $cdetails->specialization;?></td>
															<td><?php echo $cdetails->course_duration;?></td>  
															<td><?php echo $row->status;?></td>
														</tr>
														<?php $key++; }?>

													</tbody>

												</table>
												</div>


											</div>
										</div>
									
						</section>

                        
                        
                        
                        
                        
                        
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>

            <div class="modal fade" id="updateModal" role="dialog">
                        <div class="modal-dialog">
                            <form id="updateadmission">
                            <div class="modal-content">
                              <div class="modal-header">
                                
                                <h6 class="modal-title">Update Admission Status</h6>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                
                              </div>
                              <div class="modal-body">
                                <div class="smsgapply"></div>
                                                         
                                  <input type="hidden" class="csid" name="csid" id="csid">
                                  
                                  <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                      <select name="status" id="cstatus" class="form-control">
                                          <option value="In Progress">In Progress</option>
                                          <option value="Approved">Approved</option>
                                          <option value="Rejected">Rejected</option>
                                      </select>
                                    </div>
                                  </div>
                                  
                                                                  
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                            </form>
                        </div><!--.modal-dialog-->
                    </div>

<script type="text/javascript">
    $(document).ready(function(){
      setTimeout(function(){
        $("#DataTables_Table_0_info, #DataTables_Table_0_paginate, #DataTables_Table_0_filter").attr("style", "display:none;");
      }, 500);
  $(".update_button").click(function () {
      $("#csid").val($(this).attr('admssionid'));
      $("#cstatus").val($(this).attr('admssionstatus'));
    $("#updateModal").modal();
    });
 });
</script>

<script type="text/javascript">
      $("#updateadmission").submit(function(e){
  
    e.preventDefault();
    var fdata = $("#updateadmission").serialize();
    
    $.ajax({

      type : "post",
      data : fdata,
      url : "<? echo base_url('front/institutes/updateadmission') ?>",
      success : function(data){
        
        if(data == "success"){
          $(".smsgapply").html('<div class="alert alert-success">Status successfully Updated. </div>');
          setTimeout(function(){location.reload()},2000)
        } else{
          $(".smsgapply").html('<div class="alert alert-danger">Error Occured please try again.</div>');
        }
      },
      error : function(data){
        
        console.log(data);
        
      }

    })
  
  });
</script>