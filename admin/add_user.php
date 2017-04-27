<?php      
	include "../includes/common.php";
	include_once $config['SiteClassPath']."class.Admin.php";
	include_once $config['SiteClassPath']."class.ManageCategory.php";
	include_once $config['SiteClassPath']."class.split_page_results.php";
	
	$objAdmin	= new Admin();
	$objCategory	= new ManageCategory();
	
	$objAdmin->chkLogin();
	if($_REQUEST['hdAction']!=""){
		$objSmarty->assign('user',$_REQUEST);
		$objCategory->addUser();
	}
	$objCategory->getAllLeague();
	$objCategory->getCountry();
	$objSmarty->assign("page", "3");
	$objSmarty->assign("IncludeTpl", "add_user.tpl");
	$objSmarty->display("pagetemplate.tpl");
?>