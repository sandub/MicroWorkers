<?php 
include('includes/admin_header.php'); 

if(isset($_POST["gosave"])) {	
	$id = $_GET["id"];	
	
	$subject= addslashes($_POST["subject"]);
	$reply= addslashes($_POST["reply"]);
	$toemail= addslashes($_POST["toemail"]);
	$type= addslashes($_POST["type"]);
	
	dbQuery("insert into `support`(`type`,`subject`,`message`,`fromemail`,`toemail`,`createdate`) values('".$type."','".$subject."','".$reply."','".$from."','".$toemail."','".$totaldate."')");	
	$idd=dbInsertId();	
	
	if($idd>0)
	{
		header("location: managesupport.php?msd=success");
		exit();
	}
	else
	{
		header("location: replysupport.php?id=".$id."&action=edit");
		exit();
	}	
}	
$id=$_GET["id"];
$p = dbFetchArray(dbQuery("select * from `support` where `id`='$id'"),MYSQL_BOTH);
if($p["fromemail"]!=$from) {
$q = dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$p["fromemail"]."'"),MYSQL_BOTH);
}
?>
<div style="margin-bottom:10px;">
    <h1 style="text-transform:uppercase">Please edit a Job application&nbsp;&nbsp;</h1>
    <img src="media/line.png" />
</div>
	
<div style="padding-bottom:5px;">
<form name="ff" action="replysupport.php?id=<?php echo $id; ?>" id="ff" method="post" onsubmit="return check();" >
<input type="hidden" name="toemail" value="<?php if($p["fromemail"]!=$from) { echo stripslashes($p["fromemail"]); } else { echo $from; } ?>" />
<input type="hidden" name="type" value="<?php echo stripslashes($p["type"]); ?>" />
<table border="0" cellpadding="2" cellspacing="2" width="100%">    
    <tr>
        <td align="left" valign="top" colspan="2" style="color:#666">Please fillup all the fields.</td>
    </tr>	
    <tr>
        <td align="left" valign="top" class="labels"><label for="fullname">Name:</label></td>
        <td align="left" valign="top" class="rows"><?php if($p["fromemail"]!=$from) {  echo stripslashes($q["fullname"]); } else { echo $fromName; } ?></td>
    </tr>
	<tr>
        <td align="left" valign="top" class="labels"><label for="fromemail">Email:</label></td>
        <td align="left" valign="top" class="rows"><?php echo stripslashes($p["fromemail"]); ?></td>
    </tr>	
	<tr>
        <td align="left" valign="top" class="labels"><label for="fromemail">Type:</label></td>
        <td align="left" valign="top" class="rows"><?php echo stripslashes($p["type"]); ?></td>
    </tr>
	<tr>
        <td align="left" valign="top" class="labels"><label for="fromemail">SendDate:</label></td>
        <td align="left" valign="top" class="rows"><?php echo date("d/m/Y",strtotime($p["createdate"])); ?></td>
    </tr>	
	<tr>
        <td align="left" valign="top" class="labels"><label for="subject">Subject:</label></td>
        <td align="left" valign="top" class="rows"><input type="text" value="Reply: <?php echo stripslashes($p["subject"]); ?>" name="subject" id="subject" style="width:400px;" /></td>
    </tr>	
	<tr>
        <td align="left" valign="top" class="labels"><label for="message">Message:</label></td>
        <td align="left" valign="top" class="rows"><textarea name="message" readonly="readonly" id="message" cols="70" rows="4"><?php echo stripslashes($p["message"]); ?></textarea></td>        
    </tr>
	<?php if($p["fromemail"]!=$from) { ?>	
	<tr>
        <td align="left" valign="top" class="labels"><label for="reply">Reply:</label></td>
        <td align="left" valign="top" class="rows"><textarea name="reply" id="reply" cols="40" rows="4"></textarea></td>        
    </tr>
	<?php } ?>
	<tr>
        <td align="left" valign="top" colspan="2">&nbsp;</td>
    </tr> 
	<tr>
		<td align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top"><?php if($p["fromemail"]!=$from) { ?><button name="gosave" type="submit" class="input">Send Reply</button><?php } ?>&nbsp;&nbsp;&nbsp;&nbsp;<button name="back" type="button" onClick="javascript: window.location='managesupport.php';" class="input">Back</button></td> 
    </tr> 
</table>
</form>
<script language="javascript" type="text/javascript">
function check()
{	
	if(document.getElementById('subject').value == "") 
	{
	   alert('Please Enter your subject before submit.');
	   document.getElementById('subject').focus();
	   return false;	
	}
	
}
</script>
<?php if($p["fromemail"]!=$from) { ?>	
<script language="JavaScript" type="text/javascript">	
var editor = CKEDITOR.replace('reply');		
CKFinder.SetupCKEditor( editor, 'ckeditor/ckfinder/' ) ;
</script>
<?php } ?>
<script language="JavaScript" type="text/javascript">	
var editor = CKEDITOR.replace('message');		
CKFinder.SetupCKEditor( editor, 'ckeditor/ckfinder/' ) ;
</script>
<?php include('includes/admin_footer.php'); ?>
                    
                    