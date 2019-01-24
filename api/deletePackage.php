<?php
	require '../vendor/autoload.php';

	use Carbon\Carbon;
	use Carbon\CarbonInterval;
	include "../controller/connection.php";
	$data = json_decode(file_get_contents('php://input'), true);

	$id=$data['id'];
	$sql="delete from m_tourpack where package_id=$id";
	$query=mysqli_query($conn,$sql);

	$sql="delete from m_package where id=$id";
	$query=mysqli_query($conn,$sql);

	echo json_encode(array('status' => 'berhasil'));