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
                            	<h2>Live Status </h2>
                            </div>
                            <!-- <a href="<?php //echo base_url("admin/institutes/add");?>"><button type="button" class="btn btn-primary btn-block col-lg-2 pull-right"  data-target="#addevent">Add Institute</button></a> <br> -->
                                                   
                        </div>
                               
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th style="height: 35px">S.no</th>
                                        <th style="height: 35px">Name</th>
                                        <th style="height: 35px">Email</th>
                                        <th style="height: 35px">Phone</th>
                                        <th style="height: 35px">Address</th>
                                        <th style="height: 35px">Category</th>
                                        <th style="height: 35px">Login Status</th>
                                        <th style="height: 35px;width: 70px !important;">Actions</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($livestatus){
                                            $key=1;
                                            foreach($livestatus as $row):
                                        ?>
                                    <tr>
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $row->institute_name;?></td>
                                        <td><?php echo $row->email;?></td>
                                        <td><?php echo $row->phone;?></td>
                                        <td><?php echo nl2br($row->address);?></td>
                                        <td><?php if($row->category == "a"){echo "Category A";}elseif($row->category == "b"){echo "Category B";}elseif($row->category == "c"){echo "Category C";};?></td>
                                        <td><?php echo ($row->live_status == 1) ? '<label class="badge badge-success">Online</label>' : '<label class="badge badge-danger">Offline</label>';?></td>
                                         <td>
                                            <a href="<?php echo base_url("admin/institutes/add/").$row->institute_id;?>" style="margin:0px 20px 0px 20px"><i class="fa fa-pencil"></i></a>
                                            <a href="#" name="<?php echo base_url("admin/institutes/delete_institute/").$row->institute_id;?>" class="kabdelete" style="margin:0px 20px 0px 0px"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
    </div>
