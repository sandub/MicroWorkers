<?php

ob_start();

session_start();

// start the session

ini_set('display_errors', 'On');

error_reporting(E_ALL);

$offset=5*60*60; //converting 5 hours to seconds.10*60*60

$nowFormat="Y-m-d H:i:s";

$totaldate=gmdate($nowFormat, time()-$offset);

/*if(isset($_GET)) {
foreach($_GET as $gvar) {
$_GET[] = mysql_real_escape_string($gvar);
}
}*/

$setseclimithere = 96*60*60; /*[ hours * 60*60 ]*/

$EstimatedCampaigncost = '0.50';

$USAjobcost = '0.35';

$INTjobcost = '0.10';

$Highlightedjobcost = '1.00';

$Boldjobcost = '0.50';

$RecomendedJobfees = '0.15';

$MinJobpost = '20';

$SignUpbonus = '1.00';

$WithdrawDepositReferrallimit = '3';

$WithdrawFees = '5.0'; //%

$DepositFees = '2.5'; //%

$MinimumWithdraw = '10.00'; 

$ReferralFIRSTJobComplete = '0.10'; 

$ReferralBalanceReached = '10.00';

$ReferralBalanceReached10 = '1.50';

$FeePerCompletedJob = '5'; //%

$FeePerCompletedJobLESS11 = '10'; //%





$CONTACTUSMAILID = "info@info.com";

$super_admin_name="Saby B";

$super_admin_email="info@info.com";

$app_title="Admin Control Panel";

$app_url = "http://www.yourdomain.com/administrator/"; // keep the trailing slash

$date_format = "jS M Y";

$datetime_format = "jS M Y h:m A";

$globalsitename="www.yourd.com";

$dateformat = 'dd/mm/yyyy';

//mail send deatils:

$URL='http://www.yourdomain.com/'; 

$fromName="yourdomain";

$SiteName="yourdomain.com";

$from = "info@yourdomain.com";



// database connection config

# for localhost

$dbHost = 'localhost';

$dbUser = 'qb123227_micro'; 

$dbPass = 'micro'; 

$dbName = 'qb123227_micro';







$dbConn = mysql_connect ($dbHost, $dbUser, $dbPass) or die ('MySQL connect failed. ' . mysql_error());

mysql_select_db($dbName) or die('Cannot select database. ' . mysql_error());


if(isset($_POST)) {
foreach($_POST as $pvar) {
$_POST[] = mysql_real_escape_string($pvar);
}
}

function get_day_difference( $start,$end )

{



    	



	$uts['start']      =    $start;



    $uts['end']        =    $end;



    if( $uts['start']!==-1 && $uts['end']!==-1 )



    {



        if( $uts['end'] >= $uts['start'] )



        {



            $diff    =    $uts['end'] - $uts['start'];



            if( $days=intval((floor($diff/86400))) )



                $diff = $diff % 86400;      



            if( $hours=intval((floor($diff/3600))) )



                $diff = $diff % 3600;



            if( $minutes=intval((floor($diff/60))) )



                $diff = $diff % 60;



            $diff    =    intval( $diff );            



            return( array('days'=>$days,'hours'=>$hours, 'minutes'=>$minutes, 'seconds'=>$diff) );



        }



        else



        {



            trigger_error( "Ending date/time is earlier than the start date/time", E_USER_WARNING );



        }



    }



    else



    {



        trigger_error( "Invalid date/time data detected", E_USER_WARNING );



    }



    return( false );



}

function get_sec_difference( $start,$end )

{



    	



	$uts['start']      =    $start;



    $uts['end']        =    $end;



    if( $uts['start']!==-1 && $uts['end']!==-1 )



    {



        if( $uts['end'] >= $uts['start'] )



        {



            $diff    =    $uts['end'] - $uts['start'];

            

            return( array('seconds'=>$diff) );



        }



        else



        {



            trigger_error( "Ending date/time is earlier than the start date/time", E_USER_WARNING );



        }



    }



    else



    {



        trigger_error( "Invalid date/time data detected", E_USER_WARNING );



    }



    return( false );



}


