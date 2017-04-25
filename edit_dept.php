<?php
	include "includes/common.php";
    include_once $config['SiteClassPath']."class.Admin.php";
	include_once $config['SiteClassPath']."class.split_page_results.php";
	
	$objAdmin	= new Admin();
	 $objAdmin->sesionset();
	if($_REQUEST['hdAction']!="")
	{
		$objAdmin->update_dept();
	}
	$objSmarty->assign("ActivePage", "1");

	$objAdmin->getDepartmentById();
	$objSmarty->assign("objAdmin", $objAdmin);
	$objSmarty->assign("IncludeTpl", "edit_dept.tpl");
	$objSmarty->display("pagetemplate.tpl");
?>