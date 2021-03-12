
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
        <div class="container-fluid">
            
            <div class="row clearfix">
                
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="col-lg-9 pull-left">
                                <h2>Analytics </h2>
                            </div>
<!--                            <a href="<?php //echo base_url("institute/data/addtestimonial");?>"><button type="button" class="btn btn-primary btn-block col-lg-2 pull-right"  data-target="#addevent">Add Testimonial</button></a> <br>-->
                                                   
                        </div>
                               
                        <div class="body">
                        
                        	<div class="row">
                        		
                        		<div class="col-md-6" style="margin-bottom: 30px">
                        		
                        			 <div id="chart_div" style="width: 100%;"></div>
                        			
                        		</div>
                        		
                        		<div class="col-md-6">
                        		
                        			 <div id="meetings_div" style="width: 100%;"></div>
                        			
                        		</div>
                        		
                        		<div class="col-md-6" style="margin-bottom: 30px">
                        		
                        			 <div id="questions_div" style="width: 100%;"></div>
                        			
                        		</div>
                        		
                        		<div class="col-md-6">
                        		
                        			 <div id="appication_status_div" style="width: 100%;"></div>
                        			
                        		</div>
                        		
                        		<div class="col-md-6">
                        		
                        			 <div id="feedbackchart" style="width: 100%;height: 400px"></div>
                        			
                        		</div>
                        		
                        		<div class="col-md-6">
                        		
                        			 <div id="logintimechart" style="width: 100%;height: 400px"></div>
                        			
                        		</div>
                        		
                        	</div>	
                        
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawMultSeries);
google.charts.setOnLoadCallback(meetingschart);
google.charts.setOnLoadCallback(questionschart);
google.charts.setOnLoadCallback(appchart);
google.charts.setOnLoadCallback(feedbackChart);
google.charts.setOnLoadCallback(loginStuff);

	function drawMultSeries() {
      var data = google.visualization.arrayToDataTable([
        ['Booth', 'Students'],
        ['Booth 1', 8008000],
        ['Booth 2', 3694000],
        ['Booth 3', 2896000],
        ['Booth 4', 1953000],
        ['Booth 5', 1517000]
      ]);

      var options = {
        title: "No'of Students Visited E Booth's",
        chartArea: {width: '60%'},
        hAxis: {
          title: 'Total Students',
          minValue: 0
        },
        vAxis: {
          title: "E Booth's"
        },titleTextStyle: {
			color: "black",
			fontSize: 14,   // true of false
		} 
      };

      var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }

	function meetingschart() {
      var data = google.visualization.arrayToDataTable([
        ['Professor', 'Students'],
        ['Professor 1', 8008000],
        ['Professor 2', 3694000],
        ['Professor 3', 2896000],
        ['Professor 4', 1953000],
        ['Professor 5', 1517000]
      ]);

      var options = {
        title: "No'of Students Scheduled Meetings",
        chartArea: {width: '60%'},
        hAxis: {
          title: 'Total Students',
          minValue: 0
        },
        vAxis: {
          title: "Professor's"
        },titleTextStyle: {
			color: "black",
			fontSize: 14,   // true of false
		}
      };

      var chart = new google.visualization.BarChart(document.getElementById('meetings_div'));
      chart.draw(data, options);
    }
	
	function questionschart() {
      var data = google.visualization.arrayToDataTable([
        ['Student', 'Questions'],
        ['Student 1', 8008000],
        ['Student 2', 3694000],
        ['Student 3', 2896000],
        ['Student 4', 1953000],
        ['Student 5', 1517000]
      ]);

      var options = {
        title: "No'of Questions Asked By Students",
        chartArea: {width: '60%'},
        hAxis: {
          title: 'Total Questions',
          minValue: 0
        },
        vAxis: {
          title: "Students"
        },titleTextStyle: {
			color: "black",
			fontSize: 14,   // true of false
		}
      };

      var chart = new google.visualization.BarChart(document.getElementById('questions_div'));
      chart.draw(data, options);
    }

	function appchart() {
      var data = google.visualization.arrayToDataTable([
        ['Status', 'Students'],
        ['Pending', 8000],
        ['In Progress', 4000],
        ['Approved', 6000],
        ['Cancelled', 3000],
      ]);

      var options = {
        title: "Application Status Of Students",
        chartArea: {width: '60%'},
        hAxis: {
          title: 'Total Students',
          minValue: 0
        },
        vAxis: {
          title: "Status"
        },
		titleTextStyle: {
			color: "black",
			fontSize: 14,   // true of false
		}  
      };

      var chart = new google.visualization.BarChart(document.getElementById('appication_status_div'));
      chart.draw(data, options);
    }
	
    function feedbackChart() {

		var data = google.visualization.arrayToDataTable([
		  ['Rating', 'Students'],
		  ["Rating 5",     11],
		  ["Rating 4",      2],
		  ["Rating 3",  2],
		  ["Rating 2", 2],
		  ["Rating 1",    7]
		]);

		var options = {
		  title: 'Feedback Given By Students',
		  titleTextStyle: {
			color: "black",
			fontSize: 14,   // true of false
		  } 		
		};

		var chart = new google.visualization.PieChart(document.getElementById('feedbackchart'));
		chart.draw(data, options);
		
	}
	
	function loginStuff() {
          var data = new google.visualization.DataTable();
          data.addColumn('string', 'Student');
          data.addColumn('timeofday', 'Login Time');
          data.addRows([
            ['Student 1', [1, 30, 0]],
            ['Student 2', [2, 30, 0]],
            ['Student 3', [1, 30, 0]],
            ['Student 4', [5, 30, 0]],
            ['Student 5', [4, 30, 0]]
          ]);

         var options = {
           title: 'Average Login Time Of Students',
//           width: 500,
//           height: 300,
           legend: 'none',
           bar: {groupWidth: '95%'},
           vAxis: { gridlines: { count: 4 } },
		   titleTextStyle: {
			color: "black",
			fontSize: 14,   // true of false
		   }
         };

         var chart = new google.visualization.ColumnChart(document.getElementById('logintimechart'));
         chart.draw(data, options);

         document.getElementById('format-select').onchange = function() {
           options['vAxis']['format'] = this.value;
           chart.draw(data, options);
         };
      };


</script>
