<?php
include('settings/config.php');
$s=$_GET["s"];
if($s=='1') { $ss='0'; } else { $ss='1'; }
dbQuery("update `user_registration` set `newsletter`='".$ss."' where `email`='".$_SESSION["userlogin"]."'");
header("location: account.php");
exit();
?>
