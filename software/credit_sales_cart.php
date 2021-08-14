<style type="text/css">
.table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
  border: 1px solid #ddd;
  vertical-align: middle;
}
</style>

<?php
session_start();

$sess_admin_user_id		=	$_SESSION['sess_admin_user_id'];
include("configs/config.php");
include("configs/function.php");
include("configs/settings.php");

$customer_id	=	filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
	



if(isset($_POST['page']) && !empty($_POST['page']))
{


	if($_POST['page'] == "submit_cart")
	{


		$vpb_fullname 	= 	strip_tags($_POST["vpb_fullname"]);
		$vpb_email 		= 	strip_tags($_POST["vpb_email"]);
		
		$vpb_address 	= 	strip_tags($_POST["vpb_address"]);
		$vpb_phone 		= 	strip_tags($_POST["vpb_phone"]);
		
		$customer_id 		= 	strip_tags($_POST["vpb_phone"]);
		$credit 		= 	strip_tags($_POST["vpb_email"]);

		$add_date 		= 	$_POST["add_date"];
		
			$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);

		$vpb_check_items = mysqli_query($db,"select * from `acc_products_added` where `username` = '$sess_admin_user_id'");


		if(mysqli_num_rows($vpb_check_items) < 1)
		{
			?>
			<div id="vpb_shopping_cart_is_currently_empty" align="left">
			Hello There, <br /><br />Your shopping cart is empty at the moment. <br />
			
			</div>
			<?php
		}






		else
		{


			$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);

			$qq5				=	mysqli_query($db,"SELECT * FROM `shop_invoice`");
			$nnn				=	mysqli_num_rows($qq5);

			$invoice_id			= 	$nnn+1;

			//$invoice_amount		=	get_invoice_amount_info($invoice_id);

			//$discount_amount	=	($invoice_amount-$vpb_email);

			
			//$add_datetime		=	date('Y-m-d H:i:s');

			$add_date			=	date('Y-m-d');

			$modify_datetime	=	date('Y-m-d H:i:s');


			
			while($vpb_get_all_items = mysqli_fetch_array($vpb_check_items))
			{
				

				$item_name 	= strip_tags($vpb_get_all_items["item_added"]);
				$price 		= strip_tags($vpb_get_all_items["price"]);
				$quantity 	= strip_tags($vpb_get_all_items["quantity"]);

				$product_id	= strip_tags($vpb_get_all_items["product_id"]);
				
$current_stock	=	get_product_current_stock_info($product_id)-$quantity;
	
				
				$amount 	= strip_tags($vpb_get_all_items["amount"]);

				
				$remarks		=	"Cash Sales";

				$customer_name	=	$_POST['vpb_fullname'];
				
				//$product_price	= get_product_price($product_id);

				
				$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);

				$query=	mysqli_query($db,"INSERT INTO `shop_cash_sales` (
										`sales_id` ,
										`customer_id` ,
										`customer_name` ,
										`product_id` ,
										`invoice_id` ,
										`add_date` ,
										`quantity` ,
										`net_amount`
										)
								VALUES (
										NULL , '$customer_id', '$customer_name', '$product_id', '$invoice_id', '$add_date', '$quantity', '$amount'
										)

								");




		$query6=	mysqli_query($db,"INSERT INTO `shop_stock` (
												`stock_id` ,
												`product_id` ,
												`remarks` ,
												`sales` ,
												`current_stock` ,
												`add_date` ,
												`status`
												)
										VALUES (
												NULL ,
												'$product_id',
												'$remarks',
												'$quantity',
												'$current_stock',
												'$add_date',
												'1'
												)


											");


			}//end of while

	$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);

			$q5		=	mysqli_query($db,"SELECT sum( `amount`) as total FROM `acc_products_added`");
			$r5		=	mysqli_fetch_array($q5);

			$invoice_amount	=	$r5['total'];

			//$total_invoice_amount	=	$invoice_amount-$vpb_email;
			$total_invoice_amount	=	$invoice_amount;


			$query3=	mysqli_query($db,"INSERT INTO `shop_invoice` (
												`invoice_id` ,
												`customer_id` ,
												`customer_name` ,
												`remarks` ,
												`amount` ,
												`added_by` ,
												`add_date` ,
												`status`
												)
										VALUES (
												NULL ,  
												'$customer_id', 
												'$customer_name', 
												'$remarks', 
												'$total_invoice_amount', 
												'1', 
												'$add_date',
												'1'
												)

									");


		
