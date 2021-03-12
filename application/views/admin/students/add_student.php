
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
        <div class="block-header">
               <!--  <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">                        
                        <h2>Jquery Datatable</h2>
                    </div>            
                    <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                        <ul class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Table</li>
                            <li class="breadcrumb-item active">Jquery Datatable</li>
                        </ul>
                    </div>
                </div> -->
            </div>
    <div class="col-md-12">
                    <?php echo $this->session->flashdata('msg');?>
                    <div class="card">
                        <div class="header">
                            <div class="col-lg-9 pull-left">
                                <h2>Student Details</h2>
                            </div>
                            <a href="<?php echo base_url("admin/students");?>" class="col-lg-1 pull-right"><button class="btn btn-primary">Back</button></a>
                                   
                        </div>
                        <div class="body">
                            <div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
                            <form id="addeditstudent">
                                <input type="hidden" id="url" name="url" value="<?php echo base_url("admin/students/save_student/".$this->uri->segment(4));?>">
                                <input type="hidden" id="student_id" name="student_id" value="<?php echo $this->uri->segment(4);?>">

                            <!-- <form id="basic-form" method="post" action="<?php echo base_url("admin/students/save_student/".$this->uri->segment(4));?>" novalidate> -->
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Full name</label>
                                        <input type="text" class="form-control" name="name" value="<?php if(isset($student->student_name)){ echo $student->student_name;}?>" required>
                                    </div>
                                     
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" value="<?php if(isset($student->email)){ echo $student->email;}?>" required>
                                    </div>
                                   

                                </div>
                        
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control"  maxlength="10" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" name="phone" value="<?php if(isset($student->phone)){ echo $student->phone;}?>" required>
                                    </div>
                                    <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status" required="required">
                                        <option value="">Select Status</option>
                                        <option value="Active" <?php if(isset($student->status) && ($student->status=="Active")){ echo "selected";}?>>Active</option>
                                        <option value="Inactive" <?php if(isset($student->status) && ($student->status=="Inactive")){ echo "selected";}?>>Inactive</option>
                                    </select>
                                    </div>
                                </div>
                                <?php if(isset($student->password)){?>
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="text" class="form-control" name="password" value="<?php if(isset($student->password)){ echo $this->student_login_model->api_key_crypt($student->password,"d");}?>" required>
                                        <input type="hidden" class="form-control" name="old_password" value="<?php if(isset($student->password)){ echo $student->password;}?>" >
                                    </div>
                                </div>
                                <?php }?>
                                <div class="col-lg-6 pull-left">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea class="form-control" rows="5" cols="30" name="address" required><?php if(isset($student->address)){ echo $student->address;}?></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 pull-right">          
                                   <button type="submit" class="btn btn-primary pull-right"><?php if($this->uri->segment(4)){echo "Update Student";}else{ echo "Add Student";}?></button><br><br><br>
                                   <center><img src="<? echo base_url(); ?>assets/images/load.gif" width="42" height="42" alt="" style="display:none" id="loader"></center>
                                </div>
  
                            </form>
                        </div>
                    </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
  
    $("#addeditstudent").on('submit', function(e){
       e.preventDefault();
       var fdata = $("#addeditstudent").serialize();
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
</script>