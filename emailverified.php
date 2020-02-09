<?php 

include('include/header.php');	

include('phpmailer/class.phpmailer.php');

if(isset($_GET["ID"]) && isset($_GET["PID"])) {

$email=stripslashes(base64_decode($_GET["ID"]));

$password=stripslashes($_GET["PID"]);

if(isset($_GET["active"])) {

$active=$_GET["active"];

} else {

$active='';

}



		$s = dbQuery("select * from `user_registration` where `email`='".$email."' and `password`='".$password."'");

		if(dbNumRows($s)>0 && $active=="yes") {

			$arr=explode(" ", date("Y-m-d H:i:s"));

			$ar1=explode("-", $arr[0]);

			$ar2=explode(":", $arr[1]);

			$_SESSION["userlogin"]=$email;	

			$a = dbQuery("select * from `user_registration` where `email`='".$email."' and `password`='".$password."' and `createdate`<'".date("Y-m-d",mktime($ar2[0], $ar2[1], $ar2[2], $ar1[1], $ar1[2]-1, $ar1[0]))."'");

			if(dbNumRows($a)==0) {

			dbQuery("update `user_registration` set `status`='1',`current_balance`='".$SignUpbonus."' where `email`='".$email."' and `password`='".$password."'");

			dbQuery("insert into `myaccount`(`email`,`amount`,`type`,`createdate`) values('".$email."','".$SignUpbonus."','1','".$totaldate."')");

			$d='';

			$sig = dbFetchArray(dbQuery("select * from `mailsettings` where `id`='13'"),MYSQL_BOTH);

			$user = dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$email."'"),MYSQL_BOTH);

			

			$benefitusersql=dbQuery("select * from `user_registration` where `email`='".$user["referrer"]."'");

			if(dbNumRows($benefitusersql)>0) {

			$benefituserres=dbFetchArray($benefitusersql,MYSQL_BOTH);

			dbQuery("update `user_registration` set `bonuscount`='".($benefituserres["bonuscount"]+1)."' where `email`='".$user["referrer"]."'");

			}

			

			

			$Subject1 = stripslashes($sig["subject"]);

			$TemplateMessage=str_replace("%FULLNAME%", $user["fullname"], stripslashes($sig["message"]));	

			$TemplateMessage=str_replace("%EMAIL%", $user["email"], $TemplateMessage);

			$TemplateMessage=str_replace("%PASSWORD%", base64_decode($user["password"]), $TemplateMessage);	

			$mail1 = new PHPMailer;

			$mail1->FromName = $fromName;

			$mail1->From    = $from;

			$mail1->Subject = $Subject1;

			$mail1->Body    = stripslashes($TemplateMessage);

			$mail1->AltBody = stripslashes($TemplateMessage);					

			$mail1->IsHTML(true);	

			$mail1->AddAddress($user["email"],$fromName);

			$mail1->Send();

										

			$TemplateMessage="Hi ";

			$TemplateMessage.="<br><br>";					

			$TemplateMessage.="A new account has been created.<br>";

			$TemplateMessage.="Please login to the admin control panel to view details:<br>";

			$TemplateMessage.="<br>----------------<br><br>";

			$TemplateMessage.="User's Email: ".$user["email"]."<br><br>";

			$TemplateMessage.="Thanks,<br>";

			$TemplateMessage.=$fromName."<br>";

			$TemplateMessage.=$SiteName."<br>";

						

			$mail = new PHPMailer;

			$mail->FromName = $fromName;

			$mail->From    = $from;

			$mail->Subject = "A new member has been registered successfully.";

			$mail->Body    = stripslashes($TemplateMessage);

			$mail->AltBody = stripslashes($TemplateMessage);					

			$mail->IsHTML(true);	

			$mail->AddAddress($CONTACTUSMAILID,$fromName);

			$mail->Send();	

			header("location: emailverified.php");

		    exit();	

			}

			else {	

				

				$sig = dbFetchArray(dbQuery("select * from `mailsettings` where `id`='16'"),MYSQL_BOTH);

				$user = dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$email."'"),MYSQL_BOTH);

				$Subject1 = stripslashes($sig["subject"]);

				$TemplateMessage=str_replace("%FULLNAME%", $user["fullname"], stripslashes($sig["message"]));

				$mail1 = new PHPMailer;

				$mail1->FromName = $fromName;

				$mail1->From    = $from;

				$mail1->Subject = $Subject1;

				$mail1->Body    = stripslashes($TemplateMessage);

				$mail1->AltBody = stripslashes($TemplateMessage);					

				$mail1->IsHTML(true);	

				$mail1->AddAddress($user["email"],$user["fullname"]);

				$mail1->Send();					

				

				

				$TemplateMessage="Hi ";

				$TemplateMessage.="<br><br>";					

				$TemplateMessage.="A new account has been disabled due to activation time limit.<br>";

				$TemplateMessage.="Please login to the admin control panel to view details:<br>";

				$TemplateMessage.="<br>----------------<br><br>";

				$TemplateMessage.="User's Fullname: ".$user["fullname"]."<br><br>";

				$TemplateMessage.="Thanks,<br>";

				$TemplateMessage.=$fromName."<br>";

				$TemplateMessage.=$SiteName."<br>";

							

				$mail = new PHPMailer;

				$mail->FromName = $fromName;

				$mail->From    = $from;

				$mail->Subject = "A new member has been disabled due to activation time limit.";

				$mail->Body    = stripslashes($TemplateMessage);

				$mail->AltBody = stripslashes($TemplateMessage);					

				$mail->IsHTML(true);	

				$mail->AddAddress($CONTACTUSMAILID,$fromName);

				$mail->Send();

				header("location: emailverified.php?activation=dayerror");

				exit();

				}

			}

}		

