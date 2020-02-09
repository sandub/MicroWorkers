<?php
include('settings/config.php');
if(!isset($_SESSION["userlogin"])) { header("location: login.php"); exit(); }
include('phpmailer/class.phpmailer.php');
// All Order Records
$sid = session_id();
// Billing Address
if(isset($_SESSION['userlogin'])) {
$user_email = $_SESSION['userlogin']; 
}
if(isset($_GET['Amount'])) {
	$amount = $_GET['Amount'];	
	$resoffer=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$_SESSION['userlogin']."'"),MYSQL_BOTH);
	if($resoffer["bonuscount"]<$WithdrawDepositReferrallimit) {
	$Amount=$amount;
	$fees=(($amount*$DepositFees)/100);
	$amount = $amount+$fees;
	} 
} else { $amount = 0 ; }
//Consignee Address
$amount=round($amount,2);

$ip = $_SERVER['REMOTE_ADDR'];

// Setup class
require_once('include/paypal.class.php'); 								
$p = new paypal_class;             									
$p->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';  //https://www.sandbox.paypal.com/cgi-bin/webscr
//$p->paypal_url = 'https://www.paypal.com/cgi-bin/webscr'; 
            
// setup a variable for this script
$this_script = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$papid=dbFetchArray(dbQuery("select * from `paymentids` where `paypalid`<>''"),MYSQL_BOTH);
// if there is not action variable, set the default action of 'process'
if (empty($_GET['action'])) $_GET['action'] = 'process';  

switch ($_GET['action']) 
{  
    case 'process':      							
      $p->add_field('business', $papid["paypalid"]);//itssab_1246948815_biz@yahoo.com
      $p->add_field('return', $this_script.'?action=success');
      $p->add_field('cancel_return', $this_script.'?action=cancel');
      $p->add_field('notify_url', $this_script.'?action=ipn');
      $p->add_field('item_name','Account Deposit');
      $p->add_field('amount', $amount);
	  $p->add_field('item_number', '1');
      $p->add_field('currency_code','USD');
	  $p->add_field('cpp_header_image', $URL.'images/paypal_750x90.gif');  	  
  	  $p->add_field('custom',"$sid#$user_email#$amount");
      $p->submit_paypal_post();
      break;
      


   case 'success':      									
	  echo "<html><head><title>".$globalsitename." - Processing your Order</title></head><body bgcolor=#CFCFCF>";
	  echo "<p align=\"center\" style=\"font-family:Verdana; font-size:20px; font-weight:bold; color:#000000;\">
	  Thank You For Your Order, Please Wait While You redirected to the main site...</p>";
	  echo "<p align=\"left\" style=\"font-family:Verdana; font-size:10px; color:#000000;\">";
	  echo "<H5 align=\"center\">Redirection in 5 seconds  ....</H5>"; 
	  echo "</p>";
	  echo "<SCRIPT language=\"JavaScript\">";
	  echo "function delay(){";
	  echo "window.location.href='deposit.php?s=".base64_encode("success")."';";
	  echo "}";
	  echo "setTimeout(\"delay()\", 5000);";
	  echo "</script></body></html>";
	  break;


      
   case 'cancel':											    
	  echo "<html><head><title>".$globalsitename." - Processing your Order</title></head><body bgcolor=#CFCFCF><h2 align=\"center\">The order was cancelled</h2>";
	  echo "<H5 align=\"center\">Redirection in 5 seconds  ....</H5>"; 
	  echo "<SCRIPT language=\"JavaScript\">";
	  echo "function delay(){";
	  echo "window.location.href='cancel.php';";
	  echo "}";
	  echo "setTimeout(\"delay()\", 5000);";
	  echo "</script>";
	  echo "</body></html>";	  
	  unset($_SESSION["succ_amount"]);	  
      break;
      


   case 'ipn':          											
      if ($p->validate_ipn()) 
	  {
         $value = explode("#",$p->ipn_data['custom']);
		 $email = $value[1];
		 $amount = $value[2];
		 
		  
		  
		$resoffer=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$email."'"),MYSQL_BOTH);
		
		
		$Amount=$amount;
		dbQuery("insert into `myaccount`(`email`,`amount`,`type`,`createdate`) values('".$email."','$Amount','3','".$totaldate."')");
		
		$rescurbal=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$email."'"),MYSQL_BOTH);
		dbQuery("update `user_registration` set `current_balance`='".($rescurbal["current_balance"]+$Amount)."' where `email`='".$email."'");
		
		  
		  
		  		 
		 $rr = dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$email."'"),MYSQL_BOTH);
		 	 
				 
		 $sig = dbFetchArray(dbQuery("select * from `mailsettings` where `id`='7'"),MYSQL_BOTH);		
		 $Subject1 = stripslashes($sig["subject"]);
		 $TemplateMessage=str_replace("%FULLNAME%", $rr["fullname"], stripslashes($sig["message"]));
		 $TemplateMessage=str_replace("%TOTALAMOUNT%", $rr["current_balance"], $TemplateMessage);	
		 $TemplateMessage=str_replace("%AMOUNT%", $amount, $TemplateMessage);	
		 $mail = new PHPMailer;
		 $mail->FromName = $fromName;
		 $mail->From    = $from;
		 $mail->Subject = $Subject1;
		 $mail->Body    = stripslashes($TemplateMessage);
		 $mail->AltBody = stripslashes($TemplateMessage);					
		 $mail->IsHTML(true);	
		 $mail->AddAddress($rr["email"],$rr["fullname"]);
		 $mail->Send();
		
		 	
			$subject = 'Instant Payment Notification - Recieved Payment';
			$to = 'itssabya@gmail.com';    					
			$body =  "An instant payment was successfully recieved.<br /><br />";
			$body .= "of $".$amount." ";
			$body .= "from ".$email." on ".date('m/d/Y');
			$body .= " at ".date('g:i A')."<br /><br />";
			$body .= "DONE with Success."; 
			$from = $from;	
			mail($to, $subject, $body, $from);		
     }
      break;
 }
?>
