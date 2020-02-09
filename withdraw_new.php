<?php 

include("include/header.php");

if(isset($_POST["Button"])) {

	if(isset($_POST["Id_payment_system"])) {

	$Id_payment_system=$_POST["Id_payment_system"];

	} else {

	$Id_payment_system='';

	}

	if(isset($_POST["Amount"])) {

	$Amount=$_POST["Amount"];

	} else {

	$Amount='';

	}

	if(isset($_POST["Recipient_email_or_id"])) {

	$Recipient_email_or_id=$_POST["Recipient_email_or_id"];

	} else {

	$Recipient_email_or_id='';

	}

	$pin='QT'.rand(10000,99999);

	$resoffer=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$_SESSION['userlogin']."'"),MYSQL_BOTH);

	

	if($Amount=='' || $Amount < $MinimumWithdraw || $resoffer["current_balance"] < $Amount) { 

	$_SESSION["erroramount"]='Yes';

	} else {

		if($Id_payment_system!='') {

		

		

		if($resoffer["bonuscount"]<$WithdrawDepositReferrallimit) {

	

		$_SESSION["Wamount"]=$Amount;

		$fees=(($Amount*$DepositFees)/100);

		$Amount = $Amount-$fees;

		dbQuery("insert into `myaccount`(`email`,`amount`,`type`,`createdate`) values('".$_SESSION['userlogin']."','$fees','4','".$totaldate."')");

		dbQuery("update `user_registration` set `current_balance`='".($resoffer["current_balance"]-$fees)."' where `email`='".$_SESSION['userlogin']."'");

		}

		

		$_SESSION["Id_payment_system"]=$Id_payment_system;

		$_SESSION["Recipient_email_or_id"]=$Recipient_email_or_id;

		dbQuery("insert into `withdraw`(`wdmethod`,`wdamount`,`wdsendto`,`email`,`pin`,`status`,`applieddate`) values('$Id_payment_system','$Amount','$Recipient_email_or_id','".$_SESSION['userlogin']."','$pin','0','".$totaldate."')");

		

		$_SESSION["successpayment"]='Yes';

		} else {

		$_SESSION["errorpayment"]='Yes';

		}

	}



}

