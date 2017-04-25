<?php
include "includes/common.php";
$deptname=$_REQUEST['dept'];
echo $selqry = "select * from tbl_users where DepartmentName='".$deptname."'";
$rows=$access->ExecuteQuery($selqry,"select");
$option ='<select name ="choose" id="choose">';
$option .= '<option>--Select User--</option>';
foreach ($rows as $key => $value) {
	$value = $value['EmployeeName'].'-'.$value['EmployeeId'];
	$option .='<option value="'.$value.'">'.$value.'</option>';
}
$option .='</select>';
echo $option;

?>