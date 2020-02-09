<?php 
include("include/header.php");
if(!isset($_SESSION["userlogin"])) { header("location: login.php"); exit(); }
$reswith=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$_SESSION["userlogin"]."'"),MYSQL_BOTH);
if(isset($_POST["Btn"])) {
$id=$_POST["id"];
$userpin=$_POST["userpin"];
$reswithdraw=dbFetchArray(dbQuery("select * from `withdraw` where `id`='".$id."'"),MYSQL_BOTH);
if($reswithdraw["pin"]==$userpin) {
dbQuery("update `withdraw` set `userpin`='".$userpin."' where `id`='".$id."'");
} else {
$_SESSION["Epin"]='E';
}
}
?>
<link type="text/css" href="css/ui-lightness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script>
	
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
					<td width="100%" align="left" style="font-weight:bold; padding-left:10px;">Withdraw money</td>
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

          <p style="line-height: 150%">

      <table name=TABLE border="0" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber41">

  <tr name=BALANCE>

    <td width="100%">

    <p style="line-height: 150%">&mdash;<b> $<?php echo number_format($reswith["current_balance"],'2','.',''); ?> </b>on account</td>



  </tr name=BALANCE><tr name=PIN>

    <td width="100%">

    <p style="line-height: 150%"><font color="#DD0000">&mdash;</font>

	<b><font color="#DD0000">Payments on hold</font></b><table border="0" cellspacing="0" cellpadding="0">

		<tr>

			<td><img border="0" src="images/p.gif" width="15" height="1"></td>

			<td><span style="font-size: 11px"> PIN 

	will be sent to your mailing address after placing first withdrawal request.<br>



			Once you submit correct PIN we will start sending payments to you.</span></td>

		</tr>

	</table>

	</td>

  </tr name=PIN>

  <tr name=BALANCE>

  <td width="100%">

  <p style="line-height: 150%">

    <b>  <br>		

      <font face="Arial" color="#DD0000"><i>*** Withdraw fees <?php echo $WithdrawFees; ?>% ***<br>

&nbsp;</i></font> <font face="Arial" color="#009933"><i>*** You can waive transcation charges by invite <?php echo $WithdrawDepositReferrallimit; ?> friends ***<br>

&nbsp;</i></font></b></p>

  </td></tr name=BALANCE>

  </table name=TABLE>

</p><br />

    
      
