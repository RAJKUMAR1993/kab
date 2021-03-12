
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
                            <div class="col-lg-9 pull-left">
                            	<h2>Booked Sessions & Student Details</h2>
                            </div>
                                                
                        </div>
                               
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
									   
                                        <th>Sl.No</th>
                                        <th>IP Address</th>
                                        <th>Geo Loaction</th>
                                        <th>Student Name</th>
                                        <th>Student Email</th>
                                        <th>User Type</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        
                                        
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($logintime){
                                            $key=1;
                                            foreach($logintime as $row):
                                                $sdata = $this->db->get_where("tbl_students",["student_id"=>$row->student_id])->row();
                                        ?>
                                    <tr>
									   
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $row->ip_address;?></td>
                                        <td><?php echo $row->geolocation;?></td>
                                        <td><?php echo $sdata->student_name;?></td>
                                        <td><?php echo $sdata->email;?></td>
                                        <td><?php echo $row->type;?></td>
                                        <td><?php echo date("d-m-Y",strtotime($row->date));?></td>
                                        <td><?php echo $row->status;?></td>
                                        
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
