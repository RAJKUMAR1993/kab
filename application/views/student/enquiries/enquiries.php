
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
                            <table class="table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr height="40px"> 
                                        <th>Sl.No.</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Query</th>
										<th>Query Date</th>
                                        <th>Reply Message</th>
										<th>Reply Message Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($details){
                                            $key=1;
                                          //  print_r($details);
                                           foreach($details as $row):
                                        
                                        ?>
                                   <tr>
                                        <td><?php echo $key;?></td>
                                        <td><?php if($row->type=='institute'){  
                                            $name = $this->db->where("institute_id",$row->institute_id)->where("status",'Active')->where("is_deleted",'0')->get("tbl_institutes")->row()->institute_name;
                                            echo ucfirst($name);
                                         }
                                             else if($row->type=='professor'){ 
                                            $name = $this->db->where("pro_id",$row->institute_id)->where("pro_status",'Active')->where("is_deleted",'0')->get("tbl_professors")->row()->pro_name;
                                            echo ucfirst($name);
                                            } else if($row->type=='expert'){ 
                                            $name = $this->db->where("expert_id",$row->institute_id)->where("expert_status",'Active')->where("is_deleted",'0')->get("tbl_experts")->row()->expert_name;
                                            echo $name; 
                                           } else if($row->type=='speaker'){ 
                                            $name = $this->db->where("speaker_id",$row->institute_id)->where("speaker_status",'Active')->where("is_deleted",'0')->get("tbl_speakers")->row()->speaker_name;
                                            echo $name;
                                            } else if($row->type=='counsellor'){
											$name = $this->db->where("id",$row->institute_id)->where("expert_status",'Active')->where("is_deleted",'0')->get("tbl_councellors")->row()->expert_name;
                                            echo ucfirst($name);	
											} ?></td>
                                        <td><?php echo ucfirst($row->type);?></td>
                                        <td><?php echo $row->query;?></td>
										<td><?php 
										if($row->query_date == "0000-00-00"){
											echo "";
										}else{
											echo date("d-m-Y",strtotime($row->query_date));
										} ?></td>
                                        <td><?php echo $row->message;?></td>
										<td><?php 
										if($row->message_date == "0000-00-00"){
											echo "";
										}else{
											echo date("d-m-Y",strtotime($row->message_date));
										} ?></td>
                                        <td><?php echo $row->status;?></td>
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
