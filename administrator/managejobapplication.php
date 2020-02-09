<?php 
include('includes/admin_header.php'); 

if(isset($_POST["delete"]))
{
	$chk = $_POST["chk"];
	foreach($chk as $c){
	dbQuery("delete from `jobs_application` where `id`='".$c."'");
	$_SESSION["jobsdelete"]="The messages has been deleted successfully!";
	}
}
if(isset($_GET["order"]) && $_GET["order"]!='') {

if(isset($_POST["jobid"]) && $_POST["jobid"]!='') {		

if($_GET["order"]=='title') {
$sql = "select * from `jobs_application`,`jobs` where `jobs`.`id`=`jobs_application`.`jobid` and `jobs_application`.`jobid`='".$_POST["jobid"]."' order by `jobs`.`title` asc";
} else {
$sql = "select * from `jobs_application` where `jobid`='".$_POST["jobid"]."' order by `".$_GET["order"]."` asc";
}


} else {	

if($_GET["order"]=='title') {
$sql = "select * from `jobs_application`,`jobs` where `jobs`.`id`=`jobs_application`.`jobid` order by `jobs`.`title` asc";
} else {
$sql = "select * from `jobs_application` order by `".$_GET["order"]."` asc";
}

}

} else {

if(isset($_POST["jobid"]) && $_POST["jobid"]!='') {		
$sql = "select * from `jobs_application`,`jobs` where `jobs`.`id`=`jobs_application`.`jobid` and `jobs_application`.`jobid`='".$_POST["jobid"]."' order by `jobs_application`.`id` asc";
} else {		
$sql = "select * from `jobs_application` order by `id` asc";
}

}

$p = new Pager;
$limit = 1000;
$start = $p->findStart($limit);
$count = dbNumRows(dbQuery($sql));
$pages = $p->findPages($count, $limit);
$result = dbQuery($sql." LIMIT ".$start.", ".$limit );
$pagelist = $p->pageList($_GET['page'], $pages);
?>
<div style="margin-bottom:10px;">
    <h1 style="text-transform:uppercase">Here is your all job application details</h1>
    <img src="media/line.png" />
</div>
<div style="padding-bottom:5px;">
<table border="0" cellpadding="2" cellspacing="2" width="734">   
<tr>    
	<td align="left" valign="top" colspan="11" style="color:#666666;">	
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		<td align="center" valign="middle" class="labels"><strong>Completed Tasks : <?php echo $count; ?></strong></td>  
		<td align="right" valign="top" class="labels"><strong>Choose a Job :</strong></td>
		<td align="left" valign="top" class="labels">	
		<form name="f1" action="managejobapplication.php" method="post">
		<select name="jobid" id="jobid" onchange="javascript: document.f1.submit();">
		<option value=""></option>
		<?php $jsql=dbQuery('select * from `jobs`');
		if(dbNumRows($jsql)>0) {
		while($jres=dbFetchArray($jsql,MYSQL_BOTH)) { ?>
		<option value="<?php echo $jres["id"]; ?>"><?php echo stripslashes($jres["title"]); ?></option>
		<?php } }?>
		</select>
		</form>
		</td>
		</tr>
	</table>
	</td>
</tr>
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
<form name="ff" id="ff" action="managejobapplication.php" method="post" onSubmit="return godelete();">
	<tr>
        <td align="left" valign="top" colspan="7" style="color:#666">Here is your all job application details.</td>
    </tr>	
    <tr>    

        <td style="background-color:#B7CBCF; padding:3px;" width="5" align="left" valign="top"><input type="checkbox" name="chkall" onclick='checkedAll(ff);' /></td> 
		<td width="15%" align="left" valign="top" class="labels"><strong><a href="managejobapplication.php?order=title">Job</a></strong></td>    
        <td width="10%" align="left" valign="top" class="labels"><strong>Job ID</strong></td> 				
        <td width="5%" align="left" valign="top" class="labels"><strong>WorkDone</strong></td>
		<td width="10%" align="left" valign="top" class="labels"><strong>Time</strong></td>			
        <td width="5%" align="left" valign="top" class="labels"><strong>Price</strong></td>
		<td width="10%" align="left" valign="top" class="labels"><strong>Name</strong></td>
		<td width="10%" align="left" valign="top" class="labels"><strong><a href="managejobapplication.php?order=email">Email</a></strong></td> 	
		<td width="5%" align="left" valign="top" class="labels"><strong>Country</strong></td>
		<td width="5%" align="left" valign="top" class="labels"><strong><a href="managejobapplication.php?order=status">Status</a></strong></td>
        <td width="5%" align="left" valign="top" class="labels"><strong>Action</strong></td>                
    </tr>
    <?php
	$ul=0;	
	if(dbNumRows($result)>0)
	{
	$count=1;
		$ul=0;
		while($t = dbFetchArray($result,MYSQL_BOTH))
		{
		$resj=dbFetchArray(dbQuery("select * from `jobs` where `id`='".$t["jobid"]."'"),MYSQL_BOTH);
		$job_title=stripslashes($resj["title"]);
		$resu=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$t["email"]."'"),MYSQL_BOTH);		
	?>	
	<tr id="tr<?php echo $ul; ?>"> 
	<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><input type="checkbox" name="chk[]" id="chk<?php echo $ul ?>" value="<?php echo $t["id"]; ?>" onClick="goselect(<?php echo $ul;?>);" /></td>
	
	<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>">
		<?
		if($resj['highlighted']==1 && $resj['bold']==0)
		{
		?>
		<SPAN STYLE="font-size: 12px; color:#FF6600;"><?php echo $job_title; ?></SPAN>
		<?
		}
		elseif($resj['highlighted']==0 && $resj['bold']==1)
		{
		?>
		<SPAN STYLE="font-size: 12px; font-weight:bold"><?php echo $job_title; ?></SPAN>
		<?
		}
		elseif($resj['highlighted']==1 && $resj['highlighted']==1)
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
	
	<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php echo base64_encode($resj["id"]); ?></td>     
	<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php echo stripslashes($resj["wd1"])."/".stripslashes($resj["wd2"]); ?></td>
	<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php echo stripslashes($resj["time"]); ?></td>    
	<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php echo '$'.number_format($resj["price"],'2','.',''); ?></td>
	<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php echo stripslashes($resu["fullname"]); ?></td
	><td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php echo stripslashes($resu["email"]); ?></td   
><td align="center" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php echo stripslashes($resu["country"]); ?></td> 







		
	<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php if($t["status"]==1) { echo "Running"; }  if($t["status"]==2) { echo "Not Satisfied"; } if($t["status"]==0) { echo "Pending"; } if($t["status"]==3) { echo "Satisfied &amp; Paid"; } ?></td> 	    
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
    	<td valign="top" colspan="11" class="labels"><div style=" width: 734px; float:left;"><div style="width:70px; float:left; text-align:left;"><button class="input" style="font-size:9px" type="submit" name="delete">DELETE</button></div><div style="width:664px; float:left; text-align:center;"><?php echo $pagelist; ?></div></div></td>
	</tr>
	<?php } ?>
</form>	
</table>
<script language="javascript" type="text/javascript">
function goedit(a){
	window.location.href="editjobapplication.php?id="+a+"&action=edit";
}
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
		 if(confirm('Are sure want to delete those job application?')) { return true; } else {
		 return false; }
		 }
		 else {
		 alert("Please select any of the job application to delete.");
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
                    
                    
                    