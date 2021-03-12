
<style>
    td.details-control {
    background: url('<?php echo base_url(); ?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
    tr.shown td.details-control {
        background: url('<?php echo base_url(); ?>assets/images/details_close.png') no-repeat center center;
    }
    .col-md-10 {
     max-width: 70.333333%;
    }
    .col-md-2 {
      max-width: 19.333333%;
    }
</style>

<div id="main-content">
        <div class="container-fluid">
            
            <div class="row clearfix">
                
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
						
                            <div class="col-md-10 pull-left">
                                <h2>Partners & Sponsor</h2>
                            </div>
							<div class="col-md-2 pull-right">
							<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Add Partners & Sponsor</button>
								
							</div>                      
							</div>
                               
                        <div class="body">
						<hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Types</th>
                                        <th>Year</th>
                                        <th>Actions</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($partners){
                                            $key=1;
                                            foreach($partners as $row):
                                        ?>
                                    <tr>
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $row->name;?></td>
                                        <td><img src="<?php echo base_url("assets/images/partners/").$row->partner_image; ?>" width="100px" height="100px"></td>
                                        <td><?php echo $row->categories_partners;?></td>
                                        <td><?php echo $row->year;?></td>
                                        <td>
                                            <a href="#" class="update_user_button" partner_image="<?php echo $row->partner_image;  ?>" partner_name="<?php echo $row->name;  ?>"  pid="<?php echo $row->partner_id  ; ?>"  categories_partners="<?php echo $row->categories_partners  ; ?>"  year="<?php echo $row->year  ; ?>"><i class="fa fa-pencil"></i></a>
                                            <a href="#" name="<?php echo base_url("admin/homepage/delete_partner/").$row->partner_id ;?>" class="kabdelete" style="margin:0px 20px 0px 0px"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
					
					<h6  style="font-weight:bold;text-align:center">Add Partner Image</h6>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				  </div>
				  <div class="modal-body">    
											  <input type="hidden" id="url" name="url" value="<?php echo base_url("admin/homepage/add_partner");?>">
											  
                        <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="name" required>
                        </div>
                        </div>
                        <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-10">
                        <select  class="form-control" rows="5" cols="30" name="categories_partners" required>
                          <option value="">Category name</option>
                          <option value="Partners" >Partners</option>
                          <option value="Sponsor" >Sponsor</option>
                       </select>
                        </div>
                        </div>
											  <div class="form-group row">
												<label for="inputPassword3" class="col-sm-2 col-form-label">Image</label>
												<div class="col-sm-10">
												  <input type="file" accept="image/jpeg" class="form-control"  name="picture" required>
												  <small style="color: red">Note: Please upload 300*200px Image</small>
												</div>
                        </div>
                        <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Year</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control year" name="year" required>
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
						    <div class="alert alert-success" style="display:none" id="sumsg"></div>
           <div class="alert alert-danger" style="display:none" id="emsg"></div>
							  <div class="modal-header">
								
								<h6 class="modal-title">Update Partner Image</h6>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							  </div>
							  <div class="modal-body">
								
											   <input type="hidden" id="url2" name="url" value="<?php echo base_url("admin/homepage/add_partner");?>">
											    <input type="hidden" class="pid" name="pid">
                          <input type="hidden" class="partner_image" name="partner_image">
                          <input type="hidden" class="categories_partners" name="categories_partners">
											  
                        <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control name" name="name" required>
                        </div>
                        </div>
                        <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-10">
                        <select  class="form-control categories_partners" rows="5" cols="30" name="categories_partners" required>
                          <option value="">Category name</option>
                          <option value="Partners" >Partners</option>
                          <option value="Sponsor" >Sponsor</option>
                       </select>
                        </div>
                        </div>
											  <div class="form-group row">
												<label for="inputPassword3" class="col-sm-2 col-form-label">Image</label>
												<div class="col-sm-10">
												  <input type="file" accept="image/jpeg" class="form-control"  name="picture">
												  <small style="color: red">Note: Please upload 300*200px Image</small>
												</div>
                        </div>
                        <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Year</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control year" name="year" required>
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
	  $(".partner_image").val($(this).attr('partner_image'));
    $(".name").val($(this).attr('partner_name'));
    $(".categories_partners").val($(this).attr('categories_partners'));
    $(".year").val($(this).attr('year'));
	  $(".pid").val($(this).attr('pid'));
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
            setTimeout(function(){ location.reload(); }, 1000);  
          }else{
            $("#emsg").show();
            $("#emsg").html(str.Message);
          }
        }
        });
    });

    });
	</script>