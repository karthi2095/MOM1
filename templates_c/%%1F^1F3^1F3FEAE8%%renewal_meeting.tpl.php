<?php /* Smarty version 2.6.3, created on 2017-04-27 13:28:23
         compiled from renewal_meeting.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'stripslashes', 'renewal_meeting.tpl', 181, false),array('modifier', 'htmlspecialchars', 'renewal_meeting.tpl', 181, false),array('modifier', 'date_format', 'renewal_meeting.tpl', 197, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Minutes of Meeting</title>
	<meta http-equiv="X-UA-Compatible" content="IE=9" />
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" href="css/all.css">
	 <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
         
 <?php echo '        
      <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<script>
function GoBack()
{  
	window.location 		=\'manage_meeting.php\';
}
function catvalid()
{ 

document.getElementById(\'hdAction\').value=1;
}
	
	

function getDepartmentUser(val)
  {
  	
  	$.ajax({
  		url: \'Getdepartmentuser.php\',
  		type: "POST",
  		data:"departmentuser="+val,
  		success: function(data) {
	  		//alert(data); 
  			document.getElementById("teamrow").innerHTML=data;
  					
  		}
  	});
  	
  }
function getDepartmentUserLoop(cnt,val)
 {
 	
 	$.ajax({
 		url: \'Getdepartmentuserloop.php\',
 		type: "POST",
 		data:"departmentuse="+val+"&departmentcnt="+cnt,
 		success: function(data) {
	  		//alert(data); 
 			document.getElementById("teamrowloop"+cnt).innerHTML=data;
 					
 		}
 	});
 	
 }


 function ActionItem()
	 {
	
	var i=document.getElementById(\'Actionitem\').value;
	var j=1;
	if(i<=5)
	{
		if(i == 0)
		{
			var tot=i + 1; 
		}
		else if(i == 5)
		{
		 var tot=i;
		}
		else
		{
			var tot=(parseInt(i) + 1); 
			
		}
		
	   
	}
	document.getElementById(\'Actionitem\').value=tot;
	
	}
function ActionItemdelete()
{
	 
var i=document.getElementById(\'Actionitem\').value;
if(i<=5)
{
	
if(i == 5)
	{
	var tot=i - 1; 
	}
	else if(i==1)
	{
	 var tot=i;
	}
	else
	{
		var tot=(parseInt(i) - 1); 
	}
}
document.getElementById(\'Actionitem\').value=tot;

}

	function calladd(a)
	{
		
		//var actionitems=document.getElementsByClassName("actionitems");
		//alert("2");
		//var a=actionitems.length;
		//alert(a);

		//if(a<=5)
		//{
		
			//a=parseInt(a)+1;
			document.getElementById(\'action\'+a).style.display=\'block\';
			//alert("3");
		//}
		//alert("4");	
	}
	
	function callclose(a)
	{
		
		document.getElementById(\'action\'+a).style.display=\'none\';
	}

	 	

  
       jQuery(function($){
           $( "#datepicker" ).datepicker();
           $(".dtpicker").datepicker();
		});
       function changedept(dept) {       	
           $.ajax({
           		url: "getdept.php?dept="+dept, 
           		success: function(result){
           			$(".department-user").html(result);
       		}
       	});
          }

       
       
 </script>
'; ?>
	

</head>
<!--Design Prepared by Rajasri Systems-->   
<body>
<div id="middle"> 
<form name="add_meet" id="add_meet" action="" method="post" onsubmit="return catvalid();">
		<input type="hidden" name="CatIdent">
		<input type="text" name="Ident" value="<?php echo $_REQUEST['Ident']; ?>
">
		<input type="hidden" name="hdIdent">
		<input type="hidden" name="hdAction" id="hdAction">
			<input type="hidden" name="Actionitem" id="Actionitem" value="<?php echo $this->_tpl_vars['count']; ?>
">
  <div id="center-column">
    <div class="top-bar-header">
      <h1>Mintues of Meeting</h1>
      <div class="breadcrumbs"><a href="controlPanel.php">Homepage</a> >> <a href="manage_meeting.php"> Mintues of Meeting </a> >> Renewal Meeting</div>
    </div>
    <div class="select-bar">
					
					<div align="right"><img src="img/back.gif" title="Back" alt="Back" width="32" height="32" class="navigation_link" style="cursor:pointer;margin-right: 230px;" onclick="GoBack();"/></div>
			  </div>
    <div class="manage-grid">
    <div align="center" class="Error" id="errmsg" style="color:red;"><?php echo $this->_tpl_vars['ErrorMessage']; ?>
</div>
	<div align="center" class="Success" id="sucmsg" style="color:green;"><?php echo $this->_tpl_vars['SuccessMessage']; ?>
</div>
		<table border="0" cellpadding="2" cellspacing="0" class="grid-table" style="width: 70%; margin-left: 190px;">
		<tr>
				<td width="30%" style="padding: 15px;">
				Meeting Name:</td>
				<td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['meet']['0']['MeetingName'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)))) ? $this->_run_mod_handler('htmlspecialchars', true, $_tmp) : htmlspecialchars($_tmp)); ?>
</td>
			</tr>
			<tr>
				<td style="padding: 15px;">Meeting Date:</td>
				<td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['meet']['0']['MeetingDate'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)))) ? $this->_run_mod_handler('htmlspecialchars', true, $_tmp) : htmlspecialchars($_tmp)); ?>
</td>
			</tr>
			<tr>
				<td style="padding: 15px;">Program Name:</td>
				<td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['meet']['0']['ProgramName'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)))) ? $this->_run_mod_handler('htmlspecialchars', true, $_tmp) : htmlspecialchars($_tmp)); ?>
</td>
			</tr>
			<tr>
				<td style="padding: 15px;">Project Name:</td>
				<td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['meet']['0']['ProjectName'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)))) ? $this->_run_mod_handler('htmlspecialchars', true, $_tmp) : htmlspecialchars($_tmp)); ?>
</td>
			</tr>
				<tr>
											<td style="padding: 15px;">Target Date:</td>
											<td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['meet']['0']['Target_Date'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)))) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m/%d/%Y") : smarty_modifier_date_format($_tmp, "%m/%d/%Y")); ?>

											
											</td>
										</tr>
										<tr>
											<td style="padding: 15px;">In time completion:</td>
											<td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['meet']['0']['In_Time_Completion'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)))) ? $this->_run_mod_handler('htmlspecialchars', true, $_tmp) : htmlspecialchars($_tmp)); ?>

											
											</td>
										</tr>
										<tr>
											<td style="padding: 15px;">No of revision:</td>
											<td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['meet']['0']['No_Of_Revision'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)))) ? $this->_run_mod_handler('htmlspecialchars', true, $_tmp) : htmlspecialchars($_tmp)); ?>

											
											</td>
										</tr>
										<tr>
											<td style="padding: 15px;">Delayed days:</td>
											<td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['meet']['0']['Delayed_Days'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)))) ? $this->_run_mod_handler('htmlspecialchars', true, $_tmp) : htmlspecialchars($_tmp)); ?>

											
											</td>
										</tr>
										<tr>
											<td style="padding: 15px;">Meeting time:</td>
											<td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['meet']['0']['Meeting_Time'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)))) ? $this->_run_mod_handler('htmlspecialchars', true, $_tmp) : htmlspecialchars($_tmp)); ?>

											
											</td>
										</tr>
										
										<tr>
											<td style="padding: 15px;">Meeting venue:</td>
											<td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['meet']['0']['Meeting_Venue'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)))) ? $this->_run_mod_handler('htmlspecialchars', true, $_tmp) : htmlspecialchars($_tmp)); ?>

											
											</td>
										</tr>
			
			
										<tr>
											<td style="padding: 15px;">Participant:</td>
											<?php echo $this->_tpl_vars['objAdmin']->userId($this->_tpl_vars['meet']['0']['Participation']); ?>

											
											<td>
											<?php unset($this->_sections['s']);
$this->_sections['s']['name'] = 's';
$this->_sections['s']['loop'] = is_array($_loop=$this->_tpl_vars['us']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['s']['show'] = true;
$this->_sections['s']['max'] = $this->_sections['s']['loop'];
$this->_sections['s']['step'] = 1;
$this->_sections['s']['start'] = $this->_sections['s']['step'] > 0 ? 0 : $this->_sections['s']['loop']-1;
if ($this->_sections['s']['show']) {
    $this->_sections['s']['total'] = $this->_sections['s']['loop'];
    if ($this->_sections['s']['total'] == 0)
        $this->_sections['s']['show'] = false;
} else
    $this->_sections['s']['total'] = 0;
if ($this->_sections['s']['show']):

            for ($this->_sections['s']['index'] = $this->_sections['s']['start'], $this->_sections['s']['iteration'] = 1;
                 $this->_sections['s']['iteration'] <= $this->_sections['s']['total'];
                 $this->_sections['s']['index'] += $this->_sections['s']['step'], $this->_sections['s']['iteration']++):
$this->_sections['s']['rownum'] = $this->_sections['s']['iteration'];
$this->_sections['s']['index_prev'] = $this->_sections['s']['index'] - $this->_sections['s']['step'];
$this->_sections['s']['index_next'] = $this->_sections['s']['index'] + $this->_sections['s']['step'];
$this->_sections['s']['first']      = ($this->_sections['s']['iteration'] == 1);
$this->_sections['s']['last']       = ($this->_sections['s']['iteration'] == $this->_sections['s']['total']);
?>
											<?php echo $this->_tpl_vars['us'][$this->_sections['s']['index']]['EmployeeName'];  if ($this->_sections['s']['last'] == ''): ?>,<?php endif; ?>
											<?php endfor; endif; ?>
											</td>
											
										</tr>
										<tr>
											<td style="padding: 15px;" valign="top">Discussion:</td>
											<td style="padding-top: 10px; padding-bottom: 10px;"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['meet']['0']['Discussion'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)))) ? $this->_run_mod_handler('htmlspecialchars', true, $_tmp) : htmlspecialchars($_tmp)); ?>

											</td>
										</tr>
			<tr>
				<td style="padding: 15px;">Meeting Owner:<span class="mandatory" style="color:red">*</span></td>
				<td>
				Department:
					
				<?php unset($this->_sections['D']);
$this->_sections['D']['name'] = 'D';
$this->_sections['D']['loop'] = is_array($_loop=$this->_tpl_vars['dept']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['D']['show'] = true;
$this->_sections['D']['max'] = $this->_sections['D']['loop'];
$this->_sections['D']['step'] = 1;
$this->_sections['D']['start'] = $this->_sections['D']['step'] > 0 ? 0 : $this->_sections['D']['loop']-1;
if ($this->_sections['D']['show']) {
    $this->_sections['D']['total'] = $this->_sections['D']['loop'];
    if ($this->_sections['D']['total'] == 0)
        $this->_sections['D']['show'] = false;
} else
    $this->_sections['D']['total'] = 0;
if ($this->_sections['D']['show']):

            for ($this->_sections['D']['index'] = $this->_sections['D']['start'], $this->_sections['D']['iteration'] = 1;
                 $this->_sections['D']['iteration'] <= $this->_sections['D']['total'];
                 $this->_sections['D']['index'] += $this->_sections['D']['step'], $this->_sections['D']['iteration']++):
$this->_sections['D']['rownum'] = $this->_sections['D']['iteration'];
$this->_sections['D']['index_prev'] = $this->_sections['D']['index'] - $this->_sections['D']['step'];
$this->_sections['D']['index_next'] = $this->_sections['D']['index'] + $this->_sections['D']['step'];
$this->_sections['D']['first']      = ($this->_sections['D']['iteration'] == 1);
$this->_sections['D']['last']       = ($this->_sections['D']['iteration'] == $this->_sections['D']['total']);
?>
						<?php if ($this->_tpl_vars['dept'][$this->_sections['D']['index']]['Id'] == $this->_tpl_vars['meet']['0']['MeetingOwnerDepartmentID']):  echo $this->_tpl_vars['dept'][$this->_sections['D']['index']]['DepartmentName'];  endif; ?>
				
					<?php endfor; endif; ?>
				
					&nbsp;&nbsp;&nbsp;&nbsp;
					EmployeeName:
						
						<?php unset($this->_sections['D']);
$this->_sections['D']['name'] = 'D';
$this->_sections['D']['loop'] = is_array($_loop=$this->_tpl_vars['use']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['D']['show'] = true;
$this->_sections['D']['max'] = $this->_sections['D']['loop'];
$this->_sections['D']['step'] = 1;
$this->_sections['D']['start'] = $this->_sections['D']['step'] > 0 ? 0 : $this->_sections['D']['loop']-1;
if ($this->_sections['D']['show']) {
    $this->_sections['D']['total'] = $this->_sections['D']['loop'];
    if ($this->_sections['D']['total'] == 0)
        $this->_sections['D']['show'] = false;
} else
    $this->_sections['D']['total'] = 0;
if ($this->_sections['D']['show']):

            for ($this->_sections['D']['index'] = $this->_sections['D']['start'], $this->_sections['D']['iteration'] = 1;
                 $this->_sections['D']['iteration'] <= $this->_sections['D']['total'];
                 $this->_sections['D']['index'] += $this->_sections['D']['step'], $this->_sections['D']['iteration']++):
$this->_sections['D']['rownum'] = $this->_sections['D']['iteration'];
$this->_sections['D']['index_prev'] = $this->_sections['D']['index'] - $this->_sections['D']['step'];
$this->_sections['D']['index_next'] = $this->_sections['D']['index'] + $this->_sections['D']['step'];
$this->_sections['D']['first']      = ($this->_sections['D']['iteration'] == 1);
$this->_sections['D']['last']       = ($this->_sections['D']['iteration'] == $this->_sections['D']['total']);
?>
							<?php if ($this->_tpl_vars['use'][$this->_sections['D']['index']]['Id'] == $this->_tpl_vars['meet']['0']['MeetingOwnerUserID']): ?> <?php echo $this->_tpl_vars['use'][$this->_sections['D']['index']]['EmployeeName']; ?>
 <?php endif; ?>
							<?php endfor; endif; ?>
					
				</td>
			</tr>
			<tr>
				<td style="padding: 15px;" valign="top">Information Provided Description:</td>
				<td style="padding-top: 10px; padding-bottom: 10px;">
				<?php echo $this->_tpl_vars['meet']['0']['InfoProvidedDesc']; ?>

				</td>
			</tr>
			
			<tr>
			
				<td style="padding: 15px;" valign="top">Action Item:<span class="mandatory" style="color:red">*</span>
				<div  style="padding: 15px; margin-top: 40px; padding-left: 0px;" valign="top">Dependent Task:</div></td>
				<td style="padding-top: 10px; padding-bottom: 10px;">
				
				<!-- <?php $this->assign('q', 1); ?>
				<?php $this->assign('p', 2); ?>
				<?php $this->assign('r', 1); ?>
				<?php $this->assign('s', 1); ?>
				<?php unset($this->_sections['D']);
$this->_sections['D']['name'] = 'D';
$this->_sections['D']['loop'] = is_array($_loop=$this->_tpl_vars['act']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['D']['show'] = true;
$this->_sections['D']['max'] = $this->_sections['D']['loop'];
$this->_sections['D']['step'] = 1;
$this->_sections['D']['start'] = $this->_sections['D']['step'] > 0 ? 0 : $this->_sections['D']['loop']-1;
if ($this->_sections['D']['show']) {
    $this->_sections['D']['total'] = $this->_sections['D']['loop'];
    if ($this->_sections['D']['total'] == 0)
        $this->_sections['D']['show'] = false;
} else
    $this->_sections['D']['total'] = 0;
if ($this->_sections['D']['show']):

            for ($this->_sections['D']['index'] = $this->_sections['D']['start'], $this->_sections['D']['iteration'] = 1;
                 $this->_sections['D']['iteration'] <= $this->_sections['D']['total'];
                 $this->_sections['D']['index'] += $this->_sections['D']['step'], $this->_sections['D']['iteration']++):
$this->_sections['D']['rownum'] = $this->_sections['D']['iteration'];
$this->_sections['D']['index_prev'] = $this->_sections['D']['index'] - $this->_sections['D']['step'];
$this->_sections['D']['index_next'] = $this->_sections['D']['index'] + $this->_sections['D']['step'];
$this->_sections['D']['first']      = ($this->_sections['D']['iteration'] == 1);
$this->_sections['D']['last']       = ($this->_sections['D']['iteration'] == $this->_sections['D']['total']);
?>
							
								<div id="action<?php echo $this->_tpl_vars['q']++; ?>
" class="actionitems">
								<textarea rows="2" cols="70" name="ActionItemId_<?php echo $this->_tpl_vars['i']; ?>
" id="ActionItemId_<?php echo $this->_tpl_vars['i']; ?>
"><?php echo $this->_tpl_vars['act'][$this->_sections['D']['index']]['ActionItem']; ?>
</textarea>
								<br><br>
								<textarea rows="2" cols="70" name="DependentTaskId_<?php echo $this->_tpl_vars['i']; ?>
" id="DependentTaskId_<?php echo $this->_tpl_vars['i']; ?>
"><?php echo $this->_tpl_vars['act'][$this->_sections['D']['index']]['DependentTask']; ?>
</textarea>
								<br><br>
								
								<select name="DepartmentId_<?php echo $this->_tpl_vars['i']; ?>
" id="DepartmentId_<?php echo $this->_tpl_vars['i']; ?>
" style="width: 32%;">
									<option value="0">--Select--</option>
									<?php unset($this->_sections['Dp']);
$this->_sections['Dp']['name'] = 'Dp';
$this->_sections['Dp']['loop'] = is_array($_loop=$this->_tpl_vars['dept']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['Dp']['show'] = true;
$this->_sections['Dp']['max'] = $this->_sections['Dp']['loop'];
$this->_sections['Dp']['step'] = 1;
$this->_sections['Dp']['start'] = $this->_sections['Dp']['step'] > 0 ? 0 : $this->_sections['Dp']['loop']-1;
if ($this->_sections['Dp']['show']) {
    $this->_sections['Dp']['total'] = $this->_sections['Dp']['loop'];
    if ($this->_sections['Dp']['total'] == 0)
        $this->_sections['Dp']['show'] = false;
} else
    $this->_sections['Dp']['total'] = 0;
if ($this->_sections['Dp']['show']):

            for ($this->_sections['Dp']['index'] = $this->_sections['Dp']['start'], $this->_sections['Dp']['iteration'] = 1;
                 $this->_sections['Dp']['iteration'] <= $this->_sections['Dp']['total'];
                 $this->_sections['Dp']['index'] += $this->_sections['Dp']['step'], $this->_sections['Dp']['iteration']++):
$this->_sections['Dp']['rownum'] = $this->_sections['Dp']['iteration'];
$this->_sections['Dp']['index_prev'] = $this->_sections['Dp']['index'] - $this->_sections['Dp']['step'];
$this->_sections['Dp']['index_next'] = $this->_sections['Dp']['index'] + $this->_sections['Dp']['step'];
$this->_sections['Dp']['first']      = ($this->_sections['Dp']['iteration'] == 1);
$this->_sections['Dp']['last']       = ($this->_sections['Dp']['iteration'] == $this->_sections['Dp']['total']);
?>
								<option value="<?php echo $this->_tpl_vars['dept'][$this->_sections['Dp']['index']]['Id']; ?>
" <?php if ($this->_tpl_vars['dept'][$this->_sections['Dp']['index']]['Id'] == $this->_tpl_vars['act'][$this->_sections['D']['index']]['DepartmentId']): ?> selected="selected" <?php endif; ?>><?php echo $this->_tpl_vars['dept'][$this->_sections['Dp']['index']]['DepartmentName']; ?>
</option>
								<?php endfor; endif; ?>
								</select>
								
								<div class="department-user" style="width: 40%;margin-right: 36px;float: right;">
									<select name="DepatuserId_<?php echo $this->_tpl_vars['i']; ?>
" id="DepatuserId_<?php echo $this->_tpl_vars['i']; ?>
">
									<option value="0">--Select User--</option>
									<?php unset($this->_sections['U']);
$this->_sections['U']['name'] = 'U';
$this->_sections['U']['loop'] = is_array($_loop=$this->_tpl_vars['use']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['U']['show'] = true;
$this->_sections['U']['max'] = $this->_sections['U']['loop'];
$this->_sections['U']['step'] = 1;
$this->_sections['U']['start'] = $this->_sections['U']['step'] > 0 ? 0 : $this->_sections['U']['loop']-1;
if ($this->_sections['U']['show']) {
    $this->_sections['U']['total'] = $this->_sections['U']['loop'];
    if ($this->_sections['U']['total'] == 0)
        $this->_sections['U']['show'] = false;
} else
    $this->_sections['U']['total'] = 0;
if ($this->_sections['U']['show']):

            for ($this->_sections['U']['index'] = $this->_sections['U']['start'], $this->_sections['U']['iteration'] = 1;
                 $this->_sections['U']['iteration'] <= $this->_sections['U']['total'];
                 $this->_sections['U']['index'] += $this->_sections['U']['step'], $this->_sections['U']['iteration']++):
$this->_sections['U']['rownum'] = $this->_sections['U']['iteration'];
$this->_sections['U']['index_prev'] = $this->_sections['U']['index'] - $this->_sections['U']['step'];
$this->_sections['U']['index_next'] = $this->_sections['U']['index'] + $this->_sections['U']['step'];
$this->_sections['U']['first']      = ($this->_sections['U']['iteration'] == 1);
$this->_sections['U']['last']       = ($this->_sections['U']['iteration'] == $this->_sections['U']['total']);
?>
									<option value="<?php echo $this->_tpl_vars['use'][$this->_sections['U']['index']]['Id']; ?>
" <?php if ($this->_tpl_vars['use'][$this->_sections['U']['index']]['Id'] == $this->_tpl_vars['act'][$this->_sections['D']['index']]['DepatuserId']): ?> selected="selected" <?php endif; ?>><?php echo $this->_tpl_vars['use'][$this->_sections['U']['index']]['EmployeeName']; ?>
</option>
									<?php endfor; endif; ?>
									</select>
								</div>
								
								<select name="statusid_<?php echo $this->_tpl_vars['i']; ?>
" id="statusid_<?php echo $this->_tpl_vars['i']; ?>
" style="width:32%;/*! line-height: 20px; */padding: 2px 0px;">
								
									<option value="Open" <?php if ($this->_tpl_vars['act'][$this->_sections['D']['index']]['StatusOfAction'] == 'Open'): ?> selected="selected" <?php endif; ?>>Open</option>
									<option value="Closed" <?php if ($this->_tpl_vars['act'][$this->_sections['D']['index']]['StatusOfAction'] == 'Closed'): ?> selected="selected" <?php endif; ?>>Closed</option>
								</select>
								
								<span style="margin-left: 26px;width: 63%;margin-top: 0px;display: inline-block;">
								
								Action Due Date:<span class="mandatory" style="color:red">*</span>
								
								<input type="text" name="datepickerid_<?php echo $this->_tpl_vars['i']; ?>
