<?php
/*	Class Function for Admin	*/

class ManageCategory extends MysqlFns
{
	function ManageCategory()
	{
		global $config;
		$this->MysqlFns();
		$this->Offset			= 0;
		$this->Limit			= 10;
		$this->Limit_ven		= 5;
		$this->page				= 0;
		$this->Keyword			= '';
		$this->Operator			= '';
		$this->PerPage			= '';
	}

function manage_category(){
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['keyword']!="" && $_REQUEST['keyword']!="FirstName" )
		$where_condition.="and ((`Category` like '%".trim(addslashes($_REQUEST['keyword']))."%' ))";

		
			
		$where_condition1='';
		if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition1.=" order by Category asc";
			if($_REQUEST['flag']=="2")
			$where_condition1.=" order by Category desc";
			
			
		}else{
			$where_condition1.=" order by `Id` desc";
		}

		$SelQuery	= "select * from `tbl_petcategory` where
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
         					 $objSmarty->assign("CatList",$Res_Tickets);
	}
function manage_Players(){
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['keyword']!="" && $_REQUEST['keyword']!="FirstName" )
		$where_condition.="and ((`Player_name` like '%".trim(addslashes($_REQUEST['keyword']))."%' ))";

		
			
		$where_condition1='';
		if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition1.=" order by Player_name asc";
			if($_REQUEST['flag']=="2")
			$where_condition1.=" order by Player_name desc";
			
			
		}else{
			$where_condition1.=" order by `Id` desc";
		}

		$SelQuery	= "select * from `tbl_user_player` where
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
	
function manage_Teams(){
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

		$SelQuery	= "select * from `tbl_user_team` where
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
	
function manage_Teams_api(){
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['keyword']!="" && $_REQUEST['keyword']!="FirstName" )
		$where_condition.="and ((`Team_Name` like '%".trim(addslashes($_REQUEST['keyword']))."%' ))";

		
			
		$where_condition1='';
		if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition1.=" order by Team_Name asc";
			if($_REQUEST['flag']=="2")
			$where_condition1.=" order by Team_Name desc";
			
			
		}else{
			$where_condition1.=" order by `Team_Name` asc";
		}

		$SelQuery	= "select * from `tbl_teams_active` where
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
function manage_Injury(){
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['keyword']!="" && $_REQUEST['keyword']!="FirstName" )
		$where_condition.="and ((`Name` like '%".trim(addslashes($_REQUEST['keyword']))."%' ))";

		
			
		$where_condition1='';
		/*if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition1.=" order by Team_Name asc";
			if($_REQUEST['flag']=="2")
			$where_condition1.=" order by Team_Name desc";
			
			
		}else{*/
			$where_condition1.=" order by `Id` asc";
		//}

		$SelQuery	= "select * from `tbl_injury` where
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
		
function manage_Schedule(){
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['keyword']!="" && $_REQUEST['keyword']!="FirstName" )
		$where_condition.="and ((`Team_Name` like '%".trim(addslashes($_REQUEST['keyword']))."%' ))";

		
			
		$where_condition1='';
		/*if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition1.=" order by Team_Name asc";
			if($_REQUEST['flag']=="2")
			$where_condition1.=" order by Team_Name desc";
			
			
		}else{*/
			$where_condition1.=" order by `Id` asc";
		//}

		$SelQuery	= "select * from `tbl_schedule` where
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
	
function manage_Player_Api(){
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['keyword']!="" && $_REQUEST['keyword']!="FirstName" )
		$where_condition.="and ((`First_Name` like '%".trim(addslashes($_REQUEST['keyword']))."%' ) or (`Last_Name` like '%".trim(addslashes($_REQUEST['keyword']))."%' ) )";

		
			
		$where_condition1='';
		if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition1.=" order by First_Name asc";
			if($_REQUEST['flag']=="2")
			$where_condition1.=" order by First_Name desc";
			
			
		}else{
			$where_condition1.=" order by `First_Name` asc";
		}

		$SelQuery	= "select * from `tbl_players_byteam` where
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
	
	
	
