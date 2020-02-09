<?php 
include('settings/config.php');

if(isset($_GET["jobid"])) 
{ $res=dbFetchArray(dbQuery("select * from `jobs` where `id`='".$_GET["jobid"]."'"),MYSQL_BOTH); } else { $res=array(); }
$job_title=$res['title'];
$job_title=str_replace("<p>", "", $job_title);
$job_title=str_replace("</p>", "", $job_title);


$sql=dbFetchArray(dbQuery("select * from `jobs_application` where `id`='".$_GET["jid"]."' and `email`='".$_SESSION["userlogin"]."'"),MYSQL_BOTH);
?>
<link href="styles/main.css" rel="stylesheet" type="text/css">
  <table align=center border="0" cellpadding="0" width="540" id="AutoNumber53" style="border-collapse: collapse" bordercolor="#111111">
    <tr>       
      <td bgcolor="#FFFFFF">  
		<table width="100%" border="0" cellpadding="20" cellspacing="0" bgcolor="#E5E5E5">
			<tr>
				<td align="center">				
					  <table border="0" cellpadding="0" style="border-collapse: collapse" width="500" id="AutoNumber28">
					<tr>
					  <td align="left">
			
					<span style="font-size: 18px; font-weight: 700">
					<?php echo $job_title; ?></span>
					<p style="line-height: 150%">Job Name : <b><?php echo $job_title; ?></b><br>
				  </sup>Job ID :  <b><?php echo base64_encode($res["id"]); ?><br>
				  </b>Task ID :  <b><?php echo base64_encode(($sql["id"])); ?></b><br>
					Earned : <b>$<?php echo $res["price"]; ?></b><br>
					Finished : <b><?php echo stripslashes($res["started"]); ?></b><br>
			  &nbsp;</p></td>
					  </tr>
					</table>
					  <TABLE BORDER="0" CELLSPACING="0" STYLE="border-collapse: collapse" BORDERCOLOR="#111111" WIDTH="100%" CELLPADDING="0">
					  <TR>
						<TD WIDTH="100%"><BR>
			&nbsp; </TD>
					  </TR>
					</TABLE>
					  <table border="0" cellpadding="7" cellspacing="1" width="520" id="AutoNumber56"  bgcolor="#CFCFB3">
						<tr>
						  <td valign="top" bgcolor="#D9FFD9" align="left">
						
					
							<TABLE BORDER="0" CELLSPACING="0" STYLE="border-collapse: collapse" BORDERCOLOR="#111111" WIDTH="100%" CELLPADDING="0">
							  <TR>
								<TD WIDTH="100%">&nbsp;<BR>
				&nbsp; </TD>
							  </TR>
						</TABLE>
						<?php if($sql["status"]=='2') { ?>
						<table border="0" cellspacing="0" cellpadding="0">
						<tr>
				
							<td bgcolor="#FF0000" width=20 align="center"><b><font color="#FFFFFF">?</font></b></td>
							<td><b>&nbsp; Not Satisfied Job?</b></td>
						</tr>
						</table>
						<p style="line-height: 150%"><?php echo stripslashes($sql["showcause"]); ?></p>
						<p>&nbsp;</p>
						<?php } ?>
						<table border="0" cellspacing="0" cellpadding="0">
						<tr>
				
							<td bgcolor="#0099FF" width=20 align="center"><b><font color="#FFFFFF">?</font></b></td>
							<td><b>&nbsp; What is expected from workers?</b></td>
						</tr>
						</table>
						<p style="line-height: 150%"><?php echo stripslashes($res["expected"]); ?></p>
						<p>&nbsp;</p>
						<table border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td bgcolor="#003300" width=20>
								<p align="center"><font color="#FFFFFF"><b>!</b></font></td>
				
								<td><b>&nbsp; Required proof that task was finished?</b></td>
							</tr>
						</table>
						  <p style="line-height: 150%"><?php echo stripslashes($res["proof"]); ?></p><br />
						</td>
						</tr>
					  </table>
     			 </td>
		    </tr>
		</table>
      </td>
    </tr>
  </table>