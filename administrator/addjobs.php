<?php 
include('includes/admin_header.php');
include('../settings/config.php');
$normal_price=$EstimatedCampaigncost;

if(isset($_POST["gosave"])) {	

	
	$wd2= addslashes($_POST["wd2"]);
	$time= addslashes($_POST["time"]);
	$price= addslashes($_POST["price"]);
	$expected= addslashes($_POST["expected"]);
	$proof= addslashes($_POST["proof"]);
	$status= addslashes($_POST["status"]);
	$customer_id=$_REQUEST['id'];
	
	$Title=$_POST["Title"];
		
	if(isset($_POST["bold"])!="" && isset($_POST["highlighted"])=="")
	{
	$extra=$normal_price+$Boldjobcost;
	}
	elseif(isset($_POST["highlighted"])!="" && isset($_POST["bold"])=="")
	{
	$extra=$normal_price+$Highlightedjobcost;
	}
	elseif(isset($_POST["bold"])!="" && isset($_POST["highlighted"])!="")
	{
	$extra=$normal_price+($Boldjobcost+$Highlightedjobcost);
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
	
	if(isset($_POST["Targeting"]))
	 {
	$Targeting=$_POST["Targeting"];
		if($Targeting=='USA') 
		{
			if(isset($_POST["Targeting_CA"])) 
			{
			$Targeting_CA='1';
			} 
			else 
			{
			$Targeting_CA='';
			}
			if(isset($_POST["Targeting_UK"])) 
			{
			$Targeting_UK='1';
			} 
			else 
			{
			$Targeting_UK='';
			}
			if(isset($_POST["Targeting_AU"])) 
			{
			$Targeting_AU='1';
			}
			else 
			{
			$Targeting_AU='';
			}
		}
		 else 
		 {
			$Targeting_CA='';
			$Targeting_UK='';
			$Targeting_AU='';
		 } 		
	}
	
	
	$p = dbFetchArray(dbQuery("select * from `user_registration` where `id`='$customer_id'"),MYSQL_BOTH);
	$email=stripslashes($p["email"]);
					
	$sql=dbQuery("INSERT INTO `jobs`(`user_id`,`email`,`title`,`wd1`,`wd2`,`time`,`price`,`extra_price`,`country`,`CA`,`UK`,`AU`,`expected`,`proof`,`started`,`status`,`highlighted`,`bold`) VALUES('$customer_id','$email','$Title','0','$wd2','$time','$price','$extra','$Targeting','$Targeting_CA','$Targeting_UK','$Targeting_AU','$expected','$proof','".$totaldate."','0','$highlighted','$bold');");
	
	$id = dbInsertId();
	
	$usSQL=mysql_query("select * from `user_registration` where `status`='1'");
	while($usRES=mysql_fetch_array($usSQL)) {
		if($usRES["jobmailUSA"]=='1' && $Targeting=='USA') {
		
		$to = $usRES["email"];
		//$from="";
		$sub = "".stripslashes($usRES["fullname"])." a new Campaign has been Posted on ".$SiteName;
			
		//echo $txt;
		//echo $headers = "From: $email" . "\r\n";
		$headers  = 'Hello ' .stripslashes($usRES["fullname"]).'';
		$headers .= '  A New USA Campaign "' .$Title. '" Has Started On '.$SiteName;
		$headers .= ' The Campaign pays: $' .$price. ' Per Task. ';
		$headers .= ' ';
		$headers .= "$from" . '';		
		
		$mail = new PHPMailer;
		$mail->FromName = $fromName;
		$mail->From    = $from;
		$mail->Subject = $sub;
		$mail->Body    = stripslashes($headers);
		$mail->AltBody = stripslashes($headers);					
		$mail->IsHTML(true);	
		$mail->AddAddress($to,$usRES["fullname"]);
		$mail->Send();
		
		}
		if($usRES["jobmailINT"]=='1' && $Targeting=='INT') {
		
		$to = $usRES["email"];
		//$from="";
		$sub = "".stripslashes($usRES["fullname"])." a new Campaign has been Posted on ".$SiteName;
			
		//echo $txt;
		//echo $headers = "From: $email" . "\r\n";
		$headers  = 'Hello ' .stripslashes($usRES["fullname"]).'';
		$headers .= ' A New INT Campaign "' .$Title. '"  Has Started on '.$SiteName;
		$headers .= ' The Campaign pays: $' .$price. ' Per Task. ';
		$headers .= ' ';
		$headers .= "$from" . '';		
		
		$mail = new PHPMailer;
		$mail->FromName = $fromName;
		$mail->From    = $from;
		$mail->Subject = $sub;
		$mail->Body    = stripslashes($headers);
		$mail->AltBody = stripslashes($headers);					
		$mail->IsHTML(true);	
		$mail->AddAddress($to,$usRES["fullname"]);
		$mail->Send();
		
		}
	}
	
		
	if($id>0)
	{
	$select=mysql_fetch_array(mysql_query("select * from `jobs` where `id`='$id'"));
	$user_id=$select['user_id'];
	
	$select_r=mysql_fetch_array(mysql_query("select * from `user_registration` where `id`='$user_id'"));
	$auto_select=$select_r['auto_select'];
		if($auto_select==1)
		{
		$update=dbQuery("update `jobs` set `status`='3' where `id`='$id';");
		}
	}
	
	if($id>0)
	{
		header("location: managejobs.php?msd=success");
		exit();
	}
	else
	{
		header("location: addjobs.php?id=".$id."&action=add");
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
    <h1 style="text-transform:uppercase">Please Add a Jobs&nbsp;&nbsp;</h1>
    <img src="media/line.png" />
</div>
	
<div style="padding-bottom:5px;">
<form name="ff" action="addjobs.php" id="ff" method="post" enctype="multipart/form-data" >
<table border="0" cellpadding="2" cellspacing="2" width="100%">    
    <tr>
        <td align="left" valign="top" colspan="2" style="color:#666">Please fillup all the fields.</td>
    </tr>	
    <tr>
      <td align="left" valign="top" class="labels">Customer Name: </td>
      <td align="left" valign="top" class="rows">
	  	<select size="1" name="id" id="id">
		<?
		$customer=dbQuery("select * from `user_registration`");
		while($res=dbFetchArray($customer,MYSQL_BOTH))
		{
		$customer_id=stripslashes($res["id"]);
		$customer_name=stripslashes($res["fullname"]);
		?>
	  	<option value="<?=$customer_id;?>"><?=$customer_name;?></option>
		<?
		}
		?>
	  	</select>
	 </td>
    </tr>
    <tr>
        <td align="left" valign="top" class="labels"><label for="title">Title:</label></td>
        <td align="left" valign="top" class="rows">
		<span style="font-size:11px; font-weight:bold;"><!--<input name="highlighted_work" type="checkbox" value="true" onClick="addhighlightedwork(this)" />--> &nbsp;Bold or Highlight Jobs For An Extra Cost<BR>
		&nbsp;Title of the campaign in details</span><BR><BR>
			<span style="padding-right:110px;">
			<input type="checkbox" id="bold" name="bold" value="1">&nbsp;Bold&nbsp;&nbsp;
			<input type="checkbox" id="highlighted" name="highlighted" value="1">&nbsp;Highlighted</span>
			<br><br>
			<!--<span id="highltd1" style="display:block;visibility:visible"><textarea name="Title" id="Title" cols="70" rows="4"></textarea></span>-->
			
			<textarea name="Title" id="Title" cols="40" rows="4"></textarea>
			
			<!--<span id="highlight" style="display:none;visibility:hidden">
			<p align="center"><span style="font-size:11px; font-weight:bold;">Estimated Campaign Cost : <?=$extra_price;?></span></p><BR>
			<textarea name="name" id="name" cols="40" rows="4"></textarea><BR></span>-->
			</td>
    </tr>
	<tr>
        <td align="left" valign="top" class="labels"><label for="wd1">Available Positions:</label></td>
        <td align="left" valign="top" class="rows"><input type="text" name="wd2" id="wd2" class="input" style="width:40px;" /></td>
    </tr>	 
    <tr>
        <td align="left" valign="top" class="labels"><label for="time">Required Time:</label></td>
        <td align="left" valign="top" class="rows"><input type="text" name="time" id="time" class="input" style="width:40px;" />&nbsp;min</td>
    </tr>	
	<tr>
        <td align="left" valign="top" class="labels"><label for="price">Price:</label></td>
        <td align="left" valign="top" class="rows">$<input type="text" name="price" id="price" class="input" style="width:40px;" /></td>
    </tr>
	<tr>
        <td align="left" valign="middle" class="labels"><label for="countrycode">Country:</label></td>
		<td align="left" valign="top" class="rows">
			<table width="448" border="0" cellpadding="5" cellspacing="0" bordercolor="#111111" style="border-collapse: collapse">
			  <tr id=usa name=usa>
				<td width="21" align="left"  valign="top" style="padding-left:5px;">
				  <input type="radio" value="USA" name="Targeting" id="radious" CHECKED></td>
				<td width="44" align="center" valign="top">
				<img border="0" src="../images/United-States-Flag-32x32.gif" width="32" height="26"></td>
				<td width="353" valign="top"><b>USA Workers</b> - Starting from <b>
				$0.35</b> per task<br>
				<span style="font-size: 11px">Also allow: 
				<input type="checkbox" id="Targeting_CA" name="Targeting_CA" value="1"> Canada&nbsp;&nbsp;
				<input type="checkbox" id="Targeting_UK" name="Targeting_UK" value="1"> United Kingdom&nbsp;&nbsp;
				<input type="checkbox" id="Targeting_AU" name="Targeting_AU" value="1"> Australia</span>&nbsp;</td>
			  </tr>
			  <tr id=int name=int>
			    <td align="left" style="padding-left:5px;">&nbsp;</td>
			    <td align="center">&nbsp;</td>
			    <td>&nbsp;</td>
			    </tr>
			  <tr id=int name=int>
				<td align="left" style="padding-left:5px;">
				  <input type="radio"  checked  value="INT"  id=radioint name="Targeting" ></td>
				<td align="center">
				<p align="center">
				<img border="0" src="../images/int-flag.gif" width="32" height="23"></td>
				<td><B>International Workers</B><BR>
				Lots of Workers - Work done faster<BR>
				Starting from <b>$0.10</b> per task</td>
			  </tr>
		  </table>
		</td> 
    </tr>	
	<tr>
        <td align="left" valign="top" class="labels"><label for="expected">Expected:</label></td>
        <td align="left" valign="top" class="rows"><textarea name="expected" id="expected" cols="40" rows="4"></textarea></td>        
    </tr>
	<tr>
        <td align="left" valign="top" class="labels"><label for="proof">Proof:</label></td>
        <td align="left" valign="top" class="rows"><textarea name="proof" id="proof" cols="40" rows="4"></textarea></td>        
    </tr>	
	<tr>
        <td align="left" valign="top" colspan="2">&nbsp;</td>
    </tr> 
	<tr>
		<td align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top"><button name="gosave" type="submit" class="input">Add Job</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button name="back" type="button" onClick="javascript: window.location='managejobs.php';" class="input">Back</button></td> 
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
                    
                    
