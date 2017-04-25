<?php 
/*   Global Variables   */

##############################

	$config['SiteGlobalPath']				= "http://srinode41/mom";

	$config['SiteLocalPath']				= $_SERVER['DOCUMENT_ROOT']."/mom/";

	$config['SiteClassPath']				= $_SERVER['DOCUMENT_ROOT']."/mom/includes/classes/";

	$config['SiteTemplatesPath']			= $config['SiteLocalPath']."templates/";

	$config['SiteTemplatesHeader']			= $config['SiteTemplatesPath']."header.tpl";

	$config['SiteTemplatesFooter']			= $config['SiteTemplatesPath']."footer.tpl";

 
/*   Global Site Variables   */

##############################

	$config['SiteTitle']	  	= "Mom";

	$config['SiteMail']			= "";

	$config['AdminMail']		= "";

/*local	Database Settings	*/

##############################



	$config['DBHostName']	= "localhost";

	$config['DBUserName']	= "root";

	$config['DBPassword']	= "";

	$config['DBName']		= "mom";
	
	

/*	Page Navigation Settings	*/

##############################

	$config['Limit'] = 20;	

/* Setting some necessary values Here */

	#######################################

	$config['today']=date('Y-m-d');
	
	$config['HoursInGMT'] = "-6";
	$config['MinutesInGMT'] = "0";

/* Setting some necessary values Here */
	
	#######################################
?>