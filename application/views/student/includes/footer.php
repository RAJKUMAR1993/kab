<!-- Javascript -->

<script src="<?php echo base_url();?>assets/bundles/libscripts.bundle.js"></script>    
<script src="<?php echo base_url();?>assets/bundles/vendorscripts.bundle.js"></script>

<script src="<?php echo base_url();?>assets/vendor/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js --> 

<script src="<?php echo base_url();?>assets/bundles/mainscripts.bundle.js"></script>
<script src="<?php echo base_url();?>assets/bundles/morrisscripts.bundle.js"></script>
<script src="<?php echo base_url();?>assets/js/pages/ui/dialogs.js"></script>

<!-- Client list  -->
<script src="<?php echo base_url();?>assets/bundles/datatablescripts.bundle.js"></script>
<script src="<?php echo base_url();?>assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="<?php echo base_url();?>assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>


<script src="<?php echo base_url();?>assets/js/pages/tables/jquery-datatable.js"></script>
<!-- Client list page end -->

<script src="<?php echo base_url();?>assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
<script src="<?php echo base_url();?>assets/vendor/parsleyjs/js/parsley.min.js"></script>

<!-- Summer note add_corse -->
<script src="<?php echo base_url();?>assets/vendor/summernote/dist/summernote.js"></script>


<!-- Form Advanced-->
<script src="<?php echo base_url();?>assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script> <!-- Bootstrap Colorpicker Js --> 
<script src="<?php echo base_url();?>assets/vendor/jquery-inputmask/jquery.inputmask.bundle.js"></script> <!-- Input Mask Plugin Js --> 
<script src="<?php echo base_url();?>assets/vendor/jquery.maskedinput/jquery.maskedinput.min.js"></script>
<script src="<?php echo base_url();?>assets/vendor/multi-select/js/jquery.multi-select.js"></script> <!-- Multi Select Plugin Js -->
<script src="<?php echo base_url();?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url();?>assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script> <!-- Bootstrap Tags Input Plugin Js --> 
<script src="<?php echo base_url();?>assets/vendor/nouislider/nouislider.js"></script> <!-- noUISlider Plugin Js --> 

<script src="<?php echo base_url();?>assets/js/pages/forms/advanced-form-elements.js"></script>
<script src="<?php echo base_url();?>assets/js/custom.js"></script>

<!-- Javascript -->
<script src="<?php echo base_url();?>assets/vendor/dropify/js/dropify.min.js"></script>
<script src="<?php echo base_url();?>assets/js/pages/forms/dropify.js"></script>

<!-- fullCalendar 2.2.5-->
<link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/fullcalendar/fullcalendar.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/fullcalendar/fullcalendar.print.css" media="print">
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo base_url();?>assets/vendor/fullcalendar/fullcalendar.min.js"></script>
<script src="<?php echo base_url();?>assets/vendor/toastr/toastr.js"></script>

<script>
    $(function() {
        // validation needs name of the element
        //$('#food').multiselect();

        // initialize after multiselect
        //$('#basic-form').parsley();
       // $('#basic-form1').parsley();

        


    });


  /*$('#basic-form1').parsley().on('field:validated', function() { }).on('form:submit', function() {
    return false; // Don't submit form for this demo
  });*/

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
    //['insert', ['link', 'picture', 'hr']],
    ['view', ['fullscreen', 'codeview']],
    //['help', ['help']]
    ],
  height:250,
});

</script>
<script type="text/javascript">
$("#sscupdprofile").click(function(){
	 		$("#sscupddata").toggle();
	 		$("#sscsdata").hide();
	    	$("#sscupdprofile").hide();
	 });
	 $("#sscback").click(function(){
        
        $("#sscsdata").toggle();
        $("#sscupdprofile").toggle();
        $("#sscupddata").hide();
        
    });

	 $("#interupdprofile").click(function(){
	 		$("#interupddata").toggle();
	 		$("#intersdata").hide();
	    	$("#interupdprofile").hide();
	 });
	 $("#interback").click(function(){
        
        $("#intersdata").toggle();
        $("#interupdprofile").toggle();
        $("#interupddata").hide();
        
    });


	 $("#degreeupdprofile").click(function(){
	 		$("#degreeupddata").toggle();
	 		$("#degreesdata").hide();
	    	$("#degreeupdprofile").hide();
	 });
	 $("#degreeback").click(function(){
        
        $("#degreesdata").toggle();
        $("#degreeupdprofile").toggle();
        $("#degreeupddata").hide();
        
    });

	  $("#entranceupdprofile").click(function(){
	 		$("#entranceupddata").toggle();
	 		$("#entrancesdata").hide();
	    	$("#entranceupdprofile").hide();
	 });
	 $("#entranceback").click(function(){
        
        $("#entrancesdata").toggle();
        $("#entranceupdprofile").toggle();
        $("#entranceupddata").hide();
        
    });



  $("#updprofile").click(function(){
        
        $("#upddata").toggle();
        $("#sdata").hide();
	    $("#updprofile").hide();
        
    });

  $("#examsadd").click(function(){
       // alert();
        $("#edataupdate").toggle();
        $("#edata").hide();
	    $("#examsadd").hide();
        
    });

    $("#examsback").click(function(){
        	
        $("#edata").toggle();
        $("#edataupdate").hide();
	    $("#examsadd").show();
        
    });



     $("#back").click(function(){
        
        $("#sdata").toggle();
        $("#updprofile").toggle();
        $("#upddata").hide();
        
    });
    
</script>
<script type="text/javascript">
	
//  $(document).ready(function(){
    $("#search").on("click", function(){
      var query = $("#country").val();
	  //alert(query);
	  var url = '<?php echo base_url("front/institutes/searchnew") ?>'; 
        $.ajax({
                url: url,
                method: 'POST',
                data: {query:query},
                success: function(data)
                {
				
                  $('.searchResults').html(data);
                }
        });
    });
//  });
  function submitForm(cid){
  	$(".getInstitutes_"+cid).submit();
  }
  $(document).on("click",".btn-toggle-hide",function(){
        $(".role_name").toggle();
    });
</script>
</body>
</html>
