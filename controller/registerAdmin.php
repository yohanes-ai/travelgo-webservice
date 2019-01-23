<?php
	include "connection.php";
	session_start();

  $sql="insert into m_user(email,password) values('admin@admin.com','".md5('12345')."')";
  // var_dump($_SESSION['question']);die();
  $query=mysqli_query($conn,$sql);