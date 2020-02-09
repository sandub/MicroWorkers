<?php 
include('settings/config.php');
?>
<link href="styles/main.css" rel="stylesheet" type="text/css">
  <table align=center border="0" cellpadding="0" width="550" id="AutoNumber53" style="border-collapse: collapse" bordercolor="#111111">
    <tr>       
      <td bgcolor="#FFFFFF">
  
		<table width="100%" border="0" cellpadding="20" cellspacing="0" bgcolor="#E5E5E5">
			<tr>
				<td align="center">
				
				
       <TABLE BORDER="0" CELLSPACING="0" STYLE="border-collapse: collapse" BORDERCOLOR="#111111" WIDTH="490" CELLPADDING="0">
          <TR>
            <TD WIDTH="100%">
			
			<?php
					  $sqlmac=dbQuery("select * from `user_registration` where `referrer`='".$_SESSION["userlogin"]."'");
					  if(dbNumRows($sqlmac)>0) { ?>
					  <table width="490" border="1" cellpadding="5" cellspacing="5" bordercolor="#4EBBE4" class="submit" style="border:1px solid #4EBBE4; border-collapse:collapse">
						  <tr>
							<td align="center" style="font-weight:bold; color:#999999;" width="175">Referred Users</td>
							<td align="center" style="font-weight:bold; color:#999999;" width="175">Full name</td>
							<td align="center" style="font-weight:bold; color:#999999;" width="70">Account Balance</td>
							<td align="center" style="font-weight:bold; color:#999999;" width="70">Signup Date</td>
						  </tr>
						<?php
						$totalreferal=0;
					    while($resaccount=dbFetchArray($sqlmac,MYSQL_BOTH)) {
					    ?>
						  <tr>
							<td align="center" width="175">
							<?php
							 echo $resaccount["email"];
							 ?>
							</td>
							<td align="center" width="175">
							<?php 							
							echo stripslashes($resaccount["fullname"]);
							 ?>
							 </td>
							 <td align="center" width="70">
							<?php 							
							echo number_format($resaccount["current_balance"],'2','.','');
							 ?>
							 </td>
							<td align="center" width="70"><?php echo date("m/d/Y",strtotime($resaccount["createdate"])); ?></td>
						  </tr>
					   <?php } ?>						 
					  </table>
				 	 <p>&nbsp;</p><?php } else { ?>
					 <span class="submit">No Referred User</span><?php } ?> 
			
			</TD>
          </TR>
        </TABLE>
		
		  
      </td>
		</tr>
		</table>
      </td>
    </tr>
  </table>