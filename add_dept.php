<?php 
	include "includes/common.php";
    include_once $config['SiteClassPath']."class.Admin.php";
	include_once $config['SiteClassPath']."class.split_page_results.php";
	
	$objAdmin	= new Admin();
	$tablename="tbl_department";
	$id="Id";
	$word="Department name"; 
	$objAdmin->sesionset();
	if($_REQUEST['hdAction']!=""){
		$objSmarty->assign('category',$_REQUEST);
		$objAdmin->add_department();
	}
	$objSmarty->assign("ActivePage", "1");

	$objSmarty->assign("objAdmin", $objAdmin);
	$objSmarty->assign("IncludeTpl", "add_dept.tpl");
	$objSmarty->display("pagetemplate.tpl");
?>