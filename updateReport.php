<?php
	require_once 'db.php';

	$filteredPOST = filter_input_array(INPUT_POST,
		[
			'reportID' => FILTER_SANITIZE_NUMBER_INT,
			'hazardID' => FILTER_SANITIZE_NUMBER_INT,
		]
	);
	
	//$ = $filteredPOST[''];
	$reportID = $filteredPOST['reportID'];
	$hazardID = $filteredPOST['hazardID'];
	
	if(isset($hazardID)  isset($reportID)){
		$query = "UPDATE Report SET 
					HazardID = '$hazardID', 
				  WHERE ReportID = '$reportID'";
					
		$result = mysqli_query($conn, $query);
		
		if(mysqli_affected_rows($conn) < 1){
			$msg = "An error occurred while deleting data.\n" . mysqli_error($conn);
		}else{
			$msg = "Report successfully updated.";
		}
	}else{
		$msg = "Invalid option selected..";
	}
	
	$status = array("Message" => $msg);
	echo json_encode($status); //To use in Toast
	die();
?>