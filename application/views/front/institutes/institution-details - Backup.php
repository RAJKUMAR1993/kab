<? $this->load->view("front/includes/header");?>


<section class="our-webcoderskull ">
<br>
  <div class="container ">
   
   <div class="row" >
   <div class="col-md-12">
   <div class="ins-logo">
   
   <div class="row">
      <div class="col-md-2" >  <img src="<?php echo base_url();?>assets/images/front/logo.png" height="64px" alt="image">  </div>
       <div class="col-md-10">  <h2> <? echo $idata->institute_name ?> </h2> </div>
       </div>
       </div>
       </div>
    </div>
   
   
   
   
    <div class="row  text-center">
      <div class="col-md-2 text-center"> 
        <? if($this->session->userdata("student_id")){ ?>
        <a href="<? echo base_url().'exhibitors/'.$this->uri->segment(2).'/video' ?>">
        <div class="btn-box image"> <img src="<?php echo base_url();?>assets/images/front/video.png"  />
          <h2>Video</h2>
        </div>
        </a> 
        <? }else{ ?>
           <a href="<? echo base_url('student/login') ?>" target="_blank">
          <div class="btn-box image"> <img src="<?php echo base_url();?>assets/images/front/video.png"  />
            <h2>Video</h2>
          </div>
          </a> 
        <? } ?>
        <? if($this->session->userdata("student_id")){ ?>
        <a href="<? echo base_url().'exhibitors/'.$this->uri->segment(2).'/gallery' ?>">
        <div class="btn-box"> <img src="<?php echo base_url();?>assets/images/front/photo.png"  />
          <h2>Photo Gallery</h2>
        </div>
        </a>
        <? }else{ ?>
           <a href="<? echo base_url('student/login') ?>" target="_blank">
          <div class="btn-box"> <img src="<?php echo base_url();?>assets/images/front/photo.png"  />
            <h2>Photo Gallery</h2>
          </div>
          </a> 
        <? } ?>
        <? if($this->session->userdata("student_id")){ ?>
         <a href="<? echo base_url().'exhibitors/'.$this->uri->segment(2).'/programmefee' ?>">
        <div class="btn-box"> <img src="<?php echo base_url();?>assets/images/front/fees.png"  />
          <h2>Programme Fees</h2>
        </div>
        </a> 
        <? }else{ ?>
        <a href="<? echo base_url('student/login') ?>">
        <div class="btn-box"> <img src="<?php echo base_url();?>assets/images/front/fees.png"  />
          <h2>Programme Fees</h2>
        </div>
        </a>
        <? } ?>
        <? if($this->session->userdata("student_id")){ ?>
        <a href="<? echo base_url().'exhibitors/'.$this->uri->segment(2).'/placements' ?>">
        <div class="btn-box"> <img src="<?php echo base_url();?>assets/images/front/placement.png"  />
          <h2>Placements</h2>
        </div>
        </a>
          <? }else{ ?>
        <a href="<? echo base_url('student/login') ?>">
        <div class="btn-box"> <img src="<?php echo base_url();?>assets/images/front/placement.png"  />
          <h2>Placements</h2>
        </div>
        </a>
        </a>
        <? } ?>
        <? if($this->session->userdata("student_id")){ ?> 
<a href="<? echo base_url().'exhibitors/'.$this->uri->segment(2).'/achievements' ?>">
        <div class="btn-box"> <img src="<?php echo base_url();?>assets/images/front/achievements.png"  />
          <h2>Achivements</h2>
        </div>
        </a>
      <? } else { ?>
        <a href="<? echo base_url('student/login') ?>">
        <div class="btn-box"> <img src="<?php echo base_url();?>assets/images/front/achievements.png"  />
          <h2>Achivements</h2>
        </div>
        </a> 
<? } ?>
      </div>
      <div class="col-md-8">
        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active"> <img  src="<?php echo base_url();?>assets/images/front/mit-large.png" alt="" class=" d-block img-fluid" /> </div>
            <div class="carousel-item"> <img  src="<?php echo base_url();?>assets/images/front/mit-large1.png" alt="" class=" d-block img-fluid" /> </div>
            <div class="carousel-item"> <img  src="<?php echo base_url();?>assets/images/front/mit-large-2.png" alt="" class=" d-block img-fluid" /> </div>
          </div>
        </div>
      </div>
      <div class="col-md-2 text-center">
      <? if($this->session->userdata("student_id")){ ?>  
       <a href="<? echo base_url().'exhibitors/'.$this->uri->segment(2).'/admission' ?>">
        <div class="btn-box"> <img src="<?php echo base_url();?>assets/images/front/admission.png"  />
          <h2>Admission 2020</h2>
        </div>
        </a> 
        <? }else{ ?>
          <a href="<? echo base_url('student/login') ?>" target="_blank">
        <div class="btn-box"> <img src="<?php echo base_url();?>assets/images/front/admission.png"  />
          <h2>Admission 2020</h2>
        </div>
        </a> 
         <? } ?> 
        	
		<? if($this->session->userdata("student_id")){ ?>

			<a href="javascript:void(0)" data-toggle="modal" data-target="#myModal">
				<div class="btn-box"> 

					<img src="<?php echo base_url();?>assets/images/front/queries.png"  />
					<h2>Ask a Question</h2>

				</div>
			</a>

		<? }else{ ?>

			<a href="<? echo base_url('student/login') ?>" target="_blank">
				<div class="btn-box"> 

					<img src="<?php echo base_url();?>assets/images/front/queries.png"  />
					<h2>Ask a Question</h2>

				</div>
			</a>

		<? } ?>
     <? if($this->session->userdata("student_id")){ ?>     	
        <a  href="javascript:void(0)" data-toggle="modal" data-target="#myModalApplyNow">
        <div class="btn-box"> <img src="<?php echo base_url();?>assets/images/front/apply.png"  />
          <h2>Apply Now</h2>
        </div>
        </a> 
<? }else{ ?>
   <a href="<? echo base_url('student/login') ?>" target="_blank">
        <div class="btn-box"> <img src="<?php echo base_url();?>assets/images/front/apply.png"  />
          <h2>Apply Now</h2>
        </div>
        </a> 
         <? } ?>
         <? if($this->session->userdata("student_id")){ ?> 
        <a href="<? echo base_url().'exhibitors/'.$this->uri->segment(2).'/feedback' ?>">
        <div class="btn-box"> <img src="<?php echo base_url();?>assets/images/front/feedback.png"  />
          <h2>Feedback</h2>
        </div>
        </a>
<? }else{ ?>
   <a href="<? echo base_url('student/login') ?>" target="_blank">
        <div class="btn-box"> <img src="<?php echo base_url();?>assets/images/front/feedback.png"  />
          <h2>Feedback</h2>
        </div>
        </a>
         <? } ?>
         <? if($this->session->userdata("student_id")){ ?> 
         <a href="<? echo base_url().'exhibitors/'.$this->uri->segment(2).'/counsellors' ?>">
        <div class="btn-box"> <img src="<?php echo base_url();?>assets/images/front/interaction.png"  />
          <h2>Talk to Counsellor</h2>
        </div>
        </a>
<? }else{ ?>
    <a href="<? echo base_url('student/login') ?>" target="_blank">
        <div class="btn-box"> <img src="<?php echo base_url();?>assets/images/front/interaction.png"  />
          <h2>Talk to Counsellor</h2>
        </div>
        </a>
         <? } ?> 
         </div>
    </div>
    <div class="row">
      <div class="col-md-12">
      <hr/>
       <h1><? echo $idata->full_name ?></h1>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
      </div>
    </div>
  </div>