function manage_Position(){
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['keyword']!="" && $_REQUEST['keyword']!="FirstName" )
		$where_condition.="and ((`Position` like '%".trim(addslashes($_REQUEST['keyword']))."%' ))";

		
			
		$where_condition1='';
		if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition1.=" order by Position asc";
			if($_REQUEST['flag']=="2")
			$where_condition1.=" order by Position desc";
			
			
		}else{
			$where_condition1.=" order by `Id` desc";
		}

		$SelQuery	= "select * from `tbl_positions` where
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
	
	
function manage_Leagues(){
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['keyword']!="" && $_REQUEST['keyword']!="FirstName" )
		$where_condition.="and ((`League` like '%".trim(addslashes($_REQUEST['keyword']))."%' ))";
			
		$where_condition1='';
		if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition1.=" order by League asc";
			if($_REQUEST['flag']=="2")
			$where_condition1.=" order by League desc";
			
			
		}else{
			$where_condition1.=" order by `Id` desc";
		}

		$SelQuery	= "select * from `tbl_league` where
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
function manage_Rosters(){
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['keyword']!="" && $_REQUEST['keyword']!="FirstName" )
		$where_condition.="and ((`League` like '%".trim(addslashes($_REQUEST['keyword']))."%' ))";
			
		$where_condition1='';
		if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition1.=" order by Player asc";
			if($_REQUEST['flag']=="2")
			$where_condition1.=" order by Player desc";
			
			
		}else{
			$where_condition1.=" order by `Id` desc";
		}

		$SelQuery	= "select * from `tbl_roster` where
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
function manage_Power(){
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

		$SelQuery	= "select * from `tbl_power` where
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
function manage_charts(){
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

		$SelQuery	= "select * from `tbl_chart` where
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
function manage_users(){
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['keyword']!="" && $_REQUEST['keyword']!="FirstName" )
		$where_condition.="and ((`User_Name` like '%".trim(addslashes($_REQUEST['keyword']))."%' ))";

		
			
		$where_condition1='';
		if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition1.=" order by User_Name asc";
			if($_REQUEST['flag']=="2")
			$where_condition1.=" order by User_Name desc";
			
			
		}else{
			$where_condition1.=" order by `Id` desc";
		}

		$SelQuery	= "select * from `tbl_user` where
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
	
	
	
function Set_Status($tablename,$id,$word)
	{
		global $objSmarty;
		$UpQuery="UPDATE ".$tablename." SET `status`='".$_REQUEST['setStatus']."'"
		. " WHERE $id='".$_REQUEST['Ident']."'";
		$ExeUpQuery= $this->ExecuteQuery($UpQuery,"update");
		if($_REQUEST['setStatus']=='0'){
			$objSmarty->assign("SuccessMessage","$word has been deactivated successfully");
		}else{
			$objSmarty->assign("SuccessMessage","$word has been activated successfully");
		}
	}
	
	
function Change_Table($tablename,$id,$word)
	{
		global $objSmarty;
		$case=$_REQUEST['ActionType'];
		$select=$_REQUEST['ConId'];
		for($i=0;$i<count($_REQUEST['ConId']);$i++)
		{
			switch ($case)
			{
				case "Active":

					$UpQuery="UPDATE ".$tablename." SET `Status`='1'"
					. " WHERE $id = '".$select[$i]."'";
					$ExeUpQuery= $this->ExecuteQuery($UpQuery,"update");
					$objSmarty->assign("SuccessMessage","$word has been activated successfully");
					break;
				case "InActive":
					$UpQuery="UPDATE ".$tablename." SET `Status`='0'"
					. " WHERE $id = '".$select[$i]."'";
					$ExeUpQuery= $this->ExecuteQuery($UpQuery,"update");
					$objSmarty->assign("SuccessMessage","$word has been deactivated successfully");
					break;
				case "Delete":
					$UpQuery="DELETE FROM $tablename"
					. " WHERE $id = '".$select[$i]."'";
					$ExeUpQuery= $this->ExecuteQuery($UpQuery,"delete");
					//if($tablename="tbl_reminder"){
					$UpQuery1="DELETE FROM $tablename"
					. " WHERE $id  = '".$select[$i]."'";
					$ExeUpQuery= $this->ExecuteQuery($UpQuery1,"delete");
					//}

					$objSmarty->assign("SuccessMessage","$word has been deleted successfully");
					break;
			}
		}
	}


	function Delete_Record($tablename,$id,$word)
	{
		global $objSmarty;
		$UpQuery="DELETE FROM $tablename"
		. " WHERE $id = '".$_REQUEST['hdIdent']."'";
		$ExeUpQuery= $this->ExecuteQuery($UpQuery,"delete");
		$objSmarty->assign("SuccessMessage","$word has been deleted successfully");
	}
	
function Delete_Category_Record($tablename,$id,$word)
	{
		global $objSmarty,$objPage;
		$select="select * from tbl_player where Id='".$_REQUEST['hdIdent']."'"; 
		$count=$this->ExecuteQuery($select, "norows");
		if($count>0){
			$objSmarty->assign("ErrorMessage","This Score cannot be deleted as it is used by Player.");
		}else{
			$delete="DELETE FROM $tablename"
			. " WHERE $id = '".$_REQUEST['hdIdent']."'";
			$ExeUpQuery= $this->ExecuteQuery($delete,"delete");
			$objSmarty->assign("SuccessMessage","$word has been deleted successfully");
		}
	}
	
function Delete_Category_team($tablename,$id,$word)
	{
		global $objSmarty,$objPage;
		$select="select * from tbl_team where Id='".$_REQUEST['hdIdent']."'"; 
		$count=$this->ExecuteQuery($select, "norows");
		if($count>0){
			$objSmarty->assign("ErrorMessage","This team cannot be deleted as it is used by player.");
		}else{
			$delete="DELETE FROM $tablename"
			. " WHERE $id = '".$_REQUEST['hdIdent']."'";
			$ExeUpQuery= $this->ExecuteQuery($delete,"delete");
			$delete="DELETE FROM tbl_score"
			. " WHERE Player = '".$_REQUEST['hdIdent']."'";
			$ExeUpQuery= $this->ExecuteQuery($delete,"delete");
			$objSmarty->assign("SuccessMessage","$word has been deleted successfully");
		}
	}
function Delete_Category_team_new($tablename,$id,$word)
	{
		global $objSmarty,$objPage;
		
			$delete="DELETE FROM $tablename"
			. " WHERE $id = '".$_REQUEST['hdIdent']."'";
			$ExeUpQuery= $this->ExecuteQuery($delete,"delete");
			$delete="DELETE FROM tbl_score"
			. " WHERE Player = '".$_REQUEST['hdIdent']."'";
			$ExeUpQuery= $this->ExecuteQuery($delete,"delete");
			$objSmarty->assign("SuccessMessage","$word has been deleted successfully");
		
	}
	
	
function Delete_Category_player($tablename,$id,$word)
	{
		global $objSmarty,$objPage;
		$select="select * from tbl_player where Id='".$_REQUEST['hdIdent']."'"; 
		
			$delete="DELETE FROM $tablename"
			. " WHERE $id = '".$_REQUEST['hdIdent']."'";
			$ExeUpQuery= $this->ExecuteQuery($delete,"delete");
			$delete="DELETE FROM tbl_score"
			. " WHERE Player = '".$_REQUEST['hdIdent']."'";
			$ExeUpQuery= $this->ExecuteQuery($delete,"delete");
			$objSmarty->assign("SuccessMessage","$word has been deleted successfully");
		
	}

function select_owner()
	{
		global $objSmarty;

		$SelQuery	= "SELECT * from `tbl_petowners` where `Owner_Id` = '".$_REQUEST['Ident']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("User",$ExeSelQuery);

	}	
	
function addPlayers(){
		global $objSmarty,$config;
		
		$selQueryemail="select * from  tbl_player where Player_name='".addslashes($_REQUEST['fname'])."'"; //or `Username`='".$_REQUEST['username']."'";
		$count=$this->ExecuteQuery($selQueryemail, "norows");
		if($count==0){
			
			$proceed="Yes";
			if($proceed=="Yes"){
				 		 
				 $InsQuery="INSERT INTO `tbl_player` (
												`Player_name`,
												`Team`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".addslashes($_REQUEST['fname'])."',
												 '".addslashes($_REQUEST['Team'])."',
												 '1',
												 now())";
				$this->ExecuteQuery($InsQuery, "insert");
				$lastInsertId=mysql_insert_id();
				/* $Ins="INSERT INTO `tbl_score` (
												`Player`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".$lastInsertId."',
												 '1',
												 now())";
				 $this->ExecuteQuery($Ins, "insert");*/
				 
				$word='';
				$objSmarty->assign("User","");
				$objSmarty->assign("SuccessMessage","Player has been added successfully");
			}
		}
		else {
			$objSmarty->assign("ErrorMessage","Player already exist");
				$objSmarty->assign("User", $_REQUEST);

		}
		
		
	}	
