<?php
	
function get_site_info($info)
	{
	$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
	$q	=	mysqli_query($db,"SELECT $info FROM shop_settings");
	$r	=	mysqli_fetch_array($q);
	$result	=	$r[0];
	return $result;
	}

	
function data_slug($slug){

	//replacing character

	$braces		= 	array ("&", ".","(",")","@");
	$reps 		= 	array ("and","","","","-");
	$slug		=	str_replace($braces, $reps, $slug);

	$post		=	explode(" ", strtolower(trim($slug)));
	$result	=	implode("-",$post);
	return $result;
	}
		
function item_slug($slug){

	//replacing character

	$braces		= 	array ("&", ".","(",")","@");
	$reps 		= 	array ("and","","","","-");
	$slug		=	str_replace($braces, $reps, $slug);

	$post		=	explode(" ", strtolower(trim($slug)));
	$result	=	implode("_",$post);
	return $result;
	}
	
	
function data_slug2($slug){

	//replacing character

	$braces		= 	array ("&", ".","(",")","@");
	$reps 		= 	array ("and","","","","-");
	$slug		=	str_replace($braces, $reps, $slug);

	$post		=	explode(" ", strtolower(trim($slug)));
	$result	=	implode("_",$post);
	return $result;
	}

function secure($field,$type)
		{
		switch($type)
		{
		case 'get':
		$ouput = filter_input(INPUT_GET, $field, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		break;

		case 'post':
		$output = filter_input(INPUT_POST, $field, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES); 
		break;

		default:
		break;
		}
		//$username = secure("username", "post");
		return $output;
		}


	
/*-------------------------------------| USERS |-------*/
function get_user_info($info,$user_id)
	{
	$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
	$q	=	mysqli_query($db,"SELECT $info FROM shop_users WHERE user_id=$user_id");
	$r	=	mysqli_fetch_array($q);
	$result	=	$r[0];
	return $result;
	}


	
/*-------------------------------------| Status |-------*/

function get_status_info($info,$status_id)
	{
	$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
	$q	=	mysqli_query($db,"SELECT $info FROM tc_job_opening_status WHERE status_id=$status_id");
	$r	=	mysqli_fetch_array($q);
	$result	=	$r[0];
	return $result;
	}
	
function month($month)
	{
	$month1			=	$month;
	
	$month_number		=	array ("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
	
	$replace	=	array ("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
	
	$english_month	=	str_replace($month_number, $replace, $month1);
	$english_date=$english_month;
	return $english_date;
	}
	
		
function month2($month)
	{
	$month1			=	$month;
	
	$month_number	=	array ("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
	
	$replace	=	array ("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
	
	$english_month	=	str_replace($month_number, $replace, $month1);
	$english_date=$english_month;
	return $english_date;
	}

		

function get_company_info($info,$company_id)
	{
	$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
	$q	=	mysqli_query($db,"SELECT $info FROM shop_company WHERE company_id=$company_id");
	$r	=	mysqli_fetch_array($q);
	$result	=	$r[0];
	return $result;
	}
	
function get_company_lists($company_id)
	{

		$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);

		$sql="SELECT * FROM shop_company WHERE parent_id=0 ORDER BY company_name ASC";
		$base_cat = mysqli_query($db,$sql) or die($sql);
		
	echo "<select name='parent_id' id=\"select-basic\" data-placeholder=\"Choose One\" class=\"width300\">";

		print "<option value=0>Select Company</option>";
		while($r	=	mysqli_fetch_array($base_cat))
		{		
			?>
				<option value="<?php echo $r['company_id'];?>"<?php if($company_id==$r['company_id']) { ?> selected="selected" <?php } ?>><?php echo $r['company_name'];?></option>
			
			<?php
			$query 	= "select * from shop_company WHERE parent_id='".$r['company_id']."' ORDER BY company_name ASC";
			$ret 	= mysqli_query($db,$query);
			while($row	=	mysqli_fetch_array($ret))
			{
				?>

				<option value="<?php echo $row['company_id'];?>"<?php if($company_id==$row['company_id']) { echo "selected"; } ?>>&nbsp; &nbsp; -- <?php echo $row['company_name']; ?></option>

				<?php
				$subsctegory="select * from shop_company WHERE parent_id= '".$row['company_id']."' ORDER BY company_name ASC";
				$sub_res=mysqli_query($db,$subsctegory);
				while($sub=mysqli_fetch_array($sub_res))
				{
					?>

					<option value="<?php echo $sub['company_id'];?>"<?php if($company_id==$sub['company_id']) { echo "selected"; } ?>>&nbsp; &nbsp; &nbsp; &nbsp; ---- <?php echo $sub['company_name']; ?></option>
					<?php
				} // of 3rd while
			
			} // end of 2nd while

		} // end of 1st while
		print'</select>';
	}

		
function get_company_lists_search($company_id)
	{

		$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);

		$sql="SELECT * FROM shop_company WHERE parent_id=0 ORDER BY company_name ASC";
		$base_cat = mysqli_query($db,$sql) or die($sql);
		
	echo "<select name='id' id=\"select-basic\" data-placeholder=\"Choose One\" class=\"width300\">";

		print "<option value=0>Select Company</option>";
		while($r	=	mysqli_fetch_array($base_cat))
		{		
			?>
				<option value="<?php echo $r['company_id'];?>"<?php if($company_id==$r['company_id']) { ?> selected="selected" <?php } ?>><?php echo $r['company_name'];?></option>
			
			<?php
			$query 	= "select * from shop_company WHERE parent_id='".$r['company_id']."' ORDER BY company_name ASC";
			$ret 	= mysqli_query($db,$query);
			while($row	=	mysqli_fetch_array($ret))
			{
				?>

				<option value="<?php echo $row['company_id'];?>"<?php if($company_id==$row['company_id']) { echo "selected"; } ?>>&nbsp; &nbsp; -- <?php echo $row['company_name']; ?></option>

				<?php
				$subsctegory="select * from shop_company WHERE parent_id= '".$row['company_id']."' ORDER BY company_name ASC";
				$sub_res=mysqli_query($db,$subsctegory);
				while($sub=mysqli_fetch_array($sub_res))
				{
					?>

					<option value="<?php echo $sub['company_id'];?>"<?php if($company_id==$sub['company_id']) { echo "selected"; } ?>>&nbsp; &nbsp; &nbsp; &nbsp; ---- <?php echo $sub['company_name']; ?></option>
					<?php
				} // of 3rd while
			
			} // end of 2nd while

		} // end of 1st while
		print'</select>';
	}

	
function get_company_lists_auto($company_id)
	{

		$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);

		$sql="SELECT * FROM shop_company WHERE parent_id=0 ORDER BY company_name ASC";
		$base_cat = mysqli_query($db,$sql) or die($sql);
		
	echo "<select name='parent_id' id=\"select-basic\" data-placeholder=\"Choose One\" class=\"width300\" onchange=form.submit();>";

		print "<option value=0>Select Company</option>";
		while($r	=	mysqli_fetch_array($base_cat))
		{		
			?>
				<option value="<?php echo $r['company_id'];?>"<?php if($company_id==$r['company_id']) { ?> selected="selected" <?php } ?>><?php echo $r['company_name'];?></option>
			
			<?php
			$query 	= "select * from shop_company WHERE parent_id='".$r['company_id']."' ORDER BY company_name ASC";
			$ret 	= mysqli_query($db,$query);
			while($row	=	mysqli_fetch_array($ret))
			{
				?>

				<option value="<?php echo $row['company_id'];?>"<?php if($company_id==$row['company_id']) { echo "selected"; } ?>>&nbsp; &nbsp; -- <?php echo $row['company_name']; ?></option>

				<?php
				$subsctegory="select * from shop_company WHERE parent_id= '".$row['company_id']."' ORDER BY company_name ASC";
				$sub_res=mysqli_query($db,$subsctegory);
				while($sub=mysqli_fetch_array($sub_res))
				{
					?>

					<option value="<?php echo $sub['company_id'];?>"<?php if($company_id==$sub['company_id']) { echo "selected"; } ?>>&nbsp; &nbsp; &nbsp; &nbsp; ---- <?php echo $sub['company_name']; ?></option>
					<?php
				} // of 3rd while
			
			} // end of 2nd while

		} // end of 1st while
		print'</select>';
	}


function get_company_lists2($company_id)
	{
		$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);

	echo "<select name='company_id' id=\"select-basic\" data-placeholder=\"Choose One\" class=\"width300\" onchange=form.submit();>";	
	
	 	echo "<option value=0>Choose One</option>";
	$q		=	mysqli_query($db,"SELECT company_id,company_name FROM shop_company WHERE status=1");
	while($r=mysqli_fetch_array($q))
		{

		echo "<option value='".$r['company_id']."'";
		if($company_id==$r['company_id']){echo "selected";}
		echo ">";
		echo $r['company_name'];
		echo "</option>";
		}
	echo "</select>";
	}
	
function get_company_due_info($company_id)
	{
	$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
	$q	=	mysqli_query($db,"SELECT sum( `debit` ) AS DUE FROM `shop_company_ledger` WHERE `company_id` =$company_id");
	$r	=	mysqli_fetch_array($q);
	$result	=	$r['DUE'];
	return $result;
	}
		
function get_company_payment_info($company_id)
	{
	$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
	$q	=	mysqli_query($db,"SELECT sum( `credit` ) AS PAYMENT FROM `shop_company_ledger` WHERE `company_id` =$company_id");
	$r	=	mysqli_fetch_array($q);
	$result	=	$r['PAYMENT'];
	return $result;
	}
	
		
function get_company_balance_info($company_id)
	{
	$due		=	get_company_due_info($company_id);
	$payment	=	get_company_payment_info($company_id);
	
	$result	=	$payment-$due;
	return $result;
	}
	
	
	
	
function get_product_info($info,$product_id)
	{
	$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
	$q	=	mysqli_query($db,"SELECT $info FROM shop_product WHERE product_id=$product_id");
	$r	=	mysqli_fetch_array($q);
	$result	=	$r[0];
	return $result;
	}
			  

function get_category_info($info,$category_id)
	{
	$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
	$q	=	mysqli_query($db,"SELECT $info FROM shop_category WHERE category_id=$category_id");
	$r	=	mysqli_fetch_array($q);
	$result	=	$r[0];
	return $result;
	}
	

function get_category_lists2($category_id)
	{
	$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);

	echo "<select name='category_id' id=\"select-basic\" data-placeholder=\"Choose One\" class=\"width300\" onchange=form.submit();>";
	
	echo "<option value=0>Choose One</option>";
	$q		=	mysqli_query($db,"SELECT category_id,category_name FROM shop_category WHERE status=1");
	while($r=mysqli_fetch_array($q))
		{
		echo "<option value='".$r['category_id']."'";
		if($category_id==$r['category_id']){echo "selected";}
		echo ">";
		echo $r['category_name'];
		echo "</option>";
		}
	echo "</select>";
	}
	
	
