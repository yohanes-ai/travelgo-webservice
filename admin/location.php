<?php
  include "../controller/connection.php";

  $sql="select * from m_location";
  $query=mysqli_query($conn,$sql);
  $arrLocation=[];
  $photo = [];
  while($row = mysqli_fetch_assoc($query)){
    array_push($arrLocation,$row);

    $sqlPhoto = "SELECT * FROM m_location_photo WHERE location_id = '".$row['id']."' ORDER BY primaryPhoto DESC ";
    $resultPhoto = $conn->query($sqlPhoto);
    $photo[$row['id']] = [];
    while ($rowPhoto = $resultPhoto->fetch_assoc()) {
    	array_push($photo[$row['id']], $rowPhoto);
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
      <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addModal">
        ADD
      </button>

      <!-- Modal -->
      <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <form method="POST" action="../controller/addLocation.php" enctype="multipart/form-data">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Location</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                </div>
                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea class="form-control" id="description" name="description" placeholder="Description"></textarea>
                </div>
                <div class="form-group">
                  <label for="description">Photo</label>
                  <p class="text-center">Drop files here to upload or choose file<input type="file" id="file" name="files[]" multiple="multiple" accept="image/*" class="hide" /></p>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-12">
      <table class="table">
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
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal<?= $location['id'] ?>">
                  EDIT
                </button>

                <!-- Modal -->
                <div class="modal fade" id="editModal<?= $location['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <form method="POST" action="../controller/editLocation.php" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $location['id'] ?>">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Edit Location</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" value="<?= $location['name'] ?>" id="name" placeholder="Name">
                          </div>
                          <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Description"><?= $location['description'] ?></textarea>
                          </div>
                          <div class="form-group">
                          	<label for="description">Photo</label>
                          	<div class="row px-4">
                          		<?php foreach($photo[$location['id']] as $p){ ?>
                          			<div class="col-md-3 p-1">
                          				<div class="" style="height: 4rem; background-image: url(../images/location/<?= $p['urlPhoto'] ?>); background-repeat: no-repeat; background-size: cover; background-position: center;"></div>
                          				<p class="w-100 text-center m-0"><a href="#!" class="deletePhoto" id="<?= $p['id'] ?>" style="font-size: 0.75rem">Delete Photo</a></p>
                          			</div>
                          		<?php } ?>
                          	</div>
                          	<p class="text-center mt-2">Drop files here to upload or choose file<input type="file" id="fileEdt" name="filesEdt[]" multiple="multiple" accept="image/*" class="hide" /></p>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

                <a href="../controller/deleteLocation.php?id=<?= $location['id'] ?>" class="btn btn-danger">DELETE</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include "../layout/baseFooter.php" ?>
