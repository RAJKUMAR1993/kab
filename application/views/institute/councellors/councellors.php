
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
                       
                       <? $idata = $this->db->get_where("tbl_institutes",["institute_id"=>$this->session->userdata("institute_id")])->row(); 
			
						  if($idata->add_package_status == "Active"){
					
							  $adpackage = json_decode($idata->additional_package_count)->coucellors;

						  }else{

						      $adpackage = 0;

						  }	
						
						  if((json_decode($idata->allowed_creation_count)->coucellors+$adpackage) > 0){		
						?>
                       
                       
                        <div class="header instituteHeader">
                            <div class="col-md-3 pull-left">
                            	<h2>Professors <!-- <small>Basic example without any additional modification classes</small> --> </h2>

                            </div>
                            <div class="col-md-9 pull-right">
                                 <a href="<?php echo base_url("institute/councellors/add");?>"><button type="button" class="btn btn-primary btn-block col-md-3 pull-right"  data-target="#addevent">Add</button></a>
                                
                                <!-- <a href="<?php echo base_url("institute/experts/bulk");?>"><button type="button" class="btn btn-primary btn-block col-md-3 pull-left"  data-target="#addevent"  style="margin-left:210px">Bulk Upload</button></a> 
 -->
                               
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
                                        <th>Phone</th>
                                        <th>Scheduled Meetings</th>
                                        <th>status</th>
                                        <th>Actions</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($experts){
                                            $key=1;
                                            foreach($experts as $row):
                                        ?>
                                    <tr>
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $row->expert_name;?></td>
                                        <td><?php echo $row->expert_email;?></td>
                                        <td><?php echo $row->expert_mobile;?></td>
                                        <td align="center"><?php echo '<a href="'.base_url('institute/councellors/viewMeetings/').$row->id.'" class="btn btn-primary btn-sm">View</a>';?></td>
                                        <td><?php echo $row->expert_status;?></td>
                                         <td>
                                            <a href="<?php echo base_url("institute/councellors/add/").$row->id;?>" style="margin:0px 20px 0px 20px"><i class="fa fa-pencil"></i></a><!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
                                            
                                            <a href="#" name="<?php echo base_url("institute/councellors/delete_expert/").$row->id;?>" class="kabdelete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                            
                                        </td>
                                    </tr>
                                    <?php $key++; endforeach;}else{ echo "No records found";}?>
                                
                                </tbody>
                              
                            </table>
                            </div>
                        </div>
                        
                        
                       <? }else{
							  
							echo '<h4 align="center" style="padding:20px;">You don\'t have access to create Admission Officers.</h4>';	  
							  
						  } 
                        ?>
                        
                    </div>
                </div>
            </div>

            
        </div>
    </div>
