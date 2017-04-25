<?php
/*	Class Function for Admin	*/

class ManageUser extends MysqlFns
{
	function ManageUser()
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

function update_user()
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
      }else{
         print_r($errors);
      }
      $updateQry = "update tbl_user set `Image`='".addslashes($file_name)."' where UserId='".$_REQUEST['Ident']."'";
      mysql_query($updateQry);
   }
     
	
 $UPQuery	= "Update `tbl_user` set
						`FirstName`='".addslashes($_REQUEST['fname'])."',
						`LastName`='".addslashes($_REQUEST['lname'])."',
						`Email`='".addslashes($_REQUEST['email'])."',
						`Gender`='".addslashes($_REQUEST['gender'])."',
						`DOB`='".addslashes($_REQUEST['dob'])."',
						`Mobile`='".addslashes($_REQUEST['phoneNo'])."',
						`Country`='".addslashes($_REQUEST['country'])."',
						`State`='".addslashes($_REQUEST['state'])."',
						`City`='".addslashes($_REQUEST['city'])."',
						`Image`='".addslashes($_REQUEST['img'])."',
						`Company`='".addslashes($_REQUEST['company'])."',
						`Description`='".addslashes($_REQUEST['desc'])."',
						`Influences`='".addslashes($_REQUEST['influences'])."'
						 where UserId='".$_REQUEST['Ident']."'";
			$ExeInsQuery=$this->ExecuteQuery($UPQuery,"update");
			$objSmarty->assign("SuccessMessage","User has been updated successfully");
	}

	function Set_Status($tablename,$id,$word)
	{
		global $objSmarty;
		$UpQuery="UPDATE ".$tablename." SET `Status`='".$_REQUEST['setStatus']."'"
		. " WHERE $id='".$_REQUEST['Ident']."'";
		$ExeUpQuery= $this->ExecuteQuery($UpQuery,"update");
		if($_REQUEST['setStatus']=='0'){
			$objSmarty->assign("SuccessMessage","$word has been deactivated successfully");
		}else{
			$objSmarty->assign("SuccessMessage","$word has been activated successfully");
		}
	}

	function Set_StatusMail($tablename,$id,$word)
	{
		global $objSmarty;
		$UpQuery="UPDATE ".$tablename." SET `MailStatus`='".$_REQUEST['setMStatus']."'"
		. " WHERE $id='".$_REQUEST['Ident']."'";
		$ExeUpQuery= $this->ExecuteQuery($UpQuery,"update");
		if($_REQUEST['setMStatus']=='0'){
			$objSmarty->assign("SuccessMessage","Email status has been deactivated successfully");
		}else{
			$objSmarty->assign("SuccessMessage","Email status has been activated successfully");
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
     
	function resendmail()
	{
		global $objSmarty;
		$sel="select * from tbl_user where UserId='".$_REQUEST['Ident']."'";
		$exesel=$this->ExecuteQuery($sel, "select");
		$email=$exesel[0]['Email'];
		$fname=$exesel[0]['FirstName'];
		$lname=$exesel[0]['LastName'];
		$pword=$exesel[0]['Password'];
		$Ran=$this->Sentlogindetail($email,$fname,$lname,$_REQUEST['Ident'],$pword);
		$objSmarty->assign("SuccessMessage","Mail has been sent successfully");
		
	}

	function Delete_Record($tablename,$id,$word)
	{
		global $objSmarty;
		$UpQuery="DELETE FROM $tablename"
		. " WHERE $id = '".$_REQUEST['hdIdent']."'";
		$ExeUpQuery= $this->ExecuteQuery($UpQuery,"delete");
		$objSmarty->assign("SuccessMessage","$word has been deleted successfully");
	}


	//contact us page mail submission
	function sendcontactmail()
	{
		global $objSmarty,$config;
		/************************ BY SM  ****************************/
		//$sub=$_REQUEST['subject'];

		$selQuery="select * from `tbl_subject` where Id='".$_REQUEST['subject']."'";
		$result=$this->ExecuteQuery($selQuery,"select");
		$sub=$result[0]['Subject_name'];
		//$objSmarty->assign("Style",$result);
			
		/************************ BY SM  ****************************/
		$name=$_REQUEST['username'];
		$email=$_REQUEST['useremail'];
		$phone=$_REQUEST['userphone'];
		$comments=$_REQUEST['usercomments'];
		$sql="select * from tbl_site where Id='1'";
		$Result	= $this->ExecuteQuery($sql, "select");
		$to=$Result[0]['Email'];
		$imgurl="".$config['SiteGlobalPath']."/admin/img/logo.png";
		$mess='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
			<title>Donisde</title>
			<style type="text/css">
			<!--
			.style1 {
				font-size: 16px;
				font-weight: bold;
			}
			-->
			</style>
			</head>
			
			<body>
			<table width="700" border="0" cellspacing="0" cellpadding="7">
			  <tr>
			    <td bgcolor="#000000"><table width="100%" border="0" cellspacing="0" cellpadding="0">
			      <tr>
			        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
			          <tr>
			            </tr>
			          <tr>
			            <td height="35" align="center" bgcolor="#FFFFFF" class="normal_txt7"><table width="97%"  cellspacing="4" cellpadding="4" style="font-family:Verdana; font-size:12px;">
			              <tr>
			                <td height="25" colspan="2"><img src="'.$imgurl.'" border="0" /></td>
			                </tr>
			              <tr>
			                <td height="25" colspan="2" bgcolor="#CCCCCC"><span class="style1">Contact Form </span></td>
			                </tr>
			              <tr>
			                <td width="17%" bgcolor="#F8F8F8"><strong>Name</strong></td>
			                <td width="83%" height="25" align="left" valign="middle" bgcolor="#F8F8F8" ><span class="normal_blue">'.$name.'</span></td>
			                </tr>
							<tr>
			                <td bgcolor="#F8F8F8"><strong>Email</strong></td>
			                <td height="25" align="left" valign="middle" bgcolor="#F8F8F8" ><span class="normal_blue">'.$email.'</span></td>
			                </tr>
			                <tr>
			                <td bgcolor="#F8F8F8"><strong>Phone No</strong></td>
			                <td height="25" align="left" valign="middle" bgcolor="#F8F8F8" ><span class="normal_blue">'.$phone.'</span></td>
			                </tr>
							<tr>
			                <td valign="top" bgcolor="#F8F8F8"><strong>Comments</strong></td>
			                <td height="25" align="left" valign="middle" bgcolor="#F8F8F8" >'.$comments.' </td>
			                </tr>
			                 <tr>
						<td height="8"></td>
						<td height="8" colspan="2"></td>
					  </tr>
					  
					  <tr>
						
						<td height="8" colspan="2" align="left">Thanks,</td>
						<td height="8"></td>
					  </tr>
					  <tr>
						
						<td height="8" colspan="2" align="left">Admin</td>
						<td height="8"></td>
					  </tr>
					  <tr>
						<td height="8"></td>
						<td height="8" colspan="2"></td>
					  </tr>
					 
				
			            </table></td>
			          </tr>
			        </table></td>
			      </tr>
			    </table></td>
			  </tr>
			</table>
			</body>
			</html>';

		//echo $mess;
		//$to=$config['AdminMail'];
		$subject  = ".$sub.";
		$headers .= "From: ".$email."\r\n";
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		@mail($to,$subject,$mess,$headers);
		$objSmarty->assign("SuccessMessage", "Mail has been sent successfully");
	}

	function manage_users()
	{
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['pagelimit']==''){
			$this->Limit			= 10;
		}else{
		 $this->Limit=$_REQUEST['pagelimit'];
		}
		if((strcmp($_REQUEST['keyword'], "First Name"))&&(isset($_REQUEST['keyword']))){

			$where_condition.=" and `FirstName` like '%".addslashes(trim($_REQUEST['keyword']))."%' ";
		}
		if((strcmp($_REQUEST['keyword1'], "Last Name"))&&(isset($_REQUEST['keyword1']))){

			$where_condition.=" and `LastName` like '%".addslashes(trim($_REQUEST['keyword1']))."%' ";
		}
		if((isset($_REQUEST['utype']))){

			$where_condition.=" and `UserType` like '%".addslashes(trim($_REQUEST['utype']))."%' ";
		}

		if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition.=" order by FirstName asc";
			if($_REQUEST['flag']=="2")
			$where_condition.=" order by FirstName desc";
			if($_REQUEST['flag']=="9")
			$where_condition.=" order by LastName asc";
			if($_REQUEST['flag']=="10")
			$where_condition.=" order by LastName desc";
			if($_REQUEST['flag']=="11")
			$where_condition.=" order by CreatedDate asc";
			if($_REQUEST['flag']=="12")
			$where_condition.=" order by CreatedDate desc";
				
		}else{
			$where_condition.=" order by `UserID` desc";
		}
		$SelQuery	= "select * from `tbl_user` where UserId!='' "
		."$where_condition";
			
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
		}

		if(!empty($Res_Tickets)&& is_array($Res_Tickets))
		$objSmarty->assign("UserList",$Res_Tickets);
	}

	function addUser()
	{
		global $objSmarty;
		$SelQuery	= "SELECT * from `tbl_user`"
		." WHERE `Email`='".addslashes($_REQUEST['email'])."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"norows");
		if(!$ExeSelQuery){
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
				$add="../uploads/$filename";
				@move_uploaded_file($_FILES['txtpic']['tmp_name'], $add);
				$resizeObj = new resize("../uploads/".$filename);
				$resizeObj -> resizeImage(235, 215, 'crop');
				$resizeObj -> saveImage("../uploads/medium/".$filename, 100);

				$resizeObj = new resize("../uploads/".$filename);
				$resizeObj -> resizeImage(320, 300, 'crop');
				$resizeObj -> saveImage("../uploads/large/".$filename, 100);
					
				$temp='';
			}else{
				//$filename='profile'.$_REQUEST['propic'].'.jpg';
				$sql="select * from tbl_picture where Id='".$_REQUEST['propic']."'";
				$ExeS= $this->ExecuteQuery($sql,"select");
				$filename=$ExeS[0]['Image'];
				$temp=$_REQUEST['propic'];
			}
			$age=$this->agecal($_REQUEST['dob']);
			$InsQuery	= "INSERT INTO `tbl_user`
						   (
							 `UserType`,
							 `FirstName`,
							 `LastName`,
							 `Email`,
							 `Password`,
							 `Mobile`,
							 `Gender`,
							 `DOB`,
							 `Age`,
							 `Image`,
							 `ImageTemplate`,
							 `Country`,
							 `State`,
							 `City`,
							 `Zip`,
							 `Company`,
							 `Referred`,
							 `RefMusician`,
							 `RefBusiness`,
							 `Advertisement`, 
							 `SearchEngine`,
							 `Other`,
							 `Instrument`,
							 `Style`,
							 `Specialty`,
							 `Description`,	
							 `Influences`,
							 `Equipment`,
							 `Status`,
							 `MailStatus`,
							 `CreatedDate`
							) 
							VALUES
							(
							'".addslashes($_REQUEST['utype'])."',
								'".addslashes($_REQUEST['fname'])."',
								'".addslashes($_REQUEST['lname'])."',
								'".addslashes($_REQUEST['email'])."',
								'".addslashes($_REQUEST['pword'])."',
								'".addslashes($_REQUEST['phoneNo'])."',
								'".addslashes($_REQUEST['gender'])."',
								'".addslashes($_REQUEST['dob'])."',
								'".$age."',
								'".$filename."',
								'".$temp."',
								'".addslashes($_REQUEST['country'])."',
								'".addslashes($_REQUEST['state'])."',
								'".addslashes($_REQUEST['city'])."',
								'".addslashes($_REQUEST['zip'])."',
								'".addslashes($_REQUEST['company'])."',
								'".addslashes($_REQUEST['referred'])."',
								'".addslashes($_REQUEST['refmusician'])."',
								'".addslashes($_REQUEST['refbusiness'])."',
								'".addslashes($_REQUEST['adv'])."',
								'".addslashes($_REQUEST['searcheng'])."',
								'".addslashes($_REQUEST['refother'])."',
								'".$instrument."',
								'".$style."', 
								'".$specialty."',
								'".addslashes($_REQUEST['desc'])."',
								'".addslashes($_REQUEST['influences'])."',
								'".addslashes($_REQUEST['equipment'])."',
								'1',
								'1',
								now()
							)  "; 

			$ExeInsQuery=$this->ExecuteQuery($InsQuery,"insert");
			$id=mysql_insert_id();
			if(count($_REQUEST['specialty'])!='0')
			{
				for($i=0;$i<count($_REQUEST['specialty']);$i++){
					$sid=$_REQUEST['specialty'][$i];
					$sname=$_REQUEST['spe_'.$sid];
					$InsQ	= "INSERT INTO `tbl_userspecality`
						   (
							 `UserId`, `CatId`,`SubName`
							 ) 
							VALUES
							(
						'".$id."',	'".addslashes($_REQUEST['specialty'][$i])."','".$sname."'
							
							)  ";
					$ExeInsQuer=$this->ExecuteQuery($InsQ,"insert");
				}
			}
				
			if($_REQUEST['refmusician']!=''){
				$refby=addslashes($_REQUEST['refmusician']);
			}else{
				$refby=addslashes($_REQUEST['refbusiness']);
			}
			$refto=addslashes($_REQUEST['fname']).' '.addslashes($_REQUEST['lname']);
			$InsQuery1	= "INSERT INTO `tbl_friends`
						   (
							 `Refer`, `ReferredBy`,
							 `ReferredTo`,`UserId`,
							 `RequestStatus`,
							 `CreatedDate`
							 ) 
							VALUES
							(
							'".addslashes($_REQUEST['referred'])."',
							'".$refby."',
								'".$refto."','".$id."',
								'1',
								now()
							)  ";
			$ExeInsQuery1=$this->ExecuteQuery($InsQuery1,"insert");
			$objSmarty->assign("SuccessMessage","User has been added successfully");
			$objSmarty->assign('company','');
				
		}
		else
		{
			$objSmarty->assign("ErrorMessage","Email already exists");
		}
	}
	function select_user()
	{
		global $objSmarty;

		$SelQuery	= "SELECT * from `tbl_user` where `UserId` = '".$_REQUEST['Ident']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("User",$ExeSelQuery);

	}

	function EditUser()
	{
		global $objSmarty;
		$SelQuery	= "SELECT * from `tbl_user`"
		." WHERE `Email`='".addslashes($_REQUEST['email'])."' and UserId !='".$_REQUEST['Ident']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"norows");
		if(!$ExeSelQuery){
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
				$temp='';
			}else{
				$temp=$_REQUEST['propic'];
			}
			if($_FILES['txtpic']['name'] != ""){
				$filename_new =time().$_FILES['txtpic']['name'];
				$getFormat_new = substr(strrchr($filename_new,'.'),1);
				$filename = md5($filename_new).'.'.$getFormat_new;
				$filename = strtolower($filename);
				$add="../uploads/$filename";
				@move_uploaded_file($_FILES['txtpic']['tmp_name'], $add);
				$resizeObj = new resize("../uploads/".$filename);
				$resizeObj -> resizeImage(235, 215, 'crop');
				$resizeObj -> saveImage("../uploads/medium/".$filename, 100);

				$resizeObj = new resize("../uploads/".$filename);
				$resizeObj -> resizeImage(320, 300, 'crop');
				$resizeObj -> saveImage("../uploads/large/".$filename, 100);
					
				$imagePath = ", Image = '".$filename."'";
			}
			if($_FILES['txtpic']['name'] == "" && $_REQUEST['propic']!=''){
				//$filename='profile'.$_REQUEST['propic'].'.jpg';
				$sql="select * from tbl_picture where Id='".$_REQUEST['propic']."'";
				$ExeS= $this->ExecuteQuery($sql,"select");
				$filename=$ExeS[0]['Image'];
				$imagePath = ", Image = '".$filename."'";
			}
			$age=$this->agecal($_REQUEST['dob']);
				
			$InsQuery	= "UPDATE `tbl_user` SET
						
							 `UserType`='".addslashes($_REQUEST['utype'])."',
							 `FirstName`='".addslashes($_REQUEST['fname'])."',
							 `LastName`='".addslashes($_REQUEST['lname'])."',
							 `Email`='".addslashes($_REQUEST['email'])."',
							  `Gender`='".addslashes($_REQUEST['gender'])."',
							   `DOB`='".addslashes($_REQUEST['dob'])."',
							    `Age`='".$age."',
							 `Mobile`='".addslashes($_REQUEST['phoneNo'])."',
							  `Country`='".addslashes($_REQUEST['country'])."',
							  `State`='".addslashes($_REQUEST['state'])."',
							    `City`='".addslashes($_REQUEST['city'])."',
							      `Zip`='".addslashes($_REQUEST['zip'])."',
							 `Company`='".addslashes($_REQUEST['company'])."',
							 `Referred`='".addslashes($_REQUEST['referred'])."',
							 `RefMusician`='".addslashes($_REQUEST['refmusician'])."',
							  `Advertisement`='".addslashes($_REQUEST['adv'])."',
							    `SearchEngine`='".addslashes($_REQUEST['searcheng'])."',
							     `Other`='".addslashes($_REQUEST['refother'])."',
							       `ImageTemplate`='".$temp."',
							 `Instrument`='".$instrument."',
							  `Style`='".$style."',  `Specialty`='".$specialty."',
							  `Description`='".addslashes($_REQUEST['desc'])."',
							  	 `Influences`= '".addslashes($_REQUEST['influences'])."',
							  	  `Equipment`='".addslashes($_REQUEST['equipment'])."',
							 `RefBusiness`='".addslashes($_REQUEST['refbusiness'])."' $imagePath
							  where `UserId` = '".$_REQUEST['Ident']."'
							 "; 

			$ExeInsQuery=$this->ExecuteQuery($InsQuery,"update");
			if(count($_REQUEST['specialty'])!='0')
			{
				$del="delete  from `tbl_userspecality` where UserId='".$_REQUEST['Ident']."'";
				$ExeInsQue=$this->ExecuteQuery($del,"delete");
				for($i=0;$i<count($_REQUEST['specialty']);$i++){
					$sid=$_REQUEST['specialty'][$i];
					$sname=$_REQUEST['spe_'.$sid];
					$InsQ	= "INSERT INTO `tbl_userspecality`
						   (
							 `UserId`, `CatId`,`SubName`
							 ) 
							VALUES
							(
						'".$_REQUEST['Ident']."',	'".addslashes($_REQUEST['specialty'][$i])."','".$sname."'
							
							)  ";
					$ExeInsQuer=$this->ExecuteQuery($InsQ,"insert");
				}
			}
			$objSmarty->assign("SuccessMessage","User has been updated successfully");
				
				
		}
		else
		{
			$objSmarty->assign("ErrorMessage","Email already exists");
		}
	}
	function getinstrumentfound($hid,$cid)
	{
		global $objSmarty;
		$sql="select * from tbl_user where UserId ='".$hid."'";
		$ExeSelQuery=$this->ExecuteQuery($sql,"select");
			
		if($ExeSelQuery[0]['Instrument']!='')
		{
			$ex=explode(',',$ExeSelQuery[0]['Instrument']);

			for($i=0;$i<sizeof($ex);$i++)
			{
				if($cid==$ex[$i])
				{
						
					$check=1;
				}

			}
		}
		else {
			$check=2;
		}
		if($check==1)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		$ex='';
	}


	function getspecialtyfound($hid,$cid)
	{
		global $objSmarty;
		$sql="select * from tbl_user where UserId ='".$hid."'";
		$ExeSelQuery=$this->ExecuteQuery($sql,"select");
			
		if($ExeSelQuery[0]['Specialty']!='')
		{
			$ex=explode(',',$ExeSelQuery[0]['Specialty']);

			for($i=0;$i<sizeof($ex);$i++)
			{
				if($cid==$ex[$i])
				{
						
					$check=1;
				}

			}
		}
		else {
			$check=2;
		}
		if($check==1)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		$ex='';
	}

	function getjobspecialtyfound($hid,$cid)
	{
		global $objSmarty;
		$sql="select * from tbl_job where JobID ='".$hid."'";
		$ExeSelQuery=$this->ExecuteQuery($sql,"select");
			
		if($ExeSelQuery[0]['Specialty']!='')
		{
			$ex=explode(',',$ExeSelQuery[0]['Specialty']);

			for($i=0;$i<sizeof($ex);$i++)
			{
				if($cid==$ex[$i])
				{
						
					$check=1;
				}

			}
		}
		else {
			$check=2;
		}
		if($check==1)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		$ex='';
	}
	function getstylefound($hid,$cid)
	{
		global $objSmarty;
		$sql="select * from tbl_user where UserId ='".$hid."'";
		$ExeSelQuery=$this->ExecuteQuery($sql,"select");
			
		if($ExeSelQuery[0]['Style']!='')
		{
			$ex=explode(',',$ExeSelQuery[0]['Style']);

			for($i=0;$i<sizeof($ex);$i++)
			{
				if($cid==$ex[$i])
				{
						
					$check=1;
				}

			}
		}
		else {
			$check=2;
		}
		if($check==1)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		$ex='';
	}
	function getuserspec($uid,$id)
	{
		global $objSmarty;
		$selquery="select  * from tbl_userspecality where UserId='$uid' and CatId='$id' ";
		$ExeUpQuery= $this->ExecuteQuery($selquery,"select");
		$objSmarty->assign("subname",$ExeUpQuery);
	}

	/********************************** BY SM ***************************************/
	function getjobspec($uid,$id)
	{
		global $objSmarty;
		$selquery="select  * from tbl_jobspecality where JobId='$uid' and CatId='$id' ";
		$ExeUpQuery= $this->ExecuteQuery($selquery,"select");
		$objSmarty->assign("subname",$ExeUpQuery);
	}