" id="datepickerid_<?php echo $this->_tpl_vars['i']; ?>
" class="dtpicker" value="<?php echo $this->_tpl_vars['act'][$this->_sections['D']['index']]['DueDate']; ?>
" size="30" >
							
								<a href="#"  <?php if ($this->_tpl_vars['count'] == 5): ?> onclick=" ActionItem(); calladd(<?php echo $this->_tpl_vars['p']++; ?>
);" <?php else: ?> onclick=" addactionItems(); " <?php endif; ?> <?php if ($this->_sections['D']['last'] > 4): ?>style="display: none;"<?php else: ?>style="margin-top:10 px; display: inline-block;"<?php endif; ?>>
									<img src="img/plus.png" height="17" width="17" <?php if ($this->_tpl_vars['count'] == 5): ?> onclick=" ActionItem(); calladd(<?php echo $this->_tpl_vars['p']++; ?>
);" <?php else: ?> onclick=" addactionItems(); " <?php endif; ?>></a>
									
								<a href="javascript: callclose(<?php echo $this->_tpl_vars['r']++; ?>
);" <?php if ($this->_sections['D']['index'] != '0'): ?> style="margin-top:10px;display:inline-block;"<?php else: ?> style="display:none;"<?php endif; ?>>
									<img src="img/cross.png" height="17" width="17" onclick="return ActionItemdelete();"></a>
									
								</span>
							</div>
							<br></br>
						
				<?php endfor; endif; ?>
				<?php $this->assign('i', $this->_tpl_vars['i']+1); ?>
				<?php $this->assign('q', $this->_tpl_vars['q']+1); ?>
				<?php $this->assign('p', $this->_tpl_vars['p']+1); ?>
				<?php $this->assign('r', $this->_tpl_vars['r']+1); ?>
				<?php $this->assign('s', $this->_tpl_vars['s']+1); ?>
				 -->
			<?php echo $this->_tpl_vars['objAdmin']->getActionitemById(0,1); ?>

					<div id="action1">
						        <?php echo $this->_tpl_vars['getAction']['0']['ActionItem']; ?>

									<br><br>
								<?php echo $this->_tpl_vars['getAction']['0']['DependentTask']; ?>

									<br><br> 
								
							Department:
							<?php unset($this->_sections['Dp']);
