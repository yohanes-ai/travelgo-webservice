<?php
  include "../controller/connection.php";

  $sql="select * from m_user where email!='admin@admin.com'";
  $query=mysqli_query($conn,$sql);
  $arrUser=[];
  while($row = mysqli_fetch_assoc($query)){
    $sql="select * from m_tour where user_id=".$row['id'];
    $query1=mysqli_query($conn,$sql);
    $row['tour']=mysqli_fetch_assoc($query1);
    array_push($arrUser,$row);
  }
?>
<?php include "../layout/baseHeader.php" ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-6">
      <h4>User</h4>
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
            <form method="post" action="../controller/addUser.php">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
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
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">
                </div>
                <div class="form-group">
                  <label for="tour_name">Tour Name</label>
                  <input type="text" class="form-control" id="tour_name" name="tour_name" placeholder="Tour Name">
                </div>
                <div class="form-group">
                  <label for="tour_description">Tour Description</label>
                  <textarea class="form-control" id="tour_description" name="tour_description" placeholder="Tour Description"></textarea>
                </div>
                <div class="form-group">
                  <label for="tour_address">Tour Address</label>
                  <input type="text" class="form-control" id="tour_address" name="tour_address" placeholder="Tour Address">
                </div>
                <div class="form-group">
                  <label for="tour_phone">Tour Phone</label>
                  <input type="text" class="form-control" id="tour_phone" name="tour_phone" placeholder="Tour Phone">
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
            <th>Email</th>
            <th>Phone</th>
            <th>Tour Name</th>
            <th>Tour Description</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($arrUser as $key=>$user){ ?>
            <tr>
              <td><?= $key+1 ?></td>
              <td><?= $user['name'] ?></td>
              <td><?= $user['email'] ?></td>
              <td><?= $user['phone'] ?></td>
              <td><?= $user['tour']['name'] ?></td>
              <td><?= $user['tour']['description'] ?></td>
              <td>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal<?= $user['id'] ?>">
                  EDIT
                </button>

                <!-- Modal -->
                <div class="modal fade" id="editModal<?= $user['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <form method="post" action="../controller/editUser.php">
                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Edit Tour</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?= $user['name'] ?>">
                          </div>
                          <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= $user['email'] ?>">
                          </div>
                          <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="<?= $user['phone'] ?>">
                          </div>
                          <div class="form-group">
                            <label for="tour_name">Tour Name</label>
                            <input type="text" class="form-control" id="tour_name" name="tour_name" placeholder="Tour Name" value="<?= $user['tour']['name'] ?>">
                          </div>
                          <div class="form-group">
                            <label for="tour_description">Tour Description</label>
                            <textarea class="form-control" id="tour_description" name="tour_description" placeholder="Tour Description"><?= $user['tour']['description'] ?></textarea>
                          </div>
                          <div class="form-group">
                            <label for="tour_address">Tour Address</label>
                            <input type="text" class="form-control" id="tour_address" name="tour_address" placeholder="Tour Address" value="<?= $user['tour']['address'] ?>">
                          </div>
                          <div class="form-group">
                            <label for="tour_phone">Tour Phone</label>
                            <input type="text" class="form-control" id="tour_phone" name="tour_phone" placeholder="Tour Phone" value="<?= $user['tour']['phone'] ?>">
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

                <a href="../controller/deleteUser.php?id=<?= $user['id'] ?>" class="btn btn-danger">DELETE</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include "../layout/baseFooter.php" ?>
