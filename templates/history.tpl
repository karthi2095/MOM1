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
		$("#meeting").removeClass("active");
	    document.getElementById("day-wise").style.display="block";
		$("#day").addClass("active");
	    document.getElementById("dept-wise").style.display="none";
		$("#dept").removeClass("active");
	
	}else if(num == 3){
		document.getElementById("meeting-wise").style.display="none";
		$("#meeting").removeClass("active");
	    document.getElementById("day-wise").style.display="none";
		$("#day").removeClass("active");
	    document.getElementById("dept-wise").style.display="block";
		$("#dept").addClass("active");
	}else{
		
		document.getElementById("meeting-wise").style.display="block";
		$("#meeting").addClass("active");
		document.getElementById("day-wise").style.display="none";
		$("#day").removeClass("active");
		document.getElementById("dept-wise").style.display="none";
		$("#dept").removeClass("active");
	}
}
function test()
{
	//alert("");
	document.getElementById("Name").value="";
	document.getElementById("Date").value="";
	document.getElementById("ActionStatus").value="";
	
	document.forms["history"].submit();

}
</script>
 {/literal}
	</head>
	 
<!--Design Prepared by Rajasri Systems-->   
<body>
<div id="wrapper">
	
	<div style="clear:both;"></div>
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
			<li><a href="add_meeting.php" >Create Task</a></li> 
			<li><a href="controlPanel.php?div=2">Meeting Wise</a></li> 
			<li><a href="controlPanel.php?div=3" >Day Wise</a></li> 
			<li><a href="controlPanel.php?div=4" >Department Wise</a></li>  
			<li><a href="history.php" class="active">History</a></li>
		</ul>
		    <div class="clear"></div>
		 </div>
		 
		
		 <div style="margin-bottom:15px;">
		 <form name="history" action="" method="post" >
		
		    <input type="text" class="input-date" id="Name" name="Name"  value="{$smarty.request.Name}" placeholder="Meeting Name" style="background-color: #ffffff;">
			<input type="text" class="input-date" id="Date" name="Date"  value="{$smarty.request.Date}" placeholder="Meeting Date" style="background-color: #ffffff;">
			<td><select name="ActionStatus" id="ActionStatus" style="width: 150px; height:30px; border-radius: 5px;">
													<option value="">Status</option>
													<option value="Completed" {if $smarty.request.ActionStatus eq "Completed"} selected="selected" {/if}>Completed</option>
													<option value="Postpone" {if $smarty.request.ActionStatus eq "Postpone"} selected="selected" {/if}>Postpone</option>
													<option value="On Hold" {if $smarty.request.ActionStatus eq "On Hold"} selected="selected" {/if}>On Hold</option>
													<option value="Re Scheduled" {if $smarty.request.ActionStatus eq "Re Scheduled"} selected="selected" {/if}>Re Scheduled</option>
													<option value="Cancelled" {if $smarty.request.ActionStatus eq "Cancelled"} selected="selected" {/if}>Cancelled</option>
													<option value="Follow Up" {if $smarty.request.ActionStatus eq "Follow Up"} selected="selected" {/if}>Follow Up</option>
											</select>
											</td>
			<!--<input type="text" class="input-date" id="dp3" value="">
			<input type="text" class="input-date" id="dp4" value="">
			<input type="text" class="input-date" id="dp5" value="">
			<input type="text" class="input-date" id="dp6" value="">
			<input type="text" class="input-date" id="dp7" value="Target Date">-->
			
			<input type="submit" id="submit-btn" name="submit-btn" class="input-date submit-btn1"  value="Submit">
			<input type="button" class="input-date submit-btn1"  onclick="test();" value="Reset Search">
			</form>
			
			
		 </div>
		 
		 
		<div class="history-detail-div" style="width:100%">
		 <table class="history-table">
		  <thead>
			<tr>
				<th>Meeting Name</th>
				<th>Meeting Date</th>
				<th>Target Date</th>
				<th>IN Time Completion</th>
				<th>No of revision</th>
				<th>Delayed Days</th>
				<th>Status</th>
			<tr>
		  </thead>
		  <tbody>
		    {assign var="meetingId" value=0}
			{if $meet neq ""}
			 {section name=D loop=$meet}
			 {cycle values=', bg' assign=classname}
			<tr class="{$classname}">
				
				
				
				<td class="first style1" valign="top">{$meet[D].MeetingName|stripslashes|ucfirst} </td>
				
				<td class="first style1" valign="top">{$meet[D].MeetingDate|date_format:"%b %d, %Y"} </td>
				<td class="first style1" valign="top">{$meet[D].Target_Date|date_format:"%b %d, %Y"} </td>
				<td class="first style1" valign="top">{$meet[D].In_Time_Completion|stripslashes|ucfirst}</td>
				<td class="first style1" valign="top">{$meet[D].No_Of_Revision|stripslashes|ucfirst}</td>
				<td class="first style1" valign="top">{$meet[D].Delayed_Days|stripslashes|ucfirst}</td>
				
				<td class="first style1" valign="top">{$meet[D].ActionStatus|stripslashes|ucfirst} </td>
				
			
			
			{assign var="meetingId" value=$meet[D].Id}
			</tr>
				 {sectionelse}
			 <tr class="{$classname}">
			 
			 
				<td align="center" colspan="8" class="style1"><center>No datas found</center></td>
			 </tr>
				 {/section}
				 {else}
			 <tr class="{$classname}">
				<td align="center" colspan="8" class="style1"><center>No datas found</center></td>
			 </tr>
				 {/if}
			</tr>
		  </tbody>
		</table>
		</div>
		 
		 
		</div>
	     <div class="clear"></div>
   </div>
   </div>
   
	<div class="clear"></div>
  </div>
  
 
	{literal}		
<script>
/*$(function() {
    $( "#dp" ).datepicker();
});*/
$(function() {
    $( "#Date" ).datepicker({
		buttonImage: 'img/calendar_icon_1.png',
        buttonImageOnly: true,
        changeMonth: true,
        changeYear: true,
        showOn: 'both'
		});
});
/*$(function() {
    $( "#dp3" ).datepicker();
});
$(function() {
    $( "#dp4" ).datepicker();
});
$(function() {
    $( "#dp5" ).datepicker();
});
$(function() {
    $( "#dp6" ).datepicker();
});
$(function() {
    $( "#dp7" ).datepicker();
});*/
</script>
 <!--  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.js"></script>
 <script type="text/javascript">
		$("#dp1").datepicker({
		buttonImage: 'img/calendar_icon_1.png',
        buttonImageOnly: true,
        changeMonth: true,
        changeYear: true,
        showOn: 'both',
	    });
	 
	 $("#dp2").datepicker({
		buttonImage: 'img/calendar_icon_1.png',
        buttonImageOnly: true,
        changeMonth: true,
        changeYear: true,
        showOn: 'both',
		});
	
</script> --> 
{/literal}

</body>
</html>