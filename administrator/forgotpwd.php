<?php include('includes/general_header.php'); ?>
<form name="ff" action="sendmail.php" method="post" onsubmit="return checkemail();">
<table border="0" cellpadding="2" cellspacing="2" width="100%">
    <tr>
        <td align="left" valign="top" colspan="2"><h1 style="text-transform:uppercase">retrieve lost password</h1></td>
    </tr>
    <tr>
        <td align="left" valign="top" colspan="2" style="text-transform:uppercase">for the use of administrators only </td>
    </tr>
    <tr><td align="left" valign="top" colspan="2">&nbsp;</td></tr>
    <tr>
        <td align="left" valign="top" colspan="2" style="color:#888">To obtain a new password, please enter your e-mail address and it will be emailed to you.</td>
    </tr>
    <tr><td align="left" valign="top" colspan="2">&nbsp;</td></tr>
    <tr>
        <td align="left" valign="top" class="labels"><label for="email">Email address:</label></td>
        <td align="left" valign="top" class="rows"><input type="text" name="email" id="email" style="width:200px;" class="input" /></td>
    </tr>
    <tr>
        <td align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top"><button type="submit" name="btnsubmit" class="input" >Send</button>&nbsp;<button type="reset" class="input" onclick="window.location='index.php'" >Cancel</button></td>
    </tr>
	<tr><td align="left" valign="top" colspan="2">&nbsp;</td></tr>
	<tr><td align="left" valign="top" colspan="2" style="color:#FF0000"><?php if(isset($_GET["msd"]) && $_GET["msd"]=="error") { ?>This is not the registered email id, please provide correct one.<?php } ?><?php if(isset($_GET["msd"]) && $_GET["msd"]=="senterror") { ?>Error to sent email.<?php } ?></td></tr>
</table>
</form>
<script language="javascript" type="text/javascript">
function checkemail()
{
if(document.ff.email.value!="")
{
	if(validate1()==false)
	{
	return false;
	}
}
else
{
   alert("Please Enter Email Address");
   document.ff.email.value="";
   document.ff.email.focus();
   return false;
}
}
function validate1()
{
str=document.ff.email.value;

var at="@"
var dot="."
var lat=str.indexOf(at)
var lstr=str.length
var ldot=str.indexOf(dot)
if (str.indexOf(at)==-1)
{
   alert("Invalid Email Address");
   document.ff.email.value="";
   document.ff.email.focus();
   return false;
}

if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr)
{
     alert("Invalid Email Address");
 document.ff.email.value="";
  document.ff.email.focus();
   return false;
}


if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr)
{
   alert("Invalid Email Address");
   document.ff.email.value="";
  document.ff.email.focus();
     return false;
}

if (str.indexOf(at,(lat+1))!=-1)
 {
      alert("Invalid Email Address");
  document.ff.email.value="";
  document.ff.email.focus();
     return false;
 }

 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot)
 {
      alert("Invalid Email Address");
  document.ff.email.value="";
  document.ff.email.focus();
     return false;
 }

 if (str.indexOf(dot,(lat+2))==-1)
 {
    alert("Invalid Email Address");
	document.ff.email.value="";
  	document.ff.email.focus();
    return false;
 }

 if (str.indexOf(" ")!=-1)
 {
    alert("Invalid Email Address");
	document.ff.email.value="";
  	document.ff.email.focus();
    return false;
 }
 
}
</script>
<?php include('includes/general_footer.php'); ?>                    