function addTeams(){
		global $objSmarty,$config;
		
		$selQueryemail="select * from  tbl_team where Team='".addslashes($_REQUEST['fname'])."' and Position ='".addslashes($_REQUEST['Position'])."'"; //or `Username`='".$_REQUEST['username']."'";
		$count=$this->ExecuteQuery($selQueryemail, "norows");
		if($count==0){
			
			$proceed="Yes";
			if($proceed=="Yes"){
				 		 
				 $InsQuery="INSERT INTO `tbl_team` (
												`Team`,
												`Position`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".addslashes($_REQUEST['fname'])."',
												 '".addslashes($_REQUEST['Position'])."',
												 '1',
												 now())";
				$this->ExecuteQuery($InsQuery, "insert");
				$word='';
				$objSmarty->assign("User","");
				$objSmarty->assign("SuccessMessage","Team has been added successfully");
			}
		}
		else {
			$objSmarty->assign("ErrorMessage","Team already exist");
				$objSmarty->assign("User", $_REQUEST);

		}
		
		
	}	
function addPositions(){
		global $objSmarty,$config;
		
		$selQueryemail="select * from  tbl_positions where Position='".addslashes($_REQUEST['fname'])."'"; //or `Username`='".$_REQUEST['username']."'";
		$count=$this->ExecuteQuery($selQueryemail, "norows");
		if($count==0){
			
			$proceed="Yes";
			if($proceed=="Yes"){
				 		 
				 $InsQuery="INSERT INTO `tbl_positions` (
												`Position`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".addslashes($_REQUEST['fname'])."',
												 '1',
												 now())";
				$this->ExecuteQuery($InsQuery, "insert");
				$word='';
				$objSmarty->assign("User","");
				$objSmarty->assign("SuccessMessage","Position has been added successfully");
			}
		}
		else {
			$objSmarty->assign("ErrorMessage","Position already exist");
				$objSmarty->assign("User", $_REQUEST);

		}
		
		
	}	
function addLeague(){
		global $objSmarty,$config;
		
		$selQueryemail="select * from  tbl_league where League='".addslashes($_REQUEST['fname'])."'"; //or `Username`='".$_REQUEST['username']."'";
		$count=$this->ExecuteQuery($selQueryemail, "norows");
		if($count==0){
			
			$proceed="Yes";
			if($proceed=="Yes"){
				 		 
				 $InsQuery="INSERT INTO `tbl_league` (
												`League`,
												`Abbreviation`,
												`Win`,
												`Loss`,
												`Tie`,
												`PCT`,
												`GB`,
												`Streak`,
												`Div`,
												`Wks`,
												`PF`,
												`Back`,
												`PA`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".addslashes($_REQUEST['fname'])."',
												 '".addslashes($_REQUEST['Abbreviation'])."',
												 '".addslashes($_REQUEST['win'])."',
												 '".addslashes($_REQUEST['loss'])."',
												 '".addslashes($_REQUEST['tie'])."',
												 '".addslashes($_REQUEST['PCT'])."',
												 '".addslashes($_REQUEST['GB'])."',
												 '".addslashes($_REQUEST['Streak'])."',
												 '".addslashes($_REQUEST['Div'])."',
												 '".addslashes($_REQUEST['Wks'])."',
												 '".addslashes($_REQUEST['PF'])."',
												 '".addslashes($_REQUEST['Back'])."',
												 '".addslashes($_REQUEST['PA'])."',
												 '1',
												 now())";
				$this->ExecuteQuery($InsQuery, "insert");
				$word='';
				$objSmarty->assign("User","");
				$objSmarty->assign("SuccessMessage","League has been added successfully");
			}
		}
		else {
			$objSmarty->assign("ErrorMessage","League already exist");
				$objSmarty->assign("User", $_REQUEST);

		}
		
		
	}	
function addChart(){
		global $objSmarty,$config;
		
		/*$selQueryemail="select * from  tbl_chart where Starter='".addslashes($_REQUEST['Starter'])."'"; //or `Username`='".$_REQUEST['username']."'";
		$count=$this->ExecuteQuery($selQueryemail, "norows");
		if($count==0){*/
			
			$proceed="Yes";
			if($proceed=="Yes"){
				 		 
				 $InsQuery="INSERT INTO `tbl_chart` (
				 								`Position`,
												`Team`,
												`Starter`,
												`Backup`,
												`Reserves`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".addslashes($_REQUEST['Position'])."',
												 '".addslashes($_REQUEST['Team'])."',
												 '".addslashes($_REQUEST['Starter'])."',
												 '".addslashes($_REQUEST['Backup'])."',
												 '".addslashes($_REQUEST['Reserves'])."',
												 '1',
												 now())";
				$this->ExecuteQuery($InsQuery, "insert");
				$word='';
				$objSmarty->assign("User","");
				$objSmarty->assign("SuccessMessage","Chart details has been added successfully");
			}
		/*}
		else {
			$objSmarty->assign("ErrorMessage","Chart details already exist");
				$objSmarty->assign("User", $_REQUEST);

		}*/
		
		
	}	
