<?php
/*	Class Function for Admin	*/

class ManageLocation extends MysqlFns
{
	function ManageLocation()
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
	
	function getCountry(){
		global $objSmarty;
		 $selQuery="select name as countryName,code from cmn_country_mst order by name asc";
		$res=$this->ExecuteQuery($selQuery, "select");
		$objSmarty->assign("country",$res);
	}
	
	function getStateByCountry($coun){
		global $objSmarty;
		$selQuery="select * from cmn_state_mst where country='$coun'  order by name asc";
		$res=$this->ExecuteQuery($selQuery, "select");
		$objSmarty->assign("state",$res);
	}
	
	function getCityByState($state){
		global $objSmarty;
		 $selQuery="select * from cmn_district_mst where stateId='$state' and deleted='0' order by name asc";
		$res=$this->ExecuteQuery($selQuery, "select");
		$objSmarty->assign("city",$res);
	}
	
	function getCityName($id){
		
		global $objSmarty;
		/*$selQuery="select * from cmn_district_mst where id='$id' limit 1";
		$res=$this->ExecuteQuery($selQuery, "select");
		$stateId=$res[0]['stateId'];
		$objSmarty->assign("city",$res[0]['name']);
		
		$selQuery="select * from cmn_state_mst where id='$stateId' limit 1";
		$res=$this->ExecuteQuery($selQuery, "select");
		$countryCode = $res[0]['country'];
		$objSmarty->assign("state",$res[0]['name']);
		
		$selQuery="select * from cmn_country_mst where code='$countryCode' limit 1";
		$res=$this->ExecuteQuery($selQuery, "select");
		$objSmarty->assign("country1",$res[0]['name']);
		$objSmarty->assign("countrycode",$res[0]['code']);*/
		$select="select * from tbl_user where `UserId` = '".$_SESSION['userId']."'";
		$exeselect=$this->ExecuteQuery($select, "select");
		$countryCode = $exeselect[0]['Country'];
		$objSmarty->assign("countrycode",$countryCode);
		$sel="select * from  cmn_country_mst where `code` = '".$countryCode."'";
		$exesel=$this->ExecuteQuery($sel,"select");
		$country = $exesel[0]['name'];
				$objSmarty->assign("country1",$country);
		
	}

	function getCityNames($id){
		global $objSmarty;
		$selQuery="select * from cmn_district_mst where id='$id' limit 1";
		$res=$this->ExecuteQuery($selQuery, "select");
		$stateId=$res[0]['stateId'];
		$objSmarty->assign("city",$res[0]['name']);
		
		$selQuery="select * from cmn_state_mst where id='$stateId' limit 1";
		$res=$this->ExecuteQuery($selQuery, "select");
		$countryCode = $res[0]['country'];
		$objSmarty->assign("state",$res[0]['name']);
		
		$selQuery="select * from cmn_country_mst where code='$countryCode' limit 1";
		$res=$this->ExecuteQuery($selQuery, "select");
		$objSmarty->assign("countryName",$res[0]['name']);
		
	}
	
	function getCountryName($id)
	{
		global $objSmarty;
		$selqry="select * from  cmn_country_mst where code='$id'";
		$res=$this->ExecuteQuery($selqry,"select");
		return $res[0]['name'];
	
	}
	function getStateforuserid($id)
	{
		global $objSmarty;
		$selqry="select * from cmn_state_mst where id='$id'";
		$res=$this->ExecuteQuery($selqry,"select");
		$state=$res[0]['name'];
		echo $state;
	}
	function getCityforuserid($id)
	{
		global $objSmarty;
		$selqry="select * from cmn_district_mst where id='$id'";
		$res=$this->ExecuteQuery($selqry,"select");
		$city=$res[0]['name'];
		echo $city;
	}
	function manage_Breakdown(){
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['keyword']!="" && $_REQUEST['keyword']!="FirstName" )
		$where_condition.="and ((`League` like '%".trim(addslashes($_REQUEST['keyword']))."%' ))";
			
		$where_condition1='';
		if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition1.=" order by Id asc";
			if($_REQUEST['flag']=="2")
			$where_condition1.=" order by Id desc";
			
			
		}else{
			$where_condition1.=" order by `Id` desc";
		}

		$SelQuery	= "select * from `tbl_breakdown` where
         					 Id!=''
         					 $where_condition $where_condition1";
         					 if(isset($_REQUEST['page']) && $_REQUEST['page'] >1)
         					 $i= ($this->Limit * $_REQUEST['page'] )-$this->Limit +1;
         					 else
         					 $i=1;
         					 $objSmarty->assign("i",$i);

         					 $listing_split = new MsplitPageResults($SelQuery, $this->Limit);
         					 if ( ($listing_split->number_of_rows > 0) )
         					 {
         					 	$pagenos=round($listing_split->number_of_rows/$this->Limit);
         					 	$rem=($listing_split->number_of_rows%$this->Limit);
         					 	if($rem>0 && $rem <5 ){

         					 		$pagenos=$pagenos+1;
         					 	}
         					 	if($_REQUEST['page']!="")
         					 	{
         					 		if($_REQUEST['page']-$pagenos>0)
         					 		{

         					 			$pagenos=$_REQUEST['page']-1;
         					 			$i= ($this->Limit * $pagenos )-$this->Limit +1;
         					 			$objSmarty->assign("i",$i);
         					 			$objSmarty->assign("pageno",$pagenos);
         					 		}
         					 		if($this->Limit==$listing_split->number_of_rows)
         					 		{
         					 			$objSmarty->assign("i",1);
         					 		}
         					 	}
         					 	$objSmarty->assign("LinkPage",$listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_RESULT));
         					 	$objSmarty->assign("PerPageNavigation",TEXT_RESULT_PAGE1 . ' ' . $listing_split->display_links($this->Limit, get_all_get_params(array('page', 'info', 'x', 'y'))));
         					 }

         					 if ($listing_split->number_of_rows > 0)
         					 {
         					 	$rows = 0;
         					 	$Res_Tickets	= $this->ExecuteQuery($listing_split->sql_query, "select");
         					 }

         					 if(!empty($Res_Tickets)&& is_array($Res_Tickets))
         					 $objSmarty->assign("CatsList",$Res_Tickets);
	}	
function addBreakdown(){
		global $objSmarty,$config;
		
		$selQueryemail="select * from  tbl_breakdown where Team='".addslashes($_REQUEST['Team'])."' and Opponent='".addslashes($_REQUEST['Opponent'])."'"; //or `Username`='".$_REQUEST['username']."'";
		$count=$this->ExecuteQuery($selQueryemail, "norows");
		if($count==0){
			
			$proceed="Yes";
			if($proceed=="Yes"){
				// $exa=explode(" ",$_REQUEST['Game_Time']);
				// echo $exa[0];		 
				// echo $exa[1];exit;		 
				  $InsQuery="INSERT INTO `tbl_breakdown` (
												`Team`,
												`Opponent`,
												`Played`,
												`Played1`,
												`Played2`,
												`All`,
												`All1`,
												`All2`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".addslashes($_REQUEST['Team'])."',
												 '".addslashes($_REQUEST['Opponent'])."',
												 '".addslashes($_REQUEST['Played'])."',
												 '".addslashes($_REQUEST['Played1'])."',
												 '".addslashes($_REQUEST['Played2'])."',
												 '".addslashes($_REQUEST['All'])."',
												 '".addslashes($_REQUEST['All1'])."',
												 '".addslashes($_REQUEST['All2'])."',
												 '1',
												 now())"; 
				$this->ExecuteQuery($InsQuery, "insert");
				$word='';
				$objSmarty->assign("User","");
				$objSmarty->assign("SuccessMessage","Breakdown details has been added successfully");
			}
		}
		else {
			$objSmarty->assign("ErrorMessage","Breakdown details already exist");
				$objSmarty->assign("User", $_REQUEST);
		}
		
		
	}
function addOwners(){
		global $objSmarty,$config;
		
		$selQueryemail="select * from  tbl_owner where Team='".addslashes($_REQUEST['Team'])."' and Opponent='".addslashes($_REQUEST['Opponent'])."'"; //or `Username`='".$_REQUEST['username']."'";
		$count=$this->ExecuteQuery($selQueryemail, "norows");
		if($count==0){
			
			$proceed="Yes";
			if($proceed=="Yes"){
				// $exa=explode(" ",$_REQUEST['Game_Time']);
				// echo $exa[0];		 
				// echo $exa[1];exit;		 
				  $InsQuery="INSERT INTO `tbl_owner` (
												`Team`,
												`Opponent`,
												`Played`,
												`Played1`,
												`Played2`,
												`All`,
												`All1`,
												`All2`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".addslashes($_REQUEST['Team'])."',
												 '".addslashes($_REQUEST['Opponent'])."',
												 '".addslashes($_REQUEST['Played'])."',
												 '".addslashes($_REQUEST['Played1'])."',
												 '".addslashes($_REQUEST['Played2'])."',
												 '".addslashes($_REQUEST['All'])."',
												 '".addslashes($_REQUEST['All1'])."',
												 '".addslashes($_REQUEST['All2'])."',
												 '1',
												 now())"; 
				$this->ExecuteQuery($InsQuery, "insert");
				$word='';
				$objSmarty->assign("User","");
				$objSmarty->assign("SuccessMessage","Owner details has been added successfully");
			}
		}
		else {
			$objSmarty->assign("ErrorMessage","Owner details already exist");
				$objSmarty->assign("User", $_REQUEST);
		}
		
		
	}

	
function updateBreakdownbyId(){
		global $objSmarty;
		$selQuery="select * from tbl_breakdown where Team='".addslashes($_REQUEST['Team'])."' and 
		 Opponent='".addslashes($_REQUEST['Opponent'])."' and Id!='".$_REQUEST['CatIdent']."'";
		$count=$this->ExecuteQuery($selQuery, "norows");
		if(!$count){
			$proceed="Yes";
 			
			if($proceed=="Yes"){
				 
				$upQuery="update tbl_breakdown set `Team`='".addslashes($_REQUEST['Team'])."',
												`Opponent`='".addslashes($_REQUEST['Opponent'])."',
												`Played`='".addslashes($_REQUEST['Played'])."',
												`Played1`='".addslashes($_REQUEST['Played1'])."',
												`Played2`='".addslashes($_REQUEST['Played2'])."',
												`All`='".addslashes($_REQUEST['All'])."',
												`All1`='".addslashes($_REQUEST['All1'])."',
												`All2`='".addslashes($_REQUEST['All2'])."',
												`Updated_Date`=now()
												where Id='".$_REQUEST['CatIdent']."'";
				$this->ExecuteQuery($upQuery, "update");

				$objSmarty->assign("SuccessMessage","Breakdown details has been updated successfully");
			}
		}else{
			$objSmarty->assign("ErrorMessage","Breakdown details already exist");
		}
	}
	
function getBreakdownById()
	{
		global $objSmarty;

		$SelQuery	= "SELECT * from `tbl_breakdown` where `Id` = '".$_REQUEST['CatIdent']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("User",$ExeSelQuery);

	}
	
function manage_owners(){
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['keyword']!="" && $_REQUEST['keyword']!="FirstName" )
		$where_condition.="and ((`Team` like '%".trim(addslashes($_REQUEST['keyword']))."%' ))";

		
			
		$where_condition1='';
		if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition1.=" order by Team asc";
			if($_REQUEST['flag']=="2")
			$where_condition1.=" order by Team desc";
			
			
		}else{
			$where_condition1.=" order by `Id` desc";
		}

		$SelQuery	= "select * from `tbl_owner` where
         					 Id!=''
         					 $where_condition $where_condition1";
         					 if(isset($_REQUEST['page']) && $_REQUEST['page'] >1)
         					 $i= ($this->Limit * $_REQUEST['page'] )-$this->Limit +1;
         					 else
         					 $i=1;
         					 $objSmarty->assign("i",$i);

         					 $listing_split = new MsplitPageResults($SelQuery, $this->Limit);
         					 if ( ($listing_split->number_of_rows > 0) )
         					 {
         					 	$pagenos=round($listing_split->number_of_rows/$this->Limit);
         					 	$rem=($listing_split->number_of_rows%$this->Limit);
         					 	if($rem>0 && $rem <5 ){

         					 		$pagenos=$pagenos+1;
         					 	}
         					 	if($_REQUEST['page']!="")
         					 	{
         					 		if($_REQUEST['page']-$pagenos>0)
         					 		{

         					 			$pagenos=$_REQUEST['page']-1;
         					 			$i= ($this->Limit * $pagenos )-$this->Limit +1;
         					 			$objSmarty->assign("i",$i);
         					 			$objSmarty->assign("pageno",$pagenos);
         					 		}
         					 		if($this->Limit==$listing_split->number_of_rows)
         					 		{
         					 			$objSmarty->assign("i",1);
         					 		}
         					 	}
         					 	$objSmarty->assign("LinkPage",$listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_RESULT));
         					 	$objSmarty->assign("PerPageNavigation",TEXT_RESULT_PAGE1 . ' ' . $listing_split->display_links($this->Limit, get_all_get_params(array('page', 'info', 'x', 'y'))));
         					 }

         					 if ($listing_split->number_of_rows > 0)
         					 {
         					 	$rows = 0;
         					 	$Res_Tickets	= $this->ExecuteQuery($listing_split->sql_query, "select");
         					 }

         					 if(!empty($Res_Tickets)&& is_array($Res_Tickets))
         					 $objSmarty->assign("CatsList",$Res_Tickets);
	}	
function manage_division(){
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['keyword']!="" && $_REQUEST['keyword']!="FirstName" )
		$where_condition.="and ((`Team` like '%".trim(addslashes($_REQUEST['keyword']))."%' ))";

		
			
		$where_condition1='';
		if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition1.=" order by Team asc";
			if($_REQUEST['flag']=="2")
			$where_condition1.=" order by Team desc";
			
			
		}else{
			$where_condition1.=" order by `Id` desc";
		}

		$SelQuery	= "select * from `tbl_division` where
         					 Id!=''
         					 $where_condition $where_condition1";
         					 if(isset($_REQUEST['page']) && $_REQUEST['page'] >1)
         					 $i= ($this->Limit * $_REQUEST['page'] )-$this->Limit +1;
         					 else
         					 $i=1;
         					 $objSmarty->assign("i",$i);

         					 $listing_split = new MsplitPageResults($SelQuery, $this->Limit);
         					 if ( ($listing_split->number_of_rows > 0) )
         					 {
         					 	$pagenos=round($listing_split->number_of_rows/$this->Limit);
         					 	$rem=($listing_split->number_of_rows%$this->Limit);
         					 	if($rem>0 && $rem <5 ){

         					 		$pagenos=$pagenos+1;
         					 	}
         					 	if($_REQUEST['page']!="")
         					 	{
         					 		if($_REQUEST['page']-$pagenos>0)
         					 		{

         					 			$pagenos=$_REQUEST['page']-1;
         					 			$i= ($this->Limit * $pagenos )-$this->Limit +1;
         					 			$objSmarty->assign("i",$i);
         					 			$objSmarty->assign("pageno",$pagenos);
         					 		}
         					 		if($this->Limit==$listing_split->number_of_rows)
         					 		{
         					 			$objSmarty->assign("i",1);
         					 		}
         					 	}
         					 	$objSmarty->assign("LinkPage",$listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_RESULT));
         					 	$objSmarty->assign("PerPageNavigation",TEXT_RESULT_PAGE1 . ' ' . $listing_split->display_links($this->Limit, get_all_get_params(array('page', 'info', 'x', 'y'))));
         					 }

         					 if ($listing_split->number_of_rows > 0)
         					 {
         					 	$rows = 0;
         					 	$Res_Tickets	= $this->ExecuteQuery($listing_split->sql_query, "select");
         					 }

         					 if(!empty($Res_Tickets)&& is_array($Res_Tickets))
         					 $objSmarty->assign("CatsList",$Res_Tickets);
	}
function manage_score(){
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['keyword']!="" && $_REQUEST['keyword']!="FirstName" )
		$where_condition.="and ((p.Player_name like '%".trim(addslashes($_REQUEST['keyword']))."%' ))";

		
			
		$where_condition1='';
		if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition1.=" order by p.Player_name asc";
			if($_REQUEST['flag']=="2")
			$where_condition1.=" order by p.Player_name desc";
			
			
		}else{
			$where_condition1.=" order by s.Id desc";
		}

		$SelQuery	= "select *,p.Player_Name as Player_Name,s.Id as sId,s.Status as sStatus from `tbl_score` as s
		left join  tbl_player as p on s.Player = p.Id where
         					 s.Id!=''
         					 $where_condition $where_condition1";
         					 if(isset($_REQUEST['page']) && $_REQUEST['page'] >1)
         					 $i= ($this->Limit * $_REQUEST['page'] )-$this->Limit +1;
         					 else
         					 $i=1;
         					 $objSmarty->assign("i",$i);

         					 $listing_split = new MsplitPageResults($SelQuery, $this->Limit);
         					 if ( ($listing_split->number_of_rows > 0) )
         					 {
         					 	$pagenos=round($listing_split->number_of_rows/$this->Limit);
         					 	$rem=($listing_split->number_of_rows%$this->Limit);
         					 	if($rem>0 && $rem <5 ){

         					 		$pagenos=$pagenos+1;
         					 	}
         					 	if($_REQUEST['page']!="")
         					 	{
         					 		if($_REQUEST['page']-$pagenos>0)
         					 		{

         					 			$pagenos=$_REQUEST['page']-1;
         					 			$i= ($this->Limit * $pagenos )-$this->Limit +1;
         					 			$objSmarty->assign("i",$i);
         					 			$objSmarty->assign("pageno",$pagenos);
         					 		}
         					 		if($this->Limit==$listing_split->number_of_rows)
         					 		{
         					 			$objSmarty->assign("i",1);
         					 		}
         					 	}
         					 	$objSmarty->assign("LinkPage",$listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_RESULT));
         					 	$objSmarty->assign("PerPageNavigation",TEXT_RESULT_PAGE1 . ' ' . $listing_split->display_links($this->Limit, get_all_get_params(array('page', 'info', 'x', 'y'))));
         					 }

         					 if ($listing_split->number_of_rows > 0)
         					 {
         					 	$rows = 0;
         					 	$Res_Tickets	= $this->ExecuteQuery($listing_split->sql_query, "select");
         					 }

         					 if(!empty($Res_Tickets)&& is_array($Res_Tickets))
         					 $objSmarty->assign("CatsList",$Res_Tickets);
	}
