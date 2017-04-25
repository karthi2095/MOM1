<?php   
	include "includes/common.php";
	include_once $config['SiteClassPath']."class.Admin.php";
	include_once $config['SiteClassPath']."class.split_page_results.php";
	$objAdmin	= new Admin();
	//echo 'welcome5';
	$objAdmin->sesionset();
	if($_REQUEST['hdAction']!=""){
		//print_r($_REQUEST);
		$objAdmin->update_meeting();
		
	}
	$objSmarty->assign("ActivePage", "3");

	$objAdmin->GetdeptByID();
	$objAdmin->Getnotuser();
	$objAdmin->GetuseByID();
	$objAdmin->Getmeetingtype();
	$objAdmin->getMeetingById();
	//$objAdmin->getActionById();
	$objSmarty->assign("objAdmin",$objAdmin);
	$objSmarty->assign("IncludeTpl", "edit_meeting.tpl");
	$objSmarty->display("pagetemplate.tpl");
?>