function getagename($id)
	{
		global $objSmarty;
	   $selquery="select  * from tbl_age where Id In ($id)  ";
		$ExeUpQuery= $this->ExecuteQuery($selquery,"select");
		$objSmarty->assign("adetail",$ExeUpQuery);
	}
	/********************************** BY SM ***************************************/
	function getinstname($id)
	{
		global $objSmarty;
		$selquery="select  * from tbl_instrument where id IN ($id) ";
		$ExeUpQuery= $this->ExecuteQuery($selquery,"select");
		$objSmarty->assign("sdetail",$ExeUpQuery);
	}

	function getstylename($id)
	{
		global $objSmarty;
		$selquery="select  * from tbl_style where ID IN ($id) ";
		$ExeUpQuery= $this->ExecuteQuery($selquery,"select");
		$objSmarty->assign("detail",$ExeUpQuery);
	}
	function getspecatyname($id)
	{
		global $objSmarty;
		$selquery="select  * from tbl_specialty where ID IN ($id) ";
		$ExeUpQuery= $this->ExecuteQuery($selquery,"select");
		$objSmarty->assign("detail",$ExeUpQuery);
	}
	function getspecatylename($id)
	{
		global $objSmarty;
		$selquery="select  u.*,s.* from tbl_userspecality u,tbl_specialty s   where u.UserId='$id' and u.CatId=s.ID and s.Status='1'";
		$ExeUpQuery= $this->ExecuteQuery($selquery,"select");
		$objSmarty->assign("spcname",$ExeUpQuery);
	}
	function getstatename($id)
	{
		global $objSmarty;
		//$selquery="select  * from tbl_state where State_Id='$id' ";
		$selquery="select  * from states where id='$id' ";
		$ExeUpQuery= $this->ExecuteQuery($selquery,"select");
		$objSmarty->assign("state",$ExeUpQuery);
	}
	function getcountryname($id)
	{
		global $objSmarty;
		$selquery="select  * from tbl_country where Country_Id='$id' ";
		$ExeUpQuery= $this->ExecuteQuery($selquery,"select");
		$objSmarty->assign("country",$ExeUpQuery);
	}
	function getinstfound($hid,$cid)
	{
		global $objSmarty;
		$sql="select * from tbl_job where JobID ='".$hid."'";
		$ExeSelQuery=$this->ExecuteQuery($sql,"select");
			
		if($ExeSelQuery[0]['Instrument']!='')
		{
			$ex=explode(',',$ExeSelQuery[0]['Instrument']);

			for($i=0;$i<sizeof($ex);$i++)
			{
				if($cid==$ex[$i])
				{
						
					$check=1;
				}

			}
		}
		else {
			$check=2;
		}
		if($check==1)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		$ex='';
	}

	function getstyfound($hid,$cid)
	{
		global $objSmarty;
		$sql="select * from tbl_job where JobID ='".$hid."'";
		$ExeSelQuery=$this->ExecuteQuery($sql,"select");
			
		if($ExeSelQuery[0]['Style']!='')
		{
			$ex=explode(',',$ExeSelQuery[0]['Style']);

			for($i=0;$i<sizeof($ex);$i++)
			{
				if($cid==$ex[$i])
				{
						
					$check=1;
				}

			}
		}
		else {
			$check=2;
		}
		if($check==1)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		$ex='';
	}
	function getexpfound($hid,$cid)
	{
		global $objSmarty;
		$sql="select * from tbl_job where JobID ='".$hid."'";
		$ExeSelQuery=$this->ExecuteQuery($sql,"select");
			
		if($ExeSelQuery[0]['Experience']!='')
		{
			$ex=explode(',',$ExeSelQuery[0]['Experience']);

			for($i=0;$i<sizeof($ex);$i++)
			{
				if($cid==$ex[$i])
				{
						
					$check=1;
				}

			}
		}
		else {
			$check=2;
		}
		if($check==1)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		$ex='';
	}
	function getagefound($hid,$cid)
	{
		global $objSmarty;
		$sql="select * from tbl_job where JobID ='".$hid."'";
		$ExeSelQuery=$this->ExecuteQuery($sql,"select");
			
		if($ExeSelQuery[0]['Age_new']!='')
		{
			$ex=explode(',',$ExeSelQuery[0]['Age_new']);

			for($i=0;$i<sizeof($ex);$i++)
			{
				if($cid==$ex[$i])
				{
						
					$check=1;
				}

			}
		}
		else {
			$check=2;
		}
		if($check==1)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		$ex='';
	}
	function getprofound($cid)
	{
		global $objSmarty;
			
		if($_REQUEST['profile']!='')
		{
			//$ex=explode(',',$ExeSelQuery[0]['Experience']);

			for($i=0;$i<sizeof($_REQUEST['profile']);$i++)
			{
				if($cid==$_REQUEST['profile'][$i])
				{
						
					$check=1;
				}

			}
		}
		else {
			$check=2;
		}
		if($check==1)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		$_REQUEST['profile']='';
	}

	function getjobinsfound($cid)
	{
		global $objSmarty;
			
		if($_REQUEST['instrument']!='')
		{
			//$ex=explode(',',$ExeSelQuery[0]['Experience']);

			for($i=0;$i<sizeof($_REQUEST['instrument']);$i++)
			{
				if($cid==$_REQUEST['instrument'][$i])
				{
						
					$check=1;
				}

			}
		}
		else {
			$check=2;
		}
		if($check==1)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		$_REQUEST['instrument']='';
	}
	function getjobstyfound($cid)
	{
		global $objSmarty;
			
		if($_REQUEST['style']!='')
		{
			//$ex=explode(',',$ExeSelQuery[0]['Experience']);

			for($i=0;$i<sizeof($_REQUEST['style']);$i++)
			{
				if($cid==$_REQUEST['style'][$i])
				{
						
					$check=1;
				}

			}
		}
		else {
			$check=2;
		}
		if($check==1)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		$_REQUEST['style']='';
	}
	/*****************---------SA-----------06/07/2015-----------logo management-----------***********************************************/


	function manage_logos()
	{
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['pagelimit']==''){
			$this->Limit			= 10;
		}else{
		 $this->Limit=$_REQUEST['pagelimit'];
		}
		if($_REQUEST['keyword']!="")
		$where_condition.=" where `CompanyName` like '%".addslashes(trim($_REQUEST['keyword']))."%'";

		if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition.=" order by CompanyName asc";
			if($_REQUEST['flag']=="2")
			$where_condition.=" order by CompanyName desc";
		}else{
			$where_condition.=" order by `ID` desc";
		}
		$SelQuery	= "select * from `tbl_logos`"
		."$where_condition";
			
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
		}

		if(!empty($Res_Tickets)&& is_array($Res_Tickets))
		$objSmarty->assign("CatList",$Res_Tickets);
	}
	function add_company()
	{
		global $objSmarty;
		$SelQuery	= "SELECT * from `tbl_logos`"
		." WHERE `CompanyName`='".addslashes($_REQUEST['company_name'])."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"norows");

		if(!$ExeSelQuery){
				
			if (($_FILES["company_image1"]["size"] == 0)||($_FILES["company_image2"]["size"] == 0))
			{
				$objSmarty->assign("ErrorMessage","Only .jpg images below 2 MB can be uploaded");
			} else
			{
				$filename1 =time().addslashes($_FILES['company_image1']['name']);
				$add1="../Logos/$filename1";
				@move_uploaded_file($_FILES['company_image1']['tmp_name'], $add1);

				$filename2 =time().addslashes($_FILES['company_image2']['name']);
				$add2="../Logos/$filename2";
				@move_uploaded_file($_FILES['company_image2']['tmp_name'], $add2);
					
				$InsQuery	= "INSERT INTO `tbl_logos`
						   (
							 `CompanyName`,
							 `CompanyURL`,
							 `Image`,
							 `ImageHover`,
							 `Status`,
							 `DateCreated`
							) 
							VALUES
							(
								'".addslashes($_REQUEST['company_name'])."',
								'".addslashes($_REQUEST['company_url'])."',
								'".$filename1."',
								'".$filename2."',
								'1',
								now()
							)  "; 

				$ExeInsQuery=$this->ExecuteQuery($InsQuery,"insert");
				$id=mysql_insert_id();
				$objSmarty->assign("SuccessMessage","Logo has been added successfully");
				$objSmarty->assign('company','');
			}
		}
		else
		{
			$objSmarty->assign("ErrorMessage","Company name already exists");
		}
	}
	function select_logo()
	{
		global $objSmarty;

		$SelQuery	= "SELECT * from `tbl_logos` where `ID` = '".$_REQUEST['Ident']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("Cat",$ExeSelQuery);

	}




	function update_logo()
	{
		global $objSmarty;
		$SelQuery	= "SELECT * from `tbl_logos`"
		." WHERE `CompanyName`='".addslashes($_REQUEST['company_name'])."' and `ID` != '".$_REQUEST['Ident']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"norows");

		if(!$ExeSelQuery){
			if($_FILES['company_image1']['name']!='')
			{
				$filename1 =time().addslashes($_FILES['company_image1']['name']);
				$add1="../Logos/$filename1";
				@move_uploaded_file($_FILES['company_image1']['tmp_name'], $add1);
			}
			else
			{
				$filename1 = $_REQUEST['company_image1_hid'];
			}

			if($_FILES['company_image2']['name']!='')
			{
				$filename2 =time().addslashes($_FILES['company_image2']['name']);
				$add2="../Logos/$filename2";
				@move_uploaded_file($_FILES['company_image2']['tmp_name'], $add2);
			}
			else
			{
				$filename2 = $_REQUEST['company_image2_hid'];
			}

			$SelQuery	= "UPDATE `tbl_logos` SET
				      `CompanyName`='".addslashes($_REQUEST['company_name'])."',
				      `CompanyURL`='".addslashes($_REQUEST['company_url'])."',
				      `Image`='".$filename1."',
				      `ImageHover`='".$filename2."',
				      `DateCreated`=now()"
				      ." WHERE `ID`='".$_REQUEST['Ident']."'";
				      $this->ExecuteQuery($SelQuery,"update");
				      $objSmarty->assign("SuccessMessage","Logo has been updated successfully");
				      	
		}
		else{
			$objSmarty->assign("ErrorMessage","Company name already exists");
		}
	}
	function getalllogo(){
		global $objSmarty;
		$sel="select * from tbl_logos where Status='1'";
		$ExeSelQuery= $this->ExecuteQuery($sel,"select");
		$objSmarty->assign("logos",$ExeSelQuery);

	}
	/***********************---------------logo end----------------------*********************************************/
	function getinstruments(){
		global $objSmarty;
		$sel="select * from tbl_instrument where Status='1' order by Instrument asc";
		$ExeSelQuery= $this->ExecuteQuery($sel,"select");
		$objSmarty->assign("instuments",$ExeSelQuery);

	}
	
	function getinstrumentname($insid){
		global $objSmarty;
		$sel="select * from tbl_instrument where ID='".$insid."'";
		$ExeSelQuery= $this->ExecuteQuery($sel,"select");
		return 	$ExeSelQuery[0]['Instrument'];
	}
	
	function getspecialname($insid){
		global $objSmarty;
		$sel="select * from tbl_specialty where ID='".$insid."'";
		$ExeSelQuery= $this->ExecuteQuery($sel,"select");
		$spelty=$ExeSelQuery[0]['Specialty'];
		$objSmarty->assign("spelty",$spelty);
		return 	$ExeSelQuery[0]['Specialty'];
	}
	
	function getstyle(){
		global $objSmarty;
		$sel="select * from tbl_style where Status='1' order by Style asc";
		$ExeSelQuery= $this->ExecuteQuery($sel,"select");
		$objSmarty->assign("style",$ExeSelQuery);
	}
	
	function getstylesname($id){
		global $objSmarty;
		$sel="select * from tbl_style where ID='".$id."'";
		$ExeSelQuery= $this->ExecuteQuery($sel,"select");
		return 	$ExeSelQuery[0]['Style'];
    }
    
	function getspecialty(){
		global $objSmarty;
		$sel="select * from  tbl_specialty where Status='1' order by Specialty asc";
		$ExeSelQuery= $this->ExecuteQuery($sel,"select");
		$objSmarty->assign("specialty",$ExeSelQuery);

	}
	
	function getpictures(){
		global $objSmarty;
		$sel="select * from tbl_picture where Status='1'";
		$ExeSelQuery= $this->ExecuteQuery($sel,"select");
		$objSmarty->assign("Pictemp",$ExeSelQuery);

	}
	
	function getjobtemplates(){
		global $objSmarty;
		$sel="select * from tbl_jobtemplate where Status='1'";
		$ExeSelQuery= $this->ExecuteQuery($sel,"select");
		$objSmarty->assign("jobtemp",$ExeSelQuery);
    }
    
	function gettempname($id){
		global $objSmarty;
		$sel="select * from tbl_jobtemplate where Id='$id'";
		$ExeSelQuery= $this->ExecuteQuery($sel,"select");
		$objSmarty->assign("jtemp",$ExeSelQuery);
	}
	
	function getstates(){
		global $objSmarty;
		$sel="select * from tbl_state where Country_Id='1' and Status='1'";
		$ExeSelQuery= $this->ExecuteQuery($sel,"select");
		$objSmarty->assign("states",$ExeSelQuery);
	}
	
	function getuser($id){
		global $objSmarty;
		$sel="select * from tbl_user where UserId='$id'";
		$ExeSelQuery= $this->ExecuteQuery($sel,"select");
		$objSmarty->assign("User",$ExeSelQuery);
	}
	
	function manage_friends()
	{
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['pagelimit']==''){
			$this->Limit			= 10;
		}else{
		 $this->Limit=$_REQUEST['pagelimit'];
		}
		if((strcmp($_REQUEST['keyword'], "Referred By"))&&(isset($_REQUEST['keyword']))){

			$where_condition.=" and `ReferredBy` like '%".addslashes(trim($_REQUEST['keyword']))."%' ";
		}
		if((strcmp($_REQUEST['keyword1'], "Referred To"))&&(isset($_REQUEST['keyword1']))){

			$where_condition.=" and `ReferredTo` like '%".addslashes(trim($_REQUEST['keyword1']))."%' ";
		}
		if((isset($_REQUEST['referred']))){

			$where_condition.=" and `Refer` like '%".addslashes(trim($_REQUEST['referred']))."%' ";
		}
		if((isset($_REQUEST['statu']))){

			$where_condition.=" and `RequestStatus` like '%".addslashes(trim($_REQUEST['statu']))."%' ";
		}
		if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition.=" order by ReferredBy asc";
			if($_REQUEST['flag']=="2")
			$where_condition.=" order by ReferredBy desc";
			if($_REQUEST['flag']=="9")
			$where_condition.=" order by ReferredTo asc";
			if($_REQUEST['flag']=="10")
			$where_condition.=" order by ReferredTo desc";
			if($_REQUEST['flag']=="11")
			$where_condition.=" order by CreatedDate asc";
			if($_REQUEST['flag']=="12")
			$where_condition.=" order by CreatedDate desc";
				
		}else{
			$where_condition.=" order by `ID` desc";
		}


		$SelQuery	= "select * from `tbl_friends` where ID!=''"
		."$where_condition";
			
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
		}

		if(!empty($Res_Tickets)&& is_array($Res_Tickets))
		$objSmarty->assign("FriendList",$Res_Tickets);
	}
	/////////////////////////////////REGISTER/////////////////////////////////////////////////////////////////////////////
	function agecal($birthday){

		list( $month,$day, $year) = explode("/", $birthday);
		$year_diff  = date("Y") - $year;
		$month_diff = date("m") - $month;
		$day_diff   = date("d") - $day;
		if ($day_diff < 0 && $month_diff==0) $year_diff--;
		if ($day_diff < 0 && $month_diff < 0) $year_diff--;
		return $year_diff;
	}
	
	function Register()
	{
		global $objSmarty,$config;
		$SelQuery	= "SELECT * from `tbl_user`"
		." WHERE `Email`='".addslashes($_REQUEST['email'])."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"norows");
		if(!$ExeSelQuery){
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
				$resizeObj = new resize("uploads/".$filename);
				$resizeObj -> resizeImage(235, 215, 'crop');
				$resizeObj -> saveImage("uploads/medium/".$filename, 100);

				$resizeObj = new resize("uploads/".$filename);
				$resizeObj -> resizeImage(320, 300, 'crop');
				$resizeObj -> saveImage("uploads/large/".$filename, 100);
				$temp='';
			}else{
				//$filename='profile'.$_REQUEST['propic'].'.jpg';
				$sql="select * from tbl_picture where Id='".$_REQUEST['propic']."'";
				$ExeS= $this->ExecuteQuery($sql,"select");
				$filename=$ExeS[0]['Image'];
				$temp=$_REQUEST['propic'];
			}
			$age=$this->agecal($_REQUEST['dob']);
			
			 $InsQuery	= "INSERT INTO `tbl_user`
						   (
							 `UserType`,
							 `FirstName`,
							 `LastName`,
							 `Email`,
							 `Password`,
							 `Mobile`,
							 `Gender`,
							 `DOB`,
							 `Age`,
							 `Image`,
							 `ImageTemplate`,
							 `Country`,
							 `State`,
							 `City`,
							 `Zip`,
							 `Company`,
							 `Referred`,
							 `RefMusician`,
							 `RefBusiness`,
							 `Advertisement`,
                             `SearchEngine`, 
                             `Other`,
							 `Instrument`,
							 `Style`,
							 `Specialty`,
							 `Description`,	
							 `Influences`,
                             `Equipment`,
                             `RefId`,
							 `OtherIns`,
							 `OtherInsName`,
							 `OtherStyle`, 
							 `OtherStyleName`,
							 `OtherSpeciality`,
							 `OtherSpecialityName`,
							 `Latitude`,
							 `Longitude`,
							 `Status`,
							 `MailStatus`,
							 `CreatedDate`
							) 
							VALUES
							(
							'".addslashes($_REQUEST['utype'])."',
							'".addslashes($_REQUEST['fname'])."',
							'".addslashes($_REQUEST['lname'])."',
							'".addslashes($_REQUEST['email'])."',
							'".addslashes($_REQUEST['pword'])."',
							'".addslashes($_REQUEST['phoneNo'])."',
							'".addslashes($_REQUEST['gender'])."',
							'".addslashes($_REQUEST['dob'])."',
							'".$age."',
							'".$filename."',
							'".$temp."',
							'".addslashes($_REQUEST['country'])."',
							'".addslashes($_REQUEST['state'])."',
							'".addslashes($_REQUEST['city'])."',
							'".addslashes($_REQUEST['zip'])."',
							'".addslashes($_REQUEST['company'])."',
							'".addslashes($_REQUEST['referred'])."',
							'".addslashes($_REQUEST['refmusician'])."',
							'".addslashes($_REQUEST['refbusiness'])."',
							'".addslashes($_REQUEST['adv'])."',
							'".addslashes($_REQUEST['searcheng'])."',
							'".addslashes($_REQUEST['refother'])."',
							'".$instrument."',
							'".$style."',
							'".$specialty."',
							'".addslashes($_REQUEST['desc'])."',
							'".addslashes($_REQUEST['influences'])."',
							'".addslashes($_REQUEST['equipment'])."',
							'".addslashes($_REQUEST['refid'])."',
							'".addslashes($_REQUEST['other_ins'])."',
							'".addslashes($_REQUEST['otherins'])."',
							'".addslashes($_REQUEST['other_sty'])."',
							'".addslashes($_REQUEST['otherstyle'])."',
							'".addslashes($_REQUEST['other_spe'])."',
							'".addslashes($_REQUEST['otherspecialty'])."',
							'".addslashes($_REQUEST['latitude'])."',
							'".addslashes($_REQUEST['longitude'])."',
							'1',
							'0',
							now()
							)  "; 

			$ExeInsQuery=$this->ExecuteQuery($InsQuery,"insert");
			$id=mysql_insert_id(); 
			if($ExeInsQuery)
			{
				$phone = $_REQUEST['desc'];
                if($_REQUEST['gender']=='Male')
                $gender='his';
                else 
                 $gender='her';
			$numbersOnly = preg_replace('{\D}','',$phone);
			$numberOfDigits = strlen($numbersOnly);
			$selectemail="select Email from tbl_site where Id='1'";
			$exeemail=$this->ExecuteQuery($selectemail,"select");
			$email=$exeemail[0]['Email'];
			if ($numberOfDigits=='7' || $numberOfDigits>='10') {
				$Username = addslashes($_REQUEST['fname']).' '.addslashes($_REQUEST['lname']);
			    $toEmail=$email;
			    $subject = "Contact detail in registration";
			    $imgurl="".$config['SiteGlobalPath']."/img/logo.png";
			    $message='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
				<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
				<title></title>
				<link href="melslifecss.css" rel="stylesheet" type="text/css" />
				</head>
				
				<body>
				<table width="75%" border="0" align="center" cellpadding="5" cellspacing="0" class="border_grey">
				    <tr>
			                <td height="25" colspan="2"><img src="'.$imgurl.'" border="0" /></td>
			                </tr>
				  <tr>
					<td><hr size="1px" color="#e0e0e0" /></td>
				  </tr>
				  <tr>
					<td><table width="100%"  cellspacing="0" cellpadding="0">
                    <tr>
						<td height="8">&nbsp;</td>
						<td height="8" colspan="2" align="left">
						  Hi Admin, </td>
					  </tr>
					 
					<tr>
						<td height="8"></td>
						<td height="8" colspan="2"></td>
					  </tr>
					  <tr>
						<td height="8">&nbsp;</td>
						<td height="8" colspan="2" align="left">
						   It seems that '.$Username.' has given '.$gender.' phone number in the registration form. </td>
					  </tr>
					  <tr>
						<td height="8"></td>
						<td height="8" colspan="2" ></td>
					  </tr>
					 					  
					  <tr>
						<td height="8"></td>
						<td height="8" colspan="2" align="left">Thanks,</td>
					  </tr>
					  <tr>
						<td height="8"></td>
						<td height="8" colspan="2" align="left">The Admin Team</td>
					  </tr>
					  <tr>
						<td height="8"></td>
						<td height="8" colspan="2"></td>
					  </tr>
					</table></td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
				  </tr>
				  <tr>
					<td align="center" bgcolor="#7e7e7e"><span class="footer_text">Copyright &copy; 2016. Pro Musician&apos;s List, Inc. All Rights Reserved.</span></td>
				  </tr>
				</table>
				</body>
				</html>';
			    //echo $message;exit; 
				$headers = 'From: admin@admin.com'."\r\n";
				$headers.= 'Reply-To: admin@admin.com'."\r\n";
				$headers.= "MIME-Version: 1.0\r\n";
				$headers.= "Content-type: text/html; charset=iso-8859-1\r\n";		
				//echo $message. $headers;			
				$mail=@mail($toEmail,$subject,$message,$headers);
	            } 

			}
			  
			if(count($_REQUEST['specialty'])!='0')
			{
				for($i=0;$i<count($_REQUEST['specialty']);$i++){
					$sid=$_REQUEST['specialty'][$i];
					$sname=$_REQUEST['spe_'.$sid];
					 $InsQ	= "INSERT INTO `tbl_userspecality`
						   (
							 `UserId`,
							 `CatId`,
							 `SubName`
							 ) 
							VALUES
							(
						     '".$id."',
						     '".addslashes($_REQUEST['specialty'][$i])."',
						     '".$sname."'
							)  ";
					$ExeInsQuer=$this->ExecuteQuery($InsQ,"insert");
				}
			}
			if($_REQUEST['refmusician']!=''){
				$refby=addslashes($_REQUEST['refmusician']);
			}else{
				$refby=addslashes($_REQUEST['refbusiness']);
			}
			$refto=addslashes($_REQUEST['fname']).' '.addslashes($_REQUEST['lname']);
			 $InsQuery1	= "INSERT INTO `tbl_friends`
						   (
							 `Refer`,
							 `ReferredBy`,
							 `ReferredTo`,
							 `UserId`,
							 `RequestStatus`,
							 `CreatedDate`
							 ) 
							VALUES
							(
							'".addslashes($_REQUEST['referred'])."',
							'".$refby."',
							'".$refto."',
							'".$id."',
							'1',
							now()
							)  ";
			$ExeInsQuery1=$this->ExecuteQuery($InsQuery1,"insert");

			if($_REQUEST['otherins']!=''){
				$InsQuery2	= "INSERT INTO `tbl_instrument`
						   (
							 `Instrument`, `Status`, `CreatedBy`, `CreatedDate`
							 ) 
							VALUES
							(
							'".addslashes($_REQUEST['otherins'])."','0','".$id."',now()
							)  ";
				$ExeInsQuery2=$this->ExecuteQuery($InsQuery2,"insert");
				$this->sendAdminmail('Instrument',$_REQUEST['otherins'],$_REQUEST['fname'],$_REQUEST['lname']);
			}
			if($_REQUEST['otherstyle']!=''){
				$InsQuery3	= "INSERT INTO `tbl_style`
						   (
							 `Style`, `Status`, `CreatedBy`, `CreatedDate`
							 ) 
							VALUES
							(
							'".addslashes($_REQUEST['otherstyle'])."','0','".$id."',now()
							)  ";
				$ExeInsQuery3=$this->ExecuteQuery($InsQuery3,"insert");
				//exit;
				$this->sendAdminmail('Style',$_REQUEST['otherstyle'],$_REQUEST['fname'],$_REQUEST['lname']);
			}
		if($_REQUEST['otherspecialty']!=''){
				$InsQuery3	= "INSERT INTO `tbl_specialty`
						   (
							 `Specialty`, `Status`, `CreatedBy`, `CreatedDate`
							 ) 
							VALUES
							(
							'".addslashes($_REQUEST['otherspecialty'])."','0','".$id."',now()
							)  ";
				$ExeInsQuery3=$this->ExecuteQuery($InsQuery3,"insert");
				//exit;
				$this->sendAdminmail('Specialty',$_REQUEST['otherspecialty'],$_REQUEST['fname'],$_REQUEST['lname']);
			}

			$Ran=$this->Sentlogindetail($_REQUEST['email'],$_REQUEST['fname'],$_REQUEST['lname'],$id,$_REQUEST['pword']);
			$objSmarty->assign("SuccessMessage","You have registered successfully. An email has been sent to your registered Email ID. Please activate your account.");
			$objSmarty->assign('company','');

		}
		else
		{
			$objSmarty->assign("ErrorMessage","Email already exists");
			$objSmarty->assign('User',$_REQUEST);
		}
	}


	function UpdateUser()
	{
		global $objSmarty;
		$SelQuery	= "SELECT * from `tbl_user`"
		." WHERE `Email`='".addslashes($_REQUEST['email'])."' and UserId !='".$_SESSION['UserId']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"norows");
		if(!$ExeSelQuery){
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
			/*if($_FILES['txtpic']['name'] != ""){
			 $temp='';
			 }else{
			 $temp=$_REQUEST['propic'];
			 }
			 if($_FILES['txtpic']['name'] != ""){

				$filename_new =time().$_FILES['txtpic']['name'];
				$getFormat_new = substr(strrchr($filename_new,'.'),1);
				$filename = md5($filename_new).'.'.$getFormat_new;
				$filename = strtolower($filename);
				$add="uploads/$filename";
				@move_uploaded_file($_FILES['txtpic']['tmp_name'], $add);
				//$MyThumb = new Thumbnail("uploads/$filename", 235, 215, "uploads/"."thumb_".$filename);
				//$MyThumb->Output();
				$resizeObj = new resize("uploads/".$filename);
				$resizeObj -> resizeImage(235, 215, 'crop');
				$resizeObj -> saveImage("uploads/medium/".$filename, 100);

				$resizeObj = new resize("uploads/".$filename);
				$resizeObj -> resizeImage(320, 300, 'crop');
				$resizeObj -> saveImage("uploads/large/".$filename, 100);
					
				$imagePath = ", Image = '".$filename."'";
				}
				if($_FILES['txtpic']['name'] == "" && $_REQUEST['propic']!=''){
				//$filename='profile'.$_REQUEST['propic'].'.jpg';
				$sql="select * from tbl_picture where Id='".$_REQUEST['propic']."'";
				$ExeS= $this->ExecuteQuery($sql,"select");
				$filename=$ExeS[0]['Image'];
				$imagePath = ", Image = '".$filename."'";
				/*`ImageTemplate`='".$temp."',*
				$imagePath
				}*/
			$age=$this->agecal($_REQUEST['dob']);
			$InsQuery	= "UPDATE `tbl_user` SET
							 `FirstName`='".addslashes($_REQUEST['fname'])."',
							 `LastName`='".addslashes($_REQUEST['lname'])."',
							 `Email`='".addslashes($_REQUEST['email'])."',
							  `Gender`='".addslashes($_REQUEST['gender'])."',
							   `DOB`='".addslashes($_REQUEST['dob'])."',
							    `Age`='".$age."',
							 `Mobile`='".addslashes($_REQUEST['phoneNo'])."',
							  `Country`='".addslashes($_REQUEST['country'])."',
							  `State`='".addslashes($_REQUEST['state'])."',
							    `City`='".addslashes($_REQUEST['city'])."',
							      `Zip`='".addslashes($_REQUEST['zip'])."',
							 `Company`='".addslashes($_REQUEST['company'])."',
							 `Referred`='".addslashes($_REQUEST['referred'])."',
							 `RefMusician`='".addslashes($_REQUEST['refmusician'])."',
							  `RefBusiness`='".addslashes($_REQUEST['refbusiness'])."',
							   `Advertisement`='".addslashes($_REQUEST['adv'])."',
							    `SearchEngine`='".addslashes($_REQUEST['searcheng'])."',
							     `Other`='".addslashes($_REQUEST['refother'])."',
							       
							 `OtherInsName`='".addslashes($_REQUEST['otherins'])."',
							 `OtherStyleName`='".addslashes($_REQUEST['otherstyle'])."',
							 `Instrument`='".$instrument."',
							  `Style`='".$style."', `Specialty`='".$specialty."',
							  `Description`='".addslashes($_REQUEST['desc'])."',
							  	 `Influences`= '".addslashes($_REQUEST['influences'])."',
							  	  `Equipment`='".addslashes($_REQUEST['equipment'])."',
							  	   `Latitude`='".addslashes($_REQUEST['latitude'])."',
							  	    `Longitude`='".addslashes($_REQUEST['longitude'])."'
							
							  where `UserId` = '".$_SESSION['UserId']."'
							 "; 

			$ExeInsQuery=$this->ExecuteQuery($InsQuery,"update");
				
			if(count($_REQUEST['specialty'])!='0')
			{
				$del="delete  from `tbl_userspecality` where UserId='".$_SESSION['UserId']."'";
				$ExeInsQue=$this->ExecuteQuery($del,"delete");
				for($i=0;$i<count($_REQUEST['specialty']);$i++){
					$sid=$_REQUEST['specialty'][$i];
					$sname=$_REQUEST['spe_'.$sid];
					$InsQ	= "INSERT INTO `tbl_userspecality`
						   (
							 `UserId`, `CatId`,`SubName`
							 ) 
							VALUES
							(
						'".$_SESSION['UserId']."',	'".addslashes($_REQUEST['specialty'][$i])."','".$sname."'
							
							)  ";
					$ExeInsQuer=$this->ExecuteQuery($InsQ,"insert");
				}
			}
			if($_REQUEST['refmusician']!=''){
				$refby=addslashes($_REQUEST['refmusician']);
			}else{
				$refby=addslashes($_REQUEST['refbusiness']);
			}
			$refto=addslashes($_REQUEST['fname']).' '.addslashes($_REQUEST['lname']);
			$InsQuery1	= "Update  `tbl_friends` set
						 
							 `Refer`='".addslashes($_REQUEST['referred'])."', 
							 `ReferredBy`=	'".$refby."',
							 `ReferredTo`='".$refto."',
							 `CreatedDate`=now() where  `UserId`='".$_SESSION['UserId']."'";

			$ExeInsQuery1=$this->ExecuteQuery($InsQuery1,"update");
				
			if($_REQUEST['otherins']!=''){
				$InsQuery2	= "Update  `tbl_instrument` SET
						  
							 `Instrument`=	'".addslashes($_REQUEST['otherins'])."', 
							 `Status`='0',  `CreatedDate`=now() where
							 `CreatedBy`= '".$_SESSION['UserId']."'";

				$ExeInsQuery2=$this->ExecuteQuery($InsQuery2,"update");
				$this->sendAdminmail('Instrument',$_REQUEST['otherins'],$_REQUEST['fname'],$_REQUEST['lname']);
			}
			if($_REQUEST['otherstyle']!=''){
				$InsQuery3	= "Update  `tbl_style` SET
						   
							 `Style`='".addslashes($_REQUEST['otherstyle'])."',
							  `Status`='0', 
							   `CreatedDate`=now()
							   where
							 `CreatedBy`= '".$_SESSION['UserId']."'";

				$ExeInsQuery3=$this->ExecuteQuery($InsQuery3,"update");
				$this->sendAdminmail('Style',$_REQUEST['otherstyle'],$_REQUEST['fname'],$_REQUEST['lname']);
			}
				
			$objSmarty->assign("SuccessMessage","User has been updated successfully");
				
				
		}
		else
		{
			$objSmarty->assign("ErrorMessage","Email already exists");
		}
	}

	////////////////----------------------New User Register Email----------------------/////////////////////////////////
	function Sentlogindetail($email,$fname,$lname,$uid,$password)
	{
		global $objSmarty,$config;
		$sel="select * from tbl_site";
		$Exe=$this->ExecuteQuery($sel,"select");
		$from=$Exe[0]['Email'];
		$to_email=$email;
		$imgurl.=$config['SiteGlobalPath']."/admin/img/logo.png";
		$activation_link=$config['SiteGlobalPath'].'/activateaccount.php?uid='.$uid;

	$message='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Welcome to Promusicianslist!</title>
	<style>
	body{
		font-family:Verdana, "Arial Narrow";
		font-size:12px;
		color:#000000;
	}
	</style>
	</head>
	
	<body>
	<table width="700" border="0" cellspacing="0" cellpadding="7">
	  <tr>
		<td bgcolor="#000000"><table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td width="100%" height="120" align="center" bgcolor="#E0E0E0" class="normal_txt7"><img src="'.$imgurl.'" /></td>
			  </tr>
			  <tr>
				<td height="35" align="center" bgcolor="#FFFFFF" class="normal_txt7"><table width="97%"  cellspacing="0" cellpadding="0">
				  <tr>
					<td width="53%" height="8"></td>
					<td width="47%" height="8"></td>
					</tr>
					<tr>
					<td height="25" colspan="2" align="left" valign="middle" class="title_1" >Hello '.$fname.' '.$lname.', </td>
					</tr>
					
					<tr>
					  <td height="25" colspan="2" align="left" valign="middle" class="title_1" >Please keep this e-mail for your records. Your account information is as follows:</td>
					</tr>
					<tr>
				  <td height="25" colspan="2" align="left" valign="middle" class="title_1" ><b>Email:</b> '.$email.'
			
			</td>
					</tr>
					<tr>
	  <td height="25" colspan="2" align="left" valign="middle" class="title_1" ><b>Password:</b> '.$password.'

</td>
					</tr>
					<tr>
					  <td height="25" colspan="2" align="left" valign="middle" class="title_1" >&nbsp;</td>
					</tr>
					
					 <tr>
							
							<td colspan="2" align="left" valign="middle" class="title_1">
						Your account is currently inactive. You can&apos;t use it until you visit the following link:</td>
						  </tr>
						   <tr>
							
							<td colspan="2" align="left" valign="middle" class="title_1">
						<a href='.$activation_link.' style="color:blue;" target=_blank > Click Here</a></td>
						  </tr>
						 <tr> 
					<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
					<td align="left"  colspan="2" valign="middle" ><span class="normal_blue">Thanks, </span></td>
				  </tr>
				  <tr>
					<td colspan="2"  align="left" >The Admin  Team </td>
					</tr>
				 
				
				</table></td>
			  </tr>
			</table></td>
		  </tr>
		</table></td>
	  </tr>
	</table>
	</body>
	</html>';
	 $subject = 'Welcome to PromusiciansList!';
	 $headers = 'From: '.$from."\r\n";
	 $headers.= 'Reply-To: '.$from."\r\n";
	 $headers.= "MIME-Version: 1.0\r\n";
	 $headers.= "Content-type: text/html; charset=iso-8859-1\r\n";
	 //echo $to_email;	echo $message;exit;
	 @mail($to_email,$subject,$message,$headers);
	}
	function sendAdminmail($type,$name,$fname,$lname)
	{

		global $objSmarty,$config;
			
		$sel="select * from tbl_site";
		$Exe=$this->ExecuteQuery($sel,"select");
		$txtEmail=$Exe[0]['Email'];
		$subject = "New " .$type;
		$imgurl.=$config['SiteGlobalPath']."/admin/img/logo.png";
		$message='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
				<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
			
				<link href="melslifecss.css" rel="stylesheet" type="text/css" />
				</head>
				
				<body style="background:fff">
				<table width="75%" border="0" align="center" cellpadding="5" cellspacing="0" style="background:#fff">
				  <tr>
					<td><img src="'.$imgurl.'" /></td>
				  </tr>
				  <tr>
					<td><hr size="1px" color="#e0e0e0" /></td>
				  </tr>
				  <tr>
					<td><table width="100%"  cellspacing="0" cellpadding="0">
					  <tr>
						<td height="8"></td>
						<td height="8" colspan="2"></td>
					  </tr>
					  
					  
					  <tr>
						<td height="8"></td>
						<td height="8" colspan="2"></td>
					  </tr>
					   <tr>
						<td>&nbsp;</td>
						<td colspan="2" align="left" valign="middle" >
						<span style="font-family: Arial, Helvetica, sans-serif;	font-size: 12px; font-weight: bold;	color: #000000;	text-decoration: none;" ></span>
						'.$fname.' '.$lname.' has created new '.$type.'  name "'.$name.'"</td>
					  </tr>
					<tr>
						<td>&nbsp;</td>
						<td colspan="2" align="left" valign="middle" >
						<span style="font-family: Arial, Helvetica, sans-serif;	font-size: 12px; font-weight: bold;	color: #000000;	text-decoration: none;" ></span>
					Please activate this '.$type.' in admin panel.</td>
					  </tr>
					 
					  <tr>
						<td height="8"></td>
						<td height="8" colspan="2"></td>
					  </tr>
					  
					  <tr>
						<td height="8"></td>
						<td height="8" colspan="2" align="left">Thanks,</td>
					  </tr>
					  <tr>
						<td height="8"></td>
						<td height="8" colspan="2" align="left">Admin  Team</td>
					  </tr>
					  <tr>
						<td height="8"></td>
						<td height="8" colspan="2"></td>
					  </tr>
					</table></td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
				  </tr>
				
				</table>
				</body>
				</html>';

		$headers = 'From: admin@admin.com'."\r\n";

		$headers.= "MIME-Version: 1.0\r\n";
		$headers.= "Content-type: text/html; charset=iso-8859-1\r\n";
		$mail=@mail($txtEmail,$subject,$message,$headers);
			
			

	}
	function getincstatus($id){
		global $objSmarty;
		$sel="select * from tbl_instrument where CreatedBy='".$id."'";
		$ExeSelQuery= $this->ExecuteQuery($sel,"select");
		$objSmarty->assign("incstatus",$ExeSelQuery[0]['Status']);
		$objSmarty->assign("incid",$ExeSelQuery[0]['ID']);
	}

	function getstystatus($id){
		global $objSmarty;
		$sel="select * from tbl_style where CreatedBy='".$id."'";
		$ExeSelQuery= $this->ExecuteQuery($sel,"select");
		$objSmarty->assign("stystatus",$ExeSelQuery[0]['Status']);
		$objSmarty->assign("styid",$ExeSelQuery[0]['ID']);
	}
	function getprofile($id){
		global $objSmarty;
		$sel="select * from tbl_user where UserId='$id'";
		$ExeSelQuery= $this->ExecuteQuery($sel,"select");
		$objSmarty->assign("User",$ExeSelQuery);
	}
 	function getprofile_new($id){
		global $objSmarty;
		$sel="select * from tbl_user where UserId='$id'";
		$ExeSelQuery= $this->ExecuteQuery($sel,"select");
		$objSmarty->assign("Users",$ExeSelQuery);
	}
	function getprofile1($id){
		global $objSmarty;
		$sel="select * from tbl_user where UserId='$id'";
		$ExeSelQuery= $this->ExecuteQuery($sel,"select");
		$objSmarty->assign("User",$ExeSelQuery);
		$timestamp= $ExeSelQuery[0]['CreatedDate'];
		$new_time = explode(" ",$timestamp);
		$get_date = $new_time[0];
		$get_time = $new_time[1];
		$objSmarty->assign("get_date",$get_date);
		/***************** For  progress *****************/

		$sels="select * from tbl_user where UserId='$id'";
		$ExeSelQuerys= $this->ExecuteQuery($sels,"select");
		$objSmarty->assign("Users",$ExeSelQuerys);
		$Total=21;
		$count=0;
		$UserType= $ExeSelQuery[0]['UserType'];
		if($UserType !='')
		{
			$count=$count+1;
		}
		else
		{
			$count=$count-1;
		}
		$FirstName= $ExeSelQuery[0]['FirstName'];
		if($FirstName !='')
		{
			$count=$count+1;
		}
		else
		{
			$count=$count-1;
		}
		$LastName= $ExeSelQuery[0]['LastName'];
		if($LastName !='')
		{
			$count=$count+1;
		}
		else
		{
			$count=$count-1;
		}
		$Email= $ExeSelQuery[0]['Email'];
		if($Email !='')
		{
			$count=$count+1;
		}
		else
		{
			$count=$count-1;
		}
		$Password= $ExeSelQuery[0]['Password'];
		if($Password !='')
		{
			$count=$count+1;
		}
		else
		{
			$count=$count-1;
		}
		$Mobile= $ExeSelQuery[0]['Mobile'];
		if($Mobile !='')
		{
			$count=$count+1;
		}
		else
		{
			$count=$count-1;
		}
		$DOB= $ExeSelQuery[0]['DOB'];
		if($DOB !='')
		{
			$count=$count+1;
		}
		else
		{
			$count=$count-1;
		}
		$Gender= $ExeSelQuery[0]['Gender'];
		if($Gender !='')
		{
			$count=$count+1;
		}
		else
		{
			$count=$count-1;
		}
		$Image= $ExeSelQuery[0]['Image'];
		if($Image !='')
		{
			$count=$count+1;
		}
		else
		{
			$count=$count-1;
		}
		$Country= $ExeSelQuery[0]['Country'];
		if($Country !='0')
		{
			$count=$count+1;
		}
		else
		{
			$count=$count-1;
		}
		$State= $ExeSelQuery[0]['State'];
		if($State !='0')
		{
			$count=$count+1;
		}
		else
		{
			$count=$count-1;
		}
		$City= $ExeSelQuery[0]['City'];
		if($City !='')
		{
			$count=$count+1;
		}
		else
		{
			$count=$count-1;
		}
		$Zip= $ExeSelQuery[0]['Zip'];
		if($Zip !='')
		{
			$count=$count+1;
		}
		else
		{
			$count=$count-1;
		}
		$Company= $ExeSelQuery[0]['Company'];
		if($Company !='')
		{
			$count=$count+1;
		}
		else
		{
			$count=$count-1;
		}
		$Referred= $ExeSelQuery[0]['Referred'];
		if($Referred !='')
		{
			$count=$count+1;
		}
		else
		{
			$count=$count-1;
		}
		$RefMusician= $ExeSelQuery[0]['RefMusician'];
		$RefBusiness = $ExeSelQuery[0]['RefBusiness'];
		if($RefMusician !='' || $RefBusiness !='')
		{
			$count=$count+1;
		}
		else
		{
			$count=$count-1;
		}
	 if( $UserType == 'Musician' || $UserType == 'Musician & Industry' || $UserType == 'Musician & Employer' || $UserType == 'All')
	 {
	 	$Instrument= $ExeSelQuery[0]['Instrument'];
	 	if($Instrument !='')
	 	{
	 		$count=$count+1;
	 	}
	 	else
	 	{
	 		$count=$count-1;
	 	}
	 	$Style= $ExeSelQuery[0]['Style'];
	 	if($Style !='')
	 	{
	 		$count=$count+1;
	 	}
	 	else
	 	{
	 		$count=$count-1;
	 	}
	 }
	 if( $UserType == 'Industry' || $UserType == 'Musician & Industry' || $UserType == 'Employer & Industry' || $UserType == 'All')
	 {
	 $Specialty= $ExeSelQuery[0]['Specialty'];
	 	if($Specialty !='')
	 	{
	 		$count=$count+1;
	 	}
	 	else
	 	{
	 		$count=$count-1;
	 	}
	 }
	 $Description= $ExeSelQuery[0]['Description'];
	 if($Description !='')
	 {
	 	$count=$count+1;
	 }
	 else
	 {
	 	$count=$count-1;
	 }
	 $Influences= $ExeSelQuery[0]['Influences'];
	 if($Influences !='')
	 {
	 	$count=$count+1;
	 }
	 else
	 {
	 	$count=$count-1;
	 }
	 $Equipment= $ExeSelQuery[0]['Equipment'];
	 if($Equipment !='')
	 {
	 	$count=$count+1;
	 }
	 else
	 {
	 	$count=$count-1;

	 }

	 $divide= $count/$Total;
	 $overall=$divide*100;
	 $percentage=round($overall);
	 if($percentage > '100')
	 {
	 	$percentage=100;
	 }
	 if($percentage < '0')
	 {
	 	$percentage=0;
	 }
	 //echo $divide.'<br>'.$percentage.'<br>';
	 //echo $count.$Total;
	 $objSmarty->assign("percentage",$percentage);


	 /***************** For  progress *****************/
	}
	function getphotos($id){
		global $objSmarty;
		$sel="select * from  tbl_photos where UserID='$id'";
		$ExeSelQuery= $this->ExecuteQuery($sel,"select");
		$objSmarty->assign("photos",$ExeSelQuery);
	}
	function getAudio($id){
		global $objSmarty;
		$sel="select * from   tbl_music where UserID='$id' and Status='1' ORDER BY RAND() limit 1";
		$ExeSelQuery= $this->ExecuteQuery($sel,"select");
		$objSmarty->assign("Audios",$ExeSelQuery);
	}
	function getVideo($id){
		global $objSmarty;
		$sel="select * from   tbl_video where UserID='$id' and Display='Yes' and Status='1'";
		$ExeSelQuery= $this->ExecuteQuery($sel,"select");
		$objSmarty->assign("Videos",$ExeSelQuery);
	}
	function youtube($id){
		global $objSmarty;
		$sel="select * from   tbl_video where ID='$id' ";
		$ExeQry= $this->ExecuteQuery($sel,"select");
		$url = $ExeQry[0]['YoutubeUrl'];
		if($url!=''){
			preg_match(
        '/[\\?\\&]v=([^\\?\\&]+)/',
			$url,
			$matches
			);
			$id = $matches[1];
			//print_r($matches);
			$width = '320';
			$height = '175';
			echo $vid= '<object width="' . $width . '" height="' . $height . '"><param name="movie" value="http://www.youtube.com/v/' . $id . '&amp;hl=en_US&amp;fs=1?rel=0"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/' . $id . '&amp;hl=en_US&amp;fs=1?rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="' . $width . '" height="' . $height . '"></embed></object>';

		}
	}
	function getLocalMembers($id){
		global $objSmarty;


		$selquery	= "select * from tbl_user where UserId='$id' ";
		$ExeSelQuery= $this->ExecuteQuery($selquery,"select");
		$latitude=$ExeSelQuery[0]['Latitude'];
		$longitude=$ExeSelQuery[0]['Longitude'];
		if($latitude!=''){
			$sel="select * from   tbl_user where Status='1' and UserId!='$id' and ( 3959 * acos( cos( radians($latitude) ) * cos( radians(Latitude) ) * cos( radians(Longitude) - radians($longitude) )
								+ sin( radians($latitude) ) * sin( radians(Latitude) ) ) ) < '100' ";	
		}else{
			$sel="select * from   tbl_user where Status='1' and UserId!='$id' and Zip='".$ExeSelQuery[0]['Zip']."' ";
		}
		$ExeSelQuery= $this->ExecuteQuery($sel,"select");
		$objSmarty->assign("local",$ExeSelQuery);
	}
	/*========== Changing the password ===========*/
	function changePword()
	{
		global $objSmarty,$config;

		if($this->chkPassword($_REQUEST['txtCurPwd'], $_SESSION['UserId']))
		{
			$UpQuery = "UPDATE `tbl_user` SET `Password` = '".addslashes($_REQUEST['txtNewPwd'])."'"
			." WHERE `UserId` = ". $_SESSION['UserId'];
			$UpResult	= $this->ExecuteQuery($UpQuery, "update");
			$objSmarty->assign("SuccessMessage", "Password has been updated successfully");
			$objSmarty->assign("ErrorMessage", "");
			$select_password ="SELECT * FROM `tbl_user`";
			$result =$this->ExecuteQuery($select_password,"select");
			$objSmarty->assign("current_password",$result);
		}
		else
		{
			$objSmarty->assign("ErrorMessage", "Invalid current password");
		}
	}
	function getLastview($id){
		global $objSmarty;
	 $sel="select v.*,u.Image,u.Gender from   tbl_view v,tbl_user u where u.UserId=v.LoginID and ViewID='$id' ";
	 $ExeSelQuery= $this->ExecuteQuery($sel,"select");
	 $objSmarty->assign("View",$ExeSelQuery);
	}
	/*==================*/
	/*************** BY SM *******************/
	function getLocalMembers_connection($id){
		global $objSmarty;


		$selquery	= "select * from tbl_user where UserId='$id' ";
		$ExeSelQuery= $this->ExecuteQuery($selquery,"select");
		$latitude=$ExeSelQuery[0]['Latitude'];
		$longitude=$ExeSelQuery[0]['Longitude'];
		if($latitude!=''){
			$sel="select * from   tbl_user where Status='1' and UserId!='$id' and ( 3959 * acos( cos( radians($latitude) ) * cos( radians(Latitude) ) * cos( radians(Longitude) - radians($longitude) )
								+ sin( radians($latitude) ) * sin( radians(Latitude) ) ) ) < '100' ";	
		}else{
			$sel="select * from   tbl_user where Status='1' and UserId!='$id' and Zip='".$ExeSelQuery[0]['Zip']."' ";
		}
		$ExeSelQuery= $this->ExecuteQuery($sel,"select");
		$count= count($ExeSelQuery);
		//echo $count.'test';
		$objSmarty->assign("local_count",$count);
		$objSmarty->assign("local",$ExeSelQuery);
	}

	function getLastview_connection($id){
		global $objSmarty;
	 $sel="select v.*,u.Image,u.Gender,u.FirstName,u.LastName from   tbl_view v,tbl_user u where u.UserId=v.LoginID and ViewID='$id' ";
	 $ExeSelQuery= $this->ExecuteQuery($sel,"select");
	 $count= count($ExeSelQuery);
	 //echo $count.'test';
	 $objSmarty->assign("View_count",$count);
	 $objSmarty->assign("View",$ExeSelQuery);
	}

	function getVideo_connection($id){
		global $objSmarty;
		$sel="select * from   tbl_video where UserID='$id' and Display='Yes' and Status='1' order by `CreatedDate` DESC";
		$ExeSelQuery= $this->ExecuteQuery($sel,"select");
		$count= count($ExeSelQuery);
		//echo $count.'test';
		$objSmarty->assign("Video_count",$count);
		$objSmarty->assign("Videos",$ExeSelQuery);
	}
	function youtubes($id){
		global $objSmarty;
		$sel="select * from   tbl_video where ID='$id' ";
		$ExeQry= $this->ExecuteQuery($sel,"select");
		$url = $ExeQry[0]['YoutubeUrl'];
		if($url!=''){
			preg_match(
        '/[\\?\\&]v=([^\\?\\&]+)/',
			$url,
			$matches
			);
			$id = $matches[1];
			//print_r($matches);
			$width = '200';
			$height = '180';
			echo $vid= '<object class="user-video"><param name="movie" value="http://www.youtube.com/v/' . $id . '&amp;hl=en_US&amp;fs=1?rel=0"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/' . $id . '&amp;hl=en_US&amp;fs=1?rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" class=user-videos></embed></object>';

		}
	}

	function getphotos_connection($id){
		global $objSmarty;
		$sel="select * from  tbl_photos where UserID='$id' order by `CreatedDate` DESC";
		$ExeSelQuery= $this->ExecuteQuery($sel,"select");
		$count= count($ExeSelQuery);
		//echo $count.'test';
		$objSmarty->assign("UId",$id);
		$objSmarty->assign("Photo_count",$count);
		$objSmarty->assign("photos",$ExeSelQuery);
	}

	function getAudio_connection($id){
		global $objSmarty;
		$sel="select * from   tbl_music where UserID='$id' and Status='1' ORDER BY CreatedDate DESC";
		$ExeSelQuery= $this->ExecuteQuery($sel,"select");
		$count= count($ExeSelQuery);
		//echo $count.'test';
		$objSmarty->assign("Audio_count",$count);
		$objSmarty->assign("Audios",$ExeSelQuery);
	}
	function getjoblist_connection($id)
	{
		global $objSmarty;
		$sql="select * from tbl_job where EmployerId='$id'";
		$ExeInsQuery=$this->ExecuteQuery($sql,"select");
		$count= count($ExeInsQuery);
		//echo $count.'test';
		$objSmarty->assign("Job_count",$count);
		$objSmarty->assign("joblist", $ExeInsQuery);
	}
 	function getjobalert($id)
	{
		global $objSmarty;
		$sql="select * from tbl_jobapplications where Employer_ID='$id' and IsReviewed='0' and  Dismiss!='1'";
		$ExeInsQuery=$this->ExecuteQuery($sql,"select");
		$count= count($ExeInsQuery);
		//echo $count.'test';
		$objSmarty->assign("alert_count",$count);
		$objSmarty->assign("alertlist", $ExeInsQuery);
	}
	
	
	function getusernameByPhotoid($id)
	{
		global $objSmarty;
		$sql="select * from tbl_user where UserId='$id'";
		$ExeInsQuery=$this->ExecuteQuery($sql,"select");

		$count= count($ExeInsQuery);
		//echo $count.'test';
		$name=$ExeInsQuery[0]['FirstName'].$ExeInsQuery['LastName'];
		$objSmarty->assign("name",$name);
		//$objSmarty->assign("joblist", $ExeInsQuery);


	}

	function getsettingByid($id)
	{
		global $objSmarty;
		$sql="select * from tbl_settings where UserId='$id'";
		$ExeInsQuery=$this->ExecuteQuery($sql,"select");
		$limit= $ExeInsQuery[0]['num_pages'];
		//echo $limit;

		$objSmarty->assign("settingslist", $ExeInsQuery);

	}

	function updateSettings()
	{
		global $objSmarty;

		$sel="select * from tbl_settings  WHERE `UserId` = '".$_SESSION['UserId']."'";
		$res=$this->ExecuteQuery($sel, "norows");
		// print_r($_REQUEST);
		/*if(count($_REQUEST['profile_page'])!='0')
		{
			
		$profile_page=implode(',',$_REQUEST['profile_page']);


		}
		else{
		$profile_page='';
			
		}*/
		if($res==0){

			$InsQuery1="INSERT INTO `tbl_settings` (
												`UserId`,
												`profile_page`,
												`num_pages`,
												`CreatedDate`
											)
												 VALUES (
												 '".$_SESSION['UserId']."',
												 '".addslashes($_REQUEST['profile_page'])."',
												 '".addslashes($_REQUEST['num_pages'])."',
												 now()
												 )";

		 $resv=$this->ExecuteQuery($InsQuery1, "insert");
		 $objSmarty->assign("SuccessMessage", "Setting has been added successfully");
		}else{
			$UpQuery = "UPDATE `tbl_settings` SET
			`profile_page`='".addslashes($_REQUEST['profile_page'])."',
			`num_pages`='".addslashes($_REQUEST['num_pages'])."',
			`CreatedDate`=Now()"
			." WHERE `UserId` = ".$_SESSION['UserId'];
			$UpResult	= $this->ExecuteQuery($UpQuery, "update");
			$objSmarty->assign("SuccessMessage", "Setting has been updated successfully");
		}

	}

	function GetSettings($id)
	{
		global $objSmarty;
		$UserType=$_SESSION['UserType'];
			//echo $UserType;
			//print_r($_SESSION);
		/*$SelQuery="select * from tbl_settings where UserId='$id'";
		$SelResult	= $this->ExecuteQuery($SelQuery, "select");
		if(!empty($SelResult))
		{
			$pos = strpos($UserType, '&');
			if ($pos == true) {
				echo 'yes';
				$UserTypes = explode("&",$UserType);
				foreach($UserTypes as $UserType) {
					$UserType = trim($UserType);
					echo $UserType;
					if($UserType == $utype)
					{
						$sql="select * from tbl_settings where UserId='$id' and
		  				profile_page='$UserType'";	
						$ExeInsQuery=$this->ExecuteQuery($sql,"select");
						if(!empty($ExeInsQuery))
						{
							$type='1';
							if($ExeInsQuery[0]['profile_page'] == 'ALL')
							{
								$type='1';
							}

						}
						else
						{
							$type='1';
						}
					}
				}
			}
			else
			{
				echo 'no';
				$sqls="select * from tbl_settings where UserId='$id' and 
		FIND_IN_SET('$UserType', profile_page)";	
				$ExeInsQuerys=$this->ExecuteQuery($sqls,"select");
				if(!empty($ExeInsQuerys))
				{
					$type='1';
				if($ExeInsQuerys[0]['profile_page'] == 'ALL')
					{
						$type='1';
					}
				}
				else
				{
					$type='1';
				}
			
					
			}
			
		}
		else
		{
			$type='1';
		}*/
		$pos = strpos($UserType, '&');
			if ($pos == true) {
				//echo 'yes';
		$SelQuery="select * from tbl_settings where UserId='$id'";
		$SelResult	= $this->ExecuteQuery($SelQuery, "select");
		if(!empty($SelResult))
		{
			
				//echo 'yes-new';
				$UserTypes = explode("&",$UserType);
				foreach($UserTypes as $UserType_new) {
					//$UserType = trim($UserType);
					//  echo $UserType_new.$UserType;
					
						echo $sql="select * from tbl_settings where UserId='$id' and
		  				FIND_IN_SET('$UserType_new', profile_page)";
						$ExeInsQuery=$this->ExecuteQuery($sql,"select");
						if(!empty($ExeInsQuery))
						{
							$type='1';
							if($ExeInsQuery[0]['profile_page'] == 'ALL')
							{
								$type='1';
							}

						}
						else
						{
							$type='1';
						}
					}
							}
			else
				{
					$type='1';
				}
			}
			else
			{
				//echo $UserType;
				//echo 'no';
				$sqls="select * from tbl_settings where UserId='$id' and 
		FIND_IN_SET('$UserType', profile_page)";	
				$ExeInsQuerys=$this->ExecuteQuery($sqls,"select");
				if(!empty($ExeInsQuerys))
				{
					$type='1';
				if($ExeInsQuerys[0]['profile_page'] == 'ALL')
					{
						$type='1';
					}
				}
				else
				{
					$type='1';
				}
			
					
			}	
		//echo $type;
		$objSmarty->assign("type", $type);

	}

	function GetSettings_review($id,$UserType)
	{
		global $objSmarty;
		//$UserType=$_SESSION['UserType'];
			
		$SelQuery="select * from tbl_settings where UserId='$id'";
		$SelResult	= $this->ExecuteQuery($SelQuery, "select");
		$utype=$SelResult[0]['message'];
		if(!empty($SelResult))
		{
			//$categories = '';
			$UserTypes = explode("&",$UserType);
			foreach($UserTypes as $UserType) {
				$UserType = trim($UserType);
				//echo $UserType;
				if($UserType == $utype)
				{
					$sql="select * from tbl_settings where UserId='$id' and
		 message='$UserType'";	
					$ExeInsQuery=$this->ExecuteQuery($sql,"select");
					if(!empty($ExeInsQuery))
					{
						$type='1';
						if($ExeInsQuery[0]['message'] == 'ALL')
						{
							$type='1';
						}

						else
						{
							$type='0';
						}
					}
					else
					{
						$type='1';
					}
				}
			}
		}
		else
		{
			$type='1';
		}
		$objSmarty->assign("type", $type);
	}

		
