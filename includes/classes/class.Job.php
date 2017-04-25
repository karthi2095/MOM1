<?php
/*	Class Function for Admin	*/

class ManageJob extends MysqlFns
{
	function ManageJob()
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

	function manage_job()
	{
		global $objSmarty,$objPage;
		$where_condition="";
	if($_REQUEST['pagelimit']==''){
				$this->Limit			= 10;
		}else{
		 $this->Limit=$_REQUEST['pagelimit'];
		}
	if((strcmp($_REQUEST['keyword'], "Name"))&&(isset($_REQUEST['keyword']))){
		
			$where_condition.=" and `Name` like '%".addslashes(trim($_REQUEST['keyword']))."%' ";
		}
	if((strcmp($_REQUEST['keyword1'], "City"))&&(isset($_REQUEST['keyword1']))){
		
			$where_condition.=" and `City` like '%".addslashes(trim($_REQUEST['keyword1']))."%' ";
		}
	if((strcmp($_REQUEST['keyword2'], "Zip"))&&(isset($_REQUEST['keyword2']))){
		
			$where_condition.=" and `Zip` like '%".addslashes(trim($_REQUEST['keyword2']))."%' ";
		}
	if((strcmp($_REQUEST['keyword3'], "Radius"))&&(isset($_REQUEST['keyword3']))){
		
			$where_condition.=" and `Radius` ='".addslashes(trim($_REQUEST['keyword3']))."' ";
		}
if($_REQUEST['rating']!=''){
		
			$where_condition.=" and `Rating` ='".addslashes(trim($_REQUEST['rating']))."' ";
		}
		
	if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition.=" order by Name asc";
			if($_REQUEST['flag']=="2")
			$where_condition.=" order by Name desc";
			if($_REQUEST['flag']=="9")
			$where_condition.=" order by City asc";
			if($_REQUEST['flag']=="10")
			$where_condition.=" order by City desc";
			if($_REQUEST['flag']=="11")
			$where_condition.=" order by Experience asc";
			if($_REQUEST['flag']=="12")
			$where_condition.=" order by Experience desc";
			
		}else{
			$where_condition.=" order by `JobID` desc";
		}
		
				 $SelQuery	= "select *  from tbl_job  where JobID!='' "
		
		//echo $SelQuery	= "select j.*,u.FirstName,u.LastName  from tbl_job j,tbl_user u where u.UserId =j.EmployerId"
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
			//print_r($Res_Tickets);
		}

		if(!empty($Res_Tickets)&& is_array($Res_Tickets))
		$objSmarty->assign("CatList",$Res_Tickets);
	}
	
	
	
function add_job()
	{
		global $objSmarty;
	if(count($_REQUEST['instrument'])!='0')
		{
			
		$instrument=implode(',',$_REQUEST['instrument']);
		
		
		}
		else{
			$instrument='';
			
		}
		
		if(count($_REQUEST['style'])!='0')
		{
			
		$style=implode(',',$_REQUEST['style']);
		
		
		}
		else{
			$style='';
			
		}
	if($_FILES['txtpic']['name'] != ""){
					$filename_new =time().$_FILES['txtpic']['name'];
				$getFormat_new = substr(strrchr($filename_new,'.'),1);
				$filename = md5($filename_new).'.'.$getFormat_new;
				$filename = strtolower($filename);
				$add="../uploads/$filename";
				@move_uploaded_file($_FILES['txtpic']['tmp_name'], $add);
				}
	/*if($_FILES['video']['name'] != ""){
				$filename_new1 =time().$_FILES['video']['name'];
				$getFormat_new1 = substr(strrchr($filename_new1,'.'),1);
				$filename1 = md5($filename_new1).'.'.$getFormat_new1;
		$filename1 = strtolower($filename1);
				$add1="../Videos/$filename1";
				@move_uploaded_file($_FILES['video']['tmp_name'], $add1);
				$VideoPath = $filename1;
			
						}
	if($_FILES['audio']['name'] != ""){
				$filename_new2 =time().$_FILES['audio']['name'];
				$getFormat_new2 = substr(strrchr($filename_new2,'.'),1);
				$filename2 = md5($filename_new2).'.'.$getFormat_new2;
		$filename2 = strtolower($filename2);
				$add2="../Audio/$filename2";
				@move_uploaded_file($_FILES['audio']['tmp_name'], $add2);
				$AudioPath = $filename2;
			
						}*/
				$exp=implode(',',$_REQUEST['experience']);
				$age=explode('-', $_REQUEST['age']);
						$fromage=$age[0];
						$toage=$age[1];
	$InsQuery	= "INSERT INTO `tbl_job`
						(
						`EmployerId` ,
							`Name` ,
							`Country` ,
							`State` ,
							`City` ,
							`Zip` ,
							`Gender` ,
							 `Age` , `FromAge` , `ToAge` ,
							  `Experience` ,
							`WillingTravel` ,
							`Radius` ,
							`Rehearse` ,
							`Pay` ,
							`Rating` ,
							`Instrument` ,`Style`,`Audio`,`Video`,`Image`,`description`,
							`StartDate`,`EndDate`,
							`Template`,
							`Status`,
							`CreatedDate`
							
						)
						VALUES 
						(
						'".addslashes($_REQUEST['employer'])."',
							'".addslashes($_REQUEST['empid'])."',
							'".addslashes($_REQUEST['country'])."',
						    '".addslashes($_REQUEST['state'])."',
						    '".addslashes($_REQUEST['city'])."',
						    '".addslashes($_REQUEST['zip'])."',
							'".addslashes($_REQUEST['gender'])."',
							'".addslashes($_REQUEST['age'])."',
							'".$fromage."','".$toage."',
							'".$exp."',
					       '".addslashes($_REQUEST['travel'])."',
						    '".addslashes($_REQUEST['radius'])."',
						  '".addslashes($_REQUEST['rehearse'])."',
						    '".addslashes($_REQUEST['job_pay'])."',
							'".addslashes($_REQUEST['rating'])."',
							'".$instrument."','".$style."',
							'".$AudioPath."','".$VideoPath."','".$filename."',
							'".addslashes($_REQUEST['desc'])."',
								'".addslashes($_REQUEST['from'])."',	'".addslashes($_REQUEST['to'])."',
							'".addslashes($_REQUEST['template'])."',
							'1',
							now()
						)";
		$ExeInsQuery=$this->ExecuteQuery($InsQuery,"insert");
		
		$objSmarty->assign("SuccessMessage", "Job has been added successfully");
		
	}
	
	function view_Job_details()
	{
		global $objSmarty;
		if($_REQUEST['Ident']!=''){
			
		/*$SelQuery	= "SELECT *,
					   date_format(InterviewFromDate,'%b %d, %Y %H:%i') as InterviewFromDate,
					   date_format(InterviewToDate,'%b %d, %Y %H:%i') as InterviewToDate,
					   DATE_FORMAT(PostedDate, '%b %d, %Y') as date 
					   from tbl_job 
					   where JobID = '".$_REQUEST['Ident']."'";*/
			$SelQuery	="select * from tbl_job  where JobID = '".$_REQUEST['Ident']."'";
			
	    $ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
	    $emp=$ExeSelQuery[0]['EmployerId'];
	    $sel="select * from tbl_user where UserID='".$emp."'";
	     $Ex= $this->ExecuteQuery($sel,"select");
	      $objSmarty->assign("user", $Ex);
	    $objSmarty->assign("Job",$ExeSelQuery);
	   
		}else{
			redirect('manage_job.php');
		}
	}
	
	

	
