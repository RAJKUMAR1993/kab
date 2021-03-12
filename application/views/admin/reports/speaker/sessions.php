
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
                            	<h2>Speaker Sessions </h2>
                            </div>
                            <a href="<?php echo base_url("admin/reports/speaker_reports");?>"><button type="button" class="btn btn-primary btn-block col-lg-3 pull-right"  data-target="#addevent">Speaker Reports</button></a> <br>
                                                   
                        </div>
                        <form action="" method="POST">
                            <div class="row" style="margin-left: 5px;"> 
                                <?php $speakers = $this->db->get_where("tbl_speakers",["is_deleted"=>0])->result();?>  
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Eminent Speaker :</label>
                                        <select class="form-control" name="speaker">
                                            <option value="">Select Speaker</option>
                                            <?php
                                            $speaker_id = $this->input->post("speaker");
                                            foreach ($speakers as $speaker) {
                                            ?>
                                                <option <?php if($speaker_id==$speaker->speaker_id){ echo 'selected';}?> value="<?php echo $speaker->speaker_id;?>"><?php echo $speaker->speaker_name;?></option>
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
                                        <th>Speaker</th>
                                        <th>Time</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Duration(In Minutes)</th>
                                        <th>Amount</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($sessions){
                                            $key=1;
                                            foreach($sessions as $row):
                                        ?>
                                    <tr>
									    
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $row->spe_se_date;?></td>
                                        <td><?php echo $this->db->get_where("tbl_speakers",["speaker_id "=>$row->speaker_id ])->row()->speaker_name;?></td>
                                        <td><?php if(isset($row->spe_se_time)){ echo date('H:i A', $row->spe_se_time);}?></td>
                                        <td><?php echo $row->title;?></td>
                                        <td><?php echo $row->description;?></td>
                                        <td><?php echo $row->duration;?></td>
                                        <td><?php echo $row->amount;?></td>
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
