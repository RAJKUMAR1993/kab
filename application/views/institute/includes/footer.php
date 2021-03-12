<!-- Javascript -->
<script src="<?php echo base_url();?>assets/bundles/libscripts.bundle.js"></script>    
<script src="<?php echo base_url();?>assets/bundles/vendorscripts.bundle.js"></script>


<script src="<?php echo base_url();?>assets/bundles/chartist.bundle.js"></script> 


<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/c3.min.css">
<script src="<?php echo base_url();?>assets/js/d3.min.js"></script>
<script src="<?php echo base_url();?>assets/js/c3.min.js"></script>




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


<script src="<? echo base_url() ?>assets/bundles/fullcalendarscripts.bundle.js"></script><!--/ calender javascripts --> 

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script type="text/javascript">
$(function() {
    
<?php 
	 $gdate = explode(" - ",$this->input->get('date')); 
	 $startdate = ($gdate[0] != "") ? date("D M d Y H:i:s ",strtotime($gdate[0]))."GMT+0530" : '';
	 $enddate = ($gdate[1] != "") ? date("D M d Y H:i:s ",strtotime($gdate[1]))."GMT+0530" : '';
	
?>
	
    var start = <? if($startdate != ""){ ?> moment("<? echo date("Y-m-d",strtotime($gdate[0]));  ?>") <? }else{ ?> moment().subtract(29, 'days') <? } ?>;
    var end = <? if($enddate != ""){  ?> moment("<? echo date("Y-m-d",strtotime($gdate[1])); ?>") <? }else{ ?> moment() <? } ?>;
//    console.log(moment()); 

	
    function cb(start, end) {
		
		<? 
			if($startdate != ""){
		
				$start = date("F d, Y",strtotime($gdate[0]));
				$end = date("F d, Y",strtotime($gdate[1]));
				
		?>		
			$('#reportrange span').html("<? echo $start ?>" + ' - ' + "<? echo $end ?>");
		
		<? 
			}else{
		?>
		
			$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
		
		<?  } ?>
        
    }
	
	function cb1(start, end) {
		
		$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
		
    }
	
    $('#reportrange').daterangepicker({
        
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
          // 'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb1);

    cb1(start, end);

});
</script>



<script>
	
<? 
    $institute_id = $this->session->userdata("institute_id");
    $caldata = $this->db->select("tbl_counsellor_student_schedule.*")->join("tbl_councellors", "tbl_councellors.id = tbl_counsellor_student_schedule.expert_id", "left")->where("tbl_counsellor_student_schedule.institute_id", $this->session->userdata("institute_id"))->where("tbl_councellors.expert_status", "Active")->where("tbl_councellors.is_deleted", 0)->get("tbl_counsellor_student_schedule")->result();
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
    $presentations = $this->db->where("institute_id",$institute_id)->get("tbl_institute_presentations")->result();
    if(count($presentations) > 0){
        foreach($presentations as $cl){
            $data = [];
            $data["name"] = $this->db->get_where("tbl_institute_auditorium",["id"=>$cl->auditorium])->row()->title;
            $data["date"] = $cl->date;
            $data["start"] = date('H:i:s', $cl->from_time);
            $data["end"] = date('H:i:s', $cl->to_time);
            $cdata[] = $data;
        }
    }
    $videoconnect = $this->db->where("institute_id",$institute_id)->get("tbl_college_connect")->result();
    if(count($videoconnect) > 0){
        foreach($videoconnect as $cl){
            $data = [];
            $data["name"] = $cl->name;
            $data["date"] = $cl->date;
            $data["start"] = date('H:i:s', $cl->from_time);
            $data["end"] = date('H:i:s', $cl->to_time);
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

</script>

<!--Chat script-->

<script>

	$(".chatdataTable").dataTable();

	$(".getChat").click(function(){
		
		$("#chathistory").show();
		
		var sid = $(this).attr("sid");
		var ref = $(this).attr("ref");
		
		$.ajax({
			
			type : "post",
			url : "<? echo base_url('institute/reports/getChat') ?>",
			data : {sid:sid,ref:ref},
			beforeSend:function(){
			
				$("#preloader").html('<img src="<? echo base_url('assets/images/front/chatloader.gif') ?>" width="100%">');
				
			},
			success : function(data){
				
				console.log(data);
				$("#preloader").html("");
				$("#chathistory").html(data);
				
			},
			error : function(data){
				
				console.log(data);
				$("#preloader").html("");
				
			}
			
		})
		
	})
	
	$(document).on("click",".closeChat",function(){
	
		$("#chathistory").hide();

    })
    
	$(document).on("click",".btn-toggle-hide",function(){
        $(".role_name").toggle();
    });
	
</script>

</body>
</html>
