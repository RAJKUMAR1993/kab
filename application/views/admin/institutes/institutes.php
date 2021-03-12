
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
                <div class="row">
					
                    <div class="col-lg-5 col-md-8 col-sm-12">
                      <a href="<?php echo base_url("admin/institutes/add");?>" class="btn btn-primary" data-target="#addevent">Add Institute</a>
                    </div>            
                    <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                        <ul class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Institutes</li>
                            <!-- <li class="breadcrumb-item active">Cards</li> -->
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                
                <div class="col-lg-12">
                    <div class="card">
					

                        <div class="row">
						    <div class="col-lg-4 col-md-4 col-sm-6">
							<a href="<?php echo base_url('admin/institutes/all_institutes');?>">
								<div class="body">
									<div class="clearfix">
										<div class="float-left">
											<i class="fa fa-university text-col-green" style="font-size:25px;"></i>
										</div>
										<div class="number float-right text-right">
											<h6>All Institutions</h6>
											<span class="font700"><?php echo $this->db->get_where("tbl_institutes",["is_active"=>0,"status"=>"Active","is_deleted"=>0])->num_rows();?></span>
										</div>
									</div>
									<div class="progress progress-xs progress-transparent custom-color-green mb-0 mt-3">
										<div class="progress-bar" data-transitiongoal="87"></div>
									</div>
							       <!-- <small class="text-muted">19% compared to last week</small>  -->
								</div>
							</a>
							</div>
                        	<? $categories = $this->db->get_where("tbl_types")->result(); 
							   foreach($categories as $cat){	
							?>
                        	
                        		<div class="col-lg-4 col-md-4 col-sm-6">
								  <a href="<?php echo base_url('admin/institutes/all_institutes?category='.$cat->code);?>">
									<div class="body">

										<div class="clearfix">
											<div class="float-left">
												<i class="fa fa-list-alt text-col-blue" style="font-size:25px;"></i>
											</div>
											<div class="number float-right text-right">
												
												<h6><? echo $cat->type ?></h6>
												
												<span class="font700"><?php echo $this->db->get_where("tbl_institutes",["is_active"=>0,"status"=>"Active","is_deleted"=>0,"category"=>$cat->code])->num_rows();?></span>
											</div>
										</div>
										<div class="progress progress-xs progress-transparent custom-color-blue mb-0 mt-3">
											<div class="progress-bar" data-transitiongoal="87"></div>
										</div>
										<!-- <small class="text-muted">19% compared to last week</small> -->
									</div>
								  </a>
								</div>
                        	
                        	<? } ?>
                        	
                        	<div class="col-lg-4 col-md-4 col-sm-6">
							<a href="<?php echo base_url('admin/institutes/all_institutes');?>">
								<div class="body">
									<div class="clearfix">
										<div class="float-left">
											<i class="fa fa-university text-col-green" style="font-size:25px;"></i>
										</div>
										<div class="number float-right text-right">
											<h6>No'of Institutions</h6>
											<span class="font700"><?php echo $this->db->get_where("tbl_institutes",["is_active"=>0,"status"=>"Active","is_deleted"=>0])->num_rows();?></span>
										</div>
									</div>
									<div class="progress progress-xs progress-transparent custom-color-green mb-0 mt-3">
										<div class="progress-bar" data-transitiongoal="87"></div>
									</div>
									<!-- <small class="text-muted">19% compared to last week</small> -->
								</div>
							   </a>
							</div>
                       	
                       		<div class="col-lg-4 col-md-4 col-sm-6">
							   <a href="<?php echo base_url('admin/institutes/live_status');?>">
								<div class="body">
									<div class="clearfix">
										<div class="float-left">
											<i class="fa fa-circle-o text-col-green" style="font-size:25px;"></i>
										</div>
									
										<div class="number float-right text-right">
											<h6>No'of institutions Live Status On</h6>
											<span class="font700"><?php echo $this->db->get_where("tbl_institutes",["is_active"=>0,"status"=>"Active","is_deleted"=>0,"live_status"=>1])->num_rows();?></span>
										</div>
										
									</div>
									<div class="progress progress-xs progress-transparent custom-color-green mb-0 mt-3">
										<div class="progress-bar" data-transitiongoal="87"></div>
									</div>
									<!-- <small class="text-muted">19% compared to last week</small> -->
								</div>
							   </a>
							</div>
                       	
                       		<div class="col-lg-4 col-md-4 col-sm-6">
							   <a href="<?php echo base_url('admin/institutes/off_line_status');?>">
									<div class="body">
										<div class="clearfix"><br>
											<div class="float-left">
												<i class="fa fa-circle-o text-col-red" style="font-size:25px;"></i>
											</div>
											<div class="number float-right text-right">
												<h6>No'of institutions Live Status Off</h6>
												<span class="font700"><?php echo $this->db->get_where("tbl_institutes",["is_active"=>0,"status"=>"Active", "category_id"=>"1","is_deleted"=>0,"live_status"=>0])->num_rows();?></span>
											</div>
										</div>
										<div class="progress progress-xs progress-transparent custom-color-red mb-0 mt-3">
											<div class="progress-bar" data-transitiongoal="87"></div>
										</div>
										<!-- <small class="text-muted">19% compared to last week</small> -->
									</div>
							   </a>
							</div>
						
							  <?php 
									$categories = $this->db->where("is_deleted",'0')->order_by('category_name', 'ASC')->get("tbl_categories")->result();

							 if($categories){

								$colors = ["red","blue","green","purpole","aqua"];		

								$key=1;
								foreach($categories as $row):

									$color = array_rand($colors);
							?>
								<div class="col-lg-4 col-md-4 col-sm-6">
								<a href="<?php //echo base_url('admin/institutes/all_institutes?category='.$cat->code);?>">
								<a href="<?php echo base_url('admin/institutes/all_institutes?category_id='.$row->category_id);?>">
									<div class="body">
										<div class="clearfix">
											<div class="float-left">
												<i class="fa fa-fire text-col-<? echo $colors[$color] ?>" style="font-size:25px;"></i>
											</div>
											<div class="number float-right text-right">
												<h6><?php echo $row->category_name; ?></h6>
												<span class="font700"><?php echo $this->db->get_where("tbl_institutes",["category_id"=>$row->category_id,"is_deleted"=>0])->num_rows();?></span>
											</div>
										</div>
										<div class="progress progress-xs progress-transparent custom-color-<? echo $colors[$color] ?> mb-0 mt-3">
											<div class="progress-bar" data-transitiongoal="87"></div>
										</div>
										<!-- <small class="text-muted">19% compared to last week</small> -->
									</div>
								</a>
								</div>
								<?php $key++; endforeach;}else{ echo "No records found";}?>
					      	
							
                        	
                        </div>
                       
                      
                    </div>
                </div>
            </div>

            
        </div>
    </div>
