<?php	
ob_start();

system('ipconfig /all'); //Execute external program to display output
$mycom=ob_get_contents(); // Capture the output into a variable
ob_clean(); // Clean (erase) the output buffer

$findme = "Physical";
$pmac = strpos($mycom, $findme); // Find the position of Physical text
$user_mac=substr($mycom,($pmac+36),17); // Get Physical Address

//echo $user_mac;

echo "<div align='center'><h1>This is duplicate software</h1></div>";
echo "<div align='center'><h2>Please Contact Us:</h2></div>";
echo "<div align='center'><h2>01911944573:</h2></div>";
echo "<div align='center'><h2>Activation code for software: ".$user_mac."</h2></div>";

?>