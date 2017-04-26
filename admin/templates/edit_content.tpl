{literal}
<script language="javascript" type="text/javascript" src="javascript/jquery-latest.js"></script>
<script language="javascript" type="text/javascript">
function GoBack()
{
	window.location	= "manage_content.php";
}
//Dirty Message Start///////////////
var formChanged = false;

$(document).ready(function() {
	  $('#EdtMgmt input[type=text].editable, #EdtMgmt textarea.editable,#EdtMgmt select.editable').each(function (i) {
          $(this).data('initial_value', $(this).val());
     });

     $('#EdtMgmt input[type=text].editable, #EdtMgmt textarea.editable, #EdtMgmt select.editable').keyup(function() {
			 if ($(this).val() != $(this).data('initial_value')) {
               handleFormChanged();
          }
     });

     $('#EdtMgmt .editable').bind('change paste', function() {
          handleFormChanged();
     });

     $('.navigation_link').bind("click", function () {
          return confirmNavigation();
     });

     
});

function handleFormChanged() {
 
     formChanged = true;
}

function confirmNavigation() {
     if (formChanged) {
          if(confirm('Are you sure you want to exit without saving changes?')){
        	  GoBack();
          } else
          {
              return false;
          }
          
     } else {
    	 GoBack();
     }
}
//////////Dirty Message End///////////////
</script>
<SCRIPT LANGUAGE="JavaScript">
		<!-- Begin
		function countChars(field,cntfield) {
		document.EdtMgmt.title.focus();
		cntfield.value = field.value.length;
		}
		function validateForm()
		{
			if(document.EdtMgmt.title.value=="")
			{
				alert("Please enter the title");
				document.EdtMgmt.title.focus();
				return false;
			}
			varError = "";
		    var objFCKeditor1 =  document.getElementById('content');
		    if(FCKeditorAPI.GetInstance(objFCKeditor1.id).GetXHTML(true) =="")
		    {
		        varError += " Please enter the content\n";
		    }
		    if(varError !='')
		    {
		        alert(varError);
		        return false;
		    }
		    document.getElementById("hdAction").value=1;
		}
		//  End -->
</script>
{/literal}
<body onload="countChars(document.EdtMgmt.meta_title,document.EdtMgmt.lengthT);countChars(document.EdtMgmt.meta_description,document.EdtMgmt.length1)">
<div id="middle">
		{include file='admin_menu.tpl'}
		<form name="EdtMgmt" id="EdtMgmt" method="post" onsubmit="return validateForm()">
			<input type="hidden" name="CatIdent" value="{$smarty.request.CatIdent}">
			<input type="hidden" name="hdAction" id="hdAction">
			<div id="center-column" style="background:none; width:73%;">
			<div class="top-bar" style="width:695px;">
				<!--<a href="add_content.php" class="button">ADD NEW </a>-->
				<h1>Contents</h1>
				<div class="breadcrumbs"><a href="controlpanel.php" class="navigation_link" >Homepage</a> / <a href="manage_content.php" class="navigation_link" >Contents</a> / Edit Content</div>
			</div><br />
			  <div class="select-bar">
					<div style="float:left;">&nbsp;</div>
					<div align="right"><img src="img/back.gif" title="Back" alt="Back" width="32" height="32" class="navigation_link"  style="cursor:pointer;" /></div>
			  </div>
				<div class="table">
					{if $ErrorMessage neq ""}
					<div align="center" class="Error">{$ErrorMessage}</div>
					{/if}
					{if $SuccessMessage neq ""}
					<div align="center" class="Success">{$SuccessMessage}</div>
					{/if}
					<table class="listing form" border="1" cellpadding="0" cellspacing="0">
						<tr>
							<th class="full" colspan="2">EDIT CONTENT</th>
						</tr>
						<tr>
							<td align="right" class="content-last"><strong>Title:</strong><span class="mandatory">*</span></td>
							<td width="70%" class="first style3"><input type="text" name="title" value="{$title|stripslashes|htmlspecialchars}" class="editable" /></td>
						</tr>
						<tr class="bg">
							<td class="content-last" align="right" valign="top"><strong>Content:</strong><span class="mandatory">*</span></td>
							<td>{$Editor->Create()|htmlspecialchars}</td>
						</tr>						
						<tr>
							<td align="center" colspan="3">&nbsp;</td>
						</tr>
						<tr class="bg">
							<td align="center" colspan="3"><input type="submit" name="update" value="Update" class="btn" /></td>
						</tr>
						<tr>
							<td align="center" colspan="3">&nbsp;</td>
						</tr>
					</table>
					<div>&nbsp;</div>
				</div>
		</div></form>
		<!-- <div id="right-column">
			<strong class="h">INFO</strong>
			<div class="box">Content Management.</div> 
	  </div> -->
	</div>