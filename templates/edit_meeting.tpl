<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Minutes of Meeting</title>
	<meta http-equiv="X-UA-Compatible" content="IE=9" />
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" href="css/all.css">
	<link rel="stylesheet" href="css/wickedpicker.css">
	 <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
         
 {literal}        
      <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<script>
function GoBack()
{  
	window.location 		='manage_meeting.php';
}
function catvalid()
{ 
	
	//var email = /^([A-Za-z0-9_\-\.])+\@([A-Za-z_\-\.])+\.([A-Za-z]{2,4})$/;
		
	document.getElementById('errmsg').innerHTML='';
	document.getElementById('sucmsg').innerHTML='';
	
	MeetingName=document.getElementById('MeetingName').value;
	meetingtype=document.getElementById('meetingtype').value;
	MeetingDate=document.getElementById('datepicker').value;
	ProgramName=document.getElementById('ProgramName').value;
	ProjectName=document.getElementById('ProjectName').value;
	part=document.getElementById('part').value;
	DepartmentName=document.getElementById('DepartmentName').value;
	Department_user=document.getElementById('department_user').value;
	InfoProvidedDesc=document.getElementById('InfoProvidedDesc').value;
	ActionItem=document.getElementById('ActionItemId_1').value;
	DueDate=document.getElementById('datepickerid_1').value;
	ActionStatus=document.getElementById('ActionStatus').value;
	upload_file=document.getElementById('upload_file').value;
	TargetDate=document.getElementById('TargetDate').value;
	completion=document.getElementById('completion').value;
	revision=document.getElementById('revision').value;
	Delayed=document.getElementById('Delayed').value;
	time=document.getElementById('time').value;
	venue=document.getElementById('venue').value;
	Discussion=document.getElementById('Discussion').value;
	
	if(MeetingName==''){
	
		document.getElementById('errmsg').innerHTML='Please enter the Meeting Name';
		document.getElementById('MeetingName').focus();
		return false;
	 }
	 if(meetingtype=='0'){
		document.getElementById('errmsg').innerHTML='Please enter the Meeting Type';
		document.getElementById('meetingtype').focus();
		return false;
	 }
	if(MeetingDate==''){
		document.getElementById('errmsg').innerHTML='Please select the Meeting Date';
		document.getElementById('datepicker').focus();
		return false;
	 }
	
	if(ProgramName.trim()==''){
		document.getElementById('errmsg').innerHTML='Please enter the Program Name';
		document.getElementById('ProgramName').focus();
		return false;
	 }
	
	if(ProjectName.trim()==''){
		document.getElementById('errmsg').innerHTML='Please enter the Project Name';
		document.getElementById('ProjectName').focus();
		return false;
	 }
	if(TargetDate==''){
		document.getElementById('errmsg').innerHTML='Please enter the Target Date';
		document.getElementById('TargetDate').focus();
		return false;
	 }
	 if(time==''){
		document.getElementById('errmsg').innerHTML='Please enter the Meeting time';
		document.getElementById('time').focus();
		return false;
	 }
	 if(completion==''){
		document.getElementById('errmsg').innerHTML='Please enter In time completion';
		document.getElementById('completion').focus();
		return false;
	 }
	 if(revision==''){
		document.getElementById('errmsg').innerHTML='Please enter the No of revision';
		document.getElementById('revision').focus();
		return false;
	 }
	 if(Delayed==''){
		document.getElementById('errmsg').innerHTML='Please enter the Delayed days';
		document.getElementById('Delayed').focus();
		return false;
	 }
	 
	 if(venue==''){
		document.getElementById('errmsg').innerHTML='Please enter the Meeting venue';
		document.getElementById('venue').focus();
		return false;
	 }
	
	 
	 if(part==''){
	
		document.getElementById('errmsg').innerHTML='Please select atleast one Participation';
		document.getElementById('part').focus();
		return false;
	 }
	 if(Discussion==''){
			
			document.getElementById('errmsg').innerHTML='Please enter the Discussion';
			document.getElementById('Discussion').focus();
			return false;
		 }
	if(DepartmentName=='0'){
	
		document.getElementById('errmsg').innerHTML='Please select the DepartmentName';
		document.getElementById('DepartmentName').focus();
		return false;
	 }
	 
	if(Department_user=='0'){
		document.getElementById('errmsg').innerHTML='Please select the Department_user';
		document.getElementById('department_user').focus();
		return false;
	 }
	if(InfoProvidedDesc.trim()==''){
		document.getElementById('errmsg').innerHTML='Please enter the InfoProvidedDesc';
		document.getElementById('InfoProvidedDesc').focus();
		return false;
	 }
	if(ActionItem.trim()==''){
		document.getElementById('errmsg').innerHTML='Please enter the ActionItem';
		document.getElementById('ActionItemId_1').focus();
		return false;
	 }
	if(DueDate==''){
		
		document.getElementById('errmsg').innerHTML='Please select the DueDate';
		document.getElementById('datepickerid_1').focus();
		return false;
	 }
	if(ActionStatus==''){
		document.getElementById('errmsg').innerHTML='Please select the ActionStatus';
		document.getElementById('ActionStatus').focus();
		return false;
	 }
	/* if(upload_file==''){
			document.getElementById('errmsg').innerHTML='Please select the upload file';
			document.getElementById('upload_file').focus();
			return false;
		 }*/
	document.getElementById('hdAction').value=1;
	
}

