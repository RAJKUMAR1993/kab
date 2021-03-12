
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
                        <div class="header">
                            <div class="col-md-6 pull-left">
                            	<h2><? echo $title ?> </h2>

                            </div>
                                                   
                        </div>
                               
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Sl.No.</th>
                                        <th>Order ID</th>
                                        <th>Organized By</th>
                                        <th>Amount</th>
                                        <th>Reference ID</th>
                                        <th>Session Date</th>
                                        <th>Session Start Time</th>
                                        <th>Session End Time</th>
                                        <th>Transaction ID</th>
                                        <th>Order Date</th>
                                        <th>Order Status</th>
                                        <th>Payment Status</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($data){
                                            $key=1;
                                            foreach($data as $row):
	
												$sdata = json_decode($row->student_data);	
												$sesdata = json_decode($row->session_data);	
                                        ?>
                                    <tr>
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $row->order_id;?></td>
                                        <td><?php echo $this->db->get_where("$table",["$id"=>$row->creator_id])->row()->$name; ?></td>
                                        <td><i class="fa fa-rupee"></i> <?php echo $row->total_amount;?></td>
                                        <td><?php echo $row->bank_ref_no;?></td>
                                        <td><?php echo date("d-m-Y",strtotime($sesdata->$session_date)); ?></td>
                                        <td><?php echo date("H:i",($sesdata->pro_se_time)); ?></td>
                                        <td><?php echo date("H:i",($sesdata->pro_se_time+($sesdata->duration*60))); ?></td>
                                        <td><?php echo $row->txn_id;?></td>
                                        <td><?php echo date("d-m-Y H:i:s",strtotime($row->date_of_order));?></td>
                                        <td>
                                        	<? if($row->order_status == "Pending"){
											   		echo '<label class="badge badge-warning">Pending</label>';
											    }elseif($row->order_status == "Failed"){
													echo '<label class="badge badge-danger">Failed</label>';
												}elseif($row->order_status == "Success"){
													echo '<label class="badge badge-success">Success</label>';
												} 
											?>
                                        </td>
                                        <td>
                                        	<? if($row->payment_status == "Pending"){
											   		echo '<label class="badge badge-warning">Pending</label>';
											    }elseif($row->payment_status == "Failed"){
													echo '<label class="badge badge-danger">Failed</label>';
												}elseif($row->payment_status == "Success"){
													echo '<label class="badge badge-success">Success</label>';
												} 
											?>
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
