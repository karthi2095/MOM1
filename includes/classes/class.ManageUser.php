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

	function manage_users(){
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['keyword']!="" && $_REQUEST['keyword']!="FirstName" )
		$where_condition.="and ((`FirstName` like '%".trim(addslashes($_REQUEST['keyword']))."%' ) or 
		(`LastName` like '%".trim(addslashes($_REQUEST['keyword']))."%' ))";

		/*if($_REQUEST['from']!='' && isset($_REQUEST['from']) && $_REQUEST['from']!="From" ){
			$from=explode('/',$_REQUEST['from']);
			$from =$from['2']."-".$from['0']."-".$from['1'];
			$where_condition.="and CreatedDate >= '$from'";
		}
		if($_REQUEST['to']!='' && isset($_REQUEST['to']) && $_REQUEST['to']!="To" ){
			$to=explode('/',$_REQUEST['to']);
			$to =$to['2']."-".$to['0']."-".$to['1'];
			$where_condition.="and CreatedDate <= '$to'";
		}*/

			
			
		$where_condition1='';
		if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition1.=" order by FirstName asc";
			if($_REQUEST['flag']=="2")
			$where_condition1.=" order by FirstName desc";
			if($_REQUEST['flag']=="9")
			$where_condition1.=" order by FirstName asc";
			if($_REQUEST['flag']=="10")
			$where_condition1.=" order by FirstName desc";
			
		}else{
			$where_condition1.=" order by `Owner_Id` desc";
		}

		$SelQuery	= "select * from `tbl_petowners` where
         					 Owner_Id!=''
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
	

	function forgotPassword($mail)
	{
		//alert('hg');
		global $objSmarty;

		$SelQuery	= "SELECT * FROM `tbl_member`"
		." WHERE `Email` = '".addslashes($_REQUEST['forgotemail'])."'";
		$numrows	= $this->ExecuteQuery($SelQuery, "norows");

		//exit();
		if($numrows>0){
			$SelResult	= $this->ExecuteQuery($SelQuery, "select");
			$Username = $SelResult[0]['Name'];
			$Password = $SelResult[0]['Password'];
			$txtEmail=$SelResult[0]['Email'];
			$subject = "Password Request!!!";
			echo $message='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
				<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
				<title>Password Retrival</title>
				<link href="melslifecss.css" rel="stylesheet" type="text/css" />
				</head>
				
				<body style="background:fff">
				<table width="75%" border="0" align="center" cellpadding="5" cellspacing="0" style="background:#fff">
				  <tr>
					<td><!--<img src="http://srinode32/socialadmin/images/logo.gif" width="320" height="71" />--></td>
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
						<td width="8">&nbsp;</td>
						<td colspan="2" align="left" valign="middle" style="font-family: Arial, Helvetica, sans-serif;
								font-size: 14px;
								font-weight: bolder;
								color: #D53B29;">Welcome to Admin </td>
					  </tr>
					  <tr>
						<td height="8"></td>
						<td height="8" colspan="2" ></td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td colspan="2" align="left" valign="middle" ><div align="justify" style="font-family: Arial, Helvetica, sans-serif;font-size: 12px;font-weight: normal;color: #000000;text-decoration: none;" >Your login detail for Admin Panel,</div></td>
					  </tr>
					  <tr>
						<td height="8"></td>
						<td height="8" colspan="2"></td>
					  </tr>
					   <tr>
						<td>&nbsp;</td>
						<td colspan="2" align="left" valign="middle" ><span style="font-family: Arial, Helvetica, sans-serif;	font-size: 12px; font-weight: bold;	color: #000000;	text-decoration: none;" >UserName: &nbsp;</span><b>'.$Username.'</b></td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td colspan="2" align="left" valign="middle" ><span style="font-family: Arial, Helvetica, sans-serif;	font-size: 12px; font-weight: bold;	color: #000000;	text-decoration: none;" >Email: &nbsp;</span><b>'.$txtEmail.'</b></td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td colspan="2" align="left" valign="middle" ><span style="font-family: Arial, Helvetica, sans-serif;	font-size: 12px; font-weight: bold;	color: #000000;	text-decoration: none;" >Password: &nbsp;</span><b>'.$Password.'</b></td>
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
						<td height="8" colspan="2" align="left">Admin Panel Team</td>
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
					<td align="center" bgcolor="#7e7e7e"><span class="footer_text">&copy; 2013. www.admin.com. All Rights Reserved.</span></td>
				  </tr>
				</table>
				</body>
				</html>';
			$headers = 'From: admin@admin.com'."\r\n";
			$headers.= 'Reply-To: admin@admin.com'."\r\n";
			$headers.= "MIME-Version: 1.0\r\n";
			$headers.= "Content-type: text/html; charset=iso-8859-1\r\n";
			$mail=@mail($txtEmail,$subject,$message,$headers);
			$objSmarty->assign("SuccessMessage", "Login Details has been sent successfully. Please check your mail");
			header("location:account.php?SuccessMessage=1");
		}else{
			$objSmarty->assign("ErrorMessage", "Given email is not available in our database. Please check the email you have entered");
			header("location:account.php?ErrorMessage=3");
		}

	}
	function changePassword()
	{
		global $objSmarty;
		if($this->chkPassword($_REQUEST['txtCurPwd'],$_SESSION['UserId']))
		{
			$UpQuery = "UPDATE `tbl_member` SET `Password` = '".addslashes($_REQUEST['txtNewPwd'])."',
			`Name`='".addslashes($_REQUEST['username'])."',
			`Email`='".addslashes($_REQUEST['email'])."'"
			." WHERE `UserId` = ".$_SESSION['UserId'];
			$UpResult	= $this->ExecuteQuery($UpQuery, "update");
			$objSmarty->assign("SuccessMessage", "Password has been updated successfully");
			$objSmarty->assign("ErrorMessage", "");
			$select_password ="SELECT * FROM `tbl_member` WHERE `UserId`='".$_SESSION['UserId']."'";
			$result =$this->ExecuteQuery($select_password,"select");
			$objSmarty->assign("current_password",$result);

		}
		else
		{
			$objSmarty->assign("ErrorMessage", "Invalid current password");
		}
	}
	function changeaccount()
	{
		global $objSmarty;
		if(isset($_REQUEST['email']))
		{
			$updatequery="UPDATE `tbl_member` SET `Name`='".addslashes($_REQUEST['username'])."',
	      `Email`='".addslashes($_REQUEST['email'])."' WHERE `UserId`='".$_SESSION['UserId']."'";
			$result=$this->ExecuteQuery($updatequery,"update");
			$objSmarty->assign("SuccessMessage", "Details has been updated successfully");
			$objSmarty->assign("ErrorMessage", "");
			$selusername="SELECT * FROM `tbl_member` WHERE `UserId`='".$_SESSION['UserId']."'";
			$selresult=$this->ExecuteQuery($selusername,"select");
			$objSmarty->assign('username',$selresult);

		}
		else {
			$objSmarty->assign("ErrorMessage", "");
		}
		if(($_REQUEST['txtCurPwd']!=""))
		{
			if($this->chkPassword($_REQUEST['txtCurPwd'],$_SESSION['UserId']))
			{
				$UpQuery = "UPDATE `tbl_member` SET `Password` = '".addslashes($_REQUEST['txtNewPwd'])."',
			`Name`='".addslashes($_REQUEST['username'])."',
			`Email`='".addslashes($_REQUEST['email'])."'"
			." WHERE `UserId` = ".$_SESSION['UserId'];
			$UpResult	= $this->ExecuteQuery($UpQuery, "update");
			$objSmarty->assign("SuccessMessage", "Password has been updated successfully");
			$objSmarty->assign("ErrorMessage", "");
			$select_password ="SELECT * FROM `tbl_member` WHERE `UserId`='".$_SESSION['UserId']."'";
			$result =$this->ExecuteQuery($select_password,"select");
			$objSmarty->assign("current_password",$result);
			}
			else
			{
				$objSmarty->assign("SuccessMessage", "");
				$objSmarty->assign("ErrorMessage", "Invalid current password");
			}
		}
	}
	/*========== Checking whether the given password is correct or not ===========*/
	function chkPassword($CurPwd, $user_id)
	{
		$SelQuery	= "SELECT `UserId` FROM `tbl_member`"
		." WHERE binary `Password` = '".$CurPwd."' AND `UserId` = ".$user_id." LIMIT 0,1";
		$SelResult	= $this->ExecuteQuery($SelQuery, "select");
		if(!empty($SelResult) && !empty($SelResult[0]['UserId']))
		return true;
		else
		return false;
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
		
		global $objSmarty;
		$selQueryemail="select * from  tbl_petsubcategory where 
		Category_Id='".$_REQUEST['hdIdent']."'"; //or `Username`='".$_REQUEST['username']."'";
		$count=$this->ExecuteQuery($selQueryemail, "norows");
		if($count==0){
		$UpQuery="DELETE FROM $tablename"
		. " WHERE $id = '".$_REQUEST['hdIdent']."'";
		$ExeUpQuery= $this->ExecuteQuery($UpQuery,"delete");
		
		$objSmarty->assign("SuccessMessage","$word has been deleted successfully");
		}
		else 
		{
			$objSmarty->assign("ErrorMessage","This $word cannot be deleted as it is used by pet subcategory.");
		}
	}

	function addUser(){
		global $objSmarty,$config;
		$city= '';
		$otherCity=0;
		$selQueryemail="select * from  tbl_petowners where Email='".addslashes($_REQUEST['email'])."'"; //or `Username`='".$_REQUEST['username']."'";
		$count=$this->ExecuteQuery($selQueryemail, "norows");
		if($count==0){
			$selQueryusername="select * from  tbl_petowners where Username='".addslashes($_REQUEST['uname'])."'";
		$countusername=$this->ExecuteQuery($selQueryusername, "norows");
		if($countusername==0){
			$proceed="Yes";
			if($proceed=="Yes"){

				/* if($_REQUEST['city'] != "others") {
				 	$city = addslashes($_REQUEST['city']);
				 } else {
				 	$otherCity=1;
				 	$city = $_REQUEST['newCity'];
				 }*/
				 		 
				 $InsQuery="INSERT INTO `tbl_petowners` (
												`FirstName`,
												`LastName`,
												`Username`,
												`Email`,
												`Password`,
												`Address`,
												`City`,
												`State`,
												`Country`,
												`Zipcode`,
												`Phone_Number`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".addslashes($_REQUEST['fname'])."',
												 '".addslashes($_REQUEST['lname'])."',
												 '".addslashes($_REQUEST['uname'])."',
												 '".addslashes($_REQUEST['email'])."',
												 '".addslashes($_REQUEST['pwd'])."',
												 '".addslashes($_REQUEST['address'])."',
												'".addslashes($_REQUEST['city'])."',
												 '".addslashes($_REQUEST['state'])."',
												 '".addslashes($_REQUEST['country'])."',
												 '".addslashes($_REQUEST['zipcode'])."',
												 '".addslashes($_REQUEST['phone'])."',
												 '1',
												 now())";
				$this->ExecuteQuery($InsQuery, "insert");
				$word='';
				$objSmarty->assign("User","");
				$objSmarty->assign("SuccessMessage","User has been added successfully");
			}
		}
		else {
			$objSmarty->assign("ErrorMessage","Username already exist");
				$objSmarty->assign("User", $_REQUEST);

		}
		
		}
		else{
				
			$objSmarty->assign("ErrorMessage","Email already exist");
				$objSmarty->assign("User", $_REQUEST);
		}

	}

	function regUser(){
		global $objSmarty,$config;
		$city= '';
		$otherCity=0;
		$selQueryemail="select * from  tbl_petowners where Email='".addslashes($_REQUEST['email'])."'"; //or `Username`='".$_REQUEST['username']."'";
		$count=$this->ExecuteQuery($selQueryemail, "norows");
		
		$sel="select Email from admin";
		$exesel=$this->ExecuteQuery($sel,"select");
		$adminemail=$exesel[0]['Email'];		
		if($count==0){
		$selQueryusername="select * from  tbl_petowners where Username='".addslashes($_REQUEST['uname'])."'";
		$countusername=$this->ExecuteQuery($selQueryusername, "norows");
		if($countusername==0){
			$proceed="Yes";
			if($proceed=="Yes"){

				/* if($_REQUEST['city'] != "others") {
				 	$city = addslashes($_REQUEST['city']);
				 } else {
				 	$otherCity=1;
				 	$city = $_REQUEST['newCity'];
				 }*/
				 		 
				$InsQuery="INSERT INTO `tbl_petowners` (
												`FirstName`,
												`LastName`,
												`Username`,
												`Email`,
												`Password`,
												`Address`,
												`City`,
												`State`,
												`Country`,
												`Zipcode`,
												`Phone_Number`,
												`Activation`,
											 	`ActivationLink`,												
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".addslashes($_REQUEST['fname'])."',
												 '".addslashes($_REQUEST['lname'])."',
												 '".addslashes($_REQUEST['uname'])."',
												 '".addslashes($_REQUEST['email'])."',
												 '".addslashes($_REQUEST['pwd'])."',
												 '".addslashes($_REQUEST['address'])."',
												'".addslashes($_REQUEST['city'])."',
												 '".addslashes($_REQUEST['state'])."',
												 '".addslashes($_REQUEST['country'])."',
												 '".addslashes($_REQUEST['zipcode'])."',
												 '".addslashes($_REQUEST['phone'])."',
												 0,
												'".md5(time())."',												 
												 '1',
												 now())";
				$this->ExecuteQuery($InsQuery, "insert");
				$word='';
				$objSmarty->assign("User","");
				//$objSmarty->assign("SuccessMessage","User has been added successfully");

				$id= mysql_insert_id();
				$selQuery="select * from tbl_petowners where Owner_Id='$id'";
				$newUser=$this->ExecuteQuery($selQuery,"select");				

					$imgurl="".$config['SiteGlobalPath']."/images/logo.png";
					$email=$_REQUEST['email'];
					$message='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
								<html xmlns="http://www.w3.org/1999/xhtml">
								<head>
								<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
								<title> IpetMedic Confirm Registration </title>
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
											<td width="100%" height="120" align="center" bgcolor="#fffff" class="normal_txt7"><img src="'.$imgurl.'" /></td>
										  </tr>
										  <tr>
											<td height="35" align="center" bgcolor="#FFFFFF" class="normal_txt7"><table width="97%"  cellspacing="0" cellpadding="0">
											  <tr>
												<td width="53%" height="8"></td>
												<td width="47%" height="8"></td>
												</tr>
												<tr>
												<td height="25" colspan="2" align="left" valign="middle" class="title_1" >Hello '.ucfirst($_REQUEST['uname']).',</td>
												</tr>
												<tr>
												<td height="25" colspan="2" align="left" valign="middle" class="title_1" >Welcome to iPetMedic. Thanks for registering with iPetMedic!</td>
												</tr>
												<tr>
												<td height="25" colspan="2" align="left" valign="middle" class="title_1" >Your Login informations are as follows:</td>
												</tr>
												<tr>
												<td height="25" colspan="2" align="left" valign="middle" class="title_1" >Username : &nbsp;<b>'.$_REQUEST['uname'].'</b></td>
												</tr>
												<tr>
												<td height="25" colspan="2" align="left" valign="middle" class="title_1" >Password: &nbsp;<b>'.$_REQUEST['pwd'].'</b></td>
												</tr>
												<tr>
												<td height="25" colspan="2" align="left" valign="middle" class="title_1" ><a href="'.$config['SiteGlobalPath'].'/activate.php?actid='.$newUser[0]['ActivationLink'].'">Click here to activate your account</a></td>
												</tr>																							
												<tr>
												  <td height="25" colspan="2" align="left" valign="middle" class="title_1" >&nbsp;</td>
												</tr>
												<tr>
												<td colspan="2">&nbsp;</td>
												</tr>
												<tr>
												<td align="left"  colspan="2" valign="middle" ><span class="normal_blue">Thank you, </span></td>
											  </tr>
											  <tr>
												<td colspan="2" align="left">iPetMedic Team </td>
												</tr>
											 <tr>
												<td colspan="2">&nbsp;</td>
												</tr>
											  
											 <tr>
												<td colspan="2">&nbsp;</td>
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
				
					$subject = 'Confirm your IpetMedic registration';
					$headers = 'From: '.$adminemail."\r\n";
					$headers.= 'Cc: '.$adminemail."\r\n";
					$headers.= 'Reply-To: '.$adminemail."\r\n";
					$headers.= "MIME-Version: 1.0\r\n";
					$headers.= "Content-type: text/html; charset=iso-8859-1\r\n";
				//$message . '<br>'.$adminemail. '<br>'. $email; exit;					
					@mail($email,$subject,$message,$headers);

					$successMessage = "Thanks for registering with iPetMedic<br>".
  				        "Activation link has been sent to the registered email<br>".
  				    	"Please click the link in the email to activate your account with iPetMedic";
					$objSmarty->assign("SuccessMessage",$successMessage);
				//Redirect('regSuccess.php');
				//$this->loginuser($id);
				}
			} else {
				$objSmarty->assign("ErrorMessage","Username already exist");
				$objSmarty->assign("User", $_REQUEST);
			}		
		} else{				
			$objSmarty->assign("ErrorMessage","Email already exist");
				$objSmarty->assign("User", $_REQUEST);
		}
	}
	
	function regDoctor(){
		global $objSmarty,$config;
		$city= '';
		$otherCity=0;
		$selQueryemail="select * from  tbl_doctors where Email='".addslashes($_REQUEST['email'])."'"; //or `Username`='".$_REQUEST['username']."'";
		$count=$this->ExecuteQuery($selQueryemail, "norows");
		
		$sel="select Email from admin";
		$exesel=$this->ExecuteQuery($sel,"select");
		$adminemail=$exesel[0]['Email'];		
		if($count==0){
		$selQueryusername="select * from  tbl_doctors where Username='".addslashes($_REQUEST['uname'])."'";
		$countusername=$this->ExecuteQuery($selQueryusername, "norows");
		if($countusername==0){
			$proceed="Yes";
			if($proceed=="Yes"){

				/* if($_REQUEST['city'] != "others") {
				 	$city = addslashes($_REQUEST['city']);
				 } else {
				 	$otherCity=1;
				 	$city = $_REQUEST['newCity'];
				 }*/
					
			if($_FILES['txtpic']['name'] != ""){
				$filename_new =time().$_FILES['txtpic']['name'];
				$getFormat_new = substr(strrchr($filename_new,'.'),1);
				$filename = md5($filename_new).'.'.$getFormat_new;
				$filename = strtolower($filename);
				$add="doctorprofile/$filename";
				@move_uploaded_file($_FILES['txtpic']['tmp_name'], $add);
				/*$resizeObj = new resize("../doctorprofile/".$filename);
				$resizeObj -> resizeImage(230, 230, 'crop');
				$resizeObj -> saveImage("../doctorprofile/medium/".$filename, 100);

				$resizeObj = new resize("../doctorprofile/".$filename);
				$resizeObj -> resizeImage(320, 300, 'crop');
				$resizeObj -> saveImage("../doctorprofile/large/".$filename, 100);*/
					
				$temp='';
			}		 
				$InsQuery="INSERT INTO `tbl_doctors` (
												`FirstName`,
												`LastName`,
												`Username`,
												`Email`,
												`Password`,
												`Profile_picture`,
												`Address`,
												`City`,
												`State`,
												`Country`,
												`Zipcode`,
												`Phone_Number`,
												`Specialty`,
												`Education`,
												`Activation`,
											 	`ActivationLink`,												
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".addslashes($_REQUEST['fname'])."',
												 '".addslashes($_REQUEST['lname'])."',
												 '".addslashes($_REQUEST['uname'])."',
												 '".addslashes($_REQUEST['email'])."',
												 '".addslashes($_REQUEST['pwd'])."',
												 '".$filename."',
												 '".addslashes($_REQUEST['address'])."',
												 '".addslashes($_REQUEST['city'])."',
												 '".addslashes($_REQUEST['state'])."',
												 '".addslashes($_REQUEST['country'])."',
												 '".addslashes($_REQUEST['zipcode'])."',
												 '".addslashes($_REQUEST['phone'])."',
												 '".addslashes($_REQUEST['specialty'])."',
												 '".addslashes($_REQUEST['graduation'])."',
												 0,
												'".md5(time())."',												 
												 '1',
												 now())";
				$this->ExecuteQuery($InsQuery, "insert");
				$word='';
				$objSmarty->assign("User","");
				//$objSmarty->assign("SuccessMessage","User has been added successfully");

				$id= mysql_insert_id();
				$selQuery="select * from tbl_doctors where Id='$id'";
				$newUser=$this->ExecuteQuery($selQuery,"select");				

					$imgurl="".$config['SiteGlobalPath']."/images/logo.png";
					$email=$_REQUEST['email'];
					$message='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
								<html xmlns="http://www.w3.org/1999/xhtml">
								<head>
								<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
								<title> IpetMedic Confirm Registration </title>
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
											<td width="100%" height="120" align="center" bgcolor="#fffff" class="normal_txt7"><img src="'.$imgurl.'" /></td>
										  </tr>
										  <tr>
											<td height="35" align="center" bgcolor="#FFFFFF" class="normal_txt7"><table width="97%"  cellspacing="0" cellpadding="0">
											  <tr>
												<td width="53%" height="8"></td>
												<td width="47%" height="8"></td>
												</tr>
												<tr>
												<td height="25" colspan="2" align="left" valign="middle" class="title_1" >Hello '.ucfirst($_REQUEST['uname']).',</td>
												</tr>
												<tr>
												<td height="25" colspan="2" align="left" valign="middle" class="title_1" >Welcome to iPetMedic. Thanks for registering with iPetMedic!</td>
												</tr>
												<tr>
												<td height="25" colspan="2" align="left" valign="middle" class="title_1" >Your Login informations are as follows:</td>
												</tr>
												<tr>
												<td height="25" colspan="2" align="left" valign="middle" class="title_1" >Username : &nbsp;<b>'.$_REQUEST['uname'].'</b></td>
												</tr>
												<tr>
												<td height="25" colspan="2" align="left" valign="middle" class="title_1" >Password: &nbsp;<b>'.$_REQUEST['pwd'].'</b></td>
												</tr>
												<tr>
												<td height="25" colspan="2" align="left" valign="middle" class="title_1" ><a href="'.$config['SiteGlobalPath'].'/activate.php?actid='.$newUser[0]['ActivationLink'].'">Click here to activate your account</a></td>
												</tr>																							
												<tr>
												  <td height="25" colspan="2" align="left" valign="middle" class="title_1" >&nbsp;</td>
												</tr>
												<tr>
												<td colspan="2">&nbsp;</td>
												</tr>
												<tr>
												<td align="left"  colspan="2" valign="middle" ><span class="normal_blue">Thank you, </span></td>
											  </tr>
											  <tr>
												<td colspan="2" align="left">iPetMedic Team </td>
												</tr>
											 <tr>
												<td colspan="2">&nbsp;</td>
												</tr>
											  
											 <tr>
												<td colspan="2">&nbsp;</td>
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
				
					$subject = 'Confirm your IPetMedic registration';
					$headers = 'From: '.$adminemail."\r\n";
					$headers.= 'Cc: '.$adminemail."\r\n";
					$headers.= 'Reply-To: '.$adminemail."\r\n";
					$headers.= "MIME-Version: 1.0\r\n";
					$headers.= "Content-type: text/html; charset=iso-8859-1\r\n";
				//echo	$message . '<br>'.$adminemail. '<br>'. $email; exit;					
					@mail($email,$subject,$message,$headers);

					$successMessage = "Thanks for registering with iPetMedic<br>".
  				        "Activation link has been sent to the registered email<br>".
  				    	"Please click the link in the email to activate your account with iPetMedic";
					$objSmarty->assign("SuccessMessage",$successMessage);
				//Redirect('regSuccess.php');
				//$this->loginuser($id);
				}
			} else {
				$objSmarty->assign("ErrorMessage","Username already exist");
				$objSmarty->assign("User", $_REQUEST);
			}		
		} else{				
			$objSmarty->assign("ErrorMessage","Email already exist");
				$objSmarty->assign("User", $_REQUEST);
		}
	}
	function getPetOwnerAccount($ActivateId) {
 		$SelQuery	= "SELECT * FROM `tbl_petowners`"
		              ." WHERE `ActivationLink` = '".$ActivateId."' LIMIT 0,1";
		             
		$SelResult	= $this->ExecuteQuery($SelQuery, "select");
		return $SelResult;
 	}
 	
	function updatePetOwnerActive($ActivateId) {
		global $objSmarty;
		$SelQuery	= "UPDATE `tbl_petowners` SET  
		 Status = '1',
		 Activation = '1', 
		 ActivationLink= '".md5(time())."'
		  WHERE ActivationLink ='".$ActivateId."'";
		
		$this->ExecuteQuery($SelQuery,"update");		
	}
		
	function getDoctorAccount($ActivateId) {
 		$SelQuery	= "SELECT * FROM `tbl_doctors`"
		              ." WHERE `ActivationLink` = '".$ActivateId."' LIMIT 0,1";
		             
		$SelResult	= $this->ExecuteQuery($SelQuery, "select");
		return $SelResult;
 	}
 	
	function updateDoctorActive($ActivateId) {
		global $objSmarty;
		$SelQuery	= "UPDATE `tbl_doctors` SET  
		 Status = '1',
		 Activation = '1', 
		 ActivationLink= '".md5(time())."'
		  WHERE ActivationLink ='".$ActivateId."'";
		
		$this->ExecuteQuery($SelQuery,"update");		
	}
	 		
	function addaddr(){
			global $objSmarty,$config;
		  $InsQuery1="INSERT INTO `tbl_addressbook` (
				                                `UserId`,
												`Name`,
																						
												`Address`,
												`City`,
											
												`State`,
												`Country`,
												`Pincode`,
												
												`PhoneNo`,
												
												`CreatedDate`)
												 VALUES (
												 '".$_SESSION['userId']."',
												 '".addslashes($_REQUEST['name'])."',
																			
												 '".addslashes($_REQUEST['address'])."',
												 '".addslashes($_REQUEST['city'])."',
												 '".addslashes($_REQUEST['state'])."',
												 '".addslashes($_REQUEST['country'])."',
												 '".addslashes($_REQUEST['pincode'])."',
												 
												 '".addslashes($_REQUEST['phoneNo'])."',
												
												 now())";
				mysql_query($InsQuery1);
				$objSmarty->assign("Addr","");
				$objSmarty->assign("SuccessMessage","Address has been added successfully");
		
		
	}
	
	function getaddrdetails($userId)
	{
		global $objSmarty;
		$selQuery="select * from tbl_addressbook where UserId='".$userId."'";
		$res=$this->ExecuteQuery($selQuery, "select");
		 $addrcount=$this->ExecuteQuery($selQuery, "norows");
		$objSmarty->assign("addrdetail",$res);
	}
	
	function getBillingaddress($userId)
	{
		global $objSmarty;
		$selqry="select * from tbl_member where UserId='".$userId."'";
		$res=$this->ExecuteQuery($selqry,"select");
		$objSmarty->assign("Billingaddr",$res);
	}
	
	function getcontents()
	{
		global $objSmarty,$config;
		$sel="select `title` from `tbl_staticpages` where `Status`='1'";
		$exesel=$this->ExecuteQuery($sel,"select");
		$title=$exesel[0]['title'];
	}
	

	function editUser(){

		global $objSmarty,$config;
		$upQuery="update tbl_member set `Name`='".addslashes($_REQUEST['username'])."',
												`Email`='".addslashes($_REQUEST['email'])."',
												`Address`='".addslashes($_REQUEST['address'])."',
												`City`='".addslashes($_REQUEST['city'])."',
												`District`='".addslashes($_REQUEST['district'])."',
												`State`='".addslashes($_REQUEST['state'])."',
												`Country`='".addslashes($_REQUEST['country'])."',
												`Pincode`='".addslashes($_REQUEST['pincode'])."',
												`PhoneNo`='".addslashes($_REQUEST['phone'])."',
												`Status`='1',
												`UpdatedDate`=now() where UserId='".$_SESSION['UserId']."'";
		$this->ExecuteQuery($upQuery, "update");
		$word='';
		$objSmarty->assign("User","");
		$objSmarty->assign("SuccessMessage","User has been updated successfully");
			
	}

	function MakeUserLogin()
	{
		global $objSmarty;

		$sql = "SELECT * FROM `tbl_member` WHERE  `Email`='".addslashes($_REQUEST['email'])."'
	       	  AND 
	       	  `Password`='".addslashes($_REQUEST['password'])."' and `Status`='1'";
		//echo $sql;
		$sle		= $this->ExecuteQuery($sql, "select");
		$Count		= $this->ExecuteQuery($sql, "norows");
		$details = $this->ExecuteQuery($sql, "select");
		if($Count > 0){
			$_SESSION['UserId']=$details[0]['UserId'];
			$_SESSION['username']=$details[0]['Name'];
			$_SESSION['email']=$details[0]['Email'];
			header('Location:accountinfo.php?UserId='.$details[0]['UserId']);
		}
		else{

			header('Location:account.php?ErrorMessage=1');
		}
	}
	function getUserById(){
		global $objSmarty;
		if($_REQUEST['Ident']!=''){
			$selQuery="select * from tbl_member where UserId='".$_REQUEST['Ident']."'";
			$res=$this->ExecuteQuery($selQuery, "select");
			$objSmarty->assign("User",$res);
		}else{
			redirect('manage_user.php');
		}
	}

	function updateUser(){
		global $objSmarty;
		
		$selQuery="select * from tbl_petowners where Username='".addslashes($_REQUEST['username'])."' and Owner_Id !='".$_REQUEST['Ident']."'";
		$count=$this->ExecuteQuery($selQuery, "norows");
		if(!$count){				
			$selQuery1="select * from tbl_petowners where Email='".addslashes($_REQUEST['email'])."' and Owner_Id !='".$_REQUEST['Ident']."'";
			$count1=$this->ExecuteQuery($selQuery1, "norows");
			if(!$count1){
				$proceed="Yes";
				if($proceed=="Yes"){
					 				
				$upQuery="update tbl_petowners set `Firstname`='".addslashes($_REQUEST['fname'])."',
					                               `Lastname`='".addslashes($_REQUEST['lname'])."',
					                               `Username`='".addslashes($_REQUEST['uname'])."',
													`Email`='".addslashes($_REQUEST['email'])."',											
												 	`Address`='".addslashes($_REQUEST['address'])."',
													`City`='".addslashes($_REQUEST['city'])."',
													`State`='".addslashes($_REQUEST['state'])."',
													`Country`='".addslashes($_REQUEST['country'])."',
													`Zipcode`='".addslashes($_REQUEST['zipcode'])."',
													`Phone_Number`='".addslashes($_REQUEST['phone'])."',
													`Updated_Date`=now()
													where Owner_Id='".$_REQUEST['Ident']."'";
					$this->ExecuteQuery($upQuery, "update");
	
					$objSmarty->assign("SuccessMessage","User has been updated successfully");
					
				}
			}else{
				$objSmarty->assign("ErrorMessage","Email already exist");
			}
		}else{
			$objSmarty->assign("ErrorMessage","Username already exist");
		}
				
	}

	function updateaccount(){
		global $objSmarty;
		$selQuery="select * from tbl_member where Email='".addslashes($_REQUEST['email'])."'";
		$count=$this->ExecuteQuery($selQuery, "norows");
		if(!$count){
			$proceed="Yes";

			if($proceed=="Yes"){
				//$dob=explode('/', $_REQUEST['dob']);
				//$dob=$dob[2]."-".$dob[0]."-".$dob[1];
				$upQuery="update tbl_member set `Name`='".addslashes($_REQUEST['name'])."',
												`Email`='".addslashes($_REQUEST['email'])."',
												
												`UpdatedDate`=now()
												where UserId='".$_SESSION['UserId']."'";
				$this->ExecuteQuery($upQuery, "update");

				$objSmarty->assign("SuccessMessage","User has been updated successfully");
			}
		}else{
			$objSmarty->assign("ErrorMessage","Email already exist");
		}
	}
	function getUserName($id){
		global $objSmarty;
		$selQuery="select Name from tbl_member where UserId='$id'";
		$res=$this->ExecuteQuery($selQuery, "select");
		return stripslashes($res[0]['Name']);
	}
