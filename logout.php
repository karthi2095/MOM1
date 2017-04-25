<?php 
	include "includes/common.php";
	session_destroy();
	unset($_SESSION);
	Redirect("index.php");
?>