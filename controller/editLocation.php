<?php
	include "connection.php";
	$name=$_POST['name'];
	$description=$_POST['description'];
	$id=$_POST['id'];

  $sql="update m_location set name='$name',description='$description' where id='$id'";
  // var_dump($sql);die();
  $query=mysqli_query($conn,$sql);

  $path = "../images/location/";
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
  }

  header('Location: ../admin/location.php');