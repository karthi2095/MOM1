<?php /* Smarty version 2.6.3, created on 2017-04-24 04:58:08
         compiled from history.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'history.tpl', 135, false),array('modifier', 'stripslashes', 'history.tpl', 140, false),array('modifier', 'ucfirst', 'history.tpl', 140, false),array('modifier', 'date_format', 'history.tpl', 142, false),)), $this); ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Minutes of Meeting</title>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=9" />
		<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
		<link rel="stylesheet" href="css/all.css">
		<link rel="stylesheet" href="css/controlpanel.css">
		<script src="js/jquery-1.12.4.js"></script>
		<script src="js/jquery-ui.js"></script>
		<script src="js/canvasjs.min.js"></script>
		<script src="js/jquery.canvasjs.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/jquery-ui.css">
		  <?php echo '
<script>
function displaypanel(val)
{
	var num = val;
	//alert(num);
	if(num == 2)
	{
		document.getElementById("meeting-wise").style.display="none";
		$("#meeting").removeClass("active");
	    document.getElementById("day-wise").style.display="block";
		$("#day").addClass("active");
	    document.getElementById("dept-wise").style.display="none";
		$("#dept").removeClass("active");
	
	}else if(num == 3){
		document.getElementById("meeting-wise").style.display="none";
		$("#meeting").removeClass("active");
	    document.getElementById("day-wise").style.display="none";
		$("#day").removeClass("active");
	    document.getElementById("dept-wise").style.display="block";
		$("#dept").addClass("active");
	}else{
		
		document.getElementById("meeting-wise").style.display="block";
		$("#meeting").addClass("active");
		document.getElementById("day-wise").style.display="none";
		$("#day").removeClass("active");
		document.getElementById("dept-wise").style.display="none";
		$("#dept").removeClass("active");
	}
}
function test()
{
	//alert("");
	document.getElementById("Name").value="";
	document.getElementById("Date").value="";
	document.getElementById("ActionStatus").value="";
	
	document.forms["history"].submit();

}
</script>
 '; ?>

	</head>
	 
<!--Design Prepared by Rajasri Systems-->   
<body>
<div id="wrapper">
	
	<div style="clear:both;"></div>
 <div id="middle"> 
	<div id="center-column">
		<div class="top-bar-header">
		  <h1>Control Panel</h1>
		  <div class="breadcrumbs">Homepage</div>
		</div>
		<br/>
		
	    <div class="manage-grid">
		 <div>
			<ul class="task-menu">
			<li><a href="add_meeting.php" >Create Task</a></li> 
			<li><a href="controlPanel.php?div=2">Meeting Wise</a></li> 
			<li><a href="controlPanel.php?div=3" >Day Wise</a></li> 
			<li><a href="controlPanel.php?div=4" >Department Wise</a></li>  
			<li><a href="history.php" class="active">History</a></li>
		</ul>
		    <div class="clear"></div>
		 </div>
		 
		
		 <div style="margin-bottom:15px;">
		 <form name="history" action="" method="post" >
		
		    <input type="text" class="input-date" id="Name" name="Name"  value="<?php echo $_REQUEST['Name']; ?>
" placeholder="Meeting Name" style="background-color: #ffffff;">
			<input type="text" class="input-date" id="Date" name="Date"  value="<?php echo $_REQUEST['Date']; ?>
" placeholder="Meeting Date" style="background-color: #ffffff;">
			<td><select name="ActionStatus" id="ActionStatus" style="width: 150px; height:30px; border-radius: 5px;">
													<option value="">Status</option>
													<option value="Completed" <?php if ($_REQUEST['ActionStatus'] == 'Completed'): ?> selected="selected" <?php endif; ?>>Completed</option>
													<option value="Postpone" <?php if ($_REQUEST['ActionStatus'] == 'Postpone'): ?> selected="selected" <?php endif; ?>>Postpone</option>
													<option value="On Hold" <?php if ($_REQUEST['ActionStatus'] == 'On Hold'): ?> selected="selected" <?php endif; ?>>On Hold</option>
													<option value="Re Scheduled" <?php if ($_REQUEST['ActionStatus'] == 'Re Scheduled'): ?> selected="selected" <?php endif; ?>>Re Scheduled</option>
													<option value="Cancelled" <?php if ($_REQUEST['ActionStatus'] == 'Cancelled'): ?> selected="selected" <?php endif; ?>>Cancelled</option>
													<option value="Follow Up" <?php if ($_REQUEST['ActionStatus'] == 'Follow Up'): ?> selected="selected" <?php endif; ?>>Follow Up</option>
											</select>
											</td>
			<!--<input type="text" class="input-date" id="dp3" value="">
			<input type="text" class="input-date" id="dp4" value="">
			<input type="text" class="input-date" id="dp5" value="">
			<input type="text" class="input-date" id="dp6" value="">
			<input type="text" class="input-date" id="dp7" value="Target Date">-->
			
			<input type="submit" id="submit-btn" name="submit-btn" class="input-date submit-btn1"  value="Submit">
			<input type="button" class="input-date submit-btn1"  onclick="test();" value="Reset Search">
			</form>
			
			
		 </div>
		 
		 
		<div class="history-detail-div" style="width:100%">
		 <table class="history-table">
		  <thead>
			<tr>
				<th>Meeting Name</th>
				<th>Meeting Date</th>
				<th>Target Date</th>
				<th>IN Time Completion</th>
				<th>No of revision</th>
				<th>Delayed Days</th>
				<th>Status</th>
			<tr>
		  </thead>
		  <tbody>
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
				
				
				
				<td class="first style1" valign="top"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['meet'][$this->_sections['D']['index']]['MeetingName'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)))) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
 </td>
				
				<td class="first style1" valign="top"><?php echo ((is_array($_tmp=$this->_tpl_vars['meet'][$this->_sections['D']['index']]['MeetingDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%b %d, %Y") : smarty_modifier_date_format($_tmp, "%b %d, %Y")); ?>
 </td>
				<td class="first style1" valign="top"><?php echo ((is_array($_tmp=$this->_tpl_vars['meet'][$this->_sections['D']['index']]['Target_Date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%b %d, %Y") : smarty_modifier_date_format($_tmp, "%b %d, %Y")); ?>
 </td>
				<td class="first style1" valign="top"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['meet'][$this->_sections['D']['index']]['In_Time_Completion'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)))) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
</td>
				<td class="first style1" valign="top"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['meet'][$this->_sections['D']['index']]['No_Of_Revision'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)))) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
</td>
				<td class="first style1" valign="top"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['meet'][$this->_sections['D']['index']]['Delayed_Days'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)))) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
</td>
				
				<td class="first style1" valign="top"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['meet'][$this->_sections['D']['index']]['ActionStatus'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)))) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
 </td>
				
			
			
			<?php $this->assign('meetingId', $this->_tpl_vars['meet'][$this->_sections['D']['index']]['Id']); ?>
			</tr>
				 <?php endfor; else: ?>
			 <tr class="<?php echo $this->_tpl_vars['classname']; ?>
">
			 
			 
				<td align="center" colspan="8" class="style1"><center>No datas found</center></td>
			 </tr>
				 <?php endif; ?>
				 <?php else: ?>
			 <tr class="<?php echo $this->_tpl_vars['classname']; ?>
">
				<td align="center" colspan="8" class="style1"><center>No datas found</center></td>
			 </tr>
				 <?php endif; ?>
			</tr>
		  </tbody>
		</table>
		</div>
		 
		 
		</div>
	     <div class="clear"></div>
   </div>
   </div>
   
	<div class="clear"></div>
  </div>
  
 
	<?php echo '		
<script>
/*$(function() {
    $( "#dp" ).datepicker();
});*/
$(function() {
    $( "#Date" ).datepicker({
		buttonImage: \'img/calendar_icon_1.png\',
        buttonImageOnly: true,
        changeMonth: true,
        changeYear: true,
        showOn: \'both\'
		});
});
/*$(function() {
    $( "#dp3" ).datepicker();
});
$(function() {
    $( "#dp4" ).datepicker();
});
$(function() {
    $( "#dp5" ).datepicker();
});
$(function() {
    $( "#dp6" ).datepicker();
});
$(function() {
    $( "#dp7" ).datepicker();
});*/
</script>
 <!--  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.js"></script>
 <script type="text/javascript">
		$("#dp1").datepicker({
		buttonImage: \'img/calendar_icon_1.png\',
        buttonImageOnly: true,
        changeMonth: true,
        changeYear: true,
        showOn: \'both\',
	    });
	 
	 $("#dp2").datepicker({
		buttonImage: \'img/calendar_icon_1.png\',
        buttonImageOnly: true,
        changeMonth: true,
        changeYear: true,
        showOn: \'both\',
		});
	
</script> --> 
'; ?>


</body>
</html>