function addRoster(){
		global $objSmarty,$config;
		
		/*$selQueryemail="select * from  tbl_roster where League='".addslashes($_REQUEST['fname'])."'"; //or `Username`='".$_REQUEST['username']."'";
		$count=$this->ExecuteQuery($selQueryemail, "norows");
		if($count==0){*/
			
			$proceed="Yes";
			if($proceed=="Yes"){
				 $exa=explode(" ",$_REQUEST['Game_Time']);
				// echo $exa[0];		 
				// echo $exa[1];exit;		 
				  $InsQuery="INSERT INTO `tbl_roster` (
												`Pos`,
												`Player`,
												`Opp`,
												`Game_Date`,
												`Game_Time`,
												`Bye`,
												`PosRnk`,
												`Ovp`,
												`Own`,
												`Start`,
												`Per`,
												`Average`,
												`Proj`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".addslashes($_REQUEST['Pos'])."',
												 '".addslashes($_REQUEST['Player'])."',
												 '".addslashes($_REQUEST['Opp'])."',
												 '".addslashes($exa[0])."',
												 '".addslashes($exa[1])."',
												 '".addslashes($_REQUEST['Bye'])."',
												 '".addslashes($_REQUEST['PosRnk'])."',
												 '".addslashes($_REQUEST['Ovp'])."',
												 '".addslashes($_REQUEST['Own'])."',
												 '".addslashes($_REQUEST['Start'])."',
												 '".addslashes($_REQUEST['Per'])."',
												 '".addslashes($_REQUEST['Average'])."',
												 '".addslashes($_REQUEST['Proj'])."',
												 '1',
												 now())"; 
				$this->ExecuteQuery($InsQuery, "insert");
				$word='';
				$objSmarty->assign("User","");
				$objSmarty->assign("SuccessMessage","Roster has been added successfully");
			}
		/*}
		else {
			$objSmarty->assign("ErrorMessage","League already exist");
				$objSmarty->assign("User", $_REQUEST);

		}*/
		
		
	}	
function addPower(){
		global $objSmarty,$config;
		
		$selQueryemail="select * from  tbl_power where Team='".addslashes($_REQUEST['Team'])."'"; //or `Username`='".$_REQUEST['username']."'";
		$count=$this->ExecuteQuery($selQueryemail, "norows");
		if($count==0){
			
			$proceed="Yes";
			if($proceed=="Yes"){
				// $exa=explode(" ",$_REQUEST['Game_Time']);
				// echo $exa[0];		 
				// echo $exa[1];exit;		 
				  $InsQuery="INSERT INTO `tbl_power` (
												`Rank`,
												`Team`,
												`Record`,
												`Points`,
												`Breakdown`,
												`Power`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".addslashes($_REQUEST['Rank'])."',
												 '".addslashes($_REQUEST['Team'])."',
												 '".addslashes($_REQUEST['Record'])."',
												 '".addslashes($_REQUEST['Points'])."',
												 '".addslashes($_REQUEST['Breakdown'])."',
												 '".addslashes($_REQUEST['Power'])."',
												 '1',
												 now())"; 
				$this->ExecuteQuery($InsQuery, "insert");
				$word='';
				$objSmarty->assign("User","");
				$objSmarty->assign("SuccessMessage","Power details has been added successfully");
			}
		}
		else {
			$objSmarty->assign("ErrorMessage","Power details already exist");
				$objSmarty->assign("User", $_REQUEST);
		}
		
		
	}	
function getCountry()
	{
		global $objSmarty;
		 $selQuery="select * from  countries order by name asc";
		$res=$this->ExecuteQuery($selQuery, "select");
		$objSmarty->assign("country",$res);
	}
	
function getPlayer()
	{
		global $objSmarty;
		 $selQuery="select * from  tbl_player order by Player_name asc";
		$res=$this->ExecuteQuery($selQuery, "select");
		$objSmarty->assign("players",$res);
	}
	
function getAllLeague()
	{
		global $objSmarty;
		$selQuery="select * from tbl_league order by League asc";
		$res=$this->ExecuteQuery($selQuery, "select");
		$objSmarty->assign("league",$res);
	}
function getAllLeagueByDivision($id)
	{
		global $objSmarty;
		$selQuery="select * from tbl_division where Division='$id' ";
		$res=$this->ExecuteQuery($selQuery, "select");
		$objSmarty->assign("Division",$res);
	}
function getAllTeam()
{
		global $objSmarty;
		 $selQuery="select * from tbl_team order by Id asc";
		$res=$this->ExecuteQuery($selQuery, "select");
		$objSmarty->assign("team",$res);
	}
function getAllTeam_api()
{
		global $objSmarty;
		 $selQuery="select * from tbl_teams_active order by Id asc";
		$res=$this->ExecuteQuery($selQuery, "select");
		$objSmarty->assign("team",$res);
	}
function getAllPlayer()
{
		global $objSmarty;
		 $selQuery="select * from tbl_player order by Player_Name asc";
		$res=$this->ExecuteQuery($selQuery, "select");
		$objSmarty->assign("player",$res);
	}
function getPosition()
{
		global $objSmarty;
		 $selQuery="select * from  tbl_positions order by Position asc";
		$res=$this->ExecuteQuery($selQuery, "select");
		$objSmarty->assign("position",$res);
	}
	
function getTeam()
{
		global $objSmarty;
		 $selQuery="select * from  tbl_team order by Team asc";
		$res=$this->ExecuteQuery($selQuery, "select");
		$objSmarty->assign("team",$res);
	}
	
		
function getPlayerId($id)
{
		global $objSmarty;
		 $selQuery="select * from  tbl_player where Id='$id'";
		$res=$this->ExecuteQuery($selQuery, "select");
		//$objSmarty->assign("players",$res);
		return $res[0]['Player_name'];
	}
function getLeagueId($id)
{
		global $objSmarty;
		 $selQuery="select * from  tbl_league where Id='$id'";
		$res=$this->ExecuteQuery($selQuery, "select");
		//$objSmarty->assign("players",$res);
		return $res[0]['League'];
	}
function getLeaguelogo($id)
{
		global $objSmarty;
		$selQuery="select * from  tbl_league where Id='$id'";
		$res=$this->ExecuteQuery($selQuery, "select");
		//$objSmarty->assign("players",$res);
		return $res[0]['Logo'];
	}
function getAbbrId($id)
{
		global $objSmarty;
		 $selQuery="select * from  tbl_league where Id='$id'";
		$res=$this->ExecuteQuery($selQuery, "select");
		//$objSmarty->assign("players",$res);
		return $res[0]['Abbreviation'];
	}
function getTeamId($id)
{
		global $objSmarty;
		 $selQuery="select * from  tbl_team where Id='$id'";
		$res=$this->ExecuteQuery($selQuery, "select");
		//$objSmarty->assign("players",$res);
		return $res[0]['Team'];
	}
	
		
function getday($date)
{
	global $objSmarty;
	$string = $date;
	$timestamp = strtotime($string);
	return date("D", $timestamp);
}	
	
