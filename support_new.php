<?php 
include("include/header.php");
if(!isset($_SESSION["userlogin"])) { header("location: login.php"); exit(); }
$support=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$_SESSION["userlogin"]."'"),MYSQL_BOTH);
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
					<td width="100%" align="left" style="font-weight:bold; padding-left:10px;">Support New Message</td>
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

      <table border="0" cellspacing="0" style="border-collapse: collapse" id="AutoNumber13" cellpadding="0">

        <tr>

          <td nowrap><b><font color="#F62355">01</font> Enter a question</b></td>

          <td nowrap>&nbsp;</td>

          <td nowrap>02 Confirmation</td>

        </tr>

        <tr>

          <td nowrap colspan="3">

          <img border="0" src="images/p.gif" width="3" height="3"></td>

        </tr>

        <tr>

          <td nowrap bgcolor="#F62355">

          <img border="0" src="images/p.gif" width="3" height="3"></td>

          <td nowrap bgcolor="#DDDDDD">

          <img border="0" src="images/p.gif" width="12" height="3"></td>

          <td nowrap bgcolor="#DDDDDD">

          <img border="0" src="images/p.gif" width="3" height="3"></td>

        </tr>

      </table>

      <form name="ff" method="post" action="support_new2.php" onsubmit="return blancheck();">

        <p style="line-height: 150%"><br>

		If you are referring to a job or campaign, enter its ID.<br>

		If you are referring to users, use their ID.<br>

		When describing a problem write as many details as possible.</p>

        <p style="line-height: 150%">&nbsp;</p>

		<TABLE BORDER="0" CELLSPACING="0" STYLE="border-collapse: collapse" BORDERCOLOR="#111111" CELLPADDING="5">

          <TR>
            <TD WIDTH="33%" VALIGN="top" NOWRAP><B>Worker issues</B><P>
            <INPUT TYPE="radio" VALUE="Worker-CAMPAIGN" NAME="Type"> Campaign not 
            working as described<BR>
            <INPUT TYPE="radio" VALUE="Worker-MISRATED" NAME="Type"> Employer 
            misrated me<BR>
            <INPUT TYPE="radio" VALUE="Worker-MONEY" NAME="Type"> Withdrawals<BR>

            <INPUT TYPE="radio" VALUE="Worker-OTHER" NAME="Type"> Other (Workers)</TD>
            <TD WIDTH="33%" VALIGN="top"><B>Employer issues</B><P>
            <I>
            <INPUT TYPE="radio" VALUE="Employer-CAMPAIGN" NAME="Type"></I> Campaign 
            question<BR>
            <INPUT TYPE="radio" VALUE="Employer-MONEY" NAME="Type"> Money Deposit<BR>

            <INPUT TYPE="radio" VALUE="Employer-REPORTING" NAME="Type"> Reporting a 
            Worker or Task<BR>
            <INPUT TYPE="radio" VALUE="Employer-OTHER" NAME="Type"> Other (Employer)</TD>
            <TD WIDTH="33%" VALIGN="top"><B>&nbsp;Other</B><P>
            <INPUT TYPE="radio" VALUE="Other-ACCOUNT" NAME="Type"> Account<BR>
            <INPUT TYPE="radio" VALUE="Other-GENERAL" NAME="Type"> General questions</TD>

          </TR>
        </TABLE>

		<p><br>

		<b>Subject</b><br>

		<input type="text" name="Subject" size="60" value=""></p>

		<p><b>Question</b><br>

		<textarea rows="15" name="Message" cols="60"></textarea></p>

		<p>

            <input type="submit" value="Send message" name="Button"></p>

      </form>

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
					   
<script language="javascript" type="text/javascript">
function blancheck() {
	if(radio_button_checker()==false) {
	alert("Please select a Type.");
	document.ff.Type[0].focus();
	return false;
	}
	if(document.ff.Subject.value=='') {
	alert("Please enter a Subject.");
	document.ff.Subject.focus();
	return false;
	}
	if(document.ff.Message.value=='') {
	alert("Please enter a Message.");
	document.ff.Message.focus();
	return false;
	}
}
function radio_button_checker()
	{	
	var radio_choice = false;	
	for (counter = 0; counter < document.ff.Type.length; counter++)
	{	
	if (document.ff.Type[counter].checked)
	radio_choice = true; 
	}
	if (!radio_choice)
	{		
	return false;
	}
	return true;
}
</script>			       
					
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