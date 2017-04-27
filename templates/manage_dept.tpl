
{literal}
<script language="javascript" type="text/javascript">
function editCats(CatIdent)
{
	FormName		= document.CatMgmt;
	FormName.Ident.value = CatIdent;
	FormName.action	= "edit_dept.php";
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
            <input type="hidden" type="text" name="Ident">
			<input type="hidden" name="ConId[]">
			<input type="hidden" name="setStatus">
			<input type="hidden" name="hdIdent">
			<input type="hidden" name="CatIdent">
			<input type="hidden" name="ActionType">
			
  <div id="center-column">
    <div class="top-bar-header">
      <h1>Department Management</h1>
     <div class="breadcrumbs"><a href="controlpanel.php" class="navigation_link" >Homepage</a> >> Department Management</div>
    </div>
    <br/>
    <div class="manage-grid">
	<table border="0" cellpadding="2" cellspacing="0" class="grid-table" style="width: 70%; margin-left: 190px; border: none; background-color: #ecb40f;">
		<tr>
			<td style="border: none; background: #f0edeb;">
				<a href="add_dept.php"><img src="img/add.png" alt="" style="float: right; padding: 10px;"></a>
			</td>
		</tr>
	</table>
	<div align="center" class="Error" id="errmsg" style="color:red;">{$ErrorMessage}</div>
	<div align="center" class="Success" id="sucmsg" style="color:green;">{$SuccessMessage}</div>
		<table border="0" cellpadding="2" cellspacing="0" class="grid-table" style="width: 70%; margin-left: 190px;">
			<tr>
				<th width="5%">S.No</th>
				<th>Department Name</th>
				<th width="15%">Action</th>
			</tr>
			{if $Dept neq ""}
			 {section name=D loop=$Dept}
			 {cycle values=', bg' assign=classname}
			 <tr class="{$classname}">
				 <td align="center" valign="top"><center>{$i++}</center></td>
				 <td class="first style1" valign="top">{$Dept[D].DepartmentName|stripslashes|ucfirst} </td>
				 <td valign="top" style="text-align:center; font-size:0px;">
				 <a href="edit_dept.php">
				 <input type="image" class="icon-bor" src="img/edit.png" title="Edit" width="16" height="16" alt="Edit" border="0" onclick="Javascript:editCats('{$Dept[D].Id}')" /></a> 
				 
				 {if $Dept[D].Status eq '1'}
			 	 <input type="image" class="icon-bor" src="img/active.png" title="Active" width="16" height="16" alt="Active" border="0" onclick="Javascript:ChangeStatus('{$Dept[D].Id}','0')" /> 
			 	 {else}
			 	 <input type="image" class="icon-bor" src="img/inactive.png" title="InActive" width="16" height="16" alt="Active" border="0" onclick="Javascript:ChangeStatus('{$Dept[D].Id}','1')" /> 
			 	 {/if}
			 	 <input type="image" class="" src="img/delete.png" width="16" height="16" alt="Delete" border="0" onclick="Javascript:deleteCats('{$Dept[D].Id}')" title="Delete" /></td>
			</tr>
				 {sectionelse}
			 <tr class="{$classname}">
				<td align="center" colspan="6" class="style1"><center>No Department Found</center></td>
			 </tr>
				 {/section}
				 {else}
			 <tr class="{$classname}">
				<td align="center" colspan="6" class="style1"><center>No Department Found</center></td>
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