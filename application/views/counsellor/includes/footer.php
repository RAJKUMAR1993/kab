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
<script src="<?php echo base_url();?>assets/vendor/toastr/toastr.js"></script>
<script src="<?php echo base_url();?>assets/js/custom.js"></script>

<!-- Javascript -->
<script src="<?php echo base_url();?>assets/vendor/dropify/js/dropify.min.js"></script>
<script src="<?php echo base_url();?>assets/js/pages/forms/dropify.js"></script>

<script src="<? echo base_url() ?>assets/bundles/fullcalendarscripts.bundle.js"></script><!--/ calender javascripts --> 

<script>
	
<? 
    $caldata = $this->db->select("tbl_counsellor_student_schedule.*")->join("tbl_councellors", "tbl_councellors.id = tbl_counsellor_student_schedule.expert_id", "left")->where("tbl_counsellor_student_schedule.expert_id", $this->session->userdata("expert_id"))->where("tbl_councellors.expert_status", "Active")->where("tbl_councellors.is_deleted", 0)->get("tbl_counsellor_student_schedule")->result();
    $cdata = [];    
    if(count($caldata) > 0){
        foreach($caldata as $cl){
            $data = [];
            $data["name"] = $this->db->get_where("tbl_councellors",["id"=>$cl->expert_id])->row()->expert_name." (".$this->db->get_where("tbl_students",["student_id"=>$cl->student_id])->row()->student_name.")";
            $data["date"] = $cl->exp_std_date;
            $data["start"] = date('H:i:s', $cl->exp_std_time);
            $data["end"] = '';
            $cdata[] = $data;
        }
    }   
    
		
?>	
	
$('#calendar').fullCalendar({
    header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay,listWeek'
    },
	defaultView: 'agendaWeek',
    defaultDate: '<? echo date("Y-m-d") ?>',
    editable: false,
    droppable: false, // this allows things to be dropped onto the calendar
    drop: function() {
        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
            // if so, remove the element from the "Draggable Events" list
            $(this).remove();
        }
    },
    eventLimit: true, // allow "more" link when too many events
    events: [
		
		<? foreach($cdata as $cd){ ?>
			{
                title: '<? echo $cd["name"] ?>',
                start: '<? echo $cd["date"] ?>T<? echo $cd["start"] ?>',
                end: '<? echo $cd["date"] ?>T<? echo $cd["end"] ?>',
				className: 'bg-dark'
			},
		<? } ?>
/*
        {
            title: 'Click for Google',
            url: 'http://google.com/',
            start: '2018-08-28',
            className: 'bg-primary'
        }
*/
    ]
});	
	
	
	
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
$(document).on("click",".btn-toggle-hide",function(){
	$(".role_name").toggle();
});
</script>


</body>
</html>
