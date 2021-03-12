
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
									<a href="<?php echo base_url('institute/sessions?ref=scheduled');?>">
											<div class="body">
												<div class="clearfix">
													<div class="float-left">
														<i class="fa fa-handshake-o text-col-green" style="font-size:25px;"></i>
													</div>
													<div class="number float-right text-right">
														<h6> Scheduled presentations  </h6>
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
									<a href="<?php echo base_url('institute/sessions?ref=completed');?>">
											<div class="body">
												<div class="clearfix">
													<div class="float-left">
														<i class="fa fa-check text-col-blue" style="font-size:25px;"></i>
													</div>
													<div class="number float-right text-right">
														<h6>Completed presentations</h6>
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
									<a href="<?php echo base_url('institute/sessions?ref=upcoming');?>">
											<div class="body">
												<div class="clearfix">
													<div class="float-left">
														<i class="fa fa-arrow-up text-col-red" style="font-size:25px;"></i>
													</div>
													<div class="number float-right text-right">
														<h6 style="font-size: 15px;">  To Be Completed Presentations</h6>
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
                        <div class="header">
                            <div class="col-lg-9 pull-left">
                            	<h2>Presentations </h2>
                                <div class="row">
                                    <div class="col-lg-12">
                                    <form>
                                    <div class="form-row align-items-center">
                                        <div class="col-auto">
                                        <div class="input-group mb-2">
                                        <label class="sr-only" for="inlineFormInputGroup">Auditorium</label>
                                        <select  class="form-control" name="auditorium" style="width: 239px;">
                                            <option value="">Select </option>
                                                <?php
                                                $auditorium_id = $this->input->get("auditorium");
                                                foreach ($auditorium as $row) {
                                                ?>
                                            <option <?php if($auditorium_id==$row->id){ echo 'selected';}?> value="<?php echo $row->id;?>"><?php echo $row->title;?></option>
                                                <?php } ?>
                                        </select>
                                        </div>
                                        </div>
                                        <div class="col-auto">
                                        <button type="submit" class="btn btn-primary mb-2">Submit</button>
                                        </div>
                                    </div>
                                    </form>
                                    </div>
                                </div>
                                
                            </div>
                            <a href="<?php echo base_url("institute/sessions/add_session");?>"><button type="button" class="btn btn-primary btn-block col-lg-2 pull-right"  data-target="#addevent">Add Presentation</button></a> <br>
                                                   
                        </div>
                               
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table-bordered table-striped table-hover dataTable js-exportable" width="100%">
                                <thead>
                                    <tr height="40px">
									    <th></th>
                                        <th>Sl.No.</th>
                                        <th>Auditorium</th>
                                        <th>Date</th>
                                        <th>From Time</th>
                                        <th>To Time</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Duration(In Minutes)</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($sessions){
                                            $key=1;
                                            foreach($sessions as $row){
												$aud = $this->db->get_where("tbl_institute_auditorium",["id"=>$row->auditorium])->row()->title;
	
												if($aud){
													
													$rstatus = false;
													$ref = $this->input->get("ref");
													if($ref == "scheduled"){
													
														$rstatus = true;	
														$chksch = $this->db->get_where("tbl_student_auditorium_presentations",["institute_id"=>$this->session->userdata['institute_id'],"presentation_id"=>$row->id])->num_rows();
														
													}
													
													if(($rstatus && ($chksch > 0)) || (!$rstatus)){
													
													
                                        ?>
													<tr>
														<td>
															<a href="<?php echo base_url("institute/sessions/add_session/").$row->id;?>" style="margin:0px 20px 0px 20px"><i class="fa fa-pencil"></i></a>
															<a href="#" name="<?php echo base_url("institute/sessions/delete_session/").$row->id;?>" class="kabdelete" style="margin:0px 20px 0px 0px"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
														</td>
														<td><?php echo $key;?></td>
														<td><?php echo $aud;?></td>
														<td><?php echo date("d-m-Y",strtotime($row->date));?></td>
														<td><?php if(isset($row->from_time)){ echo date('H:i A', $row->from_time);}?></td>
														<td><?php if(isset($row->to_time)){ echo date('H:i A', $row->to_time);}?></td>
														<td><?php echo $row->title;?></td>
														<td><?php echo $row->description;?></td>
														<td><?php echo $row->status;?></td>
														<td><?php echo $row->duration;?></td>
													</tr>
                                    <?php $key++; 
													}
												}
											}
										}
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
