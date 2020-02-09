<?php 
include('includes/admin_header.php'); 

if(isset($_POST["delete"]))
{
	$chk = $_POST["chk"];
	foreach($chk as $c){
	dbQuery("delete from `jobs` where `id`='".$c."'");
	$_SESSION["jobsdelete"]="The messages has been deleted successfully!";
	}
}

$id=base64_decode($_REQUEST["id"]);
$user=mysql_fetch_array(mysql_query("select * from `user_registration` where `id`='$id'"));
$fullname=stripslashes($user['fullname']);

$sql = "select * from `jobs` where `user_id`='$id' order by `title`";	

$p = new Pager;
$limit = 100;
$start = $p->findStart($limit);
$count = dbNumRows(dbQuery($sql));
$pages = $p->findPages($count, $limit);
$result = dbQuery($sql." LIMIT ".$start.", ".$limit );
$pagelist = $p->pageList($_GET['page'], $pages);
?>
<script src="../calender/js/jquery.js" type="text/javascript" charset="utf-8"></script>	
<script src="../calender/js/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>	
<link type="text/css" href="../calender/js/ui.datepicker.css" rel="stylesheet"/>
<script type="text/javascript">
			jQuery(function($)
			{
				$("#fromdate").datepicker();
				
			});
			
			jQuery(function($)
			{
				$("#todate").datepicker();
				
			});
</script>
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
    <h1 style="text-transform:uppercase">Here is all what money is mine via fees collected</h1>
    <img src="media/line.png" />
</div>
<div style="padding-bottom:5px;">
<table border="0" cellpadding="2" cellspacing="2" width="100%">   
<?php if(isset($_GET["msd"]) && $_GET["msd"]=="success") { ?> 
    <tr>
        <td align="center" valign="top" colspan="7" style="color:#666"><font color="#009933">The action has been successfully performed!</font></td>
    </tr>
<?php } ?>
<?php if(isset($_SESSION["jobsdelete"]) && $_SESSION["jobsdelete"]!="") { ?>
 <tr>
        <td align="center" valign="top" colspan="7" style="color:#666"><font color="#009933">The action has been successfully performed!</font></td>
    </tr>
<?php unset($_SESSION["jobsdelete"]); } ?>
<form name="searching" id="searching" action="usermoney.php" method="post">
    <tr>
	<td align="center" valign="top" colspan="7" style="color:#666">
	<table cellpadding="0" cellspacing="0" border="0" width="100%">
	 <tr>     
	    <td align="right" valign="middle" class="labels"><strong>Search In : </strong></td> 
        <td align="center" valign="middle" class="labels">From Date &nbsp;<strong><input type="text" class="input" name="fromdate" id="fromdate" value="" /></strong></td>
		<td align="center" valign="middle" class="labels">To Date &nbsp;<strong><input type="text" class="input" name="todate" id="todate" value="" /></strong></td>
        <td align="left" valign="top" class="labels"><strong><input type="submit" class="input" name="gosearch" value="Search" /></strong></td>             
       </tr>
	  </table>	 </td>
	</tr>
</form>
<form name="ff" id="ff" action="managejobs.php" method="post" onSubmit="return godelete();">
	<tr>
        <td align="left" valign="top" colspan="7" style="color:#666">Here is your all Money details.&nbsp;&nbsp;&nbsp;</td>
    </tr>
    <tr>     
        <td style="background-color:#B7CBCF; padding:3px;" width="63" align="left" valign="top"><input type="checkbox" name="chkall" onclick='checkedAll(ff);' /></td> 
		<td width="216" align="left" valign="top" class="labels1"><strong>Job Name </strong></td>    
        <td width="61" align="left" valign="top" class="labels1"><strong>Job ID</strong></td> 		
        <td width="223" align="left" valign="top" class="labels1"><strong>User Name</strong></td>
		<td width="86" align="center" valign="top" class="labels1"><strong>Fees</strong></td> 	
		<td width="139" align="center" valign="top" class="labels1"><strong>Worker Will Earn</strong></td>
		<td width="143" align="center" valign="top" class="labels1"><strong>Started</strong></td>	
		<!--<td width="44" align="left" valign="top" class="labels"><strong>Status</strong></td>-->
    </tr>
    <?php
	$ul=0;	
	if(dbNumRows($result)>0)
	{
	$count=1;
		$ul=0;
		$admin_earn=0;
		$worker=0;
		while($t = dbFetchArray($result,MYSQL_BOTH))
		{
		$job_title=stripslashes($t["title"]);
		$admin_earn=$admin_earn+$t["extra_price"];
		$extra=$admin_earn;
		
		$worker=$worker+$t["price"];
		$worker_get=$worker;
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
	<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php echo $fullname; ?></td>
	<td align="center" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php echo stripslashes('$'.$t["extra_price"]); ?></td>    
	<td align="center" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php echo '$'.$t["price"]; ?></td>    
	<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php echo $t["started"]; ?></td>  	
	<!--<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php if($t["status"]==1) { echo "Running"; }  if($t["status"]==2) { echo "Paused"; } if($t["status"]==0) { echo "Pending"; } if($t["status"]==3) { echo "Finished"; } if($t["status"]==4) { echo "Blocked"; } ?></td>-->
	</tr>
    <?php
	$ul=$ul+1;
		}
		$extra=$admin_earn;
		$worker_get=$worker;
		$mine=($worker_get*5)/100;
		$total=$extra+$mine;
		?>
	  <tr id="tr<?php echo $ul; ?>">
	  <td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>">&nbsp;</td>
	  <td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>">&nbsp;</td>
	  <td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>">&nbsp;</td>
	  <td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>">&nbsp;</td>
	  <td align="center" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><span style="font-weight:bold; font-size:12px">$<?=$extra;?></span></td>
	  <td align="center" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><span style="font-weight:bold; font-size:12px">$<?=$worker_get;?></span></td>
	  <td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>">&nbsp;</td>
	  </tr>
	  
	  <tr id="tr<?php echo $ul; ?>">
	    <td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>">&nbsp;</td>
	    <td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>">&nbsp;</td>
	    <td align="center" valign="top" colspan="4" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>">
		<span style="font-weight:bold; font-size:12px; padding-left:30px;">Admin Will Earn : <?=number_format($extra, 2);?> + (5% of $<?=number_format($worker_get, 2);?>) $<?=number_format($mine, 2);?> = $<?=number_format($total, 2);?></span></td>
	    <td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>">&nbsp;</td>
      </tr>
	<?
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
    	<td valign="top" colspan="7" class="labels"><div style=" width: 734px; float:left;"><div style="width:70px; float:left; text-align:left;"><button class="input" style="font-size:9px" type="submit" name="delete">DELETE</button></div><div style="width:664px; float:left; text-align:center;"><?php echo $pagelist; ?></div></div></td>
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
		 if(confirm('Are sure want to delete those jobs?')) { return true; } else {
		 return false; }
		 }
		 else {
		 alert("Please select any of the jobs to delete.");
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