function update_job()
	{
		global $objSmarty;
		
		if(count($_REQUEST['instrument'])!='0')
		{
			
		$instrument=implode(',',$_REQUEST['instrument']);
		
		
		}
		else{
			$instrument='';
			
		}
		
		if(count($_REQUEST['style'])!='0')
		{
			
		$style=implode(',',$_REQUEST['style']);
		
		
		}
		else{
			$style='';
			
		}
		
	if($_FILES['video']['name'] != ""){
				$filename_new1 =time().$_FILES['video']['name'];
				$getFormat_new1 = substr(strrchr($filename_new1,'.'),1);
				$filename1 = md5($filename_new1).'.'.$getFormat_new1;
		$filename1 = strtolower($filename1);
				$add1="../Videos/$filename1";
				@move_uploaded_file($_FILES['video']['tmp_name'], $add1);
			$VideoPath = ", Video = '".$filename1."'";
						}
	if($_FILES['audio']['name'] != ""){
				$filename_new2 =time().$_FILES['audio']['name'];
				$getFormat_new2 = substr(strrchr($filename_new2,'.'),1);
				$filename2 = md5($filename_new2).'.'.$getFormat_new2;
		$filename2 = strtolower($filename2);
				$add2="../Audio/$filename2";
				@move_uploaded_file($_FILES['audio']['tmp_name'], $add2);

				$AudioPath = ", Audio = '".$filename2."'";
						}
	if($_FILES['txtpic']['name'] != ""){
				$filename_new =time().$_FILES['txtpic']['name'];
				$getFormat_new = substr(strrchr($filename_new,'.'),1);
				$filename = md5($filename_new).'.'.$getFormat_new;
				$filename = strtolower($filename);
				$add="../uploads/$filename";
				@move_uploaded_file($_FILES['txtpic']['tmp_name'], $add);
				$imagePath = ", Image = '".$filename."'";
			}
			$exp=implode(',',$_REQUEST['experience']);
		$age=explode('-', $_REQUEST['age']);
						$fromage=$age[0];
						$toage=$age[1];
	$SelQuery	= "UPDATE `tbl_job` SET
		`EmployerId` = '".addslashes($_REQUEST['employer'])."',
					`Name` = '".addslashes($_REQUEST['empid'])."',
					`Country` ='".addslashes($_REQUEST['country'])."',
					`State` ='".addslashes($_REQUEST['state'])."',
					`City` ='".addslashes($_REQUEST['city'])."',
					`Zip` ='".addslashes($_REQUEST['zip'])."',
					`Gender` ='".addslashes($_REQUEST['gender'])."',
					`Age` ='".addslashes($_REQUEST['age'])."',
						`FromAge` ='".$fromage."',	`ToAge` ='".$toage."',
					`Experience` ='".$exp."',
					`WillingTravel` ='".addslashes($_REQUEST['travel'])."',
					`Radius` ='".addslashes($_REQUEST['radius'])."',
					`Rehearse` ='".addslashes($_REQUEST['rehearse'])."',
					`Pay` ='".addslashes($_REQUEST['job_pay'])."',
					`description` ='".addslashes($_REQUEST['desc'])."',
						`StartDate` ='".addslashes($_REQUEST['from'])."',
							`EndDate` ='".addslashes($_REQUEST['to'])."',
					`Template` ='".addslashes($_REQUEST['template'])."',
					`Instrument` ='".$instrument."',
					`Style` ='".$style."',
					`Rating` ='".addslashes($_REQUEST['rating'])."' $imagePath 
					 WHERE `JobID`='".$_REQUEST['Ident']."'";
					$this->ExecuteQuery($SelQuery,"update");

					$objSmarty->assign("SuccessMessage","Job has been updated successfully");
					
	}  
