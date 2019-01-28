<?php
	include "../controller/connection.php";

	$data = json_decode(file_get_contents('php://input'), true);

	// 
	$id=$data['id'];
	$string='';

	$email=$data['email'];
	$password=md5($data['password']);
	$phone=$data['phone'];
	$tour_name=$data['tour_name'];
	$name=$data['name'];
	$tour_description=$data['tour_description'];

	if($data['password']=='')
  	$sql="update m_user set email='$email',phone='$phone',name='$name' where id='$id'";
  else
  	$sql="update m_user set email='$email',phone='$phone',name='$name',password='$password' where id='$id'";
  // var_dump($sql);die();
  $query=mysqli_query($conn,$sql);

  $sql="select * from m_tour where user_id='$id'";
  $query=mysqli_query($conn,$sql);
  $row=mysqli_fetch_assoc($query);

  if(empty($row['id'])){
	  $sql="insert into m_tour(name,description,user_id) values('$tour_name','$tour_description','$id')";
	  // var_dump($sql);die();
	  $query=mysqli_query($conn,$sql);
	  $id=mysqli_insert_id($conn);


	  if($query)
	  	echo json_encode(array('status'=>'berhasil'));
	  else
	  	echo json_encode(array('status'=>'error','message' => 'Name already exists'));
	}
	else{
		$sql="update m_tour set name='$tour_name',description='$tour_description' where user_id='$id'";
	  $query=mysqli_query($conn,$sql);

	  // var_dump($query);die();
	  if($query)
	  	echo json_encode(array('status'=>'berhasil'));
	  else
	  	echo json_encode(array('status'=>'error','message' => 'Name already exists'));
	}

	if(!$data['link']){
		$sql="select * from m_tour where user_id=$id order by id desc";
		$query=mysqli_query($conn,$sql);
		$row=mysqli_fetch_assoc($query);
		if(!empty($row['id']))
			$split1=$row['id'];
		else
			$split1="1";

		$sql="update m_tour set url_photo='".$split1.".png',mime_photo='image/png' where user_id=$id";
		$query=mysqli_query($conn,$sql);

		$data = base64_decode($data['tour_photo']);
		$im = imagecreatefromstring($data);
		imagepng($im, "../images/tour/".$split1.".png");
	}  