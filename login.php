<?php 

include("include/header.php");





if(isset($_POST["Button"])) {

$email=$_POST["Email"];

$password=base64_encode($_POST["Password"]);

if(mysql_num_rows(mysql_query("select * from `user_registration` where `email`='$email' and `password`='".addslashes($password)."'"))>0) {

	if(mysql_num_rows(mysql_query("select * from `user_registration` where `email`='$email' and `password`='".addslashes($password)."' and `status`='1'"))>0) { 

	if(mysql_num_rows(mysql_query("select * from `user_registration` where `email`='$email' and `password`='".addslashes($password)."' and `status`='1' and `banned`='1'"))>0) { 

		

		$_SESSION["userlogin"]=$email;

		

		$JAsql=dbQuery("select * from `jobs_application` where `status` not in ('2','3')");

		if(dbNumRows($JAsql)>0) {

		  while($resQ=dbFetchArray($JAsql,MYSQL_BOTH)) {

		



			$end=strtotime($totaldate);



			$start=strtotime($resQ["appdate"]);



			if($start < $end) {



				   if($diff=get_sec_difference($start,$end)) { 					



					  if($diff['seconds'] >= $setseclimithere) {	



					  



		$resJ=dbFetchArray(dbQuery("select * from `jobs` where `id`='".$resQ["jobid"]."'"),MYSQL_BOTH);



		$fees=$resJ["price"];

		if($fees > 0.11) {

		$deducted_fee = $fees*($FeePerCompletedJob/100);

		} else {

		$deducted_fee = $fees*($FeePerCompletedJobLESS11/100);

		}		

		

		$rescurbal2=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$resQ["email"]."'"),MYSQL_BOTH);

		

		if(dbNumRows(dbQuery("select * from `success_rate` where `email`='".$resQ["email"]."' and `jobid`='".$resQ["jobid"]."'"))==0) {

		

		

		if(dbNumRows(dbQuery("select * from `jobs_application` where `email`='".$resQ["email"]."' and `status`='3' "))==1) {

		$rescurbal5=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$rescurbal2["referrer"]."'"),MYSQL_BOTH);	

		$Rreferrer = $rescurbal5["email"];				

	  dbQuery("insert into `myaccount`(`email`,`amount`,`type`,`createdate`,`referreduser`) values('".$Rreferrer."','".$ReferralFIRSTJobComplete."','9','".$totaldate."','".$resQ["email"]."')");

 dbQuery("update `user_registration` set `current_balance`='".($rescurbal5["current_balance"]+$ReferralFIRSTJobComplete)."' where `email`='".$Rreferrer."'");				

	  }

		

		

		dbQuery("insert into `success_rate`(`email`,`jobid`,`status`) values('".$resQ["email"]."','".$resQ["jobid"]."','3')");

		

		dbQuery("insert into `myaccount`(`email`,`amount`,`type`,`createdate`,`jobid`) values('".$resQ["email"]."','$deducted_fee','6','".$totaldate."','".$resQ["jobid"]."')");		



		dbQuery("update `user_registration` set `current_balance`='".($rescurbal2["current_balance"]+$deducted_fee)."' where `email`='".$resQ["email"]."'");

		

		dbQuery("update `jobs_application` set `status`='3' where `id`='".$resQ["id"]."'");



		} else {



		dbQuery("update `success_rate` set `status`='3' where `jobid`='".$resQ["jobid"]."' and `email`='".$resQ["email"]."'");



		}



									  



					  }	



				   }



			 }



			 



		  }	 			



		}

		

		

		$Rsql=dbQuery("select * from `user_registration` where `referrer`='".$_SESSION['userlogin']."'");

		while($rescurbal5=dbFetchArray($Rsql,MYSQL_BOTH)) {

		

			if(dbNumRows(dbQuery("select * from `myaccount` where `email`='".$_SESSION['userlogin']."' and `amount`='".$ReferralBalanceReached10."' and `referreduser`='".$rescurbal5["email"]."'"))==0) {

			if($rescurbal5["current_balance"] >= $ReferralBalanceReached) {

			dbQuery("insert into `myaccount`(`email`,`amount`,`type`,`createdate`,`referreduser`) values('".$_SESSION['userlogin']."','".$ReferralBalanceReached10."','9','".$totaldate."','".$rescurbal5["email"]."')");

  $rescurbal6=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$_SESSION['userlogin']."'"),MYSQL_BOTH);		

  dbQuery("update `user_registration` set `current_balance`='".($rescurbal6["current_balance"]+$ReferralBalanceReached10)."' where `email`='".$_SESSION['userlogin']."'");

			}

				

			}

		

		}

		

		$euser=mysql_fetch_array(mysql_query("select * from `user_registration` where `email`='$email' and `password`='".addslashes($password)."' and `status`='1' and `banned`='1'"));

		mysql_query("insert into `login_log`(`email`,`lastlogin`,`fullname`,`country`,`IP`) values('".$euser["email"]."','".$totaldate."','".stripslashes($euser["fullname"])."','".stripslashes($euser["country"])."','".$_SERVER['REMOTE_ADDR']."')");

		

		header("location: jobs.php");

		exit();

		} else {

		$_SESSION["bannederror"]='Yes';

		} } else {

		$_SESSION["activationerror"]='Yes';

		}

	} else {

	$_SESSION["loginerror"]='Yes';

	}

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

					<td width="100%" align="left" style="font-weight:bold; padding-left:10px;">Login to your account</td>

				  </tr>

				</table>

				

				</td>

				<td class="table_content_right"></td>

			  </tr>

			  <tr>				

				<td colspan="3" class="td_dark_backg" style="padding-left:20px;">

				

				<table width="100%" border="0" cellspacing="0" cellpadding="0">

				  <tr>

					<td width="100%" align="left" style="padding:10px; line-height:20px;">

					

					

					

					<table width="522" border="0" cellspacing="0" cellpadding="0">

                         <tr>

                           <td width="438" align="left" valign="top" class="submit" style="padding-left:10px">

					<?php if(isset($_SESSION["loginerror"])) { ?>

					<p><br>

					<table border="0" cellpadding="5" cellspacing="2"  bgcolor="#FF0000" width="360">

					<tr>

					<td width="100%" bgcolor="#F4F4F4"><font color="#FF0000"><b>&nbsp;&nbsp;Email and password 

					don't match</b></font></td>

					</tr>

					</table>

					&nbsp;&nbsp;&nbsp; </p>

					<?php unset($_SESSION["loginerror"]); }  else if(isset($_SESSION["bannederror"])) { ?>

				<p><br>

				<table border="0" cellpadding="5" cellspacing="2"  bgcolor="#FF0000" width="360">

				  <tr>

					<td width="100%" bgcolor="#F4F4F4"><font color="#FF0000"><b>&nbsp;&nbsp;Your account has been banned, please contact administator for details.</b></font></td>

				  </tr>

				</table>

				&nbsp;&nbsp;&nbsp; </p>

				<?php unset($_SESSION["bannederror"]); } else if(isset($_SESSION["activationerror"])) { ?>

					<p>

					<table border="0" cellpadding="5" cellspacing="5"  bgcolor="#FF0000" width="360">

					<tr>

					<td width="100%" bgcolor="#F4F4F4"><font color="#FF0000"><b>&nbsp;&nbsp;Your account has not been activated yet, please check your mail box for activation mail.</b></font></td>

					</tr>

					</table>

					&nbsp;&nbsp;&nbsp; </p>

					<?php unset($_SESSION["activationerror"]); } else { ?>

					<BR>

					<?php } ?>

					<form method="POST" action="login.php">

	   <table border="0" cellspacing="5" cellpadding="10" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber55">					

					<tr>

					<td>Email&nbsp;&nbsp;</td>

					<td>					

					<input type="text" name="Email" size="33" value=""></td>

					</tr>

					<tr>

					<td>Password&nbsp;&nbsp;</td>

					<td>

					<input type="password" name="Password" size="33" value=""></td>

					</tr>

					

					<tr>

					<td>&nbsp;</td>

					<td>

					By Login to your account you agree to our<br>

					<a href="terms.php" style="text-decoration:none">Terms &amp; Conditions</a>

					<br>

					<input type="submit" value="Login" name="Button">					

					<br><a href="password.php" style="text-decoration:none">Forgot password?</a></td>

					</tr>

					</table>

					</form></td>

					<td width="84" valign="top"><img src="images/login_icon.gif" width="128" height="128" border="0"/></td>

                           </tr>

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

	

<?php include("include/footer.php"); ?>