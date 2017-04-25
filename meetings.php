<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Minutes of Meeting</title>
	<meta http-equiv="X-UA-Compatible" content="IE=9" />
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" href="css/all.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
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
</head>
<!--Design Prepared by Rajasri Systems-->   
<body>
<div id="wrapper">
	<div id="header">
		<a href="index.html" class="inner-logo"><img src="img/logo.png" alt=""/></a>
	<ul id="top-navigation">
		<li><a href="controlpanel.html" class="navigation_link">Homepage</a></li>
		<li><a href="department.html" class="navigation_link">Department</a></li>
		<li><a href="users.html" class="navigation_link">Users</a></li>
		<li class="active"><a href="meetings.html" class="navigation_link">Meetings</a></li>
	</ul>
	</div>
<div style="clear:both;"></div>
<div id="middle"> 
  <div id="center-column">
    <div class="top-bar-header">
      <h1>Mintues of Meeting</h1>
      <div class="breadcrumbs">Homepage >> Mintues of Meeting</div>
    </div>
    <br />
   <div class="manage-grid">
	<table border="0" cellpadding="2" cellspacing="0" class="grid-table" style="width: 100%; border: none; background-color: #f5f6f7;">
		<tr>
			<td style="border: none;">
				<a href="add_meetings.html"><img src="img/add.png" alt="" style="float: right; padding: 10px;"></a>
			</td>
		</tr>
	</table>
		<table border="0" cellpadding="2" cellspacing="0" class="grid-table" style="width: 100%";>
			<tr>
				<th width="5%">S No</th>
				<th>Meeting Name</th>
				<th width="10%">Meeting Date</th>
				<th>Meeting Owner</th>
				<th>Action Items</th>
				<th>Responsible Person-Dept</th>
				<th width="10%">Action Due Date</th>
				<th width="10%">Action Status</th>
				<th width="10%">Action</th>
			</tr>
			<?php if(($_GET['action']=='c')&&($_GET['status']=='o')){ ?> 
			<tr>
				<td style="text-align:center;">1</td>
				<td>Requirement Discussion</td>
				<td>Dec 20, 2016</td>
				<td>David - 56325</td>
				<td>Need to talk with Client</td>
				<td>Suguna - Production</td>
				<td>Dec 24, 2016</td>
				<td><span style="color: red; font-weight: bold;">Critical</span> - Open</td>
				<td style="text-align: center;">&nbsp;<img src="img/edit.png" width="25" height="25" alt=""/>&nbsp;&nbsp;<img src="img/active.png" width="20" height="20" alt=""/>&nbsp;&nbsp;<img src="img/delete.png" width="20" height="20" alt=""/></a></td>
			</tr>
			<tr>
				<td colspan="4" style="border: none;"></td>
				<td>Initial Discussion</td>
				<td>Harikrishnan - Admin</td>
				<td>Dec 24, 2016</td>
				<td><span style="color: red; font-weight: bold;">Critical</span> - Open</td>
				<td style="text-align: center;">&nbsp;<img src="img/edit.png" width="25" height="25" alt=""/>&nbsp;&nbsp;<img src="img/active.png" width="20" height="20" alt=""/>&nbsp;&nbsp;<img src="img/delete.png" width="20" height="20" alt=""/></a></td>
			</tr>
			<tr>
				<td colspan="4" style="border: none;"></td>
				<td>Initial Discussion</td>
				<td>Gautham Krishna - Finance</td>
				<td>Dec 24, 2016</td>
				<td><span style="color: red; font-weight: bold;">Critical</span> - Open</td>
				<td style="text-align: center;">&nbsp;<img src="img/edit.png" width="25" height="25" alt=""/>&nbsp;&nbsp;<img src="img/active.png" width="20" height="20" alt=""/>&nbsp;&nbsp;<img src="img/delete.png" width="20" height="20" alt=""/></a></td>
			</tr>
			<?php }?>

			<?php if(($_GET['action']=='c')&&($_GET['status']=='c')){ ?>
			<tr>
				<td style="text-align:center;">1</td>
				<td>Project Scope</td>
				<td>Dec 20, 2016</td>
				<td>David - 56325</td>
				<td>Need to talk with Client</td>
				<td>Suguna - Production</td>
				<td>Dec 24, 2016</td>
				<td><span style="color: red; font-weight: bold;">Critical</span> - Closed</td>
				<td style="text-align: center;">&nbsp;<img src="img/edit.png" width="25" height="25" alt=""/>&nbsp;&nbsp;<img src="img/active.png" width="20" height="20" alt=""/>&nbsp;&nbsp;<img src="img/delete.png" width="20" height="20" alt=""/></a></td>
			</tr>
			<tr>
				<td colspan="4" style="border: none;"></td>
				<td>Initial Discussion</td>
				<td>Harikrishnan - Admin</td>
				<td>Dec 24, 2016</td>
				<td><span style="color: red; font-weight: bold;">Critical</span> - Closed</td>
				<td style="text-align: center;">&nbsp;<img src="img/edit.png" width="25" height="25" alt=""/>&nbsp;&nbsp;<img src="img/active.png" width="20" height="20" alt=""/>&nbsp;&nbsp;<img src="img/delete.png" width="20" height="20" alt=""/></a></td>
			</tr>
			<tr>
				<td colspan="4" style="border: none;"></td>
				<td>Initial Discussion</td>
				<td>Gautham Krishna - Finance</td>
				<td>Dec 24, 2016</td>
				<td><span style="color: red; font-weight: bold;">Critical</span> - Closed</td>
				<td style="text-align: center;">&nbsp;<img src="img/edit.png" width="25" height="25" alt=""/>&nbsp;&nbsp;<img src="img/active.png" width="20" height="20" alt=""/>&nbsp;&nbsp;<img src="img/delete.png" width="20" height="20" alt=""/></a></td>
			</tr>
			<?php }?>
			
			
			<?php if(($_GET['action']=='h')&&($_GET['status']=='o')){ ?>
			<tr>
				<td style="text-align:center;">1</td>
				<td>Requirement Discussion</td>
				<td>Dec 20, 2016</td>
				<td>David - 56325</td>
				<td>Need to talk with Client</td>
				<td>Suguna - Production</td>
				<td>Dec 24, 2016</td>
				<td><span style="color: green; font-weight: bold;">High</span> - Open</td>
				<td style="text-align: center;">&nbsp;<img src="img/edit.png" width="25" height="25" alt=""/>&nbsp;&nbsp;<img src="img/active.png" width="20" height="20" alt=""/>&nbsp;&nbsp;<img src="img/delete.png" width="20" height="20" alt=""/></a></td>
			</tr>
			<tr>
				<td colspan="4" style="border: none;"></td>
				<td>Initial Discussion</td>
				<td>Harikrishnan - Admin</td>
				<td>Dec 24, 2016</td>
				<td><span style="color: green; font-weight: bold;">High</span> - Open</td>
				<td style="text-align: center;">&nbsp;<img src="img/edit.png" width="25" height="25" alt=""/>&nbsp;&nbsp;<img src="img/active.png" width="20" height="20" alt=""/>&nbsp;&nbsp;<img src="img/delete.png" width="20" height="20" alt=""/></a></td>
			</tr>
			<tr>
				<td colspan="4" style="border: none;"></td>
				<td>Initial Discussion</td>
				<td>Gautham Krishna - Finance</td>
				<td>Dec 24, 2016</td>
				<td><span style="color: green; font-weight: bold;">High</span> - Open</td>
				<td style="text-align: center;">&nbsp;<img src="img/edit.png" width="25" height="25" alt=""/>&nbsp;&nbsp;<img src="img/active.png" width="20" height="20" alt=""/>&nbsp;&nbsp;<img src="img/delete.png" width="20" height="20" alt=""/></a></td>
			</tr>
			<tr>
				<td style="text-align:center;">1</td>
				<td>Requirement Discussion</td>
				<td>Dec 20, 2016</td>
				<td>David - 56325</td>
				<td>Need to talk with Client</td>
				<td>Suguna - Production</td>
				<td>Dec 24, 2016</td>
				<td>Low - Open</td>
				<td style="text-align: center;">&nbsp;<img src="img/edit.png" width="25" height="25" alt=""/>&nbsp;&nbsp;<img src="img/active.png" width="20" height="20" alt=""/>&nbsp;&nbsp;<img src="img/delete.png" width="20" height="20" alt=""/></a></td>
			</tr>
			<tr>
				<td colspan="4" style="border: none;"></td>
				<td>Initial Discussion</td>
				<td>Harikrishnan - Admin</td>
				<td>Dec 24, 2016</td>
				<td>Low - Open</td>
				<td style="text-align: center;">&nbsp;<img src="img/edit.png" width="25" height="25" alt=""/>&nbsp;&nbsp;<img src="img/active.png" width="20" height="20" alt=""/>&nbsp;&nbsp;<img src="img/delete.png" width="20" height="20" alt=""/></a></td>
			</tr>
			<tr>
				<td colspan="4" style="border: none;"></td>
				<td>Initial Discussion</td>
				<td>Gautham Krishna - Finance</td>
				<td>Dec 24, 2016</td>
				<td>Low - Open</td>
				<td style="text-align: center;">&nbsp;<img src="img/edit.png" width="25" height="25" alt=""/>&nbsp;&nbsp;<img src="img/active.png" width="20" height="20" alt=""/>&nbsp;&nbsp;<img src="img/delete.png" width="20" height="20" alt=""/></a></td>
			</tr>
			<?php  }?>

			<?php if(($_GET['action']=='h')&&($_GET['status']=='c')){ ?>
			<tr>
				<td style="text-align:center;">1</td>
				<td>Project Scope</td>
				<td>Dec 20, 2016</td>
				<td>David - 56325</td>
				<td>Need to talk with Client</td>
				<td>Suguna - Production</td>
				<td>Dec 24, 2016</td>
				<td><span style="color: green; font-weight: bold;">High</span> - Closed</td>
				<td style="text-align: center;">&nbsp;<img src="img/edit.png" width="25" height="25" alt=""/>&nbsp;&nbsp;<img src="img/active.png" width="20" height="20" alt=""/>&nbsp;&nbsp;<img src="img/delete.png" width="20" height="20" alt=""/></a></td>
			</tr>
			<tr>
				<td colspan="4" style="border: none;"></td>
				<td>Initial Discussion</td>
				<td>Harikrishnan - Admin</td>
				<td>Dec 24, 2016</td>
				<td><span style="color: green; font-weight: bold;">High</span> - Closed</td>
				<td style="text-align: center;">&nbsp;<img src="img/edit.png" width="25" height="25" alt=""/>&nbsp;&nbsp;<img src="img/active.png" width="20" height="20" alt=""/>&nbsp;&nbsp;<img src="img/delete.png" width="20" height="20" alt=""/></a></td>
			</tr>
			<tr>
				<td colspan="4" style="border: none;"></td>
				<td>Initial Discussion</td>
				<td>Gautham Krishna - Finance</td>
				<td>Dec 24, 2016</td>
				<td><span style="color: green; font-weight: bold;">High</span> - Closed</td>
				<td style="text-align: center;">&nbsp;<img src="img/edit.png" width="25" height="25" alt=""/>&nbsp;&nbsp;<img src="img/active.png" width="20" height="20" alt=""/>&nbsp;&nbsp;<img src="img/delete.png" width="20" height="20" alt=""/></a></td>
			</tr>
			<tr>
				<td style="text-align:center;">1</td>
				<td>Project Scope</td>
				<td>Dec 20, 2016</td>
				<td>David - 56325</td>
				<td>Need to talk with Client</td>
				<td>Suguna - Production</td>
				<td>Dec 24, 2016</td>
				<td>Low - Closed</td>
				<td style="text-align: center;">&nbsp;<img src="img/edit.png" width="25" height="25" alt=""/>&nbsp;&nbsp;<img src="img/active.png" width="20" height="20" alt=""/>&nbsp;&nbsp;<img src="img/delete.png" width="20" height="20" alt=""/></a></td>
			</tr>
			<tr>
				<td colspan="4" style="border: none;"></td>
				<td>Initial Discussion</td>
				<td>Harikrishnan - Admin</td>
				<td>Dec 24, 2016</td>
				<td>Low - Closed</td>
				<td style="text-align: center;">&nbsp;<img src="img/edit.png" width="25" height="25" alt=""/>&nbsp;&nbsp;<img src="img/active.png" width="20" height="20" alt=""/>&nbsp;&nbsp;<img src="img/delete.png" width="20" height="20" alt=""/></a></td>
			</tr>
			<tr>
				<td colspan="4" style="border: none;"></td>
				<td>Initial Discussion</td>
				<td>Gautham Krishna - Finance</td>
				<td>Dec 24, 2016</td>
				<td>Low - Closed</td>
				<td style="text-align: center;">&nbsp;<img src="img/edit.png" width="25" height="25" alt=""/>&nbsp;&nbsp;<img src="img/active.png" width="20" height="20" alt=""/>&nbsp;&nbsp;<img src="img/delete.png" width="20" height="20" alt=""/></a></td>
			</tr>
			<?php  }?>
			

			

		</table>
	</div>
 </div>
</div>
</div>	
	

</body>
</html>