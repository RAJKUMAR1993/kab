
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
                                <h2>Webinar & Student Details</h2>
                            </div>
                            <div class="col-lg-1 pull-right">
                                <a href="<?php echo base_url("professor/meetings/webinars");?>" class="btn btn-info">Back</a>
                            </div>
                                                   
                        </div>
                               
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Student Name</th>
                                        <th>Title</th>
                                        <th>Date</th>
                                        <th>From Time</th>
                                        <th>To Time</th>
                                        <th>Zoom Link</th>
                                        <th>Zoom Password</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($webinars){
                                            $key=1;
                                            foreach($webinars as $row):
                                        ?>
                                    <tr>
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $row->student_name;?></td>
                                        <td><?php echo $row->title;?></td>
                                        <td><?php echo date("d-m-Y",strtotime($row->date));?></td>
                                        <td><?php echo date("H:i A", $row->from_time);?></td>
                                        <td><?php echo date("H:i A", $row->to_time);?></td>
                                        <?php
                                        if(date("Y-m-d H:i:s") >= date("Y-m-d H:i:s", $row->from_time) && date("Y-m-d H:i:s") <= date("Y-m-d H:i:s", $row->to_time)){
                                        ?>
                                        <td><?php echo $row->zoom_link;?></td>
                                        <td><?php echo $row->zoom_password;?></td>
                                        <?php
                                        }else{
                                        ?>
                                        <td colspan="2"><p style="color: red;">Webinar Time has beed completed. Please contact professor for the details.</p></td>
                                        <?php
                                        }
                                        ?>
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
