<?php
ob_start();

include("configs/config.php");
include("configs/function.php");
include("configs/settings.php");
	
$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);

// Define $user_email and $user_password
$user_email		=	filter_input(INPUT_POST, 'user_email', FILTER_SANITIZE_SPECIAL_CHARS);
$user_password	=	filter_input(INPUT_POST, 'user_password', FILTER_SANITIZE_SPECIAL_CHARS);


// To protect MySQL injection (more detail about MySQL injection)
$user_email 	= 	stripslashes($user_email);
echo $user_email;
echo $user_password;
$user_password 	= 	stripslashes($user_password);
$user_email 	= 	mysqli_real_escape_string($db,$user_email);
$user_password 	= 	mysqli_real_escape_string($db,$user_password);
$user_password	=	md5($user_password);

	$login_date	=	date("Y-m-d H:i:s");
	$add_date	=	date("Y-m-d");
	$user_ip	=	getenv("REMOTE_ADDR");
	

$sql="SELECT *
							FROM
								shop_users
							WHERE
								login_name='$user_email'
							AND
								user_password='$user_password'
							AND
								status=1

	";

$result	=	mysqli_query($db,$sql);


// Mysql_num_row is counting table row
$count	=	mysqli_num_rows($result);
$rid	=	mysqli_fetch_array($result);

echo $count;
// If result matched $user_email and $user_password, table row must be 1 row

if($count==1)
	{

	//Update last login info

	$login_date	=	date("Y-m-d H:i:s");
	$user_ip	=	getenv("REMOTE_ADDR");
	$user_id	=	$rid['user_id'];
	$q=mysqli_query($db,"UPDATE shop_users SET lastlogin_date='$login_date',lastlogin_ip='$user_ip' WHERE user_email='$user_email'");

$query=mysqli_query($db,"INSERT INTO `shop_logip` (`log_id` ,`user_id` ,`lagin_datetime` ,`login_ip`)VALUES (NULL , '$user_id', '$login_date', '$user_ip')");

	// Register $user_email, $user_id and redirect to file "index.php"

	session_start();

	$_SESSION['sess_admin_user_id']		=	$rid['user_id'];
	
	if($rid['user_id']==1){
	header("location:index.php");	
	}
	else{
		header("location:sales.php");
	}
	
	
	}

else
	{
	//header("location:login.php");
	}

ob_end_flush();

?>