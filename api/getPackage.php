<?php
	require '../vendor/autoload.php';

	use Carbon\Carbon;
	use Carbon\CarbonInterval;
	include "../controller/connection.php";

	$data = json_decode(file_get_contents('php://input'), true);

	$location = $data['location'];
	$date = (empty($data['date']))?Carbon::now()->formatLocalized('%Y-%m-%d'):Carbon::createFromFormat('d/m/Y',$data['date'])->formatLocalized('%Y-%m-%d');
	
  $sql="select m_package.*,m_tour.name as tour,m_tour.address as address from m_package 
  	join m_user on m_package.user_id=m_user.id 
  	join m_tour on m_user.id = m_tour.user_id
    join m_location on m_package.location_id=m_location.id 
  	where m_location.name='$location' and m_package.date_start='$date' and m_package.approval=1";
  // var_dump($sql);die();
  $query=$conn->query($sql);
  // $query=mysqli_query($conn,$sql);
  $arrPackage=[];
  // while($row=mysqli_fetch_assoc($query))
  // 	array_push($arrPackage,$row);

  while ($row=$query->fetch_assoc()) {
    $row['date_start']=Carbon::createFromFormat('Y-m-d',$row['date_start'])->formatLocalized('%d %B %Y');
    $row['date_end']=Carbon::createFromFormat('Y-m-d',$row['date_end'])->formatLocalized('%d %B %Y');
  	array_push($arrPackage, $row);
  }

  echo json_encode(array('user'=>$arrPackage));