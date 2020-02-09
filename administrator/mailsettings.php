<?php 
include('includes/admin_header.php');
if(isset($_POST["gosave"])){
$id = $_GET["id"];
$subject = addslashes($_POST["subject"]);
$content = addslashes($_POST['message']);
dbQuery("update `mailsettings` set `subject`='".$subject."',`message`='".$content."' where `id`='".$id."'");				
$_SESSION["msd"]="Settings saved successfully";
}
if(isset($_GET["id"])) {
$sq = dbFetchArray(dbQuery("select * from `mailsettings` where `id`='".$_GET["id"]."'"),MYSQL_BOTH);
}
?>
<div style="margin-bottom:10px;">
    <h1 style="text-transform:uppercase">Please save settings for send template mails&nbsp;&nbsp;<?php if(isset($_SESSION["msd"]) && $_SESSION["msd"]!="") { ?><font color="#009933"><?php echo $_SESSION["msd"]; unset($_SESSION["msd"]); ?></font><?php } ?></h1>
    <img src="media/line.png" />
</div>
<div style="padding-bottom:5px;">
<form name="f1" action="mailsettings.php<?php if(isset($_GET["id"])) { echo "?id=".$_GET["id"]; } ?>" method="post" enctype="multipart/form-data">
<table border="0" cellpadding="2" cellspacing="2" width="100%">    
    <tr>
        <td align="left" valign="top" colspan="2" style="color:#666">Please fillup all the fields.</td>
    </tr>   
   <tr>
        <td align="left" valign="top" class="labels"><label for="subject">Section:</label></td>
        <td align="left" valign="top" class="rows"><select name="title" id="title" class="input" style="width:300px;" onchange="gonext(this.value);">
		<option value="">Choose One</option>
		<?php
		$sql=dbQuery("select * from `mailsettings` where `status`='1' order by `id`");
		if(dbNumRows($sql)>0) {		
		while($s = dbFetchArray($sql,MYSQL_BOTH)) {
		?>
		<option value="<?php echo $s["id"]; ?>" <?php if(isset($_GET["id"])) { if($sq["id"]==$s["id"]) { ?> selected="selected"<?php } } ?> ><?php echo stripslashes($s["title"]); ?></option>
		<?php		
		 } 
		}
		?>
		</select></td>        
    </tr>
	<?php
	if(isset($_GET["id"])) {
	?>
	<tr>
        <td align="left" valign="top" class="labels"><label for="subject">Subject:</label></td>
        <td align="left" valign="top" class="rows"><input type="text" name="subject" value="<?php echo stripslashes($sq["subject"]); ?>" id="subject" class="input" style="width:400px;"></td>        
    </tr>
    <tr>
        <td align="left" valign="top" class="labels"><label for="catpicture">Enter Message:</label></td>
        <td align="left" valign="top" class="rows"><textarea name="message" id="message" cols="40" rows="4"><?php echo stripslashes($sq["message"]); ?></textarea></td>
    </tr>	
	<?php } ?>	
	<?php if(isset($_GET["id"]) && $_GET["id"]=='1') { ?> 
	<tr>
        <td align="left" valign="top" class="labels"><font color="#FF0000">***</font>&nbsp;NOTE:</td>
        <td align="left" valign="top" class="rows">
		<div style="height:100px; overflow:auto">
		<ul>
		    <li><font color="#FF0000" style="font-weight:bold">You Shouldn't change this variables</font></li>
			<li><font color="#FF0000">*</font>&nbsp;%EMAIL% - holds email address</li>
			<li><font color="#FF0000">*</font>&nbsp;%PASSWORD% - holds password</li>
			<li><font color="#FF0000">*</font>&nbsp;%URL% - holds url of the site</li>
		</ul>
		</div>
		</td>
    </tr>
	<?php } elseif(isset($_GET["id"]) && $_GET["id"]=='2') { ?>
	<tr>
        <td align="left" valign="top" class="labels"><font color="#FF0000">***</font>&nbsp;NOTE:</td>
        <td align="left" valign="top" class="rows">
		<div style="height:100px; overflow:auto">
		<ul>
			<li><font color="#FF0000" style="font-weight:bold">You Shouldn't change this variables</font></li>
			<li><font color="#FF0000">*</font>&nbsp;%FULLNAME% - holds fullname</li>
			<li><font color="#FF0000">*</font>&nbsp;%PASSWORD% - holds password</li>
		</ul>
		</div>
		</td>
    </tr>
	<?php } elseif(isset($_GET["id"]) && $_GET["id"]=='3') { ?>
	<tr>
        <td align="left" valign="top" class="labels"><font color="#FF0000">***</font>&nbsp;NOTE:</td>
        <td align="left" valign="top" class="rows">
		<div style="height:100px; overflow:auto">
		<ul>
			<li><font color="#FF0000" style="font-weight:bold">You Shouldn't change this variables</font></li>
			<li><font color="#FF0000">*</font>&nbsp;%FIRSTNAME% - holds firstname</li>
			<li><font color="#FF0000">*</font>&nbsp;%LASTNAME% - holds lastname</li>
			<li><font color="#FF0000">*</font>&nbsp;%PURSEID% - holds Purse Id</li>
			<li><font color="#FF0000">*</font>&nbsp;%WINNER/RUNNER% - holds position</li>
			<li><font color="#FF0000">*</font>&nbsp;%AMOUNT% - holds amount of GBPoints won by the user</li>
		</ul>
		</div>
		</td>
    </tr>
	<?php } elseif(isset($_GET["id"]) && $_GET["id"]=='4') { ?>
	<tr>
        <td align="left" valign="top" class="labels"><font color="#FF0000">***</font>&nbsp;NOTE:</td>
        <td align="left" valign="top" class="rows">
		<div style="height:100px; overflow:auto">
		<ul>
			<li><font color="#FF0000" style="font-weight:bold">You Shouldn't change this variables</font></li>
			<li><font color="#FF0000">*</font>&nbsp;%FIRSTNAME% - holds firstname</li>
			<li><font color="#FF0000">*</font>&nbsp;%LASTNAME% - holds lastname</li>
			<li><font color="#FF0000">*</font>&nbsp;%THISCHALLENGE% - holds GB Challenge description</li>
			<li><font color="#FF0000">*</font>&nbsp;%BONUS% - holds bonus amount in GBP</li>
		</ul>
		</div>
		</td>
    </tr>
	<?php } elseif(isset($_GET["id"]) && $_GET["id"]=='5') { ?>
	<tr>
        <td align="left" valign="top" class="labels"><font color="#FF0000">***</font>&nbsp;NOTE:</td>
        <td align="left" valign="top" class="rows">
		<div style="height:100px; overflow:auto">
		<ul>
			<li><font color="#FF0000" style="font-weight:bold">You Shouldn't change this variables</font></li>
			<li><font color="#FF0000">*</font>&nbsp;%FIRSTNAME% - holds firstname</li>
			<li><font color="#FF0000">*</font>&nbsp;%LASTNAME% - holds lastname</li>
			<li><font color="#FF0000">*</font>&nbsp;%PUIRSEID% - holds Purse Id</li>
			<li><font color="#FF0000">*</font>&nbsp;%GBPOINTS% - holds amount of GBPoints for purse entryfee</li>
		</ul>
		</div>
		</td>
    </tr>
	<?php } elseif(isset($_GET["id"]) && $_GET["id"]=='6') { ?>
	<tr>
        <td align="left" valign="top" class="labels"><font color="#FF0000">***</font>&nbsp;NOTE:</td>
        <td align="left" valign="top" class="rows">
		<div style="height:100px; overflow:auto">
		<ul>
			<li><font color="#FF0000" style="font-weight:bold">You Shouldn't change this variables</font></li>
			<li><font color="#FF0000">*</font>&nbsp;%FIRSTNAME% - holds firstname</li>
			<li><font color="#FF0000">*</font>&nbsp;%LASTNAME% - holds lastname</li>
			<li><font color="#FF0000">*</font>&nbsp;%THISCHALLENGE% - holds GB Challenge description</li>
			<li><font color="#FF0000">*</font>&nbsp;%BONUS% - holds bonus amount in GBP</li>
		</ul>
		</div>
		</td>
    </tr>
	<?php } elseif(isset($_GET["id"]) && $_GET["id"]=='7') { ?>
	<tr>
        <td align="left" valign="top" class="labels"><font color="#FF0000">***</font>&nbsp;NOTE:</td>
        <td align="left" valign="top" class="rows">
		<div style="height:100px; overflow:auto">
		<ul>
			<li><font color="#FF0000" style="font-weight:bold">You Shouldn't change this variables</font></li>
			<li><font color="#FF0000">*</font>&nbsp;%FULLNAME% - holds firstname</li>
			<li><font color="#FF0000">*</font>&nbsp;%AMOUNT% - holds amount of GBPoints topped-up by the user</li>
			<li><font color="#FF0000">*</font>&nbsp;%TOTALAMOUNT% - holds the total amount of account.</li>
		</ul>
		</div>
		</td>
    </tr>
	<?php } elseif(isset($_GET["id"]) && $_GET["id"]=='8') { ?>
	<tr>
        <td align="left" valign="top" class="labels"><font color="#FF0000">***</font>&nbsp;NOTE:</td>
        <td align="left" valign="top" class="rows">
		<div style="height:100px; overflow:auto">
		<ul>
			<li><font color="#FF0000" style="font-weight:bold">You Shouldn't change this variables</font></li>
			<li><font color="#FF0000">*</font>&nbsp;</li>
			<li><font color="#FF0000">*</font>&nbsp;</li>
			<li><font color="#FF0000">*</font>&nbsp;</li>
			<li><font color="#FF0000">*</font>&nbsp;</li>
			<li><font color="#FF0000">*</font>&nbsp;</li>
		</ul>
		</div>
		</td>
    </tr>
	<?php } elseif(isset($_GET["id"]) && $_GET["id"]=='9') { ?>
	<tr>
        <td align="left" valign="top" class="labels"><font color="#FF0000">***</font>&nbsp;NOTE:</td>
        <td align="left" valign="top" class="rows">
		<div style="height:100px; overflow:auto">
		<ul>
			<li><font color="#FF0000" style="font-weight:bold">You Shouldn't change this variables</font></li>
			<li><font color="#FF0000">*</font>&nbsp;%FIRSTNAME% - holds firstname</li>
			<li><font color="#FF0000">*</font>&nbsp;%LASTNAME% - holds lastname</li>
			<li><font color="#FF0000">*</font>&nbsp;%LOGGEDINUSER% - holds the logged in user of the site</li>
		</ul>
		</div>
		</td>
    </tr>
	<?php } elseif(isset($_GET["id"]) && $_GET["id"]=='10') { ?>
	<tr>
        <td align="left" valign="top" class="labels"><font color="#FF0000">***</font>&nbsp;NOTE:</td>
        <td align="left" valign="top" class="rows">
		<div style="height:100px; overflow:auto">
		<ul>
			<li><font color="#FF0000" style="font-weight:bold">You Shouldn't change this variables</font></li>
			<li><font color="#FF0000">*</font>&nbsp;%FIRSTNAME% - holds firstname</li>
			<li><font color="#FF0000">*</font>&nbsp;%LASTNAME% - holds lastname</li>
			<li><font color="#FF0000">*</font>&nbsp;%LOGGEDINUSER% - holds the logged in user of the site</li>
		</ul>
		</div>
		</td>
    </tr>
	<?php } elseif(isset($_GET["id"]) && $_GET["id"]=='11') { ?>
	<tr>
        <td align="left" valign="top" class="labels"><font color="#FF0000">***</font>&nbsp;NOTE:</td>
        <td align="left" valign="top" class="rows">
		<div style="height:100px; overflow:auto">
		<ul>
			<li><font color="#FF0000" style="font-weight:bold">You Shouldn't change this variables</font></li>
			<li><font color="#FF0000">*</font>&nbsp;%FIRSTNAME% - holds firstname</li>
			<li><font color="#FF0000">*</font>&nbsp;%LASTNAME% - holds lastname</li>
			<li><font color="#FF0000">*</font>&nbsp;%FRIENDNICKNAME% - holds the friends nickname from where the testimonials receive</li>
		</ul>
		</div>
		</td>
    </tr>
	<?php } elseif(isset($_GET["id"]) && $_GET["id"]=='12') { ?>
	<tr>
        <td align="left" valign="top" class="labels"><font color="#FF0000">***</font>&nbsp;NOTE:</td>
        <td align="left" valign="top" class="rows">
		<div style="height:100px; overflow:auto">
		<ul>
			<li><font color="#FF0000" style="font-weight:bold">You Shouldn't change this variables</font></li>
			<li><font color="#FF0000">*</font>&nbsp;%FIRSTNAME% - holds firstname</li>
			<li><font color="#FF0000">*</font>&nbsp;%LASTNAME% - holds lastname</li>
			<li><font color="#FF0000">*</font>&nbsp;%FRIENDNICKNAME% - holds the friends nickname who is the current viewer of that profile.</li>
		</ul>
		</div>
		</td>
    </tr>
	<?php } elseif(isset($_GET["id"]) && $_GET["id"]=='13') { ?>
	<tr>
        <td align="left" valign="top" class="labels"><font color="#FF0000">***</font>&nbsp;NOTE:</td>
        <td align="left" valign="top" class="rows">
		<div style="height:100px; overflow:auto">
		<ul>
			<li><font color="#FF0000" style="font-weight:bold">You Shouldn't change this variables</font></li>
			<li><font color="#FF0000">*</font>&nbsp;%FULLNAME% - holds fullname</li>
			<li><font color="#FF0000">*</font>&nbsp;%EMAIL% - holds email address</li>
			<li><font color="#FF0000">*</font>&nbsp;%PASSWORD% - holds password</li>
		</ul>
		</div>
		</td>
    </tr>
	<?php } elseif(isset($_GET["id"]) && $_GET["id"]=='14') { ?>
	<tr>
        <td align="left" valign="top" class="labels"><font color="#FF0000">***</font>&nbsp;NOTE:</td>
        <td align="left" valign="top" class="rows">
		<div style="height:100px; overflow:auto">
		<ul>
			<li><font color="#FF0000" style="font-weight:bold">You Shouldn't change this variables</font></li>
			<li><font color="#FF0000">*</font>&nbsp;%FRIENDNAME% - holds friend's fullname</li>
			<li><font color="#FF0000">*</font>&nbsp;%URL% - holds Url of the site</li>
			<li><font color="#FF0000">*</font>&nbsp;%LINKSTART% - linking of the site url starts with it and ends with %LINKEND%</li>
		</ul>
		</div>
		</td>
    </tr>
	<?php } elseif(isset($_GET["id"]) && $_GET["id"]=='15') { ?>
	<tr>
        <td align="left" valign="top" class="labels"><font color="#FF0000">***</font>&nbsp;NOTE:</td>
        <td align="left" valign="top" class="rows">
		<div style="height:100px; overflow:auto">
		<ul>
			<li><font color="#FF0000" style="font-weight:bold">You Shouldn't change this variables</font></li>
			<li><font color="#FF0000">*</font>&nbsp;%NICKNAME% - holds nickname</li>			
		</ul>
		</div>
		</td>
    </tr>
	<?php } elseif(isset($_GET["id"]) && $_GET["id"]=='16') { ?>
	<tr>
        <td align="left" valign="top" class="labels"><font color="#FF0000">***</font>&nbsp;NOTE:</td>
        <td align="left" valign="top" class="rows">
		<div style="height:100px; overflow:auto">
		<ul>
			<li><font color="#FF0000" style="font-weight:bold">You Shouldn't change this variables</font></li>
			<li><font color="#FF0000">*</font>&nbsp;%FIRSTNAME% - holds firstname</li>
			<li><font color="#FF0000">*</font>&nbsp;%LASTNAME% - holds lastname</li>			
		</ul>
		</div>
		</td>
    </tr>
	<?php } elseif(isset($_GET["id"]) && $_GET["id"]=='17') { ?>
	<tr>
        <td align="left" valign="top" class="labels"><font color="#FF0000">***</font>&nbsp;NOTE:</td>
        <td align="left" valign="top" class="rows">
		<div style="height:100px; overflow:auto">
		<ul>
			<li><font color="#FF0000" style="font-weight:bold">You Shouldn't change this variables</font></li>
			<li><font color="#FF0000">*</font>&nbsp;%FULLNAME% - holds fullname</li>
			<li><font color="#FF0000">*</font>&nbsp;%EMAIL% - holds email address</li>
			<li><font color="#FF0000">*</font>&nbsp;%PASSWORD% - holds password</li>
			<li><font color="#FF0000">*</font>&nbsp;%URL% - holds Url of the site</li>
		</ul>
		</div>
		</td>
    </tr>
	<?php } elseif(isset($_GET["id"]) && $_GET["id"]=='18') { ?>
	<tr>
        <td align="left" valign="top" class="labels"><font color="#FF0000">***</font>&nbsp;NOTE:</td>
        <td align="left" valign="top" class="rows">
		<div style="height:100px; overflow:auto">
		<ul>
			<li><font color="#FF0000" style="font-weight:bold">You Shouldn't change this variables</font></li>
			<li><font color="#FF0000">*</font>&nbsp;%NAME% - holds current friends name</li>
			<li><font color="#FF0000">*</font>&nbsp;%YOURNAME% - holds current your name</li>
			<li><font color="#FF0000">*</font>&nbsp;%URL% - holds referral url</li>			
		</ul>
		</div>
		</td>
    </tr>
	<?php } elseif(isset($_GET["id"]) && $_GET["id"]=='19') { ?>
	<tr>
        <td align="left" valign="top" class="labels"><font color="#FF0000">***</font>&nbsp;NOTE:</td>
        <td align="left" valign="top" class="rows">
		<div style="height:100px; overflow:auto">
		<ul>
			<li><font color="#FF0000" style="font-weight:bold">You Shouldn't change this variables</font></li>
			<li><font color="#FF0000">*</font>&nbsp;%FIRSTNAME% - holds firstname</li>
			<li><font color="#FF0000">*</font>&nbsp;%LASTNAME% - holds lastname</li>
			<li><font color="#FF0000">*</font>&nbsp;%THISCHALLENGE% - holds GB Challenge description</li>
			<li><font color="#FF0000">*</font>&nbsp;%IFOFFER% - admin might offer another chance for the member to re-enter a Bonus GB-Challenge but with a different challenge - %ENDOFFER%</li>
		</ul>
		</div>
		</td>
    </tr>
	<?php } elseif(isset($_GET["id"]) && $_GET["id"]=='20') { ?>
	<tr>
        <td align="left" valign="top" class="labels"><font color="#FF0000">***</font>&nbsp;NOTE:</td>
        <td align="left" valign="top" class="rows">
		<div style="height:100px; overflow:auto">
		<ul>
			<li><font color="#FF0000" style="font-weight:bold">You Shouldn't change this variables</font></li>
			<li><font color="#FF0000">*</font>&nbsp;%FIRSTNAME% - holds firstname</li>
			<li><font color="#FF0000">*</font>&nbsp;%LASTNAME% - holds lastname</li>
			<li><font color="#FF0000">*</font>&nbsp;%NICKNAME% - holds nickname</li>
			<li><font color="#FF0000">*</font>&nbsp;%BDAY% - holds birthday</li>	
		</ul>
		</div>
		</td>
    </tr>	
	<?php } ?>
	<tr>
        <td align="left" valign="top" colspan="2">&nbsp;</td>
    </tr> 
	<tr>
		<td align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top"><?php if(isset($_GET["id"])) { ?><button name="gosave" onClick="return check();" type="submit" class="input">Save Settings</button>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?><button name="back" type="button" onClick="javascript: window.location.href='adminhome.php';" class="input">Back</button></td> 
    </tr> 
	
</table>
</form>
<script language="javascript" type="text/javascript">
function check()
{	
	if(document.f1.subject.value == "")
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
function gonext(a) {
window.location.href="mailsettings.php?id="+a;
}
</script>
<script language="JavaScript" type="text/javascript">	
var editor = CKEDITOR.replace('message');		
CKFinder.SetupCKEditor( editor, 'ckeditor/ckfinder/' ) ;
</script>
<?php include('includes/admin_footer.php'); ?>
                    
                    