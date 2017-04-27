<?php /* Smarty version 2.6.3, created on 2017-04-24 04:43:37
         compiled from edit_dept.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'stripslashes', 'edit_dept.tpl', 55, false),array('modifier', 'htmlspecialchars', 'edit_dept.tpl', 55, false),)), $this); ?>
<?php echo '
<script>
function GoBack()
{  
	window.location 		=\'manage_dept.php\';
}
function cat_valid()
{ 
	document.getElementById(\'errmsg\').innerHTML=\'\';
	document.getElementById(\'sucmsg\').innerHTML=\'\';
	DepartmentName=document.getElementById(\'DepartmentName\').value;
	//document.getElementById(\'DepartmentName\').value=DepartmentName;
	if(DepartmentName.trim()==\'\'){
		document.getElementById(\'errmsg\').innerHTML=\'Please enter the department name\';
		document.getElementById(\'DepartmentName\').focus();
		return false;
	 }
	// alert(\'test\');
	//$(\'#hdAction\').val(\'1\');
	document.getElementById(\'hdAction\').value=1;
	//alert(\'test\');
	//alert(document.getElementById(\'hdAction\').value);
}

//////////Dirty Message End///////////////
</script>
'; ?>


<div id="middle"> 
<form name="edit_dept" id="edit_dept" action="" method="post" onsubmit="return cat_valid();">
		<input type="hidden" name="CatIdent">
		<input type="hidden" name="Ident" value="<?php echo $_REQUEST['Ident']; ?>
">
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
	<div align="center" class="Error" id="errmsg" style="color:red;"><?php echo $this->_tpl_vars['ErrorMessage']; ?>
</div>
	<div align="center" class="Success" id="sucmsg" style="color:green;"><?php echo $this->_tpl_vars['SuccessMessage']; ?>
</div>
		<table border="0" cellpadding="2" cellspacing="0" class="grid-table" style="width: 70%; margin-left: 190px;">
			
			<tr>
				<td width="30%" style="padding: 15px;">Department Name:<span class="mandatory" style="color:red">*</span></td>
				<td><input type="text" name="DepartmentName" id="DepartmentName" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['Depart']['0']['DepartmentName'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)))) ? $this->_run_mod_handler('htmlspecialchars', true, $_tmp) : htmlspecialchars($_tmp)); ?>
" size="30" /></td>
				
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