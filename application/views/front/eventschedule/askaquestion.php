<link rel="stylesheet" href="<?php echo base_url();?>assets/profilepage/style.min-bc5958d152.css">

<div class="custom_modal" id="askaquestion">
    <div class="row">
        <div class="col-md-12 text-right">
            <a style="font-size:20px;cursor:pointer;color:red" onclick="closeModal('askaquestion');">
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
	                  <form method="post" id="queSubmit1">
	                  	<div class="modal-header" style="display: block">
					        <h4 class="modal-title" style="padding: 10px;color: white;">Ask a Question</h4>
					    </div>
			      		<div class="modal-body">
					        <div class="smsg"></div>
					     	<div class="form-group">
					        	<textarea role="4" class="form-control" name="query" rows="6" placeholder="Ask A Question" style="height: 100px"></textarea>
					      	</div>
			      		</div>
			      		<div class="modal-footer">
			        		<input type="hidden" name="institute_id" id="coun_id">
			        		<input type="hidden" name="type" value="counsellor">
			        		<input type="hidden" name="student_id" value="<?php echo $this->session->userdata("student_id");?>">
					   		<input type="hidden" name="query_date" value="<? echo date("Y-m-d"); ?>">
			      			<button type="submit" class="btn btn-primary">Submit</button>
			      			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      		</div>
			    	</form>
	               </div>
	            </div>
	         </div>
	      </div>
	   </div>
	</div>
</div>