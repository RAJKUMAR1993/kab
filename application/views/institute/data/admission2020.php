
<style>
    td.details-control {
    background: url('<?php echo base_url(); ?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
    }
    tr.shown td.details-control {
        background: url('<?php echo base_url(); ?>assets/images/details_close.png') no-repeat center center;
    }
    .col-md-6 {
        max-width: 90%;
    }
	
.myProgress {
  width: 100%;
  background-color: #ddd;
}

.myBar {
  width: 1%;
  height: 30px;
  background-color: #4CAF50;
	position: relative;
}
	.percent{
		position: absolute;
		top: 50%;
		left: 50%;
		color: white;
		font-weight: 700;
		transform: translate(-50%, -50%);
	}
</style>

<script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@1.10.100/build/pdf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@1.10.100/build/pdf.worker.min.js"></script>

<div id="main-content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-md-12">
                <?php echo $this->session->flashdata('msg');?>
                <div class="card">
                    <div class="header webinarHeader1">
                        <div class="col-lg-9 pull-left">
                            <h2>Admission 2020 Details</h2>
                        </div>  
                    </div>
                    <div class="body">
                        <div class="alert alert-success" style="display:none" id="smsg"></div>
                        <div class="alert alert-danger" style="display:none" id="emsg"></div>
                        <form id="addeditwebinor">
                            <input type="hidden" id="url" name="url" value="<?php echo base_url("institute/data/save_admission2020");?>">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <h6><b>Basic Details</b></h6>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-6">
                                        <label>About Institute</label>
                                        <textarea class="form-control summernote" name="aboutinst" ><?php if(isset($institute->aboutinst)){ echo $institute->aboutinst;}?></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Important Note</label>
                                            <textarea class="form-control summernote" name="impnote" ><?php if(isset($institute->impnote)){ echo $institute->impnote;}?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-6">
                                        <div class="form-group"> 
                                            <label>Institute Offering</label>
                                            <textarea class="form-control summernote" name="instoffr" ><?php if(isset($institute->instoffr)){ echo $institute->instoffr;}?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group"> 
                                            <label>Merit Scholarships Details</label>
                                            <textarea class="form-control summernote" name="meritscolar" ><?php if(isset($institute->meritscolar)){ echo $institute->meritscolar;}?></textarea>
                                       </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 pull-right">                                    
                                <button type="submit" class="btn btn-primary pull-right">Update</button><br><br><br>
                                <center><img src="<? echo base_url(); ?>assets/images/load.gif" width="42" height="42" alt="" style="display:none" id="loader"></center>
                            </div>
                        </form>
                    </div>

                   
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                        <section id="lessons">
                            <div id="accordion_lessons" role="tablist" class="add_bottom_45">
                                <div class="card" style="margin-bottom: 10px">
                                    <div class="card-header" role="tab" id="heading_achievements">
                                        <h5 class="mb-0">
                                            <a data-toggle="collapse" href="#collapse_achievements" aria-expanded="true" aria-controls="collapse_achievements"><i class="indicator ti-minus"></i>Achievements</a>
                                        </h5>
                                    </div>

                                    <div id="collapse_achievements" class="collapse" role="tabpanel" aria-labelledby="heading_brouchers">
                                        <div class="card-body">
                                            <div class="row clearfix">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="header">
                                                            <div class="col-lg-9 pull-left">
                                                                <h2>Achievements </h2>
                                                            </div>
                                                            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal3">Add Achievement</button> <br>               
                                                        </div> 
                                                        <div class="body">
                                                            <div class="table-responsive">
                                                                <table class="table-bordered table-striped table-hover dataTable js-exportable" style="width: 100%">
                                                                    <thead>
                                                                        <tr height="40px">
                                                                            <th>S.no</th>
                                                                            <th>Title</th>
                                                                            <th>Description</th>
                                                                            <th>Status</th>
                                                                            <th>Actions</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php if($achievement){
                                                                                $key=1;
                                                                                foreach($achievement as $row):
                                                                            ?>
                                                                        <tr>
                                                                            <td><?php echo $key;?></td>
                                                                            <td><?php echo $row->title;?></td>
                                                                            <td><?php echo $row->description;?></td>
                                                                            <td><?php echo $row->status;?></td>
                                                                             <td>
                                                                                <a href="#" class="update_achi_button" ach_title="<?php echo $row->title;  ?>" ach_status="<?php echo $row->status;  ?>" ach_description='<?php echo $row->description;  ?>' aid="<?php echo $row->achievement_id ; ?>" ><i class="fa fa-pencil"></i></a>
                                                                                <a href="#" name="<?php echo base_url("institute/data/delete_achievement/").$row->achievement_id;?>" class="kabdelete" style="margin:0px 20px 0px 0px"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                                            </td>
                                                                        </tr>
                                                                        <?php $key++; endforeach;}?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="myModal3" class="modal fade" role="dialog">
                                              <div class="modal-dialog">
                                                <form id="addeditachievement">
                                                    <div class="modal-content">
                                                        <div class="alert alert-success" style="display:none" id="smsg"></div>
                                                        <div class="alert alert-danger" style="display:none" id="emsg"></div>
                                                        <div class="modal-header">
                                                            <h6  style="font-weight:bold;text-align:center" class="ach_heading">Add Achievement</h6>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">    
                                                            <input type="hidden" id="url5" name="url" value="<?php echo base_url("institute/data/saveachievement");?>">
                                                            <input type="hidden" class="aid_val" name="achievement_id">
                                                            <div class="form-group">
                                                                <label>Title</label>
                                                                <input type="text" class="form-control ach_title" name="title">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Description</label>
                                                                <textarea class="form-control summernote ach_description" name="description"  rows="5" cols="30" required></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Status</label>
                                                                <select class="form-control ach_status" name="status" required>
                                                                    <option value="">Select Status</option>
                                                                    <option value="Active">Active</option>
                                                                    <option value="Inactive">Inactive</option>
                                                                </select>
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
                                        </div>
                                    </div>
                                </div> 
                                <div class="card" style="margin-bottom: 10px">
                                    <div class="card-header" role="tab" id="heading_brouchers">
                                        <h5 class="mb-0">
                                            <a data-toggle="collapse" href="#collapse_brouchers" aria-expanded="true" aria-controls="collapse_brouchers"><i class="indicator ti-minus"></i>Brouchers</a>
                                        </h5>
                                    </div>

                                    <div id="collapse_brouchers" class="collapse" role="tabpanel" aria-labelledby="heading_brouchers">
                                        <div class="card-body">
                                            <div class="row clearfix">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="header">
                                                            <div class="col-md-10 pull-left">
                                                                <h2>Brochures</h2>
                                                            </div>
                                                            <div class="col-md-2 pull-right">
                                                                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Add Brochure</button>
                                                            </div>                      
                                                        </div>
                                                               
                                                        <div class="body">
                                                            <hr>
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>S.no</th>
                                                                            <th>Brochure Name</th>
                                                                            <th>File</th>
                                                                            <th>Actions</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php if($brouchers){
                                                                                $key=1;
                                                                                foreach($brouchers as $row):
                                                                            ?>
                                                                        <tr>
                                                                            <td><?php echo $key;?></td>
                                                                            <td><?php echo $row->broucher_name;?></td>
                                                                            <td><a href="<?php echo base_url("assets/images/brochure/").$row->broucher ;?>" target="_blank" style="text-decoration:underline;">View</td>
                                                                             <td>
                                                                                <a href="#" class="update_user_button" brochure_name="<?php echo $row->broucher_name;  ?>" bid="<?php echo $row->broucher_id ; ?>" ><i class="fa fa-pencil"></i></a>
                                                                                <a href="#" name="<?php echo base_url("institute/data/delete_brochure/").$row->broucher_id ;?>" class="kabdelete" style="margin:0px 20px 0px 0px"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                                            </td>
                                                                        </tr>
                                                                        <?php $key++; endforeach;}
                                                                        ?>
                                                                    </tbody>
                                                                  
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="myModal" class="modal fade" role="dialog">
                                              <div class="modal-dialog">
                                                <form id="addeditinstitute">
                                                    <div class="modal-content">
                                                        <div class="alert alert-success" style="display:none" id="basmsg"></div>
                                                        <div class="alert alert-danger" style="display:none" id="baemsg"></div>
                                                        <div class="modal-header">
                                                            <h6  style="font-weight:bold;text-align:center">Add Brochure</h6>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">    
                                                            <input type="hidden" id="url1" name="url" value="<?php echo base_url("institute/data/add_brochure");?>">
                                                            <div class="form-group">
                                                                <label for="inputEmail3" class="col-form-label">Brochure Name</label><br>
                                                                <input type="text" class="form-control"  name="brochure_name" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputPassword3" class="col-form-label">Brochure</label>
                                                                <input type="file" class="form-control pdfselect" id="banneraddpdf" output="banneraddthumbnail" name="picture" accept="application/pdf" required>
<!--                                                                <small style="color: red">Note : Maximum File size of pdf should be less than 1MB</small>-->
                                                            </div>
                                                            <!--<div class="form-group">
                                                                <label for="inputPassword3" class="col-form-label">Thumbnail Image</label>
                                                                <input type="file" class="form-control"  name="image" required>
                                                                <small style="color: red">Note : Maximum File size of image should be less than 1MB</small>
                                                            </div>-->                                                
                                                        </div>
                                                        <div class="modal-footer">
                                                           <input type="hidden" name="thumbnail" id="banneraddthumbnail">
                                                           <div class="myProgress" style="display: none">
															  <div class="myBar"><div class="percent">0%</div ></div>
															  
															</div>
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
                                                            <div class="alert alert-success" style="display:none" id="sumsg"></div>
                                                            <div class="alert alert-danger" style="display:none" id="eumsg"></div>
                                                            <div class="modal-header">
                                                                <h6 class="modal-title">Update Brochure</h6>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="hidden" id="url2" name="url" value="<?php echo base_url("institute/data/update_brochure");?>">
                                                                <input type="hidden" class="bid_val" name="bid">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="col-form-label">Brochure Name</label>
                                                                    <input type="text" class="form-control br_name_val"  name="brochure_name" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputPassword3" class="col-form-label">Brochure</label>
                                                                    <input type="file" class="form-control pdfselect" id="bannerupdatepdf" output="bannerupdatethumbnail"  name="picture" accept="application/pdf">
<!--                                                                    <small style="color: red">Note : Maximum File size of pdf should be less than 1MB</small>-->
                                                                </div>              
                                                                <!--<div class="form-group">
                                                                    <label for="inputPassword3" class="col-form-label">Thumbnail Image</label>
                                                                    <input type="file" class="form-control"  name="image">
                                                                    <small style="color: red">Note : Maximum File size of image should be less than 1MB</small>
                                                                </div>-->                     
                                                            </div>
                                                            <div class="modal-footer">
                                                              	<input type="hidden" name="thumbnail" id="bannerupdatethumbnail">
                                                               	<div class="myProgress" style="display: none">
																  <div class="myBar"><div class="percent">0%</div ></div>
																</div>
                                                                <button type="submit" class="btn btn-primary">Update</button>
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div><!--.modal-dialog-->
                                            </div><!--.modal-->
                                        </div>
                                    </div>
                                </div>  
                                <div class="card" style="margin-bottom: 10px">
                                    <div class="card-header" role="tab" id="heading_ppts">
                                        <h5 class="mb-0">
                                            <a data-toggle="collapse" href="#collapse_ppts" aria-expanded="true" aria-controls="collapse_ppts"><i class="indicator ti-minus"></i>PPTS</a>
                                        </h5>
                                    </div>

                                    <div id="collapse_ppts" class="collapse" role="tabpanel" aria-labelledby="heading_ppts">
                                        <div class="card-body">
                                            <div class="row clearfix">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="header">
                                                            <div class="col-md-10 pull-left">
                                                                <h2>PPTs</h2>
                                                            </div>
                                                            <div class="col-md-2 pull-right">
                                                                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal1">Add PPT</button>
                                                            </div>                      
                                                        </div>
                                                        <div class="body">
                                                            <hr>
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>S.no</th>
                                                                            <th>PPT Name</th>
                                                                            <th>File</th>
                                                                            <th>Actions</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php if($ppts){
                                                                                $key=1;
                                                                                foreach($ppts as $row):
                                                                            ?>
                                                                        <tr>
                                                                            <td><?php echo $key;?></td>
                                                                            <td><?php echo $row->broucher_name;?></td>
                                                                            <td><a href="<?php echo base_url("assets/images/brochure/").$row->broucher ;?>" target="_blank" style="text-decoration:underline;">View</td>
                                                                             <td>
                                                                                <a href="#" class="update_user_button1" brochure_name="<?php echo $row->broucher_name;  ?>" bid="<?php echo $row->broucher_id ; ?>" ><i class="fa fa-pencil"></i></a>
                                                                                <a href="#" name="<?php echo base_url("institute/data/delete_ppt/").$row->broucher_id ;?>" class="kabdelete" style="margin:0px 20px 0px 0px"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                                            </td>
                                                                        </tr>
                                                                        <?php $key++; endforeach;}?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="myModal1" class="modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <form id="addeditinstitute1">
                                                        <div class="modal-content">
                                                            <div class="alert alert-success" style="display:none" id="pasmsg"></div>
                                                            <div class="alert alert-danger" style="display:none" id="paemsg"></div>
                                                            <div class="modal-header">
                                                                <h6  style="font-weight:bold;text-align:center">Add PPT</h6>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">    
                                                                <input type="hidden" id="url3" name="url" value="<?php echo base_url("institute/data/add_ppt");?>">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="col-form-label">PPT Name</label>
                                                                    <input type="text" class="form-control"  name="brochure_name" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputPassword3" class="col-form-label">PPT</label>
                                                                    <input type="file" class="form-control"  name="picture" accept=".pptx" required>
<!--                                                                    <small style="color: red">Note : Maximum File size of ppt should be less than 1MB</small>-->
                                                                </div>
                                                                <!--<div class="form-group">
                                                                    <label for="inputPassword3" class="col-form-label">Thumbnail Image</label>
                                                                    <input type="file" class="form-control"  name="image" required>
                                                                    <small style="color: red">Note : Maximum File size of image should be less than 1MB</small>
                                                                </div> -->                  
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="myProgress" style="display: none">
																  <div class="myBar"><div class="percent">0%</div ></div>
																</div>
                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </form>

                                                  </div>
                                            </div>
                                            <div class="modal fade" id="updateModal1" role="dialog">
                                                <div class="modal-dialog">
                                                    <form id="addeditinstitute_update1">
                                                        <div class="modal-content">
                                                            <div class="alert alert-success" style="display:none" id="psumsg"></div>
                                                            <div class="alert alert-danger" style="display:none" id="peumsg"></div>
                                                            <div class="modal-header">
                                                                <h6 class="modal-title">Update PPT</h6>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="hidden" id="url4" name="url" value="<?php echo base_url("institute/data/update_ppt");?>">
                                                                <input type="hidden" class="bid_val1" name="bid">
                                                                <div class="form-group">
                                                                    <label for="inputEmail3" class="col-form-label">PPT Name</label>
                                                                    <input type="text" class="form-control br_name_val1"  name="brochure_name" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputPassword3" class="col-form-label">PPT</label>
                                                                    <input type="file" class="form-control"  name="picture" accept=".pptx">
<!--                                                                    <small style="color: red">Note : Maximum File size of ppt should be less than 1MB</small>-->
                                                                </div>                
                                                                <!--<div class="form-group">
                                                                    <label for="inputPassword3" class="col-form-label">Thumbnail Image</label>
                                                                    <input type="file" class="form-control"  name="image">
                                                                    <small style="color: red">Note : Maximum File size of image should be less than 1MB</small>
                                                                </div>-->                                        
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="myProgress" style="display: none">
																  <div class="myBar"><div class="percent">0%</div ></div>
																</div>
                                                                <button type="submit" class="btn btn-primary">Update</button>
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div><!--.modal-dialog-->
                                            </div><!--.modal-->
                                        </div>
                                    </div>
                                </div>                                                                
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<canvas id="the-canvas" style="border:1px solid black;display: none"></canvas>

<script type="text/javascript">
$(document).ready(function(){
    $('.summernote').summernote({
        toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'italic', 'underline', 'clear']],
        ['fontname', ['fontname']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
        ['table', ['table']],
       // ['insert', ['link', 'picture', 'hr']],
        ['view', ['fullscreen', 'codeview']],
        ['help', ['help']]
      ],
      height: 100,
    });
    $(".update_user_button").click(function () {
        $(".br_name_val").val($(this).attr('brochure_name'));
        $(".bid_val").val($(this).attr('bid'));
        $("#updateModal").modal();
    });
    $(".update_user_button1").click(function () {
        $(".br_name_val1").val($(this).attr('brochure_name'));
        $(".bid_val1").val($(this).attr('bid'));
        $("#updateModal1").modal();
    });
    $(".update_achi_button").click(function () {
        $(".aid_val").val($(this).attr('aid'));
        $(".ach_title").val($(this).attr('ach_title'));
        $('.ach_status option[value='+$(this).attr('ach_status')+']').attr("selected", "selected");
        $(".ach_description").summernote('code',$(this).attr('ach_description'));

        $("#myModal3").modal();
    });
    $("#addeditwebinor").on('submit', function(e){
       e.preventDefault();
       var fdata = new FormData(this);
       var url = $('#url').val();
       $.ajax({
        url:url,
        data:fdata,
        type:"post",
        dataType:"json",
        cache:false,
        contentType: false,
        processData: false,
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
    $("#addeditinstitute").on('submit', function(e){
		
	   $(".myProgress").hide();
       e.preventDefault();
       var formData = new FormData(this);
       var url = $('#url1').val();
		
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
          	$(".myProgress").show();
        }, 
			  
		xhr: function(){
		   var xhr = new window.XMLHttpRequest();
			 // Handle progress
			 //Upload progress
		   xhr.upload.addEventListener("progress", function(evt){
			   if (evt.lengthComputable) {
				  var percentComplete = evt.loaded / evt.total;
				  //Do something with upload progress
				   $(".myBar").css("width", Math.round(percentComplete*100)+"%");
				   $(".percent").html(Math.round(percentComplete*100)+" %");
				    
				  console.log(Math.round(percentComplete*100));
			   }
		   }, false);
		   //Download progress
		   /*xhr.addEventListener("progress", function(evt){
				if (evt.lengthComputable) {
				  var percentComplete = evt.loaded / evt.total;
				  //Do something with download progress
//				  console.log(percentComplete);
				}
		   }, false);*/

		   return xhr;
		},	  
        success: function(str){
          console.log(str);
          $("#loader").hide();
          if(str.Status == 'Active'){
            $("#basmsg").show();
            $("#basmsg").html(str.Message);
            setTimeout(function(){ location.reload(); }, 1500);  
          }else{
            $("#baemsg").show();
            $("#baemsg").html(str.Message);
          }
        },
		   error :function(data){
			   console.log(data)
		   }
		   
        });
    });
    $("#addeditinstitute_update").on('submit', function(e){
		$(".myProgress").hide();
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
		  $(".myProgress").show();	
        },
		xhr: function(){
		   var xhr = new window.XMLHttpRequest();
			 // Handle progress
			 //Upload progress
		   xhr.upload.addEventListener("progress", function(evt){
			   if (evt.lengthComputable) {
				  var percentComplete = evt.loaded / evt.total;
				  //Do something with upload progress
				   $(".myBar").css("width", Math.round(percentComplete*100)+"%");
				   $(".percent").html(Math.round(percentComplete*100)+" %");
				    
				  console.log(Math.round(percentComplete*100));
			   }
		   }, false);
		   //Download progress
		   /*xhr.addEventListener("progress", function(evt){
				if (evt.lengthComputable) {
				  var percentComplete = evt.loaded / evt.total;
				  //Do something with download progress
//				  console.log(percentComplete);
				}
		   }, false);*/

		   return xhr;
		},   
        success: function(str){
          console.log(str);
          $("#loader").hide();
          if(str.Status == 'Active'){
            $("#sumsg").show();
            $("#sumsg").html(str.Message);
            setTimeout(function(){ location.reload(); }, 1500);  
          }else{
            $("#eumsg").show();
            $("#eumsg").html(str.Message);
          }
        }
        });
    });
    $("#addeditinstitute1").on('submit', function(e){
		$(".myProgress").hide();
        //alert();
       e.preventDefault();
       var formData = new FormData(this);
       var url = $('#url3').val();
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
		  $(".myProgress").show();	
        },
		xhr: function(){
		   var xhr = new window.XMLHttpRequest();
			 // Handle progress
			 //Upload progress
		   xhr.upload.addEventListener("progress", function(evt){
			   if (evt.lengthComputable) {
				  var percentComplete = evt.loaded / evt.total;
				  //Do something with upload progress
				   $(".myBar").css("width", Math.round(percentComplete*100)+"%");
				   $(".percent").html(Math.round(percentComplete*100)+" %");
				    
				  console.log(Math.round(percentComplete*100));
			   }
		   }, false);
		   //Download progress
		   /*xhr.addEventListener("progress", function(evt){
				if (evt.lengthComputable) {
				  var percentComplete = evt.loaded / evt.total;
				  //Do something with download progress
//				  console.log(percentComplete);
				}
		   }, false);*/

		   return xhr;
		},	   
        success: function(str){
          console.log(str);
          $("#loader").hide();
          if(str.Status == 'Active'){
            $("#pasmsg").show();
            $("#pasmsg").html(str.Message);
            setTimeout(function(){ location.reload(); }, 1500);  
          }else{
            $("#paemsg").show();
            $("#paemsg").html(str.Message);
          }
        }
        });
    });
    $("#addeditinstitute_update1").on('submit', function(e){
		$(".myProgress").hide();
        //alert();
       e.preventDefault();
       var formData = new FormData(this);
       var url = $('#url4').val();
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
		  $(".myProgress").show();		 
        },
		xhr: function(){
		   var xhr = new window.XMLHttpRequest();
			 // Handle progress
			 //Upload progress
		   xhr.upload.addEventListener("progress", function(evt){
			   if (evt.lengthComputable) {
				  var percentComplete = evt.loaded / evt.total;
				  //Do something with upload progress
				   $(".myBar").css("width", Math.round(percentComplete*100)+"%");
				   $(".percent").html(Math.round(percentComplete*100)+" %");
				    
				  console.log(Math.round(percentComplete*100));
			   }
		   }, false);
		   //Download progress
		   /*xhr.addEventListener("progress", function(evt){
				if (evt.lengthComputable) {
				  var percentComplete = evt.loaded / evt.total;
				  //Do something with download progress
//				  console.log(percentComplete);
				}
		   }, false);*/

		   return xhr;
		},	   
        success: function(str){
          console.log(str);
          $("#loader").hide();
          if(str.Status == 'Active'){
            $("#psumsg").show();
            $("#psumsg").html(str.Message);
            setTimeout(function(){ location.reload(); }, 1500);  
          }else{
            $("#peumsg").show();
            $("#peumsg").html(str.Message);
          }
        }
        });
    });
    $("#addeditachievement").on('submit', function(e){
       e.preventDefault();
       var fdata = $("#addeditachievement").serialize();
       var url = $('#url5').val();
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
	

$(".pdfselect").change(function(){
	
	var target = $(this).attr("id");
	var output = $(this).attr("output");
	convertpdftojpg(target,output);
	
})	
	
function convertpdftojpg(pdf,output){
	
  if (file = document.getElementById(pdf).files[0]) {
	fileReader = new FileReader();
	fileReader.onload = function(ev) {
	  console.log(ev);
	  PDFJS.getDocument(fileReader.result).then(function getPdfHelloWorld(pdf) {
		//
		// Fetch the first page
		//
		console.log(pdf)
		pdf.getPage(1).then(function getPageHelloWorld(page) {
		  var scale = 1.5;
		  var viewport = page.getViewport(scale);

		  //
		  // Prepare canvas using PDF page dimensions
		  //
		  var canvas = document.getElementById('the-canvas');
		  var context = canvas.getContext('2d');
		  canvas.height = viewport.height;
		  canvas.width = viewport.width;

		  //
		  // Render PDF page into canvas context
		  //
		  var task = page.render({canvasContext: context, viewport: viewport})
		  task.promise.then(function(){
			console.log(canvas.toDataURL('image/jpeg'));

			  $.ajax({

				  type : "post",
				  url : "<? echo base_url('institute/data/convertbase642img') ?>",
				  data : {img : canvas.toDataURL('image/jpeg')},
				  success : function(data){

					  $("#"+output).val(data);
					  console.log(data);

				  },
				  error : function(data){

					  console.log(data);

				  }

			  })

		  });
		});
	  }, function(error){
		console.log(error);
	  });
	};
	fileReader.readAsArrayBuffer(file);
  }
	
}	
	
</script>