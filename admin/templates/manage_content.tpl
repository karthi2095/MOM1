{literal}
<script language="javascript" type="text/javascript">
function editCats(CatIdent)
{
	FormName		= document.ConMgmt;
	FormName.CatIdent.value = CatIdent;
	FormName.action	= "edit_content.php";
	FormName.submit;
}

function GoBack()
{
	window.location="controlpanel.php";
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
	FormName		= document.ConMgmt;
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
				<h1>Contents</h1>
				<div class="breadcrumbs"><a href="controlpanel.php">Homepage</a> / Contents</div>
			</div><br />
			<form name="ConMgmt" method="post">
			<input type="hidden" name="CatIdent">
			<input type="hidden" name="flag" id="flag" value="{$smarty.request.flag}">
			<input type="hidden" name="page" value="{$smarty.request.page}">
			  <div class="select-bar">
				<div style="float:left;">
				<label><input type="text" name="keyword" value="{$smarty.request.keyword|stripslashes|htmlspecialchars}" /></label>
				<label><input type="submit" name="Submit" value="Search" class="btn" />
				</label></div>
				<div align="right">
					<img src="img/back.gif" title="Back" alt="Back" width="32" height="32" onClick="javascript:GoBack();" style="cursor:pointer;" />
				</div>
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
							<th><span style="cursor: pointer;  text-decoration:underline;" onclick="sortsub1()">Title</span></th>
							<th width="300">Content</th>
							<th class="last">Action</th>
						</tr>
						{if $CatsList neq ""}
						{section name=Cats loop=$CatsList}
						{cycle values=', bg' assign=classname}
						<tr class="{$classname}">
							<td align="center"><strong>{$i++}.</strong></td>
							<td class="first style1">{$CatsList[Cats].title|stripslashes|htmlspecialchars|ucfirst} </td>
							<td class="first style">{$CatsList[Cats].content|truncate:80} </td>
							<td><input type="image" src="img/edit-icon.gif" title="Edit" width="16" height="16" alt="Edit" border="0" onclick="Javascript:editCats('{$CatsList[Cats].id}')" /></td>
						</tr>
						{sectionelse}
						<tr class="{$classname}">
							<td align="center" colspan="4" class="style1">No Static Pages Found</td>
						</tr>
						{/section}
						{else}
						<tr class="{$classname}">
							<td align="center" colspan="4" class="style1">No Static Pages Found</td>
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
			<div class="box">Content management, or CM, is the set of processes and technologies that support the collection, managing, and publishing of information in any form or medium. In recent times this information is typically referred to as content or, to be precise, digital content. Digital content may take the form of text, such as documents, multimedia files, such as audio or video files, or any other file type which follows a content lifecycle which requires management.</div>
	  </div>
	</div>