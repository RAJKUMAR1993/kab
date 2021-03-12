
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
                                <h2>Background Images</h2>
                            </div>
							<div class="col-md-2 pull-right">
							
								
							</div>                      
							</div>
                               
                        <div class="body">
						<hr>
                                  <div class="alert alert-success" style="display:none" id="sbmsg"></div>

            <div class="row">
                        <div class="col-md-8">
                        
                        	<? 
							
							$bimages = ["assets/exhibitors/audi-bg.jpg","assets/exhibitors/audi-bg1.jpg","assets/exhibitors/audi-bg2.jpg","assets/exhibitors/audi-bg3.jpg","assets/exhibitors/audi-bg4.jpg","assets/exhibitors/audi-bg5.jpg","assets/exhibitors/audi-bg6.jpg","assets/exhibitors/audi-bg7.jpg","assets/exhibitors/audi-bg8.jpg","assets/exhibitors/audi-bg9.jpg","assets/exhibitors/audi-bg10.jpg","assets/exhibitors/audi-bg11.jpg","assets/exhibitors/audi-bg12.jpg","assets/exhibitors/audi-bg13.jpg","assets/exhibitors/audi-bg14.jpg","assets/exhibitors/audi-bg15.jpg","assets/exhibitors/audi-bg16.jpg","assets/exhibitors/audi-bg17.jpg","assets/exhibitors/audi-bg18.jpg","assets/exhibitors/audi-bg19.jpg","assets/exhibitors/bg1.jpg","assets/exhibitors/bg2.jpg","assets/exhibitors/bg3.jpg","assets/exhibitors/bg4.jpg","assets/exhibitors/bg5.jpg","assets/exhibitors/bg6.jpg","assets/exhibitors/bg7.jpg","assets/exhibitors/bg8.jpg","assets/exhibitors/bg9.jpg","assets/exhibitors/bg10.jpg","assets/exhibitors/bg11.jpg","assets/exhibitors/bg12.jpg","assets/exhibitors/bg13.jpg","assets/exhibitors/bg14.jpg","assets/exhibitors/bg15.jpg","assets/exhibitors/bg16.jpg","assets/exhibitors/bg17.jpg","assets/exhibitors/bg18.jpg","assets/exhibitors/bg19.jpg","assets/exhibitors/bg20.jpg","assets/exhibitors/bg21.jpg","assets/exhibitors/bg22.jpg","assets/exhibitors/bg23.jpg","assets/exhibitors/bg24.jpg","assets/exhibitors/bg25.jpg","assets/exhibitors/bg26.jpg","assets/exhibitors/bg27.jpg","assets/exhibitors/bg28.jpeg","assets/exhibitors/bg29.png","assets/exhibitors/bg30.jpg","assets/exhibitors/bg31.jpg","assets/exhibitors/bg32.jpg","assets/exhibitors/bg33.jpg","assets/exhibitors/bg34.jpg","assets/exhibitors/bg35.jpg","assets/exhibitors/bg36.jpg","assets/exhibitors/bg37.jpg","assets/exhibitors/bg38.jpg","assets/exhibitors/bg39.jpg","assets/exhibitors/bg40.jpg","assets/exhibitors/bg41.jpg","assets/exhibitors/bg42.jpg","assets/exhibitors/bg43.jpg","assets/exhibitors/bg44.jpg","assets/exhibitors/bg45.jpg","assets/exhibitors/bg46.jpg","assets/exhibitors/bg47.jpg","assets/exhibitors/bg48.jpg","assets/exhibitors/bg49.jpg","assets/exhibitors/bg50.jpg","assets/exhibitors/bg51.jpg","assets/exhibitors/bg52.jpg","assets/exhibitors/bg53.jpg","assets/exhibitors/bg54.jpg","assets/exhibitors/bg55.jpg"]
							
							?>
                        	<form>
                        	
                        	<div class="row">
                        	
                        		
                        		<? 
								$i = 1;
								foreach($bimages as $bg){ 
								
								?>
                        		
									<div class="col-md-3" style="cursor: pointer">
										<div class="form-group" align="center">

											<label class="fancy-radio">
												<input class="bgimg" name="bgimage" value="<? echo $bg ?>" type="radio" <? echo ($bgurl == $bg) ? 'checked' : ''; ?>><span><i></i></span>

												<img class="img-thumbnail" src="<?php echo base_url().$bg ?>" width="100%" style="height: 120px">

											</label>
											<span style="text-align:center;margin-right: 20px;" class="badge badge-success"><? echo $i ?></span>
										</div>
									</div>
                       		
                       			<? 
								$i++;
								} ?>
                       			
                        	</div>
                        	</form>	
                        	
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-3">
                                <? if(isset($backgroundimage)){ 
                                  foreach ($backgroundimage as $bgi) {
                               
                                  ?>
                <h4>Selected Image</h4>
                                  <tr>
                                    <td><img src="<?php echo base_url().$bgi->url; ?>" width="100px" height="100px"></td>
                                    <td><div class="fancy-radio" style="display: none;">
                                          <label class="fancy-radio custom-color-green"><input  class="bgimg" name="bgimage" value="<? echo $bgi->url; ?>" type="radio" <? if($bgurl == $bgi->url){ echo 'checked';} ?>><span><i></i>12345</span></label>
                                          </div></td>
                                  </tr>
                                <? } } ?>
                                <br>
<br>

                                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Choose Custom Image</button>
                                
                            </div>
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
					
					<h6  style="font-weight:bold;text-align:center">Add Background Image</h6>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				  </div>
				  <div class="modal-body">    
											  <input type="hidden" id="url" name="url" value="<?php echo base_url("institute/settings/add_backgroundimage");?>">
											  
											  <div class="form-group row">
												<label for="inputPassword3" class="col-sm-2 col-form-label">Image</label>
												<div class="col-sm-10">
												  <input type="file" class="form-control"  name="picture" required>
                          <span>please upload 1920px * 1177px dimension image</span>
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
			
            
        </div>
    </div>
<script>


$(document).ready(function () {
     $('.bgimg').click(function () {
        var formData = $(this).val();
       var url = '<?php echo base_url("institute/settings/update_backgroundimage");?>';
       $.ajax({
        url:url,
        data:{url:formData},
        type:"post",
        dataType:"json",
    
        beforeSend: function(){
          $("#loader").show();
        },
        success: function(str){
          console.log(str);
          $("#loader").hide();
          if(str.Status == 'Active'){
            $("#myModal").modal("hide")
            $("#sbmsg").show();
            $("#sbmsg").html(str.Message);
            setTimeout(function(){ location.reload(); }, 1000);  
          }else{
            $("#ebmsg").show();
            $("#ebmsg").html(str.Message);
          }
        }
        });
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
            $("#myModal").modal("hide")
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