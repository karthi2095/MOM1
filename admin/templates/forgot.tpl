{literal}

<script language="javascript" type="text/javascript">
function GoBack()
{
	window.location="index.php";
}
function clearForm(){
	$('#errmsg').html('');
}
$(document).ready(function(){
	$('#txtEmail').focus();
});
</script>
{/literal}
<div id="middle">
		<div id="left-column" style="width:75px;">&nbsp;</div>		
		<div id="center-column">
			<div class="top-bar">
				<h1>Admin Manager</h1>
				<div class="breadcrumbs"><a href="controlpanel.php">Homepage</a> / Admin Manager</div>
			</div><br />
			<div class="select-bar">
				<div align="right"><img src="img/back.gif" title="Back" alt="Back" width="32" height="32" onClick="javascript:GoBack();" style="cursor:pointer;" /></div>
			  </div>
			<div class="Error" align="center" id="errmsg">{$ErrorMessage}</div>
			<div class="Success" align="center" id="sucmsg">{$SuccessMessage}</div>
			<form name="change" method="post" onSubmit="return for_validation(this);">
			<input type="hidden" name="hdAction" id="hdAction" >
			  <div class="table">
					<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
					<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
					<table class="listing form" cellpadding="0" cellspacing="0" align="center">
						<tr>
							<th class="full" colspan="2">Forgot Password</th>
						</tr>
						<tr class="bg">
							<td class="first" colspan="2">&nbsp;</td>
						</tr>
						<tr>
							<td width="41%" class="first"><strong style="float:right;">Email: </strong></td>
						    <td width="59%" class="last"><input type="text" class="textbox" name="txtEmail" id="txtEmail" /></td>
						</tr>
						<tr  class="bg">
							<td class="first" colspan="2">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="2" align="center"><input type="submit" class="btn" value="Submit" name="submit" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="Reset" name="reset" class="btn" onclick="clearForm();"/></td>
						</tr>
						<tr  class="bg">
							<td class="first" colspan="2">&nbsp;</td>
						</tr>
					</table>
				<p>&nbsp;</p>
			  </div>
		    </form>
		</div>
		<div id="right-column">
			  </div>
	</div>