$balance	=	get_credit_customer_balance_info($customer_id)+$credit-$total_invoice_amount;

		

			$query4	=	mysqli_query($db,"INSERT INTO `shop_credit_customer_ledger` (
												`ledger_id` ,
												`customer_id` ,
												`invoice_id` ,
												`add_date` ,
												`remarks` ,
												`debit` ,
												`credit` ,
												`balance`
												)
										VALUES (
												NULL ,  
												'$customer_id', 
												'$invoice_id', 
												'$add_date',
												'$remarks', 
												'$total_invoice_amount', 
												'$credit',
												'$balance'
												)

									");

			





	$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);

			mysqli_query($db,"delete from `acc_products_added` where `username` = '$sess_admin_user_id'");
			?>
			<div id="vpb_shopping_cart_is_currently_empty" align="left">




				 <br /><br />


				 			<a href='cash_invoice_print.php?invoice_id=<?php echo $invoice_id; ?>' data-target=".bs-example-modal-sm" data-toggle="modal"><center><h3>Print Preview Invoice</h3></center></a>

							
				<br /><br />

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                  
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
            frameDoc.document.write('<h1 style=text-align:center;><?php echo $site_title; ?> </h1>');
           
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
	<div align="right"><input type="button" onclick="PrintDiv();" value="Print" class="btn btn-primary mr5" /></div>
	
	</form>
	
	 <div id="dvContents">

<link href="css/style.datatables.css" rel="stylesheet">
<link href="css/dataTables.responsive.css" rel="stylesheet">

<style text="text/css">
table {
  border-collapse: collapse;
  border-spacing: 0;
}
.modal-sm {
  width: 550px !important;
}
</style>			  
				  
				  
                  <div class="modal-body">
		
<div align="center"><h1 style="font-size:22px; margin:0;">Invoice</h1></div>


<?php
$sl=1;
$total_cash=0;
$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
$q	=	mysqli_query($db,"SELECT * FROM `shop_cash_sales` WHERE invoice_id=$invoice_id");
$rr	=	mysqli_fetch_array($q);
?>
				 
 <hr>
				  
<table align="center" width="100%" border="0" cellpadding="5" cellspacing="5">

<tr>
	<td width="50%">Name:  <?php echo $rr['customer_name']; ?></td>
	<td>Invoice No:  <?php echo	$invoice_id; ?></td>
</tr>

<tr>
	<td>Sales Date:  <?php echo	$rr['add_date']; ?></td>
	<td>Next Payment Date:  <?php //echo $rr['next_payment_date']; ?></td>
</tr>

