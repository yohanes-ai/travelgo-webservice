<?php
	include "connection.php";
	session_start();

	$email=$_POST['email'];
	$password=md5($_POST['password']);

  $sql="select * from m_user where email='$email' and password='$password'";
  $query=mysqli_query($conn,$sql);
  $row=mysqli_fetch_assoc($query);
  // var_dump($row);die();

  if(!empty($row['id'])){
  	$_SESSION['login']=$row['id'];
  	header('Location: ../admin/index.php');
  }
  else{
  	header('Location: '.$_SERVER['HTTP_REFERER']);
  }
