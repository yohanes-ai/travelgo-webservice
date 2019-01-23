<?php

include "../controller/connection.php";

$selectLocation = "SELECT * FROM m_location ";
$resultLocation = $conn->query($selectLocation);
$location = [];
while($rowLocation = $resultLocation->fetch_assoc()){
	$location[] = $rowLocation;
}

echo json_encode(['data' => $location]);

?>