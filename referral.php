<?php 
include("include/header.php");
if(!isset($_SESSION["userlogin"])) { header("location: login.php"); exit(); }
$withdraw=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$_SESSION["userlogin"]."'"),MYSQL_BOTH);
$reswith=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$_SESSION["userlogin"]."'"),MYSQL_BOTH);
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
					<td width="100%" align="left" style="font-weight:bold; padding-left:10px;">Make Money With Referrals!</td>
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
					
					
				<table width="100%" border="0" cellspacing="0" cellpadding="0">							
                <tr>
				<td width="5"></td>	
                   <td valign="top">
				   <table width="404" border="0" cellspacing="0" cellpadding="0">
                     <tr>
                       <td>
			<table border="0" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber41">
			<tr>
			<td valign="left" style="padding-left:10px">			
			<p>
			
			
			Your referral link<span style="font-size: 11px; "><a style='cursor:help;' onmouseover="Tip('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Use this link for bringing new members. You will be paid for each member you refer.', BORDERCOLOR, '#CFCFB3', BGCOLOR, '#f9f9d7', WIDTH, -180, FONTFACE, 'Arial,Tahoma', FONTSIZE, '12px')" onmouseout="UnTip()">
						?</a></span><br>
						<?php echo "<a href='".$URL."signup.php?REF=".base64_encode($_SESSION["userlogin"])."' target=\'_blank\'>".$URL."signup.php?REF=".base64_encode($_SESSION["userlogin"])."</a>"; ?><BR><BR>
						$<?php echo $ReferralFIRSTJobComplete; ?> Per Signup<span style="font-size: 11px; "><a style='cursor:help;' onmouseover="Tip('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;User Must Activate Account and Complete at Least 1 Job.', BORDERCOLOR, '#CFCFB3', BGCOLOR, '#f9f9d7', WIDTH, -180, FONTFACE, 'Arial,Tahoma', FONTSIZE, '12px')" onmouseout="UnTip()">
						*</a></span><br>
			$<?php echo $ReferralBalanceReached10; ?> After Referred User Balance Reaches $<?php echo $ReferralBalanceReached; ?> Or More.</p><br />
			<p style="line-height: 150%"><a href="#" onClick="return loadtempalte();" style="color:#000000; text-decoration:none; font-weight:bold">Click Here to View All Members Signed under you: <?php echo $muu=dbNumRows(dbQuery("select * from `user_registration` where `referrer`='".$_SESSION["userlogin"]."' and `status`='1'")); ?></a></p>
			</td>
			</tr>
			<tr>
			<td align="center">
				
			 <?php $resaccount=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$_SESSION["userlogin"]."'"),MYSQL_BOTH);?>
			 <?php
				  $sqlmac=dbQuery("select * from `myaccount` where `email`='".$_SESSION["userlogin"]."' and `type`='9'");
				  if(dbNumRows($sqlmac)>0) { ?>
			  <br /><p><b><u>Transactions History</u></b>&nbsp;&nbsp;</p><br />
			  
				  <table width="440" border="1" cellpadding="5" cellspacing="5" bordercolor="#4EBBE4" class="submit" style="border:1px solid #4EBBE4; border-collapse:collapse">
					  <tr>
						<td align="center" style="font-weight:bold; color:#999999; width:240px;" width="240">Transaction</td>
						<td align="center" style="font-weight:bold; color:#999999; width:100px;" width="100">Amount</td>
						<td align="center" style="font-weight:bold; color:#999999; width:100px;" width="100">Date</td>
					  </tr>
				  <?php
				  $totalreferal=0;
				  while($resmac=dbFetchArray($sqlmac,MYSQL_BOTH)) {
				  ?>
					  <tr>
						<td align="center" width="340">
						<?php 							
						/*if($resmac["type"]=='0') { echo 'Withdraw Amount'; } 
						if($resmac["type"]=='1') { echo 'Sign Up Bonus'; } 
						if($resmac["type"]=='2') { echo 'Sign Up Bonus'; } 
						if($resmac["type"]=='3') { echo 'Account Deposit'; } 
						if($resmac["type"]=='4') { echo 'Withdraw Charges'; }  
						if($resmac["type"]=='5') { echo 'Paid Job : '; }  
						$Jres=dbFetchArray(dbQuery("select * from `jobs` where `id`='".$resmac["jobid"]."'"),MYSQL_BOTH);
						if($resmac["type"]=='6') { echo 'Paid Job : '.stripslashes($Jres["title"]); }*/
						if($resmac["type"]=='9') { echo 'Referred : '.$resmac["referreduser"]; }
						/*$Jres=dbFetchArray(dbQuery("select * from `jobs` where `id`='".$resmac["jobid"]."'"),MYSQL_BOTH);
						if($resmac["type"]=='8') { echo 'Job Post : '.stripslashes($Jres["title"]); }*/
						 ?>
						</td>
						<td align="center" width="100">
						<?php 
						/*if($resmac["type"]=='0') { echo '<strong>-</strong>'; } 
						if($resmac["type"]=='1') { echo '<strong>+</strong>'; } 
						if($resmac["type"]=='2') { echo '<strong>-</strong>'; } 
						if($resmac["type"]=='3') { echo '<strong>-</strong>'; } 
						if($resmac["type"]=='4') { echo '<strong>-</strong>'; }  
						if($resmac["type"]=='5') { echo '<strong>-</strong>'; }  
						if($resmac["type"]=='6') { echo '<strong>+</strong>'; } */
						if($resmac["type"]=='9') { echo '<strong>+</strong>'; } 
						/*if($resmac["type"]=='8') { echo '<strong>-</strong>'; } */
						$totalreferal +=$resmac["amount"];
						 echo '$'.number_format($resmac["amount"],'2','.',''); 
						 ?>
						 </td>
						<td align="center" width="100"><?php echo date("m/d/Y",strtotime($resmac["createdate"])); ?></td>
					  </tr>
				  <?php } ?>
					 <tr>
						<td align="center" style="font-weight:bold; color:#999999;" width="340">Total Amount</td>
						<td align="center" style="font-weight:bold; color:#999999;" width="100">$<?php echo number_format($totalreferal,'2','.','');?></td>
						<td align="center" style="font-weight:bold; color:#999999;" width="100"><?php echo date("m/d/Y"); ?></td>
					  </tr>
				  </table>
				 <p>&nbsp;</p><?php } ?>
