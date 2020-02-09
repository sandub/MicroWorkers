<?php 

include("include/header.php");

include('phpmailer/class.phpmailer.php');

if(isset($_POST["Button"])) {

	$sql=mysql_query("select * from `user_registration` where `email`='".$_POST["Email"]."'");

	if(mysql_num_rows($sql)>0) {

	 $res=mysql_fetch_array($sql);

	 $email=$res["email"];

	 $password=base64_decode(stripslashes($res["password"]));

	 $fullname=stripslashes($res["fullname"]);

	 

	 		$sig = dbFetchArray(dbQuery("select * from `mailsettings` where `id`='2'"),MYSQL_BOTH);

			$Subject1 = stripslashes($sig["subject"]);

			$TemplateMessage=str_replace("%FULLNAME%", $fullname, stripslashes($sig["message"]));

			$TemplateMessage=str_replace("%PASSWORD%", $password, $TemplateMessage);

			$mail1 = new PHPMailer;

			$mail1->FromName = $fromName;

			$mail1->From    = $from;

			$mail1->Subject = $Subject1;

			$mail1->Body    = stripslashes($TemplateMessage);

			$mail1->AltBody = stripslashes($TemplateMessage);					

			$mail1->IsHTML(true);	

			$mail1->AddAddress($email,$fullname);

			if($mail1->Send()) {

			$_SESSION["forgorpasssuccess"]='Yes';

			} 	

	 

	} else {

	$_SESSION["forgorpasserror"]='Yes';

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

					<td width="100%" align="left" style="font-weight:bold; padding-left:10px;">Forgot Password</td>

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

					

					

					

		<table border="0" width="100%" cellspacing="0" cellpadding="20">

			<tr>

				<td>

	  <?php if(!isset($_SESSION["forgorpasssuccess"])) { ?>

      <table border="0" cellspacing="0" style="border-collapse: collapse" id="AutoNumber56" cellpadding="0">

        <tr>

          <td nowrap><b><font color="#F62355">01</font> Recover Lost Password</b></td>



          <td nowrap>&nbsp;</td>

          <td nowrap>02 Confirmation</td>

        </tr>

        <tr>

          <td nowrap colspan="3">

          <img border="0" src="images/p.gif" width="3" height="3"></td>

        </tr>

        <tr>



          <td nowrap bgcolor="#F62355">

          <img border="0" src="images/p.gif" width="3" height="3"></td>

          <td nowrap bgcolor="#DDDDDD">

          <img border="0" src="images/p.gif" width="12" height="3"></td>

          <td nowrap bgcolor="#DDDDDD">

          <img border="0" src="images/p.gif" width="3" height="3"></td>

        </tr>

      </table>	 

	  <?php if(isset($_SESSION["forgorpasserror"])) { ?>

	  

	   <p><br>



                <table border="0" cellpadding="5" cellspacing="2"  bgcolor="#FF0000" width="360">

  <tr>

    <td width="100%" bgcolor=#F4F4F4><b><font color="#FF0000">&nbsp;&nbsp;Email you entered 

	is not in the database.</font></b></td>

  </tr>

</table>

&nbsp;&nbsp;&nbsp; </p>

	  

	  <?php unset($_SESSION["forgorpasserror"]); } else { ?> 

      			<p><br>



                &nbsp;&nbsp;&nbsp; </p>

	  <?php } ?>

      <form method="POST" action="password.php">

        <p style="line-height: 150%">Enter email address you were using to login 

		to <?php echo $fromName; ?><br>

		Password will be sent to that address.</p>

		<p><br>

		<input type="text" name="Email" size="33" value=""></p>

		<p><br>



            <input type="submit" value="Retrieve Password" name="Button"></p>

		<p>&nbsp;</p>

		<p>&nbsp;</p>

		<p style="line-height: 150%">If you cannot remember the email 

		address, please<br>

		contact the support at<br>

		<?php echo $from; ?></p>

      </form>

	  <?php } else { ?>

	  <table border="0" cellspacing="0" style="border-collapse: collapse" id="AutoNumber54" cellpadding="0">

        <tr>

          <td nowrap>01 Recover Lost Password</td>

          <td nowrap>&nbsp;</td>

          <td nowrap><b><font color="#F62355">02</font></b> <b>Confirmation</b></td>

        </tr>

        <tr>

          <td nowrap colspan="3">



          <img border="0" src="im/mw/p.gif" width="3" height="3"></td>

        </tr>

        <tr>

          <td nowrap bgcolor="#DDDDDD">

          <img border="0" src="im/mw/p.gif" width="3" height="3"></td>

          <td nowrap bgcolor="#DDDDDD">

          <img border="0" src="im/mw/p.gif" width="12" height="3"></td>

          <td nowrap bgcolor="#F62355" style="height:3px;">

          <img border="0" src="im/mw/p.gif" width="3" height="3"></td>



        </tr>

      </table>

      			<p><br>

				<br>

		Password has been sent to your email address:</p>

		<p>&quot;<b><?php echo $email; ?></b>&quot;</p>

		<p>&nbsp;</p>

		<p><span style="font-size: 11px">If you still experience problems, please

		contact <?php echo $fromName; ?> support at </span>



		<a href="mailto: <?php echo $from; ?>"><span style="font-size: 11px">

		<?php echo $from; ?></span></a><span style="font-size: 11px"> </span>

		</p>

		<p><br>

		<a href="login.php"><b>Click here to login</b></a></p>	  

	  <?php unset($_SESSION["forgorpasssuccess"]); } ?>

      		</td>



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