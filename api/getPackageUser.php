<?php
	require '../vendor/autoload.php';

	use Carbon\Carbon;
	use Carbon\CarbonInterval;
	include "../controller/connection.php";

	$id = $_GET['id'];
  $sql="select m_package.*,m_user.name as user,m_package.date_start as start_date,m_package.date_end as end_date, m_location.name as location from m_package 
  	join m_user on m_package.user_id=m_user.id 
  	join m_location on m_package.location_id = m_location.id
  	where m_user.id='$id'";
  // var_dump($sql);die();
  $query=mysqli_query($conn,$sql);
  $arrPackage=[];
  $date = [];
  while($row=mysqli_fetch_assoc($query)){
  	array_push($arrPackage,$row);
  }

  echo json_encode(array('package'=>$arrPackage));