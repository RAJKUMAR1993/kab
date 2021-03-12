
<style>
    td.details-control {
    background: url('<?php echo base_url(); ?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
    tr.shown td.details-control {
        background: url('<?php echo base_url(); ?>assets/images/details_close.png') no-repeat center center;
    }
</style>
<?php  //$this->db->query("SELECT * FROM tbl_speaker_student_schedule LEFT JOIN tbl_students ON tbl_speaker_student_schedule.student_id = tbl_students.student_id WHERE tbl_speaker_student_schedule.speaker_id='".$this->session->userdata['speaker_id']."' ORDER BY spe_std_date DESC")->result(); ?>
<div id="main-content">
        <div class="container-fluid">
            
            <div class="row clearfix">
                
                <div class="col-lg-12">
                    <div class="card">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <a href="<?php echo base_url('speaker/meetings');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class=" fa fa-book text-col-blue text-col-blue" style="font-size:25px;"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6> Total Booked Sessions</h6>
                                            <span class="font700"><?php echo $meetings_total; ?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-blue mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="87"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
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
                                        <th>Student Email</th>
                                        <th>Student Phone Number</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Session</th>
                                        <th>Amount</th>
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
                                        <td><?php echo $row->email;?></td>
                                        <td><?php echo $row->phone;?></td>
                                        <td><?php echo date("d-m-Y",strtotime($row->spe_std_date));?></td>
                                        <td><?php echo date("H:i A", $row->spe_std_time);?></td>
                                        <td><?php echo $row->spe_std_duration;?></td>
                                        <td><?php echo $row->spe_std_cost;?></td>
                                        <?php
                                        if(date('Y-m-d H:i:s', strtotime('+ '.$row->spe_std_duration.' minutes', $row->spe_std_time)) >= date("Y-m-d H:i:s")){
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
                                        if($converted_text!=''){?><a href="<? echo base_url('speaker/meetings/downloadText/').$mtg->id ?>" class="btn btn-success" target="_blank">Download</a><?php } else {echo 'No Text Found.';}?></td>
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
