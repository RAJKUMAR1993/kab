
<style>
    td.details-control {
    background: url('<?php echo base_url(); ?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
    tr.shown td.details-control {
        background: url('<?php echo base_url(); ?>assets/images/details_close.png') no-repeat center center;
    }
    .col-lg-9{
        padding-left: 4px;
    }
</style>

<div id="main-content">
        <div class="container-fluid">
            
            <div class="row clearfix">
                
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-6">
                                    <a href="<?php echo base_url('institute/videoconnect');?>">
                                        <div class="body">
                                            <div class="clearfix">
                                                <div class="float-left">
                                                    <i class="fa fa-video-camera text-col-green" style="font-size:25px;"></i>
                                                </div>
                                                <div class="number float-right text-right">
                                                    <h6> Total Meetings</h6>
                                                    <span class="font700"><?php  echo $this->db->get_where("tbl_college_connect",["institute_id"=>$this->session->userdata('institute_id')])->num_rows();?></span>
                                                </div>
                                            </div>
                                            <div class="progress progress-xs progress-transparent custom-color-green mb-0 mt-3">
                                                <div class="progress-bar" data-transitiongoal="87"></div>
                                            </div>
                                            <!-- <small class="text-muted">19% compared to last week</small> -->
                                        </div>
                                    </a>
                                </div>
                                <? 
                                
                                $name = $this->db->where("institute_id",$this->session->userdata('institute_id'))->order_by("id", "desc")->group_by('name')->get("tbl_college_connect")->result();
                                

                                    $colors = ["red","blue","green","purpole"];		
    
                                    $key=1;
                              
                                foreach($name as $admin_wise){	
                                    $color = array_rand($colors);
							?>
                        	
                        		<div class="col-lg-4 col-md-4 col-sm-6">
								  <a href="<?php echo base_url('institute/videoconnect?instname='.$admin_wise->name);?>">
									<div class="body">

										<div class="clearfix">
											<div class="float-left">
												<i class="fa fa-2x fa-graduation-cap text-col-<? echo $colors[$color] ?>" style="font-size:25px;"></i>
											</div>
											<div class="number float-right text-right">
												
												<h6><? echo $admin_wise->name ?></h6>
												
                                                <span class="font700"><?php 
                                                $id = $this->session->userdata('institute_id');
                                                echo $this->db->where("institute_id", $id)->where("name", $admin_wise->name)->get("tbl_college_connect")->num_rows();
                                                
                                                //$this->db->get_where("tbl_college_connect",["institute_id",$this->session->userdata('institute_id'),"designation"=>$admin_wise->designation])->num_rows();?></span>
											</div>
										</div>
										<div class="progress progress-xs progress-transparent custom-color-blue mb-0 mt-3">
											<div class="progress-bar" data-transitiongoal="87"></div>
										</div>
										<!-- <small class="text-muted">19% compared to last week</small> -->
									</div>
								  </a>
								</div>
                        	
                        	<?  } ?>
                            </div>
                            <div class="col-lg-9 pull-left">
                            	<h2>Video Connect </h2>
                            </div>
                            <a href="<?php echo base_url("institute/videoconnect/add_meeting");?>"><button type="button" class="btn btn-primary btn-block col-lg-2 pull-right"  data-target="#addevent">Add Meeting</button></a> <br>                   
                        </div>
                        <form method="get">
							<div class="row" style="margin-left: 5px;">   
							  <div class="col-md-5">   
								<div class="form-group">
									<label>Select Start & End Date :</label>
									<div class="input-daterange input-group" id="date-range">
										<input type="text" class="form-control" name="startDate" id="sdate" placeholder="Start Date" autocomplete="off" value="<? echo $this->input->get("startDate") ?>" required>
										<div class="input-group-append">
											<span class="input-group-text bg-info b-0 text-white">TO</span>
										</div>
										<input type="text" class="form-control" name="endDate" id="edate" placeholder="End Date" autocomplete="off" value="<? echo $this->input->get("endDate") ?>" required/>
									</div>
								</div>
							  </div>		

							  <div class="col-md-2">

								<button id="filter" type="submit" class="btn btn-info waves-effect waves-light m-t-30">Submit</button>

							  </div> 

						   </div> 
                        </form>
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
									    <th>Action</th>
                                        <th>Sl.No.</th>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Date</th>
                                        <th>From Time</th>
                                        <th>To Time</th>
                                        <th>Status</th>
                                         <th>Zoom Link</th>
                                        <th>Zoom Password</th>
                                        <th>Recording</th>
										<th>Converted Text</th> 
                                
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($collegeconnect){
                                            $key=1;
											$date = strtotime(date("Y-m-d H:i:s"));
                                            foreach($collegeconnect as $row):
	
												$status = "";
												if($date > $row->to_time){
													
													$status = "Completed";
													
												}elseif(($date >= $row->from_time) && ($date <= $row->to_time)){
													
													$status = "To be completed";
													
												}else{
													
													$status = "Scheduled";
													
												}	
                                        ?>
                                    <tr>
									    <td>
                                            <a href="<?php echo base_url("institute/videoconnect/add_meeting/").$row->id;?>" style="margin:0px 20px 0px 20px"><i class="fa fa-pencil"></i></a>
                                            <a href="#" name="<?php echo base_url("institute/videoconnect/delete_meeting/").$row->id;?>" class="kabdelete" style="margin:0px 20px 0px 0px"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        </td>
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $row->name;?></td>
                                        <td><?php echo $row->designation;?></td>
                                        <td><?php echo date("d-m-Y",strtotime($row->date));?></td>
                                        <td><?php if(isset($row->from_time)){ echo date('H:i A', $row->from_time);}?></td>
                                        <td><?php if(isset($row->to_time)){ echo date('H:i A', $row->to_time);}?></td>
                                        <td><?php echo $status; ?></td>
                                        <?php
                                        if(date("Y-m-d H:i:s", $row->to_time) >= date("Y-m-d H:i:s")){
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
                                       <td>
                                           <?php 
                                            $play_url = $row->play_url;
									      if($play_url!=''){?>
                                          <a href="<? echo base_url().$play_url ?>" class="btn btn-success" target="_blank">Play Recording</a><?php } else {echo 'No Recording Found.';}?>
                                        </td>
										<td><?php $converted_text = $row->converted_text;
                                        if($converted_text!=''){?><a href="<? echo base_url('institute/videoconnect/downloadText/').$row->id ?>" class="btn btn-success" target="_blank">Download</a><?php } else {echo 'No Text Found.';}?></td>
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
   
<link rel="stylesheet" type="text/css" href="<? echo base_url('assets/') ?>css/bootstrap-datepicker.min.css">  
<script src="<? echo base_url('assets/') ?>js/bootstrap-datepicker.min.js"></script>         
    
    <script type="text/javascript">
        function copyToClipboard(element){
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).text()).select();
            document.execCommand("copy");
            $temp.remove();
        }
    </script>
<script>
$(".filtersve").change(function(){
	$("#filtersve").submit();
	//alert($(this).val());
})

jQuery('#date-range').datepicker({
	toggleActive: true,
	minDate: 0,
	dateFormat: "dd-mm-yy",
});
</script>

<script>
// $(".filtersve1").change(function(){
// 	$("#filtersve1").submit();
// 	alert($(this).val());
// })
</script>
    <script type="text/javascript">
        function copyToClipboard(element){
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).text()).select();
            document.execCommand("copy");
            $temp.remove();
        }
    </script>
<script>
$(".filtersve").change(function(){
	$("#filtersve").submit();
	//alert($(this).val());
})
</script>

<script>
// $(".filtersve1").change(function(){
// 	$("#filtersve1").submit();
// 	alert($(this).val());
// })
</script>