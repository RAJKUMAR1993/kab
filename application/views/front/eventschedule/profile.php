<link rel="stylesheet" href="<?php echo base_url();?>assets/profilepage/style.min-bc5958d152.css">

<div class="custom_modal" id="profile">
    <div class="row">
        <div class="col-md-12 text-right">
            <a style="font-size:20px;cursor:pointer;color:red" onclick="closeModal('profile');">
                <i class="icon-cancel-6"></i><p style="font-size:10px">Close</p>
            </a>
        </div>
    </div>
	<div class="gray_outer_bg mentor_pro_detail" style="margin-bottom: 100px;">
	   <div class="container">
	      	<?php 
				$this->load->view("front/eventschedule/profile_basic")
	      	?>
	      <div class="row"> 
	         <div class="full_mentor_detail">
	            <div class="row">
	               <div class="col-sm-12 m_abt">
	                  <h3 class="basic_m_tital">About <span class="about_user"></span></h3>
	                  <h5 class="m_blue_tital">Biography:</h5>
	                  <p class="basic_para"></p>
	               </div>
	            </div>
	         </div>
	      </div>
	   </div>
	</div>
</div>