function get_gallery($id){
		global $objSmarty;
		$selQuery="select * from tbl_gallery where Id='".$id."'";
		$res=$this->ExecuteQuery($selQuery, "select");
		$count=$this->ExecuteQuery($selQuery, "norows");
		$objSmarty->assign("Gallery",$res);
	}


	function loginuser($id)
	{
		$SelQuery="SELECT * FROM `tbl_member` where UserId='".$id."' ";
		$SelResult=$this->ExecuteQuery($SelQuery,"select");
		session_register("userId");
		session_register("userName");
		$_SESSION['userId']=$SelResult[0]['UserId'];
		$_SESSION['userName']=$SelResult[0]['Name'];
		header('Location:index.php');
	}

	function getUserdetails($userId)
	{
		global $objSmarty;
		$selQuery="select * from tbl_member where UserId='".$userId."'";
		$res=$this->ExecuteQuery($selQuery, "select");
		$count=$this->ExecuteQuery($selQuery, "norows");
		$objSmarty->assign("User",$res);
	}
	

	function updateUserdetails($userId){
		global $objSmarty;
		$selQuery="select * from tbl_member where Email='".addslashes($_REQUEST['email'])."' and UserId!='".$userId."'";
		$count=$this->ExecuteQuery($selQuery, "norows");
		if(!$count){
			$proceed="Yes";

			if($proceed=="Yes"){
				$upQuery="update tbl_member set `Username`='".addslashes($_REQUEST['name'])."',
												`Email`='".addslashes($_REQUEST['email'])."',
											 	`Address`='".addslashes($_REQUEST['address'])."',
												`City`='".addslashes($_REQUEST['city'])."',
												`District`='".addslashes($_REQUEST['district'])."',
												`State`='".addslashes($_REQUEST['state'])."',
												`Country`='".addslashes($_REQUEST['country'])."',
												`Pincode`='".addslashes($_REQUEST['pincode'])."',
												`PhoneNo`='".addslashes($_REQUEST['phoneNo'])."',
												`UpdatedDate`=now()
												where UserId='".$userId."'";
				$this->ExecuteQuery($upQuery, "update");

				$objSmarty->assign("SuccessMessage","User has been updated successfully");
			}
		}else{
			$objSmarty->assign("ErrorMessage","Email already exist");
		}
	}

	/*-------------------------- By KM ------------------------*/


	
	//contact us page mail submission
	function sendcontactmail()
	{
		global $objSmarty,$config;
		$email=$_REQUEST['email'];
		$sql="select * from admin where Ident='1'";
		$Result	= $this->ExecuteQuery($sql, "select");
		$to=$Result[0]['Email'];
		$imgurl="".$config['SiteGlobalPath']."images/Donside_logo_new.png";
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
			                <td width="83%" height="25" align="left" valign="middle" bgcolor="#F8F8F8" ><span class="normal_blue">'.$_REQUEST['name'].'</span></td>
			                </tr>
							<tr>
			                <td bgcolor="#F8F8F8"><strong>Email</strong></td>
			                <td height="25" align="left" valign="middle" bgcolor="#F8F8F8" ><span class="normal_blue">'.$_REQUEST['email'].'</span></td>
			                </tr>
			                <tr>
			                <td bgcolor="#F8F8F8"><strong>Telephone No</strong></td>
			                <td height="25" align="left" valign="middle" bgcolor="#F8F8F8" ><span class="normal_blue">'.$_REQUEST['phone'].'</span></td>
			                </tr>
							<tr>
			                <td valign="top" bgcolor="#F8F8F8"><strong>Message</strong></td>
			                <td height="25" align="left" valign="middle" bgcolor="#F8F8F8" >'.$_REQUEST['message'].' </td>
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
		$subject  = $_REQUEST['subject'];
		$headers .= "From: ".$email."\r\n";
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

		@mail($to,$subject,$mess,$headers);

		$objSmarty->assign("SuccessMessage", "Mail has been sent successfully");
	}


	/*-------------------------- By KM ------------------------*/

	function updateUserpassword($id)
	{
		global $objSmarty;
		$selqry="select * from tbl_member where Password='".$_REQUEST['cur_pword']."'";
		$exeqry=$this->ExecuteQuery($selqry,"select");
		$cnt=$this->ExecuteQuery($selqry,"norows");
		if($cnt>0)
		{
			$update="update tbl_member set Password='".$_REQUEST['new_pword']."' where UserId='".$id."'";
			$this->ExecuteQuery($update,"update");
			$objSmarty->assign("SuccessMessage","Password has been changed successfully");
		}
		else
		{
			$objSmarty->assign("ErrorMessage", "Invalid Current Password");
		}
	}
	
	
	function getupdated()
	{
		global $objSmarty;
		$selQuery="select title,content from tbl_staticpages where pageName='Updated for 2015'";
		$res=$this->ExecuteQuery($selQuery, "select");
		$objSmarty->assign("updatenews",$res);
		
	}

    function searchByNames() {
    	global $objSmarty;
		$selqry="select * from tbl_member where
         					 UserId!='' and Status=1 and Firstname like '%".trim(addslashes($_REQUEST['searchText']))."%' OR Lastname like '%".trim(addslashes($_REQUEST['searchText']))."%' OR
							Username like '%".trim(addslashes($_REQUEST['searchText']))."%'";
		$exeqry=$this->ExecuteQuery($selqry,"select");
		//$cnt=$this->ExecuteQuery($selqry,"norows");
		$objSmarty->assign("UserList",$exeqry);
    }
