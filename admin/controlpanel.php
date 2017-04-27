<?php 
	include "../includes/common.php";
    include_once $config['SiteClassPath']."class.Admin.php";
	
	$objAdmin	= new Admin();
	
	$objAdmin->chkLogin();

	$objSmarty->assign("page", "0");
	$objSmarty->assign("IncludeTpl", "controlpanel.tpl");
	$objSmarty->display("pagetemplate.tpl");
?>