<?php 
include("include/header.php");
if(!isset($_SESSION["userlogin"])) { header("location: login.php"); exit(); }
$support=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$_SESSION["userlogin"]."'"),MYSQL_BOTH);
if(isset($_POST["Button"])) {
	if(isset($_POST["Type"])) {
	$Type=$_POST["Type"];
	} else {
	$Type='';
	}
	$Subject=addslashes($_POST["Subject"]);	
	$Message=addslashes($_POST["Message"]);	
	dbQuery("insert into `support`(`type`,`subject`,`message`,`fromemail`,`toemail`,`createdate`) values('".$Type."','".$Subject."','".$Message."','".$_SESSION["userlogin"]."','".$from."','".$totaldate."')");
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
                   <td colspan="3">
				   <table width="704" border="0" cellspacing="0" cellpadding="0">
                     <tr>
                       <td><table border="0" width="100%" cellspacing="0" cellpadding="20">
			<tr>
				<td>

			<table border="0" cellspacing="0" style="border-collapse: collapse" id="AutoNumber54" cellpadding="0">
				<tr>
					<td nowrap>01 Enter a Question</td>
					<td nowrap>&nbsp;</td>
					<td nowrap><b><font color="#F62355">02</font> Confirmation</b></td>
				</tr>
				<tr>

					<td nowrap colspan="3">
					<img border="0" src="images/p.gif" width="3" height="3"></td>
				</tr>
				<tr>
					<td nowrap bgcolor="#dddddd">
					<img border="0" src="images/p.gif" width="3" height="3"></td>
					<td nowrap bgcolor="#DDDDDD">
					<img border="0" src="images/p.gif" width="12" height="3"></td>
					<td nowrap bgcolor="#F62355">
					<img border="0" src="images/p.gif" width="3" height="3"></td>
				</tr>
			</table>
			<p><br>Message <b>&quot;<?php echo $_POST["Subject"]; ?>&quot;</b> was sent.</p>
			<p>We will get back to with 48 Hours.</p>
			<p>&nbsp;</p>

			<p><a href="jobs.php" style="text-decoration:none"><b>Back to Available jobs</b></a></p>
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