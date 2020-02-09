<?php

include('includes/admin_header.php');

$uid = $_GET["uid"];

$s = dbFetchArray(dbQuery("select * from `user_registration` where `id`='$uid'"),MYSQL_BOTH);

?>

<div style="margin-bottom:10px;">

    <h1 style="text-transform:uppercase">Here is your site user overviews : <?php echo '<font color="#006600">'.stripslashes($s["fullname"]).' < '.$s["email"].' ></font>'; ?></h1>

    <img src="media/line.png" />

</div>

<div style="padding-bottom:5px;">

<table border="0" cellpadding="2" cellspacing="2" width="723">

<?php if(isset($_GET["msd"]) && $_GET["msd"]=="success")  { ?>

    <tr>

        <td align="center" valign="top" colspan="2" style="color:#666"><font color="#009933">The action has been successfully performed!</font></td>

    </tr>

<?php } ?>

<?php if(isset($_SESSION["productdelete"]) && $_SESSION["productdelete"]!="") { ?>

    <tr>

        <td align="center" valign="top" colspan="2" style="color:#666"><font color="#009933">The action has been successfully performed!</font></td>

    </tr>

<?php unset($_SESSION["productdelete"]); } ?>



<form name="ff" id="ff" action="overview.php" method="post" onsubmit="return godelete();">



  <tr>

        <td align="left" valign="top" colspan="2" style="color:#666">Here is details of : <?php echo stripslashes($s["fullname"]).' < '.$s["email"].' >'; ?>.</td>

    </tr>

  <tr>

        <td align="left" valign="top" colspan="2">&nbsp;</td>

    </tr>



    <tr>

    <td colspan="2" align="center" valign="top">



     <?php

      $sqlmac=dbQuery("select * from `myaccount` where `email`='".stripslashes($s["email"])."'");

      if(dbNumRows($sqlmac)>0) { ?>

        <table width="650" border="1" cellpadding="5" cellspacing="5" bordercolor="#4EBBE4" style="border:1px solid #4EBBE4; border-collapse:collapse">

            <tr>

          <td colspan="3" align="center" class="labels" style="font-weight:bold;">Account History</td>

          </tr>

          <tr>

          <td align="center" class="labels" style="font-weight:bold;">Transaction</td>

          <td align="center" class="labels" style="font-weight:bold;">Amount</td>

          <td align="center" class="labels" style="font-weight:bold;">Date</td>

          </tr>

        <?php

        $ul=0;

        while($resmac=dbFetchArray($sqlmac,MYSQL_BOTH)) {

        ?>

          <tr>

          <td align="center" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>">

          <?php

          if($resmac["type"]=='0') { echo 'Withdraw Amount'; }

          if($resmac["type"]=='1') { echo 'Sign Up Bonus'; }

          if($resmac["type"]=='2') { echo 'Sign Up Bonus'; }

          if($resmac["type"]=='3') { echo 'Account Deposit'; }

          if($resmac["type"]=='4') { echo 'Withdraw Charges'; }

          if($resmac["type"]=='5') { echo 'Paid Job : '; }

          $Jres=dbFetchArray(dbQuery("select * from `jobs` where `id`='".$resmac["jobid"]."'"),MYSQL_BOTH);

          if($resmac["type"]=='6') { echo 'Paid Job : ';  echo ($Jres["title"]=='')?'Job Title':stripslashes($Jres["title"]); }

          if($resmac["type"]=='9') { echo 'Referred : '.$resmac["referreduser"]; }

          $Jres=dbFetchArray(dbQuery("select * from `jobs` where `id`='".$resmac["jobid"]."'"),MYSQL_BOTH);

          if($resmac["type"]=='8') { echo 'Job Post : '; echo ($Jres["title"]=='')?'Job Title':stripslashes($Jres["title"]); }

          $Jres=dbFetchArray(dbQuery("select * from `jobs` where `id`='".$resmac["jobid"]."'"),MYSQL_BOTH);

          if($resmac["type"]=='10') { echo 'Job Refund : '; echo ($Jres["title"]=='')?'Job Title':stripslashes($Jres["title"]); }

           ?>

          </td>

          <td align="center">

          <?php

          if($resmac["type"]=='0') { echo '<strong>-</strong>'; }

          if($resmac["type"]=='1') { echo '<strong>+</strong>'; }

          if($resmac["type"]=='2') { echo '<strong>+</strong>'; }

          if($resmac["type"]=='3') { echo '<strong>+</strong>'; }

          if($resmac["type"]=='4') { echo '<strong>-</strong>'; }

          if($resmac["type"]=='5') { echo '<strong>-</strong>'; }

          if($resmac["type"]=='6') { echo '<strong>+</strong>'; }

          if($resmac["type"]=='9') { echo '<strong>+</strong>'; }

          if($resmac["type"]=='8') { echo '<strong>-</strong>'; }

          if($resmac["type"]=='10') { echo '<strong>+</strong>'; }

           echo '$'.number_format($resmac["amount"],'2','.','');

           ?>

           </td>

          <td align="center"><?php echo date("m/d/Y",strtotime($resmac["createdate"])); ?></td>

          </tr>

        <?php $ul=$ul+1; } ?>

         <tr>

          <td align="center" class="labels" style="font-weight:bold;">Total Amount</td>

          <td align="center" class="labels" style="font-weight:bold;">$<?php echo "" . "" . number_format($s["current_balance"],'2','.','');?></td>

          <td align="center" class="labels" style="font-weight:bold;"><?php echo date("m/d/Y"); ?></td>

          </tr>

        </table>

        <p>&nbsp;</p>

     <?php } else { ?>

       <table width="650" border="1" cellpadding="5" cellspacing="5" bordercolor="#4EBBE4" style="border:1px solid #4EBBE4; border-collapse:collapse">

            <tr>

          <td colspan="3" align="center" class="labels" style="font-weight:bold;">Account History</td>

          </tr>

          <tr>

          <td align="center" class="labels" style="font-weight:bold;">Transaction</td>

          <td align="center" class="labels" style="font-weight:bold;">Amount</td>

          <td align="center" class="labels" style="font-weight:bold;">Date</td>

           </tr>

           <tr>

          <td colspan="3" align="center" class="labels">No transactions Yet</td>

          </tr>

      </table>

     <?php } ?>

    </td>

  </tr>

  <tr>

    <td colspan="2" align="center" valign="top">&nbsp;</td>

  </tr>

  <tr>

    <td colspan="2" align="center" valign="top">



     <?php

      $sqljobapp=dbQuery("select * from `jobs_application` where `email`='".stripslashes($s["email"])."'");

      if(dbNumRows($sqljobapp)>0) { ?>

        <table width="650" border="1" cellpadding="5" cellspacing="5" bordercolor="#4EBBE4" style="border:1px solid #4EBBE4; border-collapse:collapse">

            <tr>

          <td colspan="5" align="center" class="labels" style="font-weight:bold;">Job Application Records</td>

          </tr>

          <tr>

          <td colspan="5" align="left" style="font-weight:bold;"><img border="0" src="../images/task-ok2.gif" width="14" height="15">&nbsp;Satisfied &amp; Paid</td>

          </tr>

          <tr>

          <td colspan="5" align="left" style="font-weight:bold;"><img border="0" src="../images/task-nok2.gif" width="14" height="15">&nbsp;Not Satisfied</td>

          </tr>

          <tr>

          <td colspan="5" align="left" style="font-weight:bold;"><img border="0" src="../images/task-notrated7.gif" width="14" height="15">&nbsp;Pending Employer Review</td>

          </tr>



          <tr>

          <td align="center" class="labels" style="font-weight:bold;">Job</td>

          <td align="center" class="labels" style="font-weight:bold;">Proof</td>

          <td align="center" class="labels" style="font-weight:bold;">Status</td>

          <td align="center" class="labels" style="font-weight:bold;">ShowCause</td>

          <td align="center" class="labels" style="font-weight:bold;">Date</td>

          </tr>

        <?php

        $ul=0;

        while($resjobapp=dbFetchArray($sqljobapp,MYSQL_BOTH)) {

        ?>

          <tr>

          <td align="center" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>">

          <?php

          $Jres=dbFetchArray(dbQuery("select * from `jobs` where `id`='".$resjobapp["jobid"]."'"),MYSQL_BOTH);

          echo strip_tags(stripslashes($Jres["title"]));

           ?>

          </td>

          <td align="center" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>">

          <?php echo strip_tags(stripslashes($resjobapp["proof"])); ?>

          </td>

          <td align="center" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>">

                  <?php if($resjobapp["status"]!='2' && $resjobapp["status"]!='3') { ?>

                   <img border="0" src="../images/task-notrated7.gif" width="14" height="15">

                  <?php } else if($resjobapp["status"]=='3') { ?>

                   <img border="0" src="../images/task-ok2.gif" width="14" height="15">

                  <?php } else if($resjobapp["status"]=='2') { ?>

                   <img border="0" src="../images/task-nok2.gif" width="14" height="15">

                  <?php } ?>

          </td>

          <td align="center" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>">

          <?php echo strip_tags(stripslashes($resjobapp["showcause"])); ?>

          </td>

          <td align="center"><?php echo date("m/d/Y",strtotime($resjobapp["appdate"])); ?></td>

          </tr>

        <?php $ul=$ul+1; } ?>

        </table>

        <p>&nbsp;</p>

     <?php } else { ?>

       <table width="650" border="1" cellpadding="5" cellspacing="5" bordercolor="#4EBBE4" style="border:1px solid #4EBBE4; border-collapse:collapse">

           <tr>

          <td colspan="5" align="center" class="labels" style="font-weight:bold;">Job Application Records</td>

          </tr>

           <tr>

          <td align="center" class="labels" style="font-weight:bold;">Job</td>

          <td align="center" class="labels" style="font-weight:bold;">Proof</td>

          <td align="center" class="labels" style="font-weight:bold;">Status</td>

          <td align="center" class="labels" style="font-weight:bold;">ShowCause</td>

          <td align="center" class="labels" style="font-weight:bold;">Date</td>

          </tr>

           <tr>

          <td colspan="5" align="center" class="labels">No transactions Yet</td>

          </tr>

      </table>

     <?php } ?>

    </td>

  </tr>

  <tr>

    <td colspan="2" align="center" valign="top">&nbsp;</td>

  </tr>

  <tr>

  <td colspan="2" align="center" valign="top">

       <?php

      $sqljob=dbQuery("select * from `jobs` where `email`='".stripslashes($s["email"])."'");

      if(dbNumRows($sqljob)>0) { ?>

        <table width="650" border="1" cellpadding="5" cellspacing="5" bordercolor="#4EBBE4" style="border:1px solid #4EBBE4; border-collapse:collapse">

            <tr>

          <td colspan="7" align="center" class="labels" style="font-weight:bold;">Job Posted Records</td>

          </tr>

          <tr>

          <td colspan="7" align="left" style="font-weight:bold;"><table border="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber56">

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

      </table></td>

          </tr>

          <tr>

          <td colspan="7" align="left" style="font-weight:bold;"><table border="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber58">

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

      </table></td>

          </tr>

          <tr>

          <td colspan="7" align="left" style="font-weight:bold;"><table border="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber60">

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

      </table></td>

          </tr>

          <tr>

          <td colspan="7" align="left" style="font-weight:bold;"><table border="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber62">

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

      </table></td>

          </tr>

          <tr>

          <td colspan="7" align="left" style="font-weight:bold;"><table border="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber64">

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

      </table></td>

          </tr>



          <tr>

          <td align="center" class="labels" style="font-weight:bold;">Job</td>

          <td align="center" class="labels" style="font-weight:bold;">Pay</td>

          <td align="center" class="labels" style="font-weight:bold;">Time</td>

          <td align="center" class="labels" style="font-weight:bold;">Status</td>

          <td align="center" class="labels" style="font-weight:bold;">Done</td>

          <td align="center" class="labels" style="font-weight:bold;">Complete</td>

          <td align="center" class="labels" style="font-weight:bold;">Started</td>

          </tr>

        <?php

        $ul=0;

        while($resjob=dbFetchArray($sqljob,MYSQL_BOTH)) {

        $apcount=dbNumRows(dbQuery("select * from `jobs_application` where `jobid`='".$resjob["id"]."'"));

        ?>

          <tr>

          <td align="center" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>">

          <?php echo strip_tags(stripslashes($resjob["title"])); ?>

          </td>

          <td align="center" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>">

          $<?php echo number_format($resjob["price"], 2); ?>

          </td>

          <td align="center" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>">

          <?php echo $resjob["time"]; ?> min

          </td>

          <td align="center" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>">

              <?php if($res["status"]=='3') { ?>

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

              <?php } else if($res["status"]=='1' || $res["status"]=='') { ?>

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

             <?php }?>

          </td>

          <td align="center" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>">

             <?php echo stripslashes($resjob["wd1"]); ?>/<sup><?php echo stripslashes($resjob["wd2"]); ?></sup>

          </td>

          <td align="center" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>">

          <?php echo $apcount; ?>

          </td>



          <td align="center"><?php echo date("m/d/Y",strtotime($resjob["started"])); ?></td>

          </tr>

        <?php $ul=$ul+1; } ?>

        </table>

        <p>&nbsp;</p>

     <?php } else { ?>

       <table width="650" border="1" cellpadding="5" cellspacing="5" bordercolor="#4EBBE4" style="border:1px solid #4EBBE4; border-collapse:collapse">

           <tr>

          <td colspan="7" align="center" class="labels" style="font-weight:bold;">Job Posted Records</td>

          </tr>

          <tr>

          <td align="center" class="labels" style="font-weight:bold;">Job</td>

          <td align="center" class="labels" style="font-weight:bold;">Pay</td>

          <td align="center" class="labels" style="font-weight:bold;">Time</td>

          <td align="center" class="labels" style="font-weight:bold;">Status</td>

          <td align="center" class="labels" style="font-weight:bold;">Done</td>

          <td align="center" class="labels" style="font-weight:bold;">Complete</td>

          <td align="center" class="labels" style="font-weight:bold;">Started</td>

          </tr>

           <tr>

          <td colspan="7" align="center" class="labels">No transactions Yet</td>

          </tr>

      </table>

     <?php } ?>

  </td>

  </tr>

</form>

</table>

<?php include('includes/admin_footer.php'); ?>