<?php 
	include "../includes/common.php";
    include_once $config['SiteClassPath']."class.ManageUser.php";
    $objUser	= new ManageUser();
	$SelQuery	= "SELECT * FROM `states`"
		              ." WHERE country_id = '".addslashes($_REQUEST['country'])."' order by name asc";
	$res=mysql_query($SelQuery);
	$count=mysql_num_rows($res); 
	
?>
 <select name="state" id="state" class="select-value editable" onchange="getCity(this.value);" >
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
</select>