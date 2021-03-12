
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
                                <h2>Gallery</h2>
                            </div>
							<div class="col-md-2 pull-right">
							<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Add Gallery Title</button>
								
							</div>                      
							</div>
                               
                        <div class="body">
						<hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Title</th>
                                        <th>Images</th>
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
                                        <td><?php echo $row->gallery_title;?></td>
                                        <td><a href="<?php echo base_url("institute/data/add_gallery_images/").$row->title_id ;?>" style="margin:0px 20px 0px 20px"><i class="fa fa-image"></i></a></td>
                                         <td>
                                            <a href="#" class="update_user_button" title_name="<?php echo $row->gallery_title;  ?>" tid="<?php echo $row->title_id; ?>" ><i class="fa fa-pencil"></i></a>
                                            <a href="#" name="<?php echo base_url("institute/data/delete_title/").$row->title_id ;?>" class="kabdelete" style="margin:0px 20px 0px 0px"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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

            
        </div>
    </div>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
	<form class="form-inline" id="addeditinstitute">
    <div class="modal-content">
     						<div class="alert alert-success" style="display:none" id="smsg"></div>
     						<div class="alert alert-danger" style="display:none" id="emsg"></div>

      <div class="modal-header">
        
        <h6 class="modal-title">Add Gallery Title</h6>
		<button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        
								  <input type="hidden" id="url" name="url" value="<?php echo base_url("institute/data/add_title");?>">
								  <div class="form-group">
									<label for="pwd">Gallery Title :&nbsp;&nbsp;</label>
									<input type="text" class="form-control" size="45" name="title" required>
								  </div>&nbsp;&nbsp;&nbsp;
								  
								
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
		  		<form class="form-inline" id="addeditinstitute_update">
				<div class="modal-content">
     						<div class="alert alert-success" style="display:none" id="sumsg"></div>
     						<div class="alert alert-danger" style="display:none" id="eumsg"></div>
				  <div class="modal-header">
					
					<h6 class="modal-title">Update Gallery Title</h6>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				  </div>
				  <div class="modal-body">
					
											  <input type="hidden" id="url2" name="url" value="<?php echo base_url("institute/data/update_title");?>">
											  <input type="hidden" class="tid_val" name="tid">
											  <div class="form-group">
												<label for="pwd">Gallery Title :&nbsp;&nbsp;</label>
												<input type="text" class="form-control title_name_val" size="45" name="title" required>
											  </div>&nbsp;&nbsp;&nbsp;
											  
											
				  </div>
				  <div class="modal-footer">
					<button type="submit" class="btn btn-primary">Update</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				  </div>
				</div>
				</form>
		    </div><!--.modal-dialog-->
		</div><!--.modal-->
<script>
$(document).ready(function(){
  $(".update_user_button").click(function () {
	  $(".title_name_val").val($(this).attr('title_name'));
	  $(".tid_val").val($(this).attr('tid'));
    $("#updateModal").modal();

});
    $("#addeditinstitute").on('submit', function(e){
       e.preventDefault();
       var fdata = $("#addeditinstitute").serialize();
       var url = $('#url').val();
			//alert(url);
       $.ajax({
        url:url,
        data:fdata,
        type:"post",
        dataType:"json",
        beforeSend: function(){
          $("#loader").show();
        },
        success: function(str){
            //alert(str);
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
	
	$("#addeditinstitute_update").on('submit', function(e){
       e.preventDefault();
       var fdata = $("#addeditinstitute_update").serialize();
       var url = $('#url2').val();
			//alert(url);
       $.ajax({
        url:url,
        data:fdata,
        type:"post",
        dataType:"json",
        beforeSend: function(){
          $("#loader").show();
        },
        success: function(str){
            //alert(str);
          console.log(str);
          $("#loader").hide();
          if(str.Status == 'Active'){
            $("#sumsg").show();
            $("#sumsg").html("successfully Updated");
            setTimeout(function(){ location.reload(); }, 1000);  
          }else{
            $("#eumsg").show();
            $("#eumsg").html(str.Message);
          }
        }
        });
    });

    });
	</script>