if(isset($_GET["activation"]) && $_GET["activation"]!='') {

$d = 'Some error';

} else {

$d = '';

}	

?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td style="padding-left:50px; padding-right:50px;">

	

	<table width="100%" border="0" cellspacing="0" cellpadding="0">

	<tr>

    	<td>&nbsp;</td>

	</tr>		 

	 <tr>

   		 <td>&nbsp;</td>

	 </tr>

	  <tr>

		<td>

			

			<table width="100%" border="0" cellspacing="0" cellpadding="0">

			  <tr>

				<td class="table_content_left"></td>

				<td class="table_content_middle">

				

				<table width="100%" border="0" cellspacing="0" cellpadding="0">

				  <tr>

					<td width="100%" align="left" style="font-weight:bold; padding-left:10px;">Email Verification</td>

				  </tr>

				</table>

				

				</td>

				<td class="table_content_right"></td>

			  </tr>

			  			   

				<tr>				

				<td colspan="3" class="td_dark_backg" style="padding-left:20px;">

				

				<table width="100%" border="0" cellspacing="0" cellpadding="0">

				  <tr>

					<td width="100%" align="center" style="padding:10px; line-height:20px;">

					

					

					

					<table width="704" border="0" cellspacing="0" cellpadding="0">



                     <tr>

                       <td style="padding-left:5px;">

					   

						<table border="0" cellspacing="0" style="border-collapse: collapse" id="AutoNumber54" cellpadding="0">

						<tr>

						<td nowrap><b>Email verification</b></td>

						</tr>

						

						<tr>

						<td nowrap>

						<img border="0" src="images/p.gif" width="3" height="3"></td>

						</tr>

						<tr>

						<td nowrap bgcolor="#F62355">

						<img border="0" src="images/p.gif" width="3" height="3"></td>

						</tr>

						</table>

						<?php if($d=='') { ?>

						<p style="line-height: 150%"><br />

						<b>Congratulations!<br>

						</b>Your account is now active and you are logged into <?php echo $SiteName; ?>! Remember all First Time Deposits Get a 25% Bonus!</p>

						<p style="line-height: 150%">&nbsp;</p>

						<p style="line-height: 150%">

						<span style="font-size: 16px; font-weight: 700">We have deposited sign 

						up bonus to your account!</span></p>

						<p><a href="employer.php"><b>Create a new job offer</b></a>&nbsp; —&nbsp; 

						offer a job to workers 

						and get some free traffic!</p>

						

						<p>&nbsp;</p>

						<p><a href="jobs.php"><b>List available jobs</b></a></td>

						<?php } else { ?>

						<p>&nbsp;</p>

						<table border="0" cellpadding="5" cellspacing="2"  bgcolor="#FF0000" width="360">

						<tr>

						<td width="100%" bgcolor=#FFFFFF><font color="#FF0000"><b>Problem with 

						verification</b></font></td>

						

						</tr>

						</table>

						<p><b>Oooops!</b></p>

						<p style="line-height: 150%">It looks like you used incorrect verification link or you didn't<br>

						verify your email in 24 hours after you signed up.</p>

						<p>&nbsp;</p>

						<ul style="line-height: 150%">

						<li>

						

						<a href="signup.php"><b>Sign up for <?php echo $SiteName; ?> account</b></a><br>

						&nbsp;</li>

						<li>

						<a href="contact.php">Contact the support</a></li>

						</ul>

						<p>

						<?php } ?>

	                </table> 

					   

			       

					

					</td>

				  </tr>

				</table>

				

				</td>			

			  </tr>				 

				 

			  

			  	  

			</table>

		

		</td>

	  </tr>

	  <tr>

   		 <td>&nbsp;</td>

	  </tr>

	  <tr>

   		 <td>&nbsp;</td>

	  </tr>

	</table>

	

	</td>

  </tr>

</table>

	

 

<?php include('include/footer.php'); ?>