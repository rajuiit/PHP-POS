<?php ob_end_flush();
session_start();
?><style type="text/css">
.table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
  border: 1px solid #ddd;
  vertical-align: middle;
}
</style>

<?php
	

$sess_admin_user_id		=	$_SESSION['sess_admin_user_id'];

include("configs/config.php");
include("configs/function.php");
include("configs/settings.php");

	GLOBAL $groundtotal;

if(isset($_POST['page']) && !empty($_POST['page']))
{


	if($_POST['page'] == "submit_cart")
	{


		$vpb_fullname 	= 	strip_tags($_POST["vpb_fullname"]);
		$discount 		= 	strip_tags($_POST["vpb_email"]);
		$total_bill 	= 	strip_tags($_POST["vpb_address"]);
		//$return_pay 	= 	strip_tags($_POST["vpb_phone"]);
		$cash_pay 		= 	strip_tags($_POST["vpb_phone"]);
		$return_pay		=	$cash_pay-$total_bill;
		
		
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
				
				$discount		=	$_POST['vpb_email'];
				
				$net_amount		=	$amount-$discount;
				
				$net_cash_sales_amount		=	$amount;
				
				//$product_price	= get_product_price($product_id);

				$showroom_id		=	get_user_info("showroom_id",$sess_admin_user_id);
				
				$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);

				$query=	mysqli_query($db,"INSERT INTO `shop_cash_sales` (
					`sales_id` ,
					`showroom_id` ,
					`customer_name` ,
					`product_id` ,
					`invoice_id` ,
					`add_date` ,
					`quantity` ,
					`invoice_amount` ,
					`discount` ,
					`net_amount`
					)
			VALUES (
					NULL , 
					'$showroom_id', 
					'$customer_name', 
					'$product_id', 
					'$invoice_id', 
					'$add_date', 
					'$quantity', 
					'$net_cash_sales_amount', 
					'$discount', 
					'$net_amount'
					)

");


	$query6=	mysqli_query($db,"UPDATE `shop_stock` SET
	
											`sales`		= '1',
											`sales_date`= '$add_date',
											`current_stock`= 0,
											`status` 	= 0	
												
										WHERE 
											`product_id` = $product_id

								");


			}//end of while

			$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);

			$q5		=	mysqli_query($db,"SELECT sum( `amount`) as total FROM `acc_products_added` where `username` = '$sess_admin_user_id'");
			$r5		=	mysqli_fetch_array($q5);

			$invoice_amount	=	$r5['total'];

			$total_invoice_amount	=	$invoice_amount-$discount;
			//$total_invoice_amount	=	$invoice_amount;


			$query3=	mysqli_query($db,"INSERT INTO `shop_invoice` (
												`invoice_id` ,
												`showroom_id` ,
												`customer_name` ,
												`remarks` ,
												`discount` ,
												`invoice_amount` ,
												`amount` ,
												`cash_pay` ,
												`return_pay` ,
												`added_by` ,
												`add_date` ,
												`status`
												)
										VALUES (
												NULL ,  
												'$showroom_id', 
												'$customer_name', 
												'$remarks', 
												'$discount', 
												'$invoice_amount', 
												'$total_invoice_amount', 
												'$cash_pay', 
												'$return_pay', 
												'1', 
												'$add_date',
												'1'
												)



									");

			





	$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);

			mysqli_query($db,"delete from `acc_products_added` where `username` = '$sess_admin_user_id'");
			?>
			<div id="vpb_shopping_cart_is_currently_empty" align="left">




				 <br /><br />


<!-- popup a href='cash_invoice_print.php?invoice_id=<?php echo $invoice_id; ?>' data-target=".bs-example-modal-sm" data-toggle="modal"><center><h3>Print Preview Invoice</h3></center></a-->

<a href="cash_invoice_print.php?invoice_id=<?php echo $invoice_id; ?>" target="_blank"><center><h3>Print Preview Invoice</h3></center></a>

							
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
            frameDoc.document.write('<h4 style=text-align:center;margin:0;padding:0;><?php echo $site_title; ?> </h4>');
            frameDoc.document.write('<h6 style=text-align:center;margin:0;padding:0;>Holding No:04, Ovijan No:23, </h6>');
            frameDoc.document.write('<h6 style=text-align:center;margin:0;padding:0;>Sofiuddin Sarker Academi Road, </h6>');
            frameDoc.document.write('<h6 style=text-align:center;margin:0;padding:0;>Tongi, Gazipur. </h6>');
           
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
	<td>Invoice No:  #<?php echo	$invoice_id; ?></td>
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
					<form action="sales.php?" method="POST">
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
	
	
	<div style="width:50px;float:left;" align="right">
	<form action="sales.php?" method="POST">	
	<input type="submit" value="Save" title="Save" id="vasplus_p_blog_add_to_cart_button" onclick="vpb_checkout('<?php echo $groundtotal; ?>');" />
	</form>
	</div>	
	
		
	<div style="width:100px;float:left;" align="right">
		
	<input type="button" value="Checkout" title="Check out to make payment" id="vasplus_p_blog_add_to_cart_button" onclick="vpb_checkout('<?php echo $groundtotal; ?>');" />
	
	</div>	
	
	
    <div style="width:100px;float:left;" align="right"><input type="button" value="Clear Cart" title="Clear entire cart items" id="vpb_cart_buttons" onclick="vpb_clear_cart('<?php echo $sess_admin_user_id; ?>');" /></div>
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
						
<form action="sales.php?" method="POST">
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
	
<div style="width:50px;float:left;" align="right">
	<form action="sales.php?" method="POST">	
	<input type="submit" value="Save" title="Save" id="vasplus_p_blog_add_to_cart_button" />
	</form>
</div>	
	
	<div style="width:100px;float:left;" align="right">
		
	<input type="button" value="Checkout" title="Check out to make payment" id="vasplus_p_blog_add_to_cart_button" onclick="vpb_checkout('<?php echo $groundtotal; ?>');" />
	
	</div>	
	
	
    <div style="width:100px;float:left;" align="right"><input type="button" value="Clear Cart" title="Clear entire cart items" id="vpb_cart_buttons" onclick="vpb_clear_cart('<?php echo $sess_admin_user_id; ?>');" /></div>
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