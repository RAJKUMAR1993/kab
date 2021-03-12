<? $institute_id = $this->session->userdata['institute_id']; 
   $avgRating = round($this->db->query("select AVG(srating) as rating from tbl_institute_feedbackrating where institute_id=$institute_id")->row()->rating);	
?>
<style>
    td.details-control {
		background: url('<?php echo base_url(); ?>assets/images/details_open.png') no-repeat center center;
		cursor: pointer;
	}
    tr.shown td.details-control {
        background: url('<?php echo base_url(); ?>assets/images/details_close.png') no-repeat center center;
    }

.checked {
  color: orange;
}

/* Three column layout */
.side {
  float: left;
  width: 20%;
  margin-top:10px;
}

.rmiddle {
  margin-top:10px;
  float: left;
  width: 60%;
}

/* Place text to the right */
.right {
  text-align: right;
}	
	
/* The bar container */
.bar-container {
  width: 100%;
  background-color: #f1f1f1;
  text-align: center;
  color: white;
}

/* Individual bars */
<? foreach($feedback_ratings as $k => $feed){ ?>
	
	.bar-<? echo ++$k ?> {width: <? echo ($feed["count"]/$total_feedback)*100 ?>%; height: 18px; background-color: <? echo $feed["color"] ?>;}
	
<? } ?>	
</style>

<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
           
            </div>
            
            <div class="row clearfix">
                
                <div class="col-lg-9">
                    <div class="card">
                        <div class="header instituteHeader">
                            <div class="col-md-6 pull-left">
                            	<h2>Feedback Report</h2>
                            </div>                    
                        </div>
                               
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Rating</th>
                                        <th>Comment</th>
                                        <th>Date</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($feedback){
                                            $key=1;
                                            foreach($feedback as $fb):
                                                $name = 'Anonymous';
                                                $email = 'Anonymous';
                                                if($fb->student_id!='anonymous'){
                                                    $student = $this->db->where("student_id", $fb->student_id)->get("tbl_students")->row();
                                                    $name = $student->student_name;
                                                    $email = $student->email;
                                                }
                                                
                                        ?>
                                    <tr>
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $name;?></td>
                                        <td><?php echo $email;?></td>
                                        <td><?php echo $fb->srating;?></td>
                                        <td style="white-space: break-spaces;"><?php echo $fb->comment;?></td>
                                        <td><?php echo date('d-m-Y', strtotime($fb->created_date));?></td>
                                    </tr>
                                    <?php $key++; endforeach;}
                                    ?>
                                
                                </tbody>
                              
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                	<div class="card">
                		<div class="body">
							<span class="heading">User Rating</span>
							<? foreach($feedback_ratings as $kk => $ufeed){ ?>
								<span class="fa fa-star <? echo ($kk <= ($avgRating-1)) ? 'checked' : '' ?>"></span>
							<? } ?>	
							
							<p><? echo $avgRating; ?> average based on <? echo $total_feedback; ?> reviews.</p>
							<hr style="border:3px solid #f1f1f1">

							<div class="row" style="padding: 10px">
						  
						  	<? foreach($feedback_ratings as $kk => $feed){ ?>	
						  
								  <div class="side">
									<div><? echo $feed["rating"] ?> </div>
								  </div>
								  <div class="rmiddle">
									<div class="bar-container">
									  <div class="bar-<? echo ++$kk ?>"></div>
									</div>
								  </div>
								  <div class="side right">
									<div><? echo $feed["count"] ?></div>
								  </div>
								  
							<? } ?>  
							  
							</div>

						</div>
					</div>
                	
                </div>
                
            </div>

            
        </div>
    </div>
