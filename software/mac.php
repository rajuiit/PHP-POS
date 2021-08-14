<?php

//$code	=	"B8-97-5A-B5-23-98";
$code	=	"74-29-AF-05-15-F7";

ob_start();

system('ipconfig /all'); //Execute external program to display output
$mycom=ob_get_contents(); // Capture the output into a variable
ob_clean(); // Clean (erase) the output buffer

$findme = "Physical";
$pmac = strpos($mycom, $findme); // Find the position of Physical text
$user_mac=substr($mycom,($pmac+36),17); // Get Physical Address
echo $user_mac;


?>