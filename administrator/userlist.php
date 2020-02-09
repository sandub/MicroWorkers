<?php 
include('includes/admin_header.php'); 
if(isset($_POST["delete"]))
{
	$chk = $_POST["chk"];
	foreach($chk as $c){
	dbQuery("delete from `user_registration` where `id`='".$c."'");
	$_SESSION["userdelete"]="The messages has been deleted successfully!";
	}
}

if(isset($_GET["order"])) 
{		
	$sql = "select * from `user_registration` order by ".$_GET["order"];	
} 
else 
{
	$sql = "select * from `user_registration` order by `fullname`";
}

$p = new Pager;
$limit = 1000;
$start = $p->findStart($limit);
$count = dbNumRows(dbQuery($sql));
$pages = $p->findPages($count, $limit);
$result = dbQuery($sql." LIMIT ".$start.", ".$limit );
$pagelist = $p->pageList($_GET['page'], $pages);
?>
<script>
function update_auto(id)
	 {
	   var loc="update_auto.php?id="+id;
	   window.location.href=loc;
	 }
</script>
<div style="margin-bottom:10px;">
    <h1 style="text-transform:uppercase">Here is your all site user details</h1>
    <img src="media/line.png" />
</div>
<div style="padding-bottom:5px;">
<table border="0" cellpadding="2" cellspacing="2" width="723">   
<?php if(isset($_GET["msd"]) && $_GET["msd"]=="success")  { ?> 
    <tr>
        <td align="center" valign="top" colspan="7" style="color:#666"><font color="#009933">The action has been successfully performed!</font></td>
    </tr>
<?php } ?>
<?php if(isset($_SESSION["productdelete"]) && $_SESSION["productdelete"]!="") { ?>
    <tr>
        <td align="center" valign="top" colspan="7" style="color:#666"><font color="#009933">The action has been successfully performed!</font></td>
    </tr>
<?php unset($_SESSION["productdelete"]); } ?>
<form name="fff" action="usersearch.php" method="post">
    <tr>
	<td align="center" valign="top" colspan="7" style="color:#666">
	<table cellpadding="0" cellspacing="0" border="0" width="100%">
	 <tr>  
	 	<td align="center" valign="middle" class="labels"><strong>Total User : <?php echo $count; ?></strong></td>   
	    <td align="right" valign="middle" class="labels"><strong>Search In : </strong></td> 
        <td align="center" valign="top" class="labels">
		<select name="search">
		<option value="fullname">FULL NAME</option>
		<option value="email">EMAIL</option>
		<option value="current_balance">Balance</option>
                <option value="country">Country</option>
                <option value="AutoSelect">AutoSelect</option>
		</select>
		</td>
		<td align="center" valign="middle" class="labels"><strong><input type="text" class="input" name="findme" value="" /></strong></td>
        <td align="left" valign="top" class="labels"><strong><input type="submit" class="input" name="gosearch" value="Search" /></strong></td>             
       </tr>
	  </table>
	 </td>
	</tr>
</form>
<form name="ff" id="ff" action="userlist.php" method="post" onsubmit="return godelete();">

	<tr>
        <td align="left" valign="top" colspan="7" style="color:#666">Here is your all site user details.</td>
    </tr>
    <tr>     
        <td style="background-color:#B7CBCF; padding:3px;" width="25" align="left" valign="top"><input type="checkbox" name="chkall" onclick='checkedAll(ff);' /></td> 
		<td width="203" align="left" valign="top" class="labels"><strong><a href="<?php if($_SERVER['QUERY_STRING']=="") { echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']."?order=fullname"; } elseif(isset($_GET["page"]) && !isset($_GET["order"])) { echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']."&order=fullname"; } elseif(isset($_GET["page"]) && isset($_GET["order"])) { echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['SCRIPT_NAME']."?page=".$_GET["page"]."&order=fullname"; } ?>">FullName</a></strong></td>    
        <td width="127" align="left" valign="top" class="labels"><strong><a href="<?php if($_SERVER['QUERY_STRING']=="") { echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']."?order=email"; } elseif(isset($_GET["page"]) && !isset($_GET["order"])) { echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']."&order=email"; } elseif(isset($_GET["page"]) && isset($_GET["order"])) { echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['SCRIPT_NAME']."?page=".$_GET["page"]."&order=email"; } ?>">Email</a></strong></td> 		
        <td width="99" align="left" valign="top" class="labels"><strong><a href="<?php if($_SERVER['QUERY_STRING']=="") { echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']."?order=current_balance"; } elseif(isset($_GET["page"]) && !isset($_GET["order"])) { echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']."&order=current_balance"; } elseif(isset($_GET["page"]) && isset($_GET["order"])) { echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['SCRIPT_NAME']."?page=".$_GET["page"]."&order=current_balance"; } ?>">Balance</a></strong></td>