function get_category_lists($category_id)
	{

		$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);

		$sql="SELECT * FROM shop_category WHERE parent_id=0 ORDER BY category_name ASC";
		$base_cat = mysqli_query($db,$sql) or die($sql);
		
	echo "<select name='parent_id' id=\"select-basic\" data-placeholder=\"Choose One\" class=\"width300\">";

		print "<option value=0>Select Category</option>";
		while($r	=	mysqli_fetch_array($base_cat))
		{		
			?>
				<option value="<?php echo $r['category_id'];?>"<?php if($category_id==$r['category_id']) { ?> selected="selected" <?php } ?>><?php echo $r['category_name'];?></option>
			
			<?php
			$query 	= "select * from shop_category WHERE parent_id='".$r['category_id']."' ORDER BY category_name ASC";
			$ret 	= mysqli_query($db,$query);
			while($row	=	mysqli_fetch_array($ret))
			{
				?>

				<option value="<?php echo $row['category_id'];?>"<?php if($category_id==$row['category_id']) { echo "selected"; } ?>>&nbsp; &nbsp; -- <?php echo $row['category_name']; ?></option>

				<?php
				$subsctegory="select * from shop_category WHERE parent_id= '".$row['category_id']."' ORDER BY category_name ASC";
				$sub_res=mysqli_query($db,$subsctegory);
				while($sub=mysqli_fetch_array($sub_res))
				{
					?>

					<option value="<?php echo $sub['category_id'];?>"<?php if($category_id==$sub['category_id']) { echo "selected"; } ?>>&nbsp; &nbsp; &nbsp; &nbsp; ---- <?php echo $sub['category_name']; ?></option>
					<?php
				} // of 3rd while
			
			} // end of 2nd while

		} // end of 1st while
		print'</select>';
	}


