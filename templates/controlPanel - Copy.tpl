<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> -->
<!DOCTYPE html>
<html>
<head>
	<title>Minutes of Meeting</title>
	
<meta charset="UTF-8">

	<meta http-equiv="X-UA-Compatible" content="IE=9" />
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" href="css/all.css">
	<link rel="stylesheet" href="css/controlpanel.css">
	  <script src="js/jquery-1.12.4.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/canvasjs.min.js"></script>
  <script src="js/jquery.canvasjs.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  {literal}
<script>
function displaypanel(val)
{
	var num = val;
	//alert(num);
	if(num == 2)
	{
		document.getElementById("meeting-wise").style.display="none";
	    document.getElementById("day-wise").style.display="block";
	    document.getElementById("dept-wise").style.display="none";
	
	}else if(num == 3){
		document.getElementById("meeting-wise").style.display="none";
	    document.getElementById("day-wise").style.display="none";
	    document.getElementById("dept-wise").style.display="block";
	}else{
		
		document.getElementById("meeting-wise").style.display="block";
		document.getElementById("day-wise").style.display="none";
		document.getElementById("dept-wise").style.display="none";
	}
}
</script>
 {/literal}
</head>
<!--Design Prepared by Rajasri Systems-->   
<body>

	<div id="middle"> 
	  <div id="center-column">
		<div class="top-bar-header">
		  <h1>Control Panel</h1>
		  <div class="breadcrumbs">Homepage</div>
		</div>
		<br/>
		<div class="manage-grid">
		<div>
		<ul class="task-menu">
			<li><a href="add_meeting.php">Create Task</a></li> 
			<li><a onclick="return displaypanel(1);" >Meeting Wise</a></li> 
			<li><a onclick="return displaypanel(2);">Day Wise</a></li> 
			<li><a onclick="return displaypanel(3);">Department Wise</a></li>  
			<li><a href="#">History</a></li>
		</ul>
		<div class="clear"></div>
		</div>
		
		<div>
		<div class="task-detail-div">
		<table class="task-table">
		<tbody>
		<thead>
		<tr>
		<th colspan="4" style="background: #09549e;color: #fff; line-height: 30px;">Task Due -<input style="color: #fff;width: 90px;background: none;border: none;"id="dp" value=" 23/3/2017" />  ( Date Range Options)</th>
		</tr>
		<tr>
		<td colspan="2" class="open-bg">My Task - OPEN</td>
		<td colspan="2" class="open-bg">Task Deputed - OPEN</td>
		</tr>
		<tr style="background: #bed6ea;">
		<td class="color-red">Critical</td>
		<td>Non Critical</td>
		<td class="color-red">Critical</td>
		<td>Non Critical</td>
		</tr>
		</thead>
		</tbody>
		</table>
		<div class="clear"></div>
		</div>
		
		<div class="task-detail-div" style="float:right;">
		<table class="task-table">
		<tbody>
		<thead>
		<tr>
		<th colspan="4" style="background: #09549e;color: #fff; line-height: 30px;">ACTION STATUS Cumulative  - 23rd - March 2017</th>
		</tr>
		<tr>
		<td colspan="2" class="closed-bg">CLOSED</td>
		<td colspan="2" class="open-bg">OPEN</td>
		</tr>
		<tr style="background: #bed6ea;">
		<td class="color-green">Critical</td>
		<td>Non Critical</td>
		<td class="color-red">Critical</td>
		<td>Non Critical</td>
		</tr>
		</thead>
		</tbody>
		</table>
		
		<div class="clear"></div>
		</div>
		
		<div class="clear"></div>
		</div>
		
		
		<!-- for meeting Panel Left-->
		
		<div id="meeting-wise" style="display: block;">
			<div class="panel-left" style="width:100%">
				<div class="breakdown-div" style="width:20%;float: left;height:360px;">
					<p class="title">Critical Action Status (Meeting)</p>
					<div style="padding:20px;">
						<!-- <div class="contant-div">
							<h1>Closed <span class="color-green">25%</span></h1>
						</div> -->
						<div style="display:inline-block;width:100%;">
						<h1 style="font-size:13px;text-align:left;display:inline-block;">Closed <span class="color-red">25%</span></h1>
						<h1 style="font-size:13px;text-align:right;display:inline-block;float:right">Open <span class="color-yellow">75%</span></h1>
						</div>
						<div class="contant-div" style="width: 100%;margin: 0 auto;text-align: center;display: inline-block;">
							<a href="meeting.php?action=c&amp;status=c" style="display: inline-block;text-align: center;"><div class="progress progress-bar-vertical">
								<div class="progress-bar" role="progressbar" aria-valuenow="22.76" aria-valuemin="0" aria-valuemax="100" style="height: 25%;background:#C72430;" data-toggle="tooltip" title="" data-original-title="Closed"> 
									<span class="sr-only">25% Closed</span>
								</div>
							</div></a>
							<a href="meetings.php?action=c&amp;status=o" style="display: block;display: inline-block;text-align: center;"><div class="progress progress-bar-vertical">
								<div class="progress-bar" role="progressbar" aria-valuenow="63.59" aria-valuemin="0" aria-valuemax="100" style="height: 63.59%; background:#E59915;" data-toggle="tooltip" title="" data-original-title="Open"> 
									<span class="sr-only">75% Open</span> 
								</div>
							</div></a>
						</div>
						
						
						<!-- <div class="contant-div">
							<a href="meeting.php?action=c&amp;status=c"><div class="progress progress-bar-vertical">
								<div class="progress-bar" role="progressbar" aria-valuenow="22.76" aria-valuemin="0" aria-valuemax="100" style="height: 25%;background:#71B37C;" data-toggle="tooltip" title="" data-original-title="Closed"> 
									<span class="sr-only">25% Closed</span>
								</div>
							</div></a>
							<a href="meetings.php?action=c&amp;status=o"><div class="progress progress-bar-vertical">
								<div class="progress-bar" role="progressbar" aria-valuenow="63.59" aria-valuemin="0" aria-valuemax="100" style="height: 63.59%; background:#5290E9;" data-toggle="tooltip" title="" data-original-title="Open"> 
									<span class="sr-only">75% Open</span> 
								</div>
							</div></a>
						</div> -->
						<!-- <div class="contant-div">
						<h1>Open <span class="color-blue">75%</span></h1>
					  </div> -->
					  <div class="clear"></div>
					</div>
					<div class="clear"></div>
				</div>
				
					<div class="panel-right" style="width:43.5%;height: 360px;overflow: hidden;box-shadow: 1px 2px 2px 1px #b7a49a; ">
					
				<!--Code for Action Status this Month -->
				<div class="lead-month" style="margin-bottom:10px;height: 360px;">
					<div class="breakdown-div">
						<p class="title">Action Status Meeting</p>
						<div style="padding:20px;height: 360px;margin-top: 50px;">
							<div class="contant-div" style="/*! margin-right: 15%; */">
								<div id="critical" style="width:400px;">
								</div>
							</div>
							<a href="meetings.php?action=h&amp;status=o">
							<div class="contant-div" style=" margin-right: 15%;">
								<div id="non_critical" style="width:350px;">
								</div>
							</div></a>
							<div class="clear"></div>
						</div>
						<div class="clear"></div>
					</div>
					<div class="clear"></div>
				</div>
				
				<div class="clear"></div>
			</div>
			
			<div class="panel-left-new" style="width:35%;float: right;">
				<!--Code for Critical Action Status By -->
				<div>
					<div class="breakdown-div" style="height: 360px;">
						<p class="title">Critical Action Status By</p>
						<div id="newdiv" style="margin-top:30px;">
						</div>
						<div class="clear"></div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
		</div>
		
			</div>
		
		
			<div class="clear-1"></div>
		</div>	
		
		<!-- Panel for Day Wise  ----->
		
		<div id="day-wise" >
			<div class="panel-left" style="width:100%">
				<div class="breakdown-div" style="width:20%;float: left;height:360px;">
					<p class="title">Critical Action Status (Today)</p>
					<div style="padding:20px;">
						<!-- <div class="contant-div">
							<h1>Closed <span class="color-green">25%</span></h1>
						</div> -->
						<div style="display:inline-block;width:100%;">
						<h1 style="font-size:13px;text-align:left;display:inline-block;">Closed <span class="color-red">25%</span></h1>
						<h1 style="font-size:13px;text-align:right;display:inline-block;float:right">Open <span class="color-yellow">75%</span></h1>
						</div>
						<div class="contant-div" style="width: 100%;margin: 0 auto;text-align: center;display: inline-block;">
							<a href="meeting.php?action=c&amp;status=c" style="display: inline-block;text-align: center;"><div class="progress progress-bar-vertical">
								<div class="progress-bar" role="progressbar" aria-valuenow="22.76" aria-valuemin="0" aria-valuemax="100" style="height: 25%;background:#C72430;" data-toggle="tooltip" title="" data-original-title="Closed"> 
									<span class="sr-only">25% Closed</span>
								</div>
							</div></a>
							<a href="meetings.php?action=c&amp;status=o" style="display: block;display: inline-block;text-align: center;"><div class="progress progress-bar-vertical">
								<div class="progress-bar" role="progressbar" aria-valuenow="63.59" aria-valuemin="0" aria-valuemax="100" style="height: 63.59%; background:#E59915;" data-toggle="tooltip" title="" data-original-title="Open"> 
									<span class="sr-only">75% Open</span> 
								</div>
							</div></a>
						</div>
						
						
						<!-- <div class="contant-div">
							<a href="meeting.php?action=c&amp;status=c"><div class="progress progress-bar-vertical">
								<div class="progress-bar" role="progressbar" aria-valuenow="22.76" aria-valuemin="0" aria-valuemax="100" style="height: 25%;background:#71B37C;" data-toggle="tooltip" title="" data-original-title="Closed"> 
									<span class="sr-only">25% Closed</span>
								</div>
							</div></a>
							<a href="meetings.php?action=c&amp;status=o"><div class="progress progress-bar-vertical">
								<div class="progress-bar" role="progressbar" aria-valuenow="63.59" aria-valuemin="0" aria-valuemax="100" style="height: 63.59%; background:#5290E9;" data-toggle="tooltip" title="" data-original-title="Open"> 
									<span class="sr-only">75% Open</span> 
								</div>
							</div></a>
						</div> -->
						<!-- <div class="contant-div">
						<h1>Open <span class="color-blue">75%</span></h1>
					  </div> -->
					  <div class="clear"></div>
					</div>
					<div class="clear"></div>
				</div>
				
					<div class="panel-right" style="width:43.5%;height: 360px;overflow: hidden;box-shadow: 1px 2px 2px 1px #b7a49a; ">
					
				<!--Code for Action Status this Month -->
				<div class="lead-month" style="margin-bottom:10px;height: 360px;">
					<div class="breakdown-div">
						<p class="title">Action Status Today</p>
						<div style="padding:20px;height: 360px;margin-top: 50px;">
							<div class="contant-div" style="/*! margin-right: 15%; */">
								<div id="critical" style="width:400px;">
								</div>
							</div>
							<a href="meetings.php?action=h&amp;status=o">
							<div class="contant-div" style=" margin-right: 15%;">
								<div id="non_critical" style="width:350px;">
								</div>
							</div></a>
							<div class="clear"></div>
						</div>
						<div class="clear"></div>
					</div>
					<div class="clear"></div>
				</div>
				
				<div class="clear"></div>
			</div>
			
			<div class="panel-left-new" style="width:35%;float: right;">
				<!--Code for Critical Action Status By -->
				<div>
					<div class="breakdown-div" style="height: 360px;">
						<p class="title">Critical Action Status By</p>
						<div id="newdiv" style="margin-top:30px;">
						</div>
						<div class="clear"></div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
		</div>
		
			</div>
		
		
			<div class="clear-1"></div>
		</div>	
		
		<!---   Panel for Department Wise  ---->
		
		<div id="dept-wise" >
			<div class="panel-left" style="width:100%">
				<div class="breakdown-div" style="width:20%;float: left;height:360px;">
					<p class="title">Critical Action Status (Department)</p>
					<div style="padding:20px;">
						<!-- <div class="contant-div">
							<h1>Closed <span class="color-green">25%</span></h1>
						</div> -->
						<div style="display:inline-block;width:100%;">
						<h1 style="font-size:13px;text-align:left;display:inline-block;">Closed <span class="color-red">25%</span></h1>
						<h1 style="font-size:13px;text-align:right;display:inline-block;float:right">Open <span class="color-yellow">75%</span></h1>
						</div>
						<div class="contant-div" style="width: 100%;margin: 0 auto;text-align: center;display: inline-block;">
							<a href="meeting.php?action=c&amp;status=c" style="display: inline-block;text-align: center;"><div class="progress progress-bar-vertical">
								<div class="progress-bar" role="progressbar" aria-valuenow="22.76" aria-valuemin="0" aria-valuemax="100" style="height: 25%;background:#C72430;" data-toggle="tooltip" title="" data-original-title="Closed"> 
									<span class="sr-only">25% Closed</span>
								</div>
							</div></a>
							<a href="meetings.php?action=c&amp;status=o" style="display: block;display: inline-block;text-align: center;"><div class="progress progress-bar-vertical">
								<div class="progress-bar" role="progressbar" aria-valuenow="63.59" aria-valuemin="0" aria-valuemax="100" style="height: 63.59%; background:#E59915;" data-toggle="tooltip" title="" data-original-title="Open"> 
									<span class="sr-only">75% Open</span> 
								</div>
							</div></a>
						</div>
						
						
						<!-- <div class="contant-div">
							<a href="meeting.php?action=c&amp;status=c"><div class="progress progress-bar-vertical">
								<div class="progress-bar" role="progressbar" aria-valuenow="22.76" aria-valuemin="0" aria-valuemax="100" style="height: 25%;background:#71B37C;" data-toggle="tooltip" title="" data-original-title="Closed"> 
									<span class="sr-only">25% Closed</span>
								</div>
							</div></a>
							<a href="meetings.php?action=c&amp;status=o"><div class="progress progress-bar-vertical">
								<div class="progress-bar" role="progressbar" aria-valuenow="63.59" aria-valuemin="0" aria-valuemax="100" style="height: 63.59%; background:#5290E9;" data-toggle="tooltip" title="" data-original-title="Open"> 
									<span class="sr-only">75% Open</span> 
								</div>
							</div></a>
						</div> -->
						<!-- <div class="contant-div">
						<h1>Open <span class="color-blue">75%</span></h1>
					  </div> -->
					  <div class="clear"></div>
					</div>
					<div class="clear"></div>
				</div>
				
					<div class="panel-right" style="width:43.5%;height: 360px;overflow: hidden;box-shadow: 1px 2px 2px 1px #b7a49a; ">
					
				<!--Code for Action Status this Month -->
				<div class="lead-month" style="margin-bottom:10px;height: 360px;">
					<div class="breakdown-div">
						<p class="title">Action Status Department</p>
						<div style="padding:20px;height: 360px;margin-top: 50px;">
							<div class="contant-div" style="/*! margin-right: 15%; */">
								<div id="critical" style="width:400px;">
								</div>
							</div>
							<a href="meetings.php?action=h&amp;status=o">
							<div class="contant-div" style=" margin-right: 15%;">
								<div id="non_critical" style="width:350px;">
								</div>
							</div></a>
							<div class="clear"></div>
						</div>
						<div class="clear"></div>
					</div>
					<div class="clear"></div>
				</div>
				
				<div class="clear"></div>
			</div>
			
			<div class="panel-left-new" style="width:35%;float: right;">
				<!--Code for Critical Action Status By -->
				<div>
					<div class="breakdown-div" style="height: 360px;">
						<p class="title">Critical Action Status By</p>
						<div id="newdiv" style="margin-top:30px;">
						</div>
						<div class="clear"></div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
		</div>
		
			</div>
		
			<div class="clear-1"></div>
		</div>	
		
		<!--panel left new -->
		<div style="width:100%; display:block;">
		<!--panel right new -->
		<div class="panel-right-new" style="width:100%;margin: 10px 0px 0px 0px;">
			<div class="detail-table1" style="margin-bottom:10px;float: right; width:100%;">
					<div class="breakdown-div" style="">
						<p class="title">Actions</p>
						<div class="table-new">
							<table style="padding:10px;width:100%; height:100%; font-size:12px">
								<tbody >
							
								<tr style="background: #e59915;color: #fff !important;font-size: 16px;text-align: left;">
								<th>S No</th>
								<th>Meeting Name</th>
								<th>Meeting Date</th>
								<th>Meeting Owner</th>
								<th>Action Items</th>
								<th>Responsible Person-Dept</th>
								<th>Action Due Date</th>
								<th>Action Status</th>
								</tr>
								
								<tr style="background: #DB1412;">
									<td style="text-align:center; color:#fff;" >1</td>
									<td  style="color:#fff;">Requirement Discussion</td>
									<td style="color:#fff;">Feb 20, 2016</td>
									<td style="color:#fff;">David - 56325</td>
									<td style="color:#fff;">Need to talk with Client</td>
									<td style="color:#fff;">Suguna - Production</td>
									<td style="color:#fff;">Feb 24, 2016</td>
									<td style="color:#fff;"><span style="font-weight: bold; ">Critical</span> - Open</td>
								</tr>
								
								<tr style="background: #DB1412;">
									<td colspan="4" style="border: none;color:#fff"></td>
									<td style="color:#fff;">Initial Discussion</td>
									<td style="color:#fff;">Harikrishnan - Admin</td>
									<td style="color:#fff;">Feb 24, 2016</td>
									<td style="color:#fff;"><span  style="font-weight: bold; ">Critical</span> - open</td>
								</tr>
								<tr style="background:#DB1412;">
									<td colspan="4" style="border: none;color:#fff;"></td>
									<td style="color:#fff;">Initial Discussion</td>
									<td style="color:#fff;">Gautham Krishna - Finance</td>
									<td style="color:#fff;">Feb 24, 2016</td>
									<td style="color:#fff;"><span style="font-weight: bold;">Critical</span> - open</td>
								</tr>
								
								<tr style="background: #FFCC00;">
									<td style="text-align:center;">2</td>
									<td>Annual General Meeting</td>
									<td>Mar 02, 2017</td>
									<td>Christina - 56455</td>
									<td>Need to talk with Client</td>
									<td>Suguna - Production</td>
									<td>Mar 06, 2017</td>
									<td><span style="font-weight: bold;">Critical</span> - Open</td>
								</tr>
								<tr style="background: #FFCC00;">
									<td colspan="4" style="border: none;"></td>
									<td>Initial Discussion</td>
									<td>Harikrishnan - Admin</td>
									<td>Mar 06, 2017</td>
									<td><span style="font-weight: bold;">Critical</span> - Closed</td>
								</tr>
								<tr style="background:#FFCC00;">
									<td colspan="4" style="border: none;"></td>
									<td>Initial Discussion</td>
									<td>Gautham Krishna - Finance</td>
									<td>Mar 06, 2017</td>
									<td><span style="font-weight: bold;">High</span> - Closed</td>
								</tr>
								
								<tr style="background: #85B527;">
									<td style="text-align:center;">3</td>
									<td>Project Scope</td>
									<td>Mar 04, 2017</td>
									<td>David - 56325</td>
									<td>Need to talk with Client</td>
									<td>Suguna - Production</td>
									<td>Mar 06, 2017</td>
									<td><span style="font-weight: bold;">Critical</span> - Open</td>
								</tr>
								<tr style="background: #85B527;">
									<td colspan="4" style="border: none;"></td>
									<td>Initial Discussion</td>
									<td>Harikrishnan - Admin</td>
									<td>Mar 06, 2017</td>
									<td><span style="font-weight: bold;">Critical</span> - Closed</td>
								</tr>
								<tr style="background: #85B527;">
									<td colspan="4" style="border: none;"></td>
									<td>Initial Discussion</td>
									<td>Gautham Krishna - Finance</td>
									<td>Mar 06, 2017</td>
									<td><span style="font-weight: bold;">High</span> - Closed</td>
								</tr>
								
								</tbody>
							</table>
						</div>
						<div class="clear"></div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
		</div>
			<div class="clear-1"></div></div><!--Panel Center -->
			<div class="panel-center">
				<div>
					<div class="clear"></div>
				</div>
				
				<!--Code for Critical Action Status By -->
				<div style="margin:10px 0px;">
					<!-- <div class="breakdown-div">
						<p class="title">Top Social Media Channels</p>
							<br/>
							<div>
								<div style="width:12.5%;margin:0 auto;text-align:center;float:left;">
									<img src="img/facebook-icon.png" style="width: 50px;">
								</div>
								<div style="width:12.5%;margin:0 auto; text-align:center;float:left;">
									<h1 style="margin: 5px 0px;font-size: 27px;text-align: center;font-weight:bold;"><span>26,472</span></h1>
									<p style="text-align: center;">Likes</p>
								</div>
								<div style="width:12.5%;margin:0 auto;text-align:center;float:left;">
									<img src="img/icon-twitter.png" style="width: 50px;">
								</div>
								<div style="width:12.5%;margin:0 auto; text-align:center;float:left;">
									<h1 style="margin: 5px 0px;font-size: 27px;text-align: center;font-weight:bold;"><span>26,472</span></h1>
									<p style="text-align: center;">Likes</p>
								</div>
								<div style="width:12.5%;margin:0 auto;text-align:center;float:left;">
									<img src="img/icon-youtube.png" style="width: 50px;">
								</div>
								<div style="width:12.5%;margin:0 auto; text-align:center;float:left;">
									<h1 style="margin: 5px 0px;font-size: 27px;text-align: center;font-weight:bold;"><span>26,472</span></h1>
									<p style="text-align: center;">Likes</p>
								</div>
								<div style="width:12.5%;margin:0 auto;text-align:center;float:left;">
									<img src="img/LinkedIn-icon.png" style="width: 50px;">
								</div>
								<div style="width:12.5%;margin:0 auto; text-align:center;float:left;">
									<h1 style="margin: 5px 0px;font-size: 27px;text-align: center;font-weight:bold;"><span>26,472</span></h1>
									<p style="text-align: center;">Likes</p>
								</div>
								<div class="clear"></div>
							</div>
							<div class="clear"></div>
						<div class="clear"></div>
					</div> -->
				</div>
				<div class="clear"></div>
			</div>
		</div>
	 </div>
	 <div class="clear"></div>
	</div>
	
	<div class="clear"></div>
