<?php 

include("include/header.php");

include('phpmailer/class.phpmailer.php'); 

$fullname='';

$email='';

$countrycode='';

$password='';



if(isset($_POST["SignupButton"])) {

$fullname=addslashes($_POST["Fullname"]);

$email=addslashes($_POST["Email"]);

$countrycode=addslashes($_POST["Countrycode"]);

$password=base64_encode($_POST["Password"]);

	if(strlen($password)>=3 && strlen($password)<=20) {

		$password=$password;

	} else {

		$_SESSION["signuppassword"]='Yes';

		$_SESSION["signuperror"]='Yes';

	}

	if(strlen($email)>0) {

		$email=$email;

		if(dbNumRows(dbQuery("select * from `user_registration` where `email`='".$email."'"))>0) {

		$_SESSION["signupemailexists"]='Yes';

		$_SESSION["signuperror"]='Yes';

		}

	} else {	

		$_SESSION["signupemail"]='Yes';

		$_SESSION["signuperror"]='Yes';

	}

	if(strlen($countrycode)>0) {

		$countrycode=$countrycode;

	} else {

		$_SESSION["signupcountrycode"]='Yes';

		$_SESSION["signuperror"]='Yes';

	}

	if(strlen($fullname)>0) {

		$fullname=$fullname;

	} else {

		$_SESSION["signupfullname"]='Yes';

		$_SESSION["signuperror"]='Yes';

	}

	

	if(!isset($_SESSION["signuperror"])) {

		if(isset($_POST["referrer"]) && $_POST["referrer"]!='') {

		$REF=$_POST["referrer"];

		} else {

		$REF='';

		}

		dbQuery("insert into `user_registration`(`email`,`password`,`fullname`,`country`,`status`,`referrer`,`newsletter`,`submittask`,`createdate`) values('$email','".$password."','$fullname','$countrycode','0','$REF','1','1','$totaldate');");

		if(dbInsertId()>0) {

			$_SESSION["signupsuccess"]='Yes';

			$_SESSION["signupemailsuccess"]='Yes';

		}

	}

	if(isset($_SESSION["signupemailsuccess"]) &&  $_SESSION["signupemailsuccess"]=='Yes') {

					$sig = dbFetchArray(dbQuery("select * from `mailsettings` where `id`='1'"),MYSQL_BOTH);

					$Subject1 = stripslashes($sig["subject"]);

					$TemplateMessage=str_replace("%EMAIL%", stripslashes($email), stripslashes($sig["message"]));

					$TemplateMessage=str_replace("%PASSWORD%", base64_decode($password), $TemplateMessage);	

					$TemplateMessage=str_replace("%URL%", "<a href='".$URL."emailverified.php?ID=".base64_encode($email)."&PID=".base64_encode($password)."&active=yes' target=\'_blank\'>".$URL."emailverified.php?ID=".base64_encode($email)."&PID=".$password."&active=yes</a>", $TemplateMessage);									

								

					$mail = new PHPMailer;

					$mail->FromName = $fromName;

					$mail->From    = $from;

					$mail->Subject = $Subject1;

					$mail->Body    = stripslashes($TemplateMessage);

					$mail->AltBody = stripslashes($TemplateMessage);					

					$mail->IsHTML(true);	

					$mail->AddAddress($email,$fullname);

					$mail->Send();	

					unset($_SESSION["signupemailsuccess"]);

					header("location: signup.php");

					exit();

									

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

					<td width="100%" align="left" style="font-weight:bold; padding-left:10px;">Sign Up</td>

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

					

<table border="0" width="100%" cellspacing="0" cellpadding="20">

<tr>

<td align="left">

<?php if(!isset($_SESSION["signupsuccess"])) {  ?>

<table border="0" cellspacing="0" style="border-collapse: collapse" id="AutoNumber56" cellpadding="0">		

		<tr>

          <td nowrap><b><font color="#F62355">01</font> New Account Information</b></td>

          <td nowrap>&nbsp;</td>

          <td nowrap>02 Email Verification</td>

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



      <p><br>

<?php if(isset($_SESSION["signuperror"])) { ?>

<table border="0" cellpadding="5" cellspacing="2"  bgcolor="#FF0000" width="360">

  <tr>

    <td width="100%" bgcolor="#F4F4F4" style="font-weight:bold; color:#FF0000;"><ul> <?php if(isset($_SESSION["signuppassword"])) { ?><li>Password not valid (3-20 chars)</li><?php unset($_SESSION["signuppassword"]); } if(isset($_SESSION["signupemailexists"])) { ?><li>Email already taken</li><?php unset($_SESSION["signupemailexists"]); } if(isset($_SESSION["signupemail"])) { ?><li>Email is missing</li><?php unset($_SESSION["signupemail"]); } if(isset($_SESSION["signupfullname"])) { ?><li>Fullname is missing</li><?php unset($_SESSION["signupfullname"]); } if(isset($_SESSION["signupcountrycode"])) { ?><li>Country not selected</li><?php unset($_SESSION["signupcountrycode"]); } ?> <ul></td>

  </tr>

</table>

<?php unset($_SESSION["signuperror"]);  } ?>

&nbsp;&nbsp;&nbsp; </p>

		<p style="line-height: 150%"><b>

            <span lang="en-us">Your</span> name 

			</b> 

			<span lang="en-us"><b>cannot be changed later.<br>

			</b>Please Enter your real name or you will not be able to withdraw money.<br>

			</span></p>



      <form method="post" action="signup.php<?php if(isset($_GET["REF"]) && $_GET["REF"]!='') { echo '?REF='.$_GET["REF"]; } ?>" name="signup" onsubmit="return signupvalidate();" >

        <table border="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber57" cellpadding="6">

          <tr>

            <td valign="top">Full name</td>

            <td valign="top">           

            <input type="text" name="Fullname" size="33" value="<?php echo stripslashes($fullname); ?>">			

			<p>

            <span lang="en-us">To prevent Scam/Spam we allow only one account per person.<br>

			People who create more than one account will be banned&nbsp;<a style='cursor:help; font-weight:700' onmouseover="Tip('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Payments will be issued to your name. For security reasons we don\'t let people change this later.', BORDERCOLOR, '#CFCFB3', BGCOLOR, '#f9f9d7', WIDTH, -180, FONTFACE, 'Arial,Tahoma', FONTSIZE, '12px')" onmouseout="UnTip()">?</a></span></p>

&nbsp; </td>

          </tr>

          <tr>



            <td valign="top">Email</td>

            <td valign="top">

			<input type="text" name="Email" size="33" value="<?php echo stripslashes($email); ?>" onchange="return validateemail();" <?php if($countrycode=='') { echo 'selected="selected"'; } ?> ></td>

          </tr>

          <tr>

            <td valign="top">Password</td>

            <td valign="top">

            <input type="password" name="Password" size="33" value="<?php echo stripslashes($password); ?>">



            <span style="font-size: 11px">&nbsp;[4-20 characters]</span></td>

          </tr>

		  <?php

		  if(isset($_GET["REF"]) && $_GET["REF"]!='') {

		  ?>

		  <input type="hidden" name="referrer" value="<?php echo base64_decode($_GET["REF"]); ?>">		 

		  <?php 

		  }

		  ?>

          <tr>

            <td valign="top">Country of Residence&nbsp;&nbsp; </td>

            <td valign="top"><select size="1" name="Countrycode" id="Countrycode" style="width:194px;" ><option value="" <?php if($countrycode=='') { echo 'selected="selected"'; } ?> >--- Select your Country ---</option>

<option value="Afghanistan" <?php if($countrycode=='Afghanistan') { echo 'selected="selected"'; } ?> >Afghanistan</option>

<option value="Aland Islands" <?php if($countrycode=='Aland Islands') { echo 'selected="selected"'; } ?> >Aland Islands</option>



<option value="Albania" <?php if($countrycode=='Albania') { echo 'selected="selected"'; } ?> >Albania</option>

<option value="Algeria" <?php if($countrycode=='Algeria') { echo 'selected="selected"'; } ?> >Algeria</option>

<option value="American Samoa" <?php if($countrycode=='American Samoa') { echo 'selected="selected"'; } ?> >American Samoa</option>

<option value="Andorra" <?php if($countrycode=='Andorra') { echo 'selected="selected"'; } ?> >Andorra</option>

<option value="Angola" <?php if($countrycode=='Angola') { echo 'selected="selected"'; } ?> >Angola</option>

<option value="Anguilla" <?php if($countrycode=='Anguilla') { echo 'selected="selected"'; } ?> >Anguilla</option>

<option value="Antarctica" <?php if($countrycode=='Antarctica') { echo 'selected="selected"'; } ?> >Antarctica</option>

<option value="Antigua and Barbuda" <?php if($countrycode=='Antigua and Barbuda') { echo 'selected="selected"'; } ?> >Antigua and Barbuda</option>

<option value="Argentina" <?php if($countrycode=='Argentina') { echo 'selected="selected"'; } ?> >Argentina</option>



<option value="Armenia" <?php if($countrycode=='Armenia') { echo 'selected="selected"'; } ?> >Armenia</option>

<option value="Aruba" <?php if($countrycode=='Aruba') { echo 'selected="selected"'; } ?> >Aruba</option>

<option value="Asia-Pacific" <?php if($countrycode=='Asia-Pacific') { echo 'selected="selected"'; } ?> >Asia-Pacific</option>

<option value="Australia" <?php if($countrycode=='Australia') { echo 'selected="selected"'; } ?> >Australia</option>

<option value="Austria" <?php if($countrycode=='Austria') { echo 'selected="selected"'; } ?> >Austria</option>

<option value="Azerbaijan" <?php if($countrycode=='Azerbaijan') { echo 'selected="selected"'; } ?> >Azerbaijan</option>

<option value="Bahamas" <?php if($countrycode=='Bahamas') { echo 'selected="selected"'; } ?> >Bahamas</option>

<option value="Bahrain" <?php if($countrycode=='Bahrain') { echo 'selected="selected"'; } ?> >Bahrain</option>

<option value="Bangladesh" <?php if($countrycode=='Bangladesh') { echo 'selected="selected"'; } ?> >Bangladesh</option>



<option value="Barbados" <?php if($countrycode=='Barbados') { echo 'selected="selected"'; } ?> >Barbados</option>

<option value="Belarus" <?php if($countrycode=='Belarus') { echo 'selected="selected"'; } ?> >Belarus</option>

<option value="Belgium" <?php if($countrycode=='Belgium') { echo 'selected="selected"'; } ?> >Belgium</option>

<option value="Belize" <?php if($countrycode=='Belize') { echo 'selected="selected"'; } ?> >Belize</option>

<option value="Benin" <?php if($countrycode=='Benin') { echo 'selected="selected"'; } ?> >Benin</option>

<option value="Bermuda" <?php if($countrycode=='Bermuda') { echo 'selected="selected"'; } ?> >Bermuda</option>

<option value="Bhutan" <?php if($countrycode=='Bhutan') { echo 'selected="selected"'; } ?> >Bhutan</option>

<option value="Bolivia" <?php if($countrycode=='Bolivia') { echo 'selected="selected"'; } ?> >Bolivia</option>

<option value="Bosnia and Herzegovina" <?php if($countrycode=='Bosnia and Herzegovina') { echo 'selected="selected"'; } ?> >Bosnia and Herzegovina</option>



<option value="Botswana" <?php if($countrycode=='Botswana') { echo 'selected="selected"'; } ?> >Botswana</option>

<option value="Bouvet Island" <?php if($countrycode=='Bouvet Island') { echo 'selected="selected"'; } ?> >Bouvet Island</option>

<option value="Brazil" <?php if($countrycode=='Brazil') { echo 'selected="selected"'; } ?> >Brazil</option>

<option value="British Indian Ocean Territory" <?php if($countrycode=='British Indian Ocean Territory') { echo 'selected="selected"'; } ?> >British Indian Ocean Territory</option>

<option value="Brunei Darussalam" <?php if($countrycode=='Brunei Darussalam') { echo 'selected="selected"'; } ?> >Brunei Darussalam</option>

<option value="Bulgaria" <?php if($countrycode=='Bulgaria') { echo 'selected="selected"'; } ?> >Bulgaria</option>

<option value="Burkina Faso" <?php if($countrycode=='Burkina Faso') { echo 'selected="selected"'; } ?> >Burkina Faso</option>

<option value="Burma (Myanmar)" <?php if($countrycode=='Burma (Myanmar)') { echo 'selected="selected"'; } ?> >Burma (Myanmar)</option>

<option value="Burundi" <?php if($countrycode=='Burundi') { echo 'selected="selected"'; } ?> >Burundi</option>



<option value="Cambodia" <?php if($countrycode=='Cambodia') { echo 'selected="selected"'; } ?> >Cambodia</option>

<option value="Cameroon" <?php if($countrycode=='Cameroon') { echo 'selected="selected"'; } ?> >Cameroon</option>

<option value="Canada" <?php if($countrycode=='Canada') { echo 'selected="selected"'; } ?> >Canada</option>

<option value="Cape Verde" <?php if($countrycode=='Cape Verde') { echo 'selected="selected"'; } ?> >Cape Verde</option>

<option value="Cayman Islands" <?php if($countrycode=='Cayman Islands') { echo 'selected="selected"'; } ?> >Cayman Islands</option>

<option value="Central African Republic" <?php if($countrycode=='Central African Republic') { echo 'selected="selected"'; } ?> >Central African Republic</option>

<option value="Chad" <?php if($countrycode=='Chad') { echo 'selected="selected"'; } ?> >Chad</option>

<option value="Chile" <?php if($countrycode=='Chile') { echo 'selected="selected"'; } ?> >Chile</option>

<option value="China" <?php if($countrycode=='China') { echo 'selected="selected"'; } ?> >China</option>



<option value="Christmas Island" <?php if($countrycode=='Christmas Island') { echo 'selected="selected"'; } ?> >Christmas Island</option>

<option value="Cocos (Keeling) Islands" <?php if($countrycode=='Cocos (Keeling) Islands') { echo 'selected="selected"'; } ?> >Cocos (Keeling) Islands</option>

<option value="Colombia" <?php if($countrycode=='Colombia') { echo 'selected="selected"'; } ?> >Colombia</option>

<option value="Comoros" <?php if($countrycode=='Comoros') { echo 'selected="selected"'; } ?> >Comoros</option>

<option value="Congo" <?php if($countrycode=='Congo') { echo 'selected="selected"'; } ?> >Congo</option>

<option value="Cook Islands" <?php if($countrycode=='Cook Islands') { echo 'selected="selected"'; } ?> >Cook Islands</option>

<option value="Costa Rica" <?php if($countrycode=='Costa Rica') { echo 'selected="selected"'; } ?> >Costa Rica</option>

<option value="Croatia (Hrvatska)" <?php if($countrycode=='Croatia (Hrvatska)') { echo 'selected="selected"'; } ?> >Croatia (Hrvatska)</option>

<option value="Cuba" <?php if($countrycode=='Cuba') { echo 'selected="selected"'; } ?> >Cuba</option>



<option value="Cuba" <?php if($countrycode=='Cuba') { echo 'selected="selected"'; } ?> >Cyprus</option>

<option value="Czech Republic" <?php if($countrycode=='Czech Republic') { echo 'selected="selected"'; } ?> >Czech Republic</option>

<option value="Democratic Republic of Congo" <?php if($countrycode=='Democratic Republic of Congo') { echo 'selected="selected"'; } ?> >Democratic Republic of Congo</option>

<option value="Denmark" <?php if($countrycode=='Denmark') { echo 'selected="selected"'; } ?> >Denmark</option>

<option value="Djibouti" <?php if($countrycode=='Djibouti') { echo 'selected="selected"'; } ?> >Djibouti</option>

<option value="Dominica" <?php if($countrycode=='Dominica') { echo 'selected="selected"'; } ?> >Dominica</option>

<option value="Dominican Republic" <?php if($countrycode=='Dominican Republic') { echo 'selected="selected"'; } ?> >Dominican Republic</option>

<option value="East Timor" <?php if($countrycode=='East Timor') { echo 'selected="selected"'; } ?> >East Timor</option>

<option value="Ecuador" <?php if($countrycode=='Ecuador') { echo 'selected="selected"'; } ?> >Ecuador</option>



<option value="Egypt" <?php if($countrycode=='Egypt') { echo 'selected="selected"'; } ?> >Egypt</option>

<option value="El Salvador" <?php if($countrycode=='El Salvador') { echo 'selected="selected"'; } ?> >El Salvador</option>

<option value="Equatorial Guinea" <?php if($countrycode=='Equatorial Guinea') { echo 'selected="selected"'; } ?> >Equatorial Guinea</option>

<option value="Eritrea" <?php if($countrycode=='Eritrea') { echo 'selected="selected"'; } ?> >Eritrea</option>

<option value="Estonia" <?php if($countrycode=='Estonia') { echo 'selected="selected"'; } ?> >Estonia</option>

<option value="Ethiopia" <?php if($countrycode=='Ethiopia') { echo 'selected="selected"'; } ?> >Ethiopia</option>

<option value="Europe" <?php if($countrycode=='Europe') { echo 'selected="selected"'; } ?> >Europe</option>

<option value="Falkland Islands (Malvinas)" <?php if($countrycode=='Falkland Islands (Malvinas)') { echo 'selected="selected"'; } ?> >Falkland Islands (Malvinas)</option>

<option value="Faroe Islands" <?php if($countrycode=='Faroe Islands') { echo 'selected="selected"'; } ?> >Faroe Islands</option>



<option value="Fiji" <?php if($countrycode=='Fiji') { echo 'selected="selected"'; } ?> >Fiji</option>

<option value="Finland" <?php if($countrycode=='Finland') { echo 'selected="selected"'; } ?> >Finland</option>

<option value="France" <?php if($countrycode=='France') { echo 'selected="selected"'; } ?> >France</option>

<option value="French Guiana" <?php if($countrycode=='French Guiana') { echo 'selected="selected"'; } ?> >French Guiana</option>

<option value="French Polynesia" <?php if($countrycode=='French Polynesia') { echo 'selected="selected"'; } ?> >French Polynesia</option>

<option value="French Southern Territories" <?php if($countrycode=='French Southern Territories') { echo 'selected="selected"'; } ?> >French Southern Territories</option>

<option value="Gabon" <?php if($countrycode=='Gabon') { echo 'selected="selected"'; } ?> >Gabon</option>

<option value="Gambia" <?php if($countrycode=='Gambia') { echo 'selected="selected"'; } ?> >Gambia</option>

<option value="Georgia" <?php if($countrycode=='Georgia') { echo 'selected="selected"'; } ?> >Georgia</option>



<option value="Germany" <?php if($countrycode=='Germany') { echo 'selected="selected"'; } ?> >Germany</option>

<option value="Ghana" <?php if($countrycode=='Ghana') { echo 'selected="selected"'; } ?> >Ghana</option>

<option value="Gibraltar" <?php if($countrycode=='Gibraltar') { echo 'selected="selected"'; } ?> >Gibraltar</option>

<option value="Great Britain (UK)" <?php if($countrycode=='Great Britain (UK)') { echo 'selected="selected"'; } ?> >Great Britain (UK)</option>

<option value="Greece" <?php if($countrycode=='Greece') { echo 'selected="selected"'; } ?> >Greece</option>

<option value="Greenland" <?php if($countrycode=='Greenland') { echo 'selected="selected"'; } ?> >Greenland</option>

<option value="Grenada" <?php if($countrycode=='Grenada') { echo 'selected="selected"'; } ?> >Grenada</option>

<option value="Guadeloupe" <?php if($countrycode=='Guadeloupe') { echo 'selected="selected"'; } ?> >Guadeloupe</option>

<option value="Guam" <?php if($countrycode=='Guam') { echo 'selected="selected"'; } ?> >Guam</option>



<option value="Guatemala" <?php if($countrycode=='Guatemala') { echo 'selected="selected"'; } ?> >Guatemala</option>

<option value="Guinea" <?php if($countrycode=='Guinea') { echo 'selected="selected"'; } ?> >Guinea</option>

<option value="Guinea-Bissau" <?php if($countrycode=='Guinea-Bissau') { echo 'selected="selected"'; } ?> >Guinea-Bissau</option>

<option value="Guyana" <?php if($countrycode=='Guyana') { echo 'selected="selected"'; } ?> >Guyana</option>

<option value="Haiti" <?php if($countrycode=='Haiti') { echo 'selected="selected"'; } ?> >Haiti</option>

<option value="Heard and McDonald Islands" <?php if($countrycode=='Heard and McDonald Islands') { echo 'selected="selected"'; } ?> >Heard and McDonald Islands</option>

<option value="Honduras" <?php if($countrycode=='Honduras') { echo 'selected="selected"'; } ?> >Honduras</option>

<option value="Hong Kong" <?php if($countrycode=='Hong Kong') { echo 'selected="selected"'; } ?> >Hong Kong</option>

<option value="Hungary" <?php if($countrycode=='Hungary') { echo 'selected="selected"'; } ?> >Hungary</option>



<option value="Iceland" <?php if($countrycode=='Iceland') { echo 'selected="selected"'; } ?> >Iceland</option>

<option value="India" <?php if($countrycode=='India') { echo 'selected="selected"'; } ?> >India</option>

<option value="Indonesia" <?php if($countrycode=='Indonesia') { echo 'selected="selected"'; } ?> >Indonesia</option>

<option value="Iran" <?php if($countrycode=='Iran') { echo 'selected="selected"'; } ?> >Iran</option>

<option value="Iraq" <?php if($countrycode=='Iraq') { echo 'selected="selected"'; } ?> >Iraq</option>

<option value="Ireland" <?php if($countrycode=='Ireland') { echo 'selected="selected"'; } ?> >Ireland</option>

<option value="Israel" <?php if($countrycode=='Israel') { echo 'selected="selected"'; } ?> >Israel</option>

<option value="Italy" <?php if($countrycode=='Italy') { echo 'selected="selected"'; } ?> >Italy</option>

<option value="Ivory Coast" <?php if($countrycode=='Ivory Coast') { echo 'selected="selected"'; } ?> >Ivory Coast</option>



<option value="Jamaica" <?php if($countrycode=='Jamaica') { echo 'selected="selected"'; } ?> >Jamaica</option>

<option value="Japan" <?php if($countrycode=='Japan') { echo 'selected="selected"'; } ?> >Japan</option>

<option value="Jordan" <?php if($countrycode=='Jordan') { echo 'selected="selected"'; } ?> >Jordan</option>

<option value="Kazakhstan" <?php if($countrycode=='Kazakhstan') { echo 'selected="selected"'; } ?> >Kazakhstan</option>

<option value="Kenya" <?php if($countrycode=='Kenya') { echo 'selected="selected"'; } ?> >Kenya</option>

<option value="Kiribati" <?php if($countrycode=='Kiribati') { echo 'selected="selected"'; } ?> >Kiribati</option>

<option value="Korea (North)" <?php if($countrycode=='Korea (North)') { echo 'selected="selected"'; } ?> >Korea (North)</option>

<option value="Korea (South)" <?php if($countrycode=='Korea (South)') { echo 'selected="selected"'; } ?> >Korea (South)</option>

<option value="Kuwait" <?php if($countrycode=='Kuwait') { echo 'selected="selected"'; } ?> >Kuwait</option>



<option value="Kyrgyzstan" <?php if($countrycode=='Kyrgyzstan') { echo 'selected="selected"'; } ?> >Kyrgyzstan</option>

<option value="Laos" <?php if($countrycode=='Laos') { echo 'selected="selected"'; } ?> >Laos</option>

<option value="Latvia" <?php if($countrycode=='Latvia') { echo 'selected="selected"'; } ?> >Latvia</option>

<option value="Lebanon" <?php if($countrycode=='Lebanon') { echo 'selected="selected"'; } ?> >Lebanon</option>

<option value="Lesotho" <?php if($countrycode=='Lesotho') { echo 'selected="selected"'; } ?> >Lesotho</option>

<option value="Liberia" <?php if($countrycode=='Liberia') { echo 'selected="selected"'; } ?> >Liberia</option>

<option value="Libya" <?php if($countrycode=='Libya') { echo 'selected="selected"'; } ?> >Libya</option>

<option value="Liechtenstein" <?php if($countrycode=='Liechtenstein') { echo 'selected="selected"'; } ?> >Liechtenstein</option>

<option value="Lithuania" <?php if($countrycode=='Lithuania') { echo 'selected="selected"'; } ?> >Lithuania</option>



<option value="Luxembourg" <?php if($countrycode=='Luxembourg') { echo 'selected="selected"'; } ?> >Luxembourg</option>

<option value="Macau" <?php if($countrycode=='Macau') { echo 'selected="selected"'; } ?> >Macau</option>

<option value="Macedonia" <?php if($countrycode=='Macedonia') { echo 'selected="selected"'; } ?> >Macedonia</option>

<option value="Madagascar" <?php if($countrycode=='Madagascar') { echo 'selected="selected"'; } ?> >Madagascar</option>

<option value="Malawi" <?php if($countrycode=='Malawi') { echo 'selected="selected"'; } ?> >Malawi</option>

<option value="Malaysia" <?php if($countrycode=='Malaysia') { echo 'selected="selected"'; } ?> >Malaysia</option>

<option value="Maldives" <?php if($countrycode=='Maldives') { echo 'selected="selected"'; } ?> >Maldives</option>

<option value="Mali" <?php if($countrycode=='Mali') { echo 'selected="selected"'; } ?> >Mali</option>

<option value="Malta" <?php if($countrycode=='Malta') { echo 'selected="selected"'; } ?> >Malta</option>



<option value="Marshall Islands" <?php if($countrycode=='Marshall Islands') { echo 'selected="selected"'; } ?> >Marshall Islands</option>

<option value="Martinique" <?php if($countrycode=='Martinique') { echo 'selected="selected"'; } ?> >Martinique</option>

<option value="Mauritania" <?php if($countrycode=='Mauritania') { echo 'selected="selected"'; } ?> >Mauritania</option>

<option value="Mauritius" <?php if($countrycode=='Mauritius') { echo 'selected="selected"'; } ?> >Mauritius</option>

<option value="Mayotte" <?php if($countrycode=='Mayotte') { echo 'selected="selected"'; } ?> >Mayotte</option>

<option value="Mexico" <?php if($countrycode=='Mexico') { echo 'selected="selected"'; } ?> >Mexico</option>

<option value="Micronesia" <?php if($countrycode=='Micronesia') { echo 'selected="selected"'; } ?> >Micronesia</option>

<option value="Moldova" <?php if($countrycode=='Moldova') { echo 'selected="selected"'; } ?> >Moldova</option>

<option value="Monaco" <?php if($countrycode=='Monaco') { echo 'selected="selected"'; } ?> >Monaco</option>



<option value="Mongolia" <?php if($countrycode=='Mongolia') { echo 'selected="selected"'; } ?> >Mongolia</option>

<option value="Montenegro" <?php if($countrycode=='Montenegro') { echo 'selected="selected"'; } ?> >Montenegro</option>

<option value="Montserrat" <?php if($countrycode=='Montserrat') { echo 'selected="selected"'; } ?> >Montserrat</option>

<option value="Morocco" <?php if($countrycode=='Morocco') { echo 'selected="selected"'; } ?> >Morocco</option>

<option value="Mozambique" <?php if($countrycode=='Mozambique') { echo 'selected="selected"'; } ?> >Mozambique</option>

<option value="Namibia" <?php if($countrycode=='Namibia') { echo 'selected="selected"'; } ?> >Namibia</option>

<option value="Nauru" <?php if($countrycode=='Nauru') { echo 'selected="selected"'; } ?> >Nauru</option>

<option value="Nepal" <?php if($countrycode=='Nepal') { echo 'selected="selected"'; } ?> >Nepal</option>

<option value="Netherlands" <?php if($countrycode=='Netherlands') { echo 'selected="selected"'; } ?> >Netherlands</option>



<option value="Netherlands Antilles" <?php if($countrycode=='Netherlands Antilles') { echo 'selected="selected"'; } ?> >Netherlands Antilles</option>

<option value="Neutral Zone" <?php if($countrycode=='Neutral Zone') { echo 'selected="selected"'; } ?> >Neutral Zone</option>

<option value="New Caledonia" <?php if($countrycode=='New Caledonia') { echo 'selected="selected"'; } ?> >New Caledonia</option>

<option value="New Zealand (Aotearoa)" <?php if($countrycode=='New Zealand (Aotearoa)') { echo 'selected="selected"'; } ?> >New Zealand (Aotearoa)</option>

<option value="Nicaragua" <?php if($countrycode=='Nicaragua') { echo 'selected="selected"'; } ?> >Nicaragua</option>

<option value="Niger" <?php if($countrycode=='Niger') { echo 'selected="selected"'; } ?> >Niger</option>

<option value="Nigeria" <?php if($countrycode=='Nigeria') { echo 'selected="selected"'; } ?> >Nigeria</option>

<option value="Niue" <?php if($countrycode=='Niue') { echo 'selected="selected"'; } ?> >Niue</option>

<option value="Norfolk Island" <?php if($countrycode=='Norfolk Island') { echo 'selected="selected"'; } ?> >Norfolk Island</option>



<option value="Northern Mariana Islands" <?php if($countrycode=='Northern Mariana Islands') { echo 'selected="selected"'; } ?> >Northern Mariana Islands</option>

<option value="Norway" <?php if($countrycode=='Norway') { echo 'selected="selected"'; } ?> >Norway</option>

<option value="Oman" <?php if($countrycode=='Oman') { echo 'selected="selected"'; } ?> >Oman</option>

<option value="Pakistan" <?php if($countrycode=='Pakistan') { echo 'selected="selected"'; } ?> >Pakistan</option>

<option value="Palau" <?php if($countrycode=='Palau') { echo 'selected="selected"'; } ?> >Palau</option>

<option value="Palestinian Territory, Occupied" <?php if($countrycode=='Palestinian Territory, Occupied') { echo 'selected="selected"'; } ?> >Palestinian Territory, Occupied</option>

<option value="Panama" <?php if($countrycode=='Panama') { echo 'selected="selected"'; } ?> >Panama</option>

<option value="Papua New Guinea" <?php if($countrycode=='Papua New Guinea') { echo 'selected="selected"'; } ?> >Papua New Guinea</option>

<option value="Paraguay" <?php if($countrycode=='Paraguay') { echo 'selected="selected"'; } ?> >Paraguay</option>



<option value="Peru" <?php if($countrycode=='Peru') { echo 'selected="selected"'; } ?> >Peru</option>

<option value="Philippines" <?php if($countrycode=='Philippines') { echo 'selected="selected"'; } ?> >Philippines</option>

<option value="Pitcairn" <?php if($countrycode=='Pitcairn') { echo 'selected="selected"'; } ?> >Pitcairn</option>

<option value="Poland" <?php if($countrycode=='Poland') { echo 'selected="selected"'; } ?> >Poland</option>

<option value="Portugal" <?php if($countrycode=='Portugal') { echo 'selected="selected"'; } ?> >Portugal</option>

<option value="Private" <?php if($countrycode=='Private') { echo 'selected="selected"'; } ?> >Private</option>

<option value="Puerto Rico" <?php if($countrycode=='Puerto Rico') { echo 'selected="selected"'; } ?> >Puerto Rico</option>

<option value="Qatar" <?php if($countrycode=='Qatar') { echo 'selected="selected"'; } ?> >Qatar</option>

<option value="Republic of Serbia" <?php if($countrycode=='Republic of Serbia') { echo 'selected="selected"'; } ?> >Republic of Serbia</option>



<option value="Reunion" <?php if($countrycode=='Reunion') { echo 'selected="selected"'; } ?> >Reunion</option>

<option value="Romania" <?php if($countrycode=='Romania') { echo 'selected="selected"'; } ?> >Romania</option>

<option value="Russia" <?php if($countrycode=='Russia') { echo 'selected="selected"'; } ?> >Russia</option>

<option value="Rwanda" <?php if($countrycode=='Rwanda') { echo 'selected="selected"'; } ?> >Rwanda</option>

<option value="S. Georgia and S. Sandwich Isls." <?php if($countrycode=='S. Georgia and S. Sandwich Isls.') { echo 'selected="selected"'; } ?> >S. Georgia and S. Sandwich Isls.</option>

<option value="Saint Kitts and Nevis" <?php if($countrycode=='Saint Kitts and Nevis') { echo 'selected="selected"'; } ?> >Saint Kitts and Nevis</option>

<option value="Saint Lucia" <?php if($countrycode=='Saint Lucia') { echo 'selected="selected"'; } ?> >Saint Lucia</option>

<option value="Saint Vincent and the Grenadines" <?php if($countrycode=='Saint Vincent and the Grenadines') { echo 'selected="selected"'; } ?> >Saint Vincent and the Grenadines</option>

<option value="Samoa" <?php if($countrycode=='Samoa') { echo 'selected="selected"'; } ?> >Samoa</option>



<option value="San Marino" <?php if($countrycode=='San Marino') { echo 'selected="selected"'; } ?> >San Marino</option>

<option value="Sao Tome and Principe" <?php if($countrycode=='Sao Tome and Principe') { echo 'selected="selected"'; } ?> >Sao Tome and Principe</option>

<option value="Saudi Arabia" <?php if($countrycode=='Saudi Arabia') { echo 'selected="selected"'; } ?> >Saudi Arabia</option>

<option value="Senegal" <?php if($countrycode=='Senegal') { echo 'selected="selected"'; } ?> >Senegal</option>

<option value="Serbia and Montenegro" <?php if($countrycode=='Serbia and Montenegro') { echo 'selected="selected"'; } ?> >Serbia and Montenegro</option>

<option value="Seychelles" <?php if($countrycode=='Seychelles') { echo 'selected="selected"'; } ?> >Seychelles</option>

<option value="Sierra Leone" <?php if($countrycode=='Sierra Leone') { echo 'selected="selected"'; } ?> >Sierra Leone</option>

<option value="Singapore" <?php if($countrycode=='Singapore') { echo 'selected="selected"'; } ?> >Singapore</option>

<option value="Slovak Republic" <?php if($countrycode=='Slovak Republic') { echo 'selected="selected"'; } ?> >Slovak Republic</option>



<option value="Slovenia" <?php if($countrycode=='Slovenia') { echo 'selected="selected"'; } ?> >Slovenia</option>

<option value="Solomon Islands" <?php if($countrycode=='Solomon Islands') { echo 'selected="selected"'; } ?> >Solomon Islands</option>

<option value="Somalia" <?php if($countrycode=='Somalia') { echo 'selected="selected"'; } ?> >Somalia</option>

<option value="South Africa" <?php if($countrycode=='South Africa') { echo 'selected="selected"'; } ?> >South Africa</option>

<option value="Spain" <?php if($countrycode=='Spain') { echo 'selected="selected"'; } ?> >Spain</option>

<option value="Sri Lanka" <?php if($countrycode=='Sri Lanka') { echo 'selected="selected"'; } ?> >Sri Lanka</option>

<option value="St. Helena" <?php if($countrycode=='St. Helena') { echo 'selected="selected"'; } ?> >St. Helena</option>

<option value="St. Pierre and Miquelon" <?php if($countrycode=='St. Pierre and Miquelon') { echo 'selected="selected"'; } ?> >St. Pierre and Miquelon</option>

<option value="Sudan" <?php if($countrycode=='Sudan') { echo 'selected="selected"'; } ?> >Sudan</option>



<option value="Suriname" <?php if($countrycode=='Suriname') { echo 'selected="selected"'; } ?> >Suriname</option>

<option value="Svalbard and Jan Mayen Islands" <?php if($countrycode=='Svalbard and Jan Mayen Islands') { echo 'selected="selected"'; } ?> >Svalbard and Jan Mayen Islands</option>

<option value="Swaziland" <?php if($countrycode=='Swaziland') { echo 'selected="selected"'; } ?> >Swaziland</option>

<option value="Sweden" <?php if($countrycode=='Sweden') { echo 'selected="selected"'; } ?> >Sweden</option>

<option value="Switzerland" <?php if($countrycode=='Switzerland') { echo 'selected="selected"'; } ?> >Switzerland</option>

<option value="Syria" <?php if($countrycode=='Syria') { echo 'selected="selected"'; } ?> >Syria</option>

<option value="Taiwan" <?php if($countrycode=='Taiwan') { echo 'selected="selected"'; } ?> >Taiwan</option>

<option value="Tajikistan" <?php if($countrycode=='Tajikistan') { echo 'selected="selected"'; } ?> >Tajikistan</option>

<option value="Tanzania" <?php if($countrycode=='Tanzania') { echo 'selected="selected"'; } ?> >Tanzania</option>



<option value="Thailand" <?php if($countrycode=='Thailand') { echo 'selected="selected"'; } ?> >Thailand</option>

<option value="Togo" <?php if($countrycode=='Togo') { echo 'selected="selected"'; } ?> >Togo</option>

<option value="Tokelau" <?php if($countrycode=='Tokelau') { echo 'selected="selected"'; } ?> >Tokelau</option>

<option value="Tonga" <?php if($countrycode=='Tonga') { echo 'selected="selected"'; } ?> >Tonga</option>

<option value="Trinidad and Tobago" <?php if($countrycode=='Trinidad and Tobago') { echo 'selected="selected"'; } ?> >Trinidad and Tobago</option>

<option value="Tunisia" <?php if($countrycode=='Tunisia') { echo 'selected="selected"'; } ?> >Tunisia</option>

<option value="Turkey" <?php if($countrycode=='Turkey') { echo 'selected="selected"'; } ?> >Turkey</option>

<option value="Turkmenistan" <?php if($countrycode=='Turkmenistan') { echo 'selected="selected"'; } ?> >Turkmenistan</option>

<option value="Turks and Caicos Islands" <?php if($countrycode=='Turks and Caicos Islands') { echo 'selected="selected"'; } ?> >Turks and Caicos Islands</option>



<option value="Tuvalu" <?php if($countrycode=='Tuvalu') { echo 'selected="selected"'; } ?> >Tuvalu</option>

<option value="Uganda" <?php if($countrycode=='Uganda') { echo 'selected="selected"'; } ?> >Uganda</option>

<option value="Ukraine" <?php if($countrycode=='Ukraine') { echo 'selected="selected"'; } ?> >Ukraine</option>

<option value="United Arab Emirates" <?php if($countrycode=='United Arab Emirates') { echo 'selected="selected"'; } ?> >United Arab Emirates</option>

<option value="United Kingdom" <?php if($countrycode=='United Kingdom') { echo 'selected="selected"'; } ?> >United Kingdom</option>

<option value="United States" <?php if($countrycode=='United States') { echo 'selected="selected"'; } ?> >United States</option>

<option value="Uruguay" <?php if($countrycode=='Uruguay') { echo 'selected="selected"'; } ?> >Uruguay</option>

<option value="Uzbekistan" <?php if($countrycode=='Uzbekistan') { echo 'selected="selected"'; } ?> >Uzbekistan</option>

<option value="Vanuatu" <?php if($countrycode=='Vanuatu') { echo 'selected="selected"'; } ?> >Vanuatu</option>



<option value="Vatican City State (Holy See)" <?php if($countrycode=='Vatican City State (Holy See)') { echo 'selected="selected"'; } ?> >Vatican City State (Holy See)</option>

<option value="Venezuela" <?php if($countrycode=='Venezuela') { echo 'selected="selected"'; } ?> >Venezuela</option>

<option value="Viet Nam" <?php if($countrycode=='Viet Nam') { echo 'selected="selected"'; } ?> >Viet Nam</option>

<option value="Virgin Islands (British)" <?php if($countrycode=='Virgin Islands (British)') { echo 'selected="selected"'; } ?> >Virgin Islands (British)</option>

<option value="Virgin Islands (U.S.)" <?php if($countrycode=='Virgin Islands (U.S.)') { echo 'selected="selected"'; } ?> >Virgin Islands (U.S.)</option>

<option value="Wallis and Futuna Islands" <?php if($countrycode=='Wallis and Futuna Islands') { echo 'selected="selected"'; } ?> >Wallis and Futuna Islands</option>

<option value="Western Sahara" <?php if($countrycode=='Western Sahara') { echo 'selected="selected"'; } ?> >Western Sahara</option>

<option value="Yemen" <?php if($countrycode=='Yemen') { echo 'selected="selected"'; } ?> >Yemen</option>

<option value="Yugoslavia" <?php if($countrycode=='Yugoslavia') { echo 'selected="selected"'; } ?> >Yugoslavia</option>



<option value="Zambia" <?php if($countrycode=='Zambia') { echo 'selected="selected"'; } ?> >Zambia</option>

<option value="Zimbabwe" <?php if($countrycode=='Zimbabwe') { echo 'selected="selected"'; } ?> >Zimbabwe</option>

</select><br>

            <span lang="en-us">Your</span> Country 

			<span lang="en-us">cannot be changed later. <a style='cursor:help;' onmouseover="Tip('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;For Security reasons we don\'t let people change this later.', BORDERCOLOR, '#CFCFB3', BGCOLOR, '#f9f9d7', WIDTH, -180, FONTFACE, 'Arial,Tahoma', FONTSIZE, '12px')" onmouseout="UnTip()">

			Why?</a></span></td>

          </tr>

          <tr>



            <td>&nbsp;</td>

            <td><br>

                       <input type="submit" value="Submit" name="SignupButton"></td>

          </tr>

        </table>

      </form>

	  

	  <?php } else { ?>

	  <table border="0" cellspacing="0" style="border-collapse: collapse" id="AutoNumber54" cellpadding="0">

        <tr>

          <td nowrap>01 New Account Information</td>

          <td nowrap>&nbsp;</td>

          <td nowrap><b><font color="#F62355">02</font></b> <b>Email Verification</b></td>

        </tr>

        <tr>

          <td nowrap colspan="3">

          <img border="0" src="images/p.gif" width="3" height="3"></td>

        </tr>		

        <tr>

          <td nowrap bgcolor="#DDDDDD">

          <img border="0" src="images/p.gif" width="3" height="3"></td>

          <td nowrap bgcolor="#DDDDDD">

          <img border="0" src="images/p.gif" width="12" height="3"></td>

          <td nowrap bgcolor="#F62355">

          <img border="0" src="images/p.gif" width="3" height="3"></td>

        </tr>

      </table>

	  <p><br>

                <b>Your account has been created.</b></p>

		<p>&nbsp;</p>

      <p style="line-height: 150%">The verification email was sent to this address:<b><br>

		<?php echo $email; ?></b></p>



		<p style="line-height: 150%">&nbsp;</p>

      <p style="line-height: 150%">Check your inbox and confirm the account by clicking

		the link in The email message.<br>

		The verification link will

		be valid for 24 hours.</p>

      <p style="line-height: 150%"><b><font color="#F62355">If you did not receive the email, please check<br>

      SPAM/BULK folders and mark as "Not Spam".</font></b></p>

	  <?php unset($_SESSION["signupsuccess"]); } ?>

	  <p>&nbsp;</p>

		<p>&nbsp;</p>

      <p>&nbsp;</p>

	  <p>&nbsp;</p>

<script language="javascript" type="text/javascript">

function signupvalidate() {

	if(document.signup.Fullname.value=='') {

	alert('Please enter your Full name');

	document.signup.Fullname.focus();

	return false;

	}	

	if(document.signup.Email.value=='') {

	alert('Please enter your Email address');

	document.signup.Email.focus();

	return false;

	}

	if(document.signup.Password.value=='') {

	alert('Please enter your Password');

	document.signup.Password.focus();

	return false;

	}

	if(document.signup.Countrycode.value=='') {

	alert('Please choose your Country');

	document.signup.Countrycode.focus();

	return false;

	}	

}

function validateemail()

{

str=document.signup.email.value;



var at="@"

var dot="."

var lat=str.indexOf(at)

var lstr=str.length

var ldot=str.indexOf(dot)

if (str.indexOf(at)==-1)

{

    alert('Please enter valid email address');

    document.signup.email.value="";

    document.signup.email.focus();

    return false;

}



else if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr)

{

     alert('Please enter valid email address');

     document.signup.email.value="";

     document.signup.email.focus();

     return false;

}





else if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr)

{

     alert('Please enter valid email address');

     document.signup.email.value="";

     document.signup.email.focus();

     return false;

}



else if (str.indexOf(at,(lat+1))!=-1)

 {

      alert('Please enter valid email address');

      document.signup.email.value="";

      document.signup.email.focus();

      return false;

 }



else if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot)

 {

      alert('Please enter valid email address');

      document.signup.email.value="";

      document.signup.email.focus();

      return false;

 }



else if (str.indexOf(dot,(lat+2))==-1)

 {

    alert('Please enter valid email address');

	document.signup.email.value="";

  	document.signup.email.focus();

    return false;

 }



else if (str.indexOf(" ")!=-1)

 {

    alert('Please enter valid email address');

	document.signup.email.value="";

  	document.signup.email.focus();

    return false;

 }

else

 {

   return true;	

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