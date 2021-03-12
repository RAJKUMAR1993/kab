
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
                            	<h2>Sliders </h2>
                            </div>
                            <a href="<?php echo base_url("admin/homepage/add_slider");?>"><button type="button" class="btn btn-primary btn-block col-lg-2 pull-right"  data-target="#addevent">Add Slider</button></a> <br>
                                                   
                        </div>
                               
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Image</th>
                                        <th>Text</th>
                                        <th>Actions</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($sliders){
                                            $key=1;
                                            foreach($sliders as $row):
                                        ?>
                                    <tr>
                                        <td><?php echo $key;?></td>
                                        <td><img src="<?php echo base_url("assets/images/homepage/").$row->image; ?>" height="100px" width="100px"></td>
                                        <td><?php echo $row->text;?></td>
                                         <td>
                                            <a href="<?php echo base_url("admin/homepage/add_slider/").$row->slider_id;?>" style="margin:0px 20px 0px 20px"><i class="fa fa-pencil"></i></a>
                                            <a href="#" name="<?php echo base_url("admin/homepage/delete_slider/").$row->slider_id;?>" class="kabdelete" style="margin:0px 20px 0px 0px"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    <?php $key++; endforeach;}else{ echo "No records found";}?>
                                
                                </tbody>
                              
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
