<?php

include "../controller/connection.php";

$data = json_decode(file_get_contents('php://input'), true);

$email = $data['email'];
$password = md5($data['password']);

$selectUser = "SELECT * FROM m_user WHERE email = '".$email."' ";
$resultUser = $conn->query($selectUser);

if($resultUser->num_rows == 0){
	$insertUser = "INSERT into m_user (email, password) VALUES ('".$email."', '".$password."')  ";
	$saveUser = $conn->query($insertUser);
	$last_id = $conn->insert_id;
	echo json_encode(array('status' => 'success', 'data' => $last_id));
}
else{
	echo json_encode(array("status"=>"already"));
}

?>