function getCountry()
{
		global $objSmarty;
		 $selQuery="select * from  countries order by name asc";
		$res=$this->ExecuteQuery($selQuery, "select");
		$objSmarty->assign("country",$res);
	}
	
	
function getCountrybname($id)
{
		global $objSmarty;
		 $selQuery="select * from countries where id= '$id'";
		$res=$this->ExecuteQuery($selQuery, "select");
		$d=$res[0]['name'];
		
		return $d;
	}
function getState($id)
{
		global $objSmarty;
		// $selQuery="select name as countryName,code from cmn_country_mst order by name asc";
		$selQuery	= "SELECT * FROM `states`"
		              ." WHERE country_id = '".$id."'  order by name asc";
		$res=$this->ExecuteQuery($selQuery, "select");
		$objSmarty->assign("states",$res);
	}
function getSt($id)
{
	
	global $objSmarty;
		$selquery="select  * from states where id='$id' ";
		$ExeUpQuery= $this->ExecuteQuery($selquery,"select");
		$s=$ExeUpQuery[0]['name'];
		
		return $s;
}	
function getCity($id)
{
		global $objSmarty;
		$selQuery	= "SELECT * FROM `cities`"
		              ." WHERE state_id='".$id."'order by name asc";
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
function select_owner()
	{
		global $objSmarty;

		$SelQuery	= "SELECT * from `tbl_petowners` where `Owner_Id` = '".$_REQUEST['Ident']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("User",$ExeSelQuery);

	}	
function select_doctor()
	{
		global $objSmarty;

		$SelQuery	= "SELECT * from `tbl_doctors` where `Id` = '".$_REQUEST['Ident']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("User",$ExeSelQuery);
		
		$file=$ExeSelQuery[0]['Profile_picture'];
		$filename = $file;
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		$str = strtolower($ext);
		//echo $ext;
		/*if($ext != '')
		{
			
		}*/
		$objSmarty->assign("ext",$str);

	}	
function select_appointment()
	{
		global $objSmarty;

		$SelQuery	= "SELECT * from `tbl_appointment` where `Id` = '".$_REQUEST['Ident']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("User",$ExeSelQuery);

	}

function select_rating()
	{
		global $objSmarty;

		$SelQuery	= "SELECT * from `tbl_rating` where `Id` = '".$_REQUEST['Ident']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("User",$ExeSelQuery);

	}	
function manage_doctors(){
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['keyword']!="" && $_REQUEST['keyword']!="FirstName" )
		$where_condition.="and ((`FirstName` like '%".trim(addslashes($_REQUEST['keyword']))."%' ) or 
		(`LastName` like '%".trim(addslashes($_REQUEST['keyword']))."%' ))";

		
			
		$where_condition1='';
		if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition1.=" order by FirstName asc";
			if($_REQUEST['flag']=="2")
			$where_condition1.=" order by FirstName desc";
			if($_REQUEST['flag']=="9")
			$where_condition1.=" order by FirstName asc";
			if($_REQUEST['flag']=="10")
			$where_condition1.=" order by FirstName desc";
			
		}else{
			$where_condition1.=" order by `Id` desc";
		}

		$SelQuery	= "select * from `tbl_doctors` where
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
	function add_doctor(){
		global $objSmarty,$config;
		
		$selQueryemail="select * from   tbl_doctors where Email='".addslashes($_REQUEST['email'])."'"; //or `Username`='".$_REQUEST['username']."'";
		$count=$this->ExecuteQuery($selQueryemail, "norows");
		if($count==0){
			$selQueryusername="select * from   tbl_doctors where Username='".addslashes($_REQUEST['uname'])."'";
		$countusername=$this->ExecuteQuery($selQueryusername, "norows");
		if($countusername==0){
			$proceed="Yes";
			if($proceed=="Yes"){
				
			if($_FILES['txtpic']['name'] != ""){
				$filename_new =time().$_FILES['txtpic']['name'];
				$getFormat_new = substr(strrchr($filename_new,'.'),1);
				$filename = md5($filename_new).'.'.$getFormat_new;
				$filename = strtolower($filename);
				$add="../doctorprofile/$filename";
				@move_uploaded_file($_FILES['txtpic']['tmp_name'], $add);
				/*$resizeObj = new resize("../doctorprofile/".$filename);
				$resizeObj -> resizeImage(230, 230, 'crop');
				$resizeObj -> saveImage("../doctorprofile/medium/".$filename, 100);

				$resizeObj = new resize("../doctorprofile/".$filename);
				$resizeObj -> resizeImage(320, 300, 'crop');
				$resizeObj -> saveImage("../doctorprofile/large/".$filename, 100);*/
					
				$temp='';
			}

				 $InsQuery="INSERT INTO `tbl_doctors` (
												`FirstName`,
												`LastName`,
												`Username`,
												`Email`,
												`Profile_picture`,
												`Password`,
												`Specialty`,
												`Education`,
												`Address`,
												`City`,
												`State`,
												`Country`,
												`Zipcode`,
												`Phone_Number`,
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".addslashes($_REQUEST['fname'])."',
												 '".addslashes($_REQUEST['lname'])."',
												 '".addslashes($_REQUEST['uname'])."',
												 '".addslashes($_REQUEST['email'])."',
												 '".$filename."',
												 '".addslashes($_REQUEST['pwd'])."',
												 '".addslashes($_REQUEST['specialty'])."',
												 '".addslashes($_REQUEST['education'])."',
												 '".addslashes($_REQUEST['address'])."',
												 '".addslashes($_REQUEST['city'])."',
												 '".addslashes($_REQUEST['state'])."',
												 '".addslashes($_REQUEST['country'])."',
												 '".addslashes($_REQUEST['zipcode'])."',
												 '".addslashes($_REQUEST['phone'])."',
												 '1',
												 now())";
				$this->ExecuteQuery($InsQuery, "insert");
				$word='';
				$objSmarty->assign("User","");
				$objSmarty->assign("SuccessMessage","Doctor has been added successfully");
			}
		}
		else {
			$objSmarty->assign("ErrorMessage","Username already exist");
				$objSmarty->assign("User", $_REQUEST);

		}
		
		}
		else{
				
			$objSmarty->assign("ErrorMessage","Email already exist");
				$objSmarty->assign("User", $_REQUEST);
		}

	}
	function reg_doctor(){
		global $objSmarty,$config;
		
		$selQueryemail="select * from   tbl_doctors where Email='".addslashes($_REQUEST['email'])."'"; //or `Username`='".$_REQUEST['username']."'";
		$count=$this->ExecuteQuery($selQueryemail, "norows");
		if($count==0){
			$selQueryusername="select * from   tbl_doctors where Username='".addslashes($_REQUEST['uname'])."'";
		$countusername=$this->ExecuteQuery($selQueryusername, "norows");
		if($countusername==0){
			$proceed="Yes";
			if($proceed=="Yes") {
				
			if($_FILES['txtpic']['name'] != "") {
				$filename_new =time().$_FILES['txtpic']['name'];
				$getFormat_new = substr(strrchr($filename_new,'.'),1);
				$filename = md5($filename_new).'.'.$getFormat_new;
				$filename = strtolower($filename);
				$add="../doctorprofile/$filename";
				@move_uploaded_file($_FILES['txtpic']['tmp_name'], $add);
				/*$resizeObj = new resize("../doctorprofile/".$filename);
				$resizeObj -> resizeImage(230, 230, 'crop');
				$resizeObj -> saveImage("../doctorprofile/medium/".$filename, 100);

				$resizeObj = new resize("../doctorprofile/".$filename);
				$resizeObj -> resizeImage(320, 300, 'crop');
				$resizeObj -> saveImage("../doctorprofile/large/".$filename, 100);*/
					
				$temp='';
			}

				 $InsQuery="INSERT INTO `tbl_doctors` (
												`FirstName`,
												`LastName`,
												`Username`,
												`Email`,
												`Profile_picture`,
												`Password`,
												`Specialty`,
												`Education`,
												`Address`,
												`City`,
												`State`,
												`Country`,
												`Zipcode`,
												`Phone_Number`,
												`Activation`,
											 	`ActivationLink`,												
												`Status`,
												`Created_Date`)
												 VALUES (
												 '".addslashes($_REQUEST['fname'])."',
												 '".addslashes($_REQUEST['lname'])."',
												 '".addslashes($_REQUEST['uname'])."',
												 '".addslashes($_REQUEST['email'])."',
												 '".$filename."',
												 '".addslashes($_REQUEST['pwd'])."',
												 '".addslashes($_REQUEST['specialty'])."',
												 '".addslashes($_REQUEST['education'])."',
												 '".addslashes($_REQUEST['address'])."',
												 '".addslashes($_REQUEST['city'])."',
												 '".addslashes($_REQUEST['state'])."',
												 '".addslashes($_REQUEST['country'])."',
												 '".addslashes($_REQUEST['zipcode'])."',
												 '".addslashes($_REQUEST['phone'])."',
												 0,
												'".md5(time())."',													 
												 '1',
												 now())";
				$this->ExecuteQuery($InsQuery, "insert");
				$word='';
				$objSmarty->assign("User","");

				$id= mysql_insert_id();
				$selQuery="select * from tbl_doctors where Id='$id'";
				$newUser=$this->ExecuteQuery($selQuery,"select");				

					$imgurl="".$config['SiteGlobalPath']."/images/logo.png";
					$email=$_REQUEST['email'];
					$message='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
								<html xmlns="http://www.w3.org/1999/xhtml">
								<head>
								<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
								<title> Donside Safety Confirm Registration </title>
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
											<td width="100%" height="120" align="center" bgcolor="#fffff" class="normal_txt7"><img src="'.$imgurl.'" /></td>
										  </tr>
										  <tr>
											<td height="35" align="center" bgcolor="#FFFFFF" class="normal_txt7"><table width="97%"  cellspacing="0" cellpadding="0">
											  <tr>
												<td width="53%" height="8"></td>
												<td width="47%" height="8"></td>
												</tr>
												<tr>
												<td height="25" colspan="2" align="left" valign="middle" class="title_1" >Hello '.ucfirst($_REQUEST['uname']).',</td>
												</tr>
												<tr>
												<td height="25" colspan="2" align="left" valign="middle" class="title_1" >Welcome to iPetMedic. Thanks for registering with iPetMedic!</td>
												</tr>
												<tr>
												<td height="25" colspan="2" align="left" valign="middle" class="title_1" >Your Login informations are as follows:</td>
												</tr>
												<tr>
												<td height="25" colspan="2" align="left" valign="middle" class="title_1" >Username : &nbsp;<b>'.$_REQUEST['uname'].'</b></td>
												</tr>
												<tr>
												<td height="25" colspan="2" align="left" valign="middle" class="title_1" >Password: &nbsp;<b>'.$_REQUEST['pwd'].'</b></td>
												</tr>
												<tr>
												<td height="25" colspan="2" align="left" valign="middle" class="title_1" ><a href="'.$config['SiteGlobalPath'].'/activate.php?actid='.$newUser[0]['ActivationLink'].'">Click here to activate your account</a></td>
												</tr>																							
												<tr>
												  <td height="25" colspan="2" align="left" valign="middle" class="title_1" >&nbsp;</td>
												</tr>
												<tr>
												<td colspan="2">&nbsp;</td>
												</tr>
												<tr>
												<td align="left"  colspan="2" valign="middle" ><span class="normal_blue">Thank you, </span></td>
											  </tr>
											  <tr>
												<td colspan="2" align="left">iPetMedic Team </td>
												</tr>
											 <tr>
												<td colspan="2">&nbsp;</td>
												</tr>
											  
											 <tr>
												<td colspan="2">&nbsp;</td>
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
				
					$subject = 'Confirm your Donside Safety registration';
					$headers = 'From: '.$adminemail."\r\n";
					$headers.= 'Cc: '.$adminemail."\r\n";
					$headers.= 'Reply-To: '.$adminemail."\r\n";
					$headers.= "MIME-Version: 1.0\r\n";
					$headers.= "Content-type: text/html; charset=iso-8859-1\r\n";
				//echo	$message . '<br>'.$adminemail. '<br>'. $email; exit;					
					@mail($email,$subject,$message,$headers);
				
					//$objSmarty->assign("SuccessMessage","Doctor has been added successfully");
					$successMessage = "Thanks for registering with iPetMedic<br>".
  				        "Activation link has been sent to the registered email<br>".
  				    	"Please click the link in the email to activate your account with iPetMedic";
					$objSmarty->assign("SuccessMessage",$successMessage);
				}
			} else {
				$objSmarty->assign("ErrorMessage","Username already exist");
				$objSmarty->assign("User", $_REQUEST);
			}		
		} else{				
			$objSmarty->assign("ErrorMessage","Email already exist");
				$objSmarty->assign("User", $_REQUEST);
		}

	}	
	