</table>



			  
<table id="basicTable" class="table table-striped table-bordered responsive">
	<thead class="">
		<tr>
			<th width="90">SL</th>
			<th>Item Name</th>                                      
			<th width="40">Qty</th>            
			<th width="130" align="right">Amount</th>                                      
		</tr>
	</thead>

	<tbody>
			
		<?php
		
		$sl=1;
		$total_cash=0;
		$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
		$q	=	mysqli_query($db,"SELECT * FROM `shop_cash_sales` WHERE invoice_id=$invoice_id");

		while($r	=	mysqli_fetch_array($q))
		{
		?>
								
			<tr>
				<td><?php echo $sl; $sl+=1; ?></td>
				<td><?php echo get_product_info("product_name",$r['product_id']); ?></td>
				<td><?php echo $r['quantity']; ?></td>
				<td align="right">
				<?php

	$total_cash_taka	=	$r['net_amount'];

	echo number_format($total_cash_taka,2); $total_cash=$total_cash+$total_cash_taka;

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
	<td colspan="3" align="right">Net Payable: </td>
	<td align="right"><?php echo number_format($total_cash,2); ?></td>
</tr>
	
	
<tr>
	<td colspan="3" align="right">Previous Due:</td>
	<td align="right"><?php echo number_format((get_credit_customer_balance_info($rr['customer_id'])-$total_cash),2); ?></td>
</tr>


<tr>
	<td colspan="3" align="right">Cash Payment:</td>
	<td align="right"><?php echo $_POST['vpb_email']; ?></td>
</tr>


<tr>
	<td colspan="3" align="right">Total Due:</td>
	<td align="right"><?php echo number_format(get_credit_customer_balance_info($rr['customer_id']),2); ?></td>
</tr>



<tr>
	<td align="right">In word:</td>
	<td colspan="3" align="left">
	
	<?php
	$words = array('0'=> '' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five','6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten','11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' => 'fouteen','15' => 'fifteen','16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty','30' => 'thirty','40' => 'fourty','50' => 'fifty','60' => 'sixty','70' => 'seventy','80' => 'eighty','90' => 'ninty','100' => 'hundred &','1000' => 'thousand','100000' => 'lakh','10000000' => 'crore');
	function no_to_words($total_cash)
	{    global $words;
	    if($total_cash == 0)
	        return ' ';
	    else {           $novalue='';$highno=$total_cash;$remainno=0;$value=100;$value1=1000;
	            while($total_cash>=100)    {
	                if(($value <= $total_cash) &&($total_cash  < $value1))    {
	                $novalue=$words["$value"];
	                $highno = (int)($total_cash/$value);
	                $remainno = $total_cash % $value;
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
	echo "<b>".ucwords(no_to_words($total_cash))." Only. </b>";

	?>



	
	</td>
</tr>


								
		</tbody>
		
		
</table>
				
				
				
Thank you for shopping with us.<br>
For any query. Please call <?php echo $site_phone; ?>.<br><br>

<div align="center">Powered by: Zubair Bin Tareque<br>Molile: 01911-944573</div>

				
				  
				  </div>
				  </div>
				  
				  
				  
				  
				  
				  
				  
				  
				  
              </div>
            </div>
        </div>

		
		
		
		
		
				</div>
			<?php
		}

	}













	elseif($_POST['page'] == "clear_cart") //Clear the entire cart
	{
			$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);

		mysqli_query($db,"delete from `acc_products_added` where `username` = '$sess_admin_user_id'");
		?>
        <div id="vpb_shopping_cart_is_currently_empty" align="left">
    	Hello There, <br /><br />Your shopping cart is empty at the moment. <br />Please click on the add to cart buttons at the bottom of each item at the left to add an item of your choice to cart.<br /><br />Thanks You...
    </div>
        <?php
	}
	elseif($_POST['page'] == "remove_this_item") //Remove a specific item from the cart
	{
		
		$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);

		
		mysqli_query($db,"delete from `acc_products_added` where `id` = '".strip_tags($_POST["item_id"])."' and `username` = '$sess_admin_user_id'");
		$vpb_check_items = mysqli_query($db,"select * from `acc_products_added` where `username` = '$sess_admin_user_id'");
		if(mysqli_num_rows($vpb_check_items) < 1)
		{
			echo '<font style="font-size:0px;">empty</font>';
			?>
			<div id="vpb_shopping_cart_is_currently_empty" align="left">
			Hello There, <br /><br />Your shopping cart is empty at the moment. <br />Please click on the add to cart buttons at the bottom of each item at the left to add an item of your choice to cart.<br /><br />Thanks You...
			</div>
			<?php
		}
		else
		{
			
			$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);

			$vpb_check_itemsTotal = mysqli_query($db,"select sum(amount) as `items_total` from `acc_products_added` where `username` = '$sess_admin_user_id'");

			$vpb_get_itemsTotal = mysqli_fetch_array($vpb_check_itemsTotal);
			echo strip_tags($vpb_get_itemsTotal["items_total"]);
		}
	}
	else //The below code performs Add to Cart process and as well displays the cart status
	{
		//Check for valid item name and item price to add a specified item to cart




	if(isset($_POST['product_id']) && !empty($_POST['product_id']) && isset($_POST['product_name']) && !empty($_POST['product_name']) && isset($_POST['product_price']) && !empty($_POST['product_price']))
		{

			//Check if a specified user has already added a specified item to cart by checking the database acc_products_added's table
			
	$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);

$product_name12=get_product_info("product_name",$_POST['product_name']);

	$vpb_check_items = mysqli_query($db,"select * from `acc_products_added` where `username` = '$sess_admin_user_id' and `item_added` = '$product_name12'");

			//If the specified user has not already added the specified item to database acc_products_added's table

			

			if(mysqli_num_rows($vpb_check_items) < 1)
			{
				//Add the specified item to the database acc_products_added's table now

$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
$product_id			=	$_POST['product_name'];
$product_name		= 	get_product_info("product_name",$_POST['product_name']);		
$product_price		=	get_product_info("product_price",$_POST['product_name']);
$product_sell_price	=	get_product_info("product_price",$_POST['product_name']);
$add_date			=	date('Y-m-d');

	
			mysqli_query($db,"insert into `acc_products_added`(
															`id` ,
															`product_id` ,
															`username` ,
															`item_added` ,
															`purchases_price` ,
															`price` ,
															`quantity` ,
															`amount` ,
															`date`
															)
						values(
								'',
								'$product_id',
								'$sess_admin_user_id',
								'$product_name',
								'$product_price',
								'$product_sell_price',
								'1',
								'$product_sell_price',
								'$add_date'
								)
							");

				//Check all the items that the specified user has added to the database acc_products_added's table
				
					$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);

				$vpb_check_all_items = mysqli_query($db,"select * from `acc_products_added` where `username` = '$sess_admin_user_id' order by `id` asc");

				//If no product has been added still, display a no product added to cart message to the specified user
				if(mysqli_num_rows($vpb_check_all_items) < 1)
				{
					?>
					<div id="vpb_shopping_cart_is_currently_empty" align="left">
					Hello There, <br /><br />Your shopping cart is empty at the moment. <br />Please click on the add to cart buttons at the bottom of each item at the left to add an item of your choice to cart.<br /><br />Thanks You...
					</div>
					<?php
				}



				else
				{
					//Check the databse acc_products_added's table and sum up the total of all added items to cart
	
	$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);


					$vpb_check_itemsTotal = mysqli_query($db,"select sum(amount) as `items_total` from `acc_products_added` where `username` = '$sess_admin_user_id'");

					//Get all these items

					$vpb_get_itemsTotal = mysqli_fetch_array($vpb_check_itemsTotal);
					$groundtotal = ($vpb_get_itemsTotal["items_total"]); //Get total of all added items

					?>
					<div align="center">
					
					<div id="vpb_item_numbers" class="vpb_all_tops">No</div>
					<div id="vpb_item_namess" class="vpb_all_tops" align="left">Item Name</div>
					<div id="vpb_item_prices" class="vpb_all_tops" align="center">Stock</div>


					<div id="vpb_item_prices" class="vpb_all_tops">Qty</div>
					<div id="vpb_item_amounts" class="vpb_all_tops">Unit Price</div>
					<div id="vpb_item_amounts" class="vpb_all_tops">Amount</div>
					<div id="vpb_item_actions" class="vpb_all_tops">Action</div><br clear="all" />
					<?php
					$number_of_items = 1; //Item numbers assigned to 1 to later increment by 1

					//Fetch all added items and display to the screen for the specified user
					while($vpb_get_all_items = mysqli_fetch_array($vpb_check_all_items))
					{
						$item_id 		= 	strip_tags($vpb_get_all_items["id"]);
						$item_name 		= 	strip_tags($vpb_get_all_items["item_added"]);
						$stock 			= 	strip_tags(get_product_current_stock_info($vpb_get_all_items["product_id"]));

						$product_id	 		= 	strip_tags($vpb_get_all_items["product_id"]);

						$price 			= 	strip_tags($vpb_get_all_items["price"]);

						$purchases_price 	= 	strip_tags($vpb_get_all_items["purchases_price"]);


						$quantity 		= 	strip_tags($vpb_get_all_items["quantity"]);
						$amount 		= 	strip_tags($vpb_get_all_items["amount"]);
						$date 			= 	strip_tags($vpb_get_all_items["date"]);

						?>



						<div id="items_cover<?php echo $item_id; ?>" style="">
						<div id="vpb_item_numbers" style="border-top:0px solid #FFF;"><?php echo $number_of_items++; ?></div>
						<div id="vpb_item_namess" style="border-top:0px solid #FFF;" align="left"><?php echo $item_name; ?></div>
						<div id="vpb_item_prices" style="border-top:0px solid #FFF;" align="center"><?php echo $stock; ?></div>





						<!--<div id="vpb_item_prices" style="border-top:0px solid #FFF;">$<?php echo $price; ?></div>-->


						<div id="vpb_item_prices" style="border-top:0px solid #FFF;"><?php echo $quantity; ?>

								

						</div>


						<div id="vpb_item_amounts" style="border-top:0px solid #FFF;"><?php //echo $price; ?>
						
<form action="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" method="POST">
	<input type="text" name="p_price" size="5" onclick="submitForm()" value="<?php echo $price; ?>">
	<input type="hidden" name="id" size="6"  value="<?php echo $item_id; ?>">
	<input type="hidden" name="product_id" size="6"  value="<?php echo $product_id; ?>">
	<input type="hidden" name="qty" size="6" value="<?php echo $quantity; ?>">
</form>						
			
				
						</div>
						
						
						<div id="vpb_item_amounts" style="border-top:0px solid #FFF;"><?php echo $amount; ?> Tk.</div>

						<div id="vpb_item_actions" style="padding-bottom:9px; padding-top:9px;border-top:0px solid #FFF;"><a href="javascript:void(0);" style="width:10px; height:10px; padding:3px;padding-left:8px;padding-right:8px; text-decoration:none;" id="vpb_cart_buttons" title="Remove this item" onclick="vpb_remove_this_item('<?php echo $item_id; ?>');">X</a>

						<!--Modify-->

						</div>


						<br clear="all" /></div>
						<?php
					}
					?>
					 <div style="border:1px solid #E2E2E2;border:0px solid #FFF;width:595px;margin-top:25px;">
                    <div style="width:295px;float:left; padding-top:1px; font-weight:bold;" align="left">
                    <input type="text" class="vpb_total_field" disabled="disabled" id="new_sum" value="Items Total: <?php echo $groundtotal; ?> Tk." />
                    </div>
					
					<div style="width:100px;float:left;" align="right">
					
	<input type="button" value="Checkout" title="Check out to make payment" id="vasplus_p_blog_add_to_cart_button0" onclick="vpb_checkout('<?php echo $groundtotal; ?>');" />
					
					</div>
					
                    <div style="width:100px;float:left;" align="right"><input type="button" value="Clear Cart" title="Clear entire cart items" id="vpb_cart_buttons0" onclick="vpb_clear_cart('<?php echo $sess_admin_user_id ?>');" /></div>
					
					
                     <input type="hidden" id="vpb_main_total_cart_items" value="<?php echo $groundtotal; ?>" />
					 
					 

					
					
                    </div><br clear="all" />
					<?php
				}
			}






			else
			{

					$vpb_get_items 	= 	mysqli_fetch_array($vpb_check_items);

					$item_quantity 	= 	strip_tags($vpb_get_items["quantity"])+1;

					$item_amount 	= 	strip_tags($vpb_get_items["amount"])+strip_tags(get_product_info("product_price",$_POST['product_name']));

	$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);


					//Update acc_products_added's table to avoid repetition of a specified item and increment items quantity and amount to display new info

