
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
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            
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
               
                        <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Edit Main Menu</h4>
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
                                    <li class="breadcrumb-item active" aria-current="page">Edit <?php echo $n->name ?></li>
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
                <!-- Edit Navbar Menu Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <form action="<?php echo base_url() ?>admin/homepage/editfooter" method="post">
                               <!--  <div class="card-body">
                                    <h4 class="card-title">Navbar Header</h4>
                                </div> -->
                                
                                <div class="form-body">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Menu Name</label>
                                                    <input type="text" class="form-control" placeholder="Menu Name" name="name" required="" value="<?php echo $n->name ?>">
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-3">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">Select Menu Link</label>

                                                     <input type="text" name="link" class="form-control" id="link" placeholder="Menu Link" value="<?php echo $n->link ?>" required>
                                                     
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Link Target</label>
                                                    <select class="form-control custom-select" required name="target">
 <option value="_blank" <?php if($n->target == '_blank') { ?>  selected="selected"<?php } ?>>Blank</option>
 <option value="_self" <?php if($n->target == '_self') { ?> selected="selected"<?php } ?>>Self</option>

                                                    </select>
                                                </div>
                                            </div>

                                            <!-- <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="control-label">Icon Name</label>
                                                    <<input type="text" class="form-control" placeholder="Icon Name" id="menu_icon" name="icon" required="" value="<?php //echo $n->menu_icon ?>" readonly>
                                                </div>
                                            </div> -->

<!--
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="control-label">Menu Description</label>
                                                    <textarea name="description" class="form-control" rows="2" required><?php //echo $n->description ?></textarea>
                                                </div>
                                            </div>
-->
											<div class="col-md-2" style="margin-top: 5px">
                                                <div class="form-actions">
                                                    <br>
                                                        <div class="card-body">
                                                            <button type="submit" class="btn btn-success" id="msubmit"> <i class="fa fa-check"></i> Update</button>
                                                             
                                                        </div>
                                                </div>
                                            </div> 
   
                                         
                                        </div>
                                        
                                        
<!--
                               <div class="row">
                                         <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Meta Title</label>
                                                    <input type="text" class="form-control" value="<?php //echo $n->meta_title ?>" placeholder="Meta Title" name="meta_title" required="">
                                                </div>
                                         </div>
                                                     
                                         <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Meta Keyword</label>
                                                    <input type="text" class="form-control" value="<?php //echo $n->meta_keyword ?>" placeholder="Meta Keyword" name="meta_keyword" required="">
                                                </div>
                                         </div>
                                                     
                                                                 
                                          <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Meta Description</label>
                                                    <textarea class="form-control" placeholder="Meta Description" name="meta_description" required rows="3"><?php //echo $n->meta_description ?></textarea>
                                                </div>
                                            </div>                                   
                                                                                                     
                                    

                                            <div class="col-md-2" style="margin-top: 5px">
                                                <div class="form-actions">
                                                    <br>
                                                        <div class="card-body">
                                                            <button type="submit" class="btn btn-success" id="msubmit"> <i class="fa fa-check"></i> Update</button>
                                                             <button type="reset" class="btn btn-dark">Cancel</button> 
                                                        </div>
                                                </div>
                                            </div> 
 								 </div>
-->
                                        
<!--                                    <input type="hidden" name="main_icon" id="main_icon" value="<?php //echo $n->main_icon ?>">-->


                                       <input type="hidden" name="id" value="<?php echo $n->id ?>">
                                   
                                </div>
                            </form>
                            
                            </div>   

                    <div class="row">

                      <!-- <div class="col-md-6"> 
                       <div class="card" style="background-color: whitesmoke; margin-left: 2px">
                            <div class="card-body" style="text-align: horizontal">    
                          <h4 class="card-title">Menu Icons : </h4>&nbsp; 
                        <div class="row">          -->
                         <?php

                        //   $i = 0;
                        //   $directory = "uploads/icons/MainMenu";
                        //   $images = glob($directory . "/*.*");

                        //   foreach($images as $image)
                        //   {

                        //     $imgname = basename($image);

                         ?>
