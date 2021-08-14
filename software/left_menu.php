<div class="leftpanel">

<div class="media profile-left">
  
   <a class="pull-left profile-thumb" href="#">
		<!--img class="img-circle" src="images/photos/<?php echo $sess_admin_user_id; ?>.png" alt=""-->
	</a>
  
	<div class="media-body">
		<h4 class="media-heading" style="font-size: 22px;
font-weight: bold;
margin-top: 23px;"><?php //echo get_user_info("user_name",$sess_admin_user_id); 
		echo $site_nick; ?></h4>
	</div>
</div><!-- media -->

<?php
$basename	= basename($_SERVER["SCRIPT_FILENAME"], '.php');
//echo $basename;
?>	

	<ul class="nav nav-pills nav-stacked">
	
<li <?php if($basename == 'index') { echo "class=\"active\""; } ?>><a href="./"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
	
<li class="parent <?php if($basename == 'add_company'){echo "active";} elseif($basename == 'company_list'){echo "active";} elseif($basename == 'add_expense_category'){echo "active";} elseif($basename == 'expense_category_list'){echo "active";} elseif($basename == 'add_expense'){echo "active";} elseif($basename == 'expense_list'){echo "active";} ?>"><a href="#"><i class="glyphicon glyphicon-cog"></i> <span>Admin</span></a>
		<ul class="children">
			<li <?php if($basename == 'add_company') { echo "class=\"active\""; } ?>><a href="add_company.php">Add Company</a></li>

			<li <?php if($basename == 'company_list') { echo "class=\"active\""; } ?>><a href="company_list.php">Company List</a></li>  
 

			<li <?php if($basename == 'add_expense_category') { echo "class=\"active\""; } ?>><a href="add_expense_category.php">Add Expense Category</a></li>

			<li <?php if($basename == 'expense_category_list') { echo "class=\"active\""; } ?>><a href="expense_category_list.php">Expense Category List</a></li>	

			<li <?php if($basename == 'add_expense') { echo "class=\"active\""; } ?>><a href="add_expense.php">Add Expense</a></li>

			<li <?php if($basename == 'expense_list') { echo "class=\"active\""; } ?>><a href="expense_list.php">Expense List</a></li>	

				                        
		</ul>
	</li>
	
	
<li class="parent <?php if($basename == 'add_credit_customer'){echo "active";} elseif($basename == 'credit_customer_list'){echo "active";} ?>"><a href="#"><i class="fa fa-users"></i> <span>Credit Customer</span></a>
	<ul class="children">
		<li <?php if($basename == 'add_credit_customer') { echo "class=\"active\""; } ?>><a href="add_credit_customer.php">Add Customer</a></li>
		<li <?php if($basename == 'credit_customer_list') { echo "class=\"active\""; } ?>><a href="credit_customer_list.php">Customer List</a></li>  
					
	</ul>