function manage_wildcard(){
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['keyword']!="" && $_REQUEST['keyword']!="FirstName" )
		$where_condition.="and ((`Team` like '%".trim(addslashes($_REQUEST['keyword']))."%' ))";

		
			
		$where_condition1='';
		if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition1.=" order by Team asc";
			if($_REQUEST['flag']=="2")
			$where_condition1.=" order by Team desc";
			
			
		}else{
			$where_condition1.=" order by `Id` desc";
		}

		$SelQuery	= "select * from `tbl_player` where
         					 Id!=''
         					 $where_condition $where_condition1";
         					 if(isset($_REQUEST['page']) && $_REQUEST['page'] >1)
         					 $i= ($this->Limit * $_REQUEST['page'] )-$this->Limit +1;
         					 else
         					 $i=1;
         					 $objSmarty->assign("i",$i);

         					 $listing_split = new MsplitPageResults($SelQuery, $this->Limit);
         					 if ( ($listing_split->number_of_rows > 0) )
         					 {
         					 	$pagenos=round($listing_split->number_of_rows/$this->Limit);
         					 	$rem=($listing_split->number_of_rows%$this->Limit);
         					 	if($rem>0 && $rem <5 ){

         					 		$pagenos=$pagenos+1;
         					 	}
         					 	if($_REQUEST['page']!="")
         					 	{
         					 		if($_REQUEST['page']-$pagenos>0)
         					 		{

         					 			$pagenos=$_REQUEST['page']-1;
         					 			$i= ($this->Limit * $pagenos )-$this->Limit +1;
         					 			$objSmarty->assign("i",$i);
         					 			$objSmarty->assign("pageno",$pagenos);
         					 		}
         					 		if($this->Limit==$listing_split->number_of_rows)
         					 		{
         					 			$objSmarty->assign("i",1);
         					 		}
         					 	}
         					 	$objSmarty->assign("LinkPage",$listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_RESULT));
         					 	$objSmarty->assign("PerPageNavigation",TEXT_RESULT_PAGE1 . ' ' . $listing_split->display_links($this->Limit, get_all_get_params(array('page', 'info', 'x', 'y'))));
         					 }

         					 if ($listing_split->number_of_rows > 0)
         					 {
         					 	$rows = 0;
         					 	$Res_Tickets	= $this->ExecuteQuery($listing_split->sql_query, "select");
         					 }

         					 if(!empty($Res_Tickets)&& is_array($Res_Tickets))
         					 $objSmarty->assign("CatsList",$Res_Tickets);
	}
function addDivision(){
		global $objSmarty,$config;
		
		$selQueryemail="select * from  tbl_division where Team='".addslashes($_REQUEST['Team'])."'"; //or `Username`='".$_REQUEST['username']."'";
		$count=$this->ExecuteQuery($selQueryemail, "norows");
		if($count==0){
			
			$proceed="Yes";
			if($proceed=="Yes"){
				// $exa=explode(" ",$_REQUEST['Game_Time']);
				// echo $exa[0];		 
				// echo $exa[1];exit;		 
				  $InsQuery="INSERT INTO `tbl_division` (
												`Team`,
												`Division`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".addslashes($_REQUEST['Team'])."',
												 '".addslashes($_REQUEST['Division'])."',
												 '1',
												 now())"; 
				$this->ExecuteQuery($InsQuery, "insert");
				$word='';
				$objSmarty->assign("User","");
				$objSmarty->assign("SuccessMessage","Division details has been added successfully");
			}
		}
		else {
			$objSmarty->assign("ErrorMessage","Division details already exist");
				$objSmarty->assign("User", $_REQUEST);
		}
		
		
	}	
function getDivisionById()
	{
		global $objSmarty;

		$SelQuery	= "SELECT * from `tbl_division` where `Id` = '".$_REQUEST['CatIdent']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("User",$ExeSelQuery);

	}
function getScoreByIdRb()
	{
		global $objSmarty;

		$SelQuery	= "SELECT * from `tbl_score_rb` where `Score_Id` = '".$_REQUEST['CatIdent']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("Runback",$ExeSelQuery);
		$Id = $ExeSelQuery[0]['Id'];
		
		
		$SelQuery	= "SELECT * from `tbl_touch_down` where `Score_Id` = '".$_REQUEST['CatIdent']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("TouchDownRb",$ExeSelQuery);
		$resultCnt=$this->ExecuteQuery($SelQuery, "norows");
		$objSmarty->assign("resultCntRb",$resultCnt);
		
		$SelQuery	= "SELECT * from `tbl_td_rush` where `Score_Id` = '".$_REQUEST['CatIdent']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("TouchDownRbRush",$ExeSelQuery);
		$resultCnt=$this->ExecuteQuery($SelQuery, "norows");
		$objSmarty->assign("CntRbRush",$resultCnt);
		
		$SelQuery	= "SELECT * from `tbl_td_rec` where `Score_Id` = '".$_REQUEST['CatIdent']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("TouchDownRbRec",$ExeSelQuery);
		$resultCnt=$this->ExecuteQuery($SelQuery, "norows");
		$objSmarty->assign("CntRbRec",$resultCnt);
	}	
	
function getScoreByIdWr()
	{
		global $objSmarty;

		$SelQuery	= "SELECT * from `tbl_score_wr` where `Score_Id` = '".$_REQUEST['CatIdent']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("Widerec",$ExeSelQuery);
		$Id = $ExeSelQuery[0]['Id'];
		
		
		$Id = $ExeSelQuery[0]['Id'];
		
		
		$SelQuery	= "SELECT * from `tbl_touch_down` where `Score_Id` = '".$_REQUEST['CatIdent']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("TouchDownWr",$ExeSelQuery);
		$resultCnt=$this->ExecuteQuery($SelQuery, "norows");
		$objSmarty->assign("resultCntWr",$resultCnt);
		
		$SelQuery	= "SELECT * from `tbl_td_rush` where `Score_Id` = '".$_REQUEST['CatIdent']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("TouchDownWrRush",$ExeSelQuery);
		$resultCnt=$this->ExecuteQuery($SelQuery, "norows");
		$objSmarty->assign("CntWrRush",$resultCnt);
		
		$SelQuery	= "SELECT * from `tbl_td_rec` where `Score_Id` = '".$_REQUEST['CatIdent']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("TouchDownWrRec",$ExeSelQuery);
		$resultCnt=$this->ExecuteQuery($SelQuery, "norows");
		$objSmarty->assign("CntWrRec",$resultCnt);

	}	
function getScoreByIdTe()
	{
		global $objSmarty;

		$SelQuery	= "SELECT * from `tbl_score_te` where `Score_Id` = '".$_REQUEST['CatIdent']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("TightEnd",$ExeSelQuery);
		
		$Id = $ExeSelQuery[0]['Id'];
		
		
		$SelQuery	= "SELECT * from `tbl_touch_down` where `Score_Id` = '".$_REQUEST['CatIdent']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("TouchDownTe",$ExeSelQuery);
		$resultCnt=$this->ExecuteQuery($SelQuery, "norows");
		$objSmarty->assign("resultCntTe",$resultCnt);
		
		$SelQuery	= "SELECT * from `tbl_td_rush` where `Score_Id` = '".$_REQUEST['CatIdent']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("TouchDownTeRush",$ExeSelQuery);
		$resultCnt=$this->ExecuteQuery($SelQuery, "norows");
		$objSmarty->assign("CntTeRush",$resultCnt);
		
		$SelQuery	= "SELECT * from `tbl_td_rec` where `Score_Id` = '".$_REQUEST['CatIdent']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("TouchDownTeRec",$ExeSelQuery);
		$resultCnt=$this->ExecuteQuery($SelQuery, "norows");
		$objSmarty->assign("CntTeRec",$resultCnt);

	}	
	
	
	
function getScoreById()
	{
		global $objSmarty;

		$SelQuery	= "SELECT * from `tbl_score` where `Id` = '".$_REQUEST['CatIdent']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("User",$ExeSelQuery);

	}

function getScore_touchdown()
	{
		global $objSmarty;

		$SelQuery	= "SELECT * from `tbl_touch_down` where `Score_Id` = '".$_REQUEST['CatIdent']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("TouchDown",$ExeSelQuery);
		$resultCnt=$this->ExecuteQuery($SelQuery, "norows");
		$objSmarty->assign("resultCnt",$resultCnt);
		 $i=1;
         $objSmarty->assign("i",$i);
		
	}
function getScore_touchdown_rush()
	{
		global $objSmarty;

		$SelQuery	= "SELECT * from `tbl_td_rush` where `Score_Id` = '".$_REQUEST['CatIdent']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("TouchDownRush",$ExeSelQuery);
		$resultCnt=$this->ExecuteQuery($SelQuery, "norows");
		$objSmarty->assign("CntRush",$resultCnt);
	
		
	}
function getScore_touchdown_rec()
	{
		global $objSmarty;

		$SelQuery	= "SELECT * from `tbl_td_rec` where `Score_Id` = '".$_REQUEST['CatIdent']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("TouchDownRec",$ExeSelQuery);
		$resultCnt=$this->ExecuteQuery($SelQuery, "norows");
		$objSmarty->assign("CntRec",$resultCnt);
	
		
	}
	
	
function getScoreById_kickers()
	{
		global $objSmarty;

		$SelQuery	= "SELECT * from `tbl_kickers` where `Score_Id` = '".$_REQUEST['CatIdent']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("Kickers",$ExeSelQuery);
		$kick_Id = $ExeSelQuery[0]['Id'];
		
		
		$Sel	= "SELECT * from `tbl_fgmade` where `Score_Id` = '".$kick_Id."'";
		$ExeSel= $this->ExecuteQuery($Sel,"select");
		$objSmarty->assign("FgMade",$ExeSel);
		$resultCnt=$this->ExecuteQuery($Sel, "norows");
		$objSmarty->assign("CntKickers",$resultCnt);

	}
	
	
function getScoreById_defense()
	{
		global $objSmarty;

		$SelQuery	= "SELECT * from `tbl_defense` where `Score_Id` = '".$_REQUEST['CatIdent']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("Defense",$ExeSelQuery);
		
		$def_Id = $ExeSelQuery[0]['Id'];
		
		$Sel	= "SELECT * from `tbl_def_td` where `Score_Id` = '".$def_Id."'";
		$ExeSel= $this->ExecuteQuery($Sel,"select");
		$objSmarty->assign("DefenseTd",$ExeSel);
		$resultCnt=$this->ExecuteQuery($Sel, "norows");
		$objSmarty->assign("CntDefense",$resultCnt);
		
		
	}
	
	
function getScoreById_special()
	{
		global $objSmarty;

		$SelQuery	= "SELECT * from `tbl_special` where `Score_Id` = '".$_REQUEST['CatIdent']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("Special",$ExeSelQuery);
		
		$spe_Id = $ExeSelQuery[0]['Id'];
		
		$Sel	= "SELECT * from `tbl_spe_td` where `Score_Id` = '".$spe_Id."'";
		$ExeSel= $this->ExecuteQuery($Sel,"select");
		$objSmarty->assign("SpecialTd",$ExeSel);
		$resultCnt=$this->ExecuteQuery($Sel, "norows");
		$objSmarty->assign("CntSpecial",$resultCnt);

	}
	
	
function updateDivisionbyId(){
		global $objSmarty;
		$selQuery="select * from tbl_division where Team='".addslashes($_REQUEST['Team'])."'
		 and Id!='".$_REQUEST['CatIdent']."'";
		$count=$this->ExecuteQuery($selQuery, "norows");
		if(!$count){
			$proceed="Yes";
 			
			if($proceed=="Yes"){
				 
				$upQuery="update tbl_division set `Team`='".addslashes($_REQUEST['Team'])."',
												`Division`='".addslashes($_REQUEST['Division'])."',
												`Updated_Date`=now()
												where Id='".$_REQUEST['CatIdent']."'";
				$this->ExecuteQuery($upQuery, "update");

				$objSmarty->assign("SuccessMessage","Division details has been updated successfully");
			}
		}else{
			$objSmarty->assign("ErrorMessage","Division details already exist");
		}
	}
function updateScorebyId(){
		global $objSmarty;
		$selQuery="select * from tbl_score where Nfl_Team='".addslashes($_REQUEST['Nfl_Team'])."' and  Player='".addslashes($_REQUEST['Player'])."'
		 and Id!='".$_REQUEST['CatIdent']."'";
		$count=$this->ExecuteQuery($selQuery, "norows");
		if(!$count){
			$proceed="Yes";
 			
			if($proceed=="Yes"){
				 
				$upQuery="update tbl_score set `Player`='".addslashes($_REQUEST['Player'])."',
												`Game_Week`='".addslashes($_REQUEST['Game_Week'])."',
												`Nfl_Team`='".addslashes($_REQUEST['Nfl_Team'])."',
												`Position`='".addslashes($_REQUEST['Position'])."',
												`Y_Pass`='".addslashes($_REQUEST['Y_Pass'])."',
												`Y_Rush`='".addslashes($_REQUEST['Y_Rush'])."',
												`Y_Rec`='".addslashes($_REQUEST['Y_Rec'])."',
												`Y_Pass_Con`='".addslashes($_REQUEST['Y_Pass_Con'])."',
												`Y_Rush_Con`='".addslashes($_REQUEST['Y_Rush_Con'])."',
												`Y_Rec_Con`='".addslashes($_REQUEST['Y_Rec_Con'])."',
												`Y_Pass_Tot`='".addslashes($_REQUEST['Y_Pass_Tot'])."',
												`Y_Rush_Tot`='".addslashes($_REQUEST['Y_Rush_Tot'])."',
												`Y_Rec_Tot`='".addslashes($_REQUEST['Y_Rec_Tot'])."',
												`TO_Int`='".addslashes($_REQUEST['TO_Int'])."',
												`TO_Fumble`='".addslashes($_REQUEST['TO_Fumble'])."',
												`TO_Int_Con`='".addslashes($_REQUEST['TO_Int_Con'])."',
												`TO_Fumble_Con`='".addslashes($_REQUEST['TO_Fumble_Con'])."',
												`TO_Int_Tot`='".addslashes($_REQUEST['TO_Int_Tot'])."',
												`TO_Fumble_Tot`='".addslashes($_REQUEST['TO_Fumble_Tot'])."',
												`PC_Pass`='".addslashes($_REQUEST['PC_Pass'])."',
												`PC_Rush`='".addslashes($_REQUEST['PC_Rush'])."',
												`PC_Rec`='".addslashes($_REQUEST['PC_Rec'])."',
												`PC_Pass_Con`='".addslashes($_REQUEST['PC_Pass_Con'])."',
												`PC_Rush_Con`='".addslashes($_REQUEST['PC_Rush_Con'])."',
												`PC_Rec_Con`='".addslashes($_REQUEST['PC_Re_Con'])."',
												`PC_Pass_Tot`='".addslashes($_REQUEST['PC_Pass_Tot'])."',
												`PC_Rush_Tot`='".addslashes($_REQUEST['PC_Rush_Tot'])."',
												`PC_Rec_Tot`='".addslashes($_REQUEST['PC_Rec_Tot'])."',
												`Total`='".addslashes($_REQUEST['Total_sum'])."',
												`Updated_Date`=now()
												where Id='".$_REQUEST['CatIdent']."'";
				$this->ExecuteQuery($upQuery, "update");

				$delQry="DELETE FROM `tbl_touch_down` WHERE Score_Id='".addslashes($_REQUEST['CatIdent'])."'";
				$this->ExecuteQuery($delQry,"delete");		
				$TD_Pass=$_REQUEST['TD_Pass'];
				$TD_Pass_Con=$_REQUEST['TD_Pass_Con'];
				$TD_Pass_PTS=$_REQUEST['TD_Pass_PTS'];
				$TD_Pass_Tot=$_REQUEST['TD_Pass_Tot'];
				if($TD_Pass != '')
					{
					for($i=0;$i<count($TD_Pass);$i++){
						 $Ins="INSERT INTO `tbl_touch_down` (
													`Score_Id`,
													`TD_Pass`,
													`TD_Pass_Con`,
													`TD_Pass_PTS`,
													`TD_Pass_Tot`,
													`Status`,
													`Created_Date`)
													 VALUES (
													 '".$_REQUEST['CatIdent']."',
													  '".addslashes($TD_Pass[$i])."',
													 '".addslashes($TD_Pass_Con[$i])."',
													 '".addslashes($TD_Pass_PTS[$i])."',
													 '".addslashes($TD_Pass_Tot[$i])."',
													 '1',
													 now())";
					 $this->ExecuteQuery($Ins, "insert");
					
					}
					}
					
					
				$delQry="DELETE FROM `tbl_td_rush` WHERE Score_Id='".addslashes($_REQUEST['CatIdent'])."'";
				$this->ExecuteQuery($delQry,"delete");		
						
				$TD_Rush=$_REQUEST['TD_Rush'];
				$TD_Rush_Con=$_REQUEST['TD_Rush_Con'];
				$TD_Rush_PTS=$_REQUEST['TD_Rush_PTS'];
				$TD_Rush_Tot=$_REQUEST['TD_Rush_Tot'];
				if($TD_Rush != '')
					{
					for($i=0;$i<count($TD_Rush);$i++){
						 $Ins="INSERT INTO `tbl_td_rush` (
													`Score_Id`,
													`TD_Rush`,
													`TD_Rush_Con`,
													`TD_Rush_PTS`,
													`TD_Rush_Tot`,
													`Status`,
													`Created_Date`)
													 VALUES (
													 '".$_REQUEST['CatIdent']."',
													  '".addslashes($TD_Rush[$i])."',
													 '".addslashes($TD_Rush_Con[$i])."',
													 '".addslashes($TD_Rush_PTS[$i])."',
													 '".addslashes($TD_Rush_Tot[$i])."',
													 '1',
													 now())";
					 $this->ExecuteQuery($Ins, "insert");
					
					}
					}
					
				$delQry="DELETE FROM `tbl_td_rec` WHERE Score_Id='".addslashes($_REQUEST['CatIdent'])."'";
				$this->ExecuteQuery($delQry,"delete");
					
				$TD_Rec=$_REQUEST['TD_Rec'];
				$TD_Rec_Con=$_REQUEST['TD_Rec_Con'];
				$TD_Rec_PTS=$_REQUEST['TD_Rec_PTS'];
				$TD_Rec_Tot=$_REQUEST['TD_Rec_Tot'];
				if($TD_Rec != '')
					{
					for($i=0;$i<count($TD_Rec);$i++){
						 $Ins="INSERT INTO `tbl_td_rec` (
													`Score_Id`,
													`TD_Rec`,
													`TD_Rec_Con`,
													`TD_Rec_PTS`,
													`TD_Rec_Tot`,
													`Status`,
													`Created_Date`)
													 VALUES (
													 '".$_REQUEST['CatIdent']."',
													  '".addslashes($TD_Rec[$i])."',
													 '".addslashes($TD_Rec_Con[$i])."',
													 '".addslashes($TD_Rec_PTS[$i])."',
													 '".addslashes($TD_Rec_Tot[$i])."',
													 '1',
													 now())";
					 $this->ExecuteQuery($Ins, "insert");
					
					}
					}
				
				$objSmarty->assign("SuccessMessage","Score details has been updated successfully");
			}
		}else{
			$objSmarty->assign("ErrorMessage","Score details already exist");
		}
	}
