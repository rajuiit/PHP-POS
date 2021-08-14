<?php include("header.php"); ?>

<style type="text/css">
.table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
  border: 1px solid #ddd;
  vertical-align: middle;
}
</style>


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
            frameDoc.document.write('<html><head><title>Current Stock Report </title>');
            frameDoc.document.write('</head><body>');
            frameDoc.document.write('<h1 style=text-align:center;margin-top:0;margin-bottom:0;><?php echo $site_title; ?> </h1>');
            frameDoc.document.write('<h3 style=text-align:center;margin-top:0;margin-bottom:0;> <?php echo $site_address; ?> </h3>');
            frameDoc.document.write('<h1 style=text-align:center;margin-top:0;margin-bottom:0;>Current Stock Report</h1>');
            
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
	
	
        <section>
            <div class="mainwrapper">
                    
					<?php include("left_menu.php"); ?>

                <div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-pencil"></i>
                            </div>
                            <div class="media-body">
                                 <ul class="breadcrumb">
                                    <li><a href="#"><i class="glyphicon glyphicon-home"></i></a></li>                                    
                                    <li>Stock</li>
                                </ul>
								
                                <h4>Current Stock Report</h4>
								
<div align="right">
	<input type="button" onclick="PrintDiv();" value="Print" class="btn btn-primary mr5" />
</div>									
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    
                    <div class="contentpanel">
                        
                        <div class="row">
          




		 
 <div id="dvContents">

<link href="css/style.datatables.css" rel="stylesheet">
<link href="css/dataTables.responsive.css" rel="stylesheet">

<style text="text/css">
table {
  border-collapse: collapse;
  border-spacing: 0;
}
</style>


				<table id="basicTable" width="1100" border="1" cellpadding="5" cellspacing="0" class="table table-striped table-bordered responsive">
						
					<thead class="">
						<tr>							
							<th>ID</th>
							<th>Item Name</th>
							<th align="center">Quantity</th>
							<th>Price</th>
							<th width="100"><div align="right">Total Amount</div></th>
						</tr>
					</thead>


					<tbody>
					
					<?php
$total	=	0;


$db 	= 	new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
//$q		=	mysqli_query($db,"SELECT * FROM `shop_stock` $showroom_id GROUP BY product_id");
$sl		=	1;
//$q		=	mysqli_query($db,"SELECT * FROM `shop_stock` WHERE status=1 ");
$q		=	mysqli_query($db,"SELECT * FROM `shop_stock` GROUP BY category_id");


//$q		=	mysqli_query($db,"SELECT *,(sum(`stock_in`)-sum(`sales`))!=0 FROM `shop_stock` $showroom_id GROUP BY product_id");
while($r 	=	mysqli_fetch_array($q))
{
$category_id	= $r['category_id'];
$qq		=	mysqli_query($db,"SELECT * FROM `shop_stock` where category_id=$category_id and status=1");
$nn_quantity	=	mysqli_num_rows($qq);
	
	
?>
<tr>							
	
<td><?php echo $sl; $sl+=1; ?></td>
<td><?php echo get_category_info("category_name",$r['category_id']); ?></td>
<td align="center"><?php echo $nn_quantity; ?></td>
<td><?php echo get_category_info("product_price",$r['category_id']); ?></td>
	
	<td><div align="right"><?php 
	$stock	=	$nn_quantity;
	$price	=	get_category_info("product_price",$r['category_id']);
	$net_amount	=	$stock*$price;
	echo $net_amount; $total=$total+$net_amount;
	?></div></td>

</tr>
<?php	
}
?>
<tr>

	<td colspan="4"><div align="right"><b>Total Stock Amount(Tk.) = </b></div></td>
	<td><div align="right"><b><?php echo number_format($total,2); ?></b></div></td>

</tr>

					</tbody>
			</table>

</div>


						 
                        </div><!-- row -->
                        
                       
                    
                    </div><!-- contentpanel -->
                </div>
            </div><!-- mainwrapper -->
        </section>


        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/jquery-migrate-1.2.1.min.js"></script>
        <script src="js/jquery-ui-1.10.3.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/modernizr.min.js"></script>
        <script src="js/pace.min.js"></script>
        <script src="js/retina.min.js"></script>
        <script src="js/jquery.cookies.js"></script>
        
        <script src="js/jquery.autogrow-textarea.js"></script>
        <script src="js/jquery.mousewheel.js"></script>
        <script src="js/jquery.tagsinput.min.js"></script>
        <script src="js/toggles.min.js"></script>
        <script src="js/bootstrap-timepicker.min.js"></script>
        <script src="js/jquery.maskedinput.min.js"></script>
        <script src="js/select2.min.js"></script>
        <script src="js/colorpicker.js"></script>
        <script src="js/dropzone.min.js"></script>

        <script src="js/custom.js"></script>
        <script>
            jQuery(document).ready(function() {
                
                // Tags Input
                jQuery('#tags').tagsInput({width:'auto'});
                 
                // Textarea Autogrow
                jQuery('#autoResizeTA').autogrow();
                
                // Spinner
                var spinner = jQuery('#spinner').spinner();
                spinner.spinner('value', 0);
                
                // Form Toggles
                jQuery('.toggle').toggles({on: true});
                
                // Time Picker
                jQuery('#timepicker').timepicker({defaultTIme: false});
                jQuery('#timepicker2').timepicker({showMeridian: false});
                jQuery('#timepicker3').timepicker({minuteStep: 15});
                
                // Date Picker
                jQuery('#datepicker').datepicker();
                jQuery('#datepicker-inline').datepicker();
                jQuery('#datepicker-multiple').datepicker({
                    numberOfMonths: 3,
                    showButtonPanel: true
                });
                
                // Input Masks
                jQuery("#date").mask("99/99/9999");
                jQuery("#phone").mask("(999) 999-9999");
                jQuery("#ssn").mask("999-99-9999");
                
                // Select2
                jQuery("#select-basic, #select-multi").select2();
                jQuery('#select-search-hide').select2({
                    minimumResultsForSearch: -1
                });
                
                function format(item) {
                    return '<i class="fa ' + ((item.element[0].getAttribute('rel') === undefined)?"":item.element[0].getAttribute('rel') ) + ' mr10"></i>' + item.text;
                }
                
                // This will empty first option in select to enable placeholder
                jQuery('select option:first-child').text('');
                
                jQuery("#select-templating").select2({
                    formatResult: format,
                    formatSelection: format,
                    escapeMarkup: function(m) { return m; }
                });
                
                // Color Picker
                if(jQuery('#colorpicker').length > 0) {
                    jQuery('#colorSelector').ColorPicker({
			onShow: function (colpkr) {
			    jQuery(colpkr).fadeIn(500);
                            return false;
			},
			onHide: function (colpkr) {
                            jQuery(colpkr).fadeOut(500);
                            return false;
			},
			onChange: function (hsb, hex, rgb) {
			    jQuery('#colorSelector span').css('backgroundColor', '#' + hex);
			    jQuery('#colorpicker').val('#'+hex);
			}
                    });
                }
  
                // Color Picker Flat Mode
                jQuery('#colorpickerholder').ColorPicker({
                    flat: true,
                    onChange: function (hsb, hex, rgb) {
			jQuery('#colorpicker3').val('#'+hex);
                    }
                });
                
                
            });
        </script>

    </body>

</html>










