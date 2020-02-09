<?php 
	include('../settings/config.php'); 
	unset($_SESSION["adminusername"]);
	unset($_SESSION);
	session_destroy();	
	header("location: index.php?logout=success");	
?>	
	