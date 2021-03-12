<? $this->load->view("front/includes/header");?>

<style>

.fancy-radio{margin-right:10px;margin-top: 10px}.fancy-radio,.fancy-radio label{font-weight:400}.fancy-radio input[type="radio"]{display:none}.fancy-radio input[type="radio"]+span{display:block;cursor:pointer;position:relative}.fancy-radio input[type="radio"]+span i{display:inline-block;vertical-align:middle;*vertical-align:auto;*zoom:1;*display:inline;-webkit-border-radius:8px;-moz-border-radius:8px;border-radius:8px;position:relative;bottom:1px;content:"";border:1px solid #bdbdbd;width:18px;height:18px;margin-right:5px}.fancy-radio input[type="radio"]:checked+span i:after{-webkit-border-radius:50%;-moz-border-radius:50%;border-radius:50%;display:block;position:relative;top:3px;left:3px;content:'';width:10px;height:10px;background-color:#7b848c}.fancy-radio.custom-color-green input[type="radio"]:checked+span i:after{background-color:#22af46}.fancy-radio.custom-bgcolor-green input[type="radio"]:checked+span i{background-color:#22af46}.fancy-radio.custom-bgcolor-green input[type="radio"]:checked+span i:after{background-color:#fff}.input-group-addon .fancy-radio,.input-group-addon .fancy-checkbox{margin:0;position:relative;top:1px}.input-group-addon .fancy-radio input[type="radio"]+span i,.input-group-addon .fancy-checkbox input[type="checkbox"]+span{margin:0}.input-group-addon .fancy-radio input[type="radio"]+span i:before,.input-group-addon .fancy-checkbox input[type="checkbox"]+span:before{margin:0}

</style>

<div id="inbanner">
<img src="<?php echo base_url();?>assets/images/front/counselor.jpg"   alt="" class="img-fluid">
</div>

<section id="ex">
  <div class="container emp-profile">
                <div class="row">
                    <div class="col-md-3">
                        <div class="profile-img">
						    <?php if($professor_details[0]->expert_photo != ""){ ?>
								<img src="<?php echo base_url();?>assets/images/professors/<?php echo $professor_details[0]->expert_photo; ?>" class="img-thumbnail img-fluid" width="375px" height="450px" alt=""/>
							<?php }else{ ?>
								<img src="<?php echo base_url();?>assets/images/front/team-4-big.jpg" class="img-thumbnail img-fluid" alt=""/>
							<?php } ?>
                            
                            
                            
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="profile-head">
							<h5 style="padding: 0px;">
								<?php echo $professor_details[0]->expert_name; ?>
							</h5>
							<h6>
								<?php echo $professor_details[0]->expert_qualification; ?>
							</h6>
							<p class="proile-rating"> <?php echo $professor_details[0]->expert_curorg; ?></p>
                            <p>Language Spoken: <?php echo $professor_details[0]->expert_spokenlang; ?></p>
							<br>
                        	<p><strong>Description</strong> : <?php echo $professor_details[0]->expert_shortdesc; ?></p>

                        </div>
                    </div>
                </div>
                
                
                <div class="row">
                    <div class="col-md-12" style="margin-top: 20px" align="center">
                  
                    <? if(count($sessions) > 0){
						?>    
                                    
                      	<div class="main_title_2">
							<span><em></em></span>
							<h5 style="margin-right: 35px">Available Sessions</h5>
							
							<div class="alertMessage" style="margin-left: 25%;margin-right: 25%"></div>
							
							<div class="row">
								
								<? 
									$cdate = date("Y-m-d");	
									
									foreach($sessions as $se){ 
										
										if(strtotime($se->exp_se_date) >= strtotime($cdate)){
											
											$sesstimings = $this->db->get_where("tbl_counsellor_sessions",["exp_se_date"=>$se->exp_se_date,"institute_id"=>$se->institute_id,"expert_id"=>$se->expert_id,"is_booked"=>"Inactive"])->result(); 
											
											if($sesstimings){
								?>
								
												
											<div class="col-md-4">
<!--												<form method="post" class="" id="saveSession<? //echo $se->id ?>">-->
													<h4 class="pricing-header" style="padding: 0px; font-size: 16px;"><? echo date("d M Y",strtotime($se->exp_se_date)) ?></h4>

											
													<div style="height: 150px; overflow: scroll;overflow-x: hidden;overflow-y: auto;">

														<? $sesstimings = $this->db->get_where("tbl_counsellor_sessions",["exp_se_date"=>$se->exp_se_date,"institute_id"=>$se->institute_id,"expert_id"=>$se->expert_id])->result(); 

														$i = 0;
														foreach($sesstimings as $sst){
															
															if($sst->is_booked == "Inactive"){
														?>

															<div class="fancy-radio">
																<label><input name="stime<? echo $se->exp_se_id ?>" value="<? echo $sst->exp_se_id ?>" type="radio" <? //echo ($i == 0) ? 'required' : ''; ?>><span style="background-color: white"><i></i><? echo $sst->exp_se_time ?></span></label>
															</div>
															

														<? }
														$i++;
														} ?>		

													</div>
											
													<button type="button" class="btn btn-info btn-sm saveSession" id="<? echo $se->exp_se_id ?>" style="border-radius: 30%;margin-top: 10px;">Book</button>
<!--												</form>-->
											</div>
										
								<? }}} ?>
								
						
							</div>
							
						</div>
                 	
                 	<? } ?>
                 	
                  	</div>
                </div>
        </div>
</section>

<? $this->load->view("front/includes/footer");?>

<script>

	$(".saveSession").click(function(e){
		
		var radioValue = $("input[name='stime"+$(this).attr("id")+"']:checked"). val();
		
		if(radioValue){
		
			$.ajax({
				
				type : "post",
				url : "<? echo base_url('front/Councellors/save_in_session') ?>",
				data : {session:radioValue},
				success : function(data){
					
					if(data == "success"){
						
						$(".alertMessage").html('<div class="alert alert-success">You Have Successfully Applied For this Session.</div>');
						setTimeout(function(){location.reload()},3000);
						
					}else{					
						
						$(".alertMessage").html(data)
						setTimeout(function(){$(".alertMessage").html("")},3000);
					
					}
					
					console.log(data)
					
				},
				error : function(data){
					
					console.log(data)
					
				}
				
			});
			
		}else{
			
			$(".alertMessage").html('<div class="alert alert-danger">Please select atleast one session</div>')
			setTimeout(function(){$(".alertMessage").html("")},3000);
			
		}
		
	})
	
</script>

