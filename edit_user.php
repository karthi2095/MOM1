<?php   
	include "includes/common.php";
	include_once $config['SiteClassPath']."class.Admin.php";
	include_once $config['SiteClassPath']."class.split_page_results.php";
	$objAdmin	= new Admin();
	//echo 'welcome5';
	$objAdmin->sesionset();
	if($_REQUEST['hdAction']!=""){
		//print_r($_REQUEST);exit;
		$objAdmin->update_user();
	}
	$objSmarty->assign("ActivePage", "2");

	$objAdmin->GetdeptByID();
	$objAdmin->getUserById();
	$objSmarty->assign("IncludeTpl", "edit_user.tpl");
	$objSmarty->display("pagetemplate.tpl");
?>