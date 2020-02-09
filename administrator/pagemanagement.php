<?php 
include('includes/admin_header.php');
if(isset($_POST["gosave"]))
{
$pid = $_GET["pid"];
$content = addslashes($_POST['content']);
$title = addslashes( $_POST['title'] );
dbQuery("update `cms` set `ptitle`='$title', `pcontent`='$content' where `pid`='$pid'");
$_SESSION["msd"]="Your record has been successfully saved";
}
?>

<div style="margin-bottom:10px;">
    <h1 style="text-transform:uppercase">Please modify a Page&nbsp;&nbsp;<?php if(isset($_SESSION["msd"]) && $_SESSION["msd"]!="") { ?><font color="#009933"><?php echo $_SESSION["msd"]; unset($_SESSION["msd"]); ?></font><?php } ?></h1>
    <img src="media/line.png" />
</div>
<div style="padding-bottom:5px;">
<form name="f1" action="pagemanagement.php<?php if(isset($_GET["pid"]) && $_GET["pid"]!="") { echo "?pid=".$_GET["pid"]; } ?>" method="post" enctype="multipart/form-data" onSubmit="return check();">
<table border="0" cellpadding="2" cellspacing="2" width="100%">    
    <tr>
        <td align="left" valign="top" colspan="2" style="color:#666">Please fillup all the fields.</td>
    </tr>   
    <tr>
        <td align="left" valign="top" class="labels"><label for="page">Page name:</label></td>
        <td align="left" valign="top" class="rows">
		<select name="page" onchange="openme()">
		<option value="">Select One</option>
		<?php
		$ret=dbQuery("select * from `cms` order by `pid`");
		while($rest=dbFetchArray($ret,MYSQL_BOTH)) {
		?>
		<option value="<?php echo $rest["pid"]; ?>" <?php if(isset($_GET["pid"]) && $_GET["pid"]==$rest["pid"]) { ?> selected="selected" <?php } ?> ><?php echo $rest["pname"]; ?></option>
		<?php
		}
		?>		
		</select>
		</td>        
    </tr>
	<?php
	if(isset($_GET["pid"]) && $_GET["pid"]!="") {
	$tyt = dbQuery("select * from `cms` where `pid`='".$_GET["pid"]."'");
	$t = dbFetchArray($tyt,MYSQL_BOTH);	
	?>
	<tr>
		<td align="left" valign="top" class="labels"><label for="title">Page Title:</label></td>
		<td align="left" valign="top" class="rows"><input type="text" name="title" value="<?php echo stripslashes($t["ptitle"]); ?>" id="title" /></td>
    </tr> 	
    <tr>
        <td align="left" valign="top" class="labels"><label for="catpicture">Edit Page:</label>&nbsp;</td>
        <td align="left" valign="top" class="rows"><textarea name="content" id="content" cols="40" rows="4"><?php echo stripslashes($t["pcontent"]); ?></textarea></td>
	</tr>		
	<tr>
        <td align="left" valign="top" colspan="2">&nbsp;</td>
    </tr> 
	<tr>
		<td align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top"><?php if(isset($_GET["pid"]) && $_GET["pid"]!="") { ?><button name="gosave" type="submit" class="input">Save This Page</button>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?><button name="back" type="button" onClick="javascript: window.location.href='adminhome.php';" class="input">Back</button></td> 
    </tr> 
	<?php } ?>
</table>
</form>
<script language="javascript" type="text/javascript">
function check()
{
if(document.f1.page.value == "")
	{
       alert('Please Choose page Name.');
	   document.f1.page.focus();
	   return false;
	}
}
function openme()
{
	window.location.href="pagemanagement.php?pid="+document.f1.page.value;	
}
</script>
<script language="JavaScript" type="text/javascript">	
var editor = CKEDITOR.replace('content');		
CKFinder.SetupCKEditor( editor, 'ckeditor/ckfinder/' ) ;
</script>
<?php include('includes/admin_footer.php'); ?>
                    
                    