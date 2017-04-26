{literal}
<script language="javascript" type="text/javascript" src="javascript/admin_valid.js"></script>
<script type="text/javascript" src="javascript/jquery-latest.js"></script>
<script language="javascript" type="text/javascript">
function GoBack()
{
		window.location="controlpanel.php";
}
function check_email(){
	//document.getElementById("sucmsg").innerHTML='';
	if(document.getElementById("txtCurEmail").value!=""){
		var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;	
		if(!(document.getElementById("txtCurEmail").value.match(emailRegex))){
			document.getElementById("errmsg").innerHTML="Please enter valid current email";
			myForm.txtCurEmail.select();
			myForm.txtCurEmail.focus();
			return false;
		}
		$.ajax({
			url: 'checkemail.php',
			type: "POST",
			data:"CurEmail="+document.getElementById('txtCurEmail').value+"&sid="+Math.random(),
			success: function(data) {
				if(data ==0){
					document.getElementById("errmsg").innerHTML="Invalid current email";
					document.getElementById('txtCurEmail').select();
					document.getElementById('txtCurEmail').focus();
					return false;
				}else{
					return true;
				}
			}
		});
		
	}
}
//Dirty Message Start///////////////
var formChanged = false;

$(document).ready(function() {
     $('#New_user input[type=text].editable, #New_user textarea.editable , #New_user select.editable').each(function (i) {
          $(this).data('initial_value', $(this).val());
     });

     $('#New_user input[type=text].editable, #New_user textarea.editable, #New_user select.editable').keyup(function() {
          if ($(this).val() != $(this).data('initial_value')) {
               handleFormChanged();
          }
     });

     $('#New_user .editable').bind('change paste', function() {
          handleFormChanged();
     });

     $('.navigation_link').bind("click", function () {
          return confirmNavigation();
     });

     
});

/*window.onbeforeunload = function () {
	  return confirmNavigation();
};*/

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

function cursor_val()
{
	document.New_user.txtCurEmail.focus();
}
</script>
{/literal}
<body onload="cursor_val();">
<div id="middle"> 
{include file='admin_menu.tpl'}

  <div id="center-column">
    <div class="top-bar">
      <h1>Admin Manager</h1>
      <div class="breadcrumbs"><a href="controlpanel.php" class="navigation_link">Homepage</a> / Admin Manager</div>
    </div>
    <br />
    <div class="select-bar">
      <div align="right">
      	<a style="cursor:pointer" class="navigation_link"><img src="img/back.gif" title="Back" alt="Back" width="32" height="32"  border="0"/></a>
      </div>
    </div>
    <div class="Error" align="center" id="errmsg">{$ErrorMessage}</div>
    <div class="Success" align="center" id="sucmsg">{$SuccessMessage}</div>
    <form name="New_user" id="New_user" method="post" onSubmit="return email_validation(this);">
      <div class="table"> <img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" /> <img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
        <table class="listing form" cellpadding="0" cellspacing="0" align="center">
          <tr>
            <th class="full" colspan="2">Change Email</th>
          </tr>
          <tr class="bg">
            <td class="first" colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td width="41%" class="first"><strong style="float:right;">Current Email: <span class="mandatory">*</span></strong></td>
            <td width="59%" class="last"><input type="text" class="textbox editable" name="txtCurEmail" id="txtCurEmail" maxlength="250" onblur="check_email();"/></td>
          </tr>
          <tr class="bg">
            <td class="first"><strong style="float:right;">New Email: <span class="mandatory">*</span></strong></td>
            <td class="last"><input type="text" class="textbox editable" name="txtNewEmail" id="txtNewEmail" maxlength="250"/></td>
          </tr>
          <tr>
            <td class="first"><strong style="float:right;">Confirm Email: <span class="mandatory">*</span></strong></td>
            <td class="last"><input type="text" class="textbox editable" name="txtConEmail" id="txtConEmail" maxlength="250"/></td>
          </tr>
          <tr class="bg">
            <td class="first" colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" align="center"><input type="submit" class="btn" value="Change" name="submit" />
              &nbsp;&nbsp;&nbsp;&nbsp;
              <input type="reset" value="Reset" name="reset" class="btn" onclick="javascript:window.location='change_email.php';" /></td>
          </tr>
          <tr  class="bg">
            <td class="first" colspan="2">&nbsp;</td>
          </tr>
        </table>
        <p>&nbsp;</p>
      </div>
    </form>
  </div>
  <div id="right-column"> <strong class="h">INFO</strong>
    <div class="box">Here you can change your email address.</div>
  </div>
</div>
