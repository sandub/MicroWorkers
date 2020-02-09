<?php 

	include('../settings/config.php'); 

	include('../phpmailer/class.phpmailer.php');

	

	$email=$_POST["email"];

	$sql="SELECT * FROM `adminlogin` WHERE `email`= '$email' ; ";	

	$res=dbQuery($sql) or die(mysql_error().$sql);

	$rec=dbNumRows($res);

	if($rec > 0)

	{			  

		  $res2 = dbFetchArray($res,MYSQL_BOTH);

		  $subject = "Your Administrator Password from : ".$SiteName ;

		  $message = "Your Username is ".$res2["username"]." <br /> Your password is ".base64_decode($res2["password"]);

		  

		  $mail = new PHPMailer;

		  $mail->FromName = $fromName;

		  $mail->From    = $from;

		  $mail->Subject = $subject;

		  $mail->Body    = stripslashes($message);

		  $mail->AltBody = stripslashes($message);					

		  $mail->IsHTML(true);	

		  $mail->AddAddress($email,$res2["username"]);

		  if($mail->Send()) {			  		  		

		  header("location: index.php?msg=sendpass");

		  exit();

		  } else {

		  header("location: forgotpwd.php?msg=senterror");

		  exit();

		  }

		  

	}

	else

	{

		header("location: forgotpwd.php?msd=error");

		exit();

	}		

?>