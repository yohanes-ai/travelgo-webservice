<?php
	require '../vendor/autoload.php';

	use Carbon\Carbon;
	use Carbon\CarbonInterval;
	include "../controller/connection.php";

	$id = $_GET['id'];
	
  $sql="select m_location.name as location,m_invoice.* from m_invoice 
  	join m_invoice_detail on m_invoice_detail.invoice_id=m_invoice.id
    join m_tourpack on m_invoice_detail.tourpack_id=m_tourpack.id
    join m_package on m_tourpack.package_id=m_package.id
    join m_location on m_package.location_id=m_location.id
  	where m_invoice.id='$id'";
  
  $query=$conn->query($sql);
  // $query=mysqli_query($conn,$sql);
  $row=$query->fetch_assoc();

  $sql="select m_tourpack.*,m_invoice_detail.total,m_location.name as location from m_invoice_detail
    join m_tourpack on m_invoice_detail.tourpack_id=m_tourpack.id
    join m_package on m_tourpack.package_id=m_package.id
    join m_location on m_package.location_id=m_location.id
    where m_invoice_detail.invoice_id='$id'";
  $query1=$conn->query($sql);
  $arr=[];
  while ($row1=$query1->fetch_assoc()) {
    array_push($arr,$row1);
  }
  $row['detail']=$arr;

  echo json_encode(array('data'=>$row));