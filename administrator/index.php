<?php include('includes/general_header.php'); ?>
<?php 
	if(isset($_REQUEST['action']) && $_REQUEST['action']=='logout'){			
		session_unset();
		session_destroy();
		js_redirect($_SERVER['PHP_SELF']);
	}
if(isset($_GET["msg"]) && $_GET["msg"]=="error")
{
 $errorcode = "#D42F1F";	
}
else
{
  $errorcode="";
}

if(isset($_GET["mg"]) && $_GET["mg"]=="session")
{
	$val = "Your Login Session has been Expired, Please Re-Login with your valid username and password";
	$code = "#D42F1F";
}
else
{
	$val = "";
}
?>
<form name="login" action="loginshed.php" method="post" onsubmit="return validate2()">
<table border="0" cellpadding="2" cellspacing="2" width="100%">
    <tr>
        <td align="left" valign="top" colspan="2"><h1 style="text-transform:uppercase">administrator login</h1></td>
    </tr>
    <tr>
        <td align="left" valign="top" colspan="2" style="text-transform:uppercase">for the use of administrators only </td>
    </tr>
    <tr><td align="left" valign="top" colspan="2">&nbsp;</td></tr>
    <tr>
        <td align="left" valign="top" colspan="2" style="color:#888">Use a valid username and password to gain access to the administration console.</td>
    </tr>
   
    <tr>
        <td align="left" valign="top" class="labels"><label for="username">Username:</label></td>
        <td align="left" valign="top" class="rows"><input type="text" name="username" id="username" style="width:200px;" class="input" /></td>
    </tr>
    <tr>
        <td align="left" valign="top" class="labels"><label for="password">Password:</label></td>
        <td align="left" valign="top" class="rows"><input type="password" name="password" id="password" style="width:200px;" class="input"/></td>
    </tr>                            
    <tr>
        <td align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top"><button type="submit" name="btnsubmit" class="input" >Login</button>&nbsp;<button type="reset" class="input" >Reset</button></td>
    </tr>     
    <?php if(isset($_GET["logout"]) && $_GET["logout"]=="success") { ?> 
    <tr>
        <td align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top" style="color:#009999">You have successfully logout</td>
    </tr>  
    <?php } ?>
	<?php if(isset($_GET["msg"]) && $_GET["msg"]=="sendpass") { ?> 
    <tr>
        <td align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top" style="color:#009999">Your password has been send to your email address</td>
    </tr>  
    <?php } ?>
	<?php if($val!="") { ?> 
    <tr>
        <td align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top" style="color:#D42F1F">Your Login Session has been Expired, Please Re-Login</td>
    </tr>  
   <?php } ?>
   <?php if($errorcode!="") { ?> 
    <tr>
        <td align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top" style="color:#D42F1F">Please enter currect Username and Password</td>
    </tr>  
   <?php } ?>   
   <tr><td align="left" valign="top" colspan="2">&nbsp;</td></tr>
    <tr>
        <td align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top"><a href="forgotpwd.php">Forgot Password?</a></td>
    </tr>     
</table>
</form>
<script language="javascript" type="text/javascript">
function validate2()
	{		
		if(document.getElementById('username').value=="")
		{
			alert('Username Should not be blank');
			document.getElementById('username').focus();
			return false;
		}
		else if(document.getElementById('password').value=="")
		{
			alert('Password should not be Blank');
			document.getElementById('password').focus();
			return false;
		}
		else
		{
		 	document.login.submit();	
		}
	}
</script>
<?php include('includes/general_footer.php'); ?>                    