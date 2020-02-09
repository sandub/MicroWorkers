<?php 
include('includes/admin_header.php'); 

if(isset($_POST["delete"]))
{
	$chk = $_POST["chk"];
	foreach($chk as $c){
	dbQuery("delete from `jobs` where `id`='".$c."'");
	$_SESSION["jobsdelete"]="The jobs has been deleted successfully!";
	}
}
if(isset($_POST["hide"]))
{
	$chk = $_POST["chk"];
	foreach($chk as $c){
	dbQuery("update `jobs` set `status`='5' where `id`='".$c."'");
	$_SESSION["jobsdelete"]="The jobs are being hidden successfully!";
	}
}
if(isset($_POST["showjobs"]))
{
	$chk = $_POST["chk"];
	foreach($chk as $c){
	dbQuery("update `jobs` set `status`='3' where `id`='".$c."'");
	$_SESSION["jobsdelete"]="The jobs are being shown again successfully!";
	}
}

if(isset($_GET["openhid"]) && $_GET["openhid"]=='yes') {
$sql = "select * from `jobs` where `status`='5' order by `title`";
} else if(isset($_GET["order"]) && $_GET["order"]!='') {
$sql = "select * from `jobs` where `status`<>'5' order by `".$_GET["order"]."`";	
} else {
$sql = "select * from `jobs` where `status`<>'5' order by `title`";	
}

$p = new Pager;
$limit = 100;
$start = $p->findStart($limit);
$count = dbNumRows(dbQuery($sql));
$pages = $p->findPages($count, $limit);
$result = dbQuery($sql." LIMIT ".$start.", ".$limit );
$pagelist = $p->pageList($_GET['page'], $pages);
?>
<script>
 function updateis(id)
	 {
	   var loc="update_homepage.php?id="+id;
	   window.location.href=loc;
	 }
function update_form(id)
	 {
	   var loc="update_homepage_only.php?id="+id;
	   window.location.href=loc;
	 }
</script>
<div style="margin-bottom:10px;">
    <h1 style="text-transform:uppercase">Here is your all job details</h1>
    <img src="media/line.png" />
