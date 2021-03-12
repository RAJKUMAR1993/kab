
<!--
<link rel="stylesheet" href="https://bootstraplily.com/demo/youtube-website-html/css/owl.carousel.css">
    <link rel="stylesheet" href="https://bootstraplily.com/demo/youtube-website-html/css/owl.theme.default.css">
-->
    <script src="https://kit.fontawesome.com/b31e06099e.js" crossorigin="anonymous"></script>
<script>


</script>

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
			<div class="row" style="margin-bottom: 50px">
                <?
                    $cdata = $this->db->get_where("tbl_councellors",["institute_id"=>$idata->institute_id, "expert_status"=>"Active", "is_deleted"=>0])->result();
                    if(count($cdata) > 0){
                    foreach ($cdata as $row) { 
                        $insinfo = $this->institute_model->get_institute_id($row->institute_id);
                 ?>
                    <div class="col-md-3" style="text-align: center;">
                        <figure><img src="<?php if($row->expert_photo == ""){ echo base_url().'assets/images/front/team4.png'; } else { echo base_url($row->expert_photo); } ?>" class="img-fluid" alt=""></figure>
                        <h3><a href="#"><?php echo $row->expert_name; ?></a></h3>
                        <?php if($row->expert_designation!=''){ ?>
                        <p><?php echo $row->expert_designation; ?></p>
                        <div class="line1"></div>
                        <?php }if($row->expert_qualification!=''){ ?>
                        <p> <?php echo $row->expert_qualification; ?></p>
                        <div class="line1"></div>
                        <?php } ?>
                        <?php if($row->expert_spokenlang!='') { echo '<p>Language Spoken: '.$row->expert_spokenlang.'</p>';} ?>
                        <!-- <?php if($row->expert_tcost!=''){?>
                        <div class="cd">
                            <h4> <?php echo $row->expert_tcost; ?></h4>
                            <p>for 30 Minutes session</p> 
                        </div> 
                        <?php } ?>
                        <div class="row" style="margin-left: auto;margin-right: auto;width: 8em;">
                            <button type="button" style="margin: 5px;font-size: 25px;" class="btn_live_chat btn btn-danger btn-sm btn-icon call_connect_c" data-mobile="<? if($row->expert_mobile!=''){ echo $row->expert_mobile;}else{echo $row->expert_mobile2;}?>"><i class="fa fa-phone" aria-hidden="true"></i></button>
                            <button type="button" style="margin: 5px;font-size: 25px;" class="btn_live_chat btn btn-info btn-sm btn-icon"><i class="fa fa-video" aria-hidden="true"></i></button>
                        </div>   -->
                        
                        <!-- <a class="btn btn-primary" href="<? echo base_url('front/councellors/view_sessions/').$row->id ?>" style="margin-top: 10px">Book Session</a> -->
                        
                        <!-- <a class="btn btn-primary" onclick="getSessions('<?php echo $row->id;?>')" href="#">View Sessions</a> -->
                        
                        <a href="<?php echo base_url();?>front/councellors/view_sessions/<?php echo $row->id; ?>"><button class="btn btn-danger btn-block">BOOK NOW</button></a>    
                                    
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
