<?php     
include "../includes/common.php";
 include "../includes/FCKeditor/fckeditor.php";
 include_once $config['SiteClassPath']."class.Admin.php";
	include_once $config['SiteClassPath']."class.Content.php";
	include_once $config['SiteClassPath']."class.split_page_results.php";
	
	$objAdmin	= new Admin();
	$objContent	= new Content();
	
	$objAdmin->chkLogin();
if($_REQUEST['hdAction']!=""){
	$objContent->EditContent();
}

$objContent->GetContentById();
      $objSmarty->assign("page", "2");
$objSmarty->assign("IncludeTpl", "edit_content.tpl");
$objSmarty->display("pagetemplate.tpl");
?>