function updateDoctor(){
		global $objSmarty;
		
		$selQuery="select * from tbl_doctors where Username='".addslashes($_REQUEST['username'])."' 
		and Id !='".$_REQUEST['Ident']."'";
		$count=$this->ExecuteQuery($selQuery, "norows");
		if(!$count){				
			$selQuery1="select * from tbl_doctors where Email='".addslashes($_REQUEST['email'])."' 
			and Id !='".$_REQUEST['Ident']."'";
			$count1=$this->ExecuteQuery($selQuery1, "norows");
			if(!$count1){
				$proceed="Yes";
				if($proceed=="Yes"){
				/*if($_FILES['txtpic']['name'] != ""){
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
			}*/
				if($_FILES['txtpic']['name'] != ""){
				$filename_new =time().$_FILES['txtpic']['name'];
				$getFormat_new = substr(strrchr($filename_new,'.'),1);
				$filename = md5($filename_new).'.'.$getFormat_new;
				$filename = strtolower($filename);
				$add="../doctorprofile/$filename"; 
				@move_uploaded_file($_FILES['txtpic']['tmp_name'], $add);
				/*$resizeObj = new resize("../doctorprofile/".$filename);
				$resizeObj -> resizeImage(230, 230, 'crop');
				$resizeObj -> saveImage("../doctorprofile/medium/".$filename, 100);

				$resizeObj = new resize("../doctorprofile/".$filename);
				$resizeObj -> resizeImage(320, 300, 'crop');
				$resizeObj -> saveImage("../doctorprofile/large/".$filename, 100);*/
					
				$imagePath = ", Profile_picture = '".$filename."'";
			}
			else 
			{
				$sql="select * from tbl_doctors where Id='".$_REQUEST['Ident']."'";
				$ExeS= $this->ExecuteQuery($sql,"select");
				$filename=$ExeS[0]['Profile_picture'];
				$imagePath = ", Profile_picture = '".$filename."'";
				//$filename=
			} 				
			$upQuery="update tbl_doctors set `Firstname`='".addslashes($_REQUEST['fname'])."',
						                            `Lastname`='".addslashes($_REQUEST['lname'])."',
						                            `Username`='".addslashes($_REQUEST['uname'])."',
													`Email`='".addslashes($_REQUEST['email'])."',											
												 	`Address`='".addslashes($_REQUEST['address'])."',
												 	`Education`='".addslashes($_REQUEST['education'])."',											
												 	`Specialty`='".addslashes($_REQUEST['specialty'])."',
													`City`='".addslashes($_REQUEST['city'])."',
													`State`='".addslashes($_REQUEST['state'])."',
													`Country`='".addslashes($_REQUEST['country'])."',
													`Zipcode`='".addslashes($_REQUEST['zipcode'])."',
													`Phone_Number`='".addslashes($_REQUEST['phone'])."',
													`Updated_Date`=now() 
													$imagePath
													where Id='".$_REQUEST['Ident']."'";
					$this->ExecuteQuery($upQuery, "update");
	
					$objSmarty->assign("SuccessMessage","Doctor has been updated successfully");
					
				}
			}else{
				$objSmarty->assign("ErrorMessage","Email already exist");
			}
		}else{
			$objSmarty->assign("ErrorMessage","Username already exist");
		}
				
	}


