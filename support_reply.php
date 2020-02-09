<?php 
include("include/header.php");
if(!isset($_SESSION["userlogin"])) { header("location: login.php"); exit(); }
$support=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$_SESSION["userlogin"]."'"),MYSQL_BOTH);
if(isset($_GET["Go"]) && $_GET["Go"]!='' && isset($_GET["Id"]) && $_GET["Id"]!='') {
$res=dbFetchArray(dbQuery("select * from `support` where `id`='".base64_decode($_GET["Id"])."'"),MYSQL_BOTH);
} else if(isset($_GET["Go"]) && $_GET["Go"]!='') {
header("location: support.php?Go=".$_GET["Go"]);
exit();
} else {
header("location: support.php");
exit();
}
?>
<link type="text/css" href="css/ui-lightness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />	
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript">
	$(function(){				
		$("#accordion").accordion({ header: "h3" });
	});
</script>
<script language="javascript" src="validator/function.js"></script>
<script>
   function some(getFileName,getWindowName,getHeight,getWidth)
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
					<td width="100%" align="left" style="font-weight:bold; padding-left:10px;">Support</td>
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
					
					
					
			<table width="100%" border="0" cellspacing="0" cellpadding="0">

                 <tr>
                   <td colspan="3">
				   <table width="100%" border="0" cellspacing="0" cellpadding="0">                     

                     <tr>
                       <td><table border="0" width="100%" cellspacing="0" cellpadding="20">
			<tr>
				<td>
      <table border="0" cellpadding="0" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber49" width="100%">
        <tr>
          <td valign="top">
          <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber52">
            <tr>

              <td width="100%"><b>&nbsp;</b></td>
            </tr>
          </table>
          <table border="0" cellpadding="0" cellspacing="0" id="AutoNumber31">
            <tr>
              <td valign="top" width="100%">
        <table border="0" id="AutoNumber51" cellpadding="3" width="190" style="border-collapse: collapse" bordercolor="#aaaaaa">
          <tr>
            <td bgcolor=#eeeeee valign="top" style="border-bottom-style: solid;  border-bottom-width: 1px; border-bottom-color: #dddddd"  nowrap width="100%">

            &nbsp; <a href="support.php?Go=<?php echo base64_encode('toemail'); ?>" style="text-decoration:none">Inbox</a>&nbsp;
            </td>
          </tr>
          <tr>
            <td  valign="top" style="border-bottom-style: solid;  border-bottom-width: 1px; border-bottom-color: #dddddd" nowrap width="100%">&nbsp;
			<a href="support.php?Go=<?php echo base64_encode('fromemail'); ?>" style="text-decoration:none">Sent</a>&nbsp; </td>
          </tr>
          <tr>
            <td valign="top" width="100%">
			<br>
			<br>

      		<b>Do you need help?</b><p><A HREF="support_new.php" style="text-decoration:none">Submit a New message.</A><P>

Use our FAQ pages to learn more about MyMicroJob.</P>
            <P><A HREF="faq.php" style="text-decoration:none"><B>Frequently Asked Questions</B></A></P>
            <P><A HREF="faq-guidelines.php" style="text-decoration:none"><B>Guidelines FAQ</B></A></P>
            <P>Support messages are answered in 2 days. If you can't find the answer to your question in the above 
            documents you can <A HREF="support_new.php" style="text-decoration:none">Submit</A> a Message.</P>
            <P><B>Please do not submit a new message before checking FAQ 
            documents.</B></td>

          </tr>
          </table>
              </td>
            </tr>
          </table>
			</td>
          <td valign="top">
          <img border="0" src="images/p.gif" width="25" height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>

          <td valign="top" width="100%">
          <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber53">
            <tr>
              <td width="100%"><b>&nbsp;</b></td>
            </tr>
            <tr>
              <td width="100%">
<table name=TABLE border="0" cellspacing="0" style="border-collapse: collapse;" bordercolor="#111111" width="100%" id="AutoNumber27" cellpadding="0">
	<tr><td valign="top">
	<form name="ff" method="post" action="support_new3.php" onsubmit="return blancheck();">
	<input type="hidden" name="Type" value="<?php echo stripslashes($res["type"]); ?>">
	<p><br>

		<b>Subject</b><br>

		<input type="text" name="Subject" size="60" value="<?php echo 'Reply: '.stripslashes($res["subject"]); ?>"></p>

		<p><b>Question</b><br>

		<textarea rows="15" name="Message" cols="60"></textarea></p>

		<p>

            <input type="submit" value="Send message" name="Button"></p>

      </form>
	</td></tr>
  </table name=TABLE>
</td>
            </tr>
          </table><br />
		  </td>
        </tr>
      </table>

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