function addUser(){
		global $objSmarty,$config;
		
		$selQueryemail="select * from   tbl_user where Email_Id='".addslashes($_REQUEST['email'])."'"; //or `Username`='".$_REQUEST['username']."'";
		$count=$this->ExecuteQuery($selQueryemail, "norows");
		if($count==0){
			
			$proceed="Yes";
			if($proceed=="Yes"){
				 		 
				 $InsQuery="INSERT INTO `tbl_user` (
												`First_Name`,
												`Last_Name`,
												`User_Name`,
												`Email_Id`,
												`Password`,
												`Team`,
												`Gender`,
												`Occupation`,
												`DOB`,
												`Address`,
												`Phone`,
												`Zipcode`,
												`City`,
												`State`,
												`Country`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".addslashes($_REQUEST['fname'])."',
												 '".addslashes($_REQUEST['lname'])."',
												 '".addslashes($_REQUEST['uname'])."',
												 '".addslashes($_REQUEST['email'])."',
												 '".addslashes($_REQUEST['pwd'])."',
												 '".addslashes($_REQUEST['Team'])."',
												 '".addslashes($_REQUEST['gender'])."',
												 '".addslashes($_REQUEST['occupation'])."',
												 '".addslashes($_REQUEST['datepicker'])."',
												 '".addslashes($_REQUEST['address'])."',
												 '".addslashes($_REQUEST['phone'])."',
												 '".addslashes($_REQUEST['zipcode'])."',
												 '".addslashes($_REQUEST['city'])."',
												 '".addslashes($_REQUEST['state'])."',
												 '".addslashes($_REQUEST['country'])."',
												 '1',
												 now())";
				$this->ExecuteQuery($InsQuery, "insert");
				$word='';
				$objSmarty->assign("User","");
				$objSmarty->assign("SuccessMessage","User has been added successfully");
			}
		}
		else {
			$objSmarty->assign("ErrorMessage","User already exist");
				$objSmarty->assign("User", $_REQUEST);

		}
		
		
	}	
function updatePlayer(){
		global $objSmarty;
		$selQuery="select * from tbl_player where Player_name='".addslashes($_REQUEST['category'])."'
		 and Id!='".$_REQUEST['Ident']."'";
		$count=$this->ExecuteQuery($selQuery, "norows");
		if(!$count){
			$proceed="Yes";

			if($proceed=="Yes"){
				$upQuery="update tbl_player set `Category`='".addslashes($_REQUEST['category'])."',
												`Updated_Date`=now()
												where Id='".$_REQUEST['Ident']."'";
				$this->ExecuteQuery($upQuery, "update");

				$objSmarty->assign("SuccessMessage","Player has been updated successfully");
			}
		}else{
			$objSmarty->assign("ErrorMessage","Player category already exist");
		}
	}
		
	
	
	
function addCategory(){
		global $objSmarty,$config;
		
		$selQueryemail="select * from  tbl_petcategory where Category='".addslashes($_REQUEST['category'])."'"; //or `Username`='".$_REQUEST['username']."'";
		$count=$this->ExecuteQuery($selQueryemail, "norows");
		if($count==0){
			
			$proceed="Yes";
			if($proceed=="Yes"){
				 		 
				 $InsQuery="INSERT INTO `tbl_petcategory` (
												`Category`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".addslashes($_REQUEST['category'])."',
												 '1',
												 now())";
				$this->ExecuteQuery($InsQuery, "insert");
				$word='';
				$objSmarty->assign("User","");
				$objSmarty->assign("SuccessMessage","Pet Category has been added successfully");
			}
		}
		else {
			$objSmarty->assign("ErrorMessage","Pet Category already exist");
				$objSmarty->assign("User", $_REQUEST);

		}
		
		
	}
function select_Category()
	{
		global $objSmarty;

		$SelQuery	= "SELECT * from `tbl_petcategory` where `Id` = '".$_REQUEST['Ident']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("User",$ExeSelQuery);

	}
function getPlayerById()
	{
		global $objSmarty;

		$SelQuery	= "SELECT * from `tbl_player` where `Id` = '".$_REQUEST['CatIdent']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("User",$ExeSelQuery);

	}
function getTeamById()
	{
		global $objSmarty;

		$SelQuery	= "SELECT * from `tbl_team` where `Id` = '".$_REQUEST['CatIdent']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("User",$ExeSelQuery);

	}
function getPositionById()
	{
		global $objSmarty;

		$SelQuery	= "SELECT * from `tbl_positions` where `Id` = '".$_REQUEST['CatIdent']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("User",$ExeSelQuery);

	}
function getLeagueById()
	{
		global $objSmarty;

		$SelQuery	= "SELECT * from `tbl_league` where `Id` = '".$_REQUEST['CatIdent']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("User",$ExeSelQuery);

	}
function getChartById()
	{
		global $objSmarty;

		$SelQuery	= "SELECT * from `tbl_chart` where `Id` = '".$_REQUEST['CatIdent']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("User",$ExeSelQuery);

	}
function getRosterById()
	{
		global $objSmarty;

		$SelQuery	= "SELECT * from `tbl_roster` where `Id` = '".$_REQUEST['CatIdent']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("User",$ExeSelQuery);

	}
function getPowerById()
	{
		global $objSmarty;

		$SelQuery	= "SELECT * from `tbl_power` where `Id` = '".$_REQUEST['CatIdent']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("User",$ExeSelQuery);

	}
function getUserById()
	{
		global $objSmarty;

		$SelQuery	= "SELECT * from `tbl_user` where `Id` = '".$_REQUEST['CatIdent']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("User",$ExeSelQuery);

	}
function updateCategory(){
		global $objSmarty;
		$selQuery="select * from tbl_petcategory where Category='".addslashes($_REQUEST['category'])."'
		 and Id!='".$_REQUEST['Ident']."'";
		$count=$this->ExecuteQuery($selQuery, "norows");
		if(!$count){
			$proceed="Yes";

			if($proceed=="Yes"){
				$upQuery="update tbl_petcategory set `Category`='".addslashes($_REQUEST['category'])."',
												`Updated_Date`=now()
												where Id='".$_REQUEST['Ident']."'";
				$this->ExecuteQuery($upQuery, "update");

				$objSmarty->assign("SuccessMessage","Pet category has been updated successfully");
			}
		}else{
			$objSmarty->assign("ErrorMessage","Pet category already exist");
		}
	}
