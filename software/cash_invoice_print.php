<?php
session_start();
if(!isset($_SESSION['sess_admin_user_id']))
{
header("location:login.php");
}
$sess_admin_user_id		=	$_SESSION['sess_admin_user_id'];

include("configs/config.php");
include("configs/function.php");
include("configs/settings.php");

$invoice_id	=	filter_input(INPUT_GET, 'invoice_id', FILTER_SANITIZE_SPECIAL_CHARS);

	
?>

<!DOCTYPE html>
<html lang="en">
    
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?php echo $site_nick; ?></title>

        <link href="css/style.default.css" rel="stylesheet">
        <link href="css/morris.css" rel="stylesheet">
        <link href="css/select2.css" rel="stylesheet" />
		<link href="css/bootstrap-timepicker.min.css" rel="stylesheet" />
		<link href="css/style.datatables.css" rel="stylesheet">
        <link href="css/dataTables.responsive.css" rel="stylesheet">

	


		
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
		
		
    </head>

    <body>
        
		
		<script type="text/javascript">
        function PrintDiv() {
            var contents = document.getElementById("dvContents").innerHTML;
            var frame1 = document.createElement('iframe');
            frame1.name = "frame1";
            frame1.style.position = "absolute";
            frame1.style.top = "-1000000px";
            document.body.appendChild(frame1);
            var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
            frameDoc.document.open();
            frameDoc.document.write('<html><head><title></title>');
            frameDoc.document.write('</head><body>');
            frameDoc.document.write('<h4 style=text-align:center;margin:0;padding:0;><?php echo $site_title; ?> </h4>');
            frameDoc.document.write('<h6 style=text-align:center;margin:0;padding:0;>25 No Hazi Markat, Rajbari</h6>');
            
            frameDoc.document.write('<h6 style=text-align:center;margin:0;padding:0;>Mobile : 01727028899 </h6>');
           
            frameDoc.document.write(contents);
            frameDoc.document.write('</body></html>');
            frameDoc.document.close();
            setTimeout(function () {
                window.frames["frame1"].focus();
                window.frames["frame1"].print();
                document.body.removeChild(frame1);
            }, 500);
            return false;
        }
    </script>
	

	
<form action="" method="POST" name="date_range_query">	
	<div align="center"><input type="button" onclick="PrintDiv();" value="Print" class="btn btn-primary mr5" style="margin-top:10px;" /></div>
	
	</form>
	
	
<style type="text/css">
#dvContents{
	font-size:9px;
}
#dvContents table tbody tr th td{
	font-size:9px;
}

</style>


<link href="css/style.datatables.css" rel="stylesheet">
<link href="css/dataTables.responsive.css" rel="stylesheet">
	
	 <div id="dvContents">


<style text="text/css">

table {
  border-collapse: collapse;
  border-spacing: 0;
}

.modal-sm {
  width: 550px !important;
  font-size:9px;
}

</style>			  
				  
				  
<div class="modal-body">
		
<!--div align="center"><h1 style="font-size:22px; margin:0;">Invoice</h1></div-->

<?php
$sl=1;
$total_cash=0;
$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
$q	=	mysqli_query($db,"SELECT * FROM `shop_cash_sales` WHERE invoice_id=$invoice_id");
$rr	=	mysqli_fetch_array($q);
?>
				 
 <hr>
				  
<table align="center" width="100%" border="0" cellpadding="5" cellspacing="5" style="font-size:9px;">

<tr>
	<td width="50%">Name:  <?php echo $rr['customer_name']; ?></td>
	<td>Invoice No:  #<?php echo $invoice_id; ?></td>
</tr>

<tr>
	<td colspan="2">Sales Date:  <?php echo	$rr['add_date']; ?></td>
	
</tr>

</table>


			  
	   <table align="center" width="100%" class="table table-striped table-bordered responsive" style="font-size:9px;">
		
		<thead class="">
			<tr>
				<th width="12">SL</th>
				<th>Item Name</th>                                      
				<th width="35">Qty</th>            
				<th width="70" align="right">Amount</th>
			</tr>
		</thead>
 
		<tbody>
		
		<?php
		$sl=1;
		$total_cash=0;
		$total_discount	=	get_invoice_info("discount",$invoice_id);
		$invoice_amount	=	get_invoice_info("invoice_amount",$invoice_id);
		$total_cash		=	get_invoice_info("amount",$invoice_id);
		$cash_pay		=	get_invoice_info("cash_pay",$invoice_id);
		$return_pay		=	get_invoice_info("return_pay",$invoice_id);
		
		$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
		$q	=	mysqli_query($db,"SELECT * FROM `shop_cash_sales` WHERE invoice_id=$invoice_id");
		while($r	=	mysqli_fetch_array($q))
		{
		?>
								
			<tr>
				<td><?php echo $sl; $sl+=1; ?></td>
				<td><?php echo get_product_info("product_details",$r['product_id']); ?></td>
				<td><?php echo $r['quantity']; ?></td>
				<td align="right">
<?php
$total_cash_taka	=	$r['net_amount'];
//echo number_format($total_cash_taka,2); $total_cash=$total_cash+$total_cash_taka;
echo number_format($total_cash_taka,2);
?>
				</td>
			</tr>
						
		<?php
		}
		?>								
				
<tr>
<td colspan="3" align="right">Sub Total: </td>
<td align="right"><?php echo number_format($total_cash,2); ?></td>
</tr>	
		
<tr>
<td colspan="3" align="right">(+)Vat: </td>
<td align="right"><?php //echo $total_cash; ?>0.00</td>
</tr>
		
<tr>
<td colspan="3" align="right">(-)Discount: </td>
<td align="right"><?php echo number_format($total_discount,2); ?></td>
</tr>
	
<tr>
<td colspan="3" align="right">Net Payable: </td>
<td align="right"><?php echo number_format($total_cash,2); ?></td>
</tr>
	
<tr>
<td colspan="3" align="right">Cash: </td>
<td align="right"><?php echo number_format($cash_pay,2); ?></td>
</tr>
	
<tr>
<td colspan="3" align="right">Return: </td>
<td align="right"><?php echo number_format($return_pay,2); ?></td>
</tr>

				
									
									</tbody>
                            </table>
				
<div align="center" style="font-size:9px;">Thank you for shopping with us.</div><br><br>

<div align="center" style="font-size:9px;">Powered by: Zubair Bin Tareque<br>Email: zubaireye@gmail.com</div>

				
				  
				  </div>
				  </div>
				  
				  
					
		
		
		
	</body>

</html>	