<?php
	require_once 'db.php';

	$filteredPOST = filter_input_array(INPUT_POST,
		[
			'lat' => FILTER_SANITIZE_NUMBER_FLOAT,
			'lon' => FILTER_SANITIZE_NUMBER_FLOAT,
			'reportID' => FILTER_SANITIZE_NUMBER_INT,
			'hazardID' => FILTER_SANITIZE_NUMBER_INT,
			'userID' => FILTER_SANITIZE_NUMBER_INT,
			'dateTime' => FILTER_SANITIZE_STRING
		]
	);
	
	//$ = $filteredPOST[''];
	$userType = $filteredPOST['userType'];
	$lat = $filteredPOST['lat'];
	$lon = $filteredPOST['lon'];
	$reportID = $filteredPOST['reportID'];
	$hazardID = $filteredPOST['hazardID'];
	$userID = $filteredPOST['userID'];
	
	if(isset($lat) && isset($lon) && isset($hazardID) && isset($userID) && isset($dateTime) && isset($reportID)){
		$query = "UPDATE Report SET 
					HazardID = '$hazardID', 
					Latitude = '$lat', 
					Longitude = '$lon' 
				  WHERE ReportID = '$reportID'";
					
		$result = mysqli_query($conn, $query);
		
		if(mysqli_affected_rows($conn) < 1){
			$msg = "An error occurred while deleting data.\n" . mysqli_error($conn);
		}else{
			$msg = "Report successfully updated.";
		}
	}else{
		$msg = "Please input data.";
	}
	
	$status = array("Message" => $msg);
	echo json_encode($status); //To use in Toast
	die($msg);
?>