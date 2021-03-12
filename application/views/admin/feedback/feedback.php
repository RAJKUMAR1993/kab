
<style>
    td.details-control {
    background: url('<?php echo base_url(); ?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
    tr.shown td.details-control {
        background: url('<?php echo base_url(); ?>assets/images/details_close.png') no-repeat center center;
    }
</style>
<style type="text/css">
    
	.ct-chart svg g foreignObject span{
		
		color: black !important;
		width: 70px !important;
		
	}
	
</style>

<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
           		<div class="header instituteHeader row">
					<div class="col-md-3 pull-left">
						<h2>Feedback Report</h2>
					</div>
					<div class="col-lg-9 col-md-9 col-sm-12 text-right pull-right">
						<ul class="breadcrumb justify-content-end" style="background-color: transparent">
							<li class="breadcrumb-item"><a href="<? echo base_url('admin/dashboard') ?>"><i class="icon-home"></i></a></li>
							<li class="breadcrumb-item active">Feedback Report</li>
						</ul>
					</div>                    
				</div>
           
            </div>
            
            <div class="row clearfix">
                
                <div class="col-lg-12">
                    <div class="card">
                        
                               
                        <div class="body row">
                        <div class="table-responsive col-md-8">
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
                            
                            <div class="col-md-4">
                            	
                            	<div class="card">
									<div class="header">
										<div class="col-md-12">
											<h2>Graphical Feedback Report</h2>
										</div>
										<div class="col-md-3">
<!--											<a class="btn btn-success pull-right" target="_blank" href="<? //echo base_url('institute/analytics/studentfeedback') ?>">View</a>-->
										</div>
									</div>
									<div class="body">
				<!--                        <div id="feedbackchart" class="ct-chart"></div>-->
										<div id="donut-chart" style="height: 276px"></div>
									</div>
								</div>
                            	
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
<script>

	$(function() {
		var o = c3.generate({
			bindto: "#donut-chart",
			color: { pattern: ["#2962FF", "#4fc3f7", "#f62d51", "#B05AE3", "#DB7F2F"] },
			data: {
				columns: [
					<? foreach($ratings as $k => $feed){ ?>

						["<? echo $k ?>",<? echo $feed ?>],

					<? } ?>
				],
				type: "donut",
				onclick: function(o, n) { console.log("onclick", o, n) },
				onmouseover: function(o, n) { console.log("onmouseover", o, n) },
				onmouseout: function(o, n) { console.log("onmouseout", o, n) }
			},
			donut: { title: "Feedback Rating" }
		});
	});	
</script>