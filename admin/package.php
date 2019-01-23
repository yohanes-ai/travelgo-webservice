<?php
  include "../controller/connection.php";

  $sql="select m_package.*,m_tour.name as name,m_tour.address as address,m_tour.phone as phone from m_package
    join m_tour on m_tour.id=m_package.user_id";
  $query=mysqli_query($conn,$sql);
  $arrTour=[];
  while($row = mysqli_fetch_assoc($query))
    array_push($arrTour,$row);
?>
<?php include "../layout/baseHeader.php" ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <h4>Package</h4>
    </div>

    <div class="col-sm-12">
      <table class="table">
        <thead>
          <tr>
            <th>No</th>
            <th>Name</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Approve</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($arrTour as $key=>$tour){ ?>
            <tr>
              <td><?= $key+1 ?></td>
              <td><?= $tour['name'] ?></td>
              <td><?= $tour['address'] ?></td>
              <td><?= $tour['phone'] ?></td>
              <td><?= ($tour['approval']==1)?'Yes':'No' ?></td>
              <td>
                <?php if($tour['approval']==0){ ?>
                  <a href="../controller/approvalPackage.php?id=<?= $tour['id'] ?>" class="btn btn-primary">APPROVE</a>
                <?php } ?>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include "../layout/baseFooter.php" ?>
