<?php     
	include('../settings/config.php');
	
	$username= $_POST["username"];
	$password= $_POST["password"];
	
	$sql="SELECT * FROM `adminlogin` WHERE `username`='".$username."' and `password`= '".base64_encode($password)."' ; ";
	$res=dbQuery($sql) or die(mysql_error().$sql);
	$rec=dbNumRows($res);
	if($rec > 0)
	{
		$s = dbQuery("update `adminlogin` set `logintime`= '".$totaldate."' where `username`='".$username."' ; ");
		$_SESSION["adminusername"]=$username;
		header("location: adminhome.php");
	}
	else
	{
		header("location: index.php?msg=error");
	}		
?>