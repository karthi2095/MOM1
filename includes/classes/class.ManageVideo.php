<?php
/*	Class Function for Admin	*/

class ManageVideo extends MysqlFns
{
	function ManageVideo()
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

	
function AddVideo()
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
							 `Status`,
							 `CreatedDate`
							) 
							VALUES
							(
							'".addslashes($_SESSION['UserId'])."',
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
function Allvideos($id)
	{
		global $objSmarty;
		 $selquery="select  * from tbl_video where UserID ='$id' ";
		$ExeUpQuery= $this->ExecuteQuery($selquery,"select");
			$objSmarty->assign("videos",$ExeUpQuery);
			$ExeUpQuery1= $this->ExecuteQuery($selquery,"norows");
			$objSmarty->assign("videosrws",$ExeUpQuery1);
	}
function selectvideos($id)
	{
		global $objSmarty;
		 $selquery="select  * from tbl_video where ID ='$id' ";
		$ExeUpQuery= $this->ExecuteQuery($selquery,"select");
			$objSmarty->assign("video",$ExeUpQuery);
			
	}
function gethomevideo()
	{
		global $objSmarty;
		 $selquery="select  * from tbl_homepagevideo";
		$ExeUpQuery= $this->ExecuteQuery($selquery,"select");
			$objSmarty->assign("homevideo",$ExeUpQuery);
			
	}
function UpdateVideo()
	{
		global $objSmarty;
		$SelQuery	= "SELECT * from `tbl_video`"
		              ." WHERE `Title`='".addslashes($_REQUEST['title'])."' and ID!='".$_REQUEST['Ident']."' ";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"norows");
		if(!$ExeSelQuery){
		
		
			$InsQuery	= "Update `tbl_video` SET 
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

	/////----------------------------------------MUSIC LIST ----------------------------------///////////////
function Allmusic($id)
	{
		global $objSmarty;
		 $selquery="select  * from tbl_music where UserID ='$id' ";
		$ExeUpQuery= $this->ExecuteQuery($selquery,"select");
			$objSmarty->assign("Music",$ExeUpQuery);
			
	}
function AddMusic()
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
				$add2="Audio/$filename2";
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
							'".addslashes($_SESSION['UserId'])."',
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
			$objSmarty->assign("SuccessMessage","Music has been added successfully");
		
			$objSmarty->assign("",$_REQUEST);
		}
		else
		{
			$objSmarty->assign("ErrorMessage","Title already exists");
			$objSmarty->assign("vid",$_REQUEST);
		}
	}
function view_audio()
	{
		global $objSmarty;
		 if($_REQUEST['Ident']!=''){
	     $SelQuery	="select * from tbl_music  where ID = '".$_REQUEST['Ident']."'";
			
	     $ExeSelQuery= $this->ExecuteQuery($SelQuery,"select");
	     $emp=$ExeSelQuery[0]['UserID'];
	     $sel="select * from tbl_user where UserID='".$emp."'";
	     $Ex= $this->ExecuteQuery($sel,"select");
	     $objSmarty->assign("user", $Ex);
	     $objSmarty->assign("music",$ExeSelQuery);
		 }else{
			redirect('manage_audio.php');
		}
	}	
function selectaudio($id)
	{
		global $objSmarty;
		 $selquery="select  * from  tbl_music where ID ='$id' ";
		$ExeUpQuery= $this->ExecuteQuery($selquery,"select");
			$objSmarty->assign("music",$ExeUpQuery);
	}
