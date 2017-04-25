<?php
class Login extends MysqlFns
{
	function Login()
	{
		global $config;
        $this->MysqlFns();
		$this->Offset			= 0;
		$this->Limit			= 15;
		$this->page				= 0;
		$this->Keyword			= '';
		$this->Operator			= '';
		$this->PerPage			= '';
	}
	
	function chkLogin()
	{
	global $_SESSION;
		if(isset($_SESSION['UserId']) && !empty($_SESSION['UserId']))
		{
			return true;
		}
		else{
			//Redirect("index.php");
			header("Location:index.php");
		}
		//echo "check user login block...";
	} 
	
function MakeLoginusers()
	{
	
		global $objSmarty;
		 	 $sql = "SELECT * FROM `tbl_user`"
			 ." WHERE  `Email`='".addslashes($_REQUEST['Logemail'])."'  AND binary `Password`='".addslashes($_REQUEST['password'])."' ";
			 $sle		= $this->ExecuteQuery($sql, "select");
			 $Count		= $this->ExecuteQuery($sql, "norows");
			if($Count > 0){
				
			if (isset($_REQUEST['Logemail']) && isset($_REQUEST['password'])) {

  $Logemail = $_REQUEST['Logemail'];
  $password = $_REQUEST['password'];

  if (isset($_REQUEST['remember']) && $_REQUEST['remember'] == 'on') {
  
    /*
     * Set Cookie from here for one hour
     * */
    setcookie("Logemail", $Logemail, time() + 31536000);
    setcookie("password", $password, time() + 31536000);  /* expire in 1 hour */
  } else {
    /**
     * Following code will unset the cookie
     * it set cookie 1 sec back to current Unix time
     * so that it will invalid
     * */
    //setcookie("username", $username, time()-1);
    //setcookie("password", $password, time()-1);
  }

} else {
  $email = '';
  $password = '';

  if (isset($_COOKIE['Logemail'])) {
    $Logemail = $_COOKIE['Logemail'];
  }

  if (isset($_COOKIE['password'])) {
    $password = $_COOKIE['password'];
  }
}

			
			
			 	if($sle[0]['Status']==1 && $sle[0]['MailStatus']==1){
			 		$details = $this->ExecuteQuery($sql, "select");
			 		session_start();
			 		$_SESSION['Email']=$details[0]['Email'];
			 		//$_SESSION['UserName']=$details[0]['Username'];
			 		$_SESSION['FirstName']=$details[0]['FirstName'];
			 		$_SESSION['LastName']=$details[0]['LastName'];
					$_SESSION['UserType']=$details[0]['UserType'];
					$_SESSION['UserId']=$details[0]['UserId'];
					$_SESSION['session_id']=session_id();
					$_SESSION['last_activetime'] = time();
			 		// for the cookies variable update	 
	          //print_r($details);exit;
					 if($_REQUEST['ty']==1){
					 		 header("Location:referfriends.php");
					 }else{
					 //header("Location:dashboard.php");
					 header("Location:profile.php");
					 } //exit;
			 	}if($sle[0]['Status']==0 && $sle[0]['MailStatus']==1){
			 		$objSmarty->assign("ErrorMessage", "Admin has been blocked your account.");
			 	}
			 if($sle[0]['Status']==0 && $sle[0]['MailStatus']==0){
			 		$objSmarty->assign("ErrorMessage", "Your account is not yet activated.Please check your mail and activate your account.");
			 	}
			  if($sle[0]['Status']==1 && $sle[0]['MailStatus']==0){
			 		$objSmarty->assign("ErrorMessage", "Your account is not yet activated.Please check your mail and activate your account.");
			 	}
			 }else{
			 	$objSmarty->assign("ErrorMessage", "Invalid Login");
			 }
		 $objSmarty->assign("Logemail", $Logemail);
			 $objSmarty->assign("password", $password);	
	}
	
	function getOrderDetails($id)
	{
		 global $objSmarty;
		$SelQuery	= "SELECT * FROM `payment`"
					  ." WHERE `ID`='$id'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
		$objSmarty->assign("OrderList",$ExeSelQuery);
	}
	
	
	function MakeLogout()
	{	
		unset($_SESSION['UserName']);
unset($_SESSION['FirstName']);unset($_SESSION['LastName']);unset($_SESSION['Email']);
		unset($_SESSION['UserId']);
		unset($_SESSION['UserType']);
		unset($_SESSION['session_id']);
		
			Redirect("index.php");
	}
	
	function forgotPass()
	{
		global $objSmarty,$config;
		$sql = "SELECT * FROM `tbl_user`"
		       ." WHERE `Email` = '".$_REQUEST['email']."'";
		       
		$Count		= $this->ExecuteQuery($sql, "norows");
		if($Count > 0){
			$details = $this->ExecuteQuery($sql, "select");
			$Email = $details[0]['Email'];			
			$Name=$details[0]['FirstName'].' '.$details[0]['LastName'];
			$Password=$details[0]['Password'];
			$subject = "PromusiciansList - Password Request!!!";
			$sql="select * from tbl_site where Id='1'";
		$Result	= $this->ExecuteQuery($sql, "select");
		$from=$Result[0]['Email'];
			
			
			$imgurl="".$config['SiteGlobalPath']."/admin/img/logo.png";
			$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
			                <td width="17%" bgcolor="#F8F8F8"></td>
			                <td width="83%" height="25" align="left" valign="middle" bgcolor="#F8F8F8" ><span class="normal_blue">Hi '.$Name.'</span></td>
			                </tr>
							<tr>
			                <td bgcolor="#F8F8F8"></td>
			                <td height="25" align="left" valign="middle" bgcolor="#F8F8F8" ><span class="normal_blue">Your login details:</span></td>
			                </tr>
			                <tr>
			                <td bgcolor="#F8F8F8"</td>
			                <td height="25" align="left" valign="middle" bgcolor="#F8F8F8" ><span style="font-family: Arial, Helvetica, sans-serif;	font-size: 12px; font-weight: bold;	color: #000000;	text-decoration: none;" >Email: &nbsp;</span><b>'.$Email.'</b></td>
			                </tr>
							<tr>
			                <td valign="top" bgcolor="#F8F8F8"></td>
			                <td height="25" align="left" valign="middle" bgcolor="#F8F8F8" ><span style="font-family: Arial, Helvetica, sans-serif;	font-size: 12px; font-weight: bold;	color: #000000;	text-decoration: none;" >Password: &nbsp;</span><b>'.$Password.'</b></td>
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
		
			$headers = 'From: '.$from."\r\n";
			$headers.= 'Reply-To: '.$from."\r\n";
			$headers.= "MIME-Version: 1.0\r\n";
			$headers.= "Content-type: text/html; charset=iso-8859-1\r\n";		
		
			//echo $message;
			@mail($Email,$subject,$message,$headers);
			$objSmarty->assign("SuccessMessage", "Login details has been sent successfully. Please check your mail");
					
		}else{
			$objSmarty->assign("ErrorMessage", "Given email is not available in our database. Please check the email you have entered");
		}
	}
	
	
	
}
	

	
	
	
	
	
	

	

?>