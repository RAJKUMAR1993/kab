<? $this->load->view("front/includes/header");?>
<!doctype html>
<html lang="en">

<head>
<title>KAB Education Fair</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="description" content="">
<meta name="author" content="">

<link rel="icon" href="<?php echo base_url();?>assets/images/favicon.ico" type="image/x-icon">

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">


</head>

<body>

<style type="text/css">
    .bg-voilet {
    /*background: #6a2de3;*/
    background-image: linear-gradient(to left bottom, #0653b2, #0076ce, #0098e3, #00b9f3, #00dafe);
    background:url(<?php echo base_url();?>assets/images/login-bg.jpg) left top no-repeat;
    background-size:cover;
}
</style>

<section id="home" class="section bg-voilet bg-overlay overflow-hidden d-flex align-items-center">
            <div class="container">
                <div class="row align-items-center1">
                    <!-- home Intro Start -->
                    
                    <div class="col-12 col-md-5 col-lg-6">
                        <!-- home Thumb -->
                        <div class="home-thumb mx-auto" >
                            <img src="<?php echo base_url();?>assets/images/inst-bg.png" alt="">
                        </div>
                    </div>
                    <div class="col-12 col-md-7 col-lg-6">
                        <div class="home-intro"><br/>
                            <h1 class="text-white">Institution Registration</h1>
                            <p><?php echo $this->session->flashdata('msg');?> </p>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
                            <!-- Store Buttons -->
                            <form id="institutereg">
                           <!-- <form id="basic-form" method="post" action="<?php echo base_url("front/institutes/save_institute/");?>" novalidate> -->
                        <div class="row mt-4 text-white">

                            <div class="form-group col-md-6">
                                <label for="full_name">Institute Name<em>*</em></label>
                                <input type="text" class="form-control" name="name" required>

                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email Id<em>*</em></label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="full_name">Full Name<em>*</em></label>
                                <input type="text" class="form-control" name="fullname" required>

                            </div>
                            <div class="form-group col-md-6">
                                <label for="full_name">Designation<em>*</em></label>
                                <input type="text" class="form-control" name="designation" required>

                            </div>
                          
                            

                            <div class="form-group col-md-6">
                                <label for="mobile">Mobile Number<em>*</em></label>
                                <input type="text" class="form-control" name="phone"  maxlength="10" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password">Password<em>*</em></label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                           <div class="form-group col-md-12">
                                <label for="password">Address<em>*</em></label>
                                <textarea class="form-control" rows="3" cols="30" name="address" required></textarea>
                            </div>

                            

                            <div class="col-md-2 zi">
                                <div class="float-left">
                                     <button type="submit" class="btn btn-s btn-default">SUBMIT</button>
                                </div>
                                <center><img src="<? echo base_url(); ?>assets/images/load.gif" width="42" height="42" alt="" style="display:none" id="loader"></center>
                            </div>
<div class="col-md-6 log">Have an account? <a href="<? echo base_url().'institute/login'?>"> Login </a> </div>



                        </div>
                    </form>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
            <!-- Shape Bottom -->
            <div class="shape-bottom">
                <svg viewBox="0 0 1920 310" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="svg replaced-svg">
                    <title>Shape</title>
                    <desc>Created with shape</desc>
                    <defs></defs>
                    <g id="Landing-Page" stroke="none" stroke-width="12" fill="none" fill-rule="evenodd">
                        <g id="sApp-v1.0" transform="translate(0.000000, -554.000000)" fill="#ffffff">
                            <path d="M-3,551 C186.257589,757.321118 319.044414,856.322454 395.360475,848.004007 C509.834566,835.526337 561.525143,796.329212 637.731734,765.961549 C713.938325,735.593886 816.980646,681.910577 1035.72208,733.065469 C1254.46351,784.220361 1511.54925,678.92359 1539.40808,662.398665 C1567.2669,645.87374 1660.9143,591.478574 1773.19378,597.641868 C1848.04677,601.75073 1901.75645,588.357675 1934.32284,557.462704 L1934.32284,863.183395 L-3,863.183395" id="v1.0"></path>
                        </g>
                    </g>
                </svg>
            </div>
        </section>

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
<? $this->load->view("front/includes/footer");?>