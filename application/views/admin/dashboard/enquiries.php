
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
					<div class="col-lg-3 pull-left">
						<h2>Enquiry Details</h2>
					</div>
					 <div class="col-lg-9 col-md-9 col-sm-12 text-right pull-right">
						<ul class="breadcrumb justify-content-end" style="background-color: transparent">
							<li class="breadcrumb-item"><a href="<? echo base_url('admin/dashboard') ?>"><i class="icon-home"></i></a></li>
							<li class="breadcrumb-item active">Enquiries</li>
						</ul>
					</div>                                                  
				</div>
           
            </div>
            <div class="row clearfix">
                
                <div class="col-lg-12">
                    <div class="card">
                      
                        <div class="card-body">
                        <div class="table-responsive">
                            <table class="table-bordered table-striped dataTable table-hover js-exportable" width="1200px">
                                <thead>
                                    <tr> 
                                        <th height="30px" width="20px">S.no</th>
                                        <th height="30px" width="50px">Name</th>
                                        <th height="30px" width="50px">Type</th>
                                        <th height="30px" width="50px">Student Name</th>
                                        <th height="30px" width="100px">Query</th>
                                        <th height="30px" width="100px">Query Date</th>
                                        <th height="30px" width="150px">Reply Message</th>
                                        <th height="30px" width="150px">Reply Message Date</th>
                                        <th height="30px" width="150px">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($details){
                                            $key=1;
                                          //  print_r($details);
                                           foreach($details as $row):
	
												$name = "";
												if($row->type == "expert"){
													
													$name = $this->db->get_where("tbl_experts",["expert_id"=>$row->institute_id])->row()->expert_name;
													
												}elseif($row->type == "counsellor"){
													
													$name = $this->db->get_where("tbl_councellors",["id"=>$row->institute_id])->row()->expert_name;
													
												}elseif($row->type == "professor"){
													
													$name = $this->db->get_where("tbl_professors",["pro_id"=>$row->institute_id])->row()->pro_name;
													
												}elseif($row->type == "speaker"){
													
													$name = $this->db->get_where("tbl_speakers",["speaker_id"=>$row->institute_id])->row()->speaker_name;
													
												}elseif($row->type == "institute"){
													
													$name = $this->db->get_where("tbl_institutes",["institute_id"=>$row->institute_id])->row()->institute_name;
													
												}
	
                                        
                                        ?>
                                   <tr>
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $name;?></td>
                                        <td><?php echo ucfirst($row->type);?></td>
                                        <td><?php echo $row->student_name;?></td>
                                        <td><?php echo $row->query;?></td>
                                        <td><?php 
										if($row->query_date == "0000-00-00"){
											echo "";
										}else{
											echo date("d-m-Y",strtotime($row->query_date));
										} ?></td>
                                        <td><?php echo $row->message;?></td>
                                        <td><?php 
										if($row->message_date == "0000-00-00"){
											echo "";
										}else{
											echo date("d-m-Y",strtotime($row->message_date));
										} ?></td>
                                        <td><?php echo $row->status;?></td>
                                    </tr>
                                    <?php $key++; endforeach;}
                                    //else{ echo "No records found";}
                                    ?>
                                
                                </tbody>
                              
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>


<div class="modal fade" id="updateModal" role="dialog">
                        <div class="modal-dialog">
                            <form id="updateenquiry">
                            <div class="modal-content">
                              <div class="modal-header">
                                
                                <h6 class="modal-title">Reply</h6>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                
                              </div>
                              <div class="modal-body">
                                <div class="smsgapply"></div>
                                                         
                                  <input type="hidden" class="csid" name="csid" id="csid">
                                  
                                  <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Query</label>
                                    <div class="col-sm-10">
                                      
                                      <textarea id="query" class="form-control" readonly></textarea>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Message</label>
                                    <div class="col-sm-10">
                                      
                                      <textarea name="message" id="cmessage" class="form-control"></textarea>
                                    </div>
                                  </div>
                                  
                                                                  
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Send Reply</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                            </form>
                        </div><!--.modal-dialog-->
                    </div>

<script type="text/javascript">
	
	
	
    $(document).ready(function(){
  $(".update_button").click(function () {
      $("#csid").val($(this).attr('enqid'));
      $("#query").val($(this).attr('query'));
      $("#cmessage").val($(this).attr('enqmessage'));
    $("#updateModal").modal();
    });
 });
</script>

<script type="text/javascript">
      $("#updateenquiry").submit(function(e){
  
    e.preventDefault();
    var fdata = $("#updateenquiry").serialize();
    
    $.ajax({

      type : "post",
      data : fdata,
      url : "<? echo base_url('institute/enquiries/updateenquiry') ?>",
      success : function(data){
        
        if(data == "success"){
          $(".smsgapply").html('<div class="alert alert-success">Successfully replied. </div>');
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