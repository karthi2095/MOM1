<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Minutes of Meeting</title>
	<meta http-equiv="X-UA-Compatible" content="IE=9" />
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" href="css/all.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.cs++++++s">
  <link rel="stylesheet" href="css/bootstrap.min.css">
   {literal}
  <script src="js/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script>
  $( function() {
    var availableTags = [
      "Requirement Discussion",
      "Project Scope",
      "Statutory Meeting",
      "Annual General Meeting",
      "Extraordinary General Meeting",
      "Meeting of the Board of Directors",
      "Class Meeting",
      "Meeting of Creditors",
      "Meeting of Contributories",
      "Meeting of Debenture Holders"
    ];
    $( "#tags" ).autocomplete({
      source: availableTags
    });
  } );
  
  $( function() {
    var availableTags1 = [
      "Initial Discussion",
      "First Round",
      "Initial Discussion",
      "Annual",
      "Section #3",
      "Board of Directors",
      "Class Meeting",
      "Creditors",
      "Contributories",
      "Debenture Holders"
    ];
    $( "#tags1" ).autocomplete({
      source: availableTags1
    });
  } );
  
  $( function() {
    var availableTags2 = [
      "Norma B. Levy - 56325",
      "Suzanne K. Roper - 99965",
      "Howard L. Henley - 56965",
      "Eric A. Murphy - 53325",
      "Tommy J. Lee - 99925",
      "Michael A. Hart - 96325",
      "Stephanie D. McGregor - 45455",
      "Christine J. Gaskins - 56455"
    ];
    $( "#tags2" ).autocomplete({
      source: availableTags2
    });
  } );
  </script>
  <script language="javascript" type="text/javascript">
  function editCats(CatIdent,medate)
  {
 
  var meetdate=document.getElementById("meetdate").value;
 
  	FormName		= document.CatMgmt;
  	FormName.Ident.value = CatIdent;
	if(meetdate <= medate ){
  	FormName.action	= "edit_meeting.php";
	}
	else
	{
	FormName.action	= "renewal_meeting.php";
	}
  	FormName.submit;
  }
  function viewCats(CatIdent)
  {
  	FormName		= document.CatMgmt;
  	FormName.Ident.value = CatIdent;
  	FormName.action	= "view_meeting.php";
  	FormName.submit;
  }
  function deleteCats(CatIdent)
  {
  	//alert(CatIdent);
  	if(confirm("Are you sure you want to delete?")){
  	FormName		= document.CatMgmt;
  	FormName.hdIdent.value = CatIdent;
 	FormName.submit;
  	}else{
  		return false;
  	}
  }
  function ChangeStatus(Ident,st)
  {
  	FormName				= document.CatMgmt;
  	FormName.Ident.value 	= Ident;
  	FormName.setStatus.value= st;
  	FormName.submit;
  }
  function resetpage()
  {
  	FormName		= document.CatMgmt;
  	//FormName.page.value	= '';
  }
  </script>

 {/literal}
</head>
<!--Design Prepared by Rajasri Systems-->   
<body>

