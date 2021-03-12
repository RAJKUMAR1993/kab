
<style>
    td.details-control {
    background: url('<?php echo base_url(); ?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
    tr.shown td.details-control {
        background: url('<?php echo base_url(); ?>assets/images/details_close.png') no-repeat center center;
    }
    .col-md-2 {
        max-width: 7.666667%;
    }
</style>

<div id="main-content">
        <div class="container-fluid">
            
            <div class="row clearfix">
                
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="col-lg-12 pull-left">
                            	<h2>Speaker Enquiry Details</h2>
                            </div>
	                            <a href="<?php echo base_url("admin/reports/speaker_reports");?>"><button type="button" class="btn btn-primary btn-block col-lg-3 pull-right"  data-target="#addevent">Speaker Reports</button></a> <br><br>
                        </div>
                        <form action="" method="POST">
                            <div class="row" style="margin-left: 5px;"> 
                                <?php $speakers = $this->db->get_where("tbl_speakers",["is_deleted"=>0])->result();?>  
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Eminent Speaker :</label>
                                        <select class="form-control" name="speaker">
                                            <option value="">Select Speaker</option>
                                            <?php
                                                  $speaker_id = $this->input->post("speaker");
                                            foreach ($speakers as $speaker) {
                                            ?>
                                                <option <?php if($speaker_id==$speaker->speaker_id){ echo 'selected';}?> value="<?php echo $speaker->speaker_id;?>"><?php echo $speaker->speaker_name;?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>        
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light m-t-30">Submit</button> 
                                </div>
                                <div class="col-md-2">
                                    <a href="" class="btn btn-warning waves-effect waves-light m-t-30">Cancel</a>                     
                                </div>
                           </div>
                       </form>
                               
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table-bordered table-striped table-hover dataTable js-exportable" width="100%">
                                <thead>
                                    <tr height="40px"> 
                                        <th>S.no</th>
                                        <th>Speaker</th>
                                        <th>Student Name</th>
                                        <!-- <th>Student Mobile</th>-->
                                        <th>Query</th>
                                        <th>Query Date</th>
                                        <th>Reply Message</th>
										<th>Reply Message Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($details){
                                            $key=1;
                                          //  print_r($details);
                                           foreach($details as $row):
                                        
                                        ?>
                                   <tr>
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $this->db->get_where("tbl_speakers",["speaker_id "=>$row->speaker_id ])->row()->speaker_name;?></td>
                                        <td><?php echo $row->student_name;?></td>
                                        <!--<td><?php echo $row->phone;?></td>-->
                                        <td><?php echo $row->query;?></td>
										<td><?php if($row->query_date == "0000-00-00"){ echo ""; }else{ echo date("d-m-Y",strtotime($row->query_date)); } ?></td>
                                        <td><?php echo $row->message;?></td>
										<td><?php 
										if($row->message_date == "0000-00-00"){
											echo "";
										}else{
											echo date("d-m-Y",strtotime($row->message_date));
										} ?></td>
                                    </tr>
                                    <?php $key++; endforeach;}else{ echo "No records found";}?>
                                
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
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Message</label>
                                    <div class="col-sm-10">
                                      
                                      <textarea name="message" id="cstatus" class="form-control"></textarea>
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
  $(".update_button").click(function () {
      $("#csid").val($(this).attr('enqid'));
      $("#cstatus").val($(this).attr('enqstatus'));
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
      url : "<? echo base_url('expert/enquiries/updateenquiry') ?>",
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