
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
                             <div class="row">
                               
                               <div class="col-lg-4 col-md-4 col-sm-6">
                                    <a href="<?php echo base_url('institute/enquiries');?>">
                                        <div class="body">
                                            <div class="clearfix">
                                                <div class="float-left">
                                                    <i class="fa fa-check text-col-green" style="font-size:25px;"></i>
                                                </div>
                                                <div class="number float-right text-right">
                                                    <h6> Total</h6>
                                                    <span class="font700"><?php  echo $this->db->get_where("tbl_institute_ask_a_question",["type"=>'institute',"institute_id"=> $this->session->userdata['institute_id']])->num_rows();?></span>
                                                </div>
                                            </div>
                                            <div class="progress progress-xs progress-transparent custom-color-green mb-0 mt-3">
                                                <div class="progress-bar" data-transitiongoal="87"></div>
                                            </div>
                                            <!-- <small class="text-muted">19% compared to last week</small> -->
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6">
                                    <a href="<?php echo base_url('institute/enquiries');?>?status=pending">
                                        <div class="body">
                                            <div class="clearfix">
                                                <div class="float-left">
                                                    <i class="fa fa-thermometer-full text-col-red" style="font-size:25px;"></i>
                                                </div>
                                                <div class="number float-right text-right">
                                                    <h6> Pending</h6>
                                                    <span class="font700"><?php  echo $this->db->get_where("tbl_institute_ask_a_question",["status"=>'pending',"type"=>'institute',"institute_id"=> $this->session->userdata['institute_id']])->num_rows();?></span>
                                                </div>
                                            </div>
                                            <div class="progress progress-xs progress-transparent custom-color-red mb-0 mt-3">
                                                <div class="progress-bar" data-transitiongoal="87"></div>
                                            </div>
                                            <!-- <small class="text-muted">19% compared to last week</small> -->
                                        </div>
                                    </a>
                                </div>
  
                                <div class="col-lg-4 col-md-4 col-sm-6">
                                    <a href="<?php echo base_url('institute/enquiries');?>?status=Replied">
                                        <div class="body">
                                            <div class="clearfix">
                                                <div class="float-left">
                                                    <i class="fa fa-volume-up text-col-blue" style="font-size:25px;"></i>
                                                </div>
                                                <div class="number float-right text-right">
                                                    <h6>Replied</h6>
                                                    <span class="font700"><?php  echo $this->db->get_where("tbl_institute_ask_a_question",["status"=>'Replied',"type"=>'institute',"institute_id"=> $this->session->userdata['institute_id']])->num_rows();?></span>
                                                </div>
                                            </div>
                                            <div class="progress progress-xs progress-transparent custom-color-blue mb-0 mt-3">
                                                <div class="progress-bar" data-transitiongoal="87"></div>
                                            </div>
                                            <!-- <small class="text-muted">19% compared to last week</small> -->
                                        </div>
                                    </a>
                                </div>
                              </div>
                                <!-- <form  method="get" action="<?php echo base_url('institute/enquiries') ?>"> -->
                                  <div class="row">
                                      <div class="col-md-3" >	
                                      <div class="form-group">
                                      <div id="reportrange" name="date" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 140%">
                                          <i class="fa fa-calendar"></i>&nbsp;
                                          <span></span> <i class="fa fa-caret-down"></i>
                                      </div>
                                      </div>
                                      </div>
                                      <div class="col-md-4" style="padding-left: 129px;">		
                                        <div class="form-group">
                                          <input type="button" id="submitBtn" value="submit" class="btn btn-success mt-20" style="width: 100%;" />
                                        </div>
                                      </div>
                                  </div>
                                <!-- </form> -->
                            <div class="col-lg-9 pull-left">
                            	<h2>Enquiry Details</h2>
                            </div>
                                               
                        </div>
                               
                        <div class="card-body">
                        <div class="table-responsive">
                            <table class="table-bordered table-striped dataTable table-hover js-exportable" width="1200px">
                                <thead>
                                    <tr> 
                                        <th height="30px" width="20px">S.no</th>
                                        <th height="30px" width="50px">Student Name</th>
                                         <!-- <th height="30px" width="50px">Student Email</th>
                                         <th height="30px" width="50px">Student Mobile</th> -->
                                        <th height="30px" width="100px">Query</th>
                                        <th height="30px" width="100px">Query Date</th>
                                        <th height="30px" width="150px">Reply Message</th>
                                        <th height="30px" width="150px">Reply Message Date</th>
                                        <th height="30px" width="150px">Status</th>
                                        <th height="30px" width="20px">Reply</th>
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
                                        <td><?php echo $this->db->get_where("tbl_students",["student_id"=>$row->student_id])->row()->student_name;?></td>
                                        <!-- <td><?php echo $row->email;?></td>
                                        <td><?php echo $row->phone;?></td> -->
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
                                        <td><a href="#" class="update_button" query="<? echo $row->query ?>" enqid="<?php echo $row->id;  ?>" enqmessage="<?php echo $row->message ; ?>" enqstatus="<?php echo $row->status ; ?>" ><i class="fa fa-pencil"></i></a></td>
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

$("#submitBtn").click(function(){

  var date = $("#reportrange span").html();
  window.location.href = "<? echo base_url('institute/enquiries') ?>?date="+date;

})


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
<script>

jQuery(document).ready(function() {
  
    jQuery("#select").change(function() {
        if (jQuery(this).val() === 'day'){ 
            jQuery('#ctitle').show();   
        } else {
            jQuery('#ctitle').hide(); 
        }
        if (jQuery(this).val() === 'week'){ 
            jQuery('#week').show();   
        } else {
            jQuery('#week').hide(); 
        }
        if (jQuery(this).val() === 'month'){ 
            jQuery('#month').show();   
        } else {
            jQuery('#month').hide(); 
        }
    });
});
</script>
