<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Minutes of Meeting</title>
	<meta http-equiv="X-UA-Compatible" content="IE=9" />
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" href="css/all.css">
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
      <div class="breadcrumbs"><a href="controlPanel.php">Homepage</a> >> <a href="manage_meeting.php"> Minutes of Meeting </a> >> Renewal Meeting</div>
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
				Meeting Name:</td>
				<td>{$meet.0.MeetingName|stripslashes|htmlspecialchars}</td>
			</tr>
			<tr>
				<td style="padding: 15px;">Meeting Date:</td>
				<td>{$meet.0.MeetingDate|stripslashes|htmlspecialchars}</td>
			</tr>
			<tr>
				<td style="padding: 15px;">Program Name:</td>
				<td>{$meet.0.ProgramName|stripslashes|htmlspecialchars}</td>
			</tr>
			<tr>
				<td style="padding: 15px;">Project Name:</td>
				<td>{$meet.0.ProjectName|stripslashes|htmlspecialchars}</td>
			</tr>
				<tr>
											<td style="padding: 15px;">Target Date:</td>
											<td>{$meet.0.Target_Date|stripslashes|date_format:"%m/%d/%Y"}
											
											</td>
										</tr>
										<tr>
											<td style="padding: 15px;">In time completion:</td>
											<td>{$meet.0.In_Time_Completion|stripslashes|htmlspecialchars}
											
											</td>
										</tr>
										<tr>
											<td style="padding: 15px;">No of revision:</td>
											<td>{$meet.0.No_Of_Revision|stripslashes|htmlspecialchars}
											
											</td>
										</tr>
										<tr>
											<td style="padding: 15px;">Delayed days:</td>
											<td>{$meet.0.Delayed_Days|stripslashes|htmlspecialchars}
											
											</td>
										</tr>
										<tr>
											<td style="padding: 15px;">Meeting time:</td>
											<td>{$meet.0.Meeting_Time|stripslashes|htmlspecialchars}
											
											</td>
										</tr>
										
										<tr>
											<td style="padding: 15px;">Meeting venue:</td>
											<td>{$meet.0.Meeting_Venue|stripslashes|htmlspecialchars}
											
											</td>
										</tr>
			
			
										<tr>
											<td style="padding: 15px;">Participant:</td>
											{$objAdmin->userId($meet.0.Participation)}
											
											<td>
											{section name=s loop=$us}
											{$us[s].EmployeeName}{if $smarty.section.s.last eq ''},{/if}
											{/section}
											</td>
											
										</tr>
										<tr>
											<td style="padding: 15px;" valign="top">Discussion:</td>
											<td style="padding-top: 10px; padding-bottom: 10px;">{$meet.0.Discussion|stripslashes|htmlspecialchars}
											</td>
										</tr>
			<tr>
				<td style="padding: 15px;">Meeting Owner:</td>
				<td>
				Department:
					
				{section name=D loop=$dept}
						{if $dept[D].Id eq $meet.0.MeetingOwnerDepartmentID}{$dept[D].DepartmentName}{/if}
				
					{/section}
				
					&nbsp;&nbsp;&nbsp;&nbsp;
					EmployeeName:
						
						{section name=D loop=$use}
							{if $use[D].Id eq $meet.0.MeetingOwnerUserID} {$use[D].EmployeeName} {/if}
							{/section}
					
				</td>
			</tr>
			<tr>
				<td style="padding: 15px;" valign="top">Information Provided Description:</td>
				<td style="padding-top: 10px; padding-bottom: 10px;">
				{$meet.0.InfoProvidedDesc}
				</td>
			</tr>
			
			<tr>
			
				<td style="padding: 15px;" valign="top">Action Item:
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
						        {$getAction.0.ActionItem}
									<br><br>
								{$getAction.0.DependentTask}
									<br><br> 
								
							Department:
							{section name=Dp loop=$dept}
								 {if $dept[Dp].Id eq $getAction.0.DepartmentId} {$dept[Dp].DepartmentName} {/if}
									{/section}
							
								&nbsp;&nbsp;&nbsp;&nbsp;
							EmployeeName:
							{section name=U loop=$use}
							{if $use[U].Id eq  $getAction.0.DepatuserId} {$use[U].EmployeeName} {/if}</option>
									{/section}
								<br></br>
								{assign var="userID" value=$smarty.session.userid}
								{if $userID eq $getAction.0.DepatuserId}
								<select name="statusid_1" id="statusid_1" style="width: 32%; /*! line-height: 20px; */ padding: 2px 0px;">
										<option value="Open" {if  $getAction.0.StatusOfAction eq 'Open'} selected="selected" {/if}>Open</option>
									    <option value="Closed" {if  $getAction.0.StatusOfAction eq 'Closed'} selected="selected" {/if}>Closed</option>
										<option value="Yet to start" {if  $getAction.0.StatusOfAction eq 'Yet to start'} selected="selected" {/if}>Yet to start</option>
								</select>
								<br></br>
								<!--  <span style="margin-left: 26px; width: 63%; margin-top: 0px; display: inline-block;">-->
								Action Due Date:
								<input name="datepickerid_1" id="datepickerid_1" class="dtpicker" value="{$getAction.0.DueDate|date_format:"%m/%d/%Y"}" size="30" type="text"> 
							   {else}
								 Status:
								{$getAction.0.StatusOfAction}
								<br><br>
								Action Due Date:
								{$getAction.0.DueDate}
								{/if}
								<br></br>
						</div>
									
				{$objAdmin->getActionitemById(1,1)}
						<div id="action2" {if $getAction.0.Id neq ''} style="margin-bottom:10px;display:block;"{else} style="display:none;"{/if}>
								{$getAction.0.ActionItem}
								<br><br>
								{$getAction.0.DependentTask} <br><br>
								Department:
									{section name=Dp loop=$dept}
									 {if $dept[Dp].Id eq $getAction.0.DepartmentId} {$dept[Dp].DepartmentName} {/if}
									{/section}
									 &nbsp;&nbsp;&nbsp;
							EmployeeName:	 
							{section name=U loop=$use}
										{if $use[U].Id eq  $getAction.0.DepatuserId} {$use[U].EmployeeName} {/if}
							{/section}
									
									<br></br>
								
								{if $userID eq $getAction.0.DepatuserId}
								<select name="statusid_2"id="statusid_2" style="width: 32%;">
									<option value="Open" {if  $getAction.0.StatusOfAction eq 'Open'} selected="selected" {/if}>Open</option>
									<option value="Closed" {if  $getAction.0.StatusOfAction eq 'Closed'} selected="selected" {/if}>Closed</option>
									</select>
									<br></br>
								<!--<span style="margin-left: 15px; width: 63%; margin-top: 10px; display: inline-block;">-->
								Action Due Date:
								<input name="datepickerid_2" id="datepickerid_2" class="dtpicker" value="{$getAction.0.DueDate|date_format:"%m/%d/%Y"}" size="30" type="text">
								 {else}
								 Status:
								{$getAction.0.StatusOfAction}
								<br><br>
								Action Due Date:
								{$getAction.0.DueDate}
								{/if}
								<br></br>
								
					</div>
														
			{$objAdmin->getActionitemById(2,1)}
										
					<div id="action3" {if $getAction.0.Id neq ''} style="margin-bottom:10px;display:block;"{else} style="display:none;"{/if}>
								{$getAction.0.ActionItem}
								<br><br>
								{$getAction.0.DependentTask} <br><br>
								Department:
									{section name=Dp loop=$dept}
									 {if $dept[Dp].Id eq $getAction.0.DepartmentId} {$dept[Dp].DepartmentName} {/if}
									{/section}
									 &nbsp;&nbsp;&nbsp;
								EmployeeName:	 
							{section name=U loop=$use}
										{if $use[U].Id eq  $getAction.0.DepatuserId} {$use[U].EmployeeName} {/if}
							{/section}
						<br></br>
						{if $userID eq $getAction.0.DepatuserId}
								   <select name="statusid_3"id="statusid_3" style="width: 32%;">
										<option value="Open" {if  $getAction.0.StatusOfAction eq 'Open'} selected="selected" {/if}>Open</option>
										<option value="Closed" {if  $getAction.0.StatusOfAction eq 'Closed'} selected="selected" {/if}>Closed</option>
										<option value="Yet to start" {if  $getAction.0.StatusOfAction eq 'Yet to start'} selected="selected" {/if}>Yet to start</option>
									</select>
									<br></br>
									Action Due Date:
									<input name="datepickerid_3" id="datepickerid_3" class="dtpicker" value="{$getAction.0.DueDate|date_format:"%m/%d/%Y"}" size="30" type="text">
								 {else}
								 Status:
								{$getAction.0.StatusOfAction}
								<br><br>
								Action Due Date:
								{$getAction.0.DueDate}
								{/if}
								
									<br></br>
				  </div>
											
		{$objAdmin->getActionitemById(3,1)}
				<div id="action4" {if $getAction.0.Id neq ''} style="margin-bottom:10px;display:block;"{else} style="display:none;"{/if}>
									{$getAction.0.ActionItem}
								<br><br>
								{$getAction.0.DependentTask} <br><br>
								Department:
									{section name=Dp loop=$dept}
									 {if $dept[Dp].Id eq $getAction.0.DepartmentId} {$dept[Dp].DepartmentName} {/if}
									{/section}
									 &nbsp;&nbsp;&nbsp;
								EmployeeName:	 
							{section name=U loop=$use}
										{if $use[U].Id eq  $getAction.0.DepatuserId} {$use[U].EmployeeName} {/if}
							{/section}
									<br></br>
							{if $userID eq $getAction.0.DepatuserId}
									<select name="statusid_4"id="statusid_4" style="width: 32%;">
									<option value="Open" {if  $getAction.0.StatusOfAction eq 'Open'} selected="selected" {/if}>Open</option>
									<option value="Closed" {if  $getAction.0.StatusOfAction eq 'Closed'} selected="selected" {/if}>Closed</option>
									<option value="Closed" {if  $getAction.0.StatusOfAction eq 'Yet to start'} selected="selected" {/if}>Yet to start</option>
									</select>
									<br></br>			
										Action Due Date:
										<input name="datepickerid_4"id="datepickerid_4"	class="dtpicker" value="{$getAction.0.DueDate|date_format:"%m/%d/%Y"}" size="30" type="text">
										 {else}
										 Status:
										{$getAction.0.StatusOfAction}
										<br><br>
										Action Due Date:
										{$getAction.0.DueDate}
										{/if}
										</div>
										<br></br>
				{$objAdmin->getActionitemById(4,1)}
								<div id="action5"{if $getAction.0.Id neq ''} style="margin-bottom:10px;display:block;"{else} style="display:none;"{/if}">
								{$getAction.0.ActionItem}
								<br><br>
								{$getAction.0.DependentTask} <br><br>
								Department:
									{section name=Dp loop=$dept}
									{if $dept[Dp].Id eq $getAction.0.DepartmentId} {$dept[Dp].DepartmentName} {/if}
									{/section}
									 &nbsp;&nbsp;&nbsp;
								EmployeeName:	 
								{section name=U loop=$use}
								{if $use[U].Id eq  $getAction.0.DepatuserId} {$use[U].EmployeeName} {/if}
								{/section}
								<br></br>
						{if $userID eq $getAction.0.DepatuserId}
												<select name="statusid_5"id="statusid_5" style="width: 32%;">
												<option value="Open" {if  $getAction.0.StatusOfAction eq 'Open'} selected="selected" {/if}>Open</option>
												<option value="Closed" {if  $getAction.0.StatusOfAction eq 'Closed'} selected="selected" {/if}>Closed</option>
												<option value="Closed" {if  $getAction.0.StatusOfAction eq 'Yet to start'} selected="selected" {/if}>Yet to start</option>
												</select>
												<br></br>			
												 <span style="margin-left: 15px; width: 63%; margin-top: 10px; display: inline-block;">
												Action Due Date:
													<input name="datepickerid_5" id="datepickerid_5" class="dtpicker" value="{$getAction.0.DueDate|date_format:"%m/%d/%Y"}" size="30" type="text">
													 {else}
													 Status:
													{$getAction.0.StatusOfAction}
													<br><br>
													Action Due Date:
													{$getAction.0.DueDate}
												</div>
												<tr>
													<td style="padding: 15px;">Action - Status:</td>
													<td>
													{$meet.0.ActionStatus}
													</td>
												</tr>
										<!--<tr>
											<td style="padding: 15px;">Attachment file:<span
												class="mandatory" style="color: red">*</span></td>
											<td>
											<input type="file" id="upload_file" name="upload_file" value="" style="float: left;"/>
										</td>
										</tr>-->
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
</body>
</html>