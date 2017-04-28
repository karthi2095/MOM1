<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Minutes of Meeting</title>
<meta http-equiv="X-UA-Compatible" content="IE=9" />
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="css/all.css">
<link rel="stylesheet" href="css/wickedpicker.css">
	<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
		{literal}
		<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
		<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
	
		 <script>
		 function GoBack()
		 {  
		 	window.location 		='manage_meeting.php';
		 }
		 
function cat_valid()
{ 
	
	var email = /^([A-Za-z0-9_\-\.])+\@([A-Za-z_\-\.])+\.([A-Za-z]{2,4})$/;
	
	document.getElementById('errmsg').innerHTML='';
	document.getElementById('sucmsg').innerHTML='';
	MeetingName=document.getElementById('MeetingName').value;
	ProjectName=document.getElementById('ProjectName').value;
	MeetingDate=document.getElementById('datepicker').value;
	ProgramName=document.getElementById('ProgramName').value;
	meetingtype=document.getElementById('meetingtype').value;
	part=document.getElementById('part').value;
	DepartmentName=document.getElementById('DepartmentName').value;
	Department_user=document.getElementById('department_user').value;
	InfoProvidedDesc=document.getElementById('InfoProvidedDesc').value;
	ActionItem=document.getElementById('ActionItem_Id').value;
	DueDate=document.getElementById('datepicker_id').value;
	ActionStatus=document.getElementById('ActionStatus').value;
	upload_file=document.getElementById('upload_file').value;
	TargetDate=document.getElementById('TargetDate').value;
	completion=document.getElementById('completion').value;
	revision=document.getElementById('revision').value;
	Delayed=document.getElementById('Delayed').value;
	time=document.getElementById('timepicker').value;
	venue=document.getElementById('venue').value;
	Discussion=document.getElementById('Discussion').value;
	DependentTask_Id=document.getElementById('DependentTask_Id').value;
	Depatuser_Id=document.getElementById('Depatuser_Id').value;
	Department_Id=document.getElementById('Department_Id').value;
	status_id=document.getElementById('status_id').value;
	
	
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
	if(ProgramName==''){
		document.getElementById('errmsg').innerHTML='Please enter the Program Name';
		document.getElementById('ProgramName').focus();
		return false;
	 }
	if(TargetDate==''){
		document.getElementById('errmsg').innerHTML='Please enter the Target Date';
		document.getElementById('TargetDate').focus();
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
	 if(time==''){
		document.getElementById('errmsg').innerHTML='Please enter the Meeting time';
		document.getElementById('timepicker').focus();
		return false;
	 }
	 if(completion==''){
			document.getElementById('errmsg').innerHTML='Please enter In time completion';
			document.getElementById('completion').focus();
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
	if(ProjectName==''){
		document.getElementById('errmsg').innerHTML='Please enter the Project Name';
		document.getElementById('ProjectName').focus();
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
	if(InfoProvidedDesc==''){
		document.getElementById('errmsg').innerHTML='Please enter the InfoProvidedDesc';
		document.getElementById('InfoProvidedDesc').focus();
		return false;
	 }
	if(ActionItem==''){
		document.getElementById('errmsg').innerHTML='Please enter the ActionItem';
		document.getElementById('ActionItem_Id').focus();
		return false;
	 }
	if(DependentTask_Id==''){
		document.getElementById('errmsg').innerHTML='Please enter the DependentTask';
		document.getElementById('DependentTask_Id').focus();
		return false;
	 }
	if(Department_Id=='0'){
		document.getElementById('errmsg').innerHTML='Please select the Department';
		document.getElementById('Department_Id').focus();
		return false;
	 }
	if(Depatuser_Id=='0'){
		document.getElementById('errmsg').innerHTML='Please select the user';
		document.getElementById('Depatuser_Id').focus();
		return false;
	 }
	if(status_id=='0'){
		document.getElementById('errmsg').innerHTML='Please select the status';
		document.getElementById('status_id').focus();
		return false;
	 }
	
	if(DueDate==''){
		
		document.getElementById('errmsg').innerHTML='Please select the DueDate';
		document.getElementById('datepicker_id').focus();
		return false;
	 }
	if(ActionStatus=='0'){
		document.getElementById('errmsg').innerHTML='Please select the ActionStatus';
		document.getElementById('ActionStatus').focus();
		return false;
	 }
	 /*if(upload_file==''){
		document.getElementById('errmsg').innerHTML='Please select the upload file';
		document.getElementById('upload_file').focus();
		return false;
	 }*/
	//alert('Welcome5');
	document.getElementById('hdAction').value=1;
	//alert(document.getElementById('hdAction').value);
}

//////////Dirty Message End///////////////
</script>
		<script type="text/javascript">
	function calladd(a)
	{
		document.getElementById('action'+a).style.display='block';
	}
	
	function callclose(a)
	{ 
		document.getElementById('action'+a).style.display='none';
	}
	
  </script>
		<script type="text/javascript"> 
       jQuery(function($){
           $( "#datepicker" ).datepicker({minDate: 0});
           $(".dtpicker").datepicker({minDate: 0});
		});

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
	  function getDepartmentUserLoop(val)
 	  {
 	  	
 	  	$.ajax({
 	  		url: 'Getdepartmentuserloop.php',
 	  		type: "POST",
 	  		data:"departmentuse="+val,
 	  		success: function(data) {
 		  		//alert(data); 
 	  			document.getElementById("teamrowloop").innerHTML=data;
 	  					
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
	//alert(tot);
	 }


 </script>
		{/literal}

</head>
<!--Design Prepared by Rajasri Systems-->
<body>
<div id="middle">
		<form name="add_meet" id="add_meet" action="" method="post" onsubmit="return cat_valid();">
			
			<input type="hidden" name="CatIdent"> <input type="hidden"
				name="Ident"> <input type="hidden" name="hdIdent"> 
				<input type="hidden" name="hdAction" id="hdAction">
				<input type="hidden" name="Actionitem" id="Actionitem" value="1">
							<div id="center-column">
								<div class="top-bar-header">
									<h1>Minutes of Meeting</h1>
									<div class="breadcrumbs">
										<a href="controlPanel.php">Homepage</a> >> <a
											href="manage_meeting.php"> Minutes of Meeting </a> >> Add
										Meeting
									</div>
								</div>
							
								 <div class="select-bar">
					
										<div align="right"><img src="img/back.gif" title="Back" alt="Back" width="32" height="32" class="navigation_link" style="cursor:pointer;margin-right: 230px;" onclick="GoBack();"/></div>
			 					 </div>
								<div class="manage-grid">
								<!-- <input type="image" src="images/attach.png" onclick="return fileupload();" class="attach-icon"/>-->
							
								
									<div align="center" class="Error" id="errmsg"
										style="color: red; font-weight: bold;">{$ErrorMessage}</div>
									<div align="center" class="Success" id="sucmsg"
										style="color: green; font-weight: bold;">{$SuccessMessage}</div>
									<table border="0" cellpadding="2" cellspacing="0"
										class="grid-table" style="width: 70%; margin-left: 190px;">
										<tr>
											<td width="30%" style="padding: 15px;">Meeting Name:<span
												class="mandatory" style="color: red">*</span></td>
											<td><input type="text" name="MeetingName" id="MeetingName"
												value="" size="30">
											
											</td>
										</tr>
										<tr>
											<td width="30%" style="padding: 15px;">Meeting Type:<span
												class="mandatory" style="color: red">*</span></td>
											<td><select name="meetingtype" id="meetingtype"
												style="width: 32%;">
													<option value="0">--Select--</option> {section name=S
													loop=$type}
													<option value="{$type[S].Id}">{$type[S].Meeting_Type}</option>
													{/section}
											</select>
											
											</td>
										</tr>
										<tr>
											<td style="padding: 15px;">Meeting Date:<span
												class="mandatory" style="color: red">*</span></td>
											<td><input type="text" name="MeetingDate" id="datepicker"
												value="" size="30">
											
											</td>
										</tr>
										
										<tr>
											<td style="padding: 15px;">Program Name:<span
												class="mandatory" style="color: red">*</span></td>
											<td><input type="text" name="ProgramName" id="ProgramName"
												value="" size="30">
											
											</td>
										</tr>
										
										<tr>
											<td style="padding: 15px;">Target Date:<span
												class="mandatory" style="color: red">*</span></td>
											<td><input type="text" name="TargetDate" id="TargetDate" class="dtpicker"
												value="" size="30">
											
											</td>
										</tr>
										
										<tr>
											<td style="padding: 15px;">No of revision:<span
												class="mandatory" style="color: red">*</span></td>
											<td><input type="text" name="revision" id="revision"
												value="" size="30">
											
											</td>
										</tr>
										<tr>
											<td style="padding: 15px;">Delayed days:<span
												class="mandatory" style="color: red">*</span></td>
											<td><input type="text" name="Delayed" id="Delayed"
												value="" size="30">
											
											</td>
										</tr>
										<tr>
											<td style="padding: 15px;">Meeting time:<span
												class="mandatory" style="color: red">*</span></td>
											<td><input type="text" name="timepicker" id="timepicker" class="timepicker set-time" value="" size="30">
											
											</td>
										</tr>
										<tr>
											<td style="padding: 15px;">In time completion:<span
												class="mandatory" style="color: red">*</span></td>
											<td><input type="text" name="completion" id="completion" class="timepicker1 set-time"
												value="" size="30">
											
											</td>
										</tr>
										<tr>
											<td style="padding: 15px;">Meeting venue:<span
												class="mandatory" style="color: red">*</span></td>
											<td><input type="text" name="venue" id="venue"
												value="" size="30">
											
											</td>
										</tr>
										
										<tr>
											<td style="padding: 15px;">Participant:<span
												class="mandatory" style="color: red">*</span></td>
											<td><select name="part[]" id="part" style="width: 32%;" multiple>
													
													{section name=C loop=$user}
													<option value="{$user[C].Id}">{$user[C].EmployeeName}</option>
													{/section}
											</select>
											</td>
											</tr>
										<tr>
										<tr>
											<td style="padding: 15px;" valign="top">Discussion:<span class="mandatory" style="color: red">*</span>
											</td>
											<td style="padding-top: 10px; padding-bottom: 10px;">
											<textarea name="Discussion" id="Discussion" rows="6" cols="70"></textarea>
											</td>
										</tr>
										<tr>
											<td style="padding: 15px;">Project Name:
											<span class="mandatory" style="color: red">*</span></td>
											<td><input type="text" name="ProjectName" id="ProjectName" value="" size="30">
											
											</td>
										</tr>
											<td style="padding: 15px;">Meeting Owner:<span class="mandatory" style="color: red">*</span></td>
											<td><select name="DepartmentName" id="DepartmentName" style="width: 32%;" onChange="getDepartmentUser(this.value);">
													<option value="0">--Select--</option> 
													{section name=D loop=$dept}
													<option value="{$dept[D].Id}">{$dept[D].DepartmentName}</option>
													{/section}
											</select>
												<div class="department-user"
													style="width: 40%; margin-right: 36px; float: right;">
													<div id="teamrow">
														<select name="department_user" id="department_user">
															<option value="0">--Select User--</option> 
														</select>
													</div>
												</div>
											</td>
										</tr>
										
										
										<tr>
											<td style="padding: 15px;" valign="top">Information Provided Description:<span class="mandatory" style="color: red">*</span>
											</td>
											<td style="padding-top: 10px; padding-bottom: 10px;">
											<textarea name="InfoProvidedDesc" id="InfoProvidedDesc" rows="6" cols="70"></textarea>
											</td>
										</tr>
										<tr>
											<td style="padding: 15px;" valign="top">Action Item:
											<span class="mandatory" style="color: red">*</span>
											<div style="padding: 15px; margin-top: 40px; padding-left: 0px;" valign="top">Dependent Task:
											</td>
											<td style="padding-top: 10px; padding-bottom: 10px;">
												<div id="action1">
													<textarea rows="2" cols="70" name="ActionItemId[]" id="ActionItem_Id"></textarea>
														<br><br>
													<textarea rows="2" cols="70" name="DependentTaskId[]" id="DependentTask_Id"></textarea> 
														<br><br> 
													<select name="DepartmentId[]" id="Department_Id" style="width: 32%;" onChange="getDepartmentUserLoop(this.value);">
													<option value="0">--Select--</option> 
													{section name=D loop=$dept}
													<option value="{$dept[D].Id}">{$dept[D].DepartmentName}</option>
													{/section}
													</select>
													<div class="department-user" style="width: 40%; margin-right: 36px; float: right;">
													<div id="teamrowloop">
													<select name="DepatuserId[]" id="Depatuser_Id">
													<option value="0">--Select User--</option> 
													</select>
													</div>
													</div>
													<br></br>
													<select name="statusid[]" id="status_id" style="width: 32%; /*! line-height: 20px; */ padding: 2px 0px;">
													<option value="0">--Select Status--</option> 
													<option>Open</option>
													<option>Closed</option>
													<option>Yet to start</option>
													</select>
													<br></br>
													
													Action Due Date:<span class="mandatory" style="color: red">*</span>
													<input name="datepickerid[]" id="datepicker_id" class="dtpicker" value="" size="30" type="text"> 
													<a class="add-box" href="#" onclick="add_text();"><img src="img/plus.png" width="20" height="20" ></img></a>
													</span>
												
												</div>
												
											
										</tr>
										<tr>
											<td style="padding: 15px;">Action - Status:<span
												class="mandatory" style="color: red">*</span></td>
											<td><select name="ActionStatus" id="ActionStatus"
												style="width: 210px">
													<option value="0">--Select Action Status--</option> 
													<option value="Completed">Completed</option>
													<option value="Postpone">Postpone</option>
													<option value="On Hold">On Hold</option>
													<option value="Re Scheduled">Re Scheduled</option>
													<option value="Cancelled">Cancelled</option>
													<option value="Follow Up">Follow Up</option>
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
											<td align="right" style="padding: 10px; text-align: center;"
												colspan="2"><a href="" style="text-decoration: none;"><input
													type="submit" class="btn-submit" value="Add" name="submit"
													 /> </a> &nbsp;&nbsp;&nbsp; 
													<a href="manage_meeting.php" style="text-decoration: none;">
													<input type="button" class="btn-submit" value="Cancel" name="submit" /> </a></td>
										</tr>
									</table>
		
		</form>
	</div>
	</div>
	</div>
	</div>
	{literal}
	<script type="text/javascript" src="jquery-1.11.3.min.js"></script>
		<script type="text/javascript" src="js/wickedpicker.js"></script>
		<script type="text/javascript">
		$('.timepicker').wickedpicker();		
		$('.timepicker1').wickedpicker();
		</script>
	
	{/literal}
</body>
</html>
