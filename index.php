<?php include("include/header.php"); ?>

	

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td style="padding-left:50px; padding-right:50px;">

	

	<table width="100%" border="0" cellspacing="0" cellpadding="0">

	<tr>

    	<td>&nbsp;</td>

	</tr>

	  <tr>

		<td class="topic_head">The Latest Featured Projects</td>

	  </tr>

	 <tr>

   		 <td>&nbsp;</td>

	 </tr>

	  <tr>

		<td>

		<?php

		$JSQ14=dbQuery("select * from `jobs`");

		if(dbNumRows($JSQ14)>0) {

			while($JSQ24=dbFetchArray($JSQ14,MYSQL_BOTH)) {				

				if(dbNumRows(dbQuery("select * from `jobs_application` where `jobid`='".$JSQ24["id"]."'"))==$JSQ24["wd2"]) {			

				dbQuery("update `jobs` set `status`='3' where `id`='".$JSQ24["id"]."'");

				} 	

			}

		}

		if(isset($_SESSION["userlogin"])) {

		$USERCOUNT = dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$_SESSION["userlogin"]."'"),MYSQL_BOTH);

		if($USERCOUNT["country"]=='United States' || $USERCOUNT["country"]=='Canada' || $USERCOUNT["country"]=='Australia' || $USERCOUNT["country"]=='United Kingdom' || $USERCOUNT["country"]=='Virgin Islands (U.S.)') {

		$UC='USA';

		} else {

		$UC='INT';

		}

		

		if($UC=='INT') {

		$sql=dbQuery("select * from `jobs` where `homepage_only`='1' and `country`='$UC' and `status`<>'3' order by `started` desc limit 0,23");

		} else {

		$sql=dbQuery("select * from `jobs` where `homepage_only`='1' and `status`<>'3' order by `started` desc limit 0,23");

		}

		

		

		} else {

		$sql=dbQuery("select * from `jobs` where `homepage_only`='1' and `status`<>'3' order by `started` desc limit 0,23");

		}

		

		$countjobs=dbNumRows($sql);

		if($countjobs>0) {

		$c=1;

		$cnt = 1;		

		?>

		

			<table width="100%" border="0" cellspacing="0" cellpadding="0">

			  <tr>

				<td class="table_content_left">&nbsp;</td>

				<td class="table_content_middle">

				

				<table width="100%" border="0" cellspacing="0" cellpadding="0">

				  <tr>

					<td width="50%" align="left" style="font-weight:bold; padding-left:10px;">Job Title</td>

					<td width="10%" align="left" style="font-weight:bold; padding-left:10px;">Started</td>

					<td width="10%" align="left" style="font-weight:bold; padding-left:10px;">Payment</td>

					<td width="5%" align="left" style="font-weight:bold; padding-left:8px;">Time</td>

					<td width="5%" align="left" style="font-weight:bold; padding-left:8px;">Done</td>

					<td width="10%" align="left" style="font-weight:bold; padding-left:8px;">Success</td>

				  </tr>

				</table>

				

				</td>

				<td class="table_content_right">&nbsp;</td>

			  </tr>

		<?php

		while($res=dbFetchArray($sql,MYSQL_BOTH)) {

		

		$job_title=stripslashes($res['title']);

		$job_title=str_replace("<p>", "", $job_title);

		$job_title=str_replace("</p>", "", $job_title);

		

		if(isset($_SESSION["userlogin"])) {	

		if(dbNumRows(dbQuery("select * from `jobs_application` where `jobid`='".$res["id"]."' and `email`='".$_SESSION["userlogin"]."'"))==0) { 

		?>

			  <tr>				

				<td colspan="3" class="<?php if($c%2==0) { echo 'td_dark_backg'; } else { echo 'td_light_backg'; } ?>" onmouseover="javascript :  this.style.backgroundColor='#CAE7EE';" onmouseout="javascript : this.style.backgroundColor='<?php if($res["highlighted"]=='1') { echo '#ABDAE4';} else if($cnt%2==0 && $res["highlighted"]!='1') { echo '#EEEEEE'; } else if($res["highlighted"]!='1') { echo '#F8F8F8'; } ?>';" style="padding-left:20px; <?php if($res["highlighted"]=='1') { echo 'background-color:#ABDAE4;';} ?>">

				

				<table width="100%" border="0" cellspacing="0" cellpadding="0">

				  <tr>

					<td width="50%" height="28" align="left">

					<a href="jobs_details.php?Id=<?php echo base64_encode($res["id"]); ?>" style="text-decoration:none; color:#000000;">

					<div style="float:left;">

					<div style="float:left;">					

					<?php if($res["country"]=='INT') { echo '<img src="images/Globe.png" height="16" width="16" border="0" />&nbsp;&nbsp;'; } else if($res["country"]=='USA') { echo '<img src="images/USFlag.png" height="16" width="16" border="0" />&nbsp;&nbsp;'; }?></div>

					<div style="float:left;padding-top:2px;"><?php if($res["bold"]=='1') { echo '<b>'.$job_title.'</b>'; } else { echo $job_title; } ?></div>

					</div>

					</a></td>

					<td width="10%" align="left"><?php $start=strtotime($res["started"]); $end=strtotime($totaldate); if( $diff=get_day_difference($start,$end)) {							

						if($diff['days']==0 && $diff['hours']==0 && $diff['minutes']==0) { echo 'few&nbsp;secs&nbsp;ago'; }

						if($diff['days']==0 && $diff['hours']==0 && $diff['minutes']==1) { echo $diff['minutes'].'&nbsp;min&nbsp;ago'; }

						if($diff['days']==0 && $diff['hours']==0 && $diff['minutes'] > 1) { echo $diff['minutes'].'&nbsp;mins&nbsp;ago'; }

						if($diff['days']==0 && $diff['hours']==1) { echo $diff['hours'].'&nbsp;hour&nbsp;ago'; }

						if($diff['days']==0 && $diff['hours'] > 1) { echo $diff['hours'].'&nbsp;hours&nbsp;ago'; }

						if($diff['days']==1) { echo $diff['days'].'&nbsp;day&nbsp;ago'; }

						if($diff['days']>1 && $diff['days'] <= 7) { echo $diff['days'].'&nbsp;days&nbsp;ago'; }							

						if($diff['days']>7) { echo date('d/m/Y',strtotime($res["started"])); }	

							} ?></td>

					<td width="10%" align="left">$<?php echo stripslashes($res["price"]); ?></td>

					<td width="5%" align="left"><?php echo stripslashes($res["time"]); ?> min</td>

					<td width="5%" align="left"><?php echo stripslashes($res["wd1"]); ?>/<sup><?php echo stripslashes($res["wd2"]); ?>&nbsp;</sup></td>

					<td width="10%" align="left"><?php

	

$sJOBsql=dbQuery("select * from `success_rate` where `jobid`='".$res["id"]."'");

$sJOBcount=dbNumRows($sJOBsql);

$sJOBsatisfied=0;

$sJOBnotsatisfied=0;

if($sJOBcount>0) {

	while($sJOBres=dbFetchArray($sJOBsql,MYSQL_BOTH)) {

		if($sJOBres["status"]=='2') {

		$sJOBnotsatisfied=$sJOBnotsatisfied+1;

		} else if($sJOBres["status"]=='3') {

		$sJOBsatisfied=$sJOBsatisfied+1;

		}

	}

} 

if($sJOBcount==0) {

$sJOBsatisfy='100';

} else {

$sJOBsatisfy = floor((($sJOBsatisfied/$sJOBcount)*100)); 

}

	echo $sJOBsatisfy.'%';

	?></td>

				  </tr>

				</table>

				

				</td>			

			  </tr>

	    <?php 

		     }

			 		

		 } else { 

		 ?>

				

			  <tr>				

				<td colspan="3" class="<?php if($c%2==0) { echo 'td_dark_backg'; } else { echo 'td_light_backg'; } ?>" style="padding-left:20px;">

				

				<table width="100%" border="0" cellspacing="0" cellpadding="0">

				  <tr>

					<td width="50%" align="left"><a href="jobs_details.php?Id=<?php echo base64_encode($res["id"]); ?>" style="text-decoration:none; color:#000000;"><?php echo $job_title; ?></a></td>

					<td width="10%" align="left">

					<?php 

					$start=strtotime($res["started"]); $end=strtotime($totaldate);	

					 if( $diff=get_day_difference($start,$end)) {							

						if($diff['days']==0 && $diff['hours']==0 && $diff['minutes']==0) { echo 'few&nbsp;secs&nbsp;ago'; }

						if($diff['days']==0 && $diff['hours']==0 && $diff['minutes']==1) { echo $diff['minutes'].'&nbsp;min&nbsp;ago'; }

						if($diff['days']==0 && $diff['hours']==0 && $diff['minutes'] > 1) { echo $diff['minutes'].'&nbsp;mins&nbsp;ago'; }

						if($diff['days']==0 && $diff['hours']==1) { echo $diff['hours'].'&nbsp;hour&nbsp;ago'; }

						if($diff['days']==0 && $diff['hours'] > 1) { echo $diff['hours'].'&nbsp;hours&nbsp;ago'; }

						if($diff['days']==1) { echo $diff['days'].'&nbsp;day&nbsp;ago'; }

						if($diff['days']>1 && $diff['days'] <= 7) { echo $diff['days'].'&nbsp;days&nbsp;ago'; }							

						if($diff['days']>7) { echo date('d/m/Y',strtotime($res["started"])); }	

							} 

					?>

					</td>

					<td width="10%" align="left">$<?php echo stripslashes($res["price"]); ?></td>

					<td width="5%" align="left"><?php echo stripslashes($res["time"]); ?> min</td>

					<td width="5%" align="left"><?php echo stripslashes($res["wd1"]); ?>/<sup><?php echo stripslashes($res["wd2"]); ?>&nbsp;</sup></td>

					<td width="10%" align="left">

					<?php

	

$sJOBsql=dbQuery("select * from `success_rate` where `jobid`='".$res["id"]."'");

$sJOBcount=dbNumRows($sJOBsql);

$sJOBsatisfied=0;

$sJOBnotsatisfied=0;

if($sJOBcount>0) {

	while($sJOBres=dbFetchArray($sJOBsql,MYSQL_BOTH)) {

		if($sJOBres["status"]=='2') {

		$sJOBnotsatisfied=$sJOBnotsatisfied+1;

		} else if($sJOBres["status"]=='3') {

		$sJOBsatisfied=$sJOBsatisfied+1;

		}

	}

} 

if($sJOBcount==0) {

$sJOBsatisfy='100';

} else {

$sJOBsatisfy = floor((($sJOBsatisfied/$sJOBcount)*100)); 

}

	echo $sJOBsatisfy.'%';

	?>

					</td>

				  </tr>

				</table>

				

				</td>			

			  </tr>

		

		<?php	

		$c = $c+1;

			}	

		}

		}

		?>

			  

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