function AddJob()
	{
		global $objSmarty;
	if(count($_REQUEST['instrument'])!='0')
		{
			
		$instrument=implode(',',$_REQUEST['instrument']);
		
		}
		else{
			$instrument='';
			
		}
		
		if(count($_REQUEST['style'])!='0')
		{
			
		$style=implode(',',$_REQUEST['style']);
		
		}
		else{
			$style='';
			
		}
	
				if(count($_REQUEST['specialty'])!='0')
		{
			
		$specialty=implode(',',$_REQUEST['specialty']);
		
		
		}
		else{
			$specialty='';
			
		}
		if($_FILES['txtpic']['name'] != ""){
					$filename_new =time().$_FILES['txtpic']['name'];
				$getFormat_new = substr(strrchr($filename_new,'.'),1);
				$filename = md5($filename_new).'.'.$getFormat_new;
				$filename = strtolower($filename);
				$add="uploads/$filename";
				@move_uploaded_file($_FILES['txtpic']['tmp_name'], $add);
				}
	/*if($_FILES['video']['name'] != ""){
				$filename_new1 =time().$_FILES['video']['name'];
				$getFormat_new1 = substr(strrchr($filename_new1,'.'),1);
				$filename1 = md5($filename_new1).'.'.$getFormat_new1;
		$filename1 = strtolower($filename1);
				$add1="Videos/$filename1";
				@move_uploaded_file($_FILES['video']['tmp_name'], $add1);
				$VideoPath = $filename1;
			
						}
	if($_FILES['audio']['name'] != ""){
				$filename_new2 =time().$_FILES['audio']['name'];
				$getFormat_new2 = substr(strrchr($filename_new2,'.'),1);
				$filename2 = md5($filename_new2).'.'.$getFormat_new2;
		$filename2 = strtolower($filename2);
				$add2="Audio/$filename2";
				@move_uploaded_file($_FILES['audio']['tmp_name'], $add2);
				$AudioPath = $filename2;
			
						}*/
						$name=$_SESSION['FirstName'].' '.$_SESSION['LastName'];
						$exp=implode(',',$_REQUEST['experience']);
						$age=implode(',',$_REQUEST['age']);
						//print_r($_REQUEST['age']);
						///echo $age;exit;
						//$age=explode('-', $_REQUEST['age']);
						//$fromage=$age[0];
						//$toage=$age[1];
	/*$InsQuery	= "INSERT INTO `tbl_job`
						(
						`EmployerId` ,
							`Name` ,
							`Country` ,
							`State` ,
							`City` ,
							`Zip` ,
							`Gender` ,
							 `Age` , `FromAge` , `ToAge` ,
							  `Experience` ,
							`WillingTravel` ,
							`Radius` ,
							`Rehearse` ,
							`Pay` ,
							`Rating` ,
							`Instrument` ,`Style`,`Specialty`,`Image`,`description`,`Template`,
							`StartDate`,`EndDate`,
							`Status`,
							`CreatedDate`
							
						)
						VALUES 
						(
						'".addslashes($_SESSION['UserId'])."',
							'".$name."',
							'".addslashes($_REQUEST['country'])."',
						    '".addslashes($_REQUEST['state'])."',
						    '".addslashes($_REQUEST['city'])."',
						    '".addslashes($_REQUEST['zip'])."',
							'".addslashes($_REQUEST['gender'])."',
							'".addslashes($_REQUEST['age'])."','".$fromage."','".$toage."',
							'".$exp."',
					       '".addslashes($_REQUEST['travel'])."',
						    '".addslashes($_REQUEST['radius'])."',
						  '".addslashes($_REQUEST['rehearse'])."',
						    '".addslashes($_REQUEST['job_pay'])."',
							'".addslashes($_REQUEST['rating'])."',
							'".$instrument."','".$style."','".$specialty."',
						 '".$filename."',
						  '".addslashes($_REQUEST['desc'])."',
						   '".addslashes($_REQUEST['template'])."',
						    '".addslashes($_REQUEST['from'])."',
						     '".addslashes($_REQUEST['to'])."',
							'1',
							now()
						)";*/
	$InsQuery	= "INSERT INTO `tbl_job`
						(
						`EmployerId` ,
							`Name` ,
							`Country` ,
							`State` ,
							`City` ,
							`Zip` ,
							`Gender` ,
							 `Age_new` ,
							  `Experience` ,
							`WillingTravel` ,
							`Radius` ,
							`Rehearse` ,
							`Pay` ,
							`Rating` ,
							`Instrument` ,`Style`,`Specialty`,`Image`,`description`,`Template`,
							`StartDate`,`EndDate`,
							`Status`,
							`CreatedDate`
							
						)
						VALUES 
						(
						'".addslashes($_SESSION['UserId'])."',
							'".$name."',
							'".addslashes($_REQUEST['country'])."',
						    '".addslashes($_REQUEST['state'])."',
						    '".addslashes($_REQUEST['city'])."',
						    '".addslashes($_REQUEST['zip'])."',
							'".addslashes($_REQUEST['gender'])."',
							'".$age."',
							'".$exp."',
					       '".addslashes($_REQUEST['travel'])."',
						    '".addslashes($_REQUEST['radius'])."',
						  '".addslashes($_REQUEST['rehearse'])."',
						    '".addslashes($_REQUEST['job_pay'])."',
							'".addslashes($_REQUEST['rating'])."',
							'".$instrument."','".$style."','".$specialty."',
						 '".$filename."',
						  '".addslashes($_REQUEST['desc'])."',
						   '".addslashes($_REQUEST['template'])."',
						    '".addslashes($_REQUEST['from'])."',
						     '".addslashes($_REQUEST['to'])."',
							'1',
							now()
						)";
		$ExeInsQuery=$this->ExecuteQuery($InsQuery,"insert");
	    $id=mysql_insert_id();
			if(count($_REQUEST['specialty'])!='0')
		{
			for($i=0;$i<count($_REQUEST['specialty']);$i++){
				$sid=$_REQUEST['specialty'][$i];
			 $sname=$_REQUEST['spe_'.$sid];
				$InsQ	= "INSERT INTO `tbl_jobspecality`
						   (
							 `JobId`, `CatId`,`SubName`
							 ) 
							VALUES
							(
						'".$id."',	'".addslashes($_REQUEST['specialty'][$i])."','".$sname."'
							
							)  ";
					$ExeInsQuer=$this->ExecuteQuery($InsQ,"insert");
			}
		}
		$objSmarty->assign("SuccessMessage", "Job has been added successfully");
		
	}
	