function updateScorebyIdRb(){
		global $objSmarty;
		$selQuery="select * from tbl_score_rb where Nfl_Team='".addslashes($_REQUEST['Nfl_Team'])."'
		and  Player='".addslashes($_REQUEST['Player'])."' and Score_Id!='".$_REQUEST['CatIdent']."'";
		$count=$this->ExecuteQuery($selQuery, "norows");
		if(!$count){
			$proceed="Yes";
 			
			if($proceed=="Yes"){
				
				$upQry="update tbl_score set `Player`='".addslashes($_REQUEST['Player'])."',
												`Game_Week`='".addslashes($_REQUEST['Game_Week'])."',
												`Nfl_Team`='".addslashes($_REQUEST['Nfl_Team'])."',
												`Total`='".addslashes($_REQUEST['Total_sum'])."',
												`Position`='".addslashes($_REQUEST['Position'])."'
				 								where Id='".$_REQUEST['CatIdent']."'";
				$this->ExecuteQuery($upQry, "update");
				 $upQuery="update tbl_score_rb set `Player`='".addslashes($_REQUEST['Player'])."',
												`Game_Week`='".addslashes($_REQUEST['Game_Week'])."',
												`Nfl_Team`='".addslashes($_REQUEST['Nfl_Team'])."',
												`Position`='".addslashes($_REQUEST['Position'])."',
												`Y_Pass`='".addslashes($_REQUEST['Y_Pass'])."',
												`Y_Rush`='".addslashes($_REQUEST['Y_Rush'])."',
												`Y_Rec`='".addslashes($_REQUEST['Y_Rec'])."',
												`Y_Pass_Con`='".addslashes($_REQUEST['Y_Pass_Con'])."',
												`Y_Rush_Con`='".addslashes($_REQUEST['Y_Rush_Con'])."',
												`Y_Rec_Con`='".addslashes($_REQUEST['Y_Rec_Con'])."',
												`Y_Pass_Tot`='".addslashes($_REQUEST['Y_Pass_Tot'])."',
												`Y_Rush_Tot`='".addslashes($_REQUEST['Y_Rush_Tot'])."',
												`Y_Rec_Tot`='".addslashes($_REQUEST['Y_Rec_Tot'])."',
												`TO_Int`='".addslashes($_REQUEST['TO_Int'])."',
												`TO_Fumble`='".addslashes($_REQUEST['TO_Fumble'])."',
												`TO_Int_Con`='".addslashes($_REQUEST['TO_Int_Con'])."',
												`TO_Fumble_Con`='".addslashes($_REQUEST['TO_Fumble_Con'])."',
												`TO_Int_Tot`='".addslashes($_REQUEST['TO_Int_Tot'])."',
												`TO_Fumble_Tot`='".addslashes($_REQUEST['TO_Fumble_Tot'])."',
												`PC_Pass`='".addslashes($_REQUEST['PC_Pass'])."',
												`PC_Rush`='".addslashes($_REQUEST['PC_Rush'])."',
												`PC_Rec`='".addslashes($_REQUEST['PC_Rec'])."',
												`PC_Pass_Con`='".addslashes($_REQUEST['PC_Pass_Con'])."',
												`PC_Rush_Con`='".addslashes($_REQUEST['PC_Rush_Con'])."',
												`PC_Rec_Con`='".addslashes($_REQUEST['PC_Re_Con'])."',
												`PC_Pass_Tot`='".addslashes($_REQUEST['PC_Pass_Tot'])."',
												`PC_Rush_Tot`='".addslashes($_REQUEST['PC_Rush_Tot'])."',
												`PC_Rec_Tot`='".addslashes($_REQUEST['PC_Rec_Tot'])."',
												`Total`='".addslashes($_REQUEST['Total_sum'])."',
												`Updated_Date`=now()
												where Score_Id='".$_REQUEST['CatIdent']."'";
				$res=$this->ExecuteQuery($upQuery, "update");

				 $delQry="DELETE FROM `tbl_touch_down` WHERE Score_Id='".addslashes($_REQUEST['CatIdent'])."'";
				$this->ExecuteQuery($delQry,"delete");		
				$TD_Pass=$_REQUEST['TD_Pass'];
				$TD_Pass_Con=$_REQUEST['TD_Pass_Con'];
				$TD_Pass_PTS=$_REQUEST['TD_Pass_PTS'];
				$TD_Pass_Tot=$_REQUEST['TD_Pass_Tot'];
				if($TD_Pass != '')
					{
					for($i=1;$i<count($TD_Pass);$i++){
						//echo "@@@".$i;
						 $insertQuery="INSERT INTO `tbl_touch_down` (
													`Score_Id`,
													`TD_Pass`,
													`TD_Pass_Con`,
													`TD_Pass_PTS`,
													`TD_Pass_Tot`,
													`Status`,
													`Created_Date`)
													 VALUES (
													 '".$_REQUEST['CatIdent']."',
													 '".addslashes($TD_Pass[$i])."',
													 '".addslashes($TD_Pass_Con[$i])."',
													 '".addslashes($TD_Pass_PTS[$i])."',
													 '".addslashes($TD_Pass_Tot[$i])."',
													 '1',
													 now())";
						//echo "********";
					$resqry=$this->ExecuteQuery($insertQuery, "insert");
					
					}
					}
					
					
				$delQry="DELETE FROM `tbl_td_rush` WHERE Score_Id='".addslashes($_REQUEST['CatIdent'])."'";
				$this->ExecuteQuery($delQry,"delete");		
						
				$TD_Rush=$_REQUEST['TD_Rush'];
				$TD_Rush_Con=$_REQUEST['TD_Rush_Con'];
				$TD_Rush_PTS=$_REQUEST['TD_Rush_PTS'];
				$TD_Rush_Tot=$_REQUEST['TD_Rush_Tot'];
				if($TD_Rush != '')
					{
					for($i=0;$i<count($TD_Rush);$i++){
						 $Ins="INSERT INTO `tbl_td_rush` (
													`Score_Id`,
													`TD_Rush`,
													`TD_Rush_Con`,
													`TD_Rush_PTS`,
													`TD_Rush_Tot`,
													`Status`,
													`Created_Date`)
													 VALUES (
													 '".$_REQUEST['CatIdent']."',
													  '".addslashes($TD_Rush[$i])."',
													 '".addslashes($TD_Rush_Con[$i])."',
													 '".addslashes($TD_Rush_PTS[$i])."',
													 '".addslashes($TD_Rush_Tot[$i])."',
													 '1',
													 now())";
					 $this->ExecuteQuery($Ins, "insert");
					
					}
					}
					
				$delQry="DELETE FROM `tbl_td_rec` WHERE Score_Id='".addslashes($_REQUEST['CatIdent'])."'";
				$this->ExecuteQuery($delQry,"delete");
					
				$TD_Rec=$_REQUEST['TD_Rec'];
				$TD_Rec_Con=$_REQUEST['TD_Rec_Con'];
				$TD_Rec_PTS=$_REQUEST['TD_Rec_PTS'];
				$TD_Rec_Tot=$_REQUEST['TD_Rec_Tot'];
				if($TD_Rec != '')
					{
					for($i=0;$i<count($TD_Rec);$i++){
						 $Ins="INSERT INTO `tbl_td_rec` (
													`Score_Id`,
													`TD_Rec`,
													`TD_Rec_Con`,
													`TD_Rec_PTS`,
													`TD_Rec_Tot`,
													`Status`,
													`Created_Date`)
													 VALUES (
													 '".$_REQUEST['CatIdent']."',
													  '".addslashes($TD_Rec[$i])."',
													 '".addslashes($TD_Rec_Con[$i])."',
													 '".addslashes($TD_Rec_PTS[$i])."',
													 '".addslashes($TD_Rec_Tot[$i])."',
													 '1',
													 now())";
					 $this->ExecuteQuery($Ins, "insert");
					
					}
					}
				
				//$objSmarty->assign("SuccessMessage","Score details has been updated successfully");
				header('Location:manage_score.php?succmsg=Score details has been updated successfully');
			}
		}else{
			$objSmarty->assign("ErrorMessage","Score details already exist");
		}
	}
function updateScorebyIdWr(){
		global $objSmarty;
		$selQuery="select * from tbl_score_wr where  Nfl_Team='".addslashes($_REQUEST['Nfl_Team'])."' and Player='".addslashes($_REQUEST['Player'])."'
		 and Score_Id!='".$_REQUEST['CatIdent']."'";
		$count=$this->ExecuteQuery($selQuery, "norows");
		if(!$count){
			$proceed="Yes";
 			
			if($proceed=="Yes"){
				 $upQry="update tbl_score set `Player`='".addslashes($_REQUEST['Player'])."',
												`Game_Week`='".addslashes($_REQUEST['Game_Week'])."',
												`Nfl_Team`='".addslashes($_REQUEST['Nfl_Team'])."',
												`Total`='".addslashes($_REQUEST['Total_sum'])."',
												`Position`='".addslashes($_REQUEST['Position'])."'
				 								where Id='".$_REQUEST['CatIdent']."'";
				$this->ExecuteQuery($upQry, "update");
				
				
				$upQuery="update tbl_score_wr set `Player`='".addslashes($_REQUEST['Player'])."',
												`Y_Pass`='".addslashes($_REQUEST['Y_Pass'])."',
												`Y_Rush`='".addslashes($_REQUEST['Y_Rush'])."',
												`Y_Rec`='".addslashes($_REQUEST['Y_Rec'])."',
												`Y_Pass_Con`='".addslashes($_REQUEST['Y_Pass_Con'])."',
												`Y_Rush_Con`='".addslashes($_REQUEST['Y_Rush_Con'])."',
												`Y_Rec_Con`='".addslashes($_REQUEST['Y_Rec_Con'])."',
												`Y_Pass_Tot`='".addslashes($_REQUEST['Y_Pass_Tot'])."',
												`Y_Rush_Tot`='".addslashes($_REQUEST['Y_Rush_Tot'])."',
												`Y_Rec_Tot`='".addslashes($_REQUEST['Y_Rec_Tot'])."',
												`TO_Int`='".addslashes($_REQUEST['TO_Int'])."',
												`TO_Fumble`='".addslashes($_REQUEST['TO_Fumble'])."',
												`TO_Int_Con`='".addslashes($_REQUEST['TO_Int_Con'])."',
												`TO_Fumble_Con`='".addslashes($_REQUEST['TO_Fumble_Con'])."',
												`TO_Int_Tot`='".addslashes($_REQUEST['TO_Int_Tot'])."',
												`TO_Fumble_Tot`='".addslashes($_REQUEST['TO_Fumble_Tot'])."',
												`PC_Pass`='".addslashes($_REQUEST['PC_Pass'])."',
												`PC_Rush`='".addslashes($_REQUEST['PC_Rush'])."',
												`PC_Rec`='".addslashes($_REQUEST['PC_Rec'])."',
												`PC_Pass_Con`='".addslashes($_REQUEST['PC_Pass_Con'])."',
												`PC_Rush_Con`='".addslashes($_REQUEST['PC_Rush_Con'])."',
												`PC_Rec_Con`='".addslashes($_REQUEST['PC_Re_Con'])."',
												`PC_Pass_Tot`='".addslashes($_REQUEST['PC_Pass_Tot'])."',
												`PC_Rush_Tot`='".addslashes($_REQUEST['PC_Rush_Tot'])."',
												`PC_Rec_Tot`='".addslashes($_REQUEST['PC_Rec_Tot'])."',
												`Total`='".addslashes($_REQUEST['Total_sum'])."',
												`Updated_Date`=now()
												where Score_Id='".$_REQUEST['CatIdent']."'";
				$this->ExecuteQuery($upQuery, "update");

				$delQry="DELETE FROM `tbl_touch_down` WHERE Score_Id='".addslashes($_REQUEST['CatIdent'])."'";
				$this->ExecuteQuery($delQry,"delete");		
				$TD_Pass=$_REQUEST['TD_Pass'];
				$TD_Pass_Con=$_REQUEST['TD_Pass_Con'];
				$TD_Pass_PTS=$_REQUEST['TD_Pass_PTS'];
				$TD_Pass_Tot=$_REQUEST['TD_Pass_Tot'];
				if($TD_Pass != '')
					{
					for($i=0;$i<count($TD_Pass);$i++){
						 $Ins="INSERT INTO `tbl_touch_down` (
													`Score_Id`,
													`TD_Pass`,
													`TD_Pass_Con`,
													`TD_Pass_PTS`,
													`TD_Pass_Tot`,
													`Status`,
													`Created_Date`)
													 VALUES (
													 '".$_REQUEST['CatIdent']."',
													  '".addslashes($TD_Pass[$i])."',
													 '".addslashes($TD_Pass_Con[$i])."',
													 '".addslashes($TD_Pass_PTS[$i])."',
													 '".addslashes($TD_Pass_Tot[$i])."',
													 '1',
													 now())";
					 $this->ExecuteQuery($Ins, "insert");
					
					}
					}
					
					
				$delQry="DELETE FROM `tbl_td_rush` WHERE Score_Id='".addslashes($_REQUEST['CatIdent'])."'";
				$this->ExecuteQuery($delQry,"delete");		
						
				$TD_Rush=$_REQUEST['TD_Rush'];
				$TD_Rush_Con=$_REQUEST['TD_Rush_Con'];
				$TD_Rush_PTS=$_REQUEST['TD_Rush_PTS'];
				$TD_Rush_Tot=$_REQUEST['TD_Rush_Tot'];
				if($TD_Rush != '')
					{
					for($i=0;$i<count($TD_Rush);$i++){
						 $Ins="INSERT INTO `tbl_td_rush` (
													`Score_Id`,
													`TD_Rush`,
													`TD_Rush_Con`,
													`TD_Rush_PTS`,
													`TD_Rush_Tot`,
													`Status`,
													`Created_Date`)
													 VALUES (
													 '".$_REQUEST['CatIdent']."',
													  '".addslashes($TD_Rush[$i])."',
													 '".addslashes($TD_Rush_Con[$i])."',
													 '".addslashes($TD_Rush_PTS[$i])."',
													 '".addslashes($TD_Rush_Tot[$i])."',
													 '1',
													 now())";
					 $this->ExecuteQuery($Ins, "insert");
					
					}
					}
					
				$delQry="DELETE FROM `tbl_td_rec` WHERE Score_Id='".addslashes($_REQUEST['CatIdent'])."'";
				$this->ExecuteQuery($delQry,"delete");
					
				$TD_Rec=$_REQUEST['TD_Rec'];
				$TD_Rec_Con=$_REQUEST['TD_Rec_Con'];
				$TD_Rec_PTS=$_REQUEST['TD_Rec_PTS'];
				$TD_Rec_Tot=$_REQUEST['TD_Rec_Tot'];
				if($TD_Rec != '')
					{
					for($i=0;$i<count($TD_Rec);$i++){
						 $Ins="INSERT INTO `tbl_td_rec` (
													`Score_Id`,
													`TD_Rec`,
													`TD_Rec_Con`,
													`TD_Rec_PTS`,
													`TD_Rec_Tot`,
													`Status`,
													`Created_Date`)
													 VALUES (
													 '".$_REQUEST['CatIdent']."',
													  '".addslashes($TD_Rec[$i])."',
													 '".addslashes($TD_Rec_Con[$i])."',
													 '".addslashes($TD_Rec_PTS[$i])."',
													 '".addslashes($TD_Rec_Tot[$i])."',
													 '1',
													 now())";
					 $this->ExecuteQuery($Ins, "insert");
					
					}
					}
				
				$objSmarty->assign("SuccessMessage","Score details has been updated successfully");
				header('Location:manage_score.php?succmsg=Score details has been updated successfully');
			}
		}else{
			$objSmarty->assign("ErrorMessage","Score details already exist");
		}
	}
