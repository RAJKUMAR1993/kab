
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
                                <h2>Auditorium Details</h2>
                            </div>
                            <div class="col-lg-1 pull-right">
                                <a href="<?php echo base_url("admin/auditorium/video");?>" class="btn btn-info">Back</a>
                            </div>
                                   
                        </div>
                        <div class="body">
                            <div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
                            <form id="addeditwebinor">
                                <input type="hidden" id="url" name="url" value="<?php echo base_url("admin/auditorium/save_auditorium/".$this->uri->segment(4));?>">
                                <input type="hidden" id="webinor_id" name="webinor_id" value="<?php echo $this->uri->segment(4);?>">
                                
                                <div class="row">
                                
									<div class="col-lg-4">
										<div class="form-group">
											<label>Title <span style="color: red;">*</span></label>
											<input type="text" class="form-control" name="title" value="<?php if(isset($webinor->title)){ echo $webinor->title;}?>" required>
										</div>

									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label>Date <span style="color: red;">*</span></label>
											<input type="date" id="date" class="form-control" name="date" value="<?php if(isset($webinor->date)){ echo $webinor->date;}?>" required>
										</div>

									</div>
									<div class="col-lg-4">
										
										<div class="form-group">
											<label>From Time <span style="color: red;">*</span></label>
											<input type="time" class="form-control" name="from_time" value="<?php if(isset($webinor->from_time)){ echo date('H:i', $webinor->from_time);}?>" required>
										</div>
									
									</div>		
									<div class="col-lg-4">
										<div class="form-group">
											<label>To Time <span style="color: red;">*</span></label>
											<input type="time" class="form-control" name="to_time" value="<?php if(isset($webinor->to_time)){ echo date('H:i', $webinor->to_time);}?>" required>
										</div>

									</div>
									<div class="col-lg-12 pull-right">                                    
										 <button type="submit" class="btn btn-primary pull-right"><?php if($this->uri->segment(4)){echo "Update Auditorium";}else{ echo "Add Auditorium";}?></button><br><br><br>
											<center><img src="<? echo base_url(); ?>assets/images/load.gif" width="42" height="42" alt="" style="display:none" id="loader"></center>
									</div>
                           		</div>
                           
                            </form>
                        </div>

                       
                    </div>
    </div>
</div>
<? $this->load->view("admin/includes/footer");?>
<script type="text/javascript">
    // $('.summernote').summernote({
    //     toolbar: [
    //         ['style', ['style']],
    //         ['font', ['bold', 'italic', 'underline', 'clear']],
    //         ['fontname', ['fontname']],
    //         ['color', ['color']],
    //         ['para', ['ul', 'ol', 'paragraph']],
    //         ['height', ['height']],
    //         ['table', ['table']],
    //        // ['insert', ['link', 'picture', 'hr']],
    //         ['view', ['fullscreen', 'codeview']],
    //         ['help', ['help']]
    //     ],
    //     height: 100,
    // });

</script>
<script type="text/javascript">
    $(document).ready(function(){
        
    $("#addeditwebinor").on('submit', function(e){
       e.preventDefault();
       var fdata = $("#addeditwebinor").serialize();
       var url = $('#url').val();
        //alert(url);
       $.ajax({
        url:url,
        data:fdata,
        type:"post",
        dataType:"json",
        beforeSend: function(){
          $("#loader").show();
        },
        success: function(str){
            //alert(str);
          console.log(str);
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
    function copyToClipboard(element){
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
    }
</script>