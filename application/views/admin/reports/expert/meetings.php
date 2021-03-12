
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
                            <div class="col-lg-12 pull-left">
                            	<h2>Booked Sessions & Student Details</h2>
	                            <a href="<?php echo base_url("admin/reports/expert_reports");?>"><button type="button" class="btn btn-primary btn-block col-lg-3 pull-right"  data-target="#addevent">Expert Councellor Reports</button></a> <br><br>
                            </div>
                                                
                        </div>
                               
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
									   
                                        <th>S.no</th>
                                        <th>Expert Councellor</th>
                                        <th>Student Name</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Session</th>
                                        <th>Amount</th>
                                        
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($meetings){
                                            $key=1;
                                            foreach($meetings as $row):
                                        ?>
                                    <tr>
									   
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $this->db->get_where("tbl_experts",["expert_id"=>$row->expert_id])->row()->expert_name;?></td>
                                        <td><?php echo $row->student_name;?></td>
                                        <td><?php echo date("d-m-Y",strtotime($row->exp_std_date));?></td>
                                        <td><?php echo date("H:i A", $row->exp_std_time);?></td>
                                        <td><?php echo $row->exp_std_duration;?></td>
                                        <td><?php echo $row->exp_std_cost;?></td>
                                        
                                        
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
