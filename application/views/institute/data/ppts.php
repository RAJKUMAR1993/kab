
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
                                <h2>PPTs</h2>
                            </div>
							<div class="col-md-2 pull-right">
							<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Add PPT</button>
								
							</div>                      
							</div>
                               
                        <div class="body">
						<hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>PPT Name</th>
                                        <th>File</th>
                                        <th>Actions</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($video){
                                            $key=1;
                                            foreach($video as $row):
                                        ?>
                                    <tr>
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $row->broucher_name;?></td>
                                        <td><a href="<?php echo base_url("assets/images/brochure/").$row->broucher ;?>" target="_blank" style="text-decoration:underline;">View</td>
                                         <td>
                                            <a href="#" class="update_user_button" brochure_name="<?php echo $row->broucher_name;  ?>" bid="<?php echo $row->broucher_id ; ?>" ><i class="fa fa-pencil"></i></a>
                                            <a href="#" name="<?php echo base_url("institute/data/delete_ppt/").$row->broucher_id ;?>" class="kabdelete" style="margin:0px 20px 0px 0px"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
        <div id="myModal" class="modal fade" role="dialog">
			  <div class="modal-dialog">

				<!-- Modal content-->
				<form id="addeditinstitute">
				<div class="modal-content">
						<div class="alert alert-success" style="display:none" id="smsg"></div>
						<div class="alert alert-danger" style="display:none" id="emsg"></div>
				 <div class="modal-header">
					
					<h6  style="font-weight:bold;text-align:center">Add PPT</h6>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				  </div>
				  <div class="modal-body">    
					  <input type="hidden" id="url" name="url" value="<?php echo base_url("institute/data/add_ppt");?>">
					  <div class="form-group">
						<label for="inputEmail3" class="col-form-label">PPT Name</label>
						  <input type="text" class="form-control"  name="brochure_name" required>
						
					  </div>
					  <div class="form-group">
						<label for="inputPassword3" class="col-form-label">PPT</label>
						  <input type="file" class="form-control"  name="picture" accept=".pptx" required>
						  <small style="color: red">Note : Maximum File size of ppt should be less than 1MB</small>
					  </div>
					  <div class="form-group">
						<label for="inputPassword3" class="col-form-label">Thumbnail Image</label>
						  <input type="file" class="form-control"  name="image" required>
						  <small style="color: red">Note : Maximum File size of image should be less than 1MB</small>
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
						<div class="alert alert-success" style="display:none" id="sumsg"></div>
						<div class="alert alert-danger" style="display:none" id="eumsg"></div>
							  <div class="modal-header">
								
								<h6 class="modal-title">Update PPT</h6>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							  </div>
							  <div class="modal-body">
								
								  <input type="hidden" id="url2" name="url" value="<?php echo base_url("institute/data/update_ppt");?>">
								  <input type="hidden" class="bid_val" name="bid">


								  <div class="form-group">
									<label for="inputEmail3" class="col-form-label">PPT Name</label>
									
									  <input type="text" class="form-control br_name_val"  name="brochure_name" required>
									
								  </div>
								  <div class="form-group">
									<label for="inputPassword3" class="col-form-label">PPT</label>
									
									  <input type="file" class="form-control"  name="picture" accept=".pptx">
						  				<small style="color: red">Note : Maximum File size of ppt should be less than 1MB</small>
									
								  </div>
														  
								  <div class="form-group">
									<label for="inputPassword3" class="col-form-label">Thumbnail Image</label>
									
									  <input type="file" class="form-control"  name="image">
						  				<small style="color: red">Note : Maximum File size of image should be less than 1MB</small>
									
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
	  $(".br_name_val").val($(this).attr('brochure_name'));
	  $(".bid_val").val($(this).attr('bid'));
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
            setTimeout(function(){ location.reload(); }, 1500);  
          }else{
            $("#emsg").show();
            $("#emsg").html(str.Message);
          }
        },
		   error : function(data){
			   console.log(data);
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
            $("#sumsg").show();
            $("#sumsg").html(str.Message);
            setTimeout(function(){ location.reload(); }, 1500);  
          }else{
            $("#eumsg").show();
            $("#eumsg").html(str.Message);
          }
        }
        });
    });

    });
	</script>