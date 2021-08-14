<?php include("header.php"); ?>


        <section>
            <div class="mainwrapper">
			
                 <?php include("left_menu.php"); ?>
				 
				 <!-- leftpanel -->
                
				
				
                <div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-pencil"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href="#"><i class="glyphicon glyphicon-home"></i></a></li>
                                    
                                    <li>Setting</li>
                                </ul>
                                <h4>Setting</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    
                    <div class="contentpanel">
                     

<?php

if(isset($_POST['action'])&&$_POST['action']=='Change Setting')

{

	$site_url		=	filter_input(INPUT_POST, 'site_url', FILTER_SANITIZE_SPECIAL_CHARS);
	$site_nick		=	filter_input(INPUT_POST, 'site_nick', FILTER_SANITIZE_SPECIAL_CHARS);
	$site_address	=	filter_input(INPUT_POST, 'site_address', FILTER_SANITIZE_SPECIAL_CHARS);
	$site_phone		=	filter_input(INPUT_POST, 'site_phone', FILTER_SANITIZE_SPECIAL_CHARS);
	$site_email		=	filter_input(INPUT_POST, 'site_email', FILTER_SANITIZE_SPECIAL_CHARS);
		
	
	
	$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
		$query	=	mysqli_query($db,"UPDATE shop_settings
														SET
															site_url		=	'$site_url',
															site_nick		=	'$site_nick',												
															site_address	=	'$site_address',											
															site_phone		=	'$site_phone',												
															site_email		=	'$site_email'

														WHERE
															site_id			=	0
									");

					if($query)	{
					
								?>
								
							<div class="alert alert-success">
                                
                                <strong>Setting </strong> update successfully!<br><br>
								
                            </div>
							
							<?php
								
								//echo "<script type='text/javascript'>alert('$masg_category_name added successfully!')</script>";								
								
								}//end of IF Submit
						else
								{
								?>								
								
								<div class="alert alert-error">
									
										Sorry, Failed to update setting! <br><br>									
								</div>			
								
								<?php
								} //end of else

			
				}// end of IF Submit
			?>








				 
                       
                        <div class="row">
                            <div class="col-md-8">
							
							
							
							
                                
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs">
								
            <li <?php if(isset($_GET['action'])&&$_GET['action']=="home"){echo "class=\"active\"";} ?>>
			<a href="setting.php?&action=home"><strong>Site Setting</strong></a></li>
			
                                                                  
                                </ul>
        
                                <!-- Tab panes -->
                                <div class="tab-content mb30">
								
						<?php
						if(isset($_GET['action'])&&$_GET['action']=='home')
						{
						?>
						
								
                                        
									   
									 <form class="form-horizontal" action="" method="POST">
                                    <div class="panel panel-default">
                                        
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">URL:</label>
                                                <div class="col-sm-8">
                                                    <input type="text"  name="site_url" value="<?php echo get_site_info("site_url"); ?>" class="form-control" />
                                                </div>
                                            </div><!-- form-group -->
											
                                         <div class="form-group">
                                                <label class="col-sm-4 control-label">Company Name:</label>
                                                <div class="col-sm-8">
                                                    <input type="text"  name="site_nick" value="<?php echo get_site_info("site_nick"); ?>" class="form-control" />
                                                </div>
                                            </div><!-- form-group -->
                                        	
											<div class="form-group">
                                                <label class="col-sm-4 control-label">Pay to Text:</label>
                                                <div class="col-sm-8">
												 <textarea class="form-control" name="site_address" rows="5" placeholder="Address"><?php echo get_site_info("site_address"); ?></textarea>
                                                </div>
                                            </div><!-- form-group -->
                                         	
											
											<div class="form-group">
                                                <label class="col-sm-4 control-label">Phone:</label>
                                                <div class="col-sm-8">
                                                    <input type="text"  name="site_phone" value="<?php echo get_site_info("site_phone"); ?>" class="form-control" />
                                                </div>
                                            </div><!-- form-group -->
                                        
										
											<div class="form-group">
                                                <label class="col-sm-4 control-label">Email:</label>
                                                <div class="col-sm-8">
                                                    <input type="text"  name="site_email" value="<?php echo get_site_info("site_email"); ?>" class="form-control" />
                                                </div>
                                            </div><!-- form-group -->
                                        
										
										  
                                        </div><!-- panel-body -->
										
										
											<div class="panel-footer">
												<div id="submit_button">
													<button name="action" value="Change Setting" class="btn btn-primary mr5">Submit</button>
													<button type="reset" class="btn btn-default">Reset</button>
												</div><!-- panel-footer -->
											</div>
										
                                    </div><!-- panel-default -->
                                </form>  
									   
									   
                                
                                

							 <?php
							}
							elseif(isset($_GET['action'])&&$_GET['action']=='mail')
							{
							?>


							
<?php
if(isset($_POST['action'])&&$_POST['action']=='SMTP')
{

$mail_type		=	filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
$smtp_port		=	filter_input(INPUT_POST, 'smtp_port', FILTER_SANITIZE_SPECIAL_CHARS);
$smtp_host		=	filter_input(INPUT_POST, 'smtp_host', FILTER_SANITIZE_SPECIAL_CHARS);
$smtp_username	=	filter_input(INPUT_POST, 'smtp_username', FILTER_SANITIZE_SPECIAL_CHARS);
$smtp_password	=	filter_input(INPUT_POST, 'smtp_password', FILTER_SANITIZE_SPECIAL_CHARS);
$ssl_type		=	filter_input(INPUT_POST, 'ssl_id', FILTER_SANITIZE_SPECIAL_CHARS);


$qq	=	mysql_query("UPDATE `sms_smtp` SET 
											`mail_type`		= '$mail_type', 
											`smtp_port` 	= '$smtp_port', 
											`smtp_host` 	= '$smtp_host', 
											`smtp_username` = '$smtp_username', 
											`smtp_password` = '$smtp_password',
											`ssl_type` 		= '$ssl_type'
									WHERE 
											`smtp_id` =1
					");
					
				if($qq){
						?>
								
							<div class="alert alert-success">                                
                                <strong>SMTP </strong> setup successfully!<br><br>								
                            </div>
							
							<?php
							}//end of IF Submit
						else
							{
							?>								
								
								<div class="alert alert-error">									
										Sorry, Failed to update setting! <br><br>									
								</div>			
								
							<?php
							} //end of else				
					
					
					
}//end of isset if
?>									
	
<?php

$q2	=	mysql_query("SELECT * FROM `sms_smtp` WHERE smtp_id=1");
$r2	=	mysql_fetch_array($q2);

?>

	
									 <form class="form-horizontal" action="" method="POST">
                                    <div class="panel panel-default">
                                        
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Mail Type:</label>
                                                <div class="col-sm-8">
												
                                                    <div class="smpt_setting">
													<?php echo get_email_type_lists($r2['mail_type']); ?>
													</div>
													
                                                </div>
                                            </div><!-- form-group -->
											
                                         <div class="form-group">
                                                <label class="col-sm-4 control-label">SMTP Port:</label>
                                                <div class="col-sm-8">
                                                    <input type="text"  name="smtp_port" value="<?php echo $r2['smtp_port']; ?>" class="form-control" />
                                                </div>
                                            </div><!-- form-group -->
                                        	
											<div class="form-group">
                                                <label class="col-sm-4 control-label">SMTP Host:</label>
                                                <div class="col-sm-8">
                                                    <input type="text"  name="smtp_host" value="<?php echo $r2['smtp_host']; ?>" class="form-control" />
                                                </div>
                                            </div><!-- form-group -->
                                         	
											
											<div class="form-group">
                                                <label class="col-sm-4 control-label">SMTP Username:</label>
                                                <div class="col-sm-8">
                                                    <input type="text"  name="smtp_username" value="<?php echo $r2['smtp_username']; ?>" class="form-control" />
                                                </div>
                                            </div><!-- form-group -->
                                        
										
											<div class="form-group">
                                                <label class="col-sm-4 control-label">SMTP Password:</label>
                                                <div class="col-sm-8">
                                                    <input type="text"  name="smtp_password" value="<?php echo $r2['smtp_password']; ?>" class="form-control" />
                                                </div>
                                            </div><!-- form-group -->
                                        
										
											<div class="form-group">
                                                <label class="col-sm-4 control-label">SMTP SSL Type:</label>
                                                <div class="col-sm-8">
													<div class="smpt_setting">
                                                    <?php echo get_email_ssl_type_lists($r2['ssl_type']); ?>
													</div>
                                                </div>
                                            </div><!-- form-group -->
                                        
										
										  
                                        </div><!-- panel-body -->
										
										
											<div class="panel-footer">
												<div id="submit_button">
													<button name="action" value="SMTP" class="btn btn-primary mr5">Submit</button>
													<button type="reset" class="btn btn-default">Reset</button>
												</div><!-- panel-footer -->
											</div>
										
                                    </div><!-- panel-default -->
                                </form>  
									     
									   
	
                       

					<?php
					}							
					elseif(isset($_GET['action'])&&$_GET['action']=='payment')
					{
					?>	
					   
						
							<h4 class="nomargin">Profile title goes here...</h4>
							<p>Profile content goes here</p>
						
                    <?php
					}
					?>					
                                 
                                </div><!-- tab-content -->
                                
                            </div><!-- col-md-6 -->
                            
                            
                            
                        </div><!-- row -->
                           
					
					
					
                    </div><!-- contentpanel -->
                </div>
            </div><!-- mainwrapper -->
        </section>

<?php include("footer.php"); ?>