function getjoblist($id)
	{
		global $objSmarty;
		$sql="select * from tbl_job where EmployerId='$id'";
		$ExeInsQuery=$this->ExecuteQuery($sql,"select");
		$objSmarty->assign("joblist", $ExeInsQuery);
	}
	
function getapplylist($id)
	{
		global $objSmarty;
		$sql="select * from  tbl_jobapplications where Employer_ID='$id'";
		$ExeInsQuery=$this->ExecuteQuery($sql,"select");
		$objSmarty->assign("applylist", $ExeInsQuery);
	}
function Job_isViewed($id)
	{
		global $objSmarty;
		$SelQuery	= "SELECT * from `tbl_jobapplications`"
		              ." WHERE `Id`='".$id."' and IsReviewed='0'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"norows");
		if($ExeSelQuery){
		
		
			$InsQuery	= "Update `tbl_jobapplications` SET 
			                    `IsReviewed`='1'
							  where Id='".$id."' "; 
						
									 
			$ExeInsQuery=$this->ExecuteQuery($InsQuery,"update");
		
		}
		
	}
function getappliedJob($Jid, $empId)
	{
		global $objSmarty;
		$sql="select * from  tbl_jobapplications where Employer_ID='$empId' and Job_ID='$Jid'
		 and Applicant_Id='".$_SESSION['UserId']."'";
		$ExeInsQuery=$this->ExecuteQuery($sql,"select");
		if($ExeInsQuery){
			$yes = '1';
		}
		$objSmarty->assign("applylist", $ExeInsQuery);
		$objSmarty->assign("yes", $yes);
	}
function Job_Update($id)
	{
		global $objSmarty;
		$SelQuery	= "SELECT * from `tbl_jobapplications`"
		              ." WHERE `Employer_ID`='".$id."' and IsReviewed='0'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"norows");
		if($ExeSelQuery){
		
		
			$InsQuery	= "Update `tbl_jobapplications` SET 
			                    `IsReviewed`='1'
							  where Employer_ID ='".$id."' "; 
						
									 
			$ExeInsQuery=$this->ExecuteQuery($InsQuery,"update");
		
		}
		
	}	
	
function view_Job()
	{
		global $objSmarty;
		
		$SelQuery	="select * from tbl_job  where JobID = '".$_REQUEST['Ident']."'";
	    $ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
	    $start=$ExeSelQuery[0]['StartDate'];
	    $end=$ExeSelQuery[0]['EndDate'];
	    //$StartDate= strtotime($start);
	    $StartDate=date('m/d/Y' ,strtotime($start));
	    //$EndDate= strtotime($end);
	    $EndDate=date('m/d/Y' ,strtotime($end));
	    $objSmarty->assign("Job",$ExeSelQuery);
	    $objSmarty->assign("StartDate",$StartDate);
	    $objSmarty->assign("EndDate",$EndDate);
	   
	}
function view_applicants()
	{
		global $objSmarty;
		
	    $SelQuery	="select * from tbl_user  where UserId = '".$_REQUEST['Ident']."'";
	    $ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
	    $objSmarty->assign("Applicants",$ExeSelQuery);
	   
	}
