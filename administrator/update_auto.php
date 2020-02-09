<?php 
include('../settings/config.php');

if(isset($_GET["id"])) 
{
$res=dbFetchArray(dbQuery("select * from `user_registration` where `id`='".$_GET["id"]."'"),MYSQL_BOTH); } else { $res=array(); }

	$status=$res['auto_select'];
	if($status==0 || $status=="")
	 {
	   $sql=dbQuery("update `user_registration` set `auto_select`='1' where `id`='".$_GET["id"]."'");
	 }
	if($status==1)
	 {
	   $sql=dbQuery("update `user_registration` set `auto_select`='0' where `id`='".$_GET["id"]."'");
	 }

?>
<script>
      window.location.href="userlist.php?id=<?=$_GET["id"]?>";
</script>