<?php 
	include "includes/common.php";
    include_once $config['SiteClassPath']."class.Admin.php";
	include_once $config['SiteClassPath']."class.split_page_results.php";
	//echo 'hi';
	$objAdmin	= new Admin();
	$tablename="tbl_meetings";
	$id="Id";
	$word="MeetingName";
	$objAdmin->sesionset();
	if($_REQUEST['hdAction']!="") {		
		$objAdmin->add_meeting();
	}
	
	$objSmarty->assign("ActivePage", "3");
	
	$objAdmin->GetdeptByID();
	$objAdmin->Getnotuser();
	$objAdmin->Getmeetingtype();
	

	$objSmarty->assign("objAdmin", $objAdmin);
	$objSmarty->assign("IncludeTpl", "add_meeting.tpl");
	$objSmarty->display("pagetemplate.tpl");
	?>