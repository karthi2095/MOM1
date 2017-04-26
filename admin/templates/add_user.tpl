{literal}
<link type="text/css" href="calendar/jquery-ui-1.8.17.custom.css" rel="stylesheet" />
<script type="text/javascript" src="calendar/jquery-ui-1.8.17.custom.min.js"></script> 
<script language="javascript" type="text/javascript" src="javascript/admin_valid.js"></script>
<script language="javascript" type="text/javascript">
jQuery(document).ready(function (){
	//var d = new Date("04/10/2006");

	var d         = new Date();	
	$(function() {		
		$("#datepicker").datepicker({dateFormat: 'm/dd/yy',maxDate: new Date(d.getFullYear(),d.getMonth(),d.getDate()),changeYear: true,changeMonth: true,yearRange: '1900:'+ d.getFullYear()});			
		});
	});
function GoBack()
{  
	window.location 		='manage_user.php';
}
$(document).ready(function() {
	document.getElementById('categoryName').focus();
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

function confirmNavigation() 
{
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

	
	
	var fname=trim(document.getElementById('fname').value);
	document.getElementById('fname').value=fname;
	var lname=trim(document.getElementById('lname').value);
	document.getElementById('lname').value=lname;
	var uname=trim(document.getElementById('uname').value);
	document.getElementById('uname').value=uname;
	var email=trim(document.getElementById('email').value);
	document.getElementById('email').value=email;
	var pwd=trim(document.getElementById('pwd').value);
	document.getElementById('pwd').value=pwd;
	var cpwd=trim(document.getElementById('cpwd').value);
	document.getElementById('cpwd').value=cpwd;
	var occupation=document.getElementById('occupation').value;
	document.getElementById('occupation').value=occupation;
	var datepicker=document.getElementById('datepicker').value;
	document.getElementById('datepicker').value=datepicker;
	var country=document.getElementById('country').value;
	document.getElementById('country').value=country;
	var state=trim(document.getElementById('state').value);
	document.getElementById('state').value=state;
	var city=document.getElementById('city').value;
	document.getElementById('city').value=city;
	var address=trim(document.getElementById('address').value);
	document.getElementById('address').value=address;
	var zipcode=document.getElementById('zipcode').value;
	document.getElementById('zipcode').value=zipcode;
	var phone=trim(document.getElementById('phone').value);
	document.getElementById('phone').value=phone;
	
	if(fname==''){
		document.getElementById('errmsg').innerHTML='Please enter the Firstname';
		document.getElementById('fname').focus();
		return false;
	}
	if(lname==''){
		document.getElementById('errmsg').innerHTML='Please enter the Lastname';
		document.getElementById('lname').focus();
		return false;
	}
	if(uname==''){
		document.getElementById('errmsg').innerHTML='Please enter the Username';
		document.getElementById('uname').focus();
		return false;
	}
	if(email==''){
		document.getElementById('errmsg').innerHTML='Please enter the email';
		document.getElementById('email').focus();
		return false;
	}
	if(!(email.match(emailRegex))){
		document.getElementById('errmsg').innerHTML='Please enter the valid email';
		document.getElementById('email').focus();
		return false;
	}
	if(pwd==''){
		document.getElementById('errmsg').innerHTML='Please enter the Password';
		document.getElementById('pwd').focus();
		return false;
	}
	if(cpwd==''){
		document.getElementById('errmsg').innerHTML='Please enter the Confirmpassword';
		document.getElementById('cpwd').focus();
		return false;
	}
	if(pwd!=cpwd){
		document.getElementById('errmsg').innerHTML='Passwords must be same';
		document.getElementById('cpwd').focus();
		return false;
	}
	var Team=trim(document.getElementById('Team').value);
	document.getElementById('Team').value=Team;
	
	if(Team=='0'){
		document.getElementById('errmsg').innerHTML='Please select the team';
		document.getElementById('Team').focus();
		return false;
	}
	
	var gender=document.getElementsByName("gender");
	var g=0;
	for(i=0;i<gender.length;i++){
		if(gender[i].checked){
			g=1;
		}
	}
	if(g==0){
		document.getElementById('errmsg').innerHTML='Please select the gender';
		return false;
	}
	
	if(occupation=='0'){
		document.getElementById('errmsg').innerHTML='Please select the Occupation';
		return false;
	}
	if(datepicker==''){
		document.getElementById('errmsg').innerHTML='Please select the date';
		return false;
	}
	if(address==''){
		document.getElementById('errmsg').innerHTML='Please enter the address';
		document.getElementById('address').focus();
		return false;
	}
	if(country=='0'){
		document.getElementById('errmsg').innerHTML='Please select the country';
		document.getElementById('country').focus();
		return false;
	}
	if(state=='0'){
		document.getElementById('errmsg').innerHTML='Please select the state';
		document.getElementById('state').focus();
		return false;
	}
	if(city=='0'){
		document.getElementById('errmsg').innerHTML='Please select the city';
		document.getElementById('city').focus();
		return false;
	}
	
	if(zipcode==''){
		document.getElementById('errmsg').innerHTML='Please enter the zipcode';
		document.getElementById('zipcode').focus();
		return false;
	}
	if(phone==''){
		document.getElementById('errmsg').innerHTML='Please enter the phone';
		document.getElementById('phone').focus();
		return false;
	}

	$('#hdAction').val('1');
}

function getCity(val){
	
	$.ajax({
		url: 'getCity.php',
		type: "POST",
		data:"state="+val+"&sid="+Math.random(),
		success: function(data) {
			document.getElementById("cityRow").innerHTML=data;
					
		}
	});
}
function getState(val){
	$.ajax({
		url: 'getState.php',
		type: "POST",
		data:"country="+val+"&sid="+Math.random(),
		success: function(data) {
			document.getElementById("stateRow").innerHTML=data;
				
		}
	});
}

//////////Dirty Message End///////////////
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
				<!-- <a href="add_content.php" class="button">ADD NEW </a> -->
				<h1>User</h1>
				<div class="breadcrumbs"><a href="controlpanel.php" class="navigation_link" >Homepage</a> /
				 <a href="manage_user.php" class="navigation_link" >User </a> /  Add User </div>
			</div><br/>
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
						<th class="full" colspan="2">Add User</th>
					</tr>
					<tr >
						<td class="first">&nbsp;</td>
						<td class="last">&nbsp;</td>
					</tr>					
						<tr class="bg">
							<td style="text-align:right;" width="35%"><strong>FirstName: </strong><font color="#FF0000">*</font></td>
							<td class="first style3" width="65%"><input type="text" id="fname" class="editable" name="fname"  value=""  maxlength="30" /></td>
						</tr>
						 <tr>
							<td style="text-align:right;" width="35%"><strong>LastName: </strong><font color="#FF0000">*</font></td>
							<td class="first style3" width="65%"><input type="text" id="lname" class="editable" name="lname"  value=""  maxlength="30" /></td>
						</tr>
						<tr class="bg">
							<td style="text-align:right;" width="35%"><strong>UserName: </strong><font color="#FF0000">*</font></td>
							<td class="first style3" ><input type="text" id="uname" class="editable" name="uname"  value=""  maxlength="30" /></td>
						</tr>
						<tr>
							<td style="text-align:right;" width="35%"><strong>Email: </strong><font color="#FF0000">*</font></td>
							<td class="first style3" ><input type="text" id="email" class="editable" name="email"  value="" /></td>
						</tr>
						<tr class="bg">
							<td style="text-align:right;" width="35%"><strong>Password: </strong><font color="#FF0000">*</font></td>
							<td class="first style3" ><input type="password" id="pwd" class="editable" name="pwd"  value=""  maxlength="30" /></td>
						</tr>
						<tr >
							<td style="text-align:right;" width="35%"><strong>Confirm Password: </strong><font color="#FF0000">*</font></td>
							<td class="first style3" ><input type="password" id="cpwd" class="editable" name="cpwd"  value=""  maxlength="30" /></td>
						</tr>
						<tr class="bg">
							<td style="text-align:right;" width="35%"><strong>Team: </strong><font color="#FF0000">*</font></td>
							<td class="first style3" width="65%">
							<select name="Team" id="Team" class="select-value editable" >
										<option value="0">Select</option>
										{section name=c loop=$league}
										<option value="{$league[c].Id}">
										{$league[c].League|stripslashes|htmlspecialchars}</option>
										{/section}
								</select>
						</tr>
						
						<tr >
						    <td style="text-align:right;" width="35%"><strong>Gender: </strong><font color="#FF0000">*</font></td>
							<td class="first style3" >
							<input type = "radio" name ="gender" id="female" value = "female" >Female
                            <input type = "radio" name ="gender" id="male" value = "male" >Male
                            </td>
						</tr>
						
						<tr class="bg">
							<td style="text-align:right;" width="35%"><strong>Occupation: </strong><font color="#FF0000">*</font></td>
							<td class="first style3" >
							
							<select id="occupation" class="formdef" name="occupation">
							<option value="0">Select occupation</option>
							<option value="Administrative/Clerical">Administrative/Clerical</option>
							<option value="Doctor">Doctor</option>
							<option value="Educator">Educator</option>
							<option value="Attorney">Attorney</option>
							<option value="Executive">Executive (VP, President, CEO, CIO, CFO, etc.)</option>
							<option value="Managerial">Managerial (Manager/Director)</option>
							<option value="Sales">Sales</option>
							<option value="Craftsman/Skilled Labor/Construction/Factory">Craftsman/Skilled Labor/Construction/Factory</option>
							<option value="MIS/IT">MIS/IT</option>
							<option value="Professional/Technical">Professional/Technical (Engineering, Architect, etc.)</option>
							<option value="Uniform">Uniform Services (Fire, Police, Military, etc.)</option>
							<option value="Services">Services Labor (waiter/waitress, janitor, bus driver, etc.)</option>
							<option value="Other" class="dateSelected">Other</option>
							</select>
					     </tr>
					     <tr>
						<td class="first"><strong style="float: right;">Date of Birth: </strong>
						</td>
						<td  class="first style3">
					    <input style="cursor:pointer" type="text" id="datepicker" name="datepicker" readonly="readonly" value=""> 
					    
						</td>
					</tr>
					     <tr class="bg">
						<td  valign="top" class="first"><strong style="float:right;">Address:</strong></td>
						<td  class="first style3"> <textarea cols="36" rows="3" id="address" name="address" class="editable"></textarea></td>
						</tr>
                    	<tr  >
							<td style="text-align:right;"><strong>Country: </strong><font color="#FF0000">*</font></td>
							<td class="first style3" >
								<select name="country" id="country" class="select-value editable" onchange="getState(this.value);" >
										<option value="0">Select</option>
										{section name=c loop=$country}
										<option value="{$country[c].id}">
										{$country[c].name|stripslashes|htmlspecialchars}</option>
										{/section}
								</select>
							</td>
						</tr>
					
						<tr class="bg">
							<td  style="text-align:right;" ><strong>State: </strong><font color="#FF0000">*</font></td>
							<td class="first style3" id="stateRow" >
							<select name="state" id="state" onchange="getCity(this.value);">
							<option value="0">Select</option>
							{section name=V loop=$states}
							<option value="{$states[V].id}">{$states[V].name}</option>
							{/section}
							</select>
							</td>
						</tr>
						<tr >
							<td style="text-align:right;"><strong>City: </strong><font color="#FF0000">*</font></td>
							<td class="first style3" id="cityRow" >
							<select name="city" id="city" class="editable" >
								<option value="0">Select</option>
								{section name=t loop=$city}
								<option value="{$city[t].id}" {if $User.city eq $city[t].id}selected="selected" {/if}>{$city[t].name|stripslashes|htmlspecialchars}</option>
								{/section}
 							</select>
							</td>
						</tr>
					
						<tr class="bg">
							<td style="text-align:right;" width="35%"><strong>Zipcode: </strong><font color="#FF0000">*</font></td>
							<td class="first style3" ><input type="text" id="zipcode" class="editable" name="zipcode"  value=""  maxlength="6" /></td>
						</tr>
						
						<tr  >
							<td style="text-align:right;" width="35%"><strong>Phone Number: </strong></td>
							<td class="first style3" ><input type="text" id="phone" class="editable" name="phone"  value=""  maxlength="15" /></td>
						</tr>
						
					<tr >
								
					<tr class="bg">
					<td class="first">&nbsp;</td>
						<td class="last"><input type="submit" name="submit" value="Add" class="btn" />
						<input type="button" name="cancel" value="Cancel" class="btn" onclick="GoBack();"/>&nbsp;</td>
					</tr>
					<tr >
						<td class="first">&nbsp;</td>
						<td class="last">&nbsp;</td>
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
			<div class="box">Here you can add the new User.</div>
	  </div>
	</div>