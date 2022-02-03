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
	$dateTime = $filteredPOST['dateTime'];
	
	if(isset($userType)){
		if(isset($lat) && isset($lon) && isset($hazardID) && isset($userID) && isset($dateTime) && isset($reportID)){
			$query = "UPDATE Report SET
						HazardID = $hazardID, 
						time_Stamp = $dateTime,
						Latitude = $lat,
						Longitude = $lon
					  WHERE ReportID = $reportID";
						
			$result = mysqli_query($conn, $query);
			
			if($result){
				echo mysqli_error($conn);
			}else{
				echo "Report successfully updated.";
			}
		
		}else{
			die('Please input data');
		}
	}else{
		die("Please login.");
	}
?>