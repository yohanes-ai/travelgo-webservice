<?php
require '../vendor/autoload.php';

use Carbon\Carbon;
use Carbon\CarbonInterval;
include "../controller/connection.php";

$selectLocation = "SELECT m_location.* FROM m_location";
$resultLocation = $conn->query($selectLocation);
$location = [];
while($rowLocation = $resultLocation->fetch_assoc()){
	$selectPhoto = "SELECT * FROM m_location_photo WHERE location_id = '".$rowLocation['id']."' AND primaryPhoto = 1 ";
	$resultPhoto = $conn->query($selectPhoto);
	$rowLocation['photo'] = $resultPhoto->fetch_assoc();

	$selectPhoto = "SELECT m_package.* FROM m_package
		WHERE location_id = '".$rowLocation['id']."' and date_start >= '".Carbon::now()."'";
	$resultPhoto = $conn->query($selectPhoto);
	$arr=[];
	while($row = $resultPhoto->fetch_assoc()){
		$row['date_start']=(!empty($row['date_start']))?Carbon::createFromFormat('Y-m-d',$row['date_start'])->formatLocalized('%d %B %Y'):'';
		array_push($arr,$row);
	}

	$rowLocation['date']=$arr[0]['date_start'].' - '.$arr[count($arr)-1]['date_start'];

	array_push($location, $rowLocation);
}

echo json_encode(['data' => $location]);

?>