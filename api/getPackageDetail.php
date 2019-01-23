<?php
	require '../vendor/autoload.php';

	use Carbon\Carbon;
	use Carbon\CarbonInterval;
	include "../controller/connection.php";

	$data = json_decode(file_get_contents('php://input'), true);

	$id = $data['id'];
  $sql="select m_tourpack.*,m_package.date_start as start_date,m_package.date_end as end_date,m_location.name as location from m_tourpack 
    join m_package on m_tourpack.package_id=m_package.id 
  	join m_user on m_package.user_id=m_user.id 
    join m_location on m_package.location_id=m_location.id 
  	where m_tour.user_id='$id'";
  // var_dump($sql);die();
  $query=mysqli_query($conn,$sql);
  $arrPackage=[];
  while($row=mysqli_fetch_assoc($query))
  	array_push($arrPackage,$row);

  echo json_encode(array('package'=>$arrPackage));