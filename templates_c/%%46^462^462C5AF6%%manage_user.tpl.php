<?php /* Smarty version 2.6.3, created on 2017-04-24 09:48:02
         compiled from manage_user.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'manage_user.tpl', 73, false),array('modifier', 'stripslashes', 'manage_user.tpl', 76, false),array('modifier', 'ucfirst', 'manage_user.tpl', 77, false),)), $this); ?>
<?php echo '
<script language="javascript" type="text/javascript">
function editCats(CatIdent)
{
	FormName		= document.CatMgmt;
	FormName.Ident.value = CatIdent;
	FormName.action	= "edit_user.php";
	FormName.submit;
}
function deleteCats(CatIdent)
{
	//alert(CatIdent);
	if(confirm("Are you sure you want to delete?")){
	FormName		= document.CatMgmt;
	FormName.hdIdent.value = CatIdent;
	FormName.submit;
	}else{
		return false;
	}
}
function ChangeStatus(Ident,st)
{
	FormName				= document.CatMgmt;
	FormName.Ident.value 	= Ident;
	FormName.setStatus.value= st;
	FormName.submit;
}
function resetpage()
{
	FormName		= document.CatMgmt;
	//FormName.page.value	= \'\';
}
</script>
'; ?>

<div id="middle"> 
<form name="CatMgmt" method="post" onsubmit="resetpage();" action="">
            <input type="hidden" name="Ident">
			<input type="hidden" name="ConId[]">
			<input type="hidden" name="setStatus">
			<input type="hidden" name="hdIdent">
			<input type="hidden" name="CatIdent">
			<input type="hidden" name="ActionType">
  <div id="center-column">
    <div class="top-bar-header">
      <h1>User Management</h1>
    <div class="breadcrumbs"><a href="controlpanel.php" class="navigation_link" >Homepage</a> >> User Management</div>
    </div>
    <br />
	
    <div class="manage-grid">
	<table border="0" cellpadding="2" cellspacing="0" class="grid-table" style="width: 80%; margin:0 auto; border: none; background-color: #f5f6f7;">
		<tr>
			<td style="border: none;background: #f0edeb;">
				<a href="add_user.php"><img src="img/add.png" alt="" style="float: right; padding: 10px;"></a>
			</td>
		</tr>
	</table>
	<div align="center" class="Error" id="errmsg" style="color:red;"><?php echo $this->_tpl_vars['ErrorMessage']; ?>
</div>
	<div align="center" class="Success" id="sucmsg" style="color:green;"><?php echo $this->_tpl_vars['SuccessMessage']; ?>
</div>
		<table border="0" cellpadding="2" cellspacing="0" class="grid-table" style="width: 80%; margin:0 auto;">
			
			<tr>
				<th width="5%">S No</th>
				<th width="8%">Emp ID</th>
				<th>Name</th>
				<th width="25%">Email</th>
				<th>Department</th>
				<th width="18%">Designation</th>
				<th width="13%">Action</th>
			</tr>
			<?php if ($this->_tpl_vars['User'] != ""): ?>
			 <?php unset($this->_sections['D']);
$this->_sections['D']['name'] = 'D';
$this->_sections['D']['loop'] = is_array($_loop=$this->_tpl_vars['User']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			 <?php echo smarty_function_cycle(array('values' => ', bg','assign' => 'classname'), $this);?>

			 <tr class="<?php echo $this->_tpl_vars['classname']; ?>
">
			 <td align="center" valign="top"><center><?php echo $this->_tpl_vars['i']++; ?>
</center></td>
			 <td class="first style1" valign="top"><?php echo ((is_array($_tmp=$this->_tpl_vars['User'][$this->_sections['D']['index']]['EmployeeId'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
 </td>
			 <td class="first style1" valign="top"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['User'][$this->_sections['D']['index']]['EmployeeName'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)))) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
 </td>
			 <td class="first style1" valign="top"><?php echo ((is_array($_tmp=$this->_tpl_vars['User'][$this->_sections['D']['index']]['Email'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
 </td>
			 <td class="first style1" valign="top"><?php echo $this->_tpl_vars['objAdmin']->getDepartmentnameById($this->_tpl_vars['User'][$this->_sections['D']['index']]['Department_Id']); ?>
 </td>
			 <td class="first style1" valign="top"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['User'][$this->_sections['D']['index']]['Designation'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)))) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
 </td>
			 <td valign="top" style="text-align:center; font-size:0px;">
			 <a href="edit_user.php"><input type="image" class="icon-bor" src="img/edit.png" title="Edit" width="16" height="16" alt="Edit" border="0" onclick="Javascript:editCats('<?php echo $this->_tpl_vars['User'][$this->_sections['D']['index']]['Id']; ?>
')" /></a>
			 <?php if ($this->_tpl_vars['User'][$this->_sections['D']['index']]['Status'] == '1'): ?>
			 	 <input type="image" class="icon-bor" src="img/active.png" title="Active" width="16" height="16" alt="Active" border="0" onclick="Javascript:ChangeStatus('<?php echo $this->_tpl_vars['User'][$this->_sections['D']['index']]['Id']; ?>
','0')" /> 
			 	 <?php else: ?>
			 	 <input type="image" class="icon-bor" src="img/inactive.png" title="InActive" width="16" height="16" alt="Active" border="0" onclick="Javascript:ChangeStatus('<?php echo $this->_tpl_vars['User'][$this->_sections['D']['index']]['Id']; ?>
','1')" /> 
			 	 <?php endif; ?>
			 <input type="image" class="" src="img/delete.png" width="16" height="16" alt="Delete" border="0" onclick="Javascript:deleteCats('<?php echo $this->_tpl_vars['User'][$this->_sections['D']['index']]['Id']; ?>
')" title="Delete" /></td>
				
			 </tr>
				 <?php endfor; else: ?>
			 <tr class="<?php echo $this->_tpl_vars['classname']; ?>
">
				<td align="center" colspan="6" class="style1"><center>No User Found</center></td>
			 </tr>
				 <?php endif; ?>
				 <?php else: ?>
			 <tr class="<?php echo $this->_tpl_vars['classname']; ?>
">
				<td align="center" colspan="6" class="style1"><center>No User Found</center></td>
			 </tr>
				 <?php endif; ?>
			
		</table>
		</form>	
	</div>
 </div>
</div>
</div>	
	

</body>
</html>