<?php
	require '../vendor/autoload.php';

	use Carbon\Carbon;
	use Carbon\CarbonInterval;
	include "../controller/connection.php";

	$id = $_GET['id'];
  $sql="select m_package.*,m_tour.name as tour,m_tour.address as address from m_package
  	join m_user on m_package.user_id=m_user.id
    join m_tour on m_tour.user_id=m_user.id
  	where m_package.id='$id'";
  // var_dump($sql);die();
  $query=mysqli_query($conn,$sql);
  $row=mysqli_fetch_assoc($query);

  $sql="select * from m_tourpack
  where package_id='".$row['id']."'";
  // var_dump($sql);die();
  $query1=mysqli_query($conn,$sql);
  $arrDetail=[];
  while($row1=mysqli_fetch_assoc($query1))
    array_push($arrDetail,$row1);
  $row['detail']=$arrDetail;

  echo json_encode(array('package'=>$row));