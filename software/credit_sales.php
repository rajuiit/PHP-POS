<?php include("header.php"); ?>

<style type="text/css">

.mainwrapper::before {
  border-right: 1px solid #e7e7e7;
  content: "";
  height: 100%;
  left: 0;
  position: fixed;
  top: 0;
  width: 0;
}
.mainpanel {
  margin-left: 0 !important;
}
div.dataTables_length label {
  float: left;
  margin-bottom: 5px !important;
  margin-top: 3px;
}
div.dataTables_length label {
  float: left;
  margin-bottom: 5px !important;
  margin-top: 3px;
  width: 600px !important;
}

label {
  color: #4a535e;
  float: right;
  font-weight: normal;
  margin-bottom: 5px !important;
  margin-top: -42px;
}

.modal-sm {
  width: 550px !important;
}

</style>
	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
		<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
		<script type="text/javascript" language="javascript" >
			$(document).ready(function() {
				var dataTable = $('#employee-grid').DataTable( {
					"processing": true,
					"serverSide": true,
					"ajax":{
						url :"sales_item_processing.php", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".employee-grid-error").html("");
							$("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#employee-grid_processing").css("display","none");
							
						}
					}
				} );
			} );
		</script>
		
        <section>
            <div class="mainwrapper">
               
			   
                <div class="mainpanel">
                    
									
					<div class="contentpanel">
					
						<div class="row">
						
						  <table align="center" width="100%" border="0" cellpadding="5" cellspacing="5">
						 
						 <tr><td valign="top" width="2%"></td>
							<td valign="top" width="49%">
							
<table id="employee-grid" cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
	<thead>
		<tr>
			<th>Item Name</th>
			<th>Item Code</th>
<th>Item Details</th>
			<th>Price</th>
			<th><div align="center">Action</div></th>
		</tr>
	</thead>
</table>
						
			
							
							
							</td>
							<td valign="top" width="9%"></td>
							
							
							
							
							
							<td valign="top" width="40%">
							
<?php
$customer_id	=	filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
?>							
							
							
							
							<!--INLUDED FILES -->
<script type="text/javascript" language="javascript" src="jquery_1.5.2.js"></script>

<script type="text/javascript" language="javascript" src="credit_sales.js"></script>
<link type="text/css" rel="stylesheet" media="all" href="vasplus_programming_blog_shopping_cart_v4.css" />


<div id="vasplus_programming_blog_cart_titles" class="shopping_cart_status"><?php echo get_credit_customer_info("customer_name",$customer_id); ?> Shopping Cart </div>









<?php

	$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);

$customer_id	=	filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
	

