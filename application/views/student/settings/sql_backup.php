
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
        
    <div class="col-md-9">

                    <div class="card">
                        <div class="header">
                            <h2>Download Sql Database</h2>
                          <!--    <div class="col-lg-3 pull-right">
                                    <a href="<?php echo base_url("admin/settings/categories");?>"><button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#addevent">Back</button></a>
                                    <br>
                                </div>  -->
                        </div>
                        <div class="body">
                          <!--   <form id="basic-form" method="post" action="<?php echo base_url("admin/course/save_category/".$this->uri->segment(4));?>" novalidate>
                                <div class="form-group">
                                    <label>Category name</label>
                                    <input type="text" class="form-control" name="category_name" value="<?php if(isset($category->category_name)){echo $category->category_name;}?>" required>
                                </div>
                                                                

                                <br>
                                <button type="submit" class="btn btn-primary"><?php if($this->uri->segment(4)){echo "Update";}else{ echo "Add category";}?></button>
                            </form> -->
                            <a href="<?php echo base_url('admin/settings/db_backup');?>" target="_blank">
                              <button type="button" class="btn btn-primary">Download Database</button>
                          </a>
                        </div>

                    </div>
    </div>
</div>

