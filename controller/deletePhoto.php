<?php

include('connection.php');

$id = $_POST['id'];
$deletePhoto = "DELETE FROM m_location_photo WHERE id = '".$id."' ";
$saveDelete = $conn->query($deletePhoto);

echo json_encode(array("status"=>"behasil"));

?>