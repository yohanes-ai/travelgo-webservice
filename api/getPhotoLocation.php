<?php

include "../controller/connection.php";

$selectPhoto = "SELECT * FROM m_location_photo WHERE location_id = '".$_GET['id']."' ORDER BY primaryPhoto DESC ";
$resultPhoto = $conn->query($selectPhoto);
$photo = [];
while($rowPhoto = $resultPhoto->fetch_assoc()){
	$photo[] = $rowPhoto;
}

echo json_encode(array("photo"=>$photo));

?>