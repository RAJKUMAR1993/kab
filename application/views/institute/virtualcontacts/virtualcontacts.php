
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

                            <div class="col-md-3 pull-left">
                                <h2>Helpline Numbers</h2>
                            </div>
							<div class="col-md-9 pull-right">
							<button type="button" class="btn btn-info btn-lg pull-right add_virtual_contact">Add Helpline Number</button>
<!--							<button type="button" class="btn btn-info btn-lg pull-right add_virtual_link" style="margin-right: 10px">Add Virtual Link</button>-->
								
							</div>                      
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
												<th>S.no</th>
												<th>Name</th>
												<th>Designation</th>
												<th>From Time</th>
												<th>To Time</th>
												<th>Helpline Number</th>
												<th>Actions</th>

											</tr>
										</thead>
										<tbody>
											<?php 
											
												$idata = $this->db->get_where("tbl_institutes",["institute_id"=>$this->session->userdata("institute_id")])->row(); 
												$vcnumbers = json_decode($idata->virtual_conference_numbers);
		
												if($vcnumbers){
													$key=1;
													foreach($vcnumbers as $k => $row):
												?>
											<tr>
												<td><?php echo $key;?></td>
												<td><?php echo $row->name;?></td>
												<td><?php echo $row->designation;?></td>
		                                        <td><?php echo $row->from_time?></td>
		                                        <td><?php echo $row->to_time?></td>
												<td><?php echo $row->contact;?></td>
												 <td>
													<a href="#" class="update_virtual_contact" name="<?php echo $row->name;  ?>" designation="<?php echo $row->designation;  ?>" from_time="<?php echo $row->from_time;  ?>" to_time="<?php echo $row->to_time;  ?>" contact_number="<?php echo $row->contact;  ?>" bid="<?php echo $k ; ?>"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;&nbsp;
													<a href="#" did="<?php echo $k ; ?>" class="vcdelete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;
													<a href="<?php echo base_url("institute/virtualcontacts/view_virtualcontacts?mobile=").$row->contact;?>"><i class="fa fa-eye"></i></a>

												</td>
											</tr>
											<?php $key++; endforeach;}
											//else{ echo "No records found";}
											?>

										</tbody>

									</table>
								</div>

                       		</div>
                       		<!--
                       		<div class="col-md-6">
                       			
								<div class="table-responsive">
									<table class="table table-bordered table-striped table-hover dataTable js-exportable">
										<thead>
											<tr>
												<th>S.no</th>
												<th>Virual Link</th>
												<th>Actions</th>

											</tr>
										</thead>
										<tbody>
											<?php 
											
												/*$vclinks = json_decode($idata->video_conference);
		
												if($vclinks){
													$key=1;
													foreach($vclinks as $k1 => $row):*/
												?>
											<tr>
												<td><?php //echo $key;?></td>
												<td><?php //echo $row;?></td>
												 <td>
													<a href="#" class="update_virtual_link" link="<?php //echo $row;  ?>" vlid="<?php //echo $k1 ; ?>"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;&nbsp;
													<a href="javascript:void(0)" vlid="<?php //echo $k1 ; ?>" class="vldelete" style="margin:0px 20px 0px 0px"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
												</td>
											</tr>
											<?php //$key++; endforeach;}else{ echo "No records found";}?>
										</tbody>

									</table>
								</div>
                       			
                       		</div>
                       		-->
                       	</div>
                       
                        </div>
                    </div>
                </div>
            </div>
            
<!--  virtual contact     -->
       
        <div id="addvcontact" class="modal fade" role="dialog">
			  <div class="modal-dialog">

				<!-- Modal content-->
				<form id="addeditinstitute">
				<div class="modal-content">
						<div class="alert alert-success" style="display:none" id="smsg"></div>
						<div class="alert alert-danger" style="display:none" id="emsg"></div>
				 <div class="modal-header">
					
					<h6  style="font-weight:bold;text-align:center" class="vcheading"></h6>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				  </div>
				  <div class="modal-body">    
				  		
				  		<div class="form-group">
				  			<label for="inputEmail3" class="col-form-label">Name</label>
				  			<input type="text" class="form-control" id="name" name="name" required>
				  		</div>   
				  		<div class="form-group">
				  			<label for="inputEmail3" class="col-form-label">Designation</label>
				  			<input type="text" class="form-control" id="designation" name="designation" required>
				  		</div>
				  		<div class="form-group">
				  			<label for="inputEmail3" class="col-form-label">From Time</label>
				  			<input type="time" class="form-control" id="from_time" name="from_time" required>
				  		</div>
				  		<div class="form-group">
				  			<label for="inputEmail3" class="col-form-label">To Time</label>
				  			<input type="time" class="form-control" id="to_time" name="to_time" required>
				  		</div>
					  <div class="form-group">
						<label for="inputEmail3" class="col-form-label">Helpline Number</label>
						
						  <input type="text" class="form-control" id="contact_number" name="helpline_number" minlength="10" maxlength="10" onkeypress="return event.charCode >= 48 &amp;& amp; event.charCode <= 57" required>
						  <input type="hidden" class="form-control" id="cid" name="cid">
						  <span style="color: red;font-size: 11px;">Note: Please add only Non DND Numbers.</span>
					  </div>				  
											
				  </div>
				  <div class="modal-footer">
					<button type="submit" class="btn btn-primary">Submit</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				  </div>
				</div>
				</form>

			  </div>
			</div>

       
<!--    Virtual Link   -->
       					
        <div id="addvlink" class="modal fade" role="dialog">
			  <div class="modal-dialog">

				<!-- Modal content-->
				<form id="addvirtuallink">
				<div class="modal-content">
						<div class="alert alert-success" style="display:none" id="slmsg"></div>
						<div class="alert alert-danger" style="display:none" id="elmsg"></div>
				 <div class="modal-header">
					
					<h6  style="font-weight:bold;text-align:center" class="vlheading"></h6>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				  </div>
				  <div class="modal-body">    
				  
					  <div class="form-group">
						<label for="inputEmail3" class="col-form-label">Virtual Link</label>
						
						  <input type="text" class="form-control" id="link"  name="virtual_link" required>
						  <input type="hidden" class="form-control" id="vlid" name="vlid">
					  </div>				  
											
				  </div>
				  <div class="modal-footer">
					<button type="submit" class="btn btn-primary">Submit</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				  </div>
				</div>
				</form>

			  </div>
			</div>
       									
       																	
        </div>
    </div>

<script>

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