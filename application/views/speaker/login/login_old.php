
<?php $this->load->view("admin/includes/header");?>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle auth-main">
				<div class="auth-box" >
                    <div class="mobile-logo"><a href="speaker/login"><img src="<?php echo base_url();?>assets/images/logo-icon.svg" alt="KAB Education Fair"></a></div>
                    <div class="auth-left">
                        <div class="left-top">
                            <a href="speaker/login">
<span><img src="<?php echo base_url();?>assets/images/logo.png" alt="KAB Education Fair" style="width:100% !important"></span>
                            </a>
                        </div>
                        <div class="left-slider">
                            <img src="<?php echo base_url();?>assets/images/login/1.jpg" class="img-fluid"  alt="">
                        </div>
                    </div>
                    <div class="auth-right">
                        <div class="right-top">
                            <ul class="list-unstyled clearfix d-flex">
                                <li><a href="index.html"><i class="fa fa-home"></i></a></li>
                                <li><a href="javascript:void(0);">Help</a></li>
                                <li><a href="javascript:void(0);">Contact</a></li>
                            </ul>
                        </div>
                        <div class="card">
                            <div class="header">
                                <p class="lead">Log in</p>
                            </div>
                            <div class="body">
                                <?php echo $this->session->flashdata('msg');?>
                                <div class="alert alert-danger" style="display:none" id="emsg"></div>
                                <form id="speakerlogin">
                                <!-- <form class="form-auth-small" action="<?php echo base_url("speaker/login/do_login");?>" method="POST"> -->
                                    <div class="form-group">
                                        <label for="signin-email" class="control-label sr-only">Email</label>
                                        <input type="email" class="form-control" id="signin-email" value="" name="email" placeholder="User Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="signin-password" class="control-label sr-only">Password</label>
                                        <input type="password" class="form-control" id="signin-password" value="" name="password" placeholder="Password" autocomplete="off">
                                    </div>
                                    <div class="form-group clearfix">
                                        <label class="fancy-checkbox element-left">
                                            <input type="checkbox">
                                            <span>Remember me</span>
                                        </label>								
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
                                    <center><img src="<? echo base_url(); ?>assets/images/load.gif" width="42" height="42" alt="" style="display:none" id="loader"></center>
                                    <div class="bottom">
                                        <span class="helper-text m-b-10"><i class="fa fa-lock"></i> <a href="<?php echo base_url('speaker/login/forgot');?>">Forgot password?</a></span>
                                      
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

<?php $this->load->view("admin/includes/footer");?>
<script type="text/javascript">
    $(document).ready(function(){
    //Login Service
    $("#speakerlogin").on('submit', function(e){
       e.preventDefault();
       var fdata = $("#speakerlogin").serialize();
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
    });
</script>
