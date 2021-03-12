
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
                         <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6">
                            <a href="<?php echo base_url('admin/speakers/active_status');?>">
                                    <div class="body">
                                        <div class="clearfix">
                                            <div class="float-left">
                                                <i class="fa fa-signal text-col-green" style="font-size:25px;"></i>
                                            </div>
                                            <div class="number float-right text-right">
                                                <h6>Speaker Active Status</h6>
                                                <span class="font700"><?php echo $this->db->get_where("tbl_speakers",["speaker_status"=>"Active","is_deleted"=>0])->num_rows();?></span>
                                            </div>
                                        </div>
                                        <div class="progress progress-xs progress-transparent custom-color-green mb-0 mt-3">
                                            <div class="progress-bar" data-transitiongoal="87"></div>
                                        </div>
                                        <!-- <small class="text-muted">19% compared to last week</small> -->
                                    </div>
                                </a>
                            </div>
                        
                            <div class="col-lg-4 col-md-4 col-sm-6">
                               <a href="<?php echo base_url('admin/speakers/inactive_status');?>">
                                    <div class="body">
                                        <div class="clearfix">
                                            <div class="float-left">
                                                <i class="fa fa-signal text-col-red" style="font-size:25px;"></i>
                                            </div>
                                            <div class="number float-right text-right">
                                                <h6>Speaker InActive Status</h6>
                                                <span class="font700"><?php echo $this->db->get_where("tbl_speakers",["speaker_status"=>"inactive","is_deleted"=>0])->num_rows();?></span>
                                            </div>
                                        </div>
                                        <div class="progress progress-xs progress-transparent custom-color-green mb-0 mt-3">
                                            <div class="progress-bar" data-transitiongoal="87"></div>
                                        </div>
                                        <!-- <small class="text-muted">19% compared to last week</small> -->
                                    </div>
                               </a>
                            </div>
                            
                        </div>
                        <div class="header">
                            <div class="col-md-6 pull-left">
                            	<h2>Speakers </h2>

                            </div>
                            <div class="col-md-6 pull-right">
                                 <a href="<?php echo base_url("admin/speakers/add");?>"><button type="button" class="btn btn-primary btn-block col-md-3 pull-right"  data-target="#addevent">Add Speaker</button></a>
                                
                            </div>
                                                   
                        </div>
                               
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile Number</th>
                                        <th>Registered date </th>
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
                                        <td><?php if( $row->speaker_photo){ ?>
                                            <img src="<?php echo base_url().$row->speaker_photo; ?>" width="80px" height="80px" >
                                        <?php }else{
                                            echo "";
                                        }?>
                                        </td>
                                        <td><?php echo $row->speaker_name;?></td>
                                        <td><?php echo $row->speaker_email;?></td>
                                        <td><?php echo $row->speaker_mobile;?></td>
                                        <td><?php echo $row->created;?></td>
                                        <td><?php echo ($row->speaker_status == 'Active')?'<label class="badge badge-success">Active</label>' : '<label class="badge badge-danger">Inactive</label>';?></td>
                                         <td>
                                            <a href="<?php echo base_url("admin/speakers/add/").$row->speaker_id;?>" style="margin:0px 20px 0px 20px"><i class="fa fa-pencil"></i></a><!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
                                            
                                            <a href="#" name="<?php echo base_url("admin/speakers/delete_speaker/").$row->speaker_id;?>" class="kabdelete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                            <a href="<?php echo base_url("admin/speakers/meetings/").$row->speaker_id;?>" style="margin:0px 20px 0px 20px"><i class="fa fa-eye"></i></a>
                                            
                                        </td>
                                    </tr>
                                    <?php $key++; endforeach;}else{ echo "No records found";}?>
                                
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
