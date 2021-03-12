
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
           
           		<div class="header instituteHeader row">
					<div class="col-md-3 pull-left">
						<h2>Booked Presentations </h2>
					</div>
					<div class="col-lg-9 col-md-9 col-sm-12 text-right">
						<ul class="breadcrumb justify-content-end" style="background-color: transparent">
							<li class="breadcrumb-item"><a href="<? echo base_url('admin/dashboard') ?>"><i class="icon-home"></i></a></li>
							<li class="breadcrumb-item active">Booked Presentations</li>
						</ul>
					</div>                                                   
				</div>
           
            </div>
            
            <div class="row clearfix">
                
                <div class="col-lg-12">
                    <div class="card">
                       
                        <div class="body">
                        <form method="get" id="filtersve">
						<div class="row">
							
							<div class="col-md-4">
								
								<div class="form-group">
								<label>Auditorium</label>
									<select class="form-control filtersve" name="auditorium">
										<option value="">Select Auditorium</option>
										<? $institutes = $this->db->query("select tv.auditorium_id,ti.title from tbl_student_auditorium_presentations tv join tbl_institute_auditorium ti on tv.auditorium_id=ti.id group by tv.auditorium_id")->result();

											foreach($institutes as $ins){
												$insname = ($this->input->get("auditorium") == $ins->auditorium_id) ? 'selected' : '';
												echo '<option value="'.$ins->auditorium_id.'" '.$insname.'>'.$ins->title.'</option>';
											}				   
										?>

									</select>
								</div>
								
							</div>
							<div class="col-md-4">
								<div class="form-group">
								<label>Date</label>
									<select class="form-control filtersve" name="date">
										<option value="">Select Date</option>
										<? $dates = $this->db->query("select date from tbl_student_auditorium_presentations group by date")->result();

											foreach($dates as $d){
												$date = ($this->input->get("date") == $d->date) ? 'selected' : '';
												echo '<option value="'.$d->date.'" '.$date.'>'.date("d-m-Y",strtotime($d->date)).'</option>';
											}				   
										?>

									</select>
								</div>
								
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<a href="<? echo base_url('admin/auditorium/auditorium_presentations') ?>" class="btn btn-primary" style="margin-top: 25px">Clear</a>
								</div>
								
							</div>
							</form>
						</div>
                       
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Student Name</th>
                                        <th>Institute Name</th>
                                        <th>Title</th>
                                        <th>Auditorium</th>
                                        <th>Date</th>
                                        <th>From Time</th>
                                        <th>To Time</th>
                                        <th>Zoom Link</th>
                                        <th>Zoom Password</th>
                                        <th>Link</th>
                                        <th>Recording</th>
                						<th>Converted Text</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($webinars){
                                            $key=1;
                                            foreach($webinars as $row):
												$mtg = $this->db->get_where("tbl_zoom_meetings", ["meeting_link" => $row->zoom_link])->row();
                                        ?>
                                    <tr>
                                        <td><?php echo $key;?></td>
                                        <td><a href="<? echo base_url('admin/students/view_student/').$row->student_id ?>"><?php echo $this->db->get_where("tbl_students",["student_id"=>$row->student_id])->row()->student_name;?></a></td>
                                        <td><?php echo $this->db->get_where("tbl_institutes",["institute_id"=>$row->institute_id])->row()->institute_name;?></td>
                                        <td><?php echo $this->db->get_where("tbl_institute_presentations",["id"=>$row->presentation_id])->row()->title;?></td>
                                        <td><?php echo $this->db->get_where("tbl_institute_auditorium",["id"=>$row->auditorium_id])->row()->title;?></td>
                                        <td><?php echo date("d-m-Y",strtotime($row->date));?></td>
                                        <td><?php echo date("H:i A", $row->from_time);?></td>
                                        <td><?php echo date("H:i A", $row->to_time);?></td>
                                        <?php
                                        if(date("Y-m-d H:i", strtotime($row->date." ".date("H:i", $row->to_time))) >= date("Y-m-d H:i")){
                                        ?>
                                        <td><?php echo $row->zoom_link;?></td>
                                        <td><?php echo $row->zoom_password;?></td>
                                        <td><a href="<? echo $row->zoom_link ?>" class="btn btn-primary" target="_blank">Join</a></td>
                                        <?php
                                        }else{
                                        ?>
                                        <td colspan="3"><p style="color: red;">Presentation Time has been completed.</p></td>
                                        <?php
                                        }
                                        ?>
                                        <td><?php $play_url = $mtg->play_url;
                                        if($play_url!=''){?><a href="<? echo base_url().$play_url ?>" class="btn btn-success" target="_blank">Play Recording</a><?php } else {echo 'No Recording Found.';}?></td>
                                        
                                        <td><?php $converted_text = $mtg->converted_text;
                                        if($converted_text!=''){?><a href="<? echo base_url('admin/auditorium/downloadText/').$mtg->id ?>" class="btn btn-success" target="_blank">Download</a><?php } else {echo 'No Text Found.';}?></td>
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
    
<script>
	$(".filtersve").change(function(){

		$("#filtersve").submit();

	})
</script>