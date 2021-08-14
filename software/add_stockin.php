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
								
                                <h4>Add Stock IN</h4>
								
								
                                
								
								
								
								
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    
					
			
					
<div class="contentpanel">
								

<?php


if(isset($_POST['stock_search'])){$StockSearch=$_POST['stock_search'];}else{$StockSearch="";}

if(isset($_POST['stock_in'])){$StockIn=$_POST['stock_in'];}else{$StockIn="";}

if(isset($_POST['showroom_id'])){$ShowroomID=$_POST['showroom_id'];}else{$ShowroomID="";}



if(isset($_POST['action'])&&$_POST['action']=='SAVE')
{

$stock_in	=	filter_input(INPUT_POST, 'stock_in', FILTER_SANITIZE_SPECIAL_CHARS);
$showroom_id	=	filter_input(INPUT_POST, 'showroom_id', FILTER_SANITIZE_SPECIAL_CHARS);
$product_id		=	filter_input(INPUT_POST, 'product_id', FILTER_SANITIZE_SPECIAL_CHARS);
$remarks	=	filter_input(INPUT_POST, 'remarks', FILTER_SANITIZE_SPECIAL_CHARS);

$current_stock	=	get_product_current_stock_info($product_id)+$stock_in;

$add_date	=	date('Y-m-d');
$status		=	1;


	//Display error msg

		$err=array();


		if($stock_in=='')
			{ $err[]="Please enter stock quantity";}

	
			
		$n=	count($err);


	if($n>0)
		{
		//echo "<div class=err_msg><ol>";

		for($i=0;$i<$n;$i++)
				{ 
				?>
				
				  <div class="alert alert-warning">
					<strong>Warning!</strong> <?php echo " &nbsp;  ".$err[$i].""; ?>
				  </div> <!-- /.alert -->

				<?php
				}
		//echo "</ol></div>";
		}
	else
		{
		$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
		$query	=	mysqli_query($db,"INSERT INTO `shop_stock` (
												`stock_id` ,
												`product_id` ,
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
												'$showroom_id', 
												'$remarks', 
												'$stock_in',
												'$current_stock',
												'$add_date',
												'$status'
												)

										");



					if($query)	{								
								?>
															  		
											
								<div class="alert alert-success">
									<a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
									<strong>Well done!</strong> Stock <?php echo $stock_in; ?> Pics added successfully!
								</div> <!-- /.alert -->
									
								<?php
//echo $request_id;
								
								}//end of IF Submit
						else
								{
								?>
								
								<div class="alert alert-error">
									<a class="close" data-dismiss="alert">�</a>
									Sorry, Failed to add stock! <br>								
								</div>			
													
								<?php
								} //end of else

				}//end of else if no err
				
				}// end of IF Submit
			?>

   

   	
		    <div class="row">
						
						 <div class="col-md-12">
					
                







<form class="form-horizontal" action="" method="POST">

<input type="text" name="stock_search" placeholder="Please enter item code" value="<?php echo $StockSearch; ?>" class="form-control" />

</form>

<br><br><br>

<?php

$product_id	=	filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

?> 
				
									   
								<form class="form-horizontal" action="" method="POST">
                                    <div class="panel panel-default">
                                        
                                        <div class="panel-body">
                                           
						
								
					<div class="form-group">
						<label class="col-sm-5 control-label">Item Name:</label>
						<div class="col-sm-8">
						<input type="text" name="product_name" value="<?php echo get_product_info("product_name",$product_id); ?>" disabled class="form-control" />
						
	<input type="hidden" name="product_id" value="<?php echo $product_id; ?>" class="form-control" />
						</div>
					</div><!-- form-group -->
								
								
								
					<div class="form-group">
						<label class="col-sm-5 control-label">Select Showroom:</label>
						<div class="col-sm-8">
							<?php echo get_shop_showroom_lists($ShowroomID); ?>
						</div>
					</div><!-- form-group -->
							
						
								
					<div class="form-group">
						<label class="col-sm-5 control-label">Quantity:</label>
						<div class="col-sm-8">
						<input type="text" name="stock_in" autofocus value="<?php //echo $StockIn; ?>" class="form-control" />
						</div>
					</div><!-- form-group -->
							
									
					
							
					<div class="form-group">
						<label class="col-sm-5 control-label">Item Details:</label>
						<div class="col-sm-8">
						<input type="text" name="remarks" value="New Stock <?php echo get_product_info("product_name",$product_id); ?>" class="form-control" />
						</div>
					</div><!-- form-group -->
							
									
												
					
				
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
