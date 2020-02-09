<?php 
include("include/header.php");
if(!isset($_SESSION["userlogin"])) { header("location: login.php"); exit(); }
$det=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$_SESSION["userlogin"]."'"),MYSQL_BOTH);
if(isset($_GET["Id"])) { $res=dbFetchArray(dbQuery("select * from `jobs` where `id`='".base64_decode($_GET["Id"])."'"),MYSQL_BOTH); } else { $res=array(); }
?>

	
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding-left:50px; padding-right:50px;">
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
    	<td>&nbsp;</td>
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
					<td width="100%" align="left" style="font-weight:bold; padding-left:10px;">Job Details Status</td>
				  </tr>
				</table>
				
				</td>
				<td class="table_content_right"></td>
			  </tr>
			  			   
				<tr>				
				<td colspan="3" class="td_dark_backg" style="padding-left:20px;">
				
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td width="100%" align="left" style="padding:10px; line-height:20px;">
					
					
					
			<table width="704" border="0" cellspacing="0" cellpadding="0">

                 <tr>
                   <td colspan="3">
				   <table width="704" border="0" cellspacing="0" cellpadding="0">
                     

                     <tr>
                       <td><table border="0" width="100%" cellspacing="0" cellpadding="20">
			<tr>
				<td>
      <b><br>
		</b>This job is currently not running.<p>&nbsp;</p>

      <table border="0" cellpadding="7" cellspacing="1" width="" id="AutoNumber54"  bgcolor="#dddddd">
        <tr>
          <td bgcolor="#F7F7F7" valign="top" style="padding:20px;">
        Job title: <b><?php if($res["country"]=='INT') { echo '<img src="images/Globe.png" height="16" width="16" border="0" />&nbsp;&nbsp;'; } else if($res["country"]=='USA') { echo '<img src="images/USFlag.png" height="16" width="16" border="0" />&nbsp;&nbsp;'; } echo stripslashes($res["title"]); ?></b></td>
        </tr>
      </table>
      <p><br>
		
<?php if($res["status"]=='3') { ?>
<table name=TABLE border="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber41" cellpadding="0">
  <tr name=FINISHED>
    <td align="center" width="24">
    <table border="1" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="15" id="AutoNumber40" height="15">
      <tr>
        <td width="100%" bgcolor="#FFFFFF"></td>
      </tr>

    </table>
    </td>
    <td>&nbsp;<b>Finished</b> - this job is finished (all positions filled or 
    stopped by the employer)</td>
  </tr name=FINISHED></table name=TABLE>
<?php } else  { ?> 
<table name=TABLE border="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber41" cellpadding="0">
  <tr name=PAUSED_SYSTEM>
    <td align="center" width="24">
    <table border="1" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="15" id="AutoNumber39" height="15">
      <tr>
        <td width="100%" bgcolor="#56783F"></td>
      </tr>
    </table>
    </td>

    <td>&nbsp;<b>Paused by the system</b> - this job was auto paused but will 
    resume soon</td>
  </tr name=PAUSED_SYSTEM></table name=TABLE>
<?php } ?>
</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
      <p>
      <a href="jobs.php" style="text-decoration:none"><b>See available jobs listing</b></a></p>

      			</td>
		</tr>
		</table></td>
	</tr>
	</table></td>
	</tr>
	<tr>
	<td width="9">&nbsp;</td>
	<td>&nbsp;</td>
	<td width="9">&nbsp;</td>
	</tr>
	</table>
					   
							       
					
					</td>
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
   		 <td>&nbsp;</td>
	  </tr>
	</table>
	
	</td>
  </tr>
</table>
	
<?php include("include/footer.php"); ?>