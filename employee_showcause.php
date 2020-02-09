<?php 
include('settings/config.php');
dbQuery("update `jobs_application` set `showcause`='".addslashes($_POST["cause"])."' where `id`='".$_POST["appid"]."'");
$resQ=dbFetchArray(dbQuery("select * from `jobs_application` where `id`='".$_POST["appid"]."'"),MYSQL_BOTH);
$resJ=dbFetchArray(dbQuery("select * from `jobs` where `id`='".$resQ["jobid"]."'"),MYSQL_BOTH);

dbQuery("insert into `support`(`type`,`subject`,`message`,`fromemail`,`toemail`,`createdate`) values('Job Proof not Approved','".stripslashes($resJ["title"])."','".addslashes($_POST["cause"])."','".$_SESSION['userlogin']."','".$resQ["email"]."','".$totaldate."')");	

header("location: employee_application.php?Id=".base64_encode($resQ["jobid"]));
exit();
?>
