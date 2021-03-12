

<?php //print_r($sm);die;
    // $id = $this->uri->segment(3);

    // $hid = $this->db->get_where("tbl_footer_submenu",array("id"=>$id))->row()->menu_name;

	// $main_menu = $this->db->get_where("tbl_footer_submenu",array("id"=>$hid))->row()


?>

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
                   
                        <div class="page-wrapper card">
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Edit Footer Sub Menu</h4>
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
                                        <a href="<?php echo base_url() ?>admin/homepage/footer_submenu/<?php echo $sm->menu_name ?>">Sub Menus</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit <?php ?></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
            <div class="row">
                    
                    <div class="col-lg-12">
                        <div class="card">
                            <form action="<?php echo base_url() ?>admin/homepage/editfootersubmenu" method="post">
                             
                                <div class="form-body">
                                    <div class="card-body">
                                        <div class="row">
                                             <div class="col-md-2">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">Menu Name</label>
                                                     
                                                     <select class="form-control" name="menu_name">
                                                       <?php 
                                $mm = $this->db->query("select * from tbl_footer_menu where deleted=0 and status='Active'")->result();
                                                            foreach ($mm as $m) {
                                                            if($sm->menu_name==$m->id){
                                                        ?>
                                                        <option value="<?php echo $m->id ?>" selected><?php echo $m->name ?></option> 
                                                       <?php }else{ ?>
                                                        <option value="<?php echo $m->id ?>"><?php echo $m->name ?></option>
                                                       <?php }} ?>
                                                    </select>
                                                     </select>
                                                </div>
                                            </div>
  
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Sub Menu Name</label>
                                                    <input class="form-control" placeholder="Sub Menu Name" name="sub_menu_name" value="<?php echo $sm->sub_menu_name ?>" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">Sub Menu Link</label>
  
                                                     <input type="text" name="sub_menu_link" id="link" value="<?php echo $sm->sub_menu_link ?>" placeholder="Sub Menu Link" class="form-control" required>

                                                     
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Link Target</label>
                                                    <select class="form-control custom-select" required name="sub_menu_target">
                                                    <option value="_blank" <?php if($sm->sub_menu_target == '_blank') { ?>  selected="selected"<?php } ?>>Blank</option>
                                                    <option value="_self" <?php if($sm->sub_menu_target == '_self') { ?>  selected="selected"<?php } ?>>Self</option>

                                                    </select>
                                                </div>
                                            </div>
                                         	<div class="col-md-2" style="margin-top: 5px">
                                                <div class="form-actions">
                                                    <br>
                                                        <div class="card-body">
                                                            <button type="submit" class="btn btn-success" id="msubmit"> <i class="fa fa-check"></i> Update</button>
                                                        </div>
                                                </div>
                                              </div> 
                                         	
                                        </div>
                                       <input type="hidden" name="id" value="<?php echo $sm->id ?>">
                                </div>
                            </form>
                            </div>    
                        </div>

                    </div>
 
<script>


	
// Child Menu Status Starts
	
$("input[type='checkbox']").bootstrapSwitch({size : 'mini'});
$('#zero_config1').DataTable();

    $('#zero_config1').on('switchChange.bootstrapSwitch','input[name="switch"]', function (e, state) {
        
          var nav_id = $(this).attr("nav_id"); 
                    var status;
                  
                    if ($(this).is(":checked")){
                        status = "Active";
                    }else{
                        status = "Inactive";
                    }
                    $.ajax({
                        type:"POST",
                        url:"<?php echo base_url();?>navbar/navbar_menu/childmenustatus",
                        data:{id:nav_id,status:status},
                        success:function (data){
                            location. reload(true);
                        }

                    });  
        });
	
	
// Child Menu Status Ends
		



 
 
</script>

<script type="text/javascript">


function archiveFunction(id) {
       Swal({
  title: 'Are you sure?',
  text: 'You will not be able to recover this selected child menu!',
  type: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, keep it'
}).then((result) => {
  if (result.value) {

    Swal(
      'Deleted!',
      'Your Selected Child Menu has been deleted.',
      'success'
    )
    $.ajax({
        method: 'POST',
        data: {'id' : id },
        url: '<?php echo base_url() ?>admin/homepage/delChildmenu/'+id,
        success: function(data) {
            //location.reload();  
            window.location = "<?php echo base_url() ?>admin/homepage/updatefootersubmenu/<?php echo $id ?>" 
        }
    });
 
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    Swal(
      'Cancelled',
      'Your Selected Child Menu is safe :)',
      'success',
      
    )
  }
})
    }
</script>


            <!-- End footer -->