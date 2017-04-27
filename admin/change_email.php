<?php 
	include "../includes/common.php";
    include_once $config['SiteClassPath']."class.Admin.php";
	
	$objAdmin	= new Admin();
	
	$objAdmin->chkLogin();
	if($_REQUEST['submit']=="Change"){
		$objAdmin->changeEmail();
	}
	
	$objSmarty->assign("page", "1");
	$objSmarty->assign("IncludeTpl", "change_email.tpl");
	$objSmarty->display("pagetemplate.tpl");
?>