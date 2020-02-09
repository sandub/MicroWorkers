<?php 
include('includes/admin_header.php');
if(isset($_POST["delete"]))
{
	$chk = $_POST["chk"];
	foreach($chk as $c){
	dbQuery("delete from `login_log` where `id`='".$c."'");
	$_SESSION["userdelete"]="The messages has been deleted successfully!";
	}
}

if(isset($_GET["id"]) && isset($_GET["ban"])) 
{	
	$ban = ($_GET["ban"]==0)?1:0;	
	mysql_query("update `user_registration` set `banned`='$ban' where `id`='".$_GET["id"]."'");	
	header("location: userlog.php?msd=success");
	exit();
} 

if(isset($_GET["order"])) 
{		
	$sql = "select * from `login_log` order by ".$_GET["order"];	
} 
else 
{
	$sql = "select * from `login_log` order by `fullname`";
}

$p = new Pager;
$limit = 100;
$start = $p->findStart($limit);
$count = dbNumRows(dbQuery($sql));
$pages = $p->findPages($count, $limit);
$result = dbQuery($sql." LIMIT ".$start.", ".$limit );
$pagelist = $p->pageList($_GET['page'], $pages);
?>
<div style="margin-bottom:10px;">
    <h1 style="text-transform:uppercase">Here is your all site user login details</h1>
    <img src="media/line.png" />
</div>
<div style="padding-bottom:5px;">
<table border="0" cellpadding="2" cellspacing="2" width="723">   
<?php if(isset($_GET["msd"]) && $_GET["msd"]=="success")  { ?> 
    <tr>
        <td align="center" valign="top" colspan="8" style="color:#666"><font color="#009933">The action has been successfully performed!</font></td>
    </tr>
<?php } ?>
<?php if(isset($_SESSION["userdelete"]) && $_SESSION["userdelete"]!="") { ?>
    <tr>
        <td align="center" valign="top" colspan="8" style="color:#666"><font color="#009933">The action has been successfully performed!</font></td>
    </tr>
<?php unset($_SESSION["userdelete"]); } ?>
<form name="ff" id="ff" action="userlog.php" method="post" onsubmit="return godelete();">
	<tr>
        <td align="left" valign="top" colspan="8" style="color:#666">Here is your all site user login details.</td>
    </tr>
    <tr>     
        <td style="background-color:#B7CBCF; padding:3px;" width="5" align="left" valign="top"><input type="checkbox" name="chkall" onclick='checkedAll(ff);' /></td> 
		<td width="20%" align="left" valign="top" class="labels"><strong><a href="<?php if($_SERVER['QUERY_STRING']=="") { echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']."?order=fullname"; } elseif(isset($_GET["page"]) && !isset($_GET["order"])) { echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']."&order=fullname"; } elseif(isset($_GET["page"]) && isset($_GET["order"])) { echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['SCRIPT_NAME']."?page=".$_GET["page"]."&order=fullname"; } ?>">FullName</a></strong></td>    
        <td width="20%" align="left" valign="top" class="labels"><strong><a href="<?php if($_SERVER['QUERY_STRING']=="") { echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']."?order=email"; } elseif(isset($_GET["page"]) && !isset($_GET["order"])) { echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']."&order=email"; } elseif(isset($_GET["page"]) && isset($_GET["order"])) { echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['SCRIPT_NAME']."?page=".$_GET["page"]."&order=email"; } ?>">Email</a></strong></td> 		
        <td width="20%" align="left" valign="top" class="labels"><strong><a href="<?php if($_SERVER['QUERY_STRING']=="") { echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']."?order=country"; } elseif(isset($_GET["page"]) && !isset($_GET["order"])) { echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']."&order=country"; } elseif(isset($_GET["page"]) && isset($_GET["order"])) { echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['SCRIPT_NAME']."?page=".$_GET["page"]."&order=country"; } ?>">Country</a></strong></td>
		<td width="20%" align="left" valign="top" class="labels"><strong>IP Address</strong></td>
		<td width="20%" align="left" valign="top" class="labels"><strong>Login Time</strong></td>		
		<td width="20%" align="left" valign="top" class="labels"><strong>Status</strong></td>
        <td width="20%" align="left" valign="top" class="labels"><strong>Action</strong></td>                
    </tr>
    <?php	
	if(dbNumRows($result)>0)
	{
	$count=1;
		$ul=0;
		while($t = dbFetchArray($result,MYSQL_BOTH))
		{		
	?>	
	<tr id="tr<?php echo $ul; ?>"> 
	    <td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><input type="checkbox" name="chk[]" id="chk<?php echo $ul ?>" value="<?php echo $t["id"]; ?>" onclick="goselect(<?php echo $ul;?>);" /></td>
	    <td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php echo stripslashes($t["fullname"]); ?></td>     	
        <td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php echo $t["email"]; ?></td>     
		<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php echo stripslashes($t["country"]); ?></td>		
		<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php echo stripslashes($t["IP"]); ?></td>	
		<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php echo $t["lastlogin"]; ?></td>		
		<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>">
		<?php 
		$euser=mysql_fetch_array(mysql_query("select * from `user_registration` where `email`='".$t["email"]."'"));
		if($euser["status"]==1) { echo "Active"; } else { echo "Inactive"; } ?>
		</td>    
		<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>">
		<select name="banned" id="banned" onchange="javascript: window.location.href='userlog.php?id=<?php echo $euser["id"]; ?>&ban=<?php echo $euser["banned"]; ?>'"><option value="1" <?php if($euser["banned"]==1) { echo 'selected="selected"'; } ?> >NOT BANNED</option><option value="0" <?php if($euser["banned"]==0) { echo 'selected="selected"'; } ?> >BANNED</option></select>
		</td> 
	</tr>
    <?php
	$ul=$ul+1;
		}
	}
	else
	{
	$count=0;
	?>
	<tr>
    	<td valign="top" colspan="8" align="center" class="labels">Sorry no records here!</td>
	</tr>
	<?php
	}
	?>  
	<?php if($count==1) { ?>                         
    <tr>
    	<td valign="top" colspan="8" class="labels"><div style=" width: 723px; float:left;"><div style="width:70px; float:left; text-align:left;"><button class="input" style="font-size:9px" type="submit" name="delete">DELETE</button></div><div style="width:653px; float:left; text-align:center;"><?php echo $pagelist; ?></div></div></td>
	</tr>
<?php } ?>
</form>	
</table>
<script language="javascript" type="text/javascript">

