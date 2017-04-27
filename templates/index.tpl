<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Minutes of Meeting</title>
	<meta http-equiv="X-UA-Compatible" content="IE=9" />
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" href="css/all.css">

</head>
{literal}
<script>
function validate()
{
	document.getElementById('valid').innerHTML="";
	if(document.getElementById("username").value == "")	
     {
	   document.getElementById('valid').innerHTML="Please enter username";
       document.getElementById('username').focus();
            return false;
     }
    if(document.getElementById("password").value == "")	
     {
	   document.getElementById('valid').innerHTML="Please enter password";
       document.getElementById('password').focus();
            return false;
     }
	/*if(  document.getElementById('usertype1').checked == false  &&  document.getElementById('usertype2').checked == false ){
		document.getElementById('errmsg').innerHTML='Please select atleast one user type';
		//myForm.usertype.focus();
		document.getElementById('usertype1').focus();
		//myForm.usertype.select;
		return false;
	}*/
    document.getElementById('hdAction').value=1;
}
</script>

{/literal}
<!--Design Prepared by Rajasri Systems-->   
<body class="bg-new">
<div id="main">
<div class="logo"><a href="index.html"><img src="images/nissan-logo.png" alt="" style="width: 16%;height: 50px;
background: #fff;padding: 20px;"/></a></div>
<div style="clear:both;"></div>
<div id="login-panel">
		<div id="center-column"> 
			<div class="top-bar">
				<h1>User Login</h1>
			</div><br />
			<div class="Error" align="center" id="errmsg"></div>
			<form name="login" method="post" action="" onsubmit="return validate();">
			<input type="hidden" name="hdAction" id="hdAction"></input>
				<div id="error" style="color:red; align: center; font-weight: bold;"><span id="valid">{if $smarty.request.err neq ''}{$smarty.request.err}{/if}</span></div>
			  <div class="login-table">
					<table width="100%" align="center"cellpadding="5" cellspacing="3" class="listing-table">
						<tr>
						  <td class="first" width="41%" align="left">USERNAME</td>
						</tr>
						<tr>
							<td width="59%" class="last"><input type="text" class="textbox" name="username" id="username" /></td>
						</tr>
						<tr class="bg">
							<td class="first" align="left">PASSWORD</td>
						</tr>
						<tr>
							<td class="last"><input type="password" class="textbox" name="password" id="password" /></td>
						</tr>
						<!--<tr class="bg">
           				<td class="first" align="left">USER TYPE</td>
           					 </tr>
           					 <tr>
           					 <td class="last" style="text-align: left">
            				 <input type="radio" name="usertype" id="usertype1" value="Admin">Admin
							 <input type="radio" name="usertype" id="usertype2"value="User">User
           
	      				     	</td>
          				</tr>
						  <tr>
							<td align="left"><a href="#" class="forgot">Forgot Password?</a>&nbsp;</td>
						</tr>-->
						<tr class="bg">
							<td align="right"><input type="submit" class="btn-submit" value="LOGIN" name="submit" onclick="return validate();"/></td>
						</tr>
				</table>
			  </div>
		    </form>
		</div>
		
	</div>
	<div style="clear:both;"></div>
	
	</div>
</body>
</html>