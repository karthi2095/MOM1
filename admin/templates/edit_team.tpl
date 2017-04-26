{literal}
<script language="javascript" type="text/javascript" src="javascript/jquery-latest.js"></script>
<script language="javascript" type="text/javascript" src="javascript/admin_valid.js"></script>
<script language="javascript" type="text/javascript">
function trim(stringToTrim) {
	return stringToTrim.replace(/^\s+|\s+$/g,"");
}

function GoBack()
{
	window.location 		='manage_team.php';
}
$(document).ready(function() {
	document.getElementById('category').focus();
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
	var passRegex=/^(?=.*\d)(?=.*[a-zA-Z])(?!.*\s).{6,12}$/;
	var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
	var alpha=/^[a-zA-Z ]+$/;
	var phoneRegx = /^\d{10}$/;
	var ValidChars = /^[0-9]{1,}[.]?[0-9]{1,2}$/;
	document.getElementById('errmsg').innerHTML='';
	document.getElementById('sucmsg').innerHTML='';

	var category=trim(document.getElementById('category').value);
	document.getElementById('category').value=category;
	
	if(category==''){
		document.getElementById('errmsg').innerHTML='Please enter the team';
		document.getElementById('category').focus();
		return false;
	}
	var Position=trim(document.getElementById('Position').value);
	document.getElementById('Position').value=Position;
	
	if(Position=='0'){
		document.getElementById('errmsg').innerHTML='Please select the position';
		document.getElementById('Position').focus();
		return false;
	}
	$('#hdAction').val('1');
}


</script>
{/literal}
<div id="middle">
		{include file='admin_menu.tpl'}
		<form name="add_cate" id="add_cate" action="" method="post" onSubmit="return cat_valid();" enctype="multipart/form-data">
		<input type="hidden" name="Ident" value="{$smarty.request.Ident}">
		<input type="hidden" name="CatIdent" value="{$smarty.request.CatIdent}">
		<input type="hidden" name="redirect">
		<input type="hidden" name="hdAction" id="hdAction">
		<div id="center-column">
			<div class="top-bar">
				<!--<a href="add_content.php" class="button">ADD NEW </a>-->
				<h1>Teams </h1>
				<div class="breadcrumbs"><a href="controlpanel.php" class="navigation_link" >Homepage</a> 
				/ <a href="manage_team.php" class="navigation_link" >Teams </a> 
				/  Edit Team </div>
			</div><br/>
				<div class="select-bar">
					<div style="float:left;">&nbsp;</div>
					<div align="right"><img src="img/back.gif" title="Back" alt="Back" width="32" height="32"
					 class="navigation_link" style="cursor:pointer;" onclick="GoBack('a');"/></div>
			    </div>
				<div align="center" class="Error" id="errmsg">{$ErrorMessage}</div>
				<div align="center" class="Success" id="sucmsg">{$SuccessMessage}</div>
				<div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
						<th class="full" colspan="2">Edit Team</th>
					</tr>
					<tr class="bg">
						<td class="first">&nbsp;</td>
						<td class="last">&nbsp;</td>
					</tr>
						<tr>
							<td style="text-align:right;" width="35%"><strong>Team: </strong><font color="#FF0000">*</font></td>
							<td class="first style3" width="65%"><input type="text" id="category" 
							class="editable" name="category" value="{$User.0.Team|stripslashes|htmlspecialchars}"  maxlength="30" /></td>
						</tr>
					<tr class="bg">
							<td style="text-align:right;" width="35%"><strong>Position: </strong><font color="#FF0000">*</font></td>
							<td class="first style3" >
							
							<select id="Position" class="formdef" name="Position">
							<option value="0">Select Position</option>
							<option value="QB" {if $User.0.Position  eq 'QB'}selected="selected" {/if}>QB</option>
							<option value="RB" {if $User.0.Position  eq 'RB'}selected="selected" {/if}>RB</option>
							<option value="WR" {if $User.0.Position  eq 'WR'}selected="selected" {/if}>WR</option>
							<option value="TE" {if $User.0.Position  eq 'TE'}selected="selected" {/if}>TE</option>
							<option value="K" {if $User.0.Position  eq 'K'}selected="selected" {/if}>K</option>
							<option value="D" {if $User.0.Position  eq 'D'}selected="selected" {/if}>D</option>
							<option value="ST" {if $User.0.Position  eq 'ST'}selected="selected" {/if}>ST</option>
							</select>
					     </tr>
					<tr class="bg">
						<td class="first">&nbsp;</td>
						<td class="last">&nbsp;</td>
					</tr>
					<tr>
						<td class="first">&nbsp;</td>
						<td class="last">
							<input type="submit" name="submit" value="Update" class="btn" />
						</td>
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
			<div class="box">Here you can edit the team.</div>
	  </div> 
	</div>