<?php if($ul>0) { ?>
var col='';
checked=false;
var myCars=new Array();
function checkedAll (ff) {
	var aa= document.getElementById('ff');
			 
	 if (checked == false)
		  {		  
		   for(var j=0;j < <?php echo $ul ?>; j++) {		  
		  myCars[j]=document.getElementById("tr"+j).bgColor;		  
		  document.getElementById("tr"+j).style.backgroundColor='#669999';
		  }
		   checked = true
		  }
		else
		  {		   
		  checked = false
		  for(var k=0;k < <?php echo $ul ?>; k++) {		  
		  document.getElementById("tr"+k).style.backgroundColor= myCars[k];
		  }
		  }
		for (var i = 0; i < aa.elements.length; i++) 
		{	 
		 aa.elements[i].checked = checked;			
		}		
	  }
	 function godelete()
	 {
	 	var yes = 0;
		for(var i=0;i<<?php echo $ul ?>;i++) {
		if(document.getElementById('chk'+i).checked) {
		  yes = 1; 
		  break;
		  } else { yes = 0; }
		 }
		 if(yes==1)
		 {
		 if(confirm('Are sure want to delete those user logs?')) { return true; } else {
		 return false; }
		 }
		 else {
		 alert("Please select any of the user logs to delete.");
		 return false;
		 }
	 }
function goselect(a) {
if(document.getElementById('chk'+a).checked)
{
col=document.getElementById("tr"+a).bgColor;		  
document.getElementById("tr"+a).style.backgroundColor='#669999';
}
else
{
document.getElementById("tr"+a).style.backgroundColor=col;
}
}
<?php } ?>
</script>
<?php include('includes/admin_footer.php'); ?>
                    
                    