</div>
<div style="padding-bottom:5px;">
<table border="0" cellpadding="2" cellspacing="2" width="734">   
<?php if(isset($_GET["msd"]) && $_GET["msd"]=="success") { ?> 
    <tr>
        <td align="center" valign="top" colspan="11" style="color:#666"><font color="#009933">The action has been successfully performed!</font></td>
    </tr>
<?php } ?>
<?php if(isset($_SESSION["jobsdelete"]) && $_SESSION["jobsdelete"]!="") { ?>
 <tr>
        <td align="center" valign="top" colspan="11" style="color:#666"><font color="#009933">The action has been successfully performed!</font></td>
    </tr>
<?php unset($_SESSION["jobsdelete"]); } ?>
<form name="ff" id="ff" action="managejobs.php" method="post" onSubmit="return godelete();">
	<tr>
        <td align="left" valign="top" colspan="9" style="color:#666">Here is your all job details.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="Openhid" value="See Hidden Jobs" onclick="javascript: window.location.href='managejobs.php?openhid=yes';" class="input" /></td>
		<td align="right" valign="top" colspan="2" style="color:#666"><a href="addjobs.php" style="text-decoration:none; font-weight:bold">Add Jobs</a></td>
    </tr>
    <tr>     
        <td style="background-color:#B7CBCF; padding:3px;" width="61" align="left" valign="top"><input type="checkbox" name="chkall" onclick='checkedAll(ff);' /></td> 
		<td width="149" align="left" valign="top" class="labels"><strong><a href="managejobs.php?order=title">Job</a></strong></td>    
        <td width="55" align="left" valign="top" class="labels"><strong>Job ID</strong></td> 		
        <td width="80" align="left" valign="top" class="labels"><strong>Work Done</strong></td>
		<td width="149" align="left" valign="top" class="labels"><strong><a href="managejobs.php?order=email">User</a></strong></td> 	
		<td width="35" align="left" valign="top" class="labels"><strong>Cost</strong></td>		
                <td width="121" align="left" valign="top" class="labels"><strong>Country</strong></td>	
                <td width="46" align="left" valign="top" class="labels"><strong><a href="managejobs.php?order=status">Status</a></strong></td>
                <td width="46" align="left" valign="top" class="labels"><strong>Homepage</strong></td>
		<td width="46" align="left" valign="top" class="labels"><strong>Homepage Only</strong></td>
        <td width="45" align="left" valign="top" class="labels"><strong>Action</strong></td>    

    </tr>
    <?php
	$ul=0;	
	if(dbNumRows($result)>0)
	{
	$count=1;
		$ul=0;
		while($t = dbFetchArray($result,MYSQL_BOTH))
		{
		$job_title=stripslashes($t["title"]);	
	?>	
	<tr id="tr<?php echo $ul; ?>"> 
	<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><input type="checkbox" name="chk[]" id="chk<?php echo $ul ?>" value="<?php echo $t["id"]; ?>" onClick="goselect(<?php echo $ul;?>);" /></td>
	
	<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>">
		<?
		if($t['highlighted']==1 && $t['bold']==0)
		{
		?>
		<SPAN STYLE="font-size: 12px; color:#FF6600;"><?php echo $job_title; ?></SPAN>
		<?
		}
		elseif($t['highlighted']==0 && $t['bold']==1)
		{
		?>
		<SPAN STYLE="font-size: 12px; font-weight:bold"><?php echo $job_title; ?></SPAN>
		<?
		}
		elseif($t['highlighted']==1 && $t['highlighted']==1)
		{
		?>
		<SPAN STYLE="font-size: 12px; color:#FF6600; font-weight:bold"><?php echo $job_title; ?></SPAN>
		<?
		}
		else
		{
		?>
		<SPAN STYLE="font-size: 12px;"><?php echo $job_title; ?></SPAN>
		<?
		}
		?>
	</td>
	
	<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php echo base64_encode($t["id"]); ?></td>     
	<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php echo stripslashes($t["wd1"])."/".stripslashes($t["wd2"]); ?></td>
	<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php echo stripslashes($t["email"]); ?></td>       
	<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php echo '$'.$t["price"]; ?></td>    
	<td align="center" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php echo stripslashes($t["country"]); ?></td>		
	<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php if($t["status"]==1) { echo "Running"; }  if($t["status"]==2) { echo "Paused"; } if($t["status"]==0) { echo "Pending"; } if($t["status"]==3) { echo "Finished"; } if($t["status"]==4) { echo "Blocked"; } ?></td>
	
	<td align="center" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php if($t['homepage']=="") print "Inactive";if($t['homepage']=="1") print "Active";if($t['homepage']=="0") print "Inactive";?>
	<input type="checkbox" name="checkbox" value="true"  onclick="updateis('<?php print $t["id"];?>')" <? if($t['homepage']=="1") print "checked";?>/></td>
	
	<td align="center" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php if($t['homepage_only']=="") print "Inactive";if($t['homepage_only']=="1") print "Active";if($t['homepage_only']=="0") print "Inactive";?>
	<input type="checkbox" name="checkbox" value="true"  onclick="update_form('<?php echo $t["id"];?>')" <?php if($t["homepage_only"]=="1") echo "checked";?>/></td>  
	<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><input type="button" name="edit" class="input" style="font-size:9px;" onClick="goedit('<?php echo $t["id"]; ?>')" value="EDIT" /></td> 
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
    	<td valign="top" colspan="11" align="center" class="labels">Sorry no records here!</td>
	</tr>
	<?php
	}
	?>  
	<?php if($count==1) { ?>                         
    <tr>
    	<td valign="top" colspan="11" class="labels"><div style=" width: 734px; float:left;"><div style="width:150px; float:left; text-align:left;"><button class="input" style="font-size:9px" type="submit" name="delete">DELETE</button>&nbsp;&nbsp;&nbsp;<?php if(isset($_GET["openhid"]) && $_GET["openhid"]=='yes') { ?><button class="input" style="font-size:9px" type="submit" name="showjobs">SHOW JOB</button><?php } else { ?><button class="input" style="font-size:9px" type="submit" name="hide">HIDE JOB</button><?php } ?></div><div style="width:584px; float:left; text-align:center;"><?php echo $pagelist; ?></div></div></td>
	</tr>
	<?php } ?>
</form>	
</table>
<script language="javascript" type="text/javascript">
function goedit(a){
	window.location.href="editjobs.php?id="+a+"&action=edit";
}

/*function goadd(){
	window.location.href="addjobs.php?action=add";
}*/
/*function godelete(a){
	if(confirm("Are you sure want to delete this user?")==true)
	window.location.href="edituser.php?uid="+a+"&action=delete";
}*/
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
		 if(confirm('Are sure want to delete or hide those jobs?')) { return true; } else {
		 return false; }
		 }
		 else {
		 alert("Please select any of the jobs to delete or hide.");
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
                    
                    