function updateScorebyIdTe(){
		global $objSmarty;
		$selQuery="select * from tbl_score_te where   Nfl_Team='".addslashes($_REQUEST['Nfl_Team'])."' and  Player='".addslashes($_REQUEST['Player'])."'
		 and Score_Id!='".$_REQUEST['CatIdent']."'";
		$count=$this->ExecuteQuery($selQuery, "norows");
		if(!$count){
			$proceed="Yes";
 			
			if($proceed=="Yes"){
				 
				$upQry="update tbl_score set `Player`='".addslashes($_REQUEST['Player'])."',
												`Game_Week`='".addslashes($_REQUEST['Game_Week'])."',
												`Nfl_Team`='".addslashes($_REQUEST['Nfl_Team'])."',
												`Total`='".addslashes($_REQUEST['Total_sum'])."',
												`Position`='".addslashes($_REQUEST['Position'])."'
				 								where Id='".$_REQUEST['CatIdent']."'";
				$this->ExecuteQuery($upQry, "update");
				
				$upQuery="update tbl_score_te set `Player`='".addslashes($_REQUEST['Player'])."',
												`Game_Week`='".addslashes($_REQUEST['Game_Week'])."',
												`Nfl_Team`='".addslashes($_REQUEST['Nfl_Team'])."',
												`Position`='".addslashes($_REQUEST['Position'])."',
												`Y_Pass`='".addslashes($_REQUEST['Y_Pass'])."',
												`Y_Rush`='".addslashes($_REQUEST['Y_Rush'])."',
												`Y_Rec`='".addslashes($_REQUEST['Y_Rec'])."',
												`Y_Pass_Con`='".addslashes($_REQUEST['Y_Pass_Con'])."',
												`Y_Rush_Con`='".addslashes($_REQUEST['Y_Rush_Con'])."',
												`Y_Rec_Con`='".addslashes($_REQUEST['Y_Rec_Con'])."',
												`Y_Pass_Tot`='".addslashes($_REQUEST['Y_Pass_Tot'])."',
												`Y_Rush_Tot`='".addslashes($_REQUEST['Y_Rush_Tot'])."',
												`Y_Rec_Tot`='".addslashes($_REQUEST['Y_Rec_Tot'])."',
												`TO_Int`='".addslashes($_REQUEST['TO_Int'])."',
												`TO_Fumble`='".addslashes($_REQUEST['TO_Fumble'])."',
												`TO_Int_Con`='".addslashes($_REQUEST['TO_Int_Con'])."',
												`TO_Fumble_Con`='".addslashes($_REQUEST['TO_Fumble_Con'])."',
												`TO_Int_Tot`='".addslashes($_REQUEST['TO_Int_Tot'])."',
												`TO_Fumble_Tot`='".addslashes($_REQUEST['TO_Fumble_Tot'])."',
												`PC_Pass`='".addslashes($_REQUEST['PC_Pass'])."',
												`PC_Rush`='".addslashes($_REQUEST['PC_Rush'])."',
												`PC_Rec`='".addslashes($_REQUEST['PC_Rec'])."',
												`PC_Pass_Con`='".addslashes($_REQUEST['PC_Pass_Con'])."',
												`PC_Rush_Con`='".addslashes($_REQUEST['PC_Rush_Con'])."',
												`PC_Rec_Con`='".addslashes($_REQUEST['PC_Re_Con'])."',
												`PC_Pass_Tot`='".addslashes($_REQUEST['PC_Pass_Tot'])."',
												`PC_Rush_Tot`='".addslashes($_REQUEST['PC_Rush_Tot'])."',
												`PC_Rec_Tot`='".addslashes($_REQUEST['PC_Rec_Tot'])."',
												`Total`='".addslashes($_REQUEST['Total_sum'])."',
												`Updated_Date`=now()
												where Score_Id='".$_REQUEST['CatIdent']."'";
				$this->ExecuteQuery($upQuery, "update");

				$delQry="DELETE FROM `tbl_touch_down` WHERE Score_Id='".addslashes($_REQUEST['CatIdent'])."'";
				$this->ExecuteQuery($delQry,"delete");		
				$TD_Pass=$_REQUEST['TD_Pass'];
				$TD_Pass_Con=$_REQUEST['TD_Pass_Con'];
				$TD_Pass_PTS=$_REQUEST['TD_Pass_PTS'];
				$TD_Pass_Tot=$_REQUEST['TD_Pass_Tot'];
				if($TD_Pass != '')
					{
					for($i=0;$i<count($TD_Pass);$i++){
						 $Ins1="INSERT INTO `tbl_touch_down` (
													`Score_Id`,
													`TD_Pass`,
													`TD_Pass_Con`,
													`TD_Pass_PTS`,
													`TD_Pass_Tot`,
													`Status`,
													`Created_Date`)
													 VALUES (
													 '".$_REQUEST['CatIdent']."',
													  '".addslashes($TD_Pass[$i])."',
													 '".addslashes($TD_Pass_Con[$i])."',
													 '".addslashes($TD_Pass_PTS[$i])."',
													 '".addslashes($TD_Pass_Tot[$i])."',
													 '1',
													 now())";
					 $this->ExecuteQuery($Ins1, "insert");
					
					}
					}
					
					
				$delQry="DELETE FROM `tbl_td_rush` WHERE Score_Id='".addslashes($_REQUEST['CatIdent'])."'";
				$this->ExecuteQuery($delQry,"delete");		
						
				$TD_Rush=$_REQUEST['TD_Rush'];
				$TD_Rush_Con=$_REQUEST['TD_Rush_Con'];
				$TD_Rush_PTS=$_REQUEST['TD_Rush_PTS'];
				$TD_Rush_Tot=$_REQUEST['TD_Rush_Tot'];
				if($TD_Rush != '')
					{
					for($i=0;$i<count($TD_Rush);$i++){
						 $Ins2="INSERT INTO `tbl_td_rush` (
													`Score_Id`,
													`TD_Rush`,
													`TD_Rush_Con`,
													`TD_Rush_PTS`,
													`TD_Rush_Tot`,
													`Status`,
													`Created_Date`)
													 VALUES (
													 '".$_REQUEST['CatIdent']."',
													  '".addslashes($TD_Rush[$i])."',
													 '".addslashes($TD_Rush_Con[$i])."',
													 '".addslashes($TD_Rush_PTS[$i])."',
													 '".addslashes($TD_Rush_Tot[$i])."',
													 '1',
													 now())";
					 $this->ExecuteQuery($Ins2, "insert");
					
					}
					}
					
				$delQry="DELETE FROM `tbl_td_rec` WHERE Score_Id='".addslashes($_REQUEST['CatIdent'])."'";
				$this->ExecuteQuery($delQry,"delete");
					
				$TD_Rec=$_REQUEST['TD_Rec'];
				$TD_Rec_Con=$_REQUEST['TD_Rec_Con'];
				$TD_Rec_PTS=$_REQUEST['TD_Rec_PTS'];
				$TD_Rec_Tot=$_REQUEST['TD_Rec_Tot'];
				if($TD_Rec != '')
					{
					for($i=0;$i<count($TD_Rec);$i++){
						 $Ins3="INSERT INTO `tbl_td_rec` (
													`Score_Id`,
													`TD_Rec`,
													`TD_Rec_Con`,
													`TD_Rec_PTS`,
													`TD_Rec_Tot`,
													`Status`,
													`Created_Date`)
													 VALUES (
													 '".$_REQUEST['CatIdent']."',
													  '".addslashes($TD_Rec[$i])."',
													 '".addslashes($TD_Rec_Con[$i])."',
													 '".addslashes($TD_Rec_PTS[$i])."',
													 '".addslashes($TD_Rec_Tot[$i])."',
													 '1',
													 now())";
					 $this->ExecuteQuery($Ins3, "insert");
					
					}
					}
				
				$objSmarty->assign("SuccessMessage","Score details has been updated successfully");
				header('Location:manage_score.php?succmsg=Score details has been updated successfully');
			}
		}
		else{
			$objSmarty->assign("ErrorMessage","Score details already exist");
		}
	}
	
function UpdateScorebyIdKickers(){
		global $objSmarty;
		$selQuery="select * from tbl_kickers where  Nfl_Team='".addslashes($_REQUEST['Nfl_Team_kickers'])."' 
		and   Player='".addslashes($_REQUEST['Player_kickers'])."'  and Score_Id!='".$_REQUEST['CatIdent']."'";
		$count=$this->ExecuteQuery($selQuery, "norows");
		if(!$count){
			$proceed="Yes";
 			
			if($proceed=="Yes"){
				 
				$upQry="update tbl_score set `Player`='".addslashes($_REQUEST['Player_kickers'])."',
												`Game_Week`='".addslashes($_REQUEST['Game_Week_kickers'])."',
												`Nfl_Team`='".addslashes($_REQUEST['Nfl_Team_kickers'])."',
												`Total`='".addslashes($_REQUEST['Total_sum_kicker'])."',
												`Position`='".addslashes($_REQUEST['Position_kickers'])."'
				 								where Id='".$_REQUEST['CatIdent']."'";
				$this->ExecuteQuery($upQry, "update");
				  $upQuery="update tbl_kickers set 
												`Player`=  '".addslashes($_REQUEST['Player_kickers'])."',
												`Game_Week`= '".addslashes($_REQUEST['Game_Week_kickers'])."',
												`Nfl_Team`=  '".addslashes($_REQUEST['Nfl_Team_kickers'])."',
												`Position`= '".addslashes($_REQUEST['Position_kickers'])."',
												`EP_Made` = '".addslashes($_REQUEST['EP_Made'])."',
												`EP_Made_Con`= '".addslashes($_REQUEST['EP_Made_Con'])."',
												`EP_Made_Tot`= '".addslashes($_REQUEST['EP_Made_Tot'])."',
												`EP_Missed`= '".addslashes($_REQUEST['EP_Missed'])."',
												`EP_Missed_Con`= '".addslashes($_REQUEST['EP_Missed_Con'])."',
												`EP_Missed_Tot`= '".addslashes($_REQUEST['EP_Missed_Tot'])."',
												`FG_Missed`=  '".addslashes($_REQUEST['FG_Missed'])."',
												`FG_Missed_Con`= '".addslashes($_REQUEST['FG_Missed_Con'])."',
												`FG_Missed_Tot`= '".addslashes($_REQUEST['FG_Missed_Tot'])."',
												`Total_Kicker`= '".addslashes($_REQUEST['Total_sum_kicker'])."',
												`Status`='1',
												`Updated_Date`= now()
												where Score_Id='".$_REQUEST['CatIdent']."'";
												
				$this->ExecuteQuery($upQuery, "update");
				$lastInsertId=mysql_insert_id();

			$delQry="DELETE FROM `tbl_fgmade` WHERE Score_Id='".addslashes($_REQUEST['Kick_Id'])."'";
			$this->ExecuteQuery($delQry,"delete");	
				
				
			$FG_Made=$_REQUEST['FG_Made'];
			$FG_Made_Con=$_REQUEST['FG_Made_Con'];
			$FG_Made_PTS=$_REQUEST['FG_Made_PTS'];
			$FG_Made_Tot=$_REQUEST['FG_Made_Tot'];
			if($FG_Made != '')
			{
			for($i=0;$i<count($FG_Made);$i++){
				
					 $Ins="INSERT INTO `tbl_fgmade` (
												`Score_Id`,
												`FG_Made`,
												`FG_Made_Con`,
												`FG_Made_PTS`,
												`FG_Made_Tot`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".$_REQUEST['Kick_Id']."',
												  '".addslashes($FG_Made[$i])."',
												 '".addslashes($FG_Made_Con[$i])."',
												 '".addslashes($FG_Made_PTS[$i])."',
												 '".addslashes($FG_Made_Tot[$i])."',
												 '1',
												 now())";
					 
				 $this->ExecuteQuery($Ins, "insert");
				
				}
				
				}

				$objSmarty->assign("SuccessMessage","Score details has been updated successfully");
			}
		
		}
else{
			$objSmarty->assign("ErrorMessage","Score details already exist");
		}
			
			
	}	
	
function UpdateScorebyIdDefense(){
		global $objSmarty;
		$selQuery="select * from tbl_defense where  Nfl_Team='".addslashes($_REQUEST['Nfl_Team_defense'])."' and  
		 Player='".addslashes($_REQUEST['Player_defense'])."'  and Score_Id!='".$_REQUEST['CatIdent']."'";
		$count=$this->ExecuteQuery($selQuery, "norows");
		if(!$count){
			$proceed="Yes";
 			
			if($proceed=="Yes"){
				 $upQry="update tbl_score set `Player`='".addslashes($_REQUEST['Player_defense'])."',
												`Game_Week`='".addslashes($_REQUEST['Game_Week_defense'])."',
												`Nfl_Team`='".addslashes($_REQUEST['Nfl_Team_defense'])."',
												`Total`='".addslashes($_REQUEST['Total_sum_defense'])."',
												`Position`='".addslashes($_REQUEST['Position_defense'])."'
				 								where Id='".$_REQUEST['CatIdent']."'";
				$this->ExecuteQuery($upQry, "update");
				  
				   $upQuery="update tbl_defense set 
												`Player`= '".addslashes($_REQUEST['Player_defense'])."',
												`Game_Week`= '".addslashes($_REQUEST['Game_Week_defense'])."',
												`Nfl_Team`= '".addslashes($_REQUEST['Nfl_Team_defense'])."',
												`Position`= '".addslashes($_REQUEST['Position_defense'])."',
												`TurnOver_Int`= '".addslashes($_REQUEST['TurnOver_Int'])."',
												`TurnOver_Int_Con` = '".addslashes($_REQUEST['TurnOver_Int_Con'])."',
												`TurnOver_Int_Tot`=  '".addslashes($_REQUEST['TurnOver_Int_Tot'])."',
												`TurnOver_Fumble`= '".addslashes($_REQUEST['TurnOver_Fumble'])."',
												`TurnOver_Fumble_Con` =  '".addslashes($_REQUEST['TurnOver_Fumble_Con'])."',
												`TurnOver_Fumble_Tot`= '".addslashes($_REQUEST['TurnOver_Fumble_Tot'])."',
												`QB_Sacks`= '".addslashes($_REQUEST['QB_Sacks'])."',
												`QB_Sacks_Con`= '".addslashes($_REQUEST['QB_Sacks_Con'])."',
												`QB_Sacks_Tot`= '".addslashes($_REQUEST['QB_Sacks_Tot'])."',
												`Safety`= '".addslashes($_REQUEST['Safety'])."',
												`Safety_Con`= '".addslashes($_REQUEST['Safety_Con'])."',
												`Safety_Tot`= '".addslashes($_REQUEST['Safety_Tot'])."',
												`TPA`= '".addslashes($_REQUEST['TPA'])."',
												`TPA_Con`= '".addslashes($_REQUEST['TPA_Con'])."',
												`TPA_PTS`= '".addslashes($_REQUEST['TPA_PTS'])."',
												`TPA_Tot`= '".addslashes($_REQUEST['TPA_Tot'])."',
												`TYA`= '".addslashes($_REQUEST['TYA'])."',
												`TYA_Con`=  '".addslashes($_REQUEST['TYA_Con'])."',
												`TYA_PTS`= '".addslashes($_REQUEST['TPA_PTS'])."',
												`TYA_Tot`= '".addslashes($_REQUEST['TYA_Tot'])."', 
												`Total`= '".addslashes($_REQUEST['Total_sum_defense'])."',
												`Status`= '1',
												`Updated_Date`= now()
												where Score_Id='".$_REQUEST['CatIdent']."'";
												
											
												
				$this->ExecuteQuery($upQuery, "update");
				//$lastInsertId=mysql_insert_id();

		
				
			$delQry="DELETE FROM `tbl_def_td` WHERE Score_Id='".addslashes($_REQUEST['Defense_Id'])."'";
			$this->ExecuteQuery($delQry,"delete");	
				
				$D_TD=$_REQUEST['D_TD'];
				$D_TD_Con=$_REQUEST['D_TD_Con'];
				$D_TD_PTS=$_REQUEST['D_TD_PTS'];
				$D_TD_Tot=$_REQUEST['D_TD_Tot'];
				if($D_TD != '')
					{
					for($i=0;$i<count($D_TD);$i++){
						 $Ins="INSERT INTO `tbl_def_td` (
													`Score_Id`,
													`D_TD`,
													`D_TD_Con`,
													`D_TD_PTS`,
													`D_TD_Tot`,
													`Status`,
													`Created_Date`)
													 VALUES (
													 '".$_REQUEST['Defense_Id']."',
													 '".addslashes($D_TD[$i])."',
													 '".addslashes($D_TD_Con[$i])."',
													 '".addslashes($D_TD_PTS[$i])."',
													 '".addslashes($D_TD_Tot[$i])."',
													 '1',
													 now())";
					 $this->ExecuteQuery($Ins, "insert");
					
					}
					}
				
				$objSmarty->assign("SuccessMessage","Score details has been updated successfully");
			}
		}
			else{
			$objSmarty->assign("ErrorMessage","Score details already exist");
		}
		
			
	}	
	
	
