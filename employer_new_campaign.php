<?php 
include("include/header.php");
include('phpmailer/class.phpmailer.php');
if(!isset($_SESSION["userlogin"])) { header("location: login.php"); exit(); }
$edit=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$_SESSION["userlogin"]."'"),MYSQL_BOTH);

$normal_price=$EstimatedCampaigncost;

$user=mysql_fetch_array(mysql_query("select * from `user_registration` where `email`='".$_SESSION["userlogin"]."'"));
$fullname=stripslashes($user['fullname']);
$customer_id=$user['id'];
$current_balence=$user['current_balance'];
$auto_select=$user['auto_select'];

if(isset($_POST["Button"])) {
if($_POST["Title"]!='') {
$resoffer=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$_SESSION['userlogin']."'"),MYSQL_BOTH);

	$Available_positions=$_POST["Available_positions"];
	$Payment_per_task=$_POST["Payment_per_task"];
	
	if(isset($_POST["Targeting"])) {
	$Targeting=$_POST["Targeting"];
		if($Targeting=='USA') {
			if(isset($_POST["Targeting_CA"])) {
			$Targeting_CA='1';
			} else {
			$Targeting_CA='';
			}
			if(isset($_POST["Targeting_UK"])) {
			$Targeting_UK='1';
			} else {
			$Targeting_UK='';
			}
			if(isset($_POST["Targeting_AU"])) {
			$Targeting_AU='1';
			} else {
			$Targeting_AU='';
			}
		} else {
			$Targeting_CA='';
			$Targeting_UK='';
			$Targeting_AU='';
		} 		
	}
	$PPT = ($Targeting=='USA')?$USAjobcost:$INTjobcost;
	if($Payment_per_task >= $PPT) {
	
	if(isset($_POST["bold"])!="" && isset($_POST["highlighted"])=="")
	{
	$extra=$normal_price+$Boldjobcost;
	}
	elseif(isset($_POST["highlighted"])!="" && isset($_POST["bold"])=="")
	{
	$extra=$normal_price+$Highlightedjobcost;
	}
	elseif(isset($_POST["bold"])!="" && isset($_POST["highlighted"])!="")
	{
	$extra=$normal_price+($Boldjobcost+$Highlightedjobcost);
	}
	else
	{
	$extra=$normal_price;
	}
	
	if(isset($_POST["highlighted"])!="")
	{
	$highlighted=1;
	}
	else
	{
	$highlighted=0;
	}
	
	if(isset($_POST["bold"])!="")
	{
	$bold=1;
	}
	else
	{
	$bold=0;
	}
	
	
	$need=(($Available_positions*$Payment_per_task)+$extra);

	if($resoffer["current_balance"]>=$need) {

	
	
	$Minutes_to_finish=$_POST["Minutes_to_finish"];	
	
	if($_POST["Cat"]=='02') {
	$T=' : Bookmark';
	} else if($_POST["Cat"]=='03') {
	$T=' : Sign up';
	} elseif($_POST["Cat"]=='04') {
	$T=' : Comment';
	} elseif($_POST["Cat"]=='05') {
	$T=' : Forums';
	} elseif($_POST["Cat"]=='06') {
	$T=' : Facebook';
	} elseif($_POST["Cat"]=='07') {
	$T=' : Twitter';
	} elseif($_POST["Cat"]=='08') {
	$T=' : Article';
	} elseif($_POST["Cat"]=='09') {
	$T=' : Blog';
	} elseif($_POST["Cat"]=='10') {
	$T=' : Download/install';
	} elseif($_POST["Cat"]=='99') {
	$T='';
	} else {
	$T=' : Bookmark';
	}
	
	
	
	$Title=addslashes($_POST["Title"]);
	$Title=$Title.$T;
	$Required_work=nl2br(addslashes($_POST["Required_work"]));
	$Required_proof=nl2br(addslashes($_POST["Required_proof"]));
	$wd2=(addslashes($_POST["Available_positions"]));
	$wd1='0';
	
	if($auto_select==1)
	{
	$status=3;
	}
	else
	{
	$status=0;
	}
	
	
	
	
	$sql=dbQuery("INSERT INTO `jobs`(`user_id`,`email`,`title`,`wd1`,`wd2`,`time`,`price`,`extra_price`,`country`,`CA`,`UK`,`AU`,`expected`,`proof`,`started`,`status`,`highlighted`,`bold`) VALUES('$customer_id','".$_SESSION["userlogin"]."','$Title','$wd1','$wd2','$Minutes_to_finish','$Payment_per_task','$extra','$Targeting','$Targeting_CA','$Targeting_UK','$Targeting_AU','$Required_work','$Required_proof','".$totaldate."','$status','$highlighted','$bold');");
	
	$id = dbInsertId();
	$usSQL=mysql_query("select * from `user_registration` where `status`='1'");
	while($usRES=mysql_fetch_array($usSQL)) {
		if($usRES["jobmailUSA"]=='1' && $Targeting=='USA') {
		
		$to = $usRES["email"];
		//$from="";
		$sub = "".stripslashes($usRES["fullname"])." a new Campaign has been Posted on ".$SiteName;
			
		//echo $txt;
		//echo $headers = "From: $email" . "\r\n";
		$headers  = 'Hello ' .stripslashes($usRES["fullname"]).'';
		$headers .= '  A New USA Campaign "' .$Title. '" Has Started On '.$SiteName;
		$headers .= ' The Campaign pays: $' .$Payment_per_task. ' Per Task. ';
		$headers .= ' ';
		$headers .= "$from" . '';		
		
		$mail = new PHPMailer;
		$mail->FromName = $fromName;
		$mail->From    = $from;
		$mail->Subject = $sub;
		$mail->Body    = stripslashes($headers);
		$mail->AltBody = stripslashes($headers);					
		$mail->IsHTML(true);	
		$mail->AddAddress($to,$usRES["fullname"]);
		$mail->Send();
		
		}
		if($usRES["jobmailINT"]=='1' && $Targeting=='INT') {
		
		$to = $usRES["email"];
		//$from="";
		$sub = "".stripslashes($usRES["fullname"])." a new Campaign has been Posted on ".$SiteName;
			
		//echo $txt;
		//echo $headers = "From: $email" . "\r\n";
		$headers  = 'Hello ' .stripslashes($usRES["fullname"]).'';
		$headers .= ' A New INT Campaign "' .$Title. '"  Has Started on '.$SiteName;
		$headers .= ' The Campaign pays: $' .$Payment_per_task. ' Per Task. ';
		$headers .= ' ';
		$headers .= "$from" . '';		
		
		$mail = new PHPMailer;
		$mail->FromName = $fromName;
		$mail->From    = $from;
		$mail->Subject = $sub;
		$mail->Body    = stripslashes($headers);
		$mail->AltBody = stripslashes($headers);					
		$mail->IsHTML(true);	
		$mail->AddAddress($to,$usRES["fullname"]);
		$mail->Send();
		
		}
	}
	
	dbQuery("insert into `myaccount`(`email`,`amount`,`type`,`createdate`,`jobid`) values('".$_SESSION['userlogin']."','$need','8','".$totaldate."','".$id."')");
	dbQuery("update `user_registration` set `current_balance`='".($resoffer["current_balance"]-$need)."' where `email`='".$_SESSION['userlogin']."'");
	
	if($id>0) {
	$_SESSION["success"]='';
	
	$to = $_SESSION["userlogin"];
	//$from="";
	$sub = "Dear"." ".$fullname." "."Your Campaign is Successful";
		
	//echo $txt;
	//echo $headers = "From: $email" . "\r\n";
	$headers  = 'Thank You Your Campaign has Successfully Began Remember You Can Always Edit Your Listing and Increase The Payment Per Job to Get Tasks Done Quicker ' . '';
    $headers .= '';
    $headers .= "$from" . '';	
	
	$mail = new PHPMailer;
	$mail->FromName = $fromName;
	$mail->From    = $from;
	$mail->Subject = $sub;
	$mail->Body    = stripslashes($headers);
	$mail->AltBody = stripslashes($headers);					
	$mail->IsHTML(true);	
	$mail->AddAddress($to,$fullname);
	$mail->Send();		
	
	
	//print $to."<br>".$sub."<br>".$headers."<br>";
	
	} else {
	$_SESSION["error"]='';
	}
  } else {
   $_SESSION["error"]='';
   $_SESSION["balanceerror"]=$need;
  }
	
	} else {
	$_SESSION["error"]='';
 	$_SESSION["minpayerror"]='';
	}
	
 }  else {
 $_SESSION["error"]='';
 $_SESSION["titleerror"]='';
 }
}
?>
<script language="javascript" src="validator/function.js"></script>
<script>
   function some(getFileName,getWindowName,getHeight,getWidth)
   {      
	  LoadPopup(getFileName,getWindowName,getHeight,getWidth);
	  
	  document.form2.target="myWindow";
	  document.form2.action="job_preview.php";
	  document.form2.submit();
   }
   
   function record()
   {
 		if(confirm("Are You Sure Your Are Ready To Submit?"))
		{
			document.form2.action="employer_new_campaign.php";
			document.form2.target="_self";
	  		document.form2.submit();
		}
		else
		{
			return false;
		}
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
					<td width="100%" align="left" style="font-weight:bold; padding-left:10px;">Add New Campaign</td>
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
                   <td colspan="3">
				   <table width="100%" border="0" cellspacing="0" cellpadding="0">
                     
                     <tr>
                       <td>
					   <table border="0" width="100%" cellspacing="0" cellpadding="20">

			<tr>

				<td>
<?php if(!isset($_SESSION["success"])) { ?>
      <table border="0" cellspacing="0" style="border-collapse: collapse" id="AutoNumber29" cellpadding="0">
        <tr>
          <td nowrap><b><font color="#F62355">01</font> New Campaign Data</b></td>
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
<?php } else  { ?>
	  <table border="0" cellspacing="0" style="border-collapse: collapse" id="AutoNumber29" cellpadding="0">
        <tr>
          <td nowrap>01 New Campaign Data</td>
          <td nowrap>&nbsp;</td>
          <td nowrap><b><font color="#F62355">02</font> Confirmation</b></td>

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
<?php } ?>
      
      <table border="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" cellpadding="0">

        <tr>
          <td valign="top"><br />
		  <?php if(!isset($_SESSION["success"])) { ?>
		  <form method="POST" name="form2" id="form2" action="employer_new_campaign.php" onsubmit="return checkthis();">
			<table border=0 cellspacing="0" bordercolor="#CFCFB3" id="AutoNumber27" WIDTH="90%" CELLPADDING="1" BGCOLOR="#4EBBE4" >
			  <TR>
				<TD WIDTH="100%" style="padding:10px;">
					<table border=0 cellspacing="0" bordercolor="#111111" id="AutoNumber59" WIDTH="100%" CELLPADDING="4" STYLE="border-collapse: collapse" >
			  <tr>
				<td nowrap BGCOLOR="#4EBBE4" COLSPAN="2">
	
			All campaigns submitted are <b><font color="#F62355"></font>Charged a $<?php echo $EstimatedCampaigncost; ?> Approval Fee</b>. <b><font color="#F62355"></font>Minimum Number of Jobs is <?php echo $MinJobpost; ?>.</b><br> Once approved Your Job will be posted online.<BR>
		  Be sure to include all details about the campaign with easy to understand 
		  steps.
		 	<P>
		   <TABLE BORDER="0" CELLSPACING="0" STYLE="border-collapse: collapse" BORDERCOLOR="#111111" WIDTH="100%" CELLPADDING="8">
			  <TR>
				<TD WIDTH="100%">
			<?php if(isset($_SESSION["error"])) { ?>	
				<table border="0" cellpadding="5" cellspacing="2"  bgcolor="#FF0000" width="100%">
			
			  <tr>
			
				<td width="100%" bgcolor="#4EBBE4">
						<font color="#FF0000"><b>&nbsp;&nbsp;
							<?php if(isset($_SESSION["titleerror"]))  { ?>		
							Title is missing<br />
							<?php unset($_SESSION["titleerror"]); } ?>
							<?php if(isset($_SESSION["balanceerror"]))  { ?>
							You need <?php echo '$'.$_SESSION["balanceerror"]; ?>, You do not have enough funds to start this Campaign!<br />
							<?php unset($_SESSION["balanceerror"]); } ?>
							<?php if(isset($_SESSION["minpayerror"]))  { ?>
							Payment Per Task must be above $<?php echo $INTjobcost; ?><br />
							<?php unset($_SESSION["minpayerror"]); } ?>
						</b></font>
					</td>
			
			  </tr>
			
			</table>
			<?php unset($_SESSION["error"]); } ?>
				</TD>
			  </TR>
			</TABLE>
			</P>
			<TABLE BORDER="0" CELLSPACING="0" STYLE="border-collapse: collapse" BORDERCOLOR="#111111" WIDTH="100%" CELLPADDING="0">
			  <TR>
				<TD WIDTH="100%" style="padding-left:25px;"><B><BR>
				Select campaign targeting<BR>
	&nbsp;</B></TD>
			  </TR>
	
			</TABLE>
			<table border="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" cellpadding="5">
			  <tr id='usa' name='usa'>
				<td  valign="top" style="padding-left:25px;">
				<input type="radio" value="USA" name="Targeting" id="radious" onClick="price66('USA');" CHECKED>&nbsp;</td>
				<td valign="top">
				<img border="0" src="images/United-States-Flag-32x32.gif" width="32" height="26" hspace="10"></td>
				<td valign="top">&nbsp;<b>USA Workers</b> - Starting from <b>
	
				$<?php echo $USAjobcost; ?></b> per task<br>
				<span style="font-size: 11px">&nbsp;Also allow: 
				<input type="checkbox" onClick="form2.Targeting[0].checked=true; price66('USA');"  id="Targeting_CA" name="Targeting_CA" value="1">&nbsp;Canada
				<input type="checkbox" onClick="form2.Targeting[0].checked=true; price66('USA');"  id="Targeting_UK" name="Targeting_UK" value="1">&nbsp;United Kingdom
				<input type="checkbox" onClick="form2.Targeting[0].checked=true; price66('USA');"  id="Targeting_AU" name="Targeting_AU" value="1">&nbsp;Australia</span>&nbsp; </td>
			  </tr>	
			  <tr id=int name=int>
				<td style="padding-left:25px;">
				<input type="radio"  checked  value="INT"  id=radioint name="Targeting" onClick="price66('INT');document.getElementById('Targeting_CA').checked=false;document.getElementById('Targeting_UK').checked=false;document.getElementById('Targeting_AU').checked=false;"  >&nbsp;</td>
				<td>
				<p align="center">
				<img border="0" src="images/int-flag.gif" width="32" height="23">
				</p>
				</td>
				<td>&nbsp;<B>International Workers</B><BR>
				&nbsp;Lots of Workers - Work Done fFster<BR>
	
				&nbsp;Starting from <b>$<?php echo $INTjobcost; ?></b> per task</td>
			  </tr>
			</table>
			 <P><BR>

        <B>Category For Your Campaign</B></P>
        <TABLE BORDER="0" CELLSPACING="0" BORDERCOLOR="#111111" CELLPADDING="0">
          <TR>
            <TD VALIGN="top"><select size=11 name="Cat" id=Cat  onChange='update_2nd_dropdown()' ><option value="00"  selected >Click or Search</option>
<option value="02" >Bookmark a page (digg,delicious,mixx,...)</option>
<option value="03" >Sign up</option>
<option value="04" >Comment on other blogs</option>
<option value="05" >Forums</option>

<option value="06" >Facebook</option>
<option value="07" >Twitter</option>
<option value="08" >Write an Article</option>
<option value="09" >Blog/Website owners</option>
<option value="10" >Download and/or Install</option>
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
            <P ALIGN="center">Prices listed are min. You can increase payment per task to be listed higher and get better results.<BR>
&nbsp;</td>
          </tr>

          <tr>
            <td nowrap BGCOLOR="#4EBBE4" ALIGN="right">This task takes less than&nbsp;</td>
            <td nowrap BGCOLOR="#4EBBE4"><input  onChange='calculate_cost()' type="text" name="Minutes_to_finish" id="Minutes_to_finish" size="8" value="3"> 
            Minutes to finish</td>
          </tr>
          <tr>
            <td nowrap BGCOLOR="#4EBBE4" ALIGN="right">Available positions&nbsp;</td>
            <td nowrap BGCOLOR="#4EBBE4"><input onChange='calculate_cost(0,0)' type="text" id="Available_positions" name="Available_positions" size="8" value="20" maxlength="4"> 
			Workers needed<font color="#808080"><span style="font-size: 11px">&nbsp;&nbsp;&nbsp;

            Minimum <?php echo $MinJobpost; ?></span></font></td>
          </tr>
          <tr>
            <td nowrap BGCOLOR="#4EBBE4" ALIGN="right">Worker will earn&nbsp;</td>
            <td nowrap BGCOLOR="#4EBBE4"><input onChange='calculate_cost(0,0)' type="text" id="Payment_per_task" name="Payment_per_task" size="8" value="0.1"> 
            You can Increase (We Recommend Min of $<?php echo $RecomendedJobfees; ?>)</td>
          </tr>
          <tr>

            <td nowrap BGCOLOR="#4EBBE4">&nbsp;</td>
            <td nowrap BGCOLOR="#4EBBE4">
            <BR>
            <input type="button" value="Re-Calculate" name="B1"><BR>
&nbsp;<BR>
&nbsp;</td>
          </tr>
		  <tr bgcolor="#0a7470">
            <td COLSPAN="2" ALIGN="center" nowrap>
        <TABLE BORDER="0" CELLSPACING="0" STYLE="border-collapse: collapse" BORDERCOLOR="#111111" WIDTH="100%" CELLPADDING="0">

          <TR>
            <TD WIDTH="100%" BGCOLOR="#B4BA65">
            <IMG BORDER="0" SRC="im/mw/p.gif" WIDTH="1" HEIGHT="1"></TD>
          </TR>
        </TABLE>
        <P>
        <b><span class="account_gist_text1">Estimated Campaign Cost:&nbsp;</span> $<span id=total_cost1  name=total_cost1></span></b></P>

        <TABLE BORDER="0" CELLSPACING="0" STYLE="border-collapse: collapse" BORDERCOLOR="#111111" WIDTH="100%" CELLPADDING="0">
          <TR>
            <TD WIDTH="100%" BGCOLOR="#B4BA65">
            <IMG BORDER="0" SRC="im/mw/p.gif" WIDTH="1" HEIGHT="1"></TD>
          </TR>
        </TABLE>
            </td>
          </tr>
			  <tr>
				<td nowrap BGCOLOR="#4EBBE4" COLSPAN="2">
	
			<BR>
	&nbsp;<p ALIGN="center">
	<span style="font-size:11px; font-weight:bold;">&nbsp;Bold or Highlight Jobs For More Exposure<BR>
			Title of the campaign MUST BE detailed</span><BR><BR>
			<span style="padding-right:0px;">
			<input type="checkbox" id="bold" name="bold" value="1" onClick="calculate_cost(0,0)">&nbsp;Bold $<?php echo $Boldjobcost; ?>&nbsp;&nbsp;
			<input type="checkbox" id="highlighted" name="highlighted" value="1" onClick="calculate_cost(0,0)">&nbsp;Highlighted $<?php echo $Highlightedjobcost; ?></span><br />

<br><br>
<textarea name="Title" id="Title" cols="40" rows="4"></textarea><BR>
			<span style="font-size: 11px">Do not just say &quot;Sign up here, Visit my 
			site,...&quot;.<br>
			Use a Title that makes sense.</span></p>
	
			<p ALIGN="center">
			<B><BR>
			What Need's to be done<BR>
	&nbsp;</B><br>
			<textarea rows="12" name="Required_work" cols="70">1.
2.
3.
etc.</textarea><br>
			<span style="font-size: 11px">Describe the website 
			and the job. It is not enough to say<br>
			&quot;Test my landing page&quot;. You must specify where exactly will<br>
	
			you send users (Forum name, Chocolate store, Health insurance,...).<BR>
			</span></p>
			<p ALIGN="center"><b>Required proof of Finished Jobs<BR>
	&nbsp;</b><br>
			<textarea rows="10" name="Required_proof" cols="70">1.
2.
etc.</textarea></p>
<p ALIGN="center">When Submitting a Campaign Please Allow Up To 1 Min for Page To Load.
			<p ALIGN="center">

			<input type="submit" value="Preview Campaign" name="preview" onClick="some('job_preview.php','myWindow','493','657');" />&nbsp;
			<input type="submit" value="Submit campaign" name="Button" onClick="return record();"></p>
				</td>
			  </tr>
			  </table>
				</TD>
			  </TR>	
		  </TABLE>
		<p><font color="#808080"><span style="font-size: 11px">
      		</span></font><SPAN STYLE="font-size: 11px">
      *Campaign approval fee is $<?php echo $EstimatedCampaigncost; ?>
      <FONT COLOR="#C4CCD5"><B></B></div></FONT></SPAN></p>
		  </form>
		  <?php } else  { ?>
		  <p><br>
                <b>Your campaign has been created.</b></p>
		<p>&nbsp;</p>
      <p style="line-height: 150%">It deducts amount of <?php echo $need; ?> from your account.<b><br>
		Please wait for admin action to approve your campaign.</b></p>

		<p style="line-height: 150%">&nbsp;</p>
      <p style="line-height: 150%">We will soon take care of your campaign.</p>
      <p style="line-height: 150%"><b><font color="#F62355">Please Allow Up To 24 Hours for Campaign Approval</font></b></p>
	  <?php unset($_SESSION["success"]); } ?>
	  
	  
      <p><font color="#808080"><span style="font-size: 11px"><BR>

      <BR>
      <br>
		</span></font></p>
    

      	  </td>
          <td valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
          <td valign="top" width="275"><br />
      <table border="0" cellpadding="10" cellspacing="1" id="AutoNumber58"  bgcolor="#CFCFB3">
        <tr>
          <td bgcolor="#4EBBE4" valign="top"><br />
        <P ALIGN="center">
        <IMG BORDER="0" SRC="images/acceptable.gif" WIDTH="199" HEIGHT="34"></P>

        <P ALIGN="center">
		<a href="faq-guidelines.php" style="font-weight:bold; color:#FFFFFF;">Guidelines for Employers</a></P>
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
					   
			<script language="javascript" type="text/javascript">
			function checkthis() {			
			
			if(document.getElementById('Available_positions').value < <?php echo $MinJobpost; ?>) {
			
			alert("Available Positions must be above <?php echo $MinJobpost; ?>");
			
			document.getElementById('Available_positions').focus();
			
			return false;
			
			}
			
			if(document.getElementById('radious').checked==false && document.getElementById('radioint').checked==true) {
			
			if(document.getElementById('Payment_per_task').value < <?php echo $INTjobcost; ?>) {
			
			alert("Payment Per Task must be above $<?php echo $INTjobcost; ?>");
			
			document.getElementById('Payment_per_task').focus();
			
			return false;
			
			}
			
			} else if(document.getElementById('radious').checked==true && document.getElementById('radioint').checked==false) {
			
			if(document.getElementById('Payment_per_task').value < <?php echo $USAjobcost; ?>) {
			
			alert("Payment Per Task must be above $<?php echo $USAjobcost; ?>");
			
			document.getElementById('Payment_per_task').focus();
			
			return false;
			
			}
			
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