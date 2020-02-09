<?php 
include('../settings/config.php');

if(isset($_GET["id"])) 
{
$res=dbFetchArray(dbQuery("select * from `jobs` where `id`='".$_GET["id"]."'"),MYSQL_BOTH); } else { $res=array(); }

	$status=$res['homepage_only'];
	if($status==0 || $status=="")
	 {
	   $sql=dbQuery("update `jobs` set `homepage_only`='1' where `id`='".$_GET["id"]."'");
	 }
	if($status==1)
	 {
	   $sql=dbQuery("update `jobs` set `homepage_only`='0' where `id`='".$_GET["id"]."'");
	 }

?>
<script>
      window.location.href="managejobs.php?id=<?=$_GET["id"]?>";
</script>