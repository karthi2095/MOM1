<?php
class Content extends MysqlFns
{
	function Content()
	{
		global $config;
		$this->MysqlFns();
		$this->Offset			= 0;
		$this->Limit			= 10;
		$this->Keyword			= '';
		$this->Operator			= '';
		$this->PerPage			= '';
	}

	function GetContentLists()
	{
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['pagelimit']==''){
			$this->Limit			= 10;
		}else{
		 $this->Limit=$_REQUEST['pagelimit'];
		}
		if(isset($_REQUEST['keyword']) && $_REQUEST['keyword']!='')
		$where_condition.=" where `title` like '%".addslashes(trim($_REQUEST['keyword']))."%'";
		if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition.=" order by title asc";
			if($_REQUEST['flag']=="2")
			$where_condition.=" order by title desc";
				
		}else{
			$where_condition.=" order by `id` desc";
		}

		$SelQuery	= "select * from `tbl_staticpages`"
		." $where_condition";
			
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

	function EditContent()
	{
		global $objSmarty;
		$CatIdent=$_REQUEST['CatIdent'];
		$objSmarty->assign("title", $_REQUEST["title"]);
		if($this->ChkDuplicate(trim(addslashes($_REQUEST['title'])),$CatIdent)){
				
			if(!$_REQUEST["title"]){
				$objSmarty->assign("ErrorMessage", "Title should not be blank");
			}elseif(!trim(strip_tags(str_replace("&nbsp;",' ',$_REQUEST["content"])))){
				$objSmarty->assign("ErrorMessage", "Content should not be blank");
			}
			else if($_REQUEST["title"] && $_REQUEST["content"]){
				$UpQuery = "UPDATE `tbl_staticpages` SET `title` = '".trim(addslashes($_REQUEST['title']))."', `content` = '".trim(addslashes($_REQUEST['content']))."' WHERE `id` =".$_REQUEST['CatIdent'];

				$this->ExecuteQuery($UpQuery, "update");
				$objSmarty->assign("SuccessMessage", "Content has been updated successfully");
				return true;
			}
		}else{
				
			$objSmarty->assign("title", $_REQUEST["title"]);
			$objSmarty->assign("content",$_REQUEST["content"]);
			$objSmarty->assign("ErrorMessage", "Title already exists");
			$objSmarty->assign("err", "exist");
			PrePopulate($_REQUEST, "CatDetail");
		}
	}


	function GetContentById()
	{
		global $objSmarty;
		$SelQuery		= "SELECT * FROM `tbl_staticpages`"
		." WHERE `id` = ".$_REQUEST['CatIdent']." LIMIT 0,1";
		$CatDetail		= $this->ExecuteQuery($SelQuery, "select");

		$CatDetail[0]['title'] = stripslashes($CatDetail[0]['title']);
		$CatDetail[0]['content'] = stripslashes($CatDetail[0]['content']);
		$CatDetail[0]['meta_title'] = stripslashes($CatDetail[0]['meta_title']);
		$CatDetail[0]['meta_keywords'] = stripslashes($CatDetail[0]['meta_keywords']);
		$CatDetail[0]['meta_description'] = stripslashes($CatDetail[0]['meta_description']);
		$objSmarty->assign("title", $CatDetail[0]['title']);
		$objSmarty->assign("meta_title", $CatDetail[0]['meta_title']);
		$objSmarty->assign("meta_keywords", $CatDetail[0]['meta_keywords']);
		$objSmarty->assign("meta_description", $CatDetail[0]['meta_description']);
		$sBasePath = "../includes/FCKeditor/";
		$oFCKeditor 			= new FCKeditor('content') ;
		$oFCKeditor->BasePath	= $sBasePath ;
		$oFCKeditor->Width		= 600 ;
		$oFCKeditor->Height		= 450 ;
		$oFCKeditor->Value		= $CatDetail[0]['content'];
		//$Editor 				= $oFCKeditor->Create() ;
		$objSmarty->assign("Editor", $oFCKeditor);
		$objSmarty->assign("image", $CatDetail[0]['con_image']);
		return htmlspecialchars($CatDetail[0]['content']);
	}

	function ChkDuplicate1($Title, $Ident='')
	{
		global $objSmarty;
		if(!empty($Ident))
		$WhereClause	= " AND `id` != ".$Ident;
		$SelQuery		= "SELECT * FROM `tbl_testimonials`"
		. " WHERE `title` = '".$Title."' ".$WhereClause
		. " LIMIT 0,1";
		$CatDetail		= $this->ExecuteQuery($SelQuery, "select");
		if(!empty($CatDetail) && is_array($CatDetail))
		return false;
		else
		return true;
	}
	function ChkDuplicate($Title, $Ident='')
	{
		global $objSmarty;
		if(!empty($Ident))
		$WhereClause	= " AND `id` != ".$Ident;
		$SelQuery		= "SELECT * FROM `tbl_staticpages`"
		. " WHERE `title` = '".$Title."' ".$WhereClause
		. " LIMIT 0,1";
		$CatDetail		= $this->ExecuteQuery($SelQuery, "select");
		if(!empty($CatDetail) && is_array($CatDetail))
		return false;
		else
		return true;
	}

	function GetContent($title)
	{
		global $objSmarty;
		$SelQuery		= "SELECT * FROM `tbl_staticpages`"
		." WHERE `title` = '".$title."'";
		$CatDetail		= $this->ExecuteQuery($SelQuery, "select");

		$objSmarty->assign("title", $CatDetail[0]['title']);
		$objSmarty->assign("content", $CatDetail[0]['content']);
		$objSmarty->assign("StaticContent",$CatDetail);

	}
	function getcontents($id)
	{
		global $objSmarty,$config;
		$sel="select * from `tbl_staticpages` where id='$id'";
		$exesel=$this->ExecuteQuery($sel,"select");
		$objSmarty->assign("scontent",$exesel);
	}
	function GetContentid($id)
	{
		global $objSmarty;
		$SelQuery		= "SELECT * FROM `tbl_staticpages`"
		." WHERE `id` = $id";
		$CatDetail		= $this->ExecuteQuery($SelQuery, "select");
		$objSmarty->assign("title", $CatDetail[0]['title']);
		$objSmarty->assign("content", $CatDetail[0]['content']);
	}

	function InsertContent()
	{

		global $objSmarty;
        $objSmarty->assign("title", $_REQUEST["title"]);
		if($this->ChkDuplicate(trim(addslashes($_REQUEST['title'])),$CatIdent)){
				
			if(!$_REQUEST["title"]){
				$objSmarty->assign("ErrorMessage", "Title should not be blank");
			}elseif(!trim(strip_tags(str_replace("&nbsp;",' ',$_REQUEST["content"])))){
				$objSmarty->assign("ErrorMessage", "Content should not be blank");
			}
			else if($_REQUEST["title"] && $_REQUEST["content"]){
				$UpQuery = "insert into `tbl_staticpages` 
				SET 
			  `title` = '".trim(addslashes($_REQUEST['title']))."',
		      `content` = '".trim(addslashes(htmlentities($_REQUEST['content'])))."',
		      `Status` = '1' ";

				$this->ExecuteQuery($UpQuery, "update");
				$objSmarty->assign("SuccessMessage", "Content has been added successfully");
				return true;
			}
		}else{
				
			$objSmarty->assign("title", $_REQUEST["title"]);
			$objSmarty->assign("content",$_REQUEST["content"]);
			$objSmarty->assign("ErrorMessage", "Title already exists");
			$objSmarty->assign("err", "exist");
			PrePopulate($_REQUEST, "CatDetail");
		}
	}


	/********************----------------INSTRUMENT----------------------*******************/

	function GetInstrumentLists()
	{
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['pagelimit']==''){
			$this->Limit			= 10;
		}else{
		 $this->Limit=$_REQUEST['pagelimit'];
		}
		if(isset($_REQUEST['keyword']) && $_REQUEST['keyword']!='')
		$where_condition.=" where `Instrument` like '%".addslashes(trim($_REQUEST['keyword']))."%'";
		if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition.=" order by Instrument desc";
			if($_REQUEST['flag']=="2")
			$where_condition.=" order by Instrument asc";
				
		}else{
			//$where_condition.=" order by `ID` desc";
			$where_condition.=" order by `Instrument` asc";
		}

		$SelQuery	= "select * from `tbl_instrument`"
		." $where_condition";
			
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

	function add_instrument()
	{

		global $objSmarty,$objPage;
		$SelQuery	= "SELECT * from `tbl_instrument`
						WHERE 
						`Instrument`='".addslashes($_REQUEST['instrumentName'])."'";

		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"norows");
		if(!$ExeSelQuery)
		{
			$InsQuery	= "INSERT INTO `tbl_instrument`
											    (
											      `Instrument`,					      
											      `Status`,
											      `CreatedDate`
											    )
											     VALUES 
											    (
											       '".addslashes($_REQUEST['instrumentName'])."',								       
											       '1',
											       now())";
			$ExeInsQuery=$this->ExecuteQuery($InsQuery,"insert");
			$objSmarty->assign("SuccessMessage","Instrument has been added successfully");
		}
		else
		{
			$objSmarty->assign('instrument',$_REQUEST);
			$objSmarty->assign("ErrorMessage","Instrument name already exists");
		}

	}
	function add_specialty()
	{

		global $objSmarty,$objPage;
		$SelQuery	= "SELECT * from `tbl_specialty`
						WHERE 
						`Specialty`='".addslashes($_REQUEST['specialty'])."'";

		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"norows");
		if(!$ExeSelQuery)
		{
			$InsQuery	= "INSERT INTO `tbl_specialty`
											    (
											      `Specialty`,	`SubCategory`,					      
											      `Status`,
											      `CreatedDate`
											    )
											     VALUES 
											    (
											       '".addslashes($_REQUEST['specialty'])."',	 '".addslashes($_REQUEST['subcat'])."',							       
											       '1',
											       now())";
			$ExeInsQuery=$this->ExecuteQuery($InsQuery,"insert");
			$objSmarty->assign("SuccessMessage","Speciality has been added successfully");
		}
		else
		{
			$objSmarty->assign('specialty',$_REQUEST);
			$objSmarty->assign("ErrorMessage","Category name already exists");
		}

	}

	function selectInstrumentById()
	{
		global $objSmarty;
		if($_REQUEST['Ident']!='')
		{
			$selQuery="select * from `tbl_instrument` where ID='".$_REQUEST['Ident']."'";
			$result=$this->ExecuteQuery($selQuery,"select");
			$objSmarty->assign("Instrument",$result);
		}
		else
		{
			redirect('manage_instrument.php');
		}
	}
	function selectSpecialtyById()
	{
		global $objSmarty;
		if($_REQUEST['Ident']!='')
		{
			$selQuery="select * from `tbl_specialty` where ID='".$_REQUEST['Ident']."'";
			$result=$this->ExecuteQuery($selQuery,"select");
			$objSmarty->assign("specialty",$result);
		}
		else
		{
			redirect('manage_specialty.php');
		}
	}
	function update_specialty()
	{
		global $objSmarty;
		$SelQuery	= "SELECT * from `tbl_specialty`
						WHERE 
						`Specialty`='".addslashes($_REQUEST['specialty'])."' and ID !='".$_REQUEST['Ident']."'";

		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"norows");
		if(!$ExeSelQuery)
		{
			$upQuery="update `tbl_specialty` set
										`Specialty`='".addslashes($_REQUEST['specialty'])."',`SubCategory`='".addslashes($_REQUEST['subcat'])."',
										CreatedDate=now()
										where ID='".$_REQUEST['Ident']."'";
			$this->ExecuteQuery($upQuery,"update");
			$objSmarty->assign("SuccessMessage","Speciality has been updated successfully");
		}
		else
		{
			$objSmarty->assign("ErrorMessage","Category name already exists");
		}

	}
	function update_instrument()
	{
		global $objSmarty;
		$SelQuery	= "SELECT * from `tbl_instrument`
						WHERE 
						`Instrument`='".addslashes($_REQUEST['instrumentName'])."' and ID !='".$_REQUEST['Ident']."'";

		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"norows");
		if(!$ExeSelQuery)
		{
			$upQuery="update `tbl_instrument` set
										`Instrument`='".addslashes($_REQUEST['instrumentName'])."',
										CreatedDate=now()
										where ID='".$_REQUEST['Ident']."'";
			$this->ExecuteQuery($upQuery,"update");
			$objSmarty->assign("SuccessMessage","Instrument has been updated successfully");
		}
		else
		{
			$objSmarty->assign("ErrorMessage","Instrument name already exists");
		}

	}

	/********************----------------STYLE----------------------*******************/

	function GetStyleLists()
	{
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['pagelimit']==''){
			$this->Limit			= 10;
		}else{
		 $this->Limit=$_REQUEST['pagelimit'];
		}
		if(isset($_REQUEST['keyword']) && $_REQUEST['keyword']!='')
		$where_condition.=" where `Style` like '%".addslashes(trim($_REQUEST['keyword']))."%'";
		if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition.=" order by Style desc";
			if($_REQUEST['flag']=="2")
			$where_condition.=" order by Style asc";
				
		}else{
			//$where_condition.=" order by `ID` desc";
			$where_condition.=" order by Style asc";
		}

		$SelQuery	= "select * from `tbl_style`"
		." $where_condition";
			
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

	function add_style()
	{

		global $objSmarty,$objPage;
		$SelQuery	= "SELECT * from `tbl_style`
						WHERE 
						`Style`='".addslashes($_REQUEST['styleName'])."'";

		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"norows");
		if(!$ExeSelQuery)
		{
			$InsQuery	= "INSERT INTO `tbl_style`
											    (
											      `Style`,					      
											      `Status`,
											      `CreatedDate`
											    )
											     VALUES 
											    (
											       '".addslashes($_REQUEST['styleName'])."',								       
											       '1',
											       now())";
			$ExeInsQuery=$this->ExecuteQuery($InsQuery,"insert");
			$objSmarty->assign("SuccessMessage","Style has been added successfully");
		}
		else
		{
			$objSmarty->assign('Style',$_REQUEST);
			$objSmarty->assign("ErrorMessage","Style name already exists");
		}

	}


	function selectStyleById()
	{
		global $objSmarty;
		if($_REQUEST['Ident']!='')
		{
			$selQuery="select * from `tbl_style` where ID='".$_REQUEST['Ident']."'";
			$result=$this->ExecuteQuery($selQuery,"select");
			$objSmarty->assign("Style",$result);
		}
		else
		{
			redirect('manage_style.php');
		}
	}
	function update_style()
	{
		global $objSmarty;
		$SelQuery	= "SELECT * from `tbl_style`
						WHERE 
						`Style`='".addslashes($_REQUEST['styleName'])."' and ID !='".$_REQUEST['Ident']."'";

		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"norows");
		if(!$ExeSelQuery)
		{
			$upQuery="update `tbl_style` set
										`Style`='".addslashes($_REQUEST['styleName'])."',
										CreatedDate=now()
										where ID='".$_REQUEST['Ident']."'";
			$this->ExecuteQuery($upQuery,"update");
			$objSmarty->assign("SuccessMessage","Style has been updated successfully");
		}
		else
		{
			$objSmarty->assign("ErrorMessage","Style name already exists");
		}

	}
	/*************************************----SA----- july 06,2015----------site mamagement----------------**********************/
	function Manage_site()
	{
		global $objSmarty;

		$SelQuery		= "SELECT * FROM `tbl_site` WHERE `Id` ='1'";
		$ExeQueryss		= $this->ExecuteQuery($SelQuery, "select");
		$sitephone=$ExeQueryss[0]['Phone'];
	 $siteemail=$ExeQueryss[0]['Email'];
	 $siteaddress=$ExeQueryss[0]['Address'];
	 $objSmarty->assign("sitephone",$sitephone);
	 $objSmarty->assign("siteemail",$siteemail);
	 $objSmarty->assign("siteaddress",$siteaddress);
		$objSmarty->assign("CntList", $ExeQueryss);
	}
	function editSite()
	{
		global $objSmarty;

		$id = $_REQUEST['CatIdent'];

		$UpQuery = "UPDATE tbl_site SET Email = '".$_REQUEST['email']."',Phone = '".$_REQUEST['phone']."',Website = '".$_REQUEST['Website']."' ,
		Address = '".$_REQUEST['address']."' ,Date = now() WHERE Id='".$id."'"; 
		$ExeQuery		= $this->ExecuteQuery($UpQuery, "update");
		$objSmarty->assign("SuccessMessage", "Site has been updated successfully");
	}

	function GetTestimonialLists()
	{
		global $objSmarty,$objPage;
		$where_condition="";

		if(isset($_REQUEST['keyword']) && $_REQUEST['keyword']!='')
		$where_condition.=" where `title` like '%".addslashes(trim($_REQUEST['keyword']))."%'";
		if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition.=" order by title asc";
			if($_REQUEST['flag']=="2")
			$where_condition.=" order by title desc";
				
		}else{
			$where_condition.=" order by `id` desc";
		}

		$SelQuery	= "select * from `tbl_testimonials`"
		." $where_condition";
			
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
	function InsertTestimonialContent()
	{

		global $objSmarty;

		$objSmarty->assign("title", $_REQUEST["title"]);
		if($this->ChkDuplicate1(trim(addslashes($_REQUEST['title'])),$CatIdent)){
				
			if(!$_REQUEST["title"]){
				$objSmarty->assign("ErrorMessage", "Title should not be blank");
			}elseif(!trim(strip_tags(str_replace("&nbsp;",' ',$_REQUEST["content"])))){
				$objSmarty->assign("ErrorMessage", "Testimonial should not be blank");
			}
			else if($_REQUEST["title"] && $_REQUEST["content"]){
				$UpQuery = "insert into `tbl_testimonials` SET `title` = '".trim(addslashes($_REQUEST['title']))."',
		      `content` = '".trim(addslashes($_REQUEST['content']))."',`username` = '".trim(addslashes($_REQUEST['username']))."',
		      `city` = '".trim(addslashes($_REQUEST['city']))."',`country` = '".trim(addslashes($_REQUEST['country']))."',
		      `status` = '1',CreatedDate=Now()
		     ";

				$this->ExecuteQuery($UpQuery, "update");
				$objSmarty->assign("SuccessMessage", "Testimonial has been added successfully");
				return true;
			}
		}else{
				
			$objSmarty->assign("title", $_REQUEST["title"]);
			$objSmarty->assign("content",$_REQUEST["content"]);
			$objSmarty->assign("username",$_REQUEST["username"]);
			$objSmarty->assign("city",$_REQUEST["city"]);
			$objSmarty->assign("country",$_REQUEST["country"]);
			$objSmarty->assign("ErrorMessage", "Title already exists");
			$objSmarty->assign("err", "exist");
			PrePopulate($_REQUEST, "CatDetail");
		}
	}
	function GetTestimonialById()
	{
		global $objSmarty;
		$SelQuery		= "SELECT * FROM `tbl_testimonials`"
		." WHERE `id` = ".$_REQUEST['CatIdent']." LIMIT 0,1";
		$CatDetail		= $this->ExecuteQuery($SelQuery, "select");

		$CatDetail[0]['title'] = stripslashes($CatDetail[0]['title']);
		$CatDetail[0]['content'] = stripslashes($CatDetail[0]['content']);
		$CatDetail[0]['username'] = stripslashes($CatDetail[0]['username']);
		$CatDetail[0]['city'] = stripslashes($CatDetail[0]['city']);
		$CatDetail[0]['country'] = stripslashes($CatDetail[0]['country']);

		$objSmarty->assign("title", $CatDetail[0]['title']);
		$objSmarty->assign("username", $CatDetail[0]['username']);
		$objSmarty->assign("city", $CatDetail[0]['city']);
		$objSmarty->assign("country", $CatDetail[0]['country']);
		$objSmarty->assign("content", $CatDetail[0]['content']);
		$sBasePath = "../includes/FCKeditor/";
		$oFCKeditor 			= new FCKeditor('content') ;
		$oFCKeditor->BasePath	= $sBasePath ;
		$oFCKeditor->Width		=400 ;
		$oFCKeditor->Height		= 350 ;
		$oFCKeditor->Value		= $CatDetail[0]['content'];
		//$Editor 				= $oFCKeditor->Create() ;
		$objSmarty->assign("Editor", $oFCKeditor);

		return $CatDetail[0]['content'];
	}
	function EditTestimonialContent()
	{
		global $objSmarty;

		$CatIdent=$_REQUEST['CatIdent'];
		$objSmarty->assign("title", $_REQUEST["title"]);
		if($this->ChkDuplicate1(trim(addslashes($_REQUEST['title'])),$CatIdent)){
				
			if(!$_REQUEST["title"]){
				$objSmarty->assign("ErrorMessage", "Title should not be blank");
			}elseif(!trim(strip_tags(str_replace("&nbsp;",' ',$_REQUEST["content"])))){
				$objSmarty->assign("ErrorMessage", "Testimonial should not be blank");
			}
			else if($_REQUEST["title"] && $_REQUEST["content"]){
				$UpQuery = "UPDATE `tbl_testimonials` SET `title` = '".trim(addslashes($_REQUEST['title']))."', `content` = '".trim(addslashes($_REQUEST['content']))."',`username` = '".trim(addslashes($_REQUEST['username']))."',`city` = '".trim(addslashes($_REQUEST['city']))."',`country` = '".trim(addslashes($_REQUEST['country']))."' WHERE `id` =".$_REQUEST['CatIdent'];

				$this->ExecuteQuery($UpQuery, "update");
				$objSmarty->assign("SuccessMessage", "Testimonial has been updated successfully");
				return true;
			}
		}else{
				
			$objSmarty->assign("title", $_REQUEST["title"]);
			$objSmarty->assign("content",$_REQUEST["content"]);
			$objSmarty->assign("username",$_REQUEST["username"]);
			$objSmarty->assign("city",$_REQUEST["city"]);
			$objSmarty->assign("country",$_REQUEST["countyr"]);
			$objSmarty->assign("ErrorMessage", "Title already exists");
			$objSmarty->assign("err", "exist");
			PrePopulate($_REQUEST, "CatDetail");
		}
	}

	function searchmember()
	{
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['searchtype']=='4'){
			if($_REQUEST['city']!=''){
				$expcity=explode(',',$_REQUEST['city']);
				$city=$expcity[0];
				$where_condition.=" and j.City like '%".addslashes(trim($city))."%' ";
			}
			$selquery	= "select j.* from tbl_job j where j.Status='1'"."$where_condition";
			$ExeQuery		= $this->ExecuteQuery($selquery, "select");
		}
		else{
			if($_REQUEST['searchtype']=='1'){
				$where_condition.=" and u.UserType!= 'Employer'  and u.UserType!= 'Industry' and u.UserType!= 'Employer & Industry'";
			}
			if($_REQUEST['searchtype']=='2'){
				$where_condition.="and u.UserType!= 'Musician'  and u.UserType!= 'Industry' and u.UserType!= 'Musician & Industry'";
			}
			if($_REQUEST['searchtype']=='3'){
				$where_condition.=" and u.UserType!= 'Musician'  and u.UserType!= 'Employer' and u.UserType!= 'Musician & Employer'";
			}
			if($_REQUEST['city']!=''){
				$expcity=explode(',',$_REQUEST['city']);
				$city=$expcity[0];
				$where_condition.=" and u.City like '%".addslashes(trim($city))."%' ";
			}
			$selquery	= "select u.* from tbl_user u where u.Status='1' and u.MailStatus='1' and u.UserId!='".$_SESSION['UserId']."'"
			."$where_condition";
			$ExeQuery	= $this->ExecuteQuery($selquery, "select");
		}
	}
	function searchfilter()
	{
		global $objSmarty,$objPage;
		$where_condition="";
		$where_condition1="";

		
		
		
		$squery="select * from  tbl_hide where UserId='".$_SESSION['UserId']."'";
		$exesel=$this->ExecuteQuery($squery,"select");
		$exe=$this->ExecuteQuery($squery,"norows");
		for($i=0;$i<$exe;$i++){
			$hid[]=$exesel[$i]['HideId'];
			$string= implode(",",$hid);
		}

		if($string!=''){
			$where_condition.=" and u.UserId NOT IN($string) ";
		}
		/*************** BY SM *******************/
		$ins=$_REQUEST['instrument'];
		if (!empty($ins))
		{	
	   foreach ($ins as  $val) {
	   	if ($val === reset($ins))
	   	{
	   		
	   		$strt='and (';
	   	}
	   	else 
	   	{
	   		$strt=' ';
	   		
	   	}
	   	if ($val === end($ins))
	   	{
	   		//echo 'LAST ELEMENT!';
	   		$or=')';
	   	}else{	
	   		$or='or';
	   	}
	   //echo $val,'<br>';
	  $where_condition1.=" $strt FIND_IN_SET ('".$val."',u.`Instrument`) $or ";
   
       }
	} 
	$style=$_REQUEST['style'];
	if (!empty($style))
		{	
	   foreach ($style as  $vals) {
	   	if ($vals === reset($style))
	   	{
	   		
	   		$strts='and (';
	   	}
	   	else 
	   	{
	   		$strts=' ';
	   		
	   	}
	   	if ($vals === end($style))
	   	{
	   		//echo 'LAST ELEMENT!';
	   		$ors=')';
	   	}else{	
	   		$ors='or';
	   	}
	   //echo $val,'<br>';
	  $where_condition1.=" $strts FIND_IN_SET ('".$vals."',u.`Style`) $ors ";
   
       }
	}

		$specialty=$_REQUEST['specialty'];
	if (!empty($specialty))
		{	
	   foreach ($specialty as  $valus) {
	   	if ($valus === reset($specialty))
	   	{
	   		
	   		$strs='and (';
	   	}
	   	else 
	   	{
	   		$strs=' ';
	   		
	   	}
	   	if ($valus === end($specialty))
	   	{
	   		//echo 'LAST ELEMENT!';
	   		$orus=')';
	   	}else{	
	   		$orus='or';
	   	}
	   //echo $val,'<br>';
	  $where_condition1.=" $strs FIND_IN_SET ('".$valus."',u.`Specialty`) $orus ";
   
       }
	}
		/*************** BY SM *******************/
		if($_REQUEST['fromage']!='' && $_REQUEST['toage']!=''){
			if($_REQUEST['fromage']=='50' || $_REQUEST['toage']=='50'){
				$where_condition.=" and u.Age >= ".$_REQUEST['fromage']." ";
			}else{
				$where_condition.=" and u.Age between ".$_REQUEST['fromage']." and ".$_REQUEST['toage']." ";
			}
		}
		if($_REQUEST['ty']=='1'){

			$where_condition.=" and u.UserType!= 'Employer'  and u.UserType!= 'Industry'
			 and u.UserType!= 'Employer & Industry'";
		}
		if($_REQUEST['ty']=='2'){
			$where_condition.="and u.UserType!= 'Musician'  and u.UserType!= 'Industry' 
			and u.UserType!= 'Musician & Industry'   ";
		}
		if($_REQUEST['ty']=='3'){
			$where_condition.=" and u.UserType!= 'Musician'  and u.UserType!= 'Employer' 
			and u.UserType!= 'Musician & Employer'   ";
		}
		if($_REQUEST['scity']!=''){
		 $expcity=explode(',',$_REQUEST['scity']);
		 $city=$expcity[0];
		 $state1=$expcity[1];		 
		 //$where_condition.=" and u.City like '%".addslashes(trim($city))."%' ";		 

			//$cityquery	= 'SELECT ci.id as cityId, s.id as stateId, co.code as country FROM cities ci INNER JOIN states s ON ci.state_id = s.id INNER JOIN countries co ON co.code = s.country where ci.name = "'. mysql_real_escape_string($city) .'" LIMIT 1';
			$cityquery	= 'SELECT ci.id as cityId, s.id as stateId, co.code as country FROM cities ci INNER JOIN states s ON ci.state_id = s.id INNER JOIN countries co ON co.code = s.country where ci.name = "'. mysql_real_escape_string($city) .'" and s.name = "'. mysql_real_escape_string($state1) .'" LIMIT 1';			
			$ExeCityQuery= $this->ExecuteQuery($cityquery,"norows");		 
			if($ExeCityQuery > 0){		
				$cityDetail	= $this->ExecuteQuery($cityquery, "select");
				$where_condition.=" and u.Country='".$cityDetail[0]['country']."' ";
				$where_condition.=" and u.State='".$cityDetail[0]['stateId']."' ";	
				$where_condition.=" and u.City='".$cityDetail[0]['cityId']."' ";	
			}		 		 
		}
		if($_REQUEST['firstname']!=''){

			$where_condition.=" and u.FirstName like '%".addslashes(trim($_REQUEST['firstname']))."%' ";
		}
		if($_REQUEST['lastname']!=''){

			$where_condition.=" and u.LastName like '%".addslashes(trim($_REQUEST['lastname']))."%' ";
		}
	if($_REQUEST['emails']!=''){

			$where_condition.=" and u.Email like '%".addslashes(trim($_REQUEST['emails']))."%' ";
		}
	if($_REQUEST['mobile']!=''){

			$where_condition.=" and u.Mobile like '%".addslashes(trim($_REQUEST['mobile']))."%' ";
		}
		if($_REQUEST['city']!='' && $_REQUEST['city']!='0'){

			$where_condition.=" and u.City = '".addslashes(trim($_REQUEST['city']))."' ";
		}
	if($_REQUEST['company']!=''){

			$where_condition.=" and u.Company like '%".addslashes(trim($_REQUEST['company']))."%' ";
		}
		if($_REQUEST['zip']!='' ){

			$where_condition.=" and u.Zip='".$_REQUEST['zip']."' ";
		}
		if($_REQUEST['rating1']!=''){

			$where_condition.=" and u.rating >='".$_REQUEST['rating1']."' ";
		}
		if($_REQUEST['s']!='' ){

			$where_condition.=" and u.State='".$_REQUEST['s']."' ";
		}
		if($_REQUEST['country']!='' && $_REQUEST['country']!='0'){

			$where_condition.=" and u.Country='".$_REQUEST['country']."' ";
		}		
		if($_REQUEST['state']!='' && $_REQUEST['state']!='0'){

			$where_condition.=" and u.State='".$_REQUEST['state']."' ";
		}
		if($_REQUEST['fname']!=''){

			$where_condition.=" and u.FirstName like '%".addslashes(trim($_REQUEST['fname']))."%'  or  u.LastName like '%".addslashes(trim($_REQUEST['fname']))."%'";
		}

		/*if($_REQUEST['instrument']!='0' && $_REQUEST['instrument']!=''){

			$where_condition.=" and FIND_IN_SET('".$_REQUEST['instrument']."',u.Instrument) ";
		}*/

		/*if($_REQUEST['style']!='0' && $_REQUEST['style']!=''){

			$where_condition.=" and FIND_IN_SET('".$_REQUEST['style']."',u.Style) ";
		}*/
		if($_REQUEST['gender']=='Male' || $_REQUEST['gender']=='Female'){

			$where_condition.=" and u.Gender ='".$_REQUEST['gender']."' ";
		}
		if($_REQUEST['radius']!=""  && $_REQUEST['latitude']!="" && $_REQUEST['longitude']!=""){
			$latitude=$_REQUEST['latitude'];
			$longitude=$_REQUEST['longitude'];
			$where_condition.=" and ( 3959 * acos( cos( radians($latitude) ) * cos( radians(u.Latitude) ) * cos( radians(u.Longitude) - radians($longitude) )
								+ sin( radians($latitude) ) * sin( radians(u.Latitude) ) ) ) < '".$_REQUEST['radius']."' ";
		}

		//print_r($_REQUEST['profile']) 	;
			
		if($_REQUEST['profile']=='' ){
			$selquery	= "select u.* from tbl_user u where 
			u.Status='1' and u.MailStatus='1' 
			and u.UserId!='".$_SESSION['UserId']."'"
			."$where_condition $where_condition1 ";
		}else{
				
			/*if($_REQUEST['profile']=='Image'){
			 $selquery	= "select u.*,p.UserID from tbl_user u, tbl_photos p  where u.Status='1' and u.MailStatus='1' and p.UserID=u.UserId  and u.UserId!='".$_SESSION['UserId']."'"
			 ."$where_condition". "group by p.UserID ";
			 }
			 if($_REQUEST['profile']=='Audio'){
				$selquery	= "select u.*,p.UserID from tbl_user u,  tbl_music p  where u.Status='1' and u.MailStatus='1' and p.UserID=u.UserId  and u.UserId!='".$_SESSION['UserId']."'"
				."$where_condition". "group by p.UserID ";
				}
				if($_REQUEST['profile']=='Video'){
				$selquery	= "select u.*,p.UserID from tbl_user u,   tbl_video p  where u.Status='1' and u.MailStatus='1' and p.UserID=u.UserId  and u.UserId!='".$_SESSION['UserId']."'"
				."$where_condition". "group by p.UserID ";
				}*/
				
		 $cj=count($_REQUEST['profile']);
			for($g=0;$g<$cj;$g++){
				if($_REQUEST['profile'][$g]=='All'  ){
					 $selquery	= "select u.UserId,u.FirstName,u.LastName,u.Image,u.Gender,
					u.State,u.City,u.Zip,u.Status,u.MailStatus,
				u.UserType,u.Instrument,u.Style,u.rating,u.Age,
				b1.UserID,c1.UserID,d1.UserID from tbl_user u 
				LEFT JOIN tbl_photos b1 ON (b1.UserID=u.UserId)
				LEFT JOIN tbl_music c1 ON (c1.UserID=u.UserId)
				LEFT JOIN tbl_video d1 ON (u.UserId=d1.UserID) where b1.UserID !='NULL' 
				and c1.UserID !='NULL' and d1.UserID !='NULL' and  u.UserId!='".$_SESSION['UserId']."' and u.Status='1' and u.MailStatus='1'"
				."$where_condition". "$where_condition1 group by u.UserId
				";		
				}
				else if($_REQUEST['profile'][$g]=='Any' ){
					$qur[]	= "select u.*,p.UserID from tbl_user u, tbl_photos p where
					 u.MailStatus='1' and p.UserID=u.UserId  and u.UserId!='".$_SESSION['UserId']."'"
					."$where_condition". "group by p.UserID  union select u.*,a.UserID from tbl_user u,  tbl_music a  where u.Status='1' and u.MailStatus='1' and a.UserID=u.UserId  and u.UserId!='".$_SESSION['UserId']."'"
					."$where_condition". "group by a.UserID union select u.*,v.UserID from tbl_user u,   tbl_video v  where u.Status='1' and u.MailStatus='1' and v.UserID=u.UserId  and u.UserId!='".$_SESSION['UserId']."'"
					."$where_condition". "$where_condition1 group by v.UserID ";
				}
				else if($_REQUEST['profile'][$g]=='Image'  ){
					$qur[]	= "select u.*,p.UserID from tbl_user u, tbl_photos p
					where u.Status='1' and u.MailStatus='1' and p.UserID=u.UserId  and u.UserId!='".$_SESSION['UserId']."'"
					."$where_condition". " $where_condition1 group by p.UserID ";
				}
					
				else if($_REQUEST['profile'][$g]=='Audio' ){
					$qur[]	= "select u.*,a.UserID from tbl_user u,  tbl_music a 
					where u.Status='1' and u.MailStatus='1' and a.UserID=u.UserId  and u.UserId!='".$_SESSION['UserId']."'"
					."$where_condition". "$where_condition1 group by a.UserID ";
				}
				else  if($_REQUEST['profile'][$g]=='Video' ){
					$qur[]	= "select u.*,v.UserID from tbl_user u,   tbl_video v
					 where u.Status='1' and u.MailStatus='1' and v.UserID=u.UserId  and u.UserId!='".$_SESSION['UserId']."'"
					."$where_condition". "$where_condition1 group by v.UserID ";
				}
					
			}
			if($qur!=''){
				$selquery=implode(" union ",$qur);
			}
			//echo $selquery;
		}
