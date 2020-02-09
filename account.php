<?php 
include("include/header.php");
if(!isset($_SESSION["userlogin"])) { header("location: login.php"); exit(); }
$resaccount=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$_SESSION["userlogin"]."'"),MYSQL_BOTH);
?>
<script type="text/javascript" src="prototype/javascripts/prototype.js"> </script> 
<script type="text/javascript" src="prototype/javascripts/effects.js"> </script>
<script type="text/javascript" src="prototype/javascripts/window.js"> </script>

<link href="prototype/themes/default.css" rel="stylesheet" type="text/css" ></link>
<link href="prototype/themes/spread.css" rel="stylesheet" type="text/css" ></link>
<script language="javascript1.1">
function loadtempalte(id,jid)
{
	 var wintemp = new Window({className: "spread", title: "Job Preview",top:100, left:200, width:550, height:400,url: "referral_details.php", showEffectOptions: {duration:1.5}})
	 wintemp.show();     
	 return false;
}
</script>
	
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
					
					
					
				     <table width="704" border="0" cellspacing="0" cellpadding="0">                                          
                     <tr>
                       <td height="5">&nbsp;</td>
                     </tr>
                     <tr>
						<td>
		<table border="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="640" id="AutoNumber60" cellpadding="0">
				
				<tr>					
						  <td valign="top">
					  <table name=TABLE border="0" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber41">
				  <tr name=BALANCE>
					<td width="100%" class="submit">
					<p style="line-height: 150%">&mdash;<b> $<?php echo number_format($resaccount["current_balance"],'2','.',''); ?> </b>on account</td>
				  </tr name=BALANCE>
				  <tr name=BALANCE>
					<td width="100%" class="submit">
					<?php 
					$resoffer=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$_SESSION['userlogin']."'"),MYSQL_BOTH);
					?>
					&mdash;&nbsp;Jobs You Have Rated as Satisfied <b><?php echo $resoffer["bonuscount"]; ?></b></td>
				  </tr name=BALANCE>
				  <?php   
				  if($resaccount["address1"]=='') { ?>
				  <tr name=ADDRESS>
					<td width="100%">
					<p style="line-height: 150%"><font color="#DD0000">&mdash;</font> <font color="#DD0000">
					<b>Address not yet submitted&nbsp; </b>&nbsp; </font>&nbsp;
					<a href="account_address_edit.php"><span style="font-size: 11px">Edit address</span></a></p></td>
				  </tr name=ADDRESS>
				  <?php } ?>
				  </table name=TABLE>
				          </td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
					  </table>
					  	</td>
                     </tr>
					  <tr>
                       <td>					    
	<table border="0" width="640" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber61">
						<tr>
						  <td width="25">&nbsp;</td>
						  <td width="362" align="left" valign="top">
						  <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber62">
							<tr>
							  <td width="100%"><b><u>Contact Details</u></b></td>
							</tr>
							<tr>
							  <td width="100%"><b>&nbsp;</b></td>
							</tr>
						  </table>
						  <table border="0" cellpadding="0" cellspacing="0" width="100%" id="AutoNumber63">
							<tr>
							  <td valign="top" width="100%">
							   <table border="0" cellspacing="0" id="AutoNumber64" cellpadding="3" width="360" style="border-collapse: collapse" bordercolor="#aaaaaa" class="submit">
						  <tr class="submit">
							<td valign="top" nowrap>Full name</td>
				
							<td valign="top" style="border-bottom-style: solid;  border-bottom-width: 1px; border-bottom-color: #dddddd"  nowrap width="100%">
							<b><?php echo stripslashes($resaccount["fullname"]); ?></b></td>
						  </tr>
						  <tr>
							<td valign="top" nowrap>Address</td>
							<td valign="top" style="border-bottom-style: solid;  border-bottom-width: 1px; border-bottom-color: #dddddd" nowrap width="100%"><?php if($resaccount["address1"]!='') { echo stripslashes($resaccount["address1"]); } if($resaccount["address2"]!='') { '<br>'.stripslashes($resaccount["address2"]); } ?><br>            </td>
						  </tr>
				
						  <tr>
							<td valign="top" nowrap>Zip code</td>
							<td valign="top" style="border-bottom-style: solid;  border-bottom-width: 1px; border-bottom-color: #dddddd" nowrap width="100%"><?php if($resaccount["zip"]!='') { echo stripslashes($resaccount["zip"]); } ?></td>
						  </tr>
						  <tr>
							<td valign="top" nowrap>City</td>
							<td valign="top" style="border-bottom-style: solid;  border-bottom-width: 1px; border-bottom-color: #dddddd" nowrap width="100%"><?php if($resaccount["city"]!='') { echo stripslashes($resaccount["city"]); } ?></td>
						  </tr>
				
						  <tr>
							<td valign="top" nowrap>State/Region&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
							<td valign="top" style="border-bottom-style: solid;  border-bottom-width: 1px; border-bottom-color: #dddddd" nowrap width="100%"><?php if($resaccount["state"]!='') { echo stripslashes($resaccount["state"]); } ?></td>
						  </tr>
						  <tr>
							<td valign="top" nowrap>Country&nbsp; </td>
							<td valign="top" style="border-bottom-style: solid;  border-bottom-width: 1px; border-bottom-color: #dddddd" nowrap width="100%"><?php if($resaccount["country"]!='') { echo stripslashes($resaccount["country"]); } ?></td>
						  </tr>
						  <tr>
							<td valign="top" nowrap>Phone #&nbsp; </td>
							<td valign="top" style="border-bottom-style: solid;  border-bottom-width: 1px; border-bottom-color: #dddddd" nowrap width="100%"><?php if($resaccount["phone"]!='') { echo stripslashes($resaccount["phone"]); } ?></td>
						  </tr>
						  </table>             
							  </td>
							</tr>
						  </table>
						  <table border="0" width="100%" cellspacing="0" cellpadding="0">
							<tr>
							  <td>&nbsp;</td>
							</tr>
					<?php if($resaccount["address1"]!='') { ?>
					<tr>
						<td align="center"><a href="account_address_update.php"><span style="font-size: 12px">Update Account Address</span></a></td>
					</tr>
					<?php
					}
					?>
							</table>
	 <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber71">
							<tr>
							  <td width="100%"><b><u>Newsletter</u></b></td>
							</tr>							
						  </table>
		 <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber72">
							<tr>
							  <td valign="top" width="100%">
							 Newsletter: <a href="account_newsletter_change.php?s=<?php echo $resaccount["newsletter"]; ?>"><?php if($resaccount["newsletter"]=='1') { echo 'On'; } else { echo 'Off'; } ?></a></td>
						  
			</tr>
			<tr>
							  <td width="100%"><b>&nbsp;</b></td>
							</tr>
		  </table>         
						   </td>
						  <td width="25" valign="top">
						  <img border="0" src="images/p.gif" width="25" height="25">
						  </td>
						  <td width="216" valign="top">
						  <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber65" class="submit">
							<tr>
							  <td width="100%" height="20px"><b><u>Email &amp; Password</u></b></td>
							</tr>
							<tr>
							  <td width="100%" height="20px"></td>
							</tr>
						  </table>
						  <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber66">
				
							<tr>
							  <td valign="top" width="5">
							  <img border="0" src="images/p.gif" width="9" height="9"></td>
							  <td bgcolor="#DDDDDD" valign="top" width="5">
							  <img border="0" src="images/p.gif" width="3" height="3"></td>
							  <td valign="top">
							  <img border="0" src="images/p.gif" width="10" height="10"> &nbsp; </td>
							  <td valign="top" width="100%">				
								<table border="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" class="submit" id="AutoNumber67" cellpadding="3">
						  <tr>
							<td valign="top">Email: <?php if($resaccount["email"]!='') { echo stripslashes($resaccount["email"]); } ?> <a href="account_email_change.php">
							<span style="font-size: 11px">Change</span></a></td>
						  </tr>
						  <tr>
							<td valign="top">
							Password:
							********** <a href="account_password_change.php">
				
							<span style="font-size: 11px">Change</span></a></td>
						  </tr>
						  </table>
						 	  </td>
							</tr>
						  </table>
						  <table border="0" width="100%" cellspacing="0" cellpadding="0">
							<tr>
							<td>&nbsp;</td>
							</tr>
							</table>
						  <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber68">
						   <tr>
							  <td width="100%"><b><u>   Referrals&nbsp;&amp; Bonuses&nbsp;</u></b></td>
							</tr>
							<tr>
							  <td width="100%"><b>&nbsp;</b></td>
							</tr>
						  </table>
						  <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber69">
							<tr>
							  <td valign="top" width="5">
							  <img border="0" src="images/p.gif" width="9" height="9"></td>
				
							  <td bgcolor="#DDDDDD" valign="top" width="5">
							  <img border="0" src="images/p.gif" width="3" height="3"></td>
							  <td valign="top">
							  <img border="0" src="images/p.gif" width="10" height="10"> &nbsp; </td>
							  <td valign="top" width="100%">
								<table border="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber70" class="submit" cellpadding="3">
						  <tr>
							<td valign="top" width="216">			
							<p style="line-height: 150%"><a href="#" onClick="return loadtempalte();" style="color:#000000; text-decoration:none; font-weight:bold">Members Signed under you: <?php echo $muu=dbNumRows(dbQuery("select * from `user_registration` where `referrer`='".$resaccount["email"]."' and `status`='1'")); ?></a></p>							
							<!--Sign up:--></td>
						  </tr>
						  </table>
						      </td>
							</tr>
						  </table>
						    </td>
						  </tr>
						  <tr>
						  	<td colspan="4" style="padding-left:25px;" align="left"><a style='cursor:help;color:#000000;' onmouseover="Tip('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Use this link to Make Money Inviting new members. You will be paid $0.10 Per Sign up and $10.00 After users Balance reaches $10.00 or More.', BORDERCOLOR, '#CFCFB3', BGCOLOR, '#f9f9d7', WIDTH, -180, FONTFACE, 'Arial,Tahoma', FONTSIZE, '12px')" onmouseout="UnTip()"><strong style="text-decoration:underline;">Your referral link</strong></a> : <?php echo "<a href='".$URL."signup.php?REF=".base64_encode($_SESSION["userlogin"])."' target=\'_blank\'>".$URL."signup.php?REF=".base64_encode($_SESSION["userlogin"])."</a>"; ?></td>
						  </tr>
					     </table>
					  </td>
                     </tr>					  
					</table>
					
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					 <tr>
                       <td align="center">&nbsp;</td>
                     </tr>
					  <tr>
                       <td align="center"><b>Transactions History</b></td>
                     </tr>
					  <tr>
                       <td align="center">	
					  <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" id="AutoNumber27">
					 <tr name=SPACER>
						<td colspan="5" height="5">				
						<img border="0" src="images/p.gif" width="4" height="4">
						</td>
				     </tr name=SPACER>
				  <tr name=NONE>
				  <td width="27"></td>
					<td align="center" nowrap colspan="5">
				  <?php
				  $sqlmac=dbQuery("select * from `myaccount` where `email`='".stripslashes($resaccount["email"])."'");
				  if(dbNumRows($sqlmac)>0) { ?>
				  <table width="420" border="1" cellpadding="5" cellspacing="5" bordercolor="#4EBBE4" style="border:1px solid #4EBBE4; border-collapse:collapse">
					  <tr>
						<td align="center" style="font-weight:bold; color:#999999;">Transaction</td>
						<td align="center" style="font-weight:bold; color:#999999;">Amount</td>
						<td align="center" style="font-weight:bold; color:#999999;">Date</td>
					  </tr><?php
				  while($resmac=dbFetchArray($sqlmac,MYSQL_BOTH)) {
				  ?>
					  <tr>
						<td align="center">
						<?php 
						if($resmac["type"]=='0') { echo 'Withdraw Amount'; } 
						if($resmac["type"]=='1') { echo 'Sign Up Bonus'; } 
						if($resmac["type"]=='2') { echo 'Sign Up Bonus'; } 
						if($resmac["type"]=='3') { echo 'Account Deposit'; } 
						if($resmac["type"]=='4') { echo 'Withdraw Charges'; }  
						if($resmac["type"]=='5') { echo 'Paid Job : '; }  
						$Jres=dbFetchArray(dbQuery("select * from `jobs` where `id`='".$resmac["jobid"]."'"),MYSQL_BOTH);
						if($resmac["type"]=='6') { echo 'Paid Job : ';  echo ($Jres["title"]=='')?'Job Title':stripslashes($Jres["title"]); }
						if($resmac["type"]=='9') { echo 'Referred : '.$resmac["referreduser"]; }
						$Jres=dbFetchArray(dbQuery("select * from `jobs` where `id`='".$resmac["jobid"]."'"),MYSQL_BOTH);
						if($resmac["type"]=='8') { echo 'Job Post : '; echo ($Jres["title"]=='')?'Job Title':stripslashes($Jres["title"]); }
						$Jres=dbFetchArray(dbQuery("select * from `jobs` where `id`='".$resmac["jobid"]."'"),MYSQL_BOTH);
						if($resmac["type"]=='10') { echo 'Job Refund : '; echo ($Jres["title"]=='')?'Job Title':stripslashes($Jres["title"]); }
						 ?>
						</td>
						<td align="center">
						<?php 
						if($resmac["type"]=='0') { echo '<strong>-</strong>'; } 
						if($resmac["type"]=='1') { echo '<strong>+</strong>'; } 
						if($resmac["type"]=='2') { echo '<strong>+</strong>'; } 
						if($resmac["type"]=='3') { echo '<strong>+</strong>'; } 
						if($resmac["type"]=='4') { echo '<strong>-</strong>'; }  
						if($resmac["type"]=='5') { echo '<strong>-</strong>'; }  
						if($resmac["type"]=='6') { echo '<strong>+</strong>'; } 
						if($resmac["type"]=='9') { echo '<strong>+</strong>'; } 
						if($resmac["type"]=='8') { echo '<strong>-</strong>'; } 
						if($resmac["type"]=='10') { echo '<strong>+</strong>'; } 
						 echo '$'.number_format($resmac["amount"],'2','.',''); 
						 ?>
						 </td>
						<td align="center"><?php echo date("m/d/Y",strtotime($resmac["createdate"])); ?></td>
					  </tr>
				  <?php } ?>
					 <tr>
						<td align="center" style="font-weight:bold; color:#999999;">Total Amount</td>
						<td align="center" style="font-weight:bold; color:#999999;">$<?php echo number_format($resaccount["current_balance"],'2','.','');?></td>
						<td align="center" style="font-weight:bold; color:#999999;"><?php echo date("m/d/Y"); ?></td>
					  </tr>
				  </table><p>&nbsp;</p><?php } else { ?>
				 <span class="submit">No transactions Yet</span><?php } ?>  </td>
				  </tr name=NONE>
				  </table name=TABLE>
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