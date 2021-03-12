
<? $this->load->view("front/includes/header");?>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script> 
  <script>
$(document).ready(function(){
    $('.customer-logos').slick({
        slidesToShow: 3,
        slidesToScroll: 3,
        autoplay: true,
        autoplaySpeed: 1500,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 4
            }
        }, {
            breakpoint: 520,
            settings: {
                slidesToShow: 3
            }
        }]
    });
});
</script>
  <style>
article.blog .post_info ul {
    margin: 10px 30px 0 12px;
    padding: 0px 10px 0 10px;
    width: 100%;
    position:relative;
    bottom: 11px;
    border-top: 0px solid #ededed;
}
.bord{ border-bottom: 1px solid #ededed;}


.clearfix{ clear:both;}

article.blog figure {
    height: 100%;
    overflow: hidden;
    position: static;
    margin-bottom: 0;
}


.slick-slide {
    margin: 0px 10px;
    padding:0px;
}

.slick-slide img {
    width: 100%;
}

.slick-slider
{
    position: relative;
    display: block;
    box-sizing: border-box;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
            user-select: none;
    -webkit-touch-callout: none;
    -khtml-user-select: none;
    -ms-touch-action: pan-y;
        touch-action: pan-y;
    -webkit-tap-highlight-color: transparent;
}

.slick-list
{
    position: relative;
    display: block;
    overflow: hidden;
    margin: 0;
    padding: 0;
}
.slick-list:focus
{
    outline: none;
}
.slick-list.dragging
{
    cursor: pointer;
    cursor: hand;
}

.slick-slider .slick-track,
.slick-slider .slick-list
{
    -webkit-transform: translate3d(0, 0, 0);
       -moz-transform: translate3d(0, 0, 0);
        -ms-transform: translate3d(0, 0, 0);
         -o-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
}

.slick-track
{
    position: relative;
    top: 0;
    left: 0;
    display: block;
}
.slick-track:before,
.slick-track:after
{
    display: table;
    content: '';
}
.slick-track:after
{
    clear: both;
}
.slick-loading .slick-track
{
    visibility: hidden;
}

.slick-slide
{
    display: none;
    float: left;
    height: 100%;
    min-height: 1px;
}
[dir='rtl'] .slick-slide
{
    float: right;
}
.slick-slide img
{
    display: block;
}
.slick-slide.slick-loading img
{
    display: none;
}
.slick-slide.dragging img
{
    pointer-events: none;
}
.slick-initialized .slick-slide
{
    display: block;
}
.slick-loading .slick-slide
{
    visibility: hidden;
}
.slick-vertical .slick-slide
{
    display: block;
    height: auto;
    border: 1px solid transparent;
}
.slick-arrow.slick-hidden {
    display: none;
}
</style>
  <style type="text/css">
  #hero_in{
    height:230px;
  }
 
  
  /* New css start here*/
  article.blog figure img {
    -webkit-transform: translate(-50%, -50%) scale(1);
    -moz-transform: translate(-50%, -50%) scale(1);
    -ms-transform: translate(-50%, -50%) scale(1);
    -o-transform: translate(-50%, -50%) scale(1);
    transform: translate(-50%, -50%) scale(1);
    -moz-transition: 0.3s;
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
    width: auto;
    height: 295px;
    position: absolute;
    left: 50%;
    top: 50%;
    -webkit-backface-visibility: hidden;
    -moz-backface-visibility: hidden;
    -ms-backface-visibility: hidden;
    -o-backface-visibility: hidden;
    backface-visibility: hidden;
}
article.blog .post_info ul li {
    display: inline-block;
    position: relative;
    padding: 12px 0 0 0px;
    font-weight: 500;
    font-size: 0.75rem;
    color: #999;
}
article.blog .post_info ul {
    margin: 10px 30px 0 0px;
    padding: 0px 0px 0 0px;
    width: 100%;
    position: relative;
    bottom: 11px;
    border-top: 0px solid #ededed;
}

.tabs {
  
  margin: 0 auto;
  padding: 0 20px;
}
#tab-button {
  display: table;
  table-layout: fixed;
  width: 100%;
  margin: 0;
  padding: 0;
  list-style: none;
}
#tab-button li {
  display: table-cell;
  width: 20%;
}
#tab-button li a {
  display: block;
  padding: .5em;
  background: #eeedf1;
  border: 1px solid #ddd;
  text-align: center;
  color: #b6264e;
  text-decoration: none;
}
#tab-button li:not(:first-child) a {
  border-left: none;
}
#tab-button li a:hover,
#tab-button .is-active a {
  border-bottom-color: transparent;
  background: #b6264e;
  color:#fff;
  font-weight:700;
}
.tab-contents {
  padding: .5em 2em 1em;
  border: 1px solid #ddd;
}



.tab-button-outer {
  display: none;
}
.tab-contents {
  margin-top: 20px;
}
@media screen and (min-width: 768px) {
  .tab-button-outer {
    position: relative;
    z-index: 2;
    display: block;
  }
  .tab-select-outer {
    display: none;
  }
  .tab-contents {
    position: relative;
    top: -1px;
    margin-top: 0;
  }
}


