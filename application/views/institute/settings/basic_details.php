
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
                    <div class="card">
                        <div class="header">
                            <div class="col-lg-9 pull-left">
                                <h2>Institution Details</h2>
                            </div>
                            <!-- <a href="<?php echo base_url("admin/institutes");?>" class="col-lg-1 pull-right"><u>Back</u></a> -->
                                   
                        </div>
                        <div class="body">
                            <div class="alert alert-success" style="display:none" id="smsg"></div>
                            <div class="alert alert-danger" style="display:none" id="emsg"></div>
                            <form id="instituteUpdateDetails" enctype="multipart/form-data">
                            <!-- <form id="basic-form" method="post" action="<?php echo base_url("institute/settings/update")?>" enctype="multipart/form-data" novalidate> -->
							   <div class="row clearfix">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Institute name</label>
                                        <input type="text" class="form-control" name="name" maxlength="40" value="<?php if(isset($admin->institute_name)){ echo $admin->institute_name;}?>" required>
                                    </div>
                                    </div>
                                    <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea class="form-control" name="address" rows="1" required><?php if(isset($admin->address)){ echo $admin->address;}?></textarea>
                                        
                                    </div> 
									 <!---->
                                 </div>
                                    
                                   
                                </div>
								<div class="row clearfix">
								    <div class="col-md-6">
								    <div class="form-group">
                                        <label>Country</label>
										<select name="country" class="form-control" id="country" style="width: 100%" required>
											<!-- <option value="">Choose Country</option>
												<?php foreach($countries as $cou){?>
													<option value="<?php echo $cou->country_name;?>" <? echo ($admin->country == $cou->country_name) ? 'selected' : ''; ?>><?php echo $cou->country_name;?></option>
												<?php }?> -->
										</select>                                       
                                    </div>
									</div>
									<div class="col-lg-6">
                                    <div class="form-group">
                                        <label>State</label>
                                         <select name="state" class="form-control" id="state" style="width: 100%" required>
											<!-- <option value="">Choose State</option>
												<?php foreach($states as $state){?>
													<option value="<?php echo $state->state_name;?>" <? echo ($admin->state == $state->state_name) ? 'selected' : ''; ?>><?php echo $state->state_name;?></option>
												<?php }?> -->
										</select>										
                                    </div>                                                                    
                                 </div>
								</div>
								
								 <div class="row clearfix">
									 <div class="col-lg-6">
										  <div class="form-group">
											<label>City</label>
										<select name="city" id="city" class="form-control" style="width: 100%" required>
											<!-- <option value="">Choose District</option>
												<?php foreach($districts as $dist){?>
												<option value="<?php echo $dist->city_name;?>" <? echo ($admin->city == $dist->city_name) ? 'selected' : ''; ?>><?php echo $dist->city_name;?></option>
												<?php }?> -->
										</select>										
										</div>                                                                  
									 </div>
									 <div class="col-lg-6">
										  <div class="form-group">
                                        <label>Mobile</label>
                                        <input type="text" class="form-control" name="mobile" value="<?php if(isset($admin->phone)){ echo $admin->phone;}?>" maxlength="10" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" required>
                                    </div>                                                                  
									 </div>
                                 </div>
								<div class="row clearfix">
                                     <div class="col-lg-6">								    
										<div class="form-group">
											<label>Institution Email(Username)</label>
											<input type="email" class="form-control" name="email" value="<?php if(isset($admin->email)){ echo $admin->email;}?>" required>
										</div>
                                    </div>
									<div class="col-lg-6">
                                        <div class="form-group">
											<label>Password</label>
											<input type="text" class="form-control" name="password" value="<?php if(isset($admin->password)){ echo $this->institute_login_model->api_key_crypt($admin->password,"d");}?>" required>
											<input type="hidden" class="form-control" name="old_password" value="<?php if(isset($admin->password)){ echo $admin->password;}?>" >
										</div>	
                                    </div>
								</div>
								<div class="row clearfix">
								     <div class="col-lg-6">								    
										<div class="form-group">
											<label>Institution Website</label>
											<input type="text" class="form-control" name="institute_website" value="<?php if(isset($admin->website)){ echo $admin->website;}?>">
										</div>
                                    </div>
								</div>
								<h6 style="font-weight:bold">Event Coordination : </h6>
                                <div class="row clearfix">
                                    <div class="col-lg-6 pull-left">                                  
										<div class="form-group">
											<label>Contact person name</label>
											<input type="text" class="form-control" name="fullname" value="<?php if(isset($admin->full_name)){ echo $admin->full_name;}?>" required>
										</div>                                                                   
									 </div>
									 <div class="col-lg-6">
										<div class="form-group">
											<label>Designation</label>
											<input type="text" class="form-control" name="designation" value="<?php if(isset($admin->designation)){ echo $admin->designation;}?>" required>
										</div>
									</div>
                                </div>
								<div class="row clearfix">
                                    <div class="col-lg-6 pull-left">                                  
										<div class="form-group">
											<label>Official Email id</label>
											<input type="text" class="form-control" name="event_person_email" value="<?php if(isset($admin->event_person_email)){ echo $admin->event_person_email;}?>" required>
										</div>                                                                   
									 </div>
									 <div class="col-lg-6">
										<div class="form-group">
											<label>Phone number</label>
											<input type="text" class="form-control" name="event_person_mobile" value="<?php if(isset($admin->event_person_mobile)){ echo $admin->event_person_mobile;}?>" required>
										</div>
									</div>
                                </div>
                               	
                                  <div class="row clearfix">
                                  <div class="col-lg-6">
                                    
                                    
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select name="category" class="form-control" id="mySelect" onchange="myFunction()" required>
                                           
                                            <?
                                            if(isset($admin->category_id)){
                                                $catdetails = $this->category_model->get_category_id($admin->category_id);
                                                $catname = $catdetails->category_name;
                                            ?>
                                            <?php if(isset($admin->category_id)){echo '<option value="'.$admin->category_id.'">'.$catname.'</option>';} } ?>
                                            <?
                                                foreach ($categories as $category) {
                                                    echo "<option value='$category->category_id'>$category->category_name</option>";
                                                }
                                            ?>

                                        </select>
                                        
                                    </div>
                                <? 
                                if(isset($admin->category_id)){
                                //if($catname == "Coaching Centers"){ ?>
                                    <div class="form-group" id="cctype" <? if($catname == "Coaching Centers"){ ?>  <? } else { ?>style="display: none;" <? } ?>>
                                        <label>Coaching Center Type</label>
                                        <select name="cctype" class="form-control">
                                            <?php if(isset($admin->cctype)){echo '<option value="'.$admin->cctype.'">'.$admin->cctype.'</option>';}?>
                                            <option value="Training Institute">Training Institute</option>
                                            <option value="Online Classes">Online Classes</option>
                                            <option value="Both">Both</option>
                                        </select> 
                                    </div>
                                <? //} if($catname == "Overseas Education"){ ?>

                                    <div class="form-group" id="overseascountry" <? if($catname == "Overseas Education"){ ?>  <? } else { ?>style="display: none;" <? } ?>>
                                        <label>Country</label>
                                        <input type="text" class="form-control" name="overseascountry" value="<?php if(isset($admin->overseascountry)){ echo $admin->overseascountry;}?>">
                                    </div>
                                <? /*}*/ } else { ?>
                                    <div class="form-group" id="cctype" style="display: none;">
                                        <label>Coaching Center Type</label>
                                        <select name="cctype" class="form-control">  
                                            <option>Select Type</option>
                                            <option value="Training Institute">Training Institute</option>
                                            <option value="Online Classes">Online Classes</option>
                                            <option value="Both">Both</option>
                                        </select> 
                                    </div>
                                    <div id="overseascountry" class="form-group" style="display: none;">
                                        <label>Country</label>
                                        <input type="text" class="form-control" name="overseascountry" >
                                    </div>
                                <? } ?>
                                                                      
                                 </div>
                                 </div>

                                <!-- <div class="row clearfix">
                                    <div class="col-lg-6 pull-left">
                                        
                                        
                                        <div class="form-group">
                                            <label>About Institute</label>
                                            <textarea class="form-control summernote" name="aboutinst" ><?php if(isset($admin->aboutinst)){ echo $admin->aboutinst;}?></textarea>
                                            
                                        </div>
                                                                          
                                     </div>
                                     <div class="col-lg-6 pull-left">
                                        
                                        
                                        <div class="form-group">
                                            <label>Important Note</label>
                                            <textarea class="form-control summernote" name="impnote" ><?php if(isset($admin->impnote)){ echo $admin->impnote;}?></textarea>
                                            
                                        </div>
                                                                          
                                     </div>
                                 </div>
								 <div class="row clearfix">
                                    <div class="col-lg-6">
                                    
                                    
                                    <div class="form-group">
                                        <label>Institute Offering</label>
                                        <textarea class="form-control summernote" name="instoffr" ><?php if(isset($admin->instoffr)){ echo $admin->instoffr;}?></textarea>
                                        
                                    </div>
                                                                      
                                     </div>
                                     <div class="col-lg-6">
                                        
                                        
                                        <div class="form-group">
                                            <label>Merit Scholarships Details</label>
                                            <textarea class="form-control summernote" name="meritscolar" ><?php if(isset($admin->meritscolar)){ echo $admin->meritscolar;}?></textarea>
                                            
                                        </div>
                                                                          
                                     </div>
                                 </div> -->
                                

