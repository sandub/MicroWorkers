<?php 
include('includes/admin_header.php'); 
$id=$_GET["id"];
$normal_price=$EstimatedCampaigncost;

$p = dbFetchArray(dbQuery("select * from `jobs` where `id`='$id'"),MYSQL_BOTH);
$highlight_status=stripslashes($p["highlighted"]);

if(isset($_POST["gosave"])) {	
	$id = $_GET["id"];		
	$wd2= addslashes($_POST["wd2"]);
	$time= addslashes($_POST["time"]);
	$price= addslashes($_POST["price"]);
	$countrycode= addslashes($_POST["countrycode"]);
	$expected= addslashes($_POST["expected"]);
	$proof= addslashes($_POST["proof"]);
	$status= addslashes($_POST["status"]);
	
	$Title=$_POST["Title"];
		
	if(isset($_POST["bold"])!="" && isset($_POST["highlighted"])=="")
	{
	$extra=$normal_price+(0.50);
	}
	elseif(isset($_POST["highlighted"])!="" && isset($_POST["bold"])=="")
	{
	$extra=$normal_price+(1.00);
	}
	elseif(isset($_POST["bold"])!="" && isset($_POST["highlighted"])!="")
	{
	$extra=$normal_price+(0.50+1.00);
	}
	else
	{
	$extra=$normal_price;
	}
	
	if(isset($_POST["highlighted"])!="")
	{
	$highlighted=1;
	}
	else
	{
	$highlighted=0;
	}
	
	if(isset($_POST["bold"])!="")
	{
	$bold=1;
	}
	else
	{
	$bold=0;
	}
	
	
		if($countrycode=='USA') {
			if(isset($_POST["Targeting_CA"])) {
			$Targeting_CA='1';
			} else {
			$Targeting_CA='';
			}
			if(isset($_POST["Targeting_UK"])) {
			$Targeting_UK='1';
			} else {
			$Targeting_UK='';
			}
			if(isset($_POST["Targeting_AU"])) {
			$Targeting_AU='1';
			} else {
			$Targeting_AU='';
			}
		} else {
			$Targeting_CA='';
			$Targeting_UK='';
			$Targeting_AU='';
		} 
	
		
	$sql=dbQuery("update `jobs` set `title`='$Title',`wd2`='$wd2',`time`='$time',`price`='$price',`extra_price`='$extra',`country`='$countrycode',`CA`='$Targeting_CA',`UK`='$Targeting_UK',`AU`='$Targeting_AU',`expected`='$expected',`proof`='$proof',`status`='$status',`highlighted`='$highlighted',`bold`='$bold' where `id`='$id';");
			
	
	if($id>0)
	{
		header("location: managejobs.php?msd=success");
		exit();
	}
	else
	{
		header("location: editjobs.php?id=".$id."&action=edit");
		exit();
	}	
}	
?>
<script language="javascript" src="../validator/function.js"></script>
<!--<script>
function addhighlightedwork(val)
{
	if(val.checked==true)
	{
	//alert(val);

    document.getElementById("highlight").style.display="block";
    document.getElementById("highlight").style.visibility="visible";
	document.getElementById("highltd1").style.display="none";
    document.getElementById("highltd1").style.visibility="hidden";
	}
	else
	{
	//alert("jghj");
	document.getElementById("highlight").style.display="none";
    document.getElementById("highlight").style.visibility="hidden";		
	document.getElementById("highltd1").style.display="block";
    document.getElementById("highltd1").style.visibility="visible";
	}
}
</script>-->
<div style="margin-bottom:10px;">
    <h1 style="text-transform:uppercase">Please edit a Jobs&nbsp;&nbsp;</h1>
    <img src="media/line.png" />
</div>
	
<div style="padding-bottom:5px;">
<form name="ff" action="editjobs.php?id=<?php echo $id; ?>" id="ff" method="post" enctype="multipart/form-data" >
<table border="0" cellpadding="2" cellspacing="2" width="100%">    
    <tr>
        <td align="left" valign="top" colspan="2" style="color:#666">Please fillup all the fields.</td>
    </tr>	
    <tr>
        <td align="left" valign="top" class="labels"><label for="title">Title:</label></td>
        <td align="left" valign="top" class="rows">
		<span style="font-size:11px; font-weight:bold;"><!--<input name="highlighted_work" type="checkbox" value="true" <? if($highlight_status==1) { echo "checked";?> disabled="disabled" <? }?> onClick="addhighlightedwork(this)" />--> &nbsp;Bold or Highlight Jobs For An Extra Cost</span><BR>
	&nbsp;Title of the campaign in details</span><BR><BR>
	<span style="padding-right:110px;">
	<input type="checkbox" id="bold" name="bold" value="1" <? if($p["bold"]==1) { echo "checked";}?>>&nbsp;Bold&nbsp;&nbsp;
	<input type="checkbox" id="highlighted" name="highlighted" value="1" <? if($p["highlighted"]==1) { echo "checked";}?>>&nbsp;Highlighted</span>
	<br><br>
	<textarea name="Title" id="Title" cols="70" rows="4"><?=$p["title"];?></textarea><BR>
	
	</td>
    </tr>
	<tr>
        <td align="left" valign="top" class="labels"><label for="wd1">Available Positions:</label></td>
        <td align="left" valign="top" class="rows"><input type="text" name="wd2" id="wd2" value="<?php echo stripslashes($p["wd2"]); ?>" class="input" style="width:40px;" /></td>
    </tr>	 
    <tr>
        <td align="left" valign="top" class="labels"><label for="time">Required Time:</label></td>
        <td align="left" valign="top" class="rows"><input type="text" name="time" id="time" class="input" value="<?php echo stripslashes($p["time"]); ?>" style="width:40px;" />&nbsp;min</td>
    </tr>	
	<tr>
        <td align="left" valign="top" class="labels"><label for="price">Price:</label></td>
        <td align="left" valign="top" class="rows">$<input type="text" name="price" id="price" class="input" value="<?php echo stripslashes($p["price"]); ?>" style="width:40px;" /></td>
    </tr>
	<tr>
        <td align="left" valign="top" class="labels"><label for="countrycode">Country:</label></td>
        <td align="left" valign="top" class="rows"><?php $countrycode=$p["country"]; ?><select size="1" name="countrycode" id="countrycode" onchange="javascript: if(this.value=='USA') { document.getElementById('us').style.display='block'; } else { document.getElementById('us').style.display='none'; }" ><option value="INT" <?php if($countrycode=='INT') { echo 'selected="selected"'; } ?> >International</option>
