
<style>
    td.details-control {
    background: url('<?php echo base_url(); ?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
    tr.shown td.details-control {
        background: url('<?php echo base_url(); ?>assets/images/details_close.png') no-repeat center center;
    }
    .col-md-2 {
        max-width: 7.666667%;
    }
</style>

<div id="main-content">
        <div class="container-fluid">
            
            <div class="row clearfix">
                
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="col-lg-12 pull-left">
                            	<h2>Institute Professors Enquiry Details</h2>
                            </div>
	                            <a href="<?php echo base_url("admin/reports/counsellor_reports");?>"><button type="button" class="btn btn-primary btn-block col-lg-3 pull-right"  data-target="#addevent">Institute Professors Reports</button></a> <br><br>
                        </div>
                        <form action="" method="POST">
                            <div class="row" style="margin-left: 5px;"> 
                                <?php $counsellors = $this->db->get_where("tbl_councellors",["is_deleted"=>0])->result();?>  
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Institute Professor :</label>
                                        <select class="form-control" name="expert">
                                            <option value="">Select Institute Professor</option>
                                            <?php
                                            $expert_id = $this->input->post("expert");
                                            foreach ($counsellors as $expert) {
                                            ?>
                                                <option <?php if($expert_id==$expert->id){ echo 'selected';}?> value="<?php echo $expert->id;?>"><?php echo $expert->expert_name;?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>        
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light m-t-30">Submit</button> 
                                </div>
                                <div class="col-md-2">
                                    <a href="" class="btn btn-warning waves-effect waves-light m-t-30">Cancel</a>                     
                                </div>
                           </div>
                       </form> 
                               
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table-bordered table-striped table-hover dataTable js-exportable" width="100%">
                                <thead>
                                    <tr height="40px"> 
                                        <th>S.no</th>
                                        <th>Institute Professor</th>
                                        <th>Student Name</th>
                                        <th>Query</th>
                                        <th>Query Date</th>
                                        <th>Reply Message</th>
                                        <th>Reply Message Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($details){
                                            $key=1;
                                           foreach($details as $row):
                                        
                                        ?>
                                   <tr>
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $this->db->get_where("tbl_councellors",["id"=>$row->institute_id])->row()->expert_name;?></td>
                                        <td><?php echo $row->student_name;?></td>
                                        <td><?php echo $row->query;?></td>
                                        <td><?php if($row->query_date != "0000-00-00" && $row->query_date != ""){ echo date("d-m-Y",strtotime($row->query_date)); } ?></td>
                                        <td><?php echo $row->message;?></td>
                                        <td><?php if($row->message_date != "0000-00-00" && $row->message_date!=''){ echo date("d-m-Y",strtotime($row->message_date)); } ?></td>
                                    </tr>
                                    <?php $key++; endforeach;}?>
                                
                                </tbody>
                              
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>