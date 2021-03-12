<style type="text/css">
    .header {
        display: flex;
    }
	
	.ct-chart svg g foreignObject span{
		
		color: black !important;
		
	}
	
</style>
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12">                        
                    <h2>Reports</h2>
                </div>
            </div>
        </div>

	         <div class="row clearfix">
                <div class="col-12">
                    <div class="card top_report">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <a href="<?php echo base_url('student/myapplications/admissions');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class=" icon-users text-col-blue" style="font-size:25px;"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>My Applications</h6>
                                            <span class="font700"><?php echo $details;?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-blue mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="87"></div>
                                    </div>
                                </div>
                                </a>
                            </div>
                            
                             <div class="col-lg-4 col-md-6 col-sm-6">
                                <a href="<?php echo base_url('student/meetings/councellors');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="icon-control-play text-col-blue" style="font-size:25px;"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6> Admission Officers Meetings</h6>
                                            <span class="font700"><?php echo $councellormeetings;?></span>
                                           
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-blue mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="87"></div>
                                    </div>
                                </div>
                                </a>
                            </div>
                            
                            
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <a href="<?php echo base_url('student/meetings/');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="icon-control-play text-col-blue" style="font-size:25px;"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>  Professor Meetings</h6>
                                            <span class="font700"><?php echo $meetings;?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-blue mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="87"></div>
                                    </div>
                                </div>
                                </a>
                            </div>
                            
                             <div class="col-lg-4 col-md-6 col-sm-6">
                                <a href="<?php echo base_url('student/meetings/expertmeetings');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="icon-call-in text-col-blue" style="font-size:25px;"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6> Counselors Meetings</h6>
                                            <span class="font700"><?php echo $expertmeetings;?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-blue mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="87"></div>
                                    </div>
                                </div>
                                </a>
                            </div>
                            
                             <div class="col-lg-4 col-md-6 col-sm-6">
                                <a href="<?php echo base_url('institute/reports/audio_conversations');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="icon-call-in text-col-blue" style="font-size:25px;"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>College Presentations</h6>
                                            <span class="font700"><?php echo 0;?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-blue mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="87"></div>
                                    </div>
                                </div>
                                </a>
                            </div>
                            
                             <div class="col-lg-4 col-md-6 col-sm-6">
                                <a href="<?php echo base_url('student/meetings/webinars');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="icon-speech text-col-green" style="font-size:25px;"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>Webinars</h6>
                                            <span class="font700"><?php echo $webinars;?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-green mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="87"></div>
                                    </div>
                                </div>
                                </a>
                            </div>
                            
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <a href="<?php echo base_url('student/enquiries');?>">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="fa fa-2x fa-question text-col-green"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>My Enquiries</h6>
                                            <span class="font700 onlinestudents_count"><?php echo $enquries; ?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-green mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="28"></div>
                                    </div>
                                   
                                </div>
                                </a>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>

           
             
            </div>

		
    </div>
</div>
<script type="text/javascript">
	
	
$(function() {
    var o = c3.generate({
        bindto: "#donut-chart",
        color: { pattern: ["#2962FF", "#4fc3f7", "#f62d51", "#B05AE3", "#DB7F2F"] },
        data: {
            columns: [
				<? foreach($feedback as $k => $feed){ ?>
	
					["<? echo $k ?>",<? echo $feed ?>],
	
				<? } ?>
            ],
            type: "donut",
            onclick: function(o, n) { console.log("onclick", o, n) },
            onmouseover: function(o, n) { console.log("onmouseover", o, n) },
            onmouseout: function(o, n) { console.log("onmouseout", o, n) }
        },
        donut: { title: "Feedback Rating" }
    });
});	
	
	
	
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
        series: [
            <? echo json_encode($students_visited_ebooths) ?>,
            //[3, 2, 9, 5, 4]
        ]
    };
    new Chartist.Bar('#chart_div', dataHorizontalBar, {
        height: "270px",
        seriesBarDistance: 15,
        reverseData: true,
        horizontalBars: true,
        axisY: {
            offset: 75
        }
    });

    // horizontal bar chart
    var dataHorizontalBar1 = {
        labels: dates,
        series: [
            <? echo json_encode($students_scheduled_meetings) ?>,
        ]
    };
    new Chartist.Bar('#meetings_div', dataHorizontalBar1, {
        height: "270px",
        seriesBarDistance: 15,
        reverseData: true,
        horizontalBars: true,
        axisY: {
            offset: 75
        }
    });

    // horizontal bar chart
    var dataHorizontalBar2 = {
        labels: dates,
        series: [
            <? echo json_encode($qas) ?>,
        ]
    };
    new Chartist.Bar('#questions_div', dataHorizontalBar2, {
        height: "270px",
        seriesBarDistance: 15,
        reverseData: true,
        horizontalBars: true,
        axisY: {
            offset: 75
        }
    });

    // horizontal bar chart
    var dataHorizontalBar3 = {
        labels: ['In Progress', 'Approved', 'Rejected',"Merit Scholarship"],
        series: [
            [<? echo $studentinprogressapps ?>, <? echo $studentapprovedapps ?>, <? echo $studentrejectedapps ?>, <? echo $studentmerit ?>],
        ]
    };
    new Chartist.Bar('#appication_status_div', dataHorizontalBar3, {
        height: "270px",
        seriesBarDistance: 15,
        reverseData: true,
        horizontalBars: true,
        axisY: {
            offset: 75
        }
    });

    var data = {
        labels: dates,
        series: [
            <? echo json_encode($average_time) ?>,
        ]
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

