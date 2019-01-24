<?php

include('connection.php');

$id = $_POST['id'];
$deletePhoto = "DELETE FROM m_visit_place WHERE id = '".$id."' ";
$saveDelete = $conn->query($deletePhoto);

echo json_encode(array("status"=>"behasil"));

?>