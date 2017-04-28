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
	{literal}
  <script src="js/jquery-1.12.4.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/canvasjs.min.js"></script>
  <script src="js/jquery.canvasjs.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  
<script>
function displaypanel(val)
{
	var num = val;
	
	if(num == 2)
	{
		//document.getElementById("meeting-wise").style.visibility="hidden";
		$("#meeting").removeClass("active");
		$("#meeting-wise").addClass("chart");

		$("#day-wise").removeClass("chart");
	    document.getElementById("day-wise").style.visibility="visible";
		$("#day").addClass("active");
		
	    //document.getElementById("dept-wise").style.visibility="hidden";
		$("#dept").removeClass("active");
		$("#dept-wise").addClass("chart");
		
	
	}else if(num == 3){
		//document.getElementById("meeting-wise").style.visibility="hidden";
		$("#meeting").removeClass("active");
		$("#meeting-wise").addClass("chart");
		
	   // document.getElementById("day-wise").style.visibility="hidden";
		$("#day").removeClass("active");
		$("#day-wise").addClass("chart");
		
		$("#dept-wise").removeClass("chart");
	    document.getElementById("dept-wise").style.visibility="visible";
		$("#dept").addClass("active");
	}else{
		$("#meeting-wise").removeClass("chart");
		document.getElementById("meeting-wise").style.visibility="visible";
		$("#meeting").addClass("active");
		
		//document.getElementById("day-wise").style.visibility="hidden";
		$("#day").removeClass("active");
		$("#day-wise").addClass("chart");
		
		//document.getElementById("dept-wise").style.visibility="hidden";
		$("#dept").removeClass("active");
		$("#dept-wise").addClass("chart");
		
	}
}
$( document ).ready(function() {

	var qryString=window.location.search.substring(1);
	var qryArr=qryString.split("=");
	var value=qryArr[1];
	
	//alert(value);
    
    if(value == 3)
    { 
    	//document.getElementById("meeting-wise").style.visibility="hidden";
		$("#meeting").removeClass("active");

		$("#day-wise").removeClass("chart");
	    document.getElementById("day-wise").style.visibility="visible";
		$("#day").addClass("active");
		
	    //document.getElementById("dept-wise").style.visibility="hidden";
		$("#dept").removeClass("active");
     }
    else if(value == 4)
    { 
    	//document.getElementById("meeting-wise").style.visibility="hidden";
		$("#meeting").removeClass("active");
		
	   // document.getElementById("day-wise").style.visibility="hidden";
		$("#day").removeClass("active");
		
		$("#dept-wise").removeClass("chart");
	    document.getElementById("dept-wise").style.visibility="visible";
		$("#dept").addClass("active");
    } 
    else
    {
    	$("#meeting-wise").removeClass("chart");
		document.getElementById("meeting-wise").style.visibility="visible";
		$("#meeting").addClass("active");
		//document.getElementById("day-wise").style.visibility="hidden";
		$("#day").removeClass("active");
		
		//document.getElementById("dept-wise").style.visibility="hidden";
		$("#dept").removeClass("active");
     }
});
</script>

 {/literal}
