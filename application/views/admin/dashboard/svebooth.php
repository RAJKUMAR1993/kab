
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
					<div class="col-md-4 pull-left">
						<h2>Students Visited E Booth's </h2>
					</div>
					<div class="col-lg-8 col-md-8 col-sm-12 text-right">
						<ul class="breadcrumb justify-content-end" style="background-color: transparent">
							<li class="breadcrumb-item"><a href="<? echo base_url('admin/dashboard') ?>"><i class="icon-home"></i></a></li>
							<li class="breadcrumb-item active">Students Visited E Booth's</li>
						</ul>
					</div>                                                   
				</div>
           
            </div>
            
            <div class="row clearfix">
                
                <div class="col-lg-12">
                    <div class="card">
                                   
                               
                        <div class="card-body">
                        <form method="get" id="filtersve">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
									<label>Institute</label>
										<select class="form-control filtersve" name="institute">
											<option value="">Select Institute</option>
											<? $institutes = $this->db->query("select tv.institute_id,ti.institute_name from tbl_student_institute_view_time tv join tbl_institutes ti on tv.institute_id=ti.institute_id group by tv.institute_id")->result();
																   
												foreach($institutes as $ins){
													$insname = ($this->input->get("institute") == $ins->institute_id) ? 'selected' : '';
													echo '<option value="'.$ins->institute_id.'" '.$insname.'>'.$ins->institute_name.'</option>';
												}				   
											?>
											
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
									<label>Location</label>
										<select class="form-control filtersve" name="location">
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
								<div class="col-md-3">
									<div class="form-group">
										<a href="<? echo base_url('admin/dashboard/svebooth') ?>" class="btn btn-primary" style="margin-top: 25px">Clear</a>
									</div>

								</div>
							</div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" id="zero_config_sve" width="100%">
                                <thead>
                                    <tr> 
                                        <th height="30px" width="20px">S.no</th>
                                        <th height="30px" width="20px">Institute Name</th>
                                        <th height="30px" width="20px">IP Address</th>
                                        <th height="30px" width="20px">Geo Location</th>
                                        <th height="30px" width="50px">Student Name</th>
                                        <th height="30px" width="50px">Student Email</th>
<!--                                        <th height="30px" width="50px">Student Mobile</th>-->
                                        <th height="30px" width="50px">User Type</th>
                                        <th height="30px" width="50px">Date</th>
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
	
	var location = "<? echo ($this->input->get("location") != '') ? $this->input->get("location") : '' ?>"
	var institute = "<? echo ($this->input->get("institute") != '') ? $this->input->get("institute") : '' ?>"
	filter(institute,location);
	
})	
	
$("#filter").click(function(){
	
	var sdate = $("#sdate").val();
	var edate = $("#edate").val();
	filter(sdate,edate);
	
})
	
function filter(institute="",location=""){
	
	var table = $('#zero_config_sve').dataTable({
         "bProcessing": true,
         "ajax": {
			"url": "<?php echo base_url("admin/dashboard/filtersvebooth") ?>",
			"type": "get",
			"data" : {institute : institute, location : location},
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
               { mData: 'inst' } ,
               { mData: 'aip' } ,
               { mData: 'ageo' } ,
               { mData: 'st_name' },
               { mData: 'st_email' },
//               { mData: 'st_mobile' },
               { mData: 'type' },
               { mData: 'date' },
               
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