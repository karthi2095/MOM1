<?php   
	include "includes/common.php";
	include_once $config['SiteClassPath']."class.Admin.php";
	include_once $config['SiteClassPath']."class.split_page_results.php";
	$objAdmin	= new Admin();
	
	$objSmarty->assign("ActivePage", "3");

	$objAdmin->GetdeptByID();
	$objAdmin->GetuseByID();
	$objAdmin->getMeetingById();
	$objAdmin->getActionById();
	//$objAdmin->Getmeetingtpart();
	//$objAdmin->userId($_REQUEST['id']);
	$objAdmin->sesionset();
	$objSmarty->assign("objAdmin",$objAdmin);
	$objSmarty->assign("IncludeTpl", "view_meeting.tpl");
	$objSmarty->display("pagetemplate.tpl");
?>