function manage_appointment(){
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['keyword']!="" && $_REQUEST['keyword']!="FirstName" )
		$where_condition.="and ((`Doctor_Name` like '%".trim(addslashes($_REQUEST['keyword']))."%' ))";

		
			
		$where_condition1='';
		if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition1.=" order by Doctor_Name asc";
			if($_REQUEST['flag']=="2")
			$where_condition1.=" order by Doctor_Name desc";
			if($_REQUEST['flag']=="9")
			$where_condition1.=" order by Doctor_Name asc";
			if($_REQUEST['flag']=="10")
			$where_condition1.=" order by Doctor_Name desc";
			
		}else{
			$where_condition1.=" order by `Id` desc";
		}

		$SelQuery	= "select * from `tbl_appointment` where
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
	
	
function manage_rating(){
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['keyword']!="" && $_REQUEST['keyword']!="FirstName" )
		$where_condition.="and ((`Doctor_Name` like '%".trim(addslashes($_REQUEST['keyword']))."%' ))";

		
			
		$where_condition1='';
		if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition1.=" order by Doctor_Name asc";
			if($_REQUEST['flag']=="2")
			$where_condition1.=" order by Doctor_Name desc";
			if($_REQUEST['flag']=="9")
			$where_condition1.=" order by Doctor_Name asc";
			if($_REQUEST['flag']=="10")
			$where_condition1.=" order by Doctor_Name desc";
			
		}else{
			$where_condition1.=" order by `Id` desc";
		}

		$SelQuery	= "select * from `tbl_rating` where
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
	
