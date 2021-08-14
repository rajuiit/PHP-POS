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
                                    
                                    <li>Change Password </li>
                                </ul>
                                <h4>Change Password </h4>
								
								
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    
                    <div class="contentpanel">
                        
						
					

<?php


if(isset($_POST['action'])&&$_POST['action']=='SAVE')
	{
		$user_password		=	$_POST['user_password'];
		$user_password2		=	$_POST['user_password2'];
		$password			=	md5($user_password);


	
		
			if(($user_password!=$user_password2)||($user_password==""))
			{
			?>								
								
				<div class="alert alert-error">
						<a class="close" data-dismiss="alert">×</a>
						Sorry! Password missmatch.<br><br>				
				</div>			
				
			<?php	
			}
					
	elseif (strlen($user_password) < 8) {?>
			<div class="alert alert-error">
					<a class="close" data-dismiss="alert">×</a>
					Password too short!<br><br>				
			</div>
    <?php
    }

    elseif (!preg_match("#[0-9]+#", $user_password)) {
	?>
			<div class="alert alert-error">
					<a class="close" data-dismiss="alert">×</a>
					Password must include at least one number!<br><br>				
			</div>
    <?php
    }

    elseif (!preg_match("#[a-zA-Z]+#", $user_password)) {
	?>
		<div class="alert alert-error">
			<a class="close" data-dismiss="alert">×</a>
			Password must include at least one letter!<br><br>				
		</div>
    <?php
    }     
	
			
			
			
			else
			{
				$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
				$q	=	mysqli_query($db,"UPDATE shop_users SET user_password='$password' WHERE user_id=$sess_admin_user_id");

				if(!($q))	{	
							?>								
								
								<div class="alert alert-error">
										<a class="close" data-dismiss="alert">×</a>
										Sorry! Failed to change your password. <br><br>				
								</div>			
								
							<?php				
							}

				else		{ 	
							?>
								
							<div class="alert alert-success">
                                <a class="close" data-dismiss="alert">×</a>
                               Your Password has been changed successfully! <br><br>
								
                            </div>
							
							<?php
							}
			}

	}
?>




<?php
$user_id	=	$sess_admin_user_id;
$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
$q	=	mysqli_query($db,"SELECT * FROM `shop_users` WHERE user_id=$user_id");
$r	=	mysqli_fetch_array($q);

?>

   	
						
						
						
                        <div class="row">
						
						 <div class="col-md-12">
					
                              
									   
									 <form class="form-horizontal" action="" method="POST">
                                    <div class="panel panel-default">
                                        
                                        <div class="panel-body">
                                           
									
												
										
											<div class="form-group">
                                                <label class="col-sm-5 control-label">New Password:</label>
                                                <div class="col-sm-8">
                                                    <input type="password"  name="user_password" class="form-control" />
                                                </div>
                                            </div><!-- form-group -->
											
												
											<div class="form-group">
                                                <label class="col-sm-5 control-label">Re-type Password :</label>
                                                <div class="col-sm-8">
                                                    <input type="password"  name="user_password2" class="form-control" />
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
