<link rel="stylesheet" href="<?php echo base_url();?>assets/profilepage/style.min-bc5958d152.css">
<style type="text/css">
	.ment_btn {
	    margin-bottom: 20px;
	}
	div {
		margin: 0;
	    padding: 0;
	    outline: 0;
	}
	.ment_btn .round_btns {
	    background: #f0880e;
	    border: none;
	    margin: 0px;
	}
	.round_btns {
	    text-align: center;
	    border-radius: 35px !important;
	    padding: 14px 35px !important;
	    text-transform: uppercase;
	    font-family: 'museo_sans700';
	}
</style>
<div class="custom_modal" id="sessionbooking">
    <div class="row">
        <div class="col-md-12 text-right">
            <a style="font-size:20px;cursor:pointer;color:red" onclick="closeModal('sessionbooking');">
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
	         <div class="full_mentor_detail" style="width: 100%;">
	            <div class="row">
	               <div class="col-sm-12 m_abt">
	                  <div class="counsellorSessions"></div>
	               </div>
	            </div>
	         </div>
	      </div>
	   </div>
	</div>
</div>