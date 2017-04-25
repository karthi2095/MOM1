<?php 
	include "includes/common.php";
    include_once $config['SiteClassPath']."class.Admin.php";
	include_once $config['SiteClassPath']."class.split_page_results.php";
	
	$objAdmin	= new Admin();
	$tablename="tbl_meetings";
	$id="Id";
	$word="MeetingName"; 
	$objAdmin->sesionset();
	
	$objAdmin->Getsixmonthmeeting();
	$objSmarty->assign("ActivePage", "0");
	$objSmarty->assign("objAdmin", $objAdmin);
	$objSmarty->assign("IncludeTpl", "history.tpl");
	$objSmarty->display("pagetemplate.tpl");

?>