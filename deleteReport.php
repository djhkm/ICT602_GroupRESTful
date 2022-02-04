<?php
	require_once 'db.php';

	$filteredPOST = filter_input_array(INPUT_POST,
		[
			'reportID' => FILTER_SANITIZE_NUMBER_INT//,
			//'userIDLocal' => FILTER_SANITIZE_NUMBER_INT,
			//'userIDStored' => FILTER_SANITIZE_NUMBER_INT
		]
	);
	
	//$ = $filteredPOST[''];
	$reportID = $filteredPOST['userType'];
	//$userIDLocal = $filteredPOST['userIDLocal'];
	//$userIDStored = $filteredPOST['userIDStored'];

	$query = "DELETE FROM Report WHERE ReportID = $reportID;";
	
	$result = mysqli_query($conn, $query);
	
	if(mysqli_affected_rows($conn) < 1){
		$msg = "An error occurred while deleting data.\n" . mysqli_error($conn);
	}else{
		$msg = "Report successfully deleted.";

	$status = array("Message" => $msg);
	echo json_encode($status); //To use in Toast
	die();
?>