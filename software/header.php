<?php
session_start();
if(!isset($_SESSION['sess_admin_user_id']))
{
header("location:login.php");
}
$sess_admin_user_id		=	$_SESSION['sess_admin_user_id'];

include("configs/config.php");
include("configs/function.php");
include("configs/settings.php");
	
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
        <link href="css/morris.css" rel="stylesheet">
        <link href="css/select2.css" rel="stylesheet" />
		<link href="css/bootstrap-timepicker.min.css" rel="stylesheet" />
		<link href="css/style.datatables.css" rel="stylesheet">
        <link href="css/dataTables.responsive.css" rel="stylesheet">

	


		
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
		
		
    </head>

    <body>
        
        <header>
            <div class="headerwrapper">
                <div class="header-left">
                   <div class="dash">
                    <a href="./">Point Of Sales</a>
					</div>
                    <div class="pull-right">
                        <a href="#" class="menu-collapse">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                </div><!-- header-left -->
                
                <div class="header-right">
                    
                    <div class="pull-right">
                        
                        <form class="form form-search" action="">
                            <input type="search" class="form-control" placeholder="Search" />
                        </form>
                     
					 					 
                        <div class="btn-group btn-group-option">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                              <i class="fa fa-caret-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu">
                              <li><a href="add_user.php"><i class="glyphicon glyphicon-user"></i> Add User</a></li>
                              <li><a href="user_list.php"><i class="glyphicon glyphicon-star"></i> User List</a></li>
<li><a href="stock_list_reports.php"><i class="glyphicon glyphicon-star"></i> Stock List Reports </a></li>
                              <li><a href="change_password.php"><i class="fa fa-unlock-alt"></i> Change Password</a></li>
                              <li><a href="setting.php"><i class="glyphicon glyphicon-cog"></i> Setting</a></li>
                              <li class="divider"></li>
                              <li><a href="logout.php"><i class="glyphicon glyphicon-log-out"></i>Sign Out</a></li>
                            </ul>
                        </div><!-- btn-group -->
                      

					  
                    </div><!-- pull-right -->
                    
                </div><!-- header-right -->
                
            </div><!-- headerwrapper -->
        </header>
        
		