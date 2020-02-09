<?php 
include("include/header.php");
if(!isset($_SESSION["userlogin"])) { header("location: login.php"); exit(); }
$update=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$_SESSION["userlogin"]."'"),MYSQL_BOTH);
if(isset($_POST["Button"])) {
$Address_1=$_POST["Address_1"];
$Address_2=$_POST["Address_2"];
$Zip=$_POST["Zip"];
$City=$_POST["City"];
$State=$_POST["State"];
$phone=$_REQUEST["phone"];
dbQuery("update `user_registration` set `address1`='".$Address_1."',`address2`='".$Address_2."',`phone`='".$phone."',`zip`='".$Zip."',`city`='".$City."',`state`='".$State."' where `email`='".$_SESSION["userlogin"]."'");
header("location: account.php");
exit();
}
$resadd=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$_SESSION["userlogin"]."'"),MYSQL_BOTH);
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
					
					
				    <table border="0" width="100%" cellspacing="0" cellpadding="20">
			<tr>
			<td>
			<div align="center">
			<center>
			<table border="0" cellpadding="0" width="100%" id="AutoNumber4" style="border-collapse: collapse" bordercolor="#111111" class="submit">
			<tr>
			<td align="left">
			<p style="line-height: 150%">PIN number and payments (check, Paypal,...) 
			
			will be issued to your address.<br>
			
			For security reasons we don't let people change this later.</p>
			
			<p><b>Please provide a valid mailing address.<br>
			
			&nbsp;</b></p>
			
			<form method="POST" name="ff" action="account_address_edit.php" onsubmit="return blankcheck();">
			<table border="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber14" cellpadding="6">
			<tr>
			<td valign="top">Address 1</td>
			<td valign="top" dir="ltr">
			<input type="text" name="Address_1" size="60" value="<?php echo $resadd["address1"]; ?>"></td>
			</tr>
			
			<tr>
			<td valign="top">Address 2</td>
			<td valign="top" dir="ltr"><input type="text" name="Address_2" size="60" value="<?php echo $resadd["address2"]; ?>"></td>
			</tr>
			
			<tr>
			<td valign="top">Zip code</td>
			<td valign="top"><input type="text" name="Zip" size="10" value="<?php echo $resadd["zip"]; ?>"></td>
			</tr>
			
			<tr>
			<td valign="top">City</td>
			<td valign="top"><input type="text" name="City" size="40" value="<?php echo $resadd["city"]; ?>"></td>
			</tr>
			
			<tr>
			<td valign="top">Phone No</td>
			<td valign="top"><input type="text" name="phone" size="30" value="<?php echo $resadd["phone"]; ?>"></td>
			</tr>
			
			<tr>
			<td valign="top">State/Region</td>
			<td valign="top"><input type="text" name="State" size="40" value="<?php echo $resadd["state"]; ?>"></td>
			</tr>
			
			<tr>
			<td valign="top">Country of residence&nbsp;&nbsp; </td>
			<td valign="top"><b><?php echo $resadd["country"]; ?></b></td>
			</tr>
			
			<tr>
			<td>&nbsp;</td>
			<td><br><input type="submit" value="Submit address" name="Button"></td>
			</tr>
			</table>
			</form>
			</td>
			<td width="1" bgcolor="#FFFFFF">
			<img border="0" src="images/p.gif" width="1" height="1"></td>
			</tr>
			</table>
			</center>
			</div>
			</td>
			</tr>
			</table>
<script language="javascript" type="text/javascript">
function blankcheck() {
	if(document.ff.Address_1.value=='') {
	alert('Please your valid address!');
	document.ff.Address_1.focus();
	return false;
	}
	if(document.ff.Zip.value=='') {
	alert('Please your Zip!');
	document.ff.Zip.focus();
	return false;
	}
	if(document.ff.City.value=='') {
	alert('Please your City!');
	document.ff.City.focus();
	return false;
	}
	if(document.ff.State.value=='') {
	alert('Please your State!');
	document.ff.State.focus();
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