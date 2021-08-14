<?php include("header.php"); ?>

<link href="css/bootstrap-wysihtml5.css" rel="stylesheet" />
	
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
                                    <li>Products</li>
                                </ul>
                                <h4>Add Item</h4>
								
								
<a href="item_list.php" class="btn btn-success" style="float: right;
margin-top: -31px;">Item List</a>
								
								
									
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    
					
			
					
<div class="contentpanel">
					
					

<?php

$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);


if(isset($_POST['category_id'])){$ParentID=$_POST['category_id'];}else{$ParentID="";}

if(isset($_POST['product_name'])){$ProductName=$_POST['product_name'];}else{$ProductName="";}
if(isset($_POST['product_code'])){$ProductCode=$_POST['product_code'];}else{$ProductCode="";}
if(isset($_POST['product_price'])){$ProductPrice=$_POST['product_price'];}else{$ProductPrice="";}
if(isset($_POST['product_details'])){$ProductDetails=$_POST['product_details'];}else{$ProductDetails="";}
if(isset($_POST['purchases_price'])){$PurchasesPrice=$_POST['purchases_price'];}else{$PurchasesPrice="";}


if(isset($_POST['action'])&&$_POST['action']=='SAVE')
{

$category_id		=	filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_SPECIAL_CHARS);
$product_name		=	filter_input(INPUT_POST, 'product_name', FILTER_SANITIZE_SPECIAL_CHARS);
$product_code		=	filter_input(INPUT_POST, 'product_code', FILTER_SANITIZE_SPECIAL_CHARS);
echo $product_name;
$product_price		=	filter_input(INPUT_POST, 'product_price', FILTER_SANITIZE_SPECIAL_CHARS);
$product_details	=	filter_input(INPUT_POST, 'product_details', FILTER_SANITIZE_SPECIAL_CHARS);
$purchases_price	=	filter_input(INPUT_POST, 'purchases_price', FILTER_SANITIZE_SPECIAL_CHARS);

//$category_slug		=	data_slug($category_name);
		

$add_date			=	date('Y-m-d');
$status				=	1;


	//Display error msg

		$err=array();

		
		if($product_name=='')
			{ $err[]="Please select item name";}

		if($product_code=='')
			{ $err[]="Please select item code";}

		if($product_price=='')
			{ $err[]="Please select item price";}

			
		$n=	count($err);


	if($n>0)
		{
		//echo "<div class=err_msg><ol>";

		for($i=0;$i<$n;$i++)
				{ 
				?>
				
				  <div class="alert alert-danger">
					<strong>Warning!</strong> <?php echo " &nbsp;  ".$err[$i].""; ?>
				  </div> <!-- /.alert -->

				<?php
				}
		//echo "</ol></div>";
		}
	else
		{
			
		$db 	= 	new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
		
		$query	=	mysqli_query($db,"INSERT INTO `shop_product` (
									`product_id` ,
									`category_id` ,
									`product_name` ,
									`product_code` ,
									`product_price` ,
									`purchases_price` ,
									`product_details` ,
									`add_date` ,
									`status`
									)
							VALUES (
									NULL , 
									'$category_id', 
									'$product_name',
									'$product_code', 
									'$product_price', 
									'$purchases_price', 
									'$product_details', 
									'$add_date',
									'$status'
									)

										");

					if($query)	{
						
		$product_id	=	mysqli_insert_id($db);	
		
		$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
		
		$query2	=	mysqli_query($db,"INSERT INTO `shop_stock` (
												`stock_id` ,
												`product_id` ,
												`category_id` ,
												`showroom_id` ,
												`remarks` ,
												`stock_in` ,
												`current_stock` ,
												`add_date` ,
												`status`
												)
										VALUES (
												NULL , 
												'$product_id', 
												'$category_id', 
												'1', 
												'$product_details', 
												'1',
												'1',
												'$add_date',
												'$status'
												)

										");

						
								?>
															  		
											
								<div class="alert alert-success">
									<a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
									<strong>Well done!</strong> Record added successfully!
								</div> <!-- /.alert -->
									
								<?php
//echo $request_id;
								
								}//end of IF Submit
						else
								{
								?>
								
								<div class="alert alert-error">
									<a class="close" data-dismiss="alert">×</a>
									Sorry, Failed to add record! <br>								
								</div>			
													
								<?php
								} //end of else

				}//end of else if no err
				
				}// end of IF Submit
			
			?>

   

   	
		    <div class="row">
						
						 <div class="col-md-12">
					
                              
									   
								<form class="form-horizontal" action="" method="POST">
                                    <div class="panel panel-default">
                                        
                                        <div class="panel-body">
                                           
									
				
							
					<div class="form-group">
						<label class="col-sm-5 control-label">Parent Category:</label>
						<div class="col-sm-8">
							<?php get_category_lists2($ParentID); ?>
						</div>
					</div><!-- form-group -->
							
								