function AllTestimonials()
	{
		global $objSmarty;
		$sql="select * from tbl_review  r, tbl_user u  where r.UserID=u.UserId and r.ToID='".$_SESSION['UserId']."'";
		$ExeInsQuery=$this->ExecuteQuery($sql,"select");
		$objSmarty->assign("Reviews", $ExeInsQuery);
		$count= $this->ExecuteQuery($sql,"norows");
		$objSmarty->assign("count", $count);
	}
	
function review_order()
{
	global $objSmarty;
	//print_r($_REQUEST['page']);exit;
$InsQuery	= " UPDATE `tbl_review`  SET
				 `OrderBy`='".$temp."'
				 $imagePath
		        where `UserId` = '".$_SESSION['UserId']."' "; 

}	
	
	/*************** BY SM *******************/


	function chkPassword($CurPwd)
	{
		global $objSmarty,$config;
		$SelQuery	= "SELECT `UserId` FROM `tbl_user`"
		." WHERE binary `Password` = '".$CurPwd."' AND `UserId` = '". $_SESSION['UserId']."' ";
		$SelResult	= $this->ExecuteQuery($SelQuery, "select");
		if(!empty($SelResult) && !empty($SelResult[0]['UserId']))
		return true;
		else
		return false;
	}



	//----------------------------Refer Friends-------------------------------------/////////////////////////
	function Refer_friends()
	{
		global $objSmarty,$config;
		$fromname=$_SESSION['FirstName'].' '.$_SESSION['LastName'];
		$name=$_REQUEST['fname'];
		$to=$_REQUEST['email'];
		$sqlQuery="select * from tbl_mailcontent where Id='1' and Status='1'";
		$Results = $this->ExecuteQuery($sqlQuery, "select");
		$subject=$Results[0]['Subject'];
		$message=$Results[0]['Message']; 
		//$subject='OMG… Pro Musician’s List is exactly what musicians need. Just Sign Up!!';
		//$message=$_REQUEST['message'];
		$sql="select * from tbl_site where Id='1'";
		$Result	= $this->ExecuteQuery($sql, "select");
		$from=$Result[0]['Email'];
		
		$imgurl="".$config['SiteGlobalPath']."/admin/img/logo.png";
		$activation_link=$config['SiteGlobalPath'].'/register.php?rid='.$_SESSION['UserId'];
		$mess='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
			<title>Donisde</title>
			<style type="text/css">
			<!--
			.style1 {
				font-size: 16px;
				font-weight: bold;
			}
			-->
			</style>
			</head>
			
			<body>
			<table width="700" border="0" cellspacing="0" cellpadding="7">
			  <tr>
			    <td bgcolor="#000000"><table width="100%" border="0" cellspacing="0" cellpadding="0">
			      <tr>
			        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
			          <tr>
			            </tr>
			          <tr>
			            <td height="35" align="center" bgcolor="#FFFFFF" class="normal_txt7"><table width="97%"  cellspacing="4" cellpadding="4" style="font-family:Verdana; font-size:12px;">
			              <tr>
			                <td height="25" colspan="2"><img src="'.$imgurl.'" border="0" /></td>
			                </tr>
			             
			              <tr>
			               
			                <td colspan="2" width="83%" height="25" align="left" valign="middle" bgcolor="#F8F8F8" >
			                <span class="normal_blue">Hi '.$name.'</span></td>
			                </tr>
							<tr>
			             
			                <td colspan="2" height="25" align="left" valign="middle" bgcolor="#F8F8F8" ><span class="normal_blue"> 
			                Because YOU are a professional musician, '.$fromname.' has referred you and would like for you to join (him/her) on Pro Musician’s List.</span></td>
			                </tr>
			                <tr>
			              
			                <td colspan="2" height="25" align="left" valign="middle" bgcolor="#F8F8F8" >
			                <span class="normal_blue">'.$message.'</span></td>
			                </tr>
							<tr>
			              
			                <td colspan="2" height="25" align="left" valign="middle" bgcolor="#F8F8F8" >
			                Please click the link below to register and create your profile.</td>
			                </tr>
			                <tr>
			             
			                <td colspan="2" height="25" align="left" valign="middle" bgcolor="#F8F8F8" >
			                <a href='.$activation_link.'>Click Here</a></td>
			                </tr>
			                 <tr>
						<td height="8"></td>
						<td height="8" colspan="2"></td>
					  </tr>
					  
					  <tr>
						
						<td height="8" colspan="2" align="left">Thanks,</td>
					
					  </tr>
					  <tr>
						
						<td height="8" colspan="2" align="left">Admin</td>
					
					  </tr>
					  <tr>
						<td height="8"></td>
						<td height="8" colspan="2"></td>
					  </tr>
					 
			            </table></td>
			          </tr>
			        </table></td>
			      </tr>
			    </table></td>
			  </tr>
			</table>
			</body>
			</html>';
		//echo $mess;
		/*$headers .= "From: ".$from."\r\n";
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		@mail($to,$subject,$mess,$headers);*/
		$headers = 'From: info@promusicianslist.com'."\r\n";
		$headers.= "MIME-Version: 1.0\r\n";
		$headers.= "Content-type: text/html; charset=iso-8859-1\r\n";
		$mail=@mail($to,$subject,$mess,$headers);
		$objSmarty->assign("SuccessMessage", "Friend has been invited successfully");
	}


	//---------------------------------SEARCH RESULTS--------------------------------------//////////////////////////
	function Searchresults()
	{
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['searchfor']=='Musician'){

			$where_condition.=" and `UserType` !='Employer'  ";
		}
		if($_REQUEST['searchfor']=='Employer'){

			$where_condition.=" and `UserType` !='Musician'  ";
		}
		if($_REQUEST['fname']!=''){

			$where_condition.=" and `FirstName` like '%".addslashes(trim($_REQUEST['fname']))."%' ";
		}

		if($_REQUEST['lname']!=''){

			$where_condition.=" and `LastName` like '%".addslashes(trim($_REQUEST['lname']))."%' ";
		}
		if($_REQUEST['gender']!=''){

			$where_condition.=" and `Gender` ='".$_REQUEST['gender']."' ";
		}

		if($_REQUEST['country']!='0'){

			$where_condition.=" and `Country` ='".$_REQUEST['country']."' ";
		}

		if($_REQUEST['state']!='0'){

			$where_condition.=" and `State` ='".$_REQUEST['state']."' ";
		}

		if($_REQUEST['city']!=''){

			$where_condition.=" and `City` like '%".addslashes(trim($_REQUEST['city']))."%' ";
		}
		if($_REQUEST['zip']!=''){

			$where_condition.=" and `Zip` like '%".addslashes(trim($_REQUEST['zip']))."%' ";
		}

		if($_REQUEST['instrument']!='0'){

			$where_condition.=" and FIND_IN_SET('".$_REQUEST['instrument']."',`Instrument`) ";
		}

		if($_REQUEST['style']!='0'){

			$where_condition.=" and FIND_IN_SET('".$_REQUEST['style']."',`Style`) ";
		}
		$selquery	= "select * from `tbl_user` where Status='1' "
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
		$page_rows = 10;
		$last = ceil($resultns/$page_rows);
		$max = 'limit ' .($pagec - 1) * $page_rows .',' .$page_rows;

		$Res_Tickets=$this->ExecuteQuery($selquery.''.$max, "select");
		//echo "<pre>";
		//print_r($Res_Tickets);
		$resultn= $this->ExecuteQuery($selquery.''.$max,"norows");
		$objSmarty->assign("UserList",$Res_Tickets);

		$n=$resultns;

		if($n<=10)
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
			$start=($s-1)*10+1;
		}
		$end=$s*10;
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



	//---------------------------------SEARCH RESULTS--------------------------------------//////////////////////////
	function Searchresults_jobs()
	{
		global $objSmarty,$objPage;
		$where_condition="";
		$where_condition1="";
		if($_REQUEST['postby']!=''){

			$where_condition.=" and j.Name like '%".addslashes(trim($_REQUEST['postby']))."%' ";
		}

		if($_REQUEST['gender']=='Male' || $_REQUEST['gender']=='Female'){

			$where_condition.=" and j.Gender ='".$_REQUEST['gender']."' ";
		}


		if($_REQUEST['country']!='0' && $_REQUEST['country']!=''){

			$where_condition.=" and j.Country ='".$_REQUEST['country']."' ";
		}

		if($_REQUEST['state']!='0' && $_REQUEST['state']!=''){

			$where_condition.=" and j.State ='".$_REQUEST['state']."' ";
		}
		if($_REQUEST['scity']!=''){
		 $expcity=explode(',',$_REQUEST['scity']);
		 $city=$expcity[0];
		 $state1=$expcity[1];
		 //$where_condition.=" and j.City like '%".addslashes(trim($city))."%' ";
			$cityquery	= 'SELECT ci.id as cityId, s.id as stateId, co.code as country FROM cities ci INNER JOIN states s ON ci.state_id = s.id INNER JOIN countries co ON co.code = s.country where ci.name = "'. mysql_real_escape_string($city) .'" and s.name = "'. mysql_real_escape_string($state1) .'" LIMIT 1';
			$ExeCityQuery= $this->ExecuteQuery($cityquery,"norows");		 
			if($ExeCityQuery > 0){		
				$cityDetail	= $this->ExecuteQuery($cityquery, "select");
				$where_condition.=" and j.Country='".$cityDetail[0]['country']."' ";
				$where_condition.=" and j.State='".$cityDetail[0]['stateId']."' ";	
				$where_condition.=" and j.City='".$cityDetail[0]['cityId']."' ";	
			}			 
		}
		if($_REQUEST['city']!='' && $_REQUEST['city']!='0'){

			$where_condition.=" and j.City ='".addslashes(trim($_REQUEST['city']))."' ";
		}
		if($_REQUEST['zip']!=''){

			$where_condition.=" and j.Zip like '%".addslashes(trim($_REQUEST['zip']))."%' ";
		}
		if($_REQUEST['experience']!='' && $_REQUEST['experience']!='0'){

			//$where_condition.=" and j.Experience ='".$_REQUEST['experience']."' ";
			$where_condition.=" and FIND_IN_SET('".$_REQUEST['experience']."',j.Experience) ";
		}
		if($_REQUEST['job_pay']!=''){

			$where_condition.=" and j.Pay ='".$_REQUEST['job_pay']."' ";
		}
		if($_REQUEST['rating']!=''){

			$where_condition.=" and j.Rating >='".$_REQUEST['rating']."' ";
		}
		if($_REQUEST['radius']!=''){

			$where_condition.=" and j.Radius ='".$_REQUEST['radius']."' ";
		}
		/*if($_REQUEST['age']!='' && $_REQUEST['age']!='0'){

		$where_condition.=" and j.Age ='".$_REQUEST['age']."' ";
		}*/
		/*if($_REQUEST['fromage']!='' && $_REQUEST['toage']!=''){

			$where_condition.=" and ((j.FromAge>='".$_REQUEST['fromage']."' and j.FromAge<='".$_REQUEST['toage']."') or
(j.ToAge>='".$_REQUEST['fromage']."' and j.ToAge<='".$_REQUEST['toage']."') or j.Age='Any') ";
		}*/
		
		
		
		
		$sel="select * from tbl_age where Id!=''";
		$results=mysql_query($sel);
		$resCnt=mysql_num_rows($results);
		while ($row=mysql_fetch_array($results)){
		//echo $row['Id'];
		if($_REQUEST['fromage']!='' && $_REQUEST['toage']!='')
		{			
		if($_REQUEST['fromage']>=$row['age_from'] && $_REQUEST['fromage']<=$row['age_to'])
		{
			$arr[]=$row['Id'];
			//echo $row['Id'].'cond1<br>';
		}
		if($_REQUEST['toage']<=$row['age_to'])	
		{
			if($_REQUEST['toage']>=$row['age_from'])
			{
			$arr[]=$row['Id'];
			//echo $row['Id'].'cond2<br>';
			}
		}
		else 
		{
			
		$arr[]=$row['Id'];
			//echo $row['Id'].'cond3<br>';
		}
		array_push($arr, "1");
		//echo $arr;
		$arrayres = array_unique($arr);
		
		}		
		}
		
		$agebetween=$arrayres;
		if (!empty($agebetween))
		{	
	   foreach ($agebetween as  $between) {
	   	if ($between === reset($agebetween))
	   	{
	   		
	   		$start='and (';
	   	}
	   	else 
	   	{
	   		$start=' ';
	   		
	   	}
	   	if ($between === end($agebetween))
	   	{
	   		//echo 'LAST ELEMENT!';
	   		$either=')';
	   	}else{	
	   		$either='or';
	   	}
	   //echo $val,'<br>';
	  $where_condition2.=" $start FIND_IN_SET ('".$between."',j.`Age_new`) $either ";
   
       }
	} 
	 //echo $where_condition2;
		//print_r($arrayres);
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
	  $where_condition1.=" $strt FIND_IN_SET ('".$val."',j.`Instrument`) $or ";
   
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
	  $where_condition1.=" $strts FIND_IN_SET ('".$vals."',j.`Style`) $ors ";
   
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
	  $where_condition1.=" $strs FIND_IN_SET ('".$valus."',j.`Specialty`) $orus ";
   
       }
	}
		/*************** BY SM *******************/
	
	
		$selquery	= "select u.UserType,u.FirstName,u.LastName,u.Image,j.* from tbl_job j,
		tbl_user u  where j.Status='1' and j.EmployerId=u.UserId "
		."$where_condition"."$where_condition1 $where_condition2 group by j.JobID " ;

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
		//$page_rows = 12;
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
		$objSmarty->assign("ser",'1');
	}

	function GetRatings($ID)
	{
		global $objSmarty;

		$SelQuery	= "SELECT * FROM `tbl_job` where JobID=$ID";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");


		$starfilled=$ExeSelQuery[0]['Rating'];
		$starfilledexp = explode(".", $starfilled);
		$from=$starfilledexp[0];

		for($i=1; $i<=$from; $i++)
		{
			echo "<img src='images/star-4.png' width='20' height='20' border='0'>";
		}
			
		$isHalf=$starfilledexp[1];
		if($isHalf=='5' || $isHalf=='6' || $isHalf=='7')
		{
			echo "<img src='images/star-2.png' width='20' height='20' border='0'>";

			$to=5-$from;
			//echo $to;
			for($j=2; $j<=$to; $j++)
			{
				echo "<img src='images/star-0.png' width='20' height='20' border='0'>";
			}
		}
		else if($isHalf=='1' || $isHalf=='2' || $isHalf=='3')
		{
			echo "<img src='images/star-01.png' width='20' height='20' border='0'>";

			$to=5-$from;
			//echo $to;
			for($j=2; $j<=$to; $j++)
			{
				echo "<img src='images/star-0.png' width='20' height='20' border='0'>";
			}
		}
		else if($isHalf=='8' || $isHalf=='9' )
		{
			echo "<img src='images/star-03.png' width='20' height='20' border='0'>";

			$to=5-$from;
			//echo $to;
			for($j=2; $j<=$to; $j++)
			{
				echo "<img src='images/star-0.png' width='20' height='20' border='0'>";
			}
		}
		else
		{
			$to=5-$from;

			for($j=1; $j<=$to; $j++)
			{
				echo "<img src='images/star-0.png' width='20' height='20' border='0'>";
			}
		}

			
			
		$objSmarty->assign("StarFill",$from);
			
		$objSmarty->assign("PartnerVals",$ExeSelQuery);
	}

	function searchfilter_new()
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


		if($_REQUEST['fromage']!='' && $_REQUEST['toage']!=''){
			if($_REQUEST['fromage']=='50' || $_REQUEST['toage']=='50'){
				$where_condition.="and u.Age >= ".$_REQUEST['fromage']." ";
			}else{
				$where_condition.="and u.Age between ".$_REQUEST['fromage']." and ".$_REQUEST['toage']." ";
			}
		}
		if($_REQUEST['ty']=='1'){

			$where_condition.=" and u.UserType!= 'Employer'  and u.UserType!= 'Industry' and u.UserType!= 'Employer & Industry'";
		}
		if($_REQUEST['ty']=='2'){
			$where_condition.="and u.UserType!= 'Musician'  and u.UserType!= 'Industry' and u.UserType!= 'Musician & Industry'   ";
		}
		if($_REQUEST['ty']=='3'){
			$where_condition.=" and u.UserType!= 'Musician'  and u.UserType!= 'Employer' and u.UserType!= 'Musician & Employer'   ";
		}
		if($_REQUEST['search_key']!='')
		{
			 
			$where_condition.=" and (u.UserType like '%".$_REQUEST['search_key']."%' ";
			$where_condition.=" or u.Zip like '%".$_REQUEST['search_key']."%' ";
			$where_condition.=" or u.State like '%".$_REQUEST['search_key']."%' ";
			$where_condition.=" or u.Email like '%".$_REQUEST['search_key']."%' ";
			$where_condition.=" or u.Mobile like '%".$_REQUEST['search_key']."%' ";
			$where_condition.=" or u.Company like '%".$_REQUEST['search_key']."%' ";
			$where_condition.=" or u.Referred like '%".$_REQUEST['search_key']."%' ";
			$where_condition.=" or u.RefMusician like '%".$_REQUEST['search_key']."%' ";
			$where_condition.=" or u.RefBusiness like '%".$_REQUEST['search_key']."%' ";
			$where_condition.=" or FIND_IN_SET('".$_REQUEST['search_key']."',u.Instrument) ";
			$where_condition.=" or FIND_IN_SET('".$_REQUEST['search_key']."',u.Style) ";
			$where_condition.=" or u.FirstName like '%".addslashes($_REQUEST['search_key'])."%'
							or   u.LastName like '%".addslashes($_REQUEST['search_key'])."%'";
			$where_condition.=" or u.Description like '%".addslashes($_REQUEST['search_key'])."%'";
			$where_condition.=" or u.Influences like '%".addslashes($_REQUEST['search_key'])."%'";
			$where_condition.=" or d1.Title like '%".addslashes($_REQUEST['search_key'])."%'";
			$where_condition.=" or c1.Title like '%".addslashes($_REQUEST['search_key'])."%'";
				
			$where_condition.=" or u.Equipment like '%".addslashes($_REQUEST['search_key'])."%')";
		}
		
		if($_REQUEST['scity']!=''){
		 $expcity=explode(',',$_REQUEST['scity']);
		 $city=$expcity[0];
		 $where_condition.=" and u.City like '%".addslashes(trim($city))."%' ";
		 	
		}
		if($_REQUEST['city']!=''){

			$where_condition.=" and u.City like '%".addslashes(trim($_REQUEST['city']))."%' ";
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
		if($_REQUEST['state']!='' && $_REQUEST['state']!='0'){

			$where_condition.=" and u.State='".$_REQUEST['state']."' ";
		}
		if($_REQUEST['fname']!=''){

			$where_condition.=" and u.FirstName like '%".addslashes(trim($_REQUEST['fname']))."%'  or  u.LastName like '%".addslashes(trim($_REQUEST['fname']))."%'";
		}

		
		if($_REQUEST['gender']=='Male' || $_REQUEST['gender']=='Female'){

			$where_condition.=" and u.Gender ='".$_REQUEST['gender']."' ";
		}
		if($_REQUEST['radius']!=""  && $_REQUEST['latitude']!="" && $_REQUEST['longitude']!=""){
			$latitude=$_REQUEST['latitude'];
			$longitude=$_REQUEST['longitude'];
			$where_condition.=" and ( 3959 * acos( cos( radians($latitude) ) * cos( radians(u.Latitude) ) * cos( radians(u.Longitude) - radians($longitude) )
								+ sin( radians($latitude) ) * sin( radians(u.Latitude) ) ) ) < '".$_REQUEST['radius']."' ";
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

		//print_r($_REQUEST['profile']) 	;
			
		if($_REQUEST['profile']=='' ){
			$selquery	= "select * from tbl_user u
			LEFT JOIN tbl_music c1 ON (c1.UserID=u.UserId)
			LEFT JOIN tbl_video d1 ON (u.UserId=d1.UserID)
			where u.Status='1' 
			and u.MailStatus='1' and u.UserId!='".$_SESSION['UserId']."'"
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
					$selquery	= "select u.UserId,u.FirstName,u.LastName,u.Image,u.Gender,u.State,u.City,u.Zip,u.Status,u.MailStatus,
					u.UserType,u.Instrument,u.Style,u.rating,u.Age,
					b1.UserID,c1.UserID,d1.UserID from tbl_user u 
					LEFT JOIN tbl_photos b1 ON (b1.UserID=u.UserId)
					LEFT JOIN tbl_music c1 ON (c1.UserID=u.UserId)
					LEFT JOIN tbl_video d1 ON (u.UserId=d1.UserID) where b1.UserID !='NULL' 
					and c1.UserID !='NULL' and d1.UserID !='NULL' and  u.UserId!='".$_SESSION['UserId']."'and u.Status='1' and u.MailStatus='1'"
					."$where_condition". "$where_condition1  group by u.UserId
					";	
				}
				else if($_REQUEST['profile'][$g]=='Any' ){
					$qur[]	= "select u.*,p.UserID from tbl_user u, tbl_photos p  where u.Status='1' and u.MailStatus='1' and p.UserID=u.UserId  and u.UserId!='".$_SESSION['UserId']."'"
					."$where_condition". "group by p.UserID  union select u.*,a.UserID from tbl_user u,  tbl_music a  where u.Status='1' and u.MailStatus='1' and a.UserID=u.UserId  and u.UserId!='".$_SESSION['UserId']."'"
					."$where_condition". "group by a.UserID union select u.*,v.UserID from tbl_user u,   tbl_video v  where u.Status='1' and u.MailStatus='1' and v.UserID=u.UserId  and u.UserId!='".$_SESSION['UserId']."'"
					."$where_condition". "$where_condition1  group by v.UserID ";
				}
				else if($_REQUEST['profile'][$g]=='Image'  ){
					$qur[]	= "select u.*,p.UserID from tbl_user u, tbl_photos p  where u.Status='1' and u.MailStatus='1' and p.UserID=u.UserId  and u.UserId!='".$_SESSION['UserId']."'"
					."$where_condition". " $where_condition1 group by p.UserID ";
				}
					
				else if($_REQUEST['profile'][$g]=='Audio' ){
					$qur[]	= "select u.*,a.UserID from tbl_user u,  tbl_music a  where u.Status='1' and u.MailStatus='1' and a.UserID=u.UserId  and u.UserId!='".$_SESSION['UserId']."'"
					."$where_condition". "$where_condition1  group by a.UserID ";
				}
				else  if($_REQUEST['profile'][$g]=='Video' ){
					$qur[]	= "select u.*,v.UserID from tbl_user u,   tbl_video v  where u.Status='1' and u.MailStatus='1' and v.UserID=u.UserId  and u.UserId!='".$_SESSION['UserId']."'"
					."$where_condition". "$where_condition1  group by v.UserID ";
				}
					
			}
			if($qur!=''){
				$selquery=implode(" union ",$qur);
			}
			//echo $selquery;
		}
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
		//$page_rows = 12;
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




	function favjobs()
	{
		global $objSmarty,$objPage;

		$selquery	= "select u.UserType,u.FirstName,u.LastName,u.Image,j.*, f.* from tbl_favjob f,tbl_job j,tbl_user u where f.UserId='".addslashes($_SESSION['UserId'])."' and j.JobID=f.JobId and j.EmployerId=u.UserId ";

			

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
		$page_rows = 10;
		$last = ceil($resultns/$page_rows);
		$max = 'limit ' .($pagec - 1) * $page_rows .',' .$page_rows;

		$Res_Tickets=$this->ExecuteQuery($selquery.''.$max, "select");
		//echo "<pre>";
		//print_r($Res_Tickets);
		$resultn= $this->ExecuteQuery($selquery.''.$max,"norows");
		$objSmarty->assign("FavList",$Res_Tickets);

		$n=$resultns;

		if($n<=10)
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
			$start=($s-1)*10+1;
		}
		$end=$s*10;
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
	function Delete_favjob($id)
	{
		global $objSmarty;
		$UpQuery="DELETE FROM tbl_favjob"
		. " WHERE ID = '$id'";
		$ExeUpQuery= $this->ExecuteQuery($UpQuery,"delete");
		$objSmarty->assign("SuccessMessage","Job has been removed from your favorite list");
	}
	function Delete_favemp($id)
	{
		global $objSmarty;
		$UpQuery="DELETE FROM tbl_favemp"
		. " WHERE ID = '$id'";
		$ExeUpQuery= $this->ExecuteQuery($UpQuery,"delete");
		//$objSmarty->assign("SuccessMessage","Job has been removed from your favorite list");
	}
	function Delete_favemp_new($id)
	{
		global $objSmarty;
		$UpQuery="DELETE FROM tbl_favemp"
		. " WHERE FavID = '$id' and UserId = '".$_SESSION['UserId']."'";
		$ExeUpQuery= $this->ExecuteQuery($UpQuery,"delete");
		header('location:favemp.php');
		//$objSmarty->assign("SuccessMessage","Job has been removed from your favorite list");
	}

	function addfavemp()
	{
		global $objSmarty;
		$InsQuery	= "INSERT INTO `tbl_favemp`
						   (
							 `UserId`, `FavID`,`FavType`, `Date`
							) 
							VALUES
							(
								'".addslashes($_SESSION['UserId'])."',
								'".addslashes($_REQUEST['fid'])."',
								'".addslashes($_REQUEST['ftype'])."',
								now()
							)  "; 

		$ExeInsQuery=$this->ExecuteQuery($InsQuery,"insert");
			
		if($_REQUEST['ftype']=='Employer'){
			header('location:favemp.php?ty=1');
		}else{
			header('location:favemp.php?ty=2');
		}
	}


	function Addimages(){

		global $objSmarty;


		if(isset($_FILES['photoimg']['name'])!='')
//echo $_FILES['photoimg']['name'][0].'<br>';
		foreach($_FILES['photoimg']['name'] as $key => $tmp_name ){
			

		/* $image_name=time().'_'.urlencode($_FILES["photoimg"]["name"][$key]);
			move_uploaded_file($_FILES["photoimg"]["tmp_name"][$key],"uploads/".$image_name);*/
			//echo $_FILES['photoimg']['name'][0].'<br>';
			
			$filename_new =time().$_FILES['photoimg']['name'][$key];
			//echo $filename_new;
				$getFormat_new = substr(strrchr($filename_new,'.'),1);
				$filename = md5($filename_new).'.'.$getFormat_new;
				//echo $filename;exit;
				$filename = strtolower($filename);
				
				$add="uploads/$filename";
				@move_uploaded_file($_FILES['photoimg']['tmp_name'][$key], $add);
				
				$resizeObj = new resize("uploads/".$filename);
				$resizeObj -> resizeImage(200, 200, 'crop');
				$resizeObj -> saveImage("uploads/medium/".$filename, 100);
				
				$resizeObj = new resize("uploads/".$filename);
				$resizeObj -> resizeImage(300, 300, 'crop');
				$resizeObj -> saveImage("uploads/large/".$filename, 100);
				
				$resizeObj = new resize("uploads/".$filename);
				$resizeObj -> resizeImage(60, 60, 'crop');
				$resizeObj -> saveImage("uploads/x_small/".$filename, 100);
				//$MyThumb = new Thumbnail("uploads/$filename", 235, 215, "uploads/"."thumb_".$filename);
				//$MyThumb->Output();
				//$resizeObj = new resize("uploads/".$filename);	
				
				

			$insQuery="insert into  tbl_photos(`Image`,`UserID`,`UserType`,CreatedDate)
												values('$filename','".$_SESSION['UserId']."',
												'".$_SESSION['UserType']."',now())";
			$this->ExecuteQuery($insQuery,"insert");
			 header('location:uploadimage.php');
		}
	
	}

	function AllImages()
	{
		global $objSmarty;

		$SelQuery	= "SELECT * from `tbl_photos` where `UserID` = '".$_SESSION['UserId']."' ORDER BY `CreatedDate` DESC";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("photos",$ExeSelQuery);
		$ExeSelQuery1= $this->ExecuteQuery($SelQuery,"norows");
		$objSmarty->assign("photosrw",$ExeSelQuery1);
	}

	function getAdvertisement()
	{
		global $objSmarty;
  		$date = date('Y-m-d');
  		
		$SelQuery = "SELECT * from `tbl_inhouse` where '$date' BETWEEN Start_Date AND End_Date
		ORDER BY RAND() LIMIT 2";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("Ads",$ExeSelQuery);
		$ExeSelQuery1= $this->ExecuteQuery($SelQuery,"norows");
		$objSmarty->assign("count",$ExeSelQuery1);
		
	}
	function favourite_musician()
	{
		global $objSmarty;
		$selquery	= "select u.*, f.* from  tbl_favemp f,tbl_user u where f.UserId='".addslashes($_SESSION['UserId'])."' and f.FavID =u.UserId and u.UserType!= 'Employer'
 and u.UserType!= 'Industry' and u.UserType!= 'Employer & Industry' order by  f.ID desc"  ;
		$exesel=$this->ExecuteQuery($selquery,"select");
		$objSmarty->assign("favmus",$exesel);

	}
	function favourite_employer()
	{
		global $objSmarty;
		$selquery	= "select u.*, f.* from  tbl_favemp f,tbl_user u where f.UserId='".addslashes($_SESSION['UserId'])."' and f.FavID =u.UserId and u.UserType!= 'Musician'
 and u.UserType!= 'Industry' and u.UserType!= 'Musician & Industry' order by  f.ID desc";
		$exesel=$this->ExecuteQuery($selquery,"select");
		$objSmarty->assign("favemp",$exesel);

	}
	function favourite_industry()
	{
		global $objSmarty;
		$selquery	= "select u.*, f.* from  tbl_favemp f,tbl_user u where f.UserId='".addslashes($_SESSION['UserId'])."' and f.FavID =u.UserId and u.UserType!= 'Musician'
 and u.UserType!= 'Employer' and u.UserType!= 'Musician & Employer' order by  f.ID desc";
		$exesel=$this->ExecuteQuery($selquery,"select");
		$objSmarty->assign("favins",$exesel);

	}
	function favourite_jobs()
	{
		global $objSmarty;
		$selquery	= "select u.UserType,u.FirstName,u.LastName,u.Image,j.*, f.* from tbl_favjob f,tbl_job j,tbl_user u where f.UserId='".addslashes($_SESSION['UserId'])."' and j.JobID=f.JobId and j.EmployerId=u.UserId ";
		$exesel=$this->ExecuteQuery($selquery,"select");
		$objSmarty->assign("favjob",$exesel);

	}
	function insertview()
	{
		global $objSmarty;
		$SelQuery	= "SELECT * from `tbl_view`"
		." WHERE `LoginID`='".addslashes($_SESSION['UserId'])."' and `ViewID`='".addslashes($_REQUEST['id'])."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"norows");
		if(!$ExeSelQuery){
			$InsQuery	= "INSERT INTO `tbl_view`
						   (
							 `LoginID`, `ViewID`, `Date`
							) 
							VALUES
							(
								'".addslashes($_SESSION['UserId'])."',
								'".addslashes($_REQUEST['id'])."',
								now()
							)  "; 

			$ExeInsQuery=$this->ExecuteQuery($InsQuery,"insert");
			
		}
		/*$sql="select * from  tbl_user where UserId='".$_REQUEST['id']."'";
		$Result	= $this->ExecuteQuery($sql, "select");
		$fromEmail=$Result[0]['Email'];
		$FirstName=$Result[0]['FirstName'];
		$LastName=$Result[0]['LastName'];
		$Username = addslashes($FirstName).' '.addslashes($LastName);
			    $toEmail=$fromEmail;
			    $subject = "Notification mail - Pro Musician's List";
			    $imgurl="".$config['SiteGlobalPath']."/img/logo.png";
			    $message='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
				<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
				<title></title>
				<link href="melslifecss.css" rel="stylesheet" type="text/css" />
				</head>
				
				<body>
				<table width="75%" border="0" align="center" cellpadding="5" cellspacing="0" class="border_grey">
				    <tr>
			                <td height="25" colspan="2"><img src="'.$imgurl.'" border="0" /></td>
			                </tr>
				  <tr>
					<td><hr size="1px" color="#e0e0e0" /></td>
				  </tr>
				  <tr>
					<td><table width="100%"  cellspacing="0" cellpadding="0">
                    <tr>
						<td height="8">&nbsp;</td>
						<td height="8" colspan="2" align="left">
						  Hi '.$Username.', </td>
					  </tr>
					 
					<tr>
						<td height="8"></td>
						<td height="8" colspan="2"></td>
					  </tr>
					  <tr>
						<td height="8">&nbsp;</td>
						<td height="8" colspan="2" align="left">
						   It seems that '.$_SESSION['FirstName'].' '.$_SESSION['LastName'].' has been viewed your profile.</td>
					  </tr>
					  <tr>
						<td height="8"></td>
						<td height="8" colspan="2" ></td>
					  </tr>
					 					  
					  <tr>
						<td height="8"></td>
						<td height="8" colspan="2" align="left">Thanks,</td>
					  </tr>
					  <tr>
						<td height="8"></td>
						<td height="8" colspan="2" align="left">The Admin Team</td>
					  </tr>
					  <tr>
						<td height="8"></td>
						<td height="8" colspan="2"></td>
					  </tr>
					</table></td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
				  </tr>
				  <tr>
					<td align="center" bgcolor="#7e7e7e"><span class="footer_text">Copyright &copy; 2016. Pro Musician&apos;s List, Inc. All Rights Reserved.</span></td>
				  </tr>
				</table>
				</body>
				</html>';
			    //echo $message;exit; 
				$headers = 'From: admin@admin.com'."\r\n";
				$headers.= 'Reply-To: admin@admin.com'."\r\n";
				$headers.= "MIME-Version: 1.0\r\n";
				$headers.= "Content-type: text/html; charset=iso-8859-1\r\n";		
				//echo $message. $headers;			
				$mail=@mail($toEmail,$subject,$message,$headers);*/
			
			
	}
	function age($birthday){
		list($month, $day, $year) = explode("/", $birthday);
		$year_diff  = date("Y") - $year;
		$month_diff = date("m") - $month;
		$day_diff   = date("d") - $day;
		if ($day_diff < 0 && $month_diff==0) $year_diff--;
		if ($day_diff < 0 && $month_diff < 0) $year_diff--;
		return $year_diff;
	}

	function GetRatingsuser($ID)
	{
		global $objSmarty;
		$selqu = "select count(*) as count,sum(Rate) as sum from `tbl_rating` where UserId ='$ID' ";
		$cnt = $this->ExecuteQuery($selqu, "select");
			
		if($cnt[0]['count']!='0'){
			$ratingvalue=$cnt[0]['sum']/$cnt[0]['count'];
		}else{
			$ratingvalue=0;
		}
		$starfilled=number_format($ratingvalue, 1);;

		$starfilledexp = explode(".", $starfilled);
		$from=$starfilledexp[0];
		//echo "from-->".$from;
			
			
		for($i=1; $i<=$from; $i++)
		{
			echo "<img src='images/star-4.png' width='15' height='15' border='0'>";
		}
			
		$isHalf=$starfilledexp[1];
		if($isHalf=='5' || $isHalf=='6' || $isHalf=='7')
		{
			echo "<img src='images/star-2.png' width='15' height='15' border='0'>";

			$to=5-$from;
			//echo $to;
			for($j=2; $j<=$to; $j++)
			{
				echo "<img src='images/star-0.png' width='15' height='15' border='0'>";
			}
		}
		else if($isHalf=='1' || $isHalf=='2' || $isHalf=='3')
		{
				
			echo "<img src='images/star-01.png' width='15' height='15' border='0'>";

			$to=5-$from;
			//echo $to;
			for($j=2; $j<=$to; $j++)
			{
				echo "<img src='images/star-0.png' width='15' height='15' border='0'>";
			}
		}
		else if($isHalf=='8' || $isHalf=='9' )
		{
			echo "<img src='images/star-03.png' width='15' height='15' border='0'>";

			$to=5-$from;
			//echo $to;
			for($j=2; $j<=$to; $j++)
			{
				echo "<img src='images/star-0.png' width='15' height='15' border='0'>";
			}
		}
		else
		{
			$to=5-$from;

			for($j=1; $j<=$to; $j++)
			{
				echo "<img src='images/star-0.png' width='15' height='15' border='0'>";
			}
		}
		$objSmarty->assign("StarFill",$from);
		$objSmarty->assign("PartnerVals",$ExeSelQuery);

	}

	function getalert()
	{
		global $objSmarty;
		$selquery	= "select * from  tbl_text where UserId ='".$_SESSION['UserId']."' ";
		$exesel=$this->ExecuteQuery($selquery,"select");
		$objSmarty->assign("alert",$exesel);

	}

	function getReview()
	{
		global $objSmarty;
		$sql="select u.FirstName,u.UserType,u.UserId,u.Image,u.Gender,t.*,
		DATE_FORMAT(t.CreatedDate ,'%b %d %Y %h:%i %p') as date
		 from tbl_review t,tbl_user u  where t.ToID='".$_REQUEST['id']."' and t.UserID=u.UserId and t.Status='1' 
		 ORDER BY t.OrderBy ASC limit 3 ";
		$ExeInsQuery=$this->ExecuteQuery($sql,"select");
		$objSmarty->assign("review", $ExeInsQuery);
	}


	/*****************---------SA-----------10/12/2015-----------Picture management-----------***********************************************/


	function manage_pictures()
	{
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['pagelimit']==''){
			$this->Limit			= 10;
		}else{
		 $this->Limit=$_REQUEST['pagelimit'];
		}
		if($_REQUEST['keyword']!="")
		//$where_condition.=" where `CompanyName` like '%".addslashes(trim($_REQUEST['keyword']))."%'";


		$where_condition.=" order by `Id` desc";

		$SelQuery	= "select * from `tbl_picture`"
		."$where_condition";
			
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
		}

		if(!empty($Res_Tickets)&& is_array($Res_Tickets))
		$objSmarty->assign("CatList",$Res_Tickets);
	}

	function add_pictures()
	{
		global $objSmarty;


		if($_FILES['company_image1']['name'] != ""){
			$filename_new =time().$_FILES['company_image1']['name'];
			$getFormat_new = substr(strrchr($filename_new,'.'),1);
			$filename = md5($filename_new).'.'.$getFormat_new;
			$filename = strtolower($filename);
			$add="../uploads/$filename";
			@move_uploaded_file($_FILES['company_image1']['tmp_name'], $add);
			$resizeObj = new resize("../uploads/".$filename);
			$resizeObj -> resizeImage(235, 215, 'crop');
			$resizeObj -> saveImage("../uploads/medium/".$filename, 100);

			$resizeObj = new resize("../uploads/".$filename);
			$resizeObj -> resizeImage(320, 300, 'crop');
			$resizeObj -> saveImage("../uploads/large/".$filename, 100);
		}
			
		$InsQuery	= "INSERT INTO `tbl_picture`
						   (
							 `Image`,
							 `Status`,
							 `CreatedDate`
							) 
							VALUES
							(
								
								'".$filename."',	'1',now()	)  "; 
			
		$ExeInsQuery=$this->ExecuteQuery($InsQuery,"insert");
		$id=mysql_insert_id();
		$objSmarty->assign("SuccessMessage","Picture has been added successfully");
		$objSmarty->assign('company','');

	}
	function select_picture()
	{
		global $objSmarty;

		$SelQuery	= "SELECT * from `tbl_picture` where `Id` = '".$_REQUEST['Ident']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("Cat",$ExeSelQuery);

	}
	function update_picture()
	{
		global $objSmarty;

		if($_FILES['company_image1']['name']!='')
		{
			$filename_new =time().$_FILES['company_image1']['name'];
			$getFormat_new = substr(strrchr($filename_new,'.'),1);
			$filename = md5($filename_new).'.'.$getFormat_new;
			$filename = strtolower($filename);
			$add="../uploads/$filename";
			@move_uploaded_file($_FILES['company_image1']['tmp_name'], $add);
			$resizeObj = new resize("../uploads/".$filename);
			$resizeObj -> resizeImage(235, 215, 'crop');
			$resizeObj -> saveImage("../uploads/medium/".$filename, 100);

			$resizeObj = new resize("../uploads/".$filename);
			$resizeObj -> resizeImage(320, 300, 'crop');
			$resizeObj -> saveImage("../uploads/large/".$filename, 100);
		}
		else
		{
			$filename = $_REQUEST['company_image1_hid'];
		}



		$SelQuery	= "UPDATE `tbl_picture` SET
				      `Image`='".$filename."' "
				      ." WHERE `Id`='".$_REQUEST['Ident']."'";
				      $this->ExecuteQuery($SelQuery,"update");
				      $objSmarty->assign("SuccessMessage","Picture has been updated successfully");
				      	

	}

	/*****************---------SA-----------11/12/2015-----------job template management-----------***********************************************/


	function manage_jobtemplate()
	{
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['pagelimit']==''){
			$this->Limit			= 10;
		}else{
		 $this->Limit=$_REQUEST['pagelimit'];
		}
		if($_REQUEST['keyword']!="")
		//$where_condition.=" where `CompanyName` like '%".addslashes(trim($_REQUEST['keyword']))."%'";


		$where_condition.=" order by `Id` desc";

		$SelQuery	= "select * from `tbl_jobtemplate`"
		."$where_condition";
			
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
		}

		if(!empty($Res_Tickets)&& is_array($Res_Tickets))
		$objSmarty->assign("CatList",$Res_Tickets);
	}
	function add_jobtemplate()
	{
		global $objSmarty;


		if($_FILES['company_image1']['name'] != ""){
			$filename_new =time().$_FILES['company_image1']['name'];
			$getFormat_new = substr(strrchr($filename_new,'.'),1);
			$filename = md5($filename_new).'.'.$getFormat_new;
			$filename = strtolower($filename);
			$add="../uploads/$filename";
			@move_uploaded_file($_FILES['company_image1']['tmp_name'], $add);
		}
			
		$InsQuery	= "INSERT INTO `tbl_jobtemplate`
						   (
							`Type`, `Image`,
							 `Status`,
							 `CreatedDate`
							) 
							VALUES
							(
								
							'".$_REQUEST['jtype']."',	'".$filename."',	'1',now()	)  "; 
			
		$ExeInsQuery=$this->ExecuteQuery($InsQuery,"insert");
		$id=mysql_insert_id();
		$objSmarty->assign("SuccessMessage","Job template has been added successfully");
		$objSmarty->assign('company','');

	}
	function select_jobtemplate()
	{
		global $objSmarty;

		$SelQuery	= "SELECT * from `tbl_jobtemplate` where `Id` = '".$_REQUEST['Ident']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("Cat",$ExeSelQuery);

	}
	function update_jobtemplate()
	{
		global $objSmarty;

		if($_FILES['company_image1']['name']!='')
		{
			$filename_new =time().$_FILES['company_image1']['name'];
			$getFormat_new = substr(strrchr($filename_new,'.'),1);
			$filename = md5($filename_new).'.'.$getFormat_new;
			$filename = strtolower($filename);
			$add="../uploads/$filename";
			@move_uploaded_file($_FILES['company_image1']['tmp_name'], $add);

		}
		else
		{
			$filename = $_REQUEST['company_image1_hid'];
		}



		$SelQuery	= "UPDATE `tbl_jobtemplate` SET
		`Type`='".$_REQUEST['jtype']."' ,
				      `Image`='".$filename."' "
				      ." WHERE `Id`='".$_REQUEST['Ident']."'";
				      $this->ExecuteQuery($SelQuery,"update");
				      $objSmarty->assign("SuccessMessage","Job Template has been updated successfully");
				      	

	}

	function DeletePic(){
		global $objSmarty;
		$sql="Update tbl_user SET Image='' where UserId='".$_SESSION['UserId']."'";
		$this->ExecuteQuery($sql,"update");
			
	}
