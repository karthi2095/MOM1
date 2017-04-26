{literal}
<script language="javascript" type="text/javascript" src="javascript/jquery-latest.js"></script>
<script language="javascript" type="text/javascript" src="javascript/admin_valid.js"></script>
<script language="javascript" type="text/javascript">
function GoBack()
{  
	window.location 		='manage_meetingtype.php';
}
$(document).ready(function() {
	document.getElementById('meetingtype').focus();
});
//Dirty Message Start///////////////
var formChanged = false;

$(document).ready(function() {
	  $('#add_cate input[type=text].editable, #add_cate textarea.editable,#add_cate select.editable').each(function (i) {
          $(this).data('initial_value', $(this).val());
     });

     $('#add_cate input[type=text].editable, #add_cate textarea.editable, #add_cate select.editable').keyup(function() {
			 if ($(this).val() != $(this).data('initial_value')) {
               handleFormChanged();
          }
     });

     $('#add_cate .editable').bind('change paste', function() {
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

function cat_valid()
{ 

	//var passRegex=/^(?=.*\d)(?=.*[a-zA-Z])(?!.*\s).{6,12}$/;
	//var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
	//var alpha=/^[a-zA-Z ]+$/;
	//var phoneRegx = /^\d{10}$/;
	//var ValidChars = /^[0-9]{1,}[.]?[0-9]{1,2}$/;
	document.getElementById('errmsg').innerHTML='';
	document.getElementById('sucmsg').innerHTML='';
	var meetingtype=trim(document.getElementById('meetingtype').value);

	if(meetingtype==''){
		document.getElementById('errmsg').innerHTML='Please enter the meeting type';
		document.getElementById('meetingtype').focus();
		return false;
	}

	var imgAction=document.getElementById('imgAction').value;
	if(imgAction!='1'){
	var uploadfile=trim(document.getElementById('uploadfile').value);
	 if(uploadfile==''){
			document.getElementById('errmsg').innerHTML='Please select the upload file';
			document.getElementById('uploadfile').focus();
			return false;
		 }
		 
	 	var fileup=document.getElementById('uploadfile');
		var fileName = fileup.value;
			var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
			if(ext != "png" && ext != "PNG" && ext != "JPEG" && ext != "jpeg" && ext != "jpg" && ext != "JPG")
			{
			document.getElementById('errmsg').innerHTML="Upload Png or Jpg images only";
			fileup.focus();
			return false;
			}
	}
	$('#hdAction').val('1');
}

//////////Dirty Message End///////////////
</script>
{/literal}

<div id="middle">
		{include file='admin_menu.tpl'}
		<form name="add_cate" id="add_cate" action="" method="post" enctype="multipart/form-data" onSubmit="return cat_valid();">
		<input type="hidden" name="Ident" value="{$smarty.request.Ident}">
		<input type="hidden" name="CatIdent" value="{$smarty.request.CatIdent}">
		<input type="hidden" name="redirect">
		<input type="hidden" name="hdAction" id="hdAction">
		<input type="hidden" name="imgAction" id="imgAction" value="{if $meetingtype.0.Image neq ""}1{else}0{/if}">
		<div id="center-column">
			<div class="top-bar">
				<!--<a href="add_content.php" class="button">ADD NEW </a>-->
				<h1>Meeting Type</h1>
				<div class="breadcrumbs"><a href="controlpanel.php" class="navigation_link" >Homepage</a> / <a href="manage_meetingtype.php" class="navigation_link" >Meeting Type </a> /  Edit Meeting Type </div>
			</div><br />
				<div class="select-bar">
					<div style="float:left;">&nbsp;</div>
					<div align="right"><img src="img/back.gif" title="Back" alt="Back" width="32" height="32" class="navigation_link" style="cursor:pointer;" onclick="GoBack();"/></div>
			  </div>
				<div align="center" class="Error" id="errmsg">{$ErrorMessage}</div>
				<div align="center" class="Success" id="sucmsg">{$SuccessMessage}</div>
				
				<div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
						<th class="full" colspan="2">Edit Meeting Type</th>
					</tr>
					<tr class="bg">
						<td class="first">&nbsp;</td>
						<td class="last">&nbsp;</td>
					</tr>

						<tr>
							<td style="text-align:right;" width="35%"><strong>Meeting Type: </strong><font color="#FF0000">*</font></td>
							<td class="first style3" width="65%"><input type="text" id="meetingtype" class="editable" name="meetingtype"  value="{$meetingtype.0.Meeting_Type|stripslashes|htmlspecialchars}"  maxlength="30" /></td>
						</tr>					
						<tr>
						<td style="text-align:right;" width="35%"><strong>Meeting Image: </strong><font color="#FF0000">*</font></td>
						<td class="first style3" width="65%">
						
						<img src="uploadimage/{$meetingtype.0.Image}" width="100"height="100"> 
						<input type="file" name="uploadfile" id="uploadfile">
						</td>
						</tr>
					<tr class="bg">
						<td class="first">&nbsp;</td>
						<td class="last">&nbsp;</td>
					</tr>
					<tr>
						<td class="first">&nbsp;</td>
						<td class="last"><input type="submit" name="submit" value="Update" class="btn" />
						<input type="button" name="cancel" value="Cancel" class="btn" onclick="GoBack();"/>&nbsp;</td>
					</tr>
					<tr class="bg">
						<td class="first">&nbsp;</td>
						<td class="last">&nbsp;</td>
					</tr>
				</table>
					<p>&nbsp;</p>
		  </div>
				
				<div>&nbsp;</div>
		</div>
		</form>
	<div id="right-column">
			<strong class="h">INFO</strong>
			<div class="box">Here you can edit the  meetingtype.</div>
	  </div>
	</div>