</div>
	{literal}
<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
 $('[data-toggle="tooltip"]').tooltip(); 

window.onload = function() {
	// Code for pie chart
	google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawChart);

	function drawChart() {
		var pie_data = new google.visualization.arrayToDataTable([
		  ['Action Status', 'Closed Open'],
		  ['Closed',     6],
		  ['Open',      4],
		]);

		var pie_data1 = new google.visualization.arrayToDataTable([
		  ['Action Status', 'Closed Open'],
		  ['Closed', 3],
		  ['Open',7 ],
		]);
		var piechart_options = {title:'Critical',
						 is3D: true,
					   width:375,
					   height:200,
					   fontSize:13,
					   fontWeight:"lighter",
					   slices: {0: {color: '#C72430'}, 1:{color: '#E59915'}}
					 };
					   
		var piechart = new google.visualization.PieChart(document.getElementById('critical'));
		piechart.draw(pie_data, piechart_options);
		google.visualization.events.addListener(piechart, 'select', function() {
			var selection = piechart.getSelection();
			var mapvar = JSON.stringify(selection);
			var result = JSON.parse(mapvar);
			var page=result[0].row;
			if(page=='0'){
				window.location.href="meetings.php?action=c&status=c";
			}else if(page=='1'){
				window.location.href="meetings.php?action=c&status=o";
			}
			
		});
		
		var piechart1_options = {title:'Non Critical',
					 is3D: true,
					   width:360,
					   height:200,
					   fontSize:13,
					   fontWeight:"lighter",
					   slices: {0: {color: '#C72430'}, 1:{color: '#E59915'}}
					   };
					   
		var piechart_new = new google.visualization.PieChart(document.getElementById('non_critical'));
		piechart_new.draw(pie_data1, piechart1_options);
		google.visualization.events.addListener(piechart_new, 'select', function() {
			var selection = piechart_new.getSelection();
			var mapvar = JSON.stringify(selection);
			var result = JSON.parse(mapvar);		
			var page = result[0].row;
			if(page=='0'){
				window.location.href="meetings.php?action=h&status=c";
			}else if(page=='1'){
				window.location.href="meetings.php?action=h&status=o";
			}
		});
		
	}
	// Code for column chart 
	google.charts.load('current', {'packages': ['bar'], 'callback': drawCharts});
	function drawCharts() {
	   var data = new google.visualization.arrayToDataTable([
		  ['Department', 'Closed', 'Open'],
		  ['Production', 5, 8],
		  ['Sales', 4, 5],
		  ['Finance', 6, 8],
		  ['R&D', 5, 7],
		  ['Admin', 4, 7]
		]);

		var options = {
		 width: 435,
		 height: 250,
		  chart: {
			title: '',
		  },
		  bars: 'horizontal', // Required for Material Bar Charts.
		  colors: ['#C72430','#E59915'],
		  
		};

		var chart = new google.charts.Bar(document.getElementById('newdiv'));		
		chart.draw(data, options);
		google.visualization.events.addListener(chart, 'select', function() {
			var selection = chart.getSelection();
			var mapvar = JSON.stringify(selection);
			//alert(mapvar);
			var result = JSON.parse(mapvar);
			var row = result[0].row;
			var column=result[0].column;
			
			if((row=='0' && column=='1') || (row=='1' && column=='1') || (row=='2' && column=='1') || (row=='3' && column=="1") || (row=='4' && column=='1')){
				window.location.href="meetings.php?action=c&status=c";
			}else if((row=='0' && column=='2') || (row=='1' && column=='2') || (row=='2' && column=='2') || (row=='3' && column=="2") || (row=='4' && column=='2')){
				window.location.href="meetings.php?action=c&status=o";
			}
		});
	  }
}

	
	  
</script>
<script type="text/javascript">
          $("#dp").datepicker({
        buttonImage: 'img/calendar_icon_1.png',
        buttonImageOnly: true,
        changeMonth: true,
        changeYear: true,
        showOn: 'both',
		
     });
        </script>
	{/literal}
</body>
</html>