<div id="middle"> 
<form name="CatMgmt" method="post" onsubmit="resetpage();" action="">
            <input type="hidden" name="Ident" id="Ident">
			<input type="hidden" name="ConId[]" id="ConId">
			<input type="hidden" name="setStatus" id="setStatus">
			<input type="hidden" name="hdIdent" id="hdIdent">
			<input type="hidden" name="CatIdent" id="CatIdent">
			<input type="hidden" name="meetdate" id="meetdate" value="{$dat}">
			<input type="hidden" name="medate" id="medate">
			<input type="hidden" name="ActionType" id="ActionType">
  <div id="center-column">
    <div class="top-bar-header">
      <h1>Minutes of Meeting</h1>
	  <div class="breadcrumbs"><a href="controlPanel.php" class="navigation_link" >Homepage</a> >> Minutes of Meeting 
			</div><br />

   
   <div class="manage-grid">
   <div style="width:80%; float:left;">
	<table border="0" cellpadding="2" cellspacing="0" class="grid-table" style="width: 100%; border: none; background-color: #f5f6f7;">
		<tr>
			<td style="border: none; background: #f0edeb;">
		
				<a href="add_meeting.php"><img src="img/add.png" alt="" style="float: right; padding: 10px;"></a>
			</td>
		</tr>
	</table>
		<div align="center" class="Error" id="errmsg" style="color:red;">{$ErrorMessage}{$createdby}</div>
		<div align="center" class="Success" id="sucmsg" style="color:green;">{$SuccessMessage}</div>
		<table border="0" cellpadding="2" cellspacing="0" class="grid-table" style="width: 100%";>
			<tr>
				<th width="5%">S No</th>
				<th>Meeting Name</th>
				<th>Meeting Type</th>
				<th width="10%">Meeting Date</th>
				<th>Meeting Owner</th>
				<th>Action Items</th>
				<th width="10%">Action Due Date</th>
				<th width="10%">Action Item Status</th>
			<th width="15%">Action</th>
			</tr>
			
			{assign var="meetingId" value=0}
			{if $meet neq ""}
			 {section name=D loop=$meet}
			 {cycle values=', bg' assign=classname}
			<tr class="{$classname}">
				
				{if $meetingId neq $meet[D].Id}
				<td class="first style1" align="center" valign="top"><center>{$i++}</center></td>
				<td class="first style1" valign="top">{$meet[D].MeetingName|stripslashes|ucfirst} </td>
				<td class="first style1" valign="top">{$objAdmin->getMeetingTypeById($meet[D].MeetingType)} &nbsp; &nbsp; <img src="admin/uploadimage/{$objAdmin->getMeetingImageById($meet[D].MeetingType)}" width="30" height="30"></td>
				<td class="first style1" valign="top">{$meet[D].MeetingDate|date_format:"%B %d, %Y"} </td>
				<td class="first style1" valign="top">{$objAdmin->getOwnernameById($meet[D].MeetingOwnerUserID)} </td>
				{else}
				<td class="first style1" valign="top" colspan="5" style="border:0">&nbsp;</td>				
				{/if}
				<td class="first style1" valign="top">{$meet[D].ActionItem|stripslashes|ucfirst} </td>
				<td class="first style1" valign="top">{$meet[D].DueDate|date_format:"%B %d, %Y"}  </td>
				<td class="first style1" valign="top" {if $meet[D].StatusOfAction eq "Closed"} style="color: #00B050;"{elseif $meet[D].StatusOfAction eq "Open" }style="color: #f00;"{elseif $meet[D].StatusOfAction eq "Yet to start"}style="color: #E4D209;"{/if}>{$meet[D].StatusOfAction|stripslashes|ucfirst} </td>
				
			{if $meetingId neq $meet[D].Id}
			<td valign="top" style="text-align:center; font-size:0px;">
				
				 <a href="edit_meeting.php">
				
				 <input type="image" class="icon-bor" src="img/edit.png" title="Edit" width="16" height="16" alt="Edit" border="0" onclick="Javascript:editCats('{$meet[D].Id}','{$meet[D].MeetingDate}')" /></a> 
				
				{if $meet[D].meetstatus eq '1'}
				 <input type="image" class="icon-bor" src="img/active.png" title="Active" width="16" height="16" alt="Active" border="0" onclick="Javascript:ChangeStatus('{$meet[D].meetId}','0')" />
			 	 {else}
			 	 <input type="image" class="icon-bor" src="img/inactive.png" title="InActive" width="16" height="16" alt="Active" border="0" onclick="Javascript:ChangeStatus('{$meet[D].meetId}','1')" />
			 	{/if}
			 	
			 	
			 	 <input type="image" class="icon-bor"  src="img/View.gif" title="View" width="16" height="16" alt="View" border="0" {if $userID neq $meet[D].CreatedBy} style="border-right: none !important;" {/if} onclick="Javascript:viewCats('{$meet[D].Id}')" />
			 	
			 	 <input type="image" class="" src="img/delete.png" width="16" height="16" alt="Delete" border="0" onclick="Javascript:deleteCats('{$meet[D].meetId}')" title="Delete" /></td>{/if}
				
			{assign var="meetingId" value=$meet[D].Id}
			</tr>
				 {sectionelse}
			 <tr class="{$classname}">
			 
			 
				<td align="center" colspan="8" class="style1"><center>No meetings found</center></td>
			 </tr>
				 {/section}
				 {else}
			 <tr class="{$classname}">
				<td align="center" colspan="8" class="style1"><center>No meetings found</center></td>
			 </tr>
				 {/if}
			</tr>
			
		</table>
		</div>
		<div class="grid-table" style="width: 19%; float: right; color: #333; padding: 2%;">
		   <div style="margin-bottom: 20px;">
				<p class="title1">Task Description</p>
			   <table style="width:100%;" border="0" cellpadding="2" cellspacing="0">
				   <tbody>
							
					   <tr>
							<td>
							<div class="act-closed"></div>
							</td>
							<td>Completed</td>
					   </tr>
					    <tr>
							<td>
							<div class="act-revised"></div>
							</td>
							<td>Revised</td>
					   </tr>
					   <tr>
							<td>
							<div class="act-open"></div>
							</td>
							<td>Delayed</td>
					   </tr>
					   <tr>
							<td>
							<div class="act-process"></div>
							</td>
							<td>Yet to Start</td>
					   </tr>
				   </tbody>
			   </table>
			</div>
			
			<div>
				<p class="title1">Action Status</p>
			   <table style="width:100%;" border="0" cellpadding="2" cellspacing="0">
				   <tbody>
							
					   <tr>
							<td>
							<div class="act-closed"></div>
							</td>
							<td>Closed</td>
					   </tr>
					   <tr>
							<td>
							<div class="act-open"></div>
							</td>
							<td>Open</td>
					   </tr>
					   <tr>
							<td>
							<div class="act-process"></div>
							</td>
							<td>Yet to start</td>
					   </tr>
				   </tbody>
			   </table>
			</div>
			<div class="clear"></div>
	   </div>
		<div class="clear"></div>
		</form>
		
	</div>
	<div class="clear"></div>
 </div>
 <div class="clear"></div>
</div>
<div class="clear"></div>
</div>	
	

</body>
</html>