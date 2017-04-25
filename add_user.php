<?php 
	include "includes/common.php";
    include_once $config['SiteClassPath']."class.Admin.php";
	include_once $config['SiteClassPath']."class.split_page_results.php";
	
	$objAdmin	= new Admin();
	$tablename="tbl_users";
	$id="Id";
	$word="User";
	$objAdmin->sesionset();
	if($_REQUEST['hdAction']!=""){
	$objSmarty->assign('category',$_REQUEST);
	$objAdmin->add_user();
	
	}
	$objSmarty->assign("ActivePage", "2");

	$objAdmin->GetdeptByID();
	$objSmarty->assign("objAdmin", $objAdmin);
		$objSmarty->assign("IncludeTpl", "add_user.tpl");
	$objSmarty->display("pagetemplate.tpl");
?>