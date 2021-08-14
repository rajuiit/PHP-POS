<?php

function status_color($month)
	{
	$month1			=	$month;
	
	$month_number		=	array ("Done", "In Progress", "Not Interested");
	
	$f1		=	"<div class='btn btn-success mr5 mb10'>Done</div>";
	$f2		=	"<div class='btn btn-warning mr5 mb10'>In Progress</div>";
	$f3		=	"<div class='btn btn-danger mr5 mb10'>Not Interested</div>";
	
	$replace	=	array ("$f1", "$f2", "$f3");
	
	$english_month	=	str_replace($month_number, $replace, $month1);
	$english_date=$english_month;
	return $english_date;
	}
	
	
/* Database connection start */
include("processing.php");

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */

include("configs/config.php");
include("configs/function.php");
include("configs/settings.php");


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 =>'product_id', 
	1 => 'product_name'
	
);

// getting total number records without any search
$sql = "SELECT product_name,product_id,product_code,category_id,status FROM shop_product WHERE status=1";


$query=mysqli_query($conn, $sql) or die("sales_item_processing.php: get employees");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
	// if there is a search parameter
	$sql = "SELECT product_name, product_id ,product_code,category_id,product_price,status";
	$sql.=" FROM shop_product WHERE status=1 AND";
		
	$sql.=" product_code LIKE '%".$requestData['search']['value']."%' ";

	
	$query=mysqli_query($conn, $sql) or die("sales_item_processing.php: get employees");
	$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query=mysqli_query($conn, $sql) or die("sales_item_processing.php: get employees"); // again run query with limit
	
} else {	

	$sql = "SELECT product_name,product_id,product_code,category_id,product_price,status";
	$sql.=" FROM shop_product WHERE status=1";
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($conn, $sql) or die("sales_item_processing.php: get employees");
	
}

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 


	$nestedData[] = $row["product_name"];
	$nestedData[] = $row["product_code"];
	$nestedData[] = $row["product_price"];
	
	
	$nestedData[] = "<input type=\"submit\" id=\"vasplus_p_blog_add_to_cart_button\" value=\"Add to Cart\" title=\"Add Cart\" onclick=vpb_add_to_cart('".$row["product_id"]."','add');>
	
	";
	

	
	
	$data[] = $nestedData;
}



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
