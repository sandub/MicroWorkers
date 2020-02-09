<?php 
include("include/header.php");
include('phpmailer/class.phpmailer.php');
if(!isset($_SESSION["userlogin"])) { header("location: login.php"); exit(); }
$tell=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$_SESSION["userlogin"]."'"),MYSQL_BOTH);
if(isset($_POST["Button"])) {

$Email=$_POST["Email"];
$Name=$_POST["Name"];
	if(strlen($Email)>0) {
		if($Email!=$_SESSION["userlogin"]) {
			if(dbNumRows(dbQuery("select * from `user_registration` where `email`='".$Email."'"))>0) {
			$_SESSION["emailerror"]='Yes';
			$_SESSION["mailexists"]='Yes';
			
			} else {
			       $ER=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$_SESSION["userlogin"]."'"),MYSQL_BOTH);
			
					$sig = dbFetchArray(dbQuery("select * from `mailsettings` where `id`='18'"),MYSQL_BOTH);
					$Subject1 = stripslashes($sig["subject"]);
					$TemplateMessage=str_replace("%NAME%", $Name, stripslashes($sig["message"]));
					$TemplateMessage=str_replace("%YOURNAME%", stripslashes($ER["fullname"]), $TemplateMessage);
					$TemplateMessage=str_replace("%URL%", "<a href='".$URL."signup.php?REF=".base64_encode($_SESSION["userlogin"])."' target=\'_blank\'>".$URL."signup.php?REF=".base64_encode($_SESSION["userlogin"])."</a>", $TemplateMessage);									
								
					$mail = new PHPMailer;
					$mail->FromName = $fromName;
					$mail->From    = $from;
					$mail->Subject = $Subject1;
					$mail->Body    = stripslashes($TemplateMessage);
					$mail->AltBody = stripslashes($TemplateMessage);					
					$mail->IsHTML(true);	
					$mail->AddAddress($Email,$Name);
					if($mail->Send())
					{
					$_SESSION["emailsuccess"]='Yes';
					}	
			
			
			
			
			}
		}	
		$_SESSION["emailerror"]='Yes';
		$_SESSION["mailexists"]='Yes';
	} else {
	$_SESSION["emailerror"]='Yes';
	$_SESSION["emailblank"]='Yes';
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
					<td width="100%" align="left" style="font-weight:bold; padding-left:10px;">Tell a Friend</td>
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
					
				 <?php if(!isset($_SESSION["emailsuccess"])) { ?>
			 <table width="704" border="0" cellspacing="0" cellpadding="0">

                 <tr>
                   <td colspan="3">
				 <table width="704" border="0" cellspacing="0" cellpadding="0">
                     

                     <tr>
                       <td><table border="0" width="100%" cellspacing="0" cellpadding="20" class="submit">
			<tr>
	  <td style="padding-left:32px">
      <table border="0" cellspacing="0" style="border-collapse: collapse" id="AutoNumber60" cellpadding="0">
        <tr nowrap>
          <td><b><span color="#F62355">01</span></b> <b>Tell a Friend</b></td>
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
      <p><br>
	  <?php if(isset($_SESSION["emailerror"])) { ?> 
		<table border="0" cellpadding="5" cellspacing="2" bgcolor="#FF0000" width="360">
		  <tr>
			<td width="100%" bgcolor="#F4F4F4"><font color="#FF0000"><b>&nbsp;&nbsp;<?php if(isset($_SESSION["mailexists"])) { ?>Email already taken<?php unset($_SESSION["mailexists"]); } if(isset($_SESSION["emailblank"])) { ?>Email is missing<?php unset($_SESSION["emailblank"]); } ?></b></font></td>
		  </tr>
		</table>
	 <?php unset($_SESSION["emailerror"]); }?>
		</p>
		<form name="ff" method="POST" action="tellafriend.php" onsubmit="return blankcheck();">
        <p>Your friends name &nbsp;&nbsp;

            <input type="text" name="Name" size="40"></p>
		<p>Enter email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

		<input type="text" name="Email" onchange="return validateemail();" size="40"></p>
		<p><br>
            <input type="submit" value="Send Invitation" name="Button"></p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
      </form>
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
                       <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                         <tr>
                           <td width="9"><img src="image/job_content_left.jpg" /></td>
                           <td width="690" class="job"><span class="account_gist_text1"><?php echo stripslashes($tell["fullname"]); ?></span></td>
                           <td width="9"><img src="image/job_content_right.jpg" /></td>
                         </tr>
                       </table></td>
                     </tr>

                     <tr>
                       <td class="job_content_border"><table border="0" width="100%" cellspacing="0" cellpadding="20" class="submit">
			<tr>
				<td>
      <table border="0" cellspacing="0" style="border-collapse: collapse" id="AutoNumber60" cellpadding="0">
        <tr>
          <td nowrap>01 Tell a friend</b></td>
          <td nowrap>&nbsp;</td>
          <td nowrap><b><font color="#F62355">02</font></b> <b>Confirmation</b></td>
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
		You have successfully sent an invitation!&nbsp;&nbsp; </p>
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
	<?php unset($_SESSION["emailsuccess"]); } ?>
					
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