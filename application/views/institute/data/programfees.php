
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
                                <h2>Programme and Fees </h2>
                            </div>
                            <a href="<?php echo base_url("institute/data/addprogramfee");?>"><button type="button" class="btn btn-primary btn-block col-lg-2 pull-right"  data-target="#addevent">Add Programme and Fees</button></a> <br>
                                                   
                        </div>
                               
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Course</th>
                                        <th>Program</th>
                                        <th>Fees</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($programfee){
                                            $key=1;
                                            foreach($programfee as $row):
                                        ?>
                                    <tr>
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $row->title;?></td>
                                        <td><?php echo $row->program_name;?></td>
                                        <td><?php echo $row->fees;?></td>
                                        <td><?php echo $row->status;?></td>
                                         <td>
                                            <a href="<?php echo base_url("institute/data/addprogramfee/").$row->programfee_id;?>" style="margin:0px 20px 0px 20px"><i class="fa fa-pencil"></i></a>
                                            <a href="#" name="<?php echo base_url("institute/data/delete_programfee/").$row->programfee_id;?>" class="kabdelete" style="margin:0px 20px 0px 0px"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        </td>
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