<?php if(dbNumRows(dbQuery("select * from `withdraw` where `email`='".$_SESSION["userlogin"]."' and `status`='0'")) == 0) { ?>
      <p style="line-height: 150%"><a href="withdraw_new.php"><b>Place a new withdrawal request</b></a></p>
<?php } else if(isset($_SESSION["Epin"])) { ?><p style="line-height: 150%"><b><font color="#FB240D">Wrong pin entered, please check you support mail box for correct one.</font></b></p>	 
<?php unset($_SESSION["Epin"]); } else { ?>
<p><b><font color="#FF0000">You can request another withdraw after the complete processing of previous one.</font></b></p>
<?php } ?>
        
          <p style="line-height: 150%">		

       		

   		

		  <table border="0" cellspacing="5" style="border:#999999 1px solid; border-collapse: collapse" id="AutoNumber54" cellpadding="0">

		<?php $jsql=dbQuery("select * from `withdraw` where `email`='".$_SESSION["userlogin"]."' order by `id` desc");

		if(dbNumRows($jsql)>0) {	

			

		?>

 <div style="color:#666; padding-bottom:10px;">Here is your all withdraw request details.&nbsp;&nbsp;&nbsp;</div>

		 

	 <tr bgcolor="#999999"> 

		<td width="10%" align="left" valign="top" style="padding:2px; padding-left:15px;"><strong>Method</strong></td> 

		<td width="5%" align="left" valign="top" style="padding:2px;"><strong>Amount</strong></td> 

		<td width="10%" align="left" valign="top" style="padding:2px;"><strong>Payment To</strong></td> 

		<td width="10%" align="left" valign="top" style="padding:2px;"><strong>Name</strong></td> 

		<td width="10%" align="left" valign="top" style="padding:2px;"><strong>Email</strong></td>   

		<td width="10%" align="left" valign="top" style="padding:2px;"><strong>Pin</strong></td> 	 

        <td width="10%" align="left" valign="top" style="padding:2px;"><strong>Status</strong></td>

		<td width="5%" align="left" valign="top" style="padding:2px;"><strong>AppliedDate</strong></td>        

    </tr>

    <?php

	$ul=0;		

	$count=1;		

	while($t = dbFetchArray($jsql,MYSQL_BOTH))

	{		

	$resu=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$t["email"]."'"),MYSQL_BOTH);		

	?>	

	<tr id="tr<?php echo $ul; ?>"> 	

	<td class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>" align="left" valign="top" style="padding-left:15px; padding-bottom:2px; padding-top:2px; border-bottom: #999999 1px solid;"><?php echo stripslashes($t["wdmethod"]); ?></td>

	<td class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>" align="left" valign="top" style="padding-bottom:2px; padding-top:2px; border-bottom: #999999 1px solid;">$<?php echo stripslashes($t["wdamount"]); ?></td>

	<td class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>" align="left" valign="top" style="padding-bottom:2px; padding-top:2px; border-bottom: #999999 1px solid;"><?php echo stripslashes($t["wdsendto"]); ?></td>

	<td class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>" align="left" valign="top" style="padding-bottom:2px; padding-top:2px; border-bottom: #999999 1px solid;"><?php echo stripslashes($resu["fullname"]); ?></td>

	<td class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>" align="left" valign="top" style="padding-bottom:2px; padding-top:2px; border-bottom: #999999 1px solid;"><?php echo stripslashes($resu["email"]); ?></td>

	<td class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>" align="left" valign="top" style="padding-bottom:2px; padding-top:2px; border-bottom: #999999 1px solid;"><?php if($t["userpin"]=='') { echo '<font color="#FF0000">Not Entered!</font>'; } else { echo stripslashes($t["userpin"]); } ?></td>     

	<td class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>" align="left" valign="top" style="padding-bottom:2px; padding-top:2px; border-bottom: #999999 1px solid;"><?php if($t["userpin"]!=$t["pin"]) { echo '<a href="javascript: void(0);" id="dialog_link'.$t["id"].'" >Enter PIN</a>'; } else if($t["status"]==1) { echo "Completed"; }  else if($t["status"]==0) { echo "Pending"; }  ?>
	
	<script language="javascript" type="text/javascript">			  		

			    $(document).ready(function(){    
			
					
				$('#dialog_link<?php echo $t["id"]; ?>').click(function(){

				$("#dialogme<?php echo $t["id"]; ?>").dialog({

					autoOpen: true,

					width: 400					

					});	

				return false;

					});		

			  });

			</script>			

	<div id="dialogme<?php echo $t["id"]; ?>" title="Enter Your Pin" style="display:none;">

			 <p>	

			 <form name="f<?php echo $t["id"]; ?>" method="post" action="withdraw.php" onsubmit="return checkpin(document.getElementById('userpin<?php echo $t["id"]; ?>').value);" >

			 <input type="hidden" name="id" value="<?php echo $t["id"]; ?>" />			

				<table width="100%" border="0" cellspacing="0" cellpadding="0">

				  <tr>

					<td width="100" valign="top" align="center"><b>Enter Pin : </b>&nbsp;</td><td width="500" align="left" valign="top"><input type="text" name="userpin" id="userpin<?php echo $t["id"]; ?>" style="width:100px;" /></td>

				  </tr>

				   <tr>

					<td width="100" valign="top" align="right">&nbsp;</td><td width="300" align="left" valign="top">

					<input type="submit" name="Btn" value="Enter Pin" /><br />[&nbsp;<font style="color:#FF0000; font-style:italic; font-size:10px">You request should be taken care of after you put the right pin.</font>&nbsp;]

					</td>

				  </tr>

				</table>

			 </form>

			 </p>			 	 

		  </div>
<script language="javascript" type="text/javascript">
function checkpin(a) {

if(a=='') {
alert('Enter your pin correctly');
return false
} else {
return true
}

}
</script>
	</td>   

	<td class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>" align="left" valign="top" style="padding-bottom:2px; padding-top:2px; border-bottom: #999999 1px solid;"><?php echo date("d/m/Y",strtotime($t["applieddate"])); ?></td>			

	</tr>

    <?php

	$ul=$ul+1;

		}

	}	

		?>

      </table>

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