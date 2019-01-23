<?php
	require '../vendor/autoload.php';

	use Carbon\Carbon;
	use Carbon\CarbonInterval;
	include "../controller/connection.php";

  $sql="select * from m_location";
  // var_dump($sql);die();
  $query=mysqli_query($conn,$sql);
  $arrLocation=[];
  while($row=mysqli_fetch_assoc($query))
  	array_push($arrLocation,$row);

  echo json_encode(array('location'=>$arrLocation));