function UpdateJob()
	{
		global $objSmarty;
		
		if(count($_REQUEST['instrument'])!='0')
		{
			
		$instrument=implode(',',$_REQUEST['instrument']);
		
		}
		else{
			$instrument='';
			
		}
		
		if(count($_REQUEST['style'])!='0')
		{
			
		$style=implode(',',$_REQUEST['style']);
		
		}
		else{
			$style='';
		}
	if(count($_REQUEST['specialty'])!='0')
		{
			
		$specialty=implode(',',$_REQUEST['specialty']);
		
		}
		else{
			$specialty='';
		
		}
		
	if($_FILES['video']['name'] != ""){
				$filename_new1 =time().$_FILES['video']['name'];
				$getFormat_new1 = substr(strrchr($filename_new1,'.'),1);
				$filename1 = md5($filename_new1).'.'.$getFormat_new1;
		$filename1 = strtolower($filename1);
				$add1="Videos/$filename1";
				@move_uploaded_file($_FILES['video']['tmp_name'], $add1);
			$VideoPath = ", Video = '".$filename1."'";
						}
	if($_FILES['audio']['name'] != ""){
				$filename_new2 =time().$_FILES['audio']['name'];
				$getFormat_new2 = substr(strrchr($filename_new2,'.'),1);
				$filename2 = md5($filename_new2).'.'.$getFormat_new2;
		$filename2 = strtolower($filename2);
				$add2="Audio/$filename2";
				@move_uploaded_file($_FILES['audio']['tmp_name'], $add2);

				$AudioPath = ", Audio = '".$filename2."'";
						}
	if($_FILES['txtpic']['name'] != ""){
				$filename_new =time().$_FILES['txtpic']['name'];
				$getFormat_new = substr(strrchr($filename_new,'.'),1);
				$filename = md5($filename_new).'.'.$getFormat_new;
				$filename = strtolower($filename);
				$add="uploads/$filename";
				@move_uploaded_file($_FILES['txtpic']['tmp_name'], $add);
				$imagePath = ", Image = '".$filename."'";
			}
		$exp=implode(',',$_REQUEST['experience']);
		$age=implode(',',$_REQUEST['age']);
						/*$fromage=$age[0];
						$toage=$age[1];*/
	/*$SelQuery	= "UPDATE `tbl_job` SET
					`Country` ='".addslashes($_REQUEST['country'])."',
					`State` ='".addslashes($_REQUEST['state'])."',
					`City` ='".addslashes($_REQUEST['city'])."',
					`Zip` ='".addslashes($_REQUEST['zip'])."',
					`Gender` ='".addslashes($_REQUEST['gender'])."',
					`Age` ='".addslashes($_REQUEST['age'])."',
					`FromAge` ='".$fromage."',
					`ToAge` ='".$toage."',
					`Experience` ='".$exp."',
					`WillingTravel` ='".addslashes($_REQUEST['travel'])."',
					`Radius` ='".addslashes($_REQUEST['radius'])."',
					`Rehearse` ='".addslashes($_REQUEST['rehearse'])."',
					`Pay` ='".addslashes($_REQUEST['job_pay'])."',
					`description` ='".addslashes($_REQUEST['desc'])."',
					`Template` ='".addslashes($_REQUEST['template'])."',
					`Instrument` ='".$instrument."',
					`StartDate` ='".addslashes($_REQUEST['from'])."',
					`EndDate` ='".addslashes($_REQUEST['to'])."',
					`Style` ='".$style."',
					`Specialty`='".$specialty."',
					`Rating` ='".addslashes($_REQUEST['rating'])."' $imagePath
					 WHERE `JobID`='".$_REQUEST['Ident']."' and EmployerId='".$_SESSION['UserId']."'";*/
	$SelQuery	= "UPDATE `tbl_job` SET
					`Country` ='".addslashes($_REQUEST['country'])."',
					`State` ='".addslashes($_REQUEST['state'])."',
					`City` ='".addslashes($_REQUEST['city'])."',
					`Zip` ='".addslashes($_REQUEST['zip'])."',
					`Gender` ='".addslashes($_REQUEST['gender'])."',
					`Age_new` ='".$age."',
					`Experience` ='".$exp."',
					`WillingTravel` ='".addslashes($_REQUEST['travel'])."',
					`Radius` ='".addslashes($_REQUEST['radius'])."',
					`Rehearse` ='".addslashes($_REQUEST['rehearse'])."',
					`Pay` ='".addslashes($_REQUEST['job_pay'])."',
					`description` ='".addslashes($_REQUEST['desc'])."',
					`Template` ='".addslashes($_REQUEST['template'])."',
					`Instrument` ='".$instrument."',
					`StartDate` ='".addslashes($_REQUEST['from'])."',
					`EndDate` ='".addslashes($_REQUEST['to'])."',
					`Style` ='".$style."',
					`Specialty`='".$specialty."',
					`Rating` ='".addslashes($_REQUEST['rating'])."' $imagePath
					 WHERE `JobID`='".$_REQUEST['Ident']."' and EmployerId='".$_SESSION['UserId']."'";	
					$this->ExecuteQuery($SelQuery,"update");
	if(count($_REQUEST['specialty'])!='0')
		{
			$del="delete  from `tbl_jobspecality` where JobId='".$_REQUEST['Ident']."'";
			$ExeInsQue=$this->ExecuteQuery($del,"delete");
			for($i=0;$i<count($_REQUEST['specialty']);$i++){
				$sid=$_REQUEST['specialty'][$i];
			 $sname=$_REQUEST['spe_'.$sid];
				$InsQ	= "INSERT INTO `tbl_jobspecality`
						   (
							 `JobId`, `CatId`,`SubName`
							 ) 
							VALUES
							(
						'".$_REQUEST['Ident']."',	'".addslashes($_REQUEST['specialty'][$i])."','".$sname."'
							
							)  ";
					$ExeInsQuer=$this->ExecuteQuery($InsQ,"insert");
			}
		}
					$objSmarty->assign("SuccessMessage","Job has been updated successfully");
					
	}  
	
