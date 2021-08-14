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

	
?>

<!DOCTYPE html>
<html lang="en">
    
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?php echo $site_nick; ?></title>

 	
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        
       
		
<script type="text/javascript">

    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data) 
    {
        var mywindow = window.open('', 'my div', 'height=400,width=900');
        mywindow.document.write('<html><head><title>Invoice</title>');
        /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
		
mywindow.document.write('<link rel="stylesheet" href="css/style.default.css" type="text/css" />');
mywindow.document.write('<link rel="stylesheet" href="css/morris.css" type="text/css" />');
mywindow.document.write('<link rel="stylesheet" href="css/select2.css" type="text/css" />');
mywindow.document.write('<link rel="stylesheet" href="css/bootstrap-timepicker.min.css" type="text/css" />');
mywindow.document.write('<link rel="stylesheet" href="css/style.datatables.css" type="text/css" />');
mywindow.document.write('<link rel="stylesheet" href="css/dataTables.responsive.css" type="text/css" />');
		
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.print();
        mywindow.close();

        return true;
    }

</script>

 
          
                    
			
<?php
$invoice_id	=	filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
$q	=	mysqli_query($db,"SELECT * FROM `shop_invoice` WHERE `invoice_id` =$invoice_id");
$r	=	mysqli_fetch_array($q);
?>
					
					
					
                <div id="mydiv">

        <link href="css/style.default.css" rel="stylesheet">
        <link href="css/morris.css" rel="stylesheet">
        <link href="css/select2.css" rel="stylesheet" />
		<link href="css/bootstrap-timepicker.min.css" rel="stylesheet" />
		<link href="css/style.datatables.css" rel="stylesheet">
        <link href="css/dataTables.responsive.css" rel="stylesheet">

		
<table width="800" align="center" border="0">

<tr>

<td>
  
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                         <img src="images/logo-primary.png">

                                        <address>
                                            <strong><?php echo $site_title; ?></strong><br>
                                           <?php echo nl2br($site_address); ?><br>
                                            <abbr title="Phone">P:</abbr> <?php echo $site_phone; ?>
                                        </address>
                                        
                                    </div><!-- col-sm-6 -->
                                    
<div class="col-sm-6 text-right">
	<h4 class="text-primary">INV-<?php echo $r['invoice_id']; ?></h4>
	<address>
		
		<strong><?php echo $r['customer_name']; ?></strong><br>
		
	</address>
	
	<p><strong>Invoice Date:</strong> <?php echo $r['add_date']; ?></p>
	<p><strong>Due Date:</strong> <?php echo $r['add_date']; ?></p>
	
</div>
</div><!-- row -->

                                <div class="table-responsive">
                                <table class="table table-bordered table-dark table-invoice">
                                <thead>
                                  <tr>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total Price</th>
                                  </tr>
                                </thead>
                                <tbody>
								
		<?php
		$total	=	0;
		$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
		$qq	=	mysqli_query($db,"SELECT * FROM `shop_cash_sales` WHERE invoice_id=$invoice_id");
		while($rr	=	mysqli_fetch_array($qq))
		{
		?>
			
			
		  <tr>
			<td>
				<h5><?php echo get_product_info("product_name",$rr['product_id']); ?></h5>                                       
			</td>
			<td><?php echo $rr['quantity']; ?></td>
			<td><?php echo $rr['net_amount']/$rr['quantity']; ?></td>
			<td><?php 
			$sut_total	=	$rr['net_amount'];
			echo $sut_total; $total=$total+$sut_total;
			?></td>
		  </tr>
		  
		  
		<?php
		}
		?>								
								  
                                 
                                </tbody>
                              </table>
                              </div><!-- table-responsive -->
                              
                                <table class="table table-total">
                                    <tbody>
                                        <tr>
                                            <td>Sub Total:</td>
                                            <td><?php echo number_format($total,2); ?></td>
                                        </tr>
                                        <tr>
                                            <td>VAT:</td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <td>TOTAL:</td>
                                            <td><?php echo number_format($total,2); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
   <b>In word: </b><?php
	$words = array('0'=> '' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five','6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten','11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' => 'fouteen','15' => 'fifteen','16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty','30' => 'thirty','40' => 'fourty','50' => 'fifty','60' => 'sixty','70' => 'seventy','80' => 'eighty','90' => 'ninty','100' => 'hundred &','1000' => 'thousand','100000' => 'lakh','10000000' => 'crore');
	function no_to_words($total)
	{    global $words;
	    if($total == 0)
	        return ' ';
	    else {           $novalue='';$highno=$total;$remainno=0;$value=100;$value1=1000;
	            while($total>=100)    {
	                if(($value <= $total) &&($total  < $value1))    {
	                $novalue=$words["$value"];
	                $highno = (int)($total/$value);
	                $remainno = $total % $value;
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
	echo "<b>".ucwords(no_to_words($total))." Only. </b>";

	?>
                         
                                
                                <div class="mb30"></div>
                                
                                <div class="well nomargin">
                                   This is computer generated invoice and do not require any stamp or signature
                                </div>
                                
                                
                            </div><!-- panel-body -->
                        </div><!-- panel -->  
                    
 </td>
</tr>
</table> 
			
			
	    <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/jquery-migrate-1.2.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/modernizr.min.js"></script>
        <script src="js/pace.min.js"></script>
        <script src="js/retina.min.js"></script>
        <script src="js/jquery.cookies.js"></script>

        <script src="js/custom.js"></script>
				
				
				
 </div><!-- print div -->
                    
          
		  
   


    
    </body>

</html>
