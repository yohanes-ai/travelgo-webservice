<?php
require '../vendor/autoload.php';

use Carbon\Carbon;
use Carbon\CarbonInterval;
include "../controller/connection.php";

$sql="select m_package.*,m_tour.name as name,m_location.name as location
from m_package
join m_location on m_location.id=m_package.location_id
join m_user on m_user.id=m_package.user_id
join m_tour on m_user.id = m_tour.user_id
order by m_package.id desc";

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
      <div class="table-responsive">
  			<table class="table nowrap" id="table" width="100%" cellspacing="0">
  				<thead>
  					<tr>
  						<th>No</th>
  						<th>Name</th>
  						<th>Location</th>
  						<th>Start Date</th>
  						<th>End Date</th>
  						<th>Approve</th>
  						<th>Action</th>
  					</tr>
  				</thead>
  				<tbody>
  					<?php foreach($arrTour as $key=>$tour){ ?>
  						<tr>
  							<td><?= $key+1 ?></td>
  							<td><?= $tour['name'] ?></td>
  							<td><?= $tour['location'] ?></td>
  							<td><?= Carbon::createFromFormat('Y-m-d',$tour['date_start'])->formatLocalized('%d %B %Y') ?></td>
  							<td><?= Carbon::createFromFormat('Y-m-d',$tour['date_end'])->formatLocalized('%d %B %Y') ?></td>
  							<td><?= ($tour['approval']==1)?'Yes':'No' ?></td>
  							<td>
  								<?php if($tour['approval']==0){ ?>
  									<a href="../controller/approvalPackage.php?id=<?= $tour['id'] ?>" class="btn btn-primary">APPROVE</a>
  									<a href="../controller/declinePackage.php?id=<?= $tour['id'] ?>" class="btn btn-danger">DECLINE</a>
  								<?php } ?>
  								<!-- Button trigger modal -->
                  <a href="package_detail.php?id=<?= $tour['id'] ?>" class="btn btn-default">
                    View Detail
                  </a>
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