function Messages()
	{
		global $objSmarty;
		$sql="select u.FirstName,t.* from tbl_text t,tbl_user u  where t.ToId='".$_SESSION['UserId']."' and t.UserId=u.UserId ";
		$ExeInsQuery=$this->ExecuteQuery($sql,"select");
		$objSmarty->assign("messages", $ExeInsQuery);
	}
function SentMessages()
	{
		global $objSmarty;
		$sql="select u.FirstName,t.* from tbl_text t,tbl_user u  where t.UserId='".$_SESSION['UserId']."' and t.ToId=u.UserId ";
		$ExeInsQuery=$this->ExecuteQuery($sql,"select");
		$objSmarty->assign("sentmessages", $ExeInsQuery);
	}
function View_message()
	{
		global $objSmarty;
		$sql="select * from tbl_text  where Id='".$_REQUEST['id']."' ";
		$ExeInsQuery=$this->ExecuteQuery($sql,"select");
		$objSmarty->assign("viewmsg", $ExeInsQuery);
	}
	
function AllReviews()
	{
		global $objSmarty;
		 $sql="select u.FirstName,u.Image,u.Gender,t.*,DATE_FORMAT(t.CreatedDate ,'%b %d %Y %h:%i %p') as date from tbl_review t,tbl_user u 
		  where t.ToID='".$_REQUEST['id']."' and t.UserID=u.UserId and t.Status='1'
		  ORDER BY t.OrderBy ASC";
		$ExeInsQuery=$this->ExecuteQuery($sql,"select");
		$objSmarty->assign("Reviews", $ExeInsQuery);
	}
	
	
function manage_video()
	{
		global $objSmarty,$objPage;
		$where_condition="";
	if($_REQUEST['pagelimit']==''){
				$this->Limit			= 10;
		}else{
		 $this->Limit=$_REQUEST['pagelimit'];
		}
	if((strcmp($_REQUEST['keyword'], "Title"))&&(isset($_REQUEST['keyword']))){
		
			$where_condition.=" and `Title` like '%".addslashes(trim($_REQUEST['keyword']))."%' ";
		}
	
		 $SelQuery	= "select *  from  tbl_video  where ID!='' "
		."$where_condition". "order by `ID` desc";
		//if(isset($_REQUEST['keyword']) && $_REQUEST['keyword']!='')
		//$_REQUEST['page']="";
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
			//print_r($Res_Tickets);
		}

		if(!empty($Res_Tickets)&& is_array($Res_Tickets))
		$objSmarty->assign("CatList",$Res_Tickets);
	}
	
	
function manage_photos()
	{
		global $objSmarty,$objPage;
		$where_condition="";
	if($_REQUEST['pagelimit']==''){
				$this->Limit			= 10;
		}else{
		 $this->Limit=$_REQUEST['pagelimit'];
		}
	if((isset($_REQUEST['keyword']))){
		
			$where_condition.=" and c.UserType like '%".addslashes(trim($_REQUEST['keyword']))."%' or d.FirstName like '%".addslashes(trim($_REQUEST['keyword']))."%' ";
		}
	
		   $SelQuery	= "select c.*  from   tbl_photos c join tbl_user d  on c.UserID=d.UserId where c.ID!='' "
		."$where_condition". "order by c.ID desc";
		//if(isset($_REQUEST['keyword']) && $_REQUEST['keyword']!='')
		//$_REQUEST['page']="";
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
			//print_r($Res_Tickets);
		}

		if(!empty($Res_Tickets)&& is_array($Res_Tickets))
		$objSmarty->assign("CatList",$Res_Tickets);
	}
	
function manage_homevideo()
	{
	
			global $objSmarty,$objPage;
		$where_condition="";
	if($_REQUEST['pagelimit']==''){
				$this->Limit			= 10;
		}else{
		 $this->Limit=$_REQUEST['pagelimit'];
		}
	if((strcmp($_REQUEST['keyword'], "Title"))&&(isset($_REQUEST['keyword']))){
		
			$where_condition.=" and `Title` like '%".addslashes(trim($_REQUEST['keyword']))."%' ";
		}
	
		 $SelQuery	= "select *  from  tbl_homepagevideo  where ID!='' "
		."$where_condition". "order by `ID` desc";
		//if(isset($_REQUEST['keyword']) && $_REQUEST['keyword']!='')
		//$_REQUEST['page']="";
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
			//print_r($Res_Tickets);
		}

		if(!empty($Res_Tickets)&& is_array($Res_Tickets))
		$objSmarty->assign("homeCatList",$Res_Tickets);
	}

	
