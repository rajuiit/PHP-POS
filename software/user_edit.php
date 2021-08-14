<?php include("header.php"); ?>

                


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
                                    
                                    <li>Uesr </li>
                                </ul>
                                <h4>Edit Uesr </h4>
								
								
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    
                    <div class="contentpanel">
                        
						
					


<?php



if(isset($_POST['user_name'])){$UserName=$_POST['user_name'];}else{$UserName="";}
if(isset($_POST['user_address'])){$UserAddress=$_POST['user_address'];}else{$UserAddress="";}
if(isset($_POST['telephone'])){$Telephone=$_POST['telephone'];}else{$Telephone="";}
if(isset($_POST['user_email'])){$UserEmail=$_POST['user_email'];}else{$UserEmail="";}
if(isset($_POST['login_name'])){$LoginName=$_POST['login_name'];}else{$LoginName="";}




if(isset($_POST['action'])&&$_POST['action']=='SAVE')
{
	
$showroom_id	=	filter_input(INPUT_POST, 'showroom_id', FILTER_SANITIZE_SPECIAL_CHARS);
	
$user_id		=	filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
$user_name		=	filter_input(INPUT_POST, 'user_name', FILTER_SANITIZE_SPECIAL_CHARS);
$user_address	=	filter_input(INPUT_POST, 'user_address', FILTER_SANITIZE_SPECIAL_CHARS);
$telephone		=	filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_SPECIAL_CHARS);
$user_email		=	filter_input(INPUT_POST, 'user_email', FILTER_SANITIZE_SPECIAL_CHARS);
$login_name		=	filter_input(INPUT_POST, 'login_name', FILTER_SANITIZE_SPECIAL_CHARS);
$user_password	=	filter_input(INPUT_POST, 'user_password', FILTER_SANITIZE_SPECIAL_CHARS);
$password		=	md5($user_password);



$add_date					=	date('Y-m-d');
$status						=	1;


	//Display error msg

		$err=array();


		if($user_name=='')
			{ $err[]="Please select user name";}

	
		if($user_address=='')
			{ $err[]="Please select user address";}

	
		if($telephone=='')
			{ $err[]="Please select phone";}

		if($user_email=='')
			{ $err[]="Please select user email";}

		if($login_name=='')
			{ $err[]="Please select login name";}

	
	
			
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
	

						$query	=	mysqli_query($db,"UPDATE `shop_users` SET 
						
												`user_name`		= '$user_name',
												`showroom_id`	= '$showroom_id',
												`user_address`	= '$user_address',
												`telephone`		= '$telephone',
												`user_email`	= '$user_email',
												`login_name`	= '$login_name'	
												
														WHERE 
																`user_id` = $user_id
		
		
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
$user_id	=	filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
$q		=	mysqli_query($db,"SELECT * FROM `shop_users` WHERE user_id=$user_id");
$r		=	mysqli_fetch_array($q);
?>								
						
						
						
                        <div class="row">
						
						 <div class="col-md-12">
					
                              
									   
									 <form class="form-horizontal" action="" method="POST">
                                    <div class="panel panel-default">
                                        
                                        <div class="panel-body">
                                           
						<div class="form-group">
						<label class="col-sm-5 control-label">Select Showroom:</label>
						<div class="col-sm-8">
							<?php echo get_shop_showroom_lists($r['showroom_id']); ?>
						</div>
					</div><!-- form-group -->
														
												
											<div class="form-group">
                                                <label class="col-sm-5 control-label">User Name:</label>
                                                <div class="col-sm-8">
                                                    <input type="text"  name="user_name" value="<?php echo $r['user_name']; ?>" class="form-control" />
                                                </div>
                                            </div><!-- form-group -->
													
												
											<div class="form-group">
                                                <label class="col-sm-5 control-label">User Address:</label>
                                                <div class="col-sm-8">
                                                    <textarea name="user_address"  class="form-control"><?php echo $r['user_address']; ?></textarea>
                                                </div>
                                            </div><!-- form-group -->
													
											
											
												
											<div class="form-group">
                                                <label class="col-sm-5 control-label">User Phone:</label>
                                                <div class="col-sm-8">
                                                    <input type="text"  name="telephone" value="<?php echo $r['telephone']; ?>" class="form-control" />
                                                </div>
                                            </div><!-- form-group -->
											
												
												
											<div class="form-group">
                                                <label class="col-sm-5 control-label">User Email:</label>
                                                <div class="col-sm-8">
                                                    <input type="email"  name="user_email" value="<?php echo $r['user_email']; ?>" class="form-control" />
                                                </div>
                                            </div><!-- form-group -->
											
												
											<div class="form-group">
                                                <label class="col-sm-5 control-label">Login Name:</label>
                                                <div class="col-sm-8">
                                                    <input type="text"  name="login_name" value="<?php echo $r['login_name']; ?>" class="form-control" />
                                                </div>
                                            </div><!-- form-group -->
												
											<div class="form-group">
                                                <label class="col-sm-5 control-label">Password:</label>
                                                <div class="col-sm-8">
                                                    <input type="password"  name="user_password" class="form-control" />
                                                </div>
                                            </div><!-- form-group -->
											
											
										
											<div class="panel-footer">
												<div id="submit_button">
													<button name="action" value="SAVE" class="btn btn-primary mr5">Submit</button>
													<button type="reset" class="btn btn-default">Reset</button>
												</div><!-- panel-footer -->
											</div>
										
                                    </div><!-- panel-default -->
                                </form>  
									   
									
                            </div><!-- col-md-6 -->
                            
                            
						
							<div align="center"><h3>User List</h3></div>
					
							
                            <table id="basicTable" class="table table-striped table-bordered responsive">
                                
								<thead class="">
                                    <tr>
                                        <th>ID</th>                                                            
                                        <th>User Name</th>
                                        <th>User Phone</th>
                                        <th>User Email</th>
                                        <th>Login Name</th>
                                                                           
										<th width="150">Action</th>
                                    </tr>
                                </thead>
                         
                                <tbody>
								<?php 
								$sl	=	1;
								$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
								$q	=	mysqli_query($db,"SELECT * FROM `shop_users` ORDER BY user_id ASC");
								while($r	=	mysqli_fetch_array($q))
								{
								?>
								
                                    <tr>
										<td><?php echo $sl; $sl=$sl+1; ?></td>  
										
										<td><?php echo $r['user_name']; ?></td>
										<td><?php echo $r['telephone']; ?></td>
										<td><?php echo $r['user_email']; ?></td>
										<td><?php echo $r['login_name']; ?></td>
										
																												  									                                  
										<td>										
											<a href="user_edit.php?id=<?php echo $r['user_id']; ?>&user_id=<?php echo $r['user_id']; ?>" class="btn btn-primary">Edit</a>
											
										</td>
										
                                    </tr>
									
								<?php
								}
								?>								
									
									
									</tbody>
                            </table>
                       		
							
							
							
							
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
                    minimumexperience_levelsForSearch: -1
                });
                
                function format(item) {
                    return '<i class="fa ' + ((item.element[0].getAttribute('rel') === undefined)?"":item.element[0].getAttribute('rel') ) + ' mr10"></i>' + item.text;
                }
                
                // This will empty first option in select to enable placeholder
                jQuery('select option:first-child').text('');
                
                jQuery("#select-templating").select2({
                    formatexperience_level: format,
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
