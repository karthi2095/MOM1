<?php 
	include "../includes/common.php";
	include_once $config['SiteClassPath']."class.ManageCategory.php";
	$objCategory	= new ManageCategory();
	
	$SelQuery	= "SELECT * FROM `tbl_player`"
		              ." WHERE Team='".addslashes($_REQUEST['Team'])."' order by Id asc";
	$res=mysql_query($SelQuery);
	$count=mysql_num_rows($res); 
	
?>

<?php 

?>
<select name="Player" id="Player" class="select-value editable" >


<option value="0">Select</option>
<?php 
if($count!='0')
{
while($view=mysql_fetch_array($res))
{
?>
<option value="<?php echo $view['Id'];?>"><?php echo $view['Player_name'];?></option>
<?php 
} 
}?>
