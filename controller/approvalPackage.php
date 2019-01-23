<?php
	include "connection.php";
	$id=$_GET['id'];

  $sql="update m_package set approval=1 where id='$id'";
  // var_dump($sql);die();
  $query=mysqli_query($conn,$sql);

  header('Location: ../admin/package.php');