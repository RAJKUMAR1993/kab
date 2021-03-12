
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
                        <form method="get" id="filtersve">
                  <div class="row">
                     <div class="col-lg-4 col-md-4 col-sm-6">
							<a href="<?php echo base_url('student/meetings/expertmeetings');?>?meeting=professor">
								<div class="body">
									<div class="clearfix">
										<div class="float-left">
											<i class="fa fa-meetup text-col-green" style="font-size:25px;"></i>
										</div>
										<div class="number float-right text-right">
											<h6>Professors Meeting</h6>
                                            <span class="font700"><?php 
                                            echo $this->db->get_where("tbl_experts",["expert_status"=>"active","expert_designation"=>"professor","is_deleted"=>0])->num_rows();?></span>
										</div>
									</div>
									<div class="progress progress-xs progress-transparent custom-color-green mb-0 mt-3">
										<div class="progress-bar" data-transitiongoal="87"></div>
									</div>
							       <!-- <small class="text-muted">19% compared to last week</small>  -->
								</div>
							</a>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6">
							<a href="<?php echo base_url('student/meetings/expertmeetings');?>?meeting=counsellor">
								<div class="body">
									<div class="clearfix">
										<div class="float-left">
											<i class="fa fa-meetup text-col-green" style="font-size:25px;"></i>
										</div>
										<div class="number float-right text-right">
											<h6>Counsellor Meeting</h6>
                                            <span class="font700">
                                                <?php
                                                  echo $this->db->get_where("tbl_experts",["expert_status"=>"active","expert_designation"=>"Sr. Counsellor","is_deleted"=>0])->num_rows();
                                                ?>
                                             </span>
										</div>
									</div>
									<div class="progress progress-xs progress-transparent custom-color-green mb-0 mt-3">
										<div class="progress-bar" data-transitiongoal="87"></div>
									</div>
							       <!-- <small class="text-muted">19% compared to last week</small>  -->
								</div>
							</a>
                            </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="body">
                                <div class="clearfix">
                                        <div class="form-group">
                                            <label>Expert</label>
                                                <select class="form-control filtersve" name="expert_designation">
                                                    <option value="">Select Expert</option>
                                                    <? $expert = $this->db->query("select expert_designation from tbl_experts group by expert_designation")->result();
                                                        foreach($expert as $ex){
                                                            $expt = ($this->input->get("expert_designation") == $ex->expert_designation) ? 'selected' : '';
                                                            echo '<option value="'.$ex->expert_designation.'" '.$expt.'>'.$ex->expert_designation.'</option>';
                                                        }				   
                                                    ?>
                                                </select>
                                        </div>
                                </div>
                            </form>
                        </div>
                    </div>  
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="body">
                                <div class="clearfix">
                                        <div class="form-group">
                                            <label>Date</label>
                                                <select class="form-control filtersve" name="created">
                                                    <option value="">Select Date</option>
                                                    <? $created = $this->db->query("select created from tbl_experts group by created")->result();
                                                    foreach($created as $d){
                                                        $create = ($this->input->get("created") == $d->created) ? 'selected' : '';
                                                        echo '<option value="'.$d->created.'" '.$create.'>'.date("d-m-Y",strtotime($d->created)).'</option>';
                                                    }				   
                                                    ?>
                                                </select>
                                        </div>
                                </div>
                        </div>
                        </div>
                  </form>
                            <div class="col-lg-9 pull-left">
                            	<h2>Meeting & Expert Details</h2>
                            </div>
                                               
                        </div>
                               
                        <div class="body">
                        <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr> 
                                        <th>Sl.No.</th>
                                        <th>Expert Name</th>
                                        <th>Create Date</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Duration</th>
                                        <th>Amount</th> 
                                        <th>Zoom Link</th>
                                        <th>Zoom Password</th>
                                        <th>Link</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    
                                    if($expertmeetings){
                                            $key=1;
                                            foreach($expertmeetings->result() as $row): //echo "<pre/>"; print_r($row);
                                        ?>
                                    <tr>
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $row->expert_name;?></td>
                                        <td><?php echo $row->created;?></td>
                                        <td><?php echo date("d-m-Y",strtotime($row->exp_std_date));?></td>
                                        <td><?php echo date("H:i A", $row->exp_std_time);?></td>
                                        <td><?php echo $row->exp_std_duration;?></td>
                                        <td><?php echo $row->exp_std_cost;?></td>
                                        <?php
                                        if(date('Y-m-d H:i:s', strtotime('+ '.$row->exp_std_duration.' minutes', $row->exp_std_time)) >= date("Y-m-d H:i:s")){
                                        ?>
                                        <td><?php echo $row->zoom_link;?></td>
                                        <td><?php echo $row->zoom_password;?></td>
                                        <td><a href="<? echo $row->zoom_link ?>" class="btn btn-primary" target="_blank">Join</a></td>
                                        <?php
                                        }else{
                                        ?>
                                        <td colspan="3"><p style="color: red;">Meeting Time has beed completed. Please contact expert for the details.</p></td>
                                        <?php
                                        }
                                        ?>
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
    </div>
    <script>
	$(".filtersve").change(function(){
	$("#filtersve").submit();
	//alert($(this).val());

});
</script>
