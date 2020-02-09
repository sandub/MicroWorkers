<?php 

include("include/header.php");

?>

<link type="text/css" href="css/ui-lightness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />	

<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>

<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script>

<?php

if(!isset($_SESSION["userlogin"])) { header("location: login.php"); exit(); }

if(isset($_GET["Id"]) && $_GET["Id"]!='') {

$Id=base64_decode($_GET["Id"]);

} else {

header("location: employee.php");

exit();

}

if(isset($_GET["appid"]) && $_GET["appid"]!='') {



if($_POST["action"]=='4') {



dbQuery("delete from `jobs_application` where `id`='".base64_decode($_GET["appid"])."'");



} else {





//print_r($_POST);

		$resJ=dbFetchArray(dbQuery("select * from `jobs` where `id`='".$Id."'"),MYSQL_BOTH);



		$fees=$resJ["price"];



		$rescurbal=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$_SESSION['userlogin']."'"),MYSQL_BOTH);



		





	$resQ=dbFetchArray(dbQuery("select * from `jobs_application` where `id`='".base64_decode($_GET["appid"])."'"),MYSQL_BOTH);





	dbQuery("update `jobs_application` set `status`='".$_POST["action"]."' where `id`='".base64_decode($_GET["appid"])."'");

	//echo "update `jobs_application` set `status`='".$_POST["action"]."' where `id`='".base64_decode($_GET["appid"])."'";

	if($_POST["action"]=='2' || $_POST["action"]=='3') {



		$resQ=dbFetchArray(dbQuery("select * from `jobs_application` where `id`='".base64_decode($_GET["appid"])."'"),MYSQL_BOTH);

		if(dbNumRows(dbQuery("select * from `success_rate` where `email`='".$resQ["email"]."' and `jobid`='".$resQ["jobid"]."'"))==0) {



		dbQuery("insert into `success_rate`(`email`,`jobid`,`status`) values('".$resQ["email"]."','".$resQ["jobid"]."','".$_POST["action"]."')");

		} else {



		dbQuery("update `success_rate` set `status`='".$_POST["action"]."' where `jobid`='".$resQ["jobid"]."' and `email`='".$resQ["email"]."'");

		}



		



		if($_POST["action"]=='3') {



		//dbQuery("insert into `myaccount`(`email`,`amount`,`type`,`createdate`) values('".$_SESSION['userlogin']."','$fees','5',NOW())");		

		//dbQuery("update `user_registration` set `current_balance`='".($rescurbal["current_balance"]-$fees)."' where `email`='".$_SESSION['userlogin']."'");

		if($fees > 0.11) {

		$deducted_fee = $fees-$fees*($FeePerCompletedJob/100);

		} else {

		$deducted_fee = $fees-$fees*($FeePerCompletedJobLESS11/100);

		}	

		$rescurbal2=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$resQ["email"]."'"),MYSQL_BOTH);

		

	if(dbNumRows(dbQuery("select * from `jobs_application` where `email`='".$resQ["email"]."' and `status`='3' "))==1) {

	$rescurbal5=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$rescurbal2["referrer"]."'"),MYSQL_BOTH);

	$Rreferrer = $rescurbal5["email"];	

  dbQuery("insert into `myaccount`(`email`,`amount`,`type`,`createdate`,`referreduser`) values('".$Rreferrer."','".$ReferralFIRSTJobComplete."','9','".$totaldate."','".$resQ["email"]."')");

  dbQuery("update `user_registration` set `current_balance`='".($rescurbal5["current_balance"]+$ReferralFIRSTJobComplete)."' where `email`='".$Rreferrer."'");			

  }

		

  dbQuery("insert into `myaccount`(`email`,`amount`,`type`,`createdate`,`jobid`) values('".$resQ["email"]."','$deducted_fee','6','".$totaldate."','".$resQ["jobid"]."')");

  dbQuery("update `user_registration` set `current_balance`='".($rescurbal2["current_balance"]+$deducted_fee)."' where `email`='".$resQ["email"]."'");



		



		} else {

		

		dbQuery("update `jobs` set `wd1`='".($resJ["wd1"]-1)."' where `id`='".$resQ["jobid"]."'");

		

		$JSQ1=dbQuery("select * from `jobs` where `id`='".$resQ["jobid"]."'");

		if(dbNumRows($JSQ1)>0) {

			while($JSQ2=dbFetchArray($JSQ1,MYSQL_BOTH)) {			

				if(dbNumRows(dbQuery("select * from `jobs_application` where `jobid`='".$JSQ2["id"]."'"))==$JSQ2["wd2"]) {			

				dbQuery("update `jobs` set `status`='3' where `id`='".$JSQ2["id"]."'");

				} else {

				dbQuery("update `jobs` set `status`='1' where `id`='".$JSQ2["id"]."'");

				}

			}

		}

		?>

			<style >

			.ui-dialog-titlebar-close { display: none; } 

			</style>

			<script language="javascript" type="text/javascript">			  		

			    $(document).ready(function(){    

				$("#dialogme").dialog({

					autoOpen: true,

					width: 600					

					});		

			  });

			</script>			

			<div id="dialogme" title="Show Cause" style="display:none;">

			 <p>	

			 <form name="f" method="post" action="employee_showcause.php">

			 <input type="hidden" name="appid" value="<?php echo base64_decode($_GET["appid"]); ?>" />			

				<table width="100%" border="0" cellspacing="0" cellpadding="0">

				  <tr>

					<td width="100" valign="top" align="center"><b>Show Cause</b>&nbsp;</td><td width="500" align="left" valign="top"><textarea name="cause" id="cause" style="width:480px; height:50px;"></textarea></td>

				  </tr>

				   <tr>

					<td width="100" valign="top" align="right">&nbsp;</td><td width="500" align="left" valign="top">

					<input type="submit" name="Btn" value="Submit To Admin" />&nbsp;[&nbsp;<font style="color:#FF0000; font-style:italic; font-size:10px">You must show the cause to administrator.</font>&nbsp;]

					</td>

				  </tr>

				</table>

			 </form>

			 </p>			 	 

		  </div>

		<?php



		}

		



	}

	

	

			//if(($_POST["action"]=='3' || $_POST["action"]=='1') && $resQ["status"]!=1) 

			/*if($_POST["action"]=='3') 

			{

			

				//echo "update `jobs` set `wd1`=`wd1`+1 where `id`='".$Id."'";

				dbQuery("update `jobs` set `wd1`=`wd1`+1 where `id`='".$Id."'");

		

			}	*/

		



	

	



  }



}

