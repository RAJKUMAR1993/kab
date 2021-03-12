<!-- Javascript -->
<script src="<?php echo base_url();?>assets/bundles/libscripts.bundle.js"></script>    
<script src="<?php echo base_url();?>assets/bundles/vendorscripts.bundle.js"></script>


<script src="<?php echo base_url();?>assets/bundles/chartist.bundle.js"></script> 


<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/c3.min.css">
<script src="<?php echo base_url();?>assets/js/d3.min.js"></script>
<script src="<?php echo base_url();?>assets/js/c3.min.js"></script>
<!-- Javascript -->
<script src="<?php echo base_url();?>assets/bundles/libscripts.bundle.js"></script>    
<script src="<?php echo base_url();?>assets/bundles/vendorscripts.bundle.js"></script>
<script src="<?php echo base_url();?>assets/pnotify/pnotify.custom.min.js"></script>    

<script src="<?php echo base_url();?>assets/sweetalert2/sweetalert2.all.min.js"></script> <!-- SweetAlert Plugin Js --> 

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
<script src="<?php echo base_url();?>assets/vendor/toastr/toastr.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
<script>
		
	
$("#dtable").dataTable();
	
    $(function() {
        // validation needs name of the element
        //$('#food').multiselect();

        // initialize after multiselect
        $('#basic-form').parsley();
       // $('#basic-form1').parsley();

        


    });


  /*$('#basic-form1').parsley().on('field:validated', function() { }).on('form:submit', function() {
    return false; // Don't submit form for this demo
  });*/

    </script>

<script type="text/javascript">
	
var fixHelperModified = function(e, tr) {
		var $originals = tr.children();
		var $helper = tr.clone();
		$helper.children().each(function(index) {
			$(this).width($originals.eq(index).width())
		});
		return $helper;
	},
	updateIndex = function(e, ui) {
		$('td.index', ui.item.parent()).each(function (i) {
			$(this).html(i+1);
		});
		$('.sorting', ui.item.parent()).each(function (i) {
			$(this).val(i + 1);			
		});
		
		var module_id = $("input[name='module_id[]']").map(function(){return $(this).val();}).get();
		var sort = $("input[name='sort[]']").map(function(){return $(this).val();}).get();
		
//		console.log(module_id);
//		console.log(sort);
		
		$.ajax({
			type : "post",
			url : "<? echo base_url('admin/categories/sort_order') ?>",
			data : {module_id:module_id,sort:sort},
			success : function(data){
				console.log(data);
			},
			error : function(data){
				console.log(data);
			}
		})
		
	};
	$("#zero_config tbody").sortable({
		helper: fixHelperModified,
		stop: updateIndex
	}).disableSelection();	
	
	$("#zero_config").dataTable();
	
    
 $('.block_message').summernote({
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
   height:200,
 });
	
$(".chatdataTable").dataTable();

$(".getChat").click(function(){

	$("#chathistory").show();
	var sid = $(this).attr("sid");
	var ref = $(this).attr("ref");

	$.ajax({

		type : "post",
		url : "<? echo base_url('admin/reports/getChat') ?>",
		data : {sid:sid,ref:ref},
		beforeSend:function(){

			$("#chathistory").html('<img src="<? echo base_url('assets/images/front/chatloader.gif') ?>" width="100%">');

		},
		success : function(data){

			console.log(data);
			$("#chathistory").html("");
			$("#chathistory").html(data);

		},
		error : function(data){

			console.log(data);
			$("#chathistory").html("");

		}

	})

})

$(document).on("click",".closeChat",function(){
	
	$("#chathistory").hide();
	
})

$('#zero_config').dataTable(); 
$('#zero_config1').dataTable();	

$(document).on("click",".btn-toggle-hide",function(){
	$(".role_name").toggle();
});
</script>


</body>
</html>
