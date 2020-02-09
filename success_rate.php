<?php 
include("include/header.php");
if(!isset($_SESSION["userlogin"])) { header("location: login.php"); exit(); }
$rate=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$_SESSION["userlogin"]."'"),MYSQL_BOTH);
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
					<td width="100%" align="left" style="font-weight:bold; padding-left:10px;">Success Rate</td>
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
                   <td colspan="3"><table width="704" border="0" cellspacing="0" cellpadding="0">
                     

                     <tr>
                       <td><table border="0" width="100%" cellspacing="0" cellpadding="20">

	  <tr>
	  <td>
      If you are a Worker...</p>
      <p style="line-height: 150%">You must maintain your Success rate above <b>
      75%</b> at all times.</p>

      <p style="line-height: 150%">If you have submitted more than 5 
      tasks in period of 30 days and your <br />
      Success rate goes below <b>75%</b>
      you will not be able to submit tasks for 1-30 days.<span style="font-size: 18px"><br /><br />
<?php
$sql=dbQuery("select * from `success_rate` where `email`='".$_SESSION["userlogin"]."'");
$count=dbNumRows($sql);
$satisfied=0;
$notsatisfied=0;
if($count>0) {
	while($res=dbFetchArray($sql,MYSQL_BOTH)) {
		if($res["status"]=='2') {
		$notsatisfied=$notsatisfied+1;
		} else if($res["status"]=='3') {
		$satisfied=$satisfied+1;
		}
	}
} 
if($count==0) {
$satisfy='100';
} else {
$satisfy = floor((($satisfied/$count)*100)); 
}
if($satisfy>75) {
dbQuery("update `user_registration` set `submittask`='0' where `email`='".$_SESSION["userlogin"]."'");
} else {
dbQuery("update `user_registration` set `submittask`='1' where `email`='".$_SESSION["userlogin"]."'");
}
?>
      Your current Success rate is <?php echo $satisfy; ?>%<br>
&nbsp;</span></p>
		<table border="0" cellspacing=3 cellpadding=10 bgcolor="#DDDDDD">

          <tr>
            <td width="100%" bgcolor="#FFFFFF" style="padding:10px;">Employers rated Tasks you have 
    finished in past 30 days:<br>
&nbsp;
    <table border="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber57" cellpadding="4">
      <tr>
        <td align="center">
    <img border="0" src="images/task-ok2.gif" width="14" height="15"></td>
        <td>&nbsp;&nbsp; </td>

        <td><B>&nbsp;Satisfied </B> </td>
        <td><span style="font-size: 11px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></td>
        <td align="right"><b><?php echo $satisfied; ?></b></td>
        </tr>
      <tr>
        <td align="center">
    <img border="0" src="images/task-nok2.gif" width="14" height="15"></td>

        <td>&nbsp;</td>
        <td><B>&nbsp;Not satisfied</B></td>
        <td>&nbsp;</td>
        <td align="right"><b><?php echo $notsatisfied; ?></b></td>
        </tr>
      </table>
		    <p align="left">Success rate will adjust automatically.</td>

          </tr>
      </table>
      <p style="line-height: 150%"><br />
      <b>Did Employer misrated your task?</b></p>
       <p style="line-height: 150%">If you think Employers have misrated any of 
      your tasks, please open<br />
      a Support ticket and explain why do you think your task should be rated 
      Satisfied.</p>
        <p style="line-height: 150%">Include these parameters:</p>
		  <ol style="padding-left:20px;">
			  <li> Campaign ID</li>
			  <li> Task ID</li>
			  <li> Why do you think you were misrated? Explain in details.</li>
		  </ol>
        <p style="line-height: 150%">We will review your Complain.</p>
		<p style="line-height: 150%">*Success rate = (Satisfied vs Not-Satisfied 
        tasks) in a period of last 30 days.</p>
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