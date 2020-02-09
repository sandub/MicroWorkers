<?php 
include("include/header.php");
if(!isset($_SESSION["userlogin"])) { header("location: login.php"); exit(); }
$edit=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$_SESSION["userlogin"]."'"),MYSQL_BOTH);
$Id=base64_decode($_REQUEST['Id']);
$up=mysql_fetch_array(mysql_query("select * from `jobs` where `id`='".$Id."'"));
$status=stripslashes($up["highlighted"]);
$name=stripslashes($up["title"]);
$explode=explode(" ",$name);
$tit=isset($explode[0])?$explode[0]:'';
$col=isset($explode[1])?$explode[1]:'';
$cat=isset($explode[2])?$explode[2]:'';

$user=mysql_fetch_array(mysql_query("select * from `user_registration` where `email`='".$_SESSION["userlogin"]."'"));
$fullname=stripslashes($user['fullname']);
$customer_id=$user['id'];
$current_balence=$user['current_balance'];

if(isset($_POST["Button"])) {
	if(isset($_REQUEST["Available_positions"]))
	{
	$Available_positions=$_POST["Available_positions"];
	if(strpos($Available_positions,'.')===false) {	
	$pos=$Available_positions;
	$pos1=0;
	} else {
	$pieces = explode(".", $Available_positions);
	$pos=$pieces[0];
	$pos1=$pieces[1];
	}

	$Payment_per_task=$_POST["Payment_per_task"];

	$hid=$_REQUEST['hid'];
	if($pos1>0)
	{
	?>
	<script>
	alert('Job Posting Suspended');
	window.location.href="edit_job.php?Id=<?=base64_decode($hid)?>";
	</script>
	<?
	}
	else
	{	
	dbQuery("update `jobs` set `wd2`='".$Available_positions."',`price`='".$Payment_per_task."' where `id`='".$hid."' and `email`='".$_SESSION["userlogin"]."'");
	?>
	<script>
	window.location.href="employer.php";
	</script>
	<?
	}
	}
	$_SESSION['hid']=$hid;
	if($hid>0) {
	$_SESSION["success"]='';
	} else {
	$_SESSION["error"]='';
	}
} else if(isset($_POST["Cancel"])) {
$hid=$_REQUEST['hid'];
dbQuery("update `jobs` set `status`='3' where `id`='".$hid."' and `email`='".$_SESSION["userlogin"]."'");
$resJ=dbFetchArray(dbQuery("select * from `jobs` where `id`='".$hid."' and `email`='".$_SESSION["userlogin"]."'"),MYSQL_BOTH);

if($resJ["wd1"]!=$resJ["wd2"]) {
$CJ= $resJ["wd2"] - $resJ["wd1"];
$CJFees = $CJ*$resJ["price"];
dbQuery("insert into `myaccount`(`email`,`amount`,`type`,`createdate`,`jobid`) values('".$_SESSION['userlogin']."','$CJFees','10',NOW(),'".$resJ["id"]."')");
$rescurbal=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$_SESSION['userlogin']."'"),MYSQL_BOTH);		
dbQuery("update `user_registration` set `current_balance`='".($rescurbal["current_balance"]+$CJFees)."' where `email`='".$_SESSION['userlogin']."'");
}
?>
<script>
window.location.href="employer.php";
</script>
<?
}
?>
<script language="javascript" src="validator/function.js"></script>
<script>
var xmlhttp;
	function showCost(a,q,tot)
	{
	//alert(a);
	//alert(q);
	//alert(tot);
		xmlhttp=GetXmlHttpObject();
		if (xmlhttp==null)
		{
		  alert ("Browser does not support HTTP Request");
		  return;
		}
		var url="calculation.php";
		url=url+"?position="+a+"&payment="+q+"&total="+tot;
		url=url+"&sid="+Math.random();
		xmlhttp.onreadystatechange=stateChanged;
		xmlhttp.open("GET",url,true);
		xmlhttp.send(null);
		
	}
	
	function stateChanged()
	{
		if (xmlhttp.readyState==4)
		{
			var val = xmlhttp.responseText;
			//alert(val);
			var explode_val = val.split("|");
			var check = explode_val[1];
			if(check==1)
			{
			document.getElementById('payment').innerHTML = explode_val[0];
			document.getElementById('txtTotal').innerHTML = explode_val[2];
			}
			if(check==2)
			{
			document.getElementById('position').innerHTML = explode_val[0];
			document.getElementById('txtTotal').innerHTML = explode_val[2];
			}
		}
	}
	
	function GetXmlHttpObject()
	{
		if (window.XMLHttpRequest)
	  	{
	     	// code for IE7+, Firefox, Chrome, Opera, Safari
	  		return new XMLHttpRequest();
	  	}
		if (window.ActiveXObject)
	  	{
	 		 // code for IE6, IE5
	  		return new ActiveXObject("Microsoft.XMLHTTP");
	  	}
		return null;
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
					<td width="100%" align="left" style="font-weight:bold; padding-left:10px;">Edit Campaign Of <?php echo $name; ?></td>
				  </tr>
				</table>
				
				</td>
				<td class="table_content_right"></td>
			  </tr>
			  			   
				<tr>				
				<td colspan="3" class="td_dark_backg" style="padding-left:20px;">
				
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td width="100%" align="center" style="padding:10px; line-height:20px;">					
					
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						 <tr>
						   <td colspan="3">
						   
						   
						   <table width="100%" border="0" cellspacing="0" cellpadding="0">
							 <tr>
							   <td>
							   <table border="0" width="100%" cellspacing="0" cellpadding="20">
		
			<tr>
			<td>
			  <table border="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" cellpadding="0">
		
				<tr>
				  <td valign="top">
				  <form method="POST" name="form2" id="form2" action="">
					<table border=0 cellspacing="0" bordercolor="#CFCFB3" id="AutoNumber27" WIDTH="90%" CELLPADDING="1" BGCOLOR="#4EBBE4" >
					  <TR>
						<TD WIDTH="100%" style="padding:10px;" align="left">
			<table border=0 cellspacing="0" bordercolor="#111111" id="AutoNumber59" WIDTH="100%" CELLPADDING="4" STYLE="border-collapse: collapse" >
					  <tr>
						<td nowrap BGCOLOR="#4EBBE4" COLSPAN="2">
			
					All campaigns submitted are reviewed for approval, then posted online.<BR>
				  Be sure to include all details about the campaign with easy to understand 
				  steps.<P>
		   <TABLE BORDER="0" CELLSPACING="0" STYLE="border-collapse: collapse" BORDERCOLOR="#111111" WIDTH="100%" CELLPADDING="8">
			  <TR>
				<TD WIDTH="100%">
			<?php if(isset($_SESSION["error"])) { ?>	
				<table border="0" cellpadding="5" cellspacing="2"  bgcolor="#FF0000" width="100%">
			
			  <tr>
			
				<td width="100%" bgcolor="#4EBBE4"><font color="#FF0000"><b>&nbsp;&nbsp;
							<?php if(isset($_SESSION["titleerror"]))  { ?>
							Title is missing<br />
							<?php unset($_SESSION["titleerror"]); } ?>
							<?php if(isset($_SESSION["balanceerror"]))  { ?>
							You need <?php echo '$'.$_SESSION["balanceerror"]; ?>, you do not have enough funds to start this campaign!<br />
							<?php unset($_SESSION["balanceerror"]); } ?>
						</b></font>
					</td>
			
			  </tr>
			
			</table>
			<?php unset($_SESSION["error"]); } ?>
				</TD>
			  </TR>
			</TABLE></P>
					<TABLE BORDER="0" CELLSPACING="0" STYLE="border-collapse: collapse" BORDERCOLOR="#111111" WIDTH="100%" CELLPADDING="0">
					  <TR>
						<TD WIDTH="100%" style="padding-left:25px;"><b><br />
						Select Campaign Targeting<br />
			&nbsp;</b></TD>
					  </TR>
			
					</TABLE>
					<table border="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" cellpadding="5">
					  <tr id=usa name=usa>
						<td  valign="top" style="padding-left:25px;">
						<input type="radio" disabled="disabled" value="USA" name="Targeting" id="radious" <?php if($up['country']=="USA")echo "checked"; ?> ></td>
						<td valign="top">
						<img border="0" src="images/United-States-Flag-32x32.gif" width="32" height="26" hspace="10"></td>
						<td valign="top">&nbsp;<b>USA Workers</b> - Starting From <b>
			
						&nbsp;$<?php echo $USAjobcost; ?></b> per task<br>
						<span style="font-size: 11px">&nbsp;Also allow: 
						<input type="checkbox" id="Targeting_CA" name="Targeting_CA" disabled="disabled" value="1" <? if($up['CA']==1 && $up['country']=="USA")echo "checked"; ?>>Canada
						<input type="checkbox" id="Targeting_UK" name="Targeting_UK" disabled="disabled" value="1" <? if($up['UK']==1 && $up['country']=="USA")echo "checked"; ?>>United Kingdom
						<input type="checkbox" id="Targeting_AU" name="Targeting_AU" disabled="disabled" value="1" <? if($up['AU']==1 && $up['country']=="USA")echo "checked"; ?>>Australia</span>&nbsp; </td>
					  </tr>	
					  <tr id=int name=int>
						<td style="padding-left:25px;">
						<input type="radio" disabled="disabled"  value="INT"  id=radioint name="Targeting"  <? if($up['country']=="INT" && $up['CA']==0 && $up['UK']==0 && $up['AU']==0)echo "checked"; ?>></td>
						<td>
						<p align="center">
						<img border="0" src="images/int-flag.gif" width="32" height="23"></td>
						<td>&nbsp;<B>International Workers</B><BR>
						&nbsp;Lots of Workers - Work Done Faster<BR>
			
						&nbsp;Starting From <b>$<?php echo $INTjobcost; ?></b> per task</td>
					  </tr>
					</table>
					 <P><BR>
		
				<B>Category For Your Campaign</B></P>
				<TABLE BORDER="0" CELLSPACING="0" BORDERCOLOR="#111111" CELLPADDING="0">
				  <TR>
					<TD VALIGN="top"><select size=11 name="Cat" id=Cat  onChange='update_2nd_dropdown()' disabled="disabled"><option value="00"  selected >Click or Search</option>
		<option value="02" <?php if($cat=="Bookmark"){echo "selected";}?>>Bookmark a page (digg,delicious,mixx,...)</option>
		<option value="03" <?php if($cat=="Sign"){echo "selected";}?>>Sign up</option>
		<option value="04" <?php if($cat=="Comment"){echo "selected";}?>>Comment on other blogs</option>
		<option value="05" <?php if($cat=="Forums"){echo "selected";}?>>Forums</option>
		
		<option value="06" <?php if($cat=="Facebook"){echo "selected";}?>>Facebook</option>
		<option value="07" <?php if($cat=="Twitter"){echo "selected";}?>>Twitter</option>
		<option value="08" <?php if($cat=="Article"){echo "selected";}?>>Write an Article</option>
		<option value="09" <?php if($cat=="Blog"){echo "selected";}?>>Blog/Website owners</option>
		<option value="10" <?php if($cat=="Download/install"){ echo "selected"; } ?>>Download and/or Install</option>
		<option value="99" >Other (not listed)</option>
		</select></TD>
					<TD VALIGN="top">&nbsp;&nbsp; </TD>
					<TD VALIGN="top" width="200px"><div name=2nd id=2nd>...</div></TD>
		
				  </TR>
			  </TABLE>
					</td>
					</tr>
					 <tr>
					<td BGCOLOR="#4EBBE4" COLSPAN="2">
					<P ALIGN="center">Prices listed are min. You can increase  payment per task to be listed 
					higher and get better results.<BR>
		&nbsp;</td>
				  </tr>
		
						  
				  <tr>
						<td nowrap BGCOLOR="#53BEE8" ALIGN="left" style="padding-left:25px;"><b>This task takes less than</b></td>
			
						<td nowrap BGCOLOR="#53BEE8"><input type="text" readonly="readonly" name="Minutes_to_finish" id="Minutes_to_finish" size="8" value="<?php echo stripslashes($up["time"]); ?>"> 
						minutes to finish</td>
					  </tr>
					  <tr>
						<td nowrap BGCOLOR="#53BEE8" ALIGN="left" style="padding-left:25px;"><b>Available positions</b></td>
						<td nowrap BGCOLOR="#53BEE8">
						<div id="position" style="margin-top:0px"><input type="text" id="Available_positions" name="Available_positions" size="8" value="<?php echo stripslashes($up["wd2"]); ?>" onkeyup="showCost(this.value,document.getElementById('Payment_per_task').value,document.getElementById('total').value)">
						Workers Needed<font color="#808080"><span style="font-size: 11px">&nbsp;&nbsp;&nbsp;
						Minimum <?php echo $MinJobpost; ?></span></font>
						</div>
						</td>
					  </tr>
					  <tr>
						<td nowrap BGCOLOR="#53BEE8" ALIGN="left" style="padding-left:25px;"><b>Worker will earn</b></td>
						<td nowrap BGCOLOR="#53BEE8">
						<div id="payment" style="margin-top:0px"><input type="text" id="Payment_per_task" name="Payment_per_task" size="8" value="<?php echo stripslashes($up["price"]); ?>" onkeyup="showCost(document.getElementById('Available_positions').value,this.value,document.getElementById('total').value)">
						You can increase
						</div>
						</td>
					  </tr>
					  <tr>
						<td nowrap BGCOLOR="#53BEE8" ALIGN="left" style="padding-left:25px;"><b>Total: Can Not Be Changed</b></td>
						<td nowrap BGCOLOR="#53BEE8">
						<div id="txtTotal" style="margin-top:0px">
						<input type="text" id="total" name="total" size="25" value="<?php echo stripslashes($up["wd2"]); ?> X <?php echo stripslashes($up["price"]); ?> = <?php echo number_format(stripslashes($up["wd2"])*stripslashes($up["price"]), 2); ?>">
						</div>
						</td>
					  </tr>
					  
				  
					  <tr>
						<td nowrap BGCOLOR="#4EBBE4" COLSPAN="2">
			
					<BR>
			&nbsp;<p ALIGN="center">
			<span style="font-size:11px; font-weight:bold;">&nbsp;Bold/Highlight Jobs For More Exposure<BR>
					Title of the campaign MUST BE detailed</span><BR><BR>
					<span style="padding-right:90px;">
					<input type="checkbox" id="bold" name="bold" disabled="disabled" value="1" <?php if($up["bold"]==1) { echo "checked";}?>>Bold&nbsp;&nbsp;
					<input type="checkbox" id="highlighted" name="highlighted" disabled="disabled" value="1"<?php if($up["highlighted"]==1) { echo "checked";}?>>Highlighted</span>
					<br><br>
					<textarea name="Title" id="Title" cols="40" rows="4" readonly="readonly"><?php echo $up["title"];?></textarea><BR>
					<span style="font-size: 11px">Do not just say &quot;Sign up here, Visit my 
					site,...&quot;.<br>
					Use a Title that makes sense.</span></p>
			
					<p ALIGN="center">
					<B><BR>
					What need's to be done<BR>
			&nbsp;</B><br>
					<textarea rows="12" name="Required_work" cols="70" readonly="readonly"><?php echo stripslashes($up["expected"]);?></textarea><br>
					<span style="font-size: 11px">Describe the website 
					and the job. It is not enough to say<br>
					&quot;Test my landing page&quot;. You must specify where exactly will<br>
			
					you send users (Forum name, Chocolate store, Health insurance,...).<BR>
					</span></p>
					<p ALIGN="center"><b>Required Proof of Finished Jobs<BR>
			&nbsp;</b><br>
					<textarea rows="10" name="Required_proof" cols="70" readonly="readonly"><?php echo stripslashes($up["proof"]); ?></textarea></p>
					<p ALIGN="center"><br>
					<input type="submit" value="Submit Campaign" <?php if($up["status"]=='3') { echo 'disabled="disabled"';} ?> name="Button">&nbsp;&nbsp;<input type="submit" value="Finished Campaign" <?php if($up["status"]=='3') { echo 'disabled="disabled"';} ?>  name="Cancel"><br />
					<p ALIGN="center"><font style="color:#003300; font-weight:bold; font-style:italic;">If you want to cancel it and be refunded contact support</font></p>
					<input name="hid" type="hidden" id="hid"  value="<?php echo $up['id'];?>"/></p>
						</td>
					  </tr>
					  </table>
						</TD>
					  </TR>	
				  </TABLE>
				  </form>
				  </td>
				  <td valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
				  <td valign="top" width="275">
			  <table border="0" cellpadding="10" cellspacing="1" width="" id="AutoNumber58"  bgcolor="#CFCFB3">
				<tr>
				  <td bgcolor="#4EBBE4" valign="top" style="padding-top:10px;">
				<P ALIGN="center">
				<IMG BORDER="0" SRC="images/acceptable.gif" WIDTH="199" HEIGHT="34"></P>
		
				<P ALIGN="center">
				<a href="faq-guidelines.php" style="color:#FFFFFF; font-weight:bold;">Guidelines for Employers</a></P>
				<P STYLE="line-height: 150%" ALIGN="center">
				<SPAN STYLE="font-size: 16px">
				<b>
				<FONT FACE="Arial,Verdana">
				<BR>
				</FONT></b></SPAN><FONT FACE="Arial,Verdana"><B>
		
				<SPAN STYLE="font-size: 16px">Currently we do not approve</SPAN></B></FONT></P>
				<P STYLE="line-height: 150%" ALIGN="center">
				PayPal Wishlist @ Facebook
				<IMG BORDER="0" SRC="images/new2.gif" WIDTH="28" HEIGHT="11"><BR>
				Lockerz<BR>
				RUDE<BR>
				CrocMint<BR>
		
				FreebieJeebies<BR>
				AWSurveys<BR>
				IM Report Card</P>
				<P ALIGN="center">
				<FONT FACE="Arial,Verdana" STYLE="font-size: 16px; font-weight: 700">Leads</FONT></P>
				<P STYLE="line-height: 150%" ALIGN="center">
				We do not approve websites that ask for Leads if they ask personal data 
				such as Address, Phone number, etc.</P>
		
				<P ALIGN="center">
				<FONT FACE="Arial,Verdana" STYLE="font-size: 16px">
				<B>Offers, browse, invites</B></FONT></P>
				<P STYLE="line-height: 150%" ALIGN="center">
				We 
				also do not approve requests such as Refresh page x times or Sign up + Click 
				links to complete a task, View ads, Play a game for x minutes, Finish 
				offer to complete a task,...</P>
				<P ALIGN="center"><FONT FACE="Arial,Verdana" STYLE="font-size: 16px"><B>Comments &amp; Forum posts</B></FONT></P>
		
				<P STYLE="line-height: 150%" ALIGN="center">
				Do not request 10 
				posts or comments; one or two is ok, more is not.</P>
				<P STYLE="line-height: 150%" ALIGN="center">
				<FONT FACE="Arial,Verdana" STYLE="font-size: 16px">
				<B>Do not ask for screenshots</B></FONT></P>
				<P ALIGN="center">
				Proof should be submitted into proof&nbsp; box.<BR>
		
		&nbsp;</P>
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
			</table></td>
			</tr>
			<tr>
			<td width="9">&nbsp;</td>
			<td>&nbsp;</td>
			<td width="9">&nbsp;</td>
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
	</table>
	
	</td>
  </tr>
</table>
	
<?php include("include/footer.php"); ?>