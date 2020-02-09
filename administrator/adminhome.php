<?php 
include('includes/admin_header.php'); 
?>

<div style="margin-bottom:10px;">

    <h1 style="text-transform:uppercase">Welcome to the admin home page.</h1>

    <img src="media/line.png" />

</div>

<div style="padding-bottom:5px;">

Hello <?php echo $_SESSION["adminusername"]; ?>!&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<?php if(isset($_GET["msg"]) && $_GET["msg"]=="passchange") { ?><span style="color:#00F">The action has been done successfully!</span><?php } ?>

<?php 
include('includes/admin_footer.php'); 
?>

                    

                    