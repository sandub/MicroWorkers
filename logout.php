<?php 
	include('settings/config.php');
	unset($_SESSION["userlogin"]);
	session_unset();
	session_destroy();		
	header("location: index.php");
	exit();
?>	
	