</td>
			</tr>
			</table>

     

          <p style="line-height: 150%">&nbsp;
      </p>	   
          <p style="line-height: 150%">
      </p>
					   
					   </td>					   
					</tr>
					</table>
				   </td>				   
				   <td valign="top">
				   <?php
				    $RefArray = array();
			  		$sqlref=dbQuery("select distinct(`referrer`) from `user_registration` where `status`='1' and `referrer`<>''");
					if(dbNumRows($sqlref)>0) {
				   ?>
						   <table width="300" border="0" cellspacing="0" cellpadding="0">
							  <tr>
							   <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
								 <tr>
								   <td width="9"><img src="image/job_content_left.jpg" /></td>
		
								   <td align="center"><u><b>Top 10 Referrals</b></u></td>
		
								   <td width="9"><img src="image/job_content_right.jpg" /></td>
								 </tr>
		
							   </table></td>
							 </tr>
							 <tr>
							   <td>
	<table width="380" border="1" cellpadding="5" cellspacing="5" bordercolor="#4EBBE4" class="submit" style="border:1px solid #4EBBE4; border-collapse:collapse">			
			<?php		
			 
			   if(dbNumRows($sqlref)>0) {
				   while($resref=dbFetchArray($sqlref,MYSQL_BOTH)) {
				   
				   $TYU = dbQuery("select * from `user_registration` where `email`='".$resref["referrer"]."' and `status`='1'");
				   if(dbNumRows($TYU)>0) {
				   $Totalref = dbNumRows(dbQuery("select * from `user_registration` where `referrer`='".$resref["referrer"]."' and `status`='1'"));	
			       $resreff = dbFetchArray($TYU,MYSQL_BOTH);				   
				   $RefArray["fullname"][] = $resreff["fullname"];
				   $RefArray["email"][] = $resreff["email"];
				   $RefArray["refcount"][] = $Totalref;
				    }
					
				   }
			   } 
			   
			    $temp1 = ""; $temp2 = ""; $temp3 = "";
				if(dbNumRows($sqlref)>0) {
					$size = count( $RefArray["refcount"] );
					for( $i = 0; $i < $size-1; $i++ ) {
						 for( $j = 0; $j < $size - 1 - $i; $j++ ) {
							  if( $RefArray["refcount"][$j+1] > $RefArray["refcount"][$j] ) {
							  
								   $temp1 = $RefArray["fullname"][$j];
								   $temp2 = $RefArray["email"][$j];
								   $temp3 = $RefArray["refcount"][$j];
								   
								   $RefArray["fullname"][$j] = $RefArray["fullname"][$j+1];
								   $RefArray["email"][$j] = $RefArray["email"][$j+1];
								   $RefArray["refcount"][$j] = $RefArray["refcount"][$j+1];
								   
								   $RefArray["fullname"][$j+1] = $temp1;
								   $RefArray["email"][$j+1] = $temp2;
								   $RefArray["refcount"][$j+1] = $temp3;
							  }
						 }
					}
				}
			  if(dbNumRows($sqlref)>0) { 
			?>
				  <tr>
				    <td align="center" style="font-weight:bold; color:#999999;" width="40">Rank</td>
					<td align="center" style="font-weight:bold; color:#999999;" width="250">Full Name</td>
					<td align="center" style="font-weight:bold; color:#999999;" width="90">Total Referred</td>
				  </tr>
			  <?php
			  for($k=0 ; $k < 10 ; $k++) {
			  $kk = $k+1;			  
			  $resreff = dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$RefArray["email"][$k]."'"),MYSQL_BOTH);
			  ?>
				  <tr>
				    <td align="center">
					<?php echo $kk.'.'; ?>
					</td>
					<td align="center">
					<?php echo $resreff["fullname"]; ?>
					</td>					
					<td align="center"><?php echo $RefArray["refcount"][$k]; ?></td>
				  </tr>
			  <?php } 
			  ?>
			<p>&nbsp;</p>			
			<?php } ?> 
					  </table>
							   </td>
						     </tr>
							</table>
					<?php } ?>
					</td>
					<td width="5"></td>
				</tr>
				<tr>
				<td colspan="5">&nbsp;</td>
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