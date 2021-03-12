
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
									   
                                        <th>S.no</th>
                                        <th>Student Name</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Session</th>
                                        <th>Zoom Link</th>
                                        <th>Start</th>
                                        <th>Recording</th>
                                        <th>Converted Text</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($meetings){
                                            $key=1;
                                            foreach($meetings as $row):
												$mtg = $this->db->get_where("tbl_zoom_meetings", ["meeting_link" => $row->zoom_link])->row();
                                        ?>
                                    <tr>
									   
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $row->student_name;?></td>
                                        <td><?php echo date("d-m-Y",strtotime($row->exp_std_date));?></td>
                                        <td><?php echo date("H:i A", $row->exp_std_time);?></td>
                                        <td><?php echo $row->exp_std_duration;?></td>
                                        <?php
                                        if(date('Y-m-d H:i:s', strtotime('+ '.$row->exp_std_duration.' minutes', $row->exp_std_time)) >= date("Y-m-d H:i:s")){
                                        ?>
                                        <td><?php echo $row->zoom_link;?></td>
                                        <td><a href="<? echo $row->zoom_link ?>" class="btn btn-success" target="_blank">Start</a></td>
                                        <?php
                                        }else{
                                        ?>
                                        <td colspan="2"><p style="color: red;">Meeting Time has beed completed.</p></td>
                                        <?php
                                        }
                                        ?>
                                        <td><?php $play_url = $mtg->play_url;
                                        if($play_url!=''){?><a href="<? echo base_url().$play_url ?>" class="btn btn-success" target="_blank">Play Recording</a><?php } else {echo 'No Recording Found.';}?></td>
                                        
                                        <td><?php $converted_text = $mtg->converted_text;
                                        if($converted_text!=''){?><a href="<? echo base_url('counsellor/meetings/downloadText/').$mtg->id ?>" class="btn btn-success" target="_blank">Download</a><?php } else {echo 'No Text Found.';}?></td>
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