function GetDoctorById($id){

global $objSmarty;
		$selquery="select  * from tbl_doctors where Id='$id' ";
		$ExeUpQuery= $this->ExecuteQuery($selquery,"select");
		$c=$ExeUpQuery[0]['Username'];
		
		return $c;	
	
	
}	

function GetOwnerById($id){

global $objSmarty;
		$selquery="select  * from tbl_petowners where Owner_Id ='$id' ";
		$ExeUpQuery= $this->ExecuteQuery($selquery,"select");
		$c=$ExeUpQuery[0]['Username'];
		
		return $c;	
	
	
}

function manage_payment(){
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['keyword']!="" && $_REQUEST['keyword']!="FirstName" )
		$where_condition.="and ((o.Username like '%".trim(addslashes($_REQUEST['keyword']))."%' ))";

		
			
		$where_condition1='';
		if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition1.=" order by o.Username asc";
			if($_REQUEST['flag']=="2")
			$where_condition1.=" order by o.Username desc";
			if($_REQUEST['flag']=="9")
			$where_condition1.=" order by o.Username asc";
			if($_REQUEST['flag']=="10")
			$where_condition1.=" order by o.Username desc";
			
		}else{
			$where_condition1.=" order by `Id` desc";
		}

		$SelQuery	= "select * from `tbl_payment` as p
						join tbl_petowners as o on o.Owner_Id = p.UserId  where
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