<input type="hidden" name="old_video" value="<?php if(isset($admin->institute_video)){ echo $admin->institute_video; }?>">
                                



                                 <button type="submit" class="btn btn-primary pull-right">Update Details</button><br><br><br>
                                 <center><img src="<? echo base_url(); ?>assets/images/load.gif" width="42" height="42" alt="" style="display:none" id="loader"></center>
                            </form>
                        </div>
                    </div>
    </div>
</div>

<script type="text/javascript">
  $('.dropify').dropify({
    messages: {
        'default': 'Drag and drop a file here or click',
        'replace': 'Drag and drop or click to replace',
        'remove':  'Remove',
        'error':   'Ooops, something wrong happended.'
    }
});
</script>
<script>
function myFunction() {
  var x = document.getElementById("mySelect").value;
  //alert(x);
  if(x==2){
    $('#cctype').show();
    $('#overseascountry').hide();
  } else if(x==3){
    $('#cctype').hide();
    $('#overseascountry').show();
  } else {
    $('#cctype').hide();
    $('#overseascountry').hide();
  }
}
</script>
<script type="text/javascript">
    $(document).ready(function(){
    var selected_country = '<?php echo $admin->country;?>';
    var selected_state = '<?php echo $admin->state;?>';
    var selected_city = '<?php echo $admin->city;?>';
    setTimeout(function(){
            getCountries(selected_country);
        }, 500);
        setTimeout(function(){
            getStates(selected_state, selected_country);
        }, 1000);
        setTimeout(function(){
            getCities(selected_city, selected_state);
        }, 1500);
        $('#country').on('change',function(){
            var countryID = $(this).val();
            if(countryID){
                getStates(selected_state, countryID); 
            }else{
                $('#state').html('<option value="">Select country first</option>');
                $('#city').html('<option value="">Select state first</option>'); 
            }
        });
        
        $('#state').on('change',function(){
            var stateID = $(this).val();
            if(stateID){
                getCities(selected_city, stateID);
            }else{
                $('#city').html('<option value="">Select state first</option>'); 
            }
        });
    $("#instituteUpdateDetails").on('submit', function(e){
       e.preventDefault();
       var fdata = new FormData(this);
       var url = '<?php echo base_url("institute/settings/update_basic") ?>';
        //alert(fdata);
       $.ajax({
        url:url,
        data:fdata,
        type:"post",
        dataType:"json",
        processData:false,
          contentType:false,
          cache:false,
        beforeSend: function(){
          $("#loader").show();
        },
        success: function(str){
          console.log(str);
          $("#loader").hide();
          if(str.Status == 'Active'){
            $("#smsg").show();
            $("#smsg").html(str.Message);
            setTimeout(function(){ $("#smsg").hide(); location.reload(); }, 500);
          }else{
            $("#emsg").show();
            $("#emsg").html(str.Message);
          }
        }
        });
    });

    });
    function getCountries(selected_country){
        $.ajax({
            type:'POST',
            url:'<?php echo base_url("institute/settings/select_country") ?>',
            data:'selected_country='+selected_country,
            success:function(html){
                $('#country').html(html);
            }
        });
    }
    function getStates(selected_state, countryID="null"){
        $.ajax({
            type:'POST',
            url:'<?php echo base_url("institute/settings/select_state") ?>',
            data:'selected_state='+selected_state+'&country_id='+countryID,
            success:function(html){
                $('#state').html(html);
                $('#city').html('<option value="">Select state first</option>'); 
            }
        });
    }
    function getCities(selected_city, stateID="null"){
        $.ajax({
            type:'POST',
            url:'<?php echo base_url("institute/settings/select_city") ?>',
            data:'selected_city='+selected_city+'&state_id='+stateID,
            success:function(html){
                $('#city').html(html);
            }
        });
    }
</script>

<script type="text/javascript">

    
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

</script>