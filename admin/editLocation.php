<?php
include "../controller/connection.php";

	$sql="select * from m_location where id = '".$_GET['id']."' ";
	$query=mysqli_query($conn,$sql);
	$location = $query->fetch_assoc();

	$photo = [];
	$visitPlace = [];

	$sqlPhoto = "SELECT * FROM m_location_photo WHERE location_id = '".$location['id']."' ORDER BY primaryPhoto DESC ";
	$resultPhoto = $conn->query($sqlPhoto);
	$photo[$location['id']] = [];
	while ($rowPhoto = $resultPhoto->fetch_assoc()) {
		array_push($photo[$location['id']], $rowPhoto);
	}

	$sqlPhotoVisit = "SELECT * FROM m_visit_place WHERE location_id = '".$location['id']."' ";
	$resultPhotoVisit = $conn->query($sqlPhotoVisit);
	$visitPlace[$location['id']] = [];
	while ($rowPhotoVisit = $resultPhotoVisit->fetch_assoc()) {
		array_push($visitPlace[$location['id']], $rowPhotoVisit);
	}

?>
<?php include "../layout/baseHeader.php" ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<h4>Edit Location</h4>
		</div>
		
		<div class="col-sm-5 offset-sm-3 p-5">
			<form method="POST" action="../controller/editLocation.php" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?= $_GET['id'] ?>">
				<div class="row">

					<div class="col-sm-12">
						<label for="name">Name</label>
						<input type="text" class="form-control" name="name" value="<?= $location['name'] ?>" id="name" placeholder="Name">
					</div>
					<div class="col-sm-12 mt-3">
						<label for="description">Description</label>
						<textarea class="form-control" id="description" name="description" rows="5" placeholder="Description"><?= $location['description'] ?></textarea>
					</div>
					<div class="col-sm-12 mt-3">
						<label for="description">Photo <sub>(Ukuran foto 157px - 420px)</sub></label>
						<div class="row px-4">
							<?php foreach($photo[$location['id']] as $p){ ?>
								<div class="col-md-3 p-1">
									<div class="" style="height: 4rem; background-image: url(../images/location/<?= $p['urlPhoto'] ?>); background-repeat: no-repeat; background-size: cover; background-position: center;"></div>
									<p class="w-100 text-center m-0"><a href="#!" class="deletePhoto" id="<?= $p['id'] ?>" style="font-size: 0.75rem">Delete Photo</a></p>
								</div>
							<?php } ?>
						</div>
						<p class="text-center mt-2">Drop files here to upload or choose file<input type="file" id="fileEdt" name="filesEdt[]" multiple="multiple" accept="image/*" class="hide filePhotoUpload" /></p>
					</div>
					<div class="col-sm-12 mt-3">
						<label for="description">Place to Visit</label>
						<div class="row px-4">
							<?php foreach($visitPlace[$location['id']] as $p){ ?>
								<div class="col-md-3 p-1">
									<div class="" style="height: 4rem; background-image: url(../images/visit_place/<?= $p['urlPhoto'] ?>); background-repeat: no-repeat; background-size: cover; background-position: center;"></div>
									<p class="w-100 text-center m-0"><a href="#!" class="deletePhotoPlace" id="<?= $p['id'] ?>" style="font-size: 0.75rem">Delete Photo</a></p>
								</div>
							<?php } ?>
						</div>
						<p class="text-center mt-2">Drop files here to upload or choose file<input type="file" id="fileVisitPlaceEdt" name="filesVisitPlaceEdt[]" multiple="multiple" accept="image/*" class="hide filePhotoUpload" /></p>
					</div>

					<div class="col-sm-12 mt-3">
						<label for="description">Place Map</label>
						<div class="row px-4">
							<div class="col-md-12 p-1">
								<div class="" style="height: 8rem; background-image: url(../images/maps/<?= $location['map_photo'] ?>); background-repeat: no-repeat; background-size: cover; background-position: center;"></div>
							</div>
						</div>
						<p class="text-center mt-2">Drop files here to upload or choose file<input type="file" id="placePhotoEdt" name="placePhotoEdt" accept="image/*" class="hide filePhotoUpload" /></p>
					</div>

					<div class="col-sm-12 mt-3 text-right">
						<a href="location.php" class="btn btn-danger">Cancel</a>
						<button type="submit" class="btn btn-primary text-white">Save changes</button>
					</div>
				</div>
			</form>
		</div>

	</div>
</div>

<?php include "../layout/baseFooter.php" ?>
