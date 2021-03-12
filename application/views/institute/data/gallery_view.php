
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
						<div class="alert alert-success" style="display:none" id="smsg"></div>
						<div class="alert alert-danger" style="display:none" id="emsg"></div>
						    <div class="col-md-10 pull-left">
							  <h5>Gallery Title : <?php echo $this->db->where("title_id",$this->uri->segment(4))->get("tbl_gallery_title")->row()->gallery_title; ?></h5>
							</div>
							<div class="col-md-2 pull-right">
								<a href="<?php echo base_url(); ?>institute/data/gallery" style="text-decoration:underline;">Back</a>
							</div>                      
							</div>
                               
                        <div class="body"><hr>
						        <form class="form-inline" id="addeditinstitute">
								  <input type="hidden" id="url" name="url" value="<?php echo base_url("institute/data/save_gallery_image");?>">
								  <div class="form-group">
									<label for="pwd">Upload Images :&nbsp;&nbsp;</label>
									<input type="file" class="form-control" name="picture[]" accept="image/*" multiple required><br>

									<input type="hidden" class="form-control" name="title_id" value="<?php echo $this->uri->segment(4); ?>">
								  </div>&nbsp;&nbsp;&nbsp;
								  <button type="submit" class="btn btn-primary">Upload</button>
								</form><br>
				<small style="color: red">Note : Maximum 12 Images are allowed to add.<!-- & Maximum size of image should be less than 200KB--></small>
						    <div class="row">
							<?php foreach($gallery as $row){ ?>
								<div class="col-md-3">
								  <a href="#" name="<?php echo base_url("institute/data/delete_image/").$row->id ;?>" class="imgdelete" ><span class="glyphicon glyphicon-remove pull-right"></span></a>
								  <img src="<?php echo base_url(); ?>assets/images/gallery/<?php echo $row->images; ?>" class="img-thumbnail" alt="Cinque Terre" width="304" height="236">
								  
								</div>
							<?php } ?>
						  </div>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
<script type="text/javascript">
//    $(document).ready(function(){
  
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
        },
		   error : function(data){
			   console.log(data);
		   }
        });
    });
	
	$('.imgdelete').click(function(e){
		var element = jQuery(this);
		var delid = element.attr("name");

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
			  url:delid,
			  type:"get",
			  success:function(str){
				setTimeout(function(){ location.reload(); }, 1000);
			  }
			}); 
	//         setInterval(function(){ location.reload(); }, 1000);
		});

		return false;
	  });
	

//    });
</script>