td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}
.audi h3{text-align:center; padding:30px 0px 20px 0px; font-size:25px;}
</style>
<script>$(function() {
  var $tabButtonItem = $('#tab-button li'),
      $tabSelect = $('#tab-select'),
      $tabContents = $('.tab-contents'),
      activeClass = 'is-active';

  $tabButtonItem.first().addClass(activeClass);
  $tabContents.not(':first').hide();

  $tabButtonItem.find('a').on('click', function(e) {
    var target = $(this).attr('href');

    $tabButtonItem.removeClass(activeClass);
    $(this).parent().addClass(activeClass);
    $tabSelect.val(target);
    $tabContents.hide();
    $(target).show();
    e.preventDefault();
  });

  $tabSelect.on('change', function() {
    var target = $(this).val(),
        targetSelectNum = $(this).prop('selectedIndex');

    $tabButtonItem.removeClass(activeClass);
    $tabButtonItem.eq(targetSelectNum).addClass(activeClass);
    $tabContents.hide();
    $(target).show();
  });
});</script>
  <main>
  <section id="hero_in" class="general">
    <div class="wrapper">
      <div class="container">
        <h1 class="fadeInUp"><span></span><?php echo $audi->title;?></h1>
      </div>
    </div>
  </section>
  <br/>
  <div class="bg_color_1 webinarSchedule" id="webinarSchedule">
    <div class="container">
     
     <? if(count($days) > 0){ ?>
     
      <div class="row">
      <div class="col-md-12 audi">
      
      <div class="tabs">
  <div class="tab-button-outer">
    <ul id="tab-button">
     
     <? $i=1; foreach($days as $day){ ?>
     
		  <li><a href="#tab0<? echo $i ?>">DAY <? echo $i ?></a></li>
   
   	 <? ++$i;} ?>
   
    </ul>
  </div>
  <div class="tab-select-outer">
    <select id="tab-select">
     
     <? $i1=1; foreach($days as $day){ ?>
      <option value="#tab0<? echo $i1 ?>">DAY <? echo $i1 ?></option>
   <? ++$i1;} ?>
    </select>
  </div>

   <? $i2=1; foreach($days as $day){ ?>

		<div id="tab0<? echo $i2 ?>" class="tab-contents">

			<h3>DAY - <? echo $i2 ?>  (<? echo date("d/m/Y",strtotime($day->date)) ?>) <? echo date("l",strtotime($day->date)) ?></h3>
			
			<div class="smsg"></div>
			
			<div class="table-responsive">
				<table width="100%">
					<tbody>
						<tr>
							<th>Time</th>
							<th>Program</th>
							<th colspan="2">Institute(s) / Presenter(s)</th>
							<th></th>
						</tr>
						
						<? $date = strtotime(date("Y-m-d H:i:s"));
							$sessions = $this->db->query("SELECT * FROM tbl_institutes JOIN tbl_institute_presentations WHERE tbl_institutes.status='Active' AND tbl_institutes.is_deleted=0 AND tbl_institutes.institute_id=tbl_institute_presentations.institute_id AND tbl_institute_presentations.date='$day->date' AND tbl_institute_presentations.status='Active'")->result();
									
							foreach($sessions as $se){ 
								
							$image = ($se->theme_logo != "") ? base_url().$se->theme_logo : base_url()."assets/images/professors/user.png";
								
							$checkex = $this->db->get_where("tbl_student_auditorium_presentations",["presentation_id"=>$se->id,"student_id"=>$this->session->userdata("student_id")])->num_rows();
									
								
						?>
							
							<tr>
							
								<td><? echo date("h:iA",$se->from_time); ?> - <? echo date("h:iA",($se->to_time)); ?></td>
								<td><? echo ucfirst($se->title) ?></td>
								<td align="center"><img src="<? echo $image ?>" alt="" class="rounded-circle" style="width:60px;">
								</td>
								<td><b><? echo $se->institute_name ?>,</b><br> <? echo nl2br($se->address) ?></td>

								<td>
									
									
									
										<? if($this->session->userdata("student_id")){ 
									
											if($checkex > 0){
												
												echo 'Already Booked';
											?>
											
										<? }else{ ?>
												
												<button class="btn btn-danger speakersession" session_id="<?php echo $se->id; ?>">Book</button>
												
										<?	}
										}else{ ?>	
											<a class="btn btn-danger" href="javascript:void(0)" data-toggle="modal" data-target="#myModalLoginNow">Book</a>
										<? } ?>
<!--									</form>		-->
								</td>
								
									
							</tr>
						
						<? } ?>	
					</tbody>
				</table>

			</div>

		</div>
		
	<? ++$i2;} ?>	
		
  
</div>
      
      
      
      
      
      
      </div>
      </div>
      
      
      <? }else{
	
				echo '<p style="text-align:center;font-size:16px;font-weight:500">No Sessions Found</p>';
	
			} ?>
      
    </div>
  </div>
</div>
</main>

<? $this->load->view("front/includes/footer");?>
<?php $this->load->view("student/login/login_popup")?>
<script type="text/javascript">

	$(".speakersession").on('click', function(e){
//		alert()
       e.preventDefault();
//       var fdata = $("#speakersession").serialize();
		
		var session_id = $(this).attr("session_id");
       var url = '<?php echo base_url("front/Auditorium/save_in_session")?>';
        //alert(url);
       $.ajax({
        url:url,
        data:{session:session_id},
        type:"post",
//        dataType:"json",
        beforeSend: function(){
          $("#loader").show();
        },
        success: function(str){
            //alert(str);
          console.log(str);
          $("#loader").hide();
          if(str == 'success'){
            $(".smsg").show();
            $(".smsg").html('<div class="alert alert-success">Successfully applied for the session.</div>');
            setTimeout(function(){ location.reload(); }, 1000);  
          }else{
            $(".smsg").show();
            $(".smsg").html(str);
          }
        },
		   error : function(data){
			   
			   console.log(data);
			   
		   }
        });
    });

</script>


