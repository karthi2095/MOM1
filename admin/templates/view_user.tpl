{literal}
<script language="javascript" type="text/javascript" src="javascript/admin_valid.js"></script>
<script language="javascript" type="text/javascript" src="javascript/jquery-latest.js"></script>
<script language="javascript" type="text/javascript">
function GoBack(ident)
{  
	FormName= document.add_ads;
	FormName.action 		='manage_user.php';
	FormName.submit();	
}

//Dirty Message Start///////////////
var formChanged = false;

$(document).ready(function() {
	  /*$('#add_ads input[type=text].editable, #add_ads textarea.editable,#add_ads select.editable').each(function (i) {
          $(this).data('initial_value', $(this).val());
     });

     $('#add_ads input[type=text].editable, #add_ads textarea.editable, #add_ads select.editable').keyup(function() {
			 if ($(this).val() != $(this).data('initial_value')) {
               handleFormChanged();
          }
     });

     $('#add_ads .editable').bind('change paste', function() {
          handleFormChanged();
     });*/

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

function ShowPrice(PriceId)
{
	if(document.getElementById("duration").value=='0'){
	document.getElementById('pay').style.display='none';}
	else{
	$.ajax({
		url: 'GetPrice.php',
		type: "POST",
		data:"PriceDurId="+PriceId+"&sid="+Math.random(),
		success: function(data) {//alert(data);
			document.getElementById('pay').style.display='';
			document.getElementById("ShowPrice").innerHTML = data;
			document.getElementById("amount").value=data;
		}
	});
}
}
</script>
{/literal}
<div id="middle">
		{include file='admin_menu.tpl'}
		
		<form name="add_ads" id="add_ads" action="" method="post" onSubmit="return edit_ads_valid_employer(this);"  enctype="multipart/form-data">
		<input type="hidden" name="Ident" value="{$smarty.request.Ident}">
		<input type="hidden" name="CatIdent" value="{$smarty.request.CatIdent}">
		<input type="hidden" name="redirect">
		<input type="hidden" name="hdAction" id="hdAction">
		<input type="hidden" name="page" id="page" value="{$smarty.request.page}">
		<div id="center-column">
			<div class="top-bar">
				<!--<a href="add_content.php" class="button">ADD NEW </a>-->
				<h1>User Management</h1>
				<div class="breadcrumbs"><a href="controlpanel.php" class="navigation_link">Homepage</a> / <a href="manage_gift.php" class="navigation_link">User </a> /  View User </div>
			</div><br />
				<div class="select-bar">
					<div style="float:left;">&nbsp;</div>
					<div align="right"><img src="img/back.gif" title="Back" alt="Back" width="32" height="32" class="navigation_link" style="cursor:pointer;" /></div>
			  </div>
				<div align="center" class="Error" id="errmsg">{$ErrorMessage}</div>
				<div align="center" class="Success" id="sucmsg">{$SuccessMessage}</div>
				
				<div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
						<th class="full" colspan="2">User</th>
					</tr>
					<tr class="bg">
						<td class="first">&nbsp;</td>
						<td class="last">&nbsp;</td>
					</tr>
					<tr>
						<td class="first" width="41%"><strong style="float:right;">FirstName: &nbsp;&nbsp;</strong></td>
						<td class="last" width="59%">&nbsp;&nbsp;{$Ads.0.Firstname}
						</td>
					</tr>
					<tr class="bg">
						<td class="first" width="41%"><strong style="float:right;">LastName: &nbsp;&nbsp;</strong></td>
						<td class="last" width="59%">&nbsp;&nbsp;{$Ads.0.Lastname}
						
						</td>
					</tr>
					<tr >
						<td class="first" valign="top"><strong style="float:right;">UserName: &nbsp;&nbsp;</strong></td>
						<td class="last" >&nbsp;&nbsp;{$Ads.0.Username}
							&nbsp;&nbsp;
						</td>
					</tr> 
					<tr class="bg">
						<td class="first" width="41%"><strong style="float:right;">Image: &nbsp;&nbsp;</strong></td>
						<td class="last" width="59%">&nbsp;&nbsp;<img src="../uploads/{$Ads.0.Userimage}" style="max-width: 150px; max-height: 150px;">
						
						</td>
					</tr>
					<tr >
						<td class="first" valign="top"><strong style="float:right;">Intrest: &nbsp;&nbsp;</strong></td>
						<td class="last" >&nbsp;&nbsp;{$Ads.0.Intrest}
							&nbsp;&nbsp;
						</td>
					</tr>
					
					<tr class="bg">
						<td class="first"  valign="top"><strong style="float:right;">Gender: &nbsp;&nbsp;</strong></td>
						<td class="last">&nbsp;&nbsp;{$Ads.0.Gender}</td>
					</tr>
					<tr>
						<td class="first"  valign="top"><strong style="float:right;">Country: &nbsp;&nbsp;</strong></td>
						<td class="last">&nbsp;&nbsp;{$objCategory->getCountrynameById($Ads.0.Country)}
						</td>
					</tr>
						
			        <tr class="bg">
						<td class="first" valign="top"><strong style="float:right;">State: &nbsp;&nbsp;</strong></td>
						<td class="last" >&nbsp;&nbsp;{$objCategory->getStatenameById($Ads.0.State)}
							&nbsp;&nbsp;
						</td>
					</tr> 
					<tr >
						<td class="first" valign="top"><strong style="float:right;">City: &nbsp;&nbsp;</strong></td>
						<td class="last" >&nbsp;&nbsp;{$objCategory->getCitynameById($Ads.0.City)}
							&nbsp;&nbsp;
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
			<div class="box">View Users</div>
	  </div>
	</div>