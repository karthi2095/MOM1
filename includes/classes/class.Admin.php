<?php
/*	Class Function for Admin	*/

class Admin extends MysqlFns
{
	function Admin()
	{
		/*MAX FILE SIZE 2MB*/
		$this->FILE_MAXSIZE	= 200000000;
		
		$this->permissions 	= 0777 ;
		$this->Limit 		= 15;
		$this->MysqlFns();
	}
	
	/*========== Checking whether logged member is authorised or not===========*/ 
	function chkAdminLogin()
    {
		global $objSmarty;	
		extract($_REQUEST); 
		$SelQuery="SELECT * FROM `admin` "
				  . "WHERE binary `Username`= '".$username."' AND binary `Password`= '".$password."'";
		$SelResult=$this->ExecuteQuery($SelQuery,"select");
		
		if((!empty($SelResult)) && (!empty($SelResult[0]['Ident'])))
		{
			//session_register("TWAdminLogin");
			//session_register("admin_id");
			//session_register("adminName");
			$_SESSION[TWAdminLogin]=$AdminLogin=$SelResult[0]['Username'];
			$_SESSION['admin_id']=$Adminid=$SelResult[0]['Ident'];
			$_SESSION['adminName']=$adminname=$SelResult[0]['Username'];
			header("Location:controlpanel.php");
		} 
		else
		{
			$objSmarty->assign("ErrorMessage","Invalid login");
		}
	}
	
	/*========== Checking whether session has set or not===========*/ 
	function chkLogin()
	{
		global $_SESSION;
		if(isset($_SESSION[TWAdminLogin]) && !empty($_SESSION[TWAdminLogin])) {
			return true;
		} else{
			Redirect("index.php");
		}
	}
	
	/*================== Account Details======================*/
function Get_account_Details()
	{
	global $objSmarty;
	$sql="select * from admin where Ident='1'";
	$Result	= $this->ExecuteQuery($sql, "select");
	$objSmarty->assign("Acc", $Result);
	}
	function Get_account_Detatails()
	{
	global $objSmarty;
	$sql="select * from tbl_metatags where Id='".$_REQUEST['CatIdent']."' and Pagename='".$_REQUEST['Pagename']."'";
	$Result	= $this->ExecuteQuery($sql, "select");
	$objSmarty->assign("Acc", $Result);
	}
	
function Get_meta_Details()
	{
		global $objSmarty,$objPage;
			
			$where_condition="";
		if(isset($_REQUEST['keyword']) && $_REQUEST['keyword']!='')
			$where_condition.=" AND `Pagename` like '%".addslashes(trim($_REQUEST['keyword']))."%' ";
		if($_REQUEST['flag']!=""){
			if($_REQUEST['flag']=="1")
			$where_condition.=" order by Pagename asc";
			if($_REQUEST['flag']=="2")
			$where_condition.=" order by Pagename desc";
			
		}else{
			$where_condition.=" order by `Id` asc";
		}
		
		
		$SelQuery	= "select * from `tbl_metatags`"
					  ." $where_condition";
					$i=1;
		$objSmarty->assign("i",$i);	
//		if(isset($_REQUEST['page']) && $_REQUEST['page'] >1)
//			$i= ($this->Limit * $_REQUEST['page'] )-$this->Limit +1;
//		else
//			$i=1;
//		$objSmarty->assign("i",$i);	
//					  
//		$listing_split = new MsplitPageResults($SelQuery, $this->Limit);
//		if ( ($listing_split->number_of_rows > 0) ) 
//		{
//			$objSmarty->assign("LinkPage",$listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_RESULT));
//			$objSmarty->assign("PerPageNavigation",TEXT_RESULT_PAGE1 . ' ' . $listing_split->display_links(4, get_all_get_params(array('page', 'info', 'x', 'y')))); 
//		}
//		
//		if ($listing_split->number_of_rows > 0) 
//		{
//			$rows = 0;
			$Res_Tickets	= $this->ExecuteQuery($SelQuery, "select");
//		}
//		
//		if(!empty($Res_Tickets)&& is_array($Res_Tickets))
			$objSmarty->assign("Metatags",$Res_Tickets);
	}
	function updateDetails()
	{
		global $objSmarty;
	$UpQuery = "UPDATE `tbl_metatags` SET `meta_desc` = '".addslashes($_REQUEST['meta_desc'])."', `meta_keyword` = '".addslashes($_REQUEST['meta_keyword'])."' 
						 WHERE `Id`='".$_REQUEST['CatIdent']."' and `Pagename`='".$_REQUEST['Pagename']."'";
			$UpResult	= $this->ExecuteQuery($UpQuery, "update");
			$objSmarty->assign("SuccessMessage", "Meta tags has been updated successfully");
			$objSmarty->assign("ErrorMessage", "");
	}
	
