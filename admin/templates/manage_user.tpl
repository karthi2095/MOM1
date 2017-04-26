{literal}
<script language="javascript" type="text/javascript">

function SetChecked(val)
{
	var ptr =document.CatMgmt;
	var len =ptr.elements.length;
	var i=0;
	for(i=0;i<len;i++){
		if(ptr.elements[i].name=='ConId[]'){
			ptr.elements[i].checked=val;
		}	
	}
	return false;
}

function ifCheck(val){
	var flag=false;
	var i=0;
	for(i=0; i<document.CatMgmt.elements.length; i++){
		if(document.CatMgmt.elements[i].name=="ConId[]"){
			if(document.CatMgmt.elements[i].checked==true){
				flag=true;
				break;
			}
		}
	}
	if(flag){
		
		if(val=='Delete'){
			if(confirm("Are you sure you want to delete?")){
				FormName		= document.CatMgmt;
				FormName.ActionType.value = val;
				FormName.submit;
				return true;
			}
			else{
				SetChecked(0);
				return false;
			}
		}
		else
		{
			FormName		= document.CatMgmt;
			FormName.ActionType.value = val;
			FormName.submit;
			return true;
		}
	}else{
		alert('Select Atleast one Checkbox')
		return false;
	}		
}

function editCats(CatIdent)
{
	FormName		= document.CatMgmt;
	FormName.CatIdent.value = CatIdent;
	FormName.action	= "edit_user.php";
	FormName.submit;
}
function addCats(CatIdent)
{
	
	FormName		= document.CatMgmt;
	FormName.action	= "add_user.php";
	FormName.submit;
}
function GoBack()
{
	window.location="controlpanel.php";
}

function deleteCats(CatIdent)
{
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
function sortsub1()
{

	if((document.getElementById('flag').value!="1")&&(document.getElementById('flag').value!="2")){
		flag=1;
	}else if(document.getElementById('flag').value=="1"){
		flag=2;
	}
	else if(document.getElementById('flag').value=="2"){
		flag=1;
	}
	FormName		= document.CatMgmt;
	FormName.flag.value=flag;
	FormName.submit();
}
</script>
{/literal}
<div id="middle">
		{include file='admin_menu.tpl'}
		<div id="center-column">
			<div class="top-bar">
				<!--<a href="add_content.php" class="button">ADD NEW </a>-->
				<h1>User</h1>
				<div class="breadcrumbs"><a href="controlpanel.php">Homepage</a> / User</div>
			</div><br />
			<form name="CatMgmt" method="post" >
			<input type="hidden" name="Ident">
			<input type="hidden" name="ConId[]">
			<input type="hidden" name="setStatus">
			<input type="hidden" name="hdIdent">
			<input type="hidden" name="CatIdent">
			<input type="hidden" name="ActionType">
			<input type="hidden" name="flag" id="flag" value="{$smarty.request.flag}">
			<input type="hidden" name="page" value="{$smarty.request.page}">
			  <div class="select-bar">
				<div style="float:left;">
				<label><input type="text" name="keyword" value="{$smarty.request.keyword|stripslashes|htmlspecialchars}" /></label>
				<label><input type="submit" name="Submit" value="Search" class="btn" />
				</label></div>
				<div align="right">
				<input type="image" src="img/Add.gif" title="Add" alt="Add" width="30" height="30" onclick="javascript:addCats();" />&nbsp;
	  <input type="image" src="img/back.gif" title="Back" alt="Back" width="32" height="32" onClick="GoBack();" /></div>
			  </div>
			   {if $ErrorMessage neq "" and $SuccessMessage eq ""}
	 <div align="center" class="Error">{$ErrorMessage}</div>
	  {/if}
	  {if $SuccessMessage neq ""}
	  <div align="center" class="Success">{$SuccessMessage}</div>
	  {/if}
				<div class="table">
					<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
					<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
					<table class="listing" cellpadding="0" cellspacing="0">
						<tr>
							<th class="first" width="50" align="center">S.No</th>
							<th><span style="cursor: pointer;  text-decoration:underline;" onclick="sortsub1()">User Name</span></th>
							<th>Email</th>
							<th>Action</th>
							<th>Status</th>
						</tr>
						{if $CatsList neq ""}
						{section name=C loop=$CatsList}
						{cycle values=', bg' assign=classname}
						<tr class="{$classname}">
							<td align="center"><strong>{$i++}.</strong></td>
							<td class="first style1">{$CatsList[C].User_Name|stripslashes|htmlspecialchars|ucfirst} </td>
							<td>{$CatsList[C].Email_Id|stripslashes|htmlspecialchars|ucfirst} </td>
							<td><input type="image" src="img/edit-icon.gif" title="Edit" width="16" height="16" alt="Edit" border="0" onclick="Javascript:editCats('{$CatsList[C].Id}')" />
							<span style="padding-bottom:20px;"> | </span><input type="image" src="img/hr.gif" width="16" height="16" alt="Delete" border="0" onclick="Javascript:deleteCats('{$CatsList[C].Id}')" title="Delete" /></td>
							<td  align="center" valign="top">
							 {if $CatsList[C].Status eq 1}
								 <input type="image" src="img/user_add.gif" width="16" height="16" alt="Active" border="0" onclick="Javascript:ChangeStatus('{$CatsList[C].Id}','0')" />{else}
								 <input type="image" src="img/user_delete.gif" width="16" height="16" alt="InActive" border="0" onclick="Javascript:ChangeStatus('{$CatsList[C].Id}','1')" />{/if} </td>
								
						</tr>
						{sectionelse}
						<tr class="{$classname}">
							<td align="center" colspan="5" class="style1">No users Found</td>
						</tr>
						{/section}
						{else}
						<tr class="{$classname}">
							<td align="center" colspan="5" class="style1">No users Found</td>
						</tr>
						{/if}
					</table>
					{if $CatsList neq ""}
					<div class="select">
						<strong>{$PerPageNavigation}</strong>
			  		</div>
					{/if}
					<div>&nbsp;</div>
				</div>
			</form>
		</div>
		<div id="right-column">
			<strong class="h">INFO</strong>
			<div class="box">User Management</div>
	  </div>
	</div>