<td width="99" align="left" valign="top" class="labels"><strong><a href="<?php if($_SERVER['QUERY_STRING']=="") { echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']."?order=status"; } elseif(isset($_GET["page"]) && !isset($_GET["order"])) { echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']."&order=status"; } elseif(isset($_GET["page"]) && isset($_GET["order"])) { echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['SCRIPT_NAME']."?page=".$_GET["page"]."&order=status"; } ?>">Status</a></strong></td>	


		
		
<td width="99" align="left" valign="top" class="labels"><strong><a href="<?php if($_SERVER['QUERY_STRING']=="") { echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']."?order=country"; } elseif(isset($_GET["page"]) && !isset($_GET["order"])) { echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']."&order=country"; } elseif(isset($_GET["page"]) && isset($_GET["order"])) { echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['SCRIPT_NAME']."?page=".$_GET["page"]."&order=country"; } ?>">Country</a></strong></td>

<!--<td width="99" align="left" valign="top" class="labels"><strong><a href="<?php if($_SERVER['QUERY_STRING']=="") { echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']."?order=auto_select"; } elseif(isset($_GET["page"]) && !isset($_GET["order"])) { echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']."&order=auto_select"; } elseif(isset($_GET["page"]) && isset($_GET["order"])) { echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['SCRIPT_NAME']."?page=".$_GET["page"]."&order=auto_select"; } ?>">Auto Select</a></strong></td>-->

        <td width="44" align="center" valign="top" class="labels"><strong>Action</strong></td>             
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
		<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php echo stripslashes($t["current_balance"]); ?></td>		
		<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php if($t["status"]==1) { echo "Active"; } else { echo "Inactive"; } ?></td>
		<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php echo stripslashes($t["country"]); ?></td>
		
		<!--<td align="center" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php if($t['auto_select']=="") print "Inactive";if($t['auto_select']=="1") print "Active";if($t['auto_select']=="0") print "Inactive";?>
	<input type="checkbox" name="checkbox" value="true"  onclick="update_auto('<?php echo $t["id"];?>')" <?php if($t["auto_select"]=="1") echo "checked";?>/></td>-->
	
		<td align="center" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><input type="button" name="edit" class="input" style="font-size:9px;" onclick="goedit('<?php echo $t["id"]; ?>')" value="EDIT" />&nbsp;&nbsp;<input type="button" name="edit" class="input" style="font-size:9px;" onclick="gooverview('<?php echo $t["id"]; ?>')" value="OVERVIEW" /></td> 
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
    	<td valign="top" colspan="7" align="center" class="labels">Sorry no records here!</td>
	</tr>
	<?php
	}
	?>  
	<?php if($count==1) { ?>                         
    <tr>
    	<td valign="top" colspan="7" class="labels"><div style=" width: 723px; float:left;"><div style="width:70px; float:left; text-align:left;"><button class="input" style="font-size:9px" type="submit" name="delete">DELETE</button></div><div style="width:653px; float:left; text-align:center;"><?php echo $pagelist; ?></div></div></td>
	</tr>
<?php } ?>
</form>	
</table>
<script language="javascript" type="text/javascript">
function goedit(a){
	window.location.href="edituser.php?uid="+a+"&action=edit";
}
function gooverview(b){
	window.location.href="overview.php?uid="+b;
}
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
		 if(confirm('Are sure want to delete those users?')) { return true; } else {
		 return false; }
		 }
		 else {
		 alert("Please select any of the user to delete.");
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
</script>
<?php include('includes/admin_footer.php'); ?>           
                    