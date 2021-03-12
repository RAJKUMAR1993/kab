
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
						<h2>Professors (Institutes) </h2>
					</div>
					<div class="col-lg-9 col-md-9 col-sm-12 text-right">
						<ul class="breadcrumb justify-content-end" style="background-color: transparent">
							<li class="breadcrumb-item"><a href="<? echo base_url('admin/dashboard') ?>"><i class="icon-home"></i></a></li>
							<li class="breadcrumb-item active">Professors (Institutes)</li>
						</ul>
					</div>                                                   
				</div>
           
            </div>
            
            <div class="row clearfix">
                
                <div class="col-lg-12">
                    <div class="card">
                              
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Institute Name</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>status</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($details){
                                            $key=1;
                                            foreach($details as $row):
												$idata = $this->db->get_where("tbl_institutes",["institute_id"=>$row->institute_id])->row(); 
			
                                        ?>
                                    <tr>
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $idata->institute_name;?></td>
                                        <td><?php echo $row->expert_name;?></td>
                                        <td><?php echo $row->expert_email;?></td>
                                        <td><?php echo $row->expert_mobile;?></td>
                                        <td><?php echo $row->expert_status;?></td>
                                    </tr>
                                    <?php $key++; endforeach;}else{ echo "No records found";}?>
                                
                                </tbody>
                              
                            </table>
                            </div>
                        </div>
                        
                        	
                        
                    </div>
                </div>
            </div>

            
        </div>
    </div>
