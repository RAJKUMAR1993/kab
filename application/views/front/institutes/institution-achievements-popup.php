<div class="custom_modal" id="achivements">
    <div class="row">
        <div class="col-md-12 text-right">
            <a style="font-size:20px;cursor:pointer;color:red" onclick="closeModal('achivements');">
                <i class="icon-cancel-6"></i><p style="font-size:10px">Close</p>
            </a>
        </div>
    </div>
    <div class="container margin_35">
				<div class="main_title_2">
				<span><em></em></span>
				<h2>Testimonials</h2>
			</div>
		
			<div class="grid">
    <section id="testi" style="margin-top: 20px">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
       
        <?  
		  
		 $testimonials = $this->db->get_where("tbl_institute_testimonials",["status"=>"Active","deleted"=>0,"institute_id"=>$idata->institute_id])->result();
		  
		  if($testimonials){
		  
		 ?>
       
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <h2> <b>Testimonials</b></h2>
          <!-- Carousel indicators -->
         
          <!-- Wrapper for carousel items -->
          <div class="carousel-inner">
		   <?php
				
				$i=1; foreach (array_chunk($testimonials, 2) as $group){ ?>
            <div class="item carousel-item <?php if($i == 1){ echo "active"; } ?>">
              <div class="row">
			  <?php foreach($group as $ts){ 
				  
				  if(file_exists($ts->image)){
					  
					  $timage = base_url().$ts->image;
					  
				  }else{
					  
					  $timage = base_url()."assets/images/user.png";
					  
				  }
				  ?>
				<div class="col-sm-6">
                  <div class="testimonial">
                    <p><?php echo $ts->description; ?></p>
                  </div>
                  <div class="media">
                    <div class="media-left d-flex mr-3"> 
                    	<img src="<? echo $timage ?>" alt=""> 
                    </div>
                    <div class="media-body">
                      <div class="overview" style="margin-top: 10px">
                        <div class="name"><b><?php echo $ts->st_name; ?></b></div>
                        <div class="details"><?php echo $ts->title; ?></div>
                        
                      </div>
                    </div>
                  </div>
                </div>
			  <?php } ?>
              </div>
            </div>
			<?php $i++; } ?>
            
            
          </div>
          <!-- Carousel controls --> 
          
          <? if(count($testimonials) > 2){ ?>
          
          <a class="carousel-control left carousel-control-prev" href="#myCarousel" data-slide="prev"> <i class="fa fa-chevron-left"></i> </a> <a class="carousel-control right carousel-control-next" href="#myCarousel" data-slide="next"> <i class="fa fa-chevron-right"></i> </a> 
          
          <? } ?>
          
          </div>
          
          <? }else{
			  
			  echo '<p style="text-align:center;font-weight:400;font-size:18px;color:white;">No Testiminials Found</p>';
			  
		  } ?>
          
      </div>
    </div>
  </div>
</section>  

 
  </div>
  
  </div>
</div>
</div>