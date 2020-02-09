<?php 
include('includes/admin_header.php');
if(isset($_POST["delete"]))
{
	$chk = $_POST["chk"];
	foreach($chk as $c){
	dbQuery("delete from `user_hidden_jobs` where `id`='".$c."'");
	$_SESSION["userdelete"]="The Records has been deleted successfully!";
	}
}

if(isset($_GET["order"])) 
{		
	$sql = "select * from `user_hidden_jobs` order by ".$_GET["order"];	
} 
else 
{
	$sql = "select * from `user_hidden_jobs` order by `email`";
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
    <h1 style="text-transform:uppercase">Here is your all site user hidden jobs details</h1>
    <img src="media/line.png" />
</div>
<div style="padding-bottom:5px;">
<table border="0" cellpadding="2" cellspacing="2" width="723">   
<?php if(isset($_GET["msd"]) && $_GET["msd"]=="success")  { ?> 
    <tr>
        <td align="center" valign="top" colspan="3" style="color:#666"><font color="#009933">The action has been successfully performed!</font></td>
    </tr>
<?php } ?>
<?php if(isset($_SESSION["userdelete"]) && $_SESSION["userdelete"]!="") { ?>
    <tr>
        <td align="center" valign="top" colspan="3" style="color:#666"><font color="#009933">The action has been successfully performed!</font></td>
    </tr>
<?php unset($_SESSION["userdelete"]); } ?>
<form name="ff" id="ff" action="userhiddenjoblist.php" method="post" onsubmit="return godelete();">
	<tr>
        <td align="left" valign="top" colspan="3" style="color:#666">Here is your all site user hidden jobs details.</td>
    </tr>
    <tr>     
        <td style="background-color:#B7CBCF; padding:3px;" style="width:10px;" align="left" valign="top"><input type="checkbox" name="chkall" onclick='checkedAll(ff);' /></td> 		    
        <td align="left" valign="top" class="labels" style="width:250px;"><strong><a href="<?php if($_SERVER['QUERY_STRING']=="") { echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']."?order=email"; } elseif(isset($_GET["page"]) && !isset($_GET["order"])) { echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']."&order=email"; } elseif(isset($_GET["page"]) && isset($_GET["order"])) { echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['SCRIPT_NAME']."?page=".$_GET["page"]."&order=email"; } ?>">Email</a></strong></td> 		
        <td align="left" valign="top" class="labels" style="width:450px;"><strong>Job Title</strong></td>         
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
	    <td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>" style="width:10px;"><input type="checkbox" name="chk[]" id="chk<?php echo $ul ?>" value="<?php echo $t["id"]; ?>" onclick="goselect(<?php echo $ul;?>);" /></td>	   
        <td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>" style="width:250px;"><?php echo $t["email"]; ?></td>     
		<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>" style="width:450px;"><?php 
		$resJ=dbFetchArray(dbQuery("select * from `jobs` where `id`='".$t["jobid"]."'"),MYSQL_BOTH);
		 echo stripslashes($resJ["title"]); ?></td>
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
    	<td valign="top" colspan="3" align="center" class="labels">Sorry no records here!</td>
	</tr>
	<?php
	}
	?>  
	<?php if($count==1) { ?>                         
    <tr>
    	<td valign="top" colspan="3" class="labels"><div style=" width: 723px; float:left;"><div style="width:70px; float:left; text-align:left;"><button class="input" style="font-size:9px" type="submit" name="delete">DELETE</button></div><div style="width:653px; float:left; text-align:center;"><?php echo $pagelist; ?></div></div></td>
	</tr>
<?php } ?>
</form>	
</table>
<script language="javascript" type="text/javascript">
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
		 if(confirm('Are sure want to delete those user hidden jobs?')) { return true; } else {
		 return false; }
		 }
		 else {
		 alert("Please select any of the user hidden jobs to delete.");
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
                    