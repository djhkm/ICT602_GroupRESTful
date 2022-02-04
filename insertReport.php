<?php
	require_once 'db.php';

	$filteredPOST = filter_input_array(INPUT_POST,
		[
			'lat' => FILTER_SANITIZE_NUMBER_FLOAT,
			'lon' => FILTER_SANITIZE_NUMBER_FLOAT,
			'hazardID' => FILTER_SANITIZE_NUMBER_INT,
			'userID' => FILTER_SANITIZE_NUMBER_INT,
			'dateTime' => FILTER_SANITIZE_STRING
		]
	);
	
	//$ = $filteredPOST[''];
	$lat = $filteredPOST['lat'];
	$lon = $filteredPOST['lon'];
	$hazardID = $filteredPOST['hazardID'];
	$userID = $filteredPOST['userID'];
	$dateTime = $filteredPOST['dateTime'];

	$query = "INSERT INTO Report(HazardID, UserID, time_Stamp, Latitude, Longitude) 
				VALUES('$hazardID', '$userID', '$dateTime', '$lat', '$lon');";
				
	$result = mysqli_query($conn, $query);
	
	if($result){
		$msg =  "Report successfully submitted.";
	}else{
		$msg = "An error occurred while inserting data.\n" . mysqli_error($conn); 
	}
	$status = array("Message" => $msg);
	echo json_encode($status); //To use in Toast
	die($msg);
?>