function dbQuery($sql)

{


    
	//$sql = addslashes($sql);
   // $sql = htmlentities($sql);
   // $sql = mysql_real_escape_string($sql);
    
	$result = mysql_query($sql) or die(mysql_error().'<p><b>SQL:</b><br>'.$sql.'</p>');



    return $result;

}



function dbAffectedRows()

{

    global $dbConn;

    

    return mysql_affected_rows($dbConn);

}



function dbFetchArray($result, $resultType = MYSQL_NUM) {

    return mysql_fetch_array($result, $resultType);

}



function dbFetchAssoc($result)

{

    return mysql_fetch_assoc($result);

}



function dbFetchRow($result)

{

    return mysql_fetch_row($result);

}



function dbFreeResult($result)

{

    return mysql_free_result($result);

}



function dbNumRows($result)

{

    return mysql_num_rows($result);

}



function dbSelect($dbName)

{

    return mysql_select_db($dbName);

}



function dbInsertId()

{

    return mysql_insert_id();

}







function getTextAreaContent($text){

	// change all HTML special characters,

	// to prevent some nasty code injection

	$text = htmlspecialchars($text);

	// convert newline characters to HTML break tag ( <br> )

	$text = nl2br($text);	

	return $text;

}



function get_single_value($table, $column, $where){

	$sql = "select `".$column."` from `".$table."` where ".$where;

	$result = dbQuery($sql);

	$obj = dbFetchAssoc($result);	

	dbFreeResult($result);

	return stripslashes($obj[$column]);	

}



function check_email_address($email) {

	// First, we check that there's one @ symbol, and that the lengths are right

	if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {

	// Email invalid because wrong number of characters in one section, or wrong number of @ symbols.

	return false;

	}

	// Split it into sections to make life easier

	$email_array = explode("@", $email);

	$local_array = explode(".", $email_array[0]);

	for ($i = 0; $i < sizeof($local_array); $i++) {

	if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {

	return false;

	}

	}

	if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name

	$domain_array = explode(".", $email_array[1]);

	if (sizeof($domain_array) < 2) {

	return false; // Not enough parts to domain

	}

	for ($i = 0; $i < sizeof($domain_array); $i++) {

	if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {

	return false;

	}

	}

	}

	return true;

}



function js_redirect($url) {

    echo "<script language=\"JavaScript\">\n";

    echo "<!-- hide from old browser\n\n";

    

    echo "window.location = \"" . $url . "\";\n";



    echo "-->\n";

    echo "</script>\n";



    return true;

}



function send_mail($message, $to, $subject){

	// for multiple recipients separate the email ids with a comma

	// aidan@example.com, wez@example.com

	

	// Always set content-type when sending HTML email

	$headers = "MIME-Version: 1.0" . "\r\n";

	$headers .= "Content-type:text/html" . "\r\n";

	

	// Additional headers

	$headers .= 'From: piplu <piplu@piplu.com>' . "\r\n";

	//$headers .= 'Bcc: mukherjiikunal@gmail.com' . "\r\n";



	// Mail it

	return  mail($to, $subject, $message, $headers)?true:false;

}



function createRandom($number_of_digits=1,$type=3){ 

	/*

	type: 1 - numeric, 2 - letters, 3 - mixed. 

	Usage Examples Below - 

	

	$number = createRandom(10); 

	echo $number; 

	Output: 6Q1a8C1u9S 

	

	echo createRandom(10,1); 

	Output: 8754381046 

	

	echo createRandom(10,2); 

	Output: dNAoQYOtud 

	

	echo createRandom(); 

	Output: 9 

	*/

    for($x=0;$x<$number_of_digits;$x++){ 

        while(substr($num,strlen($num)-1,strlen($num)) == $r){ 

            switch($type){ 

                case "1": 

                $r = rand(0,9); 

                break; 

               

                case "2": 

                $r = chr(rand(0,25)+65); 

                break; 

               

                case "3": 

                if(is_numeric(substr($num,strlen($num)-1,strlen($num)))){ 

                 $n = rand(0,999); 

                 if($n % 2){ 

                    $r = chr(rand(0,25)+65); 

                } else { 

                    $r = strtolower(chr(rand(0,25)+65)); 

                }                    

                } else { 

                 $r = rand(0,9);   

                }               

                break; 

                }           

        } 

        $new_string .= $r; 

    } 

    return $new_string; 

} 



