
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
        

    <div class="col-md-12">
                    <?php echo $this->session->flashdata('msg');?>
                    <div class="card">
                        <div class="header webinarHeader1">
                            <div class="col-lg-9 pull-left">
                                <h2>Webinar Dates</h2>
                            </div>
                            <div class="col-lg-1 pull-right">
                                <a href="<?php echo base_url("admin/webinars/webinar_dates");?>" class="btn btn-info">Back</a>
                            </div>
                                   
                        </div>
                        <div class="body">
                            <div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
                            <form id="addeditwebinor">
                                <input type="hidden" id="url" name="url" value="<?php echo base_url("admin/webinars/save_webinar_date/".$this->uri->segment(4));?>">
                                <input type="hidden" id="wdate_id" name="wdate_id" value="<?php echo $this->uri->segment(4);?>">
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Date <span style="color: red;">*</span></label>
                                        <input type="date" class="form-control" name="date" value="<?php if(isset($wdate->date)){ echo $wdate->date;}?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 pull-right">                                    
                                     <button type="submit" class="btn btn-primary pull-right"><?php if($this->uri->segment(4)){echo "Update Webinar Date";}else{ echo "Add Webinar Date";}?></button><br><br><br>
                                        <center><img src="<? echo base_url(); ?>assets/images/load.gif" width="42" height="42" alt="" style="display:none" id="loader"></center>
                                </div>
                            </form>
                        </div>

                       
                    </div>
    </div>
</div>
<? $this->load->view("admin/includes/footer");?>
<script type="text/javascript">
    $(document).ready(function(){
    $("#addeditwebinor").on('submit', function(e){
       e.preventDefault();
       var fdata = $("#addeditwebinor").serialize();
       var url = $('#url').val();
       $.ajax({
        url:url,
        data:fdata,
        type:"post",
        dataType:"json",
        beforeSend: function(){
          $("#loader").show();
        },
        success: function(str){
          $("#loader").hide();
          if(str.Status == 'Active'){
            $("#smsg").show();
            $("#smsg").html(str.Message);
            setTimeout(function(){ location.reload(); }, 1000);  
          }else{
            $("#emsg").show();
            $("#emsg").html(str.Message);
          }
        }
        });
    });

    });
</script>