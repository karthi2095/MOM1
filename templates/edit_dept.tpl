{literal}
<script>
function GoBack()
{  
	window.location 		='manage_dept.php';
}
function cat_valid()
{ 
	document.getElementById('errmsg').innerHTML='';
	document.getElementById('sucmsg').innerHTML='';
	DepartmentName=document.getElementById('DepartmentName').value;
	//document.getElementById('DepartmentName').value=DepartmentName;
	if(DepartmentName.trim()==''){
		document.getElementById('errmsg').innerHTML='Please enter the department name';
		document.getElementById('DepartmentName').focus();
		return false;
	 }
	// alert('test');
	//$('#hdAction').val('1');
	document.getElementById('hdAction').value=1;
	//alert('test');
	//alert(document.getElementById('hdAction').value);
}

//////////Dirty Message End///////////////
</script>
{/literal}

<div id="middle"> 
<form name="edit_dept" id="edit_dept" action="" method="post" onsubmit="return cat_valid();">
		<input type="hidden" name="CatIdent">
		<input type="hidden" name="Ident" value="{$smarty.request.Ident}">
		<input type="hidden" name="hdIdent">
		<input type="hidden" name="hdAction" id="hdAction">
	 <div id="center-column">
    <div class="top-bar-header">
      <h1>Department Management</h1>
      <div class="breadcrumbs"><a href="controlPanel.php">Homepage</a> >> <a href="manage_dept.php">Department Management</a> >> Edit Department</div>
    </div>
    <div class="select-bar">
		<div align="right"><img src="img/back.gif" title="Back" alt="Back" width="32" height="32" class="navigation_link" style="cursor:pointer;margin-right: 230px;" onclick="GoBack();"/></div>
	 </div>
    <div class="manage-grid">
	<table border="0" cellpadding="2" cellspacing="0" class="grid-table" style="width: 70%; margin-left: 190px; border: none; background-color: #f5f6f7;">
		<tr>
			
		</tr>
	</table>
	<div align="center" class="Error" id="errmsg" style="color:red;">{$ErrorMessage}</div>
	<div align="center" class="Success" id="sucmsg" style="color:green;">{$SuccessMessage}</div>
		<table border="0" cellpadding="2" cellspacing="0" class="grid-table" style="width: 70%; margin-left: 190px;">
			
			<tr>
				<td width="30%" style="padding: 15px;">Department Name:<span class="mandatory" style="color:red">*</span></td>
				<td><input type="text" name="DepartmentName" id="DepartmentName" value="{$Depart.0.DepartmentName|stripslashes|htmlspecialchars}" size="30" /></td>
				
			</tr>
			<tr class="bg">
				<td align="right" style="padding: 10px; text-align: center;" colspan="2">
				<a href="" style="text-decoration: none;"><input type="submit" class="btn-submit" value="Update" name="submit" onclick="return cat_valid();"/></a>
				&nbsp;&nbsp;&nbsp;
				<a href="manage_dept.php" style="text-decoration: none;"><input type="button" class="btn-submit" value="Cancel" name="submit" /></a></td>
			</tr>
		</table>
	</div>
 </div>
 </form>
</div>
</div>	
</body>
</html>