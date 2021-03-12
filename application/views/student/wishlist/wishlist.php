
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
            
            <div class="row clearfix">
                
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="col-lg-9 pull-left">
                            	<h2>Enquiry Details</h2>
                            </div>
                                               
                        </div>
                               
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr> 
                                        <th>S.no</th>
                                        <th>Institute Name</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($collegeconnect)){
                                                $cca = $collegeconnect->video_links;
                                                $details = json_decode($cca);
                                        
                                            $key=1;
                                          //  print_r($details);
                                           foreach($details as $row):
	
											$idata = $this->db->where("institute_id",$row->institute_id)->where("status",'Active')->where("is_deleted",'0')->get("tbl_institutes")->row();
												
											if($idata){	
                                        
                                        ?>
                                   <tr>
                                        <td><?php echo $key;?></td>
                                        <td><a href="<?php echo base_url(); ?>exhibitors/<?php echo $row->institute_id ; ?>" target="_blank"><?php $insname = $idata->institute_name; 
                                        echo $insname;?></a></td>
                                        
                                    </tr>
                                    <?php $key++;} endforeach;}else{ echo "No records found";}?>
                                
                                </tbody>
                              
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
