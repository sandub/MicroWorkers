<?php 

include("include/header.php");

if(!isset($_SESSION["userlogin"])) { header("location: login.php"); exit(); }

$passchange=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$_SESSION["userlogin"]."'"),MYSQL_BOTH);

if(isset($_POST["Button"])) {

	$password=$_POST["Password"];

	if(strlen($password)>=3 && strlen($password)<=20) {

	dbQuery("update `user_registration` set `password`='".base64_encode($password)."' where `email`='".$_SESSION["userlogin"]."'");

	$_SESSION["passwordsuccess"]='Yes';

	} else {

	$_SESSION["passworderror"]='Yes';

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

					<td width="100%" align="left" style="font-weight:bold; padding-left:10px;">My Account</td>

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

					

					

				   <?php if(!isset($_SESSION["passwordsuccess"])) { ?>

			<table width="704" border="0" cellspacing="0" cellpadding="0">



                 <tr>

                   <td colspan="3"><table width="704" border="0" cellspacing="0" cellpadding="0">

                     <tr>

                       <td><table border="0" width="100%" cellspacing="0" cellpadding="20">

			<tr>



				<td>

      <table border="0" cellspacing="0" style="border-collapse: collapse" id="AutoNumber60" cellpadding="0">

        <tr>

          <td nowrap><b><font color="#F62355">01</font></b> <b>enter new 

			password</b></td>

          <td nowrap>&nbsp;</td>

          <td nowrap>02 confirmation</td>

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

      <p><br>

	 <?php if(isset($_SESSION["passworderror"])) { ?> 

		<table border="0" cellpadding="5" cellspacing="2"  bgcolor="#FF0000" width="360">

		  <tr>

			<td width="100%" bgcolor=#F4F4F4><font color="#FF0000"><b>&nbsp;&nbsp;Password not valid (3-20 chars)</b></font></td>

		  </tr>

		</table>

	 <?php unset($_SESSION["passworderror"]); }?>

		</p>

		<form name="ff" method="POST" action="account_password_change.php" onsubmit="return blankcheck();">

        <p>Enter new password<br>



            <input type="text" name="Password" size="40">&nbsp;&nbsp;

			<span style="font-size: 11px;">[3-20 characters]</span></p>

		<p><br>

            <input type="submit" value="Save changes" name="Button"></p>

		<p>&nbsp;</p>

		<p>&nbsp;</p>

      </form>

      			</td>



		</tr>

		</table></td>

	</tr>

	</table></td>

	</tr>

	<tr>

	<td width="9">&nbsp;</td>

	<td>&nbsp;</td>

	<td width="9">&nbsp;</td>

	</tr>

	</table>

  <?php } else { ?>

  <table width="704" border="0" cellspacing="0" cellpadding="0">



                 <tr>

                   <td colspan="3"><table width="704" border="0" cellspacing="0" cellpadding="0">

                   <tr>

                       <td><table border="0" width="100%" cellspacing="0" cellpadding="20">

			<tr>

				<td>

      <table border="0" cellspacing="0" style="border-collapse: collapse" id="AutoNumber60" cellpadding="0">

        <tr>

          <td nowrap>01 enter new password</td>

          <td nowrap>&nbsp;</td>

          <td nowrap><b><font color="#F62355">02</font></b> <b>confirmation</b></td>

        </tr>



        <tr>

          <td nowrap colspan="3">

          <img border="0" src="images/p.gif" width="3" height="3"></td>

        </tr>

        <tr>

          <td nowrap bgcolor="#DDDDDD">

          <img border="0" src="images/p.gif" width="3" height="3"></td>

          <td nowrap bgcolor="#DDDDDD">

          <img border="0" src="images/p.gif" width="12" height="3"></td>



          <td nowrap bgcolor="#F62355">

          <img border="0" src="images/p.gif" width="3" height="3"></td>

        </tr>

      </table>



      <p><br>

		<br>

		Password changed!&nbsp;&nbsp; </p>

		<p><br>

		<a href="account.php"><b>Back to Account settings</b></a></p>

		<p>&nbsp;</p>

		<p>&nbsp;</p>

      	</td>

		</tr>

		</table></td>

	</tr>

	</table></td>

	</tr>

	<tr>

	<td width="9">&nbsp;</td>

	<td>&nbsp;</td>

	<td width="9">&nbsp;</td>

	</tr>

	</table>

  <?php unset($_SESSION["passwordsuccess"]); } ?>

<script language="javascript" type="text/javascript">

function blankcheck() {

	if(document.ff.Password.value=='') {

	alert('Please your Password Correctly!');

	document.ff.Password.focus();

	return false;

	}

}

</script>

					

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