function UpdateScorebyIdSpecial(){
		global $objSmarty;
		$selQuery="select * from tbl_special where  Nfl_Team='".addslashes($_REQUEST['Nfl_Team_special'])."' and  
		 Player='".addslashes($_REQUEST['Player_special'])."'  and Score_Id!='".$_REQUEST['CatIdent']."'";
		$count=$this->ExecuteQuery($selQuery, "norows");
		if(!$count){
			
			$proceed="Yes";
 			
			if($proceed=="Yes"){
				 $upQry="update tbl_score set `Player`='".addslashes($_REQUEST['Player_special'])."',
												`Game_Week`='".addslashes($_REQUEST['Game_Week_special'])."',
												`Nfl_Team`='".addslashes($_REQUEST['Nfl_Team_special'])."',
												`Total`='".addslashes($_REQUEST['Total_sum_special'])."',
												`Position`='".addslashes($_REQUEST['Position_special'])."'
				 								where Id='".$_REQUEST['CatIdent']."'";
				$this->ExecuteQuery($upQry, "update");
				
				 $upQuery="update tbl_special set 
												`Player`= '".addslashes($_REQUEST['Player_special'])."',
												`Game_Week`= '".addslashes($_REQUEST['Game_Week_special'])."',
												`Nfl_Team`= '".addslashes($_REQUEST['Nfl_Team_special'])."',
												`Position`= '".addslashes($_REQUEST['Position_special'])."',
												`Yardage_Kick`= '".addslashes($_REQUEST['Yardage_Kick'])."',
												`Yardage_Kick_Con`= '".addslashes($_REQUEST['Yardage_Kick_Con'])."',
												`Yardage_Kick_Tot`= '".addslashes($_REQUEST['Yardage_Kick_Tot'])."',
												`Yardage_Punt`= '".addslashes($_REQUEST['Yardage_Punt'])."',
												`Yardage_Punt_Con`= '".addslashes($_REQUEST['Yardage_Punt_Con'])."',
												`Yardage_Punt_Tot`= '".addslashes($_REQUEST['Yardage_Punt_Tot'])."',
												`Kick_Off`= '".addslashes($_REQUEST['Kick_Off'])."',
												`Kick_Off_Con`= '".addslashes($_REQUEST['Kick_Off_Con'])."',
												`Kick_Off_Tot`= '".addslashes($_REQUEST['Kick_Off_Tot'])."',
												`Punt_Touch`= '".addslashes($_REQUEST['Punt_Touch'])."',
												`Punt_Touch_Con`= '".addslashes($_REQUEST['Punt_Touch_Con'])."',
												`Punt_Touch_Tot`= '".addslashes($_REQUEST['Punt_Touch_Tot'])."',
												`Blocked_Field`= '".addslashes($_REQUEST['Blocked_Field'])."',
												`Blocked_Field_Con`= '".addslashes($_REQUEST['Blocked_Field_Con'])."',
												`Blocked_Field_Tot`= '".addslashes($_REQUEST['Blocked_Field_Tot'])."',
												`Blocked_Punt`='".addslashes($_REQUEST['Blocked_Punt'])."',
												`Blocked_Punt_Con`= '".addslashes($_REQUEST['Blocked_Punt_Con'])."',
												`Blocked_Punt_Tot`= '".addslashes($_REQUEST['Blocked_Punt_Tot'])."',
												`Blocked_Extra`= '".addslashes($_REQUEST['Blocked_Extra'])."',
												`Blocked_Extra_Con`= '".addslashes($_REQUEST['Blocked_Extra_Con'])."',
												`Blocked_Extra_Tot`= '".addslashes($_REQUEST['Blocked_Extra_Tot'])."',
												`Fumble_Recovered`= '".addslashes($_REQUEST['Fumble_Recovered'])."',
												`Fumble_Recovered_Con`= '".addslashes($_REQUEST['Fumble_Recovered_Con'])."',
												`Fumble_Recovered_Tot`= '".addslashes($_REQUEST['Fumble_Recovered_Tot'])."',
												`Fumble_Lost`= '".addslashes($_REQUEST['Fumble_Lost'])."',
												`Fumble_Lost_Con`= '".addslashes($_REQUEST['Fumble_Lost_Con'])."',
												`Fumble_Lost_Tot`= '".addslashes($_REQUEST['Fumble_Lost_Tot'])."',
												`Total`=  '".addslashes($_REQUEST['Total_sum_special'])."',
												`Status`='1',
												`Updated_Date` = now()
												where Score_Id='".$_REQUEST['CatIdent']."'";
												
				$this->ExecuteQuery($upQuery, "update");
				
				
				$delQry="DELETE FROM `tbl_spe_td` WHERE Score_Id='".addslashes($_REQUEST['Special_Id'])."'";
				$this->ExecuteQuery($delQry,"delete");	
				
				$Special_Teams=$_REQUEST['Special_Teams'];
				$Special_Teams_Con=$_REQUEST['Special_Teams_Con'];
				$Special_Teams_PTS=$_REQUEST['Special_Teams_PTS'];
				$Special_Teams_Tot=$_REQUEST['Special_Teams_Tot'];
				if($Special_Teams != '')
					{
					for($i=0;$i<count($Special_Teams);$i++){
						 $Ins="INSERT INTO `tbl_spe_td` (
													`Score_Id`,
													`Special_Teams`,
													`Special_Teams_Con`,
													`Special_Teams_PTS`,
													`Special_Teams_Tot`,
													`Status`,
													`Created_Date`)
													 VALUES (
													 '".$_REQUEST['Special_Id']."',
													 '".addslashes($Special_Teams[$i])."',
													 '".addslashes($Special_Teams_Con[$i])."',
													 '".addslashes($Special_Teams_PTS[$i])."',
													 '".addslashes($Special_Teams_Tot[$i])."',
													 '1',
													 now())";
					 $this->ExecuteQuery($Ins, "insert");
					
					}
					}

				$objSmarty->assign("SuccessMessage","Score details has been updated successfully");
				$objSmarty->assign("Score_Position",$_REQUEST['Position_special']);
			}
		}else{
			$objSmarty->assign("ErrorMessage","Score details already exist");
		}
			
			
	}	
	

	
	
function AddScorebyId(){
		global $objSmarty;
		$selQuery="select * from tbl_score where  Nfl_Team='".addslashes($_REQUEST['Nfl_Team'])."' and  
		 Player='".addslashes($_REQUEST['Player'])."'  and Id!='".$_REQUEST['CatIdent']."'";
		$count=$this->ExecuteQuery($selQuery, "norows");
		if(!$count){
			$proceed="Yes";
 			
			if($proceed=="Yes"){
				 
				  $InsQuery="INSERT INTO `tbl_score` (
												`Player`,
												`Game_Week`,
												`Nfl_Team`,
												`Position`,
												`Y_Pass`,
												`Y_Rush`,
												`Y_Rec`,
												`Y_Pass_Con`,
												`Y_Rush_Con`,
												`Y_Rec_Con`,
												`Y_Pass_Tot`,
												`Y_Rush_Tot`,
												`Y_Rec_Tot`,
												`TO_Int`,
												`TO_Fumble`,
												`TO_Int_Con`,
												`TO_Fumble_Con`,
												`TO_Int_Tot`,
												`TO_Fumble_Tot`,
												`PC_Pass`,
												`PC_Rush`,
												`PC_Rec`,
												`PC_Pass_Con`,
												`PC_Rush_Con`,
												`PC_Rec_Con`,
												`PC_Pass_Tot`,
												`PC_Rush_Tot`,
												`PC_Rec_Tot`,
												`Total`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".addslashes($_REQUEST['Player'])."',
												 '".addslashes($_REQUEST['Game_Week'])."',
												 '".addslashes($_REQUEST['Nfl_Team'])."',
												 '".addslashes($_REQUEST['Position'])."',
												 '".addslashes($_REQUEST['Y_Pass'])."',
												 '".addslashes($_REQUEST['Y_Rush'])."',
												 '".addslashes($_REQUEST['Y_Rec'])."',
												 '".addslashes($_REQUEST['Y_Pass_Con'])."',
												 '".addslashes($_REQUEST['Y_Rush_Con'])."',
												 '".addslashes($_REQUEST['Y_Rec_Con'])."',
												 '".addslashes($_REQUEST['Y_Pass_Tot'])."',
												 '".addslashes($_REQUEST['Y_Rush_Tot'])."',
												 '".addslashes($_REQUEST['Y_Rec_Tot'])."',
												 '".addslashes($_REQUEST['TO_Int'])."',
												 '".addslashes($_REQUEST['TO_Fumble'])."',
												 '".addslashes($_REQUEST['TO_Int_Con'])."',
												 '".addslashes($_REQUEST['TO_Fumble_Con'])."',
												 '".addslashes($_REQUEST['TO_Int_Tot'])."',
												 '".addslashes($_REQUEST['TO_Fumble_Tot'])."',
												 '".addslashes($_REQUEST['PC_Pass'])."',
												 '".addslashes($_REQUEST['PC_Rush'])."',
												 '".addslashes($_REQUEST['PC_Rec'])."',
												 '".addslashes($_REQUEST['PC_Pass_Con'])."',
												 '".addslashes($_REQUEST['PC_Rush_Con'])."',
												 '".addslashes($_REQUEST['PC_Rec_Con'])."',
												 '".addslashes($_REQUEST['PC_Pass_Tot'])."',
												 '".addslashes($_REQUEST['PC_Rush_Tot'])."',
												 '".addslashes($_REQUEST['PC_Rec_Tot'])."',
												 '".addslashes($_REQUEST['Total_sum'])."',
												 '1',
												 now())"; 
			
				$this->ExecuteQuery($InsQuery, "insert");
				$lastInsertId=mysql_insert_id();
				$objSmarty->assign("record",$lastInsertId);
					//$Div=$_REQUEST['TD_Pass'];
				$TD_Pass=$_REQUEST['TD_Pass'];
				$TD_Pass_Con=$_REQUEST['TD_Pass_Con'];
				$TD_Pass_PTS=$_REQUEST['TD_Pass_PTS'];
				$TD_Pass_Tot=$_REQUEST['TD_Pass_Tot'];
				if($TD_Pass != '')
					{
					for($i=0;$i<count($TD_Pass);$i++){
						 $Ins="INSERT INTO `tbl_touch_down` (
													`Score_Id`,
													`TD_Pass`,
													`TD_Pass_Con`,
													`TD_Pass_PTS`,
													`TD_Pass_Tot`,
													`Status`,
													`Created_Date`)
													 VALUES (
													 '".$lastInsertId."',
													  '".addslashes($TD_Pass[$i])."',
													 '".addslashes($TD_Pass_Con[$i])."',
													 '".addslashes($TD_Pass_PTS[$i])."',
													 '".addslashes($TD_Pass_Tot[$i])."',
													 '1',
													 now())";
					 $this->ExecuteQuery($Ins, "insert");
					
					}
					}
				$TD_Rush=$_REQUEST['TD_Rush'];
				$TD_Rush_Con=$_REQUEST['TD_Rush_Con'];
				$TD_Rush_PTS=$_REQUEST['TD_Rush_PTS'];
				$TD_Rush_Tot=$_REQUEST['TD_Rush_Tot'];
				if($TD_Rush != '')
					{
					for($i=0;$i<count($TD_Rush);$i++){
						 $Ins="INSERT INTO `tbl_td_rush` (
													`Score_Id`,
													`TD_Rush`,
													`TD_Rush_Con`,
													`TD_Rush_PTS`,
													`TD_Rush_Tot`,
													`Status`,
													`Created_Date`)
													 VALUES (
													 '".$lastInsertId."',
													  '".addslashes($TD_Rush[$i])."',
													 '".addslashes($TD_Rush_Con[$i])."',
													 '".addslashes($TD_Rush_PTS[$i])."',
													 '".addslashes($TD_Rush_Tot[$i])."',
													 '1',
													 now())";
					 $this->ExecuteQuery($Ins, "insert");
					
					}
					}
				$TD_Rec=$_REQUEST['TD_Rec'];
				$TD_Rec_Con=$_REQUEST['TD_Rec_Con'];
				$TD_Rec_PTS=$_REQUEST['TD_Rec_PTS'];
				$TD_Rec_Tot=$_REQUEST['TD_Rec_Tot'];
				if($TD_Rec != '')
					{
					for($i=0;$i<count($TD_Rec);$i++){
						 $Ins="INSERT INTO `tbl_td_rec` (
													`Score_Id`,
													`TD_Rec`,
													`TD_Rec_Con`,
													`TD_Rec_PTS`,
													`TD_Rec_Tot`,
													`Status`,
													`Created_Date`)
													 VALUES (
													 '".$lastInsertId."',
													  '".addslashes($TD_Rec[$i])."',
													 '".addslashes($TD_Rec_Con[$i])."',
													 '".addslashes($TD_Rec_PTS[$i])."',
													 '".addslashes($TD_Rec_Tot[$i])."',
													 '1',
													 now())";
					 $this->ExecuteQuery($Ins, "insert");
					
					}
					}
				
				$objSmarty->assign("SuccessMessage","Score details has been added successfully");
				
				
			}
		}else{
			$objSmarty->assign("ErrorMessage","Score details already exist");
		}
	
	}
