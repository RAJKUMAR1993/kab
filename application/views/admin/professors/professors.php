
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
                <div class="col-md-6 pull-left">
                            	<h2>Professors  </h2>
                            </div>
                            <div class="col-md-6 pull-right">
                                 <a href="<?php echo base_url("admin/professors/add");?>"><button type="button" class="btn btn-primary btn-block col-md-3 pull-right"  data-target="#addevent">Add Professor</button></a>
                            </div>
                    <div class="card">
                        
                         <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6">
                             <a href="<?php echo base_url('admin/professors/active_status');?>">
                                    <div class="body">
                                        <div class="clearfix">
                                            <div class="float-left">
                                                <i class="fa fa-signal text-col-green" style="font-size:25px;"></i>
                                            </div>
                                            <div class="number float-right text-right">
                                                <h6>Professors Active Status</h6>
                                                <span class="font700"><?php echo $this->db->get_where("tbl_professors",["pro_status"=>"Active","is_deleted"=>0])->num_rows();?></span>
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
                               <a href="<?php echo base_url('admin/professors/inactive_status');?>">
                                    <div class="body">
                                        <div class="clearfix">
                                            <div class="float-left">
                                                <i class="fa fa-signal text-col-red" style="font-size:25px;"></i>
                                            </div>
                                            <div class="number float-right text-right">
                                                <h6>Professors InActive Status</h6>
                                                <span class="font700"><?php echo $this->db->get_where("tbl_professors",["pro_status"=>"inactive","is_deleted"=>0])->num_rows();?></span>
                                            </div>
                                        </div>
                                        <div class="progress progress-xs progress-transparent custom-color-green mb-0 mt-3">
                                            <div class="progress-bar" data-transitiongoal="87"></div>
                                        </div>
                                        <!-- <small class="text-muted">19% compared to last week</small> -->
                                    </div>
                               </a>
                            </div>
                            <? $pro_quali = $this->db->select('pro_quali')->group_by('pro_quali')->order_by('pro_id', 'desc')->get('tbl_professors')->result(); 
							   foreach($pro_quali as $quali){	
							?>
                        	
                        		<div class="col-lg-4 col-md-4 col-sm-6">
								  <a href="<?php echo base_url('admin/professors/qualification?pro_quali='.$quali->pro_quali);?>">
									<div class="body">

										<div class="clearfix">
											<div class="float-left">
												<i class="fa fa-graduation-cap text-col-blue" style="font-size:25px;"></i>
											</div>
											<div class="number float-right text-right">
												
												<h6><? echo $quali->pro_quali ?></h6>
												
												<span class="font700"><?php echo $this->db->get_where("tbl_professors",["pro_quali"=>$quali->pro_quali])->num_rows();?></span>
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
                        	
                        </div>
                  
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile Number</th>
                                        <th>Registered date </th> 
                                        <th>Designation</th>
                                        <th>Qualification</th>
                                        <th>Actions</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($professors){
                                            $key=1;
                                            foreach($professors as $row):
                                        ?>
                                    <tr>
                                        <td><?php echo $key;?></td>
                                        <td>
                                            <?php if( $row->pro_image){ ?>
                                            <img src="<?php echo base_url("assets/images/professors/").$row->pro_image; ?>" width="80px" height="80px" >
                                            <?php }else{
                                            echo "";
                                            }?>
                                        </td>
                                        <td><?php echo $row->pro_name;?></td>
                                        <td><?php echo $row->pro_email;?></td>
                                        <td><?php echo $row->mobile1;?></td>
                                         <td><?php echo $row->created;?></td>
                                        <td><?php echo $row->pro_designation;?></td>
                                        <td><?php echo $row->pro_quali;?></td>
                                         <td>
                                            <a href="<?php echo base_url("admin/professors/add/").$row->pro_id;?>" style="margin:0px 20px 0px 20px"><i class="fa fa-pencil"></i></a><!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
                                            
                                            <a href="#" name="<?php echo base_url("admin/professors/delete_pro/").$row->pro_id;?>" class="kabdelete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                            <a href="<?php echo base_url("admin/professors/meetings/").$row->pro_id;?>" style="margin:0px 20px 0px 20px"><i class="fa fa-eye"></i></a>
                                            
                                        </td>
                                    </tr>
                                    <?php $key++; endforeach;}else{ echo "No records found";}?>
                                
                                </tbody>
                              
                            </table>
                            </div>
                            <?php 
                                if($this->session->flashdata('msg')){
                                foreach($this->session->flashdata('msg') as $r){
                                    echo '<div class="alert alert-warning alert-dismissible" role="alert">
                                         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>   
                                        "'.$r.'" Email already Exist.</div>';
                                }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