?>



	

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td style="padding-left:50px; padding-right:50px;">

	

	<table width="100%" border="0" cellspacing="0" cellpadding="0">

	<tr>

    	<td>&nbsp;</td>

	</tr>

	<tr>

    	<td>

		

		<table name=TABLE border="0" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber41">

<td><table border="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber56" cellpadding="2">

		  <tr>

        <td align="left" colspan="2" style="padding:5px;">

			<table border="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber56">

			  <tr>

				<td nowrap style="padding:3px;">

			<table border="1" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="9" id="AutoNumber57" height="9">

			  <tr>

				<td width="100%" bgcolor="#FFCC00"></td>

			  </tr>

			</table>



			</td>

			<td nowrap>&nbsp;Pending Review</td>

			</tr>

		   </table>

        <td align="center" style="padding:5px;">



    <img border="0" src="images/task-ok2.gif" width="14" height="15"></td>

        <td style="padding:5px;">&nbsp;Satisfied &amp; Paid</td>

        <td align="center" style="padding:5px;">

    <img border="0" src="images/task-nok2.gif" width="14" height="15"></td>

        <td style="padding:5px;">&nbsp;Not Satisfied</td>

       <td align="center" style="padding:5px;">

    <img border="0" src="images/task-notrated7.gif" width="14" height="15"></td>

        <td style="padding:5px;">&nbsp;Pending Employer Review</td>

        </tr>

      </table></td>

  </table name=TABLE>

		

		</td>

	</tr>		 

	 <tr>

   		 <td>&nbsp;</td>

	 </tr>

	 <tr>

   		 <td>

		 

		 <table border="0" cellspacing="0" cellpadding="0">

			<tr>

				<td width="474"><TABLE BORDER="0" CELLSPACING="0" STYLE="border-collapse: collapse" BORDERCOLOR="#111111" WIDTH="111%" CELLPADDING="0">

            <TR>

              <TD WIDTH="100%">&nbsp;<?php if(isset($_SESSION["balanceerror"])) { ?><font color="#FF0000"><b>You current balance is low, deposit soon amount for furthur activity!</b></font><?php unset($_SESSION["balanceerror"]); } ?></TD>



            </TR>

          </TABLE></td>

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

			$sql=dbQuery("select * from `jobs_application` where `jobid`='".$Id."' ORDER BY `id` desc");

			$countjobs=dbNumRows($sql);				

			?>

			<table width="100%" border="0" cellspacing="0" cellpadding="0">

			  <tr>

				<td class="table_content_left"></td>

				<td class="table_content_middle">

				

				<table width="100%" border="0" cellspacing="0" cellpadding="0">

				  <tr>

					   <td width="37%" align="left" style="font-weight:bold; padding-left:20px;">Job name<br /></td>                       

                       <td width="8%" align="left" style="font-weight:bold;">Started<br /></td>

                       <td width="8%" align="left" style="font-weight:bold;">Payment<br /></td>

                       <td width="8%" align="left" style="font-weight:bold;">Time<br /></td>

                       <td width="8%" align="left" valign="top" style="font-weight:bold;">Status</td>

                       <td width="8%" align="left" style="font-weight:bold;">Done<br /></td>						

					   <td width="20%" align="left" valign="top" style="font-weight:bold;">Application</td>

					   <td width="10%" align="left" valign="top" style="font-weight:bold; padding-right:20px;">&nbsp;&nbsp;Action&nbsp;&nbsp;</td>

				  </tr>

				</table>

				

				</td>

				<td class="table_content_right"></td>

			  </tr>

			  <?php

			  if($countjobs>0) 

				{			  

				$cnt = 1;

				$j=1;

  				while($res2=dbFetchArray($sql,MYSQL_BOTH)) 

				{

				$ures=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$res2["email"]."'"),MYSQL_BOTH);

				$res=dbFetchArray(dbQuery("select * from `jobs` where `id`='".$res2["jobid"]."' ORDER BY `price` desc"),MYSQL_BOTH);

					

				$job_title=stripslashes($res['title']);

				$job_title=str_replace("<p>", "", $job_title);

				$job_title=str_replace("</p>", "", $job_title);

				?>

				<style>

				#dialog_link<?php echo $j; ?> {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}

				#dialog_link<?php echo $j; ?> span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}

				</style>

				<script language="javascript" type="text/javascript">

				

				$(document).ready(function(){    

				$("#dialog<?php echo $j; ?>").dialog({

				autoOpen: false,

				width: 600,

				buttons: {

				"Ok": function() { 

				$(this).dialog("close"); 

				}

				}

				});

				

				$('#dialog_link<?php echo $j; ?>, ul#icons li').hover(

				function() { $(this).addClass('ui-state-hover'); }, 

				function() { $(this).removeClass('ui-state-hover'); }

				);	

				

				$('#dialog_link<?php echo $j; ?>').click(function(){

				$('#dialog<?php echo $j; ?>').dialog('open');

				return false;

				});			

				});

				</script>			

				<div id="dialog<?php echo $j; ?>" title="Workers Details" style="display:none;">

				<p><b>Email : </b><?php echo $ures["email"]; ?></p>	

				<p><b>Country : </b><?php echo $ures["country"]; ?></p>	

				<p><b>Proof : </b><?php echo stripslashes($res2["proof"]); ?></p>		 

				</div>			

				

				 		   

				<tr>				

				<td colspan="3" class="<?php if($cnt%2==0) { echo 'td_dark_backg'; } else { echo 'td_light_backg'; } ?>" style="padding-left:20px;">

				

				<table width="100%" border="0" cellspacing="0" cellpadding="0">

				  <tr>

					

					

					

					

					<td width="35%" height="28" align="left"><span class="style5"><a href="<?php if($res["status"]=='1') { echo 'jobs_details'; } else { echo 'jobs_details_notrunning'; } ?>.php?Id=<?php echo base64_encode($res["id"]); ?>" style="text-decoration:none"><?php echo stripslashes($res["title"]); ?></a></span></td>

                   

                   <td width="8%" height="28" align="left"><?php $start=strtotime($res["started"]); $end=strtotime($totaldate);	 if( $diff=get_day_difference($start,$end)) {							

						if($diff['days']==0 && $diff['hours']==0 && $diff['minutes']==0) { echo 'few&nbsp;secs&nbsp;ago'; }

						if($diff['days']==0 && $diff['hours']==0 && $diff['minutes']==1) { echo $diff['minutes'].'&nbsp;min&nbsp;ago'; }

						if($diff['days']==0 && $diff['hours']==0 && $diff['minutes'] > 1) { echo $diff['minutes'].'&nbsp;mins&nbsp;ago'; }

						if($diff['days']==0 && $diff['hours']==1) { echo $diff['hours'].'&nbsp;hour&nbsp;ago'; }

						if($diff['days']==0 && $diff['hours'] > 1) { echo $diff['hours'].'&nbsp;hours&nbsp;ago'; }

						if($diff['days']==1) { echo $diff['days'].'&nbsp;day&nbsp;ago'; }

						if($diff['days']>1 && $diff['days'] <= 7) { echo $diff['days'].'&nbsp;days&nbsp;ago'; }							

						if($diff['days']>7) { echo date('d/m/Y',strtotime($res["started"])); }	

							} ?></td>

                   <td width="8%" height="28" align="left" style="padding-left:10px;"> $<?php echo number_format($res["price"], 2); ?></td>

                   <td width="8%" height="28" align="left" style="padding-left:10px;"> <?php echo stripslashes($res["time"]); ?> min</td>

                   <td width="8%" height="28" align="left" style="padding-left:10px;">

				   					<?php if($res2["status"]!='2' && $res2["status"]!='3') { ?>

									 <img border="0" src="images/task-notrated7.gif" width="14" height="15">	

									<?php } else if($res2["status"]=='3') { ?>

									 <img border="0" src="images/task-ok2.gif" width="14" height="15">

									<?php } else if($res2["status"]=='2') { ?>

									 <img border="0" src="images/task-nok2.gif" width="14" height="15">

									<?php } ?>

				   </td>

                   <td width="8%" height="28" align="left" style="padding-left:10px;"> <?php echo stripslashes($res["wd1"]); ?>/<sup><?php echo stripslashes($res["wd2"]); ?>&nbsp; </sup></td>

				   

				   <td width="20%" height="28" align="left" style="padding-left:10px;"><?php echo '<a href="javascript: viod(0);" id="dialog_link'.$j.'" class="ui-state-default ui-corner-all" >'.stripslashes($ures["email"]).'</a>'; ?></td>

				   

				   <td width="10%" height="28" align="left" style="padding-right:10px;">

                   <form name="F<?php echo $res2["id"]; ?>" method="post" action="employee_application.php?Id=<?php echo $_GET["Id"]; ?>&appid=<?php echo base64_encode($res2["id"]); ?>">

                   <select name="action" id="action" onChange="javascript: if(this.value!='') { document.F<?php echo $res2["id"]; ?>.submit(); } else { alert('please choose your action to do.'); }" style="width:70px;" <?php if($res2["status"]=='3') { echo'disabled="disabled"';} ?> >

<option value=""></option>



	<option value="2" <?php if($res2["status"]=='2') { echo 'selected="selected"'; } ?> >Not Satisfied</option>



	<option value="3" <?php if($res2["status"]=='3') { echo 'selected="selected"'; } ?> >Satisfied &amp; Paid</option>



	</select></form></td>

					   

			       

				  </tr>

				</table>

				

				</td>			

			  </tr>				 

				<?php

				 $cnt = $cnt+1;

				 $j=$j+1;

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