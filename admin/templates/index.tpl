{literal}
<script language="javascript" type="text/javascript" src="javascript/admin_valid.js"></script>
<script language="javascript" type="text/javascript">
function cursor_val()
{
	document.login.username.focus();
}
</script>
{/literal}
<body onload="cursor_val();">
<div id="middle">
		<div id="left-column">&nbsp;</div>
		<div id="center-column"> 
			<div class="top-bar">
				<h1>Admin Panel</h1>
				<div class="breadcrumbs">&nbsp;</div>
			</div><br />
			<div class="Error" align="center" id="errmsg">{$ErrorMessage}</div>
			<form name="login" method="post" onSubmit="return login_validation(this);">
			  <div class="table">
					<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
					<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
					<table width="28%" align="center" cellpadding="0" cellspacing="0" class="listing form">
						<tr>
							<th class="full" colspan="2">Administrator Login</th>
						</tr>
						<tr class="bg">
							<td class="first" colspan="2">&nbsp;</td>
						</tr>
						<tr>
						  <td class="first" width="41%" align="right"><strong style="float:right;">Username: </strong></td>
						  <td width="59%" class="last"><input type="text" class="textbox" name="username" id="username" /></td>
						</tr>
						<tr class="bg">
							<td class="first"><strong  style="float:right;">Password: </strong></td>
							<td class="last"><input type="password" class="textbox" name="password" id="password" /></td>
						</tr>
						<tr>
							<td colspan="2" align="center"><a href="forgot.php">Forgot Password?</a>&nbsp;</td>
						</tr>
						<tr class="bg">
							<td colspan="2" align="center"><input type="submit" class="btn" value="Submit" name="submit" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="Reset" name="reset" class="btn" onclick="javascript:window.location='index.php';" /></td>
						</tr>
						<tr>
							<td class="first" colspan="2">&nbsp;</td>
						</tr>
				</table>
				<p>&nbsp;</p>
			  </div>
		    </form>
		</div>
		<div id="right-column">
			<strong>&nbsp;</strong>
			<div>&nbsp;</div>
	  </div>
	</div>
	</body>