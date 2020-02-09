<?php
include('includes/admin_header.php');

if(isset($_POST["gosave"])) {
  $id = $_GET["id"];

  $proof= addslashes($_POST["proof"]);
  $status= addslashes($_POST["status"]);
  $cause= isset($_POST["cause"])?addslashes($_POST["cause"]):'';

  $sql=dbQuery("update `jobs_application` set `proof`='$proof',`status`='$status',`showcause`='$cause' where `id`='$id';");

  if($status=='3' || $status=='2') {
  $resQ=dbFetchArray(dbQuery("select * from `jobs_application` where `id`='".$id."'"),MYSQL_BOTH);

  $resJ=dbFetchArray(dbQuery("select * from `jobs` where `id`='".$resQ["jobid"]."'"),MYSQL_BOTH);

  $fees=$resJ["price"];

  if(dbNumRows(dbQuery("select * from `success_rate` where `email`='".$resQ["email"]."' and `jobid`='".$resQ["jobid"]."'"))==0) {

  dbQuery("insert into `success_rate`(`email`,`jobid`,`status`) values('".$resQ["email"]."','".$resQ["jobid"]."','".$status."')");
  } else {

  dbQuery("update `success_rate` set `status`='".$status."' where `jobid`='".$resQ["jobid"]."' and `email`='".$resQ["email"]."'");
  }

  if($status=='3') {

  if($fees > 0.11) {
  $deducted_fee = $fees*($FeePerCompletedJob/100);
  } else {
  $deducted_fee = $fees*($FeePerCompletedJobLESS11/100);
  }


  $rescurbal2=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$resQ["email"]."'"),MYSQL_BOTH);

  if(dbNumRows(dbQuery("select * from `jobs_application` where `email`='".$resQ["email"]."' and `status`='3' "))==1) {
  $rescurbal5=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$rescurbal2["referrer"]."'"),MYSQL_BOTH);
  dbQuery("insert into `myaccount`(`email`,`amount`,`type`,`createdate`,`referreduser`) values('".$rescurbal2["referrer"]."','".$ReferralFIRSTJobComplete."','9','".$totaldate."','".$resQ["email"]."')");
  dbQuery("update `user_registration` set `current_balance`='".($rescurbal5["current_balance"]+$ReferralFIRSTJobComplete)."' where `email`='".$rescurbal2["referrer"]."'");
    }

  dbQuery("insert into `myaccount`(`email`,`amount`,`type`,`createdate`,`jobid`) values('".$resQ["email"]."','$deducted_fee','6','".$totaldate."','".$resQ["jobid"]."')");
  dbQuery("update `user_registration` set `current_balance`='".($rescurbal2["current_balance"]+$deducted_fee)."' where `email`='".$resQ["email"]."'");

  } else {
  dbQuery("update `jobs` set `wd1`='".($resJ["wd1"]-1)."' where `id`='".$resQ["jobid"]."'");
  }

  }


  if($id>0)
  {
    header("location: managejobapplication.php?msd=success");
    exit();
  }
  else
  {
    header("location: editjobapplication.php?id=".$id."&action=edit");
    exit();
  }
}
$id=$_GET["id"];
$p = dbFetchArray(dbQuery("select * from `jobs_application` where `id`='$id'"),MYSQL_BOTH);
$q = dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$p["email"]."'"),MYSQL_BOTH);
?>
<div style="margin-bottom:10px;">
    <h1 style="text-transform:uppercase">Please edit a Job application&nbsp;&nbsp;</h1>
    <img src="media/line.png" />
</div>

<div style="padding-bottom:5px;">
<form name="ff" action="editjobapplication.php?id=<?php echo $id; ?>" id="ff" method="post" enctype="multipart/form-data" >
<table border="0" cellpadding="2" cellspacing="2" width="100%">
    <tr>
        <td align="left" valign="top" colspan="2" style="color:#666">Please fillup all the fields.</td>
    </tr>
    <tr>
        <td align="left" valign="top" class="labels"><label for="title">Name:</label></td>
        <td align="left" valign="top" class="rows"><?php echo stripslashes($q["fullname"]); ?></td>
    </tr>
  <tr>
        <td align="left" valign="top" class="labels"><label for="wd1">Email:</label></td>
        <td align="left" valign="top" class="rows"><?php echo stripslashes($p["email"]); ?></td>
    </tr>
  <tr>
        <td align="left" valign="top" class="labels"><label for="proof">Proof:</label></td>
        <td align="left" valign="top" class="rows"><textarea name="proof" id="proof" cols="40" rows="4"><?php echo stripslashes($p["proof"]); ?></textarea></td>
    </tr>
  <tr>
        <td align="left" valign="top" class="labels"><label for="status">Status:</label></td>
        <td align="left" valign="top" class="rows">
    <select id="status" name="status" style="width:80px;" <?php if($p["status"]=="3" || $p["status"]=="2") { ?> disabled="disabled" <?php } ?> >
    <option value="0" <?php if($p["status"]=="0") { ?> selected="selected" <?php } ?> >Pending</option>
    <option value="3" <?php if($p["status"]=="3") { ?> selected="selected" <?php } ?> >Satisfied &amp; Paid</option>
    <option value="1" <?php if($p["status"]=="1") { ?> selected="selected" <?php } ?> >Running</option>
    <option value="2" <?php if($p["status"]=="2") { ?> selected="selected" <?php } ?> >Not Satisfied</option>
    </select></td>
    </tr>
<?php if($p["status"]=="2") { ?>
  <tr>
        <td align="left" valign="top" class="labels"><label for="proof">Show Cause:</label></td>
        <td align="left" valign="top" class="rows"><textarea name="cause" id="cause" cols="40" rows="4"><?php echo stripslashes($p["showcause"]); ?></textarea></td>
    </tr>
<?php } ?>
  <tr>
        <td align="left" valign="top" colspan="2">&nbsp;</td>
    </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top"><button name="gosave" type="submit" class="input">Update Job Application</button>&nbsp;&nbsp;&nbsp;&nbsp;<button name="back" type="button" onClick="javascript: window.location='managejobapplication.php';" class="input">Back</button></td>
    </tr>
</table>
</form>
<script language="javascript" type="text/javascript">
function check()
{
  if(document.getElementById('status').value == "")
  {
     alert('Please Give Status.');
     document.getElementById('status').focus();
     return false;
  }
}
</script>
<script language="JavaScript" type="text/javascript">
var editor = CKEDITOR.replace('proof');
CKFinder.SetupCKEditor( editor, 'ckeditor/ckfinder/' ) ;
</script>
<?php include('includes/admin_footer.php'); ?>

