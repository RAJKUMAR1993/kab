<? $this->load->view("front/includes/header");?>

<div id="inbanner">
<img src="<?php echo base_url();?>assets/images/front/counselor.jpg"   alt="" class="img-fluid">
</div>

<section id="ex">
  <div class="container emp-profile">
  <br> <br> <br> <br>
            <form id="updateexpert">
			<div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
                  <select class="form-control" name="mode">
				    <option value="">Select</option>
				    <option value="success">Success</option>
				    <option value="failure">Failure</option>
				  </select> <br>
				  <button type="submit" class="btn btn-primary">Submit</button>
            </form> 
 <br>	 <br> <br> <br> <br> <br> <br>		
        </div>
</section>
<script type="text/javascript">
    $(document).ready(function(){
  
    $("#updateexpert").on('submit', function(e){
       e.preventDefault();
       var fdata = $("#updateexpert").serialize();
       var url = '<?php echo base_url("front/professor/save_student_booking")?>';
        $.ajax({
        url:url,
        data:fdata,
        type:"post",
        dataType:"json",
        beforeSend: function(){
          $("#loader").show();
        },
        success: function(str){
            //alert(str);
          console.log(str);
          $("#loader").hide();
          if(str.Status == 'Active'){
            $("#smsg").show();
            $("#smsg").html(str.Message);
			//window.location.href = "<?php echo base_url("front/professor/payment_page")?>";
            setTimeout(function(){ location.reload(); }, 2000);  
          }else{
            $("#emsg").show();
            $("#emsg").html(str.Message);
          }
        }
        });
    });

    });
</script>
<? $this->load->view("front/includes/footer");?>