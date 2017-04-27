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
	
	
	function adminlogin()
	{
		
		global $objSmarty;		
	/*if($_REQUEST['usertype'] == 'Admin')
		{
			if(isset($_REQUEST['username']) && $_REQUEST['username']!=''){
		
				$username=$_REQUEST['username'];
				}
				if(isset($_REQUEST['password']) && $_REQUEST['password']!=''){
				$password=$_REQUEST['password'];
				}

				 $selectUser="select * from admin where Username='".$username."' and Password='".$password."'";
				 $exeUser=$this->ExecuteQuery($selectUser, 'select');
				$countUser=$this->ExecuteQuery($selectUser, "norows");
				if($countUser > 0)
					{
								
						$_SESSION['userid']=$exeUser[0]['Ident'];
						$_SESSION['username']=$exeUser[0]['Username'];
						$_SESSION['usertype']=$_REQUEST['usertype'];
						header('Location: controlPanel.php');
					
					}
		
		else{
						
						header('Location: index.php?err=Invalid login credantials');
						//$objSmarty->assign("Errormsg","Invalid login credantials");
					}
		}*/
					
	/*	if($_REQUEST['usertype'] == 'User')
		{*/
		
			if(isset($_REQUEST['username']) && $_REQUEST['username']!=''){
		
				$username=$_REQUEST['username'];
				}
				if(isset($_REQUEST['password']) && $_REQUEST['password']!=''){
				$password=$_REQUEST['password'];
				}
			

				$selectUser="select * from `tbl_users` where EmployeeName='".$username."' and Password='".$password."'";
				 $exeUser=$this->ExecuteQuery($selectUser, 'select');
				$countUser=$this->ExecuteQuery($selectUser, "norows");
				if($countUser > 0)
					{
								
						$_SESSION['userid']=$exeUser[0]['Id'];
						$_SESSION['EmployeeName']=$exeUser[0]['EmployeeName'];
						$_SESSION['Email']= $exeUser[0]['Email'];
						$_SESSION['usertype']=$_REQUEST['usertype'];
						header('Location: controlPanel.php');
					
					}		
		else{						
						header('Location: index.php?err=Invalid login credantials');
						//$objSmarty->assign("Errormsg","Invalid login credantials");
					}
		/*}*/
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
	
	/*=================GET DEPT DETAILS========================*/
    function Getdepartment()
	{
	global $objSmarty;
	$sql="select * from tbl_department";
	$Result	= $this->ExecuteQuery($sql, "select");
	$objSmarty->assign("Dept", $Result);
	$i=1;
	$objSmarty->assign("i", $i);
	}
	
     /*=================GET DEPT BY ID==========================*/
    function GetdeptByID()
	{
	global $objSmarty;
    $sql="select * from tbl_department where Status='1'";
	$Result	= $this->ExecuteQuery($sql, "select");
	$objSmarty->assign("dept", $Result);
	}
	/*===================GET USER BY ID==========================*/
	function GetuseByID()
	{
	global $objSmarty;
	$sql="select * from tbl_users where Status='1'";
	$Result	= $this->ExecuteQuery($sql, "select");
	$objSmarty->assign("use", $Result);
	}
	
	function userId($id)
	{
	global $objSmarty;
	$sql="select * from tbl_users where Id IN ($id)";
	$Result	= $this->ExecuteQuery($sql, "select");
	$objSmarty->assign("us", $Result);
	}
	
	function Getnotuser()
	{
	global $objSmarty;
	$sql="select * from tbl_users where Id !='".$_SESSION['userid']."'";
	$Result	= $this->ExecuteQuery($sql, "select");
	$objSmarty->assign("user", $Result);
	}
	/*===================GET Meeting Type==========================*/
	function Getmeetingtype()
	{
	global $objSmarty;
	$sql="select * from tbl_meetingtype where Status='1'";
	$Result	= $this->ExecuteQuery($sql, "select");
	$objSmarty->assign("type", $Result);
	}
	function Getmeetingtpart()
	{
	global $objSmarty;
	$sql="select * from tbl_meetings where Status='1'";
	$Result	= $this->ExecuteQuery($sql, "select");
	$objSmarty->assign("part", $Result);
	}
	/*=================ADD DEPT DETAILS========================*/	
    function add_department()
	{
	 global $objSmarty,$objPage;
	       $SelQuery	= "SELECT * from `tbl_department`
						WHERE 
						`DepartmentName`='".addslashes($_REQUEST['DepartmentName'])."'";

		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"norows");
		if(!$ExeSelQuery)
		{
			$InsQuery	= "INSERT INTO `tbl_department`
											    (
											       `DepartmentName`,
												   `Status`
											    )
											     VALUES 
											    (
											       '".addslashes($_REQUEST['DepartmentName'])."',
												   '1'
												   
											     )";
			$ExeInsQuery=$this->ExecuteQuery($InsQuery,"insert");
			$objSmarty->assign("SuccessMessage","Department has been added successfully");
		}
		else
		{
			$objSmarty->assign("ErrorMessage","Department already exists");
		}
	}
	/*========================UPDATE DEPARTMENT BY ID================*/
	function getDepartmentById()
	{
		global $objSmarty;
		if($_REQUEST['Ident']!=''){
			$selQuery="select * from tbl_department where Id='".$_REQUEST['Ident']."'";
			$res=$this->ExecuteQuery($selQuery, "select");
			$objSmarty->assign("Depart",$res);
		}else{
			redirect('manage_dept.php');
		}
	}
	
		function update_dept()
	{
		global $objSmarty,$objPage;
		
		 $SelQuery	= "SELECT * from `tbl_department`
		 
						WHERE 
						`DepartmentName`='".addslashes($_REQUEST['DepartmentName'])."' and Id !='".$_REQUEST['Ident']."'";

		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"norows");
		if(!$ExeSelQuery)
		{
			$UPQuery	= "Update `tbl_department` set
						`DepartmentName`='".addslashes($_REQUEST['DepartmentName'])."'
						 where Id=".$_REQUEST['Ident'];

			$ExeInsQuery=$this->ExecuteQuery($UPQuery,"update");
			$objSmarty->assign("SuccessMessage","Department has been updated successfully");
		}
		else
		{
			$objSmarty->assign("ErrorMessage","Department already exists");
		}
	}
	

    /*========================GET USER DETAILS====================*/
    function Getuser()
	{
	global $objSmarty;
	$sql="select * from tbl_users";
	$Result	= $this->ExecuteQuery($sql, "select");
	$objSmarty->assign("User", $Result);
	$i=1;
	$objSmarty->assign("i", $i);
	}
	 /*=========================GET USER ID DETAILS===================*/
	
	function getDepartmentnameById($Id)
	 {
	 	 $query= "SELECT * FROM tbl_department WHERE Id='".$Id."'";
		  $row1 = mysql_query($query);
		  $res = mysql_fetch_array($row1);
          return $res['DepartmentName'];
	    	
	 }	
	
   /*=========================ADD USER DETAILS===================*/
   function add_user()
	{
		global $objSmarty,$objPage;
	  $SelQuery	= "SELECT * from `tbl_users`
						WHERE 
						`EmployeeId`='".addslashes($_REQUEST['EmployeeId'])."'
						OR
						`Email`='".addslashes($_REQUEST['Email'])."'"; 

		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"norows");
		if(!$ExeSelQuery)
		{
		$InsQuery	= "INSERT INTO `tbl_users`
											    (
											       `EmployeeId`,
												   `EmployeeName`,
												   `Password`,
												   `Email`,
												   `Department_Id`,
												   `Designation`,
												   `Status`
											    )
											     VALUES 
											    (
											       '".addslashes($_REQUEST['EmployeeId'])."',
											       '".addslashes($_REQUEST['EmployeeName'])."',
											       '".addslashes($_REQUEST['Password'])."',
											       '".addslashes($_REQUEST['Email'])."',
											       '".addslashes($_REQUEST['DepartmentName'])."',
											       '".addslashes($_REQUEST['Designation'])."',
											       '1'
												)";
			$ExeInsQuery=$this->ExecuteQuery($InsQuery,"insert");
			$objSmarty->assign("SuccessMessage","User has been added successfully");
		}
		else
		{
			$objSmarty->assign("ErrorMessage","Email address/Employee ID already exists");
		}
	}
	
    /*========================GET DEPT BY ID================*/
	function getUserById()
	{
		global $objSmarty;
		if($_REQUEST['Ident']!=''){
			$selQuery="select * from tbl_users where Id='".$_REQUEST['Ident']."'";
			$res=$this->ExecuteQuery($selQuery, "select");
			$objSmarty->assign("Users",$res);
		}else{
			redirect('manage_user.php');
		}
	}
	
	function update_user()
	{
		global $objSmarty,$objPage;
		
		 $SelQuery	= "SELECT * from `tbl_users`
						WHERE 
						(`EmployeeId`='".addslashes($_REQUEST['EmployeeId'])."' 
						OR
						`Email`='".addslashes($_REQUEST['Email'])."')
						and 
						Id !='".$_REQUEST['Ident']."'";

		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"norows");
		if(!$ExeSelQuery)
		{
			 	$UPQuery =  "Update `tbl_users` set
						`EmployeeId`='".addslashes($_REQUEST['EmployeeId'])."',
						`EmployeeName`='".addslashes($_REQUEST['EmployeeName'])."',
						`Password`='".addslashes($_REQUEST['Password'])."',
						`Email`='".addslashes($_REQUEST['Email'])."',
						`Department_Id`='".addslashes($_REQUEST['DepartmentName'])."',
						`Designation`='".addslashes($_REQUEST['Designation'])."'
						 where Id=".$_REQUEST['Ident'];
			$ExeInsQuery=$this->ExecuteQuery($UPQuery,"update");
			$objSmarty->assign("SuccessMessage","User has been updated successfully");
		}
		else
		{
			$objSmarty->assign("ErrorMessage","User Details already exists");
		}
		
	}
	/*===========================UPDATE MEETING====================*/
	function getMeetingById()
	{
		global $objSmarty;
		if($_REQUEST['Ident']!=''){
		 $selQuery="select *,DATE_FORMAT(MeetingDate,'%m/%d/%Y') as MeetingDate from tbl_meetings where Id='".$_REQUEST['Ident']."'";
			$res=$this->ExecuteQuery($selQuery, "select");
			$objSmarty->assign("meet",$res);
			
			/************************For count******************************/
			 $selQuery="select * from tbl_actions where MeetingId='".$_REQUEST['Ident']."'";
			$res=$this->ExecuteQuery($selQuery, "select");
			$count=$this->ExecuteQuery($selQuery, "norows");
			/************************For count******************************/
			//echo $res[0]['ActionItem'];
			//$objSmarty->assign("act",$res);
			$objSmarty->assign("count",$count);
			
			$i=1;
			$objSmarty->assign("i",$i);
		}else{
			redirect('manage_meeting.php');
		}
	}
	function getActionById()
	{
		global $objSmarty;
		if($_REQUEST['Ident']!=''){
			 $selQuery="select * from tbl_actions where MeetingId='".$_REQUEST['Ident']."'";
			$res=$this->ExecuteQuery($selQuery, "select");
			$count=$this->ExecuteQuery($selQuery, "norows");
			//echo $res[0]['ActionItem'];
			$objSmarty->assign("act",$res);
			$objSmarty->assign("count",$count);
		}else{
			redirect('manage_meeting.php');
		}
	}
