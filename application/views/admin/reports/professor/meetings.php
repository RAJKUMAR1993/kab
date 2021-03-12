
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
	                            <a href="<?php echo base_url("admin/reports/professor_reports");?>"><button type="button" class="btn btn-primary btn-block col-lg-3 pull-right"  data-target="#addevent">Professor Reports</button></a> <br><br>
                            </div>
                                                
                        </div>
                               
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
									   
                                        <th>S.no</th>
                                        <th>Professor</th>
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
                                        <td><?php echo $this->db->get_where("tbl_professors",["pro_id "=>$row->session_pro_id ])->row()->pro_name;?></td>
                                        <td><?php echo $row->student_name;?></td>
                                        <td><?php echo date("d-m-Y",strtotime($row->session_date));?></td>
                                        <td><?php echo date("H:i A", $row->session_time);?></td>
                                        <td><?php echo $row->session_type;?></td>
                                        <td><?php echo $row->session_cost;?></td>
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
