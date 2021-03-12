
<!--
<link rel="stylesheet" href="https://bootstraplily.com/demo/youtube-website-html/css/owl.carousel.css">
    <link rel="stylesheet" href="https://bootstraplily.com/demo/youtube-website-html/css/owl.theme.default.css">
-->
    <script src="https://kit.fontawesome.com/b31e06099e.js" crossorigin="anonymous"></script>
<script>


</script>

<!-- Custom Modal Windows -->
<div class="custom_modal" id="Video">
    <div class="row">
        <div class="col-md-12 text-right">
            <a style="font-size:20px;cursor:pointer;color:red" onclick="closeModal('Video');">
                <i class="icon-cancel-6"></i>
            </a>
        </div>
    </div>
    <div class="container margin_35">
	<!--<div class="grid row">
	<div style="width:100%;padding:10px;background-color:#f1f1f1">
		<h6 style="margin-bottom:0px">Video Gallery</h6>
	</div>
	</div>-->
		
		<div class="main_title_2">
				<span><em></em></span>
				<h2>Video Gallery</h2>
			</div>
		
		
			<!--<div class="grid row" style="margin-top:20px">
				
				<?
//					$vdata = $this->db->get_where("tbl_video",["institute_id"=>$idata->institute_id])->result();
//					if(count($vdata) > 0){
//					foreach ($vdata as $row) { 
//				   		$insinfo = $this->institute_model->get_institute_id($row->institute_id);
				 ?>
					<div class="col-md-4">
						<video controls style="opacity: inherit;padding: 10px;background-color:#f1f1f1">
							<source src="<?php //echo base_url().$row->url; ?>" type="video/mp4">
						</video>
					</div>
					
				<? /*}}else{
						echo '<p style="text-align:center;font-size:15px;font-weight:400;text-color:red">No Videos </p>';
					}*/ ?>
			</div>-->
			<!-- /grid gallery -->
       
       
       
       <div class="container" style="margin-bottom: 30px">
       
       
				<div class="row">
				
					

				<?
					$vdata = $this->db->get_where("tbl_video",["institute_id"=>$idata->institute_id])->result();
					if(count($vdata) > 0){
					foreach ($vdata as $row) { 
						$insinfo = $this->institute_model->get_institute_id($row->institute_id);
				 ?>
						<div class="box_list col-md-5" style="min-height: 200px">
						
							<div class="row">
						
								<div class="col-md-6">
									<video controls style="opacity: inherit;padding: 10px;">
										<source src="<?php echo base_url().$row->url; ?>" type="video/mp4">
									</video>
								</div>
								<div class="col-md-6">
									<div class="wrapper">
										<h3><? echo $row->title ?></h3>
										<p style="text-align: justify" class="rvhide<? echo $row->video_id ?>"><? echo nl2br(substr($row->description,0,130)) ?> <? echo (strlen(trim($row->description)) > 130) ? '<a class="rvmore" href="javascript:void(0)" style="color:blue;" id="'.$row->video_id.'">Read More</a>': ''; ?></p>
										<p style="text-align: justify;display: none" class="rmore<? echo $row->video_id ?>"><? echo nl2br($row->description) ?></p>
									</div>
								</div>
								
							</div>	
							
						</div>
							
						<div class="col-md-1"></div>			

							<? }}else{
						echo '<h3 style="text-align:center;font-size:16px;font-weight:400;text-color:red">No Videos </h3>';
					} ?>
					
					
					
				</div>
			
      </div>	
       
       
       
       
       
        </div>
        <br/><br/>
</div>

<script>

	$(".rvmore").click(function(){
		
		var vid = $(this).attr("id");
		$(".rvhide"+vid).hide();
		$(".rmore"+vid).show();
		
	})

</script>

<!-- Custom Modal Windows -->
<!--
<script src="https://bootstraplily.com/demo/youtube-website-html/js/owl.carousel.js"></script>
<script src="https://bootstraplily.com/demo/youtube-website-html/js/jquery.hoverplay.js"></script> -->
