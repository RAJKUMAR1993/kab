
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
</style>

<div id="main-content">
        <div class="container-fluid">
            
            <div class="row clearfix">
                
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="col-lg-9 pull-left">
                            	<h2>Sessions </h2>
                            </div>
                            <a href="<?php echo base_url("speaker/reports");?>"><button type="button" class="btn btn-primary btn-block col-lg-2 pull-right"  data-target="#addevent">Reports</button></a> <br>
                                                   
                        </div>
                               
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table-bordered table-striped table-hover dataTable js-exportable" width="100%">
                                <thead>
                                    <tr height="40px">
									    <th></th>
                                        <th>S.no</th>
                                        <th>Date</th>
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
									    <td>
                                            <a href="<?php echo base_url("speaker/sessions/add_session/").$row->exp_se_id;?>" style="margin:0px 20px 0px 20px"><i class="fa fa-pencil"></i></a>
                                            <a href="#" name="<?php echo base_url("speaker/sessions/delete_session/").$row->exp_se_id;?>" class="kabdelete" style="margin:0px 20px 0px 0px"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        </td>
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $row->spe_se_date;?></td>
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
