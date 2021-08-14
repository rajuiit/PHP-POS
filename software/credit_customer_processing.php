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
	0 =>'customer_id', 
	1 => 'customer_name'
	
);

// getting total number records without any search
$sql = "SELECT customer_name,customer_id,customer_address,customer_phone,referance_name,customer_code";
$sql.=" FROM shop_credit_customer";
$query=mysqli_query($conn, $sql) or die("credit_customer_processing.php: get employees");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
	// if there is a search parameter
	$sql = "SELECT customer_name, customer_id ,customer_address,customer_phone,referance_name,customer_code";
	$sql.=" FROM shop_credit_customer";
	$sql.=" WHERE customer_name LIKE '%".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
		
	$sql.=" OR customer_id LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR customer_address LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR customer_phone LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR referance_name LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR customer_code LIKE '".$requestData['search']['value']."%' ";
	
	
	$query=mysqli_query($conn, $sql) or die("credit_customer_processing.php: get employees");
	$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query=mysqli_query($conn, $sql) or die("credit_customer_processing.php: get employees"); // again run query with limit
	
} else {	

	$sql = "SELECT customer_name,customer_id,customer_address,customer_phone,referance_name,customer_code";
	$sql.=" FROM shop_credit_customer";
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($conn, $sql) or die("credit_customer_processing.php: get employees");
	
}

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 

	$nestedData[] = $row["customer_id"];
	
	
	$nestedData[] = $row["customer_name"];
	$nestedData[] = $row["customer_code"];
	$nestedData[] = $row["customer_address"];
	$nestedData[] = $row["customer_phone"];
	$nestedData[] = $row["referance_name"];
	
	
	
	$nestedData[] = "<div align='center'><a href='edit_credit_customer.php?id=".$row["customer_id"]."' title='Edit Credit Customer' class='btn btn-success'><span class='glyphicon glyphicon-pencil'></span></a>
	

	<a href='credit_customer_pay_form.php?id=".$row["customer_id"]."' target='_blank' title='Add Balance' class='btn btn-success'><span class='glyphicon glyphicon-plus-sign'></span></a>
	
	<a href='customer_ledger.php?id=".$row["customer_id"]."' target='_blank' title='Customer Ledger' class='btn btn-success'><span class='glyphicon glyphicon-list'></span></a>
	
	
	<a href='credit_sales.php?id=".$row["customer_id"]."' target='_blank' title='Credit Sales' class='btn btn-success'><span class='glyphicon glyphicon-shopping-cart'></span></a>
	
	
	
		
	</div>
	
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
