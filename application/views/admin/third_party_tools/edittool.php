<? 
	$tooldata = json_decode($t->option_value);
	$inputs = $tooldata->input_names;
	$labels = $tooldata->input_labels;

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
        	<div class="block-header" style="width: 99%">
                 <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">                        
                        <h2>Edit <? echo $t->option_name ?></h2>
                    </div>            
                    <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                        <ul class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="<? echo base_url('admin/dashboard') ?>"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<? echo base_url('admin/third_party_tools') ?>">Third Party Tools</a></li>
                            <li class="breadcrumb-item active"><? echo $t->option_name ?></li>
                        </ul>
                    </div>
                </div> 
            </div>
    			<div class="col-md-12">
                    <?php echo $this->session->flashdata('msg');?>
                    <div class="card">
                       
                        <div class="body">
                            <div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
                            <form id="addeditstudent">
                                <input type="hidden" id="url" name="url" value="<?php echo base_url("admin/third_party_tools/updatetool");?>">
                                <input type="hidden" name="option_short_name" value="<?php echo $this->uri->segment(4);?>">
                                

                            <!-- <form id="basic-form" method="post" action="<?php echo base_url("admin/students/save_student/".$this->uri->segment(4));?>" novalidate> -->
                               
                              <? foreach($inputs as $k => $input){ ?>
                               
									<div class="col-lg-4 pull-left">
										<div class="form-group">
											<label><? echo $tooldata->input_labels[$k] ?></label>
											<input type="text" class="form-control" name="<? echo $input ?>" value="<?php echo $tooldata->$input; ?>" required>
										</div>
										<input type="hidden" name="inputs[]" value="<?php echo $input;?>">
                                		<input type="hidden" name="labels[]" value="<?php echo $tooldata->input_labels[$k];?>">
									</div>
                       	  
                        	  <? } ?>	
                        	  	
                        	  		<div class="col-lg-4 pull-left" style="margin-top: 25px">
										<div class="form-group">
											<button type="submit" class="btn btn-primary">Submit</button>
										</div>

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
        },
		   error:function(data){
			   console.log(data);
		   }
        });
    });

    });
</script>