function get_credit_customer_info($info,$customer_id)
	{
	$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
	$q	=	mysqli_query($db,"SELECT $info FROM shop_credit_customer WHERE customer_id=$customer_id");
	$r	=	mysqli_fetch_array($q);
	$result	=	$r[0];
	return $result;
	}
			
	
function get_credit_customer_due_info($customer_id)
	{
	$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
	$q	=	mysqli_query($db,"SELECT sum( `debit` ) AS DUE FROM `shop_credit_customer_ledger` WHERE `customer_id` =$customer_id");
	$r	=	mysqli_fetch_array($q);
	$result	=	$r['DUE'];
	return $result;
	}
		
function get_credit_customer_payment_info($customer_id)
	{
	$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
	$q	=	mysqli_query($db,"SELECT sum( `credit` ) AS PAYMENT FROM `shop_credit_customer_ledger` WHERE `customer_id` =$customer_id");
	$r	=	mysqli_fetch_array($q);
	$result	=	$r['PAYMENT'];
	return $result;
	}
	
		
function get_credit_customer_balance_info($customer_id)
	{
	$due		=	get_credit_customer_due_info($customer_id);
	$payment	=	get_credit_customer_payment_info($customer_id);
	
	$result	=	$payment-$due;
	return $result;
	}
	
	
	
	
		
