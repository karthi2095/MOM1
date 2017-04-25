<?php 
	include "includes/common.php";
    //include_once $config['SiteClassPath']."class.Admin.php";
    include_once $config['SiteClassPath']."class.ManageUser.php";
	include_once $config['SiteClassPath']."class.split_page_results.php";
	
	//$objAdmin	= new Admin();
	$objManageUser=new ManageUser();
	$objManageUser->Get_last_Records();
	//$objAdmin->sesionset();
	$objSmarty->assign("ActivePage", "0");
	//$objSmarty->assign("objAdmin", $objAdmin);
	$objSmarty->assign("objManageUser", $objManageUser);
	$objSmarty->assign("IncludeTpl", "controlPanel.tpl");
	$objSmarty->display("pagetemplate.tpl");
	?>