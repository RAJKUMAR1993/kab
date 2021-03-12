<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view("front/includes/new_header");?>    
<main>
    <section id="hero_in" class="general">
        <div class="wrapper">
            <div class="container">
                <h1 class="fadeInUp"><span></span>Terms and Conditions</h1>
            </div>
        </div>
    </section>
    <div class="bg_color_1">
        <div class="container" style="font-size: 14px;">
            <p><?php echo $termsandconditions;?></p>
        </div>
    </div>
</main>
<?php $this->load->view("front/includes/new_footer");?>