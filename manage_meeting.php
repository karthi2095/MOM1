<?php 
	include "includes/common.php";
    include_once $config['SiteClassPath']."class.Admin.php";
	include_once $config['SiteClassPath']."class.split_page_results.php";
	
	$objAdmin	= new Admin();
	$tablename="tbl_meetings";
	$id="Id";
	$word="MeetingName"; 
	$objAdmin->sesionset();
	if($_REQUEST['setStatus']!=""){
		$objAdmin->Set_Status($tablename,$id,$word);
	}elseif($_REQUEST['ActionType']!=""){
		$objAdmin->Change_Table($tablename,$id,$word);
	}elseif($_REQUEST['hdIdent']!=""){
		//$objAdmin->Delete_Record($tablename,$id,$word);
		$objAdmin->Delete_Meeting();
	}
	$objSmarty->assign("ActivePage", "3");
	$objAdmin->Getmeeting();
	$objSmarty->assign("objAdmin", $objAdmin);
	$objSmarty->assign("IncludeTpl", "manage_meeting.tpl");
	$objSmarty->display("pagetemplate.tpl");

?>