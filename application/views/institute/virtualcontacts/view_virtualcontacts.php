
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
                            <div class="col-lg-8 pull-left">
                                <h2>Call History</h2> </h2>
                            </div>
                                <ul class="breadcrumb justify-content-end" style=" background-color: transparent;">
                                    <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>  
                                    <li class="breadcrumb-item"><a href="<?php echo base_url() ?>institute/virtualcontacts/">Helpline Number</a></li> 
                                    <li class="breadcrumb-item "><a href="">Call History</a></li> 
                                </ul>
                                <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-6">
                                    <a href="<?php echo base_url('institute/virtualcontacts/view_virtualcontacts');?>">
                                        <div class="body">
                                            <div class="clearfix">
                                                <div class="float-left">
                                                    <i class="fa fa-video-camera text-col-green" style="font-size:25px;"></i>
                                                </div>
                                                <div class="number float-right text-right">
                                                    <h6> Total Calls History</h6>
                                                    <span class="font700"><?php  echo $this->db->get_where("tbl_convoxcall_logs",["institute_id"=>$this->session->userdata('institute_id')])->num_rows();?></span>
                                                </div>
                                            </div>
                                            <div class="progress progress-xs progress-transparent custom-color-green mb-0 mt-3">
                                                <div class="progress-bar" data-transitiongoal="87"></div>
                                            </div>
                                            <!-- <small class="text-muted">19% compared to last week</small> -->
                                        </div>
                                    </a>
                                </div>
                         
                                <div class="col-lg-4 col-md-4 col-sm-6" style="margin-top: 20px">
								   <form method="get">  
										<div class="form-group">
											<label>Select Start & End Date :</label>
											<div class="input-daterange input-group" id="date-range">
												<input type="text" class="form-control" name="startDate" id="sdate" placeholder="Start Date" autocomplete="off" value="<? echo $this->input->get("startDate") ?>" required>
												<div class="input-group-append">
													<span class="input-group-text bg-info b-0 text-white">TO</span>
												</div>
												<input type="text" class="form-control" name="endDate" id="edate" placeholder="End Date" autocomplete="off" value="<? echo $this->input->get("endDate") ?>" required/>
											</div>
											
										</div>
										<input type="hidden" name="mobile" value="<? echo $this->input->get("mobile") ?>">
									
                                    
                       		 	</div> 
                      		 	                    
                      		 	<div class="col-lg-2 col-md-2" style="margin-top: 48px">
                      		 		<button id="filter" type="submit" class="btn btn-info waves-effect waves-light">Submit</button>
                      		 	</div>                    
                       		 	</form>                    
                       		 	</div>                     
                     
                        <div class="body">
						<hr>
                       	<div class="row">
                       		<div class="col-md-12">
