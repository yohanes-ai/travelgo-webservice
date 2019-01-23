<?php
	include "connection.php";
	$id=$_GET['id'];

  $sql="delete from m_user where id='$id'";
  $query=mysqli_query($conn,$sql);

  $sql="delete from m_tour where user_id='$id'";
  $query=mysqli_query($conn,$sql);

  header('Location: ../admin/user.php');