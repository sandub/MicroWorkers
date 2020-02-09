<?php 
include("include/header.php");
if(!isset($_SESSION["userlogin"])) { header("location: login.php"); exit(); }
if(isset($_POST["searchtitle"])) {
$_SESSION["searchtitle"] = $_POST["searchtitle"];
}
$JSQ14=dbQuery("select * from `jobs`");
if(dbNumRows($JSQ14)>0) {
	while($JSQ24=dbFetchArray($JSQ14,MYSQL_BOTH)) {				
		if(dbNumRows(dbQuery("select * from `jobs_application` where `jobid`='".$JSQ24["id"]."'"))==$JSQ24["wd2"]) {			
		dbQuery("update `jobs` set `status`='3' where `id`='".$JSQ24["id"]."'");
		} 	
	}
}


if(isset($_GET["jobmailUSA"]) && $_GET["jobmailUSA"]!='') {
dbQuery("update `user_registration` set `jobmailUSA`='".$_GET["jobmailUSA"]."' where `email`='".$_SESSION["userlogin"]."'");
header("location: searchjobs.php");
exit();
}
if(isset($_GET["jobmailINT"]) && $_GET["jobmailINT"]!='') {
dbQuery("update `user_registration` set `jobmailINT`='".$_GET["jobmailINT"]."' where `email`='".$_SESSION["userlogin"]."'");
header("location: searchjobs.php");
exit();
}
$jobeUI=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$_SESSION["userlogin"]."'"),MYSQL_BOTH);
if(isset($_GET["Id"]) && isset($_GET["ac"])) {
dbQuery("insert into `user_hidden_jobs`(`email`,`jobid`) values('".$_SESSION["userlogin"]."','".base64_decode($_GET["Id"])."')");
	if(isset($_GET["s"])) {
	header("location: searchjobs.php?Sort=".$_GET["s"]);
	exit();
	} else {
	header("location: searchjobs.php");
	exit();
	}
}

$USERCOUNT = dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$_SESSION["userlogin"]."'"),MYSQL_BOTH);
if($USERCOUNT["country"]=='United States' || $USERCOUNT["country"]=='Canada' || $USERCOUNT["country"]=='Australia' || $USERCOUNT["country"]=='United Kingdom' || $USERCOUNT["country"]=='Virgin Islands (U.S.)') {
$UC='USA';
} else {
$UC='INT';
}

if($UC=='INT') {

if(isset($_SESSION["searchtitle"]) && $_SESSION["searchtitle"]!='') {
$sql2=dbQuery("select * from `jobs` where `status`='1' and `title` like '%".$_SESSION["searchtitle"]."%' and `country`='$UC' and `id` not in (select `jobid` from `user_hidden_jobs` where `email`='".$_SESSION["userlogin"]."')");
} else {
$sql2=dbQuery("select * from `jobs` where `status`='1' and `country`='$UC' and `id` not in (select `jobid` from `user_hidden_jobs` where `email`='".$_SESSION["userlogin"]."')");
}

} else {

if(isset($_SESSION["searchtitle"]) && $_SESSION["searchtitle"]!='') {
$sql2=dbQuery("select * from `jobs` where `status`='1' and `title` like '%".$_SESSION["searchtitle"]."%' and `id` not in (select `jobid` from `user_hidden_jobs` where `email`='".$_SESSION["userlogin"]."')");
} else {
$sql2=dbQuery("select * from `jobs` where `status`='1' and `id` not in (select `jobid` from `user_hidden_jobs` where `email`='".$_SESSION["userlogin"]."')");
}

}
$countjobs2=dbNumRows($sql2);

