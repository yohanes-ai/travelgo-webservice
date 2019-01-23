<?php
	include "connection.php";
	$name=$_POST['name'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$tour_name=$_POST['tour_name'];
	$tour_description=$_POST['tour_description'];
	$tour_phone=$_POST['tour_phone'];
	$tour_address=$_POST['tour_address'];

  $sql="insert into m_user values(null,'$email','".md5('12345')."','$name','$phone')";
  $query=mysqli_query($conn,$sql);
  $id=mysqli_insert_id($conn);

  $sql="insert into m_tour values(null,'$tour_name','$tour_description','$tour_phone','$tour_address',$id)";
  // var_dump($sql);die();
  $query=mysqli_query($conn,$sql);

  header('Location: ../admin/user.php');