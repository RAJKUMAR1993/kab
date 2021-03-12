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
    <div class="container-fluid">

        <div class="row clearfix">

            <div class="col-lg-12">
                <div class="card">
                    <div class="header">

                        <div class="col-md-10 pull-left">
                            <h2>Testimonials</h2>
                        </div>
                        <div class="col-md-2 pull-right">
                            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal"
                                data-target="#myModal">Add Testimonials</button>

                        </div>
                    </div>
                    <?php if($this->session->flashdata('errors')){ ?>
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>error!</strong> <?php echo $this->session->flashdata('errors'); ?>
                    </div>

                    <?php } else if($this->session->flashdata('success')){  ?>

                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>success!</strong> <?php echo $this->session->flashdata('success'); ?>
                    </div>

                    <?php }  ?>
                    <div class="body">
                        <hr>
                        <div class="table-responsive">
                            <table id="status" class="table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th height="30px" width="30px"></th>
                                        <th height="30px">S.no</th>
                                        <th height="30px" width="200px">Student Name</th>
                                        <th height="30px" width="150px">Student Image</th>
                                        <th height="30px" width="200px">Student Qualification</th>
                                        <th height="30px">Testimonials Info</th>
                                        <th height="30px">Status</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($testimonials){
                                            $key=1;
                                            foreach($testimonials as $row):
                                        ?>
                                    <tr>
                                        <td align="center">
                                            <a href="#" class="update_user_button"
                                                student_name="<?php echo $row->student_name;  ?>"
                                                student_status="<?php echo $row->status;  ?>"
                                                student_msg="<?php echo $row->student_msg;  ?>"
                                                student_quali="<?php echo $row->student_quali;  ?>"
                                                student_image="<?php echo $row->student_image;  ?>"
                                                tid="<?php echo $row->test_id ; ?>"><i class="fa fa-pencil"></i></a>
                                            <a href="#"
                                                name="<?php echo base_url("admin/homepage/delete_test/").$row->test_id ;?>"
                                                class="kabdelete" style="margin:0px 20px 0px 0px"><i
                                                    class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        </td>
                                        <td align="center">
                                            <?php echo $key;?>
                                        </td>
                                        <td align="center"><?php echo $row->student_name;?></td>
                                        <td align="center"><img
                                                src="<?php echo base_url("assets/images/testimonials/").$row->student_image; ?>"
                                                width="100px" height="100px"></td>
                                        <td><?php echo $row->student_quali;?></td>
                                        <td><?php echo $row->student_msg;?></td>
                                        <td>
                                            <?php if($row->status=="Active"){ ?>
                                            <div class="switch">
                                                <input type="checkbox" data-on-color="info"
                                                    nav_id="<?php echo $row->test_id ?>" name="switch"
                                                    data-off-color="success" class="check" checked>
                                            </div>
                                            <?php  }elseif($row->status=="Inactive"){ ?>
                                            <div class="switch">
                                                <input type="checkbox" nav_id="<?php echo $row->test_id ?>"
                                                    data-on-color="info" name="switch" data-off-color="success"
                                                    class="check">
                                                <?php } ?>
                                            </div>
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
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <form id="addeditinstitute">
                    <div class="modal-content">
                        <div class="alert alert-success" style="display:none" id="smsg"></div>
                        <div class="alert alert-danger" style="display:none" id="emsg"></div>
                        <div class="modal-header">

                            <h6 style="font-weight:bold;text-align:center">Add Testimonials</h6>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="url" name="url"
                                value="<?php echo base_url("admin/homepage/add_test");?>">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Student Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="student_name" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Student Image</label>
                                <div class="col-sm-10">
                                    <input type="file" accept="image/jpeg" class="form-control" name="picture" required>
                                    <small style="color: red">Note: Please upload 150*150px Image</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label"> Testimonials Status</label>
                                <div class="col-sm-10">
                                    <select class="form-control student_status" rows="5" cols="30" name="student_status"
                                        required>
                                        <option value="">Status</option>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Student Message</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="5" name="student_msg" required></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Student Qualification</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="student_quali" required>
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
        <div class="modal fade" id="updateModal" role="dialog">
            <div class="modal-dialog">
                <form id="addeditinstitute_update">
                    <div class="modal-content">
                        <div class="alert alert-success" style="display:none" id="smsg"></div>
                        <div class="alert alert-danger" style="display:none" id="emsg"></div>
                        <div class="modal-header">

                            <h6 class="modal-title">Update Testimonials</h6>

                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">

                            <input type="hidden" id="url2" name="url"
                                value="<?php echo base_url("admin/homepage/add_test");?>">
                            <input type="hidden" class="tid" name="tid">
                            <input type="hidden" class="test_image" name="test_image">


                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Student Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control student_name" name="student_name" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Student Image</label>
                                <div class="col-sm-10">
                                    <input type="file" accept="image/jpeg" class="form-control student_image"
                                        name="picture" required>
                                    <small style="color: red">Note: Please upload 150*150px Image</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label"> Testimonials Status</label>
                                <div class="col-sm-10">
                                    <select class="form-control student_status" rows="5" cols="30" name="student_status"
                                        required>
                                        <option value="">Status</option>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Student Message</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control student_msg" rows="5" name="student_msg"
                                        required></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Student Qualification</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control student_quali" name="student_quali" required>
                                </div>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
            <!--.modal-dialog-->
        </div>
        <!--.modal-->

    </div>
</div>
<script>
$(document).ready(function() {
    $(".update_user_button").click(function() {
        $('.student_image').val('');
        var image = $(this).attr('student_image');
        if (image != "" && typeof image != "undefined") {
            $('.student_image').removeAttr("required");
        } else {
            $('.student_image').attr("required");
        }
        $(".student_name").val($(this).attr('student_name'));
        $(".student_msg").val($(this).attr('student_msg'));
        $(".student_quali").val($(this).attr('student_quali'));
        $(".student_status").val($(this).attr('student_status'));
        $(".tid").val($(this).attr('tid'));
        $("#updateModal").modal();
    });
});
$(document).ready(function() {

    $("#addeditinstitute").on('submit', function(e) {
        
        e.preventDefault();
        var formData = new FormData(this);
        var url = $('#url').val();
        $.ajax({
            url: url,
            data: formData,
            type: "post",
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("#loader").show();
            },
            success: function(str) {
                console.log(str);
                $("#loader").hide();
                if (str.Status == 'Active') {
                    $("#smsg").show();
                    $("#smsg").html(str.Message);
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    $("#emsg").show();
                    $("#emsg").html(str.Message);
                }
            }
        });
    });

});

$(document).ready(function() {
    $("#addeditinstitute_update").on('submit', function(e) {
        
        e.preventDefault();
        var formData = new FormData(this);
        var url = $('#url2').val();
        $.ajax({
            url: url,
            data: formData,
            type: "post",
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("#loader").show();
            },
            success: function(str) {
                console.log(str);
                $("#loader").hide();
                if (str.Status == 'Active') {
                    $("#smsg").show();
                    $("#smsg").html(str.Message);
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    $("#emsg").show();
                    $("#emsg").html(str.Message);
                }
            }
        });
    });

});
</script>
<script>
    $("input[type='checkbox']").bootstrapSwitch({size : 'mini'});
    
</script>
<script>


    $('#status').on('switchChange.bootstrapSwitch', 'input[name="switch"]', function(e, state) {
      
        var nav_id = $(this).attr("nav_id");
        var status;

        if ($(this).is(":checked")) {
            status = "Active";
        } else {
            status = "Inactive";
        }
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>admin/homepage/testimonials_status",
            data: {
                id: nav_id,
                status: status
            },
            success: function(data) {
                location.reload(true);
            }

        });
    });

</script>