$product_name12=get_product_info("product_name",$_POST['product_name']);

					mysqli_query($db,"update `acc_products_added` set
							`quantity` = '$item_quantity',
							`amount` = '$item_amount'
						where
							`username` = '$sess_admin_user_id'
						and
							`item_added` = '$product_name12'

								");





				//Check all added items to cart from the database repetition's table to display on the screen to the specified user

	$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);

				$vpb_check_all_items = mysqli_query($db,"select * from `acc_products_added` where `username` = '$sess_admin_user_id' order by `id` asc");

				if(mysqli_num_rows($vpb_check_all_items) < 1)// If no item exist then, display a no item message to the specified user
				{
					?>
					<div id="vpb_shopping_cart_is_currently_empty" align="left">
					Hello There, <br /><br />Your shopping cart is empty at the moment. <br />Please click on the add to cart buttons at the bottom of each item at the left to add an item of your choice to cart.<br /><br />Thanks You...
					</div>
					<?php
				}







				else
				{
					
					$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
	
					
					//From this point, follow the same comments as specified on the codes above
					$vpb_check_itemsTotal = mysqli_query($db,"select sum(amount) as `items_total` from `acc_products_added` where `username` = '$sess_admin_user_id'");

					$vpb_get_itemsTotal = mysqli_fetch_array($vpb_check_itemsTotal);
					$groundtotal = ($vpb_get_itemsTotal["items_total"]);
					?>
					<div align="center">
					<div id="vpb_item_numbers" class="vpb_all_tops">No</div>
					<div id="vpb_item_namess" class="vpb_all_tops" align="left">Item Name</div>

					<div id="vpb_item_prices" class="vpb_all_tops" align="center">Stock</div>

									
					<div id="vpb_item_prices" class="vpb_all_tops">Qty</div>
					<div id="vpb_item_amounts" class="vpb_all_tops">Unit Price</div>
					<div id="vpb_item_amounts" class="vpb_all_tops">Amount</div>
					<div id="vpb_item_actions" class="vpb_all_tops">Action</div><br clear="all" />
					<?php
					$number_of_items = 1;
					while($vpb_get_all_items = mysqli_fetch_array($vpb_check_all_items))
					{
						$item_id 	= strip_tags($vpb_get_all_items["id"]);
						$item_name 	= strip_tags($vpb_get_all_items["item_added"]);
						$stock 		= strip_tags(get_product_current_stock_info($vpb_get_all_items["product_id"]));
						$price 		= strip_tags($vpb_get_all_items["price"]);

						$product_id	 		= 	strip_tags($vpb_get_all_items["product_id"]);

						$purchases_price 	= 	strip_tags($vpb_get_all_items["purchases_price"]);

						$quantity 	= strip_tags($vpb_get_all_items["quantity"]);
						$amount 	= strip_tags($vpb_get_all_items["amount"]);
						$date 		= strip_tags($vpb_get_all_items["date"]);
						?>

						<div id="items_cover<?php echo $item_id; ?>" style="">
						<div id="vpb_item_numbers" style="border-top:0px solid #FFF;"><?php echo $number_of_items++; ?></div>
						<div id="vpb_item_namess" style="border-top:0px solid #FFF;" align="left"><?php echo $item_name; ?></div>
						<div id="vpb_item_prices" style="border-top:0px solid #FFF;" align="center"><?php echo $stock; ?></div>




<div id="vpb_item_prices" style="border-top:0px solid #FFF;"><?php echo $quantity; ?>

	

</div>
						
						
						
						
<div id="vpb_item_amounts" style="border-top:0px solid #FFF;"><?php //echo $price; ?>
						
<form action="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" method="POST">
	<input type="text" name="p_price" size="5" onclick="submitForm()" value="<?php echo $price; ?>">
	<input type="hidden" name="id" size="6"  value="<?php echo $item_id; ?>">
	<input type="hidden" name="product_id" size="6"  value="<?php echo $product_id; ?>">
	<input type="hidden" name="qty" size="6" value="<?php echo $quantity; ?>">
</form>						
		
						
						</div>
						
						<div id="vpb_item_amounts" style="border-top:0px solid #FFF;"><?php echo $amount; ?> Tk.</div>
						
						
						<div id="vpb_item_actions" style="padding-bottom:9px; padding-top:9px;border-top:0px solid #FFF;"><a href="javascript:void(0);" style="width:10px; height:10px; padding:3px;padding-left:8px;padding-right:8px; text-decoration:none;" id="vpb_cart_buttons" title="Remove this item" onclick="vpb_remove_this_item('<?php echo $item_id; ?>');">X</a>

						<!--
						<a href="javascript:void(0);" title="Remove this item" onclick="vpb_modify_this_item('<?php echo $item_id; ?>');">
						Modify
						</a>-->



						</div>
						<br clear="all" /></div>
						<?php
					}
					?>
					<div style="border:1px solid #E2E2E2;border:0px solid #FFF;width:595px;margin-top:25px;">
                   
				   <div style="width:295px;float:left; padding-top:1px; font-weight:bold;" align="left">
                    <input type="text" class="vpb_total_field" disabled="disabled" id="new_sum" value="Items Total: <?php echo $groundtotal; ?> Tk." />
                    </div>
					
					
				 
<div style="width:100px;float:left;" align="right">

<input type="button" value="Checkout" title="Check out to make payment" id="vasplus_p_blog_add_to_cart_button0" onclick="vpb_checkout('<?php echo $groundtotal; ?>');" />

</div>	
					
                    <div style="width:100px;float:left;" align="right"><input type="button" value="Clear Cart" title="Clear entire cart items" id="vpb_cart_buttons0" onclick="vpb_clear_cart('<?php echo $sess_admin_user_id; ?>');" /></div>
					
					
                     <input type="hidden" id="vpb_main_total_cart_items" value="<?php echo $groundtotal; ?>" />
					 
					 
					
					
					
                    </div><br clear="all" />
					<?php
				}
			}
		}
		else
		{
			?>
			<div id="vpb_shopping_cart_is_currently_empty" align="left">
			Hello There, <br /><br />No data is passed at the moment. Please try again or contact the site admin to report this error message if the problem persist.<br /><br />Thanks You...
			</div>
			<?php
		}
	}
}
else
{
	?>
	<div id="vpb_shopping_cart_is_currently_empty" align="left">
	Hello There, <br /><br />No data is passed at the moment. Please try again or contact the site admin to report this error message if the problem persist.<br /><br />Thanks You...
	</div>
	<?php
}
?>