<?php 
include("include/header.php");  
$FAQ=mysql_fetch_array(mysql_query("select * from `cms` where `pname`='FAQ'"));
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
					<td width="100%" align="left" style="font-weight:bold; padding-left:10px;">Frequently Asked Questions</td>
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
					
					<?php echo stripslashes($FAQ["pcontent"]);?>     
					
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