function getActionitemById($from,$to)
	{
		global $objSmarty;
			$selQuery="select * from tbl_actions where MeetingId='".$_REQUEST['Ident']."' limit $from,$to";
			$res=$this->ExecuteQuery($selQuery, "select");
			$count=$this->ExecuteQuery($selQuery, "norows");
			//echo $res[0]['ActionItem'];
			$objSmarty->assign("getAction",$res);
		
	}
 
	
	/*======================GET MEETING DETAILS=====================*/
	function Getmeeting()
	{
	global $objSmarty;
	
	/*if($_SESSION['usertype']=="Admin"){*/
	  $sql="select t1.Id as meetId,t1.Id,t1.Status as meetstatus, t1.MeetingName, 
						t1.MeetingType, 
						t1.CreatedBy,
						t1.MeetingDate, 
						t1.ProgramName,
						t1.ProjectName,
						t1.InfoProvidedDesc,
						t1.MeetingOwnerUserID,
						t1.ActionStatus,
						t2.Id as actionId,
						t2.MeetingId,
						t2.ActionItem, 
						t2.StatusOfAction,
						t2.DueDate,
						t2.Status 
		 from 
		 	tbl_meetings t1 
		 left join 
		 	tbl_actions t2 
		 on  
		 	t1.Id = t2.MeetingId
		 	where t1.CreatedBy ='".$_SESSION['userid']."'
	 		OR t2.DepatuserId='".$_SESSION['userid']."'
		 	";
	//}
	/*if($_SESSION['usertype']=="User"){
	 $sql="select t1.Id, t1.MeetingName, 
						t1.MeetingType, 
						t1.MeetingDate, 
						t1.MeetingOwnerUserID,
						t1.ActionStatus,
						t2.Id as actionId,
						 t2.ActionItem, 
						 t2.DueDate,
						
						  t2.Status 
		 from 
		 	tbl_meetings t1 
		 join 
		 	tbl_actions t2 
		 on 
		 	t1.id = t2.MeetingId where t2.DepatuserId='".$_SESSION['userid']."'";
	}*/
	 
	$Result	= $this->ExecuteQuery($sql, "select");
	$objSmarty->assign("meet", $Result);
	
	$i=1;
	$objSmarty->assign("i", $i);
	}
	
	/*====================  for mail functonality ===============================*/
	

	
	/*======================GET MEETING DETAILS=====================*/
	function Getsixmonthmeeting()
	{
	global $objSmarty;
	
	
	$where = "";
	
	if(!empty($_REQUEST['Name']) && $_REQUEST['Name'] != "")
	{
		$where ="and MeetingName like '%".trim(addslashes($_REQUEST['Name']))."%'";
	}
	
	if(isset($_REQUEST['Date']) && $_REQUEST['Date']!='' ){
		$date=explode('/',$_REQUEST['Date']);
		$date=$date[2]."-".$date[0]."-".$date[1];
		$where="and DATE_FORMAT(MeetingDate	,'%Y-%m-%d')='$date'";
		}
	if(!empty($_REQUEST['ActionStatus']) && $_REQUEST['ActionStatus'] != "")
	{
		$where ="and ActionStatus like '%".trim(addslashes($_REQUEST['ActionStatus']))."%'";
	}
	 $sql="SELECT * FROM tbl_meetings WHERE MeetingDate > DATE_SUB( now( ) , INTERVAL 6 MONTH ) $where";
	

	 
	$Result	= $this->ExecuteQuery($sql, "select");
	$objSmarty->assign("meet", $Result);
	
	}
	
	
	function getuserid($id){
	global $objSmarty;
	$selQuery="select * from tbl_users where Status='1' order by EmployeeName asc";
	$res=$this->ExecuteQuery($selQuery, "select");
	$objSmarty->assign("User",$res);
	}
	/*==========================ADD MEETING=================*/
 	function add_meeting()
	{
		global $objSmarty,$objPage;
	   	$SelQuery	= "SELECT * from `tbl_meetings`
						WHERE 
						`MeetingDate`='".addslashes($_REQUEST['MeetingDate'])."'";

		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"norows");
		if(!$ExeSelQuery)
		{
			
			$part=implode(',',$_REQUEST['part']);
			$date=explode('/',$_REQUEST['MeetingDate']);
			$date=$date[2]."-".$date[0]."-".$date[1];
			$Target=explode('/',$_REQUEST['TargetDate']);
			$Targetdate=$Target[2]."-".$Target[0]."-".$Target[1];
		    $InsQuery	= "INSERT INTO `tbl_meetings`
											    (
											       `MeetingName`,
												   `MeetingType`,
												   `MeetingDate`,
												   `MeetingOwnerDepartmentID`,
												   `MeetingOwnerUserID`,
												   `ProgramName`,
												   `Target_Date`,
												   `In_Time_Completion`,
													`No_Of_Revision`,
													`Delayed_Days`,
													`Meeting_Time`,
													`Meeting_Venue`,
													`CreatedBy`,
													`Discussion`,
												   `ProjectName`,
												   `Participation`,
												   `InfoProvidedDesc`,
												   `ActionStatus`,
												   `Status`,
												   `CreatedDate`
											    )
											     VALUES 
											    (
											       '".addslashes($_REQUEST['MeetingName'])."',
												   '".addslashes($_REQUEST['meetingtype'])."',
											       '".$date."',
												   '".addslashes($_REQUEST['DepartmentName'])."',
											       '".addslashes($_REQUEST['department_user'])."',
											       '".addslashes($_REQUEST['ProgramName'])."',
												   '".$Targetdate."',
												   '".addslashes($_REQUEST['completion'])."',
												   '".addslashes($_REQUEST['revision'])."',
												   '".addslashes($_REQUEST['Delayed'])."',
												   '".addslashes($_REQUEST['timepicker'])."',
												   '".addslashes($_REQUEST['venue'])."',
												   '".$_SESSION['userid']."',
												   '".addslashes($_REQUEST['Discussion'])."',
											       '".addslashes($_REQUEST['ProjectName'])."',
												   '".addslashes($part)."',
											       '".addslashes($_REQUEST['InfoProvidedDesc'])."',
											       '".addslashes($_REQUEST['ActionStatus'])."',
											       '1',
												   now()
												  )";
			$ExeInsQuery=$this->ExecuteQuery($InsQuery,"insert");
			$meetinglastID = mysql_insert_id();
		    $action=$_REQUEST['Actionitem'];
		    
			//print_r($_REQUEST);
			for($i=1;$i<=$action;$i++)
			{
				//echo $i;
				$act=addslashes($_REQUEST['ActionItemId_'.$i]);
				$depttask=addslashes($_REQUEST['DependentTaskId_'.$i]);
				$dept=addslashes($_REQUEST['DepartmentId_'.$i]);
				$deptuser=addslashes($_REQUEST['DepatuserId_'.$i]);
				$status=addslashes($_REQUEST['statusid_'.$i]);
				
				$dateloop=explode('/',$_REQUEST['datepickerid_'.$i]);
				$datepick=$dateloop[2]."-".$dateloop[0]."-".$dateloop[1];
				
				
				//$datepick=$_REQUEST['datepickerid_'.$i];
				
				 $InsQuery	= "INSERT INTO `tbl_actions`
											    (
											       `MeetingId`,
											       `ActionItem`,
												   `DependentTask`,
												   `DepartmentId`,
												   `DepatuserId`,
												   `StatusOfAction`,
												   `DueDate`,
												   `Status`
											    )
											     VALUES 
											    (
											       '".$meetinglastID."',
											       '".$act."',
											       '".$depttask."',
											 	   '".$dept."',
											       '".$deptuser."',
											       '".$status."',
											       '".$datepick."',
											       '1'
												  )";
			
			$ExeInsQuery=$this->ExecuteQuery($InsQuery,"insert");
			}
			
			//$objSmarty->assign("SuccessMessage","Meeting has been added successfully");
		
	
		$FromMail=$_SESSION['Email'];
		global $objSmarty;
	
		 $SELECT="SELECT Email from tbl_users where Id='".$_REQUEST['part']."'";
		$ExeSELQuery=$this->ExecuteQuery($SELECT,"select");
		
			$subject = "Meetig Invite!!!";
			$message='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
				<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
				<title>Password Retrival</title>
				<link href="melslifecss.css" rel="stylesheet" type="text/css" />
				</head>
				
				<body>
				<table border="0" cellpadding="2" cellspacing="0" class="grid-table" style="width: 70%; margin-left: 190px;">
			<tr>
				<td width="30%" style="padding: 15px;">
				Meeting Name:</td>
				<td>'.$_REQUEST['MeetingName'].' </td>
			</tr> 
			<tr>
				<td style="padding: 15px;">Meeting Date:</td>
				<td>'.$_REQUEST['MeetingDate'].'</td>
			</tr>	
			<tr>	
			<td style="padding: 15px;">Meeting time:</td>
			<td>'.$_REQUEST['time'].'</td>
			</tr>		
			<tr>
				<td style="padding: 15px;">Meeting venue:</td>
				<td>'.$_REQUEST['venue'].' </td>
			</tr>			
			</table>
				</body>
				</html>';
				$headers = "From: '".$FromMail."'"."\r\n";
				$headers.= "Reply-To: '".$FromMail."'"."\r\n";
				$headers.= "MIME-Version: 1.0\r\n";
				$headers.= "Content-type: text/html; charset=iso-8859-1\r\n";		
				//echo $message. $headers;			
				$mail=@mail($txtEmail,$subject,$message,$headers);
			$objSmarty->assign("SuccessMessage", "Meeting details has been sent successfully.");
		}
		else
		{
			$objSmarty->assign("ErrorMessage","Meeting Details already exists");
		}	
		
	}
	
	/*********************Delete for particular Id *******************/