function get_product_stock_in_info($product_id)
	{
	$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
	$q	=	mysqli_query($db,"SELECT sum( `stock_in` ) AS STOCKIN FROM `shop_stock` WHERE `product_id` =$product_id");
	$r	=	mysqli_fetch_array($q);
	$result	=	$r['STOCKIN'];
	return $result;
	}
			
			
function get_product_stock_out_info($product_id)
	{
	$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
	$q	=	mysqli_query($db,"SELECT sum( `stock_out` ) AS STOCKOUT FROM `shop_stock` WHERE `product_id` =$product_id");
	$r	=	mysqli_fetch_array($q);
	$result	=	$r['STOCKOUT'];
	return $result;
	}
		
		
function get_product_stock_sales_info($product_id)
	{
	$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
	$q	=	mysqli_query($db,"SELECT sum( `sales` ) AS SALES FROM `shop_stock` WHERE `product_id` =$product_id");
	$r	=	mysqli_fetch_array($q);
	$result	=	$r['SALES'];
	return $result;
	}
		
	
	
function get_product_current_stock_info($product_id)
	{
		
	$stock_in		=	get_product_stock_in_info($product_id);
	$stock_out		=	get_product_stock_out_info($product_id);
	$stock_sales	=	get_product_stock_sales_info($product_id);
	
	$result		=	($stock_in)-($stock_out-$stock_sales);
	
	return $result;
	
	}
	



function get_expense_category_info($info,$category_id)
	{
	$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
	$q	=	mysqli_query($db,"SELECT $info FROM shop_expense_category WHERE category_id=$category_id");
	$r	=	mysqli_fetch_array($q);
	$result	=	$r[0];
	return $result;
	}
	
	
function get_expense_category_lists($category_id)
	{

		$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);

		$sql="SELECT * FROM `shop_expense_category` WHERE parent_id=0 ORDER BY category_name ASC";
		$base_cat = mysqli_query($db,$sql) or die($sql);
		
	echo "<select name='parent_id' id=\"select-basic\" data-placeholder=\"Choose One\" class=\"width300\">";

		print "<option value=0>Select Category</option>";
		while($r	=	mysqli_fetch_array($base_cat))
		{		
			?>
				<option value="<?php echo $r['category_id'];?>"<?php if($category_id==$r['category_id']) { ?> selected="selected" <?php } ?>><?php echo $r['category_name'];?></option>
			
			<?php
			$query 	= "select * from `shop_expense_category` WHERE parent_id='".$r['category_id']."' ORDER BY category_name ASC";
			$ret 	= mysqli_query($db,$query);
			while($row	=	mysqli_fetch_array($ret))
			{
				?>

				<option value="<?php echo $row['category_id'];?>"<?php if($category_id==$row['category_id']) { echo "selected"; } ?>>&nbsp; &nbsp; -- <?php echo $row['category_name']; ?></option>

				<?php
				$subsctegory="select * from `shop_expense_category` WHERE parent_id= '".$row['category_id']."' ORDER BY category_name ASC";
				$sub_res=mysqli_query($db,$subsctegory);
				while($sub=mysqli_fetch_array($sub_res))
				{
					?>

					<option value="<?php echo $sub['category_id'];?>"<?php if($category_id==$sub['category_id']) { echo "selected"; } ?>>&nbsp; &nbsp; &nbsp; &nbsp; ---- <?php echo $sub['category_name']; ?></option>
					<?php
				} // of 3rd while
			
			} // end of 2nd while

		} // end of 1st while
		print'</select>';
	}

	


function get_invoice_info($info,$invoice_id)
	{
	$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
	$q	=	mysqli_query($db,"SELECT $info FROM shop_invoice WHERE invoice_id=$invoice_id");
	$r	=	mysqli_fetch_array($q);
	$result	=	$r[0];
	return $result;
	}
	

