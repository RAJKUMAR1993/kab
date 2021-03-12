<?php $this->load->view("student/includes/new_header");?>
<style>
#login_bg_custom, #register_bg_custom, #admission_bg_custom {
  background: url(<?php echo base_url();?>assets/udema/img/background.jpeg) center center no-repeat fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  min-height: 100vh;
  width: 100%;
}
</style>
<body id="login_bg_custom">
	
	<nav id="menu" class="fake_menu"></nav>
	
	<div id="preloader">
		<div data-loader="circle-side"></div>
	</div>
	<!-- End Preload -->
	
	<div id="login">
		<aside>
			<figure>
				<a href="<? echo base_url()?>"><img src="<?php echo base_url();?>assets/udema/img/logo.png" width="150px" height="55px" data-retina="true" alt=""></a>
			</figure>
			<?php echo $this->session->flashdata('msg');?>
            <div class="alert alert-danger" style="display:none" id="emsg"></div>
			  <form id="institutereg">
				<div class="form-group">
					<span class="input">
					<input class="input_field" type="text" autocomplete="off" name="name" value="<? echo $this->session->userdata("name") ?>" required>
						<label class="input_label">
						<span class="input__label-content">Institute Name</span>
					</label>
					</span>

					<span class="input">
					<input class="input_field" type="email" autocomplete="off" name="email" value="<? echo $this->session->userdata("email") ?>" required>
						<label class="input_label">
						<span class="input__label-content">Email Id</span>
					</label>
					</span>
					
					<span class="input">
					<input class="input_field" type="text" autocomplete="off" name="fullname" value="<? echo $this->session->userdata("fullname") ?>" required>
						<label class="input_label">
						<span class="input__label-content">Contact Person Name</span>
					</label>
					</span>
					
					<span class="input">
					<input class="input_field" type="text" autocomplete="off" name="designation" value="<? echo $this->session->userdata("designation") ?>" required>
						<label class="input_label">
						<span class="input__label-content">Designation</span>
					</label>
					</span>
					
					<span class="input">
					<input class="input_field" type="text" name="phone"  minlength="10" maxlength="10" value="<? echo $this->session->userdata("phone") ?>" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" required>
						<label class="input_label">
						<span class="input__label-content">Mobile Number</span>
					</label>
					</span>
					
					<span class="input">
					<input class="input_field" type="password" autocomplete="off" name="password" value="<? echo $this->session->userdata("password") ?>" required>
						<label class="input_label">
						<span class="input__label-content">Password</span>
					</label>
					</span>
					
					<!--<span class="input">
					<textarea class="input_field" rows="5" cols="30" name="address" required></textarea>
						<label class="input_label">
						<span class="input__label-content">Address</span>
					</label>
					</span>-->
				</div>
				<button type="submit" class="btn_1 rounded full-width add_top_60">Submit</button>
				<div class="text-center add_top_10">Have an account? <strong><a href="<?php echo base_url('institute/login');?>">Login</a></strong></div>
			</form>
			<div class="copy">© 2020 Kab</div>
		</aside>
	</div>
	<!-- /login -->
		
	<!-- COMMON SCRIPTS -->
    <script src="<?php echo base_url();?>assets/udema/js/jquery-2.2.4.min.js"></script>
    <script src="<?php echo base_url();?>assets/udema/js/common_scripts.js"></script>
    <script src="<?php echo base_url();?>assets/udema/js/main.js"></script>
	<script src="<?php echo base_url();?>assets/udema/assets/validate.js"></script>	
<script type="text/javascript">
    $(document).ready(function(){
  
    $("#institutereg").on('submit', function(e){
       e.preventDefault();
       var fdata = $("#institutereg").serialize();
       var url = '<?php echo base_url("front/institutes/save_institute/") ?>';
        //alert(fdata);
       $.ajax({
        url:url,
        data:fdata,
        type:"post",
        dataType:"json",
        beforeSend: function(){
          $("#loader").show();
        },
        success: function(str){
            //alert(str.Status);
          console.log(str);
          $("#loader").hide();
          if(str.Status == 'Active'){
            window.location.href = "verifyOTP";
          }else{
            $("#emsg").show();
            $("#emsg").html(str.Message);
          }
        }
        });
    });

    });
</script>
</body>
</html>
