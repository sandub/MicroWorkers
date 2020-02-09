<?php 
include("include/header.php");
if(!isset($_SESSION["userlogin"])) { header("location: login.php"); exit(); }
$paymentid=dbFetchArray(dbQuery("select * from `paymentids` where `paypalid`<>''"),MYSQL_BOTH);
if(isset($_GET["s"]) && base64_decode($_GET["s"])=='success') {
$_SESSION["successpay"]='Yes';
header("location: deposit.php");
exit();
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
					<td width="100%" align="left" style="font-weight:bold; padding-left:10px;">Deposit funds</td>
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
					
					
					
					<table border="0" width="95%" cellspacing="0" cellpadding="20">
			<tr>
				<td style="padding-left:20px;">
	<?php if(!isset($_SESSION["successpay"])) { ?>
      <table border="0" cellspacing="0" style="border-collapse: collapse" id="AutoNumber29" cellpadding="0" height="19">
        <tr>
          <td nowrap height="14"><b><font color="#F62355">01</font> select 
			funding source</b></td>

          <td nowrap height="14"></td>
          <td nowrap height="14">02 confirmation</td>
        </tr>
        <tr>
          <td nowrap colspan="3" height="2">
          <img border="0" src="images/p.gif" width="3" height="3"></td>
        </tr>
        <tr>

          <td nowrap bgcolor="#F62355" height="3">
          <img border="0" src="images/p.gif" width="3" height="3"></td>
          <td nowrap bgcolor="#DDDDDD" height="3">
          <img border="0" src="images/p.gif" width="12" height="3"></td>
          <td nowrap bgcolor="#dddddd" height="3">
          <img border="0" src="images/p.gif" width="3" height="3"></td>
        </tr>
      </table>
	<?php } else { ?>
	  <table border="0" cellspacing="0" style="border-collapse: collapse" id="AutoNumber29" cellpadding="0" height="19">
        <tr>
          <td nowrap height="14">01 select funding source</td>

          <td nowrap height="14"></td>
          <td nowrap height="14"><b><font color="#F62355">02</font> confirmation</b></td>
        </tr>
        <tr>
          <td nowrap colspan="3" height="2">
          <img border="0" src="images/p.gif" width="3" height="3"></td>
        </tr>
        <tr>
          <td nowrap bgcolor="#dddddd" height="3">
          <img border="0" src="images/p.gif" width="3" height="3"></td>
          <td nowrap bgcolor="#DDDDDD" height="3">
          <img border="0" src="images/p.gif" width="12" height="3"></td>
          <td nowrap bgcolor="#F62355" height="3">
          <img border="0" src="images/p.gif" width="3" height="3"></td>
        </tr>
      </table>
	<?php } ?>
          <p style="line-height: 150%">

      <br>
		You can deposit funds to your <?php echo $SiteName; ?> account via PayPal, Credit 
		card or Moneybookers.<br>
		Money will be available in your account immediately after you confirm 
		the transaction.&nbsp; <b>
      <font face="Arial" color="#DD0000"><i>*** Deposit fees <?php echo $DepositFees; ?>% ***<br>
&nbsp;</i></font> <font face="Arial" color="#009933"><i>*** You can waive transcation charges by invite <?php echo $WithdrawDepositReferrallimit; ?> friends ***<br>
&nbsp;</i></font></b></p>
		
<?php if(!isset($_SESSION["successpay"])) { ?>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>

				<td valign="top">
        		<table border="0" cellspacing="0" cellpadding="0" width="100%">
					<tr>
						<td colspan="5">
							<table border="0" cellpadding="7" cellspacing="1" id="AutoNumber51"  bgcolor="#CFCFB3" width="100%">
							<tr>
							  <td bgcolor="#F9F9D7" valign="top" style="padding-left:10px;">
									<b>Automatic deposit</b></td>
					
							</tr>
							</table>
        				</td>
					</tr>
					<tr>
						<td colspan="5">
						<img border="0" src="images/p.gif" width="22" height="22"></td>
					</tr>
					<tr>

						<td width="120"><p align="center"><b>PayPal</b></p></td>
						<td>&nbsp; </td>
						<td width="110"><p align="center"><a target="_blank" href="https://www.paypal.com"><img border="0" src="images/paypal_buynow.gif" width="72" height="29"></a></p></td>
						<td>&nbsp;</td>
						<td>

						<p align="left" style="line-height: 150%">Deposit via                         PayPal - most popular:</p>
						<p align="left" style="line-height: 150%">-<SPAN STYLE="font-size: 14px; font-weight: 700"><a href="deposit_init.php?Amount=25">                        <SPAN STYLE="font-size: 16px; font-weight: 700">deposit                         $25</SPAN></a></SPAN><SPAN STYLE="font-size: 16px; font-weight: 700"><BR>                        </SPAN>-<A HREF="deposit_init.php?Amount=50"><SPAN STYLE="font-size: 16px"><B> deposit $50</B></SPAN></A><BR>                        <SPAN STYLE="font-size: 16px">- </SPAN><a href="deposit_init.php?Amount=100">                        <SPAN STYLE="font-size: 16px; font-weight: 700">deposit                         $100</SPAN></a></p><p align="left" style="line-height: 150%">Other amounts:<a href="deposit_init.php?Amount=10">                        <B>$10</B></a><B>&nbsp;&nbsp; </B><a href="deposit_init.php?Amount=25">                        <SPAN STYLE="font-size: 16px; font-weight: 700">$25</SPAN></a><SPAN STYLE="font-size: 16px; font-weight: 700">&nbsp;&nbsp;                        </SPAN><a href="deposit_init.php?Amount=50">                        <SPAN STYLE="font-size: 16px"><B>$5</B></SPAN><SPAN STYLE="font-size: 16px" LANG="sl"><B>0</B></SPAN></a><SPAN STYLE="font-size: 14px; font-weight: 700">&nbsp;&nbsp;                        </SPAN><a href="deposit_init.php?Amount=100">                        <SPAN STYLE="font-size: 14px; font-weight: 700">$100</SPAN></a><b>&nbsp;&nbsp;

			</b><a href="deposit_init.php?Amount=250"><b>$250</b></a><b>&nbsp;&nbsp;
			</b><a href="deposit_init.php?Amount=500"><b>$500</b></a><br>
						You will be redirected to
			PayPal to approve the transaction.</p>
					  </td>
			</tr>
			<tr>
				<td colspan="5">
						<img border="0" src="images/p.gif" width="22" height="22">
				</td>
			</tr>
			<tr>
				<td colspan="5" bgcolor="#DDDDDD">
				<img border="0" src="images/p.gif" width="1" height="1"></td>
			</tr>
	</table>
	
				<table border="0" cellspacing="0" cellpadding="0" width="100%">
					<tr>
						<td colspan="5">
							<table border="0" cellpadding="7" cellspacing="1" id="AutoNumber51"  bgcolor="#CFCFB3" width="100%">
							<tr>
							  <td bgcolor="#F9F9D7" valign="top" style="padding-left:10px;">
									<b>Manual deposit</b></td>
					
							</tr>
							</table>
        				</td>
					</tr>
					<tr>
						<td colspan="5">
						<img border="0" src="images/p.gif" width="22" height="22"></td>
					</tr>
					<tr>

						<td width="120"><p align="center"><b>Moneybookers</b></p></td>
						<td>&nbsp; </td>
						<td width="110"><p align="center"><a target="_blank" href="http://moneybookers.com/">
<img border="0" src="images/moneybookers.gif" width="90" height="35"></a></p></td>
						<td>&nbsp;</td>
						<td>

						<p style="line-height: 150%">
		<b>*** Minimum deposit is $10 ***</b><br>
		You can send any amount to our Moneybookers account.<br>		
		Moneybookers email:&nbsp; <b><font color="#4874CD"><?php echo $paymentid["moneybookersid"]; ?></font></b><br>
		We will deposit funds to your account immediately.<br>
		After you have sent the money, send open a <u>        Support ticket</u> with subject &quot;Money Deposit&quot; so we can process it         immediately.</p>
					  </td>
			</tr>
			<tr>
				<td colspan="5">
						<img border="0" src="images/p.gif" width="22" height="22">
				</td>
			</tr>
			<tr>
				<td colspan="5" bgcolor="#DDDDDD">
				<img border="0" src="images/p.gif" width="1" height="1"></td>
			</tr>
	</table>
	
				<table border="0" cellspacing="0" cellpadding="0" width="100%">					
					<tr>
						<td colspan="5">
						<img border="0" src="images/p.gif" width="22" height="22"></td>
					</tr>
					<tr>

						<td width="120"><p align="center"><b>Alertpay</b></p></td>
						<td>&nbsp; </td>
						<td width="110"><p align="center"><a target="_blank" href="http://alertpay.com">
<img border="0" src="images/alertpay.gif" width="96" height="40" hspace="10"></a></p></td>
						<td>&nbsp;</td>
						<td>

						<p style="line-height: 150%">
		<b>*** Minimum deposit is $10 ***<br>        </b>You can send any amount to our Alertpay account.<br>
		Alertpay email:&nbsp; <b><font color="#4874CD"><?php echo $paymentid["alertpayid"];; ?></font></b><br>

		We will deposit funds to your account immediately.<br>
		After you have sent the money, send open a <u>        Support ticket</u> with subject &quot;Money Deposit&quot; so we can process it         immediately.</p>
					  </td>
			</tr>
			<tr>
				<td colspan="5">
						<img border="0" src="images/p.gif" width="22" height="22">
				</td>
			</tr>
			<tr>
				<td colspan="5" bgcolor="#DDDDDD">
				<img border="0" src="images/p.gif" width="1" height="1"></td>
			</tr>
	</table>
	

<?php } else { ?>

 <table align=center border="0" cellpadding="0" width="100%" >
	<tr>
      
  <td align="center" style="text-align:center; vertical-align:middle; font-size:16px; font-weight:bold; color:#006600; height:100px; padding-top:40px;">
	 Deposit Successful
  </td>
     

    </tr>
  </table>
<?php unset($_SESSION["successpay"]); } ?>
        		<table border="0" cellspacing="0" cellpadding="0" width="100%">
					<tr>
					<td>
						<img border="0" src="images/p.gif" width="1" height="1">
					</td>
					</tr>
				</table>
		<p style="line-height: 150%">
		<br>
		<br>
      	<br>
		<br>
    	<br>
		</p>

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