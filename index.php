<?php 
	include "includes/common.php";
    include_once $config['SiteClassPath']."class.Admin.php";
	include_once $config['SiteClassPath']."class.split_page_results.php";
	//echo 'hi';
	$objAdmin	= new Admin();
	
//print_r($_REQUEST);exit;
		if($_REQUEST['hdAction'] != '')
	{
		$objAdmin->adminlogin();
	}
	
	$objSmarty->assign("objAdmin", $objAdmin);
	//$objSmarty->assign("Errormsg", $Errormsg);
	$objSmarty->display("index.tpl");
?>