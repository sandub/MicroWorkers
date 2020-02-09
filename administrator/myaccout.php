<?php include('includes/admin_header.php'); ?>

<div style="margin-bottom:10px;">

    <h1 style="text-transform:uppercase">Here is your account details</h1>

    <img src="media/line.png" />

</div>

<div style="padding-bottom:5px;">

<form name="f1" action="myaccoutshed.php" method="post" onsubmit="return gosave();">

<table border="0" cellpadding="2" cellspacing="2" width="100%">    

    <tr>

        <td align="left" valign="top" colspan="2" style="color:#666">Here is your all account details.</td>

    </tr>

   

    <tr>

        <td align="left" valign="top" class="labels"><label for="username">Username:</label></td>

        <td align="left" valign="top" class="rows"><input type="text" name="username" id="username" style="width:200px;" class="input" value="<?php echo $rec["username"]; ?>" /></td>        

    </tr>

    <tr>

        <td align="left" valign="top" class="labels"><label for="password">Password:</label></td>

        <td align="left" valign="top" class="rows"><input type="password" name="password" id="password" style="width:200px;" class="input" value="<?php echo base64_decode($rec["password"]); ?>"/></td>

    </tr>  

    <tr>

        <td align="left" valign="top" class="labels"><label for="email">E-Mail:</label></td>

        <td align="left" valign="top" class="rows"><input type="text" name="email" id="email" style="width:200px;" class="input" value="<?php echo $rec["email"]; ?>" /></td>

    </tr>

                              

    <tr>

        <td align="left" valign="top">&nbsp;</td>

        <td align="left" valign="top"><button type="submit" name="btnsubmit" class="input" onclick="gosave();" >Save Changes</button>&nbsp;<button type="reset" class="input" onclick="goback();" >Back</button></td>

    </tr>

     <tr><td align="left" valign="top" colspan="2">&nbsp;</td></tr>        

</table>

</form>

<script language="javascript" type="text/javascript">

function gosave()

{

if(document.getElementById('username').value=="")

{

alert("Please enter username");

document.getElementById('username').focus();

return false;

}

else if(document.getElementById('password').value=="")

{

alert("Please enter password");

document.getElementById('password').focus();

return false;

}

else if(document.getElementById('email').value=="")

{

alert("Please enter email address");

document.getElementById('email').focus();

return false;

}

else

{

document.f1.submit();

}

}

function goback()

{

window.location.href='adminhome.php';

}

</script>

<?php include('includes/admin_footer.php'); ?>

                    

                    