
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
                        <div class="header instituteHeader">
                            <div class="col-md-6 pull-left">
                            	<h2>Upcoming Meetings</h2>
                            </div>
                            <div class="col-md-6 pull-right">
                            <ul class="breadcrumb justify-content-end" style=" background-color: transparent;">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>  
                                                      
                            <li class="breadcrumb-item"><a href="<?php echo base_url() ?>institute/councellors">Professors</a></li> 
                            <li class="breadcrumb-item text-primary"> Meetings</li> 
                        </ul>
                               
                            </div>
                                                   
                        </div>
                               
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Professor Name</th>
                                        <th>Student Name</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($meetings){
                                            $key=1;
                                            foreach($meetings as $row):
                                        ?>
                                    <tr>
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $this->db->get_where("tbl_councellors",["id"=>$row->expert_id])->row()->expert_name;?></td>
                                        <td><?php echo $this->db->get_where("tbl_students",["student_id"=>$row->student_id])->row()->student_name;?></td>
                                        <td><?php echo date("d-m-Y",strtotime($row->exp_std_date)); ?></td>
                                        <td><?php echo date('h:i A', $row->exp_std_time);?></td>
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
            <div class="row clearfix">
                
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header instituteHeader">
                            <div class="col-md-6 pull-left">
                            	<h2>In Progress</h2>

                            </div>
                            <div class="col-md-6 pull-right">
                                 
                               
                            </div>
                                                   
                        </div>
                               
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Professor Name</th>
                                        <th>Student Name</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($progress){
                                            $key=1;
                                            foreach($progress as $pro):
                                        ?>
                                    <tr>
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $this->db->get_where("tbl_councellors",["id"=>$pro->expert_id])->row()->expert_name;?></td>
                                        <td><?php echo $this->db->get_where("tbl_students",["student_id"=>$pro->student_id])->row()->student_name;?></td>
                                        <td><?php echo date("d-m-Y",strtotime($pro->exp_std_date)); ?></td>
                                        <td><?php echo date('h:i A', $pro->exp_std_time);?></td>
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
           
            <div class="row clearfix">
                
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header instituteHeader">
                            <div class="col-md-6 pull-left">
                            	<h2>Completed Meetings</h2>

                            </div>
                            <div class="col-md-6 pull-right">
                                 
                               
                            </div>
                                                   
                        </div>
                               
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Professor Name</th>
                                        <th>Student Name</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($cmeetings){
                                            $key=1;
                                            foreach($cmeetings as $row):
                                        ?>
                                    <tr>
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $this->db->get_where("tbl_councellors",["id"=>$row->expert_id])->row()->expert_name;?></td>
                                        <td><?php echo $this->db->get_where("tbl_students",["student_id"=>$row->student_id])->row()->student_name;?></td>
                                        <td><?php echo date("d-m-Y",strtotime($row->exp_std_date)); ?></td>
                                        <td><?php echo date('h:i A', $row->exp_std_time);?></td>
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