function AddScorebyIdRb(){
		global $objSmarty;
		$selQuery="select * from tbl_score_rb where  Nfl_Team='".addslashes($_REQUEST['Nfl_Team'])."' and  
		 Player='".addslashes($_REQUEST['Player'])."'  and Score_Id!='".$_REQUEST['CatIdent']."'";
		$count=$this->ExecuteQuery($selQuery, "norows");
		if(!$count){
			$proceed="Yes";
 			
			if($proceed=="Yes"){
				 
					  
				   $InsQuery1="INSERT INTO `tbl_score` (
												`Player`,
												`Game_Week`,
												`Nfl_Team`,
												`Position`,
												`Total`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".addslashes($_REQUEST['Player'])."',
												 '".addslashes($_REQUEST['Game_Week'])."',
												 '".addslashes($_REQUEST['Nfl_Team'])."',
												 '".addslashes($_REQUEST['Position'])."',
												 '".addslashes($_REQUEST['Total_sum'])."',
												  '1',
												 now())"; 
				
				$this->ExecuteQuery($InsQuery1, "insert");
				$InsertId=mysql_insert_id();
				
				  $InsQuery="INSERT INTO `tbl_score_rb` (
												`Score_Id`,
												`Player`,
												`Game_Week`,
												`Nfl_Team`,
												`Position`,
												`Y_Pass`,
												`Y_Rush`,
												`Y_Rec`,
												`Y_Pass_Con`,
												`Y_Rush_Con`,
												`Y_Rec_Con`,
												`Y_Pass_Tot`,
												`Y_Rush_Tot`,
												`Y_Rec_Tot`,
												`TO_Int`,
												`TO_Fumble`,
												`TO_Int_Con`,
												`TO_Fumble_Con`,
												`TO_Int_Tot`,
												`TO_Fumble_Tot`,
												`PC_Pass`,
												`PC_Rush`,
												`PC_Rec`,
												`PC_Pass_Con`,
												`PC_Rush_Con`,
												`PC_Rec_Con`,
												`PC_Pass_Tot`,
												`PC_Rush_Tot`,
												`PC_Rec_Tot`,
												`Total`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".addslashes($InsertId)."',
												 '".addslashes($_REQUEST['Player'])."',
												 '".addslashes($_REQUEST['Game_Week'])."',
												 '".addslashes($_REQUEST['Nfl_Team'])."',
												 '".addslashes($_REQUEST['Position'])."',
												 '".addslashes($_REQUEST['Y_Pass'])."',
												 '".addslashes($_REQUEST['Y_Rush'])."',
												 '".addslashes($_REQUEST['Y_Rec'])."',
												 '".addslashes($_REQUEST['Y_Pass_Con'])."',
												 '".addslashes($_REQUEST['Y_Rush_Con'])."',
												 '".addslashes($_REQUEST['Y_Rec_Con'])."',
												 '".addslashes($_REQUEST['Y_Pass_Tot'])."',
												 '".addslashes($_REQUEST['Y_Rush_Tot'])."',
												 '".addslashes($_REQUEST['Y_Rec_Tot'])."',
												 '".addslashes($_REQUEST['TO_Int'])."',
												 '".addslashes($_REQUEST['TO_Fumble'])."',
												 '".addslashes($_REQUEST['TO_Int_Con'])."',
												 '".addslashes($_REQUEST['TO_Fumble_Con'])."',
												 '".addslashes($_REQUEST['TO_Int_Tot'])."',
												 '".addslashes($_REQUEST['TO_Fumble_Tot'])."',
												 '".addslashes($_REQUEST['PC_Pass'])."',
												 '".addslashes($_REQUEST['PC_Rush'])."',
												 '".addslashes($_REQUEST['PC_Rec'])."',
												 '".addslashes($_REQUEST['PC_Pass_Con'])."',
												 '".addslashes($_REQUEST['PC_Rush_Con'])."',
												 '".addslashes($_REQUEST['PC_Rec_Con'])."',
												 '".addslashes($_REQUEST['PC_Pass_Tot'])."',
												 '".addslashes($_REQUEST['PC_Rush_Tot'])."',
												 '".addslashes($_REQUEST['PC_Rec_Tot'])."',
												 '".addslashes($_REQUEST['Total_sum'])."',
												 '1',
												 now())"; 
				$this->ExecuteQuery($InsQuery, "insert");
				$lastInsertId=mysql_insert_id();
				/*$scoreid=$_REQUEST['record_id'];
				$objSmarty->assign("record",$scoreid);*/
					//$Div=$_REQUEST['TD_Pass'];
				$TD_Pass=$_REQUEST['TD_Pass'];
				$TD_Pass_Con=$_REQUEST['TD_Pass_Con'];
				$TD_Pass_PTS=$_REQUEST['TD_Pass_PTS'];
				$TD_Pass_Tot=$_REQUEST['TD_Pass_Tot'];
				if($TD_Pass != '')
					{
					for($i=0;$i<count($TD_Pass);$i++){
						 $Ins="INSERT INTO `tbl_touch_down` (
													`Score_Id`,
													`TD_Pass`,
													`TD_Pass_Con`,
													`TD_Pass_PTS`,
													`TD_Pass_Tot`,
													`Status`,
													`Created_Date`)
													 VALUES (
													 '".$InsertId."',
													  '".addslashes($TD_Pass[$i])."',
													 '".addslashes($TD_Pass_Con[$i])."',
													 '".addslashes($TD_Pass_PTS[$i])."',
													 '".addslashes($TD_Pass_Tot[$i])."',
													 '1',
													 now())";
					 $this->ExecuteQuery($Ins, "insert");
					
					}
					}
				$TD_Rush=$_REQUEST['TD_Rush'];
				$TD_Rush_Con=$_REQUEST['TD_Rush_Con'];
				$TD_Rush_PTS=$_REQUEST['TD_Rush_PTS'];
				$TD_Rush_Tot=$_REQUEST['TD_Rush_Tot'];
				if($TD_Rush != '')
					{
					for($i=0;$i<count($TD_Rush);$i++){
						 $Ins="INSERT INTO `tbl_td_rush` (
													`Score_Id`,
													`TD_Rush`,
													`TD_Rush_Con`,
													`TD_Rush_PTS`,
													`TD_Rush_Tot`,
													`Status`,
													`Created_Date`)
													 VALUES (
													 '".$InsertId."',
													  '".addslashes($TD_Rush[$i])."',
													 '".addslashes($TD_Rush_Con[$i])."',
													 '".addslashes($TD_Rush_PTS[$i])."',
													 '".addslashes($TD_Rush_Tot[$i])."',
													 '1',
													 now())";
					 $this->ExecuteQuery($Ins, "insert");
					
					}
					}
				$TD_Rec=$_REQUEST['TD_Rec'];
				$TD_Rec_Con=$_REQUEST['TD_Rec_Con'];
				$TD_Rec_PTS=$_REQUEST['TD_Rec_PTS'];
				$TD_Rec_Tot=$_REQUEST['TD_Rec_Tot'];
				if($TD_Rec != '')
					{
					for($i=0;$i<count($TD_Rec);$i++){
						 $Ins="INSERT INTO `tbl_td_rec` (
													`Score_Id`,
													`TD_Rec`,
													`TD_Rec_Con`,
													`TD_Rec_PTS`,
													`TD_Rec_Tot`,
													`Status`,
													`Created_Date`)
													 VALUES (
													 '".$InsertId."',
													  '".addslashes($TD_Rec[$i])."',
													 '".addslashes($TD_Rec_Con[$i])."',
													 '".addslashes($TD_Rec_PTS[$i])."',
													 '".addslashes($TD_Rec_Tot[$i])."',
													 '1',
													 now())";
					 $this->ExecuteQuery($Ins, "insert");
					
					}
					}
				
				$objSmarty->assign("SuccessMessage","Score details has been added successfully");
				
				
			}
		}else{
			$objSmarty->assign("ErrorMessage","Score details already exist");
		}
	
	}
function AddScorebyIdWr(){
		global $objSmarty;
		$selQuery="select * from tbl_score_wr where  Nfl_Team='".addslashes($_REQUEST['Nfl_Team'])."' and  
		 Player='".addslashes($_REQUEST['Player'])."'  and Score_Id!='".$_REQUEST['CatIdent']."'";
		$count=$this->ExecuteQuery($selQuery, "norows");
		if(!$count){
			$proceed="Yes";
 			
			if($proceed=="Yes"){
				   $InsQuery1="INSERT INTO `tbl_score` (
												`Player`,
												`Game_Week`,
												`Nfl_Team`,
												`Position`,
												`Total`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".addslashes($_REQUEST['Player'])."',
												 '".addslashes($_REQUEST['Game_Week'])."',
												 '".addslashes($_REQUEST['Nfl_Team'])."',
												 '".addslashes($_REQUEST['Position'])."',
												 '".addslashes($_REQUEST['Total_sum'])."',
												  '1',
												 now())"; 
				
				$this->ExecuteQuery($InsQuery1, "insert");
				$InsertId=mysql_insert_id();
				
				 
				  $InsQuery="INSERT INTO `tbl_score_wr` (
												`Score_Id`,
												`Player`,
												`Game_Week`,
												`Nfl_Team`,
												`Position`,
												`Y_Pass`,
												`Y_Rush`,
												`Y_Rec`,
												`Y_Pass_Con`,
												`Y_Rush_Con`,
												`Y_Rec_Con`,
												`Y_Pass_Tot`,
												`Y_Rush_Tot`,
												`Y_Rec_Tot`,
												`TO_Int`,
												`TO_Fumble`,
												`TO_Int_Con`,
												`TO_Fumble_Con`,
												`TO_Int_Tot`,
												`TO_Fumble_Tot`,
												`PC_Pass`,
												`PC_Rush`,
												`PC_Rec`,
												`PC_Pass_Con`,
												`PC_Rush_Con`,
												`PC_Rec_Con`,
												`PC_Pass_Tot`,
												`PC_Rush_Tot`,
												`PC_Rec_Tot`,
												`Total`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".addslashes($InsertId)."',
												 '".addslashes($_REQUEST['Player'])."',
												 '".addslashes($_REQUEST['Game_Week'])."',
												 '".addslashes($_REQUEST['Nfl_Team'])."',
												 '".addslashes($_REQUEST['Position'])."',
												 '".addslashes($_REQUEST['Y_Pass'])."',
												 '".addslashes($_REQUEST['Y_Rush'])."',
												 '".addslashes($_REQUEST['Y_Rec'])."',
												 '".addslashes($_REQUEST['Y_Pass_Con'])."',
												 '".addslashes($_REQUEST['Y_Rush_Con'])."',
												 '".addslashes($_REQUEST['Y_Rec_Con'])."',
												 '".addslashes($_REQUEST['Y_Pass_Tot'])."',
												 '".addslashes($_REQUEST['Y_Rush_Tot'])."',
												 '".addslashes($_REQUEST['Y_Rec_Tot'])."',
												 '".addslashes($_REQUEST['TO_Int'])."',
												 '".addslashes($_REQUEST['TO_Fumble'])."',
												 '".addslashes($_REQUEST['TO_Int_Con'])."',
												 '".addslashes($_REQUEST['TO_Fumble_Con'])."',
												 '".addslashes($_REQUEST['TO_Int_Tot'])."',
												 '".addslashes($_REQUEST['TO_Fumble_Tot'])."',
												 '".addslashes($_REQUEST['PC_Pass'])."',
												 '".addslashes($_REQUEST['PC_Rush'])."',
												 '".addslashes($_REQUEST['PC_Rec'])."',
												 '".addslashes($_REQUEST['PC_Pass_Con'])."',
												 '".addslashes($_REQUEST['PC_Rush_Con'])."',
												 '".addslashes($_REQUEST['PC_Rec_Con'])."',
												 '".addslashes($_REQUEST['PC_Pass_Tot'])."',
												 '".addslashes($_REQUEST['PC_Rush_Tot'])."',
												 '".addslashes($_REQUEST['PC_Rec_Tot'])."',
												 '".addslashes($_REQUEST['Total_sum'])."',
												 '1',
												 now())"; 
				$this->ExecuteQuery($InsQuery, "insert");
				$lastInsertId=mysql_insert_id();
				$scoreid=$_REQUEST['record_id'];
				$objSmarty->assign("record",$scoreid);
					//$Div=$_REQUEST['TD_Pass'];
				$TD_Pass=$_REQUEST['TD_Pass'];
				$TD_Pass_Con=$_REQUEST['TD_Pass_Con'];
				$TD_Pass_PTS=$_REQUEST['TD_Pass_PTS'];
				$TD_Pass_Tot=$_REQUEST['TD_Pass_Tot'];
				if($TD_Pass != '')
					{
					for($i=0;$i<count($TD_Pass);$i++){
						 $Ins="INSERT INTO `tbl_touch_down` (
													`Score_Id`,
													`TD_Pass`,
													`TD_Pass_Con`,
													`TD_Pass_PTS`,
													`TD_Pass_Tot`,
													`Status`,
													`Created_Date`)
													 VALUES (
													 '".$InsertId."',
													  '".addslashes($TD_Pass[$i])."',
													 '".addslashes($TD_Pass_Con[$i])."',
													 '".addslashes($TD_Pass_PTS[$i])."',
													 '".addslashes($TD_Pass_Tot[$i])."',
													 '1',
													 now())";
					 $this->ExecuteQuery($Ins, "insert");
					
					}
					}
				$TD_Rush=$_REQUEST['TD_Rush'];
				$TD_Rush_Con=$_REQUEST['TD_Rush_Con'];
				$TD_Rush_PTS=$_REQUEST['TD_Rush_PTS'];
				$TD_Rush_Tot=$_REQUEST['TD_Rush_Tot'];
				if($TD_Rush != '')
					{
					for($i=0;$i<count($TD_Rush);$i++){
						 $Ins="INSERT INTO `tbl_td_rush` (
													`Score_Id`,
													`TD_Rush`,
													`TD_Rush_Con`,
													`TD_Rush_PTS`,
													`TD_Rush_Tot`,
													`Status`,
													`Created_Date`)
													 VALUES (
													 '".$InsertId."',
													  '".addslashes($TD_Rush[$i])."',
													 '".addslashes($TD_Rush_Con[$i])."',
													 '".addslashes($TD_Rush_PTS[$i])."',
													 '".addslashes($TD_Rush_Tot[$i])."',
													 '1',
													 now())";
					 $this->ExecuteQuery($Ins, "insert");
					
					}
					}
				$TD_Rec=$_REQUEST['TD_Rec'];
				$TD_Rec_Con=$_REQUEST['TD_Rec_Con'];
				$TD_Rec_PTS=$_REQUEST['TD_Rec_PTS'];
				$TD_Rec_Tot=$_REQUEST['TD_Rec_Tot'];
				if($TD_Rec != '')
					{
					for($i=0;$i<count($TD_Rec);$i++){
						 $Ins="INSERT INTO `tbl_td_rec` (
													`Score_Id`,
													`TD_Rec`,
													`TD_Rec_Con`,
													`TD_Rec_PTS`,
													`TD_Rec_Tot`,
													`Status`,
													`Created_Date`)
													 VALUES (
													 '".$InsertId."',
													  '".addslashes($TD_Rec[$i])."',
													 '".addslashes($TD_Rec_Con[$i])."',
													 '".addslashes($TD_Rec_PTS[$i])."',
													 '".addslashes($TD_Rec_Tot[$i])."',
													 '1',
													 now())";
					 $this->ExecuteQuery($Ins, "insert");
					
					}
					}
				
				$objSmarty->assign("SuccessMessage","Score details has been added successfully");
				
				
			}
		}else{
			$objSmarty->assign("ErrorMessage","Score details already exist");
		}
	
	}
