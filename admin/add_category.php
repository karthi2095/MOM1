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
		$objCategory->addCategory();
		//$objUser->getstateid();
	}
	$objSmarty->assign("objCategory", $objCategory);
	$objSmarty->assign("page", "3");
	$objSmarty->assign("IncludeTpl", "add_category.tpl");
	$objSmarty->display("pagetemplate.tpl");
?>