
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
       
         
    <div class="col-md-12">
                    <?php echo $this->session->flashdata('msg');?>
                    <div class="card">
                        <div class="header">
                            <div class="col-lg-9 pull-left">
                                <h2>Display Settings Details</h2>
                            </div>
                            <!-- <a href="<?php echo base_url("admin/institutes");?>" class="col-lg-1 pull-right"><u>Back</u></a> -->
                                   
                        </div>
                        <div class="body">
                            <div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
                            <form id="instituteUpdateDetails" method="post" enctype="multipart/form-data">
<!--                             <form id="basic-form" method="post" action="<?php echo base_url("institute/settings/update_display")?>" enctype="multipart/form-data"> -->
                                
							<div class="row">
                                 <div class="col-lg-6">
								    <div class="form-group">
                                        <label>Institution Name Font Family</label>
										<select class="form-control" name="ins_font_family">
										   <option value="">Select</option>
										   <option value="arial" <?php if($admin->ins_font_family == "arial"){ echo "selected"; }else{ echo ""; } ?> >Arial</option>
										    <option value="Times" <?php if($admin->ins_font_family == "Times"){ echo "selected"; }else{ echo ""; } ?>>Times</option>
										    <option value="serif" <?php if($admin->ins_font_family == "serif"){ echo "selected"; }else{ echo ""; } ?>>Serif</option>
										    <option value="sans-serif" <?php if($admin->ins_font_family == "sans-serif"){ echo "selected"; }else{ echo ""; } ?>>Sans-serif</option>
										    <option value="monospace" <?php if($admin->ins_font_family == "monospace"){ echo "selected"; }else{ echo ""; } ?>>Monospace</option>
										    <option value="cursive" <?php if($admin->ins_font_family == "cursive"){ echo "selected"; }else{ echo ""; } ?>>Cursive</option>
										    <option value="fantasy" <?php if($admin->ins_font_family == "fantasy"){ echo "selected"; }else{ echo ""; } ?>>fantasy</option>
											<option value="emoji" <?php if($admin->ins_font_family == "emoji"){ echo "selected"; }else{ echo ""; } ?>>emoji</option>
										    <option value="math" <?php if($admin->ins_font_family == "math"){ echo "selected"; }else{ echo ""; } ?>>math</option>
										    <option value="fangsong" <?php if($admin->ins_font_family == "fangsong"){ echo "selected"; }else{ echo ""; } ?>>fangsong</option>
										</select>
                                    </div>
                                 </div>
                                    
                                 <div class="col-lg-6">   
									<div class="form-group">
                                        <label>Institution Name Font Size</label>
										<select class="form-control" name="ins_font_size">
										    <option value="">Select</option>
										    <option value="10px" <?php if($admin->ins_font_size == "10px"){ echo "selected"; }else{ echo ""; } ?> >10</option>
										    <option value="11px" <?php if($admin->ins_font_size == "11px"){ echo "selected"; }else{ echo ""; } ?>>11</option>
										    <option value="12px" <?php if($admin->ins_font_size == "12px"){ echo "selected"; }else{ echo ""; } ?>>12</option>
										    <option value="13px" <?php if($admin->ins_font_size == "13px"){ echo "selected"; }else{ echo ""; } ?>>13</option>
										    <option value="14px" <?php if($admin->ins_font_size == "14px"){ echo "selected"; }else{ echo ""; } ?>>14</option>
										    <option value="15px" <?php if($admin->ins_font_size == "15px"){ echo "selected"; }else{ echo ""; } ?>>15</option>
										    <option value="16px" <?php if($admin->ins_font_size == "16px"){ echo "selected"; }else{ echo ""; } ?>>16</option>
										    <option value="17px" <?php if($admin->ins_font_size == "17px"){ echo "selected"; }else{ echo ""; } ?>>17</option>
										    <option value="18px" <?php if($admin->ins_font_size == "18px"){ echo "selected"; }else{ echo ""; } ?>>18</option>
										    <option value="19px" <?php if($admin->ins_font_size == "19px"){ echo "selected"; }else{ echo ""; } ?>>19</option>
										    <option value="20px" <?php if($admin->ins_font_size == "20px"){ echo "selected"; }else{ echo ""; } ?>>20</option>
										    <option value="21px" <?php if($admin->ins_font_size == "21px"){ echo "selected"; }else{ echo ""; } ?>>21</option>
										    <option value="22px" <?php if($admin->ins_font_size == "22px"){ echo "selected"; }else{ echo ""; } ?>>22</option>
										    <option value="23px" <?php if($admin->ins_font_size == "23px"){ echo "selected"; }else{ echo ""; } ?>>23</option>
										    <option value="24px" <?php if($admin->ins_font_size == "24px"){ echo "selected"; }else{ echo ""; } ?>>24</option>
										    <option value="25px" <?php if($admin->ins_font_size == "25px"){ echo "selected"; }else{ echo ""; } ?>>25</option>
										    <option value="26px" <?php if($admin->ins_font_size == "26px"){ echo "selected"; }else{ echo ""; } ?>>26</option>
										    <option value="27px" <?php if($admin->ins_font_size == "27px"){ echo "selected"; }else{ echo ""; } ?>>27</option>
										    <option value="28px" <?php if($admin->ins_font_size == "28px"){ echo "selected"; }else{ echo ""; } ?>>28</option>
										    <option value="29px" <?php if($admin->ins_font_size == "29px"){ echo "selected"; }else{ echo ""; } ?>>29</option>
										    <option value="30px" <?php if($admin->ins_font_size == "30px"){ echo "selected"; }else{ echo ""; } ?>>30</option>
										    <option value="31px" <?php if($admin->ins_font_size == "31px"){ echo "selected"; }else{ echo ""; } ?>>31</option>
										    <option value="32px" <?php if($admin->ins_font_size == "32px"){ echo "selected"; }else{ echo ""; } ?>>32</option>
										    <option value="33px" <?php if($admin->ins_font_size == "33px"){ echo "selected"; }else{ echo ""; } ?>>33</option>
										    <option value="34px" <?php if($admin->ins_font_size == "34px"){ echo "selected"; }else{ echo ""; } ?>>34</option>
										    <option value="35px" <?php if($admin->ins_font_size == "35px"){ echo "selected"; }else{ echo ""; } ?>>35</option>
										    <option value="36px" <?php if($admin->ins_font_size == "36px"){ echo "selected"; }else{ echo ""; } ?>>36</option>
										    <option value="37px" <?php if($admin->ins_font_size == "37px"){ echo "selected"; }else{ echo ""; } ?>>37</option>
										    <option value="38px" <?php if($admin->ins_font_size == "38px"){ echo "selected"; }else{ echo ""; } ?>>38</option>
										    <option value="39px" <?php if($admin->ins_font_size == "39px"){ echo "selected"; }else{ echo ""; } ?>>39</option>
										    <option value="40px" <?php if($admin->ins_font_size == "40px"){ echo "selected"; }else{ echo ""; } ?>>40</option>
										</select>
                                    </div>
								</div>
                                    
                                 <div class="col-lg-6">		
                                   
                                    <div class="form-group">
                                        <label>Institute Logo in Institution Detailed Page</label><br>
										<span style="color: red">Width:180px, Height:70px Please maintain aspect ratio</span>
                                        <input type="file" class="form-control dropify" id="comp_logo1"  data-max-file-size="1M" name="logo" data-allowed-file-extensions="jpg jpeg png" data-default-file="<?php echo base_url($admin->logo)?>">
                                        <input type="hidden" class="form-control" id="comp_logo" name="old_logo" value="<?php if(isset($admin->logo)){ echo $admin->logo;}?>" >
                                    </div>
                                </div>
                                    
                                 <div class="col-lg-6">   
                                     
                                    <div class="form-group">
                                        <label>Institute Theme Logo in Exhibitors List</label><br>
										<span style="color: red">Width:150px, Height:150px Please maintain aspect ratio</span>
                                        <input type="file" class="form-control dropify" id="theme_logo1"  data-max-file-size="1M" name="theme_logo" data-allowed-file-extensions="jpg jpeg png" data-default-file="<?php echo base_url($admin->theme_logo)?>">
                                        <input type="hidden" class="form-control" id="theme_logo" name="old_theme_logo" value="<?php if(isset($admin->theme_logo)){ echo $admin->theme_logo;}?>" >
                                    </div>
									
                                </div>
								<div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Theme Picture Exhibitors List</label><br>
										<span style="color: red">Width:760px, Height:432px Please maintain aspect ratio</span>
                                        <input type="file" class="form-control dropify" data-max-file-size="1M" name="theme" data-allowed-file-extensions="jpg jpeg png" id="old_theme1" data-default-file="<?php echo base_url($admin->theme_picture)?>">
                                        <input type="hidden" class="form-control" id="old_theme" name="old_theme" value="<?php if(isset($admin->theme_picture)){ echo $admin->theme_picture;}?>" >
                                    </div>
                                </div>
                                <div class="col-lg-6 pull-right">
                                    <div class="form-group">
                                        <label>Theme Picture Institution Detailed Page</label><br>
										<span style="color: red">Width:650, Height:450px Please maintain aspect ratio</span>
                                        <input type="file" class="form-control dropify" id="old_detailed_theme1" data-max-file-size="1M" name="deatiled_theme" data-allowed-file-extensions="jpg jpeg png" data-default-file="<?php echo base_url($admin->detailed_theme_picture)?>">
                                        <input type="hidden" class="form-control" id="old_detailed_theme" name="old_detailed_theme" value="<?php if(isset($admin->detailed_theme_picture)){ echo $admin->detailed_theme_picture;}?>" >
                                    </div>
                                </div>
                                 
								
                                <!--<div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                         <label>Video URL(Enter Youtube Url)</label>
                                        <input type="text" class="form-control" id="txt" name="videourl" value="<?php if(isset($admin->institute_video_url)){ echo $admin->institute_video_url;}?>" />
                                    </div>
                                </div>-->
                                
                                    <div class="col-lg-6">
									   <div class="form-group"> 
											<label>Upload Video in Exhibitors List</label><br>
											<input type="file" accept="video/*"  class="dropify" data-allowed-file-extensions="mp4 mp3" name="video" <?php if(isset($admin->institue_video)){}else{} ?>/>
										</div>
									</div>
									<div class="col-lg-6">
									   <div class="form-group"> 
									   		<h5>Uploaded Video Preview <?php if($admin->institute_video != ""){ ?>
											    <i name="data" type="button" class="fa fa-times-circle" onclick="getData()" style="left: 169px;top: 28px;position: relative;cursor: pointer;color:red"></i>
											<?php } ?></h5>
											<?php if($admin->institute_video != ""){ ?>
												<video width="400" controls controlsList="nodownload">
									      		<source src="<?php echo base_url().$admin->institute_video;?>" type="video/mp4">
												</video>
											<?php }else{ } ?>	
										</div>
									</div>
									
									<div class="col-lg-6">
										<div class="form-group">
											 <label>Institution Title Header Color : </label>
											<input type="color" id="favcolor" name="favcolor" value="<?php if($admin->header_color_code != ""){ echo $admin->header_color_code;}else{ echo "#3f18aa"; }?>">
										</div>
										
										<div class="form-group">
											 <label>Institution Font Color : </label>
											<input type="color" name="ins_font_color" value="<?php if($admin->ins_font_color != ""){ echo $admin->ins_font_color;}else{ echo "#3f18aa"; }?>">
									</div>
										
										<p style="color: red">Notes : In exhibitors page uploaded video shown first and theme picture next.</p>
                                    </div>
                                    <?php if(isset($admin->institute_video) && $admin->institute_video!=''){ ?>
									
									<input type="hidden" name="old_video" value="<?php echo $admin->institute_video;?>">
									<?php } else{
										echo '<div class="col-lg-6 col-md-12"></div>';
									}?>
                                
								</div>


                                 <button type="submit" class="btn btn-primary pull-right">Update Details</button><br><br><br>
                                 <center><img src="<? echo base_url(); ?>assets/images/load.gif" width="42" height="42" alt="" style="display:none" id="loader"></center>
								 
                            </form>
                        </div>
                    </div>
    </div>