function add_video()
	{
		global $objSmarty;
		$SelQuery	= "SELECT * from `tbl_video`"
		              ." WHERE `Title`='".addslashes($_REQUEST['title'])."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"norows");
		if(!$ExeSelQuery){
		
		
			$InsQuery	= "INSERT INTO `tbl_video`
						   (
							 `UserID`,
							 `Title`,
							 `YoutubeUrl`,
							 `Display`,
							 `Status`,
							 `CreatedDate`
							) 
							VALUES
							(
							'".addslashes($_REQUEST['employer'])."',
							'".addslashes($_REQUEST['title'])."',
								'".addslashes($_REQUEST['youtube'])."',
								'".addslashes($_REQUEST['display'])."',
									'1',
								now()
							)  "; 
									 
			$ExeInsQuery=$this->ExecuteQuery($InsQuery,"insert");
			$objSmarty->assign("SuccessMessage","Video has been added successfully");
		
			$objSmarty->assign("",$_REQUEST);
		}
		else
		{
			$objSmarty->assign("ErrorMessage","Title already exists");
			$objSmarty->assign("vid",$_REQUEST);
		}
	}
    function add_homevideo()
	{
		global $objSmarty;
		$SelQuery	= "SELECT * from `tbl_homepagevideo`"
		              ." WHERE `Title`='".addslashes($_REQUEST['title'])."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"norows");
		if(!$ExeSelQuery){
		
		
			$InsQuery	= "INSERT INTO `tbl_homepagevideo`
						   (
							 `Title`,
							 `YoutubeUrl`,
							 `Status`,
							 `CreatedDate`
							) 
							VALUES
							(
							
							'".addslashes($_REQUEST['title'])."',
								'".addslashes($_REQUEST['youtube'])."',
							'1',
								now()
							)  "; 
									 
			$ExeInsQuery=$this->ExecuteQuery($InsQuery,"insert");
			$objSmarty->assign("SuccessMessage","Homepage Video has been added successfully");
		
			$objSmarty->assign("",$_REQUEST);
		}
		else
		{
			$objSmarty->assign("ErrorMessage","Title already exists");
			$objSmarty->assign("hvid",$_REQUEST);
		}
	}
function view_video()
	{
		global $objSmarty;
		if($_REQUEST['Ident']!=''){
			$SelQuery	="select * from tbl_video  where ID = '".$_REQUEST['Ident']."'";
			
	    $ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
	    $emp=$ExeSelQuery[0]['UserID'];
	    $sel="select * from tbl_user where UserID='".$emp."'";
	     $Ex= $this->ExecuteQuery($sel,"select");
	      $objSmarty->assign("user", $Ex);
	    $objSmarty->assign("Video",$ExeSelQuery);
	   
		}else{
			redirect('manage_video.php');
		}
	}
	
function view_photos()
	{
		global $objSmarty;
		if($_REQUEST['Ident']!=''){
			$SelQuery	="select * from tbl_photos  where ID = '".$_REQUEST['Ident']."'";
			
	    $ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
	    $emp=$ExeSelQuery[0]['UserID'];
	    $sel="select * from tbl_user where UserID='".$emp."'";
	     $Ex= $this->ExecuteQuery($sel,"select");
	      $objSmarty->assign("user", $Ex);
	    $objSmarty->assign("photo",$ExeSelQuery);
	   
		}else{
			redirect('manage_photos.php');
		}
	}
	
function view_homevideo()
	{
		global $objSmarty;
		if($_REQUEST['Ident']!=''){
			$SelQuery	="select * from tbl_homepagevideo  where ID = '".$_REQUEST['Ident']."'";
			
	    $ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
	   /* $emp=$ExeSelQuery[0]['UserID'];
	    $sel="select * from tbl_user where UserID='".$emp."'";
	     $Ex= $this->ExecuteQuery($sel,"select");
	      $objSmarty->assign("user", $Ex);*/
	    $objSmarty->assign("homeVideo",$ExeSelQuery);
	   
		}else{
			redirect('manage_homevideo.php');
		}
	}
function edit_video()
	{
		global $objSmarty;
		$SelQuery	= "SELECT * from `tbl_video`"
		              ." WHERE `Title`='".addslashes($_REQUEST['title'])."' and ID!='".$_REQUEST['Ident']."' ";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"norows");
		if(!$ExeSelQuery){
		
		
			$InsQuery	= "Update `tbl_video` SET 
			                  `UserID`='".addslashes($_REQUEST['employer'])."',
							 `Title`='".addslashes($_REQUEST['title'])."',
							 `YoutubeUrl`='".addslashes($_REQUEST['youtube'])."',
							 `Display`=	'".addslashes($_REQUEST['display'])."'  where ID='".$_REQUEST['Ident']."' "; 
						
									 
			$ExeInsQuery=$this->ExecuteQuery($InsQuery,"update");
			$objSmarty->assign("SuccessMessage","Video has been updated successfully");
		
		}
		else
		{
			$objSmarty->assign("ErrorMessage","Title already exists");
			
		}
	}
	