if(isset($_POST['p_price'])){
	
	$change_price			=	$_POST['p_price'];
	$change_id				=	$_POST['id'];
	$change_product_id		=	$_POST['product_id'];
	$change_qty				=	$_POST['qty'];
	$change_total_amount	=	$change_price*$change_qty;
	//echo $change_price;
	$change_q = mysqli_query($db,"UPDATE `acc_products_added` SET 
															`price` = '$change_price' ,
															`amount` = '$change_total_amount' 
													WHERE 
															`id` = $change_id
														AND	
															`product_id` = $change_product_id
														 
														
								");
}	
	
	
	
//Check if a specified user has already added a specified item to cart by checking the database products_added's table
$vpb_check_all_items = mysqli_query($db,"select * from `acc_products_added` where `username` = '$sess_admin_user_id' order by `id` asc");

//If the specified user has not already added the specified item to database products_added's table then, display a no product added to cart message to the specified user
if(mysqli_num_rows($vpb_check_all_items) < 1)
{
	?>

    <div id="response" align="center">


    </div>

    <?php
}
else
{
		$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);

	//Check the databse products_added's table and sum up the total of all added items to cart
	$check_itemsTotal = mysqli_query($db,"select sum(amount) as `items_total` from `acc_products_added` where `username` = '$sess_admin_user_id'");

	//Get all these items
	$vpb_get_itemsTotal = mysqli_fetch_array($check_itemsTotal);
	$groundtotal = ($vpb_get_itemsTotal["items_total"]); //Get total of all added items
	?>
    <div id="response" align="center" style="float:left;">
    <div id="vpb_item_numbers" class="vpb_all_tops">No</div>
    <div id="vpb_item_namess" class="vpb_all_tops" align="left">Item Name</div>
    <div id="vpb_item_prices" class="vpb_all_tops" align="center">Stock</div>


    <div id="vpb_item_prices" class="vpb_all_tops">Qty</div>
    <div id="vpb_item_amounts" class="vpb_all_tops">Unit Price</div>
	
    <div id="vpb_item_amounts" class="vpb_all_tops">Amount</div>
    <div id="vpb_item_actions" class="vpb_all_tops">Action</div><br clear="all" />
    <?php
    $number_of_items = 1;//Item numbers assigned to 1 to later increment by 1

	//Fetch all added items and display to the screen for the specified user
    while($vpb_get_all_items = mysqli_fetch_array($vpb_check_all_items))
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
        <div id="vpb_item_prices" style="border-top:0px solid #FFF;" align="center"><?php echo $stock; ?></div>


		




        <!--div id="vpb_item_prices" style="border-top:0px solid #FFF;">$<?php echo $price; ?></div-->


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
       
	   
		<div id="vpb_item_amounts" style="border-top:0px solid #FFF;">Tk. <?php echo $amount; ?></div>
		
		
		
		
        <div id="vpb_item_actions" style="padding-bottom:9px; padding-top:9px;border-top:0px solid #FFF;"><a href="javascript:void(0);" style="width:10px; height:10px; padding:3px;padding-left:8px;padding-right:8px; text-decoration:none;" id="vpb_cart_buttons" title="Remove this item" onclick="vpb_remove_this_item('<?php echo $item_id; ?>');">X</a> </div>
        <br clear="all" /></div>
        <?php
    }
    ?>
    <div style="border:1px solid #E2E2E2;border:0px solid #FFF;width:595px;margin-top:25px;">
    <div style="width:295px;float:left; padding-top:1px; font-weight:bold;" align="left">
    <input type="text" class="vpb_total_field" disabled="disabled" id="new_sum" value="Items Total: <?php echo $groundtotal; ?> Tk." />
    </div>
	
	
	<div style="width:100px;float:left;" align="right">
		
	<button type="submit" name="checkout" value="<?php echo $groundtotal; ?>" title="Check out to make payment" id="vasplus_p_blog_add_to_cart_button0" onclick="vpb_checkout('<?php echo $groundtotal; ?>');" />Checkout</button>
	
	</div>	
	
	
    <div style="width:100px;float:left;" align="right"><input type="button" value="Clear Cart" title="Clear entire cart items" id="vpb_cart_buttons0" onclick="vpb_clear_cart('<?php echo $sess_admin_user_id; ?>');" /></div>
    <input type="hidden" id="vpb_main_total_cart_items" value="<?php echo $groundtotal; ?>" />
    
<br clear="all" />

	<span class="vpb_total_field" style="margin-top:10px;float:left;">Previous Due: <?php echo get_credit_customer_balance_info($customer_id); ?> Tk.</span>

	<br clear="all" />	
	
	<span class="vpb_total_field" style="margin-top:10px;float:left;">Total Due: <?php echo $groundtotal-get_credit_customer_balance_info($customer_id); ?> Taka</span>
	
	
    </div><br clear="all" />
	
	
	
	
	

<?php
}
?>




<div id="checkout_user_info" style="display:none;
margin-top: 10px;
width: 508px;">

<table align="center" border="0" width="100%" cellpadding="5" cellspacing="5">



<tr>
	<td>Your Fullname:</td>
	<td><input type="text" id="vpb_fullname" value="<?php echo get_credit_customer_info("customer_name",$customer_id); ?>" class="vpb_total_fields" />
	
	<input type="hidden" id="vpb_phone" value="<?php echo $customer_id; ?>" class="vpb_total_fields" /></td>
</tr>



<tr>
<td colspan="2" height="10"></td>
</tr>



<tr>
	<td>Cash Pay:</td>
	<td><input type="text" id="vpb_email" class="vpb_total_fields" />
</tr>


<tr>
<td colspan="2" height="10"></td>
</tr>

<tr>
	<td>Sales Date:</td>
	<td><input type="text" id="add_date" size="10" value="<?php echo date('Y-m-d'); ?>" class="vpb_total_fields_discount" /> &nbsp; YYYY-MM-DD</td>
</tr>

<tr>
<td colspan="2" height="10"></td>
</tr>

<tr>
	<td>Discount:</td>
	<td><input type="text" id="vpb_email" size="10" class="vpb_total_fields_discount" /> &nbsp; In Taka. Not Percentage.</td>
