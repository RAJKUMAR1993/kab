<?php $this->load->view("admin/includes/header");?>

<div class="overlay" style="display: none;"></div>

<div id="wrapper">

                <?php //$this->load->view("admin/includes/nav");?>
   
                <?php //$this->load->view("admin/includes/sidebar");?>

                <?php //$this->load->view("admin/includes/right_sidebar");?>
                <?php //$this->load->view("admin/dashboard/dashboard");?>
                <?php $this->load->view("front/".$subview) ?>

</div>



<?php $this->load->view("admin/includes/footer");?>
<script type="text/javascript">
    
/*$(document).on('ajaxStart', function() {  $('.page-loader-wrapper').fadeIn(); });
$(document).on('ajaxComplete', function() {  $('.page-loader-wrapper').fadeOut(); });*/
</script>