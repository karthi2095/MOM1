<?php
/*	Class Function for Admin	*/

class ManageScore extends MysqlFns
{
	function ManageScore()
	{
		global $config;
        $this->MysqlFns();
		$this->Offset			= 0;
		$this->Limit			= 10;
		$this->page				= 0;
		$this->Keyword			= '';
		$this->Operator			= '';
		$this->PerPage			= '';
	}
	
function addchampion(){
		global $objSmarty,$config;
	
		
		$delQry="DELETE FROM `tbl_champion` WHERE User_Id='".addslashes($_SESSION['Id'])."'";
		$this->ExecuteQuery($delQry,"delete");	
		
		$QB=$_REQUEST['QB'];
			if($QB != '')
				{
				for($i=0;$i<count($QB);$i++){
					
					$InsQuery="INSERT INTO `tbl_champion` (
												`Player`,
												`User_Id`,
												`Position`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".$QB[$i]."',
												 '".$_SESSION['Id']."',
												 'QB',
												 '1',
												 now())";
				$this->ExecuteQuery($InsQuery, "insert");
				}
				}
		
		$RB=$_REQUEST['RB'];
			if($RB != '')
				{
				for($i=0;$i<count($RB);$i++){
					
					 $InsQuery="INSERT INTO `tbl_champion` (
												`Player`,
												`User_Id`,
												`Position`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".$RB[$i]."',
												 '".$_SESSION['Id']."',
												 'RB',
												 '1',
												 now())";
				$this->ExecuteQuery($InsQuery, "insert");
				}
				}
		$WR=$_REQUEST['WR'];
			if($WR != '')
				{
				for($i=0;$i<count($WR);$i++){
					
					 $InsQuery="INSERT INTO `tbl_champion` (
												`Player`,
												`User_Id`,
												`Position`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".$WR[$i]."',
												 '".$_SESSION['Id']."',
												 'WR',
												 '1',
												 now())";
				$this->ExecuteQuery($InsQuery, "insert");
				}
				}
		$TE=$_REQUEST['TE'];
			if($TE != '')
				{
				for($i=0;$i<count($TE);$i++){
					
					 $InsQuery="INSERT INTO `tbl_champion` (
												`Player`,
												`User_Id`,
												`Position`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".$TE[$i]."',
												 '".$_SESSION['Id']."',
												 'TE',
												 '1',
												 now())";
				$this->ExecuteQuery($InsQuery, "insert");
				}
				}
		$K=$_REQUEST['K'];
			if($K != '')
				{
				for($i=0;$i<count($K);$i++){
					
					 $InsQuery="INSERT INTO `tbl_champion` (
												`Player`,
												`User_Id`,
												`Position`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".$K[$i]."',
												 '".$_SESSION['Id']."',
												 'K',
												 '1',
												 now())";
				$this->ExecuteQuery($InsQuery, "insert");
				}
				}
		$D=$_REQUEST['D'];
			if($D != '')
				{
				for($i=0;$i<count($D);$i++){
					
					 $InsQuery="INSERT INTO `tbl_champion` (
												`Player`,
												`User_Id`,
												`Position`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".$D[$i]."',
												 '".$_SESSION['Id']."',
												 'D',
												 '1',
												 now())";
				$this->ExecuteQuery($InsQuery, "insert");
				}
				}
		$ST=$_REQUEST['ST'];
			if($ST != '')
				{
				for($i=0;$i<count($ST);$i++){
					
					 $InsQuery="INSERT INTO `tbl_champion` (
												`Player`,
												`User_Id`,
												`Position`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".$ST[$i]."',
												 '".$_SESSION['Id']."',
												 'ST',
												 '1',
												 now())";
				$this->ExecuteQuery($InsQuery, "insert");
				}
				}
				
		header('location:wildcard_selection.php?table=champion');
		
	}
	
	
	
function adddivisional(){
		global $objSmarty,$config;
	
		
		$delQry="DELETE FROM `tbl_divisional` WHERE User_Id='".addslashes($_SESSION['Id'])."'";
		$this->ExecuteQuery($delQry,"delete");	
		
		$QB=$_REQUEST['QB'];
			if($QB != '')
				{
				for($i=0;$i<count($QB);$i++){
					
					$InsQuery="INSERT INTO `tbl_divisional` (
												`Player`,
												`User_Id`,
												`Position`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".$QB[$i]."',
												 '".$_SESSION['Id']."',
												 'QB',
												 '1',
												 now())";
				$this->ExecuteQuery($InsQuery, "insert");
				}
				}
		
		$RB=$_REQUEST['RB'];
			if($RB != '')
				{
				for($i=0;$i<count($RB);$i++){
					
					 $InsQuery="INSERT INTO `tbl_divisional` (
												`Player`,
												`User_Id`,
												`Position`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".$RB[$i]."',
												 '".$_SESSION['Id']."',
												 'RB',
												 '1',
												 now())";
				$this->ExecuteQuery($InsQuery, "insert");
				}
				}
		$WR=$_REQUEST['WR'];
			if($WR != '')
				{
				for($i=0;$i<count($WR);$i++){
					
					 $InsQuery="INSERT INTO `tbl_divisional` (
												`Player`,
												`User_Id`,
												`Position`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".$WR[$i]."',
												 '".$_SESSION['Id']."',
												 'WR',
												 '1',
												 now())";
				$this->ExecuteQuery($InsQuery, "insert");
				}
				}
		$TE=$_REQUEST['TE'];
			if($TE != '')
				{
				for($i=0;$i<count($TE);$i++){
					
					 $InsQuery="INSERT INTO `tbl_divisional` (
												`Player`,
												`User_Id`,
												`Position`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".$TE[$i]."',
												 '".$_SESSION['Id']."',
												 'TE',
												 '1',
												 now())";
				$this->ExecuteQuery($InsQuery, "insert");
				}
				}
		$K=$_REQUEST['K'];
			if($K != '')
				{
				for($i=0;$i<count($K);$i++){
					
					 $InsQuery="INSERT INTO `tbl_divisional` (
												`Player`,
												`User_Id`,
												`Position`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".$K[$i]."',
												 '".$_SESSION['Id']."',
												 'K',
												 '1',
												 now())";
				$this->ExecuteQuery($InsQuery, "insert");
				}
				}
		$D=$_REQUEST['D'];
			if($D != '')
				{
				for($i=0;$i<count($D);$i++){
					
					 $InsQuery="INSERT INTO `tbl_divisional` (
												`Player`,
												`User_Id`,
												`Position`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".$D[$i]."',
												 '".$_SESSION['Id']."',
												 'D',
												 '1',
												 now())";
				$this->ExecuteQuery($InsQuery, "insert");
				}
				}
		$ST=$_REQUEST['ST'];
			if($ST != '')
				{
				for($i=0;$i<count($ST);$i++){
					
					 $InsQuery="INSERT INTO `tbl_divisional` (
												`Player`,
												`User_Id`,
												`Position`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".$ST[$i]."',
												 '".$_SESSION['Id']."',
												 'ST',
												 '1',
												 now())";
				$this->ExecuteQuery($InsQuery, "insert");
				}
				}
				
		header('location:wildcard_selection.php?table=divisional');
		
	}




	
}
?>