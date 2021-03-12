
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
                                <h2>Meeting & Student Details</h2>
                            </div>
                                                
                        </div>
                               
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                       
                                        <th>S.no</th>
                                        <th>Student Name</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Session</th>
                                        <th>Amount</th>
                                        <th>Zoom Link</th>
                                        <th>Recording</th>
                                        
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($meetings){
                                            $key=1;
                                            foreach($meetings as $row):
                                        ?>
                                    <tr>
                                       
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $row->student_name;?></td>
                                        <td><?php echo date("d-m-Y",strtotime($row->exp_std_date));?></td>
                                        <td><?php echo date("H:i A", $row->exp_std_time);?></td>
                                        <td><?php echo $row->exp_std_duration;?></td>
                                        <td><?php echo $row->exp_std_cost;?></td>
                                        <td><?php if(date('Y-m-d H:i:s', strtotime('+ '.$row->exp_std_duration.' minutes', $row->exp_std_time)) >= date("Y-m-d H:i:s")){echo $row->zoom_link;}else{echo '<p style="color: red;">Meeting Time has beed completed.</p>';}?></td>
                                        <td><?php $play_url = $this->db->get_where("tbl_zoom_meetings", ["meeting_link" => $row->zoom_link])->row()->play_url;
                                        if($play_url!=''){?><a href="<? echo $play_url ?>" class="btn btn-success" target="_blank">Play Recording</a><?php } else {echo 'No Recording Found.';}?></td>
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
