{literal}
<script language="javascript" type="text/javascript">
function GoBack()
{
	
		window.location="controlpanel.php";
	
}
</script>
{/literal}
<div id="middle"> 
{include file='admin_menu.tpl'}

  <div id="center-column">
    <div class="top-bar">
      <h1>Admin Manager</h1>
      <div class="breadcrumbs"><a href="controlpanel.php">Homepage</a> / Admin Manager</div>
    </div>
    <br />
    <div class="select-bar">
      <div align="right"><img src="img/back.gif" title="Back" alt="Back" width="32" height="32" onClick="javascript:GoBack();" style="cursor:pointer;" /></div>
    </div>
   
  
      <div class="table"> <img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" /> <img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
        <table class="listing form" cellpadding="0" cellspacing="0" align="center">
          <tr>
            <th class="full" colspan="2">Account Details</th>
          </tr>
          <tr class="bg">
            <td class="first" colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td width="41%" class="first"><strong style="float:right;">Email: </strong></td>
            <td width="59%" class="last">{$Acc.0.Email}</td>
          </tr>
          <tr class="bg">
            <td class="first"><strong style="float:right;">Username: </strong></td>
            <td class="last">{$Acc.0.Username}</td>
          </tr>
		 <tr class="bg">
            <td class="first"><strong style="float:right;">Password</strong></td>
            <td class="last">{$Acc.0.Password}</td>
          </tr> 
        </table>
        <p>&nbsp;</p>
      </div>

  </div>
  <div id="right-column"> <strong class="h">INFO</strong>
    <div class="box">Account Details</div>
  </div>
</div>
