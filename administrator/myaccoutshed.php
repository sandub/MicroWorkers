<?php     

	include('../settings/config.php'); 

	$username= $_POST["username"];

	$password= $_POST["password"];

	$email= $_POST["email"];

	

	

	if(isset($_POST["username"]))

	{

	dbQuery("update `adminlogin` set `username`= '".addslashes($_POST["username"])."', `password`= '".base64_encode($_POST["password"])."', `email`= '".$_POST["email"]."' where `id`='1'; ");

	$_SESSION["adminusername"]=$_POST["username"];

	}

	

header("location: adminhome.php?msg=passchange");

		

?>