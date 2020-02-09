<?php 
	include('settings/config.php'); 
	if(isset($_GET["email"]) && $_GET["email"]!='') {
	$email=strtolower($_GET["email"]);
	$rec = dbQuery("select * from `user_registration` where `email`='$email'");
	if(dbNumRows($rec)>0) {
	echo 'yes';
	}
	else {
	echo 'no';
	}
	 	}
	else {
	echo 'no';
	} 	
?>