<option value="USA" <?php if($countrycode=='USA') { echo 'selected="selected"'; } ?> >USA</option>
</select>
				<span style="font-size: 11px; <?php if($countrycode=='USA') { echo 'display:block;'; } else { echo 'display:none;'; } ?>" id="us"><br />Also allow: 
				<input type="checkbox" id="Targeting_CA" name="Targeting_CA" <?php if($p["CA"]=='1') { echo 'checked="checked"'; } ?> value="1">&nbsp;Canada
				&nbsp;<input type="checkbox" id="Targeting_UK" name="Targeting_UK" <?php if($p["UK"]=='1') { echo 'checked="checked"'; } ?> value="1">&nbsp;United Kingdom
				&nbsp;<input type="checkbox" id="Targeting_AU" name="Targeting_AU" <?php if($p["AU"]=='1') { echo 'checked="checked"'; } ?>  value="1">&nbsp;Australia</span></td>        
    </tr>	
	<tr>
        <td align="left" valign="top" class="labels"><label for="expected">Expected:</label></td>
        <td align="left" valign="top" class="rows"><textarea name="expected" id="expected" cols="40" rows="4"><?php echo stripslashes($p["expected"]); ?></textarea></td>        
    </tr>
	<tr>
        <td align="left" valign="top" class="labels"><label for="proof">Proof:</label></td>
        <td align="left" valign="top" class="rows"><textarea name="proof" id="proof" cols="40" rows="4"><?php echo stripslashes($p["proof"]); ?></textarea></td>        
    </tr>	
	<tr>
        <td align="left" valign="top" class="labels"><label for="status">Status:</label></td>
        <td align="left" valign="top" class="rows"><select id="status" name="status" style="width:80px;"><option value="1" <?php if($p["status"]=="1") { ?> selected="selected" <?php } ?> >Active</option><option value="0" <?php if($p["status"]=="0") { ?> selected="selected" <?php } ?> >Pending</option><option value="3" <?php if($p["status"]=="3") { ?> selected="selected" <?php } ?> >Finished</option><option value="1" <?php if($p["status"]=="1") { ?> selected="selected" <?php } ?> >Running</option><option value="2" <?php if($p["status"]=="2") { ?> selected="selected" <?php } ?> >Paused</option><option value="4" <?php if($p["status"]=="4") { ?> selected="selected" <?php } ?> >Blocked</option><option value="5" <?php if($p["status"]=="5") { ?> selected="selected" <?php } ?> >Hide Job</option></select></td>        
    </tr>	
	<tr>
        <td align="left" valign="top" colspan="2">&nbsp;</td>
    </tr> 
	<tr>
		<td align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top"><button name="gosave" type="submit" class="input">Update Job</button>&nbsp;&nbsp;&nbsp;&nbsp;<button name="back" type="button" onClick="javascript: window.location='managejobs.php';" class="input">Back</button></td> 
    </tr> 
</table>
</form>
<script language="javascript" type="text/javascript">
function check()
{
	if(document.getElementById('title').value == "")
	{
       alert('Please Give Job Title.');
	   document.getElementById('title').focus();
	   return false;
	}
	if(document.getElementById('wd2').value == "")
	{
       alert('Please Give Available Positions.');
	   document.getElementById('wd2').focus();
	   return false;
	}
	if(document.getElementById('time').value == "")
	{
       alert('Please Give Required Time.');
	   document.getElementById('time').focus();
	   return false;
	}
	if(document.getElementById('price').value == "")
	{
       alert('Please Give Price.');
	   document.getElementById('price').focus();
	   return false;
	}
	if(document.getElementById('countrycode').value == "") 
	{
	   alert('Please Give Country.');
	   document.getElementById('countrycode').focus();
	   return false;	
	}
	if(document.getElementById('status').value == "") 
	{
	   alert('Please Give Status.');
	   document.getElementById('status').focus();
	   return false;	
	}	
}
</script>
<script language="JavaScript" type="text/javascript">	
var editor = CKEDITOR.replace('expected');		
CKFinder.SetupCKEditor( editor, 'ckeditor/ckfinder/' ) ;
</script>
<script language="JavaScript" type="text/javascript">	
var editor = CKEDITOR.replace('proof');		
CKFinder.SetupCKEditor( editor, 'ckeditor/ckfinder/' ) ;
</script>
<!--<script language="JavaScript" type="text/javascript">	
var editor = CKEDITOR.replace('name');		
CKFinder.SetupCKEditor( editor, 'ckeditor/ckfinder/' ) ;
</script>-->
<?php include('includes/admin_footer.php'); ?>
                    
                    