<!--                       			<h6>Virtual Contacts</h6>-->
								<div class="table-responsive">
									<table class="table table-bordered table-striped table-hover dataTable js-exportable">
										<thead>
											<tr>
												<th>Sl.No.</th>
												<th>Student Mobile</th>
												<th>Institute Call Status</th>
												<th>Student Call Status</th>
												<th>Date</th>
                                                <th>Recorded File</th>
                                                <th>Download Text</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											
												$idata = $this->db->get_where("tbl_institutes",["institute_id"=>$this->session->userdata("institute_id")])->row(); 
												$vcnumbers = json_decode($idata->virtual_conference_numbers);
		
												if($call_history){
													$key=1;
													foreach($call_history as $k => $row):
												?>
											<tr>
												<td><?php echo $key;?></td>
												<td><?php echo $row->student_mobile;?></td>
		                                        <td><?php echo $row->institute_call_status?></td>
		                                        <td><?php echo $row->student_call_status?></td>
												<td><?php echo date("d-m-Y",strtotime($row->date));?></td>
												<td><?php echo ($row->recorded_file != "") ? '<a href="'.base_url().$row->recorded_file.'" class="btn btn-primary" target="_blank">Play</a>' : 'No Recording Found' ;?></td>
                                                <td>
                                                <?php if($row->converted_text != NULL || $row->converted_text != '' ){ ?>
													<a href="<? echo base_url('institute/virtualcontacts/vrtlcntcts_download/').$row->student_id ?>" data-toggle="tooltip"  style="margin:0px 20px 0px 20px"><i class="fa fa-cloud-download"></i></a>
												<?php }else{
													echo 'No Text Found.';
												} ?>
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
            
<!--  virtual contact     -->
       
        

       
<!--    Virtual Link   -->
       					
        
       									
       																	
        </div>
    </div>
<link rel="stylesheet" type="text/css" href="<? echo base_url('assets/') ?>css/bootstrap-datepicker.min.css">  
<script src="<? echo base_url('assets/') ?>js/bootstrap-datepicker.min.js"></script> 

<script>

jQuery('#date-range').datepicker({
	toggleActive: true,
	minDate: 0,
	dateFormat: "dd-mm-yy",
});
// helpline	
	
$(document).ready(function(){
  $(".update_virtual_contact").click(function () {
	  $(".vcheading").html("Update Helpline Number")
	  $("#contact_number").val($(this).attr('contact_number'));
	  $("#name").val($(this).attr('name'));
	  $("#designation").val($(this).attr('designation'));
	  $("#from_time").val($(this).attr('from_time'));
	  $("#to_time").val($(this).attr('to_time'));
	  $("#cid").val($(this).attr('bid'));
      $("#addvcontact").modal();
  });
	
  $(".update_virtual_link").click(function () {
	  $(".vlheading").html("Update Virtual Conference Link")
	  $("#link").val($(this).attr('link'));
	  $("#vlid").val($(this).attr('vlid'));
      $("#addvlink").modal();
  });	
	
  $(".add_virtual_contact").click(function () {
	  $(".vcheading").html("Add Helpline Number")
	  $("#contact_number").val("");
	  $("#name").val("");
	  $("#designation").val("");
	  $("#from_time").val("");
	  $("#to_time").val("");
	  $("#cid").val("");
      $("#addvcontact").modal();
  });
	
  $(".add_virtual_link").click(function () {
	  $(".vlheading").html("Add Virtual Conference Link")
	  $("#contact_number").val("");
	  $("#name").val("");
	  $("#designation").val("");
	  $("#from_time").val("");
	  $("#to_time").val("");
	  $("#cid").val("");
      $("#addvlink").modal();
  });	
});	
	
  
	$('.dataTable').on("click",".vcdelete",function(e){
    var element = $(this).attr("did");

     swal({
        title: "Are you sure?",
        text: "You want to delete this ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: 'btn-warning',
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }, function () {
        swal("Deleted!", "Successfully deleted.", "success");
         $.ajax({
          url:"<?php echo base_url("institute/Virtualcontacts/delete_virtualcontact/"); ?>"+element,
          type:"get",
          success:function(str){
            setTimeout(function(){ location.reload(); }, 1000);
          }
        }); 
//         setTimeout(function(){ location.reload(); }, 1000);
    });

    return false;
  });	

	$('.dataTable').on("click",".vldelete",function(e){
		var element = $(this).attr("vlid");

		 swal({
			title: "Are you sure?",
			text: "You want to delete this ?",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: 'btn-warning',
			confirmButtonText: "Yes, delete it!",
			closeOnConfirm: false
		}, function () {
			swal("Deleted!", "Successfully deleted.", "success");
			 $.ajax({
			  url:"<?php echo base_url("institute/Virtualcontacts/delete_virtuallink/"); ?>"+element,
			  type:"get",
			  success:function(str){
				setTimeout(function(){ location.reload(); }, 1000);
			  }
			}); 
	//         setTimeout(function(){ location.reload(); }, 1000);
		});

		return false;
	  });	
	
	
    $("#addeditinstitute").on('submit', function(e){
		//alert();
       e.preventDefault();
       var formData = $(this).serialize();
       $.ajax({
        url:"<?php echo base_url("institute/Virtualcontacts/add_virtual_contact");?>",
        data:formData,
        type:"post",
        dataType:"json",
        beforeSend: function(){
          $("#loader").show();
        },
        success: function(str){
          console.log(str);
          $("#loader").hide();
          if(str.status == 'success'){
            $("#smsg").show();
            $("#smsg").html(str.msg);
            setTimeout(function(){ location.reload(); }, 1500);  
          }else{
            $("#emsg").show();
            $("#emsg").html(str.msg);
          }
        }
        });
    });

    $("#addvirtuallink").on('submit', function(e){
		//alert();
       e.preventDefault();
       var formData = $(this).serialize();
       $.ajax({
        url:"<?php echo base_url("institute/Virtualcontacts/add_virtual_link");?>",
        data:formData,
        type:"post",
        dataType:"json",
        beforeSend: function(){
          $("#loader").show();
        },
        success: function(str){
          console.log(str);
          $("#loader").hide();
          if(str.status == 'success'){
            $("#slmsg").show();
            $("#slmsg").html(str.msg);
            setTimeout(function(){ location.reload(); }, 1500);  
          }else{
            $("#elmsg").show();
            $("#elmsg").html(str.msg);
          }
        }
        });
    });
	
	

// helpline ends	

</script>
<script>
$(".filtersve").change(function(){
	$("#filtersve").submit();
    //alert($(this).val());
    console.log($(this).val());
   
}) 
</script>