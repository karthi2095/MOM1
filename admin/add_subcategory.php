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
		$objCategory->addSubCategory();
		//$objUser->getstateid();
	}
	$objCategory->getCategory();
	$objSmarty->assign("objCategory", $objCategory);
	$objSmarty->assign("page", "4");
	$objSmarty->assign("IncludeTpl", "add_subcategory.tpl");
	$objSmarty->display("pagetemplate.tpl");
?>