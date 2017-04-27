<?php        
	include "../includes/common.php";
	include_once $config['SiteClassPath']."class.Admin.php";
	include_once $config['SiteClassPath']."class.ManageUser.php";
	include_once $config['SiteClassPath']."class.split_page_results.php";
	include_once $config['SiteClassPath']."class.ManageCategory.php";
	//print_r($_REQUEST);
	$objAdmin	= new Admin();
	$objUser	= new ManageUser();
	$objCategory	= new ManageCategory();
	
	$objAdmin->chkLogin();
	if($_REQUEST['hdAction']!=""){
		$objCategory->updateTeambyId();
	}
	$objCategory->getTeamById();
	$objSmarty->assign("objUser", $objUser);
	$objSmarty->assign("objCategory", $objCategory);	
	$objSmarty->assign("page", "6");
	$objSmarty->assign("IncludeTpl", "edit_team.tpl");
	$objSmarty->display("pagetemplate.tpl");
?>