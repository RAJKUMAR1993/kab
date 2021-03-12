
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
                        <div class="card-title" align="center">
                            <h4>Questions Asked By Students</h4>
                            <a href="<? echo base_url('institute/analytics') ?>" class="btn btn-info btn-rounded pull-right" style="margin-right: 20px;"><i class="fa fa-chevron-left"></i> Analytics</a>
                        </div>
                               
                        <div class="row" style="margin-left: 5px;">   
						  <div class="col-md-5">   
							<div class="form-group">
								<label>Select Start & End Date :</label>
								<div class="input-daterange input-group" id="date-range">
									<input type="text" class="form-control" name="startDate" id="sdate" placeholder="Start Date" autocomplete="off"  required>
									<div class="input-group-append">
										<span class="input-group-text bg-info b-0 text-white">TO</span>
									</div>
									<input type="text" class="form-control" name="endDate" id="edate" placeholder="End Date" autocomplete="off" required/>
								</div>
							</div>
						  </div>		
				      
					      <div class="col-md-2">
					      	
					      	<button id="filter" type="button" class="btn btn-info waves-effect waves-light m-t-30">Submit</button>
					      	
					      </div> 
						      
					   </div>       
                               
                        <div class="card-body">
                        <div class="table-responsive">
                            <table class="table-bordered table-striped table-hover" id="zero_config" width="100%">
                                <thead>
                                    <tr> 
                                        <th height="30px" style="width: 20px !important">S.no</th>
                                        <th height="30px" width="50px">Student Name</th>
                                        <th height="30px" width="50px">Student Email</th>
<!--                                        <th height="30px" width="50px">Student Mobile</th>-->
                                        <th height="30px" width="50px">Query</th>
										<th height="30px" width="50px">Query Date</th>
                                        <th height="30px" width="50px">Reply Message</th>
                                        <th height="30px" width="50px">Reply Message Date</th>
                                        <th height="30px" width="50px">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                              
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
    
<link rel="stylesheet" type="text/css" href="<? echo base_url('assets/') ?>css/bootstrap-datepicker.min.css">  
<script src="<? echo base_url('assets/') ?>js/bootstrap-datepicker.min.js"></script>      

<script>

	jQuery('#date-range').datepicker({
        toggleActive: true,
		minDate: 0,
		dateFormat: "dd-mm-yy",
 	});
	
$(document).ready(function(){
	
	
	filter();
	
})	
	
$("#filter").click(function(){
	
	var sdate = $("#sdate").val();
	var edate = $("#edate").val();
	filter(sdate,edate);
	
})
	
function filter(sdate="",edate=""){
	
	var table = $('#zero_config').dataTable({
         "bProcessing": true,
         "ajax": {
			"url": "<?php echo base_url("institute/analytics/filteraskedquestions") ?>",
			"type": "POST",
			"data" : {sdate : sdate, edate : edate},
//			"success" : function(data){
//				
//				console.log(data);
//				
//			},
//			"error" : function(data){
//				
//				console.log(data);
//				
//			} 
  		  },
         "aoColumns": [
			 
               { mData: 'sno' } ,
               { mData: 'st_name' },
               { mData: 'st_email' },
//               { mData: 'st_mobile' },
               
               { mData: 'query' },
			   { mData: 'date' },
               { mData: 'message' },
			   { mData: 'message_date' },
               { mData: 'status' },
               
             ],
          "aaSorting": [[ 0, "asc" ]],
          "bLengthChange": true,
          "pageLength":10,
		  "destroy" : 'true',
		  "dom": 'Bfrtip',
		  "buttons": [
			 'csv', 'excel', 'pdf','pageLength'
		  ]	
      });
	
}	
	

</script>  