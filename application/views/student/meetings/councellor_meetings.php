
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
                            	<h2>Meeting & Professor Details</h2>
                            </div>
                                                   
                        </div>
                               
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Sl.No</th>
                                        <th>Professor Name</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Session</th>
                                        <th>Zoom Link</th>
                                        <th>Zoom Password</th>
                                        <th>Link</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($councellormeetings){
                                            $key=1;
                                            foreach($councellormeetings as $row):
                                        ?>
                                    <tr>
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $row->expert_name;?></td>
                                        <td><?php echo date("d-m-Y",strtotime($row->exp_std_date));?></td>
                                        <td><?php echo date("H:i A", $row->exp_std_time);?></td>
                                        <td><?php echo $row->exp_std_duration;?></td>
                                        <?php
                                        if(date('Y-m-d H:i:s', strtotime('+ '.$row->exp_std_duration.' minutes', $row->exp_std_time)) >= date("Y-m-d H:i:s")){
                                        ?>
                                        <td><?php echo $row->zoom_link;?></td>
                                        <td><?php echo $row->zoom_password;?></td>
                                        <td><a href="<? echo $row->zoom_link ?>" class="btn btn-primary" target="_blank">Join</a></td>
                                        <?php
                                        }else{
                                        ?>
                                        <td colspan="3"><p style="color: red;">Meeting Time has beed completed. Please contact counselor for the details.</p></td>
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
