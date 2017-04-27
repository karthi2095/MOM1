<?php 
	include "../includes/common.php";
	include_once $config['SiteClassPath']."class.ManageCategory.php";
	$objCategory	= new ManageCategory();
	
	$SelQuery	= "SELECT * FROM `tbl_league`"
		              ." WHERE Id!='".addslashes($_REQUEST['Team'])."' order by Id asc";
	$res=mysql_query($SelQuery);
	$count=mysql_num_rows($res); 
	
?>
<select name="Opponent" id="Opponent" class="select-value editable" style="width: 102px;" >
<option value="0">Select</option>
<?php 
if($count!='0')
{
while($view=mysql_fetch_array($res))
{
?>
<option value="<?php echo $view['Id'];?>"><?php echo $view['League'];?></option>
<?php 
} 
}?>