function updatePlayerbyId(){
		global $objSmarty;
		$selQuery="select * from tbl_player where Player_name='".addslashes($_REQUEST['category'])."'
		 and Id!='".$_REQUEST['CatIdent']."'";
		$count=$this->ExecuteQuery($selQuery, "norows");
		if(!$count){
			$proceed="Yes";

			if($proceed=="Yes"){
				$upQuery="update tbl_player set `Player_name`='".addslashes($_REQUEST['category'])."',
												`Team`='".addslashes($_REQUEST['Team'])."',
												`Updated_Date`=now()
												where Id='".$_REQUEST['CatIdent']."'";
				$this->ExecuteQuery($upQuery, "update");

				$objSmarty->assign("SuccessMessage","Player has been updated successfully");
			}
		}else{
			$objSmarty->assign("ErrorMessage","Player already exist");
		}
	}
	
function updateTeambyId(){
		global $objSmarty;
		$selQuery="select * from tbl_team where Team='".addslashes($_REQUEST['category'])."' 
		 and Id!='".$_REQUEST['CatIdent']."'";
		$count=$this->ExecuteQuery($selQuery, "norows");
		if(!$count){
			$proceed="Yes";

			if($proceed=="Yes"){
				$upQuery="update tbl_team set `Team`='".addslashes($_REQUEST['category'])."',
												`Position`='".addslashes($_REQUEST['Position'])."',
												`Updated_Date`=now()
												where Id='".$_REQUEST['CatIdent']."'";
				$this->ExecuteQuery($upQuery, "update");

				$objSmarty->assign("SuccessMessage","Team has been updated successfully");
			}
		}else{
			$objSmarty->assign("ErrorMessage","Team already exist");
		}
	}
	
	
function updatePositionbyId(){
		global $objSmarty;
		$selQuery="select * from tbl_positions where Position='".addslashes($_REQUEST['category'])."'
		 and Id!='".$_REQUEST['CatIdent']."'";
		$count=$this->ExecuteQuery($selQuery, "norows");
		if(!$count){
			$proceed="Yes";

			if($proceed=="Yes"){
				$upQuery="update tbl_positions set `Position`='".addslashes($_REQUEST['category'])."',
												`Updated_Date`=now()
												where Id='".$_REQUEST['CatIdent']."'";
				$this->ExecuteQuery($upQuery, "update");

				$objSmarty->assign("SuccessMessage","Position has been updated successfully");
			}
		}else{
			$objSmarty->assign("ErrorMessage","Position already exist");
		}
	}
	
	
function updateUserbyId(){
		global $objSmarty;
		$selQuery="select * from tbl_user where Email_Id='".addslashes($_REQUEST['email'])."'
		 and Id!='".$_REQUEST['CatIdent']."'";
		
		$count=$this->ExecuteQuery($selQuery, "norows");
		if(!$count){
			$proceed="Yes";
 
			if($proceed=="Yes"){
				$upQuery="update tbl_user set `First_Name`='".addslashes($_REQUEST['fname'])."',
												`Last_Name`='".addslashes($_REQUEST['lname'])."',
												`User_Name`='".addslashes($_REQUEST['uname'])."',
												`Email_Id`='".addslashes($_REQUEST['email'])."',
												`Team`='".addslashes($_REQUEST['Team'])."',
												`Gender`='".addslashes($_REQUEST['gender'])."',
												`Occupation`='".addslashes($_REQUEST['occupation'])."',
												`DOB`='".addslashes($_REQUEST['datepicker'])."',
												`Address`='".addslashes($_REQUEST['address'])."',
												`Phone`='".addslashes($_REQUEST['phone'])."',
												`Zipcode`='".addslashes($_REQUEST['zipcode'])."',
												`City`='".addslashes($_REQUEST['city'])."',
												`State`='".addslashes($_REQUEST['state'])."',
												`Country`='".addslashes($_REQUEST['country'])."',
												`Status`='1',
												`Updated_Date`=now()
												where Id='".$_REQUEST['CatIdent']."'"; 
				$this->ExecuteQuery($upQuery, "update");

				$objSmarty->assign("SuccessMessage","User has been updated successfully");
			}
		}else{
			$objSmarty->assign("ErrorMessage","User already exist");
		}
	}
	
function getState()
{
		global $objSmarty;
		
		$selQuery	= "SELECT * FROM `states` order by name asc";
		$res=$this->ExecuteQuery($selQuery, "select");
		$objSmarty->assign("states",$res);
	}
function getCity()
{
		global $objSmarty;
		$selQuery	= "SELECT * FROM `cities` order by name asc";
		$res=$this->ExecuteQuery($selQuery, "select");
		$objSmarty->assign("city",$res);
	}
	
function updateLeaguebyId(){
		global $objSmarty;
		$selQuery="select * from tbl_league where League='".addslashes($_REQUEST['category'])."'
		 and Id!='".$_REQUEST['CatIdent']."'";
		$count=$this->ExecuteQuery($selQuery, "norows");
		if(!$count){
			$proceed="Yes";
			if($proceed=="Yes"){
				
				$upQuery="update tbl_league set `League`='".addslashes($_REQUEST['fname'])."',
												`Abbreviation`='".addslashes($_REQUEST['Abbreviation'])."',
												`Win`='".addslashes($_REQUEST['win'])."',
												`Loss`='".addslashes($_REQUEST['loss'])."',
												`Tie`='".addslashes($_REQUEST['tie'])."',
												`PCT`='".addslashes($_REQUEST['PCT'])."',
												`GB`='".addslashes($_REQUEST['GB'])."',
												`Streak`='".addslashes($_REQUEST['Streak'])."',
												`Div`='".addslashes($_REQUEST['Div'])."',
												`Wks`='".addslashes($_REQUEST['Wks'])."',
												`PF`='".addslashes($_REQUEST['PF'])."',
												`Back`='".addslashes($_REQUEST['Back'])."',
												`PA`='".addslashes($_REQUEST['PA'])."',
												`Updated_Date`=now()
												where Id='".$_REQUEST['CatIdent']."'";
				$this->ExecuteQuery($upQuery, "update");

				$objSmarty->assign("SuccessMessage","League has been updated successfully");
			}
		}else{
			$objSmarty->assign("ErrorMessage","League already exist");
		}
	}
	
