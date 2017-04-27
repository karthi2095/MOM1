{literal}
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
	//FormName.page.value	= '';
}
</script>
{/literal}
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
	<div align="center" class="Error" id="errmsg" style="color:red;">{$ErrorMessage}</div>
	<div align="center" class="Success" id="sucmsg" style="color:green;">{$SuccessMessage}</div>
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
			{if $User neq ""}
			 {section name=D loop=$User}
			 {cycle values=', bg' assign=classname}
			 <tr class="{$classname}">
			 <td align="center" valign="top"><center>{$i++}</center></td>
			 <td class="first style1" valign="top">{$User[D].EmployeeId|stripslashes} </td>
			 <td class="first style1" valign="top">{$User[D].EmployeeName|stripslashes|ucfirst} </td>
			 <td class="first style1" valign="top">{$User[D].Email|stripslashes} </td>
			 <td class="first style1" valign="top">{$objAdmin->getDepartmentnameById($User[D].Department_Id)} </td>
			 <td class="first style1" valign="top">{$User[D].Designation|stripslashes|ucfirst} </td>
			 <td valign="top" style="text-align:center; font-size:0px;">
			 <a href="edit_user.php"><input type="image" class="icon-bor" src="img/edit.png" title="Edit" width="16" height="16" alt="Edit" border="0" onclick="Javascript:editCats('{$User[D].Id}')" /></a>
			 {if $User[D].Status eq '1'}
			 	 <input type="image" class="icon-bor" src="img/active.png" title="Active" width="16" height="16" alt="Active" border="0" onclick="Javascript:ChangeStatus('{$User[D].Id}','0')" /> 
			 	 {else}
			 	 <input type="image" class="icon-bor" src="img/inactive.png" title="InActive" width="16" height="16" alt="Active" border="0" onclick="Javascript:ChangeStatus('{$User[D].Id}','1')" /> 
			 	 {/if}
			 <input type="image" class="" src="img/delete.png" width="16" height="16" alt="Delete" border="0" onclick="Javascript:deleteCats('{$User[D].Id}')" title="Delete" /></td>
				
			 </tr>
				 {sectionelse}
			 <tr class="{$classname}">
				<td align="center" colspan="6" class="style1"><center>No User Found</center></td>
			 </tr>
				 {/section}
				 {else}
			 <tr class="{$classname}">
				<td align="center" colspan="6" class="style1"><center>No User Found</center></td>
			 </tr>
				 {/if}
			
		</table>
		</form>	
	</div>
 </div>
</div>
</div>	
	

</body>
</html>