
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
                            	<h2>Admission Details</h2>
                            </div>
                                               
                        </div>
                               
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr height="40px"> 
                                        <th>S.no</th>
                                        <th>Institute Name</th>
                                        <th>Course Name</th>
                                        <th>Specialization</th>
                                        <th>Duration</th>
                                       <th>Applied Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($details){
                                            $key=1;
                                          //  print_r($details);
                                           foreach($details as $row):
                                        
                                        ?>
                                    <tr>
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $this->homepage_model->get_insdetails($row->institute_id)->institute_name;?></td>
                                        <td><?php echo $row->course_name;?></td>
                                        <td><?php echo $row->specialization;?></td>
                                        <td><?php echo $row->course_duration;?></td>
                                       <td><?php   echo $row->created_date;?></td>
                                        <td><?php echo $row->status;?></td>
										<td><a href="<?php echo base_url(); ?>student/myapplications/detail_view/<?php echo $row->institute_id;?>">Detailed View</a></td>
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
