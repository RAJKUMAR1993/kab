
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
        <h2>Feedback</h2>
        </div>

        </div>
        <div class="col-md-2 pull-right">
        <!-- <button type="button" class="btn btn-primary folt-left " data-toggle="modal" data-target="#myModal">feedback history</button> -->
        </div>
        <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

        <!-- Modal content-->
        <form id="updatehostry">
        <div class="modal-content">
        <div class="alert alert-success" style="display:none" id="smsg"></div>
        <div class="alert alert-danger" style="display:none" id="emsg"></div>
        <div class="modal-header">

        <h6  style="font-weight:bold;text-align:center">Feedback History update</h6> 
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">    
        <!-- <input type="hidden" id="url" name="url" value="<?php echo base_url("admin/homepage/add_partner");?>"> -->
        <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Description *</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" name="feedback_description" value="<?php echo $feedback->feedback_question;?>" required>
        </div>
        </div>
        <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label" > Question *</label>
        <div class="col-sm-10">
        <input type="text" class="form-control year" name="feedback_question" value="<?php echo $feedback->feedback_description;?>" required>
        </div>
        </div>
        </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </div>
        </form>

        </div>
        </div>
        <div class="body">
        <div class="alert alert-success" style="display:none" id="smsg"></div>
        <div class="alert alert-danger" style="display:none" id="emsg"></div>
        <form id="updateAdminDetails">
        <!-- <form id="basic-form" method="post" action="<?php echo base_url("admin/settings/update")?>" novalidate> -->


        <div class="row">
        <div class="col-lg-6">
        <div class="form-group">
          <label>Feedback Description <span style="color: red;">*</span></label>
          <textarea class="form-control" name="feedback_description" required><?php echo $admin->feedback_description;?></textarea>
        </div>
        </div>
        <div class="col-lg-6">
        <div class="form-group">
          <label>Feedback Question <span style="color: red;">*</span></label>
          <textarea class="form-control" name="feedback_question" required><?php echo $admin->feedback_question;?></textarea>
        </div>
        <button type="submit" class="btn btn-primary pull-right">Update Details</button><br><br><br>
        </div>
        </div>
        <center>
        <img src="<? echo base_url(); ?>assets/images/load.gif" width="42" height="42" alt="" style="display:none" id="loader">
        </center>
        </form>
        </div>
        </div>
        <div class="card">
			<div class="body">
				<div class="table-responsive">
					<div class="header"><h2>Feedback History</h2></div>
					<table class="table table-bordered table-striped table-hover dataTable js-exportable">
						<thead>
							<tr>
								<th>S.no</th>
								<th>Feedback Question</th>
								<th>Feedback Description</th>
								<th>Update Date</th>


							</tr>
						</thead>
						<tbody>
							 <?php if($feedback){
								$key = 1;
								foreach($feedback as $row):
								?>
							<tr>
								<td><?php echo $key;?></td>
								<td><?php echo $row->feedback_question;?></td>
								<td><?php echo $row->feedback_description;?></td>
								<td><?php echo $row->updated_date;?></td>
							</tr>
								<?php $key++; endforeach;}else{ echo "No data found";}?>

						</tbody>
					</table>
				</div>
			</div>
		</div>
      </div>
  </div>

<script type="text/javascript">
    $(document).ready(function(){
    //Login Service
  
    $("#updateAdminDetails").on('submit', function(e){
       e.preventDefault();
       var fdata = $("#updateAdminDetails").serialize();
       var url = '<?php echo base_url("admin/settings/update_feedback") ?>';
        //alert(fdata);
       $.ajax({
        url:url,
        data:fdata,
        type:"post",
        dataType:"json",
        beforeSend: function(){
          $("#loader").show();
        },
        success: function(str){
          console.log(str);
          $("#loader").hide();
          if(str.Status == 'Active'){
            $("#smsg").show();
            $("#smsg").html(str.Message);
            setTimeout(function(){ $("#smsg").hide(); location.reload(); }, 500);
          }else{
            $("#emsg").show();
            $("#emsg").html(str.Message);
          }
        }
        });
    });
//Login Service Closed
    });

    $(document).ready(function(){
    //Login Service
    $("#updatehostry").on('submit', function(e){
       e.preventDefault();
       var fdata = $("#updatehostry").serialize();
       var url = '<?php echo base_url("admin/settings/update_feedback") ?>';
        //alert(fdata);
       $.ajax({
        url:url,
        data:fdata,
        type:"post",
        dataType:"json",
        beforeSend: function(){
          $("#loader").show();
        },
        success: function(str){
          console.log(str);
          $("#loader").hide();
          if(str.Status == 'Active'){
            $("#smsg").show();
            $("#smsg").html(str.Message);
            setTimeout(function(){ $("#smsg").hide(); location.reload(); }, 500);
          }else{
            $("#emsg").show();
            $("#emsg").html(str.Message);
          }
        }
        });
    });
//Login Service Closed
    });
</script>