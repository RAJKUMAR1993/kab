
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
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <a href="<?php echo base_url('speaker/enquiries?ref=received');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class=" fa fa-thumbs-up text-col-blue text-col-blue" style="font-size:25px;"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>Received</h6>
                                            <span class="font700"><?php echo $this->db->get_where("tbl_institute_ask_a_question",["institute_id"=> $this->session->userdata['speaker_id'],"type"=>"speaker","status"=>"received"])->num_rows();?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-blue mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="87"></div>
                                    </div>
                                </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                            <a href="<?php echo base_url('speaker/enquiries?ref=replied');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class=" fa fa-reply-all text-col-green text-col-greeen" style="font-size:25px;"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>Replied </h6>
                                            <span class="font700"><?php echo $this->db->get_where("tbl_institute_ask_a_question",["institute_id"=> $this->session->userdata['speaker_id'],"type"=>"speaker","status"=>"Replied"])->num_rows();?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-green mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="87"></div>
                                    </div>
                                </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                            <a href="<?php echo base_url('speaker/enquiries?ref=pending');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class=" fa fa-spinner text-col-red text-col-red" style="font-size:25px;"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6> Pending</h6>
                                            <span class="font700"><?php   echo $this->db->get_where("tbl_institute_ask_a_question",["institute_id"=>$this->session->userdata('speaker_id'),"type"=>"speaker","status"=>"pending"])->num_rows();?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-red mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="87"></div>
                                    </div>
                                </div>
                                </a>
                            </div>
                    </div>
                        <div class="header">
                            <div class="col-lg-9 pull-left">
                            	<h2>Enquiry Details</h2>
                            </div>
                                               
                        </div>
                               
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table-bordered table-striped table-hover dataTable js-exportable" width="100%">
                                <thead>
                                    <tr height="40px"> 
                                        <th>S.no</th>
                                        <th>Student Name</th>
                                         <th>Student Email</th>
                                         <th>Student Mobile</th>
                                        <th>Query</th>
                                        <th>Message</th>
                                        <th>Status</th>
                                        <th>Reply</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($details){
                                            $key=1;
                                          //  print_r($details);
                                           foreach($details->result() as $row):
                                        
                                        ?>
                                   <tr>
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $row->student_name;?></td>
                                        <td><?php echo $row->email;?></td>
                                        <td><?php echo $row->phone;?></td>
                                        <td><?php echo nl2br($row->query);?></td>
                                        <td><?php echo nl2br($row->message);?></td>
                                        <td><?php echo $row->status;?></td>
                                        <td><a href="#" class="update_button" enqid="<?php echo $row->id;  ?>" enqstatus="<?php echo $row->message ; ?>" ><i class="fa fa-pencil"></i></a></td>
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
      url : "<? echo base_url('speaker/enquiries/updateenquiry') ?>",
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