<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Minutes of Meeting</title>
	<meta http-equiv="X-UA-Compatible" content="IE=9" />
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" href="css/all.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<!--Design Prepared by Rajasri Systems-->   
<body>

<div id="wrapper">
	<div id="header">
	<div class="header-inner-div">
		<a href="index.html" class="inner-logo"><img src="images/nissan-logo.png" alt=""/></a>
	<ul id="top-navigation">
		
			<li {if $ActivePage eq 0} class="active" {/if}><a href="controlPanel.php" class="navigation_link">Homepage</a></li>
		
			<li {if $ActivePage eq 1} class="active" {/if}><a href="manage_dept.php" class="navigation_link">Department</a></li>
			<li {if $ActivePage eq 2} class="active" {/if}><a href="manage_user.php" class="navigation_link">Users</a></li>
		
			<li {if $ActivePage eq 3} class="active" {/if}><a href="manage_meeting.php" class="navigation_link">Meetings</a></li>
			<li ><a href="logout.php" class="navigation_link">Logout</a></li>
		
			<div style="clear:both;"></div>
		</ul>
		<input type="hidden" name="actheader" id="actheader" value="$smaryt.server.PHP_SELF"></input>
		<div style="clear:both;"></div>
		</div>
		<div style="clear:both;"></div>
	</div>
<div style="clear:both;"></div>