</tr>

</table>






<div style="float:left; width:110px; padding-top:10px;" align="left">&nbsp;</div>
<div style="float:left; width:370px;" align="left"><div id="response_status_brought"></div></div><br clear="all" />

<div style="float:left; width:110px; padding-top:10px;" align="left">&nbsp;</div>
<div style="float:left; width:300px;" align="left"><input type="button" id="vasplus_p_blog_add_to_cart_button" style="float:left;width:100px; padding:10px;" value="Submit" onclick="vpb_submitCart();" /><input type="button" value="Go back" title="Clear entire cart items" id="vpb_cart_buttons" onclick="vpb_go_back();" style="float:left; margin-left:20px; width:100px; padding:12px;" /></div><br clear="all" /><br clear="all" />

</div>



</div><br clear="all" />
</div><br clear="all" />



							
							</td>
							
							
							
						 
						 </tr>
						 
						 
						 </table>
						 
						 
                            
						</div><!-- row -->
                        
					</div><!-- contentpanel -->
                </div><!-- mainpanel -->
            </div><!-- mainwrapper -->
        </section>

         <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/jquery-migrate-1.2.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/modernizr.min.js"></script>
        <script src="js/pace.min.js"></script>
        <script src="js/retina.min.js"></script>
        <script src="js/jquery.cookies.js"></script>
        
        <script src="js/jquery.dataTables.min.js"></script>
        <script src=".js/dataTables.bootstrap.js"></script>
        <script src="js/dataTables.responsive.js"></script>
        <script src="js/select2.min.js"></script>

        <script src="js/custom.js"></script>
		
        <script>
            jQuery(document).ready(function(){
                
                jQuery('#basicTable').DataTable({
                    responsive: true
                });
                
                var shTable = jQuery('#shTable').DataTable({
                    "fnDrawCallback": function(oSettings) {
                        jQuery('#shTable_paginate ul').addClass('pagination-active-dark');
                    },
                    responsive: true
                });
                
                // Show/Hide Columns Dropdown
                jQuery('#shCol').click(function(event){
                    event.stopPropagation();
                });
                
                jQuery('#shCol input').on('click', function() {

                    // Get the column API object
                    var column = shTable.column($(this).val());
 
                    // Toggle the visibility
                    if ($(this).is(':checked'))
                        column.visible(true);
                    else
                        column.visible(false);
                });
                
                var exRowTable = jQuery('#exRowTable').DataTable({
                    responsive: true,
                    "fnDrawCallback": function(oSettings) {
                        jQuery('#exRowTable_paginate ul').addClass('pagination-active-success');
                    },
                    "ajax": "ajax/objects.txt",
                    "columns": [
                        {
                            "class":          'details-control',
                            "orderable":      false,
                            "data":           null,
                            "defaultContent": ''
                        },
                        { "data": "name" },
                        { "data": "position" },
                        { "data": "office" },
                        { "data": "salary" }
                    ],
                    "order": [[1, 'asc']] 
                });
                
                // Add event listener for opening and closing details
                jQuery('#exRowTable tbody').on('click', 'td.details-control', function () {
                    var tr = $(this).closest('tr');
                    var row = exRowTable.row( tr );
             
                    if ( row.child.isShown() ) {
                        // This row is already open - close it
                        row.child.hide();
                        tr.removeClass('shown');
                    }
                    else {
                        // Open this row
                        row.child( format(row.data()) ).show();
                        tr.addClass('shown');
                    }
                });
               
                
                // DataTables Length to Select2
                jQuery('div.dataTables_length select').removeClass('form-control input-sm');
                jQuery('div.dataTables_length select').css({width: '60px'});
                jQuery('div.dataTables_length select').select2({
                    minimumResultsForSearch: -1
                });
    
            });
            
            function format (d) {
                // `d` is the original data object for the row
                return '<table class="table table-bordered nomargin">'+
                    '<tr>'+
                        '<td>Full name:</td>'+
                        '<td>'+d.name+'</td>'+
                    '</tr>'+
                    '<tr>'+
                        '<td>Extension number:</td>'+
                        '<td>'+d.extn+'</td>'+
                    '</tr>'+
                    '<tr>'+
                        '<td>Extra info:</td>'+
                        '<td>And any further details here (images etc)...</td>'+
                    '</tr>'+
                '</table>';
            }
        </script>

    </body>

</html>
