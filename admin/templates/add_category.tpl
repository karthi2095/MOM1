{literal}
<script language="javascript" type="text/javascript" src="javascript/jquery-latest.js"></script>
<script language="javascript" type="text/javascript" src="javascript/admin_valid.js"></script>
<script language="javascript" type="text/javascript">
function GoBack()
{  
	window.location 		='manage_petcategory.php';
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

	
	
	var category=trim(document.getElementById('category').value);
	document.getElementById('category').value=category;
	
	if(category==''){
		document.getElementById('errmsg').innerHTML='Please enter the category';
		document.getElementById('category').focus();
		return false;
	}

	
	$('#hdAction').val('1');
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
				<h1>Pet Category</h1>
				<div class="breadcrumbs"><a href="controlpanel.php" class="navigation_link" >Homepage</a> 
				/ <a href="manage_petcategory.php" class="navigation_link" >Pet Category </a> / 
				 Add Pet Category </div>
			</div><br/>
				<div class="select-bar">
					<div style="float:left;">&nbsp;</div>
					<div align="right"><img src="img/back.gif" title="Back" alt="Back"
					 width="32" height="32" class="navigation_link" style="cursor:pointer;" 
					 onclick="GoBack();"/></div>
			  </div>
				<div align="center" class="Error" id="errmsg">{$ErrorMessage}</div>
				<div align="center" class="Success" id="sucmsg">{$SuccessMessage}</div>
				
				<div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
						<th class="full" colspan="2">Add Pet Category</th>
					</tr>
					<tr class="bg">
						<td class="first">&nbsp;</td>
						<td class="last">&nbsp;</td>
					</tr>
					
						<tr >
							<td style="text-align:right;" width="35%"><strong>Pet Category: </strong><font color="#FF0000">*</font></td>
							<td class="first style3" width="65%"><input type="text" id="category" class="editable" name="category"  value=""  maxlength="30" /></td>
						</tr>
						 
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
			<div class="box">Here you can add the new pet category.</div>
	  </div>
	</div>