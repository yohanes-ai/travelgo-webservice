<?php

include "../controller/connection.php";

$selectPhoto = "SELECT * FROM m_visit_place 
	WHERE location_id = '".$_GET['id']."'";
	// var_dump($selectPhoto);die();
$resultPhoto = $conn->query($selectPhoto);
$photo = [];
while($rowPhoto = $resultPhoto->fetch_assoc()){
	$photo[] = $rowPhoto;
}

echo json_encode(array("data"=>$photo));