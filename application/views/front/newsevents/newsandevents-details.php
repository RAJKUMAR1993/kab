<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 $this->load->view("front/includes/new_header");?>
<style type="text/css">
  #hero_in{
    height:230px;
  }
</style>
<main>
  <section id="hero_in" class="general">
    <div class="wrapper">
    <div class="container">
      <h1 class="fadeInUp"><span></span><? echo $ne->title; ?></h1>
    </div>
    </div>
  </section>
 

    <div class="container margin_60_35">
      <div class="row">
        <div class="col-lg-9">
          <div class="bloglist singlepost">
            <p><img alt="" class="img-fluid" src="<? if($ne->image){ echo base_url().$ne->image; } else { echo base_url().'assets/news/detault.jpg'; } ?>"></p>
            <h1><? echo $ne->title; ?></h1>
            <div class="postmeta">
              <ul>
                <li><a href="#"><i class="icon_folder-alt"></i> <? echo $ne->type; ?></a></li>
                <li><a href="#"><i class="icon_clock_alt"></i> <? echo date('d/m/Y',strtotime($ne->created_date)); ?></a></li>
                <li><a href="#"><i class="icon_pencil-edit"></i> <? echo $ne->createdby; ?></a></li>
              </ul>
            </div>
            <!-- /post meta -->
            <div class="post-content">
              <div class="dropcaps">
                <p><? echo $ne->message; ?></p>
              </div>

            </div>
            <!-- /post -->
          </div>

        
        </div>
        <!-- /col -->

        <aside class="col-lg-3">
          
          <div class="widget">
            <div class="form-group">
              <a href="<?php echo base_url(); ?>newsandevents"><button class="btn btn-primary" style="cursor: pointer;">Back</button></a>
            </div>
            <div class="widget-title">
              <h4>Recent News & Events </h4>
            </div>
            <ul class="comments-list">
              <? if($recentne){
                foreach($recentne as $ne) {
               ?>
              <li>
                <div class="alignleft">
                  <a href="<? echo base_url().'detail/'.$ne->news_id.'/view'; ?>"><img src="<? if($ne->image){ echo base_url().$ne->image; }else { echo base_url().'assets/news/detault.jpg'; } ?>" alt=""></a>
                </div>
                <small><? echo date('d.m.Y',strtotime($ne->created_date)); ?></small>
                <h3><a href="<? echo base_url().'detail/'.$ne->news_id.'/view'; ?>" title=""><? echo substr($ne->title,0, 50); ?></a></h3>
              </li>
              <? } } ?>
            </ul>
          </div>
          <!-- /widget -->
          <div class="widget">
           <div class="widget-title">
              <h4>Categories</h4>
            </div>
           <ul class="cats">
              <!-- <li>
<form style='display:none;' action='<? echo base_url();?>newsandevents' method='POST' class='getInstitutes_news'><input type='text' name='type' value='news'/></form>
                <a href="#" class="nev" tval="news" >News <span>(<? if($newscnt){ echo $newscnt; } ?>)</span></a></li>
              <li>

<form style='display:none;' action='<? echo base_url();?>newsandevents' method='POST' class='getInstitutes_event'><input type='text' name='type' value='event'/></form>
                <a href="#" class="nev" tval="event">Events <span>(<? if($eventscnt){ echo $eventscnt; } ?>)</span></a></li> -->
                <?php
                    foreach ($necategories as $category) {
                      $bycategory = $this->db->get_where("tbl_news", ["category_id" => $category->id, "is_deleted" => 0])->result();
                      $newseventscount = count($bycategory);
                ?>
                    <li>
                      <form style='display:none;' action='<? echo base_url();?>newsandevents' method='POST' class='getInstitutes_<?php echo $category->id;?>'><input type='text' name='category_id' value='<?php echo $category->id;?>'/></form>
                      <a style="cursor: pointer;" class="nev" tval="<?php echo $category->id;?>" ><?php echo $category->category_name;?> <span>(<?php echo $newseventscount;?>)</span></a>
                    </li>
                <?php
                }
                ?>
            </ul>
          </div>
          
        </aside>
        <!-- /aside -->
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->


</main>

<?php $this->load->view("front/includes/new_footer");?>
<script type="text/javascript">
   $(".nev").on("click", function(){
      var tval = $(this).attr('tval');
      //alert(tval);
      
      $(".getInstitutes_"+tval).submit();
    });
</script>