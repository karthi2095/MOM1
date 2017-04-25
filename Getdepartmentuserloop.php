<?php 
include "includes/common.php";
$query  = "SELECT * FROM tbl_users WHERE Department_Id='".$_REQUEST['departmentuse']."'";
$execute = mysql_query($query);

$deptcnt = $_REQUEST['departmentcnt'];
?>

<select name="DepatuserId_<?php echo $deptcnt; ?>" id="DepatuserId_<?php echo $deptcnt; ?>" >
<option value="0">Select User</option>
<?php  while ($arexecute=mysql_fetch_array($execute)) { 
?>
<option value=<?php echo $arexecute['Id']?>><?php echo $arexecute['EmployeeName']?></option>
<?php } ?>
</select>



