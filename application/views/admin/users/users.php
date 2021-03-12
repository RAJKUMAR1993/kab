
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
                            	<h2>Users  </h2>

                            </div>
                            <div class="col-md-6 pull-right">
                                 <a href="<?php echo base_url("admin/users/add");?>"><button type="button" class="btn btn-primary btn-block col-md-3 pull-right"  data-target="#addevent">Add User</button></a>
                            </div>
                                                   
                        </div>
                               
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table-bordered table-striped table-hover dataTable js-exportable" width="100%">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($users){
                                            $key=1;
                                            foreach($users as $user):
                                        ?>
                                    <tr>
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $user->user_name;?></td>
                                        <td><?php echo $user->email;?></td>
                                        <td><?php echo $user->mobile_no;?></td>
                                        <td><?php echo $user->status;?></td>
                                        <td>
                                            <a href="<?php echo base_url("admin/users/add/").$user->id;?>" style="margin:0px 20px 0px 20px"><i class="fa fa-pencil"></i></a>                                            
                                            <a href="#" name="<?php echo base_url("admin/users/delete_user/").$user->id;?>" class="kabdelete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>                                            
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
