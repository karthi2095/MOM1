<?php        
	include "../includes/common.php";
	include_once $config['SiteClassPath']."class.Admin.php";
	include_once $config['SiteClassPath']."class.ManageUser.php";
	include_once $config['SiteClassPath']."class.split_page_results.php";
	include_once $config['SiteClassPath']."class.ManageCategory.php";
	
	$objAdmin	= new Admin();
	$objUser	= new ManageUser();
	$objCategory	= new ManageCategory();
	
	$objAdmin->chkLogin();
	if($_REQUEST['hdAction']!=""){
		$objCategory->updateCategory();
	}
	$objCategory->select_Category();
	$objSmarty->assign("objUser", $objUser);
	$objSmarty->assign("objCategory", $objCategory);	
	$objSmarty->assign("page", "3");
	$objSmarty->assign("IncludeTpl", "edit_category.tpl");
	$objSmarty->display("pagetemplate.tpl");
?>