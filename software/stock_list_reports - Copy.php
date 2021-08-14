<?php include("header.php"); ?>

		<style>
			div.container {
			 
margin: 0 auto;
max-width: 1090px;
			}
			div.header {
			    margin: 100px auto;
			    line-height:30px;
			    max-width:1090px;
			}
			
		</style>




        <section>
            <div class="mainwrapper">
               
			   <?php include("left_menu.php"); ?>
			   
                <div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-th-list"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href="#"><i class="glyphicon glyphicon-home"></i></a></li>
                                   
                                    <li>Stock</li>
                                </ul>
                                <h4>Current Stock Report</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    
										
										
                    <div class="contentpanel">
                          
                        <div class="panel panel-primary-head">
						
<form method="POST" action="">
	
<div align="center">

<?php					
if(isset($_POST['showroom_id'])){$ShowroomID=$_POST['showroom_id'];}else{$ShowroomID="";}
get_shop_showroom_lists2($ShowroomID);
?><br><br>

</div>

</form>	


<?php

if(isset($_POST['showroom_id'])){
	
	$showroom	=	filter_input(INPUT_POST, 'showroom_id', FILTER_SANITIZE_SPECIAL_CHARS);
	$showroom_id	=	filter_input(INPUT_POST, 'showroom_id', FILTER_SANITIZE_SPECIAL_CHARS);
	$showroom_id	=	" WHERE showroom_id=".$showroom;
	//echo $showroom;
	
}
else{
	$showroom_id	=	" ";
}

?>
						
	<div class="panel-heading">
		<h4 class="panel-title"><?php if(isset($_POST['showroom_id'])){echo get_shop_showroom_info("showroom_name",$_POST['showroom_id']);}else{echo "All";} ?> Stock Report</h4>
	</div><!-- panel-heading -->

					
							
	<div class="container">
			<table id="employee-grid"  cellpadding="0" cellspacing="0" border="0 " class="table" width="100%">
					<thead>
						<tr>							
							<th>ID</th>
							<th width="180">Item Name</th>
							<th>Item Code</th>
							<th>Item Details</th>
							<th>Stock Quantity</th>
							<th>Price</th>
							<th width="100"><div align="right">Total Amount</div></th>
						</tr>
					</thead>
					
					<tbody>
					
<?php
$total	=	0;


$db 	= 	new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
$q		=	mysqli_query($db,"SELECT * FROM `shop_stock` $showroom_id GROUP BY product_id");
while($r 	=	mysqli_fetch_array($q))
{
?>
<tr>							
	<td><?php echo $r['product_id']; ?></td>
	<td width="180"><?php echo get_product_info("product_name",$r['product_id']); ?></td>
	<td width="180"><?php echo get_product_info("product_code",$r['product_id']); ?></td>
	<td width="180"><?php echo get_product_info("product_details",$r['product_id']); ?></td>
	<td><?php echo get_product_current_stock_info($r['product_id']); ?></td>
	<td><?php echo get_product_info("product_price",$r['product_id']); ?></td>
	
	<td><div align="right"><?php 
	$stock	=	get_product_current_stock_info($r['product_id']);
	$price	=	get_product_info("product_price",$r['product_id']);
	$net_amount	=	$stock*$price;
	echo $net_amount; $total=$total+$net_amount;
	?></div></td>

</tr>
<?php	
}
?>
<tr>

	<td colspan="6"><div align="right"><b>Total Stock Amount(Tk.) = </b></div></td>
	<td><div align="right"><b><?php echo $total; ?></b></div></td>

</tr>

					</tbody>
			</table>
	</div>						
				
	

							
							
                        </div><!-- panel -->
                        
                        <br />
                        
                       
                        
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
