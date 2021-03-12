
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
            
            <div class="row clearfix">
                
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="col-lg-9 pull-left">
                            	<h2>Logged In Students</h2>
                            </div>
                                               
                        </div>
                               
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr> 
                                        <th>S.no</th>
                                        <th>Student Name</th>
                                        <th>Student Email</th>
                                        <th>Student Mobile</th>
                                        <th>Visited date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($details){
                                            $key=1;
                                          //  print_r($details);
                                           foreach($details as $r):
                                        
											$row = $this->db->get_where("tbl_students",["student_id"=>$r->student_id])->row();
                                        ?>
                                   <tr>
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $row->student_name;?></td>
                                        <td><?php echo $row->email;?></td>
                                        <td><?php echo $row->phone;?></td>
                                        <td><?php echo $r->start_time;?></td>
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
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Query</label>
                                    <div class="col-sm-10">
                                      
                                      <textarea id="query" class="form-control" readonly></textarea>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Message</label>
                                    <div class="col-sm-10">
                                      
                                      <textarea name="status" id="cstatus" class="form-control"></textarea>
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
      $("#query").val($(this).attr('query'));
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