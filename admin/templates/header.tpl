<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Admin</title>
	<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<link rel="icon" type="image/ico" href="favicon.ico" />
  <link rel="icon" href="favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="favicon.ico" type="image/vnd.microsoft.icon" />
<script language="javascript" type="text/javascript" src="javascript/jquery-1.3.2.js"></script>
<script language="javascript" type="text/javascript" src="javascript/admin_valid.js"></script>
<script language="javascript" type="text/javascript" src="javascript/dateValidation.js"></script>
<script type="text/javascript" src="javascript/jquery-latest.js"></script>
<!-- <link type="text/css" href="../calendar/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/jquery-ui-1.7.2.custom.min.js"></script>-->
	{literal}
<script type="text/javascript">

function noError(){return true;}
window.onerror = noError;

</script>
	{/literal}
</head>
<!--Design Prepared by Rajasri Systems-->   
<body>
<div id="main">
	<div id="header">
		<a href="index.php" class="logo"><img src="img/logo1.gif" alt="" /></a>
				
		{if $smarty.session.TWAdminLogin neq ""}
		<ul id="top-navigation">
			{if $page eq '0'}
			<li class="active"><span><span>Homepage</span></span></li>
			{else}
			<li><span><span><a href="controlpanel.php" class="navigation_link">Homepage</a></span></span></li>
			{/if}
			{if $page eq 1}
			<li class="active"><span><span>Admin</span></span></li>
			{else}
			<li><span><span><a href="account_details.php" class="navigation_link">Admin</a></span></span></li>
			{/if}
			{if $page eq 2}
			<li class="active"><span><span>Meeting Type</span></span></li>
			{else}
			<li><span><span><a href="manage_meetingtype.php" class="navigation_link">Meeting Type</a></span></span></li>
			{/if}
	
			<li><span><span><a href="logout.php" class="navigation_link">Logout</a></span></span></li>
			
		</ul>
		{/if}
		
	</div>