function get_shop_showroom_info($info,$showroom_id)
	{
	$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
	$q	=	mysqli_query($db,"SELECT $info FROM shop_showroom WHERE showroom_id=$showroom_id");
	$r	=	mysqli_fetch_array($q);
	$result	=	$r[0];
	return $result;
	}
		

function get_shop_showroom_lists($showroom_id)
	{
		$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);

	echo "<select name='showroom_id' id=\"select-basic\" data-placeholder=\"Choose One\" class=\"width200\">";	
	
	 	echo "<option value=0>Choose One</option>";
	$q		=	mysqli_query($db,"SELECT showroom_id,showroom_name FROM shop_showroom WHERE status=1");
	while($r=mysqli_fetch_array($q))
		{

		echo "<option value='".$r['showroom_id']."'";
		if($showroom_id==$r['showroom_id']){echo "selected";}
		echo ">";
		echo $r['showroom_name'];
		echo "</option>";
		}
	echo "</select>";
	}
	

function get_shop_showroom_lists2($showroom_id)
	{
		$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);

	echo "<select name='showroom_id' id=\"select-basic\" data-placeholder=\"Choose One\" class=\"width200\" onchange=form.submit();>";
	
	 	echo "<option value=0>Choose One</option>";
	$q		=	mysqli_query($db,"SELECT showroom_id,showroom_name FROM shop_showroom WHERE status=1");
	while($r=mysqli_fetch_array($q))
		{

		echo "<option value='".$r['showroom_id']."'";
		if($showroom_id==$r['showroom_id']){echo "selected";}
		echo ">";
		echo $r['showroom_name'];
		echo "</option>";
		}
	echo "</select>";
	}
	

	

function get_sales_summary_product_id($product_id)
	{
							
	$year1	=	substr($_POST['date1'],6,4);
	$month1	=	substr($_POST['date1'],0,2);
	$day1	=	substr($_POST['date1'],3,2);

	$date1	=	$year1."-".$month1."-".$day1;

	$year2	=	substr($_POST['date2'],6,4);
	$month2	=	substr($_POST['date2'],0,2);
	$day2	=	substr($_POST['date2'],3,2);
	$date2	=	$year2."-".$month2."-".$day2;
	
	$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
	$q	=	mysqli_query($db,"SELECT SUM(quantity) AS Total_Quantity FROM shop_cash_sales  WHERE product_id=$product_id AND (add_date BETWEEN '$date1' AND '$date2')");
	$r	=	mysqli_fetch_array($q);
	//$r	=	mysqli_num_rows($q);
	$result	=	$r['Total_Quantity'];
	return $result;
	}
		
	
function get_sales_summary_product_price($product_id)
	{
							
	$year1	=	substr($_POST['date1'],6,4);
	$month1	=	substr($_POST['date1'],0,2);
	$day1	=	substr($_POST['date1'],3,2);

	$date1	=	$year1."-".$month1."-".$day1;

	$year2	=	substr($_POST['date2'],6,4);
	$month2	=	substr($_POST['date2'],0,2);
	$day2	=	substr($_POST['date2'],3,2);
	$date2	=	$year2."-".$month2."-".$day2;
	
	$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
	$q	=	mysqli_query($db,"SELECT SUM(net_amount) AS Total_Quantity FROM shop_cash_sales  WHERE product_id=$product_id AND (add_date BETWEEN '$date1' AND '$date2')");
	$r	=	mysqli_fetch_array($q);
	//$r	=	mysqli_num_rows($q);
	$result	=	$r['Total_Quantity'];
	return $result;
	}
		
	

function get_item_wise_sales_product_quantity($add_date)
	{
$product_id	=	filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
	$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
	$q	=	mysqli_query($db,"SELECT SUM(quantity) AS Total_Quantity FROM shop_cash_sales  WHERE add_date='$add_date' AND product_id=$product_id");
	$r	=	mysqli_fetch_array($q);
	//$r	=	mysqli_num_rows($q);
	$result	=	$r['Total_Quantity'];
	return $result;
	}
				
	

function get_item_wise_sales_product_amount($add_date)
	{
$product_id	=	filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
	$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
	$q	=	mysqli_query($db,"SELECT SUM(net_amount) AS Total_Quantity FROM shop_cash_sales  WHERE add_date='$add_date' AND product_id=$product_id");
	$r	=	mysqli_fetch_array($q);
	//$r	=	mysqli_num_rows($q);
	$result	=	$r['Total_Quantity'];
	return $result;
	}
				
	
?>