$this->_sections['Dp']['name'] = 'Dp';
$this->_sections['Dp']['loop'] = is_array($_loop=$this->_tpl_vars['dept']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['Dp']['show'] = true;
$this->_sections['Dp']['max'] = $this->_sections['Dp']['loop'];
$this->_sections['Dp']['step'] = 1;
$this->_sections['Dp']['start'] = $this->_sections['Dp']['step'] > 0 ? 0 : $this->_sections['Dp']['loop']-1;
if ($this->_sections['Dp']['show']) {
    $this->_sections['Dp']['total'] = $this->_sections['Dp']['loop'];
    if ($this->_sections['Dp']['total'] == 0)
        $this->_sections['Dp']['show'] = false;
} else
    $this->_sections['Dp']['total'] = 0;
if ($this->_sections['Dp']['show']):

            for ($this->_sections['Dp']['index'] = $this->_sections['Dp']['start'], $this->_sections['Dp']['iteration'] = 1;
                 $this->_sections['Dp']['iteration'] <= $this->_sections['Dp']['total'];
                 $this->_sections['Dp']['index'] += $this->_sections['Dp']['step'], $this->_sections['Dp']['iteration']++):
$this->_sections['Dp']['rownum'] = $this->_sections['Dp']['iteration'];
$this->_sections['Dp']['index_prev'] = $this->_sections['Dp']['index'] - $this->_sections['Dp']['step'];
$this->_sections['Dp']['index_next'] = $this->_sections['Dp']['index'] + $this->_sections['Dp']['step'];
$this->_sections['Dp']['first']      = ($this->_sections['Dp']['iteration'] == 1);
$this->_sections['Dp']['last']       = ($this->_sections['Dp']['iteration'] == $this->_sections['Dp']['total']);
?>
								 <?php if ($this->_tpl_vars['dept'][$this->_sections['Dp']['index']]['Id'] == $this->_tpl_vars['getAction']['0']['DepartmentId']): ?> <?php echo $this->_tpl_vars['dept'][$this->_sections['Dp']['index']]['DepartmentName']; ?>
 <?php endif; ?>
									<?php endfor; endif; ?>
							
								&nbsp;&nbsp;&nbsp;&nbsp;
							EmployeeName:
							<?php unset($this->_sections['U']);
$this->_sections['U']['name'] = 'U';
$this->_sections['U']['loop'] = is_array($_loop=$this->_tpl_vars['use']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['U']['show'] = true;
$this->_sections['U']['max'] = $this->_sections['U']['loop'];
$this->_sections['U']['step'] = 1;
$this->_sections['U']['start'] = $this->_sections['U']['step'] > 0 ? 0 : $this->_sections['U']['loop']-1;
if ($this->_sections['U']['show']) {
    $this->_sections['U']['total'] = $this->_sections['U']['loop'];
    if ($this->_sections['U']['total'] == 0)
        $this->_sections['U']['show'] = false;
} else
    $this->_sections['U']['total'] = 0;
if ($this->_sections['U']['show']):

            for ($this->_sections['U']['index'] = $this->_sections['U']['start'], $this->_sections['U']['iteration'] = 1;
                 $this->_sections['U']['iteration'] <= $this->_sections['U']['total'];
                 $this->_sections['U']['index'] += $this->_sections['U']['step'], $this->_sections['U']['iteration']++):
$this->_sections['U']['rownum'] = $this->_sections['U']['iteration'];
$this->_sections['U']['index_prev'] = $this->_sections['U']['index'] - $this->_sections['U']['step'];
$this->_sections['U']['index_next'] = $this->_sections['U']['index'] + $this->_sections['U']['step'];
$this->_sections['U']['first']      = ($this->_sections['U']['iteration'] == 1);
$this->_sections['U']['last']       = ($this->_sections['U']['iteration'] == $this->_sections['U']['total']);
?>
							<?php if ($this->_tpl_vars['use'][$this->_sections['U']['index']]['Id'] == $this->_tpl_vars['getAction']['0']['DepatuserId']): ?> <?php echo $this->_tpl_vars['use'][$this->_sections['U']['index']]['EmployeeName']; ?>
 <?php endif; ?></option>
									<?php endfor; endif; ?>
								<br></br>
								
								
								<select name="statusid_1" id="statusid_1" style="width: 32%; /*! line-height: 20px; */ padding: 2px 0px;">
										<option value="Open" <?php if ($this->_tpl_vars['getAction']['0']['StatusOfAction'] == 'Open'): ?> selected="selected" <?php endif; ?>>Open</option>
									    <option value="Closed" <?php if ($this->_tpl_vars['getAction']['0']['StatusOfAction'] == 'Closed'): ?> selected="selected" <?php endif; ?>>Closed</option>
										<option value="Yet to start" <?php if ($this->_tpl_vars['getAction']['0']['StatusOfAction'] == 'Yet to start'): ?> selected="selected" <?php endif; ?>>Yet to start</option>
								</select>
								<br></br>
								<!--  <span style="margin-left: 26px; width: 63%; margin-top: 0px; display: inline-block;">-->
								Action Due Date:<span class="mandatory" style="color: red">*</span>
								<input name="datepickerid_1" id="datepickerid_1" class="dtpicker" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['getAction']['0']['DueDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m/%d/%Y") : smarty_modifier_date_format($_tmp, "%m/%d/%Y")); ?>
" size="30" type="text"> 
							   
								<br></br>
						</div>
									
				<?php echo $this->_tpl_vars['objAdmin']->getActionitemById(1,1); ?>

						<div id="action2" <?php if ($this->_tpl_vars['getAction']['0']['Id'] != ''): ?> style="margin-bottom:10px;display:block;"<?php else: ?> style="display:none;"<?php endif; ?>>
								<?php echo $this->_tpl_vars['getAction']['0']['ActionItem']; ?>

								<br><br>
								<?php echo $this->_tpl_vars['getAction']['0']['DependentTask']; ?>
 <br><br>
								Department:
									<?php unset($this->_sections['Dp']);
$this->_sections['Dp']['name'] = 'Dp';
$this->_sections['Dp']['loop'] = is_array($_loop=$this->_tpl_vars['dept']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['Dp']['show'] = true;
$this->_sections['Dp']['max'] = $this->_sections['Dp']['loop'];
$this->_sections['Dp']['step'] = 1;
$this->_sections['Dp']['start'] = $this->_sections['Dp']['step'] > 0 ? 0 : $this->_sections['Dp']['loop']-1;
if ($this->_sections['Dp']['show']) {
    $this->_sections['Dp']['total'] = $this->_sections['Dp']['loop'];
    if ($this->_sections['Dp']['total'] == 0)
        $this->_sections['Dp']['show'] = false;
} else
    $this->_sections['Dp']['total'] = 0;
if ($this->_sections['Dp']['show']):

            for ($this->_sections['Dp']['index'] = $this->_sections['Dp']['start'], $this->_sections['Dp']['iteration'] = 1;
                 $this->_sections['Dp']['iteration'] <= $this->_sections['Dp']['total'];
                 $this->_sections['Dp']['index'] += $this->_sections['Dp']['step'], $this->_sections['Dp']['iteration']++):
$this->_sections['Dp']['rownum'] = $this->_sections['Dp']['iteration'];
$this->_sections['Dp']['index_prev'] = $this->_sections['Dp']['index'] - $this->_sections['Dp']['step'];
$this->_sections['Dp']['index_next'] = $this->_sections['Dp']['index'] + $this->_sections['Dp']['step'];
$this->_sections['Dp']['first']      = ($this->_sections['Dp']['iteration'] == 1);
$this->_sections['Dp']['last']       = ($this->_sections['Dp']['iteration'] == $this->_sections['Dp']['total']);
?>
									 <?php if ($this->_tpl_vars['dept'][$this->_sections['Dp']['index']]['Id'] == $this->_tpl_vars['getAction']['0']['DepartmentId']): ?> <?php echo $this->_tpl_vars['dept'][$this->_sections['Dp']['index']]['DepartmentName']; ?>
 <?php endif; ?>
									<?php endfor; endif; ?>
									 &nbsp;&nbsp;&nbsp;
								EmployeeName:	 
							<?php unset($this->_sections['U']);
$this->_sections['U']['name'] = 'U';
$this->_sections['U']['loop'] = is_array($_loop=$this->_tpl_vars['use']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['U']['show'] = true;
$this->_sections['U']['max'] = $this->_sections['U']['loop'];
$this->_sections['U']['step'] = 1;
$this->_sections['U']['start'] = $this->_sections['U']['step'] > 0 ? 0 : $this->_sections['U']['loop']-1;
if ($this->_sections['U']['show']) {
    $this->_sections['U']['total'] = $this->_sections['U']['loop'];
    if ($this->_sections['U']['total'] == 0)
        $this->_sections['U']['show'] = false;
} else
    $this->_sections['U']['total'] = 0;
if ($this->_sections['U']['show']):

            for ($this->_sections['U']['index'] = $this->_sections['U']['start'], $this->_sections['U']['iteration'] = 1;
                 $this->_sections['U']['iteration'] <= $this->_sections['U']['total'];
                 $this->_sections['U']['index'] += $this->_sections['U']['step'], $this->_sections['U']['iteration']++):
$this->_sections['U']['rownum'] = $this->_sections['U']['iteration'];
$this->_sections['U']['index_prev'] = $this->_sections['U']['index'] - $this->_sections['U']['step'];
$this->_sections['U']['index_next'] = $this->_sections['U']['index'] + $this->_sections['U']['step'];
$this->_sections['U']['first']      = ($this->_sections['U']['iteration'] == 1);
$this->_sections['U']['last']       = ($this->_sections['U']['iteration'] == $this->_sections['U']['total']);
?>
										<?php if ($this->_tpl_vars['use'][$this->_sections['U']['index']]['Id'] == $this->_tpl_vars['getAction']['0']['DepatuserId']): ?> <?php echo $this->_tpl_vars['use'][$this->_sections['U']['index']]['EmployeeName']; ?>
 <?php endif; ?>
							<?php endfor; endif; ?>
									
									<br></br>
								
								<select name="statusid_2"id="statusid_2" style="width: 32%;">
									<option value="Open" <?php if ($this->_tpl_vars['getAction']['0']['StatusOfAction'] == 'Open'): ?> selected="selected" <?php endif; ?>>Open</option>
									<option value="Closed" <?php if ($this->_tpl_vars['getAction']['0']['StatusOfAction'] == 'Closed'): ?> selected="selected" <?php endif; ?>>Closed</option>
									</select>
									<br></br>
								<!--<span style="margin-left: 15px; width: 63%; margin-top: 10px; display: inline-block;">-->
								Action Due Date:
								<input name="datepickerid_2" id="datepickerid_2" class="dtpicker" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['getAction']['0']['DueDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m/%d/%Y") : smarty_modifier_date_format($_tmp, "%m/%d/%Y")); ?>
" size="30" type="text">
								
								<br></br>
								
					</div>
														
			<?php echo $this->_tpl_vars['objAdmin']->getActionitemById(2,1); ?>

										
					<div id="action3" <?php if ($this->_tpl_vars['getAction']['0']['Id'] != ''): ?> style="margin-bottom:10px;display:block;"<?php else: ?> style="display:none;"<?php endif; ?>>
								<?php echo $this->_tpl_vars['getAction']['0']['ActionItem']; ?>

								<br><br>
								<?php echo $this->_tpl_vars['getAction']['0']['DependentTask']; ?>
 <br><br>
								Department:
									<?php unset($this->_sections['Dp']);
$this->_sections['Dp']['name'] = 'Dp';
$this->_sections['Dp']['loop'] = is_array($_loop=$this->_tpl_vars['dept']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['Dp']['show'] = true;
$this->_sections['Dp']['max'] = $this->_sections['Dp']['loop'];
$this->_sections['Dp']['step'] = 1;
$this->_sections['Dp']['start'] = $this->_sections['Dp']['step'] > 0 ? 0 : $this->_sections['Dp']['loop']-1;
if ($this->_sections['Dp']['show']) {
    $this->_sections['Dp']['total'] = $this->_sections['Dp']['loop'];
    if ($this->_sections['Dp']['total'] == 0)
        $this->_sections['Dp']['show'] = false;
} else
    $this->_sections['Dp']['total'] = 0;
if ($this->_sections['Dp']['show']):

            for ($this->_sections['Dp']['index'] = $this->_sections['Dp']['start'], $this->_sections['Dp']['iteration'] = 1;
                 $this->_sections['Dp']['iteration'] <= $this->_sections['Dp']['total'];
                 $this->_sections['Dp']['index'] += $this->_sections['Dp']['step'], $this->_sections['Dp']['iteration']++):
$this->_sections['Dp']['rownum'] = $this->_sections['Dp']['iteration'];
$this->_sections['Dp']['index_prev'] = $this->_sections['Dp']['index'] - $this->_sections['Dp']['step'];
$this->_sections['Dp']['index_next'] = $this->_sections['Dp']['index'] + $this->_sections['Dp']['step'];
$this->_sections['Dp']['first']      = ($this->_sections['Dp']['iteration'] == 1);
$this->_sections['Dp']['last']       = ($this->_sections['Dp']['iteration'] == $this->_sections['Dp']['total']);
?>
									 <?php if ($this->_tpl_vars['dept'][$this->_sections['Dp']['index']]['Id'] == $this->_tpl_vars['getAction']['0']['DepartmentId']): ?> <?php echo $this->_tpl_vars['dept'][$this->_sections['Dp']['index']]['DepartmentName']; ?>
 <?php endif; ?>
									<?php endfor; endif; ?>
									 &nbsp;&nbsp;&nbsp;
								EmployeeName:	 
							<?php unset($this->_sections['U']);
$this->_sections['U']['name'] = 'U';
$this->_sections['U']['loop'] = is_array($_loop=$this->_tpl_vars['use']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['U']['show'] = true;
$this->_sections['U']['max'] = $this->_sections['U']['loop'];
$this->_sections['U']['step'] = 1;
$this->_sections['U']['start'] = $this->_sections['U']['step'] > 0 ? 0 : $this->_sections['U']['loop']-1;
if ($this->_sections['U']['show']) {
    $this->_sections['U']['total'] = $this->_sections['U']['loop'];
    if ($this->_sections['U']['total'] == 0)
        $this->_sections['U']['show'] = false;
} else
    $this->_sections['U']['total'] = 0;
if ($this->_sections['U']['show']):

            for ($this->_sections['U']['index'] = $this->_sections['U']['start'], $this->_sections['U']['iteration'] = 1;
                 $this->_sections['U']['iteration'] <= $this->_sections['U']['total'];
                 $this->_sections['U']['index'] += $this->_sections['U']['step'], $this->_sections['U']['iteration']++):
$this->_sections['U']['rownum'] = $this->_sections['U']['iteration'];
$this->_sections['U']['index_prev'] = $this->_sections['U']['index'] - $this->_sections['U']['step'];
$this->_sections['U']['index_next'] = $this->_sections['U']['index'] + $this->_sections['U']['step'];
$this->_sections['U']['first']      = ($this->_sections['U']['iteration'] == 1);
$this->_sections['U']['last']       = ($this->_sections['U']['iteration'] == $this->_sections['U']['total']);
?>
										<?php if ($this->_tpl_vars['use'][$this->_sections['U']['index']]['Id'] == $this->_tpl_vars['getAction']['0']['DepatuserId']): ?> <?php echo $this->_tpl_vars['use'][$this->_sections['U']['index']]['EmployeeName']; ?>
 <?php endif; ?>
							<?php endfor; endif; ?>
						<br></br>
						
								   <select name="statusid_3"id="statusid_3" style="width: 32%;">
										<option value="Open" <?php if ($this->_tpl_vars['getAction']['0']['StatusOfAction'] == 'Open'): ?> selected="selected" <?php endif; ?>>Open</option>
										<option value="Closed" <?php if ($this->_tpl_vars['getAction']['0']['StatusOfAction'] == 'Closed'): ?> selected="selected" <?php endif; ?>>Closed</option>
										<option value="Yet to start" <?php if ($this->_tpl_vars['getAction']['0']['StatusOfAction'] == 'Yet to start'): ?> selected="selected" <?php endif; ?>>Yet to start</option>
									</select>
									<br></br>
									Action Due Date:
									<input name="datepickerid_3" id="datepickerid_3" class="dtpicker" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['getAction']['0']['DueDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m/%d/%Y") : smarty_modifier_date_format($_tmp, "%m/%d/%Y")); ?>
" size="30" type="text">
								   
								
									<br></br>
				  </div>
											
		<?php echo $this->_tpl_vars['objAdmin']->getActionitemById(3,1); ?>

				<div id="action4" <?php if ($this->_tpl_vars['getAction']['0']['Id'] != ''): ?> style="margin-bottom:10px;display:block;"<?php else: ?> style="display:none;"<?php endif; ?>>
									<?php echo $this->_tpl_vars['getAction']['0']['ActionItem']; ?>

								<br><br>
								<?php echo $this->_tpl_vars['getAction']['0']['DependentTask']; ?>
 <br><br>
								Department:
									<?php unset($this->_sections['Dp']);
$this->_sections['Dp']['name'] = 'Dp';
$this->_sections['Dp']['loop'] = is_array($_loop=$this->_tpl_vars['dept']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['Dp']['show'] = true;
$this->_sections['Dp']['max'] = $this->_sections['Dp']['loop'];
$this->_sections['Dp']['step'] = 1;
$this->_sections['Dp']['start'] = $this->_sections['Dp']['step'] > 0 ? 0 : $this->_sections['Dp']['loop']-1;
if ($this->_sections['Dp']['show']) {
    $this->_sections['Dp']['total'] = $this->_sections['Dp']['loop'];
    if ($this->_sections['Dp']['total'] == 0)
        $this->_sections['Dp']['show'] = false;
} else
    $this->_sections['Dp']['total'] = 0;
if ($this->_sections['Dp']['show']):

            for ($this->_sections['Dp']['index'] = $this->_sections['Dp']['start'], $this->_sections['Dp']['iteration'] = 1;
                 $this->_sections['Dp']['iteration'] <= $this->_sections['Dp']['total'];
                 $this->_sections['Dp']['index'] += $this->_sections['Dp']['step'], $this->_sections['Dp']['iteration']++):
$this->_sections['Dp']['rownum'] = $this->_sections['Dp']['iteration'];
$this->_sections['Dp']['index_prev'] = $this->_sections['Dp']['index'] - $this->_sections['Dp']['step'];
$this->_sections['Dp']['index_next'] = $this->_sections['Dp']['index'] + $this->_sections['Dp']['step'];
$this->_sections['Dp']['first']      = ($this->_sections['Dp']['iteration'] == 1);
$this->_sections['Dp']['last']       = ($this->_sections['Dp']['iteration'] == $this->_sections['Dp']['total']);
?>
									 <?php if ($this->_tpl_vars['dept'][$this->_sections['Dp']['index']]['Id'] == $this->_tpl_vars['getAction']['0']['DepartmentId']): ?> <?php echo $this->_tpl_vars['dept'][$this->_sections['Dp']['index']]['DepartmentName']; ?>
 <?php endif; ?>
									<?php endfor; endif; ?>
									 &nbsp;&nbsp;&nbsp;
								EmployeeName:	 
							<?php unset($this->_sections['U']);
$this->_sections['U']['name'] = 'U';
$this->_sections['U']['loop'] = is_array($_loop=$this->_tpl_vars['use']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['U']['show'] = true;
$this->_sections['U']['max'] = $this->_sections['U']['loop'];
$this->_sections['U']['step'] = 1;
$this->_sections['U']['start'] = $this->_sections['U']['step'] > 0 ? 0 : $this->_sections['U']['loop']-1;
if ($this->_sections['U']['show']) {
    $this->_sections['U']['total'] = $this->_sections['U']['loop'];
    if ($this->_sections['U']['total'] == 0)
        $this->_sections['U']['show'] = false;
} else
    $this->_sections['U']['total'] = 0;
if ($this->_sections['U']['show']):

            for ($this->_sections['U']['index'] = $this->_sections['U']['start'], $this->_sections['U']['iteration'] = 1;
                 $this->_sections['U']['iteration'] <= $this->_sections['U']['total'];
                 $this->_sections['U']['index'] += $this->_sections['U']['step'], $this->_sections['U']['iteration']++):
$this->_sections['U']['rownum'] = $this->_sections['U']['iteration'];
$this->_sections['U']['index_prev'] = $this->_sections['U']['index'] - $this->_sections['U']['step'];
$this->_sections['U']['index_next'] = $this->_sections['U']['index'] + $this->_sections['U']['step'];
$this->_sections['U']['first']      = ($this->_sections['U']['iteration'] == 1);
$this->_sections['U']['last']       = ($this->_sections['U']['iteration'] == $this->_sections['U']['total']);
?>
										<?php if ($this->_tpl_vars['use'][$this->_sections['U']['index']]['Id'] == $this->_tpl_vars['getAction']['0']['DepatuserId']): ?> <?php echo $this->_tpl_vars['use'][$this->_sections['U']['index']]['EmployeeName']; ?>
 <?php endif; ?>
							<?php endfor; endif; ?>
									<br></br>
									<?php $this->assign('userID', $_SESSION['userid']); ?>
				 				<?php if ($this->_tpl_vars['userID'] == $this->_tpl_vars['getAction']['0']['DepatuserId'] || $this->_tpl_vars['userID'] == $this->_tpl_vars['getAction']['0']['CreatedBy']): ?>
									<select name="statusid_4"id="statusid_4" style="width: 32%;">
									<option value="Open" <?php if ($this->_tpl_vars['getAction']['0']['StatusOfAction'] == 'Open'): ?> selected="selected" <?php endif; ?>>Open</option>
									<option value="Closed" <?php if ($this->_tpl_vars['getAction']['0']['StatusOfAction'] == 'Closed'): ?> selected="selected" <?php endif; ?>>Closed</option>
									<option value="Closed" <?php if ($this->_tpl_vars['getAction']['0']['StatusOfAction'] == 'Yet to start'): ?> selected="selected" <?php endif; ?>>Yet to start</option>
									</select>
									<br></br>			
										Action Due Date:
										<input name="datepickerid_4"id="datepickerid_4"	class="dtpicker" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['getAction']['0']['DueDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m/%d/%Y") : smarty_modifier_date_format($_tmp, "%m/%d/%Y")); ?>
" size="30" type="text">
											<?php else: ?>
								Status:	
							<?php echo $this->_tpl_vars['getAction']['0']['StatusOfAction']; ?>
 
							<br>
							<br>
								Action Due Date:
							<?php echo $this->_tpl_vars['getAction']['0']['DueDate']; ?>

								<?php endif; ?>
												
												</div>
												<br></br>
												<?php echo $this->_tpl_vars['objAdmin']->getActionitemById(4,1); ?>

												<div id="action5"<?php if ($this->_tpl_vars['getAction']['0']['Id'] != ''): ?> style="margin-bottom:10px;display:block;"<?php else: ?> style="display:none;"<?php endif; ?>">
												<?php echo $this->_tpl_vars['getAction']['0']['ActionItem']; ?>

								<br><br>
								<?php echo $this->_tpl_vars['getAction']['0']['DependentTask']; ?>
 <br><br>
								Department:
									<?php unset($this->_sections['Dp']);
$this->_sections['Dp']['name'] = 'Dp';
$this->_sections['Dp']['loop'] = is_array($_loop=$this->_tpl_vars['dept']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['Dp']['show'] = true;
$this->_sections['Dp']['max'] = $this->_sections['Dp']['loop'];
$this->_sections['Dp']['step'] = 1;
$this->_sections['Dp']['start'] = $this->_sections['Dp']['step'] > 0 ? 0 : $this->_sections['Dp']['loop']-1;
if ($this->_sections['Dp']['show']) {
    $this->_sections['Dp']['total'] = $this->_sections['Dp']['loop'];
    if ($this->_sections['Dp']['total'] == 0)
        $this->_sections['Dp']['show'] = false;
} else
    $this->_sections['Dp']['total'] = 0;
if ($this->_sections['Dp']['show']):

            for ($this->_sections['Dp']['index'] = $this->_sections['Dp']['start'], $this->_sections['Dp']['iteration'] = 1;
                 $this->_sections['Dp']['iteration'] <= $this->_sections['Dp']['total'];
                 $this->_sections['Dp']['index'] += $this->_sections['Dp']['step'], $this->_sections['Dp']['iteration']++):
$this->_sections['Dp']['rownum'] = $this->_sections['Dp']['iteration'];
$this->_sections['Dp']['index_prev'] = $this->_sections['Dp']['index'] - $this->_sections['Dp']['step'];
$this->_sections['Dp']['index_next'] = $this->_sections['Dp']['index'] + $this->_sections['Dp']['step'];
$this->_sections['Dp']['first']      = ($this->_sections['Dp']['iteration'] == 1);
$this->_sections['Dp']['last']       = ($this->_sections['Dp']['iteration'] == $this->_sections['Dp']['total']);
?>
									 <?php if ($this->_tpl_vars['dept'][$this->_sections['Dp']['index']]['Id'] == $this->_tpl_vars['getAction']['0']['DepartmentId']): ?> <?php echo $this->_tpl_vars['dept'][$this->_sections['Dp']['index']]['DepartmentName']; ?>
 <?php endif; ?>
									<?php endfor; endif; ?>
									 &nbsp;&nbsp;&nbsp;
								EmployeeName:	 
							<?php unset($this->_sections['U']);
$this->_sections['U']['name'] = 'U';
$this->_sections['U']['loop'] = is_array($_loop=$this->_tpl_vars['use']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['U']['show'] = true;
$this->_sections['U']['max'] = $this->_sections['U']['loop'];
$this->_sections['U']['step'] = 1;
$this->_sections['U']['start'] = $this->_sections['U']['step'] > 0 ? 0 : $this->_sections['U']['loop']-1;
if ($this->_sections['U']['show']) {
    $this->_sections['U']['total'] = $this->_sections['U']['loop'];
    if ($this->_sections['U']['total'] == 0)
        $this->_sections['U']['show'] = false;
} else
    $this->_sections['U']['total'] = 0;
if ($this->_sections['U']['show']):

            for ($this->_sections['U']['index'] = $this->_sections['U']['start'], $this->_sections['U']['iteration'] = 1;
                 $this->_sections['U']['iteration'] <= $this->_sections['U']['total'];
                 $this->_sections['U']['index'] += $this->_sections['U']['step'], $this->_sections['U']['iteration']++):
$this->_sections['U']['rownum'] = $this->_sections['U']['iteration'];
$this->_sections['U']['index_prev'] = $this->_sections['U']['index'] - $this->_sections['U']['step'];
$this->_sections['U']['index_next'] = $this->_sections['U']['index'] + $this->_sections['U']['step'];
$this->_sections['U']['first']      = ($this->_sections['U']['iteration'] == 1);
$this->_sections['U']['last']       = ($this->_sections['U']['iteration'] == $this->_sections['U']['total']);
?>
										<?php if ($this->_tpl_vars['use'][$this->_sections['U']['index']]['Id'] == $this->_tpl_vars['getAction']['0']['DepatuserId']): ?> <?php echo $this->_tpl_vars['use'][$this->_sections['U']['index']]['EmployeeName']; ?>
 <?php endif; ?>
							<?php endfor; endif; ?>
												<br></br>
											
												<select name="statusid_5"id="statusid_5" style="width: 32%;">
												<option value="Open" <?php if ($this->_tpl_vars['getAction']['0']['StatusOfAction'] == 'Open'): ?> selected="selected" <?php endif; ?>>Open</option>
												<option value="Closed" <?php if ($this->_tpl_vars['getAction']['0']['StatusOfAction'] == 'Closed'): ?> selected="selected" <?php endif; ?>>Closed</option>
												<option value="Closed" <?php if ($this->_tpl_vars['getAction']['0']['StatusOfAction'] == 'Yet to start'): ?> selected="selected" <?php endif; ?>>Yet to start</option>
												</select>
																
												 <span style="margin-left: 15px; width: 63%; margin-top: 10px; display: inline-block;">
												Action Due Date:
															<input name="datepickerid_5"
																		id="datepickerid_5"
																		class="dtpicker" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['getAction']['0']['DueDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m/%d/%Y") : smarty_modifier_date_format($_tmp, "%m/%d/%Y")); ?>
" size="30" type="text">
																
												
												</div>
			<tr>
				<td style="padding: 15px;">Action - Status:</td>
				<td>
				
					<?php echo $this->_tpl_vars['meet']['0']['ActionStatus']; ?>

				</td>
			</tr>
			<!--<tr>
											<td style="padding: 15px;">Attachment file:<span
												class="mandatory" style="color: red">*</span></td>
											<td>
											<input type="file" id="upload_file" name="upload_file" value="" style="float: left;"/>
										</td>
										</tr>-->
			<tr class="bg">
				<td align="right" style="padding: 10px; text-align: center;" colspan="2">
				<a href="" style="text-decoration: none;"><input type="submit" class="btn-submit" value="Update" name="submit" onclick="return catvalid();"/></a>
				&nbsp;&nbsp;&nbsp;
				<a href="manage_meeting.php" style="text-decoration: none;"><input type="button" class="btn-submit" value="Cancel" name="submit" /></a></td>
			</tr>
		</table>
		</form>
	</div>
 </div>
</div>
</div>	
</body>
</html>