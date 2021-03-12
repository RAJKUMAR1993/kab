
<style>
    td.details-control {
    background: url('<?php echo base_url(); ?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
    tr.shown td.details-control {
        background: url('<?php echo base_url(); ?>assets/images/details_close.png') no-repeat center center;
    }
    .col-lg-9{
        padding-left: 4px;
    }
    .fc-event, .fc-event-dot {
        background-color: #3eacff !important;
    }
    .fc .fc-view-container .fc-event {
        border: 1px solid #3a87ad !important;
    }
    .fc-time-grid-event{
        width: 100px !important;
    }
	.fc-unthemed .fc-list-item:hover td {
		background-color: #232323 !important;
	}
	
</style>

<div id="main-content">
    <div class="container-fluid">
        
        <div class="row clearfix">
            <div class="col-md-12">
                <link rel="stylesheet" href="<? echo base_url() ?>assets/vendor/fullcalendar/fullcalendar.min.css">
                <div class="card">
                    <div class="header">
                        <h2>No'of Students Scheduled Meetings</h2>                            
                    </div>
                    <div class="body">
                    
                        <div id="calendar"></div>
                    
                    </div>
                </div>
            </div>
        </div>

        
    </div>
</div>
<script type="text/javascript">
    function copyToClipboard(element){
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
    }
</script>