function getage()
{
		global $objSmarty;
		$sel="select * from tbl_age where Id!=''";
		$ExeSelQuery= $this->ExecuteQuery($sel,"select");
		$objSmarty->assign("age",$ExeSelQuery);
}
	function UpdatePic(){
		global $objSmarty;
		//echo 'yes';
		if($_FILES['txtpic']['name'] != ""){
			$temp='';
		}
		if($_FILES['txtpic']['name'] != ""){

			$filename_new =time().$_FILES['txtpic']['name'];
			//echo $filename_new;exit;
			$getFormat_new = substr(strrchr($filename_new,'.'),1);
			$filename = md5($filename_new).'.'.$getFormat_new;
			$filename = strtolower($filename);
			$add="uploads/$filename";
			@move_uploaded_file($_FILES['txtpic']['tmp_name'], $add);
			
			$resizeObj = new resize("uploads/".$filename);
			$resizeObj -> resizeImage(235, 215, 'crop');
			$resizeObj -> saveImage("uploads/medium/".$filename, 100);

			$resizeObj = new resize("uploads/".$filename);
			$resizeObj -> resizeImage(320, 300, 'crop');
			$resizeObj -> saveImage("uploads/large/".$filename, 100);
				
			$resizeObj = new resize("uploads/".$filename);
			$resizeObj -> resizeImage(60, 60, 'crop');
			$resizeObj -> saveImage("uploads/x_small/".$filename, 100);
			
			$imagePath = ", Image = '".$filename."'";
		}
		/*if($_FILES['txtpic']['name'] == ""){
		 //$filename='profile'.$_REQUEST['propic'].'.jpg';
		 $sql="select * from tbl_picture where Id='".$_REQUEST['propic']."'";
		 $ExeS= $this->ExecuteQuery($sql,"select");
		 $filename=$ExeS[0]['Image'];
		 $imagePath = ", Image = '".$filename."'";
		 }*/
		if($_FILES['txtpic']['name'] != ""){
			$upQuery="UPDATE `tbl_user` SET
				 `ImageTemplate`='".$temp."'
				 $imagePath
		        where `UserId` = '".$_SESSION['UserId']."'"; 

				 $this->ExecuteQuery($upQuery,"update");
				 header('location:editprofile.php');
		}
	}
	
	