<?php
				
if(isset($_POST['category_id']))
{
$category_id	=	filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_SPECIAL_CHARS);
$product_name2		= get_category_info("category_name",$category_id);
$product_price2		= get_category_info("product_price",$category_id);
$purchases_price2	= get_category_info("purchases_price",$category_id);

?>
						
								
<div class="form-group">
	<label class="col-sm-5 control-label">Item Name:</label>
	<div class="col-sm-8">
<input type="text" name="product_name" value="<?php echo $product_name2; ?>" class="form-control" />
	</div>
</div><!-- form-group -->
		
			
<div class="form-group">
	<label class="col-sm-5 control-label">Item Code:</label>
	<div class="col-sm-8">
	
<input type="text" name="product_code" autofocus class="form-control" />

	</div>
</div><!-- form-group -->
			
			
<div class="form-group">
	<label class="col-sm-5 control-label">Item Details:</label>
	<div class="col-sm-8">
	<input type="text" name="product_details" value="<?php echo $product_name2; ?>" class="form-control" />
	</div>
</div><!-- form-group -->
		
			
<div class="form-group">
	<label class="col-sm-5 control-label">Purchases Price:</label>
	<div class="col-sm-8">
	<input type="text" name="purchases_price" value="<?php echo $purchases_price2; ?>" class="form-control" />
	</div>
</div><!-- form-group -->
		


<div class="form-group">
	<label class="col-sm-5 control-label">Sales Price:</label>
	<div class="col-sm-8">
	<input type="text" name="product_price" value="<?php echo $product_price2; ?>" class="form-control" />
	</div>
</div><!-- form-group -->
			
<?php
}
?>

				
					<div class="panel-footer">
						<div id="submit_button">
							<button name="action" value="SAVE" class="btn btn-primary mr5">Submit</button>
							<button type="reset" class="btn btn-default">Reset</button>
						</div><!-- panel-footer -->
					</div>
											
										</div>
										
                                    </div><!-- panel-default -->
                                </form>  
									   
									
                            </div><!-- col-md-6 -->
                            
            </div><!-- row -->
                        
						
									
					
                       
                        
                    </div><!-- contentpanel -->
                </div><!-- mainpanel -->
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
        
		
        <script src="js/wysihtml5-0.3.0.min.js"></script>
        <script src="js/bootstrap-wysihtml5.js"></script>
        <script src="js/ckeditor/ckeditor.js"></script>		
		<script src="js/ckeditor/adapters/jquery.js"></script>

		
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
            jQuery(document).ready(function(){
                
              // HTML5 WYSIWYG Editor
              jQuery('#wysiwyg').wysihtml5({color: true,html:true});
              
              // CKEditor
              jQuery('#ckeditor').ckeditor();
              
            });
        </script>

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
                    minimumdepartmentsForSearch: -1
                });
                
                function format(item) {
                    return '<i class="fa ' + ((item.element[0].getAttribute('rel') === undefined)?"":item.element[0].getAttribute('rel') ) + ' mr10"></i>' + item.text;
                }
                
                // This will empty first option in select to enable placeholder
                jQuery('select option:first-child').text('');
                
                jQuery("#select-templating").select2({
                    formatdepartment: format,
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
