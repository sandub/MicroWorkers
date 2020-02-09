<?php include('includes/admin_header.php'); ?>
<div style="margin-bottom:10px;">
    <h1 style="text-transform:uppercase">Change your password please</h1>
    <img src="media/line.png" />
</div>
<div style="padding-bottom:5px;">
<form name="f1" method="post" action="chngpassshed.php" onsubmit="return validate1()" >
<table border="0" cellpadding="2" cellspacing="2" width="100%">
    <!--<tr>
        <td align="left" valign="top" colspan="2"><h1 style="text-transform:uppercase">administrator login</h1></td>
    </tr>
    <tr>
        <td align="left" valign="top" colspan="2" style="text-transform:uppercase">for the use of administrators only </td>
    </tr>
    <tr><td align="left" valign="top" colspan="2">&nbsp;</td></tr>-->
    <tr>
        <td align="left" valign="top" colspan="2" style="color:#666">Please enter your valid password and then put your new password.</td>
    </tr>
   
    <tr>
        <td align="left" valign="top" class="labels"><label for="oldpassword">Old Password:</label></td>
        <td align="left" valign="top" class="rows"><input type="password" name="oldpassword" id="oldpassword" style="width:200px;" class="input" /></td>
    </tr>
    <tr>
        <td align="left" valign="top" class="labels"><label for="newpassword">New Password:</label></td>
        <td align="left" valign="top" class="rows"><input type="password" name="newpassword" id="newpassword" style="width:200px;" class="input"/></td>
    </tr>                            
    <tr>
        <td align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top"><button type="submit" name="btnsubmit" class="input" >Change</button>&nbsp;<button type="button" onclick="gohome();" class="input" >Cancel</button></td>
    </tr>
     <tr><td align="left" valign="top" colspan="2">&nbsp;</td></tr> 
    <?php if(isset($_GET["msg"]) && $_GET["msg"]=="error") { ?> 
    <tr>
        <td align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top" style="color:#F00">Please enter your old plassword currectly!</td>
    </tr>  
    <?php } ?>
	 <tr>
        <td align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top">&nbsp;</td>
    </tr> 
</table>
</form>
<script language="javascript" type="text/javascript">
function gohome()
{
	window.location="adminhome.php";	
}
function validate1()
	{		
		if(document.getElementById('oldpassword').value=="")
		{
			alert('Old Password Should not be blank');
			document.getElementById('oldpassword').focus();
			return false;
		}
		else if(document.getElementById('newpassword').value=="")
		{
			alert('New Password should not be Blank');
			document.getElementById('newpassword').focus();
			return false;
		}
		else
		{
		 	document.f1.submit();	
		}
	}
</script>
<?php include('includes/admin_footer.php'); ?>
                    
                    