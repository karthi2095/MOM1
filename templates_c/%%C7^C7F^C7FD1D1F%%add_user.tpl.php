<?php /* Smarty version 2.6.3, created on 2017-04-24 04:43:15
         compiled from add_user.tpl */ ?>
<?php echo '
<script>

function GoBack()
{  
	window.location 		=\'manage_user.php\';
}
function cat_valid()
{ 
	
	var email = /^([A-Za-z0-9_\\-\\.])+\\@([A-Za-z_\\-\\.])+\\.([A-Za-z]{2,4})$/;
	
	document.getElementById(\'errmsg\').innerHTML=\'\';
	document.getElementById(\'sucmsg\').innerHTML=\'\';
	EmployeeId=document.getElementById(\'EmployeeId\').value;
	EmployeeName=document.getElementById(\'EmployeeName\').value;
	Password=document.getElementById(\'Password\').value;
	Email=document.getElementById(\'Email\').value;
	DepartmentName=document.getElementById(\'DepartmentName\').value;
	Designation=document.getElementById(\'Designation\').value;
	
	
	if(EmployeeId.trim()==\'\'){
		document.getElementById(\'errmsg\').innerHTML=\'Please enter the Employee ID\';
		document.getElementById(\'EmployeeId\').focus();
		return false;
	 }
	if(EmployeeName.trim()==\'\'){
		document.getElementById(\'errmsg\').innerHTML=\'Please enter the Employee name\';
		document.getElementById(\'EmployeeName\').focus();
		return false;
	 }
	if(Password.trim()==\'\'){
		document.getElementById(\'errmsg\').innerHTML=\'Please enter the Password\';
		document.getElementById(\'Password\').focus();
		return false;
	 }
	else if (Password.search(/\\d/) == -1) {
	
	document.getElementById("errmsg").innerHTML="Password must have atleast one number"; 
	document.getElementById(\'Password\').focus();
	return false;
	    } 
	else if (Password.search(/[A-Z]/) == -1) {
		//alert("2");
	document.getElementById("errmsg").innerHTML="Password must have atleast one uppercase letter"; 
	document.getElementById(\'Password\').focus();
	return false;
	}
	
	
	else if (Password.search(/[a-z]/) == -1) {
		//alert("3");
	 document.getElementById("errmsg").innerHTML="Password must have atleast one Lowercase Letter"; 
	 document.getElementById(\'Password\').focus();
	return false;}
	
	     else if (Password.search(/[!@#$%^&*]/) == -1) {
	    	 //alert("4");
	document.getElementById("errmsg").innerHTML="Password must have atleast one special Charecter"; 
	document.getElementById(\'Password\').focus();
	return false;
	    }
	else if(Password.length<6 || Password.length>12){
		//alert("5");
	document.getElementById("errmsg").innerHTML="Password must be 6 or 12 charecter";
	document.getElementById(\'Password\').focus();
	return false;
	}
	var c=document.getElementById("cpsw").value;
	if(c==""){
	document.getElementById("errmsg").innerHTML="Please enter the Confirm password";
	document.getElementById(\'cpsw\').focus();
	return false;
	}
	if(Password != c){
		document.getElementById("errmsg").innerHTML="Do not match the password";
		document.getElementById(\'cpsw\').focus();
		return false;
		}
	if(Email.trim()==\'\'){
		document.getElementById(\'errmsg\').innerHTML=\'Please enter the email\';
		document.getElementById(\'Email\').focus();
		return false;
	 }
	if(email.test(document.getElementById("Email").value) == false)
    {
      document.getElementById(\'errmsg\').innerHTML="Please enter a valid email address";
           document.getElementById(\'Email\').focus();
         return false;
    }
	if(DepartmentName==\'0\'){
		document.getElementById(\'errmsg\').innerHTML=\'Please select the department\';
		document.getElementById(\'DepartmentName\').focus();
		return false;
	 }
	if(Designation.trim()==\'\'){
		document.getElementById(\'errmsg\').innerHTML=\'Please enter the designation\';
		document.getElementById(\'Designation\').focus();
		return false;
	 }
	document.getElementById(\'hdAction\').value=1;
}
//////////Dirty Message End///////////////
</script>
'; ?>


<div id="middle"> 
<form name="add_user" id="add_user" action="" method="post" onsubmit="return cat_valid();">
		<input type="hidden" name="CatIdent">
		<input type="hidden" name="Ident">
		<input type="hidden" name="hdIdent">
		<input type="hidden" name="hdAction" id="hdAction">
	 <div id="center-column">
    <div class="top-bar-header">
      <h1>User Management</h1>
      <div class="breadcrumbs"><a href="controlPanel.php">Homepage</a> >><a href="manage_user.php">User Management</a> >> Add User</div>
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
				<td width="30%" style="padding: 15px;">Employee ID:<span class="mandatory" style="color:red">*</span></td>
				<td><input type="text" name="EmployeeId" id="EmployeeId"  size="30" /></td>
			</tr>
			<tr>
				<td width="30%" style="padding: 15px;">Employee Name:<span class="mandatory" style="color:red">*</span></td>
				<td><input type="text" name="EmployeeName" id="EmployeeName"  size="30" /></td>
			</tr>
				<tr>
				<td width="30%" style="padding: 15px;"> Password:<span class="mandatory" style="color:red">*</span></td>
				<td><input type="password" name="Password" id="Password" size="30" /></td>
			 </tr>
				<tr>
				<td width="30%" style="padding: 15px;">Confirm Password:<span class="mandatory" style="color:red">*</span></td>
				<td><input type="password" name="cpsw" id="cpsw" size="30" /></td>
			 </tr>
			<tr>
				<td width="30%" style="padding: 15px;">Email:<span class="mandatory" style="color:red">*</span></td>
				<td><input type="text" name="Email" id="Email" size="30" /></td>
			 </tr>
			
			 
			 <tr>
				<td width="30%" style="padding: 15px;">Department Name:<span class="mandatory" style="color:red">*</span></td>
				<td>
				<select name="DepartmentName" id="DepartmentName" >
				<option value="0">--Select Department--</option>
					<?php unset($this->_sections['D']);
$this->_sections['D']['name'] = 'D';
$this->_sections['D']['loop'] = is_array($_loop=$this->_tpl_vars['dept']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['D']['show'] = true;
$this->_sections['D']['max'] = $this->_sections['D']['loop'];
$this->_sections['D']['step'] = 1;
$this->_sections['D']['start'] = $this->_sections['D']['step'] > 0 ? 0 : $this->_sections['D']['loop']-1;
if ($this->_sections['D']['show']) {
    $this->_sections['D']['total'] = $this->_sections['D']['loop'];
    if ($this->_sections['D']['total'] == 0)
        $this->_sections['D']['show'] = false;
} else
    $this->_sections['D']['total'] = 0;
if ($this->_sections['D']['show']):

            for ($this->_sections['D']['index'] = $this->_sections['D']['start'], $this->_sections['D']['iteration'] = 1;
                 $this->_sections['D']['iteration'] <= $this->_sections['D']['total'];
                 $this->_sections['D']['index'] += $this->_sections['D']['step'], $this->_sections['D']['iteration']++):
$this->_sections['D']['rownum'] = $this->_sections['D']['iteration'];
$this->_sections['D']['index_prev'] = $this->_sections['D']['index'] - $this->_sections['D']['step'];
$this->_sections['D']['index_next'] = $this->_sections['D']['index'] + $this->_sections['D']['step'];
$this->_sections['D']['first']      = ($this->_sections['D']['iteration'] == 1);
$this->_sections['D']['last']       = ($this->_sections['D']['iteration'] == $this->_sections['D']['total']);
?>
					<option value="<?php echo $this->_tpl_vars['dept'][$this->_sections['D']['index']]['Id']; ?>
" <?php if ($this->_tpl_vars['dept'][$this->_sections['D']['index']]['Id'] == $this->_tpl_vars['Users']['0']['Department_Id']): ?> selected="selected" <?php endif; ?>><?php echo $this->_tpl_vars['dept'][$this->_sections['D']['index']]['DepartmentName']; ?>
</option>
					<?php endfor; endif; ?>
				</select>
				</td>
			</tr>
			<tr>
				<td width="30%" style="padding: 15px;">Designation:<span class="mandatory" style="color:red">*</span></td>
				<td><input type="text" name="Designation" id="Designation"  size="30" /></td>
			</tr>
			<tr class="bg">
				<td align="right" style="padding: 10px; text-align: center;" colspan="2">
				<a href="" style="text-decoration: none;"><input type="submit" class="btn-submit" value="Add" name="submit" onclick="return cat_valid();"/></a>
				&nbsp;&nbsp;&nbsp;
				<a href="manage_user.php" style="text-decoration: none;"><input type="button" class="btn-submit" value="Cancel" name="submit" /></a></td>
			</tr>
		</table>
	</div>
 </div>
 </form>
</div>
</div>	
</body>
</html>