<?php 
include "includes/common.php";
$query  = "SELECT * FROM tbl_users WHERE Department_Id='".$_REQUEST['departmentuse']."'";
$execute = mysql_query($query);

?>

<select name="DepatuserId[]" id="Depatuser_Id">
<option value="0">Select User</option>
<?php  while ($arexecute=mysql_fetch_array($execute)) { 
?>
<option value=<?php echo $arexecute['Id']?>><?php echo $arexecute['EmployeeName']?></option>
<?php } ?>
</select>



