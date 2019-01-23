<?php
	include "connection.php";
	$name=$_POST['name'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$tour_name=$_POST['tour_name'];
	$tour_description=$_POST['tour_description'];
	$tour_phone=$_POST['tour_phone'];
	$tour_address=$_POST['tour_address'];
	$id=$_POST['id'];

  $sql="update m_user set name='$name',email='$email',phone='$phone' where id='$id'";
  $query=mysqli_query($conn,$sql);

  $sql="update m_tour set name='$tour_name',description='$tour_description',phone='$tour_phone',address='$tour_address' where user_id='$id'";
  $query=mysqli_query($conn,$sql);

  header('Location: ../admin/user.php');