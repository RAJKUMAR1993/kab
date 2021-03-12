<?php $this->load->view("professor/includes/header");?>


<!-- Page Loader -->
<div class="page-loader-wrapper" style="background-color: #fff;">
    <div class="loader">
        <div class="m-t-30"><img src="<?php echo base_url();?>assets/animatedgifs/atom.gif" width="80" height="80" alt="Mplify"></div>
        <!-- <p>Please wait...</p>  -->       
    </div>
</div>
<!-- Overlay For Sidebars -->
<div class="overlay" style="display: none;"></div>

<div id="wrapper">

                <?php $this->load->view("professor/includes/nav");?>
   
                <?php $this->load->view("professor/includes/sidebar");?>

                <?php $this->load->view("professor/includes/right_sidebar");?>
                
                <?php $this->load->view("professor/".$subview) ?>

</div>



<?php $this->load->view("professor/includes/footer");?>
<script type="text/javascript">
    
/*$(document).on('ajaxStart', function() {  $('.page-loader-wrapper').fadeIn(); });
$(document).on('ajaxComplete', function() {  $('.page-loader-wrapper').fadeOut(); });*/
</script>