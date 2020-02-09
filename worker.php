<?php 

include("include/header.php");

if(!isset($_SESSION["userlogin"])) { header("location: login.php"); exit(); }

?>

<script type="text/javascript" src="prototype/javascripts/prototype.js"> </script> 

<script type="text/javascript" src="prototype/javascripts/effects.js"> </script>

<script type="text/javascript" src="prototype/javascripts/window.js"> </script>



<link href="prototype/themes/default.css" rel="stylesheet" type="text/css" ></link>

<link href="prototype/themes/spread.css" rel="stylesheet" type="text/css" ></link>

<script language="javascript1.1">

function loadtempalte(id,jid)

{

	 var wintemp = new Window({className: "spread", title: "Job Preview",top:100, left:200, width:550, height:400,url: "task_details.php?jobid="+id+"&jid="+jid, showEffectOptions: {duration:1.5}})

	 wintemp.show();     

	 return false;

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

		<td align="left">

		        <table width="100%" border="0" cellspacing="0" cellpadding="0">

                 <tr>                  

                   <td width="700" valign="top"><?php echo dbNumRows(dbQuery("select * from `jobs_application` where `email`='".$_SESSION["userlogin"]."' ORDER BY `id` desc")); ?> Submitted Tasks /      

                     <?php echo dbNumRows(dbQuery("select * from `jobs_application` where `email`='".$_SESSION["userlogin"]."' and `status`='3' ORDER BY `id` desc")); ?>      Well Done &amp; Paid<br />

<br>

                     Report problems! If  Employer asks for additional work from you, Please report immediately!<br />

                   Misrated? Let us know! Contact Support and include whole Task Details Page<br /><font color="#DD3333">

						<b><?php echo $FeePerCompletedJob; ?>% Transaction Fee Per Completed Job.</b></font><br /><br />

				   </td>

                   <td valign="top">

				   <table border="0" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber56" cellpadding="2" cellspacing="0">

						<tr>

						<td align="center" style="padding-bottom:5px;">						

						<img border="0" src="images/task-ok2.gif" width="14" height="15"></td>

						<td>&nbsp;Satisfied &amp; Paid</td>

						</tr>

						<tr>

						<td align="center" style="padding-bottom:5px;">

						<img border="0" src="images/task-nok2.gif" width="14" height="15"></td>

						<td>&nbsp;Not Satisfied</td>

						</tr>

						<tr>

						<td align="center">

						<img border="0" src="images/task-notrated7.gif" width="14" height="15"></td>

						<td>&nbsp;Pending Employer Review</td>

						</tr>

						</table>

					</td>

                 </tr>

               </table>

		</td>

	</tr>	 

	 <tr>

   		 <td>&nbsp;</td>

	 </tr>

	  <tr>

		<td>

			<?php 

				if(isset($_REQUEST["key"])!='' && isset($_REQUEST["sort"])!='')

				{

				$key = $_REQUEST["key"];

				$sort = $_REQUEST["sort"];

				

				$sql=dbQuery("select jobs.*,jobs_application.jobid,jobs_application.id as `jid`,jobs_application.proof,jobs_application.status from jobs inner join jobs_application on jobs.id=jobs_application.jobid where jobs_application.email='".$_SESSION["userlogin"]."' ORDER BY ".$key." ".$sort." ");

				}

				else

				{

				$sql=dbQuery("select jobs.*,jobs_application.jobid,jobs_application.id as `jid`,jobs_application.proof,jobs_application.status from jobs inner join jobs_application on jobs.id=jobs_application.jobid where jobs_application.email='".$_SESSION["userlogin"]."' order by jobs.started desc");				

				

				}

				$countjobs=dbNumRows($sql);				

			?> 

			<table width="100%" border="0" cellspacing="0" cellpadding="0">

			  <tr>

				<td class="table_content_left"></td>

				<td class="table_content_middle">

				

				<table width="100%" border="0" cellspacing="0" cellpadding="0">

				  <tr>

					   <td width="50%" style="font-weight:bold; padding-left:20px;" align="left">Job name<br />

						<a href="worker.php?key=title&sort=asc"><img src="images/up.gif" border="0"></a> 

						<a href="worker.php?key=title&sort=desc"><img src="images/down.gif" border="0"></a></td>

                       

                       <td width="10%" style="font-weight:bold;">Started<br />

						<a href="worker.php?key=started&sort=asc"><img src="images/up.gif" border="0"></a> 

						<a href="worker.php?key=started&sort=desc"><img src="images/down.gif" border="0"></a></td>

                       <td width="10%" style="font-weight:bold;">Payment<br />

						<a href="worker.php?key=price&sort=asc"><img src="images/up.gif" border="0"></a> 

						<a href="worker.php?key=price&sort=desc"><img src="images/down.gif" border="0"></a></td>

                       <td width="10%" style="font-weight:bold;">Time<br />

						<a href="worker.php?key=time&sort=asc"><img src="images/up.gif" border="0"></a> 

						<a href="worker.php?key=time&sort=desc"><img src="images/down.gif" border="0"></a></td>

                       <td width="10%" valign="top" style="font-weight:bold;">Status</td>

                       <td width="10%" style="font-weight:bold;">Done<br />

						<a href="worker.php?key=wd1/wd2&sort=asc"><img src="images/up.gif" border="0"></a> 

						<a href="worker.php?key=wd1/wd2&sort=desc"><img src="images/down.gif" border="0"></a></td>

					   <td width="75" valign="top" style="font-weight:bold; padding-right:10px;">Details</td>

				  </tr>

				</table>

				

				</td>

				<td class="table_content_right"></td>

			  </tr>

			  

			   <?php

			   if($countjobs>0)

				{ 

				$cnt = 1;
				$c = 0;
				while($res=dbFetchArray($sql,MYSQL_BOTH))

				{

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

                   <td width="50%" height="28" style="padding-left:10px;" align="left">

				   <a href="<?php if($res["status"]=='1') { echo 'jobs_details'; } else { echo 'jobs_details_notrunning'; } ?>.php?Id=<?php echo base64_encode($res["id"]); ?>" style="text-decoration:none"> <div style="float:left;"><div style="float:left;"><?php if($res["country"]=='INT') { echo '<img src="images/Globe.png" height="16" width="16" border="0" />&nbsp;&nbsp;'; } else if($res["country"]=='USA') { echo '<img src="images/USFlag.png" height="16" width="16" border="0" />&nbsp;&nbsp;'; }?></div><div style="float:left;padding-top:2px;"><?php if($res["bold"]=='1') { echo '<b>'.$job_title.'</b>'; } else { echo $job_title; } ?></div></a>

				   </td>

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

                   <td width="10%" height="28"><?php if($res["status"]=='3') { ?>

						<img border="0" src="images/task-ok2.gif" width="14" height="15">

						<?php } else if($res["status"]=='2') { ?>

						<img border="0" src="images/task-nok2.gif" width="14" height="15">

						<?php } else if($res["status"]!='2' && $res["status"]!='3') { ?>

						<img border="0" src="images/task-notrated7.gif" width="14" height="15">

					    <?php } ?></td>

                   <td width="10%" height="28"> <?php echo stripslashes($res["wd1"]); ?>/<sup><?php echo stripslashes($res["wd2"]); ?>&nbsp; </sup></td>

				   <td width="82" style="padding-right:15px;"><a href="#" onClick="return loadtempalte('<?php echo $res["jobid"];?>','<?php echo $res["jid"];?>')" style="color:#000000; text-decoration:none; font-weight:bold">Details</a></td>

                 </tr>

				</table>

				

				</td>			

			    </tr>					 

				 <?php

				 	 $cnt++;
					 $c++;
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