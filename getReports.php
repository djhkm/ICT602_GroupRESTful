<?php
	require_once 'db.php';

	$query = "SELECT ReportID, B.Type AS 'Hazard', time_Stamp AS 'Time', Latitude, Longitude, Username AS 'Reported By', C.UserID 
				FROM Report A 
				INNER JOIN Hazard B ON A.HazardID = B.HazardID 
				INNER JOIN User C ON A.UserID = C.UserID
				ORDER BY time_Stamp DESC";
	$result = mysqli_query($conn, $query);
	if($result){
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		echo json_encode($rows);
	}else{		
		$msg = "An error occurred while fetching data.\n" . mysqli_error($conn); 
		$status = array("Message" => $msg);
		
		echo json_encode($status); //To use in Toast
		die();
	}
?>