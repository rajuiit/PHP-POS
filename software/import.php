<html>
<head>
	<style type="text/css">
	body
	{
		margin: 0;
		padding: 0;
		background-color:#D6F5F5;
		text-align:center;
	}
	.top-bar
		{
			width: 100%;
			height: auto;
			text-align: center;
			background-color:#FFF;
			border-bottom: 1px solid #000;
			margin-bottom: 20px;
		}
	.inside-top-bar
		{
			margin-top: 5px;
			margin-bottom: 5px;
		}
	.link
		{
			font-size: 18px;
			text-decoration: none;
			background-color: #000;
			color: #FFF;
			padding: 5px;
		}
	.link:hover
		{
			background-color: #9688B2;
		}
	</style>
	
	
	
</head>

<body>


    <div style="border:1px dashed #333333; width:300px; margin:0 auto; padding:10px;">
    
	<form name="import" method="post" enctype="multipart/form-data">
    	<input type="file" name="file" /><br />
        <input type="submit" name="submit" value="Submit" />
    </form>
	
<?php



	$hostname = "localhost";
	$username = "tcentric_emailma";
	$password = "272r(ME?_xu1";
	$database = "tcentric_emailmarketing";


	$conn = mysql_connect("$hostname","$username","$password") or die(mysql_error());
	mysql_select_db("$database", $conn) or die(mysql_error());


	
	if(isset($_POST["submit"]))
	{
		$file = $_FILES['file']['tmp_name'];
		$handle = fopen($file, "r");
		$c = 0;
		while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
		{
			
			
			$product_code = $filesop[0];
			$product_name = $filesop[1];
			$product_details = $filesop[2];
			$product_price = $filesop[3];
			$add_date	=	date('Y-m-d');	
			
//$q33	=	mysql_query("SELECT * FROM `shop_product` WHERE email_address='$email'");
//$n33	=	mysql_num_rows($q33);
			
			
			
$sql = mysql_query("INSERT INTO shop_product (category_id,product_name,product_code,product_details,product_price,purchases_price,add_date,status) 
VALUES ('0','$product_name','$product_code','$product_details','$product_price','0','$add_date','1')");
			
			$c = $c + 1;
			
			
			
			
		}
		
			if($sql){
				echo "You database has imported successfully. You have inserted ". $c ." recoreds";
			}else{
				echo "Sorry! There is some problem.";
			}

	}
?>
    
    </div>
	
    <hr style="margin-top:300px;" />	
    
  

</body>
</html>