if(isset($_GET["Sort"]) && $_GET["Sort"]=='COST') {

if($UC=='INT') {

if(isset($_SESSION["searchtitle"]) && $_SESSION["searchtitle"]!='') {
$sql=dbQuery("select * from `jobs` where `status`='1' and `title` like '%".$_SESSION["searchtitle"]."%' and `country`='$UC' and `id` not in (select `jobid` from `user_hidden_jobs` where `email`='".$_SESSION["userlogin"]."') ORDER BY `price` desc");
} else {
$sql=dbQuery("select * from `jobs` where `status`='1' and `country`='$UC' and `id` not in (select `jobid` from `user_hidden_jobs` where `email`='".$_SESSION["userlogin"]."') ORDER BY `price` desc");
}


} else {

if(isset($_SESSION["searchtitle"]) && $_SESSION["searchtitle"]!='') {
$sql=dbQuery("select * from `jobs` where `status`='1' and `title` like '%".$_SESSION["searchtitle"]."%' and `id` not in (select `jobid` from `user_hidden_jobs` where `email`='".$_SESSION["userlogin"]."') ORDER BY `price` desc");
} else {
$sql=dbQuery("select * from `jobs` where `status`='1' and `id` not in (select `jobid` from `user_hidden_jobs` where `email`='".$_SESSION["userlogin"]."') ORDER BY `price` desc");
}


}

} else if(isset($_GET["Sort"]) && $_GET["Sort"]=='NEWEST') {

if($UC=='INT') {

if(isset($_SESSION["searchtitle"]) && $_SESSION["searchtitle"]!='') {
$sql=dbQuery("select * from `jobs` where `status`='1' and `title` like '%".$_SESSION["searchtitle"]."%' and `country`='$UC' and `id` not in (select `jobid` from `user_hidden_jobs` where `email`='".$_SESSION["userlogin"]."') ORDER BY `id` desc");
} else {
$sql=dbQuery("select * from `jobs` where `status`='1' and `country`='$UC' and `id` not in (select `jobid` from `user_hidden_jobs` where `email`='".$_SESSION["userlogin"]."') ORDER BY `id` desc");
}

} else {

if(isset($_SESSION["searchtitle"]) && $_SESSION["searchtitle"]!='') {
$sql=dbQuery("select * from `jobs` where `status`='1' and `title` like '%".$_SESSION["searchtitle"]."%' and `id` not in (select `jobid` from `user_hidden_jobs` where `email`='".$_SESSION["userlogin"]."') ORDER BY `id` desc");
} else {
$sql=dbQuery("select * from `jobs` where `status`='1' and `id` not in (select `jobid` from `user_hidden_jobs` where `email`='".$_SESSION["userlogin"]."') ORDER BY `id` desc");
}


}

} else 
	{
	if(isset($_GET["key"])!='' && isset($_GET["sort"])!='')
	{
	$key = $_GET["key"];
	$sort = $_GET["sort"];
	
	if($UC=='INT') {
	
	if(isset($_SESSION["searchtitle"]) && $_SESSION["searchtitle"]!='') {
	$sql=dbQuery("select * from `jobs` where `status`='1' and `title` like '%".$_SESSION["searchtitle"]."%' and `country`='$UC' and `id` not in (select `jobid` from `user_hidden_jobs` where `email`='".$_SESSION["userlogin"]."') ORDER BY ".$key." ".$sort." ");
	} else {
	$sql=dbQuery("select * from `jobs` where `status`='1' and `country`='$UC' and `id` not in (select `jobid` from `user_hidden_jobs` where `email`='".$_SESSION["userlogin"]."') ORDER BY ".$key." ".$sort." ");
	}
	
	
	} else {
	
	if(isset($_SESSION["searchtitle"]) && $_SESSION["searchtitle"]!='') {
	$sql=dbQuery("select * from `jobs` where `status`='1' and `title` like '%".$_SESSION["searchtitle"]."%' and `id` not in (select `jobid` from `user_hidden_jobs` where `email`='".$_SESSION["userlogin"]."') ORDER BY ".$key." ".$sort." ");
	} else {
	$sql=dbQuery("select * from `jobs` where `status`='1' and `id` not in (select `jobid` from `user_hidden_jobs` where `email`='".$_SESSION["userlogin"]."') ORDER BY ".$key." ".$sort." ");
	}
	
	
	}
	
	}
	else
	{
	
	if($UC=='INT') {
	
	if(isset($_SESSION["searchtitle"]) && $_SESSION["searchtitle"]!='') {
	$sql=dbQuery("select * from `jobs` where `status`='1' and `title` like '%".$_SESSION["searchtitle"]."%' and `country`='$UC' and `id` not in (select `jobid` from `user_hidden_jobs` where `email`='".$_SESSION["userlogin"]."') ORDER BY `started` desc");
	} else {
	$sql=dbQuery("select * from `jobs` where `status`='1' and `country`='$UC' and `id` not in (select `jobid` from `user_hidden_jobs` where `email`='".$_SESSION["userlogin"]."') ORDER BY `started` desc");
	}
	
	
	} else {
	
	if(isset($_SESSION["searchtitle"]) && $_SESSION["searchtitle"]!='') {
	$sql=dbQuery("select * from `jobs` where `status`='1' and `title` like '%".$_SESSION["searchtitle"]."%' and `id` not in (select `jobid` from `user_hidden_jobs` where `email`='".$_SESSION["userlogin"]."') ORDER BY `started` desc");
	} else {
	$sql=dbQuery("select * from `jobs` where `status`='1' and `id` not in (select `jobid` from `user_hidden_jobs` where `email`='".$_SESSION["userlogin"]."') ORDER BY `started` desc");
	}
	
	
	}
	
	}
}
$countjobs=dbNumRows($sql);
?>
<script language="javascript" type="text/javascript">
function show_hide(a,h) {
<?php if(isset($_GET["Sort"])) { ?>
window.location.href='searchjobs.php?Id='+a+'&ac='+h+'&s=<?php echo $_GET["Sort"]; ?>';
<?php } else { ?>
window.location.href='searchjobs.php?Id='+a+'&ac='+h;
<?php } ?>
}
</script>

	
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding-left:50px; padding-right:50px;">
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
    	<td>&nbsp;</td>
	</tr>
	<tr>
	  <td>
	  
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                 <tr>                   
                   <td width="600" valign="top" align="left">

						<b><?php echo $countjobs2; ?> Jobs Running &amp; Available to You.</b><br />
						<b><font color="#DD3333">5% Transaction Fee Per Completed Job.</font></b><br />
