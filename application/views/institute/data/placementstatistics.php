
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
                                <h2>Placement Statistics </h2>
                            </div>
                            <a href="<?php echo base_url("institute/data/addplacementstatistics");?>"><button type="button" class="btn btn-primary btn-block col-lg-2 pull-right"  data-target="#addevent">Add Placement Statistics</button></a> <br>
                                                   
                        </div>
                               
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Company Logo</th>
                                        <th>Company Name</th>
                                        <th>NO OF Students Placed</th>
                                        <th>Salary/Annum</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($placementstatistics){
                                            $key=1;
                                            foreach($placementstatistics as $row):
                                        ?>
                                    <tr>
                                        <td><?php echo $key;?></td>
                                        <td><img src="<? echo base_url().$row->company_logo ?>" style="width: 150px;height: 100px"></td>
                                        <td><?php echo $row->companyname;?></td>
                                        <td><?php echo $row->nostudentplaced;?></td>
                                        <td><?php echo $row->salaryannum;?></td>
                                        <td><?php echo $row->status;?></td>
                                         <td>
                                            <a href="<?php echo base_url("institute/data/addplacementstatistics/").$row->ps_id;?>" style="margin:0px 20px 0px 20px"><i class="fa fa-pencil"></i></a>
                                            <a href="#" name="<?php echo base_url("institute/data/delete_placementstatistics/").$row->ps_id;?>" class="kabdelete" style="margin:0px 20px 0px 0px"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