</div>

<script type="text/javascript">
  $('.dropify').dropify({
    messages: {
        'default': 'Drag and drop a file here or click',
        'replace': 'Drag and drop or click to replace',
        'remove':  'Remove',
        'error':   'Ooops, something wrong happended.'
    }
});

	
	
</script>
<script>
function myFunction() {
  var x = document.getElementById("mySelect").value;
  //alert(x);
  if(x==2){
    $('#cctype').show();
    $('#overseascountry').hide();
  } else if(x==3){
    $('#cctype').hide();
    $('#overseascountry').show();
  } else {
    $('#cctype').hide();
    $('#overseascountry').hide();
  }
}
</script>
<script type="text/javascript">
  $(document).ready(function(){
    function matchYoutubeUrl(url) {
		var p = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
		var matches = url.match(p);
		if(matches){
			return matches[1];
		}
		return false;
	}
    $("#instituteUpdateDetails").on('submit', function(e){
	   e.preventDefault();
	   var fdata = new FormData(this);
		
       var url = '<?php echo base_url("institute/settings/update_display") ?>';
	   $.ajax({
			url:url,
			data:fdata,
			type:"post",
			dataType:"json",
			processData:false,
			  contentType:false,
			  cache:false,
			beforeSend: function(){
			  $("#loader").show();
			},
			success: function(str){
			  console.log(str);
			  $("#loader").hide();
			  if(str.Status == 'Active'){
				$("#smsg").show();
				$("#smsg").html(str.Message);
				setTimeout(function(){ $("#smsg").hide(); location.reload(); }, 500);
			  }else{
				$("#emsg").show();
				$("#emsg").html(str.Message);
			  }
			}
			});
       
    });
		
		
    var drEvent = $('#comp_logo1').dropify();
	drEvent.on('dropify.afterClear', function(event, element){
		$('#comp_logo').val('');
	});
	
	
	var drEvent1 = $('#theme_logo1').dropify();
	drEvent1.on('dropify.afterClear', function(event, element){
		$('#theme_logo').val('');
	});
	
	var drEvent2 = $('#old_theme1').dropify();
	drEvent2.on('dropify.afterClear', function(event, element){
		$('#old_theme').val('');
	});
	
	var drEvent3 = $('#old_detailed_theme1').dropify();
	drEvent3.on('dropify.afterClear', function(event, element){
		$('#old_detailed_theme').val('');
	});
});
	
</script>

<script type="text/javascript">

    
    $('.summernote').summernote({
    toolbar: [
    ['style', ['style']],
    ['font', ['bold', 'italic', 'underline', 'clear']],
    ['fontname', ['fontname']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']],
    ['table', ['table']],
   // ['insert', ['link', 'picture', 'hr']],
    ['view', ['fullscreen', 'codeview']],
    ['help', ['help']]
  ],
  height: 100,
});
function getData() {
		var val = "";
       $.ajax({
			
			type : "post",
			url : "<? echo base_url('institute/settings/delete_video') ?>",
			data : {state : val},
			success : function(data){
				
				location.reload();
				
			}
			
		});
    }
</script>