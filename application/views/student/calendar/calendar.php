
<style>
    td.details-control {
    background: url('<?php echo base_url(); ?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
    tr.shown td.details-control {
        background: url('<?php echo base_url(); ?>assets/images/details_close.png') no-repeat center center;
    }
</style>
<?
 

      $data2='';
      if($expertmeetings){
      foreach ($expertmeetings as $row99){ 
        $data2.='{';  
         {
          $data2.='id:"'.$row99->exp_std_id.'",';
          $data2.='title:"'.'Expert Meeting : \n ( '.date('H:i A', $row99->exp_std_time).' ) ",';
          $data2.='start:"'.$row99->exp_std_date.'",';
          $data2.='backgroundColor:"#f5b733",';
          $data2.='borderColor:"#f5b733",';
        }
          $data2.="},";
      } 
  }
if($speakersmeetings){
      foreach ($speakersmeetings as $row88){ 
        $data2.='{';  
         {
          $data2.='id:"'.$row88->spe_std_id.'",';
          $data2.='title:"'.'Speaker Meeting : \n ( '.date('H:i A', $row88->spe_std_time).' ) ",';
          $data2.='start:"'.$row88->spe_std_date.'",';
          $data2.='backgroundColor:"#f5b733",';
          $data2.='borderColor:"#f5b733",';
        }
          $data2.="},";
      }
  }

  if($promeetings){
      foreach ($promeetings as $row77){ 
        $data2.='{';  
         {
          $data2.='id:"'.$row77->stid.'",';
          $data2.='title:"'.'Professor Meeting : \n ( '.date('H:i A', $row77->session_time).' ) ",';
          $data2.='start:"'.$row77->session_date.'",';
          $data2.='backgroundColor:"#f5b733",';
          $data2.='borderColor:"#f5b733",';
        }
          $data2.="},";
      }
  }
  if($admmeetings){
      foreach ($admmeetings as $row66){ 
        $data2.='{';  
         {
          $data2.='id:"'.$row66->exp_std_id.'",';
          $data2.='title:"'.'Admission Officer Meeting : \n ( '.date('H:i A', $row66->exp_std_time).' ) ",';
          $data2.='start:"'.$row66->exp_std_date.'",';
          $data2.='backgroundColor:"#f5b733",';
          $data2.='borderColor:"#f5b733",';
        }
          $data2.="},";
      }
  }



  if($webinars){
      foreach ($webinars as $row55){ 
        $data2.='{';  
         {
          $data2.='id:"'.$row55->webinar_student_id.'",';
          $data2.='title:"'.'Webinar : \n ( '.date('H:i A', $row55->from_time).' ) - ( '.date('H:i A', $row55->to_time).' ) ",';
          $data2.='start:"'.$row55->date.'",';
          $data2.='backgroundColor:"#f5b733",';
          $data2.='borderColor:"#f5b733",';
        }
          $data2.="},";
      }
  }

?>
<div id="main-content">
        <div class="container-fluid">
            
            <div class="row clearfix">
                
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="col-lg-9 pull-left">
                            	<h2>Meeting Schedule Details</h2>
                            </div>
                                                
                        </div>
                               
                        <div class="body">
                       <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
<script>
$(document).ready(function() {

    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    
    var events_array = [
        <? echo $data2; ?>
    ];

    $('#calendar').fullCalendar({
      defaultDate: moment(date),
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        selectable: true,
        events: events_array,
        eventRender: function(event, element) {
            element.attr('title', event.tip);
        },
       
     eventClick:  function(event, jsEvent, view) {
            /*$('#modalTitle').html(event.id);
          
            $(".modal-body #attnempcode").val( event.id );
            $(".modal-body #attendate").val( event.start );
            
            $('#fullCalModal').modal();*/
        }
        
        
    });
});
</script>