<?php
session_start();

if(!isset($_SESSION['sess_user_id']))
{
header("location:login.php");
}


$sess_user_id		=	$_SESSION['sess_user_id'];
//$user_type_id			=	get_user_type_id($sess_user_id);

include("soft_confiq/config.php");
include("soft_confiq/functions.php");
include("soft_confiq/settings.php");
include("function.php");

$invoice_id	=	$_GET['invoice_id'];

?>
<html>

<head><title>ADMIN PANEL | Powered by Zubair</title>


<link rel="stylesheet" type="text/css" href="print.css" />

</head>


<body>

<table width="400" align="center" border="0" bgcolor="white" cellpadding="5" cellspacing="5">

<tr><td>

<table width="400" align="center" border="0" bgcolor="white" cellpadding="5" cellspacing="5">
<tr><td>
<img src="images/logo.gif"></td><td align="center" width="200"><INPUT TYPE="image" SRC="images/printer.png" HEIGHT="12" WIDTH="12" BORDER="0" ALT="Print" onClick="window.print()" value="Print">
</td></tr>
</table>

</td></tr>
<tr><td>

		<table width="400" align="center" border="0" cellpadding="5" cellspacing="5">
		<tr><td><?php echo nl2br($site_address); ?></td><td><h1>INVOICE</h1></td></tr>

		</table>

</td></tr>
<tr><td>

		  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="4" margin="0" bordercolor="#EDF1F3" style="border-collapse:collapse;">
		<tr>
			<td valign="top">
				  <table width="100%" border="1" align="center" cellpadding="5" cellspacing="4" margin="0" bordercolor="#EDF1F3" style="border-collapse:collapse;">

				<tr><td width="150">Customer Mobile</td><td><?php echo get_customer_info("customer_phone",get_invoice_info("customer_id",$invoice_id)); ?></td></tr>



				</table>
			</td>


		<td valign="top">



					  <table width="100%" border="1" align="center" cellpadding="5" cellspacing="4" margin="0" bordercolor="#EDF1F3" style="border-collapse:collapse;">
							<tr><td width="100">Invoice No</td><td>: <?php echo $invoice_id; ?></td></tr>
							<tr><td>Date</td><td><?php echo get_invoice_info("add_date",$invoice_id); ?></td></tr>

					</table>



		</td></tr>

		</table>



</td></tr>
<tr><td>

	<table width="100%" border="1" align="center" cellpadding="5" cellspacing="4" margin="0" bordercolor="#EDF1F3" style="border-collapse:collapse;">
		<tr bgcolor="#cccccc">
			<th>SL NO.</th>
			<th> Description</th>
			<th>Total Price</th>
		</tr>



<?php


$invoice_id				=	$_GET['invoice_id'];

//$add_date				=	get_invoice_info("add_date",$_GET['invoice_id']);

$sl	=	1;

$sub_total	=	0;


$q	=	mysql_query("SELECT * FROM `acc_invoice` WHERE invoice_id=$invoice_id");
while($r	=	mysql_fetch_array($q))
{
?>

		<tr>
			<td align="center" width="80"><?php echo $sl; $sl+=1; ?></td>
			<td align="left"><?php echo $r['remarks']; ?></td>

			<td align="center">


			<?php $total= $r['amount']; echo $total; $sub_total+=$total;?>

			<?php //echo $total=$r["amount"]; ?>

			</td>
		</tr>

<?php
}
?>

<tr bgcolor="#F2F2F2"><td colspan="2" align="right"><b>Grand Total=</b></td><td align="center"><b><?php echo $sub_total; ?></b></td></tr>



<tr bgcolor=#cccccc>

	<td align=right><b>In word (Take):</b></td>

	<td colspan=6>


<?php
$words = array('0'=> '' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five','6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten','11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' => 'fouteen','15' => 'fifteen','16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty','30' => 'thirty','40' => 'fourty','50' => 'fifty','60' => 'sixty','70' => 'seventy','80' => 'eighty','90' => 'ninty','100' => 'hundred &','1000' => 'thousand','100000' => 'lakh','10000000' => 'crore');
	function no_to_words($sub_total)
	{    global $words;
	    if($sub_total == 0)
	        return ' ';
	    else {           $novalue='';$highno=$sub_total;$remainno=0;$value=100;$value1=1000;
	            while($sub_total>=100)    {
	                if(($value <= $sub_total) &&($sub_total  < $value1))    {
	                $novalue=$words["$value"];
	                $highno = (int)($sub_total/$value);
	                $remainno = $sub_total % $value;
	                break;
	                }
	                $value= $value1;
	                $value1 = $value * 100;
	            }
	          if(array_key_exists("$highno",$words))
	              return $words["$highno"]." ".$novalue." ".no_to_words($remainno);
	          else {
	             $unit=$highno%10;
	             $ten =(int)($highno/10)*10;
	             return $words["$ten"]." ".$words["$unit"]." ".$novalue." ".no_to_words($remainno);
	           }
	    }
	}
	echo "<b>".ucwords(no_to_words($sub_total))."Only.</b>";




?>

</td></tr>








	</table>



</td></tr>

<tr><td height="50"></td></tr>


<tr><td>

<table align="center" border="0" width="100%">

<tr>

<td>Received By</td>
<td align="center" width="200">Check By</td>
<td align="right" width="300">Authorized Signature</td>
</table>


</td></tr>

</table>


</body>
</html>
