<?php
	require '../vendor/autoload.php';

	use Carbon\Carbon;
	use Carbon\CarbonInterval;
	include "../controller/connection.php";
	$data = json_decode(file_get_contents('php://input'), true);

	

	$start = Carbon::createFromFormat('d/m/Y',$data['start_date']);
	$end = Carbon::createFromFormat('d/m/Y',$data['end_date']);
	$location = $data['location'];
	$user_id = $data['user_id'];
	$photo_array = json_decode($data['photo'],true);
	
	$tour_package = json_decode($data['tour_package'],true);
	$id=(!empty($data['id']))?$data['id']:'';



	if(empty($data['id'])){
		$sql="select * from m_location where name like '$location'";
		$query=mysqli_query($conn,$sql);
		$rowLocation=mysqli_fetch_assoc($query);

		$sql="insert into m_package values(null,$user_id,".$rowLocation['id'].",'".$start->formatLocalized('%Y-%m-%d')."','".$end->formatLocalized('%Y-%m-%d')."',0)";
		// var_dump($sql);die();
		$query=mysqli_query($conn,$sql);
		$id=mysqli_insert_id($conn);
		$flag="add";
	}
	else{
		$sql="select * from m_location where name like '$location'";
		$query=mysqli_query($conn,$sql);
		$rowLocation=mysqli_fetch_assoc($query);

		$sql="update m_package set location_id=".$rowLocation['id'].",date_start='".$start->formatLocalized('%Y-%m-%d')."',date_end='".$end->formatLocalized('%Y-%m-%d')."' where id=$id";
		// var_dump($sql);die();
		$query=mysqli_query($conn,$sql);
		$flag="edit";
	}


	if($flag=="add"){
		foreach($photo_array as $photo){

			$sql="select * from m_package_photo where packageID=$id order by id desc";
			$query=mysqli_query($conn,$sql);
			$row=mysqli_fetch_assoc($query);
			if(!empty($row['id']))
				$split1=explode('-',explode('.', $row['urlPhoto'])[0])[1]+1;
			else
				$split1="1";


			$sql="insert into m_package_photo values(null,'".$id."-".$split1.".png','image/png',$id)";
			$query=mysqli_query($conn,$sql);

			$data = base64_decode($photo['data']);
			$im = imagecreatefromstring($data);
			imagepng($im, "../images/package/".$id."-".$split1.".png");
		}
	}
	else{
		$sql="delete from m_package_photo where packageID=$id";
		foreach($photo_array as $photo)
			$sql.=" and id!=".$photo['id'];
		$query=mysqli_query($conn,$sql);

		foreach($photo_array as $photo){
			if(!$photo['link']){
				$sql="select * from m_package_photo where packageID=$id order by id desc";
				$query=mysqli_query($conn,$sql);
				$row=mysqli_fetch_assoc($query);
				if(!empty($row['id']))
					$split1=explode('-',explode('.', $row['urlPhoto'])[0])[1]+1;
				else
					$split1="1";


				$sql="insert into m_package_photo values(null,'".$id."-".$split1.".png','image/png',$id)";
				$query=mysqli_query($conn,$sql);

				$data = base64_decode($photo['data']);
				$im = imagecreatefromstring($data);
				imagepng($im, "../images/package/".$id."-".$split1.".png");
			}
		}
	}

	
	if($flag=="add"){
		foreach($tour_package as $tour){
			if($tour['image']!=""){
				$sql="select * from m_tourpack order by id desc";
				$query=mysqli_query($conn,$sql);
				$row=mysqli_fetch_assoc($query);
				if(!empty($row['id']))
					$split1=$row['id']+1;
				else
					$split1="1";

				$sql="insert into m_tourpack values(null,$id,'".$tour['name']."','".$tour['description']."','".$tour['price']."','".$split1.".png','image/png')";
				$query=mysqli_query($conn,$sql);

				$data = base64_decode($tour['image']);
				$im = imagecreatefromstring($data);
				imagepng($im, "../images/tour_pack/".$split1.".png");
			}
			else{
				$sql="insert into m_tourpack values(null,$id,'".$tour['name']."','".$tour['description']."','".$tour['price']."','','')";
				$query=mysqli_query($conn,$sql);
			}
		}
	}
	else{
		$sql="delete from m_tourpack where package_id=$id";
		foreach($tour_package as $tour)
			$sql.=" and id!=".$tour['id'];
		$query=mysqli_query($conn,$sql);

		foreach($tour_package as $tour){
			if(!empty($tour['id'])){
				$sql="update m_tourpack set name='".$tour['name']."',description='".$tour['description']."',price=".$tour['price'];

				if(!$tour['link']){
					$sql.=",url_photo='".$tour['id'].".png',mime_photo='image/png'";

					$data = base64_decode($tour['image']);
					$im = imagecreatefromstring($data);
					imagepng($im, "../images/tour_pack/".$tour['id'].".png");
				}

				$sql.=" where id=".$tour['id'];
				// var_dump($sql);die();
				$query=mysqli_query($conn,$sql);
			}
			else{
				if($tour['image']!=""){
					$sql="select * from m_tourpack order by id desc";
					$query=mysqli_query($conn,$sql);
					$row=mysqli_fetch_assoc($query);
					if(!empty($row['id']))
						$split1=$row['id']+1;
					else
						$split1="1";
				
					$sql="insert into m_tourpack values(null,$id,'".$tour['name']."','".$tour['description']."','".$tour['price']."','".$split1.".png','image/png')";
					$query=mysqli_query($conn,$sql);

					$data = base64_decode($tour['image']);
					$im = imagecreatefromstring($data);
					imagepng($im, "../images/tour_pack/".$split1.".png");
				}
				else{
					$sql="insert into m_tourpack values(null,$id,'".$tour['name']."','".$tour['description']."','".$tour['price']."','','')";
					$query=mysqli_query($conn,$sql);
				}
			}
		}
		// var_dump($query);die();
	}

	echo json_encode(array('status' => 'berhasil'));
