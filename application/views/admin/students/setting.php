
    <div id="main-content">

        <div class="container-fluid">

            <div class="block-header">
              

            </div>
              <div class="row"> 
                <div class="col-md-12">
                <a class="pull-right" href="<?php echo base_url('admin/students');?>" style="font-size: 18px; margin-left:10px;"><u>Back</u></a> 
                </div>
              </div>
            <div class="row clearfix">

              <?php echo $this->session->flashdata('msg');?>
                <div class="col-md-12">

                    <div class="row">
                        <div class="card">
                            <div class="card-header" style="background-color: #343a40; color:white; padding-bottom: 0.25rem;">
                                <h6 class="card-title">Courses</h6>

                            </div>


                            <div class="card-body">        
                                <div class="pull-right">
                                    <a href="#defaultModal" data-toggle="modal" data-target="#defaultModal"><i class="fa fa-plus"></i> Add Course to this client</a>

                                </div><br><br>
                                 <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                              <tr>
                                                  <th width="10%">S.no</th>
                                                  <th>Course</th>
                                                  <th>No of users</th>
                                                  <!-- <th>Instructions</th> -->
                                                  
                                                  <th>Status</th>
                                                  <th>Actions</th>
                                                <!--   <th>Amount</th>
                                                  <th>Actions</th> -->
                                                  
                                              </tr>
                                            </thead>
                                          <tbody>
                                                 <?php if($client_courses){
                                                      $key=1;
                                                      foreach($client_courses as $row):
                                                  ?>
                                              <tr>
                                                  <td><?php echo $key;?></td>
                                                  <td><?php echo $this->course_model->get_course_id($row->course_id)->course_title;?></td>
                                                  <td><?php echo $row->no_users;?></td>                                      
                                                  <td><?php echo $row->status;?></td>
                                                  <td>
                                                    <!-- <a href="<?php echo base_url("admin/course/add_course/").$row->course_id;?>" style="margin:0px 10px 0px 15px"><i class="fa fa-pencil"></i></a> -->
                                                    <a href="javascript:" style="margin:0px 15px 0px 3px" class="">
                                                            <i class="fa fa-pencil ec_edit" course_id="<?php echo $row->course_id;?>" client_id ="<?php echo $row->client_id;?>" nou ="<?php echo $row->no_users;?>" status ="<?php echo $row->status;?>" row_id ="<?php echo $row->id;?>"></i>
                                                      </a>

                                           
                                                     <a href="#" name="<?php echo base_url("admin/clients/delete_client_course/".$row->id);?>" class="course_delete" style="margin:0px 20px 0px 10px"><i class="fa fa-trash-o " aria-hidden="true"></i></a>

                                                     <!-- <a href="#" class="re_email" course_id="<?php echo $row->course_id;?>" client_id ="<?php echo $row->client_id;?>">
                                                       <i class="fa fa-paper-plane" aria-hidden="true"> Send email</i>
                                                     </a> -->

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



<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">Add Course to this user</h4>
            </div>
            <form id="basic-form" method="POST" action="<?php echo base_url('admin/clients/save_client_course');?>">
            <div class="modal-body">

                <div class="col-md-8">
                     <div class="form-group">
                        <label>Course Name</label>
                            <select class="form-control" id="course_id" name="course_id" required>  
                           <option value="">Choose Course</option>
                               <?php 
                                    if(isset($course)){
                                      foreach($course as $row){
                                         echo  "<option value=".$row->course_id.">".$row->course_title."</option>";  } 
                                      }
                                ?>
                            </select>
                     </div> 
                </div>

                <div class="col-md-8">
                     <div class="form-group">
                        <label>No of users</label>
                            <input type="number" class="form-control nou" name="no_users" min="1" required>  
                     </div> 
                </div>

                <div class="col-md-8">
                     <div class="form-group">
                        <label>Status</label>
                             <select class="form-control" id="c_status" name="status" required>  
                                <option value="">Choose Course</option>
                                <!--  <?php echo  '<option value=""></option>';?> -->
                                 <option value="Active">Active</option>
                                 <option value="Inactive">Inactive</option>
                            </select> 
                     </div> 
                </div>
            </div>
            <input type="hidden" name="client_id" id="client_id" value="<?php echo $this->uri->segment(4);?>">
            <input type="hidden" name="row_id" id="row_id" value="">
    
            <div class="modal-footer">
                <button type="Submit" class="btn btn-primary modal_btn">Add Course</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(".ec_edit").on("click",function(){
        var course_id = $(this).attr('course_id');
        var client_id = $(this).attr('client_id');
        var nou = $(this).attr('nou');
        var status = $(this).attr('status');
          var row_id = $(this).attr('row_id');
        //alert( course_id + " "+ client_id+" "+nou+" "+status);
        $("#course_id").val(course_id);
        $(".nou").val(nou);
        $("#c_status").val(status);
        $("#client_id").val(client_id);
        $("#row_id").val(row_id);
        $(".modal_btn").html('Update');

        $("#defaultModal").modal('show');
    });
</script>

<script type="text/javascript">
  $(".re_email").on("click",function(){

      var course_id = $(this).attr('course_id');
        var client_id = $(this).attr('client_id');

        $.ajax({
          type:"POST",
          url:"<?php echo base_url()?>admin/clients/resend_email",
          data:{course_id:course_id,client_id:client_id},
          success:function(d){
            console.log(d);
            //window.location.reload();
            window.location.href= "<?php echo base_url() ?>admin/clients/course/"+client_id;
          }
        });

  });
</script>