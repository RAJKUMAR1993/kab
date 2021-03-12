
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
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="body">
                                        <div class="clearfix">
                                            <div class="float-left">
                                                <i class="fa fa-rupee text-col-blue" style="font-size:25px;"></i>
                                            </div>
                                            <div class="number float-right text-right">
                                                <h6>Total Amount</h6> 
                                                <span class="font700"><?php 
													$tamount = $this->db->select_sum("total_amount")->get_where("tbl_orders",["session_organized_by"=>"professor","creator_id"=>$this->session->userdata['pro_id']])->row();
													echo $tamount->total_amount;
													?></span>
                                            </div>
                                        </div>
                                        <div class="progress progress-xs progress-transparent custom-color-blue mb-0 mt-3">
                                            <div class="progress-bar" data-transitiongoal="87"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" style="margin:auto"> 
                                    <form method="get" id="configform" >
                                            <div class="form-group">
                                                <label>Start Date & End Date :</label>
                                                <div class="input-daterange input-group" id="date-range">
                                                    <input type="text" class="form-control" name="startDate" value="<?= $this->input->get("startDate") ?>" id="sdate" placeholder="Start Date" autocomplete="off"  >
                                                    <div class="input-group-append">
                                                        <span class="input-group-text bg-info b-0 text-white">TO</span>
                                                    </div>
                                                    <input type="text" class="form-control" name="endDate" id="edate" value="<?= $this->input->get("endDate") ?>"  placeholder="End Date" autocomplete="off" />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group" style="margin:auto">
                                            <label>Organized By :</label>
                                            <div class="form-group">
                                                <select  class="form-control" name="creator_id">
                                                    <option value="">Select </option>
                                                        <?php
                                                        //$creator_id = $this->input->get("creator_id");
                                                       // foreach ($org_by as $organized) {
                                                        ?>
                                                    <option <?php //if($creator_id==$organized->creator_id){ echo 'selected';}?> value="<?php //echo $organized->creator_id;?>"><?php //echo $organized->pro_name;?></option>
                                                        <?php //} ?>
                                                </select>
                                            </div>
                                        </div> -->
                                        <div class="col-md-2" style="margin:21px">
                                            <button type="submit" class="btn btn-info waves-effect waves-light m-t-30" style="margin-top: inherit;">Submit</button>
                                            
                                           
                                            	<a href="<? echo base_url('professor/payments') ?>" class="btn btn-warning waves-effect waves-light m-t-30" style="margin-top: inherit;">Reset</a>
                                          
                                        </div> 
						            </form>
                            </div>
                            <div class="row">
                <div class="col-md-3" >	
                <div class="form-group">
                <div id="reportrange" name="date" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 140%; margin-left: 14px;">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span></span> <i class="fa fa-caret-down"></i>
                </div>
                </div>
                </div>
                <div class="col-md-4" style="padding-left: 129px;">		
                  <div class="form-group">
                    <input type="button" id="submitBtn" value="submit" class="btn btn-success mt-20" style="width: 100%;" />
                  </div>
                </div>
            </div>
                          
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
                                        <th>S.no</th>
                                        <th>Order ID</th>
                                        <th>Student Name</th>
                                        <th>Student Email</th>
                                        <th>Student Number</th>
                                        <th>Amount</th>
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
                                            $tamount = [];
                                            foreach($data as $row):
	
												$sdata = json_decode($row->student_data);	
                                                $sesdata = json_decode($row->session_data);	
                                                $tamount[] = $row->total_amount;	
                                        ?>
                                    <tr>
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $row->order_id;?></td>
                                        <td><?php echo $sdata->student_name;?></td>
                                        <td><?php echo $sdata->email;?></td>
                                        <td><?php echo $sdata->phone;?></td>
                                        <td><i class="fa fa-rupee"></i> <?php echo $row->total_amount;?></td>
                                        <td><?php echo date("d-m-Y",strtotime($sesdata->pro_se_date)); ?></td>
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
                                <tfoot>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>
                                            <? if(array_sum($tamount) > 0){ ?>
                                            <i class="fa fa-rupee text-col-blue" style="font-size:18px;"></i>
                                            <? echo array_sum($tamount); } ?>
                                        </th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                </tfoot>
                              
                            </table>
                              
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
    <script src="<?php echo base_url();?>assets/js/datepicker.min.js"></script>
    <script type="text/javascript">
    jQuery('#date-range').datepicker({
        toggleActive: true,
		minDate: 0,
        dateFormat: "dd-mm-yy",
        todayHighlight: true
    });	
</script>
<script type="text/javascript">

$("#submitBtn").click(function(){

var date = $("#reportrange span").html();
console.log(date);
window.location.href = "<? echo base_url('professor/payments') ?>?date="+date;

})



    $(document).ready(function(){
      setTimeout(function(){
        $("#DataTables_Table_0_info, #DataTables_Table_0_paginate, #DataTables_Table_0_filter").attr("style", "display:none;");
      }, 500);
  $(".update_button").click(function () {
      $("#csid").val($(this).attr('admssionid'));
      $("#cstatus").val($(this).attr('admssionstatus'));
    $("#updateModal").modal();
    });
 });
</script>