<!-- 
                            <div class="col-md-2">
                             <?php //if($n->menu_icon==$imgname){ ?>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio<?php //echo $i ?>" name="menu_icon" menu_id="<?php //echo $imgname ?>" class="custom-control-input menu_icon" checked>
                                    <label class="custom-control-label" for="customRadio<?php //echo $i ?>"><img src="<?php //echo base_url().$image ?>" style="height: 30px"></label>
                                </div>
                             <?php //}else{ ?>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio<?php //echo $i ?>" name="menu_icon" menu_id="<?php //echo $imgname ?>" class="custom-control-input menu_icon">
                                    <label class="custom-control-label" for="customRadio<?php //echo $i ?>"><img src="<?php //echo base_url().$image ?>" style="height: 30px"></label>
                                </div>
                             <?php //} ?>   
                            </div> -->

                         <?php 
                          //$i++;
                          //} 

                        ?>    
                      </div>
                     </div> 
                     </div>
                     </div>  

                      
<!--
                     <div class="col-md-6"> 
                       <div class="card" style="background-color: whitesmoke">
                            <div class="card-body" style="text-align: horizontal">          
                        <h4 class="card-title">Main Icons &nbsp;: </h4>&nbsp;&nbsp;
                         <div class="row">

                        <?php

//                          $i = 0;
//                          $directory = "assets/main_icons";
//                          $images = glob($directory . "/*.*");
//
//                          foreach($images as $image)
//                          {
//
//                            $icon = $this->input->post("icon");
//                            
//                            $imgname = basename($image);

                        ?>


                              <div class="col-md-2">
                            <?php //if($n->main_icon==$imgname){ ?>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="custom<?php //echo $i ?>" name="main_icon1" main_id="<?php //echo $imgname ?>" class="custom-control-input main_icon" checked>
                                    <label class="custom-control-label" for="custom<?php //echo $i ?>"><img src="<?php //echo base_url().$image ?>" style="height: 30px"></label>
                                </div>
                            <?php //}else{ ?>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="custom<?php //echo $i ?>" name="main_icon1" main_id="<?php //echo $imgname ?>" class="custom-control-input main_icon">
                                    <label class="custom-control-label" for="custom<?php //echo $i ?>"><img src="<?php //echo base_url().$image ?>" style="height: 30px"></label>
                                </div>
                            <?php //} ?>    

                              </div>  
                               
                        <?php 
//                          $i++;
//                          } 

                        ?>    
                     
                      </div>  
                    </div>    
                </div>
            </div>    
-->
      
      </div>



              </div>

        <!-- End Navbar Edit   -->
        
            </div>

    </div>
</div>

<script>
	

	
   
$(".menu_icon").on("change",function(){

  var menu_id = $(this).attr("menu_id");
  $("#menu_icon").val(menu_id);


});

$(".main_icon").on("change",function(){

  var main_id = $(this).attr("main_id");
  $("#main_icon").val(main_id);


});




$("#submit").click(function(){
    var sml = document.getElementById('sml');
    var lt = document.getElementById('lt');
    var invalidsml = sml.value == "0";
    var invalidlt = lt.value == "0";
    
    if(invalidsml){
        $("#error").html('<div class="alert alert-danger alert-dismissable">Please Select Sub Menu Link</div>')
        return false;
    }
    if(invalidlt){
        $("#error").html('<div class="alert alert-danger alert-dismissable">Please Select Link Target</div>')
        return false;
    }
});
 
$("input[type='checkbox']").bootstrapSwitch({size : 'mini'});
$('#zero_config').DataTable();

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
                        url:"<?php echo base_url();?>navbar/navbar_menu/navbarSubmenustatus",
                        data:{id:nav_id,status:status},
                        success:function (data){
                            
                            location.reload();
                        }

                    });  
        });

</script>

<script type="text/javascript">


function archiveFunction(id) {
       Swal({
  title: 'Are you sure?',
  text: 'You will not be able to recover this selected sub menu!',
  type: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, keep it'
}).then((result) => {
  if (result.value) {

    Swal(
      'Deleted!',
      'Your Selected Sub Menu has been deleted.',
      'success'
    )
    $.ajax({
        method: 'POST',
        data: {'id' : id },
        url: '<?php echo base_url() ?>navbar/navbar_menu/delNavbarSubmenu/'+id,
        success: function(data) {
            location.reload();   
        }
    });
 
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    Swal(
      'Cancelled',
      'Your Selected Sub Menu is safe :)',
      'success',
      
    )
  }
})
    }
</script>