function getDepartmentUser(val)
  {
  	
  	$.ajax({
  		url: 'Getdepartmentuser.php',
  		type: "POST",
  		data:"departmentuser="+val,
  		success: function(data) {
	  		//alert(data); 
  			document.getElementById("teamrow").innerHTML=data;
  					
  		}
  	});
  	
  }
function getDepartmentUserLoop(cnt,val)
 {
 	
 	$.ajax({
 		url: 'Getdepartmentuserloop.php',
 		type: "POST",
 		data:"departmentuse="+val+"&departmentcnt="+cnt,
 		success: function(data) {
	  		//alert(data); 
 			document.getElementById("teamrowloop"+cnt).innerHTML=data;
 					
 		}
 	});
 	
 }


 function ActionItem()
	 {
	
	var i=document.getElementById('Actionitem').value;
	var j=1;
	if(i<=5)
	{
		if(i == 0)
		{
			var tot=i + 1; 
		}
		else if(i == 5)
		{
		 var tot=i;
		}
		else
		{
			var tot=(parseInt(i) + 1); 
		
		}
	 
	}
	document.getElementById('Actionitem').value=tot;
	
	}
function ActionItemdelete()
{
	 
var i=document.getElementById('Actionitem').value;
if(i<=5)
{
	
if(i == 5)
	{
	var tot=i - 1; 
	}
	else if(i==1)
	{
	 var tot=i;
	}
	else
	{
		var tot=(parseInt(i) - 1); 
	}
}
document.getElementById('Actionitem').value=tot;

}

	function calladd(a)
	{
		
		//var actionitems=document.getElementsByClassName("actionitems");
		//alert("2");
		//var a=actionitems.length;
		//alert(a);

		//if(a<=5)
		//{
		
			//a=parseInt(a)+1;
			document.getElementById('action'+a).style.display='block';
			//alert("3");
		//}
		//alert("4");	
	}
	
	function callclose(a)
	{
		
		document.getElementById('action'+a).style.display='none';
	}

	 
       jQuery(function($){
           $( "#datepicker" ).datepicker({minDate: 0});
           $(".dtpicker").datepicker({minDate: 0});
		});
       function changedept(dept) {       	
           $.ajax({
           		url: "getdept.php?dept="+dept, 
           		success: function(result){
           			$(".department-user").html(result);
       		}
       	});
          }

       
       
 </script>
{/literal}	

