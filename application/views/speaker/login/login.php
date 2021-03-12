<?php $this->load->view("speaker/includes/new_header");?>
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
    <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/udema/img/logo.png" width="150px" height="55px" data-retina="true" alt=""></a>
	</figure>
			<?php echo $this->session->flashdata('msg');?>
            <div class="alert alert-danger" style="display:none" id="emsg"></div>
			  <form id="expertlogin">
				<div class="form-group">
					<span class="input">
					<input class="input_field" type="email" autocomplete="off" name="email">
						<label class="input_label">
						<span class="input__label-content">Your email</span>
					</label>
					</span>

					<span class="input">
						<input class="input_field" type="password" id="password-field" autocomplete="new-password" name="password">
						<label class="input_label">
							<span class="input__label-content">Your password</span>
						</label>
					</span>
					<div align="right" style="margin-top: -50px;margin-right: -30px;">
						<i style="pointer-events:auto;cursor: pointer;font-size: 20px;" class="icon-eye" toggle="#password-field"  id="togglePassword"></i>
					</div>
					
				</div>
				
				<small><a href="<?php echo base_url('speaker/login/forgot');?>">Forgot password?</a></small>
				<button type="submit" class="btn_1 rounded full-width add_top_60">Login</button>
				<div class="text-center add_top_10">New to Kab? <strong><a href="<?php echo base_url('speaker/registration');?>">Sign up!</a></strong></div>
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
    //Login Service
    $("#expertlogin").on('submit', function(e){
       e.preventDefault();
       var fdata = $("#expertlogin").serialize();
       var url = '<?php echo base_url("speaker/login/do_login") ?>';
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
          console.log(str);
          $("#loader").hide();
          if(str.Status == 'Active'){
            window.location.href = "dashboard";
          }else{
            $("#emsg").show();
            $("#emsg").html(str.Message);
          }
        }
        });
    });
//Login Service Closed
    });	$("#togglePassword").click(function(){
	  $(this).toggleClass("fa-eye fa-eye-slash");
		  var input = $($(this).attr("toggle"));
		  if (input.attr("type") == "password") {
			input.attr("type", "text");
		  } else {
			input.attr("type", "password");
		  }
	});
</script>
</body>
</html>
