
<style>
    td.details-control {
    background: url('<?php echo base_url(); ?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
    }
    tr.shown td.details-control {
        background: url('<?php echo base_url(); ?>assets/images/details_close.png') no-repeat center center;
    }
    .form-group {
        padding-left: 18px;
    }
    .form-group .item {

    }
</style>

<div id="main-content">
      
    <div class="col-md-12">
                    <?php echo $this->session->flashdata('msg');?>
                    <div class="card">
                        <div class="header">
                            <div class="col-lg-9 pull-left">
                                <h2>Custom Menu</h2>
                            </div>                                   
                        </div>
                        <div class="body">
                            <div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
                            <form id="addeditinstitute" enctype="multipart/form-data">
                                <input type="hidden" id="url" name="url" value="<?php echo base_url('admin/homepage/save_menustatus')?>">
                               
                                <div class="row">
                                    <div class="col-md-6">
<!--                                            <label>Menu Name</label>-->
                                            <?php
                                            foreach ($menustatus as $menu) {
                                            ?>
                                            <div class="form-group">
                                                <input type="hidden" name="totalmenus[]" value="<?php echo $menu->id;?>">
                                                <input class="" type="checkbox" id="<?php echo $menu->menu_name;?>" name="menustatus[<?php echo $menu->id;?>]" <?php if($menu->status==1){ echo "checked";}?>>&nbsp;&nbsp; 
                                                <input class="" type="text" name="menuname[<?php echo $menu->id;?>]" value="<?php echo $menu->menu_name;?>">&nbsp;&nbsp; 
<!--                                                <label for="<?php echo $menu->menu_name;?>"><?php echo $menu->menu_name;?></label>-->
                                            </div>
                                            <?php
                                            } 
                                            ?>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                	<div class="col-md-6" style="margin-left: 20px;">
                                        <button type="submit" class="btn btn-primary">Update</button><br><br><br>
                                        <center><img src="<? echo base_url(); ?>assets/images/load.gif" width="42" height="42" alt="" style="display:none" id="loader"></center>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
    </div>
</div>
<script type="text/javascript">
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
        },
		   error : function(data){
			   console.log(data);
		   }
        });
    });

    });
</script>