function AddScorebyIdTe(){
		global $objSmarty;
		$selQuery="select * from tbl_score_te where  Nfl_Team='".addslashes($_REQUEST['Nfl_Team'])."' and  
		 Player='".addslashes($_REQUEST['Player'])."'  and Score_Id!='".$_REQUEST['CatIdent']."'";
		$count=$this->ExecuteQuery($selQuery, "norows");
		if(!$count){
			$proceed="Yes";
 			
			if($proceed=="Yes"){
				 
				   $InsQuery1="INSERT INTO `tbl_score` (
												`Player`,
												`Game_Week`,
												`Nfl_Team`,
												`Position`,
												`Total`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".addslashes($_REQUEST['Player'])."',
												 '".addslashes($_REQUEST['Game_Week'])."',
												 '".addslashes($_REQUEST['Nfl_Team'])."',
												 '".addslashes($_REQUEST['Position'])."',
												 '".addslashes($_REQUEST['Total_sum'])."',
												  '1',
												 now())"; 
				
				$this->ExecuteQuery($InsQuery1, "insert");
				$InsertId=mysql_insert_id();
				
				
				
				  $InsQuery="INSERT INTO `tbl_score_te` (
												`Score_Id`,
												`Player`,
												`Game_Week`,
												`Nfl_Team`,
												`Position`,
												`Y_Pass`,
												`Y_Rush`,
												`Y_Rec`,
												`Y_Pass_Con`,
												`Y_Rush_Con`,
												`Y_Rec_Con`,
												`Y_Pass_Tot`,
												`Y_Rush_Tot`,
												`Y_Rec_Tot`,
												`TO_Int`,
												`TO_Fumble`,
												`TO_Int_Con`,
												`TO_Fumble_Con`,
												`TO_Int_Tot`,
												`TO_Fumble_Tot`,
												`PC_Pass`,
												`PC_Rush`,
												`PC_Rec`,
												`PC_Pass_Con`,
												`PC_Rush_Con`,
												`PC_Rec_Con`,
												`PC_Pass_Tot`,
												`PC_Rush_Tot`,
												`PC_Rec_Tot`,
												`Total`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".addslashes($InsertId)."',
												 '".addslashes($_REQUEST['Player'])."',
												 '".addslashes($_REQUEST['Game_Week'])."',
												 '".addslashes($_REQUEST['Nfl_Team'])."',
												 '".addslashes($_REQUEST['Position'])."',
												 '".addslashes($_REQUEST['Y_Pass'])."',
												 '".addslashes($_REQUEST['Y_Rush'])."',
												 '".addslashes($_REQUEST['Y_Rec'])."',
												 '".addslashes($_REQUEST['Y_Pass_Con'])."',
												 '".addslashes($_REQUEST['Y_Rush_Con'])."',
												 '".addslashes($_REQUEST['Y_Rec_Con'])."',
												 '".addslashes($_REQUEST['Y_Pass_Tot'])."',
												 '".addslashes($_REQUEST['Y_Rush_Tot'])."',
												 '".addslashes($_REQUEST['Y_Rec_Tot'])."',
												 '".addslashes($_REQUEST['TO_Int'])."',
												 '".addslashes($_REQUEST['TO_Fumble'])."',
												 '".addslashes($_REQUEST['TO_Int_Con'])."',
												 '".addslashes($_REQUEST['TO_Fumble_Con'])."',
												 '".addslashes($_REQUEST['TO_Int_Tot'])."',
												 '".addslashes($_REQUEST['TO_Fumble_Tot'])."',
												 '".addslashes($_REQUEST['PC_Pass'])."',
												 '".addslashes($_REQUEST['PC_Rush'])."',
												 '".addslashes($_REQUEST['PC_Rec'])."',
												 '".addslashes($_REQUEST['PC_Pass_Con'])."',
												 '".addslashes($_REQUEST['PC_Rush_Con'])."',
												 '".addslashes($_REQUEST['PC_Rec_Con'])."',
												 '".addslashes($_REQUEST['PC_Pass_Tot'])."',
												 '".addslashes($_REQUEST['PC_Rush_Tot'])."',
												 '".addslashes($_REQUEST['PC_Rec_Tot'])."',
												 '".addslashes($_REQUEST['Total_sum'])."',
												 '1',
												 now())"; 
				$this->ExecuteQuery($InsQuery, "insert");
				$lastInsertId=mysql_insert_id();
				$scoreid=$_REQUEST['record_id'];
				$objSmarty->assign("record",$scoreid);
				//$Div=$_REQUEST['TD_Pass'];
				$TD_Pass=$_REQUEST['TD_Pass'];
				$TD_Pass_Con=$_REQUEST['TD_Pass_Con'];
				$TD_Pass_PTS=$_REQUEST['TD_Pass_PTS'];
				$TD_Pass_Tot=$_REQUEST['TD_Pass_Tot'];
				if($TD_Pass != '')
					{
					for($i=0;$i<count($TD_Pass);$i++){
						 $Ins="INSERT INTO `tbl_touch_down` (
													`Score_Id`,
													`TD_Pass`,
													`TD_Pass_Con`,
													`TD_Pass_PTS`,
													`TD_Pass_Tot`,
													`Status`,
													`Created_Date`)
													 VALUES (
													 '".$InsertId."',
													  '".addslashes($TD_Pass[$i])."',
													 '".addslashes($TD_Pass_Con[$i])."',
													 '".addslashes($TD_Pass_PTS[$i])."',
													 '".addslashes($TD_Pass_Tot[$i])."',
													 '1',
													 now())";
					 $this->ExecuteQuery($Ins, "insert");
					
					}
					}
				$TD_Rush=$_REQUEST['TD_Rush'];
				$TD_Rush_Con=$_REQUEST['TD_Rush_Con'];
				$TD_Rush_PTS=$_REQUEST['TD_Rush_PTS'];
				$TD_Rush_Tot=$_REQUEST['TD_Rush_Tot'];
				if($TD_Rush != '')
					{
					for($i=0;$i<count($TD_Rush);$i++){
						 $Ins="INSERT INTO `tbl_td_rush` (
													`Score_Id`,
													`TD_Rush`,
													`TD_Rush_Con`,
													`TD_Rush_PTS`,
													`TD_Rush_Tot`,
													`Status`,
													`Created_Date`)
													 VALUES (
													 '".$InsertId."',
													  '".addslashes($TD_Rush[$i])."',
													 '".addslashes($TD_Rush_Con[$i])."',
													 '".addslashes($TD_Rush_PTS[$i])."',
													 '".addslashes($TD_Rush_Tot[$i])."',
													 '1',
													 now())";
					 $this->ExecuteQuery($Ins, "insert");
					
					}
					}
				$TD_Rec=$_REQUEST['TD_Rec'];
				$TD_Rec_Con=$_REQUEST['TD_Rec_Con'];
				$TD_Rec_PTS=$_REQUEST['TD_Rec_PTS'];
				$TD_Rec_Tot=$_REQUEST['TD_Rec_Tot'];
				if($TD_Rec != '')
					{
					for($i=0;$i<count($TD_Rec);$i++){
						 $Ins="INSERT INTO `tbl_td_rec` (
													`Score_Id`,
													`TD_Rec`,
													`TD_Rec_Con`,
													`TD_Rec_PTS`,
													`TD_Rec_Tot`,
													`Status`,
													`Created_Date`)
													 VALUES (
													 '".$InsertId."',
													  '".addslashes($TD_Rec[$i])."',
													 '".addslashes($TD_Rec_Con[$i])."',
													 '".addslashes($TD_Rec_PTS[$i])."',
													 '".addslashes($TD_Rec_Tot[$i])."',
													 '1',
													 now())";
					 $this->ExecuteQuery($Ins, "insert");
					
					}
					}
				
				$objSmarty->assign("SuccessMessage","Score details has been added successfully");
				
				
			}
		}else{
			$objSmarty->assign("ErrorMessage","Score details already exist");
		}
	
	}

function AddScorebyIdKickers(){
		global $objSmarty;
		$selQuery="select * from tbl_kickers where  Nfl_Team='".addslashes($_REQUEST['Nfl_Team_kickers'])."' and  
		 Player='".addslashes($_REQUEST['Player_kickers'])."'  and Score_Id!='".$_REQUEST['CatIdent']."'";
		$count=$this->ExecuteQuery($selQuery, "norows");
		if(!$count){
			$proceed="Yes";
 			
			if($proceed=="Yes"){
				 
				   $InsQuery1="INSERT INTO `tbl_score` (
												`Player`,
												`Game_Week`,
												`Nfl_Team`,
												`Position`,
												`Total`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".addslashes($_REQUEST['Player_kickers'])."',
												 '".addslashes($_REQUEST['Game_Week_kickers'])."',
												 '".addslashes($_REQUEST['Nfl_Team_kickers'])."',
												 '".addslashes($_REQUEST['Position_kickers'])."',
												 '".addslashes($_REQUEST['Total_sum_kicker'])."',
												  '1',
												 now())"; 
				
				$this->ExecuteQuery($InsQuery1, "insert");
				$InsertId=mysql_insert_id();
				
				
				  $InsQuery="INSERT INTO `tbl_kickers` (
				  								`Score_Id`,
												`Player`,
												`Game_Week`,
												`Nfl_Team`,
												`Position`,
												`EP_Made`,
												`EP_Made_Con`,
												`EP_Made_Tot`,
												`EP_Missed`,
												`EP_Missed_Con`,
												`EP_Missed_Tot`,
												`FG_Missed`,
												`FG_Missed_Con`,
												`FG_Missed_Tot`,
												`Total_Kicker`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".addslashes($InsertId)."',
												 '".addslashes($_REQUEST['Player_kickers'])."',
												 '".addslashes($_REQUEST['Game_Week_kickers'])."',
												 '".addslashes($_REQUEST['Nfl_Team_kickers'])."',
												 '".addslashes($_REQUEST['Position_kickers'])."',
												 '".addslashes($_REQUEST['EP_Made'])."',
												 '".addslashes($_REQUEST['EP_Made_Con'])."',
												 '".addslashes($_REQUEST['EP_Made_Tot'])."',
												 '".addslashes($_REQUEST['EP_Missed'])."',
												 '".addslashes($_REQUEST['EP_Missed_Con'])."',
												 '".addslashes($_REQUEST['EP_Missed_Tot'])."',
												 '".addslashes($_REQUEST['FG_Missed'])."',
												 '".addslashes($_REQUEST['FG_Missed_Con'])."',
												 '".addslashes($_REQUEST['FG_Missed_Tot'])."',
												 '".addslashes($_REQUEST['Total_sum_kicker'])."',
												 '1',
												 now())"; 
				$this->ExecuteQuery($InsQuery, "insert");
				$lastInsertId=mysql_insert_id();
				$scoreid=$_REQUEST['record_kickers'];
				$objSmarty->assign("record",$scoreid);
			$FG_Made=$_REQUEST['FG_Made'];
			$FG_Made_Con=$_REQUEST['FG_Made_Con'];
			$FG_Made_PTS=$_REQUEST['FG_Made_PTS'];
			$FG_Made_Tot=$_REQUEST['FG_Made_Tot'];
			if($FG_Made != '')
			{
			for($i=0;$i<count($FG_Made);$i++){
				
					 $Ins="INSERT INTO `tbl_fgmade` (
												`Score_Id`,
												`FG_Made`,
												`FG_Made_Con`,
												`FG_Made_PTS`,
												`FG_Made_Tot`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".$InsertId."',
												  '".addslashes($FG_Made[$i])."',
												 '".addslashes($FG_Made_Con[$i])."',
												 '".addslashes($FG_Made_PTS[$i])."',
												 '".addslashes($FG_Made_Tot[$i])."',
												 '1',
												 now())";
					 
				 $this->ExecuteQuery($Ins, "insert");
				
				}
				
				}

				$objSmarty->assign("SuccessMessage","Score details has been added successfully");
			}
		}else{
			$objSmarty->assign("ErrorMessage","Score details already exist");
		}
	}
function AddScorebyIdDefense(){
		global $objSmarty;
		$selQuery="select * from tbl_defense where  Nfl_Team='".addslashes($_REQUEST['Nfl_Team_defense'])."' and  
		 Player='".addslashes($_REQUEST['Player_defense'])."'  and Score_Id!='".$_REQUEST['CatIdent']."'";
		$count=$this->ExecuteQuery($selQuery, "norows");
		if(!$count){
			$proceed="Yes";
 			
			if($proceed=="Yes"){
				    $InsQuery1="INSERT INTO `tbl_score` (
												`Player`,
												`Game_Week`,
												`Nfl_Team`,
												`Position`,
												`Total`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".addslashes($_REQUEST['Player_defense'])."',
												 '".addslashes($_REQUEST['Game_Week_defense'])."',
												 '".addslashes($_REQUEST['Nfl_Team_defense'])."',
												 '".addslashes($_REQUEST['Position_defense'])."',
												 '".addslashes($_REQUEST['Total_sum_defense'])."',
												  '1',
												 now())"; 
				
				$this->ExecuteQuery($InsQuery1, "insert");
				$InsertId=mysql_insert_id();
				
				
				
				  $InsQuery="INSERT INTO `tbl_defense` (
												`Score_Id`,
												`Player`,
												`Game_Week`,
												`Nfl_Team`,
												`Position`,
												`TurnOver_Int`,
												`TurnOver_Int_Con`,
												`TurnOver_Int_Tot`,
												`TurnOver_Fumble`,
												`TurnOver_Fumble_Con`,
												`TurnOver_Fumble_Tot`,
												`QB_Sacks`,
												`QB_Sacks_Con`,
												`QB_Sacks_Tot`,
												`Safety`,
												`Safety_Con`,
												`Safety_Tot`,
												`TPA`,
												`TPA_Con`,
												`TPA_PTS`,
												`TPA_Tot`,
												`TYA`,
												`TYA_Con`,
												`TYA_PTS`,
												`TYA_Tot`,
												`Total`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".addslashes($InsertId)."',
												 '".addslashes($_REQUEST['Player_defense'])."',
												 '".addslashes($_REQUEST['Game_Week_defense'])."',
												 '".addslashes($_REQUEST['Nfl_Team_defense'])."',
												 '".addslashes($_REQUEST['Position_defense'])."',
												 '".addslashes($_REQUEST['TurnOver_Int'])."',
												 '".addslashes($_REQUEST['TurnOver_Int_Con'])."',
												 '".addslashes($_REQUEST['TurnOver_Int_Tot'])."',
												 '".addslashes($_REQUEST['TurnOver_Fumble'])."',
												 '".addslashes($_REQUEST['TurnOver_Fumble_Con'])."',
												 '".addslashes($_REQUEST['TurnOver_Fumble_Tot'])."',
												 '".addslashes($_REQUEST['QB_Sacks'])."',
												 '".addslashes($_REQUEST['QB_Sacks_Con'])."',
												 '".addslashes($_REQUEST['QB_Sacks_Tot'])."',
												 '".addslashes($_REQUEST['Safety'])."',
												 '".addslashes($_REQUEST['Safety_Con'])."',
												 '".addslashes($_REQUEST['Safety_Tot'])."',
												 '".addslashes($_REQUEST['TPA'])."',
												 '".addslashes($_REQUEST['TPA_Con'])."',
												 '".addslashes($_REQUEST['TPA_PTS'])."',
												 '".addslashes($_REQUEST['TPA_Tot'])."',
												 '".addslashes($_REQUEST['TYA'])."',
												 '".addslashes($_REQUEST['TYA_Con'])."',
												 '".addslashes($_REQUEST['TYA_PTS'])."',
												 '".addslashes($_REQUEST['TYA_Tot'])."',
												 '".addslashes($_REQUEST['Total_sum_defense'])."',
												 '1',
												 now())"; 
				$this->ExecuteQuery($InsQuery, "insert");
				$lastInsertId=mysql_insert_id();
				$scoreid=$_REQUEST['record_defense'];
				$objSmarty->assign("record",$scoreid);
				$D_TD=$_REQUEST['D_TD'];
				$D_TD_Con=$_REQUEST['D_TD_Con'];
				$D_TD_PTS=$_REQUEST['D_TD_PTS'];
				$D_TD_Tot=$_REQUEST['D_TD_Tot'];
				if($D_TD != '')
					{
					for($i=0;$i<count($D_TD);$i++){
						 $Ins="INSERT INTO `tbl_def_td` (
													`Score_Id`,
													`D_TD`,
													`D_TD_Con`,
													`D_TD_PTS`,
													`D_TD_Tot`,
													`Status`,
													`Created_Date`)
													 VALUES (
													 '".$lastInsertId."',
													 '".addslashes($D_TD[$i])."',
													 '".addslashes($D_TD_Con[$i])."',
													 '".addslashes($D_TD_PTS[$i])."',
													 '".addslashes($D_TD_Tot[$i])."',
													 '1',
													 now())";
					 $this->ExecuteQuery($Ins, "insert");
					
					}
					}
				
				$objSmarty->assign("SuccessMessage","Score details has been added successfully");
			}
		}
		else{
			$objSmarty->assign("ErrorMessage","Score details already exist");
		}
	}
function AddScorebyIdSpecial(){
		global $objSmarty;
		$selQuery="select * from tbl_special where  Nfl_Team='".addslashes($_REQUEST['Nfl_Team_special'])."' and  
		 Player='".addslashes($_REQUEST['Player_special'])."'  and Score_Id!='".$_REQUEST['CatIdent']."'";
		$count=$this->ExecuteQuery($selQuery, "norows");
		if(!$count){
			$proceed="Yes";
 			
			if($proceed=="Yes"){
				    $InsQuery1="INSERT INTO `tbl_score` (
												`Player`,
												`Game_Week`,
												`Nfl_Team`,
												`Position`,
												`Total`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".addslashes($_REQUEST['Player_special'])."',
												 '".addslashes($_REQUEST['Game_Week_special'])."',
												 '".addslashes($_REQUEST['Nfl_Team_special'])."',
												 '".addslashes($_REQUEST['Position_special'])."',
												 '".addslashes($_REQUEST['Total_sum_special'])."',
												  '1',
												 now())"; 
				
				$this->ExecuteQuery($InsQuery1, "insert");
				$InsertId=mysql_insert_id();
				
				
				
				  $InsQuery="INSERT INTO `tbl_special` (
												`Score_Id`,
												`Player`,
												`Game_Week`,
												`Nfl_Team`,
												`Position`,
												`Yardage_Kick`,
												`Yardage_Kick_Con`,
												`Yardage_Kick_Tot`,
												`Yardage_Punt`,
												`Yardage_Punt_Con`,
												`Yardage_Punt_Tot`,
												`Kick_Off`,
												`Kick_Off_Con`,
												`Kick_Off_Tot`,
												`Punt_Touch`,
												`Punt_Touch_Con`,
												`Punt_Touch_Tot`,
												`Blocked_Field`,
												`Blocked_Field_Con`,
												`Blocked_Field_Tot`,
												`Blocked_Punt`,
												`Blocked_Punt_Con`,
												`Blocked_Punt_Tot`,
												`Blocked_Extra`,
												`Blocked_Extra_Con`,
												`Blocked_Extra_Tot`,
												`Fumble_Recovered`,
												`Fumble_Recovered_Con`,
												`Fumble_Recovered_Tot`,
												`Fumble_Lost`,
												`Fumble_Lost_Con`,
												`Fumble_Lost_Tot`,
												`Total`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".addslashes($InsertId)."',
												 '".addslashes($_REQUEST['Player_special'])."',
												 '".addslashes($_REQUEST['Game_Week_special'])."',
												 '".addslashes($_REQUEST['Nfl_Team_special'])."',
												 '".addslashes($_REQUEST['Position_special'])."',
												 '".addslashes($_REQUEST['Yardage_Kick'])."',
												 '".addslashes($_REQUEST['Yardage_Kick_Con'])."',
												 '".addslashes($_REQUEST['Yardage_Kick_Tot'])."',
												 '".addslashes($_REQUEST['Yardage_Punt'])."',
												 '".addslashes($_REQUEST['Yardage_Punt_Con'])."',
												 '".addslashes($_REQUEST['Yardage_Punt_Tot'])."',
												 '".addslashes($_REQUEST['Kick_Off'])."',
												 '".addslashes($_REQUEST['Kick_Off_Con'])."',
												 '".addslashes($_REQUEST['Kick_Off_Tot'])."',
												 '".addslashes($_REQUEST['Punt_Touch'])."',
												 '".addslashes($_REQUEST['Punt_Touch_Con'])."',
												 '".addslashes($_REQUEST['Punt_Touch_Tot'])."',
												 '".addslashes($_REQUEST['Blocked_Field'])."',
												 '".addslashes($_REQUEST['Blocked_Field_Con'])."',
												 '".addslashes($_REQUEST['Blocked_Field_Tot'])."',
												 '".addslashes($_REQUEST['Blocked_Punt'])."',
												 '".addslashes($_REQUEST['Blocked_Punt_Con'])."',
												 '".addslashes($_REQUEST['Blocked_Punt_Tot'])."',
												 '".addslashes($_REQUEST['Blocked_Extra'])."',
												 '".addslashes($_REQUEST['Blocked_Extra_Con'])."',
												 '".addslashes($_REQUEST['Blocked_Extra_Tot'])."',
												 '".addslashes($_REQUEST['Fumble_Recovered'])."',
												 '".addslashes($_REQUEST['Fumble_Recovered_Con'])."',
												 '".addslashes($_REQUEST['Fumble_Recovered_Tot'])."',
												 '".addslashes($_REQUEST['Fumble_Lost'])."',
												 '".addslashes($_REQUEST['Fumble_Lost_Con'])."',
												 '".addslashes($_REQUEST['Fumble_Lost_Tot'])."',
												 '".addslashes($_REQUEST['Total_sum_special'])."',
												 '1',
												 now())"; 
				$this->ExecuteQuery($InsQuery, "insert");
				$lastInsertId=mysql_insert_id();
				
				//$scoreid=$_REQUEST['record_special'];
				//$objSmarty->assign("record",$scoreid);
				
				
				$Special_Teams=$_REQUEST['Special_Teams'];
				$Special_Teams_Con=$_REQUEST['Special_Teams_Con'];
				$Special_Teams_PTS=$_REQUEST['Special_Teams_PTS'];
				$Special_Teams_Tot=$_REQUEST['Special_Teams_Tot'];
				if($Special_Teams != '')
					{
					for($i=0;$i<count($Special_Teams);$i++){
						 $Ins="INSERT INTO `tbl_spe_td` (
													`Score_Id`,
													`Special_Teams`,
													`Special_Teams_Con`,
													`Special_Teams_PTS`,
													`Special_Teams_Tot`,
													`Status`,
													`Created_Date`)
													 VALUES (
													 '".$lastInsertId."',
													  '".addslashes($Special_Teams[$i])."',
													 '".addslashes($Special_Teams_Con[$i])."',
													 '".addslashes($Special_Teams_PTS[$i])."',
													 '".addslashes($Special_Teams_Tot[$i])."',
													 '1',
													 now())";
					 $this->ExecuteQuery($Ins, "insert");
					
					}
					}
				$this->ExecuteQuery($upQuery, "update");

				$objSmarty->assign("SuccessMessage","Score details has been added successfully");
			}
		}
		else{
			$objSmarty->assign("ErrorMessage","Score details already exist");
		}
	}
		
