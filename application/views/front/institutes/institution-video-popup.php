<!--<script src="https://kit.fontawesome.com/b31e06099e.js" crossorigin="anonymous"></script>-->
<!-- Custom Modal Windows -->
<div class="custom_modal" id="Video">
    <div class="row">
        <div class="col-md-12 text-right">
            <a style="font-size:20px;cursor:pointer;color:red" onclick="closeModal('Video');">
                <i class="icon-cancel-6"></i><p style="font-size:10px">Close</p>
            </a>
        </div>
    </div>
    <div class="container">
		<div class="grid row" style="margin-bottom:20px">
			<div style="width:100%;padding:10px;background-color:#f1f1f1">
					<h6 style="margin-bottom:0px;"><i class="fa fa-video"></i> VIDEO GALLERY</h6>
			</div>
		</div>
	</div>
		
	<?php
	$vdata = $this->db->get_where("tbl_video",["institute_id"=>$idata->institute_id,"status"=>"Active","is_deleted"=>0])->result();
	if(count($vdata) > 0){?>
    <div class="container">
		<div class="row">
			<? foreach($vdata as $row){?>
				<div class="col-lg-4" style="margin-bottom:20px">
					<div style="padding:5px;background:#f1f1f1;width:100%;">
					<video controls style="opacity: inherit;padding: 5px;width:100%;position:relative">
					<source src="<?php echo base_url().$row->url; ?>" type="video/mp4">
					</video>
					</div>
					<div style="max-height:120px;min-height:120px;border:1px solid #f1f1f1;padding:5px;overflow-y:auto">
						<h6 style="text-transform:uppercase;text-align:center"><? echo $row->title ?></h6>
						<p style="font-weight:normal;margin-bottom:0px;text-align:center">
							<? if($row->description == ''){ ?>
								<i class="fa fa-exclamation-circle"></i><br/>
								<i>No Description found</i>
							<? }else{ ?>
								<? echo $row->description; ?>
							<? }?>
						</p>
					</div>
				</div>
			<?}?>
		</div>
	</div>
	<?}else{?>

	<? } ?>  
       
     
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
