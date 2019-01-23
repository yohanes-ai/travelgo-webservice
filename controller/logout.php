<?php
	include "connection.php";
	session_start();

	unset($_SESSION['login']);
  unset($_SESSION['question']);
  // 
	header('Location: ../login/login.php');
