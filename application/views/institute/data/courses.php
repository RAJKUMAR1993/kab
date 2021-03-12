
<style>
    td.details-control {
    background: url('<?php echo base_url(); ?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
    tr.shown td.details-control {
        background: url('<?php echo base_url(); ?>assets/images/details_close.png') no-repeat center center;
    }
	.ellipsis {
    max-width: 40px;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
}
</style>

<div id="main-content">
        <div class="container-fluid">
            
            <div class="row clearfix">
                
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
						<div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="col-md-10 pull-left">
                                <h2>Courses</h2>
                            </div>
							<div class="col-md-2 pull-right">
							
							<a href="<?php echo base_url("institute/data/add_edit_course");?>"><button type="button" class="btn btn-primary"  data-target="#addevent">Add Course</button></a>
								
							</div>                      
							</div>
                               
                        <div class="body">
						<hr>
                        <div class="table-responsive">
                            <table class="table-bordered table-striped table-hover dataTable js-exportable" width="100%">
                                <thead>
                                    <tr height="40px">
                                        <th>S.no</th>
                                        <th>Course Name</th>
                                        <th>Specialization</th>
                                        <th>Course Duration</th>
                                        <th>Course Info</th>
										<th>Course Fees</th>
                                        <th>Actions</th>                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($courses){
                                            $key=1;
                                            foreach($courses as $row):
                                        ?>
                                    <tr>
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $row->course_name;?></td>
                                        <td><?php echo $row->specialization;?></td>
                                        <td><?php echo $row->course_duration;?></td>
                                        <td style="white-space: break-spaces;"><?php echo $row->course_desc; ?></td>
										<td class="ellipsis"><?php echo $row->course_fees; ?></td>
                                         <td>
                                            <a href="<?php echo base_url("institute/data/add_edit_course/").$row->course_id ;?>" style="margin:0px 20px 0px 20px"><i class="fa fa-pencil"></i></a>
                                            <a href="#" name="<?php echo base_url("institute/data/delete_course/").$row->course_id ;?>" class="kabdelete" style="margin:0px 20px 0px 0px"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    <?php $key++; endforeach;}else{ echo "No records found";}?>
                                
                                </tbody>
                              
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </div>

<script>
$(document).ready(function(){
  $(".update_user_button").click(function () {
    $("#updateModal").modal();
    });
 });	
	$(document).ready(function(){
  
    $("#addeditinstitute").on('submit', function(e){
       e.preventDefault();
       var formData = new FormData(this);
       var url = $('#url').val();
       $.ajax({
        url:url,
        data:formData,
        type:"post",
        dataType:"json",
		cache:false,
                contentType: false,
                processData: false,
        beforeSend: function(){
          $("#loader").show();
        },
        success: function(str){
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
	
	$(document).ready(function(){
  
    $("#addeditinstitute_update").on('submit', function(e){
		//alert();
       e.preventDefault();
       var formData = new FormData(this);
       var url = $('#url2').val();
       $.ajax({
        url:url,
        data:formData,
        type:"post",
        dataType:"json",
		cache:false,
        contentType: false,
        processData: false,
        beforeSend: function(){
          $("#loader").show();
        },
        success: function(str){
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
	</script>