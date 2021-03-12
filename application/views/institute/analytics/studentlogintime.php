
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
                            <h4>Students List of Login Time</h4>
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
                          <div class="col-md-4">
                             <form method="get" id="filtersve">
                                <div class="form-group">
                                <label>Location</label>
                                    <select class="form-control filtersve" name="location" id="location">
                                        <option value="">Location</option>
                                        <? $geolocation = $this->db->query("select geolocation from tbl_student_institute_view_time group by geolocation")->result();
                                                                
                                            foreach($geolocation as $loc){
                                                $locname = ($this->input->get("location") == $loc->geolocation) ? 'selected' : '';
                                                echo '<option value="'.$loc->geolocation.'" '.$locname.'>'.$loc->geolocation.'</option>';
                                            }				   
                                        ?>
                                        
                                    </select>
                                </div>
							</div>
                            <div class="col-md-1">
                                  <div class="form-group">
                                      <a href="<? echo base_url('institute/analytics/studentlogintime') ?>" class="btn btn-primary" style="margin-top: 25px">Clear</a>
                                  </div>
                                </form>
                            </div>
                        
                            </div>   
                        
						      
					   </div>       
                               
                        <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" id="zero_config" width="100%">
                                <thead>
                                    <tr> 
                                        <th height="30px" width="20px">S.no</th>
                                        <th height="30px" width="20px">IP Address</th>
                                        <th height="30px" width="20px">Geo Location</th>
                                        <th height="30px" width="50px">Student Name</th>
                                        <th height="30px" width="50px">Student Email</th>
<!--                                        <th height="30px" width="50px">Student Mobile</th>-->
                                        <th height="30px" width="50px">User Type</th>
                                        <th height="30px" width="50px">Date</th>
                                        <th height="30px" width="50px">Start Time</th>
                                        <th height="30px" width="50px">End Time</th>
                                        <th height="30px" width="50px">Duration</th>
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

$(".filtersve").change(function(){
	
	$("#filtersve").submit();
	
})
$(document).ready(function(){
   
	var location = "<? echo ($this->input->get("location") != '') ? $this->input->get("location") : '' ?>";
	var sdate="";
	var edate="";
	filter(sdate,edate,location);
	
})	
	jQuery('#date-range').datepicker({
        toggleActive: true,
		minDate: 0,
		dateFormat: "dd-mm-yy",
 	});
	
    
	
$("#filter").click(function(){
	var sdate = $("#sdate").val();
    var edate = $("#edate").val();
    var location = $("#location").val();
	filter(sdate,edate,location);
	
})
	
	
function filter(sdate="",edate="",location=""){
	
	var table = $('#zero_config').dataTable({
         "bProcessing": true,
         "ajax": {
			"url": "<?php echo base_url("institute/analytics/filterstudentlogintime") ?>",
			"type": "POST",
            "data" : {sdate : sdate, edate : edate, location : location},

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
               { mData: 'aip' } ,
               { mData: 'ageo' } ,
               { mData: 'st_name' },
               { mData: 'st_email' },
//               { mData: 'st_mobile' },
               { mData: 'type' },
               { mData: 'date' },
               { mData: 'start_time' },
               { mData: 'end_time' },
               { mData: 'duration' },
               
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