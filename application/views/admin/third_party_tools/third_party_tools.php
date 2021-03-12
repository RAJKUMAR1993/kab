
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
                            	<h2>Third Party Tools</h2>
                            </div>                                                   
                        </div>
                               
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Name</th>
                                        <th>Action</th>     
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
										$key=1;
										foreach($tools as $row):
									?>
                                    <tr>
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $row->option_name;?></td>
                                         <td>
                                            <a href="<?php echo base_url("admin/third_party_tools/editTool/").$row->option_short_name;?>" style="margin:0px 20px 0px 20px"><i class="fa fa-pencil"></i></a>
                                        </td>
                                    </tr>
                                    <?php $key++; endforeach;?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
