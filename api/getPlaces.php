<?php

include "../controller/connection.php";

$selectLocation = "SELECT * FROM m_location";
$resultLocation = $conn->query($selectLocation);
$location = [];
while($rowLocation = $resultLocation->fetch_assoc()){
	$selectPhoto = "SELECT * FROM m_location_photo WHERE location_id = '".$rowLocation['id']."' AND primaryPhoto = 1 ";
	$resultPhoto = $conn->query($selectPhoto);
	$rowLocation['photo'] = $resultPhoto->fetch_assoc();

	array_push($location, $rowLocation);
}

echo json_encode(['data' => $location]);

?>