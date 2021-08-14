<?php

$host		=	"localhost"; 			// Host name
$username	=	"root"; 				// Mysql username
$password	=	""; 				// Mysql password
$db_name	=	"hasib_database"; 				// Database name


// Connect to the database server and select databse.
mysql_connect("$host", "$username", "$password")or die("Cannot connect to the Database Server");
mysql_select_db("$db_name")or die("Cannot select database");

?>