<a href="success_rate.php"style="text-decoration:none"><b>Success Rate Must Stay Above 75% Click Here To Learn More: </b></a>
<br /><br />
						<b><u>You should only accept jobs you are capable of 
						finishing.</u></b>
				    </td>
						<td align="right">
						<table border="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber55" cellpadding="0">
						<tr>
						<td nowrap valign="top">
						<table border="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber56">
						
						<tr>
						<td align="center">
						<table border="1" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="9" id="AutoNumber57" height="9">
						<tr>
						<td width="100%" bgcolor="#99FF99"></td>
						</tr>
						</table></td>
						<td align="left">&nbsp;Running &amp; Available</td>
						</tr>
						<tr>
						<td align="center">
						<table border="1" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="9" id="AutoNumber58" height="9">
						<tr>
						<td width="100%" bgcolor="#008000"></td>
						</tr>
						</table></td>
						
						<td align="left">&nbsp;Temporary Unavailable</td>
						</tr>   
						<tr>
						<td align="center" colspan="2">&nbsp;</td>
						</tr>  
						<tr>
						<td align="center">
						<input type="checkbox" name="jobmailUSA" id="jobmailUSA" value="1" <?php if($jobeUI["jobmailUSA"]=='1') { echo 'checked="checked"'; } ?> onclick="window.location.href='searchjobs.php?jobmailUSA=<?php echo ($jobeUI["jobmailUSA"]==0)?1:0; ?>'" /></td>
						
						<td align="left">&nbsp; Receive Notification Of New USA Job's. </td>
						</tr>  
						<tr>
						<td align="center">
						<input type="checkbox" name="jobmailINT" id="jobmailINT" value="1" <?php if($jobeUI["jobmailINT"]=='1') { echo 'checked="checked"'; } ?> onclick="window.location.href='searchjobs.php?jobmailINT=<?php echo ($jobeUI["jobmailINT"]==0)?1:0; ?>'" /></td>
						
						<td align="left">&nbsp; Receive Notification Of New INT Job's.</td>
						</tr>     
						</table></td>
						</tr>
						</table></td>
                 </tr>
               </table>
	  
	  
	  </td>
	</tr>
	<tr>
   		 <td>&nbsp;</td>
	 </tr>
	<tr>
		<td>
		
		<table name=TABLE border="0" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber41">
						<tr name=COST>
						<td width="100%" ALIGN="center">
						<p ALIGN="left">
						<?php if((isset($_GET["Sort"]) && $_GET["Sort"]=='COST') || (!isset($_GET["Sort"]) && !isset($_GET["key"]))) { ?>
						<A HREF="searchjobs.php?Sort=COST">
						<IMG BORDER="0" SRC="images/sort_mostpaying1.gif" WIDTH="73" HEIGHT="16"></A>
						<A HREF="searchjobs.php?Sort=NEWEST">
						<IMG BORDER="0" SRC="images/sort_latest0.gif" WIDTH="73" HEIGHT="16"></A>
						<?php } ?>
						<?php if(isset($_GET["Sort"]) && $_GET["Sort"]=='NEWEST' && !isset($_GET["key"])) { ?>
						<A HREF="searchjobs.php?Sort=COST">
						<IMG BORDER="0" SRC="images/sort_mostpaying0.gif" WIDTH="73" HEIGHT="16"></A>
						<A HREF="searchjobs.php?Sort=NEWEST">
						<IMG BORDER="0" SRC="images/sort_latest1.gif" WIDTH="73" HEIGHT="16"></A>
						<?php } else if(isset($_GET["key"])) { ?>
						<A HREF="searchjobs.php?Sort=COST">
						<IMG BORDER="0" SRC="images/sort_mostpaying0.gif" WIDTH="73" HEIGHT="16"></A>
						<A HREF="searchjobs.php?Sort=NEWEST">
						<IMG BORDER="0" SRC="images/sort_latest0.gif" WIDTH="73" HEIGHT="16"></A>
						<?php } ?>
						</td>
			   </tr name=COST></table name=TABLE>
		
		</td>
	</tr>	 
	 <tr>
   		 <td>&nbsp;</td>
	 </tr>
	  <tr>
		<td>
		
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			
			  <tr>
				<td class="table_content_left"></td>
				<td class="table_content_middle">
				
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>                       
                       <td width="50%" style="padding-left:20px; font-weight:bold;" align="left">Job name<BR>
					   <a href="searchjobs.php?key=title&sort=asc"><img src="images/up.gif" border="0"></a> 
					   <a href="searchjobs.php?key=title&sort=desc"><img src="images/down.gif" border="0"></a></span></td>                       
                       <td width="10%" style="font-weight:bold;">Started<br />
						<a href="searchjobs.php?key=started&sort=asc"><img src="images/up.gif" border="0"></a> 
					   <a href="searchjobs.php?key=started&sort=desc"><img src="images/down.gif" border="0"></a></td>
                       <td width="10%" style="font-weight:bold;">Payment<br />
						<a href="searchjobs.php?key=price&sort=asc"><img src="images/up.gif" border="0"></a> 
					   <a href="searchjobs.php?key=price&sort=desc"><img src="images/down.gif" border="0"></a></td>
                       <td width="10%" style="font-weight:bold;">Time<br />
						<a href="searchjobs.php?key=time&sort=asc"><img src="images/up.gif" border="0"></a> 
					   <a href="searchjobs.php?key=time&sort=desc"><img src="images/down.gif" border="0"></a></td>
                       <td width="8%" style="font-weight:bold;">Status<br />
                        <a href="searchjobs.php?key=status&sort=asc"><img src="images/up.gif"	border="0"></a>         
						<a href="searchjobs.php?key=status&sort=desc"><img src="images/down.gif" border="0"></a></td>
                       <td width="8%" style="font-weight:bold;">Done<br />
						<a href="searchjobs.php?key=wd1/wd2&sort=asc"><img src="images/up.gif" border="0"></a> 
					    <a href="searchjobs.php?key=wd1/wd2&sort=desc"><img src="images/down.gif" border="0"></a></td>
                       <td width="14%" style="font-weight:bold;" height="28">Hide Jobs</td>
                     </tr>
				</table>
				
				</td>
				<td class="table_content_right"></td>
			  </tr>
			  
			  
			  
			  
			  
			  <?php 
			if($countjobs>0) 
				 {			 
				$cnt = 1;
				 while($res=dbFetchArray($sql,MYSQL_BOTH))
				 {
		if(dbNumRows(dbQuery("select * from `jobs_application` where `jobid`='".$res["id"]."' and `email`='".$_SESSION["userlogin"]."'"))==0) {							 		
				
				$date=$res["started"];
				$explode1=explode(" ",$date);
				$explode=explode("-",$explode1[0]);
				$year=$explode[0];
				$month=$explode[1];
				$day=$explode[2];
				
				$format=date("m/d/Y",mktime(0,0,0,$month,$day,$year));				
					
				$job_title=stripslashes($res['title']);
				$job_title=str_replace("<p>", "", $job_title);
				$job_title=str_replace("</p>", "", $job_title);
				
				
					?>
					
			   <tr>				
				<td colspan="3" class="<?php if($c%2==0) { echo 'td_dark_backg'; } else { echo 'td_light_backg'; } ?>" onmouseover="javascript :  this.style.backgroundColor='#CAE7EE';" onmouseout="javascript : this.style.backgroundColor='<?php if($res["highlighted"]=='1') { echo '#ABDAE4';} else if($cnt%2==0 && $res["highlighted"]!='1') { echo '#EEEEEE'; } else if($res["highlighted"]!='1') { echo '#F8F8F8'; } ?>';" style="padding-left:20px; <?php if($res["highlighted"]=='1') { echo 'background-color:#ABDAE4;';} ?>">
				
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td width="50%" height="28" style="padding-left:10px;" align="left"><a href="<?php if($res["status"]=='1') { echo 'jobs_details'; } else { echo 'jobs_details_notrunning'; } ?>.php?Id=<?php echo base64_encode($res["id"]); ?>" style="text-decoration:none"><div style="float:left;"><div style="float:left;"><?php if($res["country"]=='INT') { echo '<img src="images/Globe.png" height="16" width="16" border="0" />&nbsp;&nbsp;'; } else if($res["country"]=='USA') { echo '<img src="images/USFlag.png" height="16" width="16" border="0" />&nbsp;&nbsp;'; }?></div><div style="float:left;padding-top:2px;"><?php if($res["bold"]=='1') { echo '<b>'.$job_title.'</b>'; } else { echo $job_title; } ?></div></a></td>
                   <td width="10%" height="28"><?php $start=strtotime($res["started"]); $end=strtotime($totaldate);	 if( $diff=get_day_difference($start,$end)) {							
						if($diff['days']==0 && $diff['hours']==0 && $diff['minutes']==0) { echo 'few&nbsp;secs&nbsp;ago'; }
						if($diff['days']==0 && $diff['hours']==0 && $diff['minutes']==1) { echo $diff['minutes'].'&nbsp;min&nbsp;ago'; }
						if($diff['days']==0 && $diff['hours']==0 && $diff['minutes'] > 1) { echo $diff['minutes'].'&nbsp;mins&nbsp;ago'; }
						if($diff['days']==0 && $diff['hours']==1) { echo $diff['hours'].'&nbsp;hour&nbsp;ago'; }
						if($diff['days']==0 && $diff['hours'] > 1) { echo $diff['hours'].'&nbsp;hours&nbsp;ago'; }
						if($diff['days']==1) { echo $diff['days'].'&nbsp;day&nbsp;ago'; }
						if($diff['days']>1 && $diff['days'] <= 7) { echo $diff['days'].'&nbsp;days&nbsp;ago'; }							
						if($diff['days']>7) { echo $format; }	
						} ?></td>
                   <td width="10%" height="28"> $<?php echo number_format($res["price"], 2); ?></td>
                   <td width="10%" height="28"> <?php echo stripslashes($res["time"]); ?> min</td>
                   <td width="8%" height="28"> <?php if($res["status"]=='1') { ?>
						<table border="1" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="9" id="AutoNumber40" height="9">
						<tr>
						<td width="100%" bgcolor="#99FF99"></td>
						</tr>
						</table>
						<?php } else if($res["status"]=='0') { ?>
						<table border="1" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="9" id="AutoNumber58" height="9">
						<tr>
						<td width="100%" bgcolor="#008000"></td>
						</tr>
						</table>
				  <?php } ?></td>
                   <td width="8%" height="28"><?php echo stripslashes($res["wd1"]); ?>/<sup><?php echo stripslashes($res["wd2"]); ?>&nbsp; </sup></td>
				   <td width="14%" height="28"><img style="cursor: pointer" onClick="show_hide('<?php echo base64_encode($res["id"]); ?>', 'H'); return false;" border="0" src="images/arr-d.gif" width="12" height="12" /></td>
				  </tr>
				</table>
				
				</td>			
			   </tr>					
				
				 <?php				 	  
				 $cnt++;
						 }
				 
					}	 
				 } else {
			    ?>
				<tr>				
				<td colspan="3" class="td_dark_backg" align="center">
				
				No records found!
				
				</td>			
			    </tr>
				<?php } ?>
			  			  		  
			</table>
		
		</td>
	  </tr>
	  <tr>
   		 <td>&nbsp;</td>
	  </tr>
	  <tr>
   		 <td>&nbsp;</td>
	  </tr>
	</table>
	
	</td>
  </tr>
</table>
	
<?php include("include/footer.php"); ?>