function getcreatedby($id){
		global $objSmarty;
		$sel="select * from tbl_user where UserId='$id'";
		$ExeSelQuery= $this->ExecuteQuery($sel,"select");
		$objSmarty->assign("Users",$ExeSelQuery);
	}	
	
function getUserName($id)
{
		global $objSmarty;
		$sel="select * from  tbl_user where UserId='$id'";
		$ExeSelQuery= $this->ExecuteQuery($sel,"select");
		$Fname=$ExeSelQuery[0]['FirstName'];
		$Lname=$ExeSelQuery[0]['LastName'];
		$objSmarty->assign("age",$ExeSelQuery);
		return $Fname.'&nbsp;&nbsp;'. $Lname;
}

function getjobDetail($id)
{
		global $objSmarty;
		$sel="select * from    tbl_job where JobID='$id'";
		$ExeSelQuery= $this->ExecuteQuery($sel,"select");
		$description=$ExeSelQuery[0]['description'];
		
		$objSmarty->assign("age",$ExeSelQuery);
		return $description;
}
function getCountry()
{
		global $objSmarty;
		 $selQuery="select name as countryName,code from countries order by name asc";
		$res=$this->ExecuteQuery($selQuery, "select");
		$objSmarty->assign("country",$res);
	}
	
	
function getCountrybname($id)
{
		global $objSmarty;
		 $selQuery="select * from countries where code= '$id'";
		$res=$this->ExecuteQuery($selQuery, "select");
		$d=$res[0]['name'];
		
		return $d;
	}
