<?php 
	$Minutes_to_finish=$_REQUEST["Minutes_to_finish"];
	$Available_positions=$_REQUEST["Available_positions"];
	$Payment_per_task=$_REQUEST["Payment_per_task"];
	$Required_work=nl2br($_REQUEST["Required_work"]);
 	$Required_proof=nl2br($_REQUEST["Required_proof"]);

	if($_REQUEST["name"]!="")
	{
	$Title=$_REQUEST["name"];
	}
	else
	{
	$Title=$_REQUEST["Title"];
	}
		
	if($_REQUEST["name"]!="")
	{
	$highlight=$extra_price;
	}
	else
	{
	$highlight=$normal_price;
	}
	$wd2=(addslashes($_POST["Available_positions"]));
?>	
<link href="styles/main.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="middle">
	
	<table align="center" border="0" cellpadding="0" width="500" id="AutoNumber53" style="border-collapse: collapse" bordercolor="#111111">
    <tr>      
      <td bgcolor="#FFFFFF">
            <table border="0" width="100%" cellspacing="0" cellpadding="12">
			<tr>
				<td bgcolor="#F5F5F5" style="padding:10px;">
				  <b>&nbsp; </b>
				  <b>Job Preview</b></td>
					</tr>
				</table>
 <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber52">
    <tr>
      <td width="100%" bgcolor="#dddddd" style="padding:10px;">

      <img border="0" src="images/p.gif" width="1" height="1"></td>
    </tr>
  </table>
		    <table width="100%" height="100%" border="0" cellpadding="20" cellspacing="0" bgcolor="#E5E5E5">
			<tr>
				<td style="padding:10px;">
      <table border="0" cellpadding="0" style="border-collapse: collapse"  id="AutoNumber28">
        <tr>
          <td>
        <span style="font-size: 18px; font-weight: 700">
		<?php echo $Title; ?></span><p style="line-height: 150%">Work done: <b><?php echo '0'; ?>/</b><sup><b><?php echo $wd2; ?></b><br>
      </sup>You will earn <b>$<?php echo $Payment_per_task; ?><br>
      </b>This task takes less than <b><?php echo $Minutes_to_finish; ?></b> 
            minutes to finish<br>       
            </td>
          </tr>
        </table>

        <TABLE BORDER="0" CELLSPACING="0" STYLE="border-collapse: collapse" BORDERCOLOR="#111111" WIDTH="100%" CELLPADDING="0">
          <TR>
            <TD WIDTH="100%"><BR>
&nbsp; </TD>
          </TR>
        </TABLE>
      <table border="0" cellpadding="7" cellspacing="1" id="AutoNumber56"  bgcolor="#CFCFB3">
        <tr>
          <td bgcolor="#D9FFD9" valign="top">

        <P STYLE="line-height: 150%">
		<B><FONT COLOR="#DD0000">Campaign isn&#39;t working?<BR>
        </FONT></B>If a Campaign does not work, please report that immediately.<BR>
        Include Campaign name and Campaign ID&nbsp;&nbsp; </td>
        </tr>

      </table>
			<TABLE BORDER="0" CELLSPACING="0" STYLE="border-collapse: collapse" BORDERCOLOR="#111111" WIDTH="100%" CELLPADDING="0">
              <TR>
                <TD WIDTH="100%">&nbsp;<BR>
&nbsp; </TD>
              </TR>
        </TABLE><BR><BR>
      <table border="0" cellspacing="0" cellpadding="0">
		<tr>

			<td bgcolor="#0099FF" width=20 align="center"><b><font color="#FFFFFF">?</font></b></td>
			<td><b>&nbsp; What is expected from workers?</b></td>
		</tr>
		</table>
		<p style="line-height: 150%"><?php echo $Required_work; ?></p><BR><BR>
		<table border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td bgcolor="#DD0000" width=20>
				<p align="center"><font color="#FFFFFF"><b>!</b></font></td>

				<td><b>&nbsp; Required proof that task was finished?</b></td>
			</tr>
		</table>
          <p style="line-height: 150%"><?php echo $Required_proof; ?></p>	
		</td>
        </tr>
      </table>        
      </td>      
    </tr>
</table>
	
	</td>
  </tr>
</table>

