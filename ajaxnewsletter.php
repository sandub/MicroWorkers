<?php 
	include('settings/config.php');	
	
	if(isset($_GET["email"]) && $_GET["email"]!='') {
	
		$email=strtolower($_GET["email"]);
		$rec = dbQuery("select * from `newsletter` where `email`='$email'");
		if(dbNumRows($rec)==0) {
		dbQuery("insert into `newsletter`(`email`) values('$email');");
		}
		else {
		echo 'no';
		}
	
	} else {
	
		echo 'no';
		
	} 		
?>
