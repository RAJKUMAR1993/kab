
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
                            	<h2>Webinar Guests  </h2>

                            </div>
                            <div class="col-md-6 pull-right">
                                 <a href="<?php echo base_url("admin/webinars/add_guest");?>"><button type="button" class="btn btn-primary btn-block col-md-3 pull-right"  data-target="#addevent">Add Guest</button></a>
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
                                        <th>Designation</th>
                                        <th>Qualification</th>
                                        <th>Counts</th>
                                        <th>Actions</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($guests){
                                            $key=1;
                                            foreach($guests as $guest):
                                        ?>
                                    <tr>
                                   
                                        <td><?php echo $key;?></td>
                                        <td>
                                            <?php if($guest->image){ ?>
                                            <img src="<?php echo base_url('assets/images/guests/').$guest->image; ?>" width="80px" height="80px" >
                                            <?php }else{
                                            echo "";
                                            }?>
                                        <td><?php echo $guest->name;?></td>
                                        <td><?php echo $guest->email;?></td>
                                        <td><?php echo $guest->mobile_no;?></td>
                                        <td><?php echo $guest->designation;?></td>
                                        <td><?php echo $guest->qualification;?></td> 
                                         <td><?php echo $this->db->query("Select * from tbl_webinors where FIND_IN_SET($guest->id,guest_ids)")->num_rows();?></td>
                                         <td>
                                            <a href="<?php echo base_url("admin/webinars/add_guest/").$guest->id;?>" style="margin:0px 20px 0px 20px"><i class="fa fa-pencil"></i></a>
                                            
                                            <a href="#" name="<?php echo base_url("admin/webinars/delete_guest/").$guest->id;?>" class="kabdelete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                            
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
