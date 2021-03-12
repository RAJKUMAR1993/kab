
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
                            	<h2>Categories </h2>
                            </div>
                            <a href="<?php echo base_url("admin/categories/add");?>"><button type="button" class="btn btn-primary btn-block col-lg-2 pull-right"  data-target="#addevent">Add Category</button></a> <br>
                                                   
                        </div>
                               
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" id="zero_config">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Live Status</th>
                                        <th>Sort</th>
                                        <th>Actions</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                <form method="post" id="sort_update">  
                                    
                                    <?php if($categories){
                                            $key=1;
                                            foreach($categories as $row):
                                        ?>
                                    <tr>
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $row->category_name;?></td>
                                        <td><?php echo $row->status;?></td>
                                        <td><?php echo $row->live_status;?></td>
                                        <td style="padding: 0.5rem;">
											<?php echo $row->sort ?>
											<input type="hidden" name="module_id[]" id="index1" value="<?php echo $row->category_id ?>">
											<input type="hidden" class="sorting" name="sort[]" id="index" value="<?php echo $row->sort ?>">
										</td>
                                         <td>
                                            <a href="<?php echo base_url("admin/categories/add/").$row->category_id;?>" style="margin:0px 20px 0px 20px"><i class="fa fa-pencil"></i></a>
                                            <a href="#" name="<?php echo base_url("admin/categories/delete_category/").$row->category_id;?>" class="kabdelete" style="margin:0px 20px 0px 0px"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    <?php $key++; endforeach;}else{ echo "No records found";}?>
                                    
                                </form>
                                </tbody>
                                
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
