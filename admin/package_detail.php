<?php
require '../vendor/autoload.php';

use Carbon\Carbon;
use Carbon\CarbonInterval;
include "../controller/connection.php";

$sql="select * from m_tourpack
where package_id=".$_GET['id'];
$query=mysqli_query($conn,$sql);
$arrTourPack=[];
while($row = mysqli_fetch_assoc($query))
	array_push($arrTourPack,$row);
?>
<?php include "../layout/baseHeader.php" ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<h4>Package Detail</h4>
		</div>
		<div class="col-sm-12">
			<div class="table-responsive">
  			<table class="table nowrap" id="table" width="100%" cellspacing="0">
  				<thead>
  					<tr>
  						<th>No</th>
  						<th>Nama</th>
  						<th>Description</th>
  						<th>Price</th>
  						<th>Photo</th>
  					</tr>
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
  	</div>
		</div>
	</div>
</div>
<?php include "../layout/baseFooter.php" ?>