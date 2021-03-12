
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
                            <div class="col-md-3 pull-left">
                            	<h2>Auditoriums  </h2>

                            </div>
                            <div class="col-md-9 pull-right">
                                
                                 <a href="<?php echo base_url("admin/auditorium/add_auditorium");?>"><button type="button" class="btn btn-primary btn-block col-md-3 pull-right"  data-target="#addevent">Add Auditorium</button></a>

                                                                
                                 <a href="<?php echo base_url("admin/auditorium/presentations");?>"><button type="button" class="btn btn-primary btn-block col-md-3 pull-right"  data-target="#addevent" style="margin-right: 10px">View Presentations</button></a>
                                
                            </div>
                                                   
                        </div>
                               
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Title</th>
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
                                        <td><?php echo date("d-m-Y",strtotime($webinor->date));?></td>
                                        <td><?php if($webinor->from_time!='') { echo date('H:i a', $webinor->from_time);}?></td>
                                        <td><?php if($webinor->to_time!='') { echo date('H:i a', $webinor->to_time);}?></td>
                                         <td>
                                            <a href="<?php echo base_url("admin/auditorium/add_auditorium/").$webinor->id;?>" style="margin:0px 20px 0px 20px"><i class="fa fa-pencil"></i></a><!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
                                            
                                            <a href="#" name="<?php echo base_url("admin/auditorium/delete_auditorium/").$webinor->id;?>" class="kabdelete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
<!--                                            <a href="<?php echo base_url("admin/webinars/participants/").$webinor->id;?>" style="margin:0px 20px 0px 20px"><i class="fa fa-eye"></i></a>-->
                                            
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
