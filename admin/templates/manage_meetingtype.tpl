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
	FormName.Ident.value = CatIdent;
	FormName.action	= "edit_meetingtype.php";
	FormName.submit;
}

function addCats(CatIdent)
{
	FormName		= document.CatMgmt;
	FormName.action	= "add_meetingtype.php";
	FormName.submit;
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

function GoBack()
{
	FormName		= document.CatMgmt;
	FormName.action	= "controlpanel.php";
	FormName.submit;
}

function resetpage()
{
	FormName		= document.CatMgmt;
	//FormName.page.value	= '';
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
function getrows()
{

	FormName		= document.CatMgmt;
	FormName.submit();
}
</script>

{/literal}
<div id="middle">
	{include file='admin_menu.tpl'}
	<form name="CatMgmt" method="post" onsubmit="resetpage();">
	<input type="hidden" name="Ident">
	<input type="hidden" name="ConId[]">
	<input type="hidden" name="setStatus">
	<input type="hidden" name="hdIdent">
	<input type="hidden" name="CatIdent">
	<input type="hidden" name="ActionType">
	<input type="hidden" name="flag" id="flag" value="{$smarty.request.flag}">
	<input type="hidden" name="page" value="{$smarty.request.page}">
	<div id="center-column">
	 <div class="top-bar">
		<h1>Meeting Type</h1>
		<div class="breadcrumbs"><a href="controlpanel.php">Homepage</a> / Meeting Type</div>
	 </div><br />
     <div class="select-bar">
	  <div style="float:left;">
		<label><input type="text" name="keyword" value="{$smarty.request.keyword|stripslashes|htmlspecialchars}" /></label>
		<label></label>
		<label><input type="submit" name="Submit1" value="Search" class="btn" />
		</label>
	  </div>
	  <div align="right"><input type="image" src="img/Add.gif" title="Add" alt="Add" width="30" height="30" onclick="javascript:addCats();" />&nbsp;<input type="image" src="img/back.gif" title="Back" alt="Back" width="32" height="32" onClick="GoBack();" /></div>
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
				<th class="first" width="20" align="center">S.No</th>
				<th><span style="cursor: pointer;  text-decoration:underline;" onclick="sortsub1()">Meeting Type</span></th>
				
				<th width="77">Action</th>
				<th width="50">Status</th>
				<th width="50" class="last">Select</th>
			 </tr>
			 {if $CatList neq ""}
			 {section name=C loop=$CatList}
			 {cycle values=', bg' assign=classname}
			 <tr class="{$classname}">
				<td align="center" valign="top"><strong>{$i++}.</strong></td>
				<td class="first style1" valign="top">{$CatList[C].Meeting_Type|stripslashes|ucfirst} </td>
				
				<td valign="top" style="text-align:center;"><input type="image" src="img/edit-icon.gif" title="Edit" width="16" height="16" alt="Edit" border="0" onclick="Javascript:editCats('{$CatList[C].Id}')" /> <span style="padding-bottom:20px;"> | </span><input type="image" src="img/hr.gif" width="16" height="16" alt="Delete" border="0" onclick="Javascript:deleteCats('{$CatList[C].Id}')" title="Delete" /></td>
				<td  align="center" valign="top">
				 {if $CatList[C].Status eq 1}
				 <input type="image" src="img/user_add.gif" width="16" height="16" alt="Active" border="0" onclick="Javascript:ChangeStatus('{$CatList[C].Id}','0')" />{else}<input type="image" src="img/user_delete.gif" width="16" height="16" alt="InActive" border="0" onclick="Javascript:ChangeStatus('{$CatList[C].Id}','1')" />{/if} </td>
				 <td  align="center" valign="top"><input type="checkbox" name="ConId[]" value="{$CatList[C].Id}"></td>
			 </tr>
				 {sectionelse}
			 <tr class="{$classname}">
				<td align="center" colspan="6" class="style1">No Meeting type Found</td>
			 </tr>
				 {/section}
				 {else}
			 <tr class="{$classname}">
				<td align="center" colspan="6" class="style1">No Meeting type Found</td>
			 </tr>
				 {/if}
			</table>
				 {if $CatList neq ""}
			<div class="select">
				<strong>{$PerPageNavigation}</strong>
				<select name="pagelimit" id="pagelimit" onChange="getrows()" style="width:45px;">
				
				<option value="10" {if $smarty.request.pagelimit eq '10'}selected="selected"{/if}>10</option>
					<option value="25" {if $smarty.request.pagelimit eq '25'}selected="selected"{/if}>25</option>	
					<option value="50" {if $smarty.request.pagelimit eq '50'}selected="selected"{/if}>50</option>
				<option value="75" {if $smarty.request.pagelimit eq '75'}selected="selected"{/if}>75</option>
				<option value="100" {if $smarty.request.pagelimit eq '100'}selected="selected"{/if}>100</option>
				</select>
			</div>
				 {/if}
			</div>
				 {if $CatList neq ""}
			<div class="table">
			 <table border="0" cellpadding="0" cellspacing="0">
				<tr>
			      <td width="265">&nbsp;</td>
				  <td><input type="button" name="submit1" class="btn" onclick="SetChecked(1)" style="cursor:pointer;" value="Select All" />&nbsp;</td>
				  <td><input type="button" name="submit2" class="btn" onclick="SetChecked(0)" style="cursor:pointer;" value="UnSelect All" />&nbsp;</td>
				  <td><input type="submit" name="submit3" class="btn" value="Active" onclick="return ifCheck('Active');" />&nbsp;</td>
				  <td><input type="submit" name="submit4" value="InActive" class="btn" onclick="return ifCheck('InActive');" />&nbsp;</td>
				  <td><input type="submit" name="submit5" value="Delete" class="btn" onclick="return ifCheck('Delete');" />&nbsp;</td>
				</tr>
			 </table>
			</div>{/if}
			<div>&nbsp;</div>
		  </div></form>
		  <div id="right-column">
			<strong class="h">INFO</strong>
			<div class="box">Meetingtype Management.</div>
	    </div>
	</div>
