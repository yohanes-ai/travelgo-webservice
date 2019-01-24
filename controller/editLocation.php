<?php
	include "connection.php";
	$name=$_POST['name'];
	$description=$_POST['description'];
	$id=$_POST['id'];




  $sql="update m_location set name='$name',description='$description' where id='$id'";
  // var_dump($sql);die();
  $query=mysqli_query($conn,$sql);

  $path = "../images/location/";
  $pathPlace = "../images/visit_place/";
  $pathMaps = "../images/maps/";
  $arrFile=[];

  $checkPhoto = "SELECT * FROM m_location_photo WHERE location_id = '".$id."' ";
  $resultPhoto = $conn->query($checkPhoto);

  if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){

  	foreach ($_FILES['filesEdt']['name'] as $f => $name) {

  		if ($_FILES['filesEdt']['error'][$f] == 4) {
  			continue; 
  		}   
  		if ($_FILES['filesEdt']['error'][$f] == 0) {

  			$mimeType;
  			foreach($_FILES['filesEdt']['type'] as $mime){
  				$mimeType = $mime;
  			}

  			$primary = 0;

  			if($resultPhoto->num_rows == 0){
  				if($f == 0){
  					$primary = 1;
  				}
  			}
  			
  			if(move_uploaded_file($_FILES["filesEdt"]["tmp_name"][$f], $path.$name)){
  				$file = $name;
  				$mimeType = $mimeType;

  				$insertPhoto = "INSERT INTO m_location_photo (urlPhoto, mimePhoto, location_id, primaryPhoto) values('".$name."', '".$mime."', '".$id."', '".$primary."')";
  				$savePhoto = $conn->query($insertPhoto);
  			}
  		}
  	}

  	foreach ($_FILES['filesVisitPlaceEdt']['name'] as $f => $name) {

  		if ($_FILES['filesVisitPlaceEdt']['error'][$f] == 4) {
  			continue; 
  		}   
  		if ($_FILES['filesVisitPlaceEdt']['error'][$f] == 0) {

  			$mimeType;
  			foreach($_FILES['filesVisitPlaceEdt']['type'] as $mime){
  				$mimeType = $mime;
  			}
  			
  			if(move_uploaded_file($_FILES["filesVisitPlaceEdt"]["tmp_name"][$f], $pathPlace.$name)){
  				$file = $name;
  				$mimeType = $mimeType;

  				$insertPhoto = "INSERT INTO m_visit_place (urlPhoto, mimePhoto, location_id) values('".$name."', '".$mime."', '".$id."')";
  				$savePhoto = $conn->query($insertPhoto);
  			}
  		}
  	}


  	if ($_FILES['placePhotoEdt']['error'] == 0) {
  		$mimeType = $_FILES['placePhotoEdt']['type'];
  		
  		$name = $_FILES['placePhotoEdt']['name'];

  		if(move_uploaded_file($_FILES["placePhotoEdt"]["tmp_name"], $pathMaps.$name)){
  			$file = $name;
  			$mimeType = $mimeType;

  			$sql1="update m_location set map_photo = '".$name."' where id='$id'";
  			$query1=mysqli_query($conn,$sql1);
  		}
  	}


  }

  header('Location: ../admin/location.php');