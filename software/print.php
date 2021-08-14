<?php
include("configs/config.php");
include("configs/function.php");
include("configs/settings.php");

$code	=	filter_input(INPUT_GET, 'code', FILTER_SANITIZE_SPECIAL_CHARS);
//echo $code;
$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
$q3	=	mysqli_query($db,"SELECT * FROM `shop_product` WHERE product_code='$code'");
$r	=	mysqli_fetch_array($q3);
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

		
<style type="text/css">

.image ul{
	width:900px;
	border:1px solid #e5e5e5;
	margin:0 auto;
}

.image li{
font-size: 50px;
list-style: outside none none;
margin: 10px 10px 120px -450px;
text-align: center;
font-weight:bold;
}

.image li:last-child{

margin: 10px 10px 30px -450px;

}

</style>


</head>

<body>


<?php

if(!isset($_GET['page']))
{
?>
<br><br>
<form class="form-horizontal" action="" method="GET">

<table align="center" border="0" width="500">

<tr>
<td>


<input type="hidden" name="code" size=="30" placeholder="Please enter quantity" value="<?php echo $code; ?>" class="form-control" />

<input type="text" name="page" size=="30" placeholder="Please enter quantity" class="form-control" />

</td><td>
<input type="submit" name="action" class="btn btn-success" value="Submit">



</td>

</tr>

</table>
</form>
<?php
}
?>

<div align="center">


<div class="image">

<ul>

<?php
$code	=	filter_input(INPUT_GET, 'code', FILTER_SANITIZE_SPECIAL_CHARS);
if(isset($_GET['page']))
{
	
	$page	=	filter_input(INPUT_GET, 'page', FILTER_SANITIZE_SPECIAL_CHARS);

}
else{
	$page	=	168;
}
for ($x = 0; $x <= $page; $x++) {
	?>
	
	<li style="margin-bottom:<?php if(0==$x % 2){echo "0"; }else{echo 300;} ?>px;margin-top:<?php if(0==$x % 2){echo "0"; }else{echo 100;} ?>px;"><?php echo $code; ?><br> <img src="barcode.jpg" style="width:420px; height:80px;"><br>Tk. <?php echo $r['product_price']; ?></li>
	
	<?php
    //echo "The number is: $x <br>";
}
?> 
</ul>
</div>

</body>

</html>