function updateChartbyId(){
		global $objSmarty;
		$selQuery="select * from tbl_chart where Team='".addslashes($_REQUEST['Team'])."'
		 and Id!='".$_REQUEST['CatIdent']."'";
		$count=$this->ExecuteQuery($selQuery, "norows");
		if(!$count){
			$proceed="Yes";

			if($proceed=="Yes"){
				
				$upQuery="update tbl_chart set `Position`='".addslashes($_REQUEST['Position'])."',
												`Team`='".addslashes($_REQUEST['Team'])."',
												`Starter`='".addslashes($_REQUEST['Starter'])."',
												`Backup`='".addslashes($_REQUEST['Backup'])."',
												`Reserves`='".addslashes($_REQUEST['Reserves'])."',
												`Updated_Date`=now()
												where Id='".$_REQUEST['CatIdent']."'";
				$this->ExecuteQuery($upQuery, "update");

				$objSmarty->assign("SuccessMessage","Details has been updated successfully");
			}
		}else{
			$objSmarty->assign("ErrorMessage","Details already exist");
		}
	}
	
	
function updateRosterbyId(){
		global $objSmarty;
		$selQuery="select * from tbl_roster where Player='".addslashes($_REQUEST['Player'])."'
		 and Id!='".$_REQUEST['CatIdent']."'";
		$count=$this->ExecuteQuery($selQuery, "norows");
		if(!$count){
			$proceed="Yes";
 			$exa=explode(" ",$_REQUEST['Game_Time']);
			if($proceed=="Yes"){
				 
				$upQuery="update tbl_roster set `Pos`='".addslashes($_REQUEST['Pos'])."',
												`Player`='".addslashes($_REQUEST['Player'])."',
												`Opp`='".addslashes($_REQUEST['Opp'])."',
												`Game_Date`='".addslashes($exa[0])."',
												`Game_Time`='".addslashes($exa[1])."',
												`Bye`='".addslashes($_REQUEST['Bye'])."',
												`PosRnk`='".addslashes($_REQUEST['PosRnk'])."',
												`Ovp`='".addslashes($_REQUEST['Ovp'])."',
												`Own`='".addslashes($_REQUEST['Own'])."',
												`Start`='".addslashes($_REQUEST['Start'])."',
												`Per`='".addslashes($_REQUEST['Per'])."',
												`Average`='".addslashes($_REQUEST['Average'])."',
												`Proj`='".addslashes($_REQUEST['Proj'])."',
												`Updated_Date`=now()
												where Id='".$_REQUEST['CatIdent']."'";
				$this->ExecuteQuery($upQuery, "update");

				$objSmarty->assign("SuccessMessage","Roster details has been updated successfully");
			}
		}else{
			$objSmarty->assign("ErrorMessage","Roster details already exist");
		}
	}
	
	
function updatePowerbyId(){
		global $objSmarty;
		$selQuery="select * from tbl_power where Team='".addslashes($_REQUEST['Team'])."'
		 and Id!='".$_REQUEST['CatIdent']."'";
		$count=$this->ExecuteQuery($selQuery, "norows");
		if(!$count){
			$proceed="Yes";
 			
			if($proceed=="Yes"){
				 
				$upQuery="update tbl_power set `Rank`='".addslashes($_REQUEST['Rank'])."',
												`Team`='".addslashes($_REQUEST['Team'])."',
												`Record`='".addslashes($_REQUEST['Record'])."',
												`Points`='".addslashes($_REQUEST['Points'])."',
												`Breakdown`='".addslashes($_REQUEST['Breakdown'])."',
												`Power`='".addslashes($_REQUEST['Power'])."',
												`Updated_Date`=now()
												where Id='".$_REQUEST['CatIdent']."'";
				$this->ExecuteQuery($upQuery, "update");

				$objSmarty->assign("SuccessMessage","Power details has been updated successfully");
			}
		}else{
			$objSmarty->assign("ErrorMessage","Power details already exist");
		}
	}
	
	

function manage_subcategory(){
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['keyword']!="" && $_REQUEST['keyword']!="Subcategory" )
		$where_condition.="and ((`Subcategory` like '%".trim(addslashes($_REQUEST['keyword']))."%' ))";

		
			
		$where_condition1='';
		if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition1.=" order by Subcategory asc";
			if($_REQUEST['flag']=="2")
			$where_condition1.=" order by Subcategory desc";
			
			
		}else{
			$where_condition1.=" order by `Id` desc";
		}

		$SelQuery	= "select * from `tbl_petsubcategory` where
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
         					 $objSmarty->assign("CatList",$Res_Tickets);
	}
	
	
function getCategory()
{
		global $objSmarty;
		 $selQuery="select * from  tbl_petcategory where Status!='0' order by Category asc";
		$res=$this->ExecuteQuery($selQuery, "select");
		$objSmarty->assign("category",$res);
	}
function getCategoryById($id)
{
		global $objSmarty;
		 $selQuery="select * from  tbl_petcategory where Id='$id'";
		$res=$this->ExecuteQuery($selQuery, "select");
		$objSmarty->assign("category",$res);
		return $res[0]['Category'];
	}	
function addSubCategory(){
		global $objSmarty,$config;
		
		$selQueryemail="select * from  tbl_petsubcategory where 
		Subcategory='".addslashes($_REQUEST['subcategory'])."'"; //or `Username`='".$_REQUEST['username']."'";
		$count=$this->ExecuteQuery($selQueryemail, "norows");
		if($count==0){
			
			$proceed="Yes";
			if($proceed=="Yes"){
				 		 
				 $InsQuery="INSERT INTO `tbl_petsubcategory` (
				 								`Subcategory`,
												`Category_Id`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".addslashes($_REQUEST['subcategory'])."',
												 '".addslashes($_REQUEST['category'])."',
												 '1',
												 now())";
				$this->ExecuteQuery($InsQuery, "insert");
				$word='';
				$objSmarty->assign("User","");
				$objSmarty->assign("SuccessMessage","Pet SubCategory has been added successfully");
			}
		}
		else {
			$objSmarty->assign("ErrorMessage","Pet SubCategory already exist");
				$objSmarty->assign("User", $_REQUEST);

		}
		
		
	}

function select_SubCategory()
	{
		global $objSmarty;

		$SelQuery	= "SELECT * from `tbl_petsubcategory` where `Id` = '".$_REQUEST['Ident']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("User",$ExeSelQuery);

	}

