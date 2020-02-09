<?php 
include("include/header.php");
if(!isset($_SESSION["userlogin"])) { header("location: login.php"); exit(); }
$support=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$_SESSION["userlogin"]."'"),MYSQL_BOTH);
if(isset($_GET["Go"]) && $_GET["Go"]!='' && isset($_GET["Id"]) && $_GET["Id"]!='') {
dbQuery("delete from `support` where `id`='".base64_decode($_GET["Id"])."'");
$_SESSION["SeccessDelEmail"]='Yes';
header("location: support.php?Go=".$_GET["Go"]);
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
		
	<?php if(isset($_SESSION["SeccessDelEmail"])) { ?> 
	<tr><td style="font-weight:bold; color:#006633;" valign="top"><br /><br />Message deleted successfully.<br /><br /></td></tr>
    <?php unset($_SESSION["SeccessDelEmail"]); } ?>
		
 	
	<?php 
	if(isset($_GET["Go"])) {
	$sql=dbQuery("select * from `support` where `".base64_decode($_GET["Go"])."`='".$_SESSION["userlogin"]."' order by `id` desc"); 	
	if(dbNumRows($sql)==0) {
	?><div id="accordion">No messages in <b><?php if(base64_decode($_GET["Go"])=='fromemail') { echo 'SENT MAILBOX'; } else { echo 'INBOX'; } ?></b>.</div><?php } else { ?>
	<div id="accordion">
	<?php
	while($res=dbFetchArray($sql,MYSQL_BOTH)) {
	?>	
						
			<div>
				<h3><a href="#"><?php echo stripslashes($res["subject"]).'&nbsp;&nbsp;[&nbsp;'.date("m/d/Y",strtotime($res["createdate"])).'&nbsp;]'; ?></a></h3>
				<div><?php echo stripslashes($res["message"]).'<br /><br />'; ?><a href="support.php?Id=<?php echo base64_encode($res["id"]); ?>&Go=<?php echo $_GET["Go"]; ?>" style="font-size:10px; font-weight:bold; color:#000000">DELETE IT</a>&nbsp;&nbsp;<a href="support_reply.php?Id=<?php echo base64_encode($res["id"]); ?>&Go=<?php echo $_GET["Go"]; ?>" style="font-size:10px; font-weight:bold; color:#000000">REPLY IT</a></div>
			</div>
			
			
	<?php
		}
	?>
	</div>	
	<?php
	}
	} else {
	?>	
<tr><td style="font-weight:bold; color:#006633;" valign="top">Select message box to view details.</td></tr>
  	<?php } ?>
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