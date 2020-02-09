<?php 
include("include/header.php");
if(!isset($_SESSION["userlogin"])) { header("location: login.php"); exit(); }
$emchange=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$_SESSION["userlogin"]."'"),MYSQL_BOTH);
if(isset($_POST["Button"])) {
$Email=$_POST["Email"];
	if(strlen($Email)>0) {
		if($Email!=$_SESSION["userlogin"]) {
			if(dbNumRows(dbQuery("select * from `user_registration` where `email`='".$Email."'"))>0) {
			$_SESSION["emailerror"]='Yes';
			$_SESSION["mailexists"]='Yes';
			} else {
			$ER=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$_SESSION["userlogin"]."'"),MYSQL_BOTH);
			dbQuery("update `user_registration` set `email`='".$Email."' where `id`='".$ER["id"]."'");
			$_SESSION["userlogin"]=$Email;
			$_SESSION["emailsuccess"]='Yes';
			}
		}		
		$_SESSION["emailsuccess"]='Yes';
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
					
					
				    <?php if(!isset($_SESSION["emailsuccess"])) { ?>
			<table width="704" border="0" cellspacing="0" cellpadding="0">

                 <tr>
                   <td colspan="3">
				   <table width="704" border="0" cellspacing="0" cellpadding="0">
                     
                     <tr>
                       <td>
					   <table border="0" width="100%" cellspacing="0" cellpadding="20">
			<tr>

				<td>
      <table border="0" cellspacing="0" style="border-collapse: collapse" id="AutoNumber60" cellpadding="0">
        <tr>
          <td nowrap><b><font color="#F62355">01</font></b> <b>enter new 
			email</b></td>
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
      <p><br>
	  <?php if(isset($_SESSION["emailerror"])) { ?> 
		<table border="0" cellpadding="5" cellspacing="2"  bgcolor="#FF0000" width="360">
		  <tr>
			<td width="100%" bgcolor="#F4F4F4"><font color="#FF0000"><b>&nbsp;&nbsp;<?php if(isset($_SESSION["mailexists"])) { ?>Email already taken<?php unset($_SESSION["mailexists"]); } if(isset($_SESSION["emailblank"])) { ?>Email is missing<?php unset($_SESSION["emailblank"]); } ?></b></font></td>
		  </tr>
		</table>
	 <?php unset($_SESSION["emailerror"]); }?>
		</p>
		<form name="ff" method="POST" action="account_email_change.php" onsubmit="return blankcheck();">
        <p>Enter new email<br>

            <input type="text" name="Email" onchange="return validateemail();" size="40"></p>
		<p><br>
            <input type="submit" value="Save changes" name="Button"></p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
      </form>
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
  <?php } else { ?>
  <table width="704" border="0" cellspacing="0" cellpadding="0">

                 <tr>
                   <td colspan="3"><table width="704" border="0" cellspacing="0" cellpadding="0">
                     
                     <tr>
                       <td><table border="0" width="100%" cellspacing="0" cellpadding="20">
			<tr>
				<td>
      <table border="0" cellspacing="0" style="border-collapse: collapse" id="AutoNumber60" cellpadding="0">
        <tr>
          <td nowrap>01 enter new email</b></td>
          <td nowrap>&nbsp;</td>
          <td nowrap><b><font color="#F62355">02</font></b> <b>confirmation</b></td>
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
		Email changed!&nbsp;&nbsp; </p>
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
<script language="javascript" type="text/javascript">
function blankcheck() {
	if(document.ff.Email.value=='') {
	alert('Please your Email Correctly!');
	document.ff.Email.focus();
	return false;
	}
}
function validateemail()
{
str=document.ff.Email.value;

var at="@"
var dot="."
var lat=str.indexOf(at)
var lstr=str.length
var ldot=str.indexOf(dot)
if (str.indexOf(at)==-1)
{
    alert('Please enter valid email address');
    document.ff.Email.value="";
    document.ff.Email.focus();
    return false;
}

else if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr)
{
     alert('Please enter valid email address');
     document.ff.Email.value="";
     document.ff.Email.focus();
     return false;
}


else if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr)
{
     alert('Please enter valid email address');
     document.ff.Email.value="";
     document.ff.Email.focus();
     return false;
}

else if (str.indexOf(at,(lat+1))!=-1)
 {
      alert('Please enter valid email address');
      document.ff.Email.value="";
      document.ff.Email.focus();
      return false;
 }

else if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot)
 {
      alert('Please enter valid email address');
      document.ff.Email.value="";
      document.ff.Email.focus();
      return false;
 }

else if (str.indexOf(dot,(lat+2))==-1)
 {
    alert('Please enter valid email address');
	document.ff.Email.value="";
  	document.ff.Email.focus();
    return false;
 }

else if (str.indexOf(" ")!=-1)
 {
    alert('Please enter valid email address');
	document.ff.Email.value="";
  	document.ff.Email.focus();
    return false;
 }
else
 {
   return true;	
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