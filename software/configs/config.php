<?php

define('SERVER', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DATABASE', 'hasib_database');

class DB {
    function __construct(){

	$sql = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
 
if($sql->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}	
		
		
    }
}

$cat	=	"test";
?>

