<?php 
	include "../includes/common.php";
    include_once $config['SiteClassPath']."class.ManageUser.php";
    $objUser	= new ManageUser();
	 $SelQuery	= "SELECT * FROM `cities`"
		              ." WHERE state_id='".addslashes($_REQUEST['state'])."' order by name asc";
	$res=mysql_query($SelQuery);
	$count=mysql_num_rows($res); 
	
?>
<select name="city" id="city" class="select-value editable" style="width: 262px;" onchange="showOther(this.value);" >
<option value="0">Select</option>
<?php 
if($count!='0')
{
while($view=mysql_fetch_array($res))
{
?>
<option value="<?php echo $view['id'];?>"><?php echo $view['name'];?></option>
<?php 
} 
}?>
<!--
<option value="others">Others</option>
</select>&nbsp;&nbsp;
<span id="otherCity" style="display:none;"> 
<input type="text" name="newCity" id="newCity" value="" class="input-value editable"> </span> -->