<?php
	require '../vendor/autoload.php';

	use Carbon\Carbon;
	use Carbon\CarbonInterval;
	include "../controller/connection.php";

	$id = $_GET['id'];
	
  $sql="select m_invoice.tanggal,m_invoice.id,SUM(m_invoice_detail.total) as price,m_location.name as location from m_invoice 
  	left join m_invoice_detail on m_invoice_detail.invoice_id=m_invoice.id
    join m_tourpack on m_invoice_detail.tourpack_id=m_tourpack.id
    join m_package on m_tourpack.package_id=m_package.id
    join m_location on m_package.location_id=m_location.id
  	where m_invoice.user_id='$id'
    group by tanggal,location,id
    order by tanggal desc
    limit 30";
  // var_dump($sql);die();
  $query=$conn->query($sql);
  // $query=mysqli_query($conn,$sql);
  $arrHistory=[];
  // while($row=mysqli_fetch_assoc($query))
  // 	array_push($arrPackage,$row);

  while ($row=$query->fetch_assoc()) {
  	array_push($arrHistory, $row);
  }

  echo json_encode(array('data'=>$arrHistory));