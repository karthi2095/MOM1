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

function getDepartmentUserLoop(cnt,val)
 {
 	
 	$.ajax({
 		url: 'Getdepartmentuserloop.php',
 		type: "POST",
 		data:"departmentuser="+val+"&departmentcnt="+cnt,
 		success: function(data) {
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
           $( "#datepicker" ).datepicker();
           $(".dtpicker").datepicker();
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
<form name="add_meet" id="add_meet" action="" method="post">
		<input type="hidden" name="CatIdent">
		<input type="hidden" name="Ident" value="{$smarty.request.Ident}">
		<input type="hidden" name="hdIdent">
		<input type="hidden" name="hdAction" id="hdAction">
			<input type="hidden" name="Actionitem" id="Actionitem" value="{$count}">
  <div id="center-column">
    <div class="top-bar-header">
      <h1>Minutes of Meeting</h1>
      <div class="breadcrumbs"><a href="controlPanel.php">Homepage</a> >> <a href="manage_meeting.php"> Minutes of Meeting </a> >>  View Meeting</div>
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
											<td style="padding: 15px;">Meeting venue:{$meet.0.Participation}</td>
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
				<td style="padding: 15px;">Meeting Owner:<span class="mandatory" style="color:red">*</span></td>
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
			
				<td style="padding: 15px;" valign="top">Action Item:<br></br>
			    Dependent Task:</td>
				<td style="padding-top: 10px; padding-bottom: 10px;">
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
							&nbsp;&nbsp;&nbsp;
							<br></br>
								Status:	
						     {$getAction.0.StatusOfAction } 
								
							<br>
							<br>
								Action Due Date:
								{$getAction.0.DueDate} 
							   
						</div>
					<br></br>
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
							Status:	
							{$getAction.0.StatusOfAction} 
							<br>
							<br>
								Action Due Date:
							{$getAction.0.DueDate}
								
					</div>
								<br></br>								
			{$objAdmin->getActionitemById(2,1)}
									
					<div id="action3" {if $getAction.0.Id neq ''} style="margin-bottom:10px;display:block;"{else} style="display:none;"{/if}>
								{$getAction.0.ActionItem}<br><br>
								{$getAction.0.DependentTask}<br><br>
								Department:
								{section name=Dp loop=$dept}
									 {if $dept[Dp].Id eq $getAction.0.DepartmentId} {$dept[Dp].DepartmentName} {/if}
									{/section}
								&nbsp;&nbsp;&nbsp;
								EmployeeName:
								 {section name=U loop=$use}
									 {if $use[U].Id eq  $getAction.0.DepatuserId} {$use[U].EmployeeName} {/if}
									  {/section}
								&nbsp;&nbsp;&nbsp;
								<br></br>
								  Status:
								{$getAction.0.StatusOfAction}
									<br><br>
									Action Due Date:
									{$getAction.0.DueDate}
								   
				  </div>
							<br></br>			
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
									{if $use[U].Id eq $getAction.0.DepatuserId} {$use[U].EmployeeName} {/if}
									{/section}
								&nbsp;&nbsp;&nbsp;
								<br></br>
									 Status:
								{$getAction.0.StatusOfAction}
									<br><br>
									Action Due Date:
									{$getAction.0.DueDate}
																
												</div>
													<br></br>
												{$objAdmin->getActionitemById(4,1)}
												<div id="action5"{if $getAction.0.Id neq ''} style="margin-bottom:10px;display:block;"{else} style="display:none;"{/if}">
												{$getAction.0.ActionItem}
												<br><br> 
												{$getAction.0.DependentTask}<br><br>
												Department:
												{section name=Dp loop=$dept}
												{if $dept[Dp].Id eq $getAction.0.DepartmentId}{$dept[Dp].DepartmentName}{/if}
												{/section}
												&nbsp;&nbsp;&nbsp;
												EmployeeName:
												{section name=U loop=$use}
												{if $use[U].Id eq  $getAction.0.DepatuserId} {$use[U].EmployeeName} {/if}
												{/section}
											&nbsp;&nbsp;&nbsp;
											<br></br>
												 Status:
												{$getAction.0.StatusOfAction}
													<br><br>
													Action Due Date:
													{$getAction.0.DueDate}
												</div>	<br></br>
			<tr>
				<td style="padding: 15px;">Action - Status:</td>
				<td>
				
					{$meet.0.ActionStatus}
				</td>
			</tr>
			
		</table>
		</form>
	</div>
 </div>
</div>
</div>	
</body>
</html>