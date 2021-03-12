
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
                            	<h2>Webinar Dates  </h2>

                            </div>
                            <div class="col-md-6 pull-right">
                                 <a href="<?php echo base_url("admin/webinars/add_date");?>"><button type="button" class="btn btn-primary btn-block col-md-3 pull-right"  data-target="#addevent">Add Date</button></a>
                                
                              
                               
                            </div>
                                                   
                        </div>
                               
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($webinar_dates){
                                            $key=1;
                                            foreach($webinar_dates as $wdate):
                                        ?>
                                    <tr>
                                        <td><?php echo $key;?></td>
                                        <td><?php echo date('d-m-Y', strtotime($wdate->date));?></td>
                                         <td>
                                            <a href="<?php echo base_url("admin/webinars/add_date/").$wdate->id;?>" style="margin:0px 20px 0px 20px"><i class="fa fa-pencil"></i></a>      
                                            <a href="#" name="<?php echo base_url("admin/webinars/delete_webinar_date/").$wdate->id;?>" class="kabdelete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>                                            
                                        </td>
                                    </tr>
                                    <?php $key++; endforeach;}
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
