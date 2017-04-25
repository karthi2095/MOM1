<?php 
include "includes/common.php";
$query  = "SELECT * FROM tbl_users WHERE Department_Id='".$_REQUEST['departmentuser']."'";
$execute = mysql_query($query);
?>
<select name="department_user" id="department_user" >
<option value="0">Select User</option>
<?php  while ($arexecute=mysql_fetch_array($execute)) { 
?>
<option value=<?php echo $arexecute['Id']?>><?php echo $arexecute['EmployeeName']?></option>
<?php } ?>
</select>



