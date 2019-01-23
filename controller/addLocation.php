<?php
	include "connection.php";
	$name=$_POST['name'];
	$description=$_POST['description'];


  $sql="insert into m_location values(null,'$name','$description')";
  // var_dump($sql);die();
  // $query=mysqli_query($conn,$sql);
  $saveSql = $conn->query($sql);
  $last_id = $conn->insert_id;

  $path = "../images/location/";
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
}

  header('Location: ../admin/location.php');