function getState($id)
{
		global $objSmarty;
		// $selQuery="select name as countryName,code from cmn_country_mst order by name asc";
		$selQuery	= "SELECT * FROM `states`"
		              ." WHERE country = '".$id."'  order by name asc";
		$res=$this->ExecuteQuery($selQuery, "select");
		$objSmarty->assign("states",$res);
	}
function getSt($id)
{
	
	global $objSmarty;
		$selquery="select * from states where id='$id' ";
		$ExeUpQuery= $this->ExecuteQuery($selquery,"select");
		$s=$ExeUpQuery[0]['name'];
		
		return $s;
}	
function getCity($id)
{
		global $objSmarty;
		$selQuery	= "SELECT * FROM `cities`"
		              ." WHERE state_id='".$id."' order by name asc";
		/*$selQuery	= "SELECT * FROM `cmn_district_mst`"
		              ." WHERE deleted='0' order by name asc";*/
		$res=$this->ExecuteQuery($selQuery, "select");
		$objSmarty->assign("city",$res);
	}	
function getCt($id)
{
	
	global $objSmarty;
		$selquery="select  * from cities where id='$id' ";
		$ExeUpQuery= $this->ExecuteQuery($selquery,"select");
		$c=$ExeUpQuery[0]['name'];
		
		return $c;
}
	
	
	////////////////////////////////////////////END////////////////////////////////////////////////////////
}
?>