
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
                            	<h2>Logged In Students</h2>
                            </div>
                                               
                        </div>
                               
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr> 
                                        <th>S.no</th>
                                        <th>Student Name</th>
                                        <th>Student Email</th>
                                        <th>Student Mobile</th>
                                        <th>User Type</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($details){
                                            $key=1;
                                           // print_r($details);
                                           foreach($details as $r):
                                        
											$row = $this->db->get_where("tbl_students",["student_id"=>$r->student_id])->row(); 
                                        ?>
                                   <tr>
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $row->student_name;?></td>
                                        <td><?php echo $row->email;?></td>
                                        <td><?php echo $row->phone;?></td>
                                        <td><?php echo $r->type;?></td>
                                        <td><?php echo $r->status;?></td>
                                        
                                    </tr>
                                    <?php $key++; endforeach;}else{ echo "No records found";}?>
                                
                                </tbody>
                              
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>


