<?php 

include("include/header.php");

if(!isset($_SESSION["userlogin"])) { header("location: login.php"); exit(); }

if(isset($_GET["Id"]) && $_GET["Id"]!='') {

if($_POST["action"]=='5') {

dbQuery("delete from `jobs` where `id`='".base64_decode($_GET["Id"])."' and `email`='".$_SESSION["userlogin"]."'");

} else {

	dbQuery("update `jobs` set `status`='".$_POST["action"]."' where `id`='".base64_decode($_GET["Id"])."' and `email`='".$_SESSION["userlogin"]."'");

  }

}

?>

<script language="javascript" src="validator/function.js"></script>

<script>

   function some1(getFileName,getWindowName,getHeight,getWidth)

   {      

	  LoadPopup(getFileName,getWindowName,getHeight,getWidth);	 

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

				 <td width="700" valign="top" align="left">Start a campaign and ask workers to do "jobs" for you.

				 <p style="line-height: 150%">



	<U>Some Ideas for Campaigns:</U><br>



	 Ask people to visit your website<br>



	 Ask people to post comments<br>



	 Ask people to sign up<br>



	 Etc...</td>

            <td valign="top" align="left">

	<table border="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber55" cellpadding="0">

            <tr>



              <td nowrap valign="top" align="left">

    <table border="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber56">

      <tr>

        <td nowrap>

    <table border="1" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="9" id="AutoNumber57" height="9">

      <tr>

        <td width="100%" bgcolor="#FFE4B5"></td>

      </tr>

    </table>



        </td>

        <td nowrap>&nbsp;Pending Review</td>

        </tr>

      </table>

    <table border="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber58">

      <tr>

        <td nowrap>

    <table border="1" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="9" id="AutoNumber59" height="9">



      <tr>

        <td width="100%" bgcolor="#99FF99"></td>

      </tr>

    </table>

        </td>

        <td nowrap><span style="font-size: 11px">&nbsp;</span>Running</td>

        </tr>

      </table>



    <table border="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber60">

      <tr>

        <td nowrap>

    <table border="1" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="9" id="AutoNumber61" height="9">

      <tr>

        <td width="100%" bgcolor="#008000"></td>

      </tr>

    </table>

        </td>



        <td nowrap><span style="font-size: 11px">&nbsp;</span>Paused by system 

			<span style="font-size: 11px; "><a style='cursor:help;' onMouseOver="Tip('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A campaign is paused when the number of submitted tasks reaches its limit. If employer rates one or more tasks \'not-satisfied\', the campaign will automatically resume.', BORDERCOLOR, '#CFCFB3', BGCOLOR, '#f9f9d7', WIDTH, -200, FONTFACE, 'Arial,Tahoma', FONTSIZE, '12px')" onMouseOut="UnTip()">

			?</a></span></td>

        </tr>

      </table>

              </td>

     <td>

    &nbsp;&nbsp;&nbsp;

     </td>



              <td valign="top" align="left">

    <table border="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber62">

      <tr>

        <td>

    <table border="1" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="9" id="AutoNumber63" height="9">

      <tr>

        <td width="100%" bgcolor="#FFFFFF"></td>

      </tr>

    </table>



        </td>

        <td>&nbsp;Finished</td>

        </tr>

      </table>

    <table border="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber64">

      <tr>

        <td>

    <table border="1" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="9" id="AutoNumber65" height="9">



      <tr>

        <td width="100%" bgcolor="#FF0000"></td>

      </tr>

    </table>

        </td>

        <td><span style="font-size: 11px">&nbsp;</span>Blocked</td>

        </tr>

      </table>



              </td>

            </tr>

          </table>

		         <p>

		  <span style="font-size: 11px">Campaigns not approved:</span> 

			<a style='cursor:help;'  onmouseover="Tip('How many campaigns were declined (not appropriate).', BORDERCOLOR, '#CFCFB3', BGCOLOR, '#f9f9d7', WIDTH, -180, FONTFACE, 'Arial,Tahoma', FONTSIZE, '12px')" onMouseOut="UnTip()">

			<span style="font-size: 11px"><?php

		  $sql2=dbQuery("select * from `jobs` where `email`='".$_SESSION["userlogin"]."' and `status`='0' ");

		 echo  $countjobs2=dbNumRows($sql2); 

		  ?></span></a>

&nbsp;</p>

		         </td>

              </tr>

            </table>

		

		</td>

	</tr>		 

	 <tr>

   		 <td>&nbsp;</td>

	 </tr>

	 <tr>

   		 <td align="left">

		 

		 <table border="0" cellspacing="0" cellpadding="0">

			<tr>

				<td>

                <A HREF="employer_new_campaign.php">

                <IMG BORDER="0" SRC="images/startcamp.gif" WIDTH="48" HEIGHT="48"></A></td>

				<td><b>&nbsp; </b>



      <a href="employer_new_campaign.php">

                <SPAN STYLE="font-size: 16px; font-weight:700">Start a new campaign</SPAN></a></td>

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

			

			$sql=dbQuery("select * from `jobs` where `email`='".$_SESSION["userlogin"]."' and `status`<>'5' ORDER BY ".$key." ".$sort." ");

			}

			else

			{

			$sql=dbQuery("select * from `jobs` where `email`='".$_SESSION["userlogin"]."' and `status`<>'5' ORDER BY `price` desc");

			}

			$countjobs=dbNumRows($sql);

			?>

			<table width="100%" border="0" cellspacing="0" cellpadding="0">

			  <tr>

				<td class="table_content_left"></td>

				<td class="table_content_middle">

				

				<table width="100%" border="0" cellspacing="0" cellpadding="0">

				  <tr>

					<td width="40%" align="left" style="font-weight:bold; padding-left:20px;">Job name<br />

					<a href="employer.php?key=title&sort=asc"><img src="images/up.gif" border="0"></a> 

					<a href="employer.php?key=title&sort=desc"><img src="images/down.gif" border="0"></a></td>				   

				   <td width="10%" align="left" style="font-weight:bold;">Started<br />

					<a href="employer.php?key=started&sort=asc"><img src="images/up.gif" border="0"></a> 

					<a href="employer.php?key=started&sort=desc"><img src="images/down.gif" border="0"></a></td>

				   <td width="7%" align="left" style="font-weight:bold;">Payment<br />

					<a href="employer.php?key=price&sort=asc"><img src="images/up.gif" border="0"></a> 

					<a href="employer.php?key=price&sort=desc"><img src="images/down.gif" border="0"></a></td>

				   <td width="7%" align="left" style="font-weight:bold;">Time<br />

					<a href="employer.php?key=time&sort=asc"><img src="images/up.gif" border="0"></a> 

					<a href="employer.php?key=time&sort=desc"><img src="images/down.gif" border="0"></a></td>

				   <td width="7%" align="left" valign="top" style="font-weight:bold;">Status</td>

				   <td width="7%" align="left" style="font-weight:bold;">Done<br />

					<a href="employer.php?key=wd1/wd2&sort=asc"><img src="images/up.gif" border="0"></a> 

					<a href="employer.php?key=wd1/wd2&sort=desc"><img src="images/down.gif" border="0"></a></td>					

					<td width="7%" align="left" valign="top" style="font-weight:bold;">Tasks Complete</td>

					<td width="10%" align="left" valign="top" style="font-weight:bold;">&nbsp;&nbsp;&nbsp;&nbsp;Jobs</td>

					<td width="30" align="left" valign="top" style="font-weight:bold; padding-right:10px;">Edit</td>

				  </tr>

				</table>

				

				</td>

				<td class="table_content_right"></td>

			  </tr>

			  	

			<?php

			if($countjobs>0) { 

			

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

			

			$apcount=dbNumRows(dbQuery("select * from `jobs_application` where `jobid`='".$res["id"]."'"));

				

			?>				   

				<tr>				

				<td colspan="3" class="<?php if($c%2==0) { echo 'td_dark_backg'; } else { echo 'td_light_backg'; } ?>" onmouseover="javascript :  this.style.backgroundColor='#CAE7EE';" onmouseout="javascript : this.style.backgroundColor='<?php if($res["highlighted"]=='1') { echo '#ABDAE4';} else if($cnt%2==0 && $res["highlighted"]!='1') { echo '#EEEEEE'; } else if($res["highlighted"]!='1') { echo '#F8F8F8'; } ?>';" style="padding-left:20px; <?php if($res["highlighted"]=='1') { echo 'background-color:#ABDAE4;';} ?>">

				

				<table width="100%" border="0" cellspacing="0" cellpadding="0">

				  <tr>

					

			   <td width="39%" height="28" align="left">

			   <a href="<?php if($res["status"]=='1') { echo 'jobs_details'; } else { echo 'jobs_details_notrunning'; }?>.php?Id=<?php echo base64_encode($res["id"]); ?>" style="text-decoration:none"> <div style="float:left;"><div style="float:left;"><?php if($res["country"]=='INT') { echo '<img src="images/Globe.png" height="16" width="16" border="0" />&nbsp;&nbsp;'; } else if($res["country"]=='USA') { echo '<img src="images/USFlag.png" height="16" width="16" border="0" />&nbsp;&nbsp;'; }?></div><div style="float:left;padding-top:2px;"><?php if($res["bold"]=='1') { echo '<b>'.$job_title.'</b>'; } else { echo $job_title; } ?></div></div></a>

			   </td>

			   <td width="10%" height="28" align="left"><?php $start=strtotime($res["started"]); $end=strtotime($totaldate);	 if( $diff=get_day_difference($start,$end)) {							

					if($diff['days']==0 && $diff['hours']==0 && $diff['minutes']==0) { echo 'few&nbsp;secs&nbsp;ago'; }

					if($diff['days']==0 && $diff['hours']==0 && $diff['minutes']==1) { echo $diff['minutes'].'&nbsp;min&nbsp;ago'; }

					if($diff['days']==0 && $diff['hours']==0 && $diff['minutes'] > 1) { echo $diff['minutes'].'&nbsp;mins&nbsp;ago'; }

					if($diff['days']==0 && $diff['hours']==0) { echo $diff['hours'].'&nbsp;hour&nbsp;ago'; }

					if($diff['days']==0 && $diff['hours'] > 0) { echo $diff['hours'].'&nbsp;hours&nbsp;ago'; }

					if($diff['days']==1) { echo $diff['days'].'&nbsp;day&nbsp;ago'; }

					if($diff['days']>1 && $diff['days'] <= 7) { echo $diff['days'].'&nbsp;days&nbsp;ago'; }							

					if($diff['days']>7) { echo $format; }	

					} ?></td>

			   <td width="7%" height="28" align="left"> $<?php echo number_format($res["price"], 2); ?></td>

			   <td width="7%" height="28" align="left"> <?php echo stripslashes($res["time"]); ?> min</td>

			   <td width="7%" height="28" align="left" style="padding-left:7px;"> <?php if($res["status"]=='3') { ?>

					<table border="1" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="9" id="AutoNumber40" height="9">

					<tr>

					<td width="100%" bgcolor="#FFFFFF"></td>

					</tr>

					</table>

					<?php } else if($res["status"]=='2') { ?>

					<table border="1" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="9" id="AutoNumber40" height="9">

					<tr>

					<td width="100%" bgcolor="#008000"></td>

					</tr>

					</table>

					<?php } else if($res["status"]=='1') { ?>

					<table border="1" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="9" id="AutoNumber40" height="9">

					<tr>

					<td width="100%" bgcolor="#99FF99"></td>

					</tr>

					</table>

				<?php } else if($res["status"]=='4') { ?>

				<table border="1" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="9" id="AutoNumber40" height="9">

					<tr>

					<td width="100%" bgcolor="#FF0000"></td>

					</tr>

				</table>

				

			   <?php } else if($res["status"]=='0') {?>

			   <table border="1" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="9" id="AutoNumber40" height="9">

					<tr>

					<td width="100%" bgcolor="#FFCC00"></td>

					</tr>

				 </table>

			   <?php }?></td>

			   <td width="7%" height="28" align="left"> <?php echo stripslashes($res["wd1"]); ?>/<sup><?php echo stripslashes($res["wd2"]); ?>&nbsp; </sup></td>

			   

			   <td width="7%" align="left"><?php if($apcount>0) { ?><a href="employee_application.php?Id=<?php echo base64_encode($res["id"]); ?>"><?php } echo $apcount; if($apcount>0) { ?></a><?php } ?></td>

			   <td width="10%" align="left"><select name="action" id="action" onChange="javascript: if(this.value!='') { document.F<?php echo $res["id"]; ?>.submit(); } else { alert('please choose your action to do.'); }" style="width:70px;" <?php if($res["status"]!="") { echo'disabled="disabled"';} ?> >

<option value=""></option>

<option value="1" <?php if($res["status"]=='1') { echo 'selected="selected"'; } ?> disabled="disabled"  >Running</option>

<option value="0" <?php if($res["status"]=='0') { echo 'selected="selected"'; } ?> disabled="disabled" >Pending</option>	

<option value="4" <?php if($res["status"]=='4') { echo 'selected="selected"'; } ?> disabled="disabled"  >Blocked</option>

<option value="2" <?php if($res["status"]=='2') { echo 'selected="selected"'; } ?> disabled="disabled"  >Paused</option>

<option value="3" <?php if($res["status"]=='3') { echo 'selected="selected"'; } ?> disabled="disabled"  >Finished</option>

<option value="5" <?php if($res["status"]=='5') { echo 'selected="selected"'; } ?> disabled="disabled"  >Delete</option>

</select></td>

  			   <td width="30" align="left" style="padding-left:7px;"><a href="edit_job.php?Id=<?php echo base64_encode($res["id"]); ?>" style="text-decoration:none; color:#000000; font-weight:bold">

			  EDIT</a></td>

					

				  </tr>

				</table>

				

				</td>			

			   </tr>						

			<?php 

				 $cnt =	$cnt+1;
				 $c = $c+1;
				 }

			 }

			 else {

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