</section>

<section id="right">
  <div class="container text-center center-block">
    <h1>HOW TO BOOK A STALL?</h1>
    <h2> Contact KAB Consultants or TV9 to book a stall.</h2>
    <div class="row align-items-center">
      <div class="col-12 mx-auto"> <a href="#">
        <button class="btn-default btn">Book a Stall >></button>
        </a> </div>
    </div>
  </div>
</section>
<? $this->load->view("front/includes/footer");?>



<!-- question modal -->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="display: block">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ask a Question</h4>
        <div class="smsg"></div>
      </div>
      
      <form method="post" id="queSubmit">
      
		  <div class="modal-body">

			<div class="form-group">

				<textarea role="4" class="form-control" name="query"></textarea>

			</div>

		  </div>
		  <div class="modal-footer">
		  	<input type="hidden" name="institute_id" value="<? echo $idata->institute_id ?>">
		  	<input type="hidden" name="student_id" value="<? echo $this->session->userdata("student_id") ?>">
			<button type="submit" class="btn btn-primary">Submit</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		  </div>
		  
	  </form>	  
    </div>

  </div>
</div>


<!-- Apply Now modal -->

<!-- Modal -->
<div id="myModalApplyNow" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="display: block">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Apply Now</h4>
        <div class="smsgapply"></div>
      </div>
      
      <form method="post" id="applynowSubmit">
      
      <div class="modal-body">
      <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" name="name" required />
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" name="email" required />
      </div>
      <div class="form-group">
        <label>Mobile</label>
        <input type="text" class="form-control" name="mobile" maxlength="10" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" required />
      </div>
      <div class="form-group">
        <label>Message</label>
        <textarea rows="2" class="form-control" name="message" required></textarea>

      </div>

      </div>
      <div class="modal-footer">
        <input type="hidden" name="institute_id" value="<? echo $idata->institute_id ?>">
        <input type="hidden" name="student_id" value="<? echo $this->session->userdata("student_id") ?>">
      <button type="submit" class="btn btn-primary">Submit</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      
    </form>   
    </div>

  </div>
</div>

<script type="text/javascript">

	$("#queSubmit").submit(function(e){
	
		e.preventDefault();
		var fdata = $("#queSubmit").serialize();
		
		$.ajax({

			type : "post",
			data : fdata,
			url : "<? echo base_url('front/institutes/insertQuestion') ?>",
			success : function(data){
				
				if(data == "success"){
					$(".smsg").html('<div class="alert alert-success">We have received your Question successfully, We will contact you soon.</div>');
					setTimeout(function(){location.reload()},3000)
				}else{
					$(".smsg").html('<div class="alert alert-danger">Error Occured please try again.</div>');
				}
			},
			error : function(data){
				
				console.log(data);
				
			}

		})
	
	});	
		
</script>

<script type="text/javascript">

  $("#applynowSubmit").submit(function(e){
  
    e.preventDefault();
    var fdata = $("#applynowSubmit").serialize();
    
    $.ajax({

      type : "post",
      data : fdata,
      url : "<? echo base_url('front/institutes/applynow') ?>",
      success : function(data){
        
        if(data == "success"){
          $(".smsgapply").html('<div class="alert alert-success">You are successfully applied. We will contact you soon. </div>');
          setTimeout(function(){location.reload()},3000)
        }else{
          $(".smsgapply").html('<div class="alert alert-danger">Error Occured please try again.</div>');
        }
      },
      error : function(data){
        
        console.log(data);
        
      }

    })
  
  }); 
    
</script>