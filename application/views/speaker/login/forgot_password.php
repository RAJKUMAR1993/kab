<!doctype html>
<html lang="en">

<head>
<title>:: KAB Education Fair :: Forgot Password</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="description" content="Mplify Bootstrap 4.1.1 Admin Template">
<meta name="author" content="ThemeMakker, design by: ThemeMakker.com">

<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- VENDOR CSS -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/animate-css/animate.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/font-awesome/css/font-awesome.min.css">

<!-- MAIN CSS -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/main.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/color_skins.css">
</head>

<body class="theme-blue">
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle auth-main">
				<div class="auth-box">
                    <div class="mobile-logo"><a href="<?php echo base_url('speaker/login');?>"><img src="<?php echo base_url();?>assets/images/logo-icon.svg" alt="Mplify"></a></div>

                    <div class="auth-left">
                        <div class="left-top">
                            <a href="<?php echo base_url('speaker/login');?>">
                                <!-- <img src="<?php echo base_url();?>assets/images/logo-icon.svg" alt="Mplify"> -->
                                <span><img src="<?php echo base_url();?>assets/images/logo.png" alt="KAB Education Fair" style="width:100% !important"></span>
                            </a>
                        </div>
                        <div class="left-slider">
                            <img src="<?php echo base_url();?>assets/images/login/1.jpg" class="img-fluid" alt="">
                        </div>
                    </div>
                    <div class="auth-right">
                        <div class="right-top">
                            <ul class="list-unstyled clearfix d-flex">
                                <li><a href="<?php echo base_url('speaker/login');?>"><i class="fa fa-home"></i></a></li>
                                <li><a href="javascript:void(0);">Help</a></li>
                                <li><a href="javascript:void(0);">Contact</a></li>
                            </ul>
                        </div>

                        <div class="card">
                            <div class="header">
                                <p class="lead">Recover my password</p>
                            </div>
                            <div class="body">
                                <?php echo $this->session->flashdata('msg');?>
                                <div class="alert alert-danger" style="display:none" id="emsg"></div>
                                <p>Please enter your email address below to receive instructions for resetting password.</p>
                                <form id="forgotpassword">
                                <!-- <form class="form-auth-small" action="<?php echo base_url('speaker/login/reset_password');?>" method="POST"> -->
                                    <div class="form-group">                                    
                                        <input type="text" class="form-control" id="signup-password" name="email" placeholder="Email" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">RESET PASSWORD</button>
                                     <center><img src="<? echo base_url(); ?>assets/images/load.gif" width="42" height="42" alt="" style="display:none" id="loader"></center>
                                    <div class="bottom">
                                        <span class="helper-text">Know your password? <a href="<?php echo base_url('speaker/login');?>">Login</a></span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
  
    $("#forgotpassword").on('submit', function(e){
       e.preventDefault();
       var fdata = $("#forgotpassword").serialize();
       var url = '<?php echo base_url("speaker/login/reset_password") ?>';
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
