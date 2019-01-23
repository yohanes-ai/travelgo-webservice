<?php
	include "connection.php";
	$id=$_GET['id'];

  $sql="delete from m_location where id='$id'";
  // var_dump($sql);die();
  $query=mysqli_query($conn,$sql);

  header('Location: ../admin/location.php');