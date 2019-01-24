<?php
include "connection.php";
$name=$_POST['name'];
$description=$_POST['description'];

$map_photo = null;
$pathMaps = "../images/maps/";

if ($_FILES['placePhoto']['error'] == 0) {
	$mimeType = $_FILES['placePhoto']['type'];

	$name1 = $_FILES['placePhoto']['name'];

	if(move_uploaded_file($_FILES["placePhoto"]["tmp_name"], $pathMaps.$name1)){
		$map_photo = $name1;
		$mimeType = $mimeType;
	}
}


$sql="insert into m_location values(null,'$name','$description', '$map_photo')";
$saveSql = $conn->query($sql);
$last_id = $conn->insert_id;

$path = "../images/location/";
$pathPlace = "../images/visit_place/";
$arrFile=[];

if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
	
	foreach ($_FILES['files']['name'] as $f => $name) {
		if ($_FILES['files']['error'][$f] == 4) {
			continue; 
		}   
		if ($_FILES['files']['error'][$f] == 0) {

			$mimeType;
			foreach($_FILES['files']['type'] as $mime){
				$mimeType = $mime;
			}

			$primary = 0;

			if($f == 0){
				$primary = 1;
			}

			if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$name)){
				$file = $name;
				$mimeType = $mimeType;

				$insertPhoto = "INSERT INTO m_location_photo (urlPhoto, mimePhoto, location_id, primaryPhoto) values('".$name."', '".$mime."', '".$last_id."', '".$primary."')";
				$savePhoto = $conn->query($insertPhoto);
			}
		}
	}

	foreach ($_FILES['placeToVisit']['name'] as $f => $name) {
		if ($_FILES['placeToVisit']['error'][$f] == 4) {
			continue; 
		}   
		if ($_FILES['placeToVisit']['error'][$f] == 0) {

			$mimeType;
			foreach($_FILES['placeToVisit']['type'] as $mime){
				$mimeType = $mime;
			}

			if(move_uploaded_file($_FILES["placeToVisit"]["tmp_name"][$f], $pathPlace.$name)){
				$file = $name;
				$mimeType = $mimeType;

				$insertPhoto = "INSERT INTO m_visit_place (urlPhoto, mimePhoto, location_id) values('".$name."', '".$mime."', '".$last_id."')";
				$savePhoto = $conn->query($insertPhoto);
			}
		}
	}

}

header('Location: ../admin/location.php');