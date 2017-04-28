<?php   
	include "includes/common.php";
	include_once $config['SiteClassPath']."class.Admin.php";
	include_once $config['SiteClassPath']."class.split_page_results.php";
	$objAdmin	= new Admin();
	//echo 'welcome5';
	$objAdmin->sesionset();
	if($_REQUEST['hdAction']!=""){
		//print_r($_REQUEST);
		$objAdmin->renewal_meeting();
		
	}
	$objSmarty->assign("ActivePage", "3");
	$objAdmin->adminlogin();
	
	$objAdmin->GetdeptByID();
	$objAdmin->Getnotuser();
	$objAdmin->GetuseByID();
	//$objAdmin->Getmeetingtype();
	$objAdmin->getMeetingById();
	$objAdmin->getActionById();
	$date=date("Y-m-d");
	$objSmarty->assign("dat", $date);
	$objAdmin->getActionById();
	$objSmarty->assign("objAdmin",$objAdmin);
	$objSmarty->assign("IncludeTpl", "renewal_meeting.tpl");
	$objSmarty->display("pagetemplate.tpl");
?>