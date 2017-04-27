<?php /* Smarty version 2.6.3, created on 2017-04-27 11:32:56
         compiled from manage_meeting.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'manage_meeting.tpl', 167, false),array('modifier', 'stripslashes', 'manage_meeting.tpl', 172, false),array('modifier', 'ucfirst', 'manage_meeting.tpl', 172, false),array('modifier', 'date_format', 'manage_meeting.tpl', 174, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Minutes of Meeting</title>
	<meta http-equiv="X-UA-Compatible" content="IE=9" />
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" href="css/all.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.cs++++++s">
  <link rel="stylesheet" href="css/bootstrap.min.css">
   <?php echo '
  <script src="js/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script>
  $( function() {
    var availableTags = [
      "Requirement Discussion",
      "Project Scope",
      "Statutory Meeting",
      "Annual General Meeting",
      "Extraordinary General Meeting",
      "Meeting of the Board of Directors",
      "Class Meeting",
      "Meeting of Creditors",
      "Meeting of Contributories",
      "Meeting of Debenture Holders"
    ];
    $( "#tags" ).autocomplete({
      source: availableTags
    });
  } );
  
  $( function() {
    var availableTags1 = [
      "Initial Discussion",
      "First Round",
      "Initial Discussion",
      "Annual",
      "Section #3",
      "Board of Directors",
      "Class Meeting",
      "Creditors",
      "Contributories",
      "Debenture Holders"
    ];
    $( "#tags1" ).autocomplete({
      source: availableTags1
    });
  } );
  
  $( function() {
    var availableTags2 = [
      "Norma B. Levy - 56325",
      "Suzanne K. Roper - 99965",
      "Howard L. Henley - 56965",
      "Eric A. Murphy - 53325",
      "Tommy J. Lee - 99925",
      "Michael A. Hart - 96325",
      "Stephanie D. McGregor - 45455",
      "Christine J. Gaskins - 56455"
    ];
    $( "#tags2" ).autocomplete({
      source: availableTags2
    });
  } );
  </script>
  <script language="javascript" type="text/javascript">
  function editCats(CatIdent,medate)
  {
 
  var meetdate=document.getElementById("meetdate").value;
 
  	FormName		= document.CatMgmt;
  	FormName.Ident.value = CatIdent;
	if(meetdate <= medate ){
  	FormName.action	= "edit_meeting.php";
	}
	else
	{
	FormName.action	= "renewal_meeting.php";
	}
  	FormName.submit;
  }
  function viewCats(CatIdent)
  {
  	FormName		= document.CatMgmt;
  	FormName.Ident.value = CatIdent;
  	FormName.action	= "view_meeting.php";
  	FormName.submit;
  }
  function deleteCats(CatIdent)
  {
  	//alert(CatIdent);
  	if(confirm("Are you sure you want to delete?")){
  	FormName		= document.CatMgmt;
  	FormName.hdIdent.value = CatIdent;
 	FormName.submit;
  	}else{
  		return false;
  	}
  }
  function ChangeStatus(Ident,st)
  {
  	FormName				= document.CatMgmt;
  	FormName.Ident.value 	= Ident;
  	FormName.setStatus.value= st;
  	FormName.submit;
  }
  function resetpage()
  {
  	FormName		= document.CatMgmt;
  	//FormName.page.value	= \'\';
  }
  </script>

 '; ?>

</head>
<!--Design Prepared by Rajasri Systems-->   
<body>

<div id="middle"> 
<form name="CatMgmt" method="post" onsubmit="resetpage();" action="">
            <input type="hidden" name="Ident" id="Ident">
			<input type="hidden" name="ConId[]" id="ConId">
			<input type="hidden" name="setStatus" id="setStatus">
			<input type="hidden" name="hdIdent" id="hdIdent">
			<input type="hidden" name="CatIdent" id="CatIdent">
			<input type="hidden" name="meetdate" id="meetdate" value="<?php echo $this->_tpl_vars['dat']; ?>
">
			<input type="hidden" name="medate" id="medate">
			<input type="hidden" name="ActionType" id="ActionType">
  <div id="center-column">
    <div class="top-bar-header">
      <h1>Minutes of Meeting</h1>
	  <div class="breadcrumbs"><a href="controlPanel.php" class="navigation_link" >Homepage</a> >> Minutes of Meeting 
			</div><br />

   
   <div class="manage-grid">
   <div style="width:80%; float:left;">
	<table border="0" cellpadding="2" cellspacing="0" class="grid-table" style="width: 100%; border: none; background-color: #f5f6f7;">
		<tr>
			<td style="border: none; background: #f0edeb;">
		
				<a href="add_meeting.php"><img src="img/add.png" alt="" style="float: right; padding: 10px;"></a>
			</td>
		</tr>
	</table>
		<div align="center" class="Error" id="errmsg" style="color:red;"><?php echo $this->_tpl_vars['ErrorMessage'];  echo $this->_tpl_vars['createdby']; ?>
</div>
		<div align="center" class="Success" id="sucmsg" style="color:green;"><?php echo $this->_tpl_vars['SuccessMessage']; ?>
</div>
		<table border="0" cellpadding="2" cellspacing="0" class="grid-table" style="width: 100%";>
			<tr>
				<th width="5%">S No</th>
				<th>Meeting Name</th>
				<th>Meeting Type</th>
				<th width="10%">Meeting Date</th>
				<th>Meeting Owner</th>
				<th>Action Items</th>
				<th width="10%">Action Due Date</th>
				<th width="10%">Action Item Status</th>
			<th width="15%">Action</th>
			</tr>
			
			<?php $this->assign('meetingId', 0); ?>
			<?php if ($this->_tpl_vars['meet'] != ""): ?>
			 <?php unset($this->_sections['D']);
$this->_sections['D']['name'] = 'D';
$this->_sections['D']['loop'] = is_array($_loop=$this->_tpl_vars['meet']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			 <?php echo smarty_function_cycle(array('values' => ', bg','assign' => 'classname'), $this);?>

			<tr class="<?php echo $this->_tpl_vars['classname']; ?>
">
				
				<?php if ($this->_tpl_vars['meetingId'] != $this->_tpl_vars['meet'][$this->_sections['D']['index']]['Id']): ?>
				<td class="first style1" align="center" valign="top"><center><?php echo $this->_tpl_vars['i']++; ?>
</center></td>
				<td class="first style1" valign="top"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['meet'][$this->_sections['D']['index']]['MeetingName'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)))) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
 </td>
				<td class="first style1" valign="top"><?php echo $this->_tpl_vars['objAdmin']->getMeetingTypeById($this->_tpl_vars['meet'][$this->_sections['D']['index']]['MeetingType']); ?>
 &nbsp; &nbsp; <img src="admin/uploadimage/<?php echo $this->_tpl_vars['objAdmin']->getMeetingImageById($this->_tpl_vars['meet'][$this->_sections['D']['index']]['MeetingType']); ?>
" width="30" height="30"></td>
				<td class="first style1" valign="top"><?php echo ((is_array($_tmp=$this->_tpl_vars['meet'][$this->_sections['D']['index']]['MeetingDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%B %d, %Y") : smarty_modifier_date_format($_tmp, "%B %d, %Y")); ?>
 </td>
				<td class="first style1" valign="top"><?php echo $this->_tpl_vars['objAdmin']->getOwnernameById($this->_tpl_vars['meet'][$this->_sections['D']['index']]['MeetingOwnerUserID']); ?>
 </td>
				<?php else: ?>
				<td class="first style1" valign="top" colspan="5" style="border:0">&nbsp;</td>				
				<?php endif; ?>
				<td class="first style1" valign="top"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['meet'][$this->_sections['D']['index']]['ActionItem'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)))) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
 </td>
				<td class="first style1" valign="top"><?php echo ((is_array($_tmp=$this->_tpl_vars['meet'][$this->_sections['D']['index']]['DueDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%B %d, %Y") : smarty_modifier_date_format($_tmp, "%B %d, %Y")); ?>
  </td>
				<td class="first style1" valign="top" <?php if ($this->_tpl_vars['meet'][$this->_sections['D']['index']]['StatusOfAction'] == 'Closed'): ?> style="color: #00B050;"<?php elseif ($this->_tpl_vars['meet'][$this->_sections['D']['index']]['StatusOfAction'] == 'Open'): ?>style="color: #f00;"<?php elseif ($this->_tpl_vars['meet'][$this->_sections['D']['index']]['StatusOfAction'] == 'Yet to start'): ?>style="color: #E4D209;"<?php endif; ?>><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['meet'][$this->_sections['D']['index']]['StatusOfAction'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)))) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
 </td>
				
			<?php if ($this->_tpl_vars['meetingId'] != $this->_tpl_vars['meet'][$this->_sections['D']['index']]['Id']): ?>
			<td valign="top" style="text-align:center; font-size:0px;">
				
				 <a href="edit_meeting.php">
				
				 <input type="image" class="icon-bor" src="img/edit.png" title="Edit" width="16" height="16" alt="Edit" border="0" onclick="Javascript:editCats('<?php echo $this->_tpl_vars['meet'][$this->_sections['D']['index']]['Id']; ?>
','<?php echo $this->_tpl_vars['meet'][$this->_sections['D']['index']]['MeetingDate']; ?>
')" /></a> 
				
				<?php if ($this->_tpl_vars['meet'][$this->_sections['D']['index']]['meetstatus'] == '1'): ?>
				 <input type="image" class="icon-bor" src="img/active.png" title="Active" width="16" height="16" alt="Active" border="0" onclick="Javascript:ChangeStatus('<?php echo $this->_tpl_vars['meet'][$this->_sections['D']['index']]['meetId']; ?>
','0')" />
			 	 <?php else: ?>
			 	 <input type="image" class="icon-bor" src="img/inactive.png" title="InActive" width="16" height="16" alt="Active" border="0" onclick="Javascript:ChangeStatus('<?php echo $this->_tpl_vars['meet'][$this->_sections['D']['index']]['meetId']; ?>
','1')" />
			 	<?php endif; ?>
			 	
			 	
			 	 <input type="image" class="icon-bor"  src="img/View.gif" title="View" width="16" height="16" alt="View" border="0" <?php if ($this->_tpl_vars['userID'] != $this->_tpl_vars['meet'][$this->_sections['D']['index']]['CreatedBy']): ?> style="border-right: none !important;" <?php endif; ?> onclick="Javascript:viewCats('<?php echo $this->_tpl_vars['meet'][$this->_sections['D']['index']]['Id']; ?>
')" />
			 	
			 	 <input type="image" class="" src="img/delete.png" width="16" height="16" alt="Delete" border="0" onclick="Javascript:deleteCats('<?php echo $this->_tpl_vars['meet'][$this->_sections['D']['index']]['meetId']; ?>
')" title="Delete" /></td><?php endif; ?>
				
			<?php $this->assign('meetingId', $this->_tpl_vars['meet'][$this->_sections['D']['index']]['Id']); ?>
			</tr>
				 <?php endfor; else: ?>
			 <tr class="<?php echo $this->_tpl_vars['classname']; ?>
">
			 
			 
				<td align="center" colspan="8" class="style1"><center>No meetings found</center></td>
			 </tr>
				 <?php endif; ?>
				 <?php else: ?>
			 <tr class="<?php echo $this->_tpl_vars['classname']; ?>
">
				<td align="center" colspan="8" class="style1"><center>No meetings found</center></td>
			 </tr>
				 <?php endif; ?>
			</tr>
			
		</table>
		</div>
		<div class="grid-table" style="width: 19%; float: right; color: #333; padding: 2%;">
		   <div style="margin-bottom: 20px;">
				<p class="title1">Task Description</p>
			   <table style="width:100%;" border="0" cellpadding="2" cellspacing="0">
				   <tbody>
							
					   <tr>
							<td>
							<div class="act-closed"></div>
							</td>
							<td>Completed</td>
					   </tr>
					    <tr>
							<td>
							<div class="act-revised"></div>
							</td>
							<td>Revised</td>
					   </tr>
					   <tr>
							<td>
							<div class="act-open"></div>
							</td>
							<td>Delayed</td>
					   </tr>
					   <tr>
							<td>
							<div class="act-process"></div>
							</td>
							<td>Yet to Start</td>
					   </tr>
				   </tbody>
			   </table>
			</div>
			
			<div>
				<p class="title1">Action Status</p>
			   <table style="width:100%;" border="0" cellpadding="2" cellspacing="0">
				   <tbody>
							
					   <tr>
							<td>
							<div class="act-closed"></div>
							</td>
							<td>Closed</td>
					   </tr>
					   <tr>
							<td>
							<div class="act-open"></div>
							</td>
							<td>Open</td>
					   </tr>
					   <tr>
							<td>
							<div class="act-process"></div>
							</td>
							<td>Yet to start</td>
					   </tr>
				   </tbody>
			   </table>
			</div>
			<div class="clear"></div>
	   </div>
		<div class="clear"></div>
		</form>
		
	</div>
	<div class="clear"></div>
 </div>
 <div class="clear"></div>
</div>
<div class="clear"></div>
</div>	
	

</body>
</html>