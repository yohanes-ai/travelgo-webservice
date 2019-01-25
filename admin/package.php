<?php
require '../vendor/autoload.php';

use Carbon\Carbon;
use Carbon\CarbonInterval;
include "../controller/connection.php";

$sql="select m_package.*,m_tour.name as name,m_location.name as location
from m_package
join m_tourpack on m_package.id=m_tourpack.package_id
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
			<table class="table">
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
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#showModal<?= $tour['id'] ?>">
                  View Detail
                </button>
                <div class="modal fade" id="showModal<?= $tour['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Tour Package</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                      	<?php
                      	$sql="select * from m_tourpack
                      	where package_id=".$tour['id'];
                      	$query=mysqli_query($conn,$sql);
                      	$arrTourPack=[];
                      	while($row = mysqli_fetch_assoc($query))
                      		array_push($arrTourPack,$row);
                      	?>
                      	<table class="table">
                      		<thead>
                      			<th>No</th>
                      			<th>Nama</th>
                      			<th>Description</th>
                      			<th>Price</th>
                      			<th>Photo</th>
                      		</thead>
                      		<tbody>
                      			<?php foreach($arrTourPack as $key1=>$tourPack){ ?>
                      				<tr>
                      					<td><?= $key1+1 ?></td>
                      					<td><?= $tourPack['name'] ?></td>
                      					<td><?= ($tourPack['description']!="")?$tourPack['description']:"-" ?></td>
                      					<td>Rp. <?= number_format($tourPack['price'],0,'.',',') ?></td>
                      					<td>
                      						<?php if($tourPack['url_photo']!=""){ ?>
                      							<img src="../images/tour_pack/<?= $tourPack['url_photo'] ?>" height="100px"/>
                      						<?php } ?>
                      					</td>
                      				</tr>
                      			<?php } ?>
                      		</tbody>
                      	</table>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php include "../layout/baseFooter.php" ?>
