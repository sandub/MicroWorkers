<?php 

include('includes/admin_header.php');

include('../phpmailer/class.phpmailer.php');

?>

<div style="margin-bottom:10px;">

    <h1 style="text-transform:uppercase">Please edit a user&nbsp;&nbsp;<?php if(isset($_SESSION["UPLOADPICERROR"])) { ?><font color="#FF0000"><?php echo $_SESSION["UPLOADPICERROR"]; unset($_SESSION["UPLOADPICERROR"]); ?></font><?php } ?></h1>

    <img src="media/line.png" />

</div>

<div style="padding-bottom:5px;">

<?php

if(isset($_GET["action"]) && $_GET["action"]=="active") {

					dbQuery("update `user_registration` set `status`='0',`createdate`='".$totaldate."' where `id`='".$_GET["uid"]."'");

					$u = dbFetchArray(dbQuery("select * from `user_registration` where `id`='".$_GET["uid"]."'"),MYSQL_BOTH);	

					

					$sig = dbFetchArray(dbQuery("select * from `mailsettings` where `id`='17'"),MYSQL_BOTH);

					$Subject1 = stripslashes($sig["subject"]);

					$TemplateMessage=str_replace("%FULLNAME%", $u["fullname"], stripslashes($sig["message"]));

					$TemplateMessage=str_replace("%EMAIL%", $u["nname"], $TemplateMessage);	

					$TemplateMessage=str_replace("%PASSWORD%", base64_decode($u["password"]), $TemplateMessage);	

					$TemplateMessage=str_replace("%URL%", "<a href='".$URL."emailverified?ID=".base64_encode(stripslashes($u["email"]))."&PID=".base64_encode(stripslashes($u["password"]))."&active=yes\' target=\'_blank\'>".$URL."emailverified?ID=".base64_encode(stripslashes($u["email"]))."&PID=".stripslashes($u["password"])."&active=yes</a>", $TemplateMessage);

																

					$mail = new PHPMailer;

					$mail->FromName = $fromName;

					$mail->From    = $from;

					$mail->Subject = $Subject1;

					$mail->Body    = stripslashes($TemplateMessage);

					$mail->AltBody = stripslashes($TemplateMessage);					

					$mail->IsHTML(true);	

					$mail->AddAddress($u["email"],$u["fullname"]);

					if($mail->Send()) {

					header("location: userlist.php?msd=success");

					}

}

$uid = $_GET["uid"];

$action = $_GET["action"];

if($action=="delete")

{	

	dbQuery("delete from `user_registration` where `id`='$uid'");

	header("location: userlist.php?msd=success");

}

elseif($action=="edit")

{	

	$s = dbFetchArray(dbQuery("select * from `user_registration` where `id`='$uid'"),MYSQL_BOTH);	

	$fullname= stripslashes($s["fullname"]);

	$country= stripslashes($s["country"]);

	$status= stripslashes($s["status"]);

	$email= stripslashes($s["email"]);

	$current_balance= stripslashes($s["current_balance"]);

	$referrer= stripslashes($s["referrer"]);

	$password= base64_decode($s["password"]);	

}

?>

<form name="f1" action="usereditsave.php?uid=<?php echo $uid; ?>" method="post" onSubmit="return check();">

