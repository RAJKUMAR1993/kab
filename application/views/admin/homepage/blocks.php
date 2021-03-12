
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
						
                            <div class="col-md-10 pull-left">
                                <h2>Card Blocks</h2>
                            </div>
                            <?php if($this->session->flashdata('errors')){ ?>
                              <div class="alert alert-danger">
                                  <a href="#" class="close" data-dismiss="alert">&times;</a>
                                  <strong>error!</strong> <?php echo $this->session->flashdata('errors'); ?>
                              </div>

                              <?php } else if($this->session->flashdata('success')){  ?>

                              <div class="alert alert-success">
                                  <a href="#" class="close" data-dismiss="alert">&times;</a>
                                  <strong>success!</strong> <?php echo $this->session->flashdata('success'); ?>
                              </div>

                            <?php }  ?>
						    	<div class="col-md-2 pull-right" id= 'status'>
                    
                    <?php 
                
                if($blocks[0]->status=="1"){ 
                  ?>
                  <div class="switch" >
                    <label>Status :</label>
                    <input type="checkbox" data-on-color="info"
                         name="switch"
                        data-off-color="success" class="check" checked>
                    <?php  }elseif($blocks[0]->status=="0"){  ?>
                      <input type="checkbox" 
                          data-on-color="info" name="switch" data-off-color="success"
                            class="check">
                  </div>
                <?php  }?>
                    
                  </div>                      
							</div>
                               
                        <div class="body">
						<hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
									    <th height="30px" width="30px"></th>
                                        <th height="30px">S.no</th>
                                        <th height="30px" width="200px">Icon</th>
                                        <th height="30px" width="150px">Bold Text</th>
                                        <th height="30px" width="150px">Message</th>
                                        <th height="30px" width="200px">Color</th>
                                        
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($blocks){
                                            $key=1;
                                            foreach($blocks as $row):
                                        ?>
                                    <tr>
                                        <td align="center">
										<a href="#" class="update_user_button" icon="<?php echo $row->icon;  ?>" message="<?php echo $row->message;  ?>" btext="<?php echo $row->bold_text;  ?>" color="<?php echo $row->color;  ?>" tid="<?php echo $row->id ; ?>" ><i class="fa fa-pencil"></i></a>
                                        </td>
                                        <td align="center">
                                            <?php echo $key;?>
                                        </td>
										<td align="center"><?php echo $row->icon;?></td>
										<td align="center"><?php echo $row->bold_text;?></td>
                                        <td><?php echo nl2br($row->message);?></td>
                                        <td><?php echo $row->color;?></td> 
                                         
                                    </tr>
                                    <?php $key++; endforeach;}else{ echo "No records found";}?>
                                
                                </tbody>
                              
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div id="myModal" class="modal fade" role="dialog">
			  <div class="modal-dialog">

				<!-- Modal content-->
				<form id="addeditinstitute">
				<div class="modal-content">
                            <div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
				  <div class="modal-header">
					
					<h6  style="font-weight:bold;text-align:center">Add Testimonials</h6>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				  </div>
				  <div class="modal-body">    
											  <input type="hidden" id="url" name="url" value="<?php echo base_url("admin/homepage/add_test");?>">
											  <div class="form-group row">
												<label for="inputEmail3" class="col-sm-2 col-form-label">Student Name</label>
												<div class="col-sm-10">
												  <input type="text" class="form-control"  name="student_name" required>
												</div>
											  </div>
											  <div class="form-group row">
												<label for="inputPassword3" class="col-sm-2 col-form-label">Student Image</label>
												<div class="col-sm-10">
												  <input type="file" accept="image/jpeg" class="form-control"  name="picture" required>
												  <small style="color: red">Note: Please upload 150*150px Image</small>
												</div>
												
											  </div>
											  <div class="form-group row">
												<label for="inputEmail3" class="col-sm-2 col-form-label">Student Message</label>
												<div class="col-sm-10">
												  <textarea class="form-control" rows="5"  name="student_msg" required></textarea>
												</div>
											  </div>
											  <div class="form-group row">
												<label for="inputEmail3" class="col-sm-2 col-form-label">Student Qualification</label>
												<div class="col-sm-10">
												  <input type="text" class="form-control"  name="student_quali" required>
												</div>
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
			
			<div class="modal fade" id="updateModal" role="dialog">
						<div class="modal-dialog">
							<form id="addeditinstitute_update">
							<div class="modal-content">
                            <div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
							  <div class="modal-header">
								
								<h6 class="modal-title">Update Card Block</h6>
								
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							  </div>
							  <div class="modal-body">
								
											   <input type="hidden" id="url2" name="url" value="<?php echo base_url("admin/homepage/update_block");?>">
											    <input type="hidden" class="tid" name="id">
														  
														  
											 <div class="form-group row">
												<label for="inputEmail3" class="col-sm-2 col-form-label">Icon</label>
												<div class="col-sm-10">
												  <input type="text" class="form-control icon"  name="icon" required>
												</div>
												<small style="color: red;margin-left: 10px">Reference Site :  <a href="https://www.w3schools.com/icons/fontawesome_icons_text.asp" target="_blank" style="">https://www.w3schools.com/icons/fontawesome_icons_text.asp</a></small>
											  </div>
											  <div class="form-group row">
												<label for="inputPassword3" class="col-sm-2 col-form-label">Color</label>
												<div class="col-sm-10">
												  <input type="color" class="form-control color" style="height: 40px"  name="color" required>
												</div>
											  </div>
											  <div class="form-group row">
												<label for="inputPassword3" class="col-sm-2 col-form-label">Bold Text</label>
												<div class="col-sm-10">
												  <input type="text" class="form-control btext"  name="bold_text" required>
												</div>
											  </div>
											  <div class="form-group row">
												<label for="inputEmail3" class="col-sm-2 col-form-label">Message</label>
												<div class="col-sm-10">
												  <textarea class="form-control message" rows="5"  name="message" required></textarea>
												</div>
											  </div>
														  
														
							  </div>
							  <div class="modal-footer">
								<button type="submit" class="btn btn-primary">Update</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							  </div>
							</div>
							</form>
						</div><!--.modal-dialog-->
					</div><!--.modal-->
            
        </div>
    </div>
