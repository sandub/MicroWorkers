<?php 
include('includes/admin_header.php'); 

if(isset($_POST["gosave"])) {	
	$id = $_GET["id"];	
	
	$subject= addslashes($_POST["subject"]);
	$reply= addslashes($_POST["reply"]);
	$toemail= addslashes($_POST["toemail"]);
	$amount= $_POST["amount"];
	dbQuery("update `withdraw` set `status`='1' where `id`='".$id."'");
	dbQuery("insert into `support`(`type`,`subject`,`message`,`fromemail`,`toemail`,`createdate`) values('Withdraw Reply','".$subject."','".$reply."','".$from."','".$toemail."','".$totaldate."')");	
	$resoffer=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$toemail."'"),MYSQL_BOTH);
	dbQuery("update `user_registration` set `current_balance`='".($resoffer["current_balance"]-0)."' where `email`='".$toemail."'");
	dbQuery("insert into `myaccount`(`email`,`amount`,`type`,`createdate`) values('".$toemail."','$0','0','".$totaldate."')");
	$idd=dbInsertId();	
	
	if($idd>0)
	{
		header("location: managewithdraw.php?msd=success");
		exit();
	}
	else
	{
		header("location: editwithdraw.php?id=".$id."&action=edit");
		exit();
	}	
}	
$id=$_GET["id"];
$p = dbFetchArray(dbQuery("select * from `withdraw` where `id`='$id'"),MYSQL_BOTH);
$q = dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$p["email"]."'"),MYSQL_BOTH);

?>
<div style="margin-bottom:10px;">
    <h1 style="text-transform:uppercase">Please reply a withdraw request&nbsp;&nbsp;</h1>
    <img src="media/line.png" />
</div>
	
<div style="padding-bottom:5px;">
<form name="ff" action="editwithdraw.php?id=<?php echo $id; ?>" id="ff" method="post" onsubmit="return check();" >
<input type="hidden" name="toemail" value="<?php echo stripslashes($p["email"]); ?>" />
<input type="hidden" name="amount" value="<?php echo stripslashes($p["wdamount"]); ?>" />
<table border="0" cellpadding="2" cellspacing="2" width="100%">    
    <tr>
        <td align="left" valign="top" colspan="2" style="color:#666">Please fillup all the fields.</td>
    </tr>
	 <tr>
        <td align="left" valign="top" class="labels"><label for="fullname">Method:</label></td>
        <td align="left" valign="top" class="rows"><?php  echo stripslashes($p["wdmethod"]);  ?></td>
    </tr>
	<tr>
        <td align="left" valign="top" class="labels"><label for="fromemail">Amount:</label></td>
        <td align="left" valign="top" class="rows"><?php echo stripslashes($p["wdamount"]); ?></td>
    </tr>	
	<tr>
        <td align="left" valign="top" class="labels"><label for="fromemail">Sendto:</label></td>
        <td align="left" valign="top" class="rows"><?php echo stripslashes($p["wdsendto"]); ?></td>
    </tr>	
    <tr>
        <td align="left" valign="top" class="labels"><label for="fullname">Name:</label></td>
        <td align="left" valign="top" class="rows"><?php  echo stripslashes($q["fullname"]); ?></td>
    </tr>
	<tr>
        <td align="left" valign="top" class="labels"><label for="fromemail">Email:</label></td>
        <td align="left" valign="top" class="rows"><?php echo stripslashes($p["email"]); ?></td>
    </tr>	
	<tr>
        <td align="left" valign="top" class="labels"><label for="fromemail">Pin:</label></td>
        <td align="left" valign="top" class="rows"><?php echo stripslashes($p["pin"]); ?></td>
    </tr>
	<tr>
        <td align="left" valign="top" class="labels"><label for="fromemail">Applied Date:</label></td>
        <td align="left" valign="top" class="rows"><?php echo date("d/m/Y",strtotime($p["applieddate"])); ?></td>
    </tr>	
	<tr>
        <td align="left" valign="top" class="labels"><label for="subject">Subject:</label></td>
        <td align="left" valign="top" class="rows"><input type="text" value="" name="subject" id="subject" style="width:400px;" /></td>
    </tr>	
	
	<tr>
        <td align="left" valign="top" class="labels"><label for="reply">Reply:</label></td>
        <td align="left" valign="top" class="rows"><textarea name="reply" id="reply" cols="40" rows="4"></textarea></td>        
    </tr>
	<tr>
        <td align="left" valign="top" class="labels"><label for="status">Status:</label></td>
        <td align="left" valign="top" class="rows"><select id="status" name="status" style="width:200px;"><option value="1" <?php if($p["status"]=="1") { ?> selected="selected" <?php } ?> >Payment Done</option><option value="0" <?php if($p["status"]=="0") { ?> selected="selected" <?php } ?> >Payment Pending</option></select></td>        
    </tr>	
	<tr>
        <td align="left" valign="top" colspan="2">&nbsp;</td>
    </tr> 
	<tr>
		<td align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top"><button name="gosave" type="submit" class="input">Send Reply</button>&nbsp;&nbsp;&nbsp;&nbsp;<button name="back" type="button" onClick="javascript: window.location='managewithdraw.php';" class="input">Back</button></td> 
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
	
<script language="JavaScript" type="text/javascript">	
var editor = CKEDITOR.replace('reply');		
CKFinder.SetupCKEditor( editor, 'ckeditor/ckfinder/' ) ;
</script>

<?php include('includes/admin_footer.php'); ?>
                    
                    