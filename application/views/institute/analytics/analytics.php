<style type="text/css">
    .header {
        display: flex;
    }
	
	.ct-chart svg g foreignObject span{
		
		color: black !important;
		width: 70px !important;
		
	}
	
	.red-tooltip + .tooltip > .tooltip-inner {background-color: #f00 !important;}
</style>
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">                        
                    <h2>Statistics</h2>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="header">
                        <div class="col-md-9">
                            <h2>No'of Students Visited E Booth's</h2>
                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-success pull-right" target="_self" href="<? echo base_url('institute/analytics/svebooth') ?>">View</a>
                        </div>
                    </div>
                    <div class="body">
                        <div id="chart_div" class="ct-chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="header">
                        <div class="col-md-9">
                            <h2>No'of Students Scheduled Meetings</h2>
                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-success pull-right" target="_self" href="<? echo base_url('institute/analytics/ssmeetings') ?>">View</a>
                        </div>
                    </div>
                    <div class="body">
                        <div id="meetings_div" class="ct-chart"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="header">
                        <div class="col-md-9">
                            <h2>No'of Questions Asked By Students</h2>
                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-success pull-right" target="_self" href="<? echo base_url('institute/analytics/askedquestions') ?>">View</a>
                        </div>
                    </div>
                    <div class="body">
                        <div id="questions_div" class="ct-chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="header">
                        <div class="col-md-9">
                            <h2>Application Status Of Students</h2>
                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-success pull-right" target="_self" href="<? echo base_url('institute/analytics/appstatus') ?>">View</a>
                        </div>
                    </div>
                    <div class="body">
                        <div id="appication_status_div" class="ct-chart"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="header">
                        <div class="col-md-9">
                            <h2>Feedback Given By Students</h2>
                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-success pull-right" target="_self" href="<? echo base_url('institute/analytics/studentfeedback') ?>">View</a>
                        </div>
                    </div>
                    <div class="body">
                        <!--<div id="feedbackchart" class="ct-chart"></div>-->
                   		<div id="donut-chart" style="height: 276px"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="header">
                        <div class="col-md-9">
                            <h2>Total Login Time Of Students (In Minutes)</h2>
                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-success pull-right" target="_self" href="<? echo base_url('institute/analytics/studentlogintime') ?>">View</a>
                        </div>
                    </div>
                    <div class="body">
                        <div id="logintimechart" class="ct-chart"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript">
    
$(document).ready(function(){

	MorrisDonutChart();

});
function MorrisDonutChart() {

	Morris.Donut({
		element: 'donut-chart',
		data: [
			<? 

				foreach($feedback as $k => $feed){ 
			?>
			{
				label: "<?php echo $k ?> (<?php echo $feed/$total_feedback*100 ?>%)",
				value: "<?php echo $feed ?>",
			},
			<? } ?>
			],
		  labelColor: '#060',
		resize: true,
		colors: ['#2962FF', '#4fc3f7', '#f62d51', '#B05AE3']
	});
}
$(function() {
    
    var options;

    var date = new Date();
    var dates = [];
    dates.push(date.getFullYear()+'-'+(date.getMonth()+1)+'-'+date.getDate());
    for (var i = 1; i < 5; i++) {
        var dt = new Date(date.getTime() - (i * 24 * 60 * 60 * 1000));
        var fdate = dt.getFullYear()+'-'+(dt.getMonth()+1)+'-'+dt.getDate()
        dates.push(fdate);
    }

	console.log(dates);
	
	
    // horizontal bar chart
    var dataHorizontalBar = {
        labels: dates,
        series: [<? echo json_encode($students_visited_ebooths) ?>]
    };
    new Chartist.Bar('#chart_div', dataHorizontalBar, {
        height: "270px",
        seriesBarDistance: 15,
        reverseData: true,
        horizontalBars: true,
        axisY: {
            offset: 75
        },
		plugins: [
            Chartist.plugins.tooltip({
                appendToBody: true
            }),
        ]
    });

    // horizontal bar chart
    var dataHorizontalBar1 = {
        labels: dates,
        series: [<? echo json_encode($students_scheduled_meetings) ?>]
    };
    new Chartist.Bar('#meetings_div', dataHorizontalBar1, {
        height: "270px",
        seriesBarDistance: 15,
        reverseData: true,
        horizontalBars: true,
        axisY: {
            offset: 75
        },
		plugins: [
            Chartist.plugins.tooltip({
                appendToBody: true
            }),
        ]
    });

    // horizontal bar chart
    var dataHorizontalBar2 = {
        labels: dates,
        series: [<? echo json_encode($qas) ?>]
    };
    new Chartist.Bar('#questions_div', dataHorizontalBar2, {
        height: "270px",
        seriesBarDistance: 15,
        reverseData: true,
        horizontalBars: true,
        axisY: {
            offset: 75
        },
		plugins: [
            Chartist.plugins.tooltip({
                appendToBody: true
            }),
        ]
    });

    // horizontal bar chart
    var dataHorizontalBar3 = {
        labels: ['In Progress', 'Approved', 'Rejected',"Merit Scholarship"],
        series: [
            [<? echo $studentinprogressapps ?>, <? echo $studentapprovedapps ?>, <? echo $studentrejectedapps ?>, <? echo $studentmerit ?>]
        ]
    };
    new Chartist.Bar('#appication_status_div', dataHorizontalBar3, {
        height: "270px",
        seriesBarDistance: 15,
        reverseData: true,
        horizontalBars: true,
        axisY: {
            offset: 75
        },
		plugins: [
            Chartist.plugins.tooltip({
                appendToBody: true
            }),
        ]
    });

    var data = {
        labels: dates,
        series: [<? echo json_encode($average_time) ?>]
    };

    // bar chart
    options = {
        height: "270px",
        axisX: {
            showGrid: false
        },
        plugins: [
            Chartist.plugins.tooltip({
                appendToBody: true
            }),
        ]
    };
    new Chartist.Bar('#logintimechart', data, options);

});
</script>

