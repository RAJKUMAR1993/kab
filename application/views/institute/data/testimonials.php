
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
                                <h2>Testimonials </h2>
                            </div>
                            <a href="<?php echo base_url("institute/data/addtestimonial");?>"><button type="button" class="btn btn-primary btn-block col-lg-2 pull-right"  data-target="#addevent">Add Testimonial</button></a> <br>
                                                   
                        </div>
                               
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr height="40px">
                                        <th>S.no</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th width="60px">Actions</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($content){
                                            $key=1;
                                            foreach($content as $row):
                                        ?>
                                    <tr>
                                        <td><?php echo $key;?></td>
                                        <td><?php if( $row->image){ ?>
                                            <img src="<?php echo base_url().$row->image; ?>" width="80px" height="80px" >
                                        <?php }else{
                                            echo "";
                                        }?>
                                        <td><?php echo $row->st_name;?></td>
                                        <td><?php echo $row->title;?></td>
                                        <td><?php echo nl2br($row->description);?></td>
                                        <td><?php echo $row->status;?></td>
                                         <td>
                                            <a href="<?php echo base_url("institute/data/addtestimonial/").$row->id;?>" style="margin:0px 20px 0px 20px"><i class="fa fa-pencil"></i></a>
                                            <a href="#" name="<?php echo base_url("institute/data/delete_testimonial/").$row->id;?>" class="kabdelete" style="margin:0px 20px 0px 0px"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
