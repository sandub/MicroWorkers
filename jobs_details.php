<?php 
include("include/header.php");
if(!isset($_SESSION["userlogin"])) { header("location: login.php"); exit(); }
if(isset($_GET["Id"])) { $res=dbFetchArray(dbQuery("select * from `jobs` where `id`='".base64_decode($_GET["Id"])."'"),MYSQL_BOTH); } else { $res=array(); }
$job_title=stripslashes($res['title']);
$job_title=str_replace("<p>", "", $job_title);
$job_title=str_replace("</p>", "", $job_title);
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
					<td width="100%" align="left" style="font-weight:bold; padding-left:10px;"><?php if($res["country"]=='INT') { echo '<img src="images/Globe.png" height="16" width="16" border="0" />&nbsp;&nbsp;'; } else if($res["country"]=='USA') { echo '<img src="images/USFlag.png" height="16" width="16" border="0" />&nbsp;&nbsp;'; } echo $job_title; ?></td>
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
					
					
					
					<table width="724" border="0" cellspacing="0" cellpadding="0">

                 <tr>
                   <td colspan="3">
				   <table width="704" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                       <td class="job_content_border">
				<table width="704" border="0" cellspacing="0" cellpadding="0">
                          <tr>
							<td width="20" height="120">&nbsp;</td>
							<td width="120" valign="bottom"><img src="images/jobs_logo.jpg" /></td>
							<td width="564"><b>Work done : <?php echo stripslashes($res["wd1"]); ?>/<sup><?php echo stripslashes($res["wd2"]); ?></sup><br />
								 You will earn $<?php echo stripslashes($res["price"]); ?><br />
								 This task takes less than <b><?php echo stripslashes($res["time"]); ?></b>  minutes to finish<br />
								 job ID : <?php echo base64_encode($res["id"]); ?></b></td>
                     </tr>
                     <tr>
                       <td height="5" colspan="3"></td>
                     </tr>
                     <tr>
                       <td colspan="3"><b>You can accept this job if you are from:</b></td>
                     </tr>
                     <tr>
                       <td colspan="3">&nbsp;</td>
                     </tr>
                     <tr>
                       <td colspan="3">
					   <table width="686" border="0" cellspacing="0" cellpadding="0">
                         <tr>
