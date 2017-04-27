<?php 
	include "../includes/common.php";
    include_once $config['SiteClassPath']."class.Admin.php";
	
	$objAdmin	= new Admin();
	if(!isset($_SESSION['admin_id'])){
		if($_REQUEST['hdAction']=="1"){
			$objAdmin->forgotPassword();
		}
	}else{
		header("location:controlpanel.php");
	}
	
	$objSmarty->assign("IncludeTpl", "forgot.tpl");
	$objSmarty->display("pagetemplate.tpl");
?>