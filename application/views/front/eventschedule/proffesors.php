<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 $this->load->view("front/includes/new_header");?>
<link href="<? echo base_url('assets/css/professors.css') ?>" rel="stylesheet">
<link href="<? echo base_url('assets/udema/') ?>css/skins/square/grey.css" rel="stylesheet">
<style>

.singlepost figure img:hover {
    transform: scale(1.1);
}
	
.singlepost figure img {
	transition: all 0.3s ease;
}	
	
@media (min-width: 992px)
.col-md-3 {
    width: 25%;
}
.cd-gallery a {
    background: #fff;
    border: 2px solid #662d91;
    color: #662d91;
    padding: 5px 8px;
    font-weight: 500;
    line-height: 1;
    -moz-transition: all 0.3s ease-in-out;
    -o-transition: all 0.3s ease-in-out;
    -webkit-transition: all 0.3s ease-in-out;
    -ms-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
    -webkit-border-radius: 30px;
    -moz-border-radius: 30px;
    -ms-border-radius: 30px;
    border-radius: 30px;
}	
.cd-gallery a:hover {
    background: #662d91;
    color: #fff;
}		
b {
	font-weight: bold;
}
.custom_modal {
	top: 81px;
}
	
	@media screen and (max-width: 600px) {
	
	.cd-filter-trigger:hover, .cd-filter-trigger:focus {
    color: #34acdf;
    text-decoration: none;
}
	.cd-filter-trigger {color: #2d2727!important; left:15px!important;}
	
	.filter-is-visible {
    width: 100%!important;
}


	
	}
	
</style>
<?php
$filter_department = '';
$search_keyword = '';
if(isset($_POST["department"])){
    $filter_department = $_POST["department"];
}
	  
if(isset($_POST["search_keyword"])){
    $search_keyword = $_POST["search_keyword"];
}
?>
<main>
    <section id="hero_in" class="general" style="height: 230px">
        <div class="wrapper">
            <div class="container">
                <h1 class="fadeInUp"><span></span>Professors</h1>
            </div>
        </div>
    </section>
    <div class="container margin_60_35 webinarSchedule">
        <nav aria-label="breadcrumb">
	  	    <ol class="breadcrumb">
			     <li class="breadcrumb-item"><a href="<? echo base_url() ?>">Home</a></li>
			     <li class="breadcrumb-item"><a href="<? echo base_url('front/webinars/eventSchedule') ?>">Event Schedule</a></li>
                <?php
                if($filter_department!='' || $search_keyword!=''){
                    echo '<li class="breadcrumb-item"><a href="'.base_url().'front/webinars/proffesors">Professors</a></li>';
                    /*if($filter_department!=''){
                        echo '<li class="breadcrumb-item active" aria-current="page">'.ucfirst($filter_department).'</li>';
                    }*/
                    if($search_keyword!=''){
                        echo '<li class="breadcrumb-item active" aria-current="page">'.ucfirst($search_keyword).'</li>';
                    }
                }
                else{
                    echo '<li class="breadcrumb-item active" aria-current="page">Professors</li>';
                }
                ?>            
            </ol>
        </nav>
        
        
        <div class="cd-main-content">
        
        <form action="" method="POST" id="filterDepartment">
        
        	<div class="cd-tab-filter-wrapper">
				<div class="cd-tab-filter cd-filter-block">
						
					<div class="row">	
						<div class="col-md-7 col-7 d-none d-sm-block"></div>
						<div class="col-md-4 col-10" style="padding-top: 4px">
							<div class="form-group">
								<input class="form-control search" type="text" name="search_keyword" value="<?php if($search_keyword!=''){echo $search_keyword;}?>" placeholder="Search Keyword">
							</div>
						</div>
						<div class="col-md-1 col-1" style="padding-top: 8px;margin-left: -15px;">
							<div class="form-group">
								<button class="btn btn-primary" type="submit">Search</button>
							</div>
						</div>
					</div>	
				</div> 
			</div>

			<div class="cd-filter" id="filters_col" style="display: none">

				<div class="collapse show" id="collapseFilters">
					<div class="filter_type" style="margin-top: 20px">
						<h6>Departments</h6>
						<ul>
						<?php
							$departments = $this->db->query("SELECT DISTINCT expert_department FROM tbl_councellors WHERE expert_department!='' and is_deleted=0 and expert_status='Active' ORDER BY expert_department asc")->result();
							foreach ($departments as $department) {
								
								$check = '';
								
								if(in_array($department->expert_department,$filter_department)){
									
									$check = "checked";
									
								}
								
								
						?>
						
							<li>
								<label>
									<input type="checkbox" class="icheck" name="department[]" value="<?php echo $department->expert_department;?>" <? echo $check ?> ><?php echo $department->expert_department;?>
								</label>
							</li>
							
						<? } ?>	
							
						</ul>
						<div align="center">
							<a class="btn btn-info btn-sm" id="department" href="javascript:void(0)" style="border-radius: 10px;">Apply</a>
							<a class="btn btn-primary btn-sm" id="clear_all" href="javascript:void(0)" style="border-radius: 10px;">Clear All</a>
						</div>
					</div>
				</div>
									
			<a href="#0" class="cd-close">Close</a>
		</div>    

		</form>
        <a href="#0" class="cd-filter-trigger"><i class="icon_adjust-horiz"></i> Filters</a>
        
        <div class="cd-gallery row">
           
            <?
				$cdata = $this->db->select("tbl_councellors.*, tbl_institutes.institute_name")->join("tbl_institutes", "tbl_institutes.institute_id=tbl_councellors.institute_id", "left");
				if($filter_department){
					$cdata = $this->db->where_in("tbl_councellors.expert_department", $filter_department);
				}
				if($search_keyword!=''){
					$cdata = $this->db->where("tbl_councellors.expert_name LIKE '%".$search_keyword."%' OR tbl_institutes.institute_name LIKE '%".$search_keyword."%'");
				}
				$this->db->where("tbl_councellors.expert_status", "Active");
				$this->db->where("tbl_councellors.is_deleted", 0);
				
				$cdata = $this->db->get("tbl_councellors")->result();
			
				if(count($cdata) > 0){
				foreach ($cdata as $row) { 
					$insinfo = $this->institute_model->get_institute_id($row->institute_id);
			 ?>   
               
				<div class="col-md-4 col-xs-6">
					<div class="meet-card clearfix">
						<div class="img">
<!--							<a href="https://www.stoodnt.com/counselor-detail/ajay-singh">-->
								<img src="<?php if($row->expert_photo == ""){ echo base_url().'assets/images/front/team4.png'; } else { echo base_url($row->expert_photo); } ?>" width="100%">
<!--							</a>-->
						</div>
						<h4><?php echo ucfirst($row->expert_name); ?></h4>
						<!-- <h5>SPECIALITIES:<button class="btn btn-plus btn-specialization" id="13" style="display: none;"><i class="fa fa-plus" aria-hidden="true"></i></button></h5> -->
						<div class="specialization" id="specialization-13" style="display: block;">
							<ul>
								<li><b>Qualification : </b><?php echo ucfirst($row->expert_qualification); ?></li>
								<li><b>Designation : </b><?php echo ucfirst($row->expert_designation); ?></li>
								<li><b>Department : </b><?php echo ucfirst($row->expert_department); ?></li>
								<li><b>Institution : </b><?php echo ucfirst($insinfo->institute_name); ?></li>
<!--								<li>Field of Expertise : <?php //echo ucfirst($insinfo->institute_name); ?></li>-->
								<li><b>Languages : </b><?php echo $row->expert_spokenlang; ?></li>
							</ul>
								
							<div class="row">	
								<div class="col-md-12" align="center" style="margin-bottom: 13px;">
									<a href="#" onclick="openModal('profile', <?php echo $row->id;?>)">View Profile <i class="fa fa-arrow-circle-right"></i></a>
								</div>
								
								<div class="col-md-12" align="center" style="margin-bottom: 13px;">	
									<a <? if($this->session->userdata("student_id")){ ?> href="#" onclick="openModal('askaquestion', <?php echo $row->id;?>)" <?php }else{ ?>href="javascript:void(0)" data-toggle="modal" data-target="#myModalLoginNow"<?php }?>>Ask a Question <i class="fa fa-arrow-circle-right"></i></a>
								</div>	
								<div class="col-md-12" align="center" style="margin-bottom: 13px;">	
									<a <? if($this->session->userdata("student_id")){ ?> href="#" onclick="openModal('sessionbooking', <?php echo $row->id;?>)" <?php }else{ ?>href="javascript:void(0)" data-toggle="modal" data-target="#myModalLoginNow"<?php }?>>Book a Session <i class="fa fa-arrow-circle-right"></i></a>
								</div>
								
							</div>		
									
						</div>
					</div>
				</div>
                       
             <? }} ?>      
            
            </div>
            
            </div>
          	  
       
    </div>



</main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

<?php $this->load->view("front/includes/new_footer");?>

<script type="text/javascript">
	function openModal(id, cid=null){
		
		if(id == "askaquestion"){
			
			$("#coun_id").val(cid);
			
		}
		
		$(".btn_request_a_session").hide();
		if(id=='sessionbooking'){
			$(".btn_request_a_session").show();
		}
		$.ajax({
			url : "<? echo base_url('front/webinars/getProfessor') ?>",
			type : "post",
			data : {cid:cid},
			dataType: "json",
			success : function(data){
				if(data!='' && typeof data!='undefined'){
					if(data.institute_id!='' && typeof data.institute_id!='undefined'){
						$("#institute_id").val(data.institute_id);
					}
					if(data.expert_name!='' && typeof data.expert_name!='undefined'){
						$(".mnt_name").html(data.expert_name);
					}	
					if(data.expert_qualification!='' && typeof data.expert_qualification!='undefined'){
						$(".mnt_edu").html(data.expert_qualification);
					}
					if(data.expert_spokenlang!='' && typeof data.expert_spokenlang!='undefined'){
						$(".sal_row").html("Language Spoken: "+data.expert_spokenlang);
					}
					if(data.expert_expertise!='' && typeof data.expert_expertise!='undefined'){
						$(".mnt_specialy").html(data.expert_expertise);
					}
					if(data.expert_longdesc!='' && typeof data.expert_longdesc!='undefined'){
						$(".basic_para").html(data.expert_longdesc);
					}
					if(data.expert_name!='' && typeof data.expert_name!='undefined'){
						$(".about_user").html(data.expert_name);
					}
					if(data.expert_designation!='' && typeof data.expert_designation!='undefined'){
						$(".mnt_designation").html(data.expert_designation);
					}
					if(data.expert_department!='' && typeof data.expert_department!='undefined'){
						$(".mnt_department").html(data.expert_department);
					}
					if(data.institute_name!='' && typeof data.institute_name!='undefined'){
						$(".mnt_institution").html(data.institute_name);
					}
					if(data.expert_photo!='' && typeof data.expert_photo!='undefined'){
						$(".profile_image").html('<img src="<?php echo base_url();?>'+data.expert_photo+'" class="mentor_big_img" style="margin-bottom:10px;">');
					}
				}
			}
		});
		$.ajax({
			url : "<? echo base_url('front/webinars/getProfessorSessions') ?>",
			type : "post",
			data : {cid:cid},
			success : function(data){
				if(data!='' && typeof data!='undefined'){
					$(".counsellorSessions").html(data);
				}
			}
		});
		setTimeout(function(){
			$("#"+id).show();
		}, 1500);
	}	
	function closeModal(id){
		$("#"+id).hide();
	}
</script>

<?php $this->load->view("student/login/login_popup")?>
<?php $this->load->view("front/eventschedule/profile")?>
<?php $this->load->view("front/eventschedule/askaquestion")?>
<?php $this->load->view("front/eventschedule/sessionbooking")?>
<script type="text/javascript">
    $(document).ready(function(){
    	$("#queSubmit1").submit(function(e){
  
		    e.preventDefault();
		    var fdata = $("#queSubmit1").serialize();
		    
		    $.ajax({

		      type : "post",
		      data : fdata,
		      url : "<? echo base_url('front/institutes/insertQuestion') ?>",
		      success : function(data){
		        console.log(data);
		        if(data == "success"){
		          $(".smsg").html('<div class="alert alert-success">We have received your Question successfully, We will contact you soon.</div>');
		          setTimeout(function(){location.reload()},3000)
		        }else{
		          $(".smsg").html('<div class="alert alert-danger">Error Occured please try again.</div>');
		        }
		      },
		      error : function(data){
		        
		        console.log(data);
		        
		      }

		    })
		  
		}); 
        $("#department").on("click", function(){
            var department = $(this).val();
            if(typeof department!='undefined'){
                $("#filterDepartment").submit();
            }
        });
		
		$("#clear_all").click(function(){
			
			$(".icheck"). prop("checked", false);
			$(".search").val("");
			$("#filterDepartment").submit();
			
		})
    });
	
	
		
//open/close lateral filter
	$('.cd-filter-trigger').on('click', function(){
		$(".cd-filter").show();
        triggerFilter(true);
        //$('.cd-gallery').find('.col-md-4').attr('class', 'col-md-6 col-xs-6');
        $('.cd-gallery').find('.col-md-4').attr('class', 'col-md-6 col-xs-6 filterShow');

	});
	$('.cd-filter .cd-close').on('click', function(){
		triggerFilter(false);
        //$('.cd-gallery').find('.col-md-6').attr('class', 'col-md-4 col-xs-6');
        $('.cd-gallery').find('.filterShow').attr('class', 'col-md-4 col-xs-6');
		$(".cd-filter").hide();
	});

	function triggerFilter($bool) {
		var elementsToTrigger = $([$('.cd-filter-trigger'), $('.cd-filter'), $('.cd-tab-filter'), $('.cd-gallery')]);
		elementsToTrigger.each(function(){
			$(this).toggleClass('filter-is-visible', $bool);
		});
    }		
    
</script>
<script>
$(".btn_request_a_session").on('click', function(event){
    
  $('#expbooksession').show(); 
  //$('.session_booking').hide();
  $(".session_1").click();
  
});
</script>
    

    