//print_r($_REQUEST);
//echo $selquery;
			/************************* For page limit *******************************/
	     if(isset($_SESSION['UserId']))
			{
					$sql="select * from tbl_settings where UserId='".$_SESSION['UserId']."'";
					$ExeInsQuery=$this->ExecuteQuery($sql,"select");
					$limit= $ExeInsQuery[0]['num_pages'];
					if($limit != '')
					{
					$page_rows = $limit;
					}
					else
					{
						$page_rows = 10; 
					}
			}
			else
			{
				$page_rows =10;
			}
		//echo  $limit .$page_rows.'test';
		/************************* For page limit *******************************/	
		$i=1;
		$pagec=$_REQUEST['pagec'];
		if($_REQUEST['pagec']==0)
		{
			$pagec=1;
		}
		if (!(isset($_REQUEST[pagec])))
		{
			$pagec = 1;
			$i=1;
		}
		if($pagec==1){$i=1;}
		$resultns= $this->ExecuteQuery($selquery,"norows");
		$page_rows = 12;
		$last = ceil($resultns/$page_rows);
		$max = 'limit ' .($pagec - 1) * $page_rows .',' .$page_rows;

		$Res_Tickets=$this->ExecuteQuery($selquery.''.$max, "select");
		//echo "<pre>";
		//print_r($Res_Tickets);
		$resultn= $this->ExecuteQuery($selquery.''.$max,"norows");
		$objSmarty->assign("SearchList",$Res_Tickets);

		$n=$resultns;

		if($n<=12)
		{
			$last=1;
		}
		if($pagec!=1)
		{
			$s=$pagec;
			$m=$page_rows;
			for($k=1;$k<$s;$k++)
			{

				$K+=$m;
			}
			$i=$K+1;
		}
		$s=$pagec;
		if($s==1)
		{
			$start=1;
		}
		else {
			$start=($s-1)*12+1;
		}
		$end=$s*12;
		$endval=($start-1)+$resultn;
		$objSmarty->assign("start",$start);
		$objSmarty->assign("end",$end);
		$objSmarty->assign("pagec",$pagec);
		$objSmarty->assign("n",$n);
		$objSmarty->assign("styleartcount",$resultn);
		$div = ceil($resultn/3);
		$rem=$resultn-($div*2);
		$objSmarty->assign("endval",$endval);
		$objSmarty->assign("chks",$div);
		$objSmarty->assign("rem",$rem);
		$objSmarty->assign("last",$last);

	}


	function HiddenUsers()
	{
		global $objSmarty,$objPage;
		$where_condition="";

		$selquery	= "select u.*,h.* from  tbl_hide h,tbl_user u  where h.UserId='".$_SESSION['UserId']."' and u.UserId=h.HideId and u.Status='1' and u.MailStatus='1' "
		."$where_condition";



		$i=1;
		$pagec=$_REQUEST['pagec'];

		if($_REQUEST['pagec']==0)
		{
			$pagec=1;
		}
		if (!(isset($_REQUEST[pagec])))

		{

			$pagec = 1;
			$i=1;

		}
		if($pagec==1){$i=1;}
		$resultns= $this->ExecuteQuery($selquery,"norows");
		$page_rows = 12;
		$last = ceil($resultns/$page_rows);
		$max = 'limit ' .($pagec - 1) * $page_rows .',' .$page_rows;

		$Res_Tickets=$this->ExecuteQuery($selquery.''.$max, "select");
		//echo "<pre>";
		//print_r($Res_Tickets);
		$resultn= $this->ExecuteQuery($selquery.''.$max,"norows");
		$objSmarty->assign("SearchList",$Res_Tickets);

		$n=$resultns;

		if($n<=12)
		{
			$last=1;
		}
		if($pagec!=1)
		{
			$s=$pagec;
			$m=$page_rows;
			for($k=1;$k<$s;$k++)
			{

				$K+=$m;
			}
			$i=$K+1;
		}
		$s=$pagec;
		if($s==1)
		{
			$start=1;
		}
		else {
			$start=($s-1)*12+1;
		}
		$end=$s*12;
		$endval=($start-1)+$resultn;
		$objSmarty->assign("start",$start);
		$objSmarty->assign("end",$end);
		$objSmarty->assign("pagec",$pagec);
		$objSmarty->assign("n",$n);
		$objSmarty->assign("styleartcount",$resultn);
		$div = ceil($resultn/3);
		$rem=$resultn-($div*2);
		$objSmarty->assign("endval",$endval);
		$objSmarty->assign("chks",$div);
		$objSmarty->assign("rem",$rem);
		$objSmarty->assign("last",$last);

	}

	function Deletehide()
	{
		global $objSmarty;
		$UpQuery="DELETE FROM tbl_hide"
		. " WHERE ID = '".$_REQUEST['hdIdent']."'";
		$ExeUpQuery= $this->ExecuteQuery($UpQuery,"delete");
		//$objSmarty->assign("SuccessMessage","$word has been deleted successfully");
	}

	function GetReviewLists()
	{
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['pagelimit']==''){
			$this->Limit			= 10;
		}else{
		 $this->Limit=$_REQUEST['pagelimit'];
		}
		if(isset($_REQUEST['keyword']) && $_REQUEST['keyword']!='')
		$where_condition.=" where `Review` like '%".addslashes(trim($_REQUEST['keyword']))."%'";
		$SelQuery	= "select * from tbl_review" ."$where_condition" ;
			
			
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

	function ViewReview()
	{
		global $objSmarty;
		$where_condition="";
		$SelQuery	= "select * from tbl_review where Id='".$_REQUEST['CatIdent']."' "  ;
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("Review",$ExeSelQuery);
	}


	function GetSpecialtyLists()
	{
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['pagelimit']==''){
			$this->Limit			= 10;
		}else{
		 $this->Limit=$_REQUEST['pagelimit'];
		}
		if(isset($_REQUEST['keyword']) && $_REQUEST['keyword']!='')
		$where_condition.=" where `Specialty` like '%".addslashes(trim($_REQUEST['keyword']))."%'";
		if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition.=" order by Specialty desc";
			if($_REQUEST['flag']=="2")
			$where_condition.=" order by Specialty asc";
				
		}else{
			//$where_condition.=" order by `ID` desc";
			$where_condition.=" order by Specialty asc";
		}

		$SelQuery	= "select * from `tbl_specialty`"
		." $where_condition";
			
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

	function Allfaq()
	{
		global $objSmarty;
		$where_condition="";
		$SelQuery	= "select * from  tbl_faq where Status ='1' "  ;
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("Faq",$ExeSelQuery);
	}



	///////////////////////////////END//////////////////////////////////////////////////////////////////

	/********************************** For Subject Mgmt **************************************/
	function GetSubjectLists()
	{
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['pagelimit']==''){
			$this->Limit			= 10;
		}else{
		 $this->Limit=$_REQUEST['pagelimit'];
		}
		if(isset($_REQUEST['keyword']) && $_REQUEST['keyword']!='')
		$where_condition.=" where `Subject_name` like '%".addslashes(trim($_REQUEST['keyword']))."%'";
		if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition.=" order by Subject_name asc";
			if($_REQUEST['flag']=="2")
			$where_condition.=" order by Subject_name desc";
				
		}else{
			$where_condition.=" order by `Id` desc";
		}

		$SelQuery	= "select * from `tbl_subject`"
		." $where_condition";
			
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

	
	/**************************************** For Inhouse management **************************************/
	function GetInhouseLists()
	{
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['pagelimit']==''){
			$this->Limit			= 10;
		}else{
		 $this->Limit=$_REQUEST['pagelimit'];
		}
		if(isset($_REQUEST['keyword']) && $_REQUEST['keyword']!='')
		$where_condition.=" where `Content` like '%".addslashes(trim($_REQUEST['keyword']))."%'";
		if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition.=" order by Content asc";
			if($_REQUEST['flag']=="2")
			$where_condition.=" order by Content desc";
				
		}else{
			$where_condition.="ORDER BY `Created_date` DESC";
		}

		$SelQuery	= "select * from `tbl_inhouse`"
		." $where_condition";
			
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
	
	function GetMailLists()
	{
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['pagelimit']==''){
			$this->Limit			= 10;
		}else{
		 $this->Limit=$_REQUEST['pagelimit'];
		}
		if(isset($_REQUEST['keyword']) && $_REQUEST['keyword']!='')
		$where_condition.=" where `Subject` like '%".addslashes(trim($_REQUEST['keyword']))."%'";
		if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition.=" order by Subject asc";
			if($_REQUEST['flag']=="2")
			$where_condition.=" order by Subject desc";
				
		}else{
			$where_condition.=" order by `Id` desc";
		}

		$SelQuery	= "select * from `tbl_mailcontent`"
		." $where_condition";
			
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
	
	
	
	function GetImageLists()
	{
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['pagelimit']==''){
			$this->Limit			= 10;
		}else{
		 $this->Limit=$_REQUEST['pagelimit'];
		}
		if(isset($_REQUEST['keyword']) && $_REQUEST['keyword']!='')
		$where_condition.=" where `Name` like '%".addslashes(trim($_REQUEST['keyword']))."%'";
		if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition.=" order by Name asc";
			if($_REQUEST['flag']=="2")
			$where_condition.=" order by Name desc";
				
		}else{
			$where_condition.=" order by `Id` desc";
		}

		$SelQuery	= "select * from `tbl_image`"
		." $where_condition";
			
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

	function manage_Image()
	{
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['pagelimit']==''){
			$this->Limit			= 10;
		}else{
		 $this->Limit=$_REQUEST['pagelimit'];
		}
		if($_REQUEST['keyword']!="")
		$where_condition.=" where `Name` like '%".addslashes(trim($_REQUEST['keyword']))."%'";

		if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition.=" order by Name asc";
			if($_REQUEST['flag']=="2")
			$where_condition.=" order by Name desc";
		}else{
			$where_condition.=" order by `ID` desc";
		}
		$SelQuery	= "select * from `tbl_image`"
		."$where_condition";
			
		if(isset($_REQUEST['keyword']) && $_REQUEST['keyword']!='')
		$_REQUEST['page']="";
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


	function add_Subject()
	{

		global $objSmarty,$objPage;
		$SelQuery	= "SELECT * from `tbl_subject`
						WHERE 
						`Subject_name`='".addslashes($_REQUEST['styleName'])."'";

		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"norows");
		if(!$ExeSelQuery)
		{
			$InsQuery	= "INSERT INTO `tbl_subject`
											    (
											      `Subject_name`,					      
											      `Status`,
											      `Create_Date`
											    )
											     VALUES 
											    (
											       '".addslashes($_REQUEST['styleName'])."',								       
											       '1',
											       now())";
			$ExeInsQuery=$this->ExecuteQuery($InsQuery,"insert");
			$objSmarty->assign("SuccessMessage","Subject has been added successfully");
		}
		else
		{
			$objSmarty->assign('Style',$_REQUEST);
			$objSmarty->assign("ErrorMessage","Subject name already exists");
		}

	}


	function add_Inhouse()
	{
//print_r($_REQUEST);
		global $objSmarty,$objPage;
		$SelQuery	= "SELECT * from `tbl_inhouse`
						WHERE 
						`Content`='".addslashes($_REQUEST['content'])."'";

		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"norows");
		if(!$ExeSelQuery)
		{
		if($_FILES['txtpic']['name'] != ""){
				$filename_new =time().$_FILES['txtpic']['name'];
				$getFormat_new = substr(strrchr($filename_new,'.'),1);
				$filename = md5($filename_new).'.'.$getFormat_new;
				$filename = strtolower($filename);
				$add="../in-house-image/$filename";
				@move_uploaded_file($_FILES['txtpic']['tmp_name'], $add);
				
				$resizeObj = new resize("../in-house-image/".$filename);
				$resizeObj -> resizeImage(235, 215, 'crop');
				$resizeObj -> saveImage("../in-house-image/medium/".$filename, 100);

				$resizeObj = new resize("../in-house-image/".$filename);
				$resizeObj -> resizeImage(320, 300, 'crop');
				$resizeObj -> saveImage("../in-house-image/large/".$filename, 100);
					
				$temp='';
			}
			$InsQuery	= "INSERT INTO `tbl_inhouse`
											    (
											      `Content`,
											      `Start_Date`,					      
											      `End_Date`,
											      `Ad_image`,
											      `Ads_URL`,					      
											      `Status`,
											      `Created_Date`
											    )
											     VALUES 
											    (
											       '".addslashes($_REQUEST['content'])."',
											       '".addslashes($_REQUEST['Start_date'])."',
											       '".addslashes($_REQUEST['End_date'])."',
											       '".$filename."',
											       '".addslashes($_REQUEST['Ads_url'])."',								       
											       '1',
											       now())";
			$ExeInsQuery=$this->ExecuteQuery($InsQuery,"insert");
			$objSmarty->assign("SuccessMessage","In-house has been added successfully");
		}
		else
		{
			$objSmarty->assign('Style',$_REQUEST);
			$objSmarty->assign("ErrorMessage","In-house already exists");
		}

	}
	
	
	
	
	function add_Image()
	{

		global $objSmarty,$objPage;
		$SelQuery	= "SELECT * from `tbl_image`
						WHERE 
						`Name`='".addslashes($_REQUEST['styleName'])."'";

		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"norows");
		if(!$ExeSelQuery)
		{
			$filename1 =time().addslashes($_FILES['company_image1']['name']);
			$add1="../frontimages/$filename1";
			@move_uploaded_file($_FILES['company_image1']['tmp_name'], $add1);
				
				
			$InsQuery	= "INSERT INTO `tbl_image`
											    (
											      `Name`,					      
											      `Image`,
											     `Status`,
											      `Create_date`
											    )
											     VALUES 
											    (
											       '".addslashes($_REQUEST['styleName'])."',
											       '".$filename1."',								       
											       '1',
											       now())";
			$ExeInsQuery=$this->ExecuteQuery($InsQuery,"insert");
			$objSmarty->assign("SuccessMessage","Image has been added successfully");
		}
		else
		{
			$objSmarty->assign('Style',$_REQUEST);
			$objSmarty->assign("ErrorMessage","Image name already exists");
		}

	}

	function selectSubjectById()
	{
		global $objSmarty;
		if($_REQUEST['Ident']!='')
		{
			$selQuery="select * from `tbl_subject` where Id='".$_REQUEST['Ident']."'";
			$result=$this->ExecuteQuery($selQuery,"select");
			$objSmarty->assign("Style",$result);
		}
		else
		{
			redirect('manage_Subject.php');
		}
	}


	function selectInhouseById()
	{
		global $objSmarty;
		if($_REQUEST['Ident']!='')
		{
			$selQuery="select * from `tbl_inhouse` where Id='".$_REQUEST['Ident']."'";
			$result=$this->ExecuteQuery($selQuery,"select");
			$objSmarty->assign("User",$result);
		}
		else
		{
			redirect('manage_inhouse.php');
		}
	}
	function selectMailById()
	{
		global $objSmarty;
		if($_REQUEST['Ident']!='')
		{
			$selQuery="select * from `tbl_mailcontent` where Id='".$_REQUEST['Ident']."'";
			$result=$this->ExecuteQuery($selQuery,"select");
			$objSmarty->assign("Style",$result);
		}
		else
		{
			redirect('manage_Subject.php');
		}
	}
	
	function selectImageById()
	{
		global $objSmarty;
		if($_REQUEST['Ident']!='')
		{
			$selQuery="select * from `tbl_image` where Id='".$_REQUEST['Ident']."'";
			$result=$this->ExecuteQuery($selQuery,"select");
			$objSmarty->assign("Style",$result);
		}
		else
		{
			redirect('manage_Image.php');
		}
	}

	function update_Subject()
	{
		global $objSmarty;
		$SelQuery	= "SELECT * from `tbl_subject`
						WHERE 
						`Subject_name`='".addslashes($_REQUEST['styleName'])."' and Id !='".$_REQUEST['Ident']."'";

		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"norows");
		if(!$ExeSelQuery)
		{
			$upQuery="update `tbl_subject` set
										`Subject_name`='".addslashes($_REQUEST['styleName'])."',
										Update_Date=now()
										where Id='".$_REQUEST['Ident']."'";
			$this->ExecuteQuery($upQuery,"update");
			$objSmarty->assign("SuccessMessage","Subject has been updated successfully");
		}
		else
		{
			$objSmarty->assign("ErrorMessage","Subject name already exists");
		}

	}

	function update_Inhouse()
	{
		global $objSmarty;
		$SelQuery	= "SELECT * from `tbl_inhouse`
						WHERE 
						`Content`='".addslashes($_REQUEST['content'])."' and Id !='".$_REQUEST['Ident']."'";

		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"norows");
		if(!$ExeSelQuery)
		{
			if($_FILES['txtpic']['name'] != ""){
				$filename_new =time().$_FILES['txtpic']['name'];
				$getFormat_new = substr(strrchr($filename_new,'.'),1);
				$filename = md5($filename_new).'.'.$getFormat_new;
				$filename = strtolower($filename);
				$add="../in-house-image/$filename";
				@move_uploaded_file($_FILES['txtpic']['tmp_name'], $add);
				
				$resizeObj = new resize("../in-house-image/".$filename);
				$resizeObj -> resizeImage(235, 215, 'crop');
				$resizeObj -> saveImage("../in-house-image/medium/".$filename, 100);

				$resizeObj = new resize("../in-house-image/".$filename);
				$resizeObj -> resizeImage(320, 300, 'crop');
				$resizeObj -> saveImage("../in-house-image/large/".$filename, 100);
					
				$imagePath = ", Ad_image = '".$filename."'";
			}
			
			$upQuery="update `tbl_inhouse` set
										`Content`='".addslashes($_REQUEST['content'])."',
										`Start_Date`='".addslashes($_REQUEST['Start_date'])."',
										`End_Date`='".addslashes($_REQUEST['End_date'])."',
										`Ads_URL`='".addslashes($_REQUEST['Ads_url'])."',
										Updated_Date=now() $imagePath
										where Id='".$_REQUEST['Ident']."'";
			$this->ExecuteQuery($upQuery,"update");
			$objSmarty->assign("SuccessMessage","In-house has been updated successfully");
		}
		else
		{
			$objSmarty->assign("ErrorMessage","In-house name already exists");
		}

	}
		function update_Mail()
	{
		global $objSmarty;
		$SelQuery	= "SELECT * from `tbl_mailcontent`
						WHERE 
						`Subject`='".addslashes($_REQUEST['styleName'])."' and Id !='".$_REQUEST['Ident']."'";

		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"norows");
		if(!$ExeSelQuery)
		{
			$upQuery="update `tbl_mailcontent` set
										`Subject`='".addslashes($_REQUEST['styleName'])."',
										`Message`='".addslashes($_REQUEST['Message'])."',
										Updated_Date=now()
										where Id='".$_REQUEST['Ident']."'";
			$this->ExecuteQuery($upQuery,"update");
			$objSmarty->assign("SuccessMessage","Subject has been updated successfully");
		}
		else
		{
			$objSmarty->assign("ErrorMessage","Subject name already exists");
		}

	}
	
	function update_Image()
	{
		global $objSmarty;
		if($_FILES['company_image1']['name']!='')
		{
			$image=time().$_FILES['company_image1']['name'];
			@move_uploaded_file($_FILES['company_image1']['tmp_name'],"../frontimages/".$image);
				
				
		 $upQuery="update `tbl_image` set
										`Name`='".addslashes($_REQUEST['styleName'])."',
										`Image` ='".addslashes($image)."',  
										Update_Date=now()
										where Id='".$_REQUEST['Ident']."'";
		 $this->ExecuteQuery($upQuery,"update");
		 $objSmarty->assign("SuccessMessage","Name has been updated successfully");
		}
		else
		{
			$upQuery="update `tbl_image` set
										`Name`='".addslashes($_REQUEST['styleName'])."',
										Update_Date=now()
										where Id='".$_REQUEST['Ident']."'";
			$this->ExecuteQuery($upQuery,"update");
			$objSmarty->assign("SuccessMessage","Name has been updated successfully");
		}

	}

	function getSubject(){
		global $objSmarty;
		$sel="select * from tbl_subject where Subject_name!='' and Status='1'";
		$ExeSelQuery= $this->ExecuteQuery($sel,"select");
		$objSmarty->assign("subject",$ExeSelQuery);

	}
	/**********************************  For Subject Mgmt  **************************************/
}
?>