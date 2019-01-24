<?php
	require '../vendor/autoload.php';

	use Carbon\Carbon;
	use Carbon\CarbonInterval;
	include "../controller/connection.php";

	$id=$_GET['id'];
	$sql="select m_package.*,m_location.name as location from m_package 
  	join m_user on m_package.user_id=m_user.id 
    join m_location on m_package.location_id=m_location.id 
  	where m_package.id=$id";
  // var_dump($sql);die();
  $query=$conn->query($sql);
  $arrPackage=[];
  while($row = $query->fetch_assoc()){
  	$sql="select * from m_tourpack where package_id=$id";
  	$query1=$conn->query($sql);
  	$arr=[];
  	while($row1 = $query1->fetch_assoc())
  		array_push($arr,$row1);
  	$row['detail']=$arr;

  	$sql="select * from m_package_photo where packageID=$id";
  	$query1=$conn->query($sql);
  	$arr=[];
  	while($row1 = $query1->fetch_assoc())
  		array_push($arr,$row1);
  	$row['photo']=$arr;

  	$row['date_start']=Carbon::createFromFormat('Y-m-d',$row['date_start'])->formatLocalized('%d/%m/%Y');
  	$row['date_end']=Carbon::createFromFormat('Y-m-d',$row['date_end'])->formatLocalized('%d/%m/%Y');

  	array_push($arrPackage,$row);
  }

  echo json_encode(array('data' => $arrPackage));