
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
            
                            
                        <div class="page-wrapper card">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center" style="padding-top: 10px; padding-left: 20px;">
                        <h4 class="page-title">Create Sub Menu</h4>
                        <div class="d-flex align-items-center">

                        </div>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex no-block justify-content-end align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb" style="background-color: transparent">
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo base_url() ?>dashboard">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo base_url() ?>admin/homepage/footer_menu">Main Menus</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page"><?php //echo $n->name ?> Sub Menus</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-5 align-self-center">
<!--                        <h4 class="page-title"><?php //echo $n->name ?> Sub Menu</h4>-->
                        <div class="d-flex align-items-center">

                        </div>

                    </div>
                    <div id="error"></div>
                    <div class="col-lg-12">
                        <div class="card">
                            <form action="<?php echo base_url() ?>admin/homepage/insertsubmenufooter" method="post">
                               <!--  <div class="card-body">
                                    <h4 class="card-title">Navbar Header</h4>
                                </div> -->
                                
                                <div class="form-body">
                                    <div class="card-body">
                                        <div class="row">
                                             
  
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Sub Menu Name</label>
                                                    <input class="form-control" placeholder="Sub Menu Name" name="sub_menu_name" required="">
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-3">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">Sub Menu Link</label>
                                                     
                                                     <input type="text" name="sub_menu_link" id="link" placeholder="Sub Menu Link" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Link Target</label>
                                                    <select class="form-control custom-select select" required name="sub_menu_target" id="">
                                                        <option value="">Select Link Target</option>
                                                         <option value="_blank">Blank</option>
                                                         <option value="_self">Self</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <input type="hidden" name="menu_id" value="<?php echo $n->id ?>">
											
                                             <div class="col-md-3" style="margin-top: 5px">
                                                <div class="form-actions">
                                                    <br>
                                                        <div class="card-body">
                                                            <button type="submit" class="btn btn-success submit" id="msubmit"> <i class="fa fa-check"></i> Submit</button>
                                                        </div>
                                                </div>
                                             </div>
                                              
                                         
                                        </div>
                                        
                                   
                                </div>
                            </form>
                            
                            </div> 


                        </div>

                    </div>
 <!-- End Navbar Sub Menu  -->                               

<div class="container-fluid">

                    <div class="row">
                    <!-- Column -->
                    <div class="col-lg-12">
                        <div class="card" style="border: 0px">
                               <div align="center" style="margin-top: 20px"><p class="text_font"><strong>Existing <?php //echo $n->name ?> Sub Menus</strong></p></div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table product-overview table-striped" id="zero_config">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Menu</th>
                                                <th>Sub Menu</th>
                                                <th>Link</th>
                                                <th>Target</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
                                           $i = 0;

                                           foreach ($smenu as $u) {   ?> 
                                            <?php if($u->deleted==0){ ?>
                                            <tr>
                                                <td style="padding: 0.5rem;"><?php echo ++$i ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $this->db->get_where("tbl_footer_menu",array("id"=>$u->menu_name))->row()->name ?></td>
                                                <td style="padding: 0.5rem; width: 200px"><?php echo $u->sub_menu_name ?></td>
                                                <td style="padding: 0.5rem; width: 200px"><?php echo $u->sub_menu_link ?></td>
                                                <td style="padding: 0.5rem;">

                                                      <?php switch($u->sub_menu_target){
                                                      case "_top":
                                                        echo "Top";
                                                      break;  
                                                      case "_self":
                                                        echo "Self";
                                                      break;  
                                                      case '_parent':
                                                        echo "Parent";
                                                      break;  
                                                      case '_blank':
                                                      echo "Blank";   
                                                      break;
                                                      default:
                                                      echo "Blank";
                                                      break;
                                                    }      


                                                ?>
                                                        

                                                </td>
                                                <td style="padding: 0.5rem;">
                                                   
                                                   <?php if($u->status=="Active"){ ?>
                                               <div class="switch">
                                                   <input type="checkbox" data-on-color="info" nav_id="<?php echo $u->id ?>" name="switch" data-off-color="success" class="check" checked>
                                               </div>
                                                   <?php  }elseif($u->status=="Inactive"){ ?>
                                                <div class="switch">
                                                    <input type="checkbox" nav_id="<?php echo $u->id ?>" data-on-color="info" name="switch" data-off-color="success" class="check">
                                                   <?php } ?> 
                                                </div>    
                                                </td>
                                                <td style="padding: 0.5rem;">
                                                    <a href="<?php echo base_url() ?>admin/homepage/updatefootersubmenu/<?php echo $u->id ?>" class="text-inverse p-r-10 "><i class="ti-marker-alt"></i></a>
                                                    <a href="#" value="<?php echo $u->id ?>" id="<?php echo $u->id ?>" onclick="archiveFunction(this.id)" class="text-inverse "><i class="ti-trash"></i></a>
                                                    &nbsp;&nbsp;
                                                     <!-- <a href="<?php //echo base_url() ?>menus/child-menu/<?php //echo $u->id ?>"><button class="btn btn-primary btn-sm">Child Menu</button></a> -->

                                                </td>
                                                  
                                            </tr>
                                        <?php } ?>
                                     <?php  
                                     //$i++;
                                       } ?> 
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>

                           
                        </div>
                     
                        <div class="body">
                            <div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
                              
                        </div>
                    </div>
    </div>
</div>

<script>

$("input[type='checkbox']").bootstrapSwitch({size : 'mini'});
    
$('#zero_config').on('switchChange.bootstrapSwitch','input[name="switch"]', function (e, state) {
      
	  var nav_id = $(this).attr("nav_id"); 

		var status;

		if ($(this).is(":checked")){
			status = "Active";
		}else{
			status = "Inactive";
		}
		$.ajax({
			type:"POST",
			url:"<?php echo base_url();?>admin/homepage/footerSubmenustatus",
			data:{id:nav_id,status:status},
			success:function (data){
				location. reload(true);
			}

		});  
 });

</script>
<script type="text/javascript">

$(".menu_icon").on("change",function(){

  var menu_id = $(this).attr("menu_id");
  $("#menu_icon").val(menu_id);


});

$(".main_icon").on("change",function(){

  var main_id = $(this).attr("main_id");
  $("#main_icon").val(main_id);


});
</script>

<script>


	

	
	
	
$("input[type='checkbox']").bootstrapSwitch({size : 'mini'});



</script>




<script type="text/javascript">
function archiveFunction(id) {
    //alert(id);
       Swal({
  title: 'Are you sure?',
  text: 'You will not be able to recover this selected menu!',
  type: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, keep it'
}).then((result) => {
  if (result.value) {

    Swal(
      'Deleted!',
      'Your Selected Menu has been deleted.',
      'success'
    )
    $.ajax({
        method: 'POST',
        data: {'id' : id },
        url: '<?php echo base_url() ?>admin/homepage/delsubfooter/'+id,
        success: function(data) {
            location.reload();   
        }
    });
 
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    Swal(
      'Cancelled',
      'Your Selected Menu is safe :)',
      'success',
      
    )
  }
})
    }
</script>