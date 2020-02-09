<?php 
$position=$_REQUEST['position'];
$payment=$_REQUEST['payment'];
$total=trim($_REQUEST['total']);

$explode=explode("=",$total);
$explode1=explode("X",$explode[0]);
$total1=trim($explode[1]);
$prev_position=trim($explode1[0]);
$prev_payment=$explode[1];
if($position!=$prev_position)
{
$val=$total1/$position;
echo "<input type='text' id='Payment_per_task' name='Payment_per_task' size='8' value='$val' onkeyup='showCost(document.getElementById(\"Available_positions\").value,this.value,document.getElementById(\"total\").value)'> you can increase|1|<input type='text' id='total' name='total' size='25' value='$position X $val = $total1'>";
}
else
{
$val=$total1/$payment;
echo "<input type='text' id='Available_positions' name='Available_positions' size='8' value='$val' onkeyup='showCost(this.value,document.getElementById(\"Payment_per_task\").value,document.getElementById(\"total\").value)'> workers needed<font color=\"#808080\"><span style='font-size: 11px'>&nbsp;&nbsp;&nbsp;
				minimum 20</span></font>|2|<input type='text' id='total' name='total' size='25' value='$val X $payment = $total1'>";
}
?>