</head>
<!--Design Prepared by Rajasri Systems-->   
<body>
<div id="middle"> 
<form name="add_meet" id="add_meet" action="" method="post" onsubmit="return catvalid();">
		<input type="hidden" name="CatIdent">
		<input type="text" name="Ident" value="{$smarty.request.Ident}">
		<input type="hidden" name="hdIdent">
		<input type="hidden" name="hdAction" id="hdAction">
			<input type="hidden" name="Actionitem" id="Actionitem" value="{$count}">
  <div id="center-column">
    <div class="top-bar-header">
      <h1>Minutes of Meeting</h1>
      <div class="breadcrumbs"><a href="controlPanel.php">Homepage</a> >> <a href="manage_meeting.php"> Minutes of Meeting </a> >>  Edit Meeting</div>
    </div>
    <div class="select-bar">
					
					<div align="right"><img src="img/back.gif" title="Back" alt="Back" width="32" height="32" class="navigation_link" style="cursor:pointer;margin-right: 230px;" onclick="GoBack();"/></div>
			  </div>
    <div class="manage-grid">
    <div align="center" class="Error" id="errmsg" style="color:red;">{$ErrorMessage}</div>
	<div align="center" class="Success" id="sucmsg" style="color:green;">{$SuccessMessage}</div>
		<table border="0" cellpadding="2" cellspacing="0" class="grid-table" style="width: 70%; margin-left: 190px;">
			
			<tr>
				<td width="30%" style="padding: 15px;">
				Meeting Name:<span class="mandatory" style="color:red">*</span></td>
				<td><input type="text" name="MeetingName" id="MeetingName" value="{$meet.0.MeetingName|stripslashes|htmlspecialchars}" size="30"></td>
			</tr>
			<tr>
				<td width="30%" style="padding: 15px;">Meeting Type:<span
					class="mandatory" style="color: red">*</span></td>
					<td><select name="meetingtype" id="meetingtype"
							style="width: 32%;">
							<option value="0">--Select--</option> {section name=S loop=$type}
							<option value="{$type[S].Id}" {if $type[S].Id eq $meet.0.MeetingType} selected="selected" {/if}>{$type[S].Meeting_Type|stripslashes|htmlspecialchars}</option>
								{/section}
							</select>
				</td>
			</tr>
			<tr>
				<td style="padding: 15px;">Meeting Date:<span class="mandatory" style="color:red">*</span></td>
				<td><input type="text" name="datepicker" id="datepicker" value="{$meet.0.MeetingDate|stripslashes|htmlspecialchars}" size="30"/></td>
			</tr>
			<tr>
				<td style="padding: 15px;">Program Name:<span class="mandatory" style="color:red">*</span></td>
				<td><input type="text" name="ProgramName" id="ProgramName" value="{$meet.0.ProgramName|stripslashes|htmlspecialchars}" size="30"></td>
			</tr>
			<tr>
				<td style="padding: 15px;">Project Name:<span class="mandatory" style="color:red">*</span></td>
				<td><input type="text" name="ProjectName" id="ProjectName" value="{$meet.0.ProjectName|stripslashes|htmlspecialchars}" size="30"></td>
			</tr>
			<tr>
											<td style="padding: 15px;">Target Date:<span
												class="mandatory" style="color: red">*</span></td>
											<td><input type="text" name="TargetDate" id="TargetDate" class="dtpicker"
												value="{$meet.0.Target_Date|stripslashes|date_format:"%m/%d/%Y"}" size="30">
											
											</td>
											
											<tr>
											<td style="padding: 15px;">Meeting time:<span
												class="mandatory" style="color: red">*</span></td>
											<td><input type="text" name="time" id="time"
												value="{$meet.0.Meeting_Time|stripslashes|htmlspecialchars}" class="timepicker set-time" size="30">
											
											</td>
										</tr>
										</tr>
										<tr>
											<td style="padding: 15px;">In time completion:<span
												class="mandatory" style="color: red">*</span></td>
											<td><input type="text" name="completion" id="completion"
												value="{$meet.0.In_Time_Completion|stripslashes|htmlspecialchars}" class="timepicker1 set-time" size="30">
											
											</td>
										</tr>
										<tr>
											<td style="padding: 15px;">No of revision:<span
												class="mandatory" style="color: red">*</span></td>
											<td><input type="text" name="revision" id="revision"
												value="{$meet.0.No_Of_Revision|stripslashes|htmlspecialchars}" size="30">
											
											</td>
										</tr>
										<tr>
											<td style="padding: 15px;">Delayed days:<span
												class="mandatory" style="color: red">*</span></td>
											<td><input type="text" name="Delayed" id="Delayed"
												value="{$meet.0.Delayed_Days|stripslashes|htmlspecialchars}" size="30">
											
											</td>
										</tr>
										
										
										<tr>
											<td style="padding: 15px;">Meeting venue:<span
												class="mandatory" style="color: red">*</span></td>
											<td><input type="text" name="venue" id="venue"
												value="{$meet.0.Meeting_Venue|stripslashes|htmlspecialchars}" size="30">
											
											</td>
										</tr>
			
			
										<tr>
											<td style="padding: 15px;">Participant:<span
												class="mandatory" style="color: red">*</span></td>
											<td><select name="part[]" id="part" style="width: 32%;" multiple>
												
												{section name=C loop=$user}
												{assign var="avail" value="not found"}
												{assign var="part" value=$meet.0.Participation}
												{section name=S loop=$part}
												{if $part[S] eq $user[C].Id}
												{assign var="avail" value="found"}{/if}{/section}
													<option value="{$user[C].Id}"{if $avail eq "found"} selected="selected" {/if}>{$user[C].EmployeeName}</option>
													
													{/section}
											</select>
											</td>
											</tr>
												<tr>
											<td style="padding: 15px;" valign="top">Discussion:<span class="mandatory" style="color: red">*</span>
											</td>
											<td style="padding-top: 10px; padding-bottom: 10px;"><textarea
													name="Discussion" id="Discussion" rows="6"
													cols="70">{$meet.0.Discussion|stripslashes|htmlspecialchars}</textarea>
											</td>
										</tr>
							<tr>
							<td style="padding: 15px;">Meeting Owner:<span class="mandatory" style="color:red">*</span></td>
							<td>
				
					<select name="DepartmentName" id="DepartmentName" style="width: 32%;" onChange="getDepartmentUser(this.value);">
						<option value="0">--Select--</option>
						{section name=D loop=$dept}
						<option value="{$dept[D].Id}" {if $dept[D].Id eq $meet.0.MeetingOwnerDepartmentID} selected="selected" {/if}>{$dept[D].DepartmentName}</option>
				
					{/section}
					</select>
					<div class="department-user" style="width: 40%;margin-right: 36px;float: right;">
						<div id="teamrow">
						<select name="department_user" id="department_user">
						<option value="0">--Select User--</option>
						{section name=D loop=$use}
						<option value="{$use[D].Id}" {if $use[D].Id eq $meet.0.MeetingOwnerUserID} selected="selected" {/if}>{$use[D].EmployeeName}</option>
						{/section}
						</select>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td style="padding: 15px;" valign="top">Information Provided Description:<span class="mandatory" style="color:red">*</span></td>
				<td style="padding-top: 10px; padding-bottom: 10px;">
				<textarea name="InfoProvidedDesc" id="InfoProvidedDesc"  rows="6" cols="70">{$meet.0.InfoProvidedDesc}</textarea>
				</td>
			</tr>
			
			<tr>
			
				<td style="padding: 15px;" valign="top">Action Item:<span class="mandatory" style="color:red">*</span>
				<div  style="padding: 15px; margin-top: 40px; padding-left: 0px;" valign="top">Dependent Task:</div></td>
				<td style="padding-top: 10px; padding-bottom: 10px;">
				
				<!-- {assign var=q value=1}
				{assign var=p value=2}
				{assign var=r value=1}
				{assign var=s value=1}
				{section name=D loop=$act}
							
								<div id="action{$q++}" class="actionitems">
								<textarea rows="2" cols="70" name="ActionItemId_{$i}" id="ActionItemId_{$i}">{$act[D].ActionItem}</textarea>
								<br><br>
								<textarea rows="2" cols="70" name="DependentTaskId_{$i}" id="DependentTaskId_{$i}">{$act[D].DependentTask}</textarea>
								<br><br>
								
								<select name="DepartmentId_{$i}" id="DepartmentId_{$i}" style="width: 32%;">
									<option value="0">--Select--</option>
									{section name=Dp loop=$dept}
								<option value="{$dept[Dp].Id}" {if $dept[Dp].Id eq $act[D].DepartmentId} selected="selected" {/if}>{$dept[Dp].DepartmentName}</option>
								{/section}
								</select>
								
								<div class="department-user" style="width: 40%;margin-right: 36px;float: right;">
									<select name="DepatuserId_{$i}" id="DepatuserId_{$i}">
									<option value="0">--Select User--</option>
									{section name=U loop=$use}
									<option value="{$use[U].Id}" {if $use[U].Id eq  $act[D].DepatuserId} selected="selected" {/if}>{$use[U].EmployeeName}</option>
									{/section}
									</select>
								</div>
								
								<select name="statusid_{$i}" id="statusid_{$i}" style="width:32%;/*! line-height: 20px; */padding: 2px 0px;">
								
									<option value="Open" {if $act[D].StatusOfAction eq 'Open'} selected="selected" {/if}>Open</option>
									<option value="Closed" {if $act[D].StatusOfAction eq 'Closed'} selected="selected" {/if}>Closed</option>
								</select>
								
								<span style="margin-left: 26px;width: 63%;margin-top: 0px;display: inline-block;">
								
								Action Due Date:<span class="mandatory" style="color:red">*</span>
								
								<input type="text" name="datepickerid_{$i}" id="datepickerid_{$i}" class="dtpicker" value="{$act[D].DueDate}" size="30" >
							
								<a href="#"  {if $count eq 5} onclick=" ActionItem(); calladd({$p++});" {else} onclick=" addactionItems(); " {/if} {if $smarty.section.D.last gt 4}style="display: none;"{else}style="margin-top:10 px; display: inline-block;"{/if}>
									<img src="img/plus.png" height="17" width="17" {if $count eq 5} onclick=" ActionItem(); calladd({$p++});" {else} onclick=" addactionItems(); " {/if}></a>
									
								<a href="javascript: callclose({$r++});" {if $smarty.section.D.index neq '0'} style="margin-top:10px;display:inline-block;"{else} style="display:none;"{/if}>
									<img src="img/cross.png" height="17" width="17" onclick="return ActionItemdelete();"></a>
									
								</span>
							</div>
							<br></br>
						
				{/section}
				{assign var=i value=$i+1}
				{assign var=q value=$q+1}
				{assign var=p value=$p+1}
				{assign var=r value=$r+1}
				{assign var=s value=$s+1}
				 -->
			{$objAdmin->getActionitemById(0,1)}
					<div id="action1">
						        <textarea rows="2" cols="70" name="ActionItemId_1" id="ActionItemId_1">{$getAction.0.ActionItem}</textarea>
									<br><br>
								<textarea rows="2" cols="70" name="DependentTaskId_1" id="DependentTaskId_1">{$getAction.0.DependentTask}</textarea> 
									<br><br> 
								<select name="DepartmentId_1" id="DepartmentId_1" style="width: 32%;" onChange="getDepartmentUserLoop(1,this.value);">
									<option value="0">--Select--</option> 
							{section name=Dp loop=$dept}
									<option value="{$dept[Dp].Id}" {if $dept[Dp].Id eq $getAction.0.DepartmentId} selected="selected" {/if}>{$dept[Dp].DepartmentName}</option>
							{/section}
								</select>
									
						<div class="department-user" style="width: 40%; margin-right: 36px; float: right;">
							<div id="teamrowloop1">
								<select name="DepatuserId_1" id="DepatuserId_1">
									<option value="0">--Select User--</option> 
																		
										{section name=U loop=$use}
										<option value="{$use[U].Id}" {if $use[U].Id eq  $getAction.0.DepatuserId} selected="selected" {/if}>{$use[U].EmployeeName}</option>
										{/section}
								</select>
							</div>
						</div>
								<br></br>
								<select name="statusid_1" id="statusid_1" style="width: 32%; /*! line-height: 20px; */ padding: 2px 0px;">
										<option value="Open" {if  $getAction.0.StatusOfAction eq 'Open'} selected="selected" {/if}>Open</option>
									    <option value="Closed" {if  $getAction.0.StatusOfAction eq 'Closed'} selected="selected" {/if}>Closed</option>
										<option value="Closed" {if  $getAction.0.StatusOfAction eq 'Yet to start'} selected="selected" {/if}>Yet to start</option>
								</select>
								<br></br>
								<!--  <span style="margin-left: 26px; width: 63%; margin-top: 0px; display: inline-block;">-->
								Action Due Date:<span class="mandatory" style="color: red">*</span>
								<input name="datepickerid_1" id="datepickerid_1" class="dtpicker" value="{$getAction.0.DueDate|date_format:"%m/%d/%Y"}" size="30" type="text"> 
							    <a href="javascript: calladd('2');" style="margin-top: 10px; display: inline-block;"> 
								<img src="img/plus.png" height="17" width="17" onclick="return ActionItem();">
								</a>
								<br></br>
						</div>
									
				{$objAdmin->getActionitemById(1,1)}
						<div id="action2" {if $getAction.0.Id neq ''} style="margin-bottom:10px;display:block;"{else} style="display:none;"{/if}>
								<textarea rows="2" cols="70" name="ActionItemId_2" id="ActionItemId_2">{$getAction.0.ActionItem}</textarea>	<br><br>
								<textarea rows="2" cols="70" name="DependentTaskId_2" id="DependentTaskId_2">{$getAction.0.DependentTask}</textarea> <br><br>
									
								<select name="DepartmentId_2" id="DepartmentId_2" style="width: 32%;" onChange="getDepartmentUserLoop(2,this.value);">
									<option value="0">--Select--</option> 
									{section name=Dp loop=$dept}
									<option value="{$dept[Dp].Id}" {if $dept[Dp].Id eq $getAction.0.DepartmentId} selected="selected" {/if}>{$dept[Dp].DepartmentName}</option>
									{/section}
								</select>
																
							<div class="department-user" style="width: 40%; margin-right: 36px; float: right;">
								<div id="teamrowloop2">
									<select name="DepatuserId_2" id="DepatuserId_2">
										<option value="0">--Select User--</option> 
										{section name=U loop=$use}
										<option value="{$use[U].Id}" {if $use[U].Id eq  $getAction.0.DepatuserId} selected="selected" {/if}>{$use[U].EmployeeName}</option>
										{/section}
									</select>
								</div>
						  </div>
									
									<br></br>
								<select name="statusid_2"id="statusid_2" style="width: 32%;">
									<option value="Open" {if  $getAction.0.StatusOfAction eq 'Open'} selected="selected" {/if}>Open</option>
									<option value="Closed" {if  $getAction.0.StatusOfAction eq 'Closed'} selected="selected" {/if}>Closed</option>
									</select>
									<br></br>
								<!--<span style="margin-left: 15px; width: 63%; margin-top: 10px; display: inline-block;">-->
								Action Due Date:
								<input name="datepickerid_2" id="datepickerid_2" class="dtpicker" value="{$getAction.0.DueDate|date_format:"%m/%d/%Y"}" size="30" type="text">
								<a href="javascript: calladd('3');">
								<img src="img/plus.png" height="17" width="17" onclick="return ActionItem();"></a>
								<a href="javascript: callclose('2');">
								<img src="img/cross.png" height="17" width="17" onclick="return ActionItemdelete();">
							    </a>
								<br></br>
								
					</div>
														
			{$objAdmin->getActionitemById(2,1)}
										
					<div id="action3" {if $getAction.0.Id neq ''} style="margin-bottom:10px;display:block;"{else} style="display:none;"{/if}>
								<textarea rows="2" cols="70" name="ActionItemId_3" id="ActionItemId_3">{$getAction.0.ActionItem}</textarea><br><br> 
								<textarea rows="2" cols="70" name="DependentTaskId_3" id="DependentTaskId_3">{$getAction.0.DependentTask}</textarea> <br><br>
								<select name="DepartmentId_3" id="DepartmentId_3" style="width: 32%;" onChange="getDepartmentUserLoop(3,this.value);">
									<option value="0">--Select--</option>
									{section name=Dp loop=$dept}
									<option value="{$dept[Dp].Id}" {if $dept[Dp].Id eq $getAction.0.DepartmentId} selected="selected" {/if}>{$dept[Dp].DepartmentName}</option>
									{/section}
								</select>
					      <div class="department-user" style="width: 40%; margin-right: 36px; float: right;">
							<div id="teamrowloop3">
									<select name="DepatuserId_3" id="DepatuserId_3">
									  <option value="0">--Select User--</option> 
									  {section name=U loop=$use}
									  <option value="{$use[U].Id}" {if $use[U].Id eq  $getAction.0.DepatuserId} selected="selected" {/if}>{$use[U].EmployeeName}</option>
									  {/section}
									</select>
									
							</div>
						</div>
						<br></br>
								   <select name="statusid_3"id="statusid_3" style="width: 32%;">
										<option value="Open" {if  $getAction.0.StatusOfAction eq 'Open'} selected="selected" {/if}>Open</option>
										<option value="Closed" {if  $getAction.0.StatusOfAction eq 'Closed'} selected="selected" {/if}>Closed</option>
										<option value="Closed" {if  $getAction.0.StatusOfAction eq 'Yet to start'} selected="selected" {/if}>Yet to start</option>
									</select>
									<br></br>
									Action Due Date:
									<input name="datepickerid_3" id="datepickerid_3" class="dtpicker" value="{$getAction.0.DueDate|date_format:"%m/%d/%Y"}" size="30" type="text">
								    <a href="javascript: calladd('4');">
								    <img src="img/plus.png" height="17" width="17" onclick="return ActionItem();"></a>
								    <a href="javascript: callclose('3');">
								    <img src="img/cross.png" height="17" width="17" onclick="return ActionItemdelete();"></a>
									<br></br>
				  </div>
											
		{$objAdmin->getActionitemById(3,1)}
				<div id="action4" {if $getAction.0.Id neq ''} style="margin-bottom:10px;display:block;"{else} style="display:none;"{/if}>
									<textarea rows="2" cols="70" name="ActionItemId_4" id="ActionItemId_4">{$getAction.0.ActionItem}</textarea>
									<br><br> 
									<textarea rows="2" cols="70" name="DependentTaskId_4" id="DependentTaskId_4">{$getAction.0.DependentTask}</textarea> <br><br>
									<select name="DepartmentId_4" id="DepartmentId_4" style="width: 32%;" onChange="getDepartmentUserLoop(4,this.value);">
										<option value="0">--Select--</option> 
										{section name=Dp loop=$dept}
										<option value="{$dept[Dp].Id}" {if $dept[Dp].Id eq $getAction.0.DepartmentId} selected="selected" {/if}>{$dept[Dp].DepartmentName}</option>
										{/section}
									</select>
							<div class="department-user" style="width: 40%; margin-right: 36px; float: right;">
							<div id="teamrowloop4">
									<select name="DepatuserId_4" id="DepatuserId_4">
									  <option value="0">--Select User--</option> 
									  {section name=U loop=$use}
									  <option value="{$use[U].Id}" {if $use[U].Id eq  $getAction.0.DepatuserId} selected="selected" {/if}>{$use[U].EmployeeName}</option>
									  {/section}
									</select>
									
							</div>
							</div>
									<br></br>
									<select name="statusid_4"id="statusid_4" style="width: 32%;">
									<option value="Open" {if  $getAction.0.StatusOfAction eq 'Open'} selected="selected" {/if}>Open</option>
									<option value="Closed" {if  $getAction.0.StatusOfAction eq 'Closed'} selected="selected" {/if}>Closed</option>
									<option value="Closed" {if  $getAction.0.StatusOfAction eq 'Yet to start'} selected="selected" {/if}>Yet to start</option>
									</select>
									<br></br>			
										Action Due Date:
										<input name="datepickerid_4"id="datepickerid_4"	class="dtpicker" value="{$getAction.0.DueDate|date_format:"%m/%d/%Y"}" size="30" type="text">
										 <a href="javascript: calladd('5');"><img src="img/plus.png" height="17" width="17" onclick="return ActionItem();">
										</a> <a href="javascript: callclose('4');">
																			<img
																					src="img/cross.png" height="17" width="17" onclick="return ActionItemdelete();">
																			
																			</a>
																
																</span>
												
												</div>
												<br></br>
												{$objAdmin->getActionitemById(4,1)}
												<div id="action5"{if $getAction.0.Id neq ''} style="margin-bottom:10px;display:block;"{else} style="display:none;"{/if}">
												<textarea rows="2" cols="70" name="ActionItemId_5" id="ActionItemId_5">{$getAction.0.ActionItem}</textarea>
												<br><br> 
												<textarea rows="2" cols="70" name="DependentTaskId_5" id="DependentTaskId_5">{$getAction.0.DependentTask}</textarea> <br><br>
												<select name="DepartmentId_5" id="DepartmentId_5" style="width: 32%;" onChange="getDepartmentUserLoop(5,this.value);">
												<option value="0">--Select--</option> 
												{section name=Dp loop=$dept}
												<option value="{$dept[Dp].Id}" {if $dept[Dp].Id eq $getAction.0.DepartmentId} selected="selected" {/if}>{$dept[Dp].DepartmentName}</option>
												{/section}
												</select>
												<div class="department-user" style="width: 40%; margin-right: 36px; float: right;">
												<div id="teamrowloop5">
												<select name="DepatuserId_5" id="DepatuserId_5">
												<option value="0">--Select User--</option> 
												{section name=U loop=$use}
												<option value="{$use[U].Id}" {if $use[U].Id eq  $getAction.0.DepatuserId} selected="selected" {/if}>{$use[U].EmployeeName}</option>
												{/section}
												</select>
												</div>
												</div>
												<select name="statusid_5"id="statusid_5" style="width: 32%;">
												<option value="Open" {if  $getAction.0.StatusOfAction eq 'Open'} selected="selected" {/if}>Open</option>
												<option value="Closed" {if  $getAction.0.StatusOfAction eq 'Closed'} selected="selected" {/if}>Closed</option>
												<option value="Closed" {if  $getAction.0.StatusOfAction eq 'Yet to start'} selected="selected" {/if}>Yet to start</option>
												</select>
																
												 <span style="margin-left: 15px; width: 63%; margin-top: 10px; display: inline-block;">
												Action Due Date:
															<input name="datepickerid_5"
																		id="datepickerid_5"
																		class="dtpicker" value="{$getAction.0.DueDate|date_format:"%m/%d/%Y"}" size="30" type="text">
																		<!-- <img
																			src="img/plus.png" alt="" height="17" width=""25" onclick="return ActionItem();"> --> <a
																				href="javascript: callclose('5');">
																				<img
																					src="img/cross.png" height="17" width="17" onclick="return ActionItemdelete();">
																			
																			</a>
																
																</span>
												
												</div>
			<tr>
				<td style="padding: 15px;">Action - Status:<span class="mandatory" style="color:red">*</span></td>
				<td>
					<select name="ActionStatus" id="ActionStatus" style="width: 210px">
					
						<option value="Completed" {if $meet.0.ActionStatus=='Completed'} selected="selected" {/if}>Completed</option>
						<option value="Postpone"{if $meet.0.ActionStatus=='Postpone'} selected="selected" {/if}>Postpone</option>
						<option value="On Hold" {if $meet.0.ActionStatus=='On Hold'} selected="selected" {/if}>On Hold</option>
						<option value="Re Scheduled" {if $meet.0.ActionStatus=='Re Scheduled'} selected="selected" {/if}>Re Scheduled</option>
						<option value="Cancelled" {if $meet.0.ActionStatus=='Cancelled'} selected="selected" {/if}>Cancelled</option>
						<option value="Follow Up" {if $meet.0.ActionStatus=='Follow Up'} selected="selected" {/if}>Follow Up</option>
					</select>
				</td>
			</tr>
			<tr>
											<td style="padding: 15px;">Attachment file:<span
												class="mandatory" style="color: red">*</span></td>
											<td>
											<input type="file" id="upload_file" name="upload_file" value="" style="float: left;"/>
										</td>
										</tr>
			<tr class="bg">
				<td align="right" style="padding: 10px; text-align: center;" colspan="2">
				<a href="" style="text-decoration: none;"><input type="submit" class="btn-submit" value="Update" name="submit" onclick="return catvalid();"/></a>
				&nbsp;&nbsp;&nbsp;
				<a href="manage_meeting.php" style="text-decoration: none;"><input type="button" class="btn-submit" value="Cancel" name="submit" /></a></td>
			</tr>
		</table>
		</form>
	</div>
 </div>
</div>
</div>	
{literal}
	<script type="text/javascript" src="jquery-1.11.3.min.js"></script>
		<!--<script type="text/javascript" src="js/wickedpicker.js"></script>
		<script type="text/javascript">
		$('.timepicker').wickedpicker();		
		$('.timepicker1').wickedpicker();
		</script>-->
	
	{/literal}
</body>
</html>