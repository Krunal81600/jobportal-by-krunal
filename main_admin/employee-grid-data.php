<?php
/* Database connection start */
$servername = "localhost";
$username = "Africaglobalnetw";
$password = "Africaglobalnetwork";
$dbname = "Africaglobalnetwork";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 =>'id', 
	1 => 'citynm',
	2=> 'country_id'
);

// getting total number records without any search
$sql = "SELECT * ";
$sql.=" FROM city";
$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get city");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT * ";
$sql.=" FROM city WHERE 1=1";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( id LIKE '".$requestData['search']['value']."%' ";    
	$sql.=" OR citynm LIKE '".$requestData['search']['value']."%' ";

	$sql.=" OR country_id LIKE '".$requestData['search']['value']."%' )";
}
$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get city");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get city");

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 

	$cid=$row["country_id"];
	$sqla=mysqli_query($conn,"SELECT * FROM `country` WHERE id='$cid'");
	$rowa=mysqli_fetch_array($sqla);
	
	$nestedData[] = $row["id"];
	$nestedData[] = $row["citynm"];
	$nestedData[] = $rowa["countrynm"];
	$nestedData[] = "<a href='location.php?sid=". $row["id"]."&opr=edit' class='btn btn-primary'>Edit</a>";
	$nestedData[] = "<a href='location.php?sid=". $row["id"]."&opr=remove' class='btn btn-danger'>Delete</a>";
	
	
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
