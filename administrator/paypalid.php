<?php 
include('includes/admin_header.php'); 
if(isset($_POST["subMe"])) {
	if($_POST["paypalid"]!='') {
		dbQuery("update `paymentids` set `paypalid`='".$_POST["paypalid"]."',`moneybookersid`='".$_POST["moneybookersid"]."',`alertpayid`='".$_POST["alertpayid"]."' where `id`='1'");		
	} 
} 
$q = dbFetchArray(dbQuery("select * from `paymentids` where `id`='1'"),MYSQL_BOTH);
?>
<div style="margin-bottom:10px;">
    <h1 style="text-transform:uppercase">Set you Payment Ids Here&nbsp;&nbsp;</h1>
    <img src="media/line.png" />
</div>
	
<div style="padding-bottom:5px;">
<form class='pform' id='pform' method='POST' action='paypalid.php'>
<table border="0" cellpadding="2" cellspacing="2" width="100%">    
    <tr>
        <td align="left" valign="top" colspan="2" style="color:#666">Please check up all the fields.</td>
    </tr>
	 <tr>
        <td align="left" valign="top" class="labels"><label for="fullname">Paypal Id</label></td>
        <td align="left" valign="top" class="rows"><input type='text' name='paypalid' value="<?php echo stripslashes($q["paypalid"]); ?>" style="width:300px;"></td>
    </tr>
	<tr>
        <td align="left" valign="top" class="labels"><label for="fullname">Moneybookers Id</label></td>
        <td align="left" valign="top" class="rows"><input type='text' name='moneybookersid' value="<?php echo stripslashes($q["moneybookersid"]); ?>" style="width:300px;"></td>
    </tr>
	<tr>
        <td align="left" valign="top" class="labels"><label for="fullname">AlertPay Id</label></td>
        <td align="left" valign="top" class="rows"><input type='text' name='alertpayid' value="<?php echo stripslashes($q["alertpayid"]); ?>" style="width:300px;"></td>
    </tr>	
	<tr>
        <td align="left" valign="top" colspan="2">&nbsp;</td>
    </tr> 
	<tr>
		<td align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top"><input type="submit" name="subMe" value="Save Record" /></td> 
    </tr> 
</table>
</form>
<?php include('includes/admin_footer.php'); ?>
                    
                    