function UpdateMusic()
	{
		global $objSmarty;
		$SelQuery	= "SELECT * from `tbl_music`"
		              ." WHERE `Title`='".addslashes($_REQUEST['title'])."' and ID!='".addslashes($_REQUEST['Ident'])."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"norows");
		if(!$ExeSelQuery){
		
		if($_FILES['audio']['name'] != ""){
				$filename_new2 =time().$_FILES['audio']['name'];
				$getFormat_new2 = substr(strrchr($filename_new2,'.'),1);
				$filename2 = md5($filename_new2).'.'.$getFormat_new2;
		        $filename2 = strtolower($filename2);
				$add2="Audio/$filename2";
				@move_uploaded_file($_FILES['audio']['tmp_name'], $add2);
				$size= $_FILES["audio"]["size"];
				$AudioPath = ",Audio = '".$filename2."', Size= '".$size."', Type= '".$getFormat_new2."'";
 
						}
					
			$InsQuery	= "Update `tbl_music` SET
						   
							 `UserID`=	'".addslashes($_SESSION['UserId'])."',
							 `Title`='".addslashes($_REQUEST['title'])."',
							  `TrackNo`='".addslashes($_REQUEST['track'])."',
							   `Year`='".addslashes($_REQUEST['year'])."',
							`Album`='".addslashes($_REQUEST['album'])."',
							`Genre`='".addslashes($_REQUEST['genre'])."',
							 `Comments`='".addslashes($_REQUEST['comments'])."',
							  `Listen`='".addslashes($_REQUEST['listen'])."',
							 `Download`='".addslashes($_REQUEST['download'])."'
							where ID='".addslashes($_REQUEST['Ident'])."'
						 "; 
									 
			$ExeInsQuery=$this->ExecuteQuery($InsQuery,"update");
			$objSmarty->assign("SuccessMessage","Music has been updated successfully");
		
			$objSmarty->assign("",$_REQUEST);
		}
		else
		{
			$objSmarty->assign("ErrorMessage","Title already exists");
			$objSmarty->assign("vid",$_REQUEST);
		}
	}
function Update_Music()
	{
		global $objSmarty;
		$SelQuery	= "SELECT * from `tbl_music`"
		              ." WHERE `Title`='".addslashes($_REQUEST['title'])."' and ID!='".addslashes($_REQUEST['Ident'])."'";
		$ExeSelQuery= $this->ExecuteQuery($SelQuery,"norows");
		if(!$ExeSelQuery){
		
		if($_FILES['audio']['name'] != ""){
				$filename_new2 =time().$_FILES['audio']['name'];
				$getFormat_new2 = substr(strrchr($filename_new2,'.'),1);
				$filename2 = md5($filename_new2).'.'.$getFormat_new2;
		$filename2 = strtolower($filename2);
				$add2="../Audio/$filename2";
				@move_uploaded_file($_FILES['audio']['tmp_name'], $add2);
				$size= $_FILES["audio"]["size"];
				$AudioPath = ",Audio = '".$filename2."', Size= '".$size."', Type= '".$getFormat_new2."'";
 
						}
					
			$InsQuery	= "Update `tbl_music` SET
						   
							 `UserID`=	'".addslashes($_REQUEST['employer'])."',
							 `Title`='".addslashes($_REQUEST['title'])."',
							  `TrackNo`='".addslashes($_REQUEST['track'])."',
							   `Year`='".addslashes($_REQUEST['year'])."',
							`Album`='".addslashes($_REQUEST['album'])."',
							`Genre`='".addslashes($_REQUEST['genre'])."',
							 `Comments`='".addslashes($_REQUEST['comments'])."',
							  `Listen`='".addslashes($_REQUEST['listen'])."',
							 `Download`='".addslashes($_REQUEST['download'])."'
							where ID='".addslashes($_REQUEST['Ident'])."'
						 "; 
									 
			$ExeInsQuery=$this->ExecuteQuery($InsQuery,"update");
			$objSmarty->assign("SuccessMessage","Audio has been updated successfully");
		
			$objSmarty->assign("",$_REQUEST);
		}
		else
		{
			$objSmarty->assign("ErrorMessage","Title already exists");
			$objSmarty->assign("vid",$_REQUEST);
		}
	}
function smarty_modifier_filesize($size)
{
  $size = max(0, (int)$size);
  $units = array( 'b', 'Kb', 'Mb', 'Gb', 'Tb', 'Pb', 'Eb', 'Zb', 'Yb');
  $power = $size > 0 ? floor(log($size, 1024)) : 0;
  return number_format($size / pow(1024, $power), 2, '.', ',') . $units[$power];
}
////////////////////////////////////////////END////////////////////////////////////////////////////////
}
?>