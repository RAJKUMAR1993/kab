
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
                                <h2>Cards</h2>
                            </div>
							<div class="col-md-2 pull-right">
							<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Add Card</button>
								
							</div>                      
							</div>
                               
                        <div class="body">
						<hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
									    <th></th>
                                        <th>S.no</th>
                                        <th>Card Title</th>
                                        <th>Card Image</th>
                                        <th>Card Info</th>
                                        
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($cards){
                                            $key=1;
                                            foreach($cards as $row):
                                        ?>
                                    <tr>
									    <td>
                                            <a href="#" class="update_user_button" card_title="<?php echo $row->card_title;  ?>" card_desc="<?php echo $row->card_desc;  ?>" card_link="<?php echo $row->card_link;  ?>" card_image="<?php echo $row->card_image;  ?>" cid="<?php echo $row->card_id ; ?>" ><i class="fa fa-pencil"></i></a>
                                            <a href="#" name="<?php echo base_url("admin/homepage/delete_cards/").$row->card_id ;?>" class="kabdelete" style="margin:0px 20px 0px 0px"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        </td>
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $row->card_title;?></td>
                                        <td><img src="<?php echo base_url("assets/images/cards/").$row->card_image; ?>" width="100px" height="100px"></td>
                                        <td><?php echo $row->card_desc;?></td>
                                         
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
				  <div class="modal-header">
					
					<h6  style="font-weight:bold;text-align:center">Add Card</h6>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				  </div>
				  <div class="modal-body">    
											  <input type="hidden" id="url" name="url" value="<?php echo base_url("admin/homepage/add_card");?>">
											  <div class="form-group row">
												<label for="inputEmail3" class="col-sm-2 col-form-label">Card Title</label>
												<div class="col-sm-10">
												  <input type="text" class="form-control"  name="card_title" required>
												</div>
											  </div>
											  <div class="form-group row">
												<label for="inputPassword3" class="col-sm-2 col-form-label">Card Image</label>
												<div class="col-sm-10">
												  <input type="file" class="form-control"  name="picture" required>
												</div>
											  </div>
											  <div class="form-group row">
												<label for="inputEmail3" class="col-sm-2 col-form-label">Card Info</label>
												<div class="col-sm-10">
												  <textarea class="form-control" rows="5"  name="card_desc" required></textarea>
												</div>
											  </div>
											  <div class="form-group row">
												<label for="inputEmail3" class="col-sm-2 col-form-label">Card Link</label>
												<div class="col-sm-10">
												  <input type="text" class="form-control"  name="card_link" required>
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
							  <div class="modal-header">
								
								<h6 class="modal-title">Update Card</h6>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							  </div>
							  <div class="modal-body">
								
											   <input type="hidden" id="url2" name="url" value="<?php echo base_url("admin/homepage/add_card");?>">
											    <input type="hidden" class="cid" name="cid">
											    <input type="hidden" class="card_image" name="card_image">
														  
														  
											 <div class="form-group row">
												<label for="inputEmail3" class="col-sm-2 col-form-label">Card Title</label>
												<div class="col-sm-10">
												  <input type="text" class="form-control card_title"  name="card_title" required>
												</div>
											  </div>
											  <div class="form-group row">
												<label for="inputPassword3" class="col-sm-2 col-form-label">Card Image</label>
												<div class="col-sm-10">
												  <input type="file" class="form-control"  name="picture">
												</div>
											  </div>
											  <div class="form-group row">
												<label for="inputEmail3" class="col-sm-2 col-form-label">Card Info</label>
												<div class="col-sm-10">
												  <textarea class="form-control card_desc" rows="5"  name="card_desc" required></textarea>
												</div>
											  </div>
											  <div class="form-group row">
												<label for="inputEmail3" class="col-sm-2 col-form-label">Card Link</label>
												<div class="col-sm-10">
												  <input type="text" class="form-control card_link"  name="card_link" required>
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
	  $(".card_title").val($(this).attr('card_title'));
	  $(".card_desc").val($(this).attr('card_desc'));
	  $(".card_image").val($(this).attr('card_image'));
	  $(".card_link").val($(this).attr('card_link'));
	  $(".cid").val($(this).attr('cid'));
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
	</script>