
<style>
    td.details-control {
    background: url('<?php echo base_url(); ?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
    tr.shown td.details-control {
        background: url('<?php echo base_url(); ?>assets/images/details_close.png') no-repeat center center;
    }
</style>

<div id="main-content">
        <div class="container-fluid">
            
            <div class="row clearfix">
                
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">                        
                          <section id="lessons">
              							<div class="intro_title">
              								<h2>FAQ Details</h2>
              							</div>
              							<div id="accordion_lessons" role="tablist" class="add_bottom_45">
              							
                            <!-- All Students Data -->
                            <div class="card" style="margin-bottom: 10px">
                              <div class="card-header" role="tab">
                                <h5 class="mb-0">
                                  <a href="#"><i class="indicator ti-minus"></i> All Institutes FAQ Details</a>
                                </h5>
                              </div>
                              <div class="card-body">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable" style="display: none;">
                                  <thead>
                                      <tr> 
                                          <th>S.no</th>
                                          <th>Institute Name</th>
                                           <th>Question</th>
                                           <th>Answer</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php if($faqs){
                                              $key=1;
                                             foreach($faqs as $faq):
                                          ?>
                                     <tr>
                                          <td><?php echo $key;?></td>
                                          <td><?php echo $faq->institute_name;?></td>
                                          <td style="white-space: break-spaces;"><?php echo $faq->question;?></td>
                                          <td style="white-space: break-spaces;"><?php echo $faq->answer;?></td>
                                      </tr>
                                      <?php $key++; endforeach;}?>
                                  
                                  </tbody>
                                
                                </table>
                              </div>
                            </div>
                            <!-- All Students Data -->
							<? $institutes = $this->db->group_by("institute_id")->get("tbl_institute_faqs")->result(); 
								
							  foreach($institutes as $sk => $inst){
                  $faqss = $this->db->select("tbl_institute_faqs.*, tbl_institutes.institute_name")->join("tbl_institutes", "tbl_institutes.institute_id=tbl_institute_faqs.institute_id", "left")->where("tbl_institute_faqs.institute_id", $inst->institute_id)->order_by("tbl_institute_faqs.created_datetime","desc")->get("tbl_institute_faqs")->result();
								  
							?>
							
							
									<div class="card" style="margin-bottom: 10px">
										<div class="card-header" role="tab" id="heading<? echo $sk ?>">
											<h5 class="mb-0">
												<a data-toggle="collapse" href="#collapse<? echo $sk ?>" aria-expanded="true" aria-controls="collapse<? echo $sk ?>"><i class="indicator ti-minus"></i> <? echo ucfirst($faqss[0]->institute_name) ?></a>
											</h5>
										</div>

										<div id="collapse<? echo $sk ?>" class="collapse <? echo ($sk == 0) ? 'show' : '' ?>" role="tabpanel" aria-labelledby="heading<? echo $sk ?>">
											<div class="card-body">
											
						                        <div class="table-responsive">
													<table class="table table-bordered table-striped table-hover dataTable js-exportable">
														<thead>
															<tr> 
																<th>S.no</th>
																<th>Institute Name</th>
                                <th>Question</th>
                                <th>Answer</th>
															</tr>
														</thead>
														<tbody>
															<?php if($faqss){
																	$key=1;
																   foreach($faqss as $faq):
																?>
														   <tr>
																<td><?php echo $key;?></td>
																<td><?php echo $faq->institute_name;?></td>
                                <td style="white-space: break-spaces;"><?php echo $faq->question;?></td>
                                <td style="white-space: break-spaces;"><?php echo $faq->answer;?></td>
															</tr>
															<?php $key++; endforeach;}
                              ?>

														</tbody>

													</table>
													</div>


												</div>
											</div>
										</div>
									
							<? } ?>
																					
							</div>
							<!-- /accordion -->
						</section>

                        
                        
                        
                        
                        
                        
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
<script type="text/javascript">
    $(document).ready(function(){
      setTimeout(function(){
        $("#DataTables_Table_0_info, #DataTables_Table_0_paginate, #DataTables_Table_0_filter").attr("style", "display:none;");
      }, 500);
 });
</script>