function select_payments()
	{
		global $objSmarty;

		$SelQuery	= "SELECT * from `tbl_payment` as p join tbl_petowners as o on o.Owner_Id = p.UserId where `Id` = '".$_REQUEST['Ident']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("User",$ExeSelQuery);

	}	

function manage_invoice(){
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['keyword']!="" && $_REQUEST['keyword']!="FirstName" )
		$where_condition.="and ((o.Username like '%".trim(addslashes($_REQUEST['keyword']))."%' ))";

		
			
		$where_condition1='';
		if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition1.=" order by o.Username asc";
			if($_REQUEST['flag']=="2")
			$where_condition1.=" order by o.Username desc";
			if($_REQUEST['flag']=="9")
			$where_condition1.=" order by o.Username asc";
			if($_REQUEST['flag']=="10")
			$where_condition1.=" order by o.Username desc";
			
		}else{
			$where_condition1.=" order by p.Id desc";
		}

		$SelQuery	= "select p.*,p.Id as Id,o.Username as Username from `tbl_invoice` as p
						join tbl_doctors as o on o.Id = p.DoctorId  where
         					 p.Id!=''
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
	
function select_invoice()
	{
		global $objSmarty;

		$SelQuery	= "SELECT * from `tbl_invoice` as p
						join tbl_doctors as o on o.Id = p.DoctorId  where
         					 p.Id='".$_REQUEST['Ident']."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("User",$ExeSelQuery);

	}
	
	/**********************************Meeting Type****************/
	
	function manage_meetingtype()
	{
		
		global $objSmarty,$objPage;
		$where_condition="";
		if($_REQUEST['pagelimit']==''){
			$this->Limit			= 10;
		}else{
		 $this->Limit=$_REQUEST['pagelimit'];
		}
		if(isset($_REQUEST['keyword']) && $_REQUEST['keyword']!='')
		$where_condition.=" where `Meeting_Type` like '%".addslashes(trim($_REQUEST['keyword']))."%'";
		if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition.=" order by Meeting_Type desc";
			if($_REQUEST['flag']=="2")
			$where_condition.=" order by Meeting_Type asc";
				
		}else{
			//$where_condition.=" order by `ID` desc";
			$where_condition.=" order by `Id` desc";
		}

		 $SelQuery	= "select * from `tbl_meetingtype`"
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
function add_Meetingtype()
	{

		global $objSmarty,$objPage;
		$SelQuery	= "SELECT * from `tbl_meetingtype`
						WHERE 
						`Meeting_Type`='".addslashes($_REQUEST['meetingtype'])."'";

		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"norows");
		
		//$datafile=$_REQUEST['uploadfile'];
   $image=time().$_FILES["uploadfile"]["name"];
			@move_uploaded_file($_FILES['uploadfile']['tmp_name'],"uploadimage/".$image);

		//print_r($_FILES);exit;
		if(!$ExeSelQuery)
		{
			$InsQuery	= "INSERT INTO `tbl_meetingtype`
											    (
											      `Meeting_Type`,
											      `Image`,					      
											      `Status`,
											      `Created_Date`
											      
											    )
											     VALUES 
											    (
											       '".addslashes($_REQUEST['meetingtype'])."',
											        '".$image."',										       
											       '1',
											       now()
											        )";
			$ExeInsQuery=$this->ExecuteQuery($InsQuery,"insert");
			$objSmarty->assign("SuccessMessage","Meeting Type has been added successfully");
		}
		else
		{
			$objSmarty->assign('instrument',$_REQUEST);
			$objSmarty->assign("ErrorMessage","Meeting Type name already exists");
		}

	}