	/*========== Changing the password ===========*/ 
	function changePassword()
	{
		global $objSmarty;
		if($this->chkPassword($_REQUEST['txtCurPwd'], $_SESSION['admin_id']))
		{
			$UpQuery = "UPDATE `admin` SET `Password` = '".addslashes($_REQUEST['txtNewPwd'])."'" 
						." WHERE `Ident` = ". $_SESSION['admin_id'];
			$UpResult	= $this->ExecuteQuery($UpQuery, "update");
			$objSmarty->assign("SuccessMessage", "Password has been updated successfully");
			$objSmarty->assign("ErrorMessage", "");
			$select_password ="SELECT * FROM `admin`";
			$result =$this->ExecuteQuery($select_password,"select");
			$objSmarty->assign("current_password",$result);
		}
		else
		{
			$objSmarty->assign("ErrorMessage", "Invalid current password");
		}
	}
	
	/*========== Checking whether the given password is correct or not ===========*/ 
	function chkPassword($CurPwd, $admin_id)
	{
		$SelQuery	= "SELECT `Ident` FROM `admin`"
		              ." WHERE binary `Password` = '".$CurPwd."' AND `Ident` = ".$admin_id." LIMIT 0,1";
		$SelResult	= $this->ExecuteQuery($SelQuery, "select");
		if(!empty($SelResult) && !empty($SelResult[0]['Ident']))
			return true;
		else
			return false;
	}
	
	/*========== Sending the password ===========*/ 
	function forgotPassword()
	{
		global $objSmarty;
		extract($_REQUEST);
		$SelQuery	= "SELECT * FROM `admin`"
		              ." WHERE `Email` = '".$txtEmail."' LIMIT 0,1";
		$SelResult	= $this->ExecuteQuery($SelQuery, "select");
		if(!empty($SelResult) && !empty($SelResult[0]['Ident'])){
			$Username = $SelResult[0]['Username'];
			$Password = $SelResult[0]['Password'];
			$subject = "Password Request!!!";
			$message='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
				<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
				<title>Password Retrival</title>
				<link href="melslifecss.css" rel="stylesheet" type="text/css" />
				</head>
				
				<body>
				<table width="75%" border="0" align="center" cellpadding="5" cellspacing="0" class="border_grey">
				  <tr>
					<td></td>
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
						<td colspan="2" align="left" valign="middle" ><span style="font-family: Arial, Helvetica, sans-serif;	font-size: 12px; font-weight: bold;	color: #000000;	text-decoration: none;" >Username: &nbsp;</span><b>'.$Username.'</b></td>
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
					<td align="center" bgcolor="#7e7e7e"><span class="footer_text">&copy; 2015. Pro Musician List. All Rights Reserved.</span></td>
				  </tr>
				</table>
				</body>
				</html>';
				$headers = 'From: admin@admin.com'."\r\n";
				$headers.= 'Reply-To: admin@admin.com'."\r\n";
				$headers.= "MIME-Version: 1.0\r\n";
				$headers.= "Content-type: text/html; charset=iso-8859-1\r\n";		
				//echo $message. $headers;			
				$mail=@mail($txtEmail,$subject,$message,$headers);
			$objSmarty->assign("SuccessMessage", "Login details has been sent successfully. Please check your mail");
		}else{
			$objSmarty->assign("ErrorMessage", "Given email is not available in our database. Please check the email you have entered");
		}
	}
	
	/*========== Checking whether the given Username is correct or not ===========*/ 
	function chkUser($CurPwd, $admin_id)
	{
		$SelQuery	= "SELECT `Ident` FROM `admin`"
		              ." WHERE binary `Username` = '".$CurPwd."' AND `Ident` = ".$admin_id." LIMIT 0,1";
		$SelResult	= $this->ExecuteQuery($SelQuery, "select");
		if(!empty($SelResult) && !empty($SelResult[0]['Ident']))
			return true;
		else
			return false;
	}
	
	/*========== Changing the Username ===========*/ 
	function changeUser()
	{
		global $objSmarty;
		if($this->chkUser($_REQUEST['txtCurUsr'], $_SESSION['admin_id'])){
			$UpQuery = "UPDATE `admin` SET `Username` = '".addslashes($_REQUEST['txtNewUsr'])."'" 
					   ." WHERE `Ident` = ". $_SESSION['admin_id'];
			$UpResult	= $this->ExecuteQuery($UpQuery, "update");
			$objSmarty->assign("SuccessMessage", "Username has been updated successfully");
			$objSmarty->assign("ErrorMessage", "");
		}else{
			$objSmarty->assign("ErrorMessage", "Invalid current username");
		}
	}
	
