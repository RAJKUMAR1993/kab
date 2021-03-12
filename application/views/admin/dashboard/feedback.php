
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
						<h2>Institutes Feedback Report</h2>
					</div>
					<div class="col-lg-8 col-md-8 col-sm-12 text-right pull-right">
						<ul class="breadcrumb justify-content-end" style="background-color: transparent">
							<li class="breadcrumb-item"><a href="<? echo base_url('admin/dashboard') ?>"><i class="icon-home"></i></a></li>
							<li class="breadcrumb-item active">Institutes Feedback Report</li>
						</ul>
					</div>                    
				</div>
           
            </div>
            
            <div class="row clearfix">
                
                <div class="col-lg-12">
                    <div class="card">
                        
                               
                        <div class="body">
                        
                        
							<div class="row">
								<div class="col-md-4">
									<form method="get" id="filtersve">
									<div class="form-group">
									<label>Institute</label>
										<select class="form-control filtersve" name="institute">
											<option value="">Select Institute</option>
											<? $institutes = $this->db->query("select tv.institute_id,ti.institute_name from tbl_institute_feedbackrating tv join tbl_institutes ti on tv.institute_id=ti.institute_id group by tv.institute_id")->result();
																   
												foreach($institutes as $ins){
													$insname = ($this->input->get("institute") == $ins->institute_id) ? 'selected' : '';
													echo '<option value="'.$ins->institute_id.'" '.$insname.'>'.$ins->institute_name.'</option>';
												}				   
											?>
											
										</select>
									</div>
									</form>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<a href="<? echo base_url('admin/dashboard/inst_feedbacks') ?>" class="btn btn-primary" style="margin-top: 25px">Clear</a>
									</div>

								</div>
							</div>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Institute Name</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Rating</th>
                                        <th>Comment</th>
                                        <th>Date</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($feedback){
                                            $key=1;
                                            foreach($feedback as $fb):
                                                $name = 'Anonymous';
                                                $email = 'Anonymous';
                                                if($fb->student_id!='anonymous'){
                                                    $student = $this->db->where("student_id", $fb->student_id)->get("tbl_students")->row();
                                                    $name = $student->student_name;
                                                    $email = $student->email;
                                                }
                                                
                                        ?>
                                    <tr>
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $this->db->get_where("tbl_institutes",["institute_id"=>$fb->institute_id])->row()->institute_name;?></td>
                                        <td><?php echo $name;?></td>
                                        <td><?php echo $email;?></td>
                                        <td><?php echo $fb->srating;?></td>
                                        <td style="white-space: break-spaces;"><?php echo $fb->comment;?></td>
                                        <td><?php echo date('d-m-Y', strtotime($fb->created_date));?></td>
                                    </tr>
                                    <?php $key++; endforeach;}
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
<script>
$(".filtersve").change(function(){
	
	$("#filtersve").submit();
	
})
</script>