</head>
<!--Design Prepared by Rajasri Systems-->   
<body>

	<div id="middle"> 
	  <div id="center-column">
		<div class="top-bar-header">
		  <h1>Homepage</h1>
		  <div class="breadcrumbs">Homepage</div>
		</div>
		<br/>
		<div class="manage-grid">
		<div>
		<ul class="task-menu">
			<li><a href="add_meeting.php" >Create Task</a></li> 
			<li><a onclick="return displaypanel(1);" id="meeting" class="active" >Meeting Wise</a></li> 
			<li><a onclick="return displaypanel(2);" id="day" >Day Wise</a></li> 
			<li><a onclick="return displaypanel(3);" id="dept" >Department Wise</a></li>  
			<li><a href="history.php">History</a></li>
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
		
		<div id="meeting-wise" class="chart">
			<div class="panel-left" style="width:100%">
				<div class="breakdown-div" style="width:20%;float: left;height:360px;">
					<p class="title">Task Total</p>
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
								<div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height: 25%;background:#C72430;" data-toggle="tooltip" title="" data-original-title="Closed"> 
									<span class="sr-only">25% Closed</span>
								</div>
							</div></a>
							<a href="meetings.php?action=c&amp;status=o" style="display: block;display: inline-block;text-align: center;"><div class="progress progress-bar-vertical">
								<div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height: 63.59%; background:#E59915;" data-toggle="tooltip" title="" data-original-title="Open"> 
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
						<p class="title">Task break up</p>
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
			
			<div class=" -new" style="width:35%;float: right;">
				<!--Code for Critical Action Status By -->
				<div>
					<div class="breakdown-div" style="height: 360px;">
						<p class="title">Meeting Wise Task</p>
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
		
		<div id="day-wise" class="chart">
			<div class="panel-left" style="width:100%">
				<div class="breakdown-div" style="width:20%;float: left;height:360px;">
					<p class="title">Task Total</p>
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
						<p class="title">Task break up</p>
						<div style="padding:20px;height: 360px;margin-top: 50px;">
							<div class="contant-div" style="/*! margin-right: 15%; */">
								<div id="critical1" style="width:400px;">
								</div>
							</div>
							<a href="meetings.php?action=h&amp;status=o">
							<div class="contant-div" style=" margin-right: 15%;">
								<div id="non_critical1" style="width:350px;">
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
						<p class="title">Day Wise Task</p>
						<div id="newdiv1" style="margin-top:30px;">
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
		
		<div id="dept-wise" class="chart">
			<div class="panel-left" style="width:100%">
				<div class="breakdown-div" style="width:20%;float: left;height:360px;">
					<!--<p class="title">Critical Action Status (Department)</p>-->
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
						<p class="title">Open - Tasks</p>
						<div style="padding:20px;height: 360px;margin-top: 50px;">
							<div class="contant-div" style="/*! margin-right: 15%; */">
								<div id="critical2" style="width:400px;">
								</div>
							</div>
							<a href="meetings.php?action=h&amp;status=o">
							<div class="contant-div" style=" margin-right: 15%;">
								<div id="non_critical2" style="width:350px;">
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
						<p class="title">Department Wise Critical</p>
						<div id="newdiv2" style="margin-top:30px;">
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
							<table style="padding:10px;width:100%; height:100%; font-size:12px;table-layout: fixed;">
								<tbody >
							
								<tr style="background: #09549e;color: #fff !important;font-size: 16px;text-align: left;">
								<th style="width: 4%; color:#fff;">S No </th>
								<th style="width: 15%; color:#fff;">Meeting Name</th>
								<th style="width: 10%;color:#fff;">Meeting Date</th>
								<th style="width: 10%;color:#fff;">Meeting Owner</th>
								<th style="width: 15%;color:#fff;">Action Items</th>
								<th style="width: 15%;color:#fff;">Responsible Person-Dept</th>
								<th style="width: 15%;color:#fff;">Action Due Date</th>
								<th style="width: 10%;color:#fff;/*! -webkit-user-select: ; */">Action Status</th>
								</tr>
								
			{assign var="meetingId" value=0}
			{assign var="i" value=1}
			{if $rec neq ""}
			{section name=D loop=$rec}
			
				{if $dat eq $rec[D].MeetingDate}
				<tr style="background: #85B527;">
				{elseif $dat ge $rec[D].MeetingDate}
				<tr style="background: #DB1412;">
				{elseif $dat le $rec[D].MeetingDate}
				<tr style="background: #FFCC00;">
				{/if}
									<td style="text-align:center;">{$i++}</td>
									<td>{$rec[D].MeetingName} </td>
									<td>{$rec[D].MeetingDate|date_format:"%B %d, %Y"}</td>
									<td>{$objManageUser->getOwnernameById($rec[D].MeetingOwnerUserID)}</td>
									<td colspan="4" style="padding:0;">
									<table style="width:100%;">
									<tbody>
									{$objManageUser->getActionnameById($rec[D].Id)}
									{section name=C loop=$act}
									<tr>
							
										<td style="width: 27.3%;">{$act[C].ActionItem}</td>
										<td style="width: 27.3%;">{$objManageUser->Getdepartment($act[C].DepartmentId)} - {$objManageUser->getOwnernameById($act[C].DepatuserId)}</td>
										<td style="width: 27.3%;">{$act[C].DueDate|date_format:"%B %d, %Y"}</td>
										<td><span style="font-weight: bold; ">Critical</span> - {$act[C].StatusOfAction}</td>
									
									</tr>
									{/section}
									
										<!--<ul id="editlist" style="display:none;">
										<li><a href="#">Edit Team</a></li>        
										<li><a href="#">Remove Owner</a></li>        
										<li><a href="#">Replace Owner</a></li>        
										<li><a href="#">Add Co-Owner</a></li>        
										<li><a href="#">Delete Team</a></li>        
										</ul>-->
										</div>
									  </td>
								   </tr> 
								   </tbody>
								 </table>
							  </td>
								</tr>
								{/section}
								{/if}
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
<!--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByQxZlZJutSuzrM1_ru1IABvEukZiOywA&callback=initMap" type="text/javascript"></script>-->
 
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
		  ['Closed', 5],
		  ['Open', 5],
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
		
		/* --- for Day wise -----------*/
		
		var pie_data = new google.visualization.arrayToDataTable([
		  ['Action Status', 'Closed Open'],
		  ['Closed',     3],
		  ['Open',      7],
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
					   
		var piechart = new google.visualization.PieChart(document.getElementById('critical1'));
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
					   
		var piechart_new = new google.visualization.PieChart(document.getElementById('non_critical1'));
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
		
		/* --- for Department wise -----------*/
		
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
					   
		var piechart = new google.visualization.PieChart(document.getElementById('critical2'));
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
					   
		var piechart_new = new google.visualization.PieChart(document.getElementById('non_critical2'));
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
			title: ''
		  },
		  bars: 'horizontal', // Required for Material Bar Charts.
		  colors: ['#C72430','#E59915']
		  
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
		
		
		/* -------------for Day wise column chart------------ */
		
		var data1 = new google.visualization.arrayToDataTable([
		  ['Department', 'Closed', 'Open'],
		  ['Production', 5, 8],
		  ['Sales', 4, 5],
		  ['Finance', 6, 8],
		  ['R&D', 5, 7],
		  ['Admin', 4, 7]
		]);

		var options1 = {
		 width: 435,
		 height: 250,
		  chart: {
			title: ''
		  },
		  bars: 'horizontal', // Required for Material Bar Charts.
		  colors: ['#C72430','#E59915']
		  
		};

		var chart = new google.charts.Bar(document.getElementById('newdiv1'));		
		chart.draw(data1, options1);
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
		
		/*----------- for Department wise column chart----------------*/
		
		var data2 = new google.visualization.arrayToDataTable([
		  ['Department', 'Closed', 'Open'],
		  ['Production', 5, 8],
		  ['Sales', 4, 5],
		  ['Finance', 6, 8],
		  ['R&D', 5, 7],
		  ['Admin', 4, 7]
		]);

		var options2 = {
		 width: 435,
		 height: 250,
		  chart: {
			title: ''
		  },
		  bars: 'horizontal', // Required for Material Bar Charts.
		  colors: ['#C72430','#E59915']
		  
		};

		var chart = new google.charts.Bar(document.getElementById('newdiv2'));		
		chart.draw(data2, options2);
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
};

	
	  
</script>
<script type="text/javascript">
          $("#dp").datepicker({
        buttonImage: 'img/calendar_icon_1.png',
        buttonImageOnly: true,
        changeMonth: true,
        changeYear: true,
        showOn: 'both'
		
     });
        </script>
	{/literal}
</body>
</html>