function edit_photos()
	{
		global $objSmarty,$objPage;
	if($_FILES['img']['name']!=''){
      $errors= array();
      $file_name = time().$_FILES['img']['name'];
      $file_size = $_FILES['img']['size'];
      $file_tmp = $_FILES['img']['tmp_name'];
      $file_type = $_FILES['img']['type'];
     // $file_ext=strtolower(end(explode('.',$_FILES['img']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
        // $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152) {
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true) {
         move_uploaded_file($file_tmp,"../uploads/".$file_name);
         
         $resizeObj = new resize("../uploads/".$file_name);
		$resizeObj -> resizeImage(200, 200, 'crop');
		$resizeObj -> saveImage("../uploads/medium/".$file_name, 100);
	
		$resizeObj = new resize("../uploads/".$file_name);
		$resizeObj -> resizeImage(300, 300, 'crop');
		$resizeObj -> saveImage("../uploads/large/".$file_name, 100);
	
		$resizeObj = new resize("../uploads/".$file_name);
		$resizeObj -> resizeImage(60, 60, 'crop');
		$resizeObj -> saveImage("../uploads/x_small/".$file_name, 100);
      }else{
         print_r($errors);
      }
      $updateQry = "update tbl_photos set `Image`='".addslashes($file_name)."' where ID='".$_REQUEST['Ident']."'";
      mysql_query($updateQry);
   }
     
		
		
			
			$objSmarty->assign("SuccessMessage","photo has been updated successfully");
		
	
		
	}	
	
	
	

function edit_homevideo()
	{
		global $objSmarty;
		$SelQuery	= "SELECT * from `tbl_homepagevideo`"
		              ." WHERE `Title`='".addslashes($_REQUEST['title'])."' and ID!='".$_REQUEST['Ident']."' ";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"norows");
		if(!$ExeSelQuery){
		
		
			$InsQuery	= "Update `tbl_homepagevideo` SET 
			                   
							 `Title`='".addslashes($_REQUEST['title'])."',
							 `YoutubeUrl`='".addslashes($_REQUEST['youtube'])."'
							 where ID='".$_REQUEST['Ident']."' "; 
						
									 
			$ExeInsQuery=$this->ExecuteQuery($InsQuery,"update");
			$objSmarty->assign("SuccessMessage","Homepage video has been updated successfully");
		
		}
		else
		{
			$objSmarty->assign("ErrorMessage","Title already exists");
			
		}
	}
function manage_audio()
	{
		global $objSmarty,$objPage;
		$where_condition="";
	if($_REQUEST['pagelimit']==''){
				$this->Limit			= 10;
		}else{
		 $this->Limit=$_REQUEST['pagelimit'];
		}
	if((strcmp($_REQUEST['keyword'], "Title"))&&(isset($_REQUEST['keyword']))){
		
			$where_condition.=" and `Title` like '%".addslashes(trim($_REQUEST['keyword']))."%' ";
		}
		 $SelQuery	= "select *  from  tbl_music  where ID!='' "
		."$where_condition". "order by `ID` desc";
		//if(isset($_REQUEST['keyword']) && $_REQUEST['keyword']!='')
		//$_REQUEST['page']="";
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
			//print_r($Res_Tickets);
		}

		if(!empty($Res_Tickets)&& is_array($Res_Tickets))
		$objSmarty->assign("CatList",$Res_Tickets);
	}
function add_audio()
	{
		global $objSmarty;
		$SelQuery	= "SELECT * from `tbl_music`"
		              ." WHERE `Title`='".addslashes($_REQUEST['title'])."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"norows");
		if(!$ExeSelQuery){
		
		if($_FILES['audio']['name'] != ""){
				$filename_new2 =time().$_FILES['audio']['name'];
				$getFormat_new2 = substr(strrchr($filename_new2,'.'),1);
				$filename2 = md5($filename_new2).'.'.$getFormat_new2;
		$filename2 = strtolower($filename2);
				$add2="../Audio/$filename2";
				@move_uploaded_file($_FILES['audio']['tmp_name'], $add2);
				$AudioPath = $filename2;
		//echo	$_FILES["audio"]["type"];
 $size= $_FILES["audio"]["size"];
						}
					
			$InsQuery	= "INSERT INTO `tbl_music`
						   (
							 `UserID`,`Audio`,`Type`,`Size`,
							 `Title`, `TrackNo`, `Year`,
							`Album`,`Genre`, `Comments`, `Listen`,
							 `Download`,
							 `Status`,
							 `CreatedDate`
							) 
							VALUES
							(
							'".addslashes($_REQUEST['employer'])."',
							'".$AudioPath."','".$getFormat_new2."','".$size."',
							'".addslashes($_REQUEST['title'])."',
							'".addslashes($_REQUEST['track'])."',
							'".addslashes($_REQUEST['year'])."',
							'".addslashes($_REQUEST['album'])."',
							'".addslashes($_REQUEST['genre'])."',
							'".addslashes($_REQUEST['comments'])."',
							'".addslashes($_REQUEST['listen'])."',
							'".addslashes($_REQUEST['download'])."',
									'1',
								now()
							)  "; 
									 
			$ExeInsQuery=$this->ExecuteQuery($InsQuery,"insert");
			$objSmarty->assign("SuccessMessage","Audio has been added successfully");
		
			$objSmarty->assign("",$_REQUEST);
		}
		else
		{
			$objSmarty->assign("ErrorMessage","Title already exists");
			$objSmarty->assign("vid",$_REQUEST);
		}
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////	
}