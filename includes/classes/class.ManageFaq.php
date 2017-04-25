<?php
/*	Class Function for Admin	*/

class ManageFaq extends MysqlFns
{
	function ManageFaq()
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
	
	//FAQ Management
	function manage_faq()
	{
		global $objSmarty,$objPage;
		
		//$where_condition="";		
		//$where_condition="where faqid is not null";
	if($_REQUEST['pagelimit']==''){
				$this->Limit			= 10;
		}else{
		 $this->Limit=$_REQUEST['pagelimit'];
		}
		if(isset($_REQUEST['keyword']) && $_REQUEST['keyword']!='')
			$where_condition=" where question like '%".addslashes($_REQUEST['keyword'])."%'";
	
		$SelQuery	= "select *  from tbl_faq"
					  ." $where_condition"
					  ." order by faqid desc";
		//echo $SelQuery;exit;		  
		
		if(isset($_REQUEST['page']) && $_REQUEST['page'] >1)
			$i= ($this->Limit * $_REQUEST['page'] )-$this->Limit +1;
		else
			$i=1;
		$objSmarty->assign("i",$i);	
					  
		$listing_split = new MsplitPageResults($SelQuery, $this->Limit);
		if ( ($listing_split->number_of_rows > 0) ) 
		{
			$objSmarty->assign("LinkPage",$listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_RESULT));
			$objSmarty->assign("PerPageNavigation",TEXT_RESULT_PAGE1 . ' ' . $listing_split->display_links($this->Limit, get_all_get_params(array('page', 'info', 'x', 'y')))); 
		}
		
		if ($listing_split->number_of_rows > 0) 
		{
			$rows = 0;
			$Res_Tickets	= $this->ExecuteQuery($listing_split->sql_query, "select");
		}
		
		if(!empty($Res_Tickets)&& is_array($Res_Tickets))
			$objSmarty->assign("faq",$Res_Tickets);
	}
	
	function view_faq()
	{
		global $objSmarty,$objPage;
		$SelQuery	= "select *  from tbl_faq"
					  ." where faqid='".$_REQUEST['Ident']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("faq",$ExeSelQuery);

	}
	
	function edit_faq()
	{
		global $objSmarty;
		$sql="Update tbl_faq SET question='".trim(addslashes($_REQUEST['question']))."',answer='".trim(addslashes($_REQUEST['answer']))."',date=now() WHERE faqid='".$_REQUEST['Ident']."'";
			$ExeUpdQuery= $this->ExecuteQuery($sql,"update");
			$objSmarty->assign("SuccessMessage","FAQ has been updated successfully");
	}
	
	function add_faq()
	{
		global $objSmarty;
		$insert="INSERT INTO tbl_faq(question,answer,date,Status)VALUES('".trim(addslashes($_REQUEST['question']))."','".trim(addslashes($_REQUEST['answer']))."',now(),'1')";
		$ExeSelQuery= $this->ExecuteQuery($insert,"insert");
		$objSmarty->assign("SuccessMessage","FAQ has been added successfully");
	}
}
?>