
<!--
<link rel="stylesheet" href="https://bootstraplily.com/demo/youtube-website-html/css/owl.carousel.css">
    <link rel="stylesheet" href="https://bootstraplily.com/demo/youtube-website-html/css/owl.theme.default.css">
-->
<!--    <script src="https://kit.fontawesome.com/b31e06099e.js" crossorigin="anonymous"></script>-->
<script>


</script>

<link href="<? echo base_url('assets/css/professors.css') ?>" rel="stylesheet">
<link href="<? echo base_url('assets/udema/') ?>css/skins/square/grey.css" rel="stylesheet">
<style type="text/css">
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
</style>
<!-- Custom Modal Windows -->
<div class="custom_modal" id="councellors">
    <div class="row">
        <div class="col-md-12 text-right">
            <a style="font-size:20px;cursor:pointer;color:red" onclick="closeModal('councellors');">
                <i class="icon-cancel-6"></i><p style="font-size:10px">Close</p>
            </a>
        </div>
    </div>
    <div class="container margin_35">
			<div class="main_title_2">
				<span><em></em></span>
				<h2>Professors</h2>
			</div>
			<div class="cd-gallery row">
                <?
                    $cdata = $this->db->get_where("tbl_councellors",["institute_id"=>$idata->institute_id, "expert_status"=>"Active", "is_deleted"=>0])->result();
                    if(count($cdata) > 0){
                    foreach ($cdata as $row) { 
                        $insinfo = $this->institute_model->get_institute_id($row->institute_id);
                 ?>
                    <div class="col-md-4 col-xs-6 ">
                        <div class="meet-card clearfix">
                            <div class="img">
                                <img src="<?php if($row->expert_photo == ""){ echo base_url().'assets/images/front/team4.png'; } else { echo base_url($row->expert_photo); } ?>" width="100%">
                            </div>
                            <h4><?php echo ucfirst($row->expert_name); ?></h4>
                            <div class="specialization" id="specialization-13" style="display: block;">
                                <ul>
                                    <li><b>Qualification : </b><?php echo ucfirst($row->expert_qualification); ?></li>
                                    <li><b>Designation : </b><?php echo ucfirst($row->expert_designation); ?></li>
                                    <li><b>Department : </b><?php echo ucfirst($row->expert_department); ?></li>
                                    <li><b>Institution : </b><?php echo ucfirst($insinfo->institute_name); ?></li>
                                    <li><b>Languages : </b><?php echo $row->expert_spokenlang; ?></li>
                                </ul>
                                    
                                <div class="row">   
                                    <div class="col-md-12" align="center" style="margin-bottom: 10px;">
                                        <a href="#" onclick="openModal1('profile', <?php echo $row->id;?>)">View Profile <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                    
                                    <div class="col-md-12" align="center" style="margin-bottom: 10px;"> 
                                        <a <? if($this->session->userdata("student_id")){ ?> href="#" onclick="openModal1('askaquestion', <?php echo $row->id;?>)" <?php }else{ ?>href="javascript:void(0)" data-toggle="modal" data-target="#myModalLoginNow"<?php }?>>Ask a Question <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>  
                                    <div class="col-md-12" align="center" style="margin-bottom: 10px;"> 
                                        <a <? if($this->session->userdata("student_id")){ ?> href="#" onclick="openModal1('sessionbooking', <?php echo $row->id;?>)" <?php }else{ ?>href="javascript:void(0)" data-toggle="modal" data-target="#myModalLoginNow"<?php }?>>Book a Session <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                    
                                </div>      
                                        
                            </div>
                        </div>
                    </div>
                    
                <? }}else{
                        echo '<p style="text-align:center;font-size:15px;font-weight:400;text-color:red">No Councellors. </p>';
                    } ?>
            </div>
            <div class="row sessionsRow" style="display: none; border: 1px solid #ddd;padding: 36px;">
                <form id="updatestudentsession">
                    <input type="hidden" name="coun_session_id" id="sesid"/>
                    <input type="hidden" name="session_type" id="sesduration"/>
                    <input type="hidden" name="session_date" id="sesdate"/>
                    <input type="hidden" name="session_time" id="sestime"/>
                    <div class="row councellorSessions"></div>
                    <button class="btn btn-danger round_btns book_now_sessions" style="display: none;">Book now</button>
                </form>
            </div>
			<!-- /grid gallery -->
        </div>
        <br/><br/>
</div>
<!-- Custom Modal Windows -->
<!--
<script src="https://bootstraplily.com/demo/youtube-website-html/js/owl.carousel.js"></script>
<script src="https://bootstraplily.com/demo/youtube-website-html/js/jquery.hoverplay.js"></script> -->