$resamount=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$_SESSION["userlogin"]."'"),MYSQL_BOTH);

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

					<td width="100%" align="left" style="font-weight:bold; padding-left:10px;"><b>Withdraw money : Place new request</b></td>

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

					

					

					

					<?php if(!isset($_SESSION["successpayment"]) && dbNumRows(dbQuery("select * from `withdraw` where `email`='".$_SESSION["userlogin"]."' and `userpin`='' and `status`='0'")) == 0) { ?>

		<table border="0" width="100%" cellspacing="0" cellpadding="20">

			<tr>

				<td>

      <table border="0" cellspacing="0" style="border-collapse: collapse" id="AutoNumber54" cellpadding="0">

        <tr>

          <td nowrap><b><font color="#F62355">01</font> withdrawal information</b></td>



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

      <p style="line-height: 150%"><br>

	  <?php if(isset($_SESSION["errorpayment"])) { ?>

		<table border="0" cellpadding="5" cellspacing="2"  bgcolor="#FF0000" width="420">

		  <tr>

			<td width="100%" bgcolor="#F4F4F4"><b><font color="#FF0000">Payment system not selected</font></b></td>

		  </tr>

		</table>

	  <br><?php unset($_SESSION["errorpayment"]); } ?>

	  <?php if(isset($_SESSION["erroramount"])) { ?>

		<table border="0" cellpadding="5" cellspacing="2"  bgcolor="#FF0000" width="420">

		  <tr>

			<td width="100%" bgcolor="#F4F4F4">

			<b><font color="#FF0000">

			Withdraw amount must be $<?php echo $MinimumWithdraw; ?> or above<br />

			Withdraw amount must be less than your current balance

			</font></b></td>

		  </tr>

		</table>

	  <br><?php unset($_SESSION["erroramount"]); } ?></p>

      <form name="ff" method="POST" action="withdraw_new.php" onsubmit="return blankcheck();">

      <table border="0" cellpadding="7" cellspacing="1" id="AutoNumber55"  bgcolor="#CFCFB3">

        <tr>

          <td bgcolor="#F9F9D7" valign="top" style="padding:10px;">

        <span lang="en-us">You can place a withdrawal request if your balance is 

		over</span> <b>$<?php echo $MinimumWithdraw; ?></b></td>

        </tr>



      </table>

        <p>

        <br>

        <table name=TABLE border="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber14" cellpadding="3">

          <tr name=TITLE>

            <td valign="top" nowrap><p><b>Withdrawal method</b></p></td>

          </tr name=TITLE><tr name=PERCENTAGE>

            <td>

            <input  <?php if($resamount["current_balance"]<$MinimumWithdraw) { ?> DISABLED <?php } ?>   type="radio" value="PAYPAL" name="Id_payment_system"  id="Id_payment_system"> 

            Paypal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>

			<td align="right">&nbsp;

            </td>

          </tr name=PERCENTAGE><tr name=PERCENTAGE>

            <td>

            <input  <?php if($resamount["current_balance"]<$MinimumWithdraw) { ?>  DISABLED <?php } ?>   type="radio" value="BANK TRANSFER" name="Id_payment_system"  id="Id_payment_system"> 

            Bank Transfer&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>

			<td align="right">&nbsp;

            </td>

          </tr name=PERCENTAGE><tr name=PERCENTAGE>

            <td>

            <input  <?php if($resamount["current_balance"]<$MinimumWithdraw) { ?>  DISABLED <?php } ?>   type="radio" value="VOUCHER" name="Id_payment_system"  id="Id_payment_system"> 

            Voucher&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>

            <td align="right">&nbsp;

            </td>

            

          </tr name=PERCENTAGE><tr name=AMOUNT>

            <td valign="top">

            <br>

            Amount to withdraw </td>

            <td valign="top">

            <br>

            <input type="text" name="Amount" size="20" value=""><br>

            <span style="font-size: 11px">Should not exceed &quot;current balance&quot; 

            limit<br>

            Minimum withdrawal is $<?php echo $MinimumWithdraw; ?></span></td>



          </tr name=AMOUNT><tr name=SENDTO>

            <td valign="top">

            <br>

            Send payment to </td>

            <td valign="top">

            <br>

            <input type="text" name="Recipient_email_or_id" size="40" value=""><br>



            <span style="font-size: 11px">Paypal, Bank Transfer: enter your details<br>

            Voucher: leave blank<br>

            (Voucher will be sent to mailing address)</span></td>

          </tr name=SENDTO><tr name=SUBMIT>

            <td>&nbsp;

            </td>

            

            <td>

            <br>

            <input type="submit" value="Submit request" name="Button"></td>           

          </tr name=SUBMIT></table name=TABLE>



      </p>

        <p>&nbsp;</p>

      </form>

      		</td>

		   </tr>

		</table>

  <?php } else if(!isset($_SESSION["successpayment"]) && dbNumRows(dbQuery("select * from `withdraw` where `email`='".$_SESSION["userlogin"]."' and `userpin`='' and `status`='0'")) > 0) { ?>

  		<table border="0" width="100%" cellspacing="0" cellpadding="20">

			<tr>

				<td>

    	<table border="0" cellspacing="0" style="border-collapse: collapse" id="AutoNumber54" cellpadding="0">

        <tr>

          <td nowrap><b><font color="#F62355">01</font> withdrawal information</b></td>



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

       <p style="line-height: 150%"><br>

	  </p>

        <p><br><br>

		Your previous withdraw request is in process!</p>		

		<p>&nbsp;</p>	

		<p>&nbsp;<b><font color="#FF0000">You can request another withdraw after it processed completely.</font></b></p>

		<p>&nbsp;</p>		

		<p>&nbsp;</p>

		

		

        <p>&nbsp;</p>

			

      		</td>

		</tr>

		</table>

  <?php } else { ?>

   		<table border="0" width="100%" cellspacing="0" cellpadding="20">

			<tr>

				<td>

    	<table border="0" cellspacing="0" style="border-collapse: collapse" id="AutoNumber54" cellpadding="0">

        <tr>

          <td nowrap>01 withdrawal information</td>



          <td nowrap>&nbsp;</td>

          <td nowrap><b><font color="#F62355">02</font> confirmation</b></td>

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

     

        <p><br><br>

		A withdraw request has been sent successfully!</p>

		<p>&quot;<b><?php echo $from; ?></b>&quot;</p>

		<p>&nbsp;</p>

		<p>&nbsp;</p>

		

		<p><span style="font-size: 11px">Please wait for withdraw PIN from admin, if there any problem please conatct PlainJobs support at </span>



		<a href="mailto:<?php echo $from; ?>"><span style="font-size: 11px">

		<?php echo $from; ?></span></a><span style="font-size: 11px"> </span>

		</p>

		<p><br>

		<a href="account.php"><b>Have a good day!</b></a></p>

        <p>&nbsp;</p>

			

      		</td>

		</tr>

		</table>  

  <?php unset($_SESSION["successpayment"]);  } ?>

					   

<script language="javascript" type="text/javascript">

function blankcheck() {

	if(document.ff.Id_payment_system[0].checked==false && document.ff.Id_payment_system[1].checked==false && document.ff.Id_payment_system[2].checked==false) {

		alert('Payment system not selected!');

		return false;

	}

	if(document.ff.Amount.value=='') {

		alert('Please enter your amount!');

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