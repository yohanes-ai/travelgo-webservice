<?php
include "../controller/connection.php";
?>
<?php include "../layout/baseHeader.php" ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<h4>Add Location</h4>
		</div>
		
		<div class="col-sm-5 offset-sm-3 p-5">
			<form method="POST" action="../controller/addLocation.php" enctype="multipart/form-data">
				<div class="row">

					<div class="col-sm-12">
						<label for="name">Name</label>
						<input type="text" class="form-control" id="name" name="name" placeholder="Name">
					</div>
					<div class="col-sm-12 mt-3">
						<label for="description">Description</label>
						<textarea class="form-control" id="description" name="description" rows="5" placeholder="Description"></textarea>
					</div>
					<div class="col-sm-12 mt-3">
						<label for="description">Photo</label>
						<p>Drop files here to upload or choose file<input type="file" id="file" name="files[]" multiple="multiple" accept="image/*" class="hide filePhotoUpload" /></p>
					</div>
					<div class="col-sm-12 mt-3">
						<label for="description">Place to Visit</label>
						<p>Drop files here to upload or choose file<input type="file" id="placeToVisit" name="placeToVisit[]" multiple="multiple" accept="image/*" class="hide filePhotoUpload" /></p>
					</div>
					<div class="col-sm-12 mt-3">
						<label for="description">Place Map</label>
						<p>Drop files here to upload or choose file<input type="file" id="placePhoto" name="placePhoto" accept="image/*" class="hide filePhotoUpload" /></p>
					</div>

					<div class="col-sm-12 mt-3 text-right">
						<a href="location.php" class="btn btn-danger">Cancel</a>
						<button type="submit" class="btn btn-primary text-white saveNewLocation">Save changes</button>
					</div>
				</div>
			</form>
		</div>

	</div>
</div>

<?php include "../layout/baseFooter.php" ?>
