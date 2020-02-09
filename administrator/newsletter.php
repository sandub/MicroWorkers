<?php 
include('includes/admin_header.php'); 
include('../phpmailer/class.phpmailer.php');
if(isset($_POST["gosave"]))
{
					$user = $_POST["multi"];
					$subject = $_POST["subject"];
					$content = $_POST['message'];					
					$TemplateMessage=$content;				
					
						
					$mail = new PHPMailer;
					$mail->FromName = $fromName;
					$mail->From    = $from;
					$mail->Subject = stripslashes($subject);
					$mail->Body    = stripslashes($TemplateMessage);
					$mail->AltBody = stripslashes($TemplateMessage);					
					$mail->IsHTML(true);						
					$mail->AddAddress($CONTACTUSMAILID, $SiteName);	


foreach($user as $u)
{
$t = dbFetchArray(dbQuery("select * from `newsletter` where `id`='".$u."'"),MYSQL_BOTH);
$mail->AddBCC($t["email"], 'You are Welcome');
}
												
if($mail->Send()) {
 $_SESSION["msd"]="News Letter has been sent successfully";  
} else {
 echo "Mailer Error: " . $mail->ErrorInfo;
}

}
if(isset($_POST["DelUser"])) {
$user = $_POST["multi"];
	foreach($user as $u)
	{
	dbQuery("delete from `newsletter` where `id`='".$u."'");
	}
 $_SESSION["msd"]="Subscribers has been deleted successfully";  
}
if(isset($_POST["AddUser"])) {
$subscribers = $_POST["subscribers"];
dbQuery("insert into `newsletter`(`email`) values(`$subscribers`)");
 $_SESSION["msd"]="Subscribers has been added successfully";  
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
    <h1 style="text-transform:uppercase">Please Send Newsletter to all Subscribers&nbsp;&nbsp;<?php if(isset($_SESSION["msd"]) && $_SESSION["msd"]!="") { ?><font color="#009933"><?php echo $_SESSION["msd"]; unset($_SESSION["msd"]); ?></font><?php } ?></h1>
    <img src="media/line.png" />
</div>
<div style="padding-bottom:5px;">
<form name="f1" action="newsletter.php" method="post" enctype="multipart/form-data">
<table border="0" cellpadding="2" cellspacing="2" width="100%">    
    <tr>
        <td align="left" valign="top" colspan="2" style="color:#666">Please fillup all the fields.</td>
    </tr> 
	  
    <tr>
        <td align="left" valign="top" class="labels"><label for="page">Select Subscribers:</label></td>
        <td align="left" valign="top" class="rows">
		<?php
		$s = dbQuery("select * from `newsletter` where `email`<>'' order by `email`");
		$count = dbNumRows($s);
		if($count>0){
		?>
		<select size="6" multiple="multiple" id="multi" name="multi[]" style="width:200px;">
		<?php		
			while($t = dbFetchArray($s,MYSQL_BOTH))
			{	
		?>
			<option value="<?php echo $t["id"]; ?>"><?php echo $t["email"]; ?></option>
		<?php
			}		
		?>   
		</select>
		<input type="checkbox" onClick="selectAll(this);"/> Select All<br />
		<input type="submit" onclick="return checkdel();" name="DelUser" value="Delete Those Subscribers" />
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
        <td align="left" valign="top" class="labels"><label for="add">Add Subscribers:</label></td>
        <td align="left" valign="top" class="rows"><input type="text" name="subscribers" id="subscribers" class="input" style="width:200px;">&nbsp;&nbsp;<input type="submit" name="AddUser" value="Add This Subscriber" /></td>        
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
        <td align="left" valign="top"><?php	if($count>0){ ?><button name="gosave" onClick="return check();" type="submit" class="input">Send news letter</button><?php } ?>&nbsp;&nbsp;&nbsp;&nbsp;<button name="back" type="button" onClick="javascript: window.location.href='adminhome.php';" class="input">Back</button></td> 
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
function checkdel()
{	
	
	if(document.f1.multi.value == "")
	{
       alert('Please Choose User.');
	   document.f1.multi.focus();
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
                    
                    