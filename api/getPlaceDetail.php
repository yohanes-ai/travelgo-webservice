<?php

include "../controller/connection.php";

$data = json_decode(file_get_contents('php://input'), true);

$id = $_GET['id'];

$selectLocation = "SELECT * FROM m_location WHERE id = '".$id."' ";
$resultLocation = $conn->query($selectLocation);
$location = $resultLocation->fetch_assoc();


echo json_encode(['data' => $location]);

?>