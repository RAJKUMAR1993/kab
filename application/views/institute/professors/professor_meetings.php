
<style>
    td.details-control {
    background: url('<?php echo base_url(); ?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
    tr.shown td.details-control {
        background: url('<?php echo base_url(); ?>assets/images/details_close.png') no-repeat center center;
    }
    .col-lg-9{
        padding-left: 4px;
    }
</style>

<div id="main-content">
        <div class="container-fluid">
            
                            <div class="row">
					<!-- Column -->
					<div class="col-lg-12 col-md-12">
						<div class="card" style="border:0px">
							<div class="card-body">
							<div class="row">
								<div class="col-lg-4 col-md-4 col-sm-6">
									<a href="<?php echo base_url('institute/councellors/professor_meetings?ref=scheduled');?>">
											<div class="body">
												<div class="clearfix">
													<div class="float-left">
														<i class="fa fa-handshake-o text-col-green" style="font-size:25px;"></i>
													</div>
													<div class="number float-right text-right">
														<h6> Scheduled </h6>
														<span class="font700"><?php echo $booked;?></span>
													</div>
												</div>
												<div class="progress progress-xs progress-transparent custom-color-green mb-0 mt-3">
													<div class="progress-bar" data-transitiongoal="87"></div>
												</div>
											</div>
										</a>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-6">
									<a href="<?php echo base_url('institute/councellors/professor_meetings?ref=completed');?>">
											<div class="body">
												<div class="clearfix">
													<div class="float-left">
														<i class="fa fa-check text-col-blue" style="font-size:25px;"></i>
													</div>
													<div class="number float-right text-right">
														<h6>Completed</h6>
														<span class="font700"><?php echo $completed;?></span>
													</div>
												</div>
												<div class="progress progress-xs progress-transparent custom-color-blue mb-0 mt-3">
													<div class="progress-bar" data-transitiongoal="87"></div>
												</div>
											</div>
										</a>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-6">
									<a href="<?php echo base_url('institute/councellors/professor_meetings?ref=upcoming');?>">
											<div class="body">
												<div class="clearfix">
													<div class="float-left">
														<i class="fa fa-arrow-up text-col-red" style="font-size:25px;"></i>
													</div>
													<div class="number float-right text-right">
														<h6 style="font-size: 15px;">  To Be Completed</h6>
														<span class="font700"><?php echo $upcoming; ?></span>
													</div>
												</div>
												<div class="progress progress-xs progress-transparent custom-color-red mb-0 mt-3">
													<div class="progress-bar" data-transitiongoal="87"></div>
												</div>
											</div>
										</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				</div>

            
            <div class="row clearfix">                
                <div class="col-lg-12">
                    <div class="card">
                      
                        <div class="body">
                        <div class="table-responsive">
                           
                           <? 
							$ref = $this->input->get("ref");
							
							if($ref == "scheduled"){
							
							?>
                           
								<table class="table table-bordered table-striped table-hover dataTable js-exportable">
									<thead>
										<tr>
											<th>Sl.No.</th>
											<th>Professor Name</th>  
											<th>Student Name</th>  
											<th>Date</th>
											<th>Time</th>
											<th>Duration</th>

										</tr>
									</thead>
									<tbody>
										<?php if($sessions){
												$key=1;
												foreach($sessions as $row){

											?>
										<tr>
											<td><?php echo $key;?></td>
											<td><?php echo $this->db->get_where("tbl_councellors",["id"=>$row->expert_id])->row()->expert_name;?></td>
											<td><?php echo $this->db->get_where("tbl_students",["student_id"=>$row->student_id])->row()->student_name;?></td>
											<td><?php echo date("d-m-Y",strtotime($row->exp_std_date)); ?></td>
											<td><?php echo date('h:i A', $row->exp_std_time);?></td>
											<td><?php echo $row->exp_std_duration; ?></td>
										</tr>
										<?php $key++; }

											}
										?>

									</tbody>
								</table>
                           
                            <? }else{ ?> 
                            
                            	<table class="table table-bordered table-striped table-hover dataTable js-exportable">
									<thead>
										<tr>
											<th>Sl.No.</th>
											<th>Professor Name</th>  
											<th>Date</th>
											<th>Time</th>
											<th>Duration</th>

										</tr>
									</thead>
									<tbody>
										<?php if($sessions){
												$key=1;
												foreach($sessions as $row){

											?>
										<tr>
											<td><?php echo $key;?></td>
											<td><?php echo $this->db->get_where("tbl_councellors",["id"=>$row->expert_id])->row()->expert_name;?></td>
											<td><?php echo date("d-m-Y",strtotime($row->exp_se_date)); ?></td>
											<td><?php echo date('h:i A', $row->exp_std_time);?></td>
											<td><?php echo $row->duration; ?></td>
										</tr>
										<?php $key++; }

											}
										?>

									</tbody>
								</table>
                          
                          	 <? } ?>
                           
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
