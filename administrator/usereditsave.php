<?php 

	include('../settings/config.php'); 

	

	$uid=strtoupper($_GET["uid"]);

	

	if(isset($_POST["checkadjust"]) && $_POST["checkadjust"]!="") {	

	$checkadjust=$_POST["checkadjust"];

	$y = dbFetchArray(dbquery("select * from `user_registration` where `id`='".$uid."'"),MYSQL_BOTH);

	if($checkadjust=="add") {

	$diff = $_POST["account_adjust"];

	$currentaccount=$y["current_balance"]+$diff;

	dbQuery("insert into `myaccount`(`email`,`amount`,`type`,`createdate`) values('".strtolower($_POST["email"])."','$diff','1','".$totaldate."')");	 

	}

	if($checkadjust=="deduct") {

	$diff = $_POST["account_adjust"];

	$currentaccount=$y["current_balance"]-$diff;

	dbQuery("insert into `myaccount`(`email`,`amount`,`type`,`createdate`) values('".strtolower($_POST["email"])."','$diff','2','".$totaldate."')");	

	}

	} else {

	$currentaccount=$_POST["account_balance"];

	}

	

	dbQuery("update `user_registration` set `fullname`='".addslashes($_POST["fullname"])."',`email`='".strtolower($_POST["email"])."',`password`='".base64_encode($_POST["password"])."',`country`='".$_POST["country"]."',`status`='".$_POST["status"]."',`current_balance`='".$currentaccount."' where `id`='".$uid."'");

			

	

	if(!isset($_SESSION["UPLOADPICERROR"]))

	{

		header("location: userlist.php?msd=success");

	}

	else

	{

		header("location: edituser.php?action=edit&uid=".$uid);

	}		

?>