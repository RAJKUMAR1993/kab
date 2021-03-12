
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
                        <div class="header">
                            <div class="col-lg-9 pull-left">
                                <h2>Meeting Details</h2>
                            </div>
                            <div class="col-lg-1 pull-right">
                                <a href="<?php echo base_url("institute/videoconnect");?>" class="btn btn-info">Back</a>
                            </div>
                        </div>
                        <div class="body">
						
                            <form id="updateexpert">
                            <div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
                            <!-- <form id="basic-form" method="post" action="<?php echo base_url("professor/settings/update")?>" enctype="multipart/form-data" novalidate> -->
							<input type="hidden" name="id" value="<?php if(isset($collegeconnect[0]->id)){ echo $collegeconnect[0]->id;}?>">
                                <div class="col-lg-12 pull-left">
                                     <div class="col-lg-6 pull-left">
                                        <div class="form-group">
                                            <label>Name <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="name" value="<?php if(isset($collegeconnect[0]->name)){ echo $collegeconnect[0]->name;}?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 pull-left">
                                     <div class="col-lg-6 pull-left">
                                        <div class="form-group">
                                            <label>Designation <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="designation" value="<?php if(isset($collegeconnect[0]->designation)){ echo $collegeconnect[0]->designation;}?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 pull-left">
                                     <div class="col-lg-6 pull-left">
                                        <div class="form-group">
                                            <label>Date <span style="color: red;">*</span></label>
                                            <input type="date" class="form-control" name="date" value="<?php if(isset($collegeconnect[0]->date)){ echo $collegeconnect[0]->date;}?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 pull-left">
                                    <div class="col-lg-6 pull-left">
                                        <div class="form-group">
                                            <label>From Time <span style="color: red;">*</span></label>
                                            <input type="time" class="form-control" name="from_time" value="<?php if(isset($collegeconnect[0]->from_time)){ echo date('H:i', $collegeconnect[0]->from_time);}?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 pull-left">
                                    <div class="col-lg-6 pull-left">
                                        <div class="form-group">
                                            <label>To Time <span style="color: red;">*</span></label>
                                            <input type="time" class="form-control" name="to_time" value="<?php if(isset($collegeconnect[0]->to_time)){ echo date('H:i', $collegeconnect[0]->to_time);}?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 pull-right">
                                    <button type="submit" class="btn btn-primary pull-right"><?php if(isset($collegeconnect[0]->id)){ echo 'Update Details';}else{ echo 'Add Details';}?></button><br><br><br>
                                    <center><img src="<? echo base_url(); ?>assets/images/load.gif" width="42" height="42" alt="" style="display:none" id="loader"></center>
                                </div>
                            </form>
                        </div>
                    </div>
    </div>
</div>

<script type="text/javascript">
  $('.dropify').dropify({
    messages: {
        'default': 'Drag and drop a file here or click',
        'replace': 'Drag and drop or click to replace',
        'remove':  'Remove',
        'error':   'Ooops, something wrong happended.'
    }
});
</script>
<script type="text/javascript">
    $(document).ready(function(){
  
    $("#updateexpert").on('submit', function(e){
       e.preventDefault();
       var fdata = $("#updateexpert").serialize();
       var url = '<?php echo base_url("institute/videoconnect/save_meeting")?>';
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
        },
		   error : function(data){
			   console.log(data);
		   }
        });
    });

    });
</script>