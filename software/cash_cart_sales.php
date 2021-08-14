 <table width="1210" class="table" border="0" align="center" cellpadding="5" cellspacing="5">
<tr><td valign="top">


<?php

include("soft_confiq/config.php");

if(!isset($_SESSION["REMOTE_ADDR"])) { $_SESSION["REMOTE_ADDR"] = $_SERVER['REMOTE_ADDR']; } else { /*Do nothing since the session already exist man*/ }


if(isset($_POST['p_price']))
{

$purchases_price	=	$_POST['purchases_price'];
$p_price	=	$_POST['p_price'];
$p_id		=	$_POST['id'];
$qty		=	$_POST['qty'];
$total_taka	=	$p_price*$qty;

mysql_query("update `acc_products_added` set

											`purchases_price` = '".mysql_real_escape_string($purchases_price)."',
											`price` = '".mysql_real_escape_string($p_price)."',
											`quantity` = '".mysql_real_escape_string($qty)."',
											`amount` = '".mysql_real_escape_string($total_taka)."'
									where
											`id` = '".mysql_real_escape_string($p_id)."'

			");




$qq		=	mysql_query("SELECT * FROM `acc_products_price` WHERE product_id=$p_id");
$nn		=	mysql_num_rows($qq);



if($nn<1)
{

			$purchases_price	=	$_POST['purchases_price'];
			$p_price			=	$_POST['p_price'];
			$p_id				=	$_POST['id'];

			$product_id				=	$_POST['product_id'];

			$add_datetime		=	date('Y-m-d H:i:s');
			$modify_datetime	=	date('Y-m-d H:i:s');

				if($p_price=='')
					{
						$qqq	=	mysql_query("INSERT INTO `acc_products_price` (
																					`price_id` ,
																					`product_id` ,
																					`product_price` ,
																					`sell_price` ,
																					`added_by` ,
																					`add_datetime` ,
																					`modify_by` ,
																					`modify_datetime`
																					)
																			VALUES (
																					NULL ,
																					'$product_id',
																					'$purchases_price',
																					'$p_price',
																					'$sess_user_id',
																					'$add_datetime',
																					'$sess_user_id',
																					'$modify_datetime'
																					)
												");
					}
				elseif($p_price>=0)
					{
						mysql_query("UPDATE `acc_products_price` SET

											`sell_price` = '$p_price'
										WHERE
										`product_id` =$product_id
									");
					}



}// end of count if
elseif($nn==1)
	{
		if($p_price>=0)
					{
						mysql_query("UPDATE `acc_products_price` SET

											`sell_price` = '$p_price'
										WHERE
										`product_id` =$product_id
									");
					}
	}
}// end of isset of







?>



<!--INLUDED FILES -->
<script type="text/javascript" language="javascript" src="jquery_1.5.2.js"></script>

<script type="text/javascript" language="javascript" src="vasplus_programming_blog_shopping_cart_v4.js"></script>
<link type="text/css" rel="stylesheet" media="all" href="vasplus_programming_blog_shopping_cart_v4.css" />


<center>



<table width="1200" border="0" align="center" cellpadding="0" cellspacing="0">


<tr><td width="450">




<div id="dt_example">

<div id="container">



			<div id="dynamic">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" >
	<thead>
		<tr>
			<th width="40%"> Products Name</th>

			<th width="10%">Action</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="5" class="dataTables_empty">Loading data from server</td>
		</tr>
	</tbody>
	<tfoot>
		<tr>
			<th width="40%"></th>

			<th width="10%"></th>
		</tr>
	</tfoot>
</table>
			</div>

		</div>
		</div>
		<style type="text/css" title="currentStyle">
			@import "data_tables/css/demo_page.css";
			@import "data_tables/css/demo_table.css";
		</style>
		<script type="text/javascript" language="javascript" src="data_tables/js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="data_tables/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable( {
					"bProcessing": true,
					"bServerSide": true,
					"sAjaxSource": "credit_server_processing.php"
				} );
			} );
		</script>



</td><td valign="top" align="center" width="550">



<div id="vasplus_programming_blog_cart_titles" class="shopping_cart_status">Shopping Cart Status</div>


<div id="checkout_user_info" style="display:none;">
<div style="float:left; width:110px; padding-top:10px;" align="left">Your Fullname:</div>
<div style="float:left; width:290px;" align="left"><input type="text" id="vpb_fullname" class="vpb_total_fields" /></div><br clear="all" /><br clear="all" />
<!--
<div style="float:left; width:110px; padding-top:10px;" align="left">Email Address</div>
<div style="float:left; width:300px;" align="left"><input type="text" id="vpb_email" class="vpb_total_fields" /></div><br clear="all" /><br clear="all" />
-->
<div style="float:left; width:110px; padding-top:10px;" align="left">Home Address</div>
<div style="float:left; width:300px;" align="left"><input type="text" id="vpb_address" class="vpb_total_fields" /></div><br clear="all" /><br clear="all" />

<div style="float:left; width:110px; padding-top:10px;" align="left">Phone Number</div>
<div style="float:left; width:300px;" align="left"><input type="text" id="vpb_phone" class="vpb_total_fields" /></div><br clear="all" /><br clear="all" />


<div style="float:left; width:110px; padding-top:10px;" align="left">Invoice Discount</div>

<div style="float:left; width:400px;" align="left"><input type="text" id="vpb_email" size="10" class="vpb_total_fields_discount" /> &nbsp; In Taka. Not Percentage.</div><br clear="all" /><br clear="all" />


<div style="float:left; width:110px; padding-top:10px;" align="left">Sales Date</div>

<div style="float:left; width:400px;" align="left"><input type="text" id="add_date" size="10" value="<?php echo date('Y-m-d'); ?>" class="vpb_total_fields_discount" /> &nbsp; YYYY-MM-DD</div><br clear="all" /><br clear="all" />





<div style="float:left; width:110px; padding-top:10px;" align="left">&nbsp;</div>
<div style="float:left; width:370px;" align="left"><div id="response_status_brought"></div></div><br clear="all" />

<div style="float:left; width:110px; padding-top:10px;" align="left">&nbsp;</div>
<div style="float:left; width:300px;" align="left"><input type="button" id="vasplus_p_blog_add_to_cart_button" style="float:left;width:100px; padding:10px;" value="Submit" onclick="vpb_submitCart();" /><input type="button" value="Go back" title="Clear entire cart items" id="vpb_cart_buttons" onclick="vpb_go_back();" style="float:left; margin-left:20px; width:100px; padding:12px;" /></div><br clear="all" /><br clear="all" />

</div>






<?php
//Check if a specified user has already added a specified item to cart by checking the database products_added's table
$vpb_check_all_items = mysql_query("select * from `acc_products_added` where `username` = '".mysql_real_escape_string($_SESSION["REMOTE_ADDR"])."' order by `id` asc");

//If the specified user has not already added the specified item to database products_added's table then, display a no product added to cart message to the specified user
if(mysql_num_rows($vpb_check_all_items) < 1)
{
	?>

    <div id="response" align="center">


    </div>

    <?php
}
else
{
	//Check the databse products_added's table and sum up the total of all added items to cart
	$check_itemsTotal = mysql_query("select sum(amount) as `items_total` from `acc_products_added` where `username` = '".mysql_real_escape_string($_SESSION["REMOTE_ADDR"])."'");

	//Get all these items
	$vpb_get_itemsTotal = mysql_fetch_array($check_itemsTotal);
	$groundtotal = ($vpb_get_itemsTotal["items_total"]); //Get total of all added items
	?>
    <div id="response" align="center" style="float:left;">
    <div id="vpb_item_numbers" class="vpb_all_tops">No</div>
    <div id="vpb_item_namess" class="vpb_all_tops" align="left">Item Name</div>
    <div id="vpb_item_prices" class="vpb_all_tops" align="left">Stock</div>


    					<div id="vpb_item_prices" class="vpb_all_tops">Purchases Price</div>
						<div id="vpb_item_prices" class="vpb_all_tops">Sell Price</div>


    <div id="vpb_item_prices_input" class="vpb_all_tops">Qty</div>
    <div id="vpb_item_amounts" class="vpb_all_tops">Amount</div>
    <div id="vpb_item_actions" class="vpb_all_tops">Action</div><br clear="all" />
    <?php
    $number_of_items = 1;//Item numbers assigned to 1 to later increment by 1

	//Fetch all added items and display to the screen for the specified user
    while($vpb_get_all_items = mysql_fetch_array($vpb_check_all_items))
    {
		$item_id = strip_tags($vpb_get_all_items["id"]);
        $item_name = strip_tags($vpb_get_all_items["item_added"]);
        $stock = strip_tags(get_product_current_stock_info($vpb_get_all_items["product_id"]));

		$product_id	 		= 	strip_tags($vpb_get_all_items["product_id"]);

       	$purchases_price 	= 	strip_tags($vpb_get_all_items["purchases_price"]);

       	$price 				= 	strip_tags($vpb_get_all_items["price"]);


       	$quantity = strip_tags($vpb_get_all_items["quantity"]);
        $amount = strip_tags($vpb_get_all_items["amount"]);
        $date = strip_tags($vpb_get_all_items["date"]);
        ?>
        <div id="items_cover<?php echo $item_id; ?>" style="">
        <div id="vpb_item_numbers" style="border-top:0px solid #FFF;"><?php echo $number_of_items++; ?></div>
        <div id="vpb_item_namess" style="border-top:0px solid #FFF;" align="left"><?php echo $item_name; ?></div>
        <div id="vpb_item_prices" style="border-top:0px solid #FFF;" align="left"><?php echo $stock; ?></div>


			<div id="vpb_item_prices_input">

							<form action="index.php?s=2001" method="POST">
								<input type="text" name="purchases_price" size="5" onclick="submitForm()" value="<?php echo $purchases_price; ?>" <?php if(get_product_price_row_count($product_id)==1){ echo " disabled"; } ?>>
								<input type="hidden" name="p_price" size="5" onclick="submitForm()" value="<?php echo $price; ?>">
								<input type="hidden" name="product_id" size="6"  value="<?php echo $product_id; ?>">
								<input type="hidden" name="id" size="6"  value="<?php echo $item_id; ?>">
								<input type="hidden" name="qty" size="6" value="<?php echo $quantity; ?>">
							</form>

			</div>




       <div id="vpb_item_prices_input">

			<form action="index.php?s=2001" method="POST">
				<input type="text" name="p_price" size="5" onclick="submitForm()" value="<?php echo $price; ?>">
				<input type="hidden" name="purchases_price" size="5" onclick="submitForm()" value="<?php echo $purchases_price; ?>">

				<input type="hidden" name="id" size="6"  value="<?php echo $item_id; ?>">
				<input type="hidden" name="product_id" size="6"  value="<?php echo $product_id; ?>">
				<input type="hidden" name="qty" size="6" value="<?php echo $quantity; ?>">
			</form>


       </div>




        <!--div id="vpb_item_prices" style="border-top:0px solid #FFF;">$<?php echo $price; ?></div-->


        <div id="vpb_item_prices_input" style="border-top:0px solid #FFF;"><?php //echo $quantity; ?>



        		<form action="index.php?s=2001" method="POST">
						<input type="hidden" name="purchases_price" size="5" onclick="submitForm()" value="<?php echo $purchases_price; ?>">
						<input type="hidden" name="p_price" size="5" onclick="submitForm()" value="<?php echo $price; ?>">
						<input type="hidden" name="id" size="6"  value="<?php echo $item_id; ?>">
						<input type="hidden" name="product_id" size="6"  value="<?php echo $product_id; ?>">
						<input type="text" name="qty" size="3" value="<?php echo $quantity; ?>">
				</form>




        </div>
        <div id="vpb_item_amounts" style="border-top:0px solid #FFF;">$<?php echo $amount; ?></div>
        <div id="vpb_item_actions" style="padding-bottom:9px; padding-top:9px;border-top:0px solid #FFF;"><a href="javascript:void(0);" style="width:10px; height:10px; padding:3px;padding-left:8px;padding-right:8px; text-decoration:none;" id="vpb_cart_buttons" title="Remove this item" onclick="vpb_remove_this_item('<?php echo $item_id; ?>');">X</a> </div>
        <br clear="all" /></div>
        <?php
    }
    ?>
    <div style="border:1px solid #E2E2E2;border:0px solid #FFF;width:595px;margin-top:25px;">
    <div style="width:295px;float:left; padding-top:1px; font-weight:bold;" align="left">
    <input type="text" class="vpb_total_field" disabled="disabled" id="new_sum" value="Items Total: $<?php echo $groundtotal; ?>" />
    </div>
    <div style="width:100px;float:left;" align="right"><input type="button" value="Clear Cart" title="Clear entire cart items" id="vpb_cart_buttons" onclick="vpb_clear_cart('<?php echo $_SESSION["REMOTE_ADDR"]; ?>');" /></div>
    <input type="hidden" id="vpb_main_total_cart_items" value="<?php echo $groundtotal; ?>" />
    <div style="width:100px;float:left;" align="right"><input type="button" value="Checkout" title="Check out to make payment" id="vasplus_p_blog_add_to_cart_button" onclick="vpb_checkout();" /></div>
    </div><br clear="all" />
<?php
}
?>




</div><br clear="all" />
</div><br clear="all" />



</td></tr>

</table>




</center>







</td></tr></table>




