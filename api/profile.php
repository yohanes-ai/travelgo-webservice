<?php
	include "../controller/connection.php";

	$data = json_decode(file_get_contents('php://input'), true);

	// 
	$id=$data['id'];

  $sql="select m_user.*,m_tour.name as name_tour,m_tour.description as description_tour,m_tour.url_photo as photo_tour from m_user 
  	left join m_tour on m_user.id=m_tour.user_id
  	where m_user.id LIKE '$id'";
  // var_dump($sql);die();
  $query=mysqli_query($conn,$sql);
  $row=mysqli_fetch_assoc($query);

  echo json_encode(array('user'=>$row));