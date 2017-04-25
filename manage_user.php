<?php 
	include "includes/common.php";
    include_once $config['SiteClassPath']."class.Admin.php";
	include_once $config['SiteClassPath']."class.split_page_results.php";
	
	$objAdmin	= new Admin();
	$tablename="tbl_users";
	$id="Id";
	$word="Employee name"; 
	$objAdmin->sesionset();
	if($_REQUEST['setStatus']!=""){
		$objAdmin->Set_Status($tablename,$id,$word);
	}elseif($_REQUEST['ActionType']!=""){
		$objAdmin->Change_Table($tablename,$id,$word);
	}elseif($_REQUEST['hdIdent']!=""){
		$objAdmin->Delete_Record($tablename,$id,$word);
	}
	$objSmarty->assign("ActivePage", "2");
	$objAdmin->GetUser();
	$objSmarty->assign("objAdmin", $objAdmin);
	$objSmarty->assign("IncludeTpl", "manage_user.tpl");
	$objSmarty->display("pagetemplate.tpl");
	
?>