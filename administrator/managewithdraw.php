<?php 

include('includes/admin_header.php');



if(isset($_POST["delete"]))

{

	$chk = $_POST["chk"];

	foreach($chk as $c){

	dbQuery("delete from `withdraw` where `id`='".$c."'");

	$_SESSION["withdrawdelete"]="The messages has been deleted successfully!";

	}

}

if(isset($_POST["email"]) && $_POST["email"]!='') {		

$sql = "select * from `withdraw` where `email`='".$_POST["email"]."' order by `id` asc";

} else {		

$sql = "select * from `withdraw` order by `id` asc";

}

if(isset($_POST["pin"]) && $_POST["pin"]=='pin') {		

$sql = "select * from `withdraw` where `pin`='' order by `id` asc";

} else if(isset($_POST["pin"]) && $_POST["pin"]=='userpin') {				

$sql = "select * from `withdraw` where `userpin`<>'' order by `id` asc";

} else {		

$sql = "select * from `withdraw` order by `id` asc";

}




$p = new Pager;

$limit = 100;

$start = $p->findStart($limit);

$count = dbNumRows(dbQuery($sql));

$pages = $p->findPages($count, $limit);

$result = dbQuery($sql." LIMIT ".$start.", ".$limit );

$pagelist = $p->pageList($_GET['page'], $pages);

?>

<div style="margin-bottom:10px;">

    <h1 style="text-transform:uppercase">Here is your all withdraw request details</h1>

    <img src="media/line.png" />

</div>

<div style="padding-bottom:5px;">

<table border="0" cellpadding="2" cellspacing="2" width="734">   

<tr>    

	<td align="left" valign="top" colspan="11" style="color:#666">	

	<table width="100%" border="0" cellspacing="0" cellpadding="0">

	  <tr>

    <td align="right" valign="top" style="color:#666">Choose a user :</td>

	<td align="left" valign="top" style="color:#666">	

	<form name="f1" action="managewithdraw.php" method="post">

	<select name="email" id="email" onchange="javascript: document.f1.submit();" style="width:200px;">

	<option value=""></option>

	<?php $jsql=dbQuery("select * from `user_registration` where status='1'");

	if(dbNumRows($jsql)>0) {

	while($jres=dbFetchArray($jsql,MYSQL_BOTH)) { ?>

	<option value="<?php echo $jres["email"]; ?>" <?php if(isset($_POST["fromemail"]) && $_POST["fromemail"]==$jres["email"]) {	echo 'selected="selected"'; } ?> ><?php echo stripslashes($jres["fullname"]); ?></option>

	<?php } }?>

	</select>

	</form>

	</td>
	
	<td align="right" valign="top" style="color:#666">PIN STATUS :</td>

	<td align="left" valign="top" style="color:#666">	

	<form name="f2" action="managewithdraw.php" method="post">

	<select name="pin" id="pin" onchange="javascript: document.f2.submit();" style="width:100px;">

	<option value="">ALL</option>

	<option value="pin" <?php if(isset($_POST["pin"]) && $_POST["pin"]=='pin') { echo 'selected="selected"'; } ?> >SEND PIN</option>
	
	<option value="userpin" <?php if(isset($_POST["pin"]) && $_POST["pin"]=='userpin') { echo 'selected="selected"'; } ?> >SEND PAYMENT</option>

	</select>

	</form>

	</td>

</tr>

	</table>

	</td>

</tr>

<?php if(isset($_GET["msd"]) && $_GET["msd"]=="success") { ?> 

    <tr>

        <td align="center" valign="top" colspan="11" style="color:#666"><font color="#009933">The action has been successfully performed!</font></td>

    </tr>

<?php } ?>

<?php if(isset($_SESSION["supportdelete"]) && $_SESSION["supportdelete"]!="") { ?>

 <tr>

        <td align="center" valign="top" colspan="11" style="color:#666"><font color="#009933">The action has been successfully performed!</font></td>

    </tr>

<?php unset($_SESSION["supportdelete"]); } ?>

