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
		$objCategory->addTeams();
		//$objCategory->getstateid();
	}
	
    
	$objSmarty->assign("page", "6");
	$objSmarty->assign("IncludeTpl", "add_team.tpl");
	$objSmarty->display("pagetemplate.tpl");
?>