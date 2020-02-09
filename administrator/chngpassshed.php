<?php 

	include('../settings/config.php'); 

	$oldpassword= base64_encode($_POST["oldpassword"]);

	$newpassword= base64_encode($_POST["newpassword"]);

	

	$sql="SELECT * FROM `adminlogin` WHERE `password`= '".$oldpassword."' ; ";

	$res=dbQuery($sql) or die(mysql_error().$sql);

	$rec=dbNumRows($res);

	if($rec > 0)

	{

		$s = dbQuery("update `adminlogin` set `password`= '$newpassword' where `username`='".$_SESSION["adminusername"]."';");		

		header("location: adminhome.php?msg=passchange");

	}

	else

	{

		header("location: changepassword.php?msg=error");

	}		

?>