<?php $this->load->view("counsellor/includes/header");?>


<!-- Page Loader -->
<div class="page-loader-wrapper" style="background-color: #fff;">
    <div class="loader">
        <div class="m-t-30"><img src="<?php echo base_url();?>assets/animatedgifs/atom.gif" width="80" height="80" alt="KAB Education Fair"></div>
        <!-- <p>Please wait...</p>  -->       
    </div>
</div>
<!-- Overlay For Sidebars -->
<div class="overlay" style="display: none;"></div>

<div id="wrapper">

                <?php $this->load->view("counsellor/includes/nav");?>
   
                <?php $this->load->view("counsellor/includes/sidebar");?>

                <?php $this->load->view("counsellor/includes/right_sidebar");?>
                
                <?php $this->load->view("counsellor/".$subview) ?>

</div>



<?php $this->load->view("counsellor/includes/footer");?>
<script type="text/javascript">
    
/*$(document).on('ajaxStart', function() {  $('.page-loader-wrapper').fadeIn(); });
$(document).on('ajaxComplete', function() {  $('.page-loader-wrapper').fadeOut(); });*/
</script>