function updateSubCategory(){
		global $objSmarty;
		$selQuery="select * from tbl_petsubcategory where Subcategory='".addslashes($_REQUEST['subcategory'])."'
		 and Id!='".$_REQUEST['Ident']."'";
		$count=$this->ExecuteQuery($selQuery, "norows");
		if(!$count){
			$proceed="Yes";

			if($proceed=="Yes"){
				$upQuery="update tbl_petsubcategory set `Category_Id`='".addslashes($_REQUEST['category'])."',
													`Subcategory`='".addslashes($_REQUEST['subcategory'])."',
												`Updated_Date`=now()
												where Id='".$_REQUEST['Ident']."'";
				$this->ExecuteQuery($upQuery, "update");

				$objSmarty->assign("SuccessMessage","Pet subcategory has been updated successfully");
			}
		}else{
			$objSmarty->assign("ErrorMessage","Pet subcategory already exist");
		}
	}
	/************************************** PAYPAL MANAGEMENT ************************************************/
	function manage_paypal(){
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['keyword']!="" )
		$where_condition.="and ((`Paypal_name` like '%".trim(addslashes($_REQUEST['keyword']))."%' ))";

		
			
		$where_condition1='';
		if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition1.=" order by Paypal_name asc";
			if($_REQUEST['flag']=="2")
			$where_condition1.=" order by Paypal_name desc";
			
			
		}else{
			$where_condition1.=" order by `Id` desc";
		}

		$SelQuery	= "select * from `tbl_paypal` where
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
         					 $objSmarty->assign("CatList",$Res_Tickets);
	}

function getPaypaldetailsById()
	{
		global $objSmarty;

		$SelQuery	= "SELECT * from `tbl_paypal` where `Id` = '".$_REQUEST['Ident']."' and Status='1' ";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("Paypal",$ExeSelQuery);

	}
function updatepaypal(){
		global $objSmarty;
		$selQuery="select * from tbl_paypal where Paypal_Email='".addslashes($_REQUEST['email'])."'
		 and Id!='".$_REQUEST['Ident']."'";
		$count=$this->ExecuteQuery($selQuery, "norows");
		if(!$count){
			$proceed="Yes";

			if($proceed=="Yes"){
				$upQuery="update tbl_paypal set `Paypal_name`='".addslashes($_REQUEST['name'])."',
													`Paypal_Id`='".addslashes($_REQUEST['Id'])."',
													`Paypal_Email`='".addslashes($_REQUEST['email'])."',
												`Updated_Date`=now()
												where Id='".$_REQUEST['Ident']."'";
				$this->ExecuteQuery($upQuery, "update");

				$objSmarty->assign("SuccessMessage","Paypal details has been updated successfully");
			}
		}else{
			$objSmarty->assign("ErrorMessage","Paypal details already exist");
		}
	}	
	/*************************************timing management******************************************/
	
	function manage_timing(){
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['keyword']!="" )
		$where_condition.="and ((`Paypal_name` like '%".trim(addslashes($_REQUEST['keyword']))."%' ))";

		
			
		$where_condition1='';
		if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition1.=" order by Time asc";
			if($_REQUEST['flag']=="2")
			$where_condition1.=" order by Time desc";
			
			
		}else{
			$where_condition1.=" order by `Id` desc";
		}

		$SelQuery	= "select * from `tbl_timing` where
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
         					 $objSmarty->assign("CatList",$Res_Tickets);
	}
	
function gettimedetailsById()
	{
		global $objSmarty;

		$SelQuery	= "SELECT * from `tbl_timing` where `Id` = '".$_REQUEST['Ident']."' and Status='1' ";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("timing",$ExeSelQuery);

	}
function updatetime(){
		global $objSmarty;
				$upQuery="update tbl_timing set `Time`='".addslashes($_REQUEST['datetimepicker'])."',
												`Updated_Date`=now()
												where Id='".$_REQUEST['Ident']."'";
				$this->ExecuteQuery($upQuery, "update");

				$objSmarty->assign("SuccessMessage","Paypal details has been updated successfully");
			
	}	
function getsplitById($var)
{
	$res=explode(":",$var);
	if($res[0] == '00')
	{
	return $res[1].' mins';
	}
	else
	{
		return $res[0]. ' Hrs '.$res[1].' mins';
	}
	
}

function getTeamApiById()
{
		global $objSmarty;
		 $selQuery="select * from tbl_teams_active where `Id` = '".$_REQUEST['CatIdent']."'";
		$res=$this->ExecuteQuery($selQuery, "select");
		$objSmarty->assign("team",$res);
}
function getPlayerApiById()
{
		global $objSmarty;
		 $selQuery="select * from tbl_players_byteam where `Id` = '".$_REQUEST['CatIdent']."'";
		$res=$this->ExecuteQuery($selQuery, "select");
		$objSmarty->assign("player",$res);
}
function getPlayerNewsApiById($id)
{
		global $objSmarty;
		 $selQuery="select * from tbl_latestnews where `Player_ID` = '".$id."'";
		$res=$this->ExecuteQuery($selQuery, "select");
		//$objSmarty->assign("player",$res);
		return $res;
}
function getPlayerSeasonApiById($id)
{
		global $objSmarty;
		$selQuery="select * from tbl_player_season where `Player_ID` = '".$id."'";
		$res=$this->ExecuteQuery($selQuery, "select");
		//$objSmarty->assign("player",$res);
		return $res;
}
function getPlayerScoreApiById($id)
{
		global $objSmarty;
		$selQuery="select * from  tbl_scoring_details where `Player_ID` = '".$id."'";
		$res=$this->ExecuteQuery($selQuery, "select");
		//$objSmarty->assign("player",$res);
		return $res;
}
function getScheduleApiById()
{
		global $objSmarty;
		 $selQuery="select * from tbl_schedule where `Id` = '".$_REQUEST['CatIdent']."'";
		$res=$this->ExecuteQuery($selQuery, "select");
		$objSmarty->assign("schedule",$res);
}
function getInjuryApiById()
{
		global $objSmarty;
		$selQuery="select * from tbl_injury where `Id` = '".$_REQUEST['CatIdent']."'";
		$res=$this->ExecuteQuery($selQuery, "select");
		$objSmarty->assign("injury",$res);
}


}
?>