<?php
	require '../vendor/autoload.php';

	use Carbon\Carbon;
	use Carbon\CarbonInterval;
	include "../controller/connection.php";

	$id = $_GET['id'];
  $sql="select m_tourpack.*,m_tour.name as tour,m_tour.address as address,m_package.date_start as start_date,m_package.date_end as end_date from m_tourpack 
    join m_package on m_tourpack.package_id=m_package.id 
  	join m_user on m_package.user_id=m_user.id
  	where m_package.id='$id'";
  // var_dump($sql);die();
  $query=mysqli_query($conn,$sql);
  $arrPackage=[];
  while($row=mysqli_fetch_assoc($query))
  	array_push($arrPackage,$row);

  echo json_encode(array('package'=>$arrPackage));