function selectmeetingById()
	{
		global $objSmarty;
		if($_REQUEST['Ident']!='')
		{
			$selQuery="select * from `tbl_meetingtype` where Id='".$_REQUEST['Ident']."'";
			$result=$this->ExecuteQuery($selQuery,"select");
			$objSmarty->assign("meetingtype",$result);
		}
		else
		{
			redirect('manage_meetingtype.php');
		}
	}
	
	
	function update_meetingtype()
	{
		global $objSmarty;
		$SelQuery	= "SELECT * from `tbl_meetingtype`
						WHERE 
						`Meeting_Type`='".addslashes($_REQUEST['meetingtype'])."' and Id !='".$_REQUEST['Ident']."'";

		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"norows");
		 $image=time().$_FILES["uploadfile"]["name"];
			@move_uploaded_file($_FILES['uploadfile']['tmp_name'],"uploadimage/".$image);
			
		if(!$ExeSelQuery)
		{ 
		
			if($_FILES['uploadfile']['name']!="")
				
			{
				 $upQuery="update `tbl_meetingtype` set
										`Meeting_Type`='".addslashes($_REQUEST['meetingtype'])."',
										`Image`='".$image."',
										`Updated_Date`=now()
										where
										 Id='".$_REQUEST['Ident']."'";
				
			}
			else
			{
			 $upQuery="update `tbl_meetingtype` set
										`Meeting_Type`='".addslashes($_REQUEST['meetingtype'])."',
										`Updated_Date`=now()
										where
										 Id='".$_REQUEST['Ident']."'";
			}
			$this->ExecuteQuery($upQuery,"update");
			$objSmarty->assign("SuccessMessage","Meeting Type has been updated successfully");
		}
		else
		{
			$objSmarty->assign("ErrorMessage","Meeting Type name already exists");
		}
		
			
	}
	function Get_last_Records()
		{
	 
	  global $objSmarty,$objPage;
			  $sql="SELECT * FROM tbl_meetings  
			 ORDER BY Id DESC LIMIT 0,3";
		    $Result	= $this->ExecuteQuery($sql, "select");
			$objSmarty->assign("rec", $Result);
			$date=date("Y-m-d");
			$objSmarty->assign("dat", $date);
		}
	function getOwnernameById($Id)
	 {
	 	 $query= "SELECT * FROM  tbl_users WHERE Id='".$Id."'";
		  $row1 = mysql_query($query);
		  $res = mysql_fetch_array($row1);
          return $res['EmployeeName'];
	      
	 }	
	 
	function getActionnameById($Id)
	 {
	 	 global $objSmarty,$objPage;
		 $query= "SELECT * FROM  tbl_actions WHERE MeetingId='".$Id."'";
		 $Result	= $this->ExecuteQuery($query, "select");
		 $objSmarty->assign("act", $Result);
	    	
	 }
	 
	/*function getActionnameById($Id)
	{
	global $objSmarty;
	$sql="SELECT * FROM tbl_actions WHERE Id IN ($id)";
	$Result	= $this->ExecuteQuery($sql, "select");
	$objSmarty->assign("act", $Result);
	}*/
function Getdepartment($Id)
	{
	global $objSmarty;
	$sql="select * from tbl_department WHERE Id='".$Id."'";
	 $row1 = mysql_query($sql);
	 $res = mysql_fetch_array($row1);
     return $res['DepartmentName'];
	}
}
?>