</li>
	
		

	<li class="parent <?php if($basename == 'add_category'){echo "active";} elseif($basename == 'category_list'){echo "active";} elseif($basename == 'add_item'){echo "active";} elseif($basename == 'item_list'){echo "active";} ?>"><a href="#"><i class="fa fa-gift"></i>  <span>Item/Product</span></a>
		<ul class="children">
			<li <?php if($basename == 'add_category') { echo "class=\"active\""; } ?>><a href="add_category.php">Add Category</a></li>
			<li <?php if($basename == 'category_list') { echo "class=\"active\""; } ?>><a href="category_list.php">View Category</a></li>
			<li <?php if($basename == 'add_item') { echo "class=\"active\""; } ?>><a href="add_item.php" >Add Item</a></li>                              
			<li <?php if($basename == 'item_list') { echo "class=\"active\""; } ?>><a href="item_list.php">View Item</a></li>	                               
		</ul>
	</li>
		



	<li class="parent <?php if($basename == 'add_stockin'){echo "active";} elseif($basename == 'add_stockout'){echo "active";}  elseif($basename == 'stock_list'){echo "active";} elseif($basename == 'stock_list_reports'){echo "active";}elseif($basename == 'memo'){echo "active";}elseif($basename == 'memo_list'){echo "active";} ?>"><a href="#"><span><i class="fa fa-suitcase"></i> Stock</span></a>
		<ul class="children">
                               
			<!--li <?php if($basename == 'memo') { echo "class=\"active\""; } ?>><a href="memo.php">Add Memo</a></li>
			
			<li <?php if($basename == 'memo_list') { echo "class=\"active\""; } ?>><a href="memo_list.php">Memo List</a></li>
			
	
			<li <?php if($basename == 'add_stockin') { echo "class=\"active\""; } ?>><a href="add_stockin.php">Stock IN</a></li>
			<li <?php if($basename == 'add_stockout') { echo "class=\"active\""; } ?>><a href="add_stockout.php">Stock Out</a></li> 
			
			<li <?php if($basename == 'stock_list') { echo "class=\"active\""; } ?>><a href="stock_list.php">Stock Summary Report</a></li--> 
			
			
			<li <?php if($basename == 'stock_list_reports') { echo "class=\"active\""; } ?>><a href="stock_list_reports.php">Current Stock Report</a></li> 
			
		</ul>
	</li>
	
	<li <?php if($basename == 'sales'){echo "active";} ?>><a href="sales.php?" target="blank"><i class="glyphicon glyphicon-shopping-cart"></i> <span>Cash Sales</span></a></li>
	<li <?php if($basename == 'credit_customer_list'){echo "active";} ?>><a href="credit_customer_list.php?"><i class="fa fa-truck"></i> <span>Credit Sales</span></a></li>
	
	
	
<li class="parent <?php if($basename == 'invoice_query'){echo "active";} elseif($basename == 'purchases_invoice_query'){echo "active";} ?>"><a href="#"><i class="glyphicon glyphicon-search"></i>  <span>Invoice Query</span></a>
	<ul class="children">
		<li <?php if($basename == 'invoice_query') { echo "class=\"active\""; } ?>><a href="invoice_query.php?">Sales Invoice Query</a></li>
		<li <?php if($basename == 'purchases_invoice_query') { echo "class=\"active\""; } ?>><a href="purchases_invoice_query.php?">Purchases Invoice Query</a></li>
	</ul>
</li>
	
	
	
<li class="parent <?php if($basename == 'sales_reports_by_daterange'){echo "active";} elseif($basename == 'stock_in_report'){echo "active";}  elseif($basename == 'stock_list'){echo "active";} elseif($basename == 'stock_return_report'){echo "active";} elseif($basename == 'sales_summary_report'){echo "active";} elseif($basename == 'item_wise_sales'){echo "active";} elseif($basename == 'cash_book'){echo "active";} ?>"><a href="#"><i class="fa fa-book"></i> <span>Reports</span></a>
		
		<ul class="children">
		
		<li <?php if($basename == 'cash_book') { echo "class=\"active\""; } ?>><a href="cash_book.php?" >Cash Book</a></li>
				
		<li <?php if($basename == 'sales_reports_by_daterange') { echo "class=\"active\""; } ?>><a href="sales_reports_by_daterange.php?">Daily Sales Report</a></li>
		<li <?php if($basename == 'stock_list_reports') { echo "class=\"active\""; } ?>><a href="stock_list_reports.php?">Current Stock Report</a></li>
		
		<!--li <?php //if($basename == 'stock_in_report') { echo "class=\"active\""; } ?>><a href="stock_in_report.php?">Stock In Report</a></li>
		
		<li <?php //if($basename == 'stock_return_report') { echo "class=\"active\""; } ?>><a href="stock_return_report.php?">Stock Return Report</a></li-->
		
		<li <?php if($basename == 'sales_summary_report') { echo "class=\"active\""; } ?>><a href="sales_summary_report.php?">Sales Summary Report</a></li>
		
		
		<li <?php if($basename == 'purchase_summary_report') { echo "class=\"active\""; } ?>><a href="purchase_summary_report.php?">Purchase Report</a></li>
		
		
		
		<li <?php if($basename == 'item_wise_sales') { echo "class=\"active\""; } ?>><a href="item_wise_sales.php?">Item Wise Report</a></li>
		
		
		</ul>
	
</li>
	

		
		</li>
	</ul>
	
</div>