<?php 
$Co='';
if($res["CA"]=='1') { $Co.= 'CANADA - '; } if($res["UK"]=='1') { $Co.='UK - '; }  if($res["AU"]=='1') { $Co.='AU - '; } 
?>
                                                  
							<td style="padding-left:10px;"><?php if($res["country"]=='INT') { echo '<img src="images/Globe.png" height="16" width="16" border="0" />&nbsp;&nbsp;International - All Countries accepted'; } else if($res["country"]=='USA') { echo '<img src="images/USFlag.png" height="16" width="16" border="0" />&nbsp;&nbsp;Only USA - '.$Co.' Countries accepted'; } ?></td>
							
                          </tr>
                       </table>
					   </td>
                     <tr>
                     <tr>
                       <td height="5" colspan="3"></td>
                     </tr>
                     <tr>
                       <td colspan="3" align="left">
					   <table width="640" border="0" cellspacing="0" cellpadding="0">
                         <tr>
                           <td width="316" height="154" align="left" valign="top" bgcolor="#B0E0E6"><table width="316" border="0" cellspacing="0" cellpadding="0">
                             <tr>
                               <td>&nbsp;</td>
                             </tr>
                             <tr>
                               <td align="center" valign="middle" style="background:url(images/expectation_logo_1.jpg) no-repeat; height:47px; width:316px;"><FONT COLOR="#FFFFFF"><b>What is expected from workers?</b></td>
                             </tr>
                             <tr>
                               <td style="padding:10px;"><?php echo stripslashes($res["expected"]); ?></td>
                             </tr>

                           </table></td>
                           <td width="7">&nbsp;</td>
                           <td width="316" align="left" valign="top" bgcolor="#FFE4B5"><table width="316" border="0" cellspacing="0" cellpadding="0">
                             <tr>
                               <td>&nbsp;</td>
                             </tr>
                             <tr>
                               <td align="center" valign="middle" style="background:url(images/expectation_logo_2.jpg) no-repeat; height:47px; width:316px;"><FONT COLOR="#FFFFFF"><b>Required proof that task was finished?</b></td>
                             </tr>
                             <tr>
                               <td style="padding:10px;"><?php echo stripslashes($res["proof"]); ?></td>
                             </tr>
                           </table></td>
                           
                         </tr>
                       </table>
					   </td>
                     </tr>

						<tr>
						<td colspan="3">
						<?php 
						if(dbNumRows(dbQuery("select * from `jobs_application` where `jobid`='".$res["id"]."' and `email`='".$_SESSION["userlogin"]."'"))==0) { ?>
						<p><b>

						<br>
						Please select</b></p>
						
						<p style="line-height: 200%">
						<a href="jobs.php">Not interested in this job</a><br>
						<a style='cursor:pointer' onclick='return show5();' >I accept this job 
						(A Form will Open Below)</a><br></p>
						<?php } else { ?>
						<p style="padding-left:5px"><b><br>
						<br><font color="#0000FF">You have already taken action against this job</font><br><br><a href="jobs.php" style="text-decoration:none">back to jobs</a></b></p>
						<?php } ?>
						</td>
						</tr>
						
						<tr>
						<td colspan="3" align="left">
	<div style='display:none;' id='formpart' name='formpart'>
          <form method="POST" action="jobs_i_did_it.php" onsubmit="javascript: if(document.getElementById('Required_proof').value=='') { alert('Please enter your job completion proof!'); return false; }">
      <table border="0" cellpadding="7" cellspacing="1" width="520" id="AutoNumber55"  bgcolor="#CFCFB3">
        <tr>

        

        </tr>
        <tr>
          <td bgcolor="#F9F9D7" valign="top" style="padding:10px;">
        <p style="padding:1px; margin:1px;">
		<B><FONT COLOR="#DD0000">Misleading Campaign?<span style="font-size: 16px"><br>
        </span></FONT></B>Report any misleading Campaigns. Make sure to include Employer&#39;s ID, 
        Campaign Title and Campaign ID&nbsp;&nbsp; <A HREF="support_new.php">
        Click to Report</A></p>
<td bgcolor="#F9F9D7" valign="top" style="padding:10px;">
 <P style="padding:1px; margin:1px;">
			<B>Success Rate is Important!</B>
			<BR>
        Accepting a Job and Submitting a false proof will result in 
        Not-Satisfied rating. If your <A HREF="success_rate.php">Success Rate</A> 
        goes below <B>75%</B> you will not be able to submit tasks 
            anymore.

          </td>
        </tr>
      </table>
			<p style="line-height: 150%"><b>Have you Finished this Job?</b></p>
			<p style="line-height: 150%">Enter the Proof in the box below and 
			Press I Confirm.<br />
            You must Fulfill <FONT COLOR="#DD0000"> ALL Requirements </FONT>To be Paid.</p>
       			<p style="line-height: 150%"><b>Enter Required Proof of Finished Job<br> (Please Copy and Paste Proof From Word Doc Rather Than Type In)<br>

            <textarea rows="12" name="Required_proof" id="Required_proof" cols="70"></textarea></b></p>
            <p>
  
            <input type="submit" value="I confirm that I have completed this task" name="B1"><input type="hidden" name="Id" value="<?php echo base64_decode($_GET["Id"]); ?>"></p>
          </form>
          </div>

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
		function show5() {
		if(document.getElementById('formpart').style.display=='none') {
		document.getElementById('formpart').style.display='block';
		} else {
		document.getElementById('formpart').style.display='none';
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