function updateDivisionbyTeam(){
	
		global $objSmarty;
		$Div=$_REQUEST['Division'];
		$Team=$_REQUEST['Team_Id'];
			if($Team != '')
				{
				for($i=0;$i<count($Team);$i++){
					
					$upQuery="update tbl_division set
												`Division`='".trim(addslashes($Div[$i]))."',
												`Updated_Date`=now()
												where Team='".trim(addslashes($Team[$i]))."'";
				$this->ExecuteQuery($upQuery, "update");
				}
				$objSmarty->assign("SuccessMessage","Division details has been updated successfully");
				}
				
		
	}
		
function updateGrandAccessbyUser(){
	
		global $objSmarty;
		$access=$_REQUEST['access'];
		$User=$_REQUEST['User_Id'];
			if($User != '')
				{
				for($i=0;$i<count($User);$i++){
					
				 $upQuery="update tbl_grand set
												`Grand_access`='".trim(addslashes($access[$i]))."',
												`Updated_Date`=now()
												where User_Id='".trim(addslashes($User[$i]))."'";
				$this->ExecuteQuery($upQuery, "update");
				}
				$objSmarty->assign("SuccessMessage","Grand access details has been updated successfully");
				
				}
		
	}
		
	
function getAllUsers()
{
		global $objSmarty;
		$selQuery="select * from tbl_league order by League asc";
		$res=$this->ExecuteQuery($selQuery, "select");
		$objSmarty->assign("league",$res);
	}
function getAllDivision()
{
		global $objSmarty;
		 $selQuery="select * from  tbl_division where Status != '' order by Team asc";
		$res=$this->ExecuteQuery($selQuery, "select");
		$resultCnt=$this->ExecuteQuery($selQuery, "norows");
		$objSmarty->assign("division",$res);
		$objSmarty->assign("totcount",$resultCnt);
		$i=1;
		 $objSmarty->assign("i",$i);
	}		
		
	function getAllinjuries()
	{
		global $objSmarty;
		if($_REQUEST['Position'] != '' && $_REQUEST['Position'] != 'ALL')
		{
			$selQuery="select * from tbl_injury where Position='".$_REQUEST['Position']."' order by Name asc";
		}
		else if($_REQUEST['Position'] == 'ALL')
		{
			$selQuery="select * from tbl_injury order by Name asc";
		}
		else
		{
			$selQuery="select * from tbl_injury order by Name asc";
		}
		
		$res=$this->ExecuteQuery($selQuery, "select");
		$resultCnt=$this->ExecuteQuery($selQuery, "norows");
		$objSmarty->assign("injuries",$res);
		$objSmarty->assign("totcount",$resultCnt);
		$i=1;
		 $objSmarty->assign("i",$i);
		
	}
	
function getAllUserByAccess()
{
		global $objSmarty;
		$selQuery="select * from  tbl_grand where Status != '' order by User_Id asc";
		$res=$this->ExecuteQuery($selQuery, "select");
		$resultCnt=$this->ExecuteQuery($selQuery, "norows");
		$objSmarty->assign("Users",$res);
		$objSmarty->assign("totcount",$resultCnt);
		$i=1;
		 $objSmarty->assign("i",$i);
	}

function getUserNameById($id)
	{
		global $objSmarty;
		$selqry="select * from tbl_user where Id='$id'";
		$res=$this->ExecuteQuery($selqry,"select");
		return $res[0]['User_Name'];
	
	}	
function getUserByLeague($id)
	{
		global $objSmarty;
		$selqry="select * from tbl_user where Team='$id'";
		$res=$this->ExecuteQuery($selqry,"select");
		$resultCnt=$this->ExecuteQuery($selQuery, "norows");
		$objSmarty->assign("Owner",$res);
		$objSmarty->assign("totcount",$resultCnt);
	
	}	
function getAllTeamOwner()
{
		global $objSmarty;
		 $selQuery="select * from  tbl_league where Status != '' order by League asc";
		$res=$this->ExecuteQuery($selQuery, "select");
		$resultCnt=$this->ExecuteQuery($selQuery, "norows");
		$objSmarty->assign("league",$res);
		$objSmarty->assign("totcount",$resultCnt);
		$i=1;
		 $objSmarty->assign("i",$i);
	}	
function getScoreTotalId($id)
{
		global $objSmarty;
		$selQuery="select * from  tbl_score where Player='$id'";
		$res=$this->ExecuteQuery($selQuery, "select");
		$tot=$res[0]['Total'];
		$total= number_format($tot, 2);
		/*$yp= $res[0]['Y_Pass_Tot'];
		$yr= $res[0]['Y_Rush_Tot'];
		$ye =$res[0]['Y_Rec_Tot'];
		$tp= $res[0]['TD_Pass_Tot'];
		$tr= $res[0]['TD_Rush_Tot'];
		$te =$res[0]['TD_Rec_Tot'];
		$ti= $res[0]['TO_Int_Tot'];
		$tf= $res[0]['TO_Fumble_Tot'];
		$pp= $res[0]['PC_Pass_Tot'];
		$pr= $res[0]['PC_Rush_Tot'];
		$pe =$res[0]['PC_Rec_Tot'];
		//$total= ($yp) + $yr + $ye + $tp + $tr + $te + $ti + $tf + $pp + $pr +  $pe;
		$tot= ($yp) + ($yr) + ($ye) + ($tp) + ($tr) + ($te) + ($ti) + ($tf) + ($pp) + ($pr) + ($pe);
		$total= number_format($tot, 2);*/
		return $total;
	}
function getQBPlayers()
{
		global $objSmarty;
		$selQuery="select *,p.Player_Name as Player_Name,p.Id as pId, t.Team as pTeam from  tbl_player as p
		left join  tbl_team as t on p.Team = t.Id 
		 where p.Status != '' and t.Position !='RB' and t.Position !='TE' and t.Position !='WR' order by t.Team asc";
		$res=$this->ExecuteQuery($selQuery, "select");
		$resultCnt=$this->ExecuteQuery($selQuery, "norows");
		$objSmarty->assign("qbplayer",$res);
	
	}	
	
function getRBPlayers()
{
		global $objSmarty;
		$selQuery="select *,p.Player_Name as Player_Name,p.Id as pId, t.Team as pTeam from  tbl_player as p
		 left join  tbl_team as t on p.Team = t.Id 
		  where p.Status != '' and t.Position='RB' order by p.Player_name asc";
		$res=$this->ExecuteQuery($selQuery, "select");
		$resultCnt=$this->ExecuteQuery($selQuery, "norows");
		$objSmarty->assign("rbplayer",$res);
	
	}	
function getWRPlayers()
{
		global $objSmarty;
		$selQuery="select *,p.Player_Name as Player_Name,p.Id as pId, t.Team as pTeam from  tbl_player as p
		 left join  tbl_team as t on p.Team = t.Id 
		  where p.Status != '' and t.Position='WR' order by p.Player_name asc";
		$res=$this->ExecuteQuery($selQuery, "select");
		$resultCnt=$this->ExecuteQuery($selQuery, "norows");
		$objSmarty->assign("wrplayer",$res);
	
	}	
function getTEPlayers()
{
		global $objSmarty;
		$selQuery="select *,p.Player_Name as Player_Name,p.Id as pId, t.Team as pTeam from  tbl_player as p
		 left join  tbl_team as t on p.Team = t.Id 
		  where p.Status != '' and t.Position='TE' order by p.Player_name asc";
		$res=$this->ExecuteQuery($selQuery, "select");
		$resultCnt=$this->ExecuteQuery($selQuery, "norows");
		$objSmarty->assign("teplayer",$res);
		
	}	
function getKPlayers()
{
		global $objSmarty;
		$selQuery="select *,p.Player_Name as Player_Name,p.Id as pId, t.Team as pTeam from  tbl_player as p
		 left join  tbl_team as t on p.Team = t.Id 
		  where p.Status != '' and t.Position !='RB' and t.Position !='TE' and t.Position !='WR' order by p.Player_name asc";
		$res=$this->ExecuteQuery($selQuery, "select");
		$resultCnt=$this->ExecuteQuery($selQuery, "norows");
		$objSmarty->assign("kplayer",$res);
		
	}	
function getDPlayers()
{
		global $objSmarty;
		$selQuery="select *,p.Player_Name as Player_Name,p.Id as pId, t.Team as pTeam from  tbl_player as p
		 left join  tbl_team as t on p.Team = t.Id 
		  where p.Status != '' and t.Position !='RB' and t.Position !='TE' and t.Position !='WR' order by p.Player_name asc";
		$res=$this->ExecuteQuery($selQuery, "select");
		$resultCnt=$this->ExecuteQuery($selQuery, "norows");
		$objSmarty->assign("dplayer",$res);
		
	}	
function getSTPlayers()
{
		global $objSmarty;
		$selQuery="select *,p.Player_Name as Player_Name,p.Id as pId, t.Team as pTeam from  tbl_player as p
		 left join  tbl_team as t on p.Team = t.Id 
		  where p.Status != '' and t.Position !='RB' and t.Position !='TE' and t.Position !='WR' order by p.Player_name asc";
		$res=$this->ExecuteQuery($selQuery, "select");
		$resultCnt=$this->ExecuteQuery($selQuery, "norows");
		$objSmarty->assign("stplayer",$res);
	
	}	
	
function addwildcard(){
		global $objSmarty,$config;
	
		
		$delQry="DELETE FROM `tbl_wildcard` WHERE User_Id='".addslashes($_SESSION['Id'])."'";
		$this->ExecuteQuery($delQry,"delete");	
		
		$QB=$_REQUEST['QB'];
			if($QB != '')
				{
				for($i=0;$i<count($QB);$i++){
					
					$InsQuery="INSERT INTO `tbl_wildcard` (
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
					
					 $InsQuery="INSERT INTO `tbl_wildcard` (
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
					
					 $InsQuery="INSERT INTO `tbl_wildcard` (
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
					
					 $InsQuery="INSERT INTO `tbl_wildcard` (
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
					
					 $InsQuery="INSERT INTO `tbl_wildcard` (
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
					
					 $InsQuery="INSERT INTO `tbl_wildcard` (
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
					
					 $InsQuery="INSERT INTO `tbl_wildcard` (
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
				
		header('location:wildcard_selection.php?table=wildcard');
		
	}

function getAllWildcardTeam()
	{
		global $objSmarty;
		
		if($_REQUEST['table'] == 'wildcard')
		{
		$selQuery="select * from  tbl_wildcard where Status = '1' and User_Id='".$_SESSION['Id']."' order by Created_Date asc";
		}
		if($_REQUEST['table'] == 'divisional')
		{
		$selQuery="select * from  tbl_divisional where Status = '1' and User_Id='".$_SESSION['Id']."' order by Created_Date asc";
		}
		if($_REQUEST['table'] == 'champion')
		{
		$selQuery="select * from  tbl_champion where Status = '1' and User_Id='".$_SESSION['Id']."' order by Created_Date asc";
		}
		
		$res=$this->ExecuteQuery($selQuery, "select");
		$resultCnt=$this->ExecuteQuery($selQuery, "norows");
		
		$objSmarty->assign("wildcard",$res);
		$objSmarty->assign("totcount",$resultCnt);
		
	}		
	

function getTeamColorByPlayer($id)
	{
		global $objSmarty;
		
		$SelQuery	= "SELECT * FROM `tbl_player` WHERE Id='$id'";
		$res=$this->ExecuteQuery($SelQuery,"select");
		$team=$res[0]['Team'];
		
		$Sel	= "SELECT * FROM `tbl_team` WHERE Id='$team'";
		$result=$this->ExecuteQuery($Sel,"select");
		$color=$result[0]['Team_Color'];
		
		return $color;
	
	}	
function getFontColorByPlayer($id)
	{
		global $objSmarty;
		
		$SelQuery	= "SELECT * FROM `tbl_player` WHERE Id='$id'";
		$res=$this->ExecuteQuery($SelQuery,"select");
		$team=$res[0]['Team'];
		
		$Sel	= "SELECT * FROM `tbl_team` WHERE Id='$team'";
		$result=$this->ExecuteQuery($Sel,"select");
		$color=$result[0]['Font_Color'];
		
		return $color;
	
	}	
function getTeamPlayer($id)
	{
		global $objSmarty;
		$selqry="select * from  tbl_player where Id='$id'";
		$res=$this->ExecuteQuery($selqry,"select");
		return $res[0]['Player_name'];
	
	}	
	
function getPlayerByTeam($id)
	{
		global $objSmarty;
		$selqry="select * from  tbl_player where Team='$id'";
		$res=$this->ExecuteQuery($selqry,"select");
		$objSmarty->assign("player",$res);
	
	}	
	
function getTeamByPlayer($id)
	{
		global $objSmarty;
		$selqry="select * from  tbl_player where Id='$id'";
		$res=$this->ExecuteQuery($selqry,"select");
		$team= $res[0]['Team'];
		$selqry1="select * from  tbl_team where Id='$team'";
		$res1=$this->ExecuteQuery($selqry1,"select");
		return $res1[0]['Team'];
	
	}	
	
function getTeamPosition($id)
	{
	global $objSmarty;
		$selqry="select * from  tbl_player where Id='$id'";
		$res=$this->ExecuteQuery($selqry,"select");
		$team= $res[0]['Team'];
		$selqry1="select * from  tbl_team where Id='$team'";
		$res1=$this->ExecuteQuery($selqry1,"select");
		return $res1[0]['Position'];
	
	}	
	
function getTeamByPosition($id)
	{
	global $objSmarty;
		
	if($id == 'QB' || $id == 'K' || $id == 'D' || $id == 'ST' )
	{
	$selqry1	= "SELECT * FROM `tbl_team`"
		              ." WHERE Position !='RB' and Position !='TE' and Position !='WR' order by Id asc";
	}
	else 
	{
	 $selqry1	= "SELECT * FROM `tbl_team`"
		              ." WHERE Position='".addslashes($id)."' order by Id asc";
	}
	//echo $selqry1="select * from  tbl_team where Position='$id'";
		$res1=$this->ExecuteQuery($selqry1,"select");
		//return $res1[0]['Position'];
		$objSmarty->assign("team",$res1);
	
	}	

function getTeambyuserid()
		
{
		
		global $objSmarty;
		$selqry="select Team from  tbl_user where Id='".$_SESSION['Id']."'";
		$res=$this->ExecuteQuery($selqry,"select");
		$team= $res[0]['Team'];
	 	$selqry1="select * from  tbl_user_team where Id='$team'";
		$res1=$this->ExecuteQuery($selqry1,"select");
		$objSmarty->assign("teamname",$res1[0]['Team']);
		//return $res1[0]['Team'];
	
	}
function getTeamsByname($id)
{
		global $objSmarty;
		 $selQuery="select * from  tbl_teams_active where Team_Name='$id'";
		$res=$this->ExecuteQuery($selQuery, "select");
		//$objSmarty->assign("players",$res);
		return $res[0]['Full_Name'];
	}	
	
}
?>