<?php 
	include "../includes/common.php";
 
   include_once $config['SiteClassPath']."class.Admin.php";

	
	$objAdmin	= new Admin();
	

	$objAdmin->chkLogin();
	

    
$objAdmin->Get_account_Details();
	

	$objSmarty->assign("page", "1");

	$objSmarty->assign("IncludeTpl", "account_details.tpl");
	
$objSmarty->display("pagetemplate.tpl");
?>