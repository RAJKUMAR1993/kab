
<style>
    td.details-control {
    background: url('<?php echo base_url(); ?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
    tr.shown td.details-control {
        background: url('<?php echo base_url(); ?>assets/images/details_close.png') no-repeat center center;
    }
    .col-lg-9{
        padding-left: 4px;
    }
</style>

<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
           
           		<div class="header instituteHeader row">
					<div class="col-md-3 pull-left">
						<h2>Presentations </h2>
					</div>
					<div class="col-lg-9 col-md-9 col-sm-12 text-right">
						<ul class="breadcrumb justify-content-end" style="background-color: transparent">
							<li class="breadcrumb-item"><a href="<? echo base_url('admin/dashboard') ?>"><i class="icon-home"></i></a></li>
							<li class="breadcrumb-item active">Presentations</li>
						</ul>
					</div>                                                   
				</div>
           
            </div>
            <div class="row clearfix">
                
                <div class="col-lg-12">
                    <div class="card">
                               
                        <div class="body">
                        <form method="get" id="filtersve">
						<div class="row">
							
							<div class="col-md-4">
								
								<div class="form-group">
								<label>Auditorium</label>
									<select class="form-control filtersve" name="auditorium">
										<option value="">Select Auditorium</option>
										<? $institutes = $this->db->query("select tv.auditorium,ti.title from tbl_institute_presentations tv join tbl_institute_auditorium ti on tv.auditorium=ti.id group by tv.auditorium")->result();

											foreach($institutes as $ins){
												$insname = ($this->input->get("auditorium") == $ins->auditorium_id) ? 'selected' : '';
												echo '<option value="'.$ins->auditorium_id.'" '.$insname.'>'.$ins->title.'</option>';
											}				   
										?>

									</select>
								</div>
								
							</div>
							<div class="col-md-4">
								<div class="form-group">
								<label>Date</label>
									<select class="form-control filtersve" name="date">
										<option value="">Select Date</option>
										<? $dates = $this->db->query("select date from tbl_institute_presentations group by date")->result();

											foreach($dates as $d){
												$date = ($this->input->get("date") == $d->date) ? 'selected' : '';
												echo '<option value="'.$d->date.'" '.$date.'>'.date("d-m-Y",strtotime($d->date)).'</option>';
											}				   
										?>

									</select>
								</div>
								
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<a href="<? echo base_url('admin/auditorium/presentations') ?>" class="btn btn-primary" style="margin-top: 25px">Clear</a>
								</div>
								
							</div>
							</form>
						</div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
<!--									    <th></th>-->
                                        <th>Auditorium</th>
                                        <th>Institute Name</th>
                                        <th>Date</th>
                                        <th>From Time</th>
                                        <th>To Time</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Duration(In Minutes)</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($sessions){
                                            $key=1;
											$date = strtotime(date("Y-m-d H:i:s"));
                                            foreach($sessions as $row):
	
												$status = "";
												if($date > $row->to_time){
													
													$status = "Completed";
													
												}elseif(($date >= $row->from_time) && ($date <= $row->to_time)){
													
													$status = "To be completed";
													
												}else{
													
													$status = "Scheduled";
													
												}
                                        ?>
                                    <tr>
<!--									    <td>-->
                                           <? //if($row->status == "Inactive"){ ?>
<!--                                            <a href="javascript:void(0)" class="editSession" session_id="<? //echo $row->id ?>" style="margin:0px 20px 0px 20px"><i class="fa fa-pencil"></i></a>-->
                                           <? //} ?> 
<!--                                        </td>-->
                                        <td><?php echo $this->db->get_where("tbl_institute_auditorium",["id"=>$row->auditorium])->row()->title;?></td>
                                        <td><?php echo $this->db->get_where("tbl_institutes",["institute_id"=>$row->institute_id])->row()->institute_name;?></td>
                                        <td><?php echo date("d-m-Y",strtotime($row->date));?></td>
                                        <td><?php if(isset($row->from_time)){ echo date('H:i A', $row->from_time);}?></td>
                                        <td><?php if(isset($row->to_time)){ echo date('H:i A', $row->to_time);}?></td>
                                        <td><?php echo $row->title;?></td>
                                        <td><?php echo $status;?></td>
                                        <td><?php echo $row->duration;?></td>
                                        
                                    </tr>
                                    <?php $key++; endforeach;}
                                    //else{ echo "No records found";}
                                    ?>
                                
                                </tbody>
                              
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
    
 <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="display: block">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Auditorium</h4>
        <div id="smsg" class="alert alert-success" style="display: none"></div>
        <div id="emsg" class="alert alert-danger" style="display: none"></div>
      </div>
      <div class="modal-body">
       
       	<form method="post" id="adata">
			<div class="form">

				<select class="form-control" name="auditorium" required>
					
					<option value="">Select Auditorium</option>
					<? 
						$auditoriums = $this->db->get_where("tbl_institute_auditorium")->result(); 
						foreach($auditoriums as $aud){
					
					?>
					
						<option value="<? echo $aud->id ?>"><? echo $aud->title ?></option>
					
					<? } ?>
					
				</select>
				
				<input type="hidden" id="session_id" name="session_id">
	
			</div>
     	
     
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>

  </div>
</div>

<script>

	$(".filtersve").change(function(){

		$("#filtersve").submit();

	})
	 
	$(".editSession").click(function(){
		
		$("#session_id").val($(this).attr("session_id"))
		$("#myModal").modal("show");
		
	})
	
	$("#adata").on('submit', function(e){
       e.preventDefault();
       var fdata = $("#adata").serialize();
       var url = '<?php echo base_url("admin/auditorium/updateSession")?>';
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
        },
		   error : function(data){
			   console.log(data)
		   }
        });
    });


</script>
