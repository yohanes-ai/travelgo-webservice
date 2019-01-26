<?php
	include "../controller/connection.php";

	$sql="select * from m_location";
	$query=mysqli_query($conn,$sql);
	$arrLocation=[];
	$photo = [];
	$visitPlace = [];
	while($row = mysqli_fetch_assoc($query)){
		array_push($arrLocation,$row);

		$sqlPhoto = "SELECT * FROM m_location_photo WHERE location_id = '".$row['id']."' ORDER BY primaryPhoto DESC ";
		$resultPhoto = $conn->query($sqlPhoto);
		$photo[$row['id']] = [];
		while ($rowPhoto = $resultPhoto->fetch_assoc()) {
			array_push($photo[$row['id']], $rowPhoto);
		}

		$sqlPhotoVisit = "SELECT * FROM m_visit_place WHERE location_id = '".$row['id']."' ";
		$resultPhotoVisit = $conn->query($sqlPhotoVisit);
		$visitPlace[$row['id']] = [];
		while ($rowPhotoVisit = $resultPhotoVisit->fetch_assoc()) {
			array_push($visitPlace[$row['id']], $rowPhotoVisit);
		}
	}

?>
<?php include "../layout/baseHeader.php" ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-6">
			<h4>Location</h4>
		</div>
		<div class="col-sm-6">
			<!-- Button trigger modal -->
			<a href="addLocation.php" class="btn btn-primary float-right">
				ADD
			</a>

		</div>

		<div class="col-sm-12">
			<div class="table-responsive">
				<table class="table nowrap" id="table" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>No</th>
							<th>Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($arrLocation as $key=>$location){ ?>
							<tr>
								<td><?= $key+1 ?></td>
								<td><?= $location['name'] ?></td>
								<td>
									<!-- Button trigger modal -->
									<a href="editLocation.php?id=<?= $location['id'] ?>" class="btn btn-warning">
										EDIT
									</a>

									<a href="../controller/deleteLocation.php?id=<?= $location['id'] ?>" class="btn btn-danger">DELETE</a>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<?php include "../layout/baseFooter.php" ?>