/**************************

	Paging Functions

***************************/



function getPagingQuery($sql, $itemPerPage = 10)

{

	if (isset($_GET['page']) && (int)$_GET['page'] > 0) {

		$page = (int)$_GET['page'];

	} else {

		$page = 1;

	}

	

	// start fetching from this row number

	$offset = ($page - 1) * $itemPerPage;

	

	return $sql . " LIMIT $offset, $itemPerPage";

}



/*

	Get the links to navigate between one result page to another.

	Supply a value for $strGet if the page url already contain some

	GET values for example if the original page url is like this :

	

	http://www.phpwebcommerce.com/plaincart/index.php?c=12

	

	use "c=12" as the value for $strGet. But if the url is like this :

	

	http://www.phpwebcommerce.com/plaincart/index.php

	

	then there's no need to set a value for $strGet

	

	

*/

function getPagingLink($sql, $itemPerPage = 10, $strGet = '')

{

	$result        = dbQuery($sql);

	$pagingLink    = '';

	$totalResults  = dbNumRows($result);

	$totalPages    = ceil($totalResults / $itemPerPage);

	

	// how many link pages to show

	$numLinks      = 10;



		

	// create the paging links only if we have more than one page of results

	if ($totalPages > 1) {

	

		$self = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] ;

		



		if (isset($_GET['page']) && (int)$_GET['page'] > 0) {

			$pageNumber = (int)$_GET['page'];

		} else {

			$pageNumber = 1;

		}

		

		// print 'previous' link only if we're not

		// on page one

		if ($pageNumber > 1) {

			$page = $pageNumber - 1;

			if ($page > 1) {

				$prev = " <a href=\"$self?page=$page&$strGet/\">[Prev]</a> ";

			} else {

				$prev = " <a href=\"$self?$strGet\">[Prev]</a> ";

			}	

				

			$first = " <a href=\"$self?$strGet\">[First]</a> ";

		} else {

			$prev  = ''; // we're on page one, don't show 'previous' link

			$first = ''; // nor 'first page' link

		}

	

		// print 'next' link only if we're not

		// on the last page

		if ($pageNumber < $totalPages) {

			$page = $pageNumber + 1;

			$next = " <a href=\"$self?page=$page&$strGet\">[Next]</a> ";

			$last = " <a href=\"$self?page=$totalPages&$strGet\">[Last]</a> ";

		} else {

			$next = ''; // we're on the last page, don't show 'next' link

			$last = ''; // nor 'last page' link

		}



		$start = $pageNumber - ($pageNumber % $numLinks) + 1;

		$end   = $start + $numLinks - 1;		

		

		$end   = min($totalPages, $end);

		

		$pagingLink = array();

		for($page = $start; $page <= $end; $page++)	{

			if ($page == $pageNumber) {

				$pagingLink[] = " $page ";   // no need to create a link to current page

			} else {

				if ($page == 1) {

					$pagingLink[] = " <a href=\"$self?$strGet\">$page</a> ";

				} else {	

					$pagingLink[] = " <a href=\"$self?page=$page&$strGet\">$page</a> ";

				}	

			}

	

		}

		

		$pagingLink = implode(' | ', $pagingLink);

		

		// return the page navigation link

		$pagingLink = $first . $prev . $pagingLink . $next . $last;

	}

	

	return $pagingLink;

}

?>