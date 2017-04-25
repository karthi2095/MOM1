<?php 
	include "includes/common.php";
    include_once $config['SiteClassPath']."class.Admin.php";
	include_once $config['SiteClassPath']."class.split_page_results.php";
	//print_r($_SESSION);exit;
	$objAdmin	= new Admin();
	$tablename="tbl_department";
	$id="Id";
	$word="Department name"; 
	$objAdmin->sesionset();
	if($_REQUEST['setStatus']!=""){
		$objAdmin->Set_Status($tablename,$id,$word);
	}elseif($_REQUEST['ActionType']!=""){
		$objAdmin->Change_Table($tablename,$id,$word);
	}elseif($_REQUEST['hdIdent']!=""){
		$objAdmin->Delete_Record($tablename,$id,$word);
	}
	$objSmarty->assign("ActivePage", "1");
	$objAdmin->Getdepartment();
	$objSmarty->assign("objAdmin", $objAdmin);
	$objSmarty->assign("IncludeTpl", "manage_dept.tpl");
	$objSmarty->display("pagetemplate.tpl");
	

?>