<?php 
include('includes/admin_header.php');
include('../phpmailer/class.phpmailer.php');
if(isset($_POST["gosave"]))
{
					$user = $_POST["multi"];
					$subject = addslashes($_POST["subject"]);
					$content = addslashes($_POST['message']);					
					$TemplateMessage=$content;				
					
										

$mail = new PHPMailer;

foreach($user as $u)
{
$t = dbFetchArray(dbQuery("select * from `user_registration` where `id`='".$u."'"),MYSQL_BOTH);
$mail->AddBCC($t["email"], stripslashes($t["fullname"]));
$TemplateMessage.="Try to unsubscribe through : <a href='".$URL."unsubscribe.php?id=".$t["id"]."'>".$URL."unsubscribe.php?id=".$t["id"]."</a><br />";
}
	
$TemplateMessage.="<br /><br />----------------<br />";
$TemplateMessage.="<br />";
$TemplateMessage.=$fromName." Team<br>";
$TemplateMessage.=$globalsitename;		

$mail->FromName = $fromName;
$mail->From    = $from;
$mail->Subject = stripslashes($subject);
$mail->Body    = stripslashes($TemplateMessage);
$mail->AltBody = stripslashes($TemplateMessage);					
$mail->IsHTML(true);						
$mail->AddAddress($CONTACTUSMAILID, "Admin");	
											
if($mail->Send()) {
 $_SESSION["msd"]="Mail has been sent successfully";  
} else {
 echo "Mailer Error: " . $mail->ErrorInfo;
}

}
if(isset($_POST["gosend"]))
{
$user = $_POST["multi"];
$subject = addslashes($_POST["subject"]);
$content = addslashes($_POST['message']);	
foreach($user as $u)
{
$t = dbFetchArray(dbQuery("select * from `user_registration` where `id`='".$u."'"),MYSQL_BOTH);
dbQuery("insert into `support`(`type`,`subject`,`message`,`fromemail`,`toemail`,`createdate`) values('Admin General Mail','".$subject."','".$content."','".$from."','".$t["email"]."','".$totaldate."')");	
}
$_SESSION["msd"]="Support Mail has been sent successfully";  
}
?>
<script type="text/javascript" charset="utf-8">
function selectAll(chkObj){
var multi=document.getElementById('multi');
if(chkObj.checked)
for(i=0;i<multi.options.length;i++)
multi.options[i].selected=true;
else
for(i=0;i<multi.options.length;i++)
multi.options[i].selected=false;
}
</script>
<div style="margin-bottom:10px;">
    <h1 style="text-transform:uppercase">Please Send Mail to All Site Users&nbsp;&nbsp;<?php if(isset($_SESSION["msd"]) && $_SESSION["msd"]!="") { ?><font color="#009933"><?php echo $_SESSION["msd"]; unset($_SESSION["msd"]); ?></font><?php } ?></h1>
    <img src="media/line.png" />
</div>
<div style="padding-bottom:5px;">
<form name="f2" action="mailtousers.php" method="post">
<table border="0" cellpadding="2" cellspacing="2" width="100%">    
    <tr>
        <td align="left" valign="top" colspan="2" style="color:#666">Please fillup all the fields.</td>
    </tr> 
	<tr>
        <td align="left" valign="top" class="labels"><label for="subject">Choose Users:</label></td>
        <td align="left" valign="top" class="rows"><select name="usertype" id="usertype" style="width:300px;" onchange="javascript: if(this.value!='') { document.f2.submit(); }" ><option value=""></option><option value="all" <?php if(isset($_POST["usertype"]) && $_POST["usertype"]=='all') { echo 'selected="selected"'; } ?> >All Users</option><option value="balance" <?php if(isset($_POST["usertype"]) && $_POST["usertype"]=='balance') { echo 'selected="selected"'; } ?> >Users balance under $1.01</option></select></td>        
    </tr>
</table>
</form>
<form name="f1" action="mailtousers.php" method="post" enctype="multipart/form-data">
<table border="0" cellpadding="2" cellspacing="2" width="100%">    
    <tr>
        <td align="left" valign="top" colspan="2" style="color:#666">Please fillup all the fields.</td>
    </tr> 	
    <tr>
        <td align="left" valign="top" class="labels"><label for="page">Select User:</label></td>
        <td align="left" valign="top" class="rows">
		<?php
		if(isset($_POST["usertype"]) && $_POST["usertype"]=='all') {
		$s = dbQuery("select * from `user_registration` where `status`='1' and `mailtouser`='1' order by `fullname`");
		} else if(isset($_POST["usertype"]) && $_POST["usertype"]=='balance') {
		$s = dbQuery("select * from `user_registration` where `current_balance` < '1.02' and `mailtouser`='1' order by `fullname`");
		} else {
		$s = dbQuery("select * from `user_registration` where `status`='1' and `mailtouser`='1' order by `fullname`");
		}
		$count = dbNumRows($s);
		if($count>0){
		?>
		<select size="5" multiple="multiple" id="multi" name="multi[]" style="width:200px;">
		<?php		
			while($t = dbFetchArray($s,MYSQL_BOTH))
			{	
		?>
			<option value="<?php echo $t["id"]; ?>"><?php echo $t["fullname"]; ?></option>
		<?php
			}		
		?>   
		</select>
		<input type="checkbox" onClick="selectAll(this);"/> Select All
		<?php
		}
		else
		{
		?>
		No Records!
		<?php
		}		
		?>
		</td>        
    </tr>
	<tr>
        <td align="left" valign="top" class="labels"><label for="subject">Subject:</label></td>
        <td align="left" valign="top" class="rows"><input type="text" name="subject" id="subject" class="input" style="width:400px;"></td>        
    </tr>
    <tr>
        <td align="left" valign="top" class="labels"><label for="catpicture">Enter Message:</label></td>
        <td align="left" valign="top" class="rows"><textarea name="message" id="message" cols="40" rows="4"></textarea></td>
	</tr>	
	<tr>
        <td align="left" valign="top" colspan="2">&nbsp;</td>
    </tr> 
	<tr>
		<td align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top"><?php	if($count>0){ ?><button name="gosave" onClick="return check();" type="submit" class="input">Send To E-Mail</button>&nbsp;&nbsp;&nbsp;<button name="gosend" onClick="return check();" type="submit" class="input">Send To Support</button><?php } ?>&nbsp;&nbsp;&nbsp;&nbsp;<button name="back" type="button" onClick="javascript: window.location.href='adminhome.php';" class="input">Back</button></td> 
    </tr> 
	
</table>
</form>
<script language="javascript" type="text/javascript">
function check()
{	
	<?php
	if($count>0){
	?>
	if(document.f1.multi.value == "")
	{
       alert('Please Choose User.');
	   document.f1.multi.focus();
	   return false;
	}
	else <?php } ?> if(document.f1.subject.value == "")
	{
       alert('Please Enter Subject.');
	   document.f1.subject.focus();
	   return false;
	}
	else
	{
	document.f1.submit();
	}	
}
</script>
<script language="JavaScript" type="text/javascript">	
var editor = CKEDITOR.replace('message');		
CKFinder.SetupCKEditor( editor, 'ckeditor/ckfinder/' ) ;
</script>
<?php include('includes/admin_footer.php'); ?>
                    
                    