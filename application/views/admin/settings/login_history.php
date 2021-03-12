
<style>
    td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
    tr.shown td.details-control {
        background: url('<?php echo base_url();?>assets/images/details_close.png') no-repeat center center;
    }
</style>

<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
               <!--  <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">                        
                        <h2>Jquery Datatable</h2>
                    </div>            
                    <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                        <ul class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Table</li>
                            <li class="breadcrumb-item active">Jquery Datatable</li>
                        </ul>
                    </div>
                </div> -->
            </div>
            
            <div class="row clearfix">
                
                <div class="col-lg-12">
                   <!--  <div class="card col-lg-12">
                         
                                <br><br>
                           <form id="basic-form" method="post" action="<?php echo base_url("admin/course/save_category/".$this->uri->segment(4));?>" novalidate>
                           
                                   <div class="col-lg-6 pull-left">
                                    <input type="text" class="form-control" name="category_name" value="<?php if(isset($category->category_name)){echo $category->category_name;}?>" required>
                                </div>
                                <div class="col-lg-6 pull-right">
                                    <button type="submit" class="btn btn-primary "><?php if($this->uri->segment(4)){echo "Update";}else{ echo "Add category";}?></button> <br><br><br>
                                    </div> 
                            </form>
                           
                    </div> -->
                    <div class="card">
                        <div class="header">
                            <div class="col-lg-9 pull-left">
                                <h2>Login history List </h2>
                            </div>
                            
                           <!--  <a href="<?php echo base_url("admin/course/add_category");?>"><button type="button" class="btn btn-primary btn-block col-lg-2 pull-right" data-toggle="modal" data-target="#addevent">Add Category</button></a>
                            <br> -->
                                                    
                        </div>
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Agent</th>
                                        <th>Platform</th>
                                        <th>IP Address</th>
                                        <th>Time</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php if($logins){
                                        $key = 1;
                                        foreach($logins as $row):
                                        ?>
                                    <tr>
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $row->agent;?></td>
                                        <td><?php echo $row->platform;?></td>
                                        <td><?php echo $row->ip_address;?></td>
                                        <td><?php echo date("F j, Y, g:i a", strtotime($row->date_time));?></td>
                                    </tr>
                                        <?php $key++; endforeach;}else{ echo "No data found";}?>
                                   
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>