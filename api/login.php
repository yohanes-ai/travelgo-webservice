<?php

include "../controller/connection.php";

$data = json_decode(file_get_contents('php://input'), true);

$email = $data['email'];

if(!empty($data['password'])){
	$password = md5($data['password']);

	$selectUser = "SELECT * FROM m_user WHERE email = '".$email."' AND password = '".$password."' ";
	$resultUser = $conn->query($selectUser);
	if($resultUser->num_rows > 0){
		$rowUser = $resultUser->fetch_assoc();
		echo json_encode(array("status"=>"success", "data" => $rowUser['id']));
	}
	else{
		echo json_encode(array("status"=>"error"));
	}
}
else{
	$selectAlready = "SELECT * FROM m_user WHERE email = '".$email."' ";
	$resultAlready = $conn->query($selectAlready);
	if($resultAlready->num_rows > 0){
		$rowAlready = $resultAlready->fetch_assoc();
		echo json_encode(array("status"=>"success", "data" => $rowAlready['id']));
	}
	else{
		$name = $data['first_name'];
		$insertNewUser = "INSERT into m_user (email, name) VALUES ('".$email."', '".$name."') ";
		$saveNewUser = $conn->query($insertNewUser);
		$last_id = $conn->insert_id;
		echo json_encode(array('status' => 'success', 'data' => $last_id));
	}

}

?>