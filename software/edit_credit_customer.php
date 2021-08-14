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
                                    <li>Credit Customer</li>
                                </ul>
                                <h4>Edit Credit Customer</h4>
								
	<a style="float: right;
margin-top: -31px;" class="btn btn-success" href="credit_customer_list.php">Customer List</a>							
								
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    
					
			
					
<div class="contentpanel">
					
					
<?php

if(isset($_POST['customer_name'])){$CustomerName=$_POST['customer_name'];}else{$CustomerName="";}
if(isset($_POST['customer_code'])){$CustomerCode=$_POST['customer_code'];}else{$CustomerCode="";}

if(isset($_POST['customer_address'])){$CustomerAddress=$_POST['customer_address'];}else{$CustomerAddress="";}

if(isset($_POST['customer_phone'])){$CustomerPhone=$_POST['customer_phone'];}else{$CustomerPhone="";}

if(isset($_POST['action'])&&$_POST['action']=='SAVE')
{
$customer_id	=	filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

$customer_name		=	filter_input(INPUT_POST, 'customer_name', FILTER_SANITIZE_SPECIAL_CHARS);
$customer_code		=	filter_input(INPUT_POST, 'customer_code', FILTER_SANITIZE_SPECIAL_CHARS);
$customer_address	=	$_POST['customer_address'];
$customer_phone		=	filter_input(INPUT_POST, 'customer_phone', FILTER_SANITIZE_SPECIAL_CHARS);
$referance_name		=	filter_input(INPUT_POST, 'referance_name', FILTER_SANITIZE_SPECIAL_CHARS);
$referance_mobile	=	filter_input(INPUT_POST, 'referance_mobile', FILTER_SANITIZE_SPECIAL_CHARS);

$add_date			=	date('Y-m-d');

$status				=	1;


	//Display error msg

		$err=array();


		if($customer_name=='')
			{ $err[]="Please enter customer name";}

	
		if($customer_address=='')
			{ $err[]="Please enter address";}

	
		if($customer_phone=='')
			{ $err[]="Please select company phone";}

		
	
	
	
	
			
		$n=	count($err);


	if($n>0)
		{
		//echo "<div class=err_msg><ol>";

		for($i=0;$i<$n;$i++)
				{ 
				?>

				
      <div class="alert alert-warning">
        <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
        <strong>Warning!</strong> <?php echo " &nbsp;  ".$err[$i].""; ?>
      </div> <!-- /.alert -->


				<?php


				}
		//echo "</ol></div>";

		}
	else
		{
		$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
		

if (!isset($_POST["status"])) { $status=0; }
				else { $status=$_POST['status']; }
				
		$query	=	mysqli_query($db,"UPDATE `shop_credit_customer` SET 
												
												`customer_name`		= '$customer_name',
												`customer_code`		= '$customer_code',
												`customer_address`	= '$customer_address',
												`customer_phone`	= '$customer_phone',
												`referance_name`	= '$referance_name',
												`referance_mobile`	= '$referance_mobile',
												`status` 			= '$status'	
											WHERE 
											
												`customer_id` = $customer_id
		
		
								");

					if($query)	{
					
								
								?>
															  		
											
				<div class="alert alert-success">
					<a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
					<strong>Well done!</strong> Record modified successfully!
				  </div> <!-- /.alert -->
					
								<?php
//echo $request_id;
								
								}//end of IF Submit
						else
								{
								?>
								
								<div class="alert alert-error">
									<a class="close" data-dismiss="alert">×</a>
									Sorry, Failed to modify record! <br>								
								</div>			
													
								<?php
								} //end of else

				}//end of else if no err
				
				}// end of IF Submit
			?>

   
   
<?php
$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
$customer_id	=	filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
$q		=	mysqli_query($db,"SELECT * FROM `shop_credit_customer` WHERE customer_id=$customer_id");
$r		=	mysqli_fetch_array($q);
?>	
   	
		    <div class="row">
						
						 <div class="col-md-12">
					
                              
									   
								<form class="form-horizontal" action="" method="POST">
                                    <div class="panel panel-default">
                                        
                                        <div class="panel-body">
                             
							
					<div class="form-group">
						<label class="col-sm-5 control-label">Customer Name:</label>
						<div class="col-sm-8">
							<input type="text"  name="customer_name" value="<?php echo $r['customer_name']; ?>" class="form-control" />
						</div>
					</div><!-- form-group -->
							
								
					<div class="form-group">
						<label class="col-sm-5 control-label">Customer Code:</label>
						<div class="col-sm-8">
							<input type="text"  name="customer_code" value="<?php echo $r['customer_code']; ?>" class="form-control" />
						</div>
					</div><!-- form-group -->
							
								
					
								
					<div class="form-group">
						<label class="col-sm-5 control-label">Customer Mobile:</label>
						<div class="col-sm-8">
							<input type="text" name="customer_phone" value="<?php echo $r['customer_phone']; ?>" class="form-control" />
						</div>
					</div><!-- form-group -->
							
									
					
											
					<div class="form-group">
						<label class="col-sm-5 control-label">Customer Address:</label>
						<div class="col-sm-8">
	<textarea name="customer_address" id="wysiwyg" rows="3" class="form-control"><?php echo $r['customer_address']; ?></textarea>
						</div>
					</div><!-- form-group -->
							
					

							
		<div class="form-group">
			<label class="col-sm-5 control-label">Referance Name:</label>
			<div class="col-sm-8">
				<input type="text" name="referance_name" value="<?php echo $r['referance_name']; ?>" class="form-control" />
			</div>
		</div><!-- form-group -->
				
		
				
		<div class="form-group">
			<label class="col-sm-5 control-label">Referance Mobile:</label>
			<div class="col-sm-8">
				<input type="text"  name="referance_mobile" value="<?php echo $r['referance_mobile']; ?>" class="form-control" />
			</div>
		</div><!-- form-group -->
				
			
					


					
			<div class="form-group">
						<label class="col-sm-5 control-label">Status:</label>
						<div class="col-sm-8">
							<div class="ckbox ckbox-success">
					<input type="checkbox" name="status" value="1" <?php if($r['status']==1){ echo "checked"; } ?> id="checkboxSuccess">
					<label for="checkboxSuccess"><?php if($r['status']==1){ echo "Active"; }else{echo "InActive";} ?></label>
				</div>	 
						
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
