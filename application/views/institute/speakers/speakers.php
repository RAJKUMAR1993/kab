
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
                            	<h2>Speakers </h2>

                            </div>
                            <div class="col-md-6 pull-right">
                                 <a href="<?php echo base_url("institute/speakers/add");?>"><button type="button" class="btn btn-primary btn-block col-md-3 pull-right"  data-target="#addevent">Add Speaker</button></a>
                                
                                <!-- <a href="<?php echo base_url("institute/speakers/bulk");?>"><button type="button" class="btn btn-primary btn-block col-md-3 pull-left"  data-target="#addevent"  style="margin-left:210px">Bulk Upload</button></a> 
 -->
                               
                            </div>
                                                   
                        </div>
                               
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>status</th>
                                        <th>Actions</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($speakers){
                                            $key=1;
                                            foreach($speakers as $row):
                                        ?>
                                    <tr>
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $row->speaker_name;?></td>
                                        <td><?php echo $row->speaker_email;?></td>
                                        <td><?php echo $row->speaker_mobile;?></td>
                                        <td><?php echo $row->speaker_status;?></td>
                                         <td>
                                            <a href="<?php echo base_url("institute/speakers/add/").$row->speaker_id;?>" style="margin:0px 20px 0px 20px"><i class="fa fa-pencil"></i></a><!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
                                            
                                            <a href="#" name="<?php echo base_url("institute/speakers/delete_speaker/").$row->speaker_id;?>" class="kabdelete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                            
                                        </td>
                                    </tr>
                                    <?php $key++; endforeach;}
                                    //else{ echo "No records found";}
                                    ?>
                                
                                </tbody>
                              
                            </table>
                            </div>
                            <?php 
                                if($this->session->flashdata('msg')){
                                foreach($this->session->flashdata('msg') as $r){
                                    echo '<div class="alert alert-warning alert-dismissible" role="alert">
                                         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>   
                                        "'.$r.'" Email already Exist.</div>';
                                }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