	/*========== Checking whether the given email is correct or not ===========*/ 
	function chkEmail($CurPwd, $admin_id)
	{
		$SelQuery	= "SELECT `Ident` FROM `admin`"
		              ." WHERE `Email` = '".$CurPwd."' AND `Ident` = ".$admin_id." LIMIT 0,1";
		$SelResult	= $this->ExecuteQuery($SelQuery, "select");
		if(!empty($SelResult) && !empty($SelResult[0]['Ident']))
			return true;
		else
			return false;
	}
	
	/*========== Changing the Email ===========*/ 
	function changeEmail()
	{
		global $objSmarty;
		if($this->chkEmail($_REQUEST['txtCurEmail'], $_SESSION['admin_id'])){
			$UpQuery = "UPDATE `admin` SET `Email` = '".addslashes($_REQUEST['txtNewEmail'])."'"
			           ." WHERE `Ident` = ". $_SESSION['admin_id'];
			$UpResult	= $this->ExecuteQuery($UpQuery, "update");
			$objSmarty->assign("SuccessMessage", "Email has been updated successfully");
			$objSmarty->assign("ErrorMessage", "");
		}else{
			$objSmarty->assign("ErrorMessage", "Invalid current email");
		}
	}
	/*========== User Panel ===========*/ 
	function chkuserLogin()
	{
		global $objSmarty;
		$SelQuery="Select count(*) from `tbl_members` where `Username`='".$_REQUEST['loginusername']."' AND `Password`='".$_REQUEST['loginpassowrd']."'";
		$SelResult=$this->ExecuteQuery($SelQuery,"select");
		$count=$this->ExecuteQuery($SelQuery, "norows");
		if($count>0)
		{
			//session_register("ID");
           // session_register("Username");
    		$_SESSION['ID']=$SelResult[0]['ID'];
    		$_SESSION['Username']=$SelResult[0]['Username'];
			header('Location:index.php');
		}
		else{
			$objSmarty->assign("ErrorMessage", "Invalid Login");
		}
	}
	
	
function forgotuserPassword()
	{
		global $objSmarty;
		extract($_REQUEST);
		$SelQuery	= "SELECT * FROM `tbl_user`"
		              ." WHERE `Email` = '".$_REQUEST['txtEmail']."' ";
		$SelResult	= $this->ExecuteQuery($SelQuery, "select");
		if(!empty($SelResult)){
			$Email = $SelResult[0]['Email'];
			$Password = $SelResult[0]['Password'];
			$subject = "Password Request!!!";
			$message='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
				<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
				<title>Password Retrival</title>
				<link href="melslifecss.css" rel="stylesheet" type="text/css" />
				</head>
				
				<body>
				<table width="75%" border="0" align="center" cellpadding="5" cellspacing="0" class="border_grey">
				  <tr>
					<td></td>
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
								color: #D53B29;">Welcome to Bookwormz </td>
					  </tr>
					  <tr>
						<td height="8"></td>
						<td height="8" colspan="2" ></td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td colspan="2" align="left" valign="middle" ><div align="justify" style="font-family: Arial, Helvetica, sans-serif;font-size: 12px;font-weight: normal;color: #000000;text-decoration: none;" >Your login detail ,</div></td>
					  </tr>
					  <tr>
						<td height="8"></td>
						<td height="8" colspan="2"></td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td colspan="2" align="left" valign="middle" ><span style="font-family: Arial, Helvetica, sans-serif;	font-size: 12px; font-weight: bold;	color: #000000;	text-decoration: none;" >Email: &nbsp;</span><b>'.$Email.'</b></td>
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
						<td height="8" colspan="2" align="left">Bookwormz Team</td>
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
					<td align="center" bgcolor="#7e7e7e"><span class="footer_text">&copy; 2013. www.bookwormz.com. All Rights Reserved.</span></td>
				  </tr>
				</table>
				</body>
				</html>';
				$headers = 'From: admin@admin.com'."\r\n";
				$headers.= 'Reply-To: admin@admin.com'."\r\n";
				$headers.= "MIME-Version: 1.0\r\n";
				$headers.= "Content-type: text/html; charset=iso-8859-1\r\n";		
				//echo $message;
				$mail=@mail($txtEmail,$subject,$message,$headers);
			$objSmarty->assign("SuccessMessage", "Login details has been sent successfully. Please check your mail");
		}else{
			$objSmarty->assign("ErrorMessage", "Given email is not available in our database. Please check the email you have entered");
		}
	}
}
?>