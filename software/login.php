<?php
session_start();
include("configs/config.php");
include("configs/function.php");
include("configs/settings.php");
if(isset($_SESSION['sess_admin_user_id']))
{
//echo ("<META HTTP-EQUIV=Refresh CONTENT=\"0; URL=$site_url/data_server/index.php\">");
}
	
?>
<!DOCTYPE html>
<html lang="en">
    
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?php echo $site_nick; ?></title>

        <link href="css/style.default.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
		
		
		
    </head>

    <body class="signin">
    <?php
$key = md5(uniqid(rand(), true));;
$_SESSION['csrf'] = $key;	

?>    
        
        <section>
            
            <div class="panel panel-signin">
                <div class="panel-body">
                    <div class="logo text-center">
                        
                    </div>
                    <br />
                    <h4 class="text-center mb5">Already a Member?</h4>
                    <p class="text-center">Sign in to your account</p>
                    
					
			  
<?php

if(isset($_POST['action'])&&$_POST['action']=='LOGIN')
{

if(!isset($_SESSION['csrf']) || $_SESSION['csrf'] !== $_POST['csrf'])
	{
	
ob_start();

system('ipconfig /all'); //Execute external program to display output
$mycom=ob_get_contents(); // Capture the output into a variable
ob_clean(); // Clean (erase) the output buffer

$findme = "Physical";
$pmac = strpos($mycom, $findme); // Find the position of Physical text
$user_mac=substr($mycom,($pmac+36),17); // Get Physical Address

//echo $user_mac;


// Define $user_email and $user_password
$user_email		=	$_POST['user_email'];
$user_password	=	$_POST['user_password'];


// To protect MySQL injection (more detail about MySQL injection)
$user_email 	= 	stripslashes($user_email);
$user_password 	= 	stripslashes($user_password);
$user_email 	= 	mysql_real_escape_string($user_email);
$user_password 	= 	mysql_real_escape_string($user_password);
$user_password	=	md5($user_password);

	$login_date	=	date("Y-m-d H:i:s");
	$add_date	=	date("Y-m-d");
	$user_ip	=	getenv("REMOTE_ADDR");
	
	//echo $login_attempts;		

	$q = mysql_query("SELECT
							*
							FROM
								shop_users
							WHERE
								login_name='$user_email'
							AND
								user_password='$user_password'
							AND
								status=1
							
					");	
					
	//$qq = $db->query("SELECT count(*) FROM sms_users WHERE login_name='$user_email' AND user_password='$user_password' AND status=1");	
					
	$rid 		= mysql_fetch_array($q);
	
	$num_rows 	= mysql_num_rows($q);
	
	
	
	//$count = count($num_rows);
	

// If result matched $user_email and $user_password, table row must be 1 row

if($num_rows==1)
	{

	//Update last login info
	$user_id	=	$rid['user_id'];
	$login_date	=	date("Y-m-d H:i:s");
	$add_date	=	date("Y-m-d");
	$user_ip	=	getenv("REMOTE_ADDR");
	


$sql = "UPDATE shop_users SET lastlogin_date=?, lastlogin_ip=? WHERE user_id=?";
$q_sql = $db->prepare($sql);
$q_sql->execute(array($login_date,$user_ip,$user_id));

	
// Register $user_email, $user_id and redirect to file "index.php"

	$_SESSION['sess_admin_user_id']		=	$rid['user_id'];
	
	//echo $_SESSION['sess_admin_user_id'];
	if($rid['user_id']==1){
		echo ("<META HTTP-EQUIV=Refresh CONTENT=\"0; URL=$site_url/index.php\">");	
	}
	else{
		echo ("<META HTTP-EQUIV=Refresh CONTENT=\"0; URL=$site_url/sales.php\">");	
	}
	//header("location:index.php");
	}

else
	{	
	echo "<div class=\"alert alert-warning\">Username or Password Mismatch</div>";		
	//echo ("<META HTTP-EQUIV=Refresh CONTENT=\"0; URL=$site_url/login.php\">");
	//header("location:login.php");
	}
	
	ob_end_flush();
	
}//end of crsf
}//isset if
?>  
	  
	  			
					
					
					
                    <div class="mb30"></div>
                    
    <form class="form account-form" method="POST" action="check_login.php">
                        <div class="input-group mb15">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
									  <input type="hidden" name="csrf" value="<?php echo $key; ?>" />

                            <input type="text" class="form-control" name="user_email" placeholder="Username">
                        </div><!-- input-group -->
                        <div class="input-group mb15">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" class="form-control" name="user_password" placeholder="Password">
                        </div><!-- input-group -->
                        
                        <div class="clearfix">
                            <div class="pull-left">
                                <div class="ckbox ckbox-primary mt10">
                                    <input type="checkbox" id="rememberMe" value="1">
                                    <label for="rememberMe">Remember Me</label>
                                </div>
                            </div>
                            <div class="pull-right">
                                <button type="submit" name="action" value="LOGIN" class="btn btn-success">Sign In <i class="fa fa-angle-right ml5"></i></button>
                            </div>
                        </div>                      
                    </form>
                    
                </div><!-- panel-body -->
               
			   
            </div><!-- panel -->
            
        </section>


        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/jquery-migrate-1.2.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/modernizr.min.js"></script>
        <script src="js/pace.min.js"></script>
        <script src="js/retina.min.js"></script>
        <script src="js/jquery.cookies.js"></script>

        <script src="js/custom.js"></script>

    </body>

</html>