function update_meeting()
	{
		global $objSmarty,$objPage;
		//print_r($_REQUEST);
	   	$SelQuery	= "SELECT * from `tbl_meetings`
						WHERE 
						`MeetingDate`='".addslashes($_REQUEST['MeetingDate'])."' and Id!='".$_REQUEST['Ident']."'";

		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"norows");
		if(!$ExeSelQuery)
		{
			$part=implode(',',$_REQUEST['part']);
			$date=explode('/',$_REQUEST['datepicker']);
			$dateorder=$date[2]."-".$date[0]."-".$date[1];
			$Target=explode('/',$_REQUEST['TargetDate']);
			$Targetdate=$Target[2]."-".$Target[0]."-".$Target[1];
		$UPQuery =  "Update `tbl_meetings` set
												   `MeetingName`='".addslashes($_REQUEST['MeetingName'])."',
												   `MeetingType`='".addslashes($_REQUEST['meetingtype'])."',
												   `MeetingDate`='".$dateorder."',
												   `MeetingOwnerDepartmentID`='".addslashes($_REQUEST['DepartmentName'])."',
												   `MeetingOwnerUserID`='".addslashes($_REQUEST['department_user'])."',
												   `ProgramName`='".addslashes($_REQUEST['ProgramName'])."',
												   `Target_Date`='".$Targetdate."',
												   `In_Time_Completion`='".addslashes($_REQUEST['completion'])."',
												   `No_Of_Revision`='".addslashes($_REQUEST['revision'])."',
												   `Delayed_Days`='".addslashes($_REQUEST['Delayed'])."',
												   `Meeting_Time`='".addslashes($_REQUEST['time'])."',
												   `Meeting_Venue`='".addslashes($_REQUEST['venue'])."',
												   `CreatedBy`= '".$_SESSION['userid']."',
												   `Discussion`='".addslashes($_REQUEST['Discussion'])."',
												   `ProjectName`='".addslashes($_REQUEST['ProjectName'])."',
												   `Participation`='".$part."',										   
												   `InfoProvidedDesc`='".addslashes($_REQUEST['InfoProvidedDesc'])."',
												   `ActionStatus`='".addslashes($_REQUEST['ActionStatus'])."',
											       `UpdatedDate`=now()
												   where Id='".$_REQUEST['Ident']."'";

			$ExeInsQuery=$this->ExecuteQuery($UPQuery,"update");
			$meetinglastID = mysql_insert_id();
		    $action=$_REQUEST['Actionitem'];
		    
		    $SelQuery	= "DELETE  from `tbl_actions` WHERE `MeetingId`='".$_REQUEST['Ident']."'";
			$ExeInsQuery=$this->ExecuteQuery($SelQuery,"delete");
			//print_r($_REQUEST);
			//echo $i;
			for($i=1;$i<=$action;$i++)
			{
				//echo $i;
				$act=addslashes($_REQUEST['ActionItemId_'.$i]);
				$depttask=addslashes($_REQUEST['DependentTaskId_'.$i]);
				$dept=addslashes($_REQUEST['DepartmentId_'.$i]);
				$deptuser=addslashes($_REQUEST['DepatuserId_'.$i]);
				$stat=addslashes($_REQUEST['statusid_'.$i]);
				
				$dateloop=explode('/',$_REQUEST['datepickerid_'.$i]);
				$datepick=$dateloop[2]."-".$dateloop[0]."-".$dateloop[1];
				 	
				//$datepick=$_REQUEST['datepickerid_'.$i];
				
				 $InsQuery	= "INSERT INTO `tbl_actions`
											    (
											       `MeetingId`,
											       `ActionItem`,
												   `DependentTask`,
												   `DepartmentId`,
												   `DepatuserId`,
												   `StatusOfAction`,
												   `DueDate`,
												   `Status`
											    )
											     VALUES 
											    (
											       '".$_REQUEST['Ident']."',
											       '".$act."',
											       '".$depttask."',
											 	   '".$dept."',
											       '".$deptuser."',
											       '".$stat."',
											       '".$datepick."',
											       '1'
												  )";
			
			$ExeInsQuery=$this->ExecuteQuery($InsQuery,"insert");
			}
			
			$objSmarty->assign("SuccessMessage","Meeting has been Updated successfully");
			//exit;
		}
		else
		{
			$objSmarty->assign("ErrorMessage","Meeting Details already exists");
		}
	}
	
	
	
	function renewal_meeting()
	{
		global $objSmarty,$objPage;
	 $action=$_REQUEST['Actionitem'];
			for($i=1;$i<=$action;$i++)
			{
				//echo $i;
				
				$stat=addslashes($_REQUEST['statusid_'.$i]);
				
				$dateloop=explode('/',$_REQUEST['datepickerid_'.$i]);
				 $datepick=$dateloop[2]."-".$dateloop[0]."-".$dateloop[1];
				 	
				//$datepick=$_REQUEST['datepickerid_'.$i];
				
		 $UPQuery =  "Update `tbl_actions` set
												   `StatusOfAction`='".$stat."',
												   `DueDate`='".$datepick."'
												    where MeetingId='".$_REQUEST['Ident']."'";
			
			$ExeInsQuery=$this->ExecuteQuery($UPQuery,"update");
			}
			
			$objSmarty->assign("SuccessMessage","Meeting has been Updated successfully");
			//exit;
		
		
	}
	
	
	  /*=============================getOwnernameById=============*/
	function getOwnernameById($Id)
	 {
	 	 $query= "SELECT * FROM  tbl_users WHERE Id='".$Id."'";
		  $row1 = mysql_query($query);
		  $res = mysql_fetch_array($row1);
          return $res['EmployeeName'];
	    	
	 }	
	 
	   /*=============================getMeetingTypeById=============*/
	function getMeetingTypeById($Id)
	 {
	 	 $query= "SELECT * FROM  tbl_meetingtype WHERE Id='".$Id."'";
		  $row1 = mysql_query($query);
		  $res = mysql_fetch_array($row1);
          return $res['Meeting_Type'];
	    	
	 }	
	 function getMeetingimageById($Id)
	 {
	 	 $query= "SELECT * FROM  tbl_meetingtype WHERE Id='".$Id."'";
		  $row1 = mysql_query($query);
		  $res = mysql_fetch_array($row1);
          return $res['Image'];
	    	
	 }	
	 
	   /*=============================Delete_Meeting=============*/
	function Delete_Meeting()
	 {
	 	global $objSmarty,$objPage;
		$sql= "DELETE FROM tbl_meetings 
				WHERE 
					Id='".$_REQUEST['hdIdent']."'";
		$ExeUpQuery= $this->ExecuteQuery($sql,"delete");
	 	$query= "DELETE FROM tbl_actions 
				WHERE 
					MeetingId='".$_REQUEST['hdIdent']."'";
		$ExeUpQuery= $this->ExecuteQuery($query,"delete");
		$objSmarty->assign("SuccessMessage","Data has been deleted successfully");
	    	
	 }	
	 
   /*=============================DELETE RECORD=============*/
   function Set_Status($tablename,$id,$word)
	{
		global $objSmarty,$objPage;
		$UpQuery="UPDATE ".$tablename." SET `Status`='".$_REQUEST['setStatus']."'"
		. " WHERE $id='".$_REQUEST['Ident']."'";
			
		if($_REQUEST['setStatus']==0){

			$ExeUpQuery= $this->ExecuteQuery($UpQuery,"update");
			$objSmarty->assign("SuccessMessage","$word has been deactivated successfully");
		}
		else{
			$ExeUpQuery= $this->ExecuteQuery($UpQuery,"update");
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
		$emails=$_REQUEST['emails'];
		global $objSmarty;
		 $SelQuery="SELECT * FROM `admin` "
				  . "WHERE binary `Email`= '".$emails."' ";  
		$SelResult=$this->ExecuteQuery($SelQuery,"select");
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
					<td align="center" bgcolor="#7e7e7e"><span class="footer_text">&copy; 2015. Tutor Website. All Rights Reserved.</span></td>
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
			session_register("ID");
            session_register("Username");
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
		              ." WHERE `Email` = '".$_REQUEST['emails']."' ";
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
   /*==============================================changes by TG====================================*/
    function Getbrandcount()
	{
	global $objSmarty;
    $SelQuery	= "SELECT COUNT(*) FROM tbl_brand";
	$Result	= $this->ExecuteQuery($sql, "select");
	$objSmarty->assign("Acc", $Result);
	}

	/*==============================================changes by 21.03.2017====================================*/
 function sesionset()
	 {
	    if(isset($_SESSION['userid']))
	    {
	    	return true;
	    }
	    else
	    {
	    	
	    	header('Location:index.php');
	    }
	    		
	 }
	function Get_account_Details()
		{
		global $objSmarty;
			$sql="SELECT * FROM `tbl_admin` WHERE `Ident`='".$_SESSION['admin_id']."'";
			$Result	= $this->ExecuteQuery($sql, "select");
			$objSmarty->assign("Acc", $Result);
		} 
		

	
}

?>