<table border="0" cellpadding="2" cellspacing="2" width="100%">    

    <tr>

        <td align="left" valign="top" colspan="2" style="color:#666">Please fillup all the fields.</td>

    </tr>  

	<?php	

	$arr=explode(" ", date("Y-m-d H:i:s"));

	$ar1=explode("-", $arr[0]);

	$ar2=explode(":", $arr[1]);

	$saq="select * from `user_registration` where `status`='0' and `id`='".$uid."' and `createdate`<'".date("Y-m-d",mktime($ar2[0], $ar2[1], $ar2[2], $ar1[1], $ar1[2]-1, $ar1[0]))."'";

	$a = dbQuery($saq);

	if(dbNumRows($a)>0) {

	?> 

	 <tr>

        <td align="left" valign="top" colspan="2" class="labels">Re-send activation link to the user:&nbsp;&nbsp;<input type="button" name="But" value="Click Here" onclick="javascript: window.location.href='edituser.php?action=active&uid=<?php echo $uid; ?>';" class="input" style="width:150px; text-align:center" /></td>        

    </tr>

	<?php

	}

	?>

    <tr>

        <td align="left" valign="top" class="labels"><label for="fname">Full Name:</label></td>

        <td align="left" valign="top" class="rows"><input type="text" name="fullname" id="fullname" value="<?php echo $fullname; ?>" style="width:200px;" class="input" /></td>        

    </tr>

   <tr>

        <td align="left" valign="top" class="labels"><label for="email">Email:</label></td>

        <td align="left" valign="top" class="rows"><input type="text" name="email" id="email" value="<?php echo $email; ?>" style="width:200px;" class="input" onchange="return validateemail();" /></td>        

    </tr>	  

	<input type="hidden" name="mainemail" value="<?php echo $email; ?>" />

	<tr>

        <td align="left" valign="top" class="labels"><label for="password">Password:</label></td>

        <td align="left" valign="top" class="rows"><input type="text" name="password" id="password" value="<?php echo $password; ?>" style="width:200px;" class="input" /></td>

    </tr> 

	<tr>

		<td align="left" valign="top" class="labels" ><label for="referrer">Country:</label></td>

		<td align="left" valign="top" class="rows"><input type="text" name="country" value="<?php echo $country; ?>"  id="country" class="input" style="width:200px;" /></td>

	 </tr>   

	<tr>

		<td align="left" valign="top" class="labels" ><label for="referrer">Referrer:</label></td>

		<td align="left" valign="top" class="rows"><input type="text" name="referrer" value="<?php echo $referrer; ?>"  id="referrer" class="input" style="width:200px;" /></td>

	</tr>

	<tr>

		<td align="left" valign="top" class="labels" ><label for="account_balance">Account Balance:</label></td>

		<td align="left" valign="top" class="rows">$<input type="text" name="account_balance" value="<?php echo $current_balance; ?>"  id="account_balance" class="input" style="width:200px;" /></td>

	</tr>

	<tr>

		<td align="left" valign="top" class="labels" ><label for="account_balance">Status:</label></td>

		<td align="left" valign="top" class="rows"><select name="status" id="status"><option value="">Choose</option><option value="1" <?php if($status=='1') { echo 'selected="selected"'; } ?> >ON</option><option value="0" <?php if($status=='0') { echo 'selected="selected"'; } ?> >OFF</option></select></td>

	 </tr>

	<tr>

		<td align="left" valign="top" class="labels" ><label for="account_balance">Adjust Balance:</label></td>

		<td align="left" valign="top" class="rows"><div style="width: 500px; float:left"><div style="float:left;"><input type="radio" name="checkadjust" onclick="javascript: getElementById('adjust').style.display='block';" value="add" id="add" /> Add <input type="radio" name="checkadjust" onclick="javascript: getElementById('adjust').style.display='block';" value="deduct" id="deduct" /> Deduct&nbsp;&nbsp;&nbsp;</div><div id="adjust" style="display:none; float:right; padding-right:144px;">$<input type="text" name="account_adjust" value="<?php echo $s["current_balance"]; ?>"  id="account_adjust" class="input" style="width:98px;" />&nbsp;&nbsp;<input type="button" onclick="javascript: document.getElementById('deduct').checked=false; document.getElementById('add').checked=false; getElementById('adjust').style.display='none';" name="Me" value="Cancel" /></div></div></td>

	 </tr>	 

	<tr>

        <td align="left" valign="top" colspan="2">&nbsp;</td>

    </tr> 

	<tr>

		<td align="left" valign="top">&nbsp;</td>

        <td align="left" valign="top"><button name="gosave" type="submit" class="input">Save user Record</button>&nbsp;&nbsp;&nbsp;&nbsp;<button name="back" type="button" onClick="javascript: window.location='userlist.php';" class="input">Back</button></td> 

    </tr> 

</table>

</form>

<script language="javascript" type="text/javascript">

function check()

{

    if(document.f1.fullname.value == "")

	{

       alert('Please Give Full Name.');

	   document.f1.fullname.focus();

	   return false;

	}

	if(document.f1.email.value == "")

	{

       alert('Please Give Email Address.');

	   document.f1.email.focus();

	   return false;

	}

	if(document.f1.password.value == "")

	{

       alert('Please Give User password.');

	   document.f1.password.focus();

	   return false;

	}		

	if(document.f1.country.value == "")

	{

       alert('Please Give Country Name.');

	   document.f1.country.focus();

	   return false;

	}	

}

function validateemail()

{

str=document.f1.email.value;



var at="@"

var dot="."

var lat=str.indexOf(at)

var lstr=str.length

var ldot=str.indexOf(dot)

if (str.indexOf(at)==-1)

{

    alert("Invalid Email Address");

    document.f1.email.value="";

    document.f1.email.focus();

    return false;

}



else if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr)

{

     alert("Invalid Email Address");

     document.f1.email.value="";

     document.f1.email.focus();

     return false;

}





else if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr)

{

     alert("Invalid Email Address");

     document.f1.email.value="";

     document.f1.email.focus();

     return false;

}



else if (str.indexOf(at,(lat+1))!=-1)

 {

      alert("Invalid Email Address");

      document.f1.email.value="";

      document.f1.email.focus();

      return false;

 }



else if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot)

 {

      alert("Invalid Email Address");

      document.f1.email.value="";

      document.f1.email.focus();

      return false;

 }



else if (str.indexOf(dot,(lat+2))==-1)

 {

    alert("Invalid Email Address");

	document.f1.email.value="";

  	document.f1.email.focus();

    return false;

 }



else if (str.indexOf(" ")!=-1)

 {

    alert("Invalid Email Address");

	document.f1.email.value="";

  	document.f1.email.focus();

    return false;

 }

else if(document.f1.email.value!=document.f1.mainemail.value)

{

    $.get("../emailcheck.php", { email: document.f1.email.value },

   function(data){   

   	if($.trim(data)=='yes') {

		alert('This Email Id already exists!');

	    document.getElementById("email").value='';

		}

	else if($.trim(data)=='no') {			

		} 

   });

}

 

}

</script>

<?php include('includes/admin_footer.php'); ?>

                    

                    