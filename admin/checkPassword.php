<?php 
	include "../includes/common.php";
    
	$SelQuery	= "SELECT `Ident` FROM `admin`"
		              ." WHERE binary `Password` = '".addslashes($_REQUEST['CurPwd'])."' AND `Ident` = ".$_SESSION['admin_id']." LIMIT 0,1";
		$SelFetch	= mysql_query($SelQuery);
		$num = mysql_num_rows($SelFetch);
		echo $num;
		
?>