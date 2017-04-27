<?php 
	include "../includes/common.php";
	include_once $config['SiteClassPath']."class.ManageCategory.php";
	$objCategory	= new ManageCategory();
	if($_REQUEST['Position'] == 'QB' || $_REQUEST['Position'] == 'K' || $_REQUEST['Position'] == 'D' || $_REQUEST['Position'] == 'ST' )
	{
	 $SelQuery	= "SELECT * FROM `tbl_team`"
		              ." WHERE Position !='RB' and Position !='TE' and Position !='WR' order by Id asc";
	}
	else 
	{
	$SelQuery	= "SELECT * FROM `tbl_team`"
		              ." WHERE Position='".addslashes($_REQUEST['Position'])."' order by Id asc";
	}
	$res=mysql_query($SelQuery);
	$count=mysql_num_rows($res); 
	
?>
<?php  

?>
<select  name="Nfl_Team" id="Nfl_Team" class="select-value editable" onchange=" getPlayer(this.value);" >

<option value="0">Select</option>
<?php 
if($count!='0')
{
while($view=mysql_fetch_array($res))
{
?>
<option value="<?php echo $view['Id'];?>"><?php echo $view['Team'];?></option>
<?php 
} 
}?>
