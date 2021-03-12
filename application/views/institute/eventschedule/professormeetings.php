
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
            <div class="block-header">
           
            </div>
            
            <div class="row clearfix">
                
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header instituteHeader">
                            <div class="col-md-6 pull-left">
                            <h2>Professors meetings</h2>

                            </div>
                            <div class="col-md-6 pull-right">
                                 
                               
                            </div>
                                                   
                        </div>
                               
                        <div class="body">
                        <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <!-- <th>Student Name</th> -->
                                        <th>Professor Name</th>
                                        <th>Title</th>
                                        <th>Date</th>
                                        <th>From Time</th>
                                        <th>To Time</th>
                                        <th>Zoom Link</th>
                                        <th>Zoom Password</th>
                                        <th>Recording</th>
                						<th>Converted Text</th> 
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($meeting){
                                            $key=1;
                                            foreach($meeting as $row):
												//$mtg = $this->db->get_where("tbl_zoom_meetings", ["meeting_link" => $row->zoom_link])->row();
                                        ?>
                                    <tr>
																	<td><?php echo $key;?></td>
																	<td><?php echo $this->db->get_where("tbl_councellors",array("id"=> $row->expert_id))->row()->expert_name;?></a></td>
																	<td><?php echo $this->db->get_where("tbl_counsellor_sessions",["exp_se_id"=>$row->session_id])->row()->title;?></td>
																	<td><?php echo date("d-m-Y",strtotime($row->exp_std_date));?></td>
																	<td><?php echo date("H:i A", $row->exp_std_time);?></td>
																	<td><?php echo date("H:i A", $row->to_time);?></td>
																	<?php
																	if(date("Y-m-d H:i", strtotime($row->date." ".date("H:i", $row->to_time))) >= date("Y-m-d H:i")){
																	?>
                                                                    <td><a href="<? echo $row->zoom_link ?>" class="btn btn-primary" target="_blank">Join</a></td>
                                                                        <td><?php echo $row->zoom_password;?></td>
                                                                        <?php
                                                                        }else{
                                                                        ?>
                                                                    <td><p style="color: red;">Presentation Time has been completed.</p></td>
                                                                    <td></td>
																	<?php
																	}
																	?>
																	<td><?php $play_url = $row->play_url;
																	if($play_url!=''){?><a href="<? echo base_url().$play_url ?>" class="btn btn-success" target="_blank">Play Recording</a><?php } else {echo 'No Recording Found.';}?></td>

																	<td><?php $converted_text = $row->converted_text;
																	if($converted_text!=''){?><a href="<? echo base_url('institute/sessions/downloadText/').$row->id ?>" class="btn btn-success" target="_blank">Download</a><?php } else {echo 'No Text Found.';}?></td>
																</tr>
																<?php $key++; endforeach;}
																else{ echo "No records found";}
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
