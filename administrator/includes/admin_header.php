<?php 
	include('../settings/config.php');
	include("../include/class.pager.php");
	if(!isset($_SESSION["adminusername"]))
	{
		header("location: index.php?mg=session");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $SiteName; ?> - Secure Admin Area</title>
<link rel="stylesheet" type="text/css" href="css/admin_styles_main.css" />
<link rel="stylesheet" type="text/css" href="../js/jquery-ui-1.7.2.custom.css" />
<script language="javascript" src="../js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery-1.3.2.min.js"></script>
<SCRIPT LANGUAGE="JavaScript" SRC="js/CalendarPopup.js"></SCRIPT>
<script type="text/javascript" language="javascript" src="js/ui.datepicker.js"></script>
<script type="text/javascript" language="javascript" src="js/ui.core.js"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js" charset="utf-8"></script>
<script type="text/javascript" src="ckeditor/ckfinder/ckfinder.js" charset="utf-8"></script>
<script type="text/javascript" language="javascript">
jQuery.noConflict();
	jQuery(function(){
		jQuery(".box").hover(
			function () {
				jQuery(this).addClass("box-hover");
			}, 
			function () {
				jQuery(this).removeClass("box-hover");
			}
		);
	});
</script>
<script language="javascript" src="../validator/function.js"></script>
</head>
<?php 
if(isset($_SESSION["adminusername"])) {
$res = dbQuery("select * from `adminlogin` where `username`='".$_SESSION["adminusername"]."'");
$rec = dbFetchArray($res,MYSQL_BOTH);
}
?>
<body>
	<div style="width:892px; margin:10px auto; border:dashed 1px #C7C7C7; padding:3px;">
    	<div style="text-align:right; text-transform:uppercase; margin-bottom:5px; font-size:10px; width:100%; overflow:hidden;">
        	<div style="float:left; font-size:11px; text-align:left;"> welcome back, <b><?php if(isset($_SESSION["adminusername"])) { echo $_SESSION["adminusername"]; } ?></b><br /><span style="font-size:10px; color:#949494;">Last login: <?php if(isset($_SESSION["adminusername"])) { echo date(" jS F Y g:i a", strtotime($rec["logintime"])); } ?></span></div>
            <div style="float:right">
            <a href="adminhome.php" style="text-decoration:none;"><img src="media/house.png" /> home</a>&nbsp;&nbsp;
            <a href="myaccout.php" style="text-decoration:none;"><img src="media/vcard.png" /> my account</a>&nbsp;&nbsp;
            <a href="changepassword.php" style="text-decoration:none;"><img src="media/key.png" /> change password</a>&nbsp;&nbsp;
            <a href="#;" onclick="javascript: window.open('<?php echo $URL; ?>');" style="text-decoration:none;"><img src="media/world.png" /> site home</a>&nbsp;&nbsp;			
            <a href="#;" onclick="gologout()" style="text-decoration:none;"><img src="media/door_in.png" /> logout</a></div>
        </div>
        <script language="javascript" type="text/javascript">
		function gologout()
		{
			if(confirm("Are you sure you want to Logout?"))
			{
				window.location.href="logout.php";	
			}			
		}
		</script>
        <div style="margin-bottom:5px;"><img src="media/host_keyboards_v5.jpg" /></div>
        <table width="100%" cellpadding="0" cellspacing="0">
        	<tr>
            	<td align="left" valign="top" width="150">
					<div class="box"><a href="pagemanagement.php">Page Management</a></div>
					<div class="box"><a href="mailsettings.php">Mailing Templates</a></div>					
					<div class="box"><a href="mailtousers.php">Mail to Users</a></div>
                	<div class="box"><a href="userlist.php">Manage users</a></div>
					<div class="box"><a href="money_list.php">Manage Money</a></div>				
					<div class="box"><a href="addjobs.php">Jobs: Add</a></div>					
					<div class="box"><a href="managejobs.php">Jobs: Manage</a></div>
					<div class="box"><a href="userhiddenjoblist.php">User Hidden Jobs</a></div>
					<div class="box"><a href="managejobapplication.php">Completed Tasks</a></div>
					<div class="box"><a href="paypalid.php">Set PaymentID</a></div>	
					<div class="box"><a href="managesupport.php">Support</a></div>
					<div class="box"><a href="managewithdraw.php">Withdraw</a></div>
					<div class="box"><a href="newsletter.php">Send Newsletter</a></div>
					<div class="box"><a href="userlog.php">Ban Users/IP</a></div>				
                </td>
                <td align="left" valign="top" width="5">&nbsp;</td>
                <td align="left" valign="top">
                	
                   