<form name="ff" id="ff" action="managewithdraw.php" method="post" onSubmit="return godelete();">

	<tr>

        <td align="left" valign="top" colspan="11" style="color:#666">Here is your all withdraw request details.&nbsp;&nbsp;&nbsp;</td>

    </tr>

    <tr>     

        <td style="background-color:#B7CBCF; padding:3px;" width="5" align="left" valign="top"><input type="checkbox" name="chkall" onclick='checkedAll(ff);' /></td> 

		<td width="15%" align="left" valign="top" class="labels"><strong>Method</strong></td> 

		<td width="5%" align="left" valign="top" class="labels"><strong>Amount</strong></td> 

		<td width="10%" align="left" valign="top" class="labels"><strong>Sendto</strong></td> 

		<td width="15%" align="left" valign="top" class="labels"><strong>Name</strong></td> 

		<td width="10%" align="left" valign="top" class="labels"><strong>Email</strong></td>   

		<td width="5%" align="left" valign="top" class="labels"><strong>SystemPin</strong></td> 	
		 
		<td width="5%" align="left" valign="top" class="labels"><strong>UserPin</strong></td> 	

        <td width="5%" align="left" valign="top" class="labels"><strong>Status</strong></td>

		<td width="10%" align="left" valign="top" class="labels"><strong>AppliedDate</strong></td>

        <td width="5%" align="left" valign="top" class="labels"><strong>Action</strong></td>                

    </tr>

    <?php

	$ul=0;	

	if(dbNumRows($result)>0)

	{

	$count=1;

		$ul=0;

		while($t = dbFetchArray($result,MYSQL_BOTH))

		{		

		$resu=dbFetchArray(dbQuery("select * from `user_registration` where `email`='".$t["email"]."'"),MYSQL_BOTH);		

	?>	

	<tr id="tr<?php echo $ul; ?>"> 

	<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><input type="checkbox" name="chk[]" id="chk<?php echo $ul ?>" value="<?php echo $t["id"]; ?>" onClick="goselect(<?php echo $ul;?>);" /></td>

	<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php echo stripslashes($t["wdmethod"]); ?></td>

	<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php echo stripslashes($t["wdamount"]); ?></td>

	<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php echo stripslashes($t["wdsendto"]); ?></td>

	<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php echo stripslashes($resu["fullname"]); ?></td>

	<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php echo stripslashes($resu["email"]); ?></td>

	<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php echo stripslashes($t["pin"]); ?></td>   
	
	<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php echo stripslashes($t["userpin"]); ?></td>     

	<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php if($t["status"]==1) { echo "Payment Done"; }  if($t["status"]==0) { echo "Payment Pending"; }  ?></td>    <td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><?php echo date("d/m/Y",strtotime($t["applieddate"])); ?></td>	

	<td align="left" valign="top" class="<?php if($ul%2==0) {?>rows<?php } else {?>labels<?php } ?>"><input type="button" name="edit" class="input" style="font-size:9px;" onClick="goedit('<?php echo $t["id"]; ?>')" value="<?php if(isset($_POST["fromemail"]) && $_POST["fromemail"]==$from) { echo 'DETAILS'; } else { echo 'REPLY'; } ?>" /></td> 	

	</tr>

    <?php

	$ul=$ul+1;

		}

	}

	else

	{

	$count=0;

	?>

	<tr>

    	<td valign="top" colspan="11" align="center" class="labels">Sorry no records here!</td>

	</tr>

	<?php

	}

	?>  

	<?php if($count==1) { ?>                         

    <tr>

    	<td valign="top" colspan="11" class="labels"><div style=" width: 734px; float:left;"><div style="width:70px; float:left; text-align:left;"><button class="input" style="font-size:9px" type="submit" name="delete">DELETE</button></div><div style="width:664px; float:left; text-align:center;"><?php echo $pagelist; ?></div></div></td>

	</tr>

	<?php } ?>

</form>	

</table>

<script language="javascript" type="text/javascript">

function goedit(a){

	window.location.href="editwithdraw.php?id="+a+"&action=edit";

}

/*function godelete(a){

	if(confirm("Are you sure want to delete this user?")==true)

	window.location.href="edituser.php?uid="+a+"&action=delete";

}*/

var col='';

checked=false;

var myCars=new Array();

function checkedAll (ff) {

	var aa= document.getElementById('ff');

			 

	 if (checked == false)

		  {		  

		   for(var j=0;j < <?php echo $ul ?>; j++) {		  

		  myCars[j]=document.getElementById("tr"+j).bgColor;		  

		  document.getElementById("tr"+j).style.backgroundColor='#669999';

		  }

		   checked = true

		  }

		else

		  {		   

		  checked = false

		  for(var k=0;k < <?php echo $ul ?>; k++) {		  

		  document.getElementById("tr"+k).style.backgroundColor= myCars[k];

		  }

		  }

		for (var i = 0; i < aa.elements.length; i++) 

		{	 

		 aa.elements[i].checked = checked;			

		}		

	  }

	 function godelete()

	 {

	 	var yes = 0;

		for(var i=0;i<<?php echo $ul ?>;i++) {

		if(document.getElementById('chk'+i).checked) {

		  yes = 1; 

		  break;

		  } else { yes = 0; }

		 }

		 if(yes==1)

		 {

		 if(confirm('Are sure want to delete those withdraw requests?')) { return true; } else {

		 return false; }

		 }

		 else {

		 alert("Please select any of the withdraw requests to delete.");

		 return false;

		 }

	 }

function goselect(a) {

if(document.getElementById('chk'+a).checked)

{

col=document.getElementById("tr"+a).bgColor;		  

document.getElementById("tr"+a).style.backgroundColor='#669999';

}

else

{

document.getElementById("tr"+a).style.backgroundColor=col;

}

}

</script>

<?php include('includes/admin_footer.php'); ?>

                    

                    