<? $this->load->view("front/includes/header");?>
<section class="our-webcoderskull ">
  <div class="container text-center"><br>
    <div class="row">
		   <div class="col-md-10"></div>
		   <div class="col-md-2">
		    <input type="text" class="form-control" name="country"  placeholder="Search Institute.." id="country" autocomplete="off">
		   </div>
		</div>
		 <div id="results"></div>
		 <div id="results2">
    <div class="row heading text-center">
      
      <?php foreach($inst as $in){ ?>
		   <div class="col-md-4">
			  <a class="getloginuser" studentid="<? if($this->session->userdata("student_id")){ echo $this->session->userdata("student_id"); } ?>" instituteid="<?php echo $in->institute_id ; ?>" href="<?php echo base_url(); ?>exhibitors/<?php echo $in->institute_id ; ?>">
				<div class="in-top image"><img src="<?php echo base_url();?><?php echo $in->theme_picture; ?>"   alt="" class="img-fluid" /></div>
				<div class="in-btm">
				  <div class="in-img"><img src="<?php echo base_url();?><?php echo $in->logo; ?>"   alt="" class="img-fluid img-thumbnail"></div>
				  <h3><?php echo $in->institute_name; ?></h3>
				  <p><?php echo $in->address; ?></p>
				</div></a>
			  </div>
	  <?php } ?>
    </div></div><br>
	<div class="row">
	    <div class="col-md-10"></div>
	    <div class="col-md-2">
		    <ul class="pagination">
				<li class="page-item"><a href="<?php echo base_url(); ?>front/institutes/list/1">First</a></li>
				<li class="page-item">
					<a href="<?php echo base_url(); ?>front/institutes/list/<?php if($pageno <= 1){ echo '#'; } else { echo $pageno - 1; } ?>">Prev</a>
				</li>
				<li class="page-item">
					<a href="<?php echo base_url(); ?>front/institutes/list/<?php if($pageno >= $total_pages){ echo '#'; } else { echo $pageno + 1; } ?>">Next</a>
				</li>
				<li class="page-item"><a href="<?php echo base_url(); ?>front/institutes/list/<?php echo $total_pages; ?>">Last</a></li>
			</ul>
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
<script type="text/javascript">
  $(document).ready(function(){
    $("#country").keyup(function(){
      var query = $(this).val();
	  //alert(query);
	  var url = '<?php echo base_url("front/institutes/search") ?>'; 
        $.ajax({
                url: url,
                method: 'POST',
                data: {query:query},
                success: function(data)
                {
				
                  $('#results').html(data);
                  $('#results2').remove();
                }
        });
    });
  });
</script>
<? $this->load->view("front/includes/footer");?>
<script type="text/javascript">
	$(".getloginuser").on('click', function(event){
		var stid = $(this).attr("studentid");
	   	var insid = $(this).attr("instituteid");
	   	//alert(stid + insid );
	   	if(stid != ""){
	   		
	   	
	   	var url = '<?php echo base_url("front/institutes/insertstdip") ?>'; 
        $.ajax({
                url: url,
                method: 'POST',
                data: {stid:stid,insid:insid},
                success: function(data)
                {
				console.log(data);
                }
        });
        }

	});
</script>

<script type="text/javascript">
	$(".getloginuser").on('click', function(event){
		var stid = $(this).attr("studentid");
	   	var insid = $(this).attr("instituteid");
	   	//alert(stid + insid );
	   	if(stid != ""){
	   		
	   	
	   	var url = '<?php echo base_url("front/institutes/stdeventbag") ?>'; 
        $.ajax({
                url: url,
                method: 'POST',
                data: {stid:stid,insid:insid},
                success: function(data)
                {
				console.log(data);
                }
        });
        }

	});
</script>