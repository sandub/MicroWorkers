<?php
include('settings/config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $SiteName; ?></title>
<meta name="language" content="en" />
<meta name="description" content="The <?php echo $SiteName; ?> is just show you how we earn online through this online jobs. ... just go through this website articles and step by step instructions" />
<meta name="keywords" content="online jobs, Create online jobs free registration, online pay, withdrawl, deposite,  work, online jobs, Create online jobs free registration, online pay, withdrawl, deposite,  work,online jobs, Create online jobs free registration, online pay, withdrawl, deposite,  work" />
<link rel="stylesheet" type="text/css" href="styles/main.css"/>
<link rel="shortcut icon" href="images/favicon.ico" />
<link rel="icon" href="images/favicon.ico" />
<?php if((strpos($_SERVER['PHP_SELF'],'support.php')!==false || !isset($_SESSION["userlogin"])) && strpos($_SERVER['HTTP_USER_AGENT'],"MSIE 6.0")!==false || strpos($_SERVER['HTTP_USER_AGENT'],"MSIE 7.0")!==false) { ?>

<?php } else { ?>
<style type="text/css">
img ,input, div,td { behavior: url("iepngfix.htc"); }
</style>
<?php } ?>
<script language="javascript" src="js/div.js"></script>
<script language="javascript" src="js/jquery.js"></script>

<script language=Javascript>

function divOn (aId_task)

{

	var arrayPageSize = getPageSize();

	var arrayPageScroll = getPageScroll();

	

	//bgrnd4 = '<div style="position:absolute; top:0; left:0; width:100%; height:100%; z-index:300; background-color:#000000; -moz-opacity: 0.6; opacity:.60; filter: alpha(opacity=60);" id=overlay></div>';

	//bgrnd4 = '<div style="position:absolute; top:0; left:0; width: ' + arrayPageSize[0] + '; height:' + arrayPageSize[1] + '; z-index:300; background-color:#000000; -moz-opacity: 0.6; opacity:.60; filter: alpha(opacity=60);" id="overlay"></div>';

	bgrnd4 = '<div style="position:absolute; top:0; left:0; width: 100%; height:' + arrayPageSize[1] + '; z-index:300; background-color:#000000; -moz-opacity: 0.6; opacity:.60; filter: alpha(opacity=60);" id="overlay"></div>';

	document.getElementById("div_popup").innerHTML = bgrnd4;



	var objFlash = document.getElementById('divek');

	objFlash.style.visibility = "visible";

	objFlash.style.display = 'block';

	objFlash.style.border = "6px solid #4874CD";

	objFlash.style.zIndex = 301;

	objFlash.style.position= "absolute";

	objFlash.style.backgroundColor = "#ffffff";

	

	x = '';	

	x = x + '<table border=0 cellspacing=0 cellpadding=5 width=100%><tr><td align=right>';

	x = x + '<a style="cursor: pointer;" onclick="divOff(); return false;">x<b> close</b></a>';

	x = x + '<b>&nbsp;&nbsp;&nbsp; </b>';

	x = x + '</td></tr></table>';

	x = x + '<iframe name=iframe4 id=iframe4  width=600 height=417 frameborder=0 marginheight=8 marginwidth=8 scrolling=auto></iframe>';

	objFlash.innerHTML = x;

	

	var arrayPageSize = getPageSize();

	var arrayPageScroll = getPageScroll();



	// center loadingImage if it exists

	if (objFlash)

	{

		objFlash.style.position = 'absolute'; //???

		objFlash.style.top = (((arrayPageSize[3] - 35 - 440) / 2) + 'px');

		objFlash.style.left = (((arrayPageSize[0] - 20 - 600) / 2) + 'px');

		objFlash.style.width = '600';

		objFlash.style.height = '440';



//		objFlash.style.zIndex = '90';

//		objFlash.style.display = 'block';

	}

	

	var start = new Date();

	var randomnumber=Math.floor(Math.random()*30000);

	xtime = start.getTime();

	dummyvar = xtime + randomnumber;

		

	

	xUrl = "worker_tasks_details.php?dummy=" + dummyvar + "&Id=" + aId_task;

	document.getElementById('iframe4').src = xUrl;

}



function divOff()

{

	document.getElementById("div_popup").innerHTML = "";

//	document.getElementById("divek").display = "";

	document.getElementById("divek").style.visibility = "hidden";

	

	xUrl = "";

	document.getElementById('iframe4').src = xUrl;

}



</script>
<script language="JavaScript">

	

	function show_hide (aId, aAction)

	{



		var req = null; 

		var start = new Date();

		var randomnumber=Math.floor(Math.random()*30000);

		xtime = start.getTime();

		dummyvar = xtime + randomnumber;

		

		x = 0;



		//document.ajax.dyn.value="Started...";

 

		if (window.XMLHttpRequest)

		{

 			req = new XMLHttpRequest();



		} 

		else if (window.ActiveXObject) 

		{

			try {

				req = new ActiveXObject("Msxml2.XMLHTTP");

				

			} catch (e)

			{

				try {

					req = new ActiveXObject("Microsoft.XMLHTTP");

					

				} catch (e) {}

			}

			

       	}





		req.onreadystatechange = function()

		{ 

			

			//document.ajax.dyn.value="Wait server...";

			if(req.readyState == 4)

			{

				if(req.status == 200)

				{

					//document.ajax.dyn.value="Received:" + req.responseText;	

					

				}	

				else	

				{

					//document.ajax.dyn.value="Error: returned status code " + req.status + " " + req.statusText;

				}	

			} 

		}; 

		

		x = 1;


		xUrl = "jobs_hide_show.php?Action=" + aAction + "&Id=" + aId + "&dummy=" + dummyvar;

		req.open("GET", xUrl, false); 

		req.send(null); 

		

		x = 2;

		xPage_update = "jobs.php?Oto=1" + "&dummy=" + dummyvar;

		req.open("GET", xPage_update, false); 

		req.send(null); 	

		

		d = document.getElementById("jobslist"); 

		d.innerHTML = req.responseText;

		

		

		return true;

	} 





	

</script>
<script language=Javascript>





	TaskPrices = new Array();

	TaskPricesUsa = new Array();



	// all categories - main + sub and prices per task

	

TaskPrices['00'] = 0.00000;

TaskPrices['0000'] = 0.10000;

TaskPrices['0001'] = 0.12000;

TaskPrices['0002'] = 0.10000;

TaskPrices['0003'] = 0.12000;

TaskPrices['02'] = 0.00000;

TaskPrices['0200'] = 0.10000;

TaskPrices['0201'] = 0.15000;

TaskPrices['0202'] = 0.15000;

TaskPrices['0203'] = 0.18000;

TaskPrices['03'] = 0.00000;

TaskPrices['0300'] = 0.10000;

TaskPrices['0301'] = 0.15000;

TaskPrices['0302'] = 0.20000;

TaskPrices['04'] = 0.00000;

TaskPrices['0400'] = 0.10000;

TaskPrices['0401'] = 0.15000;

TaskPrices['0402'] = 0.11000;

TaskPrices['0403'] = 0.12000;

TaskPrices['0404'] = 0.13000;

TaskPrices['05'] = 0.00000;

TaskPrices['0500'] = 0.10000;

TaskPrices['0501'] = 0.12000;

TaskPrices['0502'] = 0.14000;

TaskPrices['0503'] = 0.16000;

TaskPrices['0504'] = 0.10000;

TaskPrices['0505'] = 0.13000;

TaskPrices['0506'] = 0.16000;

TaskPrices['06'] = 0.00000;

TaskPrices['0601'] = 0.15000;

TaskPrices['0602'] = 0.20000;

TaskPrices['0603'] = 0.15000;

TaskPrices['0604'] = 0.20000;

TaskPrices['07'] = 0.00000;

TaskPrices['0700'] = 0.15000;

TaskPrices['0701'] = 0.20000;

TaskPrices['08'] = 0.00000;

TaskPrices['0800'] = 0.50000;

TaskPrices['0801'] = 0.75000;

TaskPrices['0802'] = 0.90000;

TaskPrices['0803'] = 1.25000;

TaskPrices['0804'] = 1.50000;

TaskPrices['0805'] = 0.50000;

TaskPrices['0806'] = 0.75000;

TaskPrices['0807'] = 0.90000;

TaskPrices['0808'] = 1.25000;

TaskPrices['0809'] = 1.75000;

TaskPrices['09'] = 0.00000;

TaskPrices['0900'] = 0.25000;

TaskPrices['0901'] = 0.40000;

TaskPrices['0902'] = 0.60000;

TaskPrices['0903'] = 0.80000;

TaskPrices['10'] = 0.00000;

TaskPrices['1000'] = 0.25000;

TaskPrices['1001'] = 0.35000;

TaskPrices['99'] = 0.00000;

TaskPrices['9900'] = 0.10000;







TaskPricesUsa['00'] = 0.00000;

TaskPricesUsa['0000'] = 0.30000;

TaskPricesUsa['0001'] = 0.32000;

TaskPricesUsa['0002'] = 0.30000;

TaskPricesUsa['0003'] = 0.32000;

TaskPricesUsa['02'] = 0.00000;

TaskPricesUsa['0200'] = 0.30000;

TaskPricesUsa['0201'] = 0.35000;

TaskPricesUsa['0202'] = 0.35000;

TaskPricesUsa['0203'] = 0.38000;

TaskPricesUsa['03'] = 0.00000;

TaskPricesUsa['0300'] = 0.35000;

TaskPricesUsa['0301'] = 0.40000;

TaskPricesUsa['0302'] = 0.50000;

TaskPricesUsa['04'] = 0.00000;

TaskPricesUsa['0400'] = 0.35000;

TaskPricesUsa['0401'] = 0.40000;

TaskPricesUsa['0402'] = 0.36000;

TaskPricesUsa['0403'] = 0.36000;

TaskPricesUsa['0404'] = 0.35000;

TaskPricesUsa['05'] = 0.00000;

TaskPricesUsa['0500'] = 0.35000;

TaskPricesUsa['0501'] = 0.40000;

TaskPricesUsa['0502'] = 0.45000;

TaskPricesUsa['0503'] = 0.50000;

TaskPricesUsa['0504'] = 0.35000;

TaskPricesUsa['0505'] = 0.40000;

TaskPricesUsa['0506'] = 0.42000;

TaskPricesUsa['06'] = 0.00000;

TaskPricesUsa['0601'] = 0.35000;

TaskPricesUsa['0602'] = 0.40000;

TaskPricesUsa['0603'] = 0.35000;

TaskPricesUsa['0604'] = 0.40000;

TaskPricesUsa['07'] = 0.00000;

TaskPricesUsa['0700'] = 0.35000;

TaskPricesUsa['0701'] = 0.40000;

TaskPricesUsa['08'] = 0.00000;

TaskPricesUsa['0800'] = 1.30000;

TaskPricesUsa['0801'] = 1.80000;

TaskPricesUsa['0802'] = 2.80000;

TaskPricesUsa['0803'] = 4.20000;

TaskPricesUsa['0804'] = 5.60000;

TaskPricesUsa['0805'] = 1.50000;

TaskPricesUsa['0806'] = 2.40000;

TaskPricesUsa['0807'] = 3.60000;

TaskPricesUsa['0808'] = 4.20000;

TaskPricesUsa['0809'] = 7.00000;

TaskPricesUsa['09'] = 0.00000;

TaskPricesUsa['0900'] = 0.50000;

TaskPricesUsa['0901'] = 0.80000;

TaskPricesUsa['0902'] = 1.20000;

TaskPricesUsa['0903'] = 2.00000;

TaskPricesUsa['10'] = 0.00000;

TaskPricesUsa['1000'] = 0.50000;

TaskPricesUsa['1001'] = 0.80000;

TaskPricesUsa['99'] = 0.00000;

TaskPricesUsa['9900'] = 0.35000;





xSelected_sub_cat = '0000';

xSelected_price = 0;



function final_cat_and_price()

{



	CatV = document.getElementById('Cat').value;

//	SubV = document.getElementById('Sub').value;



	if ((document.getElementById('Sub')== undefined) || (document.getElementById('Sub')== '') || (document.getElementById('Sub')== null))

	{

		FinalCat = CatV;

	}

	else

	{

		SubV = document.getElementById('Sub').value;

		FinalCat = SubV;

	}

			



//	alert(document.getElementById('Targeting')['INT'].value);



//chosen_int = document.form2.Targeting[1].checked;

//chosen_us = document.form2.Targeting[0].checked;







chosen_int = document.getElementById("radioint").checked;

chosen_us = document.getElementById("radious").checked;







//alert('int: ' + chosen_int + ' us: '+chosen_us);

		

	if (chosen_int == true)

	{

		FinalPrice = TaskPrices[FinalCat];

	}

	else

	{

		FinalPrice = TaskPricesUsa[FinalCat];

	}

		

	// get correct price and update the number

	

	document.getElementById('pricepertask').innerHTML = ':' + FinalCat + '$' + FinalPrice ;

	

	if (xSelected_price == 0) // first time when we arrive we dont modify anything

	{

		document.getElementById('Payment_per_task').value = FinalPrice.toFixed(2);

	}

	xSelected_price = 0;

	

	calculate_cost();



}





function update_2nd_dropdown()

{

	dd = new Array();

	

	// dropdowns for subcategories



	



dd['00'] = '<SELECT onChange="final_cat_and_price()" SIZE=9 NAME=Sub Id=Sub><OPTION value=0000>Click 2x</OPTION><OPTION value=0001>Click 3x</OPTION><OPTION value=0002>Search + Click 1x</OPTION><OPTION value=0003>Search + Click 2x</OPTION></SELECT>';

dd['02'] = '<SELECT onChange="final_cat_and_price()" SIZE=9 NAME=Sub Id=Sub><OPTION value=0200>1 Page</OPTION><OPTION value=0201>2 Pages</OPTION><OPTION value=0202>1 Page + Comment</OPTION><OPTION value=0203>2 Pages + Comment 2x</OPTION></SELECT>';

dd['03'] = '<SELECT onChange="final_cat_and_price()" SIZE=9 NAME=Sub Id=Sub><OPTION value=0300>Simple sign up</OPTION><OPTION value=0301>Sign up to Dating websites - simple</OPTION><OPTION value=0302>Complex Sign up</OPTION></SELECT>';

dd['04'] = '<SELECT onChange="final_cat_and_price()" SIZE=9 NAME=Sub Id=Sub><OPTION value=0400>Short Comment</OPTION><OPTION value=0401>Short Comment with a link</OPTION><OPTION value=0402>Short Comment 2x</OPTION><OPTION value=0403>Short Comment 3x</OPTION><OPTION value=0404>Short Comment 4x + Click 2x</OPTION></SELECT>';

dd['05'] = '<SELECT onChange="final_cat_and_price()" SIZE=9 NAME=Sub Id=Sub><OPTION value=0500>Sign up only</OPTION><OPTION value=0501>Sign up + Post 1x</OPTION><OPTION value=0502>Sign up + Post 2x</OPTION><OPTION value=0503>Sign up + Post 3x</OPTION><OPTION value=0504>Post 2x</OPTION><OPTION value=0505>Post 1x + Link in signature</OPTION><OPTION value=0506>Post 2x + Link in signature</OPTION></SELECT>';

dd['06'] = '<SELECT onChange="final_cat_and_price()" SIZE=9 NAME=Sub Id=Sub><OPTION value=0601>Add me as a Friend</OPTION><OPTION value=0602>Become a Fan</OPTION><OPTION value=0603>Post to your Wall</OPTION><OPTION value=0604>Change profile photo</OPTION></SELECT>';

dd['07'] = '<SELECT onChange="final_cat_and_price()" SIZE=9 NAME=Sub Id=Sub><OPTION value=0700>Follow me on Twitter</OPTION><OPTION value=0701>Post to your Twitter</OPTION></SELECT>';

dd['08'] = '<SELECT onChange="final_cat_and_price()" SIZE=9 NAME=Sub Id=Sub><OPTION value=0800>Write an Article of 45-50 words</OPTION><OPTION value=0801>Write an Article of 85-100 words</OPTION><OPTION value=0802>Write an Article of 185-200 words</OPTION><OPTION value=0803>Write an Article of 275-300 words</OPTION><OPTION value=0804>Write an Article of 375-400 words</OPTION><OPTION value=0805>Re-write an Article of 85-100 words</OPTION><OPTION value=0806>Re-write an Article of 185-200 words</OPTION><OPTION value=0807>Re-write an Article of 275-300 words</OPTION><OPTION value=0808>Re-write an Article of 375-400 words</OPTION><OPTION value=0809>Write an Article of 475-500 words</OPTION></SELECT>';

dd['09'] = '<SELECT onChange="final_cat_and_price()" SIZE=9 NAME=Sub Id=Sub><OPTION value=0900>Text Link to my site</OPTION><OPTION value=0901>Link to my site + Review of at least 50 words</OPTION><OPTION value=0902>Link to my site + Review of at least 100 words</OPTION><OPTION value=0903>Banner + Link to my site</OPTION></SELECT>';

dd['10'] = '<SELECT onChange="final_cat_and_price()" SIZE=9 NAME=Sub Id=Sub><OPTION value=1000>Download only</OPTION><OPTION value=1001>Download + Install</OPTION></SELECT>';

dd['99'] = '<SELECT onChange="final_cat_and_price()" SIZE=9 NAME=Sub Id=Sub><OPTION value=9900>Describe below</OPTION></SELECT>';

	

	

	i = document.getElementById('Cat').selectedIndex;

	v = document.getElementById('Cat').value;

	

	



	// show 2nd dropdown 

	



	if ((dd[v] == undefined) || (dd[v] == '') || (dd[v] == null))

	{

		document.getElementById('2nd').innerHTML = "";

	}

	else

	{

		document.getElementById('2nd').innerHTML = dd[v];

	}

	

	

	

	// select 1st option in 2nd dropdown

	

	if ((document.getElementById('Sub')== undefined) || (document.getElementById('Sub')== '') || (document.getElementById('Sub')== null))

	{

	}

	else

	{

		//	document.getElementById('Sub')[xSelected_sub_cat ].selected = true;

		xFound = 0;



		if (xSelected_sub_cat  != 0) // update only when we came to this HTML for the 1st time

		{

			// select proper sub cat in 2nd dropdown



			//if ((Sub != undefined) && (Sub != '') && (Sub != null))

			

			for(var i=0;i<document.getElementById('Sub').length;i++)

			{

		

				if(document.getElementById('Sub')[i].value=='0000')

				{

					xFound = 1;

					//alert('MATCHING  sub[i].value=' + Sub[i].value + '........ selected_sub_cat=0000');

					//document.getElementById('Sub')[i].selected = true;

					document.getElementById('Sub').selectedIndex = i;

					// Sub.selectedIndex = i;			

					xSelected_sub_cat = 0;

				}

			}

		}



		if (xFound == 0)

		{

			document.getElementById('Sub').selectedIndex = 0;

		}

		//	document.getElementById('Sub')[0].selected = true;

	

	}

	

	final_cat_and_price();



}



function update_2nd_dropdown2()
{
	dd = new Array();
	
	// dropdowns for subcategories

	

dd['00'] = '<SELECT disabled="disabled" onChange="final_cat_and_price()" SIZE=9 NAME=Sub Id=Sub><OPTION value=0000>Click 2x</OPTION><OPTION value=0001>Click 3x</OPTION><OPTION value=0002>Search + Click 1x</OPTION><OPTION value=0003>Search + Click 2x</OPTION></SELECT>';
dd['02'] = '<SELECT disabled="disabled" onChange="final_cat_and_price()" SIZE=9 NAME=Sub Id=Sub><OPTION value=0200>1 Page</OPTION><OPTION value=0201>2 Pages</OPTION><OPTION value=0202>1 Page + Comment</OPTION><OPTION value=0203>2 Pages + Comment 2x</OPTION></SELECT>';
dd['03'] = '<SELECT disabled="disabled" onChange="final_cat_and_price()" SIZE=9 NAME=Sub Id=Sub><OPTION value=0300>Simple sign up</OPTION><OPTION value=0301>Sign up to Dating websites - simple</OPTION><OPTION value=0302>Complex Sign up</OPTION></SELECT>';
dd['04'] = '<SELECT disabled="disabled" onChange="final_cat_and_price()" SIZE=9 NAME=Sub Id=Sub><OPTION value=0400>Short Comment</OPTION><OPTION value=0401>Short Comment with a link</OPTION><OPTION value=0402>Short Comment 2x</OPTION><OPTION value=0403>Short Comment 3x</OPTION><OPTION value=0404>Short Comment 4x + Click 2x</OPTION></SELECT>';
dd['05'] = '<SELECT disabled="disabled" onChange="final_cat_and_price()" SIZE=9 NAME=Sub Id=Sub><OPTION value=0500>Sign up only</OPTION><OPTION value=0501>Sign up + Post 1x</OPTION><OPTION value=0502>Sign up + Post 2x</OPTION><OPTION value=0503>Sign up + Post 3x</OPTION><OPTION value=0504>Post 2x</OPTION><OPTION value=0505>Post 1x + Link in signature</OPTION><OPTION value=0506>Post 2x + Link in signature</OPTION></SELECT>';
dd['06'] = '<SELECT disabled="disabled" onChange="final_cat_and_price()" SIZE=9 NAME=Sub Id=Sub><OPTION value=0601>Add me as a Friend</OPTION><OPTION value=0602>Become a Fan</OPTION><OPTION value=0603>Post to your Wall</OPTION><OPTION value=0604>Change profile photo</OPTION></SELECT>';
dd['07'] = '<SELECT disabled="disabled" onChange="final_cat_and_price()" SIZE=9 NAME=Sub Id=Sub><OPTION value=0700>Follow me on Twitter</OPTION><OPTION value=0701>Post to your Twitter</OPTION></SELECT>';
dd['08'] = '<SELECT disabled="disabled" onChange="final_cat_and_price()" SIZE=9 NAME=Sub Id=Sub><OPTION value=0800>Write an Article of 45-50 words</OPTION><OPTION value=0801>Write an Article of 85-100 words</OPTION><OPTION value=0802>Write an Article of 185-200 words</OPTION><OPTION value=0803>Write an Article of 275-300 words</OPTION><OPTION value=0804>Write an Article of 375-400 words</OPTION><OPTION value=0805>Re-write an Article of 85-100 words</OPTION><OPTION value=0806>Re-write an Article of 185-200 words</OPTION><OPTION value=0807>Re-write an Article of 275-300 words</OPTION><OPTION value=0808>Re-write an Article of 375-400 words</OPTION><OPTION value=0809>Write an Article of 475-500 words</OPTION></SELECT>';
dd['09'] = '<SELECT disabled="disabled" onChange="final_cat_and_price()" SIZE=9 NAME=Sub Id=Sub><OPTION value=0900>Text Link to my site</OPTION><OPTION value=0901>Link to my site + Review of at least 50 words</OPTION><OPTION value=0902>Link to my site + Review of at least 100 words</OPTION><OPTION value=0903>Banner + Link to my site</OPTION></SELECT>';
dd['10'] = '<SELECT disabled="disabled" onChange="final_cat_and_price()" SIZE=9 NAME=Sub Id=Sub><OPTION value=1000>Download only</OPTION><OPTION value=1001>Download + Install</OPTION></SELECT>';
dd['99'] = '<SELECT disabled="disabled" onChange="final_cat_and_price()" SIZE=9 NAME=Sub Id=Sub><OPTION value=9900>Describe below</OPTION></SELECT>';
	
	
	i = document.getElementById('Cat').selectedIndex;
	v = document.getElementById('Cat').value;
	
	

	// show 2nd dropdown 
	

	if ((dd[v] == undefined) || (dd[v] == '') || (dd[v] == null))
	{
		document.getElementById('2nd').innerHTML = "";
	}
	else
	{
		document.getElementById('2nd').innerHTML = dd[v];
	}
	
	
	
	// select 1st option in 2nd dropdown
	
	if ((document.getElementById('Sub')== undefined) || (document.getElementById('Sub')== '') || (document.getElementById('Sub')== null))
	{
	}
	else
	{
		//	document.getElementById('Sub')[xSelected_sub_cat ].selected = true;
		xFound = 0;

		if (xSelected_sub_cat  != 0) // update only when we came to this HTML for the 1st time
		{
			// select proper sub cat in 2nd dropdown

			//if ((Sub != undefined) && (Sub != '') && (Sub != null))
			
			for(var i=0;i<document.getElementById('Sub').length;i++)
			{
		
				if(document.getElementById('Sub')[i].value=='0000')
				{
					xFound = 1;
					//alert('MATCHING  sub[i].value=' + Sub[i].value + '........ selected_sub_cat=0000');
					//document.getElementById('Sub')[i].selected = true;
					document.getElementById('Sub').selectedIndex = i;
					// Sub.selectedIndex = i;			
					xSelected_sub_cat = 0;
				}
			}
		}

		if (xFound == 0)
		{
			document.getElementById('Sub').selectedIndex = 0;
		}
		//	document.getElementById('Sub')[0].selected = true;
	
	}
	
	final_cat_and_price();

}





//-----------------------------------------------------





function price66(aTarget)

{

//	return;

	//aTarget = 'INT';

	

//	alert(1);

	

	

	if (aTarget == 'USA')

	{

		if (document.getElementById('Payment_per_task').value < <?php echo $USAjobcost; ?>)

		{

			document.getElementById('Payment_per_task').value = <?php echo $USAjobcost; ?>;

		}

	}

	

	

	if (aTarget == 'INT')

	{

		if (document.getElementById('Payment_per_task').value < <?php echo $INTjobcost; ?>)

		{

			document.getElementById('Payment_per_task').value = <?php echo $INTjobcost; ?>;

		}

	}



	final_cat_and_price();

	calculate_cost();





}

function calculate_cost(isbold,ishigh)
{
	xfee = 0;
	if(document.form2.bold.checked==1)
		isbold=1;
	if(document.form2.highlighted.checked==1)
		ishigh=1;
	
	xapproval_fee = <?php echo $EstimatedCampaigncost; ?>;
	boldcost = <?php echo $Boldjobcost; ?>;
	highlightcost = <?php echo $Highlightedjobcost; ?>;
	// cost per position - 2 decimals
	
	x = document.getElementById('Payment_per_task').value;
	x = Math.abs(parseFloat(x).toFixed(2));
	if (isNaN(x)) x = 0;
	x=  x.toFixed(2);
	document.getElementById('Payment_per_task').value = x;
	
	// available position - 0 decimals

	x = document.getElementById('Available_positions').value;
	x = Math.abs(parseFloat(x).toFixed(0));
	if (isNaN(x)) x = 0;
	document.getElementById('Available_positions').value = x;

	// minutes - 0 decimals

	x = document.getElementById('Minutes_to_finish').value;
	x = Math.abs(parseFloat(x).toFixed(0));
	if (isNaN(x)) x = 0;
	document.getElementById('Minutes_to_finish').value = x;
	
	


	xPositions = document.getElementById('Available_positions').value;
	xPayment = document.getElementById('Payment_per_task').value;
//	xPayment =  xPayment.toFixed(2);
	
//	xTotal_cost = parseFloat(xPositions * xPayment);
	xTotal_cost = parseFloat(xPositions * xPayment)*(1+xfee/100) + xapproval_fee;

	
//##	document.getElementById('available_positions2').innerHTML = xPositions;
//##	document.getElementById('payment_per_task2').innerHTML = xPayment;
//##	document.getElementById('total_cost2').innerHTML = xTotal_cost.toFixed(2);
    var totcost=parseFloat(xTotal_cost.toFixed(2));
	if(isbold==1)
		totcost +=   parseFloat(boldcost);
	if(ishigh==1)
		totcost +=   parseFloat(highlightcost);
	document.getElementById('total_cost1').innerHTML = totcost;

	return false;

}


</script>
</head>

<body <?php if(strpos($_SERVER['PHP_SELF'],'employer_new_campaign.php')===false) { } else { echo 'onLoad="update_2nd_dropdown()"'; } ?><?php  if(strpos($_SERVER['PHP_SELF'],'edit_job.php')===false) { } else { echo 'onLoad="update_2nd_dropdown2()"'; } ?> >
<?php
if(strpos($_SERVER['PHP_SELF'],'support.php')===false) { } else {
	if(dbNumRows(dbQuery("select * from `support` where `toemail`='".$_SESSION["userlogin"]."' and `read`='1'"))>0) {
	dbQuery("update `support` set `read`='0' where `toemail`='".$_SESSION["userlogin"]."'");
	}
}
?>
<script language="javascript" src="js/wz_tooltip.js"></script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top">
	
	

<table class="container" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="head_top">
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td style="text-align:center;"><a href="index.php"><img src="<?php if((strpos($_SERVER['PHP_SELF'],'support.php')!==false || !isset($_SESSION["userlogin"])) && strpos($_SERVER['HTTP_USER_AGENT'],"MSIE 6.0")!==false || strpos($_SERVER['HTTP_USER_AGENT'],"MSIE 7.0")!==false) { echo 'images/logo.jpg'; } else { echo 'images/logo.png'; } ?>" height="75" width="225" border="0" /></a></td>
		<td width="450">&nbsp;</td>
		<?php if(isset($_SESSION["userlogin"])) { ?>
		<td align="center"><a href="tellafriend.php">Tell a Friend</a></td>		
        <td align="center">|</td>
        <td align="center"><a href="support.php?Go=dG9lbWFpbA==" style="text-decoration:none"><?php if(dbNumRows(dbQuery("select * from `support` where `toemail`='".$_SESSION["userlogin"]."' and `read`='1'"))>0) { ?>
	   Support&nbsp;<img src="images/mail-new2.gif" height="11" width="42" border="0" />
	   <?php } else { ?>
	   Support
	   <?php } ?></a>
	    </td>
        <td align="center">|</td> 
		<td align="center" style="padding-right:20px;"><a href="logout.php">Logout</a></td>
		<?php } else { ?>
		<td>Existing user <a href="login.php">Login</a></td>
		<td>New User? <a href="signup.php">Register for Free</a></td>
		<?php } ?>
	  </tr>
	</table>
	
	</td>
  </tr>
<?php 
if(isset($_SESSION["userlogin"])) { 
$user=mysql_fetch_array(mysql_query("select * from `user_registration` where `email`='".$_SESSION["userlogin"]."'"));
?>
  <tr>
    <td class="head_mid_afterlogin">
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td style="padding-left:20px; padding-top:30px;" align="left" valign="top">
		
		<table width="440" border="0" cellspacing="5" cellpadding="0">		  
		  <tr>
			<td class="head_mid_smalltextafterlogin">
			<?php echo stripslashes($user["fullname"]); ?><br />
			<?php echo stripslashes($user["email"]); ?><br />
			Balance:$<?php echo number_format($user["current_balance"],'2','.',''); ?>  +<?php echo $SignUpbonus; ?> bonus  <a style='cursor:help;' onmouseover="Tip('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bonus available in your account. Bonus will be used for new campaigns.', BORDERCOLOR, '#CFCFB3', BGCOLOR, '#f9f9d7', WIDTH, -180, FONTFACE, 'Arial,Tahoma', FONTSIZE, '12px')" onmouseout="UnTip()">
<span style="font-size: 12px; color:#FFFFFF">?</span></a><br />
<?php
$successsql=dbQuery("select * from `success_rate` where `email`='".$_SESSION["userlogin"]."'");
$successcount=dbNumRows($successsql);
$successsatisfied=0;
$successnotsatisfied=0;
if($successcount>0) {
	while($successres=dbFetchArray($successsql,MYSQL_BOTH)) {
		if($successres["status"]=='2') {
		$successnotsatisfied=$successnotsatisfied+1;
		} else if($successres["status"]=='3') {
		$successsatisfied=$successsatisfied+1;
		}
	}
} 
if($successcount==0) {
$successsatisfy='100';
} else {
$successsatisfy = floor((($successsatisfied/$successcount)*100)); 
}
if($successsatisfy>75) {
dbQuery("update `user_registration` set `submittask`='0' where `email`='".$_SESSION["userlogin"]."'");
} else {
dbQuery("update `user_registration` set `submittask`='1' where `email`='".$_SESSION["userlogin"]."'");
}
?>
<style>
div.pagerank-holder
{
height:10px;
width:100px;
background-color:#FFFFFF;
border:1px #848484 solid;
float:left;
} 
.rank
{
background-color:#FF0000;
height:10px;
float:left;
} 
</style>

			
            <a href="success_rate.php" style="text-decoration:none; font-size: 15px; color:#FFFFFF; font-weight:bold;">Success rate: <?php echo $successsatisfy; ?>%</a>
			</td>
			<td class="head_mid_smalltextafterlogin">
			Worker [ Past day ]<br />
			 Rated Satisfied: <?php echo $successsatisfied; ?> of <?php echo $successcount; ?><br />
			<table width="210" border="0" cellpadding="0" cellspacing="0">				 
				  <tr>					
					<td width="102"><div class="pagerank-holder">
				<div class="rank" style="width:<?php if($user["current_balance"]>=10) { echo '100'; } else { echo $user["current_balance"]*10; } ?>%"></div>
				</div></td>
					<td align="left" style="padding:0px; padding-left:5px; padding-bottom:4px; margin:0px;">[ <?php if($user["current_balance"]>=10) { echo '100'; } else { echo $user["current_balance"]*10; } ?>%  To Pay Out ]</td>
				  </tr>
			</table>
			<a href="withdraw.php" style="text-decoration:none; font-size: 15px; color:#FFFFFF; font-weight:bold;">Withdrawal Now...</a>
			</td>
		  </tr>		 
		</table>

		
		</td>
		<td>&nbsp;</td>
		<td align="center" valign="middle"><img src="<?php if((strpos($_SERVER['PHP_SELF'],'support.php')!==false || strpos($_SERVER['PHP_SELF'],'index.php')!==false) && strpos($_SERVER['HTTP_USER_AGENT'],"MSIE 6.0")!==false || strpos($_SERVER['HTTP_USER_AGENT'],"MSIE 7.0")!==false) { echo 'images/header_banner-img-innerpage.jpg'; } else { echo 'images/header_banner-img.png'; } ?>" height="120" width="462" border="0" /></td>
	  </tr>
	</table>

	
	</td>
  </tr>
<?php } else { ?>
  <tr>
    <td class="head_mid">
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td style="padding-left:20px;" align="left">
		
		<table width="400" border="0" cellspacing="5" cellpadding="0">
		  <tr>
			<td class="head_mid_boldtext">Out Sourcing For<br /> Small Business</td>
		  </tr>
		  <tr>
			<td class="head_mid_smalltext">Get your job done online the smart way! Instantly tap into out 24x7 workfource of YOURDOMAIN. Get any job done quickly, to a hogh level of quality and cost effectively.</td>
		  </tr>
		  <tr>
			<td class="head_mid_smallbottomtext">Post a project in seconds. Try it now!</td>
		  </tr>
		</table>

		
		</td>
		<td>&nbsp;</td>
		<td align="center" valign="middle"><img src="<?php if((strpos($_SERVER['PHP_SELF'],'support.php')!==false || !isset($_SESSION["userlogin"])) && strpos($_SERVER['HTTP_USER_AGENT'],"MSIE 6.0")!==false || strpos($_SERVER['HTTP_USER_AGENT'],"MSIE 7.0")!==false) { echo 'images/header_banner-img.jpg'; } else { echo 'images/header_banner-img.png'; } ?>" height="222" width="482" border="0" /></td>
	  </tr>
	</table>

	
	</td>
  </tr>
<?php } ?>
  <tr>
    <td style="background:url(images/menu-bar.png) repeat-x; height:50px;">
	<?php if(isset($_SESSION["userlogin"])) { ?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td style="padding-left:50px;" align="left">
		
		<table width="650" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td class="menu" align="center"><a href="jobs.php">Available Jobs</a></td>
			<td class="menu">&nbsp;|&nbsp;</td>
			<td class="menu" align="center"><a href="worker.php">Finished Tasks</a></td>
			<td class="menu">&nbsp;|&nbsp;</td>
			<td class="menu" align="center"><a href="employer.php">My Campaigns</a></td>
			<td class="menu">&nbsp;|&nbsp;</td>
			<td class="menu" align="center"><a href="account.php">My Account</a></td>
			<td class="menu">&nbsp;|&nbsp;</td>
			<td class="menu" align="center"><a href="deposit.php">Deposit</a></td>
			<td class="menu">&nbsp;|&nbsp;</td>
			<td class="menu" align="center"><a href="withdraw.php">Withdraw</a></td>
			<td class="menu">&nbsp;|&nbsp;</td>
			<td class="menu" align="center"><a href="referral.php">Referrals</a></td>
		  </tr>
		</table>
		
		</td>
		<td>&nbsp;</td>
		<td style="padding-right:50px;" align="right">
		<form name="search" action="searchjobs.php" method="post">
		<table width="235" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td style="background:url(images/search-box.png) no-repeat; padding-left:30px; width:175px;" align="left"><input type="text" style="padding:2px; border:0px; width:140px; color:#0094CC;" onBlur="if(this.value=='') this.value='Search Job Title'" onClick="if(this.value=='Search Job Title')this.value=''" value="Search Job Title" name="searchtitle" id="searchtitle" /></td><td width="5"></td><td><input type="image" src="images/btn_go.png" style="width:40px; height:30px;" name="goSearch" /></td>
		  </tr>
		</table>
		</form>		
		</td>
	  </tr>
	</table>
    <?php } else { ?>
	<link type="text/css" href="css/ui-lightness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td style="padding-left:50px;" align="left">
		
		<table width="450" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td class="menu" align="center"><a href="index.php">Home</a></td>
			<td class="menu" align="center">&nbsp;|&nbsp;&nbsp;</td>
			<td class="menu" align="center"><a href="aboutus.php">About Us</a></td>
			<td class="menu" align="center">&nbsp;|&nbsp;&nbsp;</td>
			<td class="menu" align="center"><a href="toon.php">How it Works</a></td>
			<td class="menu" align="center">&nbsp;|&nbsp;&nbsp;</td>
			<td class="menu" align="center"><a href="javascript: void(0);" id="dialog_news">Newsletter Subscription</a></td>
		  </tr>
		</table>		
			<script language="javascript" type="text/javascript">			  		
			    $(document).ready(function(){  
				$('#dialog_news').click(function(){  
				 $("#dialognewsletter").dialog({
					autoOpen: true,
					width: 400					
					});	
				return false;
				});			
			  });
			</script>			
			<div id="dialognewsletter" title="Newsletter Subscription" style="display:none;">
			 <p>	
			 <form name="fn" method="get" action="">		
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				 <tr>
					<td colspan="2">&nbsp;</td>
				 </tr>
				  <tr>
					<td width="100" valign="top" align="center"><b>Your Email</b>&nbsp;</td><td width="250" align="left" valign="top"><input type="text" id="Email" name="Email" style="width:220px; border: 2px solid #C0C0C0"></td>
				  </tr>
				   <tr>
					<td width="100" valign="top" align="right">&nbsp;</td><td width="250" align="left" valign="top" style="padding-top:5px;">
					<input type="button" name="Btnnews" onclick='javascript: newsletter_subscribe();'  value="Subscribe" />
					</td>
				  </tr>
				  <tr>
					<td width="100" valign="top" align="right">&nbsp;</td><td id="newsletter" align="left" style="padding-top:5px;"><font color="#7BB242"><b>&nbsp;</b></font></td>
				 </tr>
				</table>
			 </form>
			 </p>			 	 
		  </div>
		  <script language="javascript" type="text/javascript">			
			function newsletter_subscribe()			
			{
			
				if(document.getElementById('Email').value!='') {
			
			
			
			$.get("ajaxnewsletter.php", { email: document.getElementById('Email').value },
			
			   function(data){   
			
				if($.trim(data)!='no') {
			
					document.getElementById("newsletter").innerHTML='<font color="#7BB242"><b>Thank you for subscribe!</b></font>';
			
					} else if($.trim(data)=='no') {
			
					document.getElementById("newsletter").innerHTML='<font color="#FF0000"><b>You have already subscribed!</b></font>';
			
					}	
			
			   });
			
			   
			
			   } else {
			
			   document.getElementById("newsletter").innerHTML='<font color="#FF0000"><b>Please enter your Email!</b></font>';
			
			   }
			
			}			
		  </script>   
		</td>
		<td>&nbsp;</td>
		<td style="padding-right:50px;" align="right">
		<form name="search" action="searchjobslogin.php" method="post">
		<table width="300" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td style="background:url(images/search-box.gif) no-repeat; padding-left:30px;" align="left"><input type="text" style="padding:2px; border:0px; width:200px; color:#0094CC;" name="searchtitle" onBlur="if(this.value=='') this.value='Search Job Title'" onClick="if(this.value=='Search Job Title')this.value=''" value="Search Job Title" id="searchtitle" /></td><td width="5"></td><td><input type="image" src="images/btn_go.gif" style="width:40px; height:30px;" name="goSearch" /></td>
		  </tr>
		</table>
		</form>	
		</td>
	  </tr>
	</table>
	<?php } ?>
	</td>
  </tr>
</table>

<?php if(strpos($_SERVER['PHP_SELF'],'index.php')===false) { } else { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding-left:38px; padding-right:38px;">
	
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="background:url(images/left-box.gif) no-repeat; width:460px; height:277px;" valign="top" align="center">
	
	<table width="370" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td class="home_top_blodtext" align="left">LOOKING FOR WORKERS?</td>
	  </tr>
	  <tr>
		<td class="home_top_middletext" style="padding-bottom:10px;" align="left">Join us and post project, Our 13445 YOURDOMAIN professionals can get any job done quickly and professionally. Find out more...</td>
	  </tr>
	  <tr>
		<td class="home_top_middletext" style="padding-bottom:30px;" align="left">
		--- Blog about your product<br />
		--- Post reviews to Websites &amp; Blogs<br />
		--- Add you to Facebook<br />
		--- Become fan of your group<br />
		--- Follow you on Twitter<br />
		--- Digg your website<br />
		--- <i>and much more...</i>
		</td>
	  </tr>
	  <tr>
		<td style="color:#FFFFFF; font-size:14px; font-weight:bold; padding-left:102px;" align="left">POST A PROJECT NOW!</td>
	  </tr>
	</table>

	
	</td> 
	<td style="width:5px;">&nbsp;</td> 
	<td style="background:url(images/right-box.gif) no-repeat; width:460px; height:277px;" valign="top" align="center">
	
	<table width="340" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td class="home_top_blodtext" align="left">LOOKING FOR WORKS?</td>
	  </tr>
	  <tr>
		<td class="home_top_middletext" style="padding-bottom:10px;" align="left">Our user have earned US$3432,432! Let us find you online jobs! Its very easy to sign up and bid. Join us and start making money today! Find out more...</td>
	  </tr>
	  <tr>
		<td class="home_top_middletext" style="padding-bottom:46px;" align="left">	
		--- Browse jobs<br />
		--- Select jobs you like<br />
		--- Finish tasks &amp; submit proof<br />
		--- Earn money<br />
		--- $1.00 Sign up bonus
		</td>
	  </tr>
	  <tr>
		<td style="color:#FFFFFF; font-size:14px; font-weight:bold; padding-left:95px;" align="left">SIGN NOW FOR FREE!</td>
	  </tr>
	</table>
	
	</td>
  </tr>
</table>
	
	</td>
  </tr>
</table>
<?php } ?>

	
	</td>
  </tr>
  <tr>
    <td>