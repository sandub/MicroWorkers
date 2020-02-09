<?php 
include('includes/admin_header.php'); 
if(isset($_POST["gosearch"])) { 
$_SESSION["search"] = $_POST["search"];
$_SESSION["findme"] = $_POST["findme"];
	if($_SESSION["findme"]!="") {	
		if(isset($_GET["order"])) 
		{		
			$_SESSION["sql"] = "select * from `user_registration` where `".$_SESSION["search"]."` like '%".$_SESSION["findme"]."%' order by ".$_GET["order"];		
		
		} 
		else 
		{
			$_SESSION["sql"] = "select * from `user_registration` where `".$_SESSION["search"]."` like '%".$_SESSION["findme"]."%' order by `fullname`";
		}	 
	} else {
		if(isset($_GET["order"])) 
	{		
		$_SESSION["sql"] = "select * from `user_registration` order by ".$_GET["order"];
	} 
	else 
	{
		$_SESSION["sql"] = "select * from `user_registration` order by `".$_SESSION["search"]."`";
	}
  	}
}
	

$p = new Pager;
$limit = 100;
$start = $p->findStart($limit);
$count = dbNumRows(dbQuery($_SESSION["sql"]));
$pages = $p->findPages($count, $limit);
$result = dbQuery($_SESSION["sql"]." LIMIT ".$start.", ".$limit );
$pagelist = $p->pageList($_GET['page'], $pages);
?>
<div style="margin-bottom:10px;">
    <h1 style="text-transform:uppercase">Here is your all site user details</h1>
    <img src="media/line.png" />
</div>
<div style="padding-bottom:5px;">
<table border="0" cellpadding="2" cellspacing="2" width="100%">   
<?php if(isset($_GET["msd"]) && $_GET["msd"]=="success") { ?> 
    <tr>
        <td align="center" valign="top" colspan="8" style="color:#666"><font color="#009933">The action has been successfully performed!</font></td>
    </tr>
<?php } ?>
<form name="ff" action="usersearch.php" method="post">
    <tr>
		<td align="center" valign="top" colspan="8" style="color:#666">
		<table cellpadding="2" cellspacing="2" border="0" width="100%"><tr>     
			<td align="right" valign="middle" class="labels"><strong>Search In : </strong></td> 
			<td align="left" valign="top" class="labels">
			<select name="search">
			<option value="fullname">FULL NAME</option>
			<option value="email">EMAIL</option>
			<option value="country">COUNTRY</option>
			</select>
			</td>
			<td align="left" valign="middle" class="labels"><strong><input type="text" class="input" name="findme" value="" /></strong></td>
			<td align="left" valign="top" colspan="5" class="labels"><strong><input type="submit" class="input" name="gosearch" value="Search" /></strong></td>             
		</tr></table>
		</td>
	</tr>
</form>
	<tr>
        <td align="left" valign="top" colspan="8" style="color:#666">Here is your all site user details.</td>
    </tr>
    <tr>   
	    <td style="background-color:#B7CBCF; padding:3px;" width="7" align="left" valign="top">&nbsp;</td>    
	    <td width="230" align="left" valign="top" class="labels1"><strong><a href="<?php if($_SERVER['QUERY_STRING']=="") { echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']."?order=fullname"; } elseif(isset($_GET["page"]) && !isset($_GET["order"])) { echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']."&order=fullname"; } elseif(isset($_GET["page"]) && isset($_GET["order"])) { echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['SCRIPT_NAME']."?page=".$_GET["page"]."&order=fullname"; } ?>">Full Name</a></strong></td> 
		<td width="175" align="left" valign="top" class="labels1"><strong><a href="<?php if($_SERVER['QUERY_STRING']=="") { echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']."?order=email"; } elseif(isset($_GET["page"]) && !isset($_GET["order"])) { echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']."&order=email"; } elseif(isset($_GET["page"]) && isset($_GET["order"])) { echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['SCRIPT_NAME']."?page=".$_GET["page"]."&order=email"; } ?>">Email</a></strong></td> 		
        <td width="136" align="left" valign="top" class="labels1"><strong><a href="<?php if($_SERVER['QUERY_STRING']=="") { echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']."?order=country"; } elseif(isset($_GET["page"]) && !isset($_GET["order"])) { echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']."&order=country"; } elseif(isset($_GET["page"]) && isset($_GET["order"])) { echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['SCRIPT_NAME']."?page=".$_GET["page"]."&order=country"; } ?>">Country</a></strong></td>
		<td width="44" align="left" valign="top" class="labels1"><strong>Status</strong></td>
		<td width="119" align="left" valign="top" class="labels1"><strong>Referrer</strong></td>
		<td width="70" align="center" valign="top" class="labels1"><strong>View Fees</strong></td>	
        <td width="127" align="center" valign="top" class="labels1"><strong>Action</strong></td>                
    </tr>
    <?php	
	if(dbNumRows($result)>0)
	{
		$ul=0;
		while($t = dbFetchArray($result,MYSQL_BOTH))
		{		
	?>	
	<tr> 
		<td style="background-color:#B7CBCF; padding:3px;" width="7" align="left" valign="top">&nbsp;</td>
	    <td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php echo stripslashes($t["fullname"]); ?></td>     	
        <td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php echo stripslashes($t["email"]); ?></td>     
		<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php echo stripslashes($t["country"]); ?></td>
		<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php if($t["status"]==1) { echo "Active"; } else { echo "Inactive"; } ?></td>  
		<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php echo $t["referrer"]; ?></td> 
		<td align="center" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><a href="managemoney.php?id=<?=base64_encode($t["id"]);?>" class="style1"><img src="images/bView.png" width="16" height="16" border="0"></a></td>
		<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><button class="input" style="font-size:9px" onClick="goedit('<?php echo $t["id"]; ?>')" name="edit">EDIT</button>&nbsp;&nbsp;<button class="input" style="font-size:9px" onClick="godelete('<?php echo $t["id"]; ?>')" name="delete">DELETE</button></td> 
	</tr>
    <?php
	$ul=$ul+1;
		}
	}
	else
	{
	?>
	<tr>
    	<td valign="top" colspan="8" align="center" class="labels">Sorry no records here!</td>
	</tr>
	<?php
	}
	?>                           
    <tr>
    	<td valign="top" colspan="8" align="center" class="labels"><?php echo $pagelist; ?></td>
	</tr>	
</table>
<script language="javascript" type="text/javascript">
function goedit(a){
	window.location.href="edituser.php?uid="+a+"&action=edit";
}
function godelete(a){
	if(confirm("Are you sure want to delete this user?")==true)
	window.location.href="edituser.php?uid="+a+"&action=delete";
}
</script>
<?php include('includes/admin_footer.php'); ?>
                    
                    