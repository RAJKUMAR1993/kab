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
				<a href="index.html"><img src="<?php echo base_url();?>assets/udema/img/logo.png" width="149" height="42" data-retina="true" alt=""></a>
			</figure>
			<?php echo $this->session->flashdata('msg');?>
            <div class="alert alert-danger" style="display:none" id="emsg"></div>
			 <h5>Recover my password</h5><br>
			  <form id="forgotpassword">
				<p>Please enter your email address below to receive instructions for resetting password.</p>
				<div class="form-group">
					<span class="input">
					<input class="input_field" type="email" autocomplete="off" name="email" required>
						<label class="input_label">
						<span class="input__label-content">Your email</span>
					</label>
					</span>
				</div>
				<button type="submit" class="btn_1 rounded full-width add_top_40">RESET PASSWORD</button>
				<div class="text-center add_top_10">Know your password? <strong><a href="<?php echo base_url('admin');?>">Login!</a></strong></div>
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
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
  
    $("#forgotpassword").on('submit', function(e){
       e.preventDefault();
       var fdata = $("#forgotpassword").serialize();
       var url = '<?php echo base_url("admin/login/reset_password") ?>';
      //  alert(fdata);
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
            window.location.href = "./";
          }else{
            $("#emsg").show();
            $("#emsg").html(str.Message);
          }
        }
        });
    });

    });
</script>