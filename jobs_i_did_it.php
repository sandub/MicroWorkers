<?php 
include("include/header.php");
if(!isset($_SESSION["userlogin"])) { header("location: login.php"); exit(); }
$did=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$_SESSION["userlogin"]."'"),MYSQL_BOTH);
if(isset($_POST["B1"])) {
$JSQ1=dbQuery("select * from `jobs` where `id`='".$_POST["Id"]."'");
if(dbNumRows($JSQ1)>0) {
	while($JSQ2=dbFetchArray($JSQ1,MYSQL_BOTH)) {				
		if(dbNumRows(dbQuery("select * from `jobs_application` where `jobid`='".$JSQ2["id"]."'"))==$JSQ2["wd2"]) {			
		dbQuery("update `jobs` set `status`='3' where `id`='".$JSQ2["id"]."'");
		$added = 'NO';
		} else {
dbQuery("insert into `jobs_application`(`jobid`,`email`,`proof`,`status`,`appdate`) values('".$_POST["Id"]."','".$_SESSION["userlogin"]."','".addslashes($_POST["Required_proof"])."','1','".$totaldate."')");
$resjob2=dbFetchArray(dbQuery("select * from `jobs` where `id`='".$_POST["Id"]."'"),MYSQL_BOTH);
dbQuery("update `jobs` set `wd1`='".($resjob2["wd1"]+1)."' where `id`='".$resjob2["id"]."'");
$added = 'YES';
	}	
   }
  }
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
					<td width="100%" align="left" style="font-weight:bold; padding-left:10px;">Jobs i did it</td>
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
                       <td>
					<table border="0" width="100%" cellspacing="0" cellpadding="20">
					<tr>
					<td>
					<?php if($added=='YES') { ?>
					<b><br>
					Thank you for finishing the job!</b><p style="line-height: 150%">
					<br>
					Employer will review your task.<br>
					If you are rated "not satisfied" and feel this is a mistake please contact Support and include job title and your email address.</p>
					<p style="line-height: 200%">&nbsp;
					</p>
					
					<p style="line-height: 200%">
					<a href="jobs.php" style="text-decoration:none">Return to Available Jobs</a></p>
					<p style="line-height: 200%">
					<a href="worker.php" style="text-decoration:none"><b>See Tasks You Have Submitted</b></a></p>
					<?php } else if($added=='NO') { ?>
					<b><br>
					Sorry this job is already finished!</b><p style="line-height: 150%">
					<br>
					Please try to take action against another job!</p>
					<p style="line-height: 200%">&nbsp;
					</p>
					
					<p style="line-height: 200%">
					<a href="jobs.php" style="text-decoration:none">Return to Available Jobs</a></p>
					<p style="line-height: 200%">
					<a href="worker.php" style="text-decoration:none"><b>See Tasks You Have Submitted</b></a></p>
					<?php } ?>
					<br />
					</td>
					</tr>
					</table>
					</td>
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