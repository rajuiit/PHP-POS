<?php
session_start();
session_unset($_SESSION['sess_admin_user_id']);
?>

<html>

<head>
	<title>Logout ~ Good Bye</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>

	<div id="login_area">

      <div align="center"><br>
        <?php


	echo "
				<p align=center><b>You have been logged out successfully.</b></p>
				<p align=center>Please wait.....</p>
		";
	echo ("<META HTTP-EQUIV=Refresh CONTENT=\"0; URL=./\">");


?>
    </div>
</div>
