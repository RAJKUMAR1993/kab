
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
           
            </div>
            
            <div class="row clearfix">
                
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header webinarHeader">
                            <div class="col-md-6 pull-left">
                            	<h2>Webinars  </h2>

                            </div>
                            <div class="col-md-6 pull-right">
                                 <a href="<?php echo base_url("admin/webinars/add");?>"><button type="button" class="btn btn-primary btn-block col-md-3 pull-right"  data-target="#addevent">Add Webinar</button></a>
                                
                              
                               
                            </div>
                                                   
                        </div>
                               
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table-bordered table-striped table-hover dataTable js-exportable" width="100%">
                                <thead>
                                    <tr height="40px">
                                        <th>S.no</th>
                                        <th width="150px">Title</th>
                                        <th width="300px">Description</th>
                                        <th>Date</th>
                                        <th>From Time</th>
                                        <th>To Time</th>
                                        <th>Actions</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($webinors){
                                            $key=1;
                                            foreach($webinors as $webinor):
                                        ?>
                                    <tr>
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $webinor->title;?></td>
                                        <td><?php echo nl2br($webinor->description);?></td>
                                        <td><?php echo date('d-m-Y', strtotime($webinor->date));?></td>
                                        <td><?php if($webinor->from_time!='') { echo date('H:i a', $webinor->from_time);}?></td>
                                        <td><?php if($webinor->to_time!='') { echo date('H:i a', $webinor->to_time);}?></td>
                                         <td>
                                            <a href="<?php echo base_url("admin/webinars/add/").$webinor->id;?>" style="margin:0px 20px 0px 20px"><i class="fa fa-pencil"></i></a><!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
                                            
                                            <a href="#" name="<?php echo base_url("admin/webinars/delete_webinor/").$webinor->id;?>" class="kabdelete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                            <a href="<?php echo base_url("admin/webinars/participants/").$webinor->id;?>" style="margin:0px 20px 0px 20px"><i class="fa fa-eye"></i></a>
                                            
                                        </td>
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
