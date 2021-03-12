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
			<h1 class="fadeInUp"><span></span>News & Events</h1>
		</div>
		</div>
	</section>

		<div class="container margin_60_35">
			<nav aria-label="breadcrumb">
			  <ol class="breadcrumb">
			    <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Home</a></li>
			    <?php 
			    if($category_id!=''){
			    	$category = $this->db->where("id", $category_id)->get("tbl_news_events_categories")->row();
			    }
				if($category_id=='' && $type==''){
					echo '<li class="breadcrumb-item active" aria-current="page">News&Events</li>';
				}
				if($category_id!='' && $type!=''){
				?>
				<li class="breadcrumb-item"><a href="<?php echo base_url();?>newsandevents">New&Events</a></li>
				<li class="breadcrumb-item">
                  <form style='display:none;' action='<? echo base_url();?>newsandevents' method='POST' class='getInstitutes_<?php echo $category_id;?>'><input type='text' name='category_id' value='<?php echo $category_id;?>'/></form>
                  <a href="#" style="cursor: pointer;" class="nev" tval="<?php echo $category_id;?>" ><?php echo $category->category_name;?></a>
                </li>
				<li class="breadcrumb-item active" aria-current="page"><?php echo $type;?></li>
				
				<?php
				}
				if($category_id!='' && $type==''){
				?>
				<li class="breadcrumb-item"><a href="<? echo base_url();?>newsandevents">New&Events</a></li>
				<li class="breadcrumb-item active" aria-current="page"><?php echo $category->category_name;?></li>
				<?php
				}
				?>
			  </ol>
			</nav>
			<div class="row">
				<div class="col-lg-9 searchResults">
					<? if($newsevn) { 
foreach($newsevn as $ne) { 
					?>
					<article class="blog wow fadeIn">
						<div class="row no-gutters">
							<div class="col-lg-7">
								<figure>
									<a href="<? echo base_url().'detail/'.$ne->news_id.'/view'; ?>"><img src="<? if($ne->image){ echo base_url().$ne->image; } else { echo base_url().'assets/news/detault.jpg'; } ?>" alt="">
										<div class="preview"><span>Read more</span></div>
									</a>
								</figure>
							</div>
							<div class="col-lg-5">
								<div class="post_info">
									<small><? echo date('d M.Y',strtotime($ne->created_date)); ?></small>
									<h3><a href="<? echo base_url().'detail/'.$ne->news_id.'/view'; ?>"><? echo $ne->title; ?></a></h3>
									<p><? echo  substr($ne->message,0, 300); ?></p>
									<ul>
										<li>
											<div class="thumb"><img src="<? echo base_url().'assets/news/user.jpg'; ?>" alt=""></div> <? echo $ne->createdby; ?>
										</li>
										<li><i class="icon_tag"></i> <? echo $ne->type; ?> </li>
									</ul>
								</div>
							</div>
						</div>
					</article>
				<? } }  ?>
					<nav aria-label="...">
						<? echo $pagination; ?>
					
					</nav>
					<!-- /pagination -->
				</div>
				<!-- /col -->

				<aside class="col-lg-3">
					<div class="widget">
							
							<div class="form-group">
						      <?php 
								$url = base_url();
								if($category_id!='' || $type!=''){
									$url = base_url().'newsandevents';
								}
								if($category_id!='' && $type!=''){
								?>
								<form style='display:none;' action='<? echo base_url();?>newsandevents' method='POST' class='getInstitutes_<?php echo $category_id;?>'><input type='text' name='category_id' value='<?php echo $category_id;?>'/></form>
			                      <a style="cursor: pointer;color: #fff;" class="nev btn btn-primary" tval="<?php echo $category_id;?>" >Back</a>
								<?php
								}
								else{
									echo '<a href="'.$url.'"><button class="btn btn-primary" style="cursor: pointer;">Back</button></a>';
								}
								?>
						   </div>
							<div class="form-group">
								<input type="text" name="search" id="search" class="form-control" placeholder="Search...">
							</div>
							<button type="submit" id="searchne" class="btn_1 rounded"> Search</button>
						
					</div>
					<!-- /widget -->
					<div class="widget">
						<div class="widget-title">
							<h4>Recent News & Events </h4>
						</div>
						<ul class="comments-list">
							<? if($recentne){
								foreach($recentne as $ne) {
							 ?>
							<li>
								<div class="alignleft">
									<a href="<? echo base_url().'detail/'.$ne->news_id.'/view'; ?>"><img src="<? if($ne->image){ echo base_url().$ne->image; } else { echo base_url().'assets/news/detault.jpg'; } ?>" alt=""></a>
								</div>
								<small><? echo date('d.m.Y',strtotime($ne->created_date)); ?></small>
								<h3><a href="<? echo base_url().'detail/'.$ne->news_id.'/view'; ?>" title=""><? echo substr($ne->title,0, 50); ?></a></h3>
							</li>
							<? } } ?>
						</ul>
					</div>
					<!-- /widget -->
					<?php
					if($type==''){
					?>
					<div class="widget">
						<div class="widget-title">
							<h4>Categories</h4>
						</div>
						<ul class="cats">
							<?php if($category_id!=''){?>
								<li>
									<form style='display:none;' action='<? echo base_url();?>newsandevents' method='POST' class='getInstitutes_news'><input type='text' name='type' value='news'/><input type='text' name='category_id' value='<?php echo $category_id;?>'/></form>
									<a style="cursor: pointer;" class="nev" tval="news" >News <span>(<? if($newscnt){ echo $newscnt; }else{ echo 0;} ?>)</span></a></li>
								<li>
								<form style='display:none;' action='<? echo base_url();?>newsandevents' method='POST' class='getInstitutes_event'><input type='text' name='type' value='event'/><input type='text' name='category_id' value='<?php echo $category_id;?>'/></form>
									<a style="cursor: pointer;" class="nev" tval="event">Events <span>(<? if($eventscnt){ echo $eventscnt; }else{ echo 0;} ?>)</span></a>
								</li>
							<?php
							}else{
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
			                }
			                ?>
						</ul>
					</div>
					<?php
					}
					?>
				</aside>
				<!-- /aside -->
			</div>
			<!-- /row -->
		</div>

	</main>
	<!--/main-->
<?php $this->load->view("front/includes/new_footer");?>
<script type="text/javascript">
	$("#searchne").on("click", function(){
      var query = $("#search").val();
	  //alert(query);
	  var url = '<?php echo base_url("front/newsevents/search") ?>'; 
        $.ajax({
                url: url,
                method: 'POST',
                data: {query:query},
                success: function(data)
                {
				
                  $('.searchResults').html(data);
                }
        });
    });

    $(".nev").on("click", function(){
    	var tval = $(this).attr('tval');
    	//alert(tval);
    	
      $(".getInstitutes_"+tval).submit();
    });
</script>