<script>

	
	
$(document).ready(function(){
  $(".update_user_button").click(function () {
	  $(".icon").val($(this).attr('icon'));
	  $(".color").val($(this).attr('color'));
	  $(".message").val($(this).attr('message'));
	  $(".btext").val($(this).attr('btext'));
	  $(".tid").val($(this).attr('tid'));
    $("#updateModal").modal();
    });
 });	
	$(document).ready(function(){
  
    $("#addeditinstitute").on('submit', function(e){
		//alert();
       e.preventDefault();
       var formData = new FormData(this);
       var url = $('#url').val();
       $.ajax({
        url:url,
        data:formData,
        type:"post",
        dataType:"json",
		cache:false,
        contentType: false,
        processData: false,
        beforeSend: function(){
          $("#loader").show();
        },
        success: function(str){
          console.log(str);
          $("#loader").hide();
          if(str.Status == 'Active'){
            $("#smsg").show();
            $("#smsg").html(str.Message);
            setTimeout(function(){ location.reload(); }, 1000);  
          }else{
            $("#emsg").show();
            $("#emsg").html(str.Message);
          }
        },
		   error : function(str){
			   console.log(str);
		   }
        });
    });

    });
	
	$(document).ready(function(){
  
    $("#addeditinstitute_update").on('submit', function(e){
		//alert();
       e.preventDefault();
       var formData = new FormData(this);
       var url = $('#url2').val();
       $.ajax({
        url:url,
        data:formData,
        type:"post",
        dataType:"json",
		cache:false,
        contentType: false,
        processData: false,
        beforeSend: function(){
          $("#loader").show();
        },
        success: function(str){
          console.log(str);
          $("#loader").hide();
          if(str.Status == 'Active'){
            $("#smsg").show();
            $("#smsg").html(str.Message);
            setTimeout(function(){ location.reload(); }, 1000);  
          }else{
            $("#emsg").show();
            $("#emsg").html(str.Message);
          }
        },
		   error : function(str){
			   console.log(str);
		   }
        });
    });

    });
  </script>
  <script>
    $("input[type='checkbox']").bootstrapSwitch({size : 'mini'});
    
</script>
<script>


$('#status').on('switchChange.bootstrapSwitch', 'input[name="switch"]', function(e, state) {
  

    if ($(this).is(":checked")) {
        status = "1";
    } else {
        status = "0";
    }
   // alert(status);
    $.ajax({
        type: "POST",
        url: "<?php echo base_url();?>admin/homepage/block_status",
        data: {
            status: status
        },
        success: function(data) {
          //  location.reload(true);
        }
    });
});

</script>