<?php 
include_once("../includes/common.php");
include_once $config['SiteClassPath']."class.ManageStudent.php";
	$objStudent	= new ManageStudent();


 $uid=$_REQUEST['uid'];

if($_REQUEST['key']=='1'){
	 $sql="update   tbl_student set Status='1'  where StudId='".$uid."' LIMIT 1";
	
$UpdateQuery1=$objStudent->ExecuteQuery($sql, "update");

}else{
	$sql="update tbl_student set ParentStatus='1' where StudId='".$uid."' LIMIT 1";
	
$UpdateQuery1=$objStudent->ExecuteQuery($sql, "update");

}
?>
<table width="50%" align="center" style="margin-top:100px;">
<tr>
<th style="font-size:28px;background:green;color:white;height:40px;">
Welcome to Tutoring
</th>

</tr>
<tr align="center" style="font-size:14px;font-family:verdana;padding-top:20px;"><td>Thank You for Joining the Tutoring service.</td></tr>
</table>