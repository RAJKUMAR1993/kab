
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
                            <div class="col-lg-9 pull-left">
                            	<h2>Institute Professor Sessions </h2>
                            </div>
                            <a href="<?php echo base_url("admin/reports/counsellor_reports");?>"><button type="button" class="btn btn-primary btn-block col-lg-3 pull-right"  data-target="#addevent">Institute Professor Reports</button></a> <br>
                                                   
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
                                        <th>Date</th>
                                        <th>Admission Officer</th>
                                        <th>Time</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Duration(In Minutes)</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($sessions){
                                            $key=1;
                                            foreach($sessions as $row):
                                        ?>
                                    <tr>
									    
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $row->exp_se_date;?></td>
                                        <td><?php echo $this->db->get_where("tbl_councellors",["id"=>$row->expert_id])->row()->expert_name;?></td>
                                        <td><?php if(isset($row->exp_se_time)){ echo date('H:i A', $row->exp_se_time);}?></td>
                                        <td><?php echo $row->title;?></td>
                                        <td><?php echo $row->description;?></td>
                                        <td><?php echo $row->duration;?></td>
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
