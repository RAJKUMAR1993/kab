<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js"></script>
<style>.portfolio-menu{
  text-align:center;
}
.portfolio-menu ul li{
  display:inline-block;
  margin:0;
  list-style:none;
  padding:10px 15px;
  cursor:pointer;
  -webkit-transition:all 05s ease;
  -moz-transition:all 05s ease;
  -ms-transition:all 05s ease;
  -o-transition:all 05s ease;
  transition:all .5s ease;
}

.portfolio-item{
  /*width:100%;*/
}
.portfolio-item .item{
  /*width:303px;*/
  float:left;
  margin-bottom:10px;
}
</style>
<div class="custom_modal" id="photo">
    <div class="row">
        <div class="col-md-12 text-right">
            <a style="font-size:20px;cursor:pointer;color:red" onclick="closeModal('photo');">
                <i class="icon-cancel-6"></i><p style="font-size:10px">Close</p>
            </a>
        </div>
    </div>
    <div class="container margin_35">
			<!--<div class="grid row">
			<div style="width:100%;padding:10px;background-color:#f1f1f1">
				<h6 style="margin-bottom:0px">Photo Gallery</h6>
			</div>
			</div>-->
			
			<div class="main_title_2">
				<span><em></em></span>
				<h2>Photo Gallery</h2>
			</div>
			
			<div class="grid">
			
			  <? 
				$gdata = $this->db->get_where("tbl_gallery_title",["institute_id"=>$idata->institute_id,"deleted"=>0])->result();
				if($gdata){
					
				 $earray = [];
					
					foreach($gdata as $row){
						
						array_push($earray,$this->institute_model->get_institute_gallery($row->title_id));
						
					}
			
					
				if($earray[0]){	
					
				  $gallery = array();
			  ?>  
				 <div class="portfolio-menu mt-2 mb-4">
					<ul>

					   <li class="btn btn-outline-dark active" data-filter="*" style="color: white;width: auto;">All</li>
					   <? foreach($gdata as $row){ ?>
						<?  array_push($gallery,$this->institute_model->get_institute_gallery($row->title_id));?>
					   <li class="btn btn-outline-dark" data-filter=".gts<? echo $row->title_id; ?>" style="color: white;width: auto;"> <? echo $row->gallery_title; ?></li>
					 <? } ?>
					</ul>
				 </div>
			
			 <div class="portfolio-item row">


       <?  if($gallery){
       
        $key = 1;
            foreach ($gallery as $row3) { 
              foreach ($row3 as $row4) {
               
              
              ?>
             <div class="item gts<? echo $row4->title_id; ?> col-lg-3 col-md-4 col-6 col-sm">
               <a href="<? echo base_url('assets/images/gallery/').$row4->images; ?>" class="fancylight popup-btn" data-fancybox-group="light"> 
               <img class="" src="<? echo base_url('assets/images/gallery/').$row4->images; ?>" style="height: 180px" alt="">
               </a>
            </div>
        <?  $key++;  } } } ?>
            
         </div>
        <? }else{
					
				echo '<h3 style="text-align:center;font-size:18px;font-weight:600;text-color:red">No Images Found</h3>';	
					
				}}else{
					
				echo '<h3 style="text-align:center;font-size:18px;font-weight:600;text-color:red">No Images Found</h3>';	
					
				} ?>
			
			</div>
			<!-- /grid gallery -->
        </div>
        <br/><br/>
</div>
<style type="text/css">
  .mfp-wrap {
    z-index: 9999999999999;
  }
</style>
<script>
         $('.portfolio-menu ul li').click(function(){
          $('.portfolio-menu ul li').removeClass('active');
          $(this).addClass('active');
          
          var selector = $(this).attr('data-filter');
          $('.portfolio-item').isotope({
            filter:selector
          });
          return  false;
         });
         $(document).ready(function() {
         var popup_btn = $('.popup-btn');
